@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Produto</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.produto_detalhe.adicionar', ['id_produto' => $produtos[0] -> produto_id]) }}">Novo</a></li>
				<li><a href="{{ route('app.produto.listar') }}">Voltar</a></li>
			</ul>
		</div>
		<div>
			<h1>{{ session()->get('msg') }}</h1>
		</div>
		<div class="informação-pagina">
			<div class="contato-principal">
				<table class="table table-bordered data-table">
					<thead>
						<tr>
							<th>Produto</th>
							<th>Comprimento</th>
							<th>Largura</th>
							<th>Altura</th>
							<th>Peso</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($produtos as $produto)						
							<tr>
                <td>{{ $produto -> nome}}</td>
								<td>{{ $produto -> comprimento}}</td>
								<td>{{ $produto -> largura}}</td>
								<td>{{ $produto -> altura}}</td>
								<td>{{ $produto -> peso}}</td>
								{{-- <td><a href="{{ route('app.produto_detalhe', $produto -> id) }}">Detalhes</a></td>--}}
								<td><a href="{{ route('app.produto_detalhe.excluir', $produto -> id) }}">Excluir</a></td> 
								<td><a href="{{ route('app.produto_detalhe.editar', ['id' => $produto -> id, 'id_produto' => $produto -> produto_id] ) }}">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection