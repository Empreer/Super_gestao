<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\SiteContato;   //Chama o model pra enviar e receber dados
use \App\Models\MotivoContato; //Chama o model Motivo Contaos.

class ContatoController extends Controller
{                          //Request $request recebe os dados do formulario la da view
    public function contato(Request $request){
        $motivo_contatos = MotivoContato::all();

        return view('site.contato',['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request){

        // Método de Validação dos campos:

        $request->validate([
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ],
    
        [       //Tradução dos Erros.
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',//Individual
            'nome.unique' => 'O nome informado já está em uso',
            'email.email' => 'O email informado não é válido',
            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',
            'required' => 'O campo :attribute deve ser preenchido' // Generico tipo erro.
        ]
    );
          // Método para gravacao no banco dos dados
        $contato = new SiteContato();
          //nome no banco   //nome do input da tela
        $contato->nome = $request->input('nome');  //request chama o dado la da tela
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contatos_id = $request->input('motivo_contatos_id');
        $contato->mensagem = $request->input('mensagem');
        $contato->save();
        // redireciona pra pagina principal após enviar os dados
        return redirect()->route('site.index');
    }      
}
