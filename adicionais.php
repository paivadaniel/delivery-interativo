<?php
require_once('cabecalho.php');
@session_start();

$sessao = date('Y-m-d-H:i:s-') . rand(0, 9999);

if (@$_SESSION['sessao_usuario'] == '') {
    $_SESSION['sessao_usuario'] = $sessao;
}

$nova_sessao = $_SESSION['sessao_usuario'];

$url_completa = $_GET['url'];  /*
url_completa = adicionais.php?url=$1&item=$1
vem de variacoes.php, pelo link <a href="adicionais-<?php echo $url ?>_<?php echo $nome_variacao ?>" class="link-neutro">

*/

$separar_url = explode('_', $url_completa); //separa por underline, como definido na url
$url = $separar_url[0];
$item = @$separar_url[1]; //item=nome do tipo de variação do produto, se por exemplo, pizza de calabresa for o produto, as variações podem ser pequena, média e grande

$query = $pdo->query("SELECT * FROM produtos WHERE url = '$url'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    $id_produto = $res[0]['id'];
    $nome_produto = $res[0]['nome'];
    $descricao_produto = $res[0]['descricao'];
    $foto_produto = $res[0]['foto'];
    $valor_produto = $res[0]['valor_venda'];
    $id_categoria_produto = $res[0]['categoria'];

    $valor_produtoF = number_format($valor_produto, 2, ',', '.');
}

if ($item == '') { //se não tiver variação, preço do produto é o preço do produto
    $valor_item = $valor_produto;
    $id_variacao = '';
} else { //se tiver variação, preço do produto é o preço da variação do produto
    $query = $pdo->query("SELECT * FROM variacoes WHERE produto = '$id_produto' and nome = '$item'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $valor_item = $res[0]['valor'];
    $id_variacao = $res[0]['id'];
}

?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <div class="navbar-brand" href="index.php">
                <a href="produto-<?php echo $url ?>" class="link-neutro">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px"><?php echo mb_strtoupper($nome_produto) ?> - <?php echo mb_strtoupper($item) ?></span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <div id="listar-adicionais" style="margin-top:60px"></div>

    <div id="listar-ingredientes"></div>


    <div class="d-grid gap-2 mt-4">
        <!-- d-grip gap-2 são classes bootstrap para deixar o botão cheio, ou seja, preenchendo toda a extensão da tela -->
        <a href="observacoes-<?php echo $url_completa ?>" class="btn btn-primary" style="margin-top:35px">AVANÇAR</a>
        <!--
            estética é a mesma de cima, basta declarar as classes btn e btn-primary
        <button href="observacoes.php" class="btn btn-primary" type="button">AVANÇAR</button>

-->
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {

        listarAdicionais();
        listarIngredientes();
    });

//adicionais

    function adicionarAdicional(id_adicional, acao) {

        var id_variacao = '<?= $id_variacao ?>';

        $.ajax({
            url: 'js/ajax/adicionais.php',
            method: 'POST',
            data: {
                id_adicional,
                acao,
                id_variacao
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Alterado com Sucesso!") {
                    listarAdicionais();
                }

            },

        });
    }

    function listarAdicionais() {
        
        var id_produto = '<?= $id_produto ?>';
        var valor_item = '<?= $valor_item ?>'; //valor da variação do produto ou do próprio produto caso ele não tiver variação

        $.ajax({
            url: 'js/ajax/listar-adicionais.php',
            method: 'POST',
            data: {id_produto, valor_item},
            dataType: "html", //não é texto, é html

            success: function(result) {
                $("#listar-adicionais").html(result); //joga o resultado que trazer de listar.php na div com id listar
            }
        });
    }

//ingredientes

function adicionarIngredientes(id_ingrediente, acao) {

    var id_variacao = '<?= $id_variacao ?>';

$.ajax({
    url: 'js/ajax/ingredientes.php',
    method: 'POST',
    data: {
        id_ingrediente,
        acao,
        id_variacao
    },
    dataType: "text",

    success: function(mensagem) {
        if (mensagem.trim() == "Alterado com Sucesso!") {
            listarIngredientes();
        }

    },

});
}

function listarIngredientes() {

var id_produto = '<?= $id_produto ?>';

$.ajax({
    url: 'js/ajax/listar-ingredientes.php',
    method: 'POST',
    data: {id_produto},
    dataType: "html", //não é texto, é html

    success: function(result) {
        $("#listar-ingredientes").html(result); //joga o resultado que trazer de listar-ingredientes.php na div com id listar-ingredientes
    }
});
}


</script>

<?php
require_once('rodape.php');
?>