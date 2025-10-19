<?php

$config = require __DIR__ . '/../../../config/config.php';
$basePath = $config['base_path'];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="<?= $basePath ?>/">Estoque</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/produtos">Produtos</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/categorias">Categorias</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>/estoque">Movimentos</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">