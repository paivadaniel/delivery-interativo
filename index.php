<?php
require_once('cabecalho.php'); //sistema/conexao.php já está sendo requisitado em cabecalho.php

?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                <?php echo $nome_sistema; ?>
            </a>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <div class="row cards">
        <div class="col-6 col-md-4">
            <a class="link-card" href="itens.php">
                <div class="card azul">
                    <h3 class="card-title">PIZZAS</h3>
                </div> <!-- classe card do bootstrap já coloca uma borda automatizada ao inserir margin:10px no .card do css -->
                <!-- inicialmente havia setado col-6 col-md-4, porém, card tem margin e padding no style.css, daí para não quebrar as colunas tive que diminuir -->

            </a>
        </div>

        <div class="col-6 col-md-4">
            <a class="link-card" href="#">
                <div class="card vermelho">
                    <h3 class="card-title">ESFIHAS</h3>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
            <a class="link-card" href="#">
                <div class="card verde">
                    <h3 class="card-title">PASTÉIS</h3>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
            <a class="link-card" href="#">
                <div class="card azul-escuro">
                    <h3 class="card-title">SANDUÍCHES</h3>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
            <a class="link-card" href="#">
                <div class="card rosa">
                    <h3 class="card-title">COQUETÉIS</h3>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
            <a class="link-card" href="#">
                <div class="card roxo">
                    <h3 class="card-title">DRINKS</h3>
                </div>
            </a>
        </div>

    </div>
</div>

<?php
require_once('rodape.php');
?>