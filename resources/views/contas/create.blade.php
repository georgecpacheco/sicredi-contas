@extends('templates.layout')

@section('conteudo')

    <div class="jumbotron">
        <h2>
           Adicionar conta
        </h2>
        <span style="color: red">* Campos obrigatórios</span>
        @include('partials.mensagens')
        <div class="row col-8">

            <form class="col-8" role="form" method="post" action="{{ route('contas.contas.store') }}">
                @csrf
                <input type="hidden" value="{{ $associado->associado_cpf }}" name="conta_cpf">
                <div class="form-group">
                    <label for="nome-assoiado">
                        Número da conta
                    </label><span style="color: red"> *</span>
                    <input type="text" class="form-control" id="nome-assoiado" name="conta_numero" value="{{ old('conta_numero') }}" />
                </div>
                <div class="form-group">
                    <label for="cpf-assoiado">
                        Tipo da conta
                    </label>
                    <select name="conta_tipo">
                        <option value="Conta Corrente">Conta Corrente</option>
                        <option value="Conta Poupança">Conta Poupança</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nome-assoiado">
                        Número da agência
                    </label><span style="color: red"> *</span>
                    <input type="text" class="form-control" id="nome-assoiado" name="conta_agencia" value="{{ old('conta_agencia') }}" />
                </div>

                <button type="submit" class="btn btn-primary">
                    Salvar
                </button>
            </form>
        </div>

    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function($){
        $('.cpf').mask('000.000.000-00', {reverse: true});
    });
</script>

    @endsection
