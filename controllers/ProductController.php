<?php

require_once '../models/Product.php';

class ProductController {
    // Lista todos os produtos
    public function index() {
        $product = new Product();
        $products = $product->getAll();
        echo json_encode($products);
    }

    // Exibe um produto específico
    public function show($id) {
        $product = new Product();
        $result = $product->getById($id);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Produto não encontrado"]);
        }
    }

    // Adiciona um novo produto
    public function store() {
        $data = json_decode(file_get_contents("php://input"), true); // Recebe dados JSON do corpo da requisição
        if ($this->validate($data)) {
            $product = new Product();
            $product->create($data);
            http_response_code(201);
            echo json_encode(["message" => "Produto criado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    // Atualiza um produto existente
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->validate($data)) {
            $product = new Product();
            if ($product->update($id, $data)) {
                echo json_encode(["message" => "Produto atualizado com sucesso"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Produto não encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    // Exclui um produto
    public function delete($id) {
        $product = new Product();
        if ($product->delete($id)) {
            echo json_encode(["message" => "Produto excluído com sucesso"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Produto não encontrado"]);
        }
    }

    // Validação básica dos dados de entrada
    private function validate($data) {
        return isset($data['name'], $data['price']) && !empty($data['name']) && is_numeric($data['price']);
    }
}
