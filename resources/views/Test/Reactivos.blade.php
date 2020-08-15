@extends('layouts.test')
@section('content')
{{-- 
<div id="AdminReactivos" class="col-md-11 col-12">
	@include('vue_code.addtextarea_vue', ['id_table' => 'table'])
</div>
--}}
<!-- Crear Reactivos -->
<div>
<a href="{{route('Reactivos/AdminReactivos')}}">Administrar Reactivos</a>
</div>
<div>
	<a href="{{route('Reactivos/AdminRetroalmientacion')}}">Administrar Retroalimentaciones</a>
</div>

@endsection