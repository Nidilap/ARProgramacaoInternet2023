<!doctype html>
<html lang="en">
  <head>
    <title>Registro</title>
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
    <!-- scrollbar -->
    <link rel="stylesheet" href="Components/customScrollbar/css/customScrollbar.css">
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
      if(isset($popup) && $popup != ""){
        echo("<div id='overlay' onclick='closePopup();'><div id='text'>".$popup."</div></div>");
      }
    ?>
    <div class="block"></div>
    <form action="index.php?controller=RegisterController&action=check" method="post" style="padding-right:5vw; padding-left:5vw;">
    <div class="container row-containment bg-color radius30px block-selection padding" style="margin-top: 5vh; margin-bottom: 5vh; max-width:650px;">
      <div class="row mx-auto text-center">
          <div class="col form-title">
              Criar um perfil
          </div>
      </div>
      <div class="row">
          <div class="col-12">
              <div class="input-group mb-2 txt-dark m-t-10" field="Name">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-user flat-icon"></label></div>
                </div>
                <input type="text" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="usuario-nome" name="usuario-nome" placeholder="Name"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col">
              <div class="input-group mb-2 txt-dark m-t-10" field="Email">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><i class="fas fa-at flat-icon"></i></div>
                </div>
                <input type="email" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="usuario-email" name="usuario-email" placeholder="Email"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Usuario">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-user flat-icon"></label></div>
                </div>
                <input type="text" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="usuario-usuario" name="usuario-usuario" placeholder="Usuario"> <!-- invalid to display wrong data input -->
              </div>
          </div>
          <div class="col-12 col-md-6">
              <div class="input-group mb-2 txt-dark m-t-10" field="Senha">
                <div class="input-group-prepend">
                  <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-key flat-icon"></label></div>
                </div>
                <input type="password" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="usuario-senha" name="usuario-senha" placeholder="Senha"> <!-- invalid to display wrong data input -->
              </div>
          </div>
      </div>
      <div class="row">
      <div class="col-12 col-md-6">
            <div class="input-group mb-2 txt-dark m-t-10" field="Estado">
              <div class="input-group-prepend">
                <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-map-marked-alt flat-icon"></label></div>
              </div>

              <div class="md-select form-control radius-0 bg-none border-none border-bottom focused">
                <label>Estado</label>
                <select name="usuario-estado" id="usuario-estado" class="validate">
                  <option value="">Selecione uma opção</option>
                  <?php
                    if(isset($estado)){
                      foreach($estado as $row){
                        echo "<option value=".$row->idEstado.">".$row->nome."</option>";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="input-group mb-2 txt-dark m-t-10" field="Cidade">
              <div class="input-group-prepend">
                <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-map-marker-alt flat-icon"></label></div>
              </div>
              
              <div class="md-select form-control radius-0 bg-none border-none border-bottom focused">
                <label>Cidade</label>
                <select name="usuario-cidade" id="usuario-cidade" class="validate">
                  <option value="">Selecione uma opção</option>
                  <?php
                    if(isset($cidade)){
                      foreach($cidade as $row){
                        echo "<option value=".$row->idCidade.">".$row->nome."</option>";
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="input-group mb-2 txt-dark m-t-10" field="Endereço">
            <div class="input-group-prepend">
              <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-road flat-icon"></label></div>
            </div>
            <input type="address" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="usuario-endereco" name="usuario-endereco" placeholder="Address" data-toggle="tooltip" data-placement="bottom" title="via nomeVia, numero"> <!-- invalid to display wrong data input -->
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col-12 col-md-12">
            <div class="input-group mb-2 txt-dark m-t-10" field="Nascimento">
              <div class="input-group-prepend">
                <div class="input-group-text radius-50 bg-none border-none"><label class="fas fa-calendar-alt flat-icon"></label></div>
              </div>
              <input type="date" class="form-control radius-0 bg-none border-none border-bottom focused validate" id="usuario-nascimento" name="usuario-nascimento" placeholder="Birthdate"> <!-- invalid to display wrong data input -->
            </div>
          </div>
        </div>
      <div class="row btn-color-cyan btn-txt-color-light btn-txt-color-light-hover">
        <button type="submit" name="submit" class="mx-auto btn waves-button waves-float waves-teal radius-50" id="startValidate">Criar um usuário</button>
      </div>
    </div>
    </form>
    <script type="text/javascript">      
      $("form").submit(function( event ) {
        $(".validate").each(function(){ 
          validateField($(this)); 
        });
      });

      //ao selecionar o estado
      function selectMenu(){
        $("#usuario-estado").on('change', function() {
          //executa uma função para obter as cidades
          setTimeout(() => {
            $.post("index.php?controller=registerController&action=getEstadosRequeridos",
              {
                  estado: $("#usuario-estado").val(),
              },
              function (data, status) {
                let temp = data.match(new RegExp("registerController(.*)registerController"));
                data = temp!==null?temp[1]:null;
                // pega os dados e salva numa lista
                if(data!==null){
                  var cidade = JSON.parse(data);

                  let selectCidade = $("#usuario-cidade");
                  selectCidade.val("");
                  selectCidade.empty();
                  
                  selectCidade.append("<option value=''>Selecione uma opção</option>")
                  for (var i = 0; i < cidade.length; i++) {
                    selectCidade.append($("<option>").text(cidade[i].nome).val(cidade[i].idCidade));
                  }

                }
              });
          }, 0);
        });
      }

      selectMenu();
      $(document).ajaxComplete (function(){
        selectMenu();
      });
    </script>
  </body>
</html>