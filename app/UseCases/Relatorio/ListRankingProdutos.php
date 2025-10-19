<?php

namespace App\UseCases\Relatorio;

use App\Repositories\RelatorioRepository;

class ListRankingProdutos {

    private RelatorioRepository $repository;

    public function __construct() {
        $this->repository = new RelatorioRepository();
    }

    public function execute(): array {
        return $this->repository->getRankingProdutosMaisSaidas();
    }

}