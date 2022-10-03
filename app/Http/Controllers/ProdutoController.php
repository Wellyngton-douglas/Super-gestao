<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
  public function index() {
		return view('app.produto', ['titulo' => 'Produtos']);
	}

	public function listar() {
		$produto = DB::table('produtos')
			-> orderBy('id')
			-> paginate(1);
		return view('app.produto.listar', ['titulo' => 'Produtos', 'produtos' => $produto]);
	}

	public function adicionar(Request $request) {
		$msg = '';
		if ($request -> input('_token') != '' && $request -> input('id') == '') {
			$regras = [
				'nome' => 'required|min:3|max:100|unique:produtos',
				'descricao' => 'required',
				'preco_venda' => 'required'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido',
				'nome.min' => 'O campo nome deve conter no mínimo 3 caracteres',
				'nome.max' => 'O campo nome deve conter no máximo 100 caracteres',
				'nome.unique' => 'O nome informado já está em uso'
			];

			$request -> validate($regras, $feedback);
			Produto::create($request -> all());
			$msg = 'Produto cadastrado corretamente';
		} elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
				$produto = Produto::find($request -> input('id'));
				$update = $produto -> update($request -> all());
				if ($update) {
					$msg = 'Atualização realizado com sucesso';
				} else {
						$msg = 'Atualização apresentou problema';
				}

				return redirect() -> route('app.produto.editar', ['id' => $request -> input('id'), 'msg' => $msg]);
				
		}
		return view('app.produto.adicionar', ['titulo' => 'adicionar', 'msg' => $msg]);
	}

	public function editar($id, $msg = '') {
		$produto = Produto::find($id);
		return view('app.produto.adicionar', ['titulo' => 'Editar', 'produto' => $produto, 'msg' => $msg]);
	}

	public function excluir($id) {
		$delete = Produto::find($id) -> delete();
		$produto = DB::table('produtos')
			-> orderBy('id')
			-> paginate(1);
		session()->flash('msg', 'registro excluido com sucesso');

		return redirect() -> route('app.produto.listar', ['titulo' => 'Produtos', 'produtos' => $produto]);
	}
}
