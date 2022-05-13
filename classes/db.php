<?php

class DB{
    public static $servidor = "localhost";
    public static $usuario = "root";
    public static $senha = "";
    public static $nome_banco = "dc-loja"; 
    
    public static function conexao(){
        $conexao = null;
        
        try{
            $conexao = new PDO(
                'mysql:host=localhost;dbname=dc-loja', 
                self::$usuario, self::$senha);

        }catch(PDOException $e){
            echo "Erro de Conexão:" . $e->getMessage(); 
        }
        return $conexao;
    }

    
}




?>
