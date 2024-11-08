<?php

class Order {
    private $conn;
    private $table = 'orders';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Obtém todos os pedidos
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtém um pedido por ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria um novo pedido
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (table_id, product_id, quantity, status) VALUES (:table_id, :product_id, :quantity, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':table_id', $data['table_id']);
        $stmt->bindParam(':product_id', $data['product_id']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':status', $data['status'] ?? 'pending');  // Define um status padrão, como 'pending'
        return $stmt->execute();
    }

    // Atualiza um pedido existente
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET table_id = :table_id, product_id = :product_id, quantity = :quantity, status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':table_id', $data['table_id']);
        $stmt->bindParam(':product_id', $data['product_id']);
        $stmt->bindParam(':quantity', $data['quantity']);
        $stmt->bindParam(':status', $data['status']);
        return $stmt->execute();
    }

    // Exclui um pedido
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
