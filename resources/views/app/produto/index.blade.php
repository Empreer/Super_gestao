@extends('app.layouts.basico')
@include('app.layouts._partials.topo')
@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.create') }}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td> {{-- belongs to do model --}}
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td> {{-- hasone do model --}}
                                <td>{{ $produto->itemDetalhe->altura ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->largura ?? '' }}</td>
                                <td><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></td> {{-- rota visualizacao produto --}}
                                
                                    {{-- metodo de exclusao foi adicionado o id para usar embaixo na funcao javascript --}}
                            <td> <form id="form_{{ $produto->id }}" method="post"
                                        action="{{ route('produto.destroy', ['produto' => $produto->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>--> {{-- Funcao criada ao inves do botão --}}
                                        <a href="#"onclick="document.getElementById('form_{{ $produto->id }}').submit()">Excluir</a>
                                    </form>
                                </td>
                                <td><a href="{{route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></td>
                            </tr>
                             <tr>
                                 <td colspan='12'>
                                    <p>Pedidos</p>
                                    @foreach($produto->pedido as $pedido) {{--pedido e o apelido da funcao lá do model aonde faz o hasmany--}}
                                        <a href="{{ route('pedido.produto.create', ['pedido' => $pedido->id]) }}">
                                            Pedido: {{ $pedido->id }},
                                        </a>
                                    @endforeach
                                 </td>       
                             </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $produtos->appends($request)->links() }}

                <!--
                                    <br>
                                    {{ $produtos->count() }} - Total de registros por página
                                    <br>
                                    {{ $produtos->total() }} - Total de registros da consulta
                                    <br>
                                    {{ $produtos->firstItem() }} - Número do primeiro registro da página
                                    <br>
                                    {{ $produtos->lastItem() }} - Número do último registro da página

                                    -->
                <br>
                Exibindo {{ $produtos->count() }} produtos de {{ $produtos->total() }} (de
                {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})
            </div>
        </div>

    </div>

@endsection