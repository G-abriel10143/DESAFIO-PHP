<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($aluno) ? 'Editar Aluno' : 'Novo Aluno' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Menu Superior -->
<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>


<div class="container mt-5">
    <h2 class="text-center mb-4"><?= isset($aluno) ? 'Editar Aluno' : 'Novo Aluno' ?></h2>

    <form method="POST" action="?controller=aluno&action=<?= isset($aluno) ? 'atualizar' : 'inserir' ?>" class="shadow p-4 bg-white rounded">
        <input type="hidden" name="id_aluno" value="<?= $aluno['id_aluno'] ?? '' ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= $aluno['nome'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" id="cpf" name="cpf" class="form-control" value="<?= $aluno['cpf'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?= $aluno['data_nascimento'] ?? '' ?>" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Salvar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
