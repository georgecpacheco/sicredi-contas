<?php

namespace App\Http\Requests\Associados;

use App\Http\Requests\Base\BaseRequest;
use App\Http\Requests\Base\IUpdateRequest;
use App\Repositories\Associados\AssociadosRepository as Repository;

class UpdateRequest extends BaseRequest implements IUpdateRequest {

    protected $repo;
    protected $fields = [
        'associado_nome',
        'associado_cpf',
    ];

    public function __construct(Repository $repo) {
        parent::__construct();
        $this->repo = $repo;
    }

}
