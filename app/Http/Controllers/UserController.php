<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Models\User;

class UserController extends Controller
{
    public function showallusers(){
        $users = User::all();
        return dd($users);
    }

    /*
    public function showuser($id = 0){
        return "showuser:".$id;
    } 
    */

}
