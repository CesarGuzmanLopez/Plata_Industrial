<!Doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<html lang="es">
    <head>
      <title>{{$title?? config('app.name') }}</title><!-- Meta Etiquetas  --> 
      <meta name="author" content="Cesar Gerardo ,CesarGuzman@ieee.org">
       <meta name="copyright" content="Cesar Gerardo Guzman Lopez"><link rel="icon"  href="{{asset($icon ?? '') }}">        <meta name="robots" content="index, follow" />
      <meta name="language" content="es"><meta name="generator" content="laravel"><meta http-equiv="X-UA-Compatible" content="IE=edge"><base target ="_self">
	  <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1"><meta name="Classification" content="Quimica "><meta name="msapplication-TileColor" content=" #009900" />
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}?ver={{env('APP_Version')}}">
		@yield('styles') 
	</head> 
    <body>
  	<div class="nav sidebar">
		<a href="{{route('/')}}">Principal</a>
   	</div> 
      	 @yield('content')	 
    <script src="{{asset('/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/app.js') }}?ver={{env('APP_Version')}}"></script>
@yield('scripts')
   </body>
</html>
