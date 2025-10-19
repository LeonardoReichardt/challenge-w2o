<?php

namespace App\Controllers;

use App\Core\Controller;
use App\UseCases\Relatorio\ListEstoqueAtual;
use App\UseCases\Relatorio\ListRankingProdutos;

class RelatorioController extends Controller {

    public function estoqueAtual(): void {
        $dados = (new ListEstoqueAtual())->execute();
        $this->view('relatorios/estoque', ['estoque' => $dados]);
    }

    public function rankingProdutos(): void {
        $dados = (new ListRankingProdutos())->execute();
        $this->view('relatorios/ranking', ['ranking' => $dados]);
    }

}