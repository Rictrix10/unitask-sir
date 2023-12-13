<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $table = 'priorities';
    protected $primaryKey = 'id_priority';
    protected $fillable = [
        'name'
    ];

    public function tasks()
{
    return $this->hasMany(Task::class, 'id_priority');
}

}
