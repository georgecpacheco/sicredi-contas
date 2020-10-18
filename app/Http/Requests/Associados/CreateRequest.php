<?php

namespace App\Http\Requests\Associados;

use App\Http\Requests\Base\BaseRequest;
use App\Http\Requests\Base\ICreateRequest;
use App\Repositories\Associados\AssociadosRepository as Repository;

class CreateRequest extends BaseRequest implements ICreateRequest {

    protected $repo;
    protected $fields = [
        'associado_nome',
        'associado_cpf',
    ];

    public function __construct(Repository $repo) {
        parent::__construct();
        $this->repo = $repo;
    }

 /*   public function authorize() {
        return auth()->check();
    }*/

}
