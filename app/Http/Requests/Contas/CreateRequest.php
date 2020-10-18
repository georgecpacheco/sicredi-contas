<?php

namespace App\Http\Requests\Contas;

use App\Http\Requests\Base\BaseRequest;
use App\Http\Requests\Base\ICreateRequest;
use App\Repositories\Contas\ContasRepository as Repository;

class CreateRequest extends BaseRequest implements ICreateRequest {

    protected $repo;
    protected $fields = [
        'conta_agencia',
        'conta_cpf',
    ];

    public function __construct(Repository $repo) {
        parent::__construct();
        $this->repo = $repo;
    }

}
