<?php
require_once "Database.php";

class Estado implements JsonSerializable {

    private $idEstado;
    private $nome;
    private $sigla;
    
    
    public function __construct($idEstado, $nome, $sigla) {
        $this->idEstado = $idEstado;
        $this->nome = $nome;
        $this->sigla = $sigla;
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
            "idEstado" => $this->idEstado,
            "nome" => $this->nome,
            "sigla" => $this->sigla
        );
    }
}



function getEstado($parametersValues = null){
    $queryColums = ["idEstado",
                    "nome",
                    "sigla"];
    
    $queryTable = "estado";
    $queryEnd = "order by nome asc";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, $queryEnd);
    $estado = array();
    foreach($result as $row){
        array_push($estado, new Estado($row['idEstado'], $row['nome'],  $row['sigla']));
    }

    return $estado;
}

?>