@extends('layouts.test')
@section('content')
<div id="AdminReactivos" class="container-fluid">
	<div class="row">
		<div class="col-12">
<table class="table-fluid table-striped  table-bordered"  id="">
 	<thead>
 		<tr>
 			<th> id</th>
 			<th>Nombre</th>
 			<th>Enunciado</th>
 			<th>Tema</th>
 			<th>Nivel Grado</th>
 			<th>Tipo Reactivo</th>
 			<th>Editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
 	<tbody>
		@foreach($Reactivos  as $Reactivo)
			<tr>
				<td>{{$Reactivo->id}}</td>
				<!-- interes -->
				<td v-pre>{!!$Reactivo->Nombre!!}</td>
				<td><textarea readonly v-pre>  {!!$Reactivo->Enunciado!!} </textarea></td>
				<!--  -->
				<td>
    				 {{$Reactivo->tg_tema["Nombre" ] }}
				</td>
				<td>
				<ul class="">
					@foreach($Reactivo->reactivos__popularidads as $algo )
						<li class="">{{$algo->tg_grados_academico->Nombre}}</li>
                 	@endforeach
				</ul>
				</td>
				<td>
					<b>{{$Reactivo->reactivos_grupos_tipo["Nombre"]}}</b>
				</td>
				<td>
					<a  href="{{route('Reactivos/editarReactivo', $Reactivo->id)}}" class="btn btn-md btn-block btn-primary">Editar</a>
				</td>
				<td>
						<form method="post" action="{{route('Reactivos/EliminarReactivo',$Reactivo->id)}}"> @csrf<button class="btn btn-danger" >Eliminar </button></form>
				</td>
			</tr>
		@endforeach
 	</tbody>
</table>
</div>
  <div class="col-12 col-md-12">
	 <form class="form-horizontal" method="post" action="{{route('Reactivos/AddReactivo')}}">
        <fieldset>
   		 <legend class="text-center header">Nuevo reactivo</legend>
        <div class="form-group">
        	<label class="label">Nombre Reactivo</label>
            <div class="col-md-12">
                <input id="Nombre_Reactivo" value="{{old('Nombre_Reactivo')??''}}" name="Nombre_Reactivo" type="text" placeholder="Nombre Reactivo" class="form-control" required >
            </div>
        </div>
       	<div class="form-group">
        	<label class="label" for="Enunciado">Enunciado</label>
            <div class="col-md-12">
				@include('vue_code.addtextarea_vue',['name'=>"Enunciado"])	
            </div>
        </div>	
        <div class="row">
        <div class="form-group col-4">
            	<label class="label" for="Tema">Tema</label>
                <div class="col-md-12">
                      <select class="form-control" id="Tema" name="Tema"  >
    						<option> </option>
    						@foreach($Temas as $tema)
    							<option value="{{$tema->id}}">{{$tema->Nombre}}</option>
    						@endforeach
                      </select>
                </div>
          </div>	
           <div class="form-group col-4">
            	<label class="label" for="Grado">Grado</label>
                <div class="col-md-12">
    						@foreach($Grados as $Grado)
    							<div class="border"><label class="form-group"><input type="checkbox" value="{{$Grado->id}}"  name="Grado[]">{{$Grado->Nombre}}</label>
    							    				<label class="form-group">dificultad: <input type="range" value="0" name="Dificultad[$Grado->id}]"></label>
    							
    							</div>
    					
    						@endforeach
                </div>
          </div>	
            <div class="form-group col-4">
            	<label class="label" for="Grupo_Tipo">Tipo de pregunta</label>
                <div class="col-md-12">
                      <select class="form-control" id="Grupo_Tipo" name="Grupo_Tipo"   value="{{old('Grupo_Tipo')??''}}" >
    						@foreach($Grupo_Tipos as $Tipo)
    							<option value="{{$Tipo->id}}">{{$Tipo->Nombre}}</option>
    						@endforeach
                      </select>
                </div>
          </div>	
        </div>
        <div class="form-group">
        	<label class="label">Datos </label>
            <div class="col-md-12">
                <textarea id="Data" name="Data" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control"></textarea>
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
</div>

<div></div>
@endsection