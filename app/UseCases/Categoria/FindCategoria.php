<?php

namespace App\UseCases\Categoria;

use App\Repositories\CategoriaRepository;
use App\Entities\Categoria;

class FindCategoria {

    private CategoriaRepository $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function execute(int $id): ?Categoria {
        return $this->repository->findById($id);
    }

}