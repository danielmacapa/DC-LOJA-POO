<?php

$objetos = Funcionario::listar();

foreach($objetos as $funcionario){
    $id = $funcionario->getId();
    $nome = $funcionario->getNome();
    $endereco = $funcionario->getEndereco();
    $cpf = $funcionario->getCpf();
    $telefone = $funcionario->getTelefone();

    echo $id, $nome, $endereco, $cpf, $telefone;
}

?>