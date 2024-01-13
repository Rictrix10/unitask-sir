<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Task;
use App\Models\Priority;
use App\Models\State;
use App\Models\Category;
use App\Models\User;
use App\Models\SharedTask;

class AllTasksController extends Controller
{

    public function getAllTasks(Request $request)
{
    $tasksQuery = Task::query();

    // Apply search filter
    if ($request->filled('search')) {
        $tasksQuery->where('name', 'like', '%' . $request->input('search') . '%');
    }

    // Apply favorite filter
    $filterFavorites = $request->input('filterFavorites');
    if ($filterFavorites === '1') {
        $tasksQuery->where('favorite', true);
    } elseif ($filterFavorites === '0') {
        $tasksQuery->where('favorite', false);
    }

    if ($request->filled('showOnlyUserTasks')) {
        $userId = Session::get('id_user');
        $tasksQuery->where('id_user', $userId);
    }

    // Apply category filter
    $filterCategory = $request->input('filterCategory');
    if (!is_null($filterCategory)) {
        $tasksQuery->where('id_category', $filterCategory);
    }

    // Apply state filter
    $filterState = $request->input('filterState');
    if (!is_null($filterState)) {
        $tasksQuery->where('id_state', $filterState);
    }

    // Apply priority filter
    $filterPriority = $request->input('filterPriority');
    if (!is_null($filterPriority)) {
        $tasksQuery->where('id_priority', $filterPriority);
    }

    // Get the tasks
    $tasks = $tasksQuery->get();

    // Fetch priorities, states, and categories for dropdowns
    $priorities = Priority::all();
    $states = State::all();
    $categories = Category::all();

    return view('alltasks', compact('tasks', 'priorities', 'states', 'categories'));
}

public function getAdminTasks(Request $request)
{
    $userId = Session::get('id_user');
    $tasksQuery = Task::where('id_user', $userId);

    // Apply search filter
    if ($request->filled('search')) {
        $tasksQuery->where('name', 'like', '%' . $request->input('search') . '%');
    }

    /*
    // Apply favorite filter
    if ($request->filled('filterFavorites')) {
        $tasksQuery->where('favorite', true);
    }
    */

    $filterFavorites = $request->input('filterFavorites');

    if ($filterFavorites === '1') {
        $tasksQuery->where('favorite', true);
    } elseif ($filterFavorites === '0') {
        $tasksQuery->where('favorite', false);
    }


    // Apply category filter
    $filterCategory = $request->input('filterCategory');
    if (!is_null($filterCategory)) {
        $tasksQuery->where('id_category', $filterCategory);
    }

    // Apply state filter
    $filterState = $request->input('filterState');
    if (!is_null($filterState)) {
        $tasksQuery->where('id_state', $filterState);
    }

    // Apply priority filter
    $filterPriority = $request->input('filterPriority');
    if (!is_null($filterPriority)) {
        $tasksQuery->where('id_priority', $filterPriority);
    }

    $tasks = $tasksQuery->get();

    // Fetch priorities, states, and categories for dropdowns
    $priorities = Priority::all();
    $states = State::all();
    $categories = Category::all();

    return view('admintasks', compact('tasks', 'priorities', 'states', 'categories'));
}
    

    public function getAllSharedTasks()
    {
        // Obtenha todas as tarefas compartilhadas
        $sharedTasks = SharedTask::all();
    
        // Criar um array para armazenar tarefas e mensagens associadas
        $tasksWithMessages = [];
    
        // Iterar sobre as tarefas compartilhadas
        foreach ($sharedTasks as $sharedTask) {
            // Adicionar a tarefa e a mensagem associada ao array
            $tasksWithMessages[] = [
                'task' => $sharedTask->task,
                'message' => $sharedTask->message ?? 'N/A',
                'username' => $sharedTask->getNickNameAttribute() ?? 'N/A'
            ];
        }
    
        return view('allsharedtasks', ['sharedtasks' => $tasksWithMessages]);
    }

}
