<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="text-center py-5">
    <h1 class="mb-4">📦 Sistema de Gerenciamento de Estoque</h1>
    <p class="lead">Controle seus produtos, categorias, movimentações e relatórios de forma simples e eficiente.</p>

    <div class="row mt-5">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📋 Produtos</h5>
                    <p class="card-text">Gerencie o cadastro de produtos, preços, fotos e categorias.</p>
                    <a href="<?= $basePath ?>/produtos" class="btn btn-primary">Acessar Produtos</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🏷️ Categorias</h5>
                    <p class="card-text">Organize seus produtos em categorias para facilitar a gestão.</p>
                    <a href="<?= $basePath ?>/categorias" class="btn btn-success">Acessar Categorias</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📈 Movimentações</h5>
                    <p class="card-text">Controle entradas e saídas de produtos e acompanhe o estoque.</p>
                    <a href="<?= $basePath ?>/estoque" class="btn btn-warning">Acessar Movimentos</a>
                </div>
            </div>
        </div>
    </div>

    <h3 class="mt-5">📊 Relatórios</h3>
    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">📦 Estoque Atual</h5>
                    <p class="card-text">Visualize a quantidade em estoque de cada produto.</p>
                    <a href="<?= $basePath ?>/relatorios/estoque" class="btn btn-outline-primary">Ver Estoque Atual</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">🏆 Ranking de Vendas</h5>
                    <p class="card-text">Confira os 10 produtos mais vendidos no sistema.</p>
                    <a href="<?= $basePath ?>/relatorios/ranking" class="btn btn-outline-success">Ver Ranking</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>