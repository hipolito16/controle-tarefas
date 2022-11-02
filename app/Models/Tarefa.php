<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    protected $table = 'tarefas';
    protected $fillable = ['user_id', 'tarefa', 'data_limite_conclusao'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
