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

    private function JsonEncoder($arr){
        $jsonEncode = json_encode($arr);
        return "HomeController".$jsonEncode."HomeController";
    }
    

    public function saveProduto(){
        $this->requireDaoProduto();
        $result = false;

        $produto = new Produto(
            $_POST['idProduto'], 
            $_POST['nome'], 
            $_POST['descricao'], 
            '', 
            $_POST['imagemProduto'], 
            $_POST['imagemTipoProduto'],
            $_POST['fabricante'], 
            $_POST['validade']);
            
        if($_POST['idProduto']) { // Caso haver um id, apenas atualizar.
            $result = updateProduto($produto);
        } else {    
            $result = insertProduto($produto);
        }


        if ($result === false) {
            $this->popup = ':( Ocorreu um problema ao cadastrar';
            $this->loadPage($this->popup);
        } else {
            $this->popup = 'Produto inserido com sucesso!';
            $this->loadPage($this->popup);
        }
    }

    public function updateProduto(){

        $idProdutoToEdit = $_POST['idProduto'];

        $result = insertProduto($produto);

                
        $index = array_search($idProdutoToEdit, array_column($this->produtos, 'idProduto'));

        if ($index !== false) {

            $produtoToEdit = $this->produto[$index];

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
            
            if ($result === false) {
                $this->popup = ':( Ocorreu um problema ao cadastrar';
                $this->loadPage($this->popup);
            } else {
                $this->popup = 'Produto inserido com sucesso!';
                $this->loadPage($this->popup);
            }
        } else {
            $this->popup = 'Não foi possível atualizar!';
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

    public function getProdutoEspecifico() {
        
        $this->requireDaoProduto();
        $produto = getProdutos(array("idProduto" => $_POST["idProduto"]))[0];

        $dadosEncodados = $this->JsonEncoder($produto);
        echo $dadosEncodados;
    }

}

?>