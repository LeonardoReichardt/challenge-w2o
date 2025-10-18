<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categorias</h2>
    <a href="/categorias/create" class="btn btn-primary">Nova Categoria</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categorias as $categoria): ?>
            <tr>
                <td><?= $categoria->getId() ?></td>
                <td><?= htmlspecialchars($categoria->getNome()) ?></td>
                <td>
                    <a href="/categorias/edit?id=<?= $categoria->getId() ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="/categorias/delete" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $categoria->getId() ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir categoria?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>