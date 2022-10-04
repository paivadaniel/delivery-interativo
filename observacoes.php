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
            <div class="col-11">

                <div class="row">
                    <div class="col-6">
                        <input type="text" name="telefone" class="form-control" placeholder="Seu Telefone" required>
                    </div>

                    <div class="col-6">
                        <input type="text" name="nome" class="form-control" placeholder="Seu Nome" required>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <a class="close" href="#">&times;</a>
            </div>
        </div>
        <hr class="linha">
        <div class="conteudo-popup">
            Aqui vamos colocar depois o conteúdo desse popup trazendo os itens que forem adicionados no carrinho
        </div>
    </div>
</div>
<?php
require_once('rodape.php');
?>