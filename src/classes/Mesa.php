<?php

require_once 'Pedido.php';

class Mesa {
    private $id;
    private $pedidoAtual;
    private $chamandoGarcom = false;

    public function __construct($id) {
        $this->id = $id;
    }

    // Métodos para manipular pedidos e chamar garçom aqui
}
