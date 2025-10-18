<?php

namespace App\UseCases\Produto;

use App\Repositories\ProdutoRepository;

class ListProdutos {

    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(): array {
        return $this->repository->getAll();
    }
    
}