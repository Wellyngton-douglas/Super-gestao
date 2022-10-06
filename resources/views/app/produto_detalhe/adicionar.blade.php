@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Produto - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
        <li><a href="{{ route('app.produto.listar') }}">Produtos Cadastrados</a></li>
				@if (isset($produto[0]))
					<li><a href="{{ route('app.produto_detalhe', ['id' => $id_produto]) }}">Voltar</a></li>
				@else
					<li><a href="{{ route('app.produto.listar') }}">Voltar</a></li>	
				@endif
				
			</ul>
		</div>

		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;"">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.produto_detalhe.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $produto -> id ?? '' }}" type="hidden" class="borda-preta">
					<input name="produto_id" value="{{ $id_produto ?? old('produto_id') }}" type="hidden" class="borda-preta">
          <br>
          <input name="comprimento" value="{{ $produto -> comprimento ?? old('comprimento') }}" type="text" placeholder="Comprimento" class="borda-preta" onkeyup="substituir(this);">
					{{ $errors->has('comprimento') ? $errors->first('comprimento') : '' }}
					<br>
          <input name="largura" value="{{ $produto -> largura ?? old('largura') }}" type="text" placeholder="Largura" class="borda-preta" onkeyup="substituir(this);">
					{{ $errors->has('largura') ? $errors->first('largura') : '' }}
					<br>
          <input name="altura" value="{{ $produto -> altura ?? old('altura') }}" type="text" placeholder="Altura" class="borda-preta" onkeyup="substituir(this);">
					{{ $errors->has('altura') ? $errors->first('altura') : '' }}
					<br>
          <input name="peso" value="{{ $produto -> peso ?? old('peso') }}" type="text" placeholder="Peso" class="borda-preta" onkeyup="substituir(this);">
					{{ $errors->has('peso') ? $errors->first('peso') : '' }}
					<br>
					<select name="unidade_id" class="borda-preta">
						<option value="">Unidade de Medida do Produto</option>
						@foreach ($unidades as $key => $unidade)
							<option value="{{ $unidade -> id }}" {{ ($produto -> unidade_id ?? old('unidade_id')) == $unidade -> id ? 'selected' : '' }}>{{ $unidade -> unidade}}</option>
						@endforeach
					</select>
					<br>
					<button type="submit" class="borda-preta">ADICIONAR</button>
				</form>			
			</div>
		</div>
	</div>
	<script>
		function substituir(el) {
    	el.value = el.value.replace(",", ".");
		}	
  </script>
	@include('app.layouts._partials.rodape')
@endsection