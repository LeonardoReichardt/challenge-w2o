<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;

$router = new Router();

$router->get('/', function() {
    echo "<h1>Sistema de Gerenciamento de Estoque</h1>";
    echo "<p>Bem-vindo! 🚀</p>";
    echo "<a href='/produtos'>Ver produtos</a>";
});

#region Rotas de Produtos

$router->get('/produtos', ['ProdutoController', 'index']);
$router->get('/produtos/create', ['ProdutoController', 'create']);
$router->post('/produtos/store', ['ProdutoController', 'store']);
$router->get('/produtos/edit', ['ProdutoController', 'edit']);
$router->post('/produtos/update', ['ProdutoController', 'update']);
$router->post('/produtos/delete', ['ProdutoController', 'delete']);

#endregion

#region Rotas de Categorias

$router->get('/categorias', ['CategoriaController', 'index']);
$router->get('/categorias/create', ['CategoriaController', 'create']);
$router->post('/categorias/store', ['CategoriaController', 'store']);
$router->get('/categorias/edit', ['CategoriaController', 'edit']); 
$router->post('/categorias/update', ['CategoriaController', 'update']);
$router->post('/categorias/delete', ['CategoriaController', 'delete']);

#endregion

#region Rotas de Movimentação de Estoque

$router->get('/estoque', ['MovimentoController', 'index']);
$router->post('/estoque/entrada', ['MovimentoController', 'entrada']);
$router->post('/estoque/saida', ['MovimentoController', 'saida']);

#endregion

#region Relatórios

$router->get('/relatorios/estoque', ['RelatorioController', 'estoqueAtual']);
$router->get('/relatorios/ranking', ['RelatorioController', 'rankingProdutos']);

#endregion

$uri = strtok($_SERVER["REQUEST_URI"], '?');
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);