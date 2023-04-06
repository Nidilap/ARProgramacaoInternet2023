<?php

class RegisterController extends MainController {
    private $viewRegister = "view/registerView.php";
    private $successPath = "view/homeView.php";
    private $modelEstado = "model/DAOestado.php";
    private $modelCidade = "model/DAOcidade.php";
    private $modelUsuario = "model/DAOusuario.php";
    

    public $cidades = null;
    public $estados = null;

    public function loadPage($popup){

        $this->requireDaoEstado();
        $this->requireDaoCidade();
        $this->estados = getEstado();
        $this->cidades = getCidade();

        parent::loadPage($this->viewRegister);
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

    private function JsonEncoder($arr){
        $jsonEncode = json_encode($arr);
        return "RegisterController".$jsonEncode."RegisterController";
    }

    public function check(){
        if (isset($_POST['submit'])) {
            $this->requireDaoUsuario();
            $this->requireDaoCidade();

            $cidade2 = $_POST['usuario-cidade'];
            $cidadeSelecionada = getCidade(array("idCidade" => $_POST['usuario-cidade']))[0]->idCidade;

            $usuario = new Usuario(null, $_POST['usuario-email'], $_POST['usuario-usuario'], hash('sha256', $_POST['usuario-senha']), $_POST['usuario-nome'], $cidadeSelecionada, $_POST['usuario-endereco'], "", $_POST['usuario-nascimento'], "", "");

            if (count(getUsuarios(array('email' => $usuario->email))) > 0) {
                $this->popup = 'E-mail já em uso.';
                //Inclui a view novamente com o erro do popup
                $this->loadPage($this->popup);
            } else {
                if (count(getUsuarios(array('usuario' => $usuario->usuario))) > 0) {
                    $this->popup = 'Usuário já estava registrado.';
                    $this->loadPage($this->popup);
                } else {
                    // Insere o usuário no banco
                    $result = insertUsuario($usuario);

                    if ($result === false) {
                        $this->popup = ':( Ocorreu um problema ao cadastrar';
                        $this->loadPage($this->popup);
                    } else {
                        $_SESSION['usuario'] = $usuario->usuario;
                        $_SESSION['senha'] = $usuario->senha;

                        parent::route("HomeController");
                        die();
                    }
                }
            }
        } else {
            $this->loadPage("Erro.");
        }
    }

    public function getCidadesDoEstado(){
        $this->requireDaoEstado();
        $this->requireDaoCidade();

        $codigoEstado = getEstado(array("idEstado" => $_POST["estado"]))[0]->idEstado;

        $cidade =  getCidade(array("idEstado" => $codigoEstado));

        $dadosEncodados = $this->JsonEncoder($cidade);
        echo $dadosEncodados;
    }
}

?>
