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
    <form>
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
        			<tr>
        				<td>{{$Tema->id}}</td>
            			<td>{{$Tema->Nombre}}</td>
            			<td></td>
        			</tr>
        		@endforeach
        </tbody>        
        </table>
    </form>
    </div>
</div>





@endsection