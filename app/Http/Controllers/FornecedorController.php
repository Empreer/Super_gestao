<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Fornecedor;


class FornecedorController extends Controller
{
    public function index() {
        return view('app.fornecedor.index');

    }
    // Função de pesquisa no banco.
    public function listar(Request $request) { //request requisita os dados lá da view

        $fornecedores = Fornecedor::where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->paginate(4);

        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]); //retorna os dados lá pra view
    }

   
     // Função de gravação no banco
    public function adicionar(Request $request) {

        $msg = '';  // Mensagem de sucesso inicializando

        if($request->input('_token') != '' && $request->input('id') == '') {  //se tiver token @csrf for presente e o id vazio ele grava um novo registro
            //validacao
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchida',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
                'email.email' => 'O campo e-mail não foi preenchido corretamente'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());  //metodo de insercao da tabela desde que esteja configurado la no model

            //redirect

            //dados view
            $msg = 'Cadastro realizado com sucesso';
        }
             // Trecho do Adicionar quando em Edição--------------
        if ($request->input('_token') != '' && $request->input('id') != '') { //Se houver token csrf e id irá entrar em modo e edicao
            $fornecedor = Fornecedor::find($request->input('id')); //variavel recebe pelo id
            $update = $fornecedor->update($request->all()); //dá o update em todos os campos liberados lá no MOdel.
    
            if($update) { //Se a variavel update existir nao for nula
                $msg = 'Atualização realizado com sucesso';
            } else {
                $msg = 'Erro ao tentar atualizar o registro';
            }
             //Se der erro retorna pra rota editar anterior
            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }
             // se salvar retorna pra view adicionar com a mensagem de sucesso.
             return view('app.fornecedor.adicionar', ['msg' => $msg]); //manda a mensagem pra view

    }

            //Função de pesquisa dados para edicao // pega o id e mensagem lá da view de lista e joga pra view adicionar para nova edicao.
            public function editar($id, $msg = '') {

                $fornecedor = Fornecedor::find($id);  //metodo find busca o fornecedor pelo id
        
                return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
            }

            public function excluir($id) {

                Fornecedor::find($id)->delete();  //metodo find busca o fornecedor pelo id
        
                // return redirect()->route('app.fornecedor'); //original
                return view('app.fornecedor.listar');
            }

}
