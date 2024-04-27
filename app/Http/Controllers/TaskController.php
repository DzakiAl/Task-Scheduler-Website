<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $data = $request->validate([
            'task' => ['required', 'string'],
            'time' => ['required', 'date_format:H:i'],
            'date' => ['required', 'date']
        ]);        
    
        $data['user_id'] = $request->user()->id;
        $task = Task::create($data);
    
        // Retrieve tasks again after creating a new task
        $tasks = Task::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
    
        // Pass the $tasks variable to the index view
        return view('task.index', compact('tasks'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->task = $request->input('task');
        $task->date = $request->input('date');
        $task->time = $request->input('time');
        $task->save();

        return to_route('task.index', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return to_route('task.index', $task);
    }
}
