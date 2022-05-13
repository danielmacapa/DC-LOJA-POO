<?php

include "db.php";

class Categoria{
    protected $id;
    protected $nome;

    // método construtor
    
    public function __construct($id = false){
        if($id){
            $sql = "SELECT * FROM categoria WHERE id = ?";
        }

        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);
        }catch(PDOException $e){
            echo "Erro na consulta de Categoria: ".$e->getMessage();
        }

    }
    
// métodos set e get
    
    public function setId($id){
        $this->id = $id();
        }
    public function getId(){
        return $this->id;
    }
    
    public function setNome($nome){
        $this->nome = $nome();
        }
    public function getNome(){
        return $this->nome;
    }
    
// método adicionar

    public function adicionar(){
        $sql = "INSERT INTO categoria
        (nome) VALUES (?)";
    try{

    $con = DB::conexao();
    $stmt = $con->prepare($sql);

    $stmt->bindValue(1, $this->getNome());
    $stmt->execute();

    }catch(PDOException $e){
        echo "Erro ao Adicionar Categoria:" . $e->getMessage(); 
    }
    }

// método listar

    public function listar(){
        $sql = "SELECT * FROM categoria";
        $objetos = array();
    
        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);  
            $stmt->execute();
            $registros = $stmt->fetchAll();
            
            foreach($registros as $registro){
                $temp = new Cliente();
                $temp->setId($registro["id"]);
                $temp->setNome($registro["nome"]);
            
                $objetos[] = $temp;
            }

        }catch (PDOException $e){
            echo "Erro no Listar Categoria: " . $e->getMessage();
        }
        return $objetos;
    }

// método atualizar

    public function atualizar(){
        $sql = "UPDATE categoria 
        SET nome = ?
        WHERE id = ?";

        try{

            $con = DB::conexao();
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $this->getNome());
            $stmt->execute();
        
        }catch(PDOException $e){
            echo "Erro no Atualizar: ".$e->getMessage();
        }

    }

// método excluir

    public function excluir(){
        $sql = "DELETE FROM categoria WHERE id = ?";

        try{

            $con = DB::conexao();
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $this->getId());
            $stmt->execute();

        }catch(PDOException $e){
            echo "Erro no Excluir: ".$e->getMessage();
        }
    }
}
?>