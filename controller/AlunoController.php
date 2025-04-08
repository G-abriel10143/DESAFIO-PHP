<?php

require_once 'models/Aluno.php';

class AlunoController {

    // Listar todos os alunos
    public function listar() {
        // Chama o método 'listar' do model 'Aluno' para recuperar todos os alunos
        $alunos = Aluno::listar();
        
        // Inclui a view de listagem de alunos e passa os dados para a view
        include 'views/alunos_list.php';
    }

    // Exibir o formulário de inserção de aluno
    public function criar() {
        // Apenas inclui a view para inserir um novo aluno
        include 'views/alunos_form.php';
    }

    // Inserir um novo aluno
    public function inserir() {
        // Verifica se os dados foram enviados via POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $dataNascimento = $_POST['data_nascimento'];

            // Chama o método 'inserir' do model 'Aluno' para adicionar o novo aluno
            Aluno::inserir($nome, $cpf, $dataNascimento);
            
            // Redireciona para a listagem de alunos após a inserção
            header('Location: index.php?controller=aluno&action=listar');
        }
    }

    // Exibir o formulário para editar um aluno
    // public function editar($id) {
    //     // Recupera os dados do aluno a ser editado
    //     $aluno = Aluno::buscarPorId($id);
        
    //     // Inclui a view de edição de aluno e passa os dados para a view
    //     include 'views/alunos_form.php';
    // }

    // Atualizar os dados de um aluno
    public function atualizar() {
        // Verifica se os dados foram enviados via POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_aluno = $_POST['id_aluno'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $dataNascimento = $_POST['data_nascimento'];

            // Chama o método 'editar' do model 'Aluno' para atualizar os dados
            Aluno::editar($id_aluno, $nome, $cpf, $dataNascimento);
            
            // Redireciona para a listagem de alunos após a atualização
            header('Location: index.php?controller=aluno&action=listar');
        }
    }

    // Deletar um aluno
    public function deletar($id) {
        // Chama o método 'deletar' do model 'Aluno' para excluir o aluno
        Aluno::deletar($id);
        
        // Redireciona para a listagem de alunos após a exclusão
        header('Location: index.php?controller=aluno&action=listar');
    }
}

?>
