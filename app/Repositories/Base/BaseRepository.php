<?php

namespace App\Repositories\Base;

use GiordanoLima\EloquentRepository\BaseRepository as VendorRepository;

abstract class BaseRepository extends VendorRepository implements ICoreRepository {
   
    protected $perPage = 10;
    
    public function busca($busca) {
        return $this;
    }

    public function regras(array $fields = [])
    {
        if (count($fields) > 0) {
            $retorno = [];
            foreach ($fields as $field) {
                if (array_key_exists($field, $this->regras)) {
                    $retorno[$field] = $this->regras[$field];
                }
            }

            return $retorno;
        } else {
            return $this->regras;
        }
    }

    public function nomes(array $fields = [])
    {
        if (count($fields) > 0) {
            $retorno = [];
            foreach ($fields as $field) {
                if (array_key_exists($field, $this->nomes)) {
                    $retorno[$field] = $this->nomes[$field];
                }
            }

            return $retorno;
        } else {
            return $this->nomes;
        }
    }

    public function admin($request)
    {
        if (array_key_exists("busca", $request) && $request["busca"] && method_exists($this, "busca")) {
            $this->busca($request["busca"]);
        }
        
        if (array_key_exists("qtd", $request)) {
            $this->perPage = $request["qtd"];
        }
        return $this->paginate();
    }
    
    public function getKeyName()
    {
        return $this->model->getKeyName();
    }
    
    public function getById($id)
    {
        return $this->find($id);
    }
    
    public function getAll()
    {
        return $this->get();
    }

    public function createObj($data)
    {
        return $this->create($data);
    }

    public function updateObj($id, $data)
    {
        $obj = $this->find($id);
        if ($obj) {
            $obj->fill($data);
            $obj->save();
        }
        return $obj;
    }

    public function deleteObj($id)
    {
        $this->destroy($id);
    }
}
