@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
@include('app.layouts._partials.topo')
@section('conteudo')

      <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Fornecedor - Adicionar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('app.fornecedor.adicionar') }}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{$msg ?? ''}} {{--Caso mensagem vazia imprime em branco--}}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('app.fornecedor.adicionar') }}"> {{--Form metodo post direcionando para rota adicionar--}}
                    <input type="hidden" name="id" value="{{ $fornecedor->id ?? '' }}"> {{--Se tiver em edicao vai aparecer o id--}}
                    @csrf {{--csrf criacao do token--}}                                          {{--se estiver recebendo o campo de edicao se nao campo antigo digitado--}}
                    <input type="text" name="nome" placeholder="Nome" class="borda-preta" value="{{ $fornecedor->nome ?? old('nome') }}">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}  {{--validacao do erro de input--}}
                    <input type="text" name="site" placeholder="Site" class="borda-preta" value="{{ $fornecedor->site ?? old('site') }}">
                    {{ $errors->has('site') ? $errors->first('site') : '' }}
                    <input type="text" name="uf" placeholder="UF" class="borda-preta" value="{{ $fornecedor->uf ?? old('uf') }}">
                    {{ $errors->has('uf') ? $errors->first('uf') : '' }}
                    <input type="text" name="email" placeholder="E-mail" class="borda-preta" value="{{ $fornecedor->email ?? old('email') }}">
                    {{ $errors->has('email') ? $errors->first('email') : '' }}
                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>

    </div>
@endsection
