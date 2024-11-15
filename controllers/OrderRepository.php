<?php

//Este crud faz todo o controle do repositorio
class OrderRepository {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM orders");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function save(Order $order) {
        if ($order->id) {
            $stmt = $this->db->prepare("UPDATE orders SET product_id = :product_id, quantity = :quantity, total_price = :total_price WHERE id = :id");
            return $stmt->execute([':product_id' => $order->productId, ':quantity' => $order->quantity, ':total_price' => $order->totalPrice, ':id' => $order->id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO orders (product_id, quantity, total_price) VALUES (:product_id, :quantity, :total_price)");
            return $stmt->execute([':product_id' => $order->productId, ':quantity' => $order->quantity, ':total_price' => $order->totalPrice]);
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
