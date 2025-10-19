<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="mb-3">
    <h2>Nova Categoria</h2>
    <hr class="text-muted">

    <form method="POST" action="<?= $basePath ?>/categorias/store">
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        
        <hr class="text-muted">
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= $basePath ?>/categorias" class="btn btn-secondary">Voltar</a>
    </form>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>