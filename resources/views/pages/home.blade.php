@extends('templates.layout')

@section('conteudo')

    <div class="jumbotron">
        <h2>
            Bem vindo!
        </h2>
        <p>
            Este é o sistema de contas do Sicredi. Aqui você pode consultar os associados cadastrados e no botão abaixo você
            pode importar o arquivo .csv das contas para dentro do nosso banco de dados.
        </p>
        <p>
            <a class="btn btn-primary btn-large" href="#"><i class="fa fa-cloud-upload"></i> Importar arquivo de contas</a>
        </p>
    </div>

    @endsection