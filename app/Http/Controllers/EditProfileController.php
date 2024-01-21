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


    public function updatePassword(Request $request)
    {

        // Validação dos campos
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8', // ajuste conforme necessário
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Obter o ID do usuário armazenado na sessão
        $userId = Session::get('id_user');

        // Hash da nova senha
        $hashedPassword = Hash::make($request->input('password'));

        // Atualizar a senha do usuário
        DB::table('users')
            ->where('id_user', $userId)
            ->update(['password' => $hashedPassword]);

        // Redirecionar para a página de perfil ou qualquer outra página apropriada
        return redirect()->route('profile')->with('success', 'Senha atualizada com sucesso!');
    }

    
    public function updateUserData(Request $request)
    {
        if ($request->has('dados')) {
            error_log("a");
        }
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