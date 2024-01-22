<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class EditProfileController extends Controller
{

    public function putdatauser()
    {
        // Obter o ID do usuário armazenado na sessão
        $userId = Session::get('id_user');

        // Log para verificar se o id_user está sendo recuperado corretamente
        Log::info("ID do usuário recuperado da sessão: " . $userId);

        // Obter os dados do usuário com base no ID
        $user = DB::table('users')->where('id_user', $userId)->first();

        // Passar os dados do usuário para a view
        return view('profile', ['user' => $user]);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/',
            'confirmpassword' => 'required|same:password',
        ], [
            'password.regex' => 'A palavra-passe deve ter pelo menos 8 caracteres, uma letra maiúscula, um número e um caractere especial.',
            'confirmpassword' => 'As palavras-passe não coincidem.',
        ]);
    
        // Obter o ID do usuário armazenado na sessão
        $userId = Session::get('id_user');

    
        // Atualizar a senha do usuário
        DB::table('users')
            ->where('id_user', $userId)
            ->update(['password' => $request->input('password')]);
    
        // Redirecionar para a página de perfil ou qualquer outra página apropriada
        return redirect()->route('profile')->with('success', 'Senha atualizada com sucesso!');
    }
    

    
    public function updateUserData(Request $request)
    {
        // Obter o ID do usuário armazenado na sessão
        $userId = Session::get('id_user');

        // Validar os campos que são obrigatórios
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
        ],[
            'name.required' => 'O nome é obrigatório.',
            'username.required' => 'O username é obrigatório.',
            'email.required' => 'O email é obrigatório.',
        ]);

        // Atualizar os dados do usuário
        DB::table('users')
            ->where('id_user', $userId)
            ->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'phone_number' => $request->input('phone') ?? null, // Torna o campo opcional
                'address' => $request->input('address') ?? null, // Torna o campo opcional
            ]);

        // Redirecionar de volta à página de perfil
        return redirect()->route('profile');
    }


    public function deleteUser()
    {
        // Obter o ID do usuário armazenado na sessão
        $userId = Session::get('id_user');

        // Excluir o usuário
        DB::table('users')->where('id_user', $userId)->delete();

        // Redirecionar para a página de login ou qualquer outra página apropriada após a exclusão
        return redirect()->route('login');
    }
}