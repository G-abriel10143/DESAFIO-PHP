<?php
// models/Turma.php

require_once 'data/Database.php';

class Turma {
    // Listar todas as turmas (usando Stored Procedure)
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_turmas()";  // Chamando a Stored Procedure para listar turmas
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir uma nova turma (usando Stored Procedure)
    public static function inserir($nome, $descricao) {
        $pdo = Database::conectar();
        $sql = "CALL sp_inserir_turma(?, ?)";  // Chamando a Stored Procedure para inserir turma
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao]);
    }

    // Editar uma turma existente (usando Stored Procedure)
    public static function editar($id_turma, $nome, $descricao) {
        $pdo = Database::conectar();
        $sql = "CALL sp_editar_turma(?, ?, ?)";  // Chamando a Stored Procedure para editar turma
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_turma, $nome, $descricao]);
    }

    // Deletar uma turma (usando Stored Procedure)
    public static function deletar($id_turma) {
        $pdo = Database::conectar();
        $sql = "CALL sp_deletar_turma(?)";  // Chamando a Stored Procedure para deletar turma
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_turma]);
    }
}
?>
