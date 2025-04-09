<?php

require_once 'data/Database.php';

class Matricula {

    // Listar todas as matrículas
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_matriculas()";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar alunos por turma
    public static function listarPorTurma($id_turma) {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_alunos_turma(?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_turma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir nova matrícula (com validação RN04)
    public static function inserir($id_aluno, $id_turma) {
        $pdo = Database::conectar();

        // Validação de matrícula duplicada (RN04)
        $sql = "SELECT COUNT(*) FROM matriculas WHERE id_aluno = ? AND id_turma = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_aluno, $id_turma]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("Erro: Aluno já está matriculado nesta turma.");
        }

        // Inserção
        $sql = "CALL sp_inserir_matricula(?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_aluno, $id_turma]);
    }

    // Deletar matrícula
    public static function deletar($id_matricula) {
        $pdo = Database::conectar();
        $sql = "CALL sp_deletar_matricula(?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_matricula]);
    }
}

?>
