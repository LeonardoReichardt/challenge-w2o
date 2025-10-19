<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Editar Produto</h2>

<form method="POST" action="<?= $basePath ?>/produtos/update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $produto->getId() ?>">

    <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" class="form-control" value="<?= htmlspecialchars($produto->getSku()) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($produto->getNome()) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Descrição</label>
        <textarea name="descricao" class="form-control"><?= htmlspecialchars($produto->getDescricao()) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Preço</label>
        <input type="number" step="0.01" name="preco" class="form-control" value="<?= $produto->getPreco() ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Categoria</label>
        <select name="categoria_id" class="form-select" required>
            <?php foreach($categorias as $categoria): ?>
                <option value="<?= $categoria->getId() ?>" <?= $categoria->getId() == $produto->getCategoriaId() ? 'selected' : '' ?>>
                    <?= htmlspecialchars($categoria->getNome()) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Data de Vencimento</label>
        <input type="date" name="data_vencimento" class="form-control" value="<?= $produto->getDataVencimento() ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Foto</label><br>
        <?php if ($produto->getFoto()): ?>
            <img src="<?= $basePath ?>/assets/img/<?= $produto->getFoto() ?>" width="100"><br><br>
        <?php endif; ?>
        <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png">
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="<?= $basePath ?>/produtos" class="btn btn-secondary">Voltar</a>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>