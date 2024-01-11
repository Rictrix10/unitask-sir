<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\SharedTask;
use App\Models\State;

class AdminController extends Controller
{
    public function showStatistics()
    {
        // Número de usuários registrados
        $totalUsers = User::count();

        $totalTasks = Task::count();

        $totalSharedTasks = SharedTask::count();

        // Porcentagem de tarefas em cada estado
        $tasksByState = Task::select('id_state', \DB::raw('count(*) as total'))
            ->groupBy('id_state')
            ->get();

        $totalTasks = Task::count();

        $tasksPercentageByState = $tasksByState->map(function ($item) use ($totalTasks) {
            return [
                'state_id' => $item->id_state,
                'state_name' => State::find($item->id_state)->name,
                'percentage' => ($item->total / $totalTasks) * 100,
            ];
        });

        return view('adminstatistics', compact('totalUsers', 'totalTasks', 'totalSharedTasks', 'tasksPercentageByState'));
    }
}
