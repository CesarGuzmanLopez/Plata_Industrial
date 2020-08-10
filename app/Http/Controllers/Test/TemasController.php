<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TgTema;
use App\Models\TgCurso;
use App\Models\TgGradosAcademico;
use App\Models\TgSubtemasDifuso;
use App\Models\TgCursoTemasDifuso;

class TemasController extends Controller
{
    public function index(){
        $variables = [
            'Temas'=>TgTema::get(),
            'Cursos'=>TgCurso::get(),
            'Grados'=>TgGradosAcademico::get(),
        ];
        return view("Test.Temas")->with($variables);
    }
    public function addTemas(Request $request){
        $this->validate($request, [
            'NombreTema'   => 'required|string|min:3|max:35|unique:tg__temas,Nombre',
        ]); 
        $nuevoTemaPrincipal = new TgTema();
        $nuevoTemaPrincipal->Nombre = $request->NombreTema;
        $nuevoTemaPrincipal->Premium = $request->has('Premium');
        $nuevoTemaPrincipal->Descripcion=json_encode($request->Temas_Desc) ;
        $nuevoTemaPrincipal->ID_Usuario_Creador = $request->user()->id;
        $nuevoTemaPrincipal->save();
        return back();
    }
    /**
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCurso(Request $request){
        $this->validate($request, [
            'NombreCurso'   => 'required|string|min:3|max:35|unique:tg__curso,Nombre',
        ]);
        $nuevoCursoPrincipal =new TgCurso();
        $nuevoCursoPrincipal->Nombre = $request->NombreCurso;
        $nuevoCursoPrincipal->ID_Usuario_Creador = $request->user()->id;
        $nuevoCursoPrincipal->Descripcion=json_encode($request->Curso_Desc);
        $nuevoCursoPrincipal->save();
        return back();
    }

    
    
    /***
    * @param int$ id
    * @var TgTema $algunTema
    * @return \Illuminate\Http\RedirectResponse
    */
       
    public function EditTemas(int $id){
        $Tema = TgTema::get()->where('id','=',$id)->first();
        if(!$Tema) return redirect()->route("Temas/");
        $TemasTEmp  = TgTema::get()->where("id","<>",$Tema->id);
        $Temas =  collect([]);
        foreach ($TemasTEmp as   $algunTema){
           
            if(!$algunTema->tg__subtemas_difusos->where('ID_Subtema','=',$id)->first())
                $Temas->push($algunTema);
        }
        $variables = [
            'Tema'=>$Tema,
            'Temas'=>$Temas,
            'Cursos'=>TgCurso::get(),
            'Grados'=>TgGradosAcademico::get(),
        ];
        return view("Test.EditTemas")->with($variables);
    }
    
    
    
    public function EditCursos(int $id){
        $Curso = TgCurso::get()->where('id','=',$id)->first();
        if(!$Curso) return redirect()->route("Temas/");
        $variables = [

            'Curso'=>$Curso,
            'Temas'=> TgTema::get()
        ];
    return view("Test.EditCurso")->with($variables);
    }
    
    
    public function EditCursosP(Request $request,  $id){
        $Curso = TgCurso::get()->where('id','=',$id)->first();
        if($Curso->Nombre != $request->NombreCurso)
            $this->validate($request, [ 'NombreCurso'   => 'required|string|min:3|max:35|unique:tg__curso,Nombre' ]);
        $Curso->Nombre = $request->NombreCurso;
        $Curso->Descripcion=json_encode($request->Curso_Desc) ;
        $Curso->ID_Usuario_Creador = $request->user()->id;
        $Curso->save();
        return redirect()->route('Temas/');
    }
    
    public function EditGrados(int $id){
        $Grado = TgGradosAcademico::get()->where('id','=',$id)->first();
        if(!$Grado) return redirect()->route("Temas/");
        $variables = [
            'Grado'=>$Grado,
        ];
        return view("Test.EditGrados")->with($variables);
    }
    public function EditGradosP(Request $request,  $id){
        $Grado = TgGradosAcademico::get()->where('id','=',$id)->first();
        if($Grado->Nombre != $request->NombreGrado)
            $this->validate($request, [ 'NombreGrado'   => 'required|string|min:3|max:35|unique:tg__grados_academicos,Nombre' ]);      
       $Grado->Nombre = $request->NombreGrado;
       $Grado->ID_Usuario_Creador = $request->user()->id;
       $Grado->save();
        return redirect()->route('Temas/');
    }
    public function EditTemasP(Request $request,  $id){
        $Tema = TgTema::get()->where('id','=',$id)->first();
        if($Tema->Nombre != $request->NombreTema) 
            $this->validate($request, [ 'NombreTema'   => 'required|string|min:3|max:35|unique:tg__temas,Nombre' ]);    
        $Tema->Nombre = $request->NombreTema;
        $Tema->Premium = $request->has('Premium');
        $Tema->Descripcion=json_encode($request->Temas_Desc) ;
        $Tema->ID_Usuario_Creador = $request->user()->id;
        $Tema->save();
        return redirect()->route('Temas/');
    }
    public function ElminarTema(Request $request,int  $id){
        TgTema::where('id','=',$id)->delete();;
        return back();
    }
    public function ElminarCurso(Request $request,int  $id){
        TgCurso::where('id','=',$id)->delete();;
        return back();
    }
    public function ElminarGrado(Request $request,int  $id){
        TgGradosAcademico::where('id','=',$id)->delete();;
        return back();
    }
    public function AddTemaCurso(Request $request,int  $id){
        $TodosTemas = TgCursoTemasDifuso::where('ID_Curso','=',$id)->get();

            foreach ($TodosTemas as $temas)
            {
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
            return back();

    }
    
    public function AddSubtema(Request $request,int  $id){
        $TodosSubtemas = TgSubtemasDifuso::where('ID_Tema','=',$id)->get();
        foreach ($TodosSubtemas as $subtemas){
            TgSubtemasDifuso::where('ID_Tema','=',$id)->where('ID_Subtema', "=",$subtemas->ID_Subtema)->delete();
        }
        
        foreach ($request->Subtema as  $clave => $valor){
            if($valor =="1"){
                $TemaDif = new TgSubtemasDifuso();
                $TemaDif->ID_Tema = $id;
                $TemaDif->ID_Subtema=$clave;
                $TemaDif->valor= $request->Valores[$clave];
                $TemaDif->save();
            }
        }
        return  back();
    }
    
    
    public function addGrado(Request $request){
        $this->validate($request, [
            'NombreGrado'   => 'required|string|min:3|max:35|unique:tg__grados_academicos,Nombre',
        ]);
        $nuevoCursoPrincipal =new TgGradosAcademico();
        $nuevoCursoPrincipal->Nombre = $request->NombreGrado;
        $nuevoCursoPrincipal->ID_Usuario_Creador = $request->user()->id;
        $nuevoCursoPrincipal->save();
        return back();
    } 
}
