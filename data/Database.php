<?php
// data/Database.php

class Database {
    private static $host = 'localhost';  // Endereço do banco de dados
    private static $dbname = 'desafio_fiap';  // Nome do banco de dados
    private static $user = 'root';  // Usuário do banco de dados
    private static $pass = 'Gaga9090.';  // Senha do banco de dados
    private static $pdo;  // Conexão PDO

    // Função para conectar ao banco
    public static function conectar() {
        if (self::$pdo == null) {
            try {
                // Conecta ao banco de dados
                self::$pdo = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8',
                    self::$user,
                    self::$pass
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar com o banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
