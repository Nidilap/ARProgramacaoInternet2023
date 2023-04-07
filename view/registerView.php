<div class="block"></div>
<form action="index.php?controller=RegisterController&action=check" method="post"
    style="padding-right:5vw; padding-left:5vw;">
    <div class="container row-containment bg-color radius30px block-selection padding"
        style="margin-top: 5vh; margin-bottom: 5vh; max-width:650px;">
        <div class="row mx-auto text-center">
            <div class="col form-title">
                Criar um perfil
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="input-group mb-2 txt-dark m-t-10" field="Name">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-user flat-icon"></label></div>
                    </div>
                    <input type="text"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-nome" name="usuario-nome" placeholder="Name">
                    <!-- invalid to display wrong data input -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-2 txt-dark m-t-10" field="Email">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><i
                                class="fas fa-at flat-icon"></i></div>
                    </div>
                    <input type="email"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-email" name="usuario-email" placeholder="Email">
                    <!-- invalid to display wrong data input -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="input-group mb-2 txt-dark m-t-10" field="Usuario">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-user flat-icon"></label></div>
                    </div>
                    <input type="text"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-usuario" name="usuario-usuario" placeholder="Usuario">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="input-group mb-2 txt-dark m-t-10" field="Senha">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-key flat-icon"></label></div>
                    </div>
                    <input type="password"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-senha" name="usuario-senha" placeholder="Senha">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="mb-2 txt-dark m-t-10 d-flex flex-row justify-content-center align-items-center" field="Estado">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-map-marked-alt flat-icon"></label></div>
                    </div>
                    <label for="usuario-estado" class="mx-1" style="margin-bottom: 0">Estado:</label>
                    <select name="usuario-estado" id="usuario-estado" class="validate" style="flex: 1">
                        <option value="">Selecione uma opção</option>
                        <?php
                            if(isset($this->estados)){
                            foreach($this->estados as $row){
                                echo "<option value=".$row->idEstado.">".$row->nome."</option>";
                            }
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-12">
                <div class="mb-2 txt-dark m-t-10 d-flex justify-content-center align-items-center" field="Cidade">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-map-marker-alt flat-icon"></label></div>
                    </div>
                    <label for="usuario-cidade" class="mx-1" style="margin-bottom: 0">Cidade:</label>
                    <select name="usuario-cidade" id="usuario-cidade" class="validate" style="flex: 1">
                        <option value="">Selecione uma opção</option>
                        <?php
                            if(isset($this->cidades)){
                            foreach($this->cidades as $row){
                                echo "<option value=".$row->idCidade.">".$row->nome."</option>";
                            }
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-2 txt-dark m-t-10" field="Endereço">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-road flat-icon"></label></div>
                    </div>
                    <input type="address"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-endereco" name="usuario-endereco" placeholder="Address" data-toggle="tooltip"
                        data-placement="bottom" title="via nomeVia, numero">
                    <!-- invalid to display wrong data input -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12">
                <div class="input-group mb-2 txt-dark m-t-10" field="Nascimento">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-calendar-alt flat-icon"></label></div>
                    </div>
                    <input type="date"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-nascimento" name="usuario-nascimento" placeholder="Birthdate">
                    <!-- invalid to display wrong data input -->
                </div>
            </div>
        </div>
        <div class="row btn-color-cyan btn-txt-color-light btn-txt-color-light-hover">
            <button type="submit" name="submit" class="mx-auto btn waves-button waves-float waves-teal radius-50"
                id="startValidate">Criar um usuário</button>
        </div>

        
        
        <div class="row">
            <a href="login" class="text-center link" style="background-color: transparent; border: none;">Já tenho um usuário</button>
        </div>
    </div>
</form>
<script type="text/javascript">
  $("form").submit(function(event) {
      $(".validate").each(function() {
          validateField($(this));
      });
  });

  //ao selecionar o estado
  function selectMenu() {
      $("#usuario-estado").on('change', function() {
          //executa uma função para obter as cidades
          setTimeout(() => {
              $.post("index.php?controller=RegisterController&action=getCidadesDoEstado", {
                      estado: $("#usuario-estado").val(),
                  },
                  function(data, status) {
                      let temp = data.match(new RegExp("RegisterController(.*)RegisterController"));
                      data = temp !== null ? temp[1] : null;
                      // pega os dados e salva numa lista
                      if (data !== null) {
                          var cidade = JSON.parse(data);

                          let selectCidade = $("#usuario-cidade");
                          selectCidade.val("");
                          selectCidade.empty();

                          selectCidade.append("<option value=''>Selecione uma opção</option>")
                          for (var i = 0; i < cidade.length; i++) {
                              selectCidade.append($("<option>").text(cidade[i].nome).val(cidade[i]
                                  .idCidade));
                          }

                      }
                  });
          }, 0);
      });
  }

  selectMenu();
  $(document).ajaxComplete(function() {
      selectMenu();
  });
</script>