<?php

namespace App\Models\Base;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

trait FoldersTrait
{
    public function nextIndex()
    {
        if ($this->table && $this->folderColunm) {
            $selectQuery = DB::raw('(COALESCE(MAX(' . $this->folderColunm . '), 0) + 1 ) as "index"');
            $resultado = DB::table($this->table)->select($selectQuery);

            return $resultado->value('index');
        } else {
            return;
        }
    }

    public function folderUrl()
    {
        return Storage::url($this->folderPath());
    }

    public function folderPath()
    {
        if ($this->folderColunm) {
            return $this->folderName . '/' . $this->{$this->folderColunm};
        }
        return $this->folderName;
    }

    public function createFolder()
    {
        if ($this->folderColunm && ! collect(Storage::directories($this->folderName))->has($this->{$this->folderColunm})) {
            Storage::makeDirectory($this->folderName . '/' . $this->{$this->folderColunm});
        }
    }

    public function deleteFolder()
    {
        if ($this->folderColunm && collect(Storage::directories($this->folderName))->contains($this->folderPath())) {
            Storage::deleteDirectory($this->folderPath());
        }
    }
    
    public function gerarNomeHashArquivo($arquivo, $tamanho = 32)
    {
        $nomeCurto = str_random($tamanho);
        $diretorio = $this->folderPath();

        if (is_string($arquivo)) {
            $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);
        } else {
            $extensao = $arquivo->guessExtension();
        }
        if($extensao == "txt")
            $extensao = "jpg";

        $nomeCompleto = $nomeCurto . '.' . $extensao;
        $destino = $diretorio . '/' . $nomeCompleto;

        if (Storage::exists($destino)) {
            return $this->gerarNomeHashArquivo($arquivo, $tamanho);
        } else {
            return [
                'completo' => $nomeCompleto,
                'curto' => $nomeCurto,
                'extensao' => $extensao,
            ];
        }
    }
}
