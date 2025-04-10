<?php

require_once 'data/Database.php';

class Administrador {

    // Autenticar administrador por email e senha (com verificação de hash)
    public static function autenticar($email, $senha) {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM administradores WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($admin && password_verify($senha, $admin['senha'])) {
            return $admin; // Retorna o administrador autenticado
        }
        return null; // Retorna null se a autenticação falhar
    }

    // Inserir novo administrador
    public static function inserir($email, $senha) {
        $pdo = Database::conectar();

        // Verificar se o email já existe
        $sql = "SELECT COUNT(*) FROM administradores WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("Erro: Este email já está cadastrado.");
        }

        // Inserir o administrador no banco de dados com a senha encriptada
        $sql = "INSERT INTO administradores (email, senha) VALUES (?, ?)";
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $senhaHash]);
    }

    // Listar todos os administradores
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "SELECT id_admin, email FROM administradores ORDER BY email";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Deletar administrador pelo ID
    public static function deletar($id_admin) {
        $pdo = Database::conectar();
        $sql = "DELETE FROM administradores WHERE id_admin = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_admin]);
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
    public static function buscarPorId($id_admin) {
        $pdo = Database::conectar();
        $sql = "SELECT id_admin, email FROM administradores WHERE id_admin = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_admin]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}

?>
