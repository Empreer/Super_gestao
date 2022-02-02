{{ $slot }}
<form action={{ route('site.contato') }} method="post">
    @csrf {{--Precisa declarar o csrf para enviar o toke do request para pode enviar o formulario --}}
    <input name="nome" value="{{ old('nome') }}" type="text" placeholder="Nome" class="{{ $classe }}">
        @if ($errors->has('nome'))    {{--Valida se tem erro no campo--}}
            {{ $errors->first('nome') }}
        @endif
    <br>
    <input name="telefone" value="{{ old('telefone') }}" type="text" placeholder="Telefone" class="{{ $classe }}">
      {{ $errors->has('telefone') ? $errors->first('telefone') : '' }} {{--Valida se tem erro no campo metodo ternario--}}
    <br>
    <input name="email" value="{{ old('email') }}" type="text" placeholder="E-mail" class="{{ $classe }}">
        {{ $errors->has('email') ? $errors->first('email') : '' }} {{--Valida se tem erro no campo metodo ternario--}}
    <br>
    <select name="motivo_contatos_id" class="{{ $classe }}">
        <option value="">Qual o motivo do contato?</option>
        @foreach($motivo_contatos as $key => $motivo_contato) {{--COmbo-box--}}
        <option value="{{$motivo_contato->id}}" {{ old('motivo_contatos_id') == $motivo_contato->id ? 'selected' : '' }}>{{$motivo_contato->motivo_contato}}</option>
        @endforeach
    </select>
        {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : '' }} {{--Valida se tem erro no campo metodo ternario--}}
    <br>
    <textarea name="mensagem" class="{{ $classe }}">Preencha aqui a sua mensagem</textarea>
        {{ $errors->has('mensagem') ? $errors->first('mensagem') : '' }} {{--Valida se tem erro no campo metodo ternario--}}
    <br>
    <button type="submit" class="{{ $classe }}">ENVIAR</button>
    
</form>


 {{--   @if($errors->any())   //Erros do Formulário- Gera a mensagem de erros de validacao se existir modelo mensagem//
        <div style="margin-left:auto; margin-right:auto, width:400px; background:red">
            @foreach ($errors->all() as $erro)
            {{ $erro }}
            <br >
            @endforeach
        </div>
    @endif  --}}
