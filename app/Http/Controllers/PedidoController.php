<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Cliente;

class PedidoController extends Controller
{
	public function listar() {
		$pedido = DB::table('pedidos')
			-> join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
			-> select('pedidos.*', 'clientes.nome as nome_cliente', 'clientes.id as cliente_id')
			-> paginate(1);
		return view('app.pedido.listar', ['titulo' => 'Listar', 'pedidos' => $pedido]);
	}

	public function adicionar(Request $request) {
		$msg = '';
		$cliente = Cliente::all();
		
		$pedido = DB::table('pedidos')
			-> paginate(1);

		if ($request -> input('_token') != '' && $request -> input('id') == '') {
			$regras = [
				'cliente_id' => 'required'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido'
			];

			$request -> validate($regras, $feedback);
			Pedido::create($request -> all());
			return redirect() -> route('app.pedido.listar');
		} elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
				$pedido = Pedido::find($request -> input('id'));
				$update = $pedido -> update($request -> all());
				if ($update) {
					$msg = 'Atualização realizado com sucesso';
				} else {
						$msg = 'Atualização apresentou problema';
				}

				return redirect() -> route('app.pedido.editar', ['id' => $request -> input('id'), 'msg' => $msg]);

		}
		return view('app.pedido.adicionar', ['titulo' => 'Pedido', 'msg' => $msg, 'clientes' => $cliente]);
	}

	public function editar($id, $msg = '') {
		$pedido = Pedido::find($id);
		$cliente = Cliente::all();
		return view('app.pedido.adicionar', ['titulo' => 'Editar', 'pedido' => $pedido, 'clientes' => $cliente, 'msg' => $msg]);
	}

	public function excluir($id) {
		$pedido = Pedido::find($id) -> delete();
		$pedido = DB::table('pedidos')
			-> join('clientes', 'clientes.id', '=', 'pedidos.cliente_id')
			-> select('pedidos.*', 'clientes.nome as nome_cliente', 'clientes.id as cliente_id')
			-> paginate(1);
		session()->flash('msg', 'registro excluido com sucesso');
		return view('app.pedido.listar', ['titulo' => 'Listar', 'pedidos' => $pedido]);
	}
}
