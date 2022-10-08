<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use App\Models\Deposit;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $user_id = $request->user_id;
        $count = $request->count;
        if($user_id && $count){
           return  $task = Task::where(['user_id'=>$user_id])->latest()->take($count)->get()->sum('task_comisition');

        }


        $id = $request->id;
        if($id){

            $task = Task::where(['user_id'=>$id])->get();
            $user = User::find($id);
            $plans = Plan::find($user->plan_id);


            $rows = [

                'user'=>$user,
                'task'=>$task,
                'plans'=>$plans,

            ];
            return $rows;

        }

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



        $user_id = $request->user_id;
        $task_comisition = $request->task_comisition;

     $user = User::find($user_id);

$registerdate =  date('d-m-Y', strtotime($user->created_at));
$todaydate =  date('d-m-Y');


$now = time(); // or your date as well
$your_date = strtotime($registerdate);
$datediff = $now - $your_date;
$registerDays = round($datediff / (60 * 60 * 24));

        if($registerDays>4){

           $planName = Plan::find($user->plan_id)->name;
           if($planName=='VIP0'){
            return 1000;
           }


        }


    $tascount = $user->task;
if($tascount>0){
    $levelOneCommisition =  tasklevelCommistion('Level1', $task_comisition);
    $levelTwoCommisition =  tasklevelCommistion('Level2', $task_comisition);
    $levelThreeCommisition =  tasklevelCommistion('Level3', $task_comisition);
    if ($user->ref_by) {
          $LevelOneUser = User::where(['username' => $user->ref_by])->first();
          $depositCount = Deposit::where(['user_id'=>$LevelOneUser->id,'status'=>'approved'])->count();
        if($depositCount>0){
                        $LevelOneNewBalance = balanceIncrease($LevelOneUser->balance, $levelOneCommisition);
        transitionCreate($LevelOneUser->id,$levelOneCommisition,0,$levelOneCommisition,'increase','','refer_task_commisition','');
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
            transitionCreate($LevelTwoUser->id,$levelTwoCommisition,0,$levelTwoCommisition,'increase','','refer_task_commisition','');

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
                transitionCreate($LevelThreeUser->id,$levelThreeCommisition,0,$levelThreeCommisition,'increase','','refer_task_commisition','');
                $LevelThreeUser->update([
                    'balance' => $LevelThreeNewBalance,
                    'plan_id' => planId($LevelThreeNewBalance),
                ]);
            }
            }
        }
    }






    $newBalance = balanceIncrease($user->balance, $task_comisition);
    $user->decrement('task');
    $user->update([
        'balance'=>$newBalance,
        'plan_id' => planId($newBalance),
    ]);
    transitionCreate($user_id,$task_comisition,0,$task_comisition,'increase',quickRandom(10),'task_comisition','');


    $data = $request->all();


    $data['date'] = date('Y-m-d');
    return Task::create($data);
}else{
    return 444;
}








    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
