<?php

namespace App\Models\Associados;

use App\Models\Base\Model;
use App\Models\Contas\Contas;

class Associados extends Model
{
    protected $table = 'tb_associados';
    protected $primaryKey = 'associado_id';
    protected $guarded = ['associado_id'];
    protected $dates = [
        'created_at'
    ];


    public static function boot()
    {
        parent::boot();
    }

    public function contas()
    {
        return $this->hasMany(Contas::class, 'conta_cpf', 'associado_cpf');
    }



}

