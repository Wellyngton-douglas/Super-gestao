<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteContato;
use App\Models\MotivoContato;

class ContatoController extends Controller
{
	public function contato(Request $request) {
		$motivo_contatos = MotivoContato::all();

		return view('site.contato', ['titulo' => 'Contato', 'motivo_contatos' => $motivo_contatos]);
	}

	public function salvar(Request $request) {
		
		$regras = [
			'nome' => 'required|min:3|max:255|unique:site_contatos',
		  'telefone' => 'required',
		  'email' => 'email',
		  'motivo_contatos_id' => 'required',
		  'mensagem' => 'required|max:2000'
		];

		$feedback = [
			'required' => 'O campo precisa :attribute ser preenchido',
			'nome.min' => 'O campo nome deve conter no mínimo 3 caracteres',
			'nome.max' => 'O campo nome deve conter no máximo 40 caracteres',
			'nome.unique' => 'O nome informado já está em uso',
			'email' => 'O email informado não é valido',
			'mensagem.max' => 'O campo nome deve conter no máximo 2000 caracteres',
		];
		
		//validação dos dados que vem na requisição
		$request -> validate($regras, $feedback);

		SiteContato::create($request -> all());
		return redirect() -> route('site.index');
	}
}
