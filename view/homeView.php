<div class="block"></div>
<div class="row d-flex justify-content-center mt-3">
    <div class="col-lg-5 col-sm-12">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormProduto" onclick="clearAllInputs()"
            style="width: 100%">
            Criar novo produto
        </button>
    </div>
</div>

<div class="row d-flex justify-content-center mt-3 mx-3">
    <?php
        if(isset($this->produtos)){
            foreach($this->produtos as $row){
            
                $imageTag = '';
                if($row->imagem != '') {
                    $imageTag = '<div class="wrapperImgProduto"><img src="data:'.$row->imagemType.';base64,'.$row->imagem.'" alt="produto" class="imagemProduto" /></div>';
                }

                echo '<div class="col-3">
                    <div class="card m-auto text-align-center" >
                        '. $imageTag . ' 
                        <div class="card-body">
                            <h5 class="card-title">' . $row->nome . '</h5>
                            <p class="card-text">' . $row->descricao . '</p>
                            <p class="card-text"><strong>Fabricante: </strong>' . $row->fabricante . '</p>
                            <p class="card-text"><strong>Validade: </strong>' . $row->validade . '</p>
                            <div class="d-flex justify-content-center">
                                <button onClick="onEditProduto(' . $row->idProduto . ')" class="btn btn-primary mx-2">Editar</button>
                                <button onClick="removerProduto(' . $row->idProduto . ')" class="btn btn-danger mx-2">Remover</button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    ?>
</div>

<div class="modal fade" id="modalFormProduto" tabindex="-1" role="dialog" aria-labelledby="modalFormProdutoTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

        <form id="formProduto" style="width: 100%" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Criar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row hidden">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="produto-idProduto">Id do Produto</label>
                                <input type="text" class="form-control" name="produto-idProduto" placeholder="Id">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="produto-nome">Nome do Produto</label>
                                <input type="text" class="form-control validate" name="produto-nome"
                                    placeholder="Produto">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea type="text" class="form-control validate" name="produto-descricao"
                                    rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="produto-fabricante">Fabricante</label>
                                <input type="text" class="form-control validate" name="produto-fabricante"
                                    placeholder="Fabricante">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="produto-validade">Validade</label>
                                <input type="date" class="form-control validate" name="produto-validade"
                                    placeholder="dd/mm/aaaa">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="produto-imagem">Imagem</label>
                                <input type="file" class="form-control validate" name="produto-imagem" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" name="submit" id="botaoSaveProduto" class="btn btn-primary"
                        onclick="salvarProduto()">Salvar</button>
                    <!-- <button type="submit" class="mx-auto btn waves-button waves-float waves-teal radius-50"
                id="startValidate">Criar um usuário</button> -->
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">

function clearAllInputs() {
    let listaInputs = ['produto-idProduto', 'produto-nome', 'produto-descricao', 'produto-fabricante', 'produto-validade', 'produto-imagem'];
    listaInputs.map((inputAtual) => {
        $(`[name='${inputAtual}']`).val('');
    })
}

function onEditProduto(idProduto) {
    $.post("index.php?controller=HomeController&action=getProdutoEspecifico", {
            idProduto: idProduto
        },
        function(data, status) {
            let temp = data.match(new RegExp("HomeController(.*)HomeController"));
            data = temp !== null ? temp[1] : null;
            // pega os dados e salva numa lista
            if (data !== null) {

                let produto = JSON.parse(data)
                $("[name=produto-idProduto]").val(produto.idProduto);
                $("[name=produto-nome]").val(produto.nome);
                $("[name=produto-descricao]").val(produto.descricao);
                $("[name=produto-fabricante]").val(produto.fabricante);
                $("[name=produto-validade]").val(produto.validade);

                if(produto.imagem && produto.imagemType) {

                    // let b64 = `data:${produto.imagemType};base64,${produto.imagem}`;

                    var blob = b64toBlob(produto.imagem, produto.imagemType);
                    var file = new File([blob], 'imagemSalva', {type: produto.imagemType});

                    const dataTransfer = new DataTransfer();

                    dataTransfer.items.add(file);

                    const inputFile = document.querySelector('input[name="produto-imagem"]');

                    inputFile.files = dataTransfer.files;

                    $("#modalFormProduto").modal('show');
                }
            }
            
        });
}

function removerProduto(idProduto) {
    $.post("index.php?controller=HomeController&action=removeProdutoController", {
            idProdutoToRemove: idProduto
        },
        function(data, status) {
            location.reload();
        });
}

function salvarProduto() {
    $("#formProduto .validate").each(function() {
        validateField($(this));
    });

    let idProduto = $("[name=produto-idProduto]").val();
    let nomeProduto = $("[name=produto-nome]").val();
    let descricaoProduto = $("[name=produto-descricao]").val();
    let fabricanteProduto = $("[name=produto-fabricante]").val();
    let validadeProduto = $("[name=produto-validade]").val();
    let imagemProduto = $("[name=produto-imagem]");

    const file = imagemProduto[0].files[0];
    const reader = new FileReader();

    reader.onload = function() {
        const base64String = reader.result.split(',')[1];
        const fileType = file.type;

        $.post("index.php?controller=HomeController&action=saveProduto", {
                idProduto: idProduto,
                nome: nomeProduto,
                descricao: descricaoProduto,
                fabricante: fabricanteProduto,
                validade: validadeProduto,
                imagemProduto: base64String,
                imagemTipoProduto: fileType
            },
            function(data, status) {
                location.reload();
            });
    }

    reader.readAsDataURL(file);

}
</script>