<?php namespace App\Repositories\Base;

trait SortableRepository {

    public function reordenar($data)
    {
        foreach ($data as $chave => $id) {
            $field = isset($this->position_field) ? $this->position_field: 'default';
            $obj = $this->find($id);
            $obj->update([
                $field => $chave
            ]);
        }
    }

}
