<?php

$venda = new Venda();
$venda->setTipo("aluguel");
$venda->setPagamento("debito");
$venda->setData("02/02/2022");
$venda->setPrazo("30");
$venda->adicionar();

?>