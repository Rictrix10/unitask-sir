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

        // Validar entrada
        if (!$request->filled(['name', 'email', 'username', 'password'])) {
            return redirect()->route('register')->withErrors(['error2' => 'Por favor, preencha todos os campos!']);
        }

        // Verificar se o usuário já existe
        $existingUser = User::where('username', $username)->orWhere('email', $email)->first();

        if ($existingUser) {
            return redirect()->route('register')->with('error2', 'Nome de usuário ou email já está em uso. Escolha outros.!');
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
