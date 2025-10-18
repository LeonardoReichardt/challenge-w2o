<?php

namespace App\UseCases\Produto;

use App\Entities\Produto;
use App\Repositories\ProdutoRepository;

class CreateProduto {

    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(array $data): bool {
        $produto = new Produto(
            null,
            $data['sku'],
            $data['nome'],
            $data['descricao'] ?? null,
            (float)$data['preco'],
            $data['foto'] ?? null,
            $data['data_vencimento'] ?? null,
            date("Y-m-d H:i:s"),
            date("Y-m-d H:i:s"),
            (int)$data['categoria_id']
        );

        return $this->repository->save($produto);
    }
    
}