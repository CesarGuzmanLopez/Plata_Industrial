@extends('layouts.test')
@section('content')
<div id="AdminReactivos" class="container-fluid">
  <div class="col-12 col-md-12">
	 <form class="form-horizontal" method="post" action="{{route('Reactivos/editarRetroPost',$Retroalimentacion->id)}}">
	 <fieldset>
	 	<legend class="text-center header">Editar reactivo</legend>
        <div class="container">
        <div class="row">
        <div class="form-group col-6">
        	<label class="label" for="Reactivo">Reactivo</label>
            <div class="col-md-12">
             <select class="form-control" id="Reactivo" name="Reactivo">
						@foreach($Reactivos as $reactivo)
						<option  value="{{$reactivo->id}}" {{($Retroalimentacion->ID_Reactivo == $reactivo->id)?'selected':''}}>
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
            		<option  value="{{$Grado->id}}"  {{($Retroalimentacion->ID_Grado == $Grado->id)?'selected':''}}>
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
            	@include('vue_code.addtextarea_vue',['name'=>"Retroalimentacion", 'value'=>json_decode($Retroalimentacion->Retroalimentacion)])	
            </div>
        </div>
        <div class="form-group">
        	<label class="label">Datos </label>
            <div class="col-md-12">
                <textarea id="Data" name="Data" type="text" placeholder="Datos y metadatos necesarios para el reactivo (Avanzado)" class="form-control">
                {!!json_decode($Retroalimentacion->Datos)!!}
                </textarea>
            </div>
        </div>     
         @csrf
         <button class="btn btn-primary">Editar</button>
	 </fieldset>
	 
	 </form>
</div>
</div>
@endsection