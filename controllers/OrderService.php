<?php

//Faz toda a ordem dos serviços da mesa
class OrderService {
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository) {
        $this->orderRepository = $orderRepository;
    }

    public function getAllOrders() {
        return $this->orderRepository->findAll();
    }

    public function getOrderById($id) {
        return $this->orderRepository->find($id);
    }

    public function createOrder($data) {
        $order = new Order();
        $order->productId = $data['product_id'];
        $order->quantity = $data['quantity'];
        $order->totalPrice = $data['quantity'] * $data['price']; 
        return $this->orderRepository->save($order);
    }

    public function updateOrder($id, $data) {
        $order = $this->orderRepository->find($id);
        if (!$order) return null;

        $order->productId = $data['product_id'];
        $order->quantity = $data['quantity'];
        $order->totalPrice = $data['quantity'] * $data['price'];
        return $this->orderRepository->save($order);
    }

    public function deleteOrder($id) {
        return $this->orderRepository->delete($id);
    }
}
