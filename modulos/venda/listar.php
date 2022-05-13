<?php

$objetos = Venda::listar();

foreach($objetos as $venda){
    $id = $venda->getId();
    $tipo = $venda->getTipo();
    $pagamento = $venda->getPagamento();
    $data = $venda->getData();
    $prazo = $venda->getPrazo();

    echo $id, $tipo, $pagamento, $data, $prazo;
}

?>