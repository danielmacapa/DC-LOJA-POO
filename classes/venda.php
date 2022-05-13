<?php

include "db.php";

class Venda{
    protected $id;
    protected $tipo;
    protected $pagamento;
    protected $data;
    protected $prazo;

//método construtor

    public function __construct($id = false){
        if($id){
            $sql = "SELECT * FROM venda WHERE id = ?";
        }

        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);
        }catch(PDOException $e){
            echo "Erro na consulta de Venda: ".$e->getMessage();
        }

    }
    
//métodos set e get
        
    public function setId($id){
        $this->id = $id;
        }
    public function getId(){
        return $this->id;
    }
    
    public function setTipo($tipo){
        $this->tipo = $tipo;
        }
    public function getTipo(){
        return $this->tipo;
    }

    public function setPagamento($pagamento){
        $this->pagamento = $pagamento;
        }
    public function getPagamento(){
        return $this->pagamento;
    }

    public function setData($data){
        $this->data = $data;
        }
    public function getData(){
        return $this->data;
    }

    public function setPrazo($prazo){
        $this->prazo = $prazo;
        }
    public function getPrazo(){
        return $this->prazo;
    }

//método adicionar

    public function adicionar(){
        $sql = "INSERT INTO venda
        (tipo, pagamento, data, prazo)
        VALUES (?, ?, ?, ?)";
    
    try{

        $con = DB::conexao();
        $stmt = $con->prepare($sql);

        $stmt->bindValue(1, $this->getTipo());
        $stmt->bindValue(2, $this->getPagamento());
        $stmt->bindValue(3, $this->getData());
        $stmt->bindValue(4, $this->getPrazo());
        $stmt->execute();

    }catch(PDOException $e){
        echo "Erro ao Adicionar Venda:" . $e->getMessage(); 
    }
    }

//método listar

    public function listar(){
        $sql = "SELECT * FROM venda";
        $vendas = array();
    
        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);  
            $stmt->execute();
            $registros = $stmt->fetchAll();
            
            foreach($registros as $registro){
                $temp = new Venda();
                $temp->setTipo($registro["tipo"]);
                $temp->setPagamento($registro["pagamento"]);
                $temp->setData($registro["data"]);
                $temp->setPrazo($registro["prazo"]);

                $vendas[] = $temp;
            }

        }catch (PDOException $e){
            echo "Erro no Listar Vendas: " . $e->getMessage();
        }
        return $vendas;
    }

//método atualizar

    public function atualizar( ){
        $sql = "UPDATE venda
        SET tipo = ?, pagamento = ?, data = ?, prazo = ?
        WHERE id = ?";

        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $this->getTipo());
            $stmt->bindValue(2, $this->getPagamento());
            $stmt->bindValue(3, $this->getData());
            $stmt->bindValue(4, $this->getPrazo());
            $stmt->execute();
        }catch(PDOException $e){
            echo "Erro no Atualizar: ".$e->getMessage();
        }
    }

//método excluir

    public function excluir(){
        $sql = "DELETE FROM venda WHERE id = ?";

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