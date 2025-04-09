<?php

require_once __DIR__ . '/../models/Aluno.php';

class AlunoController {
    public function __construct() {
        session_start();
        if (empty($_SESSION['admin_logado'])) {
            header('Location: index.php?controller=login&action=exibir');
            exit;
        }
    }
    // Listar todos os alunos
    public function listar() {
        $search = $_GET['search'] ?? ''; // Obtém o termo de busca
    
        if (trim($search) === '') {
            // Quando não houver termo de busca, lista todos os alunos
            $alunos = Aluno::listar();
        } else {
            // Filtra alunos pelo nome
            $alunos = Aluno::buscarPorNome($search);
        }
    
        include __DIR__ . '/../views/aluno/index.php';
    }
    
    
    // Exibir o formulário de inserção ou edição de aluno
    public function criar($id = null) {
        $aluno = null;

        if ($id) {
            // Busca o aluno pelo ID, se fornecido
            $aluno = Aluno::buscarPorId($id);
        }

        include __DIR__ . '/../views/aluno/form.php';
    }

    // Inserir um novo aluno
    public function inserir() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $dataNascimento = $_POST['data_nascimento'];
    
                // Chama o método de inserção com validação no Model
                Aluno::inserir($nome, $cpf, $dataNascimento);
    
                header('Location: index.php?controller=aluno&action=listar');
            }
        } catch (Exception $e) {
            // Exibe mensagem de erro em caso de exceção
            echo "<div class='alert alert-danger'>{$e->getMessage()}</div>";
            include __DIR__ . '/../views/aluno/form.php';
        }
    }
    

    // Atualizar os dados de um aluno
    public function atualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluno = $_POST['id_aluno'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $dataNascimento = $_POST['data_nascimento'];

            Aluno::editar($id_aluno, $nome, $cpf, $dataNascimento);
            header('Location: index.php?controller=aluno&action=listar');
        }
    }

    // Deletar um aluno
    public function deletar($id) {
        Aluno::deletar($id);
        header('Location: index.php?controller=aluno&action=listar');
    }
}

?>
