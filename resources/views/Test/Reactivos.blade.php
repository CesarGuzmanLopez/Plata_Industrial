@extends('layouts.test')
@section('content')
<hr>
<br>

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
@endsection