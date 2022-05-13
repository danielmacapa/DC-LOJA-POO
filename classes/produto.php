<?php

include "db.php";

class Produto{
    protected $id;
    protected $nome;
    protected $preco_venda;
    protected $preco_aluguel;
    protected $quantidade;
    protected $fk_categoria;

//método construtor
    
    public function __construct($id = false){
        if($id){
            $sql = "SELECT * FROM produto WHERE id = ?";
        }

        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);
        }catch(PDOException $e){
            echo "Erro na consulta de Produto: ".$e->getMessage();
        }

    }
    
//métodos set e get

    public function setId($id){
        $this->id = $id;
        }
    public function getId(){
        return $this->id;
    }

    public function setNome($nome){
        $this->nome = $nome;
        }
    public function getNome(){
        return $this->nome;
    }

    public function setPreco_venda($preco_venda){
        $this->preco_venda = $preco_venda;
        }
    public function getPreco_venda(){
        return $this->preco_venda;
    }

    public function setPreco_aluguel($preco_aluguel){
        $this->preco_aluguel = $preco_aluguel;
        }
    public function getPreco_aluguel(){
        return $this->preco_aluguel;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
        }
    public function getQuantidade(){
        return $this->quantidade;
    }
    
    public function setFk_categoria($fk_categoria){
        $this->fk_categoria = $fk_categoria;
        }
    public function getFk_categoria(){
        return $this->fk_categoria;
    }


//método adicionar

    public function adicionar(){
        $sql = "INSERT INTO produto
        (nome, preco_venda, preco_aluguel, quantidade, fk_categoria)
        VALUES (?, ?, ?, ?, ?)";
    
    try{
        
        $con = DB::conexao();
        $stmt = $con->prepare($sql);

        $stmt->bindValue(1, $this->getNome());
        $stmt->bindValue(2, $this->getPreco_venda());
        $stmt->bindValue(3, $this->getPreco_aluguel());
        $stmt->bindValue(4, $this->getQuantidade());
        $stmt->bindValue(5, $this->getFk_categoria());
        $stmt->execute();

    }catch(PDOException $e){
        echo "Erro ao Adicionar Produto:" . $e->getMessage(); 
    }
    }

//método listar

    public function listar(){
        $sql = "SELECT * FROM produto";
        $objetos = array();
    
        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);  
            $stmt->execute();
            $registros = $stmt->fetchAll();
            
            foreach($registros as $registro){
                $temp = new Produto();
                $temp->setId($registro["id"]);
                $temp->setnome($registro["nome"]);
                $temp->setPreco_venda($registro["preco_venda"]);
                $temp->setPreco_aluguel($registro["preco_aluguel"]);
                $temp->setQuantidade($registro["quantidade"]);
                $temp->setFk_categoria($registro["fk_categoria"]);

                $objetos[] = $temp;
            }

        }catch (PDOException $e){
            echo "Erro no Listar Produto: " . $e->getMessage();
        }
        return $objetos;
    }

//método atualizar

    public function atualizar( ){
        $sql = "UPDATE produto
        SET nome = ?, preco_venda = ?, preco_aluguel = ?, quantidade = ?, fk_categoria = ?
        WHERE id = ?";

        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $this->getNome());
            $stmt->bindValue(2, $this->getPreco_venda());
            $stmt->bindValue(3, $this->getPreco_aluguel());
            $stmt->bindValue(4, $this->getQuantidade());
            $stmt->bindValue(5, $this->getFk_categoria());
            $stmt->execute();
        }catch(PDOException $e){
            echo "Erro no Atualizar: ".$e->getMessage();
        }
    }


//método excluir

    public function excluir(){
        $sql = "DELETE FROM produto WHERE id = ?";

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