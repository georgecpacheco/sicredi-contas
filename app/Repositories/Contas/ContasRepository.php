<?php

namespace App\Repositories\Contas;

use App\Repositories\Base\BaseRepository;

class ContasRepository extends BaseRepository {

    protected $orderBy = "created_at";
    protected $orderByDirection = 'DESC';
    protected $regras = [];
    protected $nomes = [];

    protected function model() {
        return \App\Models\Contas\Contas::class;
    }

}
