<?php
require_once('cabecalho.php');

?>

<style type="text/css">
    body {
        background: #f2f2f2;
    }
</style>

<div class="main-container" style="background:#fff">
    <!-- css interno acima faz toda o background ficar com tom de cinza, menos tudo que está dentro do main-container, pois o css inline dele deixa background branco (#fff) -->
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <div class="navbar-brand" href="index.php">
                <a href="adicionais.php" class="link-neutro">
                    <!-- se não tiver adicionais, não volta para adicionais.php, volta direto para itens.php -->
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px">RESUMO DO ITEM</span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <div class="destaque">
        <b>PIZZA CALABREZA</b>
    </div>


    <div class="destaque-qtd">
        <b>QUANTIDADE: </b>
        <span class="direita">
            <big>
                <span>
                    <i class="bi bi-dash-circle-fill text-danger"></i>
                </span>
                <span> 1 </span>

                <span>
                    <i class="bi bi-plus-circle-fill text-success"></i>
                </span>
            </big>

        </span>
    </div>

    <div class="destaque-qtd">
        <b>OBSERVAÇÕES: </b>

        <div class="form-group">
            <label for="obs"></label>
            <textarea name="obs" class="form-control"></textarea>
        </div>

    </div>
</div>

<div class="d-grid gap-2 mt-4 abaixo">
    <a href="#popup2" class="btn btn-primary no-border-radius">ADICIONAR AO CARRINHO</a>
</div>

<div class="total-item">
    <span><b>TOTAL: </b></span>
    <span class="direita"><b>R$ 25,00</b></span>

</div>

<div id="popup2" class="overlay2">
    <div class="popup2">
        <div class="row">
            <div class="col-12">
                <div class="card-add-carrinho">
                    <a class="close" href="#">&times;</a>
                    <form action="carrinho.php" method="post">

                        <div class="row">
                            <div class="col-6">
                                <div class="group">
                                    <input type="text" class="input" name="telefone" id="telefone" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="label">Telefone</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="group">
                                    <input type="text" class="input" name="nome" id="nome" required>
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="label">Nome</label>
                                </div>
                            </div>

                            <div class="row" align="center">
                                <div class="col-6">
                                    <a href="index.php" class="btn btn-primary" style="width:100%">COMPRAR MAIS</a>
                                </div>

                                <div class="col-6">
                                    <button class="btn btn-success" style="width:100%">FINALIZAR COMPRA</button>
                                </div>

                                <br>
                                <small>
                                    <div id="mensagem" align="center"></div>
                                </small>

                            </div>

                        </div>
                </div>
                </form>
            </div>
        </div>

    </div>

</div>
</div>

<!-- jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>

<!-- Mascaras JS -->
<script type="text/javascript" src="js/mascaras.js"></script>

<!-- jQuery para Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

<?php
require_once('rodape.php');
?>

