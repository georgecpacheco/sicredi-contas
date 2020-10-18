<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="navbar-toggler-icon"></span>
    </button> <a class="navbar-brand" href="#">Sicredi Contas</a>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="navbar-nav ml-md-auto">
            <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pages.home') }}"> <i class="fa fa-home"></i> Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"><i class="fa fa-users"></i> Associados</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('associados.associados.create') }}"><i class="fa fa-user-plus"></i> Novo associado</a>
                    <a class="dropdown-item" href="{{ route('associados.associados.index') }}"><i class="fa fa-users"></i> Associados cadastrados</a>
                    <a class="dropdown-item" href="#"><i class="fa fa-building"></i> Associados cadastrados por agência</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contas.contas.index') }}"> <i class="fa fa-cloud-upload"></i> Importar arquivo de contas</a>
            </li>

        </ul>
    </div>
</nav>