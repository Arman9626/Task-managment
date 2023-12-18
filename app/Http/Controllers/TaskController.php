<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::with(['createdByUser', 'assignedToUser'])->where(
          function ($query) {
              if($search = request()->query('search')){
                  $query->where("name", "LIKE", "%$search%");
              }
          }
        );
        if(auth()->user()->role=='manager'){
            $tasks = $tasks->where('created_by', auth()->id())->paginate(5);
        }else{
            $tasks = $tasks->paginate(5);
        }

        return view('tasks.all-tasks', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $developers = User::where("role", "developer")->get();
        return view('tasks.create-task', compact('developers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $request->merge(['created_by' => auth()->user()->id]);
        Task::create($request->all());
        return redirect()->route('tasks.index')->with("message", "Task has been added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = $task::with(['createdByUser', 'assignedToUser'])->where('created_by', auth()->id())->first();
        if (!$task){
            return abort(401);
        }
        return view('tasks.show-task', compact('task'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $developers = User::where("role", "developer")->get();

        if ($task->created_by !== auth()->id()){
            return abort(401);
        }
        return view('tasks.edit-task', compact('task', 'developers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (!$task->created_by !== auth()->id()){
            return abort(401);
        }
        $task->update($request->except('_token'));
        return redirect()->route('tasks.index')->with('message', 'Task has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->created_by !== auth()->id()){
            return abort(401);
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('message', 'Task has been deleted successfully');
    }
}
