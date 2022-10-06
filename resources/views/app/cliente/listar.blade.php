@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Cliente - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.cliente.adicionar') }}">Novo</a></li>
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
							<th>Nome</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($clientes as $cliente)						
							<tr>
								<td>{{ $cliente -> nome}}</td>
								<td><a href="{{ route('app.cliente.excluir', $cliente -> id) }}">Excluir</a></td>
								<td><a href="{{ route('app.cliente.editar', $cliente -> id) }}">Editar</a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{ $clientes -> links() }}
				</div>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection