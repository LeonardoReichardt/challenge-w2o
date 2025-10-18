<?php

namespace App\UseCases\Categoria;

use App\Repositories\CategoriaRepository;

class UpdateCategoria {

    private CategoriaRepository $repository;

    public function __construct() {
        $this->repository = new CategoriaRepository();
    }

    public function execute(int $id, string $nome): bool {
        $categoria = $this->repository->findById($id);

        if(!$categoria) {
            return false;
        }

        $categoria->setNome($nome);
        return $this->repository->save($categoria);
    }

}