<!-- não precisa dar require_once de conexao.php, porque já tem esse require em cabecalho.php, e toda página que abre o rodapé, abre também primeiro o cabecalho.php -->

<footer class="rodape">
    <span><?php echo $endereco_sistema; ?> </span>
    <span style="margin-left: 15px"><a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_sistema ?>" class="link-neutro"><i class="bi bi-whatsapp text-success"></i> <?php echo $telefone_sistema; ?></a></span>

</footer>

</body>

</html>