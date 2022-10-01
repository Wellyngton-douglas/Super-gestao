@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-destaque">
		<div class="esquerda">
			<div class="informacoes">
				<h1>Produtos</h1>
				<p>Cadastrar e listar os produtos que foram sincronizados</p>
				<button onclick="window.location.href='{{route('app.produto.adicionar')}}'">Cadastrar</button>
				<button onclick="window.location.href='{{route('app.produto.listar')}}'">Listar</button>
			</div>
		</div>

		<div class="direita">
			<div class="contato">
				<h1>Unidades de medida</h1>
				<p>Cadastrar e listar as unidades de medidas que vão ser utilizadas para seus produtos</p>
				<button onclick="window.location.href='{{route('app.unidade.adicionar')}}'">Cadastrar</button>
				<button onclick="window.location.href='{{route('app.unidade.listar')}}'">Listar</button>
			</div>
		</div>
	</div>

	@include('app.layouts._partials.rodape')
@endsection