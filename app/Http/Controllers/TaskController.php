<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Pour Afficher la liste de toutes les tâches
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return Inertia::render('Tasks/Index', ['tasks' => $tasks]);
    }

    /**
     * Pour Afficher le formulaire de création d'une nouvelle tâche
     */
    public function create()
    {
        return Inertia::render('Tasks/Create');
    }

    /**
     * Pour Enregistrer une nouvelle tâche en base de données
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255|unique:tasks',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'status' => 'required|in:todo,in_progress,complete'
        ]);

        // Création de la tâche
        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès');
    }

    /**
     * Pour Afficher une tâche spécifique en utilisant find()
    */
    public function show($id)
    {
        $task = Task::find($id);
        return Inertia::render('Tasks/Show', ['task' => $task]);
    }

    /**
     * Pour Afficher le formulaire d'édition d'une tâche
    */
    public function edit($id)
    {
        $task = Task::find($id);
        return Inertia::render('Tasks/Edit', ['task' => $task]);
    }

    /**
     * Pour Mettre à jour une tâche existante
     */
    public function update(Request $request, Task $task)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'status' => 'required|in:todo,in_progress,complete'
        ]);

        // Vérification de l'unicité du titre, sauf pour la tâche actuelle
        if ($request->title !== $task->title) {
            if(Task::where('title', $request->title)->exists()) {
                return redirect()->route('tasks.index')
                    ->with('error', 'Une tâche avec ce titre existe déjà');
            }
        }

        // Mise à jour de la tâche
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès');
    }

    /**
     * Pour Supprimer une tâche
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès');
    }
}
