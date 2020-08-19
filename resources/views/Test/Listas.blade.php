@extends('layouts.test')
@section('content')
<div id="AdminReactivos">
<div>

	 <form class="form-horizontal" method="post" action="{{route('Reactivos/AddListaReactivo')}}">
        <fieldset>
   		 <legend class="text-center header">Crear lista Reactivos </legend>
        <div class="form-group">
        	<label class="label" >Nombre Lista</label>
        	@csrf
        	<div class="row">
            <div class="col-5">
                <input id="NombreLista" value="{{old('NombreLista')??''}}" name="NombreLista" type="text" placeholder="Nombre Lista Reactivo" class="form-control" required >
            </div>
            <div class="5">
                    <button type="submit">Agragar Lista</button>
            
            </div>
            </div>
        </div>
        </fieldset>
        </form>
</div>

<tablamodelo></tablamodelo>
</div>
@endsection