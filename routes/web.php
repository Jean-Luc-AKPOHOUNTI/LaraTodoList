<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [TaskController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour la gestion des tâches
    Route::prefix('tasks')->name('tasks.')->group(function () {
        // GET /tasks - Afficher toutes les tâches
        Route::get('/', [TaskController::class, 'index'])->name('index');
        
        // GET /tasks/create - Formulaire de création
        Route::get('/create', [TaskController::class, 'create'])->name('create');
        
        // POST /tasks - Enregistrer une nouvelle tâche
        Route::post('/', [TaskController::class, 'store'])->name('store');
        
        // GET /tasks/{task} - Afficher une tâche spécifique
        Route::get('/{task}', [TaskController::class, 'show'])->name('show');
        
        // GET /tasks/{task}/edit - Formulaire d'édition
        Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('edit');
        
        // PUT/PATCH /tasks/{task} - Mettre à jour une tâche
        Route::put('/{task}', [TaskController::class, 'update'])->name('update');
        Route::patch('/{task}', [TaskController::class, 'update']);
        
        // DELETE /tasks/{task} - Supprimer une tâche
        Route::delete('/{task}', [TaskController::class, 'destroy'])->name('destroy');
    });
    
    // Route alternative avec resource (plus simple)
    // Route::resource('tasks', TaskController::class);
});

require __DIR__.'/auth.php';
