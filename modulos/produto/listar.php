<?php

$objetos = Produto::listar();

foreach($objetos as $produto){
    $id = $produto->getId();
    $nome = $produto->getNome();
    $preco_venda = $produto->getPreco_venda();
    $preco_aluguel = $produto->getPreco_aluguel();
    $quantidade = $produto->getQuantidade();

    echo $id, $nome, $preco_venda, $preco_aluguel, $quantidade;
}

?>