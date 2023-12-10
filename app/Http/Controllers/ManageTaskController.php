<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class ManageTaskController extends Controller
{

    public function viewtask($id_task)
    {
        $task = Task::find($id_task);

        if (!$task) {
            // Lógica para lidar com a tarefa não encontrada, por exemplo, redirecionar de volta para a lista de tarefas.
        }

        // Armazenar a task na Session
        session(['current_task' => $task]);

        return view('viewtask');
    }

}
