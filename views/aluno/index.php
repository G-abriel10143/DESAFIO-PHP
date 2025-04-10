<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Alunos</h2>
    
    <!-- Formulário de busca -->
    <form method="GET" action="index.php" class="mb-3 d-flex align-items-center">
        <input type="hidden" name="controller" value="aluno">
        <input type="hidden" name="action" value="listar">

        <!-- Campo de busca por CPF ou Nome -->
        <input type="text" name="search" class="form-control form-control-sm me-2" style="max-width: 300px;" placeholder="Buscar por CPF ou Nome">
        
        <!-- Botão de busca -->
        <button type="submit" class="btn btn-secondary btn-sm">Buscar</button>
    </form>

    <a href="?controller=aluno&action=criar" class="btn btn-primary mb-3">Novo Aluno</a>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>RM</th>
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
                        <td><?= date('d-m-Y', strtotime($aluno['data_nascimento'])) ?></td>
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
<script>
    // Permitir digitação mista no campo de busca e orientar o usuário
    $(document).ready(function() {
        const searchField = $('input[name="search"]');

        // Atualiza o placeholder para facilitar a busca por CPF ou nome
        searchField.attr('placeholder', "Buscar por CPF (000.000.000-00) ou Nome");

        // Remove máscara de CPF para permitir entrada de letras e números
        searchField.off();
    });
</script>
</body>
</html>
