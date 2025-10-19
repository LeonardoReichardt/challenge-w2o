<?php

namespace App\UseCases\Relatorio;

use App\Repositories\RelatorioRepository;

class ListEstoqueAtual {

    private RelatorioRepository $repository;

    public function __construct() {
        $this->repository = new RelatorioRepository();
    }

    public function execute(): array {
        return $this->repository->getEstoqueAtual();
    }

}