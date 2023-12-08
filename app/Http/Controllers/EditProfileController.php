<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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

    public function updateUserData(Request $request)
    {
        // Obter o ID do usuário armazenado na sessão
        $userId = Session::get('id_user');

        // Validar os campos que são obrigatórios
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Atualizar os dados do usuário
        DB::table('users')
            ->where('id_user', $userId)
            ->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'phone_number' => $request->input('phone') ?? null, // Torna o campo opcional
                'address' => $request->input('address') ?? null, // Torna o campo opcional
            ]);

        // Redirecionar de volta à página de perfil
        return redirect()->route('profile');
    }
}
