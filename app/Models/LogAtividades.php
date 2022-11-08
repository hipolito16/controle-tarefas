<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class LogAtividades extends Model
{
    use HasFactory;

    protected $table = 'log_atividades';

    protected $fillable = [
        'user_id',
        'method',
        'request_uri',
        'remote_addr',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
