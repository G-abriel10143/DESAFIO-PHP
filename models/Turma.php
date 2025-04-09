<?php

require_once 'data/Database.php';

class Turma {
    // Listar todas as turmas (ordenadas alfabeticamente)
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_turmas_com_quantidade()"; // Chama a Stored Procedure
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Inserir uma nova turma
    public static function inserir($nome, $descricao) {
        if (strlen($nome) < 3) {
            throw new Exception("O nome da turma deve ter no mínimo 3 caracteres.");
        }
        $pdo = Database::conectar();
        $sql = "CALL sp_inserir_turma(?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao]);
    }

    // Editar uma turma existente
    
public static function editar($id_turma, $nome, $descricao) {
    if (strlen($nome) < 3) {
        throw new Exception("O nome da turma deve ter no mínimo 3 caracteres.");
    }
    $pdo = Database::conectar();
    $sql = "CALL sp_editar_turma(?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id_turma, $nome, $descricao]);
}

    // Deletar uma turma
    public static function deletar($id_turma) {
        $pdo = Database::conectar();
        $sql = "CALL sp_deletar_turma(?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_turma]);
    }

    // Buscar uma turma pelo ID
    public static function buscarPorId($id_turma) {
        $pdo = Database::conectar();
        $sql = "SELECT id_turma, nome, descricao FROM turmas WHERE id_turma = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_turma]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
