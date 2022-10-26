<?php
$pag = 'categorias';
?>

<a onclick="inserir()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Nova Categoria</a>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="titulo_inserir"></span></h4>
                <button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cor</label>

                                <select class="form-control sel2" id="cor" name="cor" style="width:100%;">
                                    <option value="azul">Azul</option>
                                    <option value="rosa">Rosa</option>
                                    <option value="azul-escuro">Azul Escuro</option>
                                    <option value="verde">Verde</option>
                                    <option value="roxo">Roxo</option>
                                    <option value="vermelho">Vermelho</option>
                                    <option value="verde-escuro">Verde Escuro</option>
                                    <option value="laranja">Laranja</option>
                                    <option value="amarelo">Amarelo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Descrição</label>
                                <input maxlength="255" type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Foto</label>
                                <input class="form-control" type="file" name="foto-categoria" onChange="carregarImg();" id="foto-categoria">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="divImg">
                                <img src="images/<?php echo $pag ?>/sem-foto.jpg" width="80px" id="target-categoria">
                            </div>
                        </div>

                    </div>

                    <input type="hidden" name="id" id="id">

                    <br>
                    <small>
                        <div id="mensagem" align="center"></div>
                    </small>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>


        </div>
    </div>
</div>

<!-- na chamada do script abaixo, o src mais correto seria ../js/ajax.js, porém, essa página é aberta dentro de painel/index.php, portanto, o correto é js/ajax.js -->
<script type="text/javascript">
    var pag = "<?= $pag ?>";
</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
    function carregarImg() {
        var target = document.getElementById('target-categoria');
        var file = document.querySelector("#foto-categoria").files[0];

        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);

        } else {
            target.src = "";
        }
    }
</script>

<script type="text/javascript">
    //as funções a seguir recebem parâmetros genéricos, por isso, não podem ser colocadas em ajax.js
    function editar(id, nome, descricao, foto, cor, ativo) {
        //recupera os valores do banco de dados para mostrar nos inputs da modal de editar dados do usuário
        //passa valor para os ids abaixo, que são únicos na página usuarios.php, e estão na modal com id=modalForm
        $('#id').val(id); //val é para input, text é para span e div
        $('#nome').val(nome);
        $('#descricao').val(descricao);
        $('#cor').val(cor).change();
        $('#ativo').val(ativo);

        $('#titulo_inserir').text('Editar Registro');
        $('#modalForm').modal('show');
        $('#foto-categoria').val('');
        $('#target-categoria').attr('src', 'images/' + pag + '/' + foto);
    }


    function limparCampos() {
        $('#id').val(''); //val é para input, text é para span e div
        $('#nome').val('');
        $('#descricao').val('');
        $('#cor').val('');
        $('#ativo').val('');

        $('#foto-categoria').val('');
        $('#target-categoria').attr('src', 'images/' + pag + '/' + 'sem-foto.jpg');
    }
</script>