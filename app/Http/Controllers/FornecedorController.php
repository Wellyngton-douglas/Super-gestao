<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Models\Fornecedor;

class FornecedorController extends Controller
{
	public function index() {
		$estados = Estado::all();

		return view('app.fornecedor.index', ['titulo' => 'Fornecedor', 'estados' => $estados]);
	}

	public function listar(Request $request) {
		$estados = Estado::all();
		// if ($request -> input('nome') == '' &&
		// 	  $request -> input('site') == '' &&
		// 		$request -> input('estados_id') == '' &&
		// 		$request -> input('email') == '') {

		// 	return view('app.fornecedor.index', ['titulo' => 'Fornecedor',
		// 																			 'estados' => $estados,
		// 																			 'erro' => 'Algum dos campos precisam ser informados']);
		// } else {
				$fornecedores = Fornecedor::join('estados', 'estados.id', '=', 'fornecedores.estados_id')
					-> where('nome', 'like', '%'.$request -> input('nome').'%')
					-> where('site', 'like', '%'.$request -> input('site').'%')
					-> where('estados_id', 'like', '%'.$request -> input('estado_id').'%')
					-> where('email', 'like', '%'.$request -> input('email').'%')
					-> select('fornecedores.*', 'estados.uf')
					-> paginate(1);
				return view('app.fornecedor.listar', ['titulo' => 'Listar', 'fornecedores' => $fornecedores, 'request' => $request -> all()]);
		//}
	}
	
	public function adicionar(Request $request) {
		$estados = Estado::all();
		$msg = '';
		if ($request -> input('_token') != '' && $request -> input('id') == '') {		
			$regras = [
				'nome' => 'required|min:3|max:255|unique:fornecedores',
				'site' => 'required',
				'estados_id' => 'required',
				'email' => 'email|required'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido',
				'nome.min' => 'O campo nome deve conter no mínimo 3 caracteres',
				'nome.max' => 'O campo nome deve conter no máximo 255 caracteres',
				'nome.unique' => 'O nome informado já está em uso',
				'email' => 'O email informado não é valido'
			];
			
			//validação dos dados que vem na requisição
			$request -> validate($regras, $feedback);
			Fornecedor::create($request -> all());
			$msg = 'Fornecedor cadastrado corretamente';
		} elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
				$fornecedor = Fornecedor::find($request -> input('id'));
				$update = $fornecedor -> update($request -> all());
				if ($update) {
					$msg = 'Atualização realizado com sucesso';
				} else {
						$msg = 'Atualização apresentou problema';
				}

				return redirect() -> route('app.fornecedor.editar', ['id' => $request -> input('id'), 'msg' => $msg]);
				
		}
		
		return view('app.fornecedor.adicionar', ['titulo' => 'Adicionar', 'estados' => $estados, 'msg' => $msg]);
	}

	public function editar($id, $msg = '') {
		$fornecedor = Fornecedor::find($id);
		$estados = Estado::all();
		return view('app.fornecedor.adicionar', ['titulo' => 'Editar', 'estados' => $estados, 'fornecedor' => $fornecedor, 'msg' => $msg]);
	}

	public function excluir($id) {
		$delete = Fornecedor::find($id) -> delete();
		session()->flash('msg', 'excluida com sucesso');

		return redirect() -> route('app.fornecedor');

	}
}