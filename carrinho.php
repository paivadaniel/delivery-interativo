<?php
require_once('cabecalho.php');

?>

<style type="text/css">
    body {
        background: #f2f2f2;
    }
</style>

<div class="main-container" style="background:#fff">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <div class="navbar-brand" href="index.php">
                <a href="index.php" class="link-neutro">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px">RESUMO DO PEDIDO</span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>


    <ol class="list-group" style="margin-top:60px">
        <!-- removida classe list-group-numbered que numerava os itens da li -->

        <li class="list-group-item">
            <!-- classe bootstrap justify-content-between foi removida aqui da li, ela distanciava os itens um em cada ponta, ou com espaçamento igualitário caso hajam mais de 2 itens -->
            <span class="nome-produto"><b>Pizza Calabresa</b> </span>
            <a href="#popup-excluir" class="link-neutro"> <i class="bi bi-x-lg direita"></i> </a>

            <div class="carrinho-qtd">
                <a href="#" class="link-neutro">
                    <div class="menos-mais">-</div><!-- teve que usar div ao invés de span, pois span não aceita width nem height -->
                </a>
                <div class="qtd-item-carrinho">1</div>
                <a href="#" class="link-neutro">
                    <div class="menos-mais ">+</div>
                </a>
                <div class="total-item-carrinho"> <small><b> R$11.500,00</b></small></div>

            </div>
        </li>

        <li class="list-group-item">
            <!-- classe bootstrap justify-content-between foi removida aqui da li, ela distanciava os itens um em cada ponta, ou com espaçamento igualitário caso hajam mais de 2 itens -->
            <span class="nome-produto"><b>Refrigerante Coca Cola 2l</b> </span>
            <a href="#popup-excluir" class="link-neutro"> <i class="bi bi-x-lg direita"></i> </a>

            <div class="carrinho-qtd">
                <a href="#" class="link-neutro">
                    <div class="menos-mais">-</div><!-- teve que usar div ao invés de span, pois span não aceita width nem height -->
                </a>
                <div class="qtd-item-carrinho">1</div>
                <a href="#" class="link-neutro">
                    <div class="menos-mais ">+</div>
                </a>
                <div class="total-item-carrinho"> <small><b> R$12,00</b></small></div>

            </div>
        </li>

        <li class="list-group-item">
            <!-- classe bootstrap justify-content-between foi removida aqui da li, ela distanciava os itens um em cada ponta, ou com espaçamento igualitário caso hajam mais de 2 itens -->
            <span class="nome-produto"><b>Pastel de Carne</b> </span>
            <a href="#popup-excluir" class="link-neutro"> <i class="bi bi-x-lg direita"></i> </a>

            <div class="carrinho-qtd">
                <a href="#" class="link-neutro">
                    <div class="menos-mais">-</div><!-- teve que usar div ao invés de span, pois span não aceita width nem height -->
                </a>
                <div class="qtd-item-carrinho">1</div>
                <a href="#" class="link-neutro">
                    <div class="menos-mais ">+</div>
                </a>
                <div class="total-item-carrinho"> <small><b> R$9,50</b></small></div>

            </div>
        </li>
    </ol>

    <div class="d-grid gap-2 mt-4 abaixo">
        <a href="#" class="btn btn-primary no-border-radius">AVANÇAR</a>
    </div>

    <div class="total-item">
        <span><b>SUBTOTAL: </b></span>
        <span class="direita"><b>R$ 25,00</b></span>

    </div>

    <div id="popup-excluir" class="overlay-excluir">
    <div class="popup">
        <div class="row">
            <div class="col-9">
                Confirmar Exclusão? <a href="" class="text-danger link-neutro">Sim</a>
            </div>
            <div class="col-3">
                <a class="close" href="#">&times;</a>
            </div>
        </div>
    </div>
</div>

</div>



<?php
require_once('rodape.php');
?>