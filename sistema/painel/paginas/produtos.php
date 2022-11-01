<?php
$pag = 'produtos';
?>

<a onclick="inserir()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Novo Produto</a>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>

<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" required>
                            </div>
                        </div>

                        <div class="col-md-5">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Categoria</label>
                                <select class="form-control sel2" id="categoria" name="categoria" style="width:100%;">

                                    <?php
                                    $query = $pdo->query("SELECT * FROM categorias ORDER BY id asc");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $total_reg = @count($res);

                                    if ($total_reg > 0) {
                                        for ($i = 0; $i < $total_reg; $i++) {
                                            foreach ($res[$i] as $key => $value) {
                                            }
                                            echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="0">Cadastre uma Categoria</option>';
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descrição <small>(Até 1000 Caracteres)</small></label>
                                <input maxlength="1000" type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição do Produto">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor Compra</label>
                                <input type="text" class="form-control" id="valor_compra" name="valor_compra" placeholder="Valor Compra">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor Venda</label>
                                <input type="text" class="form-control" id="valor_venda" name="valor_venda" placeholder="Valor Venda">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estoque Mínimo</label>
                                <input type="number" class="form-control" id="nivel_estoque" name="nivel_estoque" placeholder="Nível Mínimo">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tem Estoque?</label>
                                <select class="form-control sel2" id="tem_estoque" name="tem_estoque" style="width:100%;">

                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Foto</label>
                                <input class="form-control" type="file" name="foto-produto" onChange="carregarImg();" id="foto-produto">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="divImg">
                                <img src="images/produtos/sem-foto.jpg" width="80px" id="target-produto">
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
                <button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-7">
                        <span><b>Categoria: </b></span>
                        <span id="categoria_dados"></span>
                    </div>
                    <div class="col-md-5">
                        <span><b>Valor Compra: </b></span>
                        <span id="valor_compra_dados"></span>
                    </div>

                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-7">
                        <span><b>Valor Venda: </b></span>
                        <span id="valor_venda_dados"></span>
                    </div>

                    <div class="col-md-5">
                        <span><b>Estoque: </b></span>
                        <span id="estoque_dados"></span>
                    </div>

                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">

                    <div class="col-md-6">
                        <span><b>Alerta Nível Mínimo Estoque: </b></span>
                        <span id="nivel_estoque_dados"></span>
                    </div>

                    <div class="col-md-6">
                        <span><b>Tem Estoque: </b></span>
                        <span id="tem_estoque_dados"></span>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-12">
                        <span><b>Descrição: </b></span>
                        <span id="descricao_dados"></span>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12" align="center">
                        <img width="250px" id="target_mostrar">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Saida-->
<div class="modal fade" id="modalSaida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="nome_saida"></span></h4>
                <button id="btn-fechar-saida" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-saida">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">

                                <input type="number" class="form-control" id="quantidade_saida" name="quantidade_saida" placeholder="Quantidade Saída" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" id="motivo_saida" name="motivo_saida" placeholder="Motivo Saída" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </div>
                    </div>

                    <input type="hidden" id="id_saida" name="id"> <!-- na modalInserir já usou id=id para passar o id como hidden, por isso mudou de id, já o name pode repetir, e é o id do produto -->
                    <input type="hidden" id="estoque_saida" name="estoque">

                </form>

                <br>
                <small>
                    <div id="mensagem-saida" align="center"></div>
                </small>
            </div>

        </div>
    </div>
</div>

<!-- Modal Entrada-->
<div class="modal fade" id="modalEntrada" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="nome_entrada"></span></h4>
                <button id="btn-fechar-entrada" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-entrada">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">

                                <input type="number" class="form-control" id="quantidade_entrada" name="quantidade_entrada" placeholder="Quantidade Entrada" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" id="motivo_entrada" name="motivo_entrada" placeholder="Motivo Entrada" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </div>
                    </div>

                    <input type="hidden" id="id_entrada" name="id"> <!-- na modalInserir já usou id=id para passar o id como hidden, por isso mudou de id -->
                    <input type="hidden" id="estoque_entrada" name="estoque">

                </form>

                <br>
                <small>
                    <div id="mensagem-entrada" align="center"></div>
                </small>
            </div>

        </div>
    </div>
</div>

<!-- Modal Variações-->
<div class="modal fade" id="modalVariacoes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_nome_var"></span></h4>
                <button id="btn-fechar-var" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-var">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sigla</label>
                                <input maxlength="5" type="text" class="form-control" id="sigla" name="sigla" placeholder="P / M / G" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input maxlength="50" type="text" class="form-control" id="nome_var" name="nome" placeholder="Pequena / Média ...">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor</label>
                                <input type="text" class="form-control" id="valor_var" name="valor" placeholder="50,00" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Descrição</label>
                                <input maxlength="50" type="text" class="form-control" id="descricao_var" name="descricao" placeholder="8 Fatias">
                            </div>
                        </div>

                        <div class="col-md-3" style="margin-top: 20px">
                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </div>
                    </div>

                    <input type="hidden" id="id_prod_var" name="id_prod_var"> <!-- esse não é o id da variação, é o id_produto da variação, campo produto -->

                </form>

                <br>
                <small>
                    <div id="mensagem-var" align="center"></div>
                </small>

                <hr>
                <div id="listar-var"></div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Ingredientes-->
<div class="modal fade" id="modalIngredientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_nome_ing"></span></h4>
                <button id="btn-fechar-ing" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-ing">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <input maxlength="50" type="text" class="form-control" id="nome_ing" name="nome_ing" placeholder="Ingrediente" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </div>
                    </div>

                    <input type="hidden" id="id_prod_ing" name="id_prod_ing">
                </form>

                <br>
                <small>
                    <div id="mensagem-ing" align="center"></div>
                </small>
                <hr>
                <div id="listar-ing"></div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Adicionais-->
<div class="modal fade" id="modalAdicionais" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"><span id="titulo_nome_adc"></span></h4>
                <button id="btn-fechar-adc" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-adc">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input maxlength="50" type="text" class="form-control" id="nome_adc" name="nome_adc" placeholder="Adicional" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="valor_adc" name="valor_adc" placeholder="Valor" required>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Salvar</button>

                        </div>
                    </div>

                    <input type="hidden" id="id_prod_adc" name="id_prod_adc">
                </form>

                <br>
                <small>
                    <div id="mensagem-adc" align="center"></div>
                </small>
                <hr>
                <div id="listar-adc"></div>
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
    function carregarImg() {
        var target = document.getElementById('target-produto');
        var file = document.querySelector("#foto-produto").files[0];

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
    function editar(id, nome, categoria, descricao, valor_compra, valor_venda, foto, nivel_estoque, tem_estoque) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#valor_venda').val(valor_venda);
        $('#valor_compra').val(valor_compra);
        $('#categoria').val(categoria).change();
        $('#descricao').val(descricao);
        $('#nivel_estoque').val(nivel_estoque);
        $('#tem_estoque').val(tem_estoque).change();

        $('#titulo_inserir').text('Editar Registro');
        $('#modalForm').modal('show');
        $('#foto-produto').val('');
        $('#target-produto').attr('src', 'images/produtos/' + foto);
    }

    function mostrar(nome, categoria, descricao, valor_compra, valor_venda, estoque, foto, nivel_estoque, tem_estoque) {

        $('#nome_dados').text(nome);
        $('#valor_compra_dados').text(valor_compra);
        $('#categoria_dados').text(categoria);
        $('#valor_venda_dados').text(valor_venda);
        $('#descricao_dados').text(descricao);
        $('#estoque_dados').text(estoque);
        $('#nivel_estoque_dados').text(nivel_estoque);
        $('#tem_estoque_dados').text(tem_estoque);

        $('#target_mostrar').attr('src', 'images/produtos/' + foto);

        $('#modalDados').modal('show');
    }

    function limparCampos() {
        $('#id').val('');
        $('#nome').val('');
        $('#valor_compra').val('');
        $('#valor_venda').val('');
        $('#descricao').val('');
        $('#foto-produto').val('');
        $('#target-produto').attr('src', 'images/produtos/sem-foto.jpg');
    }

    function entrada(id, nome, estoque) {

        $('#nome_entrada').text(nome);
        $('#estoque_entrada').val(estoque);
        $('#id_entrada').val(id);

        $('#modalEntrada').modal('show');
    }

    function saida(id, nome, estoque) {

        $('#nome_saida').text(nome);
        $('#estoque_saida').val(estoque);
        $('#id_saida').val(id);

        $('#modalSaida').modal('show');
    }

    //variações
    function variacoes(id, nome) {

        $('#titulo_nome_var').text(nome);
        $('#id_prod_var').val(id);

        listarVariacoes(id);
        $('#modalVariacoes').modal('show');
        limparCamposVariacoes(); //fiquei meia hora para descobrir isso erro, não estava passando nada em id_prod_var, pois em limparCamposVariacoes tinha $('#id_prod_var').val('');

    }

    function limparCamposVariacoes() {
        $('#sigla').val('');
        $('#nome_var').val('');
        $('#valor_var').val('');
        $('#descricao_var').val('');

    }

    function listarVariacoes(id_prod_var) {
        $.ajax({
            url: 'paginas/' + pag + "/listar-variacoes.php",
            method: 'POST',
            data: {
                id_prod_var
            },
            dataType: "html", //não é texto, é html

            success: function(result) {
                $("#listar-var").html(result); //joga o resultado que trazer de listar.php na div com id listar
                $('#mensagem-var').text('');
            }
        });
    }

    function excluirVar(id) {

        var id_prod_var = $('#id_prod_var').val();

        $.ajax({
            url: 'paginas/' + pag + "/excluir-variacoes.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Excluído com Sucesso!") {
                    listarVariacoes(id_prod_var);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }

            },

        });
    }

    function ativarVar(id, acao) {

        var id_prod_var = $('#id_prod_var').val();

        $.ajax({
            url: 'paginas/' + pag + "/mudar-status-variacoes.php",
            method: 'POST',
            data: {
                id,
                acao
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Alterado com Sucesso!") {
                    listarVariacoes(id_prod_var);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }

            },

        });
    }

    //ingredientes
    function ingredientes(id, nome) {

        $('#titulo_nome_ing').text(nome);
        $('#id_prod_ing').val(id);

        listarIngredientes(id);
        $('#modalIngredientes').modal('show');
        limparCamposIngredientes();

    }

    function limparCamposIngredientes() {
        $('#nome_ing').val('');

    }

    function listarIngredientes(id_prod_ing) {
        $.ajax({
            url: 'paginas/' + pag + "/listar-ingredientes.php",
            method: 'POST',
            data: {
                id_prod_ing
            },
            dataType: "html", //não é texto, é html

            success: function(result) {
                $("#listar-ing").html(result); //joga o resultado que trazer de listar.php na div com id listar
                $('#mensagem-ing').text('');
            }
        });
    }

    function excluirIng(id) {

        var id_prod_ing = $('#id_prod_ing').val();

        $.ajax({
            url: 'paginas/' + pag + "/excluir-ingredientes.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Excluído com Sucesso!") {
                    listarIngredientes(id_prod_ing);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }

            },

        });
    }

    function ativarIng(id, acao) {

        var id_prod_ing = $('#id_prod_ing').val();

        $.ajax({
            url: 'paginas/' + pag + "/mudar-status-ingredientes.php",
            method: 'POST',
            data: {
                id,
                acao
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Alterado com Sucesso!") {
                    listarIngredientes(id_prod_ing);
                } else {
                    $('#mensagem-excluir').addClass('text-danger')
                    $('#mensagem-excluir').text(mensagem)
                }

            },

        });
    }

    // adicionais

    function adicionais(id, nome) {

        $('#titulo_nome_adc').text(nome);
        $('#id_prod_adc').val(id);

        listarAdicionais(id);
        $('#modalAdicionais').modal('show');
        limparCamposAdicionais();

    }

    function limparCamposAdicionais() {
        $('#nome_adc').val('');
        $('#valor_adc').val('');

    }

    function listarAdicionais(id_prod_adc) {
        $.ajax({
            url: 'paginas/' + pag + "/listar-adicionais.php",
            method: 'POST',
            data: {
                id_prod_adc
            },
            dataType: "html", //não é texto, é html

            success: function(result) {
                $("#listar-adc").html(result); //joga o resultado que trazer de listar.php na div com id listar
                $('#mensagem-adc').text('');
            }
        });
    }

    function excluirAdc(id) {

        var id_prod_adc = $('#id_prod_adc').val();

        $.ajax({
            url: 'paginas/' + pag + "/excluir-adicionais.php",
            method: 'POST',
            data: {
                id
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Excluído com Sucesso!") {
                    listarAdicionais(id_prod_adc);
                } else {
                    $('#mensagem-adc').addClass('text-danger')
                    $('#mensagem-adc').text(mensagem)
                }

            },

        });
    }

    function ativarAdc(id, acao) {

        var id_prod_adc = $('#id_prod_adc').val();

        $.ajax({
            url: 'paginas/' + pag + "/mudar-status-adicionais.php",
            method: 'POST',
            data: {
                id,
                acao
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Alterado com Sucesso!") {
                    listarAdicionais(id_prod_adc);
                } else {
                    $('#mensagem-adc').addClass('text-danger')
                    $('#mensagem-adc').text(mensagem)
                }

            },

        });
    }
</script>

<script type="text/javascript">
    $("#form-saida").submit(function() {

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/saida.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-saida').text('');
                $('#mensagem-saida').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {

                    $('#btn-fechar-saida').click();
                    listar();

                } else {

                    $('#mensagem-saida').addClass('text-danger')
                    $('#mensagem-saida').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>

<script type="text/javascript">
    $("#form-entrada").submit(function() {

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/entrada.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-entrada').text('');
                $('#mensagem-entrada').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {

                    $('#btn-fechar-entrada').click();
                    listar();

                } else {

                    $('#mensagem-entrada').addClass('text-danger')
                    $('#mensagem-entrada').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>

<script type="text/javascript">
    $("#form-var").submit(function() {

        var id_prod_var = $('#id_prod_var').val();

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/inserir-variacoes.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-var').text('');
                $('#mensagem-var').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#btn-fechar-var').click();
                    listarVariacoes(id_prod_var);
                    limparCamposVariacoes();

                } else {

                    $('#mensagem-var').addClass('text-danger')
                    $('#mensagem-var').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>


<script type="text/javascript">
    $("#form-ing").submit(function() {

        var id_prod_ing = $('#id_prod_ing').val();

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/inserir-ingredientes.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-ing').text('');
                $('#mensagem-ing').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#btn-fechar-var').click();
                    listarIngredientes(id_prod_ing);
                    limparCamposIngredientes();

                } else {

                    $('#mensagem-ing').addClass('text-danger')
                    $('#mensagem-ing').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>

<script type="text/javascript">
    $("#form-adc").submit(function() {

        var id_prod_adc = $('#id_prod_adc').val();

        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: 'paginas/' + pag + "/inserir-adicionais.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {
                $('#mensagem-adc').text('');
                $('#mensagem-adc').removeClass()
                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#btn-fechar-var').click();
                    listarAdicionais(id_prod_adc);
                    limparCamposAdicionais();

                } else {

                    $('#mensagem-adc').addClass('text-danger')
                    $('#mensagem-adc').text(mensagem)
                }

            },

            cache: false,
            contentType: false,
            processData: false,

        });

    });
</script>