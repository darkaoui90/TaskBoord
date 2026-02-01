<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $tasks = Task::where('user_id', auth()->id())
          ->orderBy('created_at', 'desc')
          ->get();

      $tasksByStatus = [
          'todo' => $tasks->where('status', 'todo'),
          'in_progress' => $tasks->where('status', 'in_progress'),
          'done' => $tasks->where('status', 'done'),
      ];

      return view('tasks', compact('tasks', 'tasksByStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('search');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date', 'after_or_equal:today'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:todo,in_progress,done'],
        ]);

        $validated['description'] = $validated['description'] ?: null;
        $validated['deadline'] = $validated['deadline'] ?: null;
        $validated['user_id'] = $request->user()->id;

        Task::create($validated);

        return redirect()->route('Tasks')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->ensureOwner($task);
        return view('tasks-edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $this->ensureOwner($task);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['nullable', 'date', 'after:today'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:todo,in_progress,done'],
        ]);

        $task->update($validated);

        return redirect()->route('Tasks')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->ensureOwner($task);
        $task->delete();
        return redirect()->route('Tasks')->with('success', 'Task deleted successfully.');
    }

    public function updateStatus(Request $request, Task $task)
    {
        $this->ensureOwner($task);

        $validated = $request->validate([
            'status' => ['required', 'in:todo,in_progress,done'],
        ]);

        $task->update($validated);

        return response()->json(['ok' => true]);
    }

    private function ensureOwner(Task $task): void
    {
        abort_unless($task->user_id === auth()->id(), 403);
    }
}
