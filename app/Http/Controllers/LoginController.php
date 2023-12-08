<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (empty($username) || empty($password)) {
            return "Por favor, preencha todos os campos.";
        }

        $user = DB::table('users')->where('username', $username)->first();

        if ($user) {
            // Usuário encontrado, verifique a senha
            if ($user->password === $password) {
                // Autenticação bem-sucedida
                // Obtém o id_user do usuário encontrado
                $id_user = $user->id_user;

                $request->session()->put('id_user', $id_user);

                // Agora você pode usar $id_user conforme necessário

                return redirect()->route('homepage'); // Redireciona para a página inicial
            } else {
                return "Nome de usuário ou senha incorretos.";
            }
        } else {
            return "Nome de usuário não encontrado.";
        }
    }
}
