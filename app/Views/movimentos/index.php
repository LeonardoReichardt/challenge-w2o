<?php require __DIR__ . '/../layout/header.php'; ?>

<h2>Movimentos de Estoque</h2>

<div class="row mb-4">
    <div class="col-md-6">
        <h4>Entrada de Produto</h4>
        <form method="POST" action="/estoque/entrada">
            <div class="mb-3">
                <label class="form-label">Produto</label>
                <select name="produto_id" class="form-select" required>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto->getId() ?>"><?= htmlspecialchars($produto->getNome()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Usuário</label>
                <input type="text" name="usuario" class="form-control" value="Sistema" required>
            </div>
            <button type="submit" class="btn btn-success">Registrar Entrada</button>
        </form>
    </div>

    <div class="col-md-6">
        <h4>Saída de Produto</h4>
        <form method="POST" action="/estoque/saida">
            <div class="mb-3">
                <label class="form-label">Produto</label>
                <select name="produto_id" class="form-select" required>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto->getId() ?>"><?= htmlspecialchars($produto->getNome()) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Usuário</label>
                <input type="text" name="usuario" class="form-control" value="Sistema" required>
            </div>
            <button type="submit" class="btn btn-danger">Registrar Saída</button>
        </form>
    </div>
</div>

<h4>Histórico de Movimentos</h4>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>Tipo</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Usuário</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movimentos as $mov): ?>
            <tr>
                <td><?= $mov->getId() ?></td>
                <td><?= $mov->getProdutoId() ?></td>
                <td>
                    <span class="badge bg-<?= $mov->getTipo() === 'entrada' ? 'success' : 'danger' ?>">
                        <?= ucfirst($mov->getTipo()) ?>
                    </span>
                </td>
                <td><?= $mov->getQuantidade() ?></td>
                <td><?= date("d/m/Y H:i", strtotime($mov->getDataMovimento())) ?></td>
                <td><?= htmlspecialchars($mov->getUsuario()) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . '/../layout/footer.php'; ?>