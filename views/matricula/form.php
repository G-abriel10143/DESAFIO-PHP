<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($matricula) ? 'Editar Matrícula' : 'Nova Matrícula' ?></title>
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
    <h2 class="text-center mb-4"><?= isset($matricula) ? 'Editar Matrícula' : 'Nova Matrícula' ?></h2>

    <form method="POST"  action="?controller=matricula&action=inserir" class="shadow p-4 bg-white rounded">
        <input type="hidden" name="id_matricula" value="<?= $matricula['id_matricula'] ?? '' ?>">

        <div class="mb-3">
            <label for="id_aluno" class="form-label">Aluno</label>
            <select id="id_aluno" name="id_aluno" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id_aluno'] ?>" <?= isset($matricula) && $matricula['id_aluno'] == $aluno['id_aluno'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($aluno['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_turma" class="form-label">Turma</label>
            <select id="id_turma" name="id_turma" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($turmas as $turma): ?>
                    <option value="<?= $turma['id_turma'] ?>" <?= isset($matricula) && $matricula['id_turma'] == $turma['id_turma'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($turma['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Salvar Matrícula</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
