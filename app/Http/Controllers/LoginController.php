<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;  //Seta a Model User no sistema.

class LoginController extends Controller
{
    public function index(Request $request) {  //recupera o resquest 

        $erro = '';

        if($request->get('erro') == 1) {
            $erro = 'Usuário e ou senha não existe';
        }

        if($request->get('erro') == 2) {
            $erro = 'Necessario realizar login para ter acesso a página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request) {
           //regras de validação
           $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //as mensagens de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        //se não passar no validate
        $request->validate($regras, $feedback);

        //recuperando os parâmetros do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');
        
        //Iniciar o Model User- Comparando dados no banco.
        $user = new User();

        $usuario = $user->where('email','=',$email)->where('password','=', $password)->get()
        ->first(); // seleciona apenas o usuario existente no banco se ele existir.

        if(isset($usuario->name)) {  //isset é um teste Boleano, se sim ele deu 1 se nao deu 0, se existe ou nao o campo dentro da variavel.
            
            session_start();  //inicia a variavel global Session e pega os dados nome e email.
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login',['erro' => 1]); //o redirect joga sempre para o metodo GET lá da rota.
        }
    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
    }

}
