<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    protected $connection = 'sysweb';

    protected $table = 'dispositivo';

    protected $fillable = [
        'device_id',
        'model',
        'app_bloqueado',
    ];

    public $timestamps = false;
}
