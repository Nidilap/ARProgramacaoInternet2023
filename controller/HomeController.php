<?php

class HomeController extends MainController {
    private $homeView = "view/homeView.php";

    public function loadPage($popup){

        parent::loadPage($this->homeView);
    }
    
}

?>
