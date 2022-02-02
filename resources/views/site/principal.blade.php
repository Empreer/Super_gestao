@extends('site.layouts.basico') {{-- Extende a view de layout principal --}}

@section('titulo', 'Home') {{-- Extende apenas o titulo da pagina, não precisa do endsection--}}

@section('conteudo') {{-- inicia a section, nome será usado la no Yield do layout principal --}}

    @include('site.layouts._partials.topo')

    <div class="conteudo-destaque">

        <div class="esquerda">
            <div class="informacoes">
                <h1>Sistema Super Gestão</h1>
                <p>Software para gestão empresarial ideal para sua empresa.
                <p>
                <div class="chamada">
                    <img src=" {{ asset('/img/check.png') }}">
                    <span class="texto-branco">Gestão completa e descomplicada</span>
                </div>
                <div class="chamada">
                    <img src=" {{ asset('/img/check.png') }}">
                    <span class="texto-branco">Sua empresa na nuvem</span>
                </div>
            </div>

            <div class="video">
                <img src=" {{ asset('img/player_video.jpg') }}">
            </div>
        </div>

        <div class="direita">
            <div class="contato">
                <h1>Contato</h1>
                <p>Caso tenha qualquer dúvida por favor entre em contato com nossa equipe pelo formulário abaixo.
                @component('site.layouts._components.form_contato', ['classe' => 'borda-branca','motivo_contatos' => $motivo_contatos])
                @endcomponent    
               
            </div>
        </div>
    </div>
@endsection
