@extends('site.layouts.basico')

@section('titulo', $titulo)

@section('conteudo')	
	<div class="conteudo-pagina">
		<div class="titulo-pagina">
			<h1>Entre em contato conosco</h1>
		</div>

		<div class="informacao-pagina">
			<div class="contato-principal">
				@component('site.layouts._components.form_contato', ['classe' => 'borda-preta', 'motivo_contatos' => $motivo_contatos])
					<p>A nossa equipe analisará a sua mensagem e retornaremos o mais breve possível</p>
					<p>Nosso tempo medio de resposta é 48H</p>
				@endcomponent
			</div>
		</div>  
	</div>
	
	@include('site.layouts._partials.rodape')
@endsection