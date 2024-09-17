<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LiberarDispositivoController extends Controller
{
    public function index()
    {
        return view('liberardispositivo');
    }

    public function desbloquearDispositivo(Request $request, $device_id)
    {

        DB::connection('sysweb')->statement("
            INSERT INTO mobile_saida (imei, aplicacao, tipo, grupo, conteudo, gerado_push_gcm, status)
            VALUES (?, 31, 8, 1001, '{\"appBloqueado\":\"0\"}', 0, 0)
            ", [$device_id]);


        return redirect()->route('liberardispositivo.index')->with('Desbloqueado', 'Comando de desbloqueio enviado!');
    }

    public function procurarDispositivo(Request $request)
    {
        $imei = $request->input('imei');

        $dispositivos = DB::connection('sysweb')
        ->table('dispositivo')
        ->select(
            'device_id',
            'model',
            'app_bloqueado'
        )
        ->where('device_id', 'like', '%' . $imei . '%')
        ->get();

        return view('liberardispositivo', compact('dispositivos'));
    }
}
