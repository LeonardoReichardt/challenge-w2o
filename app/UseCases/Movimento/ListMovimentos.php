<?php

namespace App\UseCases\Movimento;

use App\Repositories\MovimentoRepository;

class ListMovimentos {

    private MovimentoRepository $repository;

    public function __construct() {
        $this->repository = new MovimentoRepository();
    }

    public function execute(): array {
        return $this->repository->getAll();
    }
}