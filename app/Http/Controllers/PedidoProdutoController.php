<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Pedido;
use \App\Models\Produto;
use \App\Models\Pedidoproduto;
use Illuminate\Support\Facades\DB;


class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all(); 

        $pedidoproduto = DB::select('SELECT p2.id, p3.nome, p.quantidade, p2.created_at,p3.id as produtoid, p.id as pedidoprodutoid 
        from pedidoprodutos p, pedidos p2, produtos p3   
        where p.pedido_id = p2.id 
        and p.produto_id = p3.id
        and p.pedido_id = :pedidoid',['pedidoid' => $pedido->id]);

        //$pedido->produtos; //eager loading
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos, 'pedidoproduto' => $pedidoproduto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'O produto informado não existe',
            'quantidade' => 'A Quantidade não foi selecionada'
        ];

        $request->validate($regras, $feedback);

        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id');
        $pedidoProduto->quantidade = $request->get('quantidade');
        $pedidoProduto->save();

        return redirect()->route('pedido.produto.create', ['pedido' => $pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido, Produto $produto)
    {
      
       DB::table('pedidoprodutos')->where('pedido_id', '=', $pedido->id)->where('produto_id', '=', $produto->id)->delete();
       //  DB::select('delete from pedidoprodutos where pedido_id = :pedid and produto_id = :prodid',['pedid' => $pedido,'prodid' => $produto]);
    
         return redirect()->route('pedido.produto.create', ['pedido' => $pedido->id]);
        }

}
