<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where(function ($q) {
            $q->where('assigned_to', auth()->id())
              ->orWhere('created_by', auth()->id())
              ->orWhereNull('assigned_to');
        })
        ->with(['assignedTo', 'createdBy', 'facility'])
        ->latest()
        ->paginate(20);

        return view('tasks.index', compact('tasks'));
    }

    public function complete(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);

        return back()->with('success', 'Task completed!');
    }
}