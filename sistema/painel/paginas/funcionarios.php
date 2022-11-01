<?php
$pag = 'funcionarios';
?>

<a onclick="inserir()" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Novo Funcionário</a>

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
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Nível</label>
                                <select class="form-control sel2" id="nivel" name="nivel" style="width:100%;">

                                    <?php
                                    $query = $pdo->query("SELECT * FROM niveis ORDER BY nome asc");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $total_reg = @count($res);

                                    if ($total_reg > 0) {
                                        for ($i = 0; $i < $total_reg; $i++) {
                                            foreach ($res[$i] as $key => $value) {
                                            }
                                            echo '<option value="' . $res[$i]['nome'] . '">' . $res[$i]['nome'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="0">Cadastre um Nível</option>';
                                    }
                                    ?>


                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo Chave Pix</label>
                                <select class="form-control" name="tipo_chave" id="tipo_chave">
                                    <option value="">Selecionar Chave</option>
                                    <option value="CPF">CPF</option>
                                    <option value="Telefone">Telefone</option>
                                    <option value="Email">Email</option>
                                    <option value="Código">Código</option>
                                    <option value="CNPJ">CNPJ</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Chave Pix</label>
                                <input type="text" class="form-control" id="chave_pix" name="chave_pix" placeholder="Chave Pix">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Foto</label>
                                <input class="form-control" type="file" name="foto-usuario" onChange="carregarImg();" id="foto-usuario">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="divImg">
                                <img src="images/perfil/sem-foto.jpg" width="80px" id="target-usuario">
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
                        <span><b>Email: </b></span>
                        <span id="email_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Data de Cadastro: </b></span>
                        <span id="data_dados"></span>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-6">
                        <span><b>CPF: </b></span>
                        <span id="cpf_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Telefone: </b></span>
                        <span id="telefone_dados"></span>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">
                    <div class="col-md-6">
                        <span><b>Nível: </b></span>
                        <span id="nivel_dados"></span>
                    </div>
                    <div class="col-md-6">
                        <span><b>Ativo: </b></span>
                        <span id="ativo_dados"></span>
                    </div>
                </div>

                <div class="row" style="border-bottom: 1px solid #cac7c7;">

                    <div class="col-md-6">
                        <span><b>Tipo Chave: </b></span>
                        <span id="tipo_chave_dados"></span>
                    </div>

                    <div class="col-md-6">
                        <span><b>Chave Pix: </b></span>
                        <span id="chave_pix_dados"></span>
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

<!-- na chamada do script abaixo, o src mais correto seria ../js/ajax.js, porém, essa página é aberta dentro de painel/index.php, portanto, o correto é js/ajax.js -->
<script type="text/javascript">
    var pag = "<?= $pag ?>";
</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
    function carregarImg() {
        var target = document.getElementById('target-usuario');
        var file = document.querySelector("#foto-usuario").files[0];

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
    function editar(id, nome, email, senha, nivel, foto, telefone, cpf, tipo_chave, chave_pix) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#email').val(email);
        $('#telefone').val(telefone);
        $('#cpf').val(cpf);
        $('#cargo').val(nivel).change();
        $('#tipo_chave').val(tipo_chave).change();
        $('#chave_pix').val(chave_pix);


        $('#titulo_inserir').text('Editar Registro');
        $('#modalForm').modal('show');
        $('#foto').val('');
        $('#target').attr('src', 'images/perfil/' + foto);
    }

    function mostrar(nome, email, cpf, senha, nivel, data, ativo, telefone, foto, tipo_chave, chave_pix) {

        $('#nome_dados').text(nome);
        $('#email_dados').text(email);
        $('#cpf_dados').text(cpf);
        $('#senha_dados').text(senha);
        $('#nivel_dados').text(nivel);
        $('#data_dados').text(data);
        $('#ativo_dados').text(ativo);
        $('#telefone_dados').text(telefone);
        $('#tipo_chave_dados').text(tipo_chave);
        $('#chave_pix_dados').text(chave_pix);

        $('#target_mostrar').attr('src', 'images/perfil/' + foto);
        $('#modalDados').modal('show');
    }


    function limparCampos() {
        $('#id').val('');
        $('#nome').val('');
        $('#telefone').val('');
        $('#email').val('');
        $('#cpf').val('');
        $('#foto').val('');
        $('#chave_pix').val('');
        $('#target').attr('src', 'images/perfil/sem-foto.jpg');
    }
</script>