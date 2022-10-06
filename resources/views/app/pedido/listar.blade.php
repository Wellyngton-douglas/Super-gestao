@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Pedidos - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.pedido.adicionar') }}">Novo</a></li>
				<li><a href="{{ route('app.cliente') }}">Voltar</a></li>
			</ul>
		</div>
		<div>
			<h1>{{ session()->get('msg') }}</h1>
		</div>
		<div class="informação-pagina">
			<div style="width:90%; margin-left:auto; margin-right:auto;">
				<table class="table table-bordered data-table">
					<thead>
						<tr>
							<th>Pedido</th>
							<th>Cliente</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($pedidos as $pedido)						
							<tr>
								<td>{{ $pedido -> id}}</td>
								<td>{{ $pedido -> nome_cliente}}</td>
								<td><a href="{{ route('app.pedido_detalhe.adicionar', $pedido -> id) }}">Adicionar Produto</a></td>
								<td><a href="{{ route('app.pedido_detalhe.listar', $pedido -> id) }}">Detalhes</a></td>
								<td><a href="{{ route('app.pedido.excluir', $pedido -> id) }}">Excluir</a></td>
								<td><a href="{{ route('app.pedido.editar', $pedido -> id) }}">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{ $pedidos -> links() }}
				</div>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection