<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Get only the tasks belonging to the logged-in user
        $tasks = auth()->user()->tasks()->latest()->get(); 
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        // Logic from image_1d3bc1.png: Create task linked to the user
        auth()->user()->tasks()->create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        // Find the task only if it belongs to the authenticated user for security
        $task = auth()->user()->tasks()->findOrFail($id);
        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        // Ensure the user can only delete their own tasks
        auth()->user()->tasks()->where('id', $id)->delete();
        
        return redirect()->back();
    }
}