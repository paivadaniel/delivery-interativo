<?php
require_once('cabecalho.php'); //sistema/conexao.php já está sendo requisitado em cabecalho.php

?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <a class="navbar-brand" href="index">
                <img src="img/<?php echo $logo_sistema ?>" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
                <?php echo $nome_sistema; ?>
            </a>

            <?php
            require_once('icone-carrinho.php');
            ?>
        </div>
    </nav>

    <div class="row cards">

        <?php

        $query = $pdo->query("SELECT * FROM categorias WHERE ativo = 'Sim'");
        $res = $query->fetchAll(PDO::FETCH_ASSOC);
        $total_reg = @count($res);

        if ($total_reg > 0) {

            for ($i = 0; $i < $total_reg; $i++) {
                foreach ($res[$i] as $key => $value) {
                }

                $id_categoria = $res[$i]['id'];
                $cor = $res[$i]['cor'];
                $nome = $res[$i]['nome'];
                $foto = $res[$i]['foto'];
                $url = $res[$i]['url'];

                $query2 = $pdo->query("SELECT * FROM produtos WHERE categoria = '$id_categoria' and ativo = 'Sim'");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $tem_produto = @count($res2);

                $mostrar = 'ocultar';

                if ($tem_produto > 0) {

                    for ($i2 = 0; $i2 < $tem_produto; $i2++) {
                        foreach ($res2[$i2] as $key => $value) {
                        }

                        $estoque_produto = $res2[$i2]['estoque'];
                        $tem_estoque = $res2[$i2]['tem_estoque'];

                        if (($tem_estoque == 'Sim' and $estoque_produto > 0) || ($tem_estoque == 'Não')) { //não entendi porque deve mostrar a categoria quando tem_estoque for igual a não, não entendi muito bem para que serve o tem_estoque
                            //creio que tem_estoque seja por exemplo bala, refrigerante, ou seja, produtos que não necessitem ser feitos, e daí mostra o estoque deles independente se tiver ou não em estoque, pois podem ser comprados na hora e vendidos
                            $mostrar = '';
                        } else {
                            $mostrar = 'ocultar';
                        }
                    }
                } else {
                    $mostrar = 'ocultar';
                }


        ?>

                <div class="col-6 col-md-4">
                    <a class="link-card <?php echo $mostrar ?>" href="categoria-<?php echo $url ?>">
                        <div class="card <?php echo $cor ?>" <?php if ($tipo_miniatura == 'Foto') { ?> style="background-image:url('sistema/painel/images/categorias/<?php echo $foto ?>'); background-size: cover; border: none;" <?php } ?>>

                            <?php if ($tipo_miniatura == 'Foto') { ?>
                                <div class="badge2"><?php echo $nome ?>
                                </div>
                            <?php } else { ?>
                                <h3 class="card-title"><?php echo $nome ?></h3>
                            <?php } ?>
                        </div> <!-- classe card do bootstrap já coloca uma borda automatizada ao inserir margin:10px no .card do css -->
                        <!-- inicialmente havia setado col-6 col-md-4, porém, card tem margin e padding no style.css, daí para não quebrar as colunas tive que diminuir -->

                    </a>
                </div>

        <?php

            } //fechamento for
        } //fechamento if

        ?>

    </div>
</div>

<?php
require_once('rodape.php');
?>