@extends('layouts.test')
@section('content')
<div id="AdminReactivos" class="container-fluid">
<table class="table-fluid table-striped  table-bordered"  id="" v-pre>
 	<thead>
 		<tr>
 			<th> id</th>
 			<th>Reactivo</th>
 			<th>Grado</th>
 			<th>Retroalimentación</th>
 			<th>Editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
<tbody>
	@foreach($Retroalimentaciones as $Retro)
		<tr>
			<td>
				{{$Retro->id}}
			</td>
			<td>
				{{$Retro->reactivos_reactivo->Nombre}}
			</td>
			<td>
				{{$Retro->tg_grados_academico->Nombre}}
			</td>
			<td>
				<textarea disabled>
					{!!json_decode($Retro->Retroalimentacion)!!}
				</textarea>
			</td>
			<td>
				<a href="{{route('Reactivos/editarRetro',$Retro->id)}}" class="btn btn-primary"> editar</a>
			</td>
			<td>
				<form action="{{route('Reactivos/EliminarRetroalimentacion',$Retro->id)}}" method="post">@csrf<button type="submit" class="btn btn-danger">Eliminar</button></form>
			</td>
		</tr>
	@endforeach
</tbody>
</table>

  <div class="col-12 col-md-12">
	 <form class="form-horizontal" method="post" action="{{route('Reactivos/AgregaRetroalimentacion')}}">
	 <fieldset>
	 	<legend class="text-center header">Nuevo reactivo</legend>
        <div class="container">
        <div class="row">
        <div class="form-group col-6">
        	<label class="label" for="Reactivo">Reactivo</label>
            <div class="col-md-12">
             <select class="form-control" id="Reactivo" name="Reactivo">
						@foreach($Reactivos as $reactivo)
						<option  value="{{$reactivo->id}}">
							{{$reactivo->Nombre}}
						</option>
						@endforeach
                </select>
            </div>
        </div>
        <div class="form-group col-6">
        	<label class="label" for="Grado">Grado</label>
            <div class="col-md-12">
                 <select class="form-control" id="Grado" name="Grado">
            		@foreach($Grados as $Grado)
            		<option  value="{{$Grado->id}}">
            			{{$Grado->Nombre}}
            		</option>
            		@endforeach
            	</select>
            </div>
        </div>
        </div>
        </div>
         <div class="form-group">
        	<label class="label" for='Retroalimentacion'>Retroalimentacion</label>
            <div class="col-md-12">
            	@include('vue_code.addtextarea_vue',['name'=>"Retroalimentacion"])	
            </div>
        </div>
        <div class="form-group">
        	<label class="label">Datos </label>
            <div class="col-md-12">
                <textarea id="Data" name="Data" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control"></textarea>
            </div>
        </div>     
         @csrf
         <button class="btn btn-primary">Agregar</button>
	 </fieldset>
	 
	 </form>
</div>
</div>
@endsection