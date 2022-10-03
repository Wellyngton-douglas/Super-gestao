<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProdutoDetalhe;

class ProdutoDetalheController extends Controller
{
	public function listar($id) {
		$busca = DB::table('produtos_detalhes')
			-> where('produto_id', '=', $id)
			-> exists();
		$produto = DB::table('produtos')
			-> where('id', '=', $id)
			-> get();
		$unidade = DB::table('unidades')
			-> orderBy('id')
			-> get();
		if ($busca) {
			$produto = DB::table('produtos_detalhes')
			-> select('produtos_detalhes.*', 'produtos.nome')
			-> join('produtos','produtos_detalhes.produto_id', '=', 'produtos.id')
			-> where('produto_id', '=', $id)
			-> orderBy('produtos_detalhes.id')
			-> get();
			return view('app.produto_detalhe.listar', ['titulo' => 'Detalhe', 'produtos' => $produto]);
		} else {
			return view('app.produto_detalhe.adicionar', ['titulo' => 'Detalhe', 'id_produto' => $id, 'unidades' => $unidade]);
		}		
	}

	public function adicionar($id_produto = '', Request $request) {
		$msg = '';
		$produto = DB::table('produtos')
			-> orwhere('id', '=', $request -> input('id_produto'))
			-> orwhere('id', '=', $id_produto)
			-> get();
		$unidade = DB::table('unidades')
			-> orderBy('id')
			-> get();
		if ($request -> input('_token') != '' && $request -> input('id') == '') {
			$regras = [
				'comprimento' => 'required',
				'unidade_id' => 'required',
				'peso' => 'required'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido'
			];

			$request -> validate($regras, $feedback);
			//dd($request -> all());
			ProdutoDetalhe::create($request -> all());
			$msg = 'Produto cadastrado corretamente';
		} elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
				$detalhe = ProdutoDetalhe::find($request -> input('id'));
				$update = $detalhe -> update($request -> all());
				if ($update) {
					$msg = 'Atualização realizado com sucesso';
				} else {
						$msg = 'Atualização apresentou problema';
				}
				
				return redirect() -> route('app.produto_detalhe.editar', ['id' => $request -> input('id'), 'id_produto' => $request -> input('produto_id'), 'msg' => $msg]);
				
		}
		
		return view('app.produto_detalhe.adicionar', ['titulo' => 'adicionar', 'msg' => $msg, 'id_produto' => $id_produto, 'unidades' => $unidade]);
	}

	public function editar($id, $id_produto, $msg = '') {
		$detalhe = ProdutoDetalhe::find($id);
		$unidade = DB::table('unidades')
			-> orderBy('id')
			-> get();
		return view('app.produto_detalhe.adicionar', ['titulo' => 'Editar', 'id' => $id, 'produto' => $detalhe, 'msg' => $msg, 'id_produto' => $id_produto, 'unidades' => $unidade]);
	}

	public function excluir($id) {
		$delete = ProdutoDetalhe::find($id) -> delete();
		$produto = DB::table('produtos')
			-> orderBy('id')
			-> paginate(1);
		session()->flash('msg', 'registro excluido com sucesso');

		return redirect() -> route('app.produto.listar', ['titulo' => 'Produtos', 'produtos' => $produto]);
	}
}
