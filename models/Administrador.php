<?php

require_once 'data/Database.php';

class Administrador {

    // Buscar administrador por email e senha (não encriptada)
    public static function autenticar($email, $senha) {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM administradores WHERE email = ? AND senha = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email, $senha]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
