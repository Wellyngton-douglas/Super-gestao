@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Produto</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.produto.adicionar') }}">Novo</a></li>
				<li><a href="{{ route('app.produto') }}">Consultar</a></li>
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
							<th>Nome Produto</th>
							<th>Descrição</th>
							<th>Fornecedor</th>
							<th>Preço venda</th>
							<th>Estoque mínimo</th>
							<th>Estoque máximo</th>
							{{-- <th>Unidade</th> --}}
						</tr>
					</thead>
					<tbody>
						@foreach ($produtos as $produto)						
							<tr>
								<td>{{ $produto -> nome}}</td>
								<td>{{ $produto -> descricao}}</td>
								<td>{{ $produto -> nome_fornecedor}}</td>
								<td>{{ $produto -> preco_venda}}</td>
								<td>{{ $produto -> estoque_minimo}} Uni.</td>
								<td>{{ $produto -> estoque_maximo}} Uni.</td>
								{{-- <td>{{ $produto -> unidade}}</td> --}}
								<td><a href="{{ route('app.produto_detalhe', $produto -> id) }}">Detalhes</a></td>
								<td><a href="{{ route('app.produto.excluir', $produto -> id) }}">Excluir</a></td>
								<td><a href="{{ route('app.produto.editar', $produto -> id) }}">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{-- {{ $produto -> appends($request) -> links() }} --}}
					{{ $produtos -> links() }}
				</div>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection