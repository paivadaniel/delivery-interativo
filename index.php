<?php
require_once('cabecalho.php'); //sistema/conexao.php já está sendo requisitado em cabecalho.php

?>

<div class="main-container">
    <nav class="navbar bg-light fixed-top" style="box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);">
        <!-- fixed-top anula padding-top da classe main-container no css e faz com que o topo não desça mesmo com a rolagem da página -->
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
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

                $cor = $res[$i]['cor'];
                $nome = $res[$i]['nome'];
                $foto = $res[$i]['foto'];

                $nome_novo = strtolower(preg_replace(
                    "[^a-zA-Z0-9-]",
                    "-",
                    strtr(
                        utf8_decode(trim($nome)),
                        utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
                        "aaaaeeiooouuncAAAAEEIOOOUUNC-"
                    )
                ));
                $url = preg_replace('/[ -]+/', '-', $nome_novo);

        ?>

                <div class="col-6 col-md-4">
                    <a class="link-card" href="categoria-<?php echo $url ?>">
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