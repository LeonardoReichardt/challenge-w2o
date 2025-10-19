<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Editar Categoria</h2>

<form method="POST" action="<?= $basePath ?>/categorias/update">
    <input type="hidden" name="id" value="<?= $categoria->getId() ?>">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($categoria->getNome()) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Atualizar</button>
    <a href="<?= $basePath ?>/categorias" class="btn btn-secondary">Voltar</a>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>