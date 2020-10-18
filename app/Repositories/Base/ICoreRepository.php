<?php

namespace App\Repositories\Base;

interface ICoreRepository
{
    public function regras(array $fields = []);

    public function nomes(array $fields = []);

    public function admin($request);
    
    public function getKeyName();
    
    public function getById($id);
    
    public function getAll();

    public function createObj($data);

    public function updateObj($id, $data);

    public function deleteObj($id);
}
