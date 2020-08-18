@extends('layouts.test')
@section('content')
<h2 class="text-center">Agregar Reactivo de opciones multiple</h2>
<div id="CrearReactivos"  class="container">
    <form  >
    <div class="row">
   <div class="form-group col-12 col-md-4">
    Grupo
    <select class="custom-select mr-sm-2" id="" name="ID_Curso"  @change="ChangeCurso($event)">
            <option value="-1" selected>...</option>
    		@foreach($Cursos as $Curso )
    			<option value="{{$Curso->id}}"> {{$Curso->Nombre}}</option>
    		@endforeach
    </select>
</div>
   <div class="form-group col-12 col-md-4">
    Grado
    <select class="custom-select mr-sm-2" id="" name="ID_Grado"  v-model="ID_Grado"  required>
            <option selected>...</option>
    		@foreach($Grados as $Grado )
    			<option value="{{$Grado->id}}"> {{$Grado->Nombre}}</option>
    		@endforeach
    </select>
</div>
   <div class="form-group col-12 col-md-4">
   <div>Tema</div>
    <select class="custom-select mr-sm-2" id="ID_Tema" name="ID_Tema"  v-model="ID_Tema" required>
            <option selected>...</option>
    		@foreach($Temas as $Tema )
    			<option value="{{$Tema->id}}"> {{$Tema->Nombre}}</option>
    		@endforeach
    </select>
</div>
</div>
   <div class="form-group">
    Reactivo
    @include('vue_code.addtextarea_vue',['name'=>"Reactivo"])	
   </div>
  	<div class="form-group ">
    opciones
        @foreach($Opciones as $opcion)
    <div class="row border">
      <div class="col-8 border ">
       <b> </b>  
    @include('vue_code.addtextarea_vue',['name'=>"OpcionLista[$opcion->id]"])
    </div>
   <div class="col-4 border p-2">
   		valor <input type="range"  name="valorLista[4]" value="0">
   </div>
    </div>
    
   @endforeach 
    <div class="row border">
      <div class="col-8">
       <b> opcion1</b>  
    @include('vue_code.addtextarea_vue',['name'=>"Opcion[1]"])
    </div>
   <div class="col-4 border p-2">
   		valor <input type="range"  name="valor[1]" value="0">
   </div>
    </div>
    <div class="row border" >
      <div class="col-8">
       <b> opcion2</b>  
    @include('vue_code.addtextarea_vue',['name'=>"Opcion[2]"])
    </div>
   <div class="col-4 border p-2">
   		   		valor <input type="range"  name="valor[2]" value="0">
   </div>
    </div>
    <div class="row border">
      <div class="col-8 ">
       <b> opcion1</b>  
    @include('vue_code.addtextarea_vue',['name'=>"Opcion[3]"])
    </div>
   <div class="col-4 border p-2">
   		valor <input type="range"  name="valor[3]" value="0">
   </div>
    </div>
    <div class="row border">
      <div class="col-8 border ">
       <b> opcion1</b>  
    @include('vue_code.addtextarea_vue',['name'=>"Opcion[4]"])
    </div>
   <div class="col-4 border p-2">
   		valor <input type="range"  name="valor[4]" value="0">
   </div>
    </div>	
    <!--  -->

   
    </div>   
    </form>
</div>
@endsection