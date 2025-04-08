<?php
// models/Matricula.php

require_once 'data/Database.php';

class Matricula {
    // Listar todas as matrículas (usando Stored Procedure)
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_matriculas()";  // Chamando a Stored Procedure para listar matrículas
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir uma nova matrícula (usando Stored Procedure)
    public static function inserir($id_aluno, $id_turma) {
        $pdo = Database::conectar();
        $sql = "CALL sp_inserir_matricula(?, ?)";  // Chamando a Stored Procedure para inserir matrícula
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_aluno, $id_turma]);
    }

    // Editar a matrícula (usando Stored Procedure)
    public static function editar($id_matricula, $id_turma) {
        $pdo = Database::conectar();
        $sql = "CALL sp_editar_matricula(?, ?)";  // Chamando a Stored Procedure para editar matrícula
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_matricula, $id_turma]);
    }

    // Deletar uma matrícula (usando Stored Procedure)
    public static function deletar($id_matricula) {
        $pdo = Database::conectar();
        $sql = "CALL sp_deletar_matricula(?)";  // Chamando a Stored Procedure para deletar matrícula
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_matricula]);
    }
}
?>
