<?php

namespace App\UseCases\Movimento;

use App\Entities\MovimentoEstoque;
use App\Repositories\MovimentoRepository;

class RegistrarSaida {

    private MovimentoRepository $repository;

    public function __construct() {
        $this->repository = new MovimentoRepository();
    }

    public function execute(int $produtoId, int $quantidade, string $usuario): bool {
        $movimento = new MovimentoEstoque(
            null,
            $produtoId,
            'saida',
            $quantidade,
            date("Y-m-d H:i:s"),
            $usuario
        );

        return $this->repository->save($movimento);
    }

}