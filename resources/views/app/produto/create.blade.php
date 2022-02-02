@extends('app.layouts.basico')
@include('app.layouts._partials.topo')
@section('titulo', 'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Adicionar Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{ route('produto.index') }}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form method="post" action="{{ route('produto.store') }}"> {{-- Caminho e metodo de envio do formulario --}}
                    @csrf

                    <select name="fornecedor_id">
                        <option>-- Selecione um Fornecedor --</option>

                        @foreach ($fornecedores as $fornecedor)
                            <option value="{{ $fornecedor->id }}"
                                {{ ($produto->fornecedor_id ?? old('fornecedor_id')) == $fornecedor->id ? 'selected' : '' }}>
                                {{ $fornecedor->nome }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : '' }}

                    <input type="text" name="nome" value="" placeholder="Nome" class="borda-preta">
                    {{ $errors->has('nome') ? $errors->first('nome') : '' }}

                    <input type="text" name="descricao" value="" placeholder="Descrição" class="borda-preta">
                    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}

                    <input type="text" name="peso" value="" placeholder="peso" class="borda-preta">
                    {{ $errors->has('peso') ? $errors->first('peso') : '' }}

                    <select name="unidade_id" class="borda-preta">
                        <option>-- Selecione a Unidade de Medida --</option>

                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}">{{ $unidade->descricao }}</option>
                        @endforeach
                    </select>
                    {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}

                    <button type="submit" class="borda-preta">Cadastrar</button>
                </form>
            </div>
        </div>

    </div>

@endsection
