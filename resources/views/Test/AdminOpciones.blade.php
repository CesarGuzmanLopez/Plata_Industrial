@extends('layouts.test')
@section('content')
<div id="AdminReactivos" class="container-fluid">
<table class="table-fluid table-striped  table-bordered"  id="" v-pre>
 	<thead>
 		<tr>
 			<th> id</th>
 			<th>Opcion 1</th>
 			<th>Opcion 2</th>
 			<th>Editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
<tbody>
		@foreach($Opciones as $opcion )
	<tr>
		<td>{{$opcion->id}}</td>
			
		<td><textarea rows="5" cols="30" readonly >{{$opcion->Enunciado1}}</textarea></td>
		<td><textarea rows="5" cols="30" readonly >{{$opcion->Enunciado2}}</textarea></td>
		<td><a href="{{route('Reactivos/EditarOpciones',$opcion->id)}}" class="btn btn-primary">Editar</a> </td>
		<td><form  method="post" action="{{route('Reactivos/EliminarOpciones',$opcion->id)}}"><button class="btn btn-danger">Eliminar</button>@csrf</form></td>
		</tr>
		@endforeach
</tbody>
</table>

  <div class="col-12 col-md-12">
	 <form class="form-horizontal" method="post" action="{{route('Reactivos/AddOpciones')}}">
	 <fieldset>
	 	<legend class="text-center header">Nueva respuesta</legend>
         <div class="form-group">
        	<label class="label" for='Opcion1'>Opcion 1</label>
            <div class="col-md-12">
            	@include('vue_code.addtextarea_vue',['name'=>"Opcion1"])	
            </div>
        </div>
        <div class="form-group" v-pre>
        	<label class="label">Datos 1</label>
            <div class="col-md-12">
                <textarea id="Datos1" name="Datos1" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control"></textarea>
            </div>
        </div>     
         @csrf
 <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link"  type ="button"data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			Relacion 
        </button>
      </h5>
    </div>
    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
         <div class="form-group">
        	<label class="label" for='Opcion1' >Opcion 2</label>
            <div class="col-md-12">
            	@include('vue_code.addtextarea_vue',['name'=>"Opcion2"])	
            </div>
        </div>
        <div class="form-group" v-pre>
        	<label class="label">Datos 2</label>
            <div class="col-md-12">
                <textarea id="Datos2" name="Datos2" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control"></textarea>
            </div>
        </div> 
    </div>
  </div>
  </div>
         <hr>
         <button class="btn btn-primary">Agregar</button>
	 </fieldset>
	 </form>
</div>
</div>


@endsection