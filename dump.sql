-- ===============================================
-- Criar o banco de dados
-- ===============================================
CREATE DATABASE desafio_fiap;

-- Selecionar o banco de dados para uso
USE desafio_fiap;

-- ===============================================
-- Criar tabela de alunos
-- ===============================================
-- Tabela para armazenar informações dos alunos, incluindo:
-- ID único, nome, data de nascimento e CPF (único).
CREATE TABLE IF NOT EXISTS alunos (
    id_aluno INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE
);

-- ===============================================
-- Criar tabela de turmas
-- ===============================================
-- Tabela para armazenar informações das turmas, incluindo:
-- ID único, nome e descrição.
CREATE TABLE IF NOT EXISTS turmas (
    id_turma INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL
);

-- ===============================================
-- Criar tabela de matrículas
-- ===============================================
-- Tabela para registrar as matrículas dos alunos nas turmas.
-- Inclui ID único, referência ao aluno, referência à turma,
-- data da matrícula e restrições de unicidade.
CREATE TABLE IF NOT EXISTS matriculas (
    id_matricula INT AUTO_INCREMENT PRIMARY KEY,
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    data_matricula TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (id_aluno, id_turma), -- Garante que um aluno não seja matriculado duas vezes na mesma turma
    FOREIGN KEY (id_aluno) REFERENCES alunos(id_aluno) ON DELETE CASCADE, -- Exclui matrícula se o aluno for deletado
    FOREIGN KEY (id_turma) REFERENCES turmas(id_turma) ON DELETE CASCADE -- Exclui matrícula se a turma for deletada
);

-- ===============================================
-- Stored Procedures para alunos
-- ===============================================

-- Listar todos os alunos ordenados alfabeticamente
DELIMITER $$
CREATE PROCEDURE sp_listar_alunos()
BEGIN
    SELECT * FROM alunos ORDER BY nome;
END $$
DELIMITER ;

-- Inserir um novo aluno
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

-- Editar informações de um aluno existente
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

-- Deletar um aluno pelo ID
DELIMITER $$
CREATE PROCEDURE sp_deletar_aluno(
    IN p_id_aluno INT
)
BEGIN
    DELETE FROM alunos WHERE id_aluno = p_id_aluno;
END $$
DELIMITER ;

-- Buscar um aluno pelo ID
DELIMITER $$
CREATE PROCEDURE sp_buscar_aluno(IN p_id_aluno INT)
BEGIN
    SELECT id_aluno, nome, cpf, data_nascimento
    FROM alunos
    WHERE id_aluno = p_id_aluno;
END$$
DELIMITER ;

-- Buscar alunos pelo nome (usando LIKE para busca parcial)
DELIMITER $$
CREATE PROCEDURE sp_buscar_alunos_nome(IN p_nome VARCHAR(255))
BEGIN
    SELECT id_aluno, nome, cpf, data_nascimento
    FROM alunos
    WHERE nome LIKE p_nome
    ORDER BY nome;
END$$
DELIMITER ;

-- ===============================================
-- Stored Procedures para turmas
-- ===============================================

-- Listar todas as turmas ordenadas alfabeticamente
DELIMITER $$
CREATE PROCEDURE sp_listar_turmas()
BEGIN
    SELECT * FROM turmas ORDER BY nome;
END $$
DELIMITER ;

-- Inserir uma nova turma
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

-- Editar informações de uma turma existente
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

-- Deletar uma turma pelo ID
DELIMITER $$
CREATE PROCEDURE sp_deletar_turma(
    IN p_id_turma INT
)
BEGIN
    DELETE FROM turmas WHERE id_turma = p_id_turma;
END $$
DELIMITER ;

-- Listar turmas com a quantidade de alunos matriculados
DELIMITER $$
CREATE PROCEDURE sp_listar_turmas_com_quantidade()
BEGIN
    SELECT 
        t.id_turma,
        t.nome,
        t.descricao,
        COUNT(m.id_aluno) AS quantidade_alunos
    FROM turmas t
    LEFT JOIN matriculas m ON t.id_turma = m.id_turma
    GROUP BY t.id_turma, t.nome, t.descricao
    ORDER BY t.nome;
END$$
DELIMITER ;

-- ===============================================
-- Stored Procedures para matrículas
-- ===============================================

-- Listar todas as matrículas com informações de alunos e turmas
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

-- Inserir uma nova matrícula (com validação de duplicidade)
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

-- Editar uma matrícula existente
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

-- Deletar uma matrícula pelo ID
DELIMITER $$
CREATE PROCEDURE sp_deletar_matricula(
    IN p_id_matricula INT
)
BEGIN
    DELETE FROM matriculas WHERE id_matricula = p_id_matricula;
END $$
DELIMITER ;

-- Listar alunos matriculados em uma turma específica
DELIMITER $$
CREATE PROCEDURE sp_listar_alunos_turma(IN p_id_turma INT)
BEGIN
    SELECT a.id_aluno, a.nome AS nome_aluno, a.cpf, a.data_nascimento
    FROM matriculas m
    JOIN alunos a ON m.id_aluno = a.id_aluno
    WHERE m.id_turma = p_id_turma
    ORDER BY a.nome; -- Ordenação alfabética dos alunos
END$$
DELIMITER ;

-- ===============================================
-- Criar tabela de administradores
-- ===============================================
-- Tabela para armazenar administradores do sistema
CREATE TABLE administradores (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Inserir um administrador inicial (senha será encriptada no código)
INSERT INTO administradores (email, senha) VALUES ('admin@fiap.com', '1234');
