<?php

namespace App\Http\Requests\Base;

use App\Http\Requests\Request;

class ImagensCropRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'x' => 'required|numeric',
            'y' => 'required|numeric',
            'w' => 'required|numeric',
            'h' => 'required|numeric',
        ];
    }

}
