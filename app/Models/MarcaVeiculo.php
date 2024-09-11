<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVeiculo extends Model
{
    protected $connection = 'sysweb';

    protected $table = 'veiculo_marca';
}
