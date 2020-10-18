@extends('templates.layout')

@section('conteudo')

    <div class="jumbotron">
        <h2>
            Contas
        </h2>
        @include('partials.mensagens')
        <div class="row col-8">

            <form class="col-8" role="form" method="post" action="{{ route('contas.importar') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                    <label for="exampleInputFile">
                        Importar arquivo de contas
                    </label>
                    <input type="file" class="form-control-file" id="exampleInputFile" name="importacsv" />
                    <p class="help-block">
                        Apenas arquivos .csv são aceitos.
                    </p>
                </div>

                <button type="submit" class="btn btn-primary">
                    Importar contas
                </button>
            </form>
        </div>
        <hr>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>CPF</th>
                        <th>Número</th>
                        <th>Tipo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($contas as $conta)
                    <tr>
                        <td>{{ $conta->conta_id }}</td>
                        <td>{{ $conta->conta_cpf }}</td>
                        <td>{{ $conta->conta_numero }}</td>
                        <td>{{ $conta->conta_tipo }}</td>
                        <td>
                            <a class="btn-acao pull-left text-center transition" href="{{ route('contas.contas.edit',["conta" => $conta->conta_id]) }}"><button class="btn"><i class="fa fa-pencil"></i></button></a>
                            <a href="{{ route('contas.contas.index') }}"
                               onclick="confirm('Tem certeza que deseja excluir este item?');
                                       event.preventDefault();
                                       document.getElementById(
                                       'delete-form-{{$conta->conta_id}}').submit();">
                                <button class="btn"><i class="fa fa-trash"></i></button>
                            </a>
                        </td>
                        <form id="delete-form-{{$conta->conta_id}}"
                              + action="{{route('contas.contas.destroy', $conta->conta_id)}}"
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