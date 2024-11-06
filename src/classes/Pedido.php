<?php

require_once 'Produto.php';

class Pedido {
    private $id;
    private $mesaId;
    private $produtos = [];
    private $status = 'pendente';

    public function __construct($id, $mesaId) {
        $this->id = $id;
        $this->mesaId = $mesaId;
    }

    public function adicionarProduto(Produto $produto) {
        $this->produtos[] = $produto;
    }

    // Outros métodos aqui
}
