<?php

namespace App\Http\Controllers\Api;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Get /api/tasks
    public function index() {
        $tasks = Task::all();
        return response() ->json([
            'message' => 'Task Berhasil ditampilkan',
            'data' => TaskResource::collection($tasks)
        ],200);
    }

    public function store(Request $request){
       
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);
       
        $tasks = Task::create($validated);

       return response()->json([
            'message' => 'Task Berhasil ditambahkan',
            'data' => new TaskResource($tasks)
       ],201);
    }

    public function show($id){
        $task = Task::find($id);
        if(!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json([
            'message' => 'Task Berhasil ditampilkan',
            'data' => new TaskResource($task)
        ],200);
    }

    public function update(Request $request, $id){
        $task = Task::find($id);
        if(!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_completed' => 'boolean',
        ]);

        $task->update($validated);
        return response()->json([
            'message' => 'Task Berhasil diupdate',
            'data' => new TaskResource($task)
        ],200);
    }

    public function destroy($id){
        $task = Task::find($id);
        if(!$task){
            return response()->json(['message' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}