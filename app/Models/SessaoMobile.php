<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessaoMobile extends Model
{
    protected $connection = 'sysweb';

    protected $table = 'auth_mobile_session';

    protected $fillable = [
        'id_efetivo',
        'data_exclusao'
    ];

    public $timestamps = false;
}
