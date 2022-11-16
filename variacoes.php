<?php
require_once('cabecalho.php');

$url = $_GET['url']; //mesmo que o nome da variável seja $url_produto em itens.php, o que vale é a variável que está no htaccess, que foi chamada de url apenas

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

    $query = $pdo->query("SELECT * FROM categorias WHERE id = '$id_categoria_produto'");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    $url_categoria = $res[0]['url'];


}

?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <div class="navbar-brand" href="index.php">
                <a href="categoria-<?php echo $url_categoria ?>" class="link-neutro">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px"><?php echo mb_strtoupper($nome_produto); ?></span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <ol class="list-group" style="margin-top:60px">
        <!-- removida classe list-group-numbered que numerava os itens da li -->

        <?php
        $query = $pdo->query("SELECT * FROM variacoes WHERE produto = '$id_produto' and ativo = 'Sim'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);

        if ($total_reg > 0) {
            for ($i = 0; $i < $total_reg; $i++) {
                foreach ($res[$i] as $key => $value) {
                }

                $id_variacao = $res[$i]['id'];
                $nome_variacao = $res[$i]['nome'];
                $sigla_variacao = $res[$i]['sigla'];
                $valor_variacao = $res[$i]['valor'];

                $valor_variacaoF = number_format($valor_variacao, 2, ',', '.');

                //variações dos produtos
        ?>

                <a href="adicionais-<?php echo $url ?>_<?php echo $nome_variacao ?>" class="link-neutro">
                <!-- se usar / no lugar do -, na url acima, dá problema, pois na hora de voltar página entende que é uma pasta, procura a pasta adicionais, que não existe
            como o nome já é saparado por -, aqui usou _, para separar o nome do produto ($url) da variação dele ($nome_variacao) -->
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="me-auto">
                            <div class="fw-bold titulo-item"><?php echo $nome_variacao ?></div>
                            <span class="valor-item"><?php echo 'R$ ' . $valor_variacaoF ?></span> <!-- usou span ao invés de parágrafo para não dar margin-bottom automática -->

                        </div>

                    </li>
                </a>

            <?php

            } //fechamento for
        } else { //fechamento if
            ?>

            <a href="adicionais-<?php echo $url ?>" class="link-neutro">
         
                <li class="list-group-item">
                <!-- classe bootstrap justify-content-between foi removida aqui da li, ela distanciava os itens um em cada ponta, ou com espaçamento igualitário caso hajam mais de 2 itens -->
                
                <?php echo $nome_produto ?> <span class="valor-item">(<?php echo 'R$ ' . $valor_produtoF ?></span>)</span> 
                    <big><big><i class="bi bi-check direita text-success"></i></big></big>                
            </li>

            </a>

        <?php
        }
        ?>

    </ol>

    <hr>

    <div class="conteudo-descricao-item">
        <div class="titulo-descricao-item">
            <b>Descrição</b>
            <p><?php echo $nome_produto ?></p>
        </div>
        <p class="descricao-item">
            <?php echo $descricao_produto ?>
        </p>

        <div>
            <img src="sistema/painel/images/produtos/<?php echo $foto_produto ?>" alt="Pizza de Calabresa" class="imagem-produto">
        </div>

    </div>


</div>


<?php
require_once('rodape.php');
?>