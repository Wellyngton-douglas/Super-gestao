@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-destaque">
		<div class="esquerda">
			<div class="informacoes">
				<h1>Clientes</h1>
				<button onclick="window.location.href='{{route('app.cliente')}}'">Clientes</button>
			</div>
			<div class="informacoes">
				<h1>Fornecedores</h1>
				<button onclick="window.location.href='{{route('app.fornecedor') }}'">Fornecedores</button>
			</div>
		</div>
		<div class="direita">
			<div class="contato">
				<h1>Produto</h1>
				<button onclick="window.location.href='{{route('app.produto')}}'">Produto</button>
			</div>
			<div class="contato">
				<h1>Sair</h1>
				<button onclick="window.location.href='{{route('app.sair')}}'">Sair</button>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection