<?php
require_once "Database.php";

class Usuario{

    private $idUsuario;
    private $email;
    private $usuario;
    private $senha;
    private $nome;
    private $idCidade;
    private $endereco;
    private $imagem;
    private $nascimento;
    private $descricao;
    private $banner;

    public function __construct($idUsuario, $email, $usuario, $senha, $nome, $idCidade, $endereco, $imagem, $nascimento, $descricao, $banner) {
        $this->idUsuario = $idUsuario;
        $this->email = $email;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->nome = $nome;
        $this->idCidade = $idCidade;
        $this->endereco = $endereco;
        $this->imagem = $imagem;
        $this->nascimento = $nascimento;
        $this->descricao = $descricao;
        $this->banner = $banner;
    }

    public function __get($property) {
        var_dump(__METHOD__);
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value) {
        var_dump(__METHOD__);
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}

function insertUsuario($usuario){
    $query = "INSERT INTO Usuario(email,usuario,senha,nome,idCidade,endereco,imagem,nascimento,descricao,banner) VALUES (:email,:usuario,:senha,:nome,:idCidade,:endereco,:imagem,:nascimento,:descricao,:banner)";

    unset($parameters);
    $parameters = array(
        "email" => $usuario->__get("email"),
        "usuario" => $usuario->__get("usuario"),
        "senha" => $usuario->__get("senha"),
        "nome" => $usuario->nome,
        "idCidade" => $usuario->idCidade,
        "endereco" => $usuario->endereco,
        "imagem" => $usuario->imagem,
        "nascimento" => $usuario->nascimento,
        "descricao" => $usuario->descricao,
        "banner" => $usuario->banner
    );

    if(Database::execute($query, $parameters)){
        return true;
    }
    // Se der problema na inserção, retorna false;
    return false;
}


function getUsuarios($parametersValues){
    $queryColums = [
                    "idUsuario",
                    "email",
                    "usuario",
                    "senha",
                    "nome",
                    "idCidade",
                    "endereco",
                    "imagem",
                    "nascimento",
                    "descricao",
                    "banner"];
    
    $queryTable = "usuario";
    
    $result = Database::getTuples($queryColums, $queryTable, null, $parametersValues, null);
    $usuarios = array();
    foreach($result as $row){
        array_push($usuarios, 
            new Usuario(
                $row["idUsuario"],
                $row['email'], 
                $row['usuario'], 
                $row['senha'], 
                $row['nome'], 
                $row['idCidade'], 
                $row['endereco'], 
                $row['imagem'], 
                $row['nascimento'], 
                $row['descricao'],
                $row['banner'])
            );
    }
    return $usuarios;
}
?>
