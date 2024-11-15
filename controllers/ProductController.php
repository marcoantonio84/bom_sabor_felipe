<?php

require_once '../models/Product.php';

class ProductController {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    // Listar todos os produtos
    public function index() {
        $products = $this->product->getAll();
        if (count($products) > 0) {
            echo json_encode($products);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Nenhum produto encontrado"]);
        }
    }

    // Exibir um produto específico
    public function show($id) {
        $product = $this->product->getById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Produto não encontrado"]);
        }
    }

    // Criar um novo produto
    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['name']) && isset($data['price']) && isset($data['description'])) {
            $result = $this->product->create($data);
            if ($result) {
                http_response_code(201);
                echo json_encode(["message" => "Produto criado com sucesso"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao criar o produto"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    // Atualizar um produto
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['name']) && isset($data['price']) && isset($data['description'])) {
            $result = $this->product->update($id, $data);
            if ($result) {
                echo json_encode(["message" => "Produto atualizado com sucesso"]);
            } else {
                http_response_code(500);
                echo json_encode(["message" => "Erro ao atualizar o produto"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    // Excluir um produto
    public function delete($id) {
        $result = $this->product->delete($id);
        if ($result) {
            echo json_encode(["message" => "Produto excluído com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Erro ao excluir o produto"]);
        }
    }
}
