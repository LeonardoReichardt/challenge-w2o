<?php

namespace App\UseCases\Produto;

use App\Entities\Produto;
use App\Repositories\ProdutoRepository;
use Exception;

class CreateProduto {

    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(array $data): bool {
        try {
            if(empty(trim($data['nome'] ?? ''))) {
                throw new Exception('O campo Nome é obrigatório.');
            }
                
            if(empty($data['categoria_id'])) {
                throw new Exception('O campo Categoria é obrigatório.');
            }

            if(!isset($data['preco']) || $data['preco'] <= 0) {
                throw new Exception('O campo Preço é obrigatório e deve ser maior que 0.');
            }

            if(empty(trim($data['sku'] ?? ''))) {
                throw new Exception('O campo SKU é obrigatório.');
            }

            if($this->repository->findBySku($data['sku'])) {
                throw new Exception('Já existe um produto com esse SKU.');
            }

            if(!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                throw new Exception('A foto do produto é obrigatória.');
            }

            $file = $_FILES['foto'];

            if($file['size'] > 5 * 1024 * 1024) {
                throw new Exception('A imagem não pode ultrapassar 5MB.');
            }

            $mime = mime_content_type($file['tmp_name']);

            if(!in_array($mime, ['image/jpeg', 'image/png'])) {
                throw new Exception('Formato de imagem inválido. Use apenas JPG ou PNG.');
            }

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid('produto_') . ".{$ext}";
            $destino = __DIR__ . "/../../../public/assets/img/{$filename}";

            if(!move_uploaded_file($file['tmp_name'], $destino)) {
                throw new Exception('Erro ao salvar a imagem do produto.');
            }

            $data['foto'] = $filename;

            if(!empty($data['data_vencimento'])) {
                $hoje = date('Y-m-d');

                if($data['data_vencimento'] < $hoje) {
                    throw new Exception('A data de vencimento não pode ser retroativa.');
                }
            }

            $produto = new Produto(
                null,
                $data['sku'],
                $data['nome'],
                $data['descricao'] ?? null,
                (float)$data['preco'],
                $data['foto'],
                $data['data_vencimento'] ?? null,
                date('Y-m-d H:i:s'),
                date('Y-m-d H:i:s'),
                (int)$data['categoria_id']
            );

            return $this->repository->save($produto);
        } 
        catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

}