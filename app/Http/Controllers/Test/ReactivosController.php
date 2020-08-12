<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
}
