@extends('layouts.test')
@section('content')
<hr>
<br>
<div id="Reactivos"> 
<!-- Crear Reactivos -->
<div>
<a href="{{route('Reactivos/AdminReactivos')}}">Administrar Reactivos</a>
</div>
<div>
	<a href="{{route('Reactivos/AdminRetroalmientacion')}}">Administrar Retroalimentaciones</a>
</div>
<div>
	<a href="{{route('Reactivos/AdminOpciones')}}">Administrar Opciones</a>
</div>
<div>
	<a href="{{route('Reactivos/Listas')}}">Listas de Organizacion</a>
</div>


<div>
	<b>
	<a href="{{route('Reactivos/CrearReactivo')}}">Crear Reactivos</a>
	</b>
</div>
</div>
@endsection