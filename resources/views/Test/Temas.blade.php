@extends('layouts.test')
@section('content')
<div class="container-fluid">
<div class="row">
<div class="col-12 col-md-5">
<table class="table-fluid table-striped table-hover  table-bordered" id="">
 	<thead class="thead-dark">
 		<tr>
 			<th> id</th>
 			<th>Tema</th>
 			<th>Descripcion</th>
 			<th>Premium</th>
 			<th>editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
 	<tbody>
 		@foreach($Temas as $Tema)
 		<tr>
 			<td>{{$Tema->id}}</td>
 			<td>{{$Tema->Nombre}}</td>
 			<td>{{json_decode($Tema->Descripcion)}}</td>
 			<td>{{$Tema->Premium?"true": "false"}}</td>
 			<td><a href="{{route('Temas/EditTemas',$Tema->id)}}">Editar</a></td>
 			<td><form action="{{route('Temas/ElminarTema',$Tema->id)}}" method="post">  @csrf <button type="submit">Eliminiar</button></form></td>
 		</tr>
 		 @endforeach
 	</tbody>
</table>
<form method="post"  action="{{route('Temas/addTemas')}}" method="post" class="m-4">
    <h4>Añadir un tema</h4>
    <div>
    <div>
    @csrf
    	 Tema <input name='NombreTema' type="text"  class="form-control">
    </div>
    <div>
    		Descripción <textarea rows="10" cols="20" name="Temas_Desc"  class="form-control"></textarea>
    </div>
    <div>
    Premium {{Form::checkbox('Premium', '1', true,['class'=>'form-control'])}}
    </div>
    </div>
    <button type="submit">Enviar</button>
</form>
    <span class="help-block text-danger" role="alert">
        <strong>{{ $errors->first('NombreTema')?"Existe este Tema o esta en blanco":"" }}</strong>
    </span>
</div>
<div class="col-12 col-md-7">
<table class="table-fluid table-striped  table-bordered" id="">
 	<thead>
 		<tr>
 			<th> id</th>
 			<th>Curso(Materia)</th>
 			<th>Descripcion</th>
 			<th>Editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
 	<tbody>
 		@foreach($Cursos as $Curso)
 		<tr>
 			<td>{{$Curso->id}}</td>
 			<td>{{$Curso->Nombre}}</td>
 			<td>{{json_decode($Curso->Descripcion)}}</td>
 			<td><a href="{{route('Temas/EditCursos',$Curso->id)}}">Editar</a></td>
 			<td><form action="{{route('Temas/ElminarCurso',$Curso->id)}}" method="post">  @csrf <button type="submit">Eliminiar</button></form></td>
 			
 		</tr>
 		 @endforeach
 	</tbody>
</table>
<form method="post"  action="{{route('Temas/addCurso')}}" method="post" class="m-4">
    <h4>Añadir un Curso</h4>
    <div>
    @csrf
    	 Curso <input name='NombreCurso'  class="form-control" type="text">
    </div>
    <div>
    		Descripción  <textarea rows="2" cols="20" name="Curso_Desc"  class="form-control">	</textarea>
    </div>
    <button type="submit">Enviar</button>
</form>
<span class="help-block text-danger" role="alert">
    <strong>{{ $errors->first('NombreCurso')?"Existe este Curso o esta en blanco":"" }}</strong>
</span>
<hr>

<div class="border border-gray">
<h3>Grado</h3>
<table class="table-fluid table-striped  table-bordered" id="">
 	<thead>
 		<tr>
 			<th> id</th>
 			<th>Grado/Escolaridad/Nivel</th>
 			<th>editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
 	<tbody>
 		@foreach($Grados as $Grado)
 		<tr>
 			<td>{{$Grado->id}}</td>
 			<td>{{$Grado->Nombre}}</td>
 			<td><a href="{{route('Temas/EditGrados',$Grado->id)}}">Editar</a></td>
 			<td><form action="{{route('Temas/ElminarGrado',$Grado->id)}}" method="post">  @csrf <button type="submit">Eliminiar</button></form></td>
 		</tr>
 		 @endforeach
 	</tbody>
</table>
<form method="post"  action="{{route('Temas/addGrado')}}" method="post" class="m-4">
    <b>Añadir un Grado/Escolaridad/Nivel/Especial</b>
    <div>
    @csrf
    	 Curso <input name='NombreGrado'  class="form-control" type="text">
    </div>
    <button type="submit">Enviar</button>
</form>
<span class="help-block text-danger" role="alert">
    <strong>{{ $errors->first('NombreGrado')?"Existe este Grado Academico o esta vacio":"" }}</strong>
</span>
</div>
</div>
</div>
</div>
@endsection
