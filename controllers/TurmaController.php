<?php

require_once 'models/Turma.php';

class TurmaController {

    // Listar todas as turmas
    public function listar() {
        $turmas = Turma::listar();
        include 'views/turma/index.php';
    }

    // Exibir o formulário para criar ou editar uma turma
    public function criar($id = null) {
        $turma = null;

        if ($id) {
            $turma = Turma::buscarPorId($id); // Busca os dados da turma pelo ID (para edição)
        }

        include 'views/turma/form.php';
    }

    // Inserir uma nova turma
    public function inserir() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'];
                $descricao = $_POST['descricao'];
    
                // Inserir a turma com validação no Model
                Turma::inserir($nome, $descricao);
                header('Location: index.php?controller=turma&action=listar');
            }
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
            include 'views/turmas_form.php';
        }
    }
    

    // Atualizar os dados de uma turma existente
    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_turma = $_POST['id_turma'];
            $nomeTurma = $_POST['nome'];
            $descricao = $_POST['descricao'];

            Turma::editar($id_turma, $nomeTurma, $descricao);
            header('Location: index.php?controller=turma&action=listar');
        }
    }

    // Deletar uma turma
    public function deletar($id) {
        Turma::deletar($id);
        header('Location: index.php?controller=turma&action=listar');
    }
}

?>
