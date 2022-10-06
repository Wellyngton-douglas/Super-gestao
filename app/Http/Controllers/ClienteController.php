<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class ClienteController extends Controller
{
	public function index() {
		return view('app.cliente', ['titulo' => 'Cliente']);
	}
	
	public function listar() {
		$cliente = DB::table('clientes') -> paginate(1);
		return view('app.cliente.listar', ['titulo' => 'Listar', 'clientes' => $cliente]);
	}

	public function adicionar(Request $request) {
		$msg = '';
		if ($request -> input('_token') != '' && $request -> input('id') == '') {		
			$regras = [
				'nome' => 'required|min:3|max:100|unique:clientes'
			];

			$feedback = [
				'required' => 'O campo precisa :attribute ser preenchido',
				'nome.min' => 'O campo nome deve conter no mínimo 3 caracteres',
				'nome.max' => 'O campo nome deve conter no máximo 255 caracteres'
			];
			$request -> validate($regras, $feedback);
			Cliente::create($request -> all());
			$msg = 'Cliente cadastrado corretamente';
		} elseif ($request -> input('_token') != '' && $request -> input('id') != '') {
				$cliente = Cliente::find($request -> input('id'));
				$update = $cliente -> update($request -> all());
				if ($update) {
					$msg = 'Atualização realizado com sucesso';
				} else {
						$msg = 'Atualização apresentou problema';
				}

			return redirect() -> route('app.cliente.editar', ['id' => $request -> input('id'), 'msg' => $msg]);

		}
		return view('app.cliente.adicionar', ['titulo' => 'Cliente', 'msg' => $msg]);
	}

	public function editar($id, $msg = '') {
		$cliente = Cliente::find($id);
		return view('app.cliente.adicionar', ['titulo' => 'Editar', 'cliente' => $cliente, 'msg' => $msg]);
	}

	public function excluir($id) {
		$delete = Cliente::find($id) -> delete();
		$cliente = DB::table('clientes')
			-> orderBy('id')
			-> paginate(1);
		session()->flash('msg', 'registro excluido com sucesso');

		return redirect() -> route('app.cliente.listar', ['titulo' => 'Cliente', 'clientes' => $cliente]);
	}

}
