<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReactivosController extends Controller
{
    public function __construct()
    {
    
    }
    public function index(){
        
        return "contenido index";
    }
}
