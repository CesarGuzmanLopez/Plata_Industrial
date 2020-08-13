@extends('layouts.test')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-6">
<table class="table-fluid table-striped  table-bordered" id="">
 	<thead>
 		<tr>
 			<th> id</th>
 			<th>Nombre</th>
 			<th>Enunciado</th>
 			<th>Tema</th>
 			<th>Nivel</th>
 			<th>Editar</th>
 			<th>Eliminar</th>
 		</tr>
 	</thead>
 	<tbody>
		@foreach($Reactivos  as $Reactivo)
			<tr>
				<div>$Reactivo->id</div>
				<div>$Reactivo->Nombre</div>
				<div>$Reactivo->Enunciado</div>
			</tr>
		@endforeach
 	</tbody>
</table>
		
		</div>
		<div class="col-6">
		
		
		</div>
	</div>


</div>	



@endsection