<?php

namespace App\UseCases\Produto;

use App\Repositories\ProdutoRepository;

class UpdateProduto {

    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(int $id, array $data): bool {
        $produto = $this->repository->findById($id);

        if(!$produto) {
            return false;
        }

        $produto->setSku($data['sku']);
        $produto->setNome($data['nome']);
        $produto->setDescricao($data['descricao'] ?? null);
        $produto->setPreco((float)$data['preco']);
        $produto->setFoto($data['foto'] ?? null);
        $produto->setDataVencimento($data['data_vencimento'] ?? null);
        $produto->setCategoriaId((int)$data['categoria_id']);
        $produto->setDataEdicao(date("Y-m-d H:i:s"));

        return $this->repository->save($produto);
    }

}