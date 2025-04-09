<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>




<div class="container mt-5">
    <h2 class="text-center mb-4">Alunos</h2>
    
    <!-- Formulário de busca -->
   <form method="GET" action="index.php" class="mb-3 d-flex">
    <input type="hidden" name="controller" value="aluno">
    <input type="hidden" name="action" value="listar">
    <input type="text" name="search" class="form-control me-2" placeholder="Buscar aluno pelo nome">
    <button type="submit" class="btn btn-secondary">Buscar</button>
</form>

    
    <a href="?controller=aluno&action=criar" class="btn btn-primary mb-3">Novo Aluno</a>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($alunos)): ?>
                <?php foreach ($alunos as $aluno): ?>
                    <tr>
                        <td><?= htmlspecialchars($aluno['id_aluno']) ?></td>
                        <td><?= htmlspecialchars($aluno['nome']) ?></td>
                        <td><?= htmlspecialchars($aluno['cpf']) ?></td>
                        <td><?= htmlspecialchars($aluno['data_nascimento']) ?></td>
                        <td>
                            <a href="?controller=aluno&action=criar&id=<?= htmlspecialchars($aluno['id_aluno']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?controller=aluno&action=deletar&id=<?= htmlspecialchars($aluno['id_aluno']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhum aluno encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
