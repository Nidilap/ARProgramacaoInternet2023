<?php

class LoginController {
    private $viewLogin = "view/loginView.php";
    private $successPath = "success.php";
    private $modelEstado = "model/DAOestado.php";
    private $modelUsuario = "model/DAOusuario.php";

    public function loadPage($popup){
        include ($this->viewLogin);
    }

    private function requireDaoUsuario(){
        require_once $this->modelUsuario;
    }

    private function requireDaoEstado(){
        require_once $this->modelEstado;
    }

    public function check(){
        if(isset($_POST['submit'])){ //controllo per sicurezza
            session_start();
            $this->requireDaoUsuario();
        
            $usuario_usuario =  $_POST['usuario-usuario'];
            $usuario_senha =  hash('sha256',$_POST['usuario-senha']);
            $filterCredential = array('usuario'=>$usuario_usuario,'senha'=>$usuario_senha);
        
            if(count(getUsuarios($filterCredential)) == 1){//ho un riscontro
        
                $_SESSION['usuario'] = $usuario_usuario;
                $_SESSION['senha'] = $usuario_senha;
                
                //var_dump($_REQUEST);
                
                header("Location: ".$this->successPath); die();//chiamo la pagina di success
            } else {
                //prepare the popup in case of error login invalid
                $popup = 'Usuario invalido e senha';
                $this->loadPage($popup); //includo la view di login
            }
        } else {
            $this->loadPage("error incorrect program logic"); //non è passato per la logica corretta
            //the passed message is only for debug
        }
    }
    
}

?>
