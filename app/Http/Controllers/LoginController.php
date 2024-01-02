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
            return redirect()->route('login')->with('error', 'Por favor, preencha todos os campos!');
        }

        $user = DB::table('users')->where('username', $username)->first();

        if ($user) {
            if ($user->password === $password) {
                $id_user = $user->id_user;

                $request->session()->put('id_user', $id_user);

                return redirect()->route('tasks');
            } else {
                return redirect()->route('login')->with('error', 'O nome do utilizador ou a palavra-passe estão incorretos.');
            }
        } else {
            return redirect()->route('login')->with('error', 'O nome do utilizador não foi encontrado!');
        }
    }
}
