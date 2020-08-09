@extends('layouts.test')
@section('content')
<div class="container-fluid">
<form method="post" action="{{route('Temas/EditGradosP', $Grado->id)}}">
    <div>
    <div>
    @csrf
    	 Grado<input name='NombreGrado' type="text"  class="form-control" value="{{$Grado->Nombre}}">
    </div>
    </div>
    <button type="submit">Cambiar</button>
       <span class="help-block text-danger" role="alert">
        <strong>{{ $errors->first('NombreGrado')?"Existe este Grado o esta en blanco":"" }}</strong>
    	</span>
</form>
</div>
@endsection