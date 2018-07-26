<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

 
     public function create(){
         return view('users.create');
     }
 



    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //$task = Task::findOrFail($id);
        return response()->json([
            'task' => $task,
            'message' => 'Success'
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit')->with('id',$user->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required',
            ]);

            $task->title = request('title');
            $task->description = request('description');
            $task->save();

            return response()->json([
                'message' => 'Task updated successfully!'
            ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully!'
        ], 200);

    }
}
