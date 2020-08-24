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
      <meta content="" name="descriptison">
      <meta content="" name="keywords">
      <meta charset="utf-8">
      
      <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}?ver={{env('APP_Version')}}">
		@yield('styles') 
	
	</head> 
    <body>
		@section('header')
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  	<b><a class="navbar-brand" href="{{route('/')}}">Plata</a></b>
	<a class="navbar-brand" href="{{route('/index')}}">Escritorio</a>
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  	</button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  	Cursos y preguntas 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('Temas/')}}">Administracion Cursos Temas Grados</a>
          <a class="dropdown-item" href="{{route('CrearCurso/')}}">Crear un curso</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('Reactivos/')}}">Reactivos</a></h2>
        </div>
      </li>
 <li>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    
                    </ul>
                    <!-- Right Side Of Navbar -->
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @else
    
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                        @endguest

                </div>
 </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
@show
<div class="wrapper">
  @yield('content')    	 
</div>

 <!-- ======= Footer ======= -->
  <footer id="footer" >

@yield('footer')

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Proyecto PLATA</span></strong>. All Rights Reserved
      </div>
      <div class="credits">

     </div>
    </div>
  </footer><!-- End Footer -->
      	 
     <div id="preloader"></div>
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('js/app.js') }}?ver={{env('APP_Version')}}"></script>
  
@yield('scripts')
   </body>
</html>
