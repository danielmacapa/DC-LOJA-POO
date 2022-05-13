<?php

$objetos = Cliente::listar();

foreach($objetos as $cliente){
    $id = $cliente->getId();
    $nome = $cliente->getNome();
    $endereco = $cliente->getEndereco();
    $cpf = $cliente->getCpf();
    $telefone = $cliente->getTelefone();

    echo $id, $nome, $endereco, $cpf, $telefone;
}

?>