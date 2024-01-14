<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\SharedTask;
use App\Models\State;
use App\Models\Priority;
use App\Models\Category;

class AdminController extends Controller
{
    public function showStatistics()
    {
        // Número de usuários registrados
        $totalUsers = User::count();
    
        // Número total de tarefas
        $totalTasks = Task::count();
    
        // Número total de tarefas compartilhadas
        $totalSharedTasks = SharedTask::count();
    
        // Número total de tarefas favoritas
        $totalFavoriteTasks = Task::where('favorite', true)->count();
    
        // Porcentagem de tarefas em cada estado
        $tasksByState = Task::select('id_state', \DB::raw('count(*) as total'))
            ->groupBy('id_state')
            ->get();
    
        // Porcentagem de tarefas em cada prioridade
        $tasksByPriority = Task::select('id_priority', \DB::raw('count(*) as total'))
            ->groupBy('id_priority')
            ->get();
    
        // Porcentagem de tarefas em cada categoria
        $tasksByCategory = Task::select('id_category', \DB::raw('count(*) as total'))
            ->groupBy('id_category')
            ->get();
    
        // Inicializar as porcentagens com valores padrão
        $tasksPercentageByState = collect([]);
        $tasksPercentageByPriority = collect([]);
        $tasksPercentageByCategory = collect([]);
    
        // Calcular a porcentagem de tarefas por estado
        if ($totalTasks > 0) {
            $tasksPercentageByState = $tasksByState->map(function ($item) use ($totalTasks) {
                return [
                    'state_id' => $item->id_state,
                    'state_name' => State::find($item->id_state)->name,
                    'percentage' => number_format(($item->total / $totalTasks) * 100, 2),
                ];
            });
        }
    
        // Calcular a porcentagem de tarefas por prioridade
        if ($totalTasks > 0) {
            $tasksPercentageByPriority = $tasksByPriority->map(function ($item) use ($totalTasks) {
                return [
                    'priority_id' => $item->id_priority,
                    'priority_name' => Priority::find($item->id_priority)->name,
                    'percentage' => number_format(($item->total / $totalTasks) * 100, 2),
                ];
            });
        }
    
        // Calcular a porcentagem de tarefas por categoria
        if ($totalTasks > 0) {
            $tasksPercentageByCategory = $tasksByCategory->map(function ($item) use ($totalTasks) {
                return [
                    'category_id' => $item->id_category,
                    'category_name' => Category::find($item->id_category)->name,
                    'percentage' => number_format(($item->total / $totalTasks) * 100, 2),
                ];
            });
        }
    
        // Obter a tarefa mais antiga e a mais recente
        $oldestTaskDate = Task::orderBy('created_at', 'asc')->first();
        $newestTaskDate = Task::orderBy('created_at', 'desc')->first();
    
        // Obter o usuário mais antigo e o mais recente
        $oldestUser = User::where('user_type', 'User')->orderBy('created_at', 'asc')->first();
        $newestUser = User::where('user_type', 'User')->orderBy('created_at', 'desc')->first();
    
        return view('adminstatistics', compact(
            'totalUsers',
            'totalTasks',
            'totalSharedTasks',
            'tasksPercentageByState',
            'tasksPercentageByPriority',
            'tasksPercentageByCategory',
            'totalFavoriteTasks',
            'oldestTaskDate',
            'newestTaskDate',
            'oldestUser',
            'newestUser'
        ));
    }
}    
