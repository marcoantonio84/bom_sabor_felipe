<?php

// Carregar o arquivo .env
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Definir as configurações do banco de dados
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {
    // Criar a conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Configurar o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Opcional: Exibir uma mensagem para confirmar a conexão (pode ser removida depois)
    // echo "Conectado ao banco de dados com sucesso!";
} catch (PDOException $e) {
    // Caso haja erro na conexão
    die("Falha na conexão com o banco de dados: " . $e->getMessage());
}

return $pdo;
