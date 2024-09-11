<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaVeiculo;

class MarcaVeiculoController extends Controller
{
    public function index(Request $request){
         // Verifica se há filtros passados na requisição
         $query = MarcaVeiculo::query();

        //  dd($request->has('marca'));
         // Aplicar filtro de marca, se houver
         if ($request->has('marca')) {
            $marca = $request->input('marca');
            // Usar upper() e comparar case-insensitive
            $query->whereRaw('upper(descricao) like upper(?)', ['%' . $marca . '%']);
         }

        // Aplicar filtro para garantir que data_exclusao seja null
        $query->whereNull('data_exclusao');

         // Obter resultados paginados ou todos, conforme necessidade
         $resultados = $query->paginate(15); // ou use ->get() para obter todos os resultados

        //  dd($resultados);
         // Passar os resultados para a view
         return view('marcaveiculo', compact('resultados'));
    }

    public function destroy($id)
    {
        // Encontra o veículo pelo ID e o deleta
        $veiculo = MarcaVeiculo::findOrFail($id);
        $veiculo->delete();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('marcaveiculo.index')->with('success', 'Veículo deletado com sucesso!');
    }
}
