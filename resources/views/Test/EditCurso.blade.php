<?php 
/**
 * @author: Cesar
 * @todo Edito los cursos hago una consulta
 */

?>
@extends('layouts.test')
@section('content')
<div class="container-fluid">
<form method="post" action="{{route('Temas/EditCursosP', $Curso->id)}}">
    <div>
    <div>
    @csrf
    	 curso <input name='NombreCurso' type="text"  class="form-control" value="{{$Curso->Nombre}}">
    </div>
    <div>
    		Descripción <textarea rows="10" cols="20" name="Curso_Desc"  class="form-control">{{json_decode($Curso->Descripcion)}}</textarea>
    </div>
    </div>
    <button type="submit">Cambiar</button>
       <span class="help-block text-danger" role="alert">
        <strong>{{ $errors->first('NombreCurso')?"Existe este Curso o esta en blanco":"" }}</strong>
    	</span>
</form>
</div>
<div>
<h5>Temas en curso</h5>
    <div>
<form method="post" action="{{route('Temas/AddTemaCurso', $Curso->id)}}">
          @csrf
        <table class="table-fluid table-striped  table-bordered" id="">
        <thead>
        	<tr>
        		<th>id</th>
        		<th>Tema</th>
        		<th>Activo</th>
        	</tr>
        </thead>
        <tbody>
        		@foreach($Temas as $Tema)
        			<?php $otroTema = $Curso->tg__curso_temas_difusos()->where("ID_Tema","=",$Tema->id )->first() ?>
        			<tr>
        				<td>{{$Tema->id}}</td>
            			<td>{{$Tema->Nombre}}</td>
            			<td>
                           si  <input type="radio"  name="Temas[{{$Tema->id}}]" value="1"  {{$otroTema?'checked':''}}>
                           no<input type="radio"  name="Temas[{{$Tema->id}}]" value="0"  {{!$otroTema?'checked':''}}>	
            			</td>
        			</tr>
        		@endforeach
        </tbody>        
        </table>
        <button type="submit">Agregar Curso</button>
    </form>
    </div>
</div>
@endsection