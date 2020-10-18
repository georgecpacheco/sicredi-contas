<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\File;

trait ImagensRepository {

    public function enviarImagem(Model $obj, $tipo, File $file, $substituir = false) {
        //EXCLUINDO ANTIGA
        if ($substituir) {
            $imagens = $this
                        ->where($obj->getKeyName(), $obj->getKey())
                        ->where('imagem_tipo', $tipo)
                        ->get();
            foreach ($imagens as $img) {
                $img->delete();
            }
        }


        $arquivo = $obj->gerarNomeHashArquivo($file);
        
        Storage::putFileAs($obj->folderPath(), $file, $arquivo['completo']);
        $image_data = Storage::read($obj->folderPath() . "/" . $arquivo['completo']);
        
        $tamanho = getimagesizefromstring($image_data);
        if ($tamanho[0] < $this->model->sizes[$tipo][0] || $tamanho[1] < $this->model->sizes[$tipo][1]) {
            $img = Image::make( $image_data );
            $img->resizeCanvas($this->model->sizes[$tipo][0], $this->model->sizes[$tipo][1], 'center');
            Storage::delete( $obj->folderPath() . '/' . $arquivo['completo'] );
            
            $image_data = $img->encode($arquivo['extensao']);
            Storage::put( $obj->folderPath() . '/' . $arquivo['completo'], $image_data );
            $tamanho = getimagesizefromstring($image_data);
        }

        $imagem = $this->create([
            $obj->getKeyName() => $obj->getKey(),
            'imagem_tipo' => $tipo,
            'imagem_nome' => $arquivo['completo'],
            'imagem_largura' => $tamanho[0],
            'imagem_altura' => $tamanho[1],
        ]);

        return $imagem;
    }

    public function thumbs($id) {
        $retorno = [];
        
        $obj = $this->find($id);
        if(!$obj)
            return $retorno;
        
        $imagens = $obj->filhos;
        foreach ($imagens as $img) {
            $retorno[] = [
                "imagem_id" => $img->imagem_id,
                "imagem_url" => asset($img->{$this->belongs}->folderUrl() . "/" . $img->imagem_nome),
                "imagem_largura" => $img->imagem_largura,
                "imagem_altura" => $img->imagem_altura,
            ];
        }
        return $retorno;
    }

    public function crop($id, $data) {
        $data = collect($data);
        $imagem = $this->find($id);
        $obj = $imagem->{$this->belongs};
        $arquivo = $obj->gerarNomeHashArquivo($imagem->imagem_nome);

        $img = Image::make( Storage::read($obj->folderPath() . "/" . $imagem->pai->imagem_nome) );
        $img->crop((int) $data->get("w"), (int) $data->get("h"), (int) $data->get("x"), (int) $data->get("y"));
        $img->resize($imagem->imagem_largura, $imagem->imagem_altura);
        Storage::put( $obj->folderPath() . '/' . $arquivo['completo'], $img->encode($arquivo['extensao']) );
        
        $this->create([
            $obj->getKeyName() => $obj->getKey(),
            "imagem_pai" => $imagem->imagem_pai,
            "imagem_tipo" => "THUMBNAIL",
            "imagem_nome" => $arquivo['completo'],
            "imagem_largura" => $imagem->imagem_largura,
            "imagem_altura" => $imagem->imagem_altura
        ]);

        $imagem->delete();
    }
    
    public function principal($id) {
        $obj = $this->find($id);
        $obj->{$this->belongs}->imagens()->update([
            "imagem_principal" => false
        ]);
        $obj->update([
            "imagem_principal" => true
        ]);
    }
    
    public function deleteImage($id) {
        $img = $this->find($id);
        if($img) {
            $img->delete();
        }
    }

}
