<?php

class RegisterController{
    private $viewRegister = "view/registerView.php";
    private $successPath = "success.php";
    private $modelEstado = "model/DAOestado.php";
    private $modelCidade = "model/DAOcidade.php";
    private $modelUsuario = "model/DAOusuario.php";

    public function loadPage($popup){
        //carico e ottengo le cidade per il form cidade
        $this->requireDaoEstado();
        $this->requireDaoCidade();
        $estado = getEstado();
        $cidade = getCidade();

        include($this->viewRegister);
    }

    private function requireDaoUsuario(){
        require_once $this->modelUsuario;
    }

    private function requireDaoEstado(){
        require_once $this->modelEstado;
    }

    private function requireDaoCidade(){
        require_once $this->modelCidade;
    }

    //viene usata per encodare in formato json un array tra due stringhe
    private function JsonEncoder($arr){
        return "registerController".json_encode($arr)."registerController";
    }

    public function check(){
        if (isset($_POST['submit'])) { //controllo per sicurezza
            //register logic here
            session_start();
            $this->requireDaoUsuario();
            $this->requireDaoCidade();
            $usuario = new Usuario($_POST['usuario-usuario'], $_POST['usuario-email'], hash('sha256', $_POST['usuario-senha']), $_POST['usuario-nome'], getCidade(array("nome" => $_POST['usuario-cidade']))[0]->idCidade, $_POST['usuario-endereco'], $_POST['usuario-imagem'], $_POST['usuario-nascimento'], "", "", "");

            if (count(getUsuarios(array('email' => $usuario->__get("email")))) > 0) { //ho un riscontro qundi esiste gia un utente con quella mail
                $popup = 'Mail already used';
                //include the view
                $this->loadPage($popup);
            } else {
                if (count(getUsuarios(array('usuario' => $usuario->__get("usuario")))) > 0) { //ho un riscontro qundi esiste gia un utente con quel usuario
                    $popup = 'Usuario already used';
                    //include the view
                    $this->loadPage($popup);
                } else {
                    //procedo ad inserire l'utente nel database
                    $result = insertUsuario($usuario);

                    if ($result === false) {
                        $popup = ':( Something bad happend';
                        $this->loadPage($popup); //include la view register
                    } else {
                        //echo("utente inserito");
                        $_SESSION['usuario'] = $usuario->__get("usuario");
                        $_SESSION['senha'] = $usuario->__get("senha");

                        header("Location: " . $this->successPath);
                        die(); //apre la nuova pagina
                    }
                }
            }
        } else {
            $this->loadPage("error incorrect program logic"); //non è passato per la logica corretta
            //the passed message is only for debug
        }
    }

    public function getEstadosRequeridos(){
        $this->requireDaoEstado();
        $this->requireDaoCidade();
        //trovo il suo codice
        $codigoEstado = getEstado(array("nome" => $_POST["estado"]))[0]->__get("idEstado");
        //ottengo le cidade con quel codice
        $cidade =  getCidade(array("idEstado" => $codigoEstado));
        //formatto i dati in json
        echo $this->JsonEncoder($cidade);
    }
}

?>
