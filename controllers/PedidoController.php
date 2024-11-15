<?php

//Faz o gerenciamento dos pedidos 
function finalizarPedido() {
    $dadosPedido = json_decode(file_get_contents('php://input'), true);

    if (empty($dadosPedido['itens']) || !is_array($dadosPedido['itens'])) {
        echo json_encode(["status" => "error", "message" => "Pedido inválido. Itens não encontrados."]);
        return;
    }

    if (empty($dadosPedido['cliente_id']) || empty($dadosPedido['total'])) {
        echo json_encode(["status" => "error", "message" => "Pedido incompleto. Informações do cliente ou total não encontrados."]);
        return;
    }

    try {
        $itensDisponiveis = verificarEstoque($dadosPedido['itens']);
        if (!$itensDisponiveis) {
            echo json_encode(["status" => "error", "message" => "Estoque insuficiente para alguns itens."]);
            return;
        }

        $pedidoId = savePedido($dadosPedido);
        atualizarEstoque($dadosPedido['itens']);

        $statusPedido = "Pedido confirmado e em preparação";
        atualizarStatusPedido($pedidoId, $statusPedido);

        echo json_encode(["status" => "success", "message" => "Pedido realizado com sucesso!", "pedido_id" => $pedidoId, "status" => $statusPedido]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Erro ao processar o pedido: " . $e->getMessage()]);
    }
}

function savePedido($dadosPedido) {
    return 123;
}

function verificarEstoque($itens) {
    foreach ($itens as $item) {
        if ($item['quantidade'] > 10) {
            return false;
        }
    }
    return true;
}

function atualizarEstoque($itens) {
    foreach ($itens as $item) {
    }
}

function atualizarStatusPedido($pedidoId, $status) {
}
?>
