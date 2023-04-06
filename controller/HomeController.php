<?php

class HomeController extends MainController {
    private $homeView = "view/homeView.php";
    private $modelProduto = "model/DAOproduto.php";

    public $produtos = null;

    public function loadPage($popup){

        $this->requireDaoProduto();
        $this->produtos = getProdutos();

        parent::loadPage($this->homeView);
    }

    private function requireDaoProduto(){
        require_once $this->modelProduto;
    }
    

    public function saveProduto(){
        $this->requireDaoProduto();



        $produto = new Produto(
            $_POST['idProduto'], 
            $_POST['nome'], 
            $_POST['descricao'], 
            '', 
            $_POST['imagemProduto'], 
            $_POST['imagemTipoProduto'],
            $_POST['fabricante'], 
            $_POST['validade']);

        $result = insertProduto($produto);

        if ($result === false) {
            $this->popup = ':( Ocorreu um problema ao cadastrar';
            $this->loadPage($this->popup);
        } else {
            $this->popup = 'Produto inserido com sucesso!';
            $this->loadPage($this->popup);
        }
            
    }

    public function removeProdutoController(){
        $this->requireDaoProduto();

        if(isset($_POST['idProdutoToRemove']) && $_POST['idProdutoToRemove'] != '') {
            
            $result = removeProduto($_POST['idProdutoToRemove']);

            if ($result === false) {
                $this->popup = ':( Ocorreu um problema ao cadastrar';
                $this->loadPage($this->popup);
            } else {
                $this->popup = 'Produto removido com sucesso!';
                $this->loadPage($this->popup);
            }
        } else {
            $this->loadPage("Erro.");
        }
    }  


}

?>