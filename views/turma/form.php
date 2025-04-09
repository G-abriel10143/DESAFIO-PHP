<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($turma) ? 'Editar Turma' : 'Nova Turma' ?></title>
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
    <h2 class="text-center mb-4"><?= isset($turma) ? 'Editar Turma' : 'Nova Turma' ?></h2>

    <form method="POST" action="?controller=turma&action=<?= isset($turma) ? 'atualizar' : 'inserir' ?>" class="shadow p-4 bg-white rounded">
        <input type="hidden" name="id_turma" value="<?= $turma['id_turma'] ?? '' ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= $turma['nome'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="4" required><?= $turma['descricao'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Salvar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
