@extends('templates.layout')

@section('conteudo')

    <div class="jumbotron">
        <h2>
            Associados
        </h2>
        @include('partials.mensagens')
        <p>
            <a class="btn btn-primary btn-large" href="{{ route('associados.associados.create') }}"><i class="fa fa-plus"></i> Adicionar Associado</a>
        <form class="form-inline" method="get" action="{{ route('contas.agencia.busca') }}">
            @csrf
            <input class="form-control mr-sm-2" type="text" name="agencia" placeholder="Digite o n° da Agência" />
            <button class="btn btn-primary my-2 my-sm-0" type="submit">
                Busca por Agência
            </button>
        </form>
        </p>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>Agência</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Conta</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contas as $conta)
                    <tr>
                        <td>{{ $conta->conta_agencia }}</td>
                        <td>{{ $conta->associado->associado_nome }}</td>
                        <td>{{ $conta->associado->associado_cpf }}</td>
                        <td>{{ $conta->conta_numero }}</td>
                        <td>
                            <a class="btn-acao pull-left text-center transition" href="{{ route('associados.associados.edit',["associado" => $conta->associado->associado_id]) }}"><button class="btn"><i class="fa fa-pencil"></i></button></a>
                            <a href="{{ route('associados.associados.index') }}"
                               onclick="confirm('Tem certeza que deseja excluir este item?');
                                       event.preventDefault();
                                       document.getElementById(
                                       'delete-form-{{$conta->associado->associado_id}}').submit();">
                                <button class="btn"><i class="fa fa-trash"></i></button>
                            </a>
                        </td>
                        <form id="delete-form-{{$conta->associado->associado_id}}"
                              + action="{{route('associados.associados.destroy', $conta->associado->associado_id)}}"
                              method="post">
                            @csrf @method('DELETE')
                        </form>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>

    </div>

@endsection