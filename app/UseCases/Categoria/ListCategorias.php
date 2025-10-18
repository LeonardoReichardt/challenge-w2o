<?php

namespace App\UseCases\Categoria;

use App\Repositories\CategoriaRepository;

class ListCategorias {

    private CategoriaRepository $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function execute(): array {
        return $this->repository->getAll();
    }
}