@extends('templates.layout')

@section('conteudo')

    <div class="jumbotron">
        <h2>
           Adicionar associado
        </h2>
        <span style="color: red">* Campos obrigatórios</span>
        @include('partials.mensagens')
        <div class="row col-8">

            <form class="col-8" role="form" method="post" action="{{ route('associados.associados.store') }}">
                @csrf
                <div class="form-group">
                    <label for="nome-assoiado">
                        Nome do associado
                    </label><span style="color: red"> *</span>
                    <input type="text" class="form-control" id="nome-assoiado" name="associado_nome" />
                </div>
                <div class="form-group">
                    <label for="cpf-assoiado">
                        CPF do associado
                    </label><span style="color: red"> *</span>
                    <input type="text" class="form-control cpf" id="cpf-assoiado" name="associado_cpf"/>
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
