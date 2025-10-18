<?php

namespace App\UseCases\Produto;

use App\Repositories\ProdutoRepository;

class DeleteProduto {

    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(int $id): bool {
        return $this->repository->delete($id);
    }

}