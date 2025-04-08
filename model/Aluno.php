<?php
// models/Aluno.php

require_once 'data/Database.php';

class Aluno {
    // Listar todos os alunos (usando Stored Procedure)
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_alunos()";  // Chamando a Stored Procedure para listar alunos
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir um novo aluno (usando Stored Procedure)
    public static function inserir($nome, $cpf, $dataNascimento) {
        $pdo = Database::conectar();
        $sql = "CALL sp_inserir_aluno(?, ?, ?)";  // Chamando a Stored Procedure para inserir aluno
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nome, $cpf, $dataNascimento]);
    }

    // Editar os dados de um aluno (usando Stored Procedure)
    public static function editar($id_aluno, $nome, $cpf, $dataNascimento) {
        $pdo = Database::conectar();
        $sql = "CALL sp_editar_aluno(?, ?, ?, ?)";  // Chamando a Stored Procedure para editar aluno
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_aluno, $nome, $cpf, $dataNascimento]);
    }

    // Deletar um aluno (usando Stored Procedure)
    public static function deletar($id_aluno) {
        $pdo = Database::conectar();
        $sql = "CALL sp_deletar_aluno(?)";  // Chamando a Stored Procedure para deletar aluno
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_aluno]);
    }
}
