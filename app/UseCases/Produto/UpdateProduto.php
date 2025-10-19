<?php

namespace App\UseCases\Produto;

use App\Repositories\ProdutoRepository;
use Exception;

class UpdateProduto {

    private ProdutoRepository $repository;

    public function __construct() {
        $this->repository = new ProdutoRepository();
    }

    public function execute(int $id, array $data): bool {
        try {
            $produto = $this->repository->findById($id);

            if(!$produto) {
                throw new Exception('Produto não encontrado.');
            }

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

            $produtoExistente = $this->repository->findBySku($data['sku']);

            if($produtoExistente && $produtoExistente->getId() !== $id) {
                throw new Exception('Já existe um produto cadastrado com esse SKU.');
            }

            if(isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['foto'];

                if($file['size'] > 5 * 1024 * 1024) {
                    throw new Exception('O tamanho da imagem não pode ultrapassar 5MB.');
                }

                $mime = mime_content_type($file['tmp_name']);

                if(!in_array($mime, ['image/jpeg', 'image/png'])) {
                    throw new Exception('O formato de imagem deve ser JPG ou PNG.');
                }

                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = uniqid('produto_') . ".{$ext}";
                $destino = __DIR__ . "/../../../public/assets/img/{$filename}";

                if(!move_uploaded_file($file['tmp_name'], $destino)) {
                    throw new Exception('Erro ao salvar a imagem do produto.');
                }

                $data['foto'] = $filename;
            } 
            else {
                $data['foto'] = $produto->getFoto();
            }

            if(!empty($data['data_vencimento'])) {
                $hoje = date('Y-m-d');

                if($data['data_vencimento'] < $hoje) {
                    throw new Exception('A data de vencimento não pode ser retroativa.');
                }
            }

            $produto->setSku($data['sku']);
            $produto->setNome($data['nome']);
            $produto->setDescricao($data['descricao'] ?? null);
            $produto->setPreco((float)$data['preco']);
            $produto->setFoto($data['foto']);
            $produto->setDataVencimento($data['data_vencimento'] ?? null);
            $produto->setCategoriaId((int)$data['categoria_id']);
            $produto->setDataEdicao(date('Y-m-d H:i:s'));

            return $this->repository->save($produto);
        } 
        catch(Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }

}