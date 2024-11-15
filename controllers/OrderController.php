<?php

//parte de controle de ordem de serviço

require_once '../models/Order.php';

class OrderController {
    // Lista todos os pedidos
    public function index() {
        $order = new Order();
        $orders = $order->getAll();
        echo json_encode($orders);
    }

    // Exibe um pedido específico
    public function show($id) {
        $order = new Order();
        $result = $order->getById($id);
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Pedido não encontrado"]);
        }
    }

    // Cria um novo pedido
    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->validate($data)) {
            $order = new Order();
            $order->create($data);
            http_response_code(201);
            echo json_encode(["message" => "Pedido criado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    // Atualiza um pedido existente
    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->validate($data)) {
            $order = new Order();
            if ($order->update($id, $data)) {
                echo json_encode(["message" => "Pedido atualizado com sucesso"]);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "Pedido não encontrado"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["message" => "Dados inválidos"]);
        }
    }

    // Exclui um pedido
    public function delete($id) {
        $order = new Order();
        if ($order->delete($id)) {
            echo json_encode(["message" => "Pedido excluído com sucesso"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Pedido não encontrado"]);
        }
    }

    // Validação básica dos dados de entrada
    private function validate($data) {
        return isset($data['table_id'], $data['product_id'], $data['quantity']) && 
               is_numeric($data['table_id']) && 
               is_numeric($data['product_id']) && 
               is_numeric($data['quantity']);
    }
}
