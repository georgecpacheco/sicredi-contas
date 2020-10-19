<?php

namespace App\Repositories\Contas;

use App\Models\Associados\Associados;
use App\Repositories\Base\BaseRepository;

class ContasRepository extends BaseRepository {

    protected $orderBy = "created_at";
    protected $orderByDirection = 'DESC';
    protected $regras = [];
    protected $nomes = [];

    protected function model() {
        return \App\Models\Contas\Contas::class;
    }

    public function getAgencia($agencia = null)
    {
        if (request("agencia")) {
            $this->where("conta_agencia", "=", request('agencia') );
        }
        return $this->orderBy('conta_agencia')->get();
    }

    public function getcontas($associado)
    {
        $associado = Associados::find($associado);
        $cpf = $associado->associado_cpf;
        return $this->where("conta_cpf", "=", $cpf )->orderBy('conta_agencia')->get();
    }

}
