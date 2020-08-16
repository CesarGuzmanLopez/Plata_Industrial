@extends('layouts.test')
@section('content')
<div  id ="AdminReactivos" class="container-fluid">
	<div class="col-12 col-md-12">
	 <form class="form-horizontal" method="post" action="{{route('Reactivos/editarReactivopost',$Reactivo->id)}}">
        <fieldset>
   		 <legend class="text-center header">Editar reactivo</legend>
        <div class="form-group">
        	<label class="label">Nombre Reactivo</label>
            <div class="col-md-12">
                <input id="Nombre_Reactivo" value="{{$Reactivo->Nombre??''}}" name="Nombre_Reactivo" type="text" placeholder="Nombre Reactivo" class="form-control" required >
            </div>
        </div>
       	<div class="form-group">
        	<label class="label" for="Enunciado">Enunciado</label>
            <div class="col-md-12">
				@include('vue_code.addtextarea_vue',['name'=>"Enunciado", 'value'=>$Reactivo->Enunciado])	
            </div>
        </div>	
        <div class="row">
        <div class="form-group col-6 col-md-3">
            	<label class="label" for="Tema">Tema</label>
                <div class="col-md-12">
                      <select class="form-control" id="Tema" name="Tema"  >
    						<option> </option>
    						@foreach($Temas as $tema)
    							<option value="{{$tema->id}}" {{ ($tema->id == $Reactivo->ID_Tema)?'selected':'' }}  >{{$tema->Nombre}}</option>
    						@endforeach
                      </select>
                </div>
          </div>	
           <div class="form-group col-6 col-md-3">
            	<label class="label" for="Grado">Grado</label>
                <div class="col-md-12">
    			@foreach($Grados as $Grado)
    							@php
    								$selected ="";
    								$valor=0;
    							@endphp
    							@foreach(  $Reactivo->reactivos__popularidads as $Pop)
    								@if($Pop->ID_Grado ==$Grado->id)
        								@php
        								$valor =$Pop->Dificultad_Creador;
        								$selected ="checked";break;
        								@endphp
    								 @endif
    							@endforeach
    				<div class="border"><b><label class="form-group"><input type="checkbox" value="{{$Grado->id}}"  name="Grado[]"  {{$selected }}>{{$Grado->Nombre}}</label></b>
    				<label class="form-group">dificultad: <input type="range" value="{{$valor}}" name="Dificultad[{{$Grado->id}}]"></label>    				
    				</div>
				@endforeach
                </div>
          </div>	
            <div class="form-group col-6 col-md-3">
            	<label class="label" for="Grupo_Tipo">Tipo de pregunta</label>
                <div class="col-md-12">
                      <select class="form-control" id="Grupo_Tipo" name="Grupo_Tipo"   value="{{old('Grupo_Tipo')??''}}" >
    						@foreach($Grupo_Tipos as $Tipo)
    							<option value="{{$Tipo->id}}"   {{ ($Tipo->id == $Reactivo->ID_Grupo_Reactivos) ?'selected':'' }}>{{$Tipo->Nombre}}</option>
    						@endforeach
                      </select>
                </div>
          </div>	
          
           <div class="form-group col-6 col-md-5">
            	<label class="label" for="Opcion">Opciones</label>
                <div class="col-md-12">
    			@foreach($Opciones as $opcion)
    							@php
    								$selected ="";
    								$valor=0;
    							@endphp
    							@foreach(  $Reactivo->reactivos__reactivos_opciones as $Pop)
    								@if($Pop->ID_Opcion ==$opcion->id)
        								@php
        								$valor =$Pop->valor;
        								$selected ="checked";break;
        								@endphp
    								 @endif
    							@endforeach
    				<div class="border"><b><label class="form-group"><input type="checkbox" value="{{$opcion->id}}"  name="Opcion[]"  {{$selected }}><div   style=" width: 300px;  height: 100px;  overflow: visible;" class="overflow-auto border border-danger">{!!$opcion->Enunciado1!!}</div></label></b>
    				<label class="form-group">Valor de respuesta: <input type="range" value="{{$valor}}" name="ValorEnPregunta[{{$opcion->id}}]"></label>    				
    				</div>
				@endforeach
                </div>
          </div>	
          
          
          
        </div>
        <div class="form-group">
        	<label class="label">Datos </label>
            <div class="col-md-12">
                <textarea id="Data" name="Data" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control" v-pre>{!!json_decode($Reactivo->Datos)!!}</textarea>
            </div>
        </div>     
         @csrf
             <button type="submit" class="btn btn-primary">Añadir</button>
        </fieldset>	
	</form>
	      <span class="help-block text-danger" role="alert">
        <strong>{{ $errors->first('Nombre_Reactivo')?"Existe una reactivo con este nombre":"" }}</strong>
    	<strong>{{ $errors->first('Enunciado')?"El enunciado debe ser mayor a 3 letras":"" }}</strong>
    	</span>
  </div>
</div>
@endsection