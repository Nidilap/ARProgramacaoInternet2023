<?php
require_once "Database.php";

class Produto implements JsonSerializable {

    private $idProduto;
    private $nome;
    private $descricao;
    private $codigoDeBarras;
    private $imagem;
    private $imagemType;
    private $fabricante;
    private $validade;

    public function __construct($idProduto, $nome, $descricao, $codigoDeBarras, $imagem, $imagemType, $fabricante, $validade) {
        $this->idProduto = $idProduto;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->codigoDeBarras = $codigoDeBarras;
        $this->imagem = $imagem;
        $this->imagemType = $imagemType;
        $this->fabricante = $fabricante;
        $this->validade = $validade;
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
            "idProduto" => $this->idProduto,
            "nome" => $this->nome,
            "descricao" => $this->descricao,
            "codigoDeBarras" => $this->codigoDeBarras,
            "imagem" => $this->imagem,
            "imagemType" => $this->imagemType,
            "fabricante" => $this->fabricante,
            "validade" => $this->validade
        );
    }
}

function insertProduto($produto){
    $query = "INSERT INTO Produto(nome,descricao,codigoDeBarras,imagem,imagemType,fabricante,validade) VALUES (:nome,:descricao,:codigoDeBarras,:imagem,:imagemType,:fabricante,:validade)";

    unset($parameters);
    $parameters = array(
        "nome" => $produto->nome,
        "descricao" => $produto->descricao,
        "codigoDeBarras" => $produto->codigoDeBarras,
        "imagem" => $produto->imagem,
        "imagemType" => $produto->imagemType,
        "fabricante" => $produto->fabricante,
        "validade" => $produto->validade
    );

    if(Database::execute($query, $parameters)){
        return true;
    }
    // Se der problema na inserção, retorna false;
    return false;
}


function getProdutos($parametersValues = null){
    $queryColums = [
                    "idProduto",
                    "nome",
                    "descricao",
                    "codigoDeBarras",
                    "imagem",
                    "imagemType",
                    "fabricante",
                    "validade"];
    
    $queryTable = "produto";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, null);
    $produtos = array();
    if($result != null && count($result) > 0) {
        foreach($result as $row){
            array_push($produtos, 
                new Produto(
                    $row["idProduto"],
                    $row['nome'], 
                    $row['descricao'], 
                    $row['codigoDeBarras'], 
                    $row['imagem'], 
                    $row['imagemType'], 
                    $row['fabricante'], 
                    $row['validade'])
                );
        }
    }
    return $produtos;
}

function removeProduto($idProduto) {
    $query = "DELETE FROM Produto WHERE idProduto = :idProduto";

    unset($parameters);
    $parameters = array(
        "idProduto" => $idProduto
    );

    if(Database::execute($query, $parameters)){
        return true;
    }
    // Se der problema na inserção, retorna false;
    return false;
}
?>
