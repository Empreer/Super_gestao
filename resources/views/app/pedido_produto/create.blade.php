@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Adicionar Produtos ao Pedido</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('pedido.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <h4>Detalhes do pedido</h4>
            <p>ID do pedido: {{ $pedido->id }}</p>
            <p>Cliente: {{ $pedido->cliente_id }}</p> 
            
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <h4>Itens do pedido</h4>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome do produto</th>
                            <th>Quantidade</th>
                            <th>Data de Criacao</th>
                            <th>Data Criacao SQL</th>
                        </tr>
                    </thead>
                    <tbody>
                     {{--   @foreach($pedido->produtos as $produto)--}}
                           @foreach ($pedidoproduto as $pedproduto)
                            <tr>
                                <td>{{ $pedproduto->id }}</td>
                                <td>{{ $pedproduto->nome }}</td>
                                <td>{{ $pedproduto->quantidade}}</td>
                                <td>{{ date('d-m-Y', strtotime($pedproduto->created_at ?? ''->pedcreated_at)) }}</td>
                                <td>           {{--Nomes dos campos igual do SQL feito lá no controller--}}
                                    <form id="form_{{$pedproduto->id}}_{{$pedproduto->produtoid}}" method="post" action="{{ route('pedido.produto.destroy', ['pedido' => $pedproduto->id, 'produto' => $pedproduto->produtoid])}}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('form_{{$pedproduto->id}}_{{$pedproduto->produtoid}}').submit()">Excluir</a>
                                    </form> 
                                </td> 
                            </tr>
                        @endforeach
                    <tbody>
                </table>
                @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos, 'pedidoproduto' => $pedidoproduto])
                @endcomponent 
            </div>
        </div>

    </div>

@endsection

