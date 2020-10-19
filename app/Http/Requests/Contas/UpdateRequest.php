<?php

namespace App\Http\Requests\Contas;

use App\Http\Requests\Base\BaseRequest;
use App\Http\Requests\Base\IUpdateRequest;
use App\Repositories\Contas\ContasRepository as Repository;

class UpdateRequest extends BaseRequest implements IUpdateRequest {

    protected $repo;
    protected $fields = [
        'conta_agencia',
        'conta_cpf',
        'conta_tipo',
    ];

    public function __construct(Repository $repo) {
        parent::__construct();
        $this->repo = $repo;
    }

}
