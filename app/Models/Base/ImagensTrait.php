<?php

namespace App\Models\Base;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait ImagensTrait
{
    public function getThumbsAttribute()
    {
        $retorno = [];
        if ($this->imagem_tipo == "THUMBNAIL") {
            return $retorno;
        }
        foreach ($this->filhos as $filho) {
            $retorno[$filho->imagem_largura."x".$filho->imagem_altura] = $filho;
        }
        return $retorno;
    }
    
    public function getUrlAttribute()
    {
        $path = Cache::rememberForever($this->belongs . '-' . $this->{$this->{$this->belongs}()->getForeignKeyName()}, function () {
            return $this->{$this->belongs}->folderUrl();
        });
        return asset($path . "/" . $this->imagem_nome);
    }

    public static function excluirArquivo($imagem)
    {
        foreach ($imagem->filhos as $img) {
            $img->delete();
        }
        $arquivo = $imagem->{$imagem->belongs}->folderPath().'/'.$imagem->imagem_nome;

        if (Storage::exists($arquivo)) {
            Storage::delete($arquivo);
        }
    }
    
    public static function criarThumb($imagem, $thumb)
    {
        $arquivo = $imagem->{$imagem->belongs}->gerarNomeHashArquivo($imagem->imagem_nome);
        $img = Image::make(Storage::read($imagem->{$imagem->belongs}->folderPath() . '/' . $imagem->imagem_nome));
        
        if ($thumb[0] == null || $thumb[1] == null) {
            $img->resize($thumb[0], $thumb[1], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        } else {
            $img->fit($thumb[0], $thumb[1], function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            }, 'center');
        }

        Storage::put($imagem->{$imagem->belongs}->folderPath() . '/' . $arquivo['completo'], $img->encode($arquivo['extensao']));
        
        app()->make(self::$repository)->createObj([
            $imagem->{$imagem->belongs}->getKeyName() => $imagem->{$imagem->{$imagem->belongs}->getKeyName()},
            "imagem_pai" => $imagem->imagem_id,
            "imagem_tipo" => "THUMBNAIL",
            "imagem_nome" => $arquivo['completo'],
            "imagem_largura" => $thumb[0] ? $thumb[0] : "0",
            "imagem_altura" => $thumb[1] ? $thumb[1] : "0"
        ]);
    }
}
