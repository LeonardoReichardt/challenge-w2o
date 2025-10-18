<?php

namespace App\Repositories;

use App\Core\Database;
use App\Entities\Produto;
use PDO;

class ProdutoRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->query('SELECT * 
                                    FROM produtos
                                ORDER BY nome ASC');

        $produtos = [];

        while($row = $stmt->fetch()) {
            $produtos[] = new Produto(
                $row['id'],
                $row['sku'],
                $row['nome'],
                $row['descricao'],
                $row['preco'],
                $row['foto'],
                $row['data_vencimento'],
                $row['data_cadastro'],
                $row['data_edicao'],
                $row['categoria_id']
            );
        }

        return $produtos;
    }

    public function findById(int $id): ?Produto {
        $stmt = $this->db->prepare('SELECT * 
                                      FROM produtos
                                     WHERE id = ?');

        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? new Produto(
            $row['id'],
            $row['sku'],
            $row['nome'],
            $row['descricao'],
            $row['preco'],
            $row['foto'],
            $row['data_vencimento'],
            $row['data_cadastro'],
            $row['data_edicao'],
            $row['categoria_id']
        ) : null;
    }

    public function findBySku(string $sku): ?Produto {
        $stmt = $this->db->prepare('SELECT * 
                                      FROM produtos
                                     WHERE sku = ?');
        
        $stmt->execute([$sku]);
        $row = $stmt->fetch();

        return $row ? new Produto(
            $row['id'],
            $row['sku'],
            $row['nome'],
            $row['descricao'],
            $row['preco'],
            $row['foto'],
            $row['data_vencimento'],
            $row['data_cadastro'],
            $row['data_edicao'],
            $row['categoria_id']
        ) : null;
    }

    public function save(Produto $produto): bool {
        if($produto->getId()) {
            $stmt = $this->db->prepare('UPDATE produtos 
                                           SET sku = ?, nome = ?, descricao = ?, preco = ?, foto = ?, data_vencimento = ?, data_edicao = NOW(), categoria_id = ?
                                         WHERE id = ?');

            return $stmt->execute([
                $produto->getSku(),
                $produto->getNome(),
                $produto->getDescricao(),
                $produto->getPreco(),
                $produto->getFoto(),
                $produto->getDataVencimento(),
                $produto->getCategoriaId(),
                $produto->getId()
            ]);
        } 
        else {
            $stmt = $this->db->prepare('INSERT INTO produtos (sku, nome, descricao, preco, foto, data_vencimento, data_cadastro, data_edicao, categoria_id) 
                                             VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)');

            return $stmt->execute([
                $produto->getSku(),
                $produto->getNome(),
                $produto->getDescricao(),
                $produto->getPreco(),
                $produto->getFoto(),
                $produto->getDataVencimento(),
                $produto->getCategoriaId()
            ]);
        }
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE
                                      FROM produtos 
                                     WHERE id = ?');

        return $stmt->execute([$id]);
    }

}