@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Pedidos - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
				<li><a href="{{ route('app.pedido.listar') }}">Listar</a></li>
				<li><a href="{{ route('app.cliente') }}">Voltar</a></li>
			</ul>
		</div>
		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.pedido.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $pedido -> id ?? '' }}" type="hidden" class="borda-preta">
					<select name="cliente_id" class="borda-preta">
						<option value="">Cliente</option>
						@foreach ($clientes as $key => $cliente)
							<option value="{{ $cliente -> id }}" {{ ($pedido -> cliente_id ?? old('cliente_id')) == $cliente -> id ? 'selected' : '' }}>{{ $cliente -> nome}}</option>
						@endforeach
					</select>
					{{ $errors->has('cliente_id') ? $errors->first('cliente_id') : '' }}
					<button type="submit" class="borda-preta">ADICIONAR</button>
				</form>			
			</div>
		</div>
	</div>
	
	@include('app.layouts._partials.rodape')
@endsection