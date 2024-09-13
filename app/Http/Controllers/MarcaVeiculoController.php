<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaVeiculo;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MarcaVeiculoController extends Controller
{
    public function index(Request $request){
         $query = MarcaVeiculo::query();

         dd($query);

         if ($request->has('marca')) {
            $marca = $request->input('marca');
            $query->whereRaw('upper(descricao) like upper(?)', ['%' . $marca . '%']);
         }

        $query->whereNull('data_exclusao');

         $resultados = $query->paginate(15);

         return view('marcaveiculo', compact('resultados'));
    }

    public function destroy($id)
    {
        // Encontra o veículo pelo ID e o deleta
        $veiculo = MarcaVeiculo::findOrFail($id);
        $veiculo->delete();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('marcaveiculo.index')->with('delete', 'Veículo deletado com sucesso!');
    }

    public function atualizarBase()
    {
        DB::connection('sysweb')->statement("
            INSERT INTO mobile_saida (imei, aplicacao, tipo, grupo, conteudo, gerado_push_gcm, status)
            SELECT device_id, 31, 11, 1001, '{\"ID_JOB\":\"11\"}', 0, 0
            FROM dispositivo
            WHERE id_instancia_sistema = 13
        ");
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'descricao' => 'required|string|max:255',
        ]);

        $descricao = $request->input('descricao');
        $existingMarca = MarcaVeiculo::where('descricao', $descricao)->first();

        if ($existingMarca) {
            return redirect()->route('marcaveiculo.index')
                             ->with('error', 'Já existe Marca/Modelo cadastrada');
        } else {
            // Criação de uma nova marca de veículo
            MarcaVeiculo::create([
                'id_instancia_sistema' => 13, // Valor fixo de 13
                'descricao' => $descricao,
                'data_insercao' => Carbon::now(),
                'data_atualizacao' => Carbon::now(),
                'data_exclusao' => null,
            ]);

            if ($request->input('atualizar_base') == "on") {
                $this->atualizarBase();
            }

            // Redirecionar com uma mensagem de sucesso
            return redirect()->route('marcaveiculo.index')
                             ->with('success', 'Cadastro realizado com sucesso!');
        }
    }
}
