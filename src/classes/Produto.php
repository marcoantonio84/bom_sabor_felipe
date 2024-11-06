<?php

class Produto {
    private $id;
    private $nome;
    private $preco;
    private $descricao;

    public function __construct($id, $nome, $preco, $descricao) {
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
    }

    // Getters e Setters aqui
}
