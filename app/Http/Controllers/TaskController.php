<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Task;
use App\Models\Priority;

class TaskController extends Controller
{
    public function getUserTasks()
    {
        $userId = Session::get('id_user');
        $tasks = Task::where('id_user', $userId)->get();

        return view('tasks', ['tasks' => $tasks]);
    }

    
    public function createtask(Request $request)
    {

        $userId = Session::get('id_user');

        $priorities = Priority::all();
        
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'favorite' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'prioridade' => 'required|in:alta,normal,baixa',
        ]);

        // Manipulação do upload da imagem (caso tenha sido fornecida)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        // Criação da nova tarefa
        $task = new Task([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'favorite' => $request->input('favorite', false),
            'image' => $imageName,
            //'initial_date' => now(),  // Pode ser ajustado conforme necessário
            'initial_date' => null, 
            'finish_date' => null,    // Pode ser ajustado conforme necessário
            'id_user' => $userId,  // Obtém o ID do usuário autenticado
            'id_priority' => 1,
            'id_state' => 1,    
        ]);

        $task->save();

        // Redireciona de volta para a página de tarefas ou para onde for apropriado
        return redirect()->route('tasks');
    }
}
