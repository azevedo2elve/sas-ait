<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaVeiculo extends Model
{
    protected $connection = 'sysweb';

    protected $table = 'veiculo_marca';

    protected $fillable = [
        'id_instancia_sistema',
        'descricao',
        'data_insercao',
        'data_atualizacao',
        'data_exclusao'
    ];

    public $timestamps = false;
}
