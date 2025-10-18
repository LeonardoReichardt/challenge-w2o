<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Nova Categoria</h2>

<form method="POST" action="/categorias/store">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="/categorias" class="btn btn-secondary">Voltar</a>
</form>

<?php require __DIR__ . '/../layout/footer.php'; ?>