@extends('layouts.test')
@section('content')
<div id="AdminReactivos" class="container-fluid">
  <div class="col-12 col-md-12">
	 <form class="form-horizontal" method="post" action="{{route('Reactivos/EditarOpcionesPost',$Opcion->id)}}">
	 <fieldset>
	 	<legend class="text-center header">Nueva respuesta</legend>
         <div class="form-group">
        	<label class="label" for='Opcion1'>Opcion 1</label>
            <div class="col-md-12">
            	@include('vue_code.addtextarea_vue',['name'=>"Opcion1", 'value'=>$Opcion->Enunciado1])	
            </div>
        </div>
        <div class="form-group" v-pre>
        	<label class="label">Datos 1</label>
            <div class="col-md-12">
                <textarea id="Datos1" name="Datos1" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control">{!!json_decode($Opcion->Opcion1)!!}</textarea>
            </div>
        </div>     
         @csrf
         <hr>
        	<label class="label" for='Opcion1' >Opcion 2</label>
            <div class="col-md-12">
            	@include('vue_code.addtextarea_vue',['name'=>"Opcion2" ,'value'=>$Opcion->Enunciado2])	
            </div>

        <div class="form-group" v-pre>
        	<label class="label">Datos 2</label>
            <div class="col-md-12">
                <textarea id="Datos2" name="Datos2" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control">{!!json_decode($Opcion->Opcion1)!!}</textarea>
            </div>
        </div> 
         <hr>
         <button class="btn btn-primary" type="submit">editar</button>
	 </fieldset>
	 </form>
</div>
</div>


@endsection