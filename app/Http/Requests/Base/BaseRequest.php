<?php

namespace App\Http\Requests\Base;

use App\Http\Requests\Request;

abstract class BaseRequest extends Request implements AdminRequest
{
    protected $fields = [];
    protected $decimal_fields = [];

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->repo->regras($this->fields);
    }

    public function attributes()
    {
        return $this->repo->nomes($this->fields);
    }

    public function getFields()
    {
        return $this->fields;
    }

    protected function prepareForValidation()
    {
        $fs = [];
        if(count($this->decimal_fields)) {
            foreach ($this->decimal_fields as $field) {
                if($this->{$field}) {
                    $fs[$field] = (float) str_replace([".", ","], ["", "."], $this->{$field});
                }
            }
        }
        $this->merge($fs);
    }
}
