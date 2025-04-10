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
<?php if (!empty($erro)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($erro) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Menu Superior -->
<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Matrículas</h2>

    <!-- Filtro por turma e busca -->
    <form method="GET" action="index.php" class="mb-3 d-flex align-items-center">
    <input type="hidden" name="controller" value="matricula">
    <input type="hidden" name="action" value="listar">

    <!-- Filtro por turma -->
    <select name="turma" class="form-select me-2" style="max-width: 200px;">
        <option value="">Filtrar por turma</option>
        <?php foreach ($turmas as $turma): ?>
            <option value="<?= htmlspecialchars($turma['id_turma']) ?>" <?= isset($_GET['turma']) && $_GET['turma'] == $turma['id_turma'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($turma['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <!-- Campo de busca -->
    <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Buscar por aluno ou turma" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" style="max-width: 250px;">

    <!-- Botão de busca -->
    <button type="submit" class="btn btn-secondary btn-sm">Filtrar</button>
</form>
<div class="d-flex justify-content-between mb-3">
        <a href="?controller=matricula&action=criar" class="btn btn-primary">Nova Matrícula</a>
    </div>
    <!-- Tabela de matrículas -->
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>RA</th>
                <th>Aluno</th>
                <th>Turma</th>
                <th>Data Matrícula</th>
                
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($matriculas)): ?>
            <?php foreach ($matriculas as $matricula): ?>
                <tr>
                    <td><?= htmlspecialchars($matricula['id_matricula']) ?></td>
                    <td><?= htmlspecialchars($matricula['aluno_nome']) ?></td>
                    <td><?= htmlspecialchars($matricula['turma_nome']) ?></td>
                    <td><?= date('d-m-Y', strtotime($matricula['data_matricula'])) ?></td>
                    
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
