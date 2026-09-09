<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\addTaskRequest;
use App\Http\Requests\Task\editTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function getAllMyTasks(){
        $task = Task::query()->where('tasks.user_id', auth()->id())->get();
        if ($task->isEmpty()) {
            return response()->json(['error' => 'No tasks found'], 404);
        }
        return response()->json($task, 200);
    }

    public function getMyTask(Task $task){
        if ($task->user_id !== auth()->id()) {
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        return response()->json($task, 200);
    }

    public function addMyTask(addTaskRequest $request){
        if ($request->validated()['type'] == 'single') {
            $count = 1;
            $count_completed = 0;
        }else{
            $count = $request->validated()['count'] ?? 1;
            $count_completed = $request->validated()['completed'] ?? 0;
        }
        if($count_completed >= $count){
            return response()->json(['error' => "You can't add more completed task"], 403);
        }
        Task::query()->create([
            'user_id' => auth()->id(),
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'type' => $request->validated()['type'],
            'count' => $count,
            'count_completed' => $count_completed,
            'priority' => $request->validated()['priority'],
        ]);
        return response()->json(['success' => 'Task added successfully.'], 200);
    }

    public function editMyTask(Task $task,editTaskRequest $request){
        if ($task->user_id !== auth()->id()) {
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        $task->query()->update($request->validated());
        return response()->json(['success' => 'Task edited successfully.'], 200);
    }

    public function deleteMyTask(Task $task){
        if ($task->user_id !== auth()->id()) {
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        $task->delete();
        return response()->json(['success' => 'Task deleted successfully.'], 200);
    }
}
