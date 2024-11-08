<?php

use PHPUnit\Framework\TestCase;

require_once './controllers/ProductController.php';

class ProductTest extends TestCase
{
    protected $productController;

    protected function setUp(): void
    {
        $this->productController = new ProductController();
    }

    public function testIndexReturnsProducts()
    {
        // Suponha que o método index retorna uma lista de produtos como array
        $result = $this->productController->index();
        
        // Verifica se o resultado é um array e possui pelo menos um produto
        $this->assertIsArray($result, "O resultado deve ser um array.");
        $this->assertNotEmpty($result, "O array de produtos não deve estar vazio.");
    }

    public function testStoreCreatesProduct()
    {
        // Dados simulados para criação de produto
        $_POST['name'] = "Produto Teste";
        $_POST['price'] = 99.99;

        ob_start(); // Captura a saída
        $this->productController->store();
        $output = ob_get_clean();

        $response = json_decode($output, true);

        // Verifica se a resposta contém uma mensagem de sucesso
        $this->assertArrayHasKey('message', $response, "A resposta deve conter uma chave 'message'.");
        $this->assertEquals('Produto criado com sucesso.', $response['message']);
    }

    public function testShowReturnsProduct()
    {
        // Supondo que existe um produto com ID 1
        $id = 1;

        ob_start();
        $this->productController->show($id);
        $output = ob_get_clean();

        $product = json_decode($output, true);

        // Verificar se o produto retornado possui os dados esperados
        $this->assertIsArray($product, "O produto deve ser um array.");
        $this->assertArrayHasKey('id', $product, "O produto deve conter a chave 'id'.");
        $this->assertEquals($id, $product['id'], "O ID do produto deve ser igual ao ID solicitado.");
    }

    public function testUpdateModifiesProduct()
    {
        // ID do produto a ser atualizado
        $id = 1;

        // Dados simulados para atualização
        $_POST['name'] = "Produto Atualizado";
        $_POST['price'] = 89.99;

        ob_start();
        $this->productController->update($id);
        $output = ob_get_clean();

        $response = json_decode($output, true);

        // Verifica se a resposta contém uma mensagem de sucesso
        $this->assertArrayHasKey('message', $response, "A resposta deve conter uma chave 'message'.");
        $this->assertEquals('Produto atualizado com sucesso.', $response['message']);
    }

    public function testDeleteRemovesProduct()
    {
        // ID do produto a ser deletado
        $id = 1;

        ob_start();
        $this->productController->delete($id);
        $output = ob_get_clean();

        $response = json_decode($output, true);

        // Verifica se a resposta contém uma mensagem de sucesso
        $this->assertArrayHasKey('message', $response, "A resposta deve conter uma chave 'message'.");
        $this->assertEquals('Produto excluído com sucesso.', $response['message']);
    }
}
