<?php
require_once "Database.php";

class Cidade{

    public $idCidade;
    public $nome;
    public $idEstado;
    
    function __construct($idCidade, $nome, $idEstado){
        $this->idCidade = $idCidade;
        $this->nome = $nome;
        $this->idEstado = $idEstado;
    }
}

function getCidade($parametersValues = null){
    $queryColums = ["idCidade",
                    "nome",
                    "idEstado"];
    
    $queryTable = "cidade";
    $queryEnd = "order by nome asc";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, $queryEnd);
    $cidade = array();
    foreach($result as $row){
        array_push($cidade, new Cidade($row['idCidade'],$row['nome'],$row['idEstado']));
    }
    return $cidade;
}

?>