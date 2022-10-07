@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Pedidos - @yield('titulo')</p>
		</div>
		<div class="menu">
			<ul>
				<li><a href="{{ route('app.pedido.listar') }}">Voltar</a></li>
			</ul>
		</div>
		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.pedido_detalhe.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $detalhes-> id ?? '' }}" type="hidden" class="borda-preta">
					<input name="pedido_id" value="{{ $pedido_id ?? old('pedido_id') }}" type="hidden" class="borda-preta">
					<select name="produto_id" class="borda-preta">
						<option value="">Produtos</option>
						@foreach ($produtos as $key => $produto)
							<option value="{{ $produto -> id }}" {{ ($detalhes -> produto_id ?? old('produto_id')) == $produto -> id ? 'selected' : '' }}>{{ $produto -> nome}}</option>
						@endforeach
					</select>
					<button type="submit" class="borda-preta">ADICIONAR</button>
				</form>			
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection