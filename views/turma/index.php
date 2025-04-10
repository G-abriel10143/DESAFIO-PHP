<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Menu Superior -->
<?php
// Faz a inclusão do arquivo menu.php
include __DIR__ . '/../menu.php';

// Configurações de paginação
$porPagina = 10; // Quantidade de itens por página
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1; // Página atual
$totalTurmas = count($turmas); // Total de turmas
$totalPaginas = ceil($totalTurmas / $porPagina); // Calcula o número total de páginas

// Determina o índice inicial e final das turmas para exibir
$inicio = ($paginaAtual - 1) * $porPagina;
$turmasPaginadas = array_slice($turmas, $inicio, $porPagina); // Divide os resultados
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Turmas</h2>
    <a href="?controller=turma&action=criar" class="btn btn-primary mb-2">Nova Turma</a>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Turma</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade de Alunos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($turmasPaginadas)): ?>
                <?php foreach ($turmasPaginadas as $turma): ?>
                    <tr>
                        <td>Turmaº <?= htmlspecialchars($turma['id_turma']) ?></td>
                        <td><?= htmlspecialchars($turma['nome']) ?></td>
                        <td><?= htmlspecialchars($turma['descricao']) ?></td>
                        <td><?= htmlspecialchars($turma['quantidade_alunos']) ?></td>
                        <td>
                            <a href="?controller=turma&action=criar&id=<?= htmlspecialchars($turma['id_turma']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="?controller=turma&action=deletar&id=<?= htmlspecialchars($turma['id_turma']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Nenhuma turma encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Paginação -->
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $paginaAtual <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=turma&action=listar&pagina=<?= $paginaAtual - 1 ?>">Anterior</a>
            </li>
            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?= $paginaAtual == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?controller=turma&action=listar&pagina=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $paginaAtual >= $totalPaginas ? 'disabled' : '' ?>">
                <a class="page-link" href="?controller=turma&action=listar&pagina=<?= $paginaAtual + 1 ?>">Próximo</a>
            </li>
        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
