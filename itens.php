<?php
require_once('cabecalho.php');

/*
no .htaccess: RewriteRule ^categoria-(.*)$ itens.php?url=$1 [L]

url é o que se pega no GET

no index.php da raíz da pasta fizemos: 

<a class="link-card" href="categoria-<?php echo $url ?>">

daí url estar no .htaccess

*/

$url = $_GET['url'];

$query = $pdo->query("SELECT * FROM categorias WHERE url = '$url'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    $id_categoria = $res[0]['id'];
    $nome_categoria = $res[0]['nome'];
    $descricao_categoria = $res[0]['descricao'];
}
?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <div class="navbar-brand" href="index">
                <a href="index.php" class="link-neutro">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <span style="margin-left:15px">
                    <?php echo mb_strtoupper($nome_categoria) //strtoupper deixa em maiúsculo 
                    //mb_ adiciona para não dar problema quando a palavra tem acento ou caracteres especiais, como ç
                    ?></span>
            </div>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>


    <ol class="list-group" style="margin-top:60px">
        <!-- removida classe list-group-numbered que numerava os itens da li -->

        <?php
        $query = $pdo->query("SELECT * FROM produtos WHERE categoria = '$id_categoria' and ativo = 'Sim'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);

        if ($total_reg > 0) {
            for ($i = 0; $i < $total_reg; $i++) {
                foreach ($res[$i] as $key => $value) {
                }

                $id_produto = $res[$i]['id'];
                $nome_produto = $res[$i]['nome'];
                $descricao_produto = $res[$i]['descricao'];
                $valor_produto = $res[$i]['valor_venda'];
                $url_produto = $res[$i]['url'];

                $valor_produtoF = number_format($valor_produto, 2, ',', '.');


                $estoque_produto = $res[$i]['estoque'];
                $tem_estoque = $res[$i]['tem_estoque'];

                if ($tem_estoque == 'Sim' and $estoque_produto <= 0) {
                    $mostrar = 'ocultar';
                } else {
                    $mostrar = '';
                }

                //variações dos produtos
        ?>
                <a href="produto-<?php echo $url_produto ?>" class="link-neutro">
                    <li class="list-group-item d-flex justify-content-between align-items-start <?php echo $mostrar ?>">
                        <div class="me-auto">
                            <div class="fw-bold titulo-item"><?php echo $nome_produto ?></div>
                            <span class="valor-item">

                                <?php

                                $query2 = $pdo->query("SELECT * FROM variacoes WHERE produto = '$id_produto' and ativo = 'Sim'"); //ativo da variação
                                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                $total_reg2 = @count($res2);

                                if ($total_reg2 > 0) {
                                    for ($i2 = 0; $i2 < $total_reg2; $i2++) {
                                        foreach ($res2[$i2] as $key => $value) {
                                        }

                                        $id_variacao = $res2[$i2]['id'];
                                        $sigla_variacao = $res2[$i2]['sigla'];
                                        $valor_variacao = $res2[$i2]['valor'];

                                        $valor_variacaoF = number_format($valor_variacao, 2, ',', '.');


                                        echo '(' . $sigla_variacao . ') R$ ' . $valor_variacaoF;
                                        if ($i2 < $total_reg2 - 1) {
                                            echo ' / ';
                                        }
                                    } //for das variações
                                } else { //if das variações
                                    echo 'R$ ' . $valor_produtoF;
                                }
                                ?>
                            </span> <!-- usou span ao invés de parágrafo para não dar margin-bottom automática -->
                        </div>

                    </li>
                </a>

        <?php

            } //for dos produtos
        } //if dos produtos

        ?>

    </ol>


</div>

<?php
require_once('rodape.php');
?>