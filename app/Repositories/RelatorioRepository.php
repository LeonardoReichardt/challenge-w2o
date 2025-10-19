<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

class RelatorioRepository {

    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getEstoqueAtual(): array {
        $stmt = $this->db->query('SELECT * FROM vw_estoque_atual ORDER BY nome ASC');
        return $stmt->fetchAll();
    }

    public function getRankingProdutosMaisSaidas(): array {
        $stmt = $this->db->query('SELECT * FROM vw_ranking_produtos_mais_saidas');
        return $stmt->fetchAll();
    }

}