<?php

class RegisterController{
    private $viewRegister = "view/registerView.php";
    private $successPath = "view/homeView.php";
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
        $jsonEncode = json_encode($arr);
        return "registerController".$jsonEncode."registerController";
    }

    public function check(){
        if (isset($_POST['submit'])) { //controllo per sicurezza
            //register logic here
            session_start();
            $this->requireDaoUsuario();
            $this->requireDaoCidade();

            $cidade2 = $_POST['usuario-cidade'];
            $cidadeSelecionada = getCidade(array("idCidade" => $_POST['usuario-cidade']))[0]->idCidade;

            $usuario = new Usuario(null, $_POST['usuario-email'], $_POST['usuario-usuario'], hash('sha256', $_POST['usuario-senha']), $_POST['usuario-nome'], $cidadeSelecionada, $_POST['usuario-endereco'], "", $_POST['usuario-nascimento'], "", "");

            if (count(getUsuarios(array('email' => $usuario->email))) > 0) { //ho un riscontro qundi esiste gia un utente con quella mail
                $popup = 'E-mail já em uso.';
                //include the view
                $this->loadPage($popup);
            } else {
                if (count(getUsuarios(array('usuario' => $usuario->usuario))) > 0) { //ho un riscontro qundi esiste gia un utente con quel usuario
                    $popup = 'Usuário já estava registrado.';
                    //include the view
                    $this->loadPage($popup);
                } else {
                    //procedo ad inserire l'utente nel database
                    $result = insertUsuario($usuario);

                    if ($result === false) {
                        $popup = ':( Ocorreu um problema ao cadastrar';
                        $this->loadPage($popup); //include la view register
                    } else {
                        //echo("utente inserito");
                        $_SESSION['usuario'] = $usuario->usuario;
                        $_SESSION['senha'] = $usuario->senha;

                        header("Location: " . $this->successPath);
                        die(); //apre la nuova pagina
                    }
                }
            }
        } else {
            $this->loadPage("Erro.");
        }
    }

    public function getEstadosRequeridos(){
        $this->requireDaoEstado();
        $this->requireDaoCidade();

        //trovo il suo codice
        $codigoEstado = getEstado(array("idEstado" => $_POST["estado"]))[0]->idEstado;
        //ottengo le cidade con quel codice
        $cidade =  getCidade(array("idEstado" => $codigoEstado));
        //formatto i dati in json
        $dadosEncodados = $this->JsonEncoder($cidade);
        echo $dadosEncodados;
    }
}

?>
