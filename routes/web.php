<?php

require_once '../controllers/ProductController.php';
require_once '../controllers/OrderController.php';

// Obter o caminho da URL e o método HTTP
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Criar instâncias dos controllers
$productController = new ProductController();
$orderController = new OrderController();

// Roteamento
switch ($path) {
    // Rotas para produtos
    case '/products':
        if ($method == 'GET') {
            $productController->index(); // Listar todos os produtos
        } elseif ($method == 'POST') {
            $productController->store(); // Criar um novo produto
        }
        break;

    case preg_match('/\/products\/(\d+)/', $path, $matches) ? true : false:
        $id = $matches[1];
        if ($method == 'GET') {
            $productController->show($id); // Exibir um produto específico
        } elseif ($method == 'PUT') {
            $productController->update($id); // Atualizar um produto
        } elseif ($method == 'DELETE') {
            $productController->delete($id); // Excluir um produto
        }
        break;

    // Rotas para pedidos
    case '/orders':
        if ($method == 'GET') {
            $orderController->index(); // Listar todos os pedidos
        } elseif ($method == 'POST') {
            $orderController->store(); // Criar um novo pedido
        }
        break;

    case preg_match('/\/orders\/(\d+)/', $path, $matches) ? true : false:
        $id = $matches[1];
        if ($method == 'GET') {
            $orderController->show($id); // Exibir um pedido específico
        } elseif ($method == 'PUT') {
            $orderController->update($id); // Atualizar um pedido
        } elseif ($method == 'DELETE') {
            $orderController->delete($id); // Excluir um pedido
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["message" => "Rota não encontrada"]);
        break;
}
