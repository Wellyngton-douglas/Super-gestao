<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;
use App\Models\PedidoDetalhe;

class PedidoDetalheController extends Controller
{
	public function listar($id, $ind_criar = 'N') {
		$detalhe = DB::table('pedidos_produtos')
			-> where('pedidos_produtos.pedido_id', '=', $id)
			-> join('pedidos', 'pedidos_produtos.pedido_id', '=', 'pedidos.id')
			-> join('produtos', 'produtos.id', '=', 'pedidos_produtos.produto_id')
			-> select('pedidos_produtos.*', 'produtos.nome as nome_produto')
			-> paginate(1);
		$produto = Produto::all();
		if ($ind_criar == 'N') {
			return view('app.pedido_detalhe.listar', ['titulo' => 'Listar', 'detalhes' => $detalhe]);
		} elseif ($ind_criar == 'S') {
			return view('app.pedido_detalhe.adicionar', ['titulo' => 'Listar', 'produtos' => $produto, 'pedido_id' => $id]);
		}
	}

	public function adicionar(Request $request) {
		$msg = '';
		$produto = Produto::all();
		$detalhe = DB::table('pedidos_produtos')
			-> orwhere('pedido_id', '=', $request -> input('pedido_id'))
			// -> orwhere('pedido_id', '=', $pedido_id)
			-> paginate(1);
		
		if ($request -> input('_token') != '' && $request -> input('id') == '') {
			$regras = [
				'produto_id' => 'required'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido'
			];

			$request -> validate($regras, $feedback);
			PedidoDetalhe::create($request -> all());
			$msg = 'Produto cadastrado corretamente';
		} elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
			$detalhe = PedidoDetalhe::find($request -> input('id'));
			$update = $detalhe -> update($request -> all());
			if ($update) {
				$msg = 'Atualização realizado com sucesso';
			} else {
					$msg = 'Atualização apresentou problema';
			}
			
			return redirect() -> route('app.pedido_detalhe.editar', ['id' => $request -> input('id'), 'pedido_id' => $request -> input('pedido_id'), 'msg' => $msg]);
		}

		return view('app.pedido_detalhe.adicionar', ['titulo' => 'Listar', 'produtos' => $produto, 'detalhes' => $detalhe, 'msg' => $msg]);

	}

	public function editar($id, $pedido_id , $msg = ''){
		$detalhe = PedidoDetalhe::find($id);
		$produto = Produto::all();

		return view('app.pedido_detalhe.adicionar', ['titulo' => 'Editar', 'produtos' => $produto, 'detalhes' => $detalhe, 'pedido_id' => $pedido_id, 'msg' => $msg]);
	}

	public function excluir($id, $pedido_id) {
		$delete = PedidoDetalhe::find($id) -> delete();
		$detalhe = DB::table('pedidos_produtos')
		-> where('pedido_id', '=', $id)
		-> paginate(1);
		session()->flash('msg', 'registro excluido com sucesso');

		return redirect() -> route('app.pedido_detalhe.listar', ['titulo' => 'Pedidos', 'id' => $pedido_id, 'detalhes' => $detalhe]);
	}
}
