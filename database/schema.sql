-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS challenge_w2o
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

USE challenge_w2o;

-- ==============================
-- TABELA: categorias
-- ==============================
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- ==============================
-- TABELA: produtos
-- ==============================
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sku VARCHAR(50) NOT NULL UNIQUE,
    nome VARCHAR(150) NOT NULL,
    descricao TEXT NULL,
    preco DECIMAL(10,2) NOT NULL CHECK (preco > 0),
    foto VARCHAR(255) NULL,
    data_vencimento DATE NULL,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_edicao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    categoria_id INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ==============================
-- TABELA: movimentos_estoque
-- ==============================
CREATE TABLE movimentos_estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produto_id INT NOT NULL,
    tipo ENUM('entrada', 'saida') NOT NULL,
    quantidade INT NOT NULL CHECK (quantidade > 0),
    usuario VARCHAR(100) NOT NULL,
    data_movimento DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produto_id) REFERENCES produtos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ==============================
-- VIEW: Estoque atual
-- ==============================
CREATE OR REPLACE VIEW vw_estoque_atual AS
                SELECT produtos.id AS produto_id,
                       produtos.nome,
                       produtos.sku,
                       produtos.preco,
                       categorias.nome AS categoria,
                       COALESCE(SUM(CASE WHEN movimentos_estoque.tipo = 'entrada' THEN movimentos_estoque.quantidade ELSE 0 END), 0) -
                       COALESCE(SUM(CASE WHEN movimentos_estoque.tipo = 'saida' THEN movimentos_estoque.quantidade ELSE 0 END), 0) AS quantidade_em_estoque
                  FROM produtos
             LEFT JOIN categorias 
                    ON categorias.id = produtos.categoria_id
             LEFT JOIN movimentos_estoque
                    ON movimentos_estoque.produto_id = produtos.id
              GROUP BY produtos.id, 
                       produtos.nome, 
                       produtos.sku, 
                       produtos.preco, 
                       categorias.nome;

-- ==============================
-- VIEW: Ranking 10 Produtos Mais Saídas
-- ==============================
CREATE OR REPLACE VIEW vw_ranking_produtos_mais_saidas AS
                SELECT produtos.id AS produto_id,
                       produtos.nome,
                       SUM(movimentos_estoque.quantidade) AS total_saidas
                  FROM produtos
            INNER JOIN movimentos_estoque
                    ON produtos.id = movimentos_estoque.produto_id
                 WHERE movimentos_estoque.tipo = 'saida'
              GROUP BY produtos.id,
                       produtos.nome
              ORDER BY total_saidas DESC
                 LIMIT 10;