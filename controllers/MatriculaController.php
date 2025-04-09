<?php

require_once 'models/Matricula.php';
require_once 'models/Aluno.php';
require_once 'models/Turma.php';

class MatriculaController {

    // Listar todas as matrículas
    public function listar() {
        $matriculas = Matricula::listar();
        $turmas = Turma::listar(); // Adiciona turmas para filtro
        include 'views/matricula/index.php';
    }

    // Listar alunos por turma
    public function listarPorTurma($id_turma) {
        $alunosMatriculados = Matricula::listarPorTurma($id_turma);
        $turma = Turma::buscarPorId($id_turma);
        include 'views/matricula/alunos_por_turma.php';
    }

    // Exibir o formulário de matrícula
    public function criar() {
        $alunos = Aluno::listar();
        $turmas = Turma::listar();
        include 'views/matricula/form.php';
    }

    // Inserir nova matrícula
    public function inserir() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluno = $_POST['id_aluno'];
            $id_turma = $_POST['id_turma'];

            try {
                Matricula::inserir($id_aluno, $id_turma);
                header('Location: index.php?controller=matricula&action=listar');
            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
            }
        }
    }

    // Deletar matrícula
    public function deletar($id) {
        Matricula::deletar($id);
        header('Location: index.php?controller=matricula&action=listar');
    }
}

?>
