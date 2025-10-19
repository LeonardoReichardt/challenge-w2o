<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="mb-3">
    <h2>Novo Produto</h2>
    <hr class="text-muted">
    
    <form method="POST" action="<?= $basePath ?>/produtos/store" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">SKU</label>
            <input type="text" name="sku" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Preço</label>
            <input type="number" step="0.01" name="preco" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="categoria_id" class="form-select" required>
                <?php foreach($categorias as $categoria): ?>
                    <option value="<?= $categoria->getId() ?>"><?= htmlspecialchars($categoria->getNome()) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Data de Vencimento</label>
            <input type="date" name="data_vencimento" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png">
        </div>
        
        <hr class="text-muted">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= $basePath ?>/produtos" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>