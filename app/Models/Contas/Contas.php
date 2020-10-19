<?php

namespace App\Models\Contas;

use App\Models\Associados\Associados;
use App\Models\Base\Model;

class Contas extends Model
{
    protected $table = 'tb_contas';
    protected $primaryKey = 'conta_id';
    protected $guarded = ['conta_id'];
    protected $dates = [
        'created_at'
    ];


    public static function boot()
    {
        parent::boot();
    }

    public function associado()
    {
        return $this->belongsTo(Associados::class, 'conta_cpf', 'associado_cpf');
    }

}

