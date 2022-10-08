<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Super Gestão - @yield('titulo')</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="{{ asset('css/style_app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" >
  </head>

	<body>
    @include('app.layouts._partials.menu')
		@yield('conteudo')
	</body>
</html>