<?php

class Database {
    private static $connection;
    
    public static function getConnection(){
        if(!isset(self::$connection)){
            // lendo os parâmetros do arquivo de configuração
            $config = parse_ini_file("./model/config.ini");
            try{
                $conn = new PDO("mysql:host=".$config["hostname"].";dbname=".$config["dbname"], $config["user"], $config["pass"]);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection = $conn;
            }catch(PDOException $e){
                echo $e->getMessage();
                die();// interrompe o carregamento da página
            }
        }
        return self::$connection;
    }
	
	public static function execute($query, $parameter = null) {
        try {
            $db = self::getConnection();
            $stmt = $db->prepare($query);
            // vinculando parâmetro
			if ($parameter != null) {
				foreach ($parameter as $key => $param) {
					$stmt->bindValue(':' . $key, $param);
                }
            }
            
            // executando e retornando
            $stmt->execute();
            
            // $testes = $stmt->debugDumpParams();
            try {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(empty($result) && $stmt->rowCount() > 0) { // Caso o array de resultados esteja vazio, significa que é um insert, delete ou update, setar como true.
                    $result = true;
                }
            } catch(PDOException $e){
                $result = true; // é um insert ou um delete ou um update
            }
            
            return $result;
        }catch(PDOException $e){
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public static function getTuples($columns = null, $table, $join = null, $data = null, $end = null){
        $queryStart = "SELECT ";
        $queryFrom = " FROM ";
        $queryJoin = "";
        $queryWhere = "";
        $queryEnd = "";
    
        // Criação da cláusula Select
        if ($columns != null) {
            $colNumber = count($columns);// número de colunas
            foreach ($columns as $column) {
                $queryStart = $queryStart." ".$column;
                $colNumber--;
                if($colNumber > 0){
                    $queryStart = $queryStart.", ";
                }
            }
        } else {
            $queryStart = $queryStart." * "; // todas as colunas por padrão
        }
    
        // Criação da cláusula From
        $queryFrom = $queryFrom." ".$table;
    
        // Criação da cláusula Join
        $queryJoin = $queryJoin." ".$join;
    
        // Criação da cláusula Where
        if ($data != null) {
            $queryWhere = " WHERE ";
            $whereBlocks = count($data);
            //if($whereBlocks)
            foreach ($data as $key => $param) {
                $queryWhere = $queryWhere." ".$key."=:".$key;
                $whereBlocks--;
                if($whereBlocks > 0){
                    $queryWhere = $queryWhere." AND";
                }
            }
        }

        // Criação da cláusula End
        $queryEnd = $queryEnd." ".$end;

        // Unindo os componentes da consulta
        $query = $queryStart." ".$queryFrom." ".$queryJoin." ".$queryWhere." ".$queryEnd;
    
        // echo("<br>".$query."<br>");
    
        $return = self::execute($query, $data);
        //print_r($return);
        return $return;
    }
	
}
?>