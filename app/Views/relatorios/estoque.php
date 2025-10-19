<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="mb-3">
    <h2>Relatório - Estoque Atual</h2>
    <hr class="text-muted">

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Quantidade em Estoque</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($estoque as $item): ?>
                <tr>
                    <td><?= $item['produto_id'] ?></td>
                    <td><?= htmlspecialchars($item['sku']) ?></td>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td><?= htmlspecialchars($item['categoria']) ?></td>
                    <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                    <td><?= $item['quantidade_em_estoque'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>