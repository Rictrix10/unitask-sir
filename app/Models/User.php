<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'password',
        'username',
        'email',
        'phone_number',
        'address',
        'user_type'
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class, 'id_user');
    }

    public function sharedTasks()
    {
        return $this->hasMany(SharedTask::class, 'id_user');
    }

}
