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

    <form method="POST" action="?controller=turma&action=<?= isset($turma) ? 'editar&id=' . htmlspecialchars($turma['id_turma']) : 'inserir' ?>" class="shadow p-4 bg-white rounded">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($turma['nome'] ?? '') ?>" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control" rows="3" required><?= htmlspecialchars($turma['descricao'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100"><?= isset($turma) ? 'Atualizar Turma' : 'Salvar Turma' ?></button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
