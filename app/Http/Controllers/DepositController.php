<?php
namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Level;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Transition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DepositController extends Controller
{

    public function CTRLRequest($url='',$data='',$header=['Content-Type: application/json'])
    {

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => $header,
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;

    }



    public function paymentwebhook(Request $request)
    {


          $apiResponse =  json_decode($request->all());

$method =  ucfirst($apiResponse->payment_method);
$sender_number =  $apiResponse->sender_number;
$amount =  $apiResponse->amount;
$transaction_id =  $apiResponse->transaction_id;
 $user_id =  $apiResponse->metadata->userid;


        $methodData = Gateway::where(['name' => $method])->first();
        $depositData = [
            'user_id'=>$user_id,
            'method'=>$methodData->id,
            'amount'=>$amount,
            'curency'=>$methodData->currency,
            'rate'=>$methodData->rate,
            'sender'=>$sender_number,
            'trx'=>$transaction_id,
            'status'=>'pending',
        ];
      $new_Deposit =    Deposit::create($depositData);

      return  $this->userbanned('approved',$new_Deposit->id);



    }


    public function paymentSuccess(Request $request)
    {





        $panel_url = env('UDDOKTAPY_URL');
        $Api_Key = env('UDDOKTAPY_API_KEY');
        $invoice_id = $request->invoice_id;

        $data = ["invoice_id"=>"$invoice_id"];
        $data = json_encode($data);

        $header = [
        "RT-UDDOKTAPAY-API-KEY: $Api_Key",
        "Content-Type: application/json"
        ];




          $apiResponse =  json_decode($this->CTRLRequest("$panel_url/api/verify-payment",$data,$header));

$method =  ucfirst($apiResponse->payment_method);
$sender_number =  $apiResponse->sender_number;
$amount =  $apiResponse->amount;
$transaction_id =  $apiResponse->transaction_id;
 $user_id =  $apiResponse->metadata->userid;


        $methodData = Gateway::where(['name' => $method])->first();
        $depositData = [
            'user_id'=>$user_id,
            'method'=>$methodData->id,
            'amount'=>$amount,
            'curency'=>$methodData->currency,
            'rate'=>$methodData->rate,
            'sender'=>$sender_number,
            'trx'=>$transaction_id,
            'status'=>'pending',
        ];
      $new_Deposit =    Deposit::create($depositData);

        $this->userbanned('approved',$new_Deposit->id);


        $redirect = url('/dashboard/user/rechargeHistory');


    $html = "
    <!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
</head>
<body>
    <style>
        *{
            margin:0
        }
    </style>
    <div style='text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);width: 300px;'>
    <h2 style='color:red'>Don't Close this page</h2>
    <p>Please wait untill redirect this page</p>
    <p style='display:none' id='redirect'>if can't redirect this page <a href='$redirect'>Click to redirect</a></p>
    <h2 style='display:block;color:#3e12a8' id='coundown'></h2>
    </div>
<script>
var i = 5;
setInterval(function(){
    document.getElementById('coundown').innerHTML='Please Wait'+i
    if(i==0){
        document.getElementById('redirect').style.display='block'
         document.getElementById('coundown').style.display='none'
         window.location.href = '$redirect'
    }
    i--
}, 1000);


</script>
    </body>
    </html>
    ";
    echo $html;

    die();




    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        if ($id) {
            return Deposit::where(['user_id' => $id])->orderBy('created_at','DESC')->get();
        }
        $status = $request->status;
        if ($status == 'all') {
            return Deposit::with(['methods','users'])->get();
        } else {
            return Deposit::with(['methods','users'])->where([
                'status' => $status
            ])->where('user_id','!=',null)->orderBy('created_at','DESC')->get();
        }
    }


    public function userbanned($status, $id)
    {
        $deposit = Deposit::find($id);
        if ($status == 'approved') {
        $userid = $deposit->user_id;
        $methodid = $deposit->method;
        $user = User::find($userid);
        $DPamount =  $deposit->amount;




        $levelOneCommisition =  levelCommistion('Level1', $DPamount);
        $levelTwoCommisition =  levelCommistion('Level2', $DPamount);
        $levelThreeCommisition =  levelCommistion('Level3', $DPamount);
        if ($user->ref_by) {
            $LevelOneUser = User::where(['username' => $user->ref_by])->first();
            $depositCount = Deposit::where(['user_id'=>$LevelOneUser->id,'status'=>'approved'])->count();
            if($depositCount>0){
            $LevelOneNewBalance = balanceIncrease($LevelOneUser->balance, $levelOneCommisition);
            transitionCreate($LevelOneUser->id,$levelOneCommisition,0,$levelOneCommisition,'increase',$deposit->trx,'refer_commisition','');
            // return planId($LevelOneNewBalance);
            $LevelOneUser->update([
                'balance' => $LevelOneNewBalance,
                'plan_id' => planId($LevelOneNewBalance),
            ]);
        }
            if ($LevelOneUser->ref_by) {
                $LevelTwoUser = User::where(['username' => $LevelOneUser->ref_by])->first();
                $depositCount = Deposit::where(['user_id'=>$LevelTwoUser->id,'status'=>'approved'])->count();
                if($depositCount>0){
                $LevelTwoNewBalance = balanceIncrease($LevelTwoUser->balance, $levelTwoCommisition);
                transitionCreate($LevelTwoUser->id,$levelTwoCommisition,0,$levelTwoCommisition,'increase',$deposit->trx,'refer_commisition','');

                $LevelTwoUser->update([
                    'balance' => $LevelTwoNewBalance,
                    'plan_id' => planId($LevelTwoNewBalance),
                ]);
            }
                if ($LevelTwoUser->ref_by) {
                    $LevelThreeUser = User::where(['username' => $LevelTwoUser->ref_by])->first();
                    $depositCount = Deposit::where(['user_id'=>$LevelThreeUser->id,'status'=>'approved'])->count();
                    if($depositCount>0){
                    $LevelThreeNewBalance = balanceIncrease($LevelThreeUser->balance, $levelThreeCommisition);
                    transitionCreate($LevelThreeUser->id,$levelThreeCommisition,0,$levelThreeCommisition,'increase',$deposit->trx,'refer_commisition','');
                    $LevelThreeUser->update([
                        'balance' => $LevelThreeNewBalance,
                        'plan_id' => planId($LevelThreeNewBalance),
                    ]);
                }
                }
            }
        }
        $method = Gateway::find($methodid);
        $userbalance = $user->balance;
        if ($userbalance == null) $userbalance = 0;
        $amount = $userbalance + $deposit->amount;
        $plans = Plan::where('start_balance', '<=', $amount)->where('end_balance', '>=', $amount)->where('status', 'active')->first();
        if ($status == 'approved') {
            $user->update([
                'plan_id' => planId($amount),
                'balance' => $amount,
            ]);
        }
        transitionCreate($userid,$amount,0,$amount,'increase',$deposit->trx,'rechage','');
    }
        return $deposit->update(['status' => $status]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $method = $request->method;
        $methodData = Gateway::where(['name' => $method])->first();
        $data = $request->all();
        $date = date("Y-m-d");

        if($request->screenshot){
            $data['screenshot'] =  fileupload($request->screenshot, "Recharge/screenshot/$date/");
        }

        $data['method'] =  $methodData->id;
        $data['curency'] =  $methodData->currency;
        $data['rate'] =  $methodData->rate;
        //  $data['trx'] = strtoupper(Str::random(10));
        $data['status'] = 'pending';
        return Deposit::create($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function show(Deposit $deposit)
    {
        $dp =  $deposit;
        $user = User::where(['id' => $dp->user_id])->first();
        $method = Gateway::where(['id' => $dp->method])->first();
        $rows = [
            'deposit' => $dp,
            'user' => $user,
            'method' => $method,
        ];
        return $rows;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposit $deposit)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposit $deposit)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposit  $deposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposit $deposit)
    {
        //
    }
}
