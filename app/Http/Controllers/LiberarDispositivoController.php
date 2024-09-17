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

    public function desbloquearDispositivo(Request $request)
    {
        
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
