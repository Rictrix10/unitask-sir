<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*
Route::get('/index', function(){
    return view('index');
});
*/
Route::view('/index', '/index');

Route::view('/users', '/users');

Route::get('/login', function(){
    return view('login');
});

Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');

//Route::get('/homepage', 'HomeController@index')->name('homepage');


Route::match(['get', 'post'], '/match', function(){
    return "Permite apenas acessos definidos";
});

Route::get('/user/{id}/{username?}', function($id, $username = ''){
    return "O id do user é:".$id."<br>"."O username é:".$username;
});

Route::redirect('/sobre', '/login');

Route::prefix('homepage')->group(function(){
    Route::get('inbox', function(){
        return "inbox";
    });

    Route::get('/tasks', function(){
        return view('tasks');
    })->name('tasks');

    Route::get('/profile', function(){
        return view('profile');
    })->name('profile');
});

//Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');


//Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');

Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register');

Route::get('/users', [UserController::class, 'showallusers'])->name('users.showallusers');

//Route::get('/users/{id?}', [UserController::class, 'showuser'])->name('users.showuser');