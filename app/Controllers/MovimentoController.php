<?php

namespace App\Controllers;

use App\Core\Controller;
use App\UseCases\Movimento\ListMovimentos;
use App\UseCases\Movimento\RegistrarEntrada;
use App\UseCases\Movimento\RegistrarSaida;
use App\UseCases\Produto\ListProdutos;

class MovimentoController extends Controller {
    
    public function index(): void {
        $movimentos = (new ListMovimentos())->execute();
        $produtos = (new ListProdutos())->execute();

        $this->view('movimentos/index', [
            'movimentos' => $movimentos,
            'produtos'   => $produtos
        ]);
    }

    public function entrada(): void {
        $produtoId = (int)($_POST['produto_id'] ?? 0);
        $quantidade = (int)($_POST['quantidade'] ?? 0);
        $usuario = $_POST['usuario'] ?? 'Sistema';

        if($produtoId > 0 && $quantidade > 0) {
            $useCase = new RegistrarEntrada();
            $useCase->execute($produtoId, $quantidade, $usuario);
        }

        $this->redirect('/estoque');
    }

    public function saida(): void {
        $produtoId = (int)($_POST['produto_id'] ?? 0);
        $quantidade = (int)($_POST['quantidade'] ?? 0);
        $usuario = $_POST['usuario'] ?? 'Sistema';

        if($produtoId > 0 && $quantidade > 0) {
            $useCase = new RegistrarSaida();
            $useCase->execute($produtoId, $quantidade, $usuario);
        }

        $this->redirect('/estoque');
    }
    
}
