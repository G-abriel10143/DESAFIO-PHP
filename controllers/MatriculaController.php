<?php

require_once 'models/Matricula.php';
require_once 'models/Aluno.php';
require_once 'models/Turma.php';

class MatriculaController {

    // Listar todas as matrículas
    public function listar() {
        try {
            $turma = $_GET['turma'] ?? null;
            $search = $_GET['search'] ?? null;

            $matriculas = Matricula::listar($turma, $search);
            $turmas = Turma::listar(); // Lista de turmas para filtro
            $erro = null; // Sem erros no início

            include 'views/matricula/index.php';
        } catch (Exception $e) {
            $erro = $e->getMessage(); // Captura o erro
            include 'views/matricula/index.php';
        }
    }

    // Inserir nova matrícula
    public function inserir() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $id_aluno = $_POST['id_aluno'];
                $id_turma = $_POST['id_turma'];

                Matricula::inserir($id_aluno, $id_turma);
                header('Location: index.php?controller=matricula&action=listar');
                exit();
            } catch (Exception $e) {
                $erro = $e->getMessage(); // Captura o erro
                $alunos = Aluno::listar();
                $turmas = Turma::listar();
                include 'views/matricula/form.php';
            }
        }
    }

    // Deletar matrícula
    public function deletar($id) {
        try {
            Matricula::deletar($id);
            header('Location: index.php?controller=matricula&action=listar');
            exit();
        } catch (Exception $e) {
            $erro = $e->getMessage(); // Captura o erro
            $this->listar(); // Recarrega a lista com o erro
        }
    }
}

?>
