<!-- não precisa dar require_once de conexao.php, porque já tem esse require em cabecalho.php, e toda página que abre o rodapé, abre também primeiro o cabecalho.php -->

<footer class="rodape">
    <div class="row">

        <div class="col-md-6">

            <?php if ($endereco_sistema == '') { ?>

                <span class="ocultar-mobile"><?php echo $nome_sistema; ?> </span>

            <?php } else { ?>

                <span class="ocultar-mobile"><?php echo $endereco_sistema; ?> </span>

            <?php } ?>

        </div>
        <div class="col-md-6">
            <span style="margin-left: 15px"><a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_sistema ?>" class="link-neutro" target="_blank"><i class="bi bi-whatsapp text-success"></i> <?php echo $telefone_sistema; ?></a></span>

            /

            <span style="margin-left: 15px"><a href="<?php echo $instagram_sistema ?>" class="link-neutro" target="_blank"><i class="bi bi-instagram text-info"></i></a></span>


        </div>
    </div>


</footer>

</body>

</html>