<?php
require_once('cabecalho.php');
@session_start();

$sessao = $_SESSION['sessao_usuario'];

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

//ver preço do produto escolhido ou da variação dele

if ($item == '') { //se não tiver variação, preço do produto é o preço do produto
    $valor_item = $valor_produto;
    $id_variacao = '';
} else { //se tiver variação, preço do produto é o preço da variação do produto
    $query = $pdo->query("SELECT * FROM variacoes WHERE produto = '$id_produto' and nome = '$item'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $valor_item = $res[0]['valor'];
    $id_variacao = $res[0]['id'];
}

//ver preço do adicional escolhido

$query = $pdo->query("SELECT * FROM temp WHERE sessao = '$sessao' and tabela = 'adicionais' and carrinho = '0'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) { //item selecionado
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id_adicional = $res[$i]['id_item'];

        $query2 = $pdo->query("SELECT * FROM adicionais WHERE id = '$id_adicional'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);

        $valor_adicional = $res2[0]['valor'];

        $valor_item += $valor_adicional;
    }
} else { //item não selecionado


}

$valor_itemF = number_format($valor_item, 2, ',', '.');


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
                <a href="adicionais-<?php echo $url_completa ?>" class="link-neutro">
                    <!-- se não tiver adicionais, não volta para adicionais.php, volta direto para itens.php -->
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px">RESUMO DO PEDIDO</span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <div class="destaque">
        <b><?php echo mb_strtoupper($nome_produto) ?></b>
    </div>


    <div class="destaque-qtd">
        <b>QUANTIDADE: </b>
        <span class="direita">
            <big>
                <span>
                    <a href="#" onclick="diminuirQuantidade()">
                        <i class="bi bi-dash-circle-fill text-danger"></i>
                    </a>
                </span>
                <span> <b><span id="quant"></span></b> </span>

                <span>
                    <a href="#" onclick="aumentarQuantidade(1)">
                        <i class="bi bi-plus-circle-fill text-success"></i>
                    </a>

                </span>
            </big>

        </span>
    </div>

    <input type="hidden" id="quantidade" value="1"> <!-- difere do elemeto com id=quant pois este é um span, e portanto para atribuir value para ele usa text, e não val -->
    <input type="hidden" id="total_item_input" value="<?php echo $valor_item ?>">

    <div class="destaque-qtd">
        <b>OBSERVAÇÕES: </b>

        <div class="form-group">
            <label for="obs"></label>
            <textarea maxlength="255" name="obs" class="form-control"></textarea>
        </div>

    </div>
</div>

<div class="d-grid gap-2 mt-4 abaixo">
    <a href="#popup2" class="btn btn-primary no-border-radius">ADICIONAR AO CARRINHO</a>
</div>

<div class="total-item">
    <span><b>TOTAL: </b></span>
    <span class="direita"><b>R$ <span id="total_item"></span></b></span>

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
                                    <input type="text" onkeyup="buscarNome()" class="input" name="telefone" id="telefone" required>
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

<!-- jQuery para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<?php
require_once('rodape.php');
?>

<script type="text/javascript">
    $(document).ready(function() {

        var quant = $("#quantidade").val();
        $("#quant").text(quant);



    });

    function aumentarQuantidade() {
        var quant = $("#quantidade").val();
        //var novo_valor = quant + valor; //o mais no javascript é interpretado também como concatenação de valores, por isso tem que ser feita primeiramente a conversão para int (parseInt) pois só pode valores inteiros, se pudesse fração daí teria que ser parseFloat
        var nova_quantidade = parseInt(quant) + parseInt(1);
        $("#quant").text(nova_quantidade);
        $("#quantidade").val(nova_quantidade);

        var total_inicial = '<?= $valor_item ?>';
        var total = parseFloat(total_inicial) * parseFloat(nova_quantidade);

        $("#total_item").text(total.toFixed(2)); //está com problema pois estou passando um valor convertido para inteiro para ser exibido como texto
        //toFixed(2) é para mostrar 2 casas decimais
        $("#total_item_input").val(total);


    }

    function diminuirQuantidade() {
        var quant = $("#quantidade").val();

        if (quant > 1) { //não pode diminuir quantidade para zero nem para número negativo
            var nova_quantidade = parseInt(quant) - parseInt(1);
            $("#quant").text(nova_quantidade);
            $("#quantidade").val(nova_quantidade);

            var total_inicial = '<?= $valor_item ?>';
            var total = parseFloat(total_inicial) * parseFloat(nova_quantidade);

            $("#total_item").text(total.toFixed(2));
            $("#total_item_input").val(total);
        }

    }

    function buscarNome() {

        var tel = $('#telefone').val();

        $.ajax({
            url: 'js/ajax/listar-nome.php',
            method: 'POST',
            data: {
                tel
            },
            dataType: "text",

            success: function(result) {

                $('#nome').val(result);
            }
        });
    }
</script>