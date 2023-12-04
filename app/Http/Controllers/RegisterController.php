<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password');
        $phone_number = $request->input('phone_number', ''); // Valor padrão vazio se não fornecido
        $address = $request->input('address', ''); // Valor padrão vazio se não fornecido

        // Validar entrada
        if (empty($name) || empty($email) || empty($username) || empty($password)) {
            return "Por favor, preencha todos os campos.";
        }

        // Verificar se o usuário já existe
        $existingUser = User::where('username', $username)->orWhere('email', $email)->first();

        if ($existingUser) {
            return "Nome de usuário ou email já está em uso. Escolha outros.";
        }

        // Criar novo usuário
        $newUser = new User();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->username = $username;
        $newUser->password = $password; // Lembre-se de criptografar a senha no ambiente de produção
        $newUser->phone_number = $phone_number;
        $newUser->address = $address;
        $newUser->save();

        // Registro bem-sucedido
        return redirect()->route('homepage'); // Redireciona para a página inicial
    }
}
