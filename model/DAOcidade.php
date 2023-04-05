<?php
require_once "Database.php";

class Cidade implements JsonSerializable {

    private $idCidade;
    private $nome;
    private $idEstado;
    
    function __construct($idCidade, $nome, $idEstado){
        $this->idCidade = $idCidade;
        $this->nome = $nome;
        $this->idEstado = $idEstado;
    }

    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function jsonSerialize()
    {
        return array(
            "idCidade" => $this->idCidade,
            "nome" => $this->nome,
            "idEstado" => $this->idEstado
        );
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