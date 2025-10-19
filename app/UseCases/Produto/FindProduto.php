<?php

namespace App\UseCases\Produto;

use App\Repositories\ProdutoRepository;
use App\Entities\Produto;

class FindProduto {
    
    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(int $id): ?Produto {
        return $this->repository->findById($id);
    }

}