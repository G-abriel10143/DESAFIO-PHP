<?php

require_once 'data/Database.php';

class Matricula {

    // Listar todas as matrículas
    public static function listar($id_turma = null, $search = null) {
        $pdo = Database::conectar();
    
        // Consulta base
        $sql = "SELECT m.id_matricula, a.nome AS aluno_nome, t.nome AS turma_nome, m.data_matricula 
                FROM matriculas m
                INNER JOIN alunos a ON m.id_aluno = a.id_aluno
                INNER JOIN turmas t ON m.id_turma = t.id_turma
                WHERE 1=1";
    
        // Adiciona condições dinamicamente
        $params = [];
        if ($id_turma) {
            $sql .= " AND m.id_turma = ?";
            $params[] = $id_turma;
        }
        if ($search) {
            $sql .= " AND (a.nome LIKE ? OR t.nome LIKE ?)";
            $params[] = '%' . $search . '%';
            $params[] = '%' . $search . '%';
        }
    
        // Prepara e executa a consulta
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
    
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
