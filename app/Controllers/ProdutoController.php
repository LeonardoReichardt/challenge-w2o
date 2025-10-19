<?php

namespace App\Controllers;

use App\Core\Controller;
use App\UseCases\Produto\ListProdutos;
use App\UseCases\Produto\CreateProduto;
use App\UseCases\Produto\UpdateProduto;
use App\UseCases\Produto\DeleteProduto;
use App\UseCases\Categoria\ListCategorias;
use App\UseCases\Produto\FindProduto;

class ProdutoController extends Controller {

    public function index(): void {
        $useCase = new ListProdutos();
        $produtos = $useCase->execute();
        $this->view('produtos/index', ['produtos' => $produtos]);
    }

    public function create(): void {
        $categorias = (new ListCategorias())->execute();

        $this->view('produtos/create', [
            'categorias' => $categorias,
            'error'      => $_SESSION['error'] ?? null
        ]);

        unset($_SESSION['error']);
    }


    public function store(): void {
        $useCase = new CreateProduto();

        if(!$useCase->execute($_POST)) {
            $this->redirect('/produtos/create');
        }
        else {
            $this->redirect('/produtos');
        }
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);

        if($id > 0) {
            $produto = (new FindProduto())->execute($id);
            $categorias = (new ListCategorias())->execute();

            if(!$produto) {
                $_SESSION['error'] = 'Produto não encontrado.';
                $this->redirect('/produtos');
            }

            $this->view('produtos/edit', [
                'produto'    => $produto,
                'categorias' => $categorias,
                'error'      => $_SESSION['error'] ?? null
            ]);

            unset($_SESSION['error']);
        } 
        else {
            $this->redirect('/produtos');
        }
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);

        if($id > 0) {
            $useCase = new UpdateProduto();

            if(!$useCase->execute($id, $_POST)) {
                $this->redirect("/produtos/edit?id={$id}");
            }
            else {
                $this->redirect('/produtos');
            }
        }
        else {
            $this->redirect('/produtos');
        }
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);

        if($id > 0) {
            $useCase = new DeleteProduto();
            $useCase->execute($id);
        }

        $this->redirect('/produtos');
    }

}