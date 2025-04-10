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
    <h2 class="text-center mb-4">Nova Matrícula</h2>
 <!-- Botão de voltar -->
 <div class="mb-3">
        <a href="?controller=aluno&action=listar" class="btn btn-secondary">Voltar</a>
    </div>
    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($erro) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="?controller=matricula&action=inserir" class="shadow p-4 bg-white rounded">
        <div class="mb-3">
            <label for="id_aluno" class="form-label">Aluno</label>
            <select id="id_aluno" name="id_aluno" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($alunos as $aluno): ?>
                    <option value="<?= $aluno['id_aluno'] ?>"><?= htmlspecialchars($aluno['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_turma" class="form-label">Turma</label>
            <select id="id_turma" name="id_turma" class="form-select" required>
                <option value="">Selecione</option>
                <?php foreach ($turmas as $turma): ?>
                    <option value="<?= $turma['id_turma'] ?>"><?= htmlspecialchars($turma['nome']) ?></option>
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
