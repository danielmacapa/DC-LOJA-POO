<?php

$venda = new Venda(1);
$venda->setTipo("Venda");
$venda->setPagamento("300,00");
$venda->setData("02/02/2022");
$venda->setPrazo("");
$venda->atualizar();


?>