<?php

namespace App\UseCases\Categoria;

use App\Entities\Categoria;
use App\Repositories\CategoriaRepository;

class CreateCategoria {
    
    private CategoriaRepository $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function execute(string $nome): bool {
        $categoria = new Categoria(null, $nome);
        return $this->repository->save($categoria);
    }

}