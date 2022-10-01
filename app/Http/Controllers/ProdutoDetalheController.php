<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutoDetalheController extends Controller
{
	public function listar($id) {
		$produto = DB::table('produtos_detalhes')
			-> select('produtos_detalhes.*', 'produtos.nome')
			-> join('produtos','produtos_detalhes.produto_id', '=', 'produtos.id')
			-> where('produto_id', '=', $id)
			-> orderBy('produtos_detalhes.id')
			-> get();
		return view('app.produto_detalhe.listar', ['titulo' => 'Detalhe', 'produtos' => $produto]);
	}
}
