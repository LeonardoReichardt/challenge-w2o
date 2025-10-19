<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Produtos</h2>
    <a href="<?= $basePath ?>/produtos/create" class="btn btn-primary">Novo Produto</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>SKU</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Foto</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($produtos as $produto): ?>
            <tr>
                <td><?= $produto->getId() ?></td>
                <td><?= htmlspecialchars($produto->getSku()) ?></td>
                <td><?= htmlspecialchars($produto->getNome()) ?></td>
                <td>R$ <?= number_format($produto->getPreco(), 2, ',', '.') ?></td>
                <td><?= $produto->getCategoriaId() ?></td>
                <td>
                    <?php if($produto->getFoto()): ?>
                        <img src="<?= $basePath ?>/assets/img/<?= $produto->getFoto() ?>" width="50">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= $basePath ?>/produtos/edit?id=<?= $produto->getId() ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="<?= $basePath ?>/produtos/delete" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $produto->getId() ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir produto?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>