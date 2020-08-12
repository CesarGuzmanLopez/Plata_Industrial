<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TgCurso;
use App\Models\TgGradosAcademico;
use App\Models\TgCursoTemasDifuso;
use App\Models\TgGradoCursosDifuso;
use App\Models\TgTema;

class Cursos extends Controller
{
    public function index(){
        $Grados = TgGradosAcademico::get();
        $var = [
            'Grados'=>$Grados
        ];
        return view("Cursos.CrearCurso")->with($var);
    }
    public function AddTemasACursoid($id){
        $var = [
            'Temas'=>TgTema::get(),
            'Curso'=> TgCurso::where('id',"=",$id)->first()
        ];
        return view("Cursos.AddTemasACurso")->with($var);
    }
    public function GetTemas(){
        return TgTema::get();
    }
    public function addCurso(Request $request){   
        $this->validate($request, [
            'NombreCurso'   => 'required|string|min:3|max:35|unique:tg__curso,Nombre',
        ]);
        $nuevoCursoPrincipal =new TgCurso();
        $nuevoCursoPrincipal->Nombre = $request->NombreCurso;
        $nuevoCursoPrincipal->ID_Usuario_Creador = $request->user()->id;
        $nuevoCursoPrincipal->Descripcion=json_encode($request->Descripcion);
        
        $nuevoCursoPrincipal->save();
        if($request->Grado !="-1"  &&  $nuevoCursoPrincipal )
        {
            $asignarGrado =  new TgGradoCursosDifuso();
            $asignarGrado->ID_Curso =$nuevoCursoPrincipal->id;
            $asignarGrado->ID_Grado = $request->Grado;
            $asignarGrado->valor=100;
            $asignarGrado->save();
        }
        $var = [
            'Temas'=>TgTema::get(),
            'Curso'=>$nuevoCursoPrincipal
        ];
        return view("Cursos.AddTemasACurso")->with($var);
    }
    public function  AddTemaS(Request $request){
        $this->validate($request, [
            'NombreTema'   => 'required|string|min:3|max:35|unique:tg__temas,Nombre',
        ]);
        $nuevoTemaPrincipal = new TgTema();
        $nuevoTemaPrincipal->Nombre = $request->NombreTema;
        $nuevoTemaPrincipal->Premium = true;
        $nuevoTemaPrincipal->Descripcion=NULL ;
        $nuevoTemaPrincipal->ID_Usuario_Creador = $request->user()->id;
        $nuevoTemaPrincipal->save();
        return $nuevoTemaPrincipal->id;
    }
    public function TemasToCurso(Request $request,$id){
        $TodosTemas = TgCursoTemasDifuso::where('ID_Curso','=',$id)->get();
        foreach ($TodosTemas as $temas){
            TgCursoTemasDifuso::where('ID_Curso','=',$id)->where('ID_Tema', "=",$temas->ID_Tema)->delete();
        }
        foreach ($request->Temas as  $clave => $valor){
            if($valor =="1"){
                $TemaDif = new TgCursoTemasDifuso();
                $TemaDif->ID_Curso = $id;
                $TemaDif->ID_Tema=$clave;
                $TemaDif->save();
            }
        }
        
        return redirect()->route("Reactivos/");
    }
    
}
