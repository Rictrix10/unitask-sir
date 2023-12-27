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

class TaskController extends Controller
{
    public function getUserTasks()
    {
        $userId = Session::get('id_user');
        $tasks = Task::where('id_user', $userId)->get();

        return view('tasks', ['tasks' => $tasks]);
    }

    public function getSharedTasks()
    {
        $userId = Session::get('id_user');

        // Obtenha as tarefas compartilhadas associadas ao usuário da sessão
        $sharedTasks = User::find($userId)->sharedTasks;

        // Extrair as tarefas associadas aos registros compartilhados
        $tasks = $sharedTasks->map(function ($sharedTask) {
            return $sharedTask->task;
        });

        return view('sharedtasks', ['sharedtasks' => $tasks]);
    }

    public function showCreateTaskForm()
    {
        $priorities = Priority::all();
        $states = State::all(); 
        $categories = Category::all(); 
    
        return view('createtask', [
            'priorities' => $priorities,
            'states' => $states,
            'categories' => $categories,
        ]);
    }

    public function deleteTask(Request $request, $id_task)
    {
        $userId = Session::get('id_user');
        $task = Task::where('id_user', $userId)->find($id_task);

        if (!$task) {
            return redirect()->route('tasks')->with('error', 'Tarefa não encontrada.');
        }

        SharedTask::where('id_task', $id_task)->delete();
        // Remova a tarefa
        $task->delete();

        // Redireciona de volta para a página de tarefas ou para onde for apropriado
        return redirect()->route('tasks');
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
            //'prioridade' => 'required|in:alta,normal,baixa',
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
            'initial_date' => $request->input('initial_date'),  // Pode ser ajustado conforme necessário
            'finish_date' => null,    // Pode ser ajustado conforme necessário
            'id_user' => $userId,  // Obtém o ID do usuário autenticado
            'id_priority' => $request->input('id_priority'),
            'id_state' => $request->input('id_state'),
            'id_category' => $request->input('id_category')
        ]);

        $task->save();

        // Redireciona de volta para a página de tarefas ou para onde for apropriado
        return redirect()->route('tasks');
    }

    public function shareTask(Request $request, $id_task)
{
    $userId = Session::get('id_user');
    $task = Task::where('id_user', $userId)->find($id_task);

    if (!$task) {
        return redirect()->route('tasks')->with('error', 'Tarefa não encontrada.');
    }

    // Validação dos dados do formulário de partilha
    $request->validate([
        'email' => 'required|email',
        'message' => 'required|string',
    ]);

    // Encontrar o usuário com base no email fornecido
    $user = User::where('email', $request->input('email'))->first();

    if (!$user) {
        return redirect()->route('tasks')->with('share_error', 'Utilizador com o email fornecido não encontrado.');
    }

    // Verifica se a tarefa já foi compartilhada com este usuário
    $existingSharedTask = SharedTask::where('id_user', $user->id_user)
        ->where('id_task', $id_task)
        ->first();

    if ($existingSharedTask) {
        return redirect()->route('tasks')->with('share_error', 'Esta tarefa já foi compartilhada com o utilizador.');
    }

    // Verifica se o usuário tem permissão para compartilhar a tarefa
    // (adicione lógica conforme necessário)

    // Criação do registro na tabela shared_tasks
    $sharedTask = new SharedTask([
        'message' => $request->input('message'),
        'id_user' => $user->id_user,
        'id_task' => $id_task,
    ]);

    $sharedTask->save();

    // Redireciona de volta para a página de tarefas ou para onde for apropriado
    return redirect()->route('tasks')->with('success', 'Tarefa compartilhada com sucesso.');
}
}
