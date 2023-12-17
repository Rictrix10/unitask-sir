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

        if (!$task || $task->id_task != $id_task) {
            return redirect()->route('tasks')->with('error', 'Tarefa não encontrada.');
        }

        // Exemplo de validação:
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'favorite' => 'nullable|boolean',
            'id_category' => 'required|exists:categories,id_category',
            'id_priority' => 'required|exists:priorities,id_priority',
            'id_state' => 'required|exists:states,id_state',
        ]);

        // Atualização dos dados da tarefa
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->favorite = $request->input('favorite', false);
        $task->id_category = $request->input('id_category');
        $task->id_priority = $request->input('id_priority');
        $task->id_state = $request->input('id_state');

        // Adicione aqui a lógica para manipulação da imagem, se necessário

        // Salva as alterações
        $task->save();

        // Redireciona de volta para a página de visualização da tarefa ou para onde for apropriado
        return redirect()->route('tasks');
    }
}