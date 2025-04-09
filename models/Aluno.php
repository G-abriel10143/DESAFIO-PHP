<?php

require_once __DIR__ . '/../data/Database.php';

class Aluno {

    // Listar todos os alunos
    public static function listar() {
        $pdo = Database::conectar();
        $sql = "CALL sp_listar_alunos()";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir um aluno
    public static function inserir($nome, $cpf, $dataNascimento) {
        // Valida o tamanho do nome
        if (strlen($nome) < 3) {
            throw new Exception("O nome do aluno deve ter no mínimo 3 caracteres.");
        }
    
        // Valida o formato do CPF
        if (!self::validarCpf($cpf)) {
            throw new Exception("CPF inválido. Por favor, insira um CPF válido.");
        }
    
        // Valida a data de nascimento (deve ser uma data válida e no passado)
        if (!self::validarDataNascimento($dataNascimento)) {
            throw new Exception("Data de nascimento inválida. Certifique-se de que seja uma data válida no passado.");
        }
    
        // Insere o aluno no banco de dados
        $pdo = Database::conectar();
        $sql = "CALL sp_inserir_aluno(?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$nome, $cpf, $dataNascimento]);
    }
    
    // Buscar aluno por ID
    public static function buscarPorId($id) {
        $pdo = Database::conectar();
        $sql = "CALL sp_buscar_aluno(?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Editar aluno
    public static function editar($id_aluno, $nome, $cpf, $dataNascimento) {
        if (strlen($nome) < 3) {
            throw new Exception("O nome do aluno deve ter no mínimo 3 caracteres.");
        }
    
        if (!self::validarCpf($cpf)) {
            throw new Exception("CPF inválido. Por favor, insira um CPF válido.");
        }
    
        if (!self::validarDataNascimento($dataNascimento)) {
            throw new Exception("Data de nascimento inválida. Certifique-se de que seja uma data válida no passado.");
        }
    
        $pdo = Database::conectar();
        $sql = "CALL sp_editar_aluno(?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_aluno, $nome, $cpf, $dataNascimento]);
    }
    

    // Deletar aluno
    public static function deletar($id_aluno) {
        $pdo = Database::conectar();
        $sql = "CALL sp_deletar_aluno(?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$id_aluno]);
    }


    private static function validarCpf($cpf) {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
        // Verifica tamanho
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica sequência repetida
        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }
    
        // Valida dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
    
        return true;
    }
    
    private static function validarDataNascimento($dataNascimento) {
        $dataAtual = date('Y-m-d');
        return (strtotime($dataNascimento) < strtotime($dataAtual)) && strtotime($dataNascimento) !== false;
    }
    

    public static function buscarPorNome($nome) {
        $pdo = Database::conectar();
        $sql = "CALL sp_buscar_alunos_nome(?)"; // Stored Procedure para buscar alunos
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["%$nome%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>
