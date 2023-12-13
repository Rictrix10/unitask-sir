<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $primaryKey = 'id_state';
    protected $fillable = [
        'name'
    ];

    public function tasks()
{
    return $this->hasMany(Task::class, 'id_state');
}
}
