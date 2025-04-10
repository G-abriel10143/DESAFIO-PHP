<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Administradores</h2>

    <!-- Mensagem de sucesso, se houver -->
    <?php if (!empty($sucesso)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($sucesso) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Botão para criar novo administrador -->
    <div class="mb-3 text-end">
        <a href="index.php?controller=admin&action=criar" class="btn btn-primary">Novo Administrador</a>
    </div>

    <!-- Tabela de administradores -->
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($administradores)): ?>
                <?php foreach ($administradores as $admin): ?>
                    <tr>
                        <td><?= htmlspecialchars($admin['id_admin']) ?></td>
                        <td><?= htmlspecialchars($admin['email']) ?></td>
                        <td>
                            <a href="index.php?controller=admin&action=editar&id=<?= htmlspecialchars($admin['id_admin']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Nenhum administrador encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>