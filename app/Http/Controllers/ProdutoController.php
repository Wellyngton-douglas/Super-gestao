<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
  public function index() {
		return view('app.produto', ['titulo' => 'Produtos']);
	}

	public function listar() {
		$produto = DB::table('produtos')
			-> select('produtos.*',
								'unidades.unidade',
								'unidades.descricao as desc_unidade')
			-> join('unidades', 'produtos.unidade_id', '=', 'unidades.id')
			-> orderBy('produtos.id')
			-> paginate(1);
		return view('app.produto.listar', ['titulo' => 'Produtos', 'produtos' => $produto]);
	}

	public function adicionar(Request $request) {
		$unidade = Unidade::all();
		$msg = '';
		if ($request -> input('_token') != '' && $request -> input('id') == '') {
			$regras = [
				'nome' => 'required|min:3|max:100|unique:produtos',
				'descricao' => 'required',
				'preco_venda' => 'required',
				'unidade_id' => 'required'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido',
				'nome.min' => 'O campo nome deve conter no mínimo 3 caracteres',
				'nome.max' => 'O campo nome deve conter no máximo 100 caracteres',
				'nome.unique' => 'O nome informado já está em uso'
			];

			$request -> validate($regras, $feedback);
			$valor = $request -> input('preco_venda');
			Produto::create($request -> all());
			$msg = 'Produto cadastrado corretamente';
		}
		return view('app.produto.adicionar', ['titulo' => 'adicionar', 'unidades' => $unidade, 'msg' => $msg]);
	}
}
