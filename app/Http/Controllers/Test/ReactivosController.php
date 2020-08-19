<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ReactivosReactivo;
use App\Models\TgCurso;
use App\Models\TgCursoTemasDifuso;
use App\Models\TgGradosAcademico;
use App\Models\TgTema;
use App\Models\ReactivosGruposTipo;
use App\Models\ReactivosPopularidad;
use App\Models\ReactivosRetroalimentacion;
use App\Models\ReactivosOpcione;
use App\Models\ReactivosReactivosOpcione;
use App\Models\TgGradoCursosDifuso;
use function GuzzleHttp\json_decode;
use App\Models\ReactivosListasReactivo;
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
        $reactivo->Enunciado =$this->sanitize_output( $request->Enunciado);
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
        foreach(  
            $reactivo->reactivos__reactivos_opciones as  $Pop){
            ReactivosReactivosOpcione:: where('ID_Reactivo','=',$id)->where('ID_Opcion', "=",$Pop->ID_Opcion)->delete();
        }
     
        if($request->Opcion)
            foreach($request->Opcion as $G){
                $relacion = new ReactivosReactivosOpcione();
                $relacion->ID_Opcion=$G;
                $relacion->ID_Reactivo=  $reactivo->id;
                $relacion->valor =$request->ValorEnPregunta["$relacion->ID_Opcion"];
                $relacion->save();
        }
        
        
        
        return  redirect()->route('Reactivos/AdminReactivos');
    }
    public function AddListaReactivo(Request $request){
        $this->validate($request, [
            'NombreLista'   => 'required|string|min:3|max:35|unique:reactivos__listas_reactivo,Nombre',
        ]);
        $nuevaLista = new ReactivosListasReactivo();
        $nuevaLista->Nombre=$request->NombreLista;
        $nuevaLista->ID_Creador= $request->user()->id;;
        $nuevaLista->save();
        return back();
    }
    public function getReactivos(){
        return ReactivosReactivo::get();
    }
    public function AddReactivo (Request $request){

            $this->validate($request, [
                'Nombre_Reactivo'   => 'required|string|min:3|max:35|unique:reactivos__reactivos,Nombre',
                'Enunciado'=>'required|string'
            ]);
            $Reactivo = new ReactivosReactivo();
            $Reactivo->Nombre = $request->Nombre_Reactivo;
            $Reactivo->Enunciado =$this->sanitize_output( $request->Enunciado);
            $Reactivo->ID_Tema = $request->Tema;
            $Reactivo->ID_Creador = $request->user()->id;
            $Reactivo->Datos =json_encode($request->Data);
            $Reactivo->ID_Grupo_Reactivos = $request->Grupo_Tipo;
            $Reactivo->save();
            if($Reactivo->Enunciado =="")"esto paso";
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
              'Opciones'=>ReactivosOpcione::get(),
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
        $retro->Retroalimentacion =$this->sanitize_output($request->Retroalimentacion);
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

    }
    public function editarRetroPost(Request $request,$id){
            $retro = ReactivosRetroalimentacion::where('id','=',$id)->first();
            $retro->ID_Grado =$request->Grado;
            $retro->ID_Reactivo =$request->Reactivo;
            $retro->Retroalimentacion =$this->sanitize_output($request->Retroalimentacion);
            $retro->Datos=json_encode($request->Data);
            $retro->save();
            return redirect()->route('Reactivos/AdminRetroalmientacion');
    } 
    public function AdminOpciones(){
        $data=[
            'Grupo_Tipos'=>ReactivosGruposTipo::get(),
            'Opciones'=>ReactivosOpcione::get(),
        ];
        
        
        
        return view('Test.AdminOpciones')->with($data);      
    }
    public function AddOpciones(Request $request){
        $this->validate($request, [
            'Opcion1'=> 'bail|required',
        ]);
        $Opcion =  new ReactivosOpcione();
        $Opcion->Enunciado1 =$request->Opcion1;
        $Opcion->Enunciado2 =$request->Opcion2;
        $Opcion->Datos1 =json_encode($request->Datos1);
        $Opcion->Datos2 =json_encode($request->Datos2);
        $Opcion->ID_Tipo_Pregunta = $request->Grupo_Tipo;
        $Opcion->save();
        return back();
    }
    public function EliminarOpciones($id){
        ReactivosOpcione::where('id','=',$id)->first()->delete();
        return back();
    }
    public function EditarOpciones($id){
        $data=[      
            'Grupo_Tipos'=>ReactivosGruposTipo::get(),
            
            'Opcion'=>ReactivosOpcione::where('id','=',$id)->first(),
        ];
        return view('Test.EditarOpciones')->with($data);
    }
    public function EditarOpcionesPost(Request $request, $id){
            $this->validate($request, [
                'Opcion1'=> 'bail|required',
            ]);
            $Opcion=ReactivosOpcione::where('id','=',$id)->first();
            $Opcion->Enunciado1 =$this->sanitize_output($request->Opcion1);
            $Opcion->Enunciado2 =$this->sanitize_output($request->Opcion2);
            $Opcion->Datos1 =$request->Datos1;
            $Opcion->Datos2 =$request->Datos2;
            $Opcion->ID_Tipo_Pregunta = $request->Grupo_Tipo;
            $Opcion->save();
           return redirect()->route('Reactivos/AdminOpciones');
    }
    public function Listas(){
        return view('Test.Listas');
    }   
    private function sanitize_output($buffer) {
        $search = array(
            '/\>[^\S ]+/s',     // strip whitespaces after tags, except space
            '/[^\S ]+\</s',     // strip whitespaces before tags, except space
            '/(\s)+/s',         // shorten multiple whitespace sequences
            '/<!--(.|\s)*?-->/' // Remove HTML comments
        );
        $replace = array(
            '>',
            '<',
            '\\1',
            ''
        );
        $buffer =str_replace("\n",'', preg_replace($search, $replace, $buffer));
        return $buffer;
    }
    /**
     * Crear funciones para dar de alta archivos
     */
    public function  CrearReactivo(){
        $data =[
            'Temas'=>TgTema::get(),
            'Cursos'=>TgCurso::get(),
            'Grados'=>TgGradosAcademico::get(),
            'Grupo_Tipos'=>ReactivosGruposTipo::get(),
            'Opciones'=>ReactivosOpcione::get(),
        ];  
        return view('Reactivos/CrearReactivo')->with($data);
    }
    public function getTemasCurso($id){
        return TgCursoTemasDifuso::where('ID_Curso','=',$id)
        ->join('tg__temas', 'tg__curso_temas_difusos.ID_Tema', '=', 'tg__temas.id')
        ->get();
    }
    public function getGrado($ID_Curso){
        return   TgGradoCursosDifuso::where('ID_Curso','=',$ID_Curso)->first();       
    }
    
    
}

