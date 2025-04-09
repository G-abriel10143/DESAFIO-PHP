<?php

require_once 'models/Administrador.php';

class LoginController {

    // Exibir página de login
    public function exibir() {
        include 'views/login.php';
    }

    // Autenticação do administrador
    public function autenticar() {
        session_start();

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Valida email e senha diretamente no Model
        $admin = Administrador::autenticar($email, $senha);

        if ($admin) {
            $_SESSION['admin_logado'] = true;
            header('Location: index.php?controller=aluno&action=listar');
        } else {
            $mensagemErro = "E-mail ou senha inválidos!";
            include 'views/login.php';
        }
    }

    // Logout
    public function logout() {
        session_start();
        session_destroy(); // Destroi a sessão
        header('Location: index.php?controller=login&action=exibir');
    }
}

?>
