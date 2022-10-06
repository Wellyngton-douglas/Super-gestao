@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Detalhes do Pedidos - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.pedido.listar') }}">Voltar</a></li>
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
							<th>Produto</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($detalhes as $detalhe)						
							<tr>
								<td>{{ $detalhe -> pedido_id}}</td>
								<td>{{ $detalhe -> produto_id}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<div class="pagination justify-content-center">
					{{ $detalhes -> links() }}
				</div>
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection