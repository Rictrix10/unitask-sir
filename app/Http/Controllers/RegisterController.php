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
        $phone_number = $request->input('phone_number', ''); 
        $address = $request->input('address', ''); 

        if (empty($username) || empty($email) || empty($name) || empty($password)) {
            return redirect()->route('register')->with('error', 'Por favor, preencha todos os campos!');
        }

        if (strlen($password) <= 8) {
            return redirect()->route('register')->with('error', 'A palavra passe deve ter no mínimo 8 caracteres!');
        } elseif (!preg_match('/[A-Z]/', $password)) {
            return redirect()->route('register')->with('error', 'Deve conter no mínimo uma letra maiúscula!');
        } elseif (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            return redirect()->route('register')->with('error', 'Deve conter no mínimo um caractere especial!');
        }

        // Verificar se o usuário já existe
        $existingUser = User::where('username', $username)->orWhere('email', $email)->first();

        if ($existingUser) {
            return redirect()->route('register')->with('error', 'Nome de usuário ou email já está em uso. Escolha outros!');
        }

        if(!$existingUser){
            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->username = $username;
            $newUser->password = $password; // Lembre-se de criptografar a senha no ambiente de produção
            $newUser->phone_number = $phone_number;
            $newUser->address = $address;
            $newUser->save();

            // Registro bem-sucedido
            return redirect()->route('login'); // Redireciona para a página inicial
        }
    }
}
