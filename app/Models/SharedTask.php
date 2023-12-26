<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedTask extends Model
{
    use HasFactory;

    protected $table = 'shared_tasks';
    protected $primaryKey = 'id_share';
    protected $fillable = [
        'message',
        'id_user',
        'id_task',
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}
        
    public function task()
    {
        return $this->belongsTo(Task::class, 'id_task');
    }

    public function getUserNameAttribute()
    {
        return $this->user->name ?? 'N/A';
    }

    public function getUserEmailAttribute()
    {
        return $this->user->email ?? 'N/A';
    }

    public function getTaskNameAttribute()
    {
        return $this->task->name ?? 'N/A';
    }
    

}
