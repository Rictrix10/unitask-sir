<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Priority;
use App\Models\State;

class EditTaskController extends Controller
{
    public function updateTask(Request $request, $id_task)
    {
        $task = Session::get('current_task');
        $userId = Session::get('id_user');
        $userType = Session::get('user_type');

        if (!$task || $task->id_task != $id_task) {
            return redirect()->route('tasks')->with('error', 'Tarefa não encontrada.');
        }

        // Exemplo de validação:
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:300',
            'favorite' => 'nullable|boolean',
            'initial_date' => 'required|date',
            'finish_date' => 'required|date|after:initial_date',  
            'id_category' => 'required|exists:categories,id_category',
            'id_priority' => 'required|exists:priorities,id_priority',
            'id_state' => 'required|exists:states,id_state',
        ],[
            'name.required' => 'O nome é obrigatório.',
            'description.required' => 'A descrição é obrigatoria é obrigatório.',
            'description.max' => 'A descrição só pode ter 300 catacteres',
            'finish_date.after' => 'A data de término deve ser posterior à data inicial.', 
            'finish_date.date' => 'A data de término deve estar no formato correto.',
            'initial_date.required' => 'A data inicial é obrigatória.',
            'initial_date.date' => 'A data inicial deve estar no formato correto.',
            'finish_date.required' => 'A data de término é obrigatória.',
            'username.required' => 'O username é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'password.required' => 'A palavra-passe é obrigatório.',
        ]);

        // Atualização dos dados da tarefa
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->favorite = $request->input('favorite', false);
        $task->initial_date = $request->input('initial_date');
        $task->finish_date = $request->input('finish_date');
        $task->id_category = $request->input('id_category');
        $task->id_priority = $request->input('id_priority');
        $task->id_state = $request->input('id_state');

        $task->save();
        
        if ($userType == 'Admin') {
            return redirect()->route('alltasks')->with('success', 'Tarefa atualizada com sucesso.');
        } else {
            return redirect()->route('tasks')->with('success', 'Tarefa atualizada com sucesso.');
        }
    }
}