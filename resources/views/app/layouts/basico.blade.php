<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Super Gestão - @yield('titulo')</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="{{ asset('css/style_app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
  </head>

	<body>
    @include('app.layouts._partials.menu')
		@yield('conteudo')
	</body>
</html>