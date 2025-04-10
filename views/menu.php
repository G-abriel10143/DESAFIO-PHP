<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        
        <a class="navbar-brand" >
            <img src="https://media.licdn.com/dms/image/v2/C4D0BAQFGUHRJ26bFDw/company-logo_200_200/company-logo_200_200/0/1631312349936?e=2147483647&v=beta&t=2cxZo7IPlpqVmRsvk_tS2TYDHSqh8Q3SlFYcLW9nlVc" alt="FIAP Logo" height="40">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=matricula&action=listar">Matrículas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=aluno&action=listar">Alunos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=turma&action=listar">Turmas</a>
                </li>
            </ul>
            <!-- Botão de sair -->
            <form method="POST" action="?controller=login&action=logout" class="ms-auto">
                <button type="submit" class="btn btn-danger">Sair</button>
            </form>
        </div>
    </div>
</nav>
