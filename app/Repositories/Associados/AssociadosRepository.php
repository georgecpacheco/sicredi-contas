<?php

namespace App\Repositories\Associados;

use App\Repositories\Base\BaseRepository;

class AssociadosRepository extends BaseRepository {

    protected $orderBy = "created_at";
    protected $orderByDirection = 'DESC';
    protected $regras = [
        'associado_nome' => [
            'required',
            'max:255'
        ],
        'associado_cpf' => [
            'required',
            'max:255'
        ],

    ];
    protected $nomes = [
        'associado_nome' => 'NOME',
        'associado_cpf' => 'CPF',
    ];

    protected function model() {
        return \App\Models\Associados\Associados::class;
    }

    public function busca($busca) {
        $this->where(function($query) use($busca) {
            return $query->where("associado_cpf", "like", "%".$busca."%");
        });
        return $this;
    }

}
