<?php

namespace App\Repositories;

use App\Core\Database;
use App\Entities\Categoria;
use PDO;

class CategoriaRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll(): array {
        $stmt = $this->db->query('SELECT * 
                                    FROM categorias
                                ORDER BY nome ASC');

        $categorias = [];

        while($row = $stmt->fetch()) {
            $categorias[] = new Categoria($row['id'], $row['nome']);
        }

        return $categorias;
    }

    public function findById(int $id): ?Categoria {
        $stmt = $this->db->prepare('SELECT *
                                      FROM categorias
                                     WHERE id = ?');

        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? new Categoria($row['id'], $row['nome']) : null;
    }

    public function save(Categoria $categoria): bool {
        if($categoria->getId()) {
            $stmt = $this->db->prepare('UPDATE categorias 
                                           SET nome = ?
                                         WHERE id = ?');

            return $stmt->execute([$categoria->getNome(), $categoria->getId()]);
        } 
        else {
            $stmt = $this->db->prepare('INSERT INTO categorias (nome)
                                             VALUES (?)');

            return $stmt->execute([$categoria->getNome()]);
        }
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare('DELETE 
                                      FROM categorias
                                     WHERE id = ?');

        return $stmt->execute([$id]);
    }

}