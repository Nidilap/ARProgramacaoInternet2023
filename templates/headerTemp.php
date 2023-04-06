<!doctype html>
<html lang="pt-br">
  <head>
    <title>AR Programacao Internet</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- jQuery -->
    <script src="Components/jquery/3.3.1/js/jquery.js"></script>
    <script src="Components/jquery/3.3.1/js/jqueryPlus.js"></script>

    <!-- Popper -->
    <script src="Components/popper/js/popper.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="Components/bootstrap/4.2/css/bootstrap.css">
    <script src="Components/bootstrap/4.2/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/generalstyles.css"><!-- block-selection-->
    <link rel="stylesheet" href="css/estilocomdiv.css">
    <link rel="stylesheet" href="css/util.css">
    
    <link rel="stylesheet" href="Components/fontAWESOME/css/all.css">
    
    <!-- minimal Framework -->
    <link rel="stylesheet" href="Components/minimal/css/minimal.css">
    <script type="text/javascript" src="Components/minimal/js/minimal.js"></script>
    <!-- radio -->
    <link rel="stylesheet" href="Components/radio/css/radio.css">
    <!-- file -->
    <link rel="stylesheet" href="Components/file/css/file.css">
    <!-- waves -->
    <link rel="stylesheet" href="Components/waves/css/waves.css">
    <script src="Components/waves/js/waves.js"></script>
    <!-- customSelect -->
    <link rel="stylesheet" href="Components/customSelect/css/customSelect.css">
    <script src="Components/customSelect/js/customSelect.js"></script>
    <!-- POPUP -->
    <link rel="stylesheet" type="text/css" href="Components/popup/css/popup.css">
    <script src="Components/popup/js/popup.js"></script>
  </head>
  <body>
    <?php 
    
      $usuario = $_SESSION ? $_SESSION['usuario'] : null;
      if(isset($usuario)) {        
        echo '<nav class="navbar navbar-light bg-primary justify-content-between navbarPrincipal">
          <a class="navbar-brand">Produtos</a>
        </nav>';
      }
    ?>
    <?php
      if(isset($this->popup) && $this->popup != ""){
        echo("<div id='overlay' onclick='closePopup();'><div id='text'>".$this->popup."</div></div>");
      }
    ?>