<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', function () {
    $userId = auth()->id();
    $total = Task::where('user_id', $userId)->count();
    $todo = Task::where('user_id', $userId)->where('status', 'todo')->count();
    $inProgress = Task::where('user_id', $userId)->where('status', 'in_progress')->count();
    $done = Task::where('user_id', $userId)->where('status', 'done')->count();
    $overdue = Task::where('user_id', $userId)
        ->whereNotNull('deadline')
        ->where('deadline', '<', now()->toDateString())
        ->where('status', '!=', 'done')
        ->count();

    $completion = $total > 0 ? round(($done / $total) * 100) : 0;

    return view('dashboard', compact('total', 'todo', 'inProgress', 'done', 'overdue', 'completion'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tasks', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('Tasks');

Route::get('/search', [TaskController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('search');

Route::post('/tasks', [TaskController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.store');

Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.edit');

Route::put('/tasks/{task}', [TaskController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.update');

Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.destroy');

Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->middleware(['auth', 'verified'])
    ->name('tasks.status');


// Route::get('tasks', [TaskController::class, 'index']);
// Route::resource('tasks', TaskController::class)->middleware('auth');
// Route::get('tasks/create', [TaskController::class, 'create'])->middleware('auth')->name('tasks.create');
// Route::post('tasks', [TaskController::class, 'store'])->middleware('auth')->name('tasks.store');
// Route::get('tasks/{id}/edit', [TaskController::class, 'edit'])->middleware('auth')->name('tasks.edit');
// Route::put('tasks/{id}', [TaskController::class, 'update'])->middleware('auth')->name('tasks.update');
// Route::delete('tasks/{id}', [TaskController::class, 'destroy'])->middleware('auth')->name('tasks.destroy');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
