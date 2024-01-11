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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AllUsersController extends Controller
{

    public function getAllUsers(Request $request)
    {
    //$usersQuery = User::all();
        $users = User::all();
        return view('allusers', compact('users'));
    }

    public function deleteUser(Request $request, $id_user)
    {
    
        // Obtém o usuário com base no ID
        $user = User::find($id_user);
    
        // Verifica se o usuário foi encontrado
        if (!$user) {
            return redirect()->route('allusers')->with('error', 'Utilizador não encontrado.');
        }
    
        $user->tasks()->delete();
    
        $user->sharedTasks()->delete();
    
        $user->delete();
    
        // Redireciona de volta para a página de usuários ou para onde for apropriado
        return redirect()->route('allusers')->with('success', 'Utilizador eliminado com sucesso.');
    }

    public function profileUser($id_user)
{
    // Obter o usuário com base no ID
    $user = User::find($id_user);

    // Verificar se o usuário foi encontrado
    if (!$user) {
        return redirect()->route('allusers')->with('error', 'Utilizador não encontrado.');
    }

    // Passar os dados do usuário para a view
    return view('edituser', ['user' => $user]);
}

public function updateUserData(Request $request, $id_user)
{
    // Obter o usuário com base no ID
    $user = User::find($id_user);

    // Verificar se o usuário foi encontrado
    if (!$user) {
        return redirect()->route('allusers')->with('error', 'Utilizador não encontrado.');
    }

    // Validar os campos que são obrigatórios
    $request->validate([
        'name' => 'required',
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Atualizar os dados do usuário
    $user->update([
        'name' => $request->input('name'),
        'username' => $request->input('username'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
        'phone_number' => $request->input('phone') ?? null,
        'address' => $request->input('address') ?? null,
    ]);

    // Redirecionar de volta à página de perfil
    return redirect()->route('profileuser', ['id_user' => $user->id_user])->with('success', 'Dados do utilizador atualizados com sucesso.');
}



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
    return redirect()->route('allusers');
}


}
