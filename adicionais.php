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
                <span style="margin-left:15px">Pizza Calabreza - Pequena</span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <div class="titulo-item">
        Inserir Adicionais?
    </div>


    <ol class="list-group" style="margin-top:60px">
        <!-- removida classe list-group-numbered que numerava os itens da li -->

        <a href="adicionais.php" class="link-neutro">
            <li class="list-group-item">
                <!-- classe bootstrap justify-content-between foi removida aqui da li, ela distanciava os itens um em cada ponta, ou com espaçamento igualitário caso hajam mais de 2 itens -->
                
                    Bacon <span class="valor-item">(R$5,00)</span> 
                    <i class="bi bi-square direita"></i>                
            </li>
        </a>

        <a href="adicionais.php" class="link-neutro">
            <li class="list-group-item">
                    Cheddar <span class="valor-item">(R$7,00)</span> 
                    <i class="bi bi-square direita"></i>                
            </li>
        </a>

        <a href="adicionais.php" class="link-neutro">
            <li class="list-group-item">
                    Anchovas <span class="valor-item">(R$3,00)</span> 
                    <i class="bi bi-square direita"></i>                
            </li>
        </a>

    </ol>

    <div class="total">
        R$ <b>25,00</b>
    </div>

    <div class="titulo-item-2">
        Remover Ingredientes
    </div>


    <ol class="list-group" style="margin-top:60px">

        <a href="adicionais.php" class="link-neutro">
            <li class="list-group-item">
                
                    Cebola
                    <i class="bi bi-check-square-fill direita"></i>                
            </li>
        </a>

        <a href="adicionais.php" class="link-neutro">
            <li class="list-group-item">
                    Tomate
                    <i class="bi bi-check-square-fill direita"></i>                
            </li>
        </a>

        <a href="adicionais.php" class="link-neutro">
            <li class="list-group-item">
                    Palmito
                    <i class="bi bi-check-square-fill direita"></i>                
            </li>
        </a>

    </ol>

    <div class="botao">
        <button class="btn btn-primary">AVANÇAR</button>
    </div>

</div>

<?php
require_once('rodape.php');
?>