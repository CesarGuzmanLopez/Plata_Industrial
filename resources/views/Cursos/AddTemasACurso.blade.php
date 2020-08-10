@extends('layouts.test')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" method="post" action="{{Route('CrearCurso/AddTemasACursoPOST', $Curso->id)}}">
                    @csrf
                    <fieldset>
                        <legend class="text-center header">Añadir Temas al Curso <b>"{{$Curso->Nombre}}"</b></legend>
                        <div class="form-group">
                        	<div class="label"></div>
                                <div class="col-md-8">
    								<div id="TemasLista">
    									 <div v-for="(item, index) in Temas">
    										<div class="form-check">
                                              <input class="form-check-input" :id ="'Temas_'+item.id"  type="checkbox"  value="1"   :name=" 'Temas['+item.id+']'">
                                              <label class="form-check-label" :for="'Temas_'+item.id">
                               					@{{item.Nombre}}
                                              </label>
                                            </div>
                                            </div>
                                            <div>
                                            	<input class="form-input" type="text" v-model="NuevoNombre"><button type="button" v-on:click="AddTema()"  class="btn btn-success p-2" >+</button>
                                            </div>
    								</div>
								</div>
                        </div>
                        <span class="help-block text-danger" role="alert">
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