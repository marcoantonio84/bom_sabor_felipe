<?php

require_once 'Pedido.php';

class Cozinha {
    private $pedidos = [];

    public function receberPedido(Pedido $pedido) {
        $this->pedidos[] = $pedido;
    }

    // Outros métodos irei por aqui
}
