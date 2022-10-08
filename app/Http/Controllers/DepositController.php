<?php
namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\Gateway;
use App\Models\Level;
use App\Models\Plan;
use App\Models\Transition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class DepositController extends Controller
{
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


    public function userbanned(Request $request, $status, $id)
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
