<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarcaVeiculo;

class MarcaVeiculoController extends Controller
{
    public function index(Request $request){
         // Verifica se há filtros passados na requisição
         $query = MarcaVeiculo::query();

         // Aplicar filtro de marca, se houver
         if ($request->has('marca')) {
             $query->where('marca', 'like', '%' . $request->input('marca') . '%');
         }

         // Aplicar filtro de modelo, se houver
         if ($request->has('modelo')) {
             $query->where('modelo', 'like', '%' . $request->input('modelo') . '%');
         }

         // Obter resultados paginados ou todos, conforme necessidade
         $resultados = $query->paginate(10); // ou use ->get() para obter todos os resultados

         // Passar os resultados para a view
         return view('marcaveiculo', compact('resultados'));
    }
}
