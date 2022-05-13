<?php

$objetos = Categoria::listar();

foreach($objetos as $categoria){
    $id = $categoria->getId();
    $nome = $categoria->getNome();
   
    echo $id, $nome;
}

?>