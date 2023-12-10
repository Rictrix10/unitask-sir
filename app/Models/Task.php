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
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }
}
