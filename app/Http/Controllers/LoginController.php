<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
  public function index(Request $request) {
		
		$erro = '';

		if($request -> get('erro') == 1) {
			$erro = 'Usúario e/ou senha não existe';
		}

		if($request -> get('erro') == 2) {
			$erro = 'Necessário fazer login para ter acesso a página';
		}
		
		return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
	}

	public function autenticar(Request $request) {
		$regras = [
			'usuario' => 'email|required',
		  'senha' => 'required',
		];

		$feedback = [
			'required' => 'O campo precisa :attribute ser preenchido',
			'email' => 'O usúario (email) informado não é valido',
		];
		
		//validação dos dados que vem na requisição
		$request -> validate($regras, $feedback);
		
		//validação para ver se o usuario existe cadastrado
		$email = $request -> get('usuario');
		$senha = $request -> get('senha');

		//iniciando o Model User
		$user = new User();

		$existe = $user -> where('email', $email)
										-> where('password', $senha)
										-> get()
										-> first();

		if (isset($existe -> name)) {
			session_start();
			$_SESSION['id'] = $existe -> id;
			$_SESSION['nome'] = $existe -> name;
			$_SESSION['email'] = $existe -> email;
			
			return redirect() -> route('app.home');
		} else {
			return redirect() -> route('site.login', ['erro' => 1]);
		}		
	}

	public function sair() {
		session_destroy();
		return redirect() -> route('site.index');
	}
}
