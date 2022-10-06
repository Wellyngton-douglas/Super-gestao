@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-destaque">
		<div class="esquerda">
			<div class="informacoes">
				<h1>Clientes</h1>
				<p>Cadastrar e listar os clientes</p>
				<button onclick="window.location.href='{{route('app.cliente.adicionar')}}'">Cadastrar</button>
				<button onclick="window.location.href='{{route('app.cliente.listar')}}'">Listar</button>
			</div>
		</div>

		<div class="direita">
			<div class="contato">
				<h1>Pedidos</h1>
				<p>Cadastrar e listar os pedidos que foram feitos</p>
				<button onclick="window.location.href='{{route('app.pedido.adicionar')}}'">Cadastrar</button>
				<button onclick="window.location.href='{{route('app.pedido.listar')}}'">Listar</button>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection