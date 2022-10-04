<?php
require_once('cabecalho.php');

?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <div class="navbar-brand" href="index.php">
                <a href="index.php" class="link-neutro">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px">PIZZAS</span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>


    <ol class="list-group" style="margin-top:60px">
        <!-- removida classe list-group-numbered que numerava os itens da li -->

        <a href="variacoes.php" class="link-neutro">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-bold titulo-item">Pizza Calabreza</div>
                    <span class="valor-item">(P) R$25,00 / (M) R$30,00 / (G) R$35,00</span> <!-- usou span ao invés de parágrafo para não dar margin-bottom automática -->

                </div>

            </li>
        </a>
        <a href="#" class="link-neutro">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-bold titulo-item">Pizza Frango Catupiry</div>
                    <span class="valor-item">(P) R$25,00 / (M) R$30,00 / (G) R$35,00</span> <!-- usou span ao invés de parágrafo para não dar margin-bottom automática -->

                </div>

            </li>
        </a>
        <a href="#" class="link-neutro">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="me-auto">
                    <div class="fw-bold titulo-item">Pizza Cheddar com Bacon</div>
                    <span class="valor-item">(P) R$25,00 / (M) R$30,00 / (G) R$35,00</span> <!-- usou span ao invés de parágrafo para não dar margin-bottom automática -->

                </div>

            </li>
        </a>
    </ol>


</div>

<?php
require_once('rodape.php');
?>