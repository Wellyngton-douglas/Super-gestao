<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;

class PedidoDetalheController extends Controller
{
	public function listar($id) {
		$detalhe = DB::table('pedidos_produtos')
			-> where('pedido_id', '=', $id)
			-> paginate(1);
		// dd($detalhe);
		return view('app.pedido_detalhe.listar', ['titulo' => 'Listar', 'detalhes' => $detalhe]);
	}

	public function adicionar($id) {
		$msg = '';
		$produto = Produto::all();
		$detalhe = DB::table('pedidos_produtos')
			-> where('pedido_id', '=', $id)
			-> paginate(1);

		return view('app.pedido_detalhe.adicionar', ['titulo' => 'Listar', 'produtos' => $produto, 'detalhes' => $detalhe, 'pedido_id' => $id]);

	}
}
