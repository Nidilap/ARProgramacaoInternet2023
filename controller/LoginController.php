<?php

class LoginController extends MainController {
    private $viewLogin = "view/loginView.php";
    private $successPath = "view/homeView.php";
    private $modelEstado = "model/DAOestado.php";
    private $modelUsuario = "model/DAOusuario.php";

    public function loadPage($popup){
        parent::loadPage($this->viewLogin);
    }

    private function requireDaoUsuario(){
        require_once $this->modelUsuario;
    }

    private function requireDaoEstado(){
        require_once $this->modelEstado;
    }

    public function check(){
        if(isset($_POST['submit'])){ //controllo per sicurezza
            $this->requireDaoUsuario();
        
            $usuario_usuario =  $_POST['usuario-usuario'];
            $usuario_senha =  hash('sha256',$_POST['usuario-senha']);
            $filterCredential = array('usuario'=>$usuario_usuario,'senha'=>$usuario_senha);
        
            if(count(getUsuarios($filterCredential)) == 1){//ho un riscontro
        
                $_SESSION['usuario'] = $usuario_usuario;
                $_SESSION['senha'] = $usuario_senha;
                
                parent::route("HomeController");
            } else {
                //prepare the popup in case of error login invalid
                $this->popup = 'Usuario e senha inválidos';
                $this->loadPage($this->popup); //includo la view di login
            }
        } else {
            $this->loadPage("erro do programa"); //non è passato per la logica corretta
            //the passed message is only for debug
        }
    }
    
}

?>
