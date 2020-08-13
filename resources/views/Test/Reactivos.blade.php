@extends('layouts.test')
@section('content')
{{-- 
<div id="AdminReactivos" class="col-md-11 col-12">
	@include('vue_code.addtextarea_vue', ['id_table' => 'table'])
</div>
--}}
<!-- Crear preguntas -->
<a href="{{route('Reactivos/AdminReactivos')}}">Administrar Reactivos y Respuestas</a>

@endsection