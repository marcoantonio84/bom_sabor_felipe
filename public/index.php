<?php

// Carregar as dependências necessárias
require_once '../config/db.php'; // Conexão com o banco de dados
require_once '../controllers/User.php'; // Controller de usuários
require_once '../Router.php'; // Classe Router

// Definir o cabeçalho para resposta JSON
header("Content-type: application/json; charset=UTF-8");

// Instanciar o roteador e o controller
$router = new Router();
$controller = new UserController($pdo); // Passar o PDO (conexão com o banco) para o controller

// Adicionar as rotas para a API
$router->add('GET', '/users', [$controller, 'list']);
$router->add('GET', '/users/{id}', [$controller, 'getById']);
$router->add('POST', '/users', [$controller, 'create']);
$router->add('DELETE', '/users/{id}', [$controller, 'delete']);
$router->add('PUT', '/users/{id}', [$controller, 'update']);

// Obter o caminho da URL solicitada
$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

// Disparar a rota solicitada
$router->dispatch($requestedPath);
