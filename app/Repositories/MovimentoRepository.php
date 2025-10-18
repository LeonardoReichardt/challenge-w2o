<?php

namespace App\Repositories;

use App\Core\Database;
use App\Entities\MovimentoEstoque;
use PDO;

class MovimentoRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->query('SELECT * 
                                    FROM movimentos_estoque 
                                ORDER BY data_movimento DESC');
        
        $movimentos = [];

        while($row = $stmt->fetch()) {
            $movimentos[] = new MovimentoEstoque(
                $row['id'],
                $row['produto_id'],
                $row['tipo'],
                $row['quantidade'],
                $row['data_movimento'],
                $row['usuario']
            );
        }

        return $movimentos;
    }

    public function findById(int $id): ?MovimentoEstoque {
        $stmt = $this->db->prepare('SELECT * 
                                      FROM movimentos_estoque
                                     WHERE id = ?');

        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ? new MovimentoEstoque(
            $row['id'],
            $row['produto_id'],
            $row['tipo'],
            $row['quantidade'],
            $row['data_movimento'],
            $row['usuario']
        ) : null;
    }

    public function save(MovimentoEstoque $movimento): bool {
        $stmt = $this->db->prepare('INSERT INTO movimentos_estoque (produto_id, tipo, quantidade, data_movimento, usuario) 
                                         VALUES (?, ?, ?, NOW(), ?)');

        return $stmt->execute([
            $movimento->getProdutoId(),
            $movimento->getTipo(),
            $movimento->getQuantidade(),
            $movimento->getUsuario()
        ]);
    }

}