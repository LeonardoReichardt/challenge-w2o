<?php

namespace App\Controllers;

use App\Core\Controller;
use App\UseCases\Produto\ListProdutos;
use App\UseCases\Produto\CreateProduto;
use App\UseCases\Produto\UpdateProduto;
use App\UseCases\Produto\DeleteProduto;
use App\UseCases\Categoria\ListCategorias;

class ProdutoController extends Controller {

    public function index(): void {
        $useCase = new ListProdutos();
        $produtos = $useCase->execute();
        $this->view('produtos/index', ['produtos' => $produtos]);
    }

    public function create(): void {
        $categorias = (new ListCategorias())->execute();
        $this->view('produtos/create', ['categorias' => $categorias]);
    }

    public function store(): void {
        $data = $_POST;
        $data['foto'] = null;

        if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['foto'];

            if($file['size'] <= 5 * 1024 * 1024 && in_array(mime_content_type($file['tmp_name']), ['image/jpeg', 'image/png'])) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . ".{$ext}";
                move_uploaded_file($file['tmp_name'], __DIR__ . "/../../public/assets/img/{$filename}");
                $data['foto'] = $filename;
            }
        }

        $useCase = new CreateProduto();
        $useCase->execute($data);

        $this->redirect('/produtos');
    }

    public function edit(): void {
        $id = (int)($_GET['id'] ?? 0);

        if($id > 0) {
            $produtos = (new ListProdutos())->execute();
            $categorias = (new ListCategorias())->execute();

            $this->view('produtos/edit', [
                'produto'    => $produtos[$id - 1] ?? null,
                'categorias' => $categorias
            ]);
        } 
        else {
            $this->redirect('/produtos');
        }
    }

    public function update(): void {
        $id = (int)($_POST['id'] ?? 0);

        if($id > 0) {
            $data = $_POST;
            $data['foto'] = null;

            if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['foto'];

                if($file['size'] <= 5 * 1024 * 1024 && in_array(mime_content_type($file['tmp_name']), ['image/jpeg', 'image/png'])) {
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . ".{$ext}";
                    move_uploaded_file($file['tmp_name'], __DIR__ . "/../../public/assets/img/{$filename}");
                    $data['foto'] = $filename;
                }
            }

            $useCase = new UpdateProduto();
            $useCase->execute($id, $data);
        }

        $this->redirect("/produtos");
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