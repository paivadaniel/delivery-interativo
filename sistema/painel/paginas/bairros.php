<?php
$pag = 'bairros';
?>

<a onclick="inserir()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Novo Bairro</a>

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
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor</label>
                                <input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required>
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
    //as funções a seguir recebem parâmetros genéricos, por isso, não podem ser colocadas em ajax.js
    function editar(id, nome, valor) {
        //recupera os valores do banco de dados para mostrar nos inputs da modal de editar dados do usuário
        //passa valor para os ids abaixo, que são únicos na página usuarios.php, e estão na modal com id=modalForm
        $('#id').val(id); //val é para atribuir valor input, text é para atribuir valor para span e div
        $('#nome').val(nome);
        $('#valor').val(valor);

        $('#titulo_inserir').text('Editar Registro');
        $('#modalForm').modal('show');
    }

    function limparCampos() {
        $('#id').val('');
        $('#nome').val('');
        $('#valor').val('');
    }
</script>