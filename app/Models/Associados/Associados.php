<?php

namespace App\Models\Associados;

use App\Models\Base\Model;

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

}

