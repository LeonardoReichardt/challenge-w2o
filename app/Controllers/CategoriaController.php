<?php

namespace App\Controllers;

use App\Core\Controller;
use App\UseCases\Categoria\ListCategorias;
use App\UseCases\Categoria\CreateCategoria;
use App\UseCases\Categoria\UpdateCategoria;
use App\UseCases\Categoria\DeleteCategoria;

class CategoriaController extends Controller {

    public function index(): void {
        $useCase = new ListCategorias();
        $categorias = $useCase->execute();
        $this->view('categorias/index', ['categorias' => $categorias]);
    }

    public function create(): void {
        $this->view('categorias/create');
    }

    public function store(): void {
        $nome = $_POST['nome'] ?? '';

        if(!empty($nome)) {
            $useCase = new CreateCategoria();
            $useCase->execute($nome);
        }

        $this->redirect('/categorias');
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);

        if($id > 0) {
            $useCase = new ListCategorias();
            $categorias = $useCase->execute();
            $this->view('categorias/edit', ['categoria' => $categorias[$id] ?? null]);
        } 
        else {
            $this->redirect("/categorias");
        }
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);
        $nome = $_POST['nome'] ?? '';

        if($id > 0 && !empty($nome)) {
            $useCase = new UpdateCategoria();
            $useCase->execute($id, $nome);
        }

        $this->redirect('/categorias');
    }

    public function delete(): void {
        $id = (int)($_POST['id'] ?? 0);

        if($id > 0) {
            $useCase = new DeleteCategoria();
            $useCase->execute($id);
        }

        $this->redirect('/categorias');
    }
    
}