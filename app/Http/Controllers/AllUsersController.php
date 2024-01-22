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
use Illuminate\Support\Facades\Validator;

class AllUsersController extends Controller
{

    public function getAllUsers(Request $request)
    {
        $userIdToExclude = Session::get('id_user');
    
        $users = User::where('id_user', '!=', $userIdToExclude)->get();
    
        return view('allusers', compact('users'));
    }
    
    public function deleteUser(Request $request, $id_user)
    {
    
        $user = User::find($id_user);
    
        if (!$user) {
            return redirect()->route('allusers')->with('error', 'Utilizador não encontrado.');
        }
    
        $user->tasks()->delete();
    
        $user->sharedTasks()->delete();
    
        $user->delete();
    
        return redirect()->route('allusers')->with('success', 'Utilizador eliminado com sucesso.');
    }

    public function profileUser($id_user)
    {

        $user = User::find($id_user);

        if (!$user) {
            return redirect()->route('allusers')->with('error', 'Utilizador não encontrado.');
        }

        return view('edituser', ['user' => $user]);
    }

    public function updateUserData(Request $request, $id_user)
    {
        $user = User::find($id_user);

        if (!$user) {
            return redirect()->route('allusers')->with('error', 'Utilizador não encontrado.');
        }

        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone') ?? null,
            'address' => $request->input('address') ?? null,
            'user_type' => $request->input('user_type'),
        ]);

        return redirect()->route('profileuser', ['id_user' => $user->id_user])->with('success', 'Dados do utilizador atualizados com sucesso.');
    }

    public function adminUpdatePassword(Request $request, $id_user)
    {
        $user = User::find($id_user);
        error_log("a");
        $request->validate([
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ],[
        'confirm_password' => 'required|same:password',
        ]);

        $user->update([
            'password' => $request->input('password')
        ]);
            
         return redirect()->route('profileuser', ['id_user' => $user->id_user])->with('success', 'Dados do utilizador atualizados com sucesso.');
    }

    public function updateTask(Request $request, $id_task)
    {
        $task = Session::get('current_task');

        if (!$task || $task->id_task != $id_task) {
            return redirect()->route('tasks')->with('error', 'Tarefa não encontrada.');
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'favorite' => 'nullable|boolean',
            'id_category' => 'required|exists:categories,id_category',
            'id_priority' => 'required|exists:priorities,id_priority',
            'id_state' => 'required|exists:states,id_state',
        ]);

        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->favorite = $request->input('favorite', false);
        $task->id_category = $request->input('id_category');
        $task->id_priority = $request->input('id_priority');
        $task->id_state = $request->input('id_state');

        $task->save();

        return redirect()->route('allusers');
    }
}
