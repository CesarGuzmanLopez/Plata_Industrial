@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<h2><a href="{{route('Temas/')}}">Administracion Cursos Temas Grados</a></h2>

<h2><a href="{{route('CrearCurso/')}}">Crear un curso</a></h2>



<h2><a href="{{route('Reactivos/')}}">Reactivos</a></h2>

@endsection
