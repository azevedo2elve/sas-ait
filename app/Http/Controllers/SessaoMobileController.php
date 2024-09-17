<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Efetivo;
use App\Models\SessaoMobile;
use Illuminate\Support\Facades\DB;

class SessaoMobileController extends Controller
{
    public function index(){
        return view('sessaomobile');
   }

    public function procurarEfetivo(Request $request)
    {
        // Obtém a matrícula do request
        $matricula = $request->input('matricula');

        // Realiza a consulta principal para buscar os efetivos
        $efetivos = DB::connection('sysweb')
        ->table('efetivo')
        ->select(
            'efetivo.id',
            'efetivo.nome',
            'efetivo.matricula',
            'efetivo.cpf',
            'instancia_sistema.descricao as descricao_instancia_sistema'
        )
        ->join('instancia_sistema', 'efetivo.id_instancia_sistema', '=', 'instancia_sistema.id')
        ->where('efetivo.matricula', 'like', '%' . $matricula . '%')
        ->whereNull('efetivo.data_exclusao')
        ->get();

        // Para cada efetivo, buscar sessões relacionadas
        foreach ($efetivos as $efetivo) {
            $efetivo->sessao = SessaoMobile::select('id')
                ->where('id_efetivo', $efetivo->id)
                ->whereNull('data_exclusao')
                ->get();
        }

        $pesquisarealizada = true;

        // Retorna a resposta em JSON
        return view('sessaomobile', compact('efetivos', 'pesquisarealizada'));
    }

    public function deslogarEfetivo($id)
    {
        // Busca o efetivo pelo ID e marca como deslogado
        $sessao = SessaoMobile::where('id_efetivo', $id)
            ->whereNull('data_exclusao')
            ->first();

        if ($sessao) {
            // Marca a data de exclusão (ou atualiza o status de logout)
            $sessao->data_exclusao = now();
            $sessao->save();

            return redirect()->back()->with('deslogado', 'Efetivo deslogado com sucesso!');
        }

        return redirect()->back()->with('offline', 'Efetivo está offline');
    }


}
