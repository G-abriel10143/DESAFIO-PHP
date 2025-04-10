<?php
require_once 'models/Administrador.php';

class AdminController {

    // Exibe o formulário para cadastro de administrador
    public function criar() {
        $sucesso = null; // Inicializa a variável de sucesso
        $erro = null; // Inicializa a variável de erro
        include 'views/admin/form.php'; // Renderiza o formulário
    }

    // Insere um novo administrador no sistema
    public function inserir() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Captura os dados do formulário
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $senha = $_POST['senha'];

                // Verifica campos vazios
                if (empty($email) || empty($senha)) {
                    throw new Exception("Erro: Email e senha são obrigatórios.");
                }

                // Encripta a senha com bcrypt
                $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

                // Chama o modelo para inserção no banco de dados
                Administrador::inserir($email, $senhaHash);

                // Mensagem de sucesso
                $sucesso = "Administrador cadastrado com sucesso!";
            } catch (Exception $e) {
                // Captura o erro lançado e exibe no formulário
                $erro = $e->getMessage();
            }

            // Renderiza o formulário novamente com feedback
            include 'views/admin/form.php';
        }
    }

    public function listar() {
        $administradores = Administrador::listar(); // Busca os administradores do modelo
        include 'views/admin/index.php'; // Exibe a view da lista
    }
    
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $admin = Administrador::buscarPorId($id);
            if ($admin) {
                include 'views/admin/form.php';
            } else {
                $erro = "Administrador não encontrado!";
                $administradores = Administrador::listar();
                include 'views/admin/list.php';
            }
        }
    }
    
}
?>
