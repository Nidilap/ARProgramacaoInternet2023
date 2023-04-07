<div class="block"></div>
<div class="container row-containment bg-color radius30px block-selection padding"
    style="margin-top: 5vh; margin-bottom: 5vh; max-width:500px;">
    <div class="row mx-auto text-center">
        <div class="col form-title">
            Login
        </div>
    </div>
    <form id="loginForm" action="index.php?controller=LoginController&action=check" method="post">
        <div class="row">
            <div class="col">
                <div class="input-group mb-2 txt-dark m-t-10" field="Usuario">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-user flat-icon"></label></div>
                    </div>
                    <input type="text"
                        class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-usuario" name="usuario-usuario" placeholder="Usuário">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-2 txt-dark m-t-10" field="Senha">
                    <div class="input-group-prepend">
                        <div class="input-group-text radius-50 bg-none border-none"><label
                                class="fas fa-key flat-icon"></label></div>
                    </div>
                    <input type="password" class="form-control radius-0 bg-none border-none border-bottom focused validate"
                        id="usuario-senha" name="usuario-senha" placeholder="Senha">
                </div>
            </div>
        </div>
        <div class="row btn-color-cyan btn-txt-color-light btn-txt-color-light-hover">
            <button type="submit" name="submit" class="mx-auto btn waves-button waves-float waves-teal radius-50"
                id="startValidate">Login</button>
        </div>
    </form>
    <div class="row">
        <form action="register" method="post" class="centered">
            <button type="submit" class="text-center link" style="background-color: transparent; border: none;">Criar
                um usuário</button>
        </form>
    </div>
</div>
<!-- end content -->
<script type="text/javascript">
$("#loginForm").submit(function(event) {
  $(".validate").each(function() {
      validateField($(this));
  });
});
</script>