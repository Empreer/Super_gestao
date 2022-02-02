@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
@include('app.layouts._partials.topo')
@section('conteudo')
      <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 90%; margin-left: auto; margin-right: auto;">
                <table border="1" width="100%" class="table table-striped">
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>E-mail</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fornecedores as $fornecedor) {{--variável fornecedor já veio lá do Controlador--}}
                            <tr>
                                <td>{{ $fornecedor->nome }}</td>
                                <td>{{ $fornecedor->site }}</td>
                                <td>{{ $fornecedor->uf }}</td>
                                <td>{{ $fornecedor->email }}</td>
                                <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</td>
                                <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td> {{--Fornecedor id é o parametro enviado para a edicao--}}
                            </tr>
                        <tr>
                                <td colspan="6">
                                    <p>Lista de produtos</p>
                                    <table border="1" style="margin:20px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($fornecedor->produtos as $key => $produto)
                                                <tr>
                                                    <td>{{ $produto->id}}</td>
                                                    <td>{{ $produto->nome}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            <tr>
                        @endforeach
                    </tbody>
                </table>
                    <br>
                    
                     {{ $fornecedores->appends($request)->links() }}{{--Paginacao--}}
            Exibindo {{ $fornecedores->count() }} fornecedores de {{ $fornecedores->total() }} (de {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }})
            
            </div>
        </div>

    </div>
@endsection
