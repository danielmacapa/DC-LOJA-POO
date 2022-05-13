<?php

include "db.php";

class Cliente{
    protected $id;
    protected $nome;
    protected $endereco;
    protected $cpf;
    protected $telefone;

    // método construtor

    public function __construct($id = false){
        if($id){
            $sql = "SELECT * FROM cliente WHERE id = ?";
        }

        try{
            $con = DB::conexao();
            $stmt = $con->prepare($sql);
        }catch(PDOException $e){
            echo "Erro na consulta de Produto: ".$e->getMessage();
        }

    }
    
// méotods set e get

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

    public function setEndereco($endereco){
        $this->endereco = $endereco;
        }
    public function getEndereco(){
        return $this->endereco;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
        }
    public function getCpf(){
        return $this->cpf;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
        }
    public function getTelefone(){
        return $this->telefone;
    }

// método adicionar    

    public function adicionar(){
        $sql = "INSERT INTO cliente
        (nome, endereco, cpf, telefone)
        VALUES (?, ?, ?, ?)";
    try{

    $con = DB::conexao();
    $stmt = $con->prepare($sql);

    $stmt->bindValue(1, $this->getNome());
    $stmt->bindValue(2, $this->getEndereco());
    $stmt->bindValue(3, $this->getCpf());
    $stmt->bindValue(4, $this->getTelefone());
    $stmt->execute();

    }catch(PDOException $e){
        echo "Erro ao Adicionar Cliente:" . $e->getMessage(); 
    }
    }

//método listar    

    public function listar(){
        $sql = "SELECT * FROM cliente";
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
                $temp->setCpf($registro["cpf"]);
                $temp->setEndereco($registro["endereco"]);
                $temp->setTelefone($registro["telefone"]);

                $objetos[] = $temp;
            }

        }catch (PDOException $e){
            echo "Erro no Listar Cliente: " . $e->getMessage();
        }
        return $objetos;
    }

//método atualizar

    public function atualizar(){
        $sql = "UPDATE cliente 
        SET nome = ?, cpf = ?, endereco = ?, telefone = ?
        WHERE id = ?";

        try{

            $con = DB::conexao();
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $this->getNome());
            $stmt->bindValue(2, $this->getEndereco());
            $stmt->bindValue(3, $this->getCpf());
            $stmt->bindValue(4, $this->getTelefone());
            $stmt->execute();
        
        }catch(PDOException $e){
            echo "Erro no Atualizar: ".$e->getMessage();
        }

    }

//método excluir

    public function excluir(){
        $sql = "DELETE FROM cliente WHERE id = ?";

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