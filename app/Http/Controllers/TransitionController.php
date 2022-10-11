<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use App\Models\Transition;
use Illuminate\Http\Request;

class TransitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $id = $request->id;
        if($id){

            $task = Task::where(['user_id'=>$id])->get();
            $transiton = Transition::where(['user_id'=>$id])->orderBy('id','desc')->get();
            $user = User::find($id);
            $plans = Plan::find($user->plan_id);


            $rows = [

                'user'=>$user,
                'task'=>$task,
                'transiton'=>$transiton,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transition  $transition
     * @return \Illuminate\Http\Response
     */
    public function show(Transition $transition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transition  $transition
     * @return \Illuminate\Http\Response
     */
    public function edit(Transition $transition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transition  $transition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transition $transition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transition  $transition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transition $transition)
    {
        //
    }
}
