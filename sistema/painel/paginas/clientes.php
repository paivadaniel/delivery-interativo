<?php
$pag = 'clientes';
?>

<a onclick="inserir()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Novo Cliente</a>

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
                                <label for="exampleInputEmail1">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logradouro</label>
                                <input type="text" class="form-control" id="logradouro" name="logradouro" placeholder="Rua">
                            </div>
                        </div>
                        <div class="col-md-3">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Número">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento">
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Bairro / Localidade</label>
                                <select class="form-control sel2" id="bairro" name="bairro" style="width:100%;">

                                    <?php
                                    $query = $pdo->query("SELECT * FROM bairros ORDER BY nome asc");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $total_reg = @count($res);
                                    if ($total_reg > 0) {
                                        for ($i = 0; $i < $total_reg; $i++) {
                                            foreach ($res[$i] as $key => $value) {
                                            }
                                            echo '<option value="' . $res[$i]['nome'] . '">' . $res[$i]['nome'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="0">Cadastre um Bairro</option>';
                                    }
                                    ?>

                                </select>
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

<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="nome_dados"></span></h4>
                <button id="btn-fechar-dados" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-6">
                        <span><b>Telefone: </b></span>
                        <span id="telefone_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Data: </b></span>
                        <span id="data_dados"></span>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-8">
                        <span><b>Rua: </b></span>
                        <span id="logradouro_dados"></span>
                    </div>
                    <div class="col-md-4">
                        <span><b>Número: </b></span>
                        <span id="numero_dados"></span>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-6">
                        <span><b>Complemento: </b></span>
                        <span id="complemento_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Localidade: </b></span>
                        <span id="bairro_dados"></span>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- na chamada do script abaixo, o src mais correto seria ../js/ajax.js, porém, essa página é aberta dentro de painel/index.php, portanto, o correto é js/ajax.js -->
<script type="text/javascript">
    var pag = "<?= $pag ?>";
</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function editar(id, nome, telefone, logradouro, numero, bairro, complemento){
		$('#id').val(id);
		$('#nome').val(nome);
		$('#telefone').val(telefone);
		$('#logradouro').val(logradouro);
		$('#numero').val(numero);
		$('#bairro').val(bairro).change();
		$('#complemento').val(complemento);
				
		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');
		
	}




	function mostrar(nome, telefone, logradouro, numero, bairro, complemento, data){

		$('#nome_dados').text(nome);		
		$('#logradouro_dados').text(logradouro);
		$('#numero_dados').text(numero);
		$('#bairro_dados').text(bairro);
		$('#data_dados').text(data);
		$('#complemento_dados').text(complemento);
		$('#telefone_dados').text(telefone);		
		
		$('#modalDados').modal('show');
	}


	function limparCampos(){
		$('#id').val('');
		$('#nome').val('');
		$('#telefone').val('');
		$('#logradouro').val('');
		$('#complemento').val('');		
		$('#numero').val('');
		
	}

</script>



