<?php

require_once '../controllers/ProductController.php';
require_once '../controllers/OrderController.php';

// Obter o caminho da URL e o método HTTP
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Criar instâncias dos controllers
$productController = new ProductController();
$orderController = new OrderController();

// Extraímos o ID do produto ou pedido, se existir na URL
$productMatches = [];
$orderMatches = [];
$productId = preg_match('/^\/products\/(\d+)$/', $path, $productMatches) ? $productMatches[1] : null;
$orderId = preg_match('/^\/orders\/(\d+)$/', $path, $orderMatches) ? $orderMatches[1] : null;

// Roteamento para as rotas
switch ($path) {
    // Rotas para produtos
    case '/products':
        switch ($method) {
            case 'GET':
                $productController->index(); // Listar todos os produtos
                break;
            case 'POST':
                $productController->store(); // Criar um novo produto
                break;
            default:
                http_response_code(405); // Método não permitido
                echo json_encode(["message" => "Método não permitido para /products"]);
                break;
        }
        break;

    // Rota para um produto específico
    case ($productId !== null ? true : false):
        switch ($method) {
            case 'GET':
                $productController->show($productId); // Exibir um produto específico
                break;
            case 'PUT':
                $productController->update($productId); // Atualizar um produto específico
                break;
            case 'DELETE':
                $productController->delete($productId); // Excluir um produto específico
                break;
            default:
                http_response_code(405); // Método não permitido
                echo json_encode(["message" => "Método não permitido para /products/{$productId}"]);
                break;
        }
        break;

    // Rotas para pedidos
    case '/orders':
        switch ($method) {
            case 'GET':
                $orderController->index(); // Listar todos os pedidos
                break;
            case 'POST':
                $orderController->store(); // Criar um novo pedido
                break;
            default:
                http_response_code(405); // Método não permitido
                echo json_encode(["message" => "Método não permitido para /orders"]);
                break;
        }
        break;

    // Rota para um pedido específico
    case ($orderId !== null ? true : false):
        switch ($method) {
            case 'GET':
                $orderController->show($orderId); // Exibir um pedido específico
                break;
            case 'PUT':
                $orderController->update($orderId); // Atualizar um pedido específico
                break;
            case 'DELETE':
                $orderController->delete($orderId); // Excluir um pedido específico
                break;
            default:
                http_response_code(405); // Método não permitido
                echo json_encode(["message" => "Método não permitido para /orders/{$orderId}"]);
                break;
        }
        break;

    // Rota padrão caso o caminho não seja encontrado
    default:
        http_response_code(404); // Rota não encontrada
        echo json_encode(["message" => "Rota não encontrada"]);
        break;
}
