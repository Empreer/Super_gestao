<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use \App\Http\Middleware\LogAcessoMiddleware;  // puchando a Middleware

class SobreNosController extends Controller
{
   
 /*   public function __construct() {           //Middleware arquivo de LOG.
        $this->middleware(log.acesso);    // middleware apelidado la Kernel do http.
    } */
   
    public function sobreNos(){
        return view('site.sobre-nos');
    }
}
