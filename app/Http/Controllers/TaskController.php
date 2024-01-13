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

    public function getUserTasks(Request $request)
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

    return view('tasks', compact('tasks', 'priorities', 'states', 'categories'));
}

    /*
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
    */

    public function getSharedTasks()
{
    $userId = Session::get('id_user');

    // Obtenha as tarefas compartilhadas associadas ao usuário da sessão
    $sharedTasks = User::find($userId)->sharedTasks;

    // Criar um array para armazenar tarefas e mensagens associadas
    $tasksWithMessages = [];

    // Iterar sobre as tarefas compartilhadas
    foreach ($sharedTasks as $sharedTask) {
        // Adicionar a tarefa e a mensagem associada ao array
        $tasksWithMessages[] = [
            'task' => $sharedTask->task,
            'message' => $sharedTask->message ?? 'N/A',
        ];
    }

    return view('sharedtasks', ['sharedtasks' => $tasksWithMessages]);
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
        $userType = Session::get('user_type');
        $task = Task::where('id_user', $userId)->find($id_task);

        if (!$task) {
            return redirect()->route('tasks')->with('error', 'Tarefa não encontrada.');
        }

        SharedTask::where('id_task', $id_task)->delete();
        // Remova a tarefa
        $task->delete();

        // Redireciona de volta para a página de tarefas ou para onde for apropriado
        if ($userType == 'Admin') {
            return redirect()->route('alltasks');
        } else {
            return redirect()->route('tasks');
        }
    }

    

    
    public function createtask(Request $request)
    {

        $userId = Session::get('id_user');
        $userType = Session::get('user_type');
        $priorities = Priority::all();
        
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'favorite' => 'nullable|boolean',
            'initial_date' => 'required|date',
            'finish_date' => 'required|date|after:initial_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'initial_date.required' => 'A data inicial é obrigatória.',
            'initial_date.date' => 'A data inicial deve estar no formato correto.',
            'finish_date.required' => 'A data de término é obrigatória.',
            'finish_date.date' => 'A data de término deve estar no formato correto.',
            'finish_date.after' => 'A data de término deve ser posterior à data inicial.',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $task = new Task([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'favorite' => $request->input('favorite', false),
            'image' => $imageName,
            'initial_date' => $request->input('initial_date'),  
            'finish_date' => $request->input('finish_date'),    
            'id_user' => $userId,  
            'id_priority' => $request->input('id_priority'),
            'id_state' => $request->input('id_state'),
            'id_category' => $request->input('id_category')
        ]);

        $task->save();

        if ($userType == 'Admin') {
            return redirect()->route('alltasks');
        } else {
            return redirect()->route('tasks');
        }
    }

    public function shareTask(Request $request, $id_task)
{
    $userId = Session::get('id_user');
    $userType = Session::get('user_type');
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
    if ($userType == 'Admin') {
        return redirect()->route('alltasks');
    } else {
        return redirect()->route('tasks');
    }
}
}