<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Priority;
use App\Models\State;
use App\Models\Category;

class ManageTaskController extends Controller
{

    public function viewtask($id_task)
    {
        $task = Task::find($id_task);
        $priorities = Priority::all();
        $states = State::all(); 
        $categories = Category::all(); 

        if (!$task) {
            // Lógica para lidar com a tarefa não encontrada, por exemplo, redirecionar de volta para a lista de tarefas.
        }

        // Armazenar a task na Session
        session(['current_task' => $task]);

        return view('viewtask', [
            'priorities' => $priorities,
            'states' => $states,
            'categories' => $categories,
        ]);
    }

}
