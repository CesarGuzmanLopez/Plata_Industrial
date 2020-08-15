<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ReactivosReactivo;
use App\Models\TgCurso;
use App\Models\TgGradosAcademico;
use App\Models\TgTema;
use App\Models\ReactivosGruposTipo;
use App\Models\ReactivosPopularidad;
use App\Models\ReactivosRetroalimentacion;
class ReactivosController extends Controller
{
    public function __construct()
    {
    }
    public function index(){
        return view ("Test.Reactivos");
    }
    public function uploadImagen(Request $request){
        $path =$request->file('file')->store('public/Preguntas');
        echo json_encode(array('location' =>asset(Storage::url($path))));
    }   
    public function AdminReactivos(){
        
        $data =[
            'Retroalimentacion'=>ReactivosRetroalimentacion::get(),
            'Reactivos' => ReactivosReactivo::get(),
            'Temas'=>TgTema::get(),
            'Cursos'=>TgCurso::get(),
            'Grados'=>TgGradosAcademico::get(),
            'Grupo_Tipos'=>ReactivosGruposTipo::get(),
        ];  
        return view("Test.AdminReactivos")->with($data);
    }
    public function editReactivo(Request $request,$id){
      
        $reactivo = ReactivosReactivo::get()->where('id','=',$id)->first();
        if($reactivo->Nombre != $request->Nombre_Reactivo)
            $this->validate($request, [ 'Nombre_Reactivo'   => 'required|string|min:3|max:35|unique:reactivos__reactivos,Nombre',
                'Enunciado'=>'required|string|min:3'
            ]);
          if(! $request->Enunciado)return back();
        $reactivo->Nombre = $request->Nombre_Reactivo;
        $reactivo->Enunciado = $request->Enunciado;
        $reactivo->ID_Tema = $request->Tema;
        $reactivo->ID_Creador = $request->user()->id;
        $reactivo->Datos =json_encode($request->Data);
        $reactivo->ID_Grupo_Reactivos = $request->Grupo_Tipo;
        $reactivo->save();
        foreach(  $reactivo->reactivos__popularidads as $Pop){
            ReactivosPopularidad::where('ID_Reactivo','=',$id)->where('ID_Grado', "=",$Pop->ID_Grado)->delete();
        }
        if($request->Grado)
            foreach($request->Grado as $G){
                $relacion = new ReactivosPopularidad();
                $relacion->ID_Grado=$G;
                $relacion->ID_Reactivo=  $reactivo->id;
                $relacion->Dificultad_Creador =$request->Dificultad["$relacion->ID_Grado"];
                $relacion->save();
        }
        
        return  redirect()->route('Reactivos/AdminReactivos');
    }
    public function AddReactivo (Request $request){
            $this->validate($request, [
                'Nombre_Reactivo'   => 'required|string|min:3|max:35|unique:reactivos__reactivos,Nombre',
                'Enunciado'=>'required|string'
            ]);
            $Reactivo = new ReactivosReactivo();
            $Reactivo->Nombre = $request->Nombre_Reactivo;
            $Reactivo->Enunciado = $request->Enunciado;
            $Reactivo->ID_Tema = $request->Tema;
            $Reactivo->ID_Creador = $request->user()->id;
            $Reactivo->Datos =json_encode($request->Data);
            $Reactivo->ID_Grupo_Reactivos = $request->Grupo_Tipo;
            $Reactivo->save();
            if($Reactivo->Enunciado =="")return back();
            if($request->Grado)
                foreach($request->Grado as $G){
                    $relacion = new ReactivosPopularidad();
                    $relacion->ID_Grado=$G;
                    $relacion->ID_Reactivo=  $Reactivo->id;
                    $relacion->Dificultad_Creador =$request->Dificultad[ $relacion->ID_Grado];
                    $relacion->save();
            }
        return back();
    }
    public function EliminarReactivo($id){
        ReactivosReactivo::where('id','=',$id)->first()->delete();
        return back();
    }
    public function editarReactivo($id){
        
        $data =[
             'Reactivo' =>  ReactivosReactivo::where('id','=',$id)->first(),
             'Temas'=>TgTema::get(),
             'Cursos'=>TgCurso::get(),
             'Grados'=>TgGradosAcademico::get(),
             'Grupo_Tipos'=>ReactivosGruposTipo::get(),
         ];  
        return view('Test.editarReactivo')->with($data);
    }
    public function AdminRetroalmientacion(){
        $data=[
            'Retroalimentaciones'=>ReactivosRetroalimentacion::get(),
            'Reactivos' => ReactivosReactivo::get(),
            'Grados'=>TgGradosAcademico::get(),
        ];
        return view('Test.Retro')->with($data);
    }
    public  function AgregaRetroalimentacion(Request $request){
        $this->validate($request, [
            'Grado'=> 'bail|required|int',
            'Reactivo'=> 'bail|required|int',
            //'Grado'=>'unique:reactivos__retroalimentacion,ID_Grado,Null,ID_Reactivo'.$request->Reactivo clave compuesta unica
        ]);
        $retro = new ReactivosRetroalimentacion();
        $retro->ID_Grado =$request->Grado;
        $retro->ID_Reactivo =$request->Reactivo;
        $retro->Retroalimentacion =json_encode($request->Retroalimentacion);
        $retro->Datos=json_encode($request->Data);
        $retro->save();
        return back();
    }
    public function EliminarRetroalimentacion($id){
        ReactivosRetroalimentacion::where('id','=',$id)->first()->delete();
        return back();
    }
    public function editarRetro($id){
        $data=[
            'Retroalimentacion'=>ReactivosRetroalimentacion::where('id','=',$id)->first(),
            'Reactivos' => ReactivosReactivo::get(),
            'Grados'=>TgGradosAcademico::get(),
        ];
        return view('Test.editarRetro')->with($data);
        return back();
    }
    public function editarRetroPost(Request $request,$id){
            $retro = ReactivosRetroalimentacion::where('id','=',$id)->first();
            $retro->ID_Grado =$request->Grado;
            $retro->ID_Reactivo =$request->Reactivo;
            $retro->Retroalimentacion =json_encode($request->Retroalimentacion);
            $retro->Datos=json_encode($request->Data);
            $retro->save();
            return redirect()->route('Reactivos/AdminRetroalmientacion');
    }
    
    
    
    
    
}

