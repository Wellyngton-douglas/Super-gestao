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
		}
		return view('app.cliente.adicionar', ['titulo' => 'Cliente', 'msg' => $msg]);
	}
}
