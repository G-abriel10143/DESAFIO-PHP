<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrículas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Menu Superior -->
<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Matrículas</h2>

    <!-- Botões de ação -->
    <div class="d-flex justify-content-between mb-3">
        <a href="?controller=matricula&action=criar" class="btn btn-primary">Nova Matrícula</a>
    </div>

    <!-- Tabela de matrículas -->
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID Matrícula</th>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Data Matrícula</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($matriculas)): ?>
            <?php foreach ($matriculas as $matricula): ?>
                <tr>
                    <td><?= htmlspecialchars($matricula['id_matricula']) ?></td>
                    <td><?= htmlspecialchars($matricula['aluno_nome']) ?></td>
                    <td><?= htmlspecialchars($matricula['turma_nome']) ?></td>
                    <td><?= htmlspecialchars($matricula['data_matricula']) ?></td>
                    <td>
                        <a href="?controller=matricula&action=deletar&id=<?= htmlspecialchars($matricula['id_matricula']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Cancelar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">Nenhuma matrícula encontrada.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
