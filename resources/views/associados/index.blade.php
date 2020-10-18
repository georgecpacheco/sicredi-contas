@extends('templates.layout')

@section('conteudo')

    <div class="jumbotron">
        <h2>
            Associados
        </h2>
        @include('partials.mensagens')
        <p>
            <a class="btn btn-primary btn-large" href="{{ route('associados.associados.create') }}"><i class="fa fa-plus"></i> Adicionar Associado</a>
        </p>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($associados as $associado)
                    <tr>
                        <td>{{ $associado->associado_id }}</td>
                        <td>{{ $associado->associado_nome }}</td>
                        <td>{{ $associado->associado_cpf }}</td>
                        <td>
                            <a class="btn-acao pull-left text-center transition" href="{{ route('associados.associados.edit',["associado" => $associado->associado_id]) }}"><button class="btn"><i class="fa fa-pencil"></i></button></a>
                            <a href="{{ route('associados.associados.index') }}"
                               onclick="confirm('Tem certeza que deseja excluir este item?');
                                       event.preventDefault();
                                       document.getElementById(
                                       'delete-form-{{$associado->associado_id}}').submit();">
                                <button class="btn"><i class="fa fa-trash"></i></button>
                            </a>
                        </td>
                        <form id="delete-form-{{$associado->associado_id}}"
                              + action="{{route('associados.associados.destroy', $associado->associado_id)}}"
                              method="post">
                            @csrf @method('DELETE')
                        </form>
                    </tr>
                    @empty
                    <tr role="row">
                        <td class="td-lista text-center" colspan="6">Sem itens cadastrados</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection