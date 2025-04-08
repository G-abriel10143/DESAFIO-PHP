-- Criar banco de dados
CREATE DATABASE desafio_fiap;

-- Selecionar o banco
USE desafio_fiap;


-- Criar tabela de alunos
CREATE TABLE IF NOT EXISTS alunos (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE
);

-- Criar tabela de turmas
CREATE TABLE IF NOT EXISTS turmas (
    id_turma INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL
);

-- Criar tabela de matriculas
CREATE TABLE IF NOT EXISTS matriculas (
    id_matricula INT AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (id_aluno, id_turma),
    FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno) ON DELETE CASCADE,
    FOREIGN KEY (id_turma) REFERENCES turmas(id_turma) ON DELETE CASCADE
);

-- ===============================================
-- Criar Stored Procedure para listar alunos
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_listar_alunos()
BEGIN
    SELECT * FROM alunos ORDER BY nome;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para inserir aluno
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_inserir_aluno(
    IN p_nome VARCHAR(100),
    IN p_cpf VARCHAR(14),
    IN p_data_nascimento DATE
)
BEGIN
    INSERT INTO alunos (nome, cpf, data_nascimento) 
    VALUES (p_nome, p_cpf, p_data_nascimento);
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para editar aluno
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_editar_aluno(
    IN p_id_aluno INT,
    IN p_nome VARCHAR(100),
    IN p_cpf VARCHAR(14),
    IN p_data_nascimento DATE
)
BEGIN
    UPDATE alunos 
    SET nome = p_nome, cpf = p_cpf, data_nascimento = p_data_nascimento
    WHERE id_aluno = p_id_aluno;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para deletar aluno
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_deletar_aluno(
    IN p_id_aluno INT
)
BEGIN
    DELETE FROM alunos WHERE id_aluno = p_id_aluno;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para listar turmas
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_listar_turmas()
BEGIN
    SELECT * FROM turmas ORDER BY nome;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para inserir turma
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_inserir_turma(
    IN p_nome VARCHAR(100),
    IN p_descricao TEXT
)
BEGIN
    INSERT INTO turmas (nome, descricao) 
    VALUES (p_nome, p_descricao);
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para editar turma
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_editar_turma(
    IN p_id_turma INT,
    IN p_nome VARCHAR(100),
    IN p_descricao TEXT
)
BEGIN
    UPDATE turmas 
    SET nome = p_nome, descricao = p_descricao
    WHERE id_turma = p_id_turma;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para deletar turma
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_deletar_turma(
    IN p_id_turma INT
)
BEGIN
    DELETE FROM turmas WHERE id_turma = p_id_turma;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para listar matrículas
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_listar_matriculas()
BEGIN
    SELECT 
        m.id_matricula,
        a.nome AS aluno_nome,
        t.nome AS turma_nome,
        m.data_matricula
    FROM matriculas m
    JOIN alunos a ON m.id_aluno = a.id_aluno
    JOIN turmas t ON m.id_turma = t.id_turma
    ORDER BY a.nome;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para inserir matrícula
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_inserir_matricula(
    IN p_id_aluno INT,
    IN p_id_turma INT
)
BEGIN
    -- Verificar se o aluno já está matriculado na turma
    IF NOT EXISTS (SELECT 1 FROM matriculas WHERE id_aluno = p_id_aluno AND id_turma = p_id_turma) THEN
        INSERT INTO matriculas (id_aluno, id_turma) 
        VALUES (p_id_aluno, p_id_turma);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'O aluno já está matriculado nesta turma';
    END IF;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para editar matrícula
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_editar_matricula(
    IN p_id_matricula INT,
    IN p_id_turma INT
)
BEGIN
    UPDATE matriculas 
    SET id_turma = p_id_turma
    WHERE id_matricula = p_id_matricula;
END $$

DELIMITER ;

-- ===============================================
-- Criar Stored Procedure para deletar matrícula
-- ===============================================
DELIMITER $$

CREATE PROCEDURE sp_deletar_matricula(
    IN p_id_matricula INT
)
BEGIN
    DELETE FROM matriculas WHERE id_matricula = p_id_matricula;
END $$

DELIMITER ;
