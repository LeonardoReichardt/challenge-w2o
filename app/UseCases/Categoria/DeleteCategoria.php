<?php

namespace App\UseCases\Categoria;

use App\Repositories\CategoriaRepository;

class DeleteCategoria {

    private CategoriaRepository $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function execute(int $id): bool {
        return $this->repository->delete($id);
    }

}