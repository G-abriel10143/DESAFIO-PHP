<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Menu Superior -->
<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>


<div class="container mt-5">
    <h2 class="text-center mb-4">Turmas</h2>
    <a href="?controller=turma&action=criar" class="btn btn-primary mb-2">Nova Turma</a>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade de Alunos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($turmas as $turma): ?>
                <tr>
                    <td><?= htmlspecialchars($turma['id_turma']) ?></td>
                    <td><?= htmlspecialchars($turma['nome']) ?></td>
                    <td><?= htmlspecialchars($turma['descricao']) ?></td>
                    <td><?= htmlspecialchars($turma['quantidade_alunos']) ?></td>
                    <td>
                        <a href="?controller=turma&action=criar&id=<?= htmlspecialchars($turma['id_turma']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="?controller=turma&action=deletar&id=<?= htmlspecialchars($turma['id_turma']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
