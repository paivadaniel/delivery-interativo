<?php

require_once('../../sistema/conexao.php');

@session_start();
$sessao = @$_SESSION['sessao_usuario'];

$total_carrinho = 0;

$query = $pdo->query("SELECT * FROM carrinho WHERE sessao = '$sessao'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {
    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id_produto = $res[$i]['produto'];
        $quantidade = $res[$i]['quantidade'];
        $total_item = $res[$i]['total_item'];
        $id_carrinho = $res[$i]['id'];
        $obs = $res[$i]['obs'];

        $valor_unitario = $total_item / $quantidade;

        $total_carrinho += $total_item;

        $query2 = $pdo->query("SELECT * FROM produtos WHERE id = '$id_produto'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $total_reg2 = @count($res2);

        if ($total_reg2 > 0) {
            $nome_produto = $res2[0]['nome'];
            $foto_produto = $res2[0]['foto'];
        }

        $valor_unitarioF = number_format($valor_unitario, 2, ',', '.');
        $total_itemF = number_format($total_item, 2, ',', '.');
        $total_carrinhoF = number_format($total_carrinho, 2, ',', '.');


        if ($obs == '') {
            $classe_obs = 'text-warning';
        } else {
            $classe_obs = 'text-danger';
        }

        echo <<< HTML

                <li class="list-group-item">
                    <!-- classe bootstrap justify-content-between foi removida aqui da li, ela distanciava os itens um em cada ponta, ou com espaçamento igualitário caso hajam mais de 2 itens -->
                    
                    <img src="sistema/painel/images/produtos/{$foto_produto}" alt="" width="50px">
                    <span class="nome-produto"><b>{$nome_produto}</b> </span>

HTML;

        $query3 = $pdo->query("SELECT * FROM temp WHERE carrinho = '$id_carrinho' and tabela = 'ingredientes'");
        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
        $total_reg3 = @count($res3);

        if ($total_reg3 > 0) {

            for ($i2 = 0; $i2 < $total_reg3; $i2++) {
                foreach ($res3[$i2] as $key => $value) {
                }

                $id_item = $res3[$i2]['id_item'];

                $query4 = $pdo->query("SELECT * FROM ingredientes WHERE id = '$id_item'");
                $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);

                $nome_ingrediente = 'Sem ' . $res4[0]['nome'];

                if ($i2 < ($total_reg3) - 1) { //se tiver mais de um ingrediente removido
                    $nome_ingrediente = $nome_ingrediente . ', ';
                }

                echo '<span class="ingredientes text-danger">' . $nome_ingrediente . '</span>';
            } //fechamento for i2
        } //fechamento if

        echo <<< HTML

                    <a href="#" onclick="excluir('{$id_carrinho}')" class="link-neutro"> <i class="bi bi-x-lg direita"></i> </a>

                    <!-- tem um popup-excluir para cada item do carrinho (que está dentro do for), ou seja, popup-excluir1, popup-excluir2 etc.-->
                    <div id="popup-excluir{$id_carrinho}" class="overlay-excluir">
                        <div class="popup">
                            <div class="row">
                                <div class="col-9">
                                    Confirmar Exclusão? <a href="#" onclick="excluirCarrinho('{$id_carrinho}')" class="text-danger link-neutro">Sim</a>
                                </div>
                                <div class="col-3">
                                    <a class="close" href="#" onclick="fecharExcluir('{$id_carrinho}')">&times;</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    OBS
                    <div class="carrinho-qtd">

                    <div class="itens-carrinho-qtd">
                    <a href="#" title="Observações do Item" class="link-neutro" onclick="obs('{$id_carrinho}', '{$obs}', '{$nome_produto}')">
                    <i class="bi bi-card-text {$classe_obs}"></i>
                    </a>
                    </div>

                    <div class="itens-carrinho-qtd-adc">
                    <a href="#" title="Ver Adicionais" class="link-neutro" onclick="adicionais('{$id_carrinho}', '{$nome_produto}')">
                    <i class="bi bi-plus-square-fill text-primary"></i>
                    </a>
                    </div>

                        <a href="#" onclick="mudarQuantidade('{$id_carrinho}', '{$quantidade}', 'menos')" class="link-neutro">
                            <div class="menos-mais">-</div><!-- teve que usar div ao invés de span, pois span não aceita width nem height -->
                        </a>
                        <div class="qtd-item-carrinho">
                            <span id="quant">{$quantidade}</span>
                        </div>
                        <a href="#" onclick="mudarQuantidade('{$id_carrinho}', '{$quantidade}', 'mais')" class="link-neutro">
                            <div class="menos-mais ">+</div>
                        </a>
                        <div class="total-item-carrinho"> <small><b>{$total_itemF}</b></small></div>

                    </div>
                </li>

HTML;
    } //fechamento for
} else { //fechamento if
    echo "<script>window.alert('Carrinho Vazio!')</script>";
    echo "<script>window.location='index.php'</script>";
}

echo <<< HTML

</ol>

HTML;

//precisa fechar o php após o HTML;
?>


<script type="text/javascript">
    $("#total-do-pedido").text('<?= $total_carrinhoF ?>');

    function mudarQuantidade(id_carrinho, quantidade, acao) {

        $.ajax({
            url: 'js/ajax/mudar-quantidade-carrinho.php',
            method: 'POST',
            data: {
                id_carrinho,
                quantidade,
                acao
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Alterado com Sucesso!") {
                    listarCarrinho();

                }
            },
        });
    }

    function excluirCarrinho(id_carrinho) {

        $.ajax({
            url: 'js/ajax/excluir-carrinho.php',
            method: 'POST',
            data: {
                id_carrinho
            },
            dataType: "text",

            success: function(mensagem) {
                if (mensagem.trim() == "Excluído com Sucesso!") {
                    listarCarrinho();
                }
            },
        });
    }

    function excluir(id) {
        var popup = 'popup-excluir' + id;
        document.getElementById(popup).style.display = 'block';
    }

    function fecharExcluir(id) {
        var popup = 'popup-excluir' + id;
        document.getElementById(popup).style.display = 'none';
    }

    function obs(id_carrinho, obs, nome_produto) {

        $('#obs').val('');
        $("#nome_produto").text(nome_produto);
        $("#obs").val(obs); //para textarea é val() e não text(), igual para input, apenas para id e span que é text
        $("#id_carrinho").val(id_carrinho);

        var myModal = new bootstrap.Modal(document.getElementById('modalObs'), {
            //backdrop: 'static', //não permite que fecha a janela quando clicar fora dela
        });
        myModal.show();

    }

</script>