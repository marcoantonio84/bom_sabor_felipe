<?php
// Endpoint para finalizar um pedido
function finalizarPedido() {
    $dadosPedido = json_decode(file_get_contents('php://input'), true);
    // Lógica para processar o pedido e salvar no banco de dados
    
    echo json_encode(["status" => "success", "message" => "Pedido realizado com sucesso!"]);
}
?>
