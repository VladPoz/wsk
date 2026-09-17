<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\addTaskRequest;
use App\Http\Requests\Task\countCompletedTaskRequest;
use App\Http\Requests\Task\editTaskRequest;
use App\Http\Requests\Task\toggleTaskRequest;
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
        if($request->validated()['count_completed'] >= $request->validated()['count']){
            return response()->json(['error' => "You can't add more completed task"], 403);
        }
        Task::query()->create([
            'user_id' => auth()->id(),
            'title' => $request->validated()['title'],
            'description' => $request->validated()['description'],
            'type' => $request->validated()['type'],
            'count' => $request->validated()['count'] ?? 1,
            'count_completed' => $request->validated()['count_completed'] ?? 0,
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

    public function toggleTaskStatus(Task $task){
        if($task->user_id !== auth()->id()){
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        if($task->type == 'single'){
            if($task->completed == false){
                $task->update(['completed' => true, 'count_completed' => $task->count]);
                return response()->json(['success' => 'Task completed successfully.'], 200);
            }
            $task->update(['completed' => false, 'count_completed' => 0]);
            return response()->json(['success' => 'Task incompleted successfully.'], 200);
        }
        if($task->completed == false){
            $task->update(['completed' => true]);
            return response()->json(['success' => 'Task completed successfully.'], 200);
        }
        $task->update(['completed' => false]);
        return response()->json(['success' => 'Task incompleted successfully.'], 200);
    }

    public function plusCompletedTask(Task $task, countCompletedTaskRequest $request){
        if($task->user_id != auth()->id()){
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        if($task->type !== 'multiple'){
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        $value = $task->count_completed + $request->validated()['count'];
        $task->update(['count_completed' => $value]);
        return response()->json(['success' => 'Task updated successfully.'], 200);
    }

    public function minusCompletedTask(Task $task, countCompletedTaskRequest $request){
        if($task->user_id != auth()->id()){
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        if($task->type !== 'multiple'){
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        $value = $task->count_completed - $request->validated()['count'];
        if ($value < 0){
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        $task->update(['count_completed' => $value]);
        return response()->json(['success' => 'Task updated successfully.'], 200);
    }

    public function deleteMyTask(Task $task){
        if ($task->user_id !== auth()->id()) {
            return response()->json(['error' => "You don't have access to this task."], 403);
        }
        $task->delete();
        return response()->json(['success' => 'Task deleted successfully.'], 200);
    }
}
