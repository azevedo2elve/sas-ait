<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efetivo extends Model
{
    protected $connection = 'sysweb';

    protected $table = ['efetivo', 'instancia_sistemas'];

    protected $fillable = [
        'nome',
        'matricula',
        'cpf',
        'instancia_sistema'
    ];

    public $timestamps = false;
}
