<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\MotivoContato;

class PrincipalController extends Controller
{
     public function principal(){
        // Pucha do banco todos os dados de motivos contato.
        $motivo_contatos = MotivoContato::all();
                                            // Manda os dados puchados la pra view
        return view('site.principal', ['motivo_contatos' => $motivo_contatos]); 
     }

}
