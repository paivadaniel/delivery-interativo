<?php

require_once('../../sistema/conexao.php');

@session_start();
$nova_sessao = @$_SESSION['sessao_usuario'];

$id_produto = $_POST['id_produto'];
$valor_item = $_POST['valor_item'];

$query = $pdo->query("SELECT * FROM adicionais WHERE produto = '$id_produto' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {

echo <<< HTML

    <div class="titulo-item">
        Adicionais <small>(Marque para Inserir)</small>
    </div>

    <ol class="list-group" id="listar-adicionais">

HTML;

    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }

        $id_adicional = $res[$i]['id'];
        $nome_adicional = $res[$i]['nome'];
        $valor_adicional = $res[$i]['valor'];

        $valor_adicionalF = number_format($valor_adicional, 2, ',', '.');

        $query2 = $pdo->query("SELECT * FROM temp WHERE id_item = '$id_adicional' and sessao = '$nova_sessao' and tabela = 'adicionais' and carrinho = '0'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $total_reg2 = @count($res2);

        if ($total_reg2 > 0) { //item selecionado
            $icone = 'bi-check-square-fill';
            $titulo_link = 'Remover Item';
            $acao = 'Não';
            $valor_item += $valor_adicional;
        } else { //item não selecionado
            $icone = 'bi-square';
            $titulo_link = 'Adicionar Item';
            $acao = 'Sim';
        }

        echo <<< HTML

    <a href="#" onclick="adicionarAdicional('{$id_adicional}', '{$acao}')" class="link-neutro" title="{$titulo_link}">
        <li class="list-group-item">

            {$nome_adicional} <span class="valor-item">(R$ {$valor_adicionalF})</span>
            <i class="bi {$icone} direita"></i>
        </li>
    </a>

HTML;
    } //fechamento for adicionais

    $valor_itemF = number_format($valor_item, 2, ',', '.');

    echo <<< HTML

</ol>

<div class="total">
        <b class="text-success">R$ {$valor_itemF}</b>
</div>

HTML;
} //fechamento if
