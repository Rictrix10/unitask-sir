<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\EditTaskController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllTasksController;
use App\Http\Controllers\AllUsersController;
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

Route::get('/register', function () {
    return view('register');
});

Route::get('', function () {
    return view('/index');
});

//Route::view('/calendar','/calendar');

Route::view('/index', '/index');

Route::view('/users', '/users');

/*
Route::get('/calendar', function(){
    return view('calendar');
});
*/

Route::get('/login', function(){
    return view('login');
});

/*
Route::get('/homepage', function () {
    return view('homepage');
})->name('homepage');
*/

Route::match(['get', 'post'], '/match', function(){
    return "Permite apenas acessos definidos";
});

Route::get('/user/{id}/{username?}', function($id, $username = ''){
    return "O id do user é:".$id."<br>"."O username é:".$username;
});

Route::redirect('/sobre', '/login');


    Route::get('/tasks', function(){
        return view('tasks');
    })->name('tasks');

    Route::get('/sharedtasks', function(){
        return view('sharedtasks');
    })->name('sharedtasks');

    Route::get('/profile', function(){
        return view('profile');
    })->name('profile');

    /*
    Route::get('/schedule', function(){
        return view('schedule');
    })->name('schedule');
    */
    

Route::get('tasks/createtask', function(){
    return view('createtask');
})->name('createtask');

Route::get('tasks/viewtask', function(){
    return view('viewtask');
})->name('viewtask');

Route::group(['middleware' => ['web']], function () {
    Route::post('/login', 'LoginController@login')->name('login');
});

Route::group(['middleware' => ['web']], function () {
    Route::post('/register', 'RegisterController@register')->name('register');
});


Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login');

Route::post('/register', 'App\Http\Controllers\RegisterController@register')->name('register');

Route::get('/users', [UserController::class, 'showallusers'])->name('users.showallusers');

Route::get('/profile', 'App\Http\Controllers\EditProfileController@putdatauser')->name('profile');

Route::post('/update-user-data', 'App\Http\Controllers\EditProfileController@updateUserData')->name('update.user.data');

Route::delete('profile/delete/{id_user}', [EditProfileController::class, 'deleteUser'])->name('delete.user');

Route::post('/tasks/createtask', [TaskController::class, 'createtask'])->name('create.task');

//Route::get('/calendar', [CalendarController::class, 'calendar'])->name('calendar');

Route::get('tasks/createtask', [TaskController::class, 'showCreateTaskForm'])->name('createtask');

Route::get('/tasks', [TaskController::class, 'getUserTasks'])->name('tasks');

Route::get('/sharedtasks', [TaskController::class, 'getSharedTasks'])->name('sharedtasks');

Route::get('/priorities', [PriorityController::class, 'listPriorities'])->name('priorities');

Route::get('tasks/viewtask/{id_task}', 'App\Http\Controllers\ManageTaskController@viewtask')->name('viewtask');

Route::post('/tasks/viewtask/{id_task}', [EditTaskController::class, 'updateTask'])->name('update.task');

Route::delete('tasks/delete/{id_task}', [TaskController::class, 'deleteTask'])->name('delete.task');

Route::post('/tasks/share/{id_task}', [TaskController::class, 'shareTask'])->name('share.task');


//Calendario
Route::get('tasks/shedule', [ScheduleController::class, 'index'])->name('shedule');
Route::get('/events',[ScheduleController::class, 'getEvents']);
Route::delete('/tasks/schedule/{id}',[ScheduleController::class, 'deleteEvent']);
Route::put('/tasks/schedule/{id}',[ScheduleController::class, 'update']);
Route::put('/tasks/schedule/{id}/resize',[ScheduleController::class, 'resize']);

//Admin (Tasks)

Route::get('/homeadmin', function(){
    return view('homeadmin');
})->name('homeadmin');

Route::get('/adminstatistics', [AdminController::class, 'showStatistics'])->name('adminstatistics');

Route::get('/alltasks', [AllTasksController::class, 'getAllTasks'])->name('alltasks');

Route::get('/allsharedtasks', [AllTasksController::class, 'getAllSharedTasks'])->name('allsharedtasks');


// Admin (Users)

Route::get('/allusers', [AllUsersController::class, 'getAllUsers'])->name('allusers');

Route::delete('allusers/delete/{id_user}', [AllUsersController::class, 'deleteUser'])->name('delete.user');

Route::get('/edituser/{id_user}', function(){
    return view('edituser/{id_user}');
})->name('edituser/{id_user}');

//Route::get('/profileuser', 'App\Http\Controllers\AllUsersController@putdatauser')->name('profileuser');

Route::get('/profileuser/{id_user}', [AllUsersController::class, 'profileUser'])->name('profileuser');

Route::post('/updateuser/{id_user}', [AllUsersController::class, 'updateUserData'])->name('updateuser.user.data');

//Route::post('/updateuser/{id_user}', 'AllUsersController@updateUserData')->name('updateuser.user.data');
