@extends('layouts.test')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" method="post" action="{{route('CrearCurso/addCurso')}}">
                    @csrf
                    <fieldset>
                        <legend class="text-center header">Nuevo Curso</legend>
                        <div class="form-group">
                        	<div class="label"></div>
                            <div class="col-md-12">
                                <input id="Nombre_Curso" name="NombreCurso" type="text" placeholder="Nombre del curso" class="form-control" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-md-12">
                            <div class="label">Descripcion</div>
                                <textarea id="Descripcion" name="Descripcion" type="text" placeholder="Descripcion" class="form-control"></textarea>
                            </div>
                        </div>
                         <div class="form-group">
                            <div class="col-md-12">
                            <div class="label">Grado</div>
								<select id="Grado" name="Grado" type="text" placeholder="Descripcion" class="form-control">
									<option value="-1"></option>
									@foreach($Grados as $Grado)
												<option value ="{{$Grado->id}}">{{$Grado->Nombre}}</option>
									@endforeach
                                </select>
                                </div>
                        </div>
                           <span class="help-block text-danger" role="alert">
                            <strong>{{ $errors->first('NombreCurso')?"Este curso(Nombre) ya existe":"" }}</strong>
                        </span>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">siguiente</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection