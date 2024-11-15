<?php

//Verificação de estoque peço e outra regras

class ProductService {
    private $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts() {
        return $this->productRepository->findAll();
    }

    public function getProductById($id) {
        return $this->productRepository->find($id);
    }

    public function createProduct($data) {
        $product = new Product();
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        return $this->productRepository->save($product);
    }

    public function updateProduct($id, $data) {
        $product = $this->productRepository->find($id);
        if (!$product) return null;

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        return $this->productRepository->save($product);
    }

    public function deleteProduct($id) {
        return $this->productRepository->delete($id);
    }
}
