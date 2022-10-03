@extends('app.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	
  <div class="conteudo-pagina">
		<div class="titulo-pagina-2">
			<p>Produto - @yield('titulo')</p>
		</div>

		<div class="menu">
			<ul>
        <li><a href="{{ route('app.produto.listar') }}">Cadastrados</a></li>
				<li><a href="{{ route('app.produto') }}">Voltar</a></li>
			</ul>
		</div>
		<div class="informação-pagina">
			<div style="width:30%; margin-left:auto; margin-right:auto;"">
				{{ isset($msg) && $msg != '' ? $msg : ''}}
				<form action= {{ route('app.produto.adicionar') }} method="post">
					@csrf
					<input name="id" value="{{ $produto -> id ?? '' }}" type="hidden" class="borda-preta">
					<input name="nome" value="{{ $produto -> nome ?? old('nome') }}" type="text" placeholder="Nome do Produto" class="borda-preta">
					{{ $errors->has('nome') ? $errors->first('nome') : '' }}
					<br>
					<input name="descricao" value="{{ $produto -> descricao ?? old('descricao') }}" type="text" placeholder="Descrição" class="borda-preta">
					{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
					<br>
          <input name="preco_venda" value="{{ $produto -> preco_venda ?? old('preco_venda') }}" type="text" placeholder="Preço Venda" class="borda-preta" onkeyup="substituir(this);">
					{{ $errors->has('preco_venda') ? $errors->first('preco_venda') : '' }}
					<br>
          <input name="estoque_minimo" value="{{ $produto -> estoque_minimo ?? old('estoque_minimo') }}" type="text" placeholder="Estoque Mínimo" class="borda-preta">
					{{ $errors->has('estoque_minimo') ? $errors->first('estoque_minimo') : '' }}
					<br>
          <input name="estoque_maximo" value="{{ $produto -> estoque_maximo ?? old('estoque_maximo') }}" type="text" placeholder="Estoque Máximo" class="borda-preta">
					{{ $errors->has('estoque_maximo') ? $errors->first('estoque_maximo') : '' }}
					<br>
					<select name="fornecedor_id" class="borda-preta">
						<option value="">Selecione o Fornecedor do Produto</option>
						@foreach ($fornecedores as $key => $fornecedor)
							<option value="{{ $fornecedor -> id }}" {{ $produto -> fornecedor_id ?? old('fornecedor_id') == $fornecedor -> id ? 'selected' : '' }}>{{ $fornecedor -> nome}}</option>
						@endforeach
					</select>
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