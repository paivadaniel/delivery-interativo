<?php
require_once('cabecalho.php');

@session_start();

$sessao = $_SESSION['sessao_usuario'];

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
                <a href="index" class="link-neutro">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px">RESUMO DO PEDIDO</span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <ol class="list-group" style="margin-top:60px; margin-bottom:60px; overflow: scroll; height:100%; scrollbar-width: thin;" id="listar-itens-carrinho">

    </ol>

    <div class="area-pedidos">

        <div class="total-pedido">
            <div class="total-item">
                <span><b>SUBTOTAL: </b></span>
                <span class="direita"><b>R$ <span id="total-do-pedido"></span></b></span>

            </div>

            <div class="d-grid gap-2 mt-4 abaixo">
                <a href="#" class="btn btn-primary no-border-radius">AVANÇAR</a>
            </div>

        </div>
    </div>


</div>



<?php
require_once('rodape.php');
?>


<script type="text/javascript">
    $(document).ready(function() {
        listarCarrinho();
    });

    function listarCarrinho() {

        $.ajax({
            url: 'js/ajax/listar-itens-carrinho.php',
            method: 'POST',
            data: {},
            dataType: "html",

            success: function(result) {
                $("#listar-itens-carrinho").html(result);

            }
        });
    }

</script>