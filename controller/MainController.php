<?php
class MainController
{
    public $popup = "";
    public $isLogado = false;

    public function route($controllerToGo = null){

        $usuario = $_SESSION ? $_SESSION['usuario'] : null;
        $defaultController = 'LoginController';

        if(isset($usuario)) { // Se estiver logado, seta as variaveis abaixo
            $this->isLogado = true;
            $defaultController = "HomeController";
        }

        $publicControllers = array(
            "LoginController",
            "RegisterController"
        );



        if(isset($_GET['controller'])){
            $controllerGet = $_GET['controller'];
            if($this->isLogado || (!$this->isLogado && in_array($controllerGet, $publicControllers))) {
                $controller = $controllerGet;
            } else { // Caso não estiver logado e não for um controller público, redireciona para o login.
                $controller = "LoginController";
            }
        }else{
            $controller = $defaultController; //default
        }

        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = 'loadPage'; //default
        }

        if($controllerToGo) {
            $controller = $controllerToGo;

            // Caso for um routeamento, limpa os parametros da URL.

            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $url_components = parse_url($url);
            unset($url_components['query']);
            $url = $url_components['scheme'] . '://' . $url_components['host'] . $url_components['path'];
            if (isset($url_components['fragment'])) {
                $url .= '#' . $url_components['fragment'];
            }

            // Redirect to the new URL without parameters
            header("Location: $url");
        }

        include_once './controller/'.$controller.'.php';

        $controller = new $controller();
        $controller->$action("");
    }

    public function loadPage($pageToLoad) {
        include ("./templates/headerTemp.php");
        include ($pageToLoad);
        include ("./templates/footerTemp.php");
    }

    public function deslogar() {
        session_unset();
    }
}

?>