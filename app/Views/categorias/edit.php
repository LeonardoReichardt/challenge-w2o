<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="mb-3">
    <h2>Editar Categoria</h2>
    <hr class="text-muted">

    <form method="POST" action="<?= $basePath ?>/categorias/update">
        <input type="hidden" name="id" value="<?= $categoria->getId() ?>">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($categoria->getNome()) ?>" required>
        </div>
        
        <hr class="text-muted">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="<?= $basePath ?>/categorias" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>