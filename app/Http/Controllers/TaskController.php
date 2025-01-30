<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        $data = $request->validated();
        return Task::create($data);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validated();
        $task->update($data);
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json();
    }
}
