@extends('layouts.test')
@section('content')
<div class="container-fluid">
<form method="post" action="{{route('Temas/EditTemasP', $Tema->id)}}">
    <div>
    <div>
    @csrf
    	 Tema <input name='NombreTema' type="text"  class="form-control" value="{{$Tema->Nombre}}">
    </div>
    <div>
    		Descripción <textarea rows="10" cols="20" name="Temas_Desc"  class="form-control">{{json_decode($Tema->Descripcion)}}</textarea>
    </div>
    <div>
    	Premium {{Form::checkbox('Premium', '1', $Tema->Premium,['class'=>'form-control'])}}
    </div>
    </div>
    <button type="submit">Cambiar</button>
       <span class="help-block text-danger" role="alert">
        <strong>{{ $errors->first('NombreTema')?"Existe este Tema o esta en blanco":"" }}</strong>
    	</span>
</form>
</div>
<div class="container-fluid">

<form method="post" action="{{route('Temas/AddSubtema', $Tema->id)}}">
    <table class="Table-fluid table-striped table-hover  table-bordered">
    	<thead>
        <tr>
            <th>Sub-tema</th>
            <th>Porcentaje de Relacion</th>
    		<th>Activo</th>
    		</tr>
    	</thead>
    	<tbody>
    	@foreach($Temas as $Tematemp)
    	<tr>
    	<td>
    		{{$Tematemp->Nombre}}
    	</td>
    	<td> 
    	<?php $Subtem = $Tema->tg__subtemas_difusos->where("ID_Subtema", "=",$Tematemp->id)->first() ;?>
        <input type="range" list="tickmarks" name="Valores[{{$Tematemp->id}}]" value='{{$Subtem->valor??0}}'>
        <datalist id="tickmarks">
                <option value="0" label="0%">
                <option value="10">
                <option value="20">
                <option value="30">
                <option value="40">
                <option value="50" label="50%">
                <option value="60">
                <option value="70">
                <option value="80">
                <option value="90">
                <option value="100" label="100%">
        </datalist>
</td>
<td>
   si  <input type="radio"  name="Subtema[{{$Tematemp->id}}]" value="1"  {{$Subtem?'checked':''}}>
   no<input type="radio"  name="Subtema[{{$Tematemp->id}}]" value="0"  {{!$Subtem?'checked':''}}>
</td>
</tr>
@endforeach
</tbody>  
    </table>
      @csrf
    <button type="submit">Enviar</button><a class="button m-2 p-2 button-warning" href="{{route('Temas/')}}">Regresar</a>
</form>
</div>
@endsection