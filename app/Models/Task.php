<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id_task';
    protected $fillable = [
        'name',
        'description',
        'favorite',
        'image',
        'initial_date',
        'finish_date',
        'id_user',
        'id_priority',
        'id_state',
        'id_category'
    ];

    public function user()
{
    return $this->belongsTo(User::class, 'id_user');
}
        
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'id_priority');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'id_state');
    }

    public function getUserNameAttribute()
    {
        return $this->user->name ?? 'N/A';
    }

    public function getNickUserAttribute()
    {
        return $this->user->username ?? 'N/A';
    }


    public function getCategoryNameAttribute()
    {
        return $this->category->name ?? 'N/A';
    }

    public function getPriorityNameAttribute()
    {
        return $this->priority->name ?? 'N/A';
    }

    public function getStateNameAttribute()
    {
        return $this->state->name ?? 'N/A';
    }
    

}
