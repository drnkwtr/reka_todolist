<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\CreateTaskRequest;
use App\Http\Requests\Api\v1\UpdateTaskRequest;
use App\Http\Resources\Api\v1\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->orderBy('order')->get();
        return TaskResource::collection($tasks);
    }

    public function store(CreateTaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['order'] = Task::first() ? Task::max('order') + 1 : 1;
        $task = Task::create($data);
        return new TaskResource($task);
    }

    public function show($id)
    {
        $task = Task::find($id);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, $id)
    {
        $data = $request->validated();
        $task = Task::find($id);
        $task->update($data);
        return new TaskResource($task);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->json([
            'success' => true,
        ], 204);
    }
}
