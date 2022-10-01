<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use Illuminate\Support\Facades\DB;

class UnidadeController extends Controller
{
	public function listar() {
		$unidade = DB::table('unidades')
		-> orderBy('id')
		-> paginate(1);
		return view('app.unidade.listar', ['titulo' => 'listar', 'unidades' => $unidade]);
	}

	public function adicionar(Request $request) {
		$msg = '';
		if ($request -> input('_token') != '' && $request -> input('id') == '') {		
			$regras = [
				'unidade' => 'required|min:2|max:5|unique:unidades',
				'descricao' => 'required|min:5|max:100'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido',
				'unidade.min' => 'O campo nome deve conter no mínimo 3 caracteres',
				'unidade.max' => 'O campo nome deve conter no máximo 5 caracteres',
				'descricao.min' => 'O campo nome deve conter no mínimo 5 caracteres',
				'descricao.max' => 'O campo nome deve conter no máximo 100 caracteres',
				'unidade.unique' => 'A unidade informado já está em uso'
			];
			
			//validação dos dados que vem na requisição
			$request -> validate($regras, $feedback);
			Unidade::create($request -> all());
			$msg = 'Unidade cadastrada corretamente';
		}elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
			$unidade = Unidade::find($request -> input('id'));
			$update = $unidade -> update($request -> all());
			if ($update) {
				$msg = 'Atualização realizado com sucesso';
			} else {
					$msg = 'Atualização apresentou problema';
			}

			return redirect() -> route('app.unidade.adicionar', ['id' => $request -> input('id'), 'msg' => $msg]);
		}
		return view('app.unidade.adicionar', ['titulo' => 'adicionar', 'msg' => $msg]);
	}

	public function editar($id, $msg = '') {
		$unidade = Unidade::find($id);
		return view('app.unidade.adicionar', ['titulo' => 'Editar', 'unidade' => $unidade,'msg' => $msg]);
	}

	public function excluir($id) {
		$delete = Unidade::find($id) -> delete();
		$unidade = DB::table('unidades')
			-> orderBy('id')
		  -> paginate(1);
		session()->flash('msg', 'registro excluido com sucesso');

		return redirect() -> route('app.unidade.listar', ['titulo' => 'listar', 'unidades' => $unidade]);
	}
}
