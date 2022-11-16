<?php

require_once('../../sistema/conexao.php');

@session_start();
$nova_sessao = @$_SESSION['sessao_usuario'];

$id_produto = $_POST['id_produto'];

$query = $pdo->query("SELECT * FROM ingredientes WHERE produto = '$id_produto' and ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {

echo <<< HTML
    <div class="titulo-item-2">
        Ingredientes <small> (Desmarque para Remover) </small>
    </div>

    <ol class="list-group">

HTML;

        for ($i = 0; $i < $total_reg; $i++) {
            foreach ($res[$i] as $key => $value) {
            }

            $id_ingrediente = $res[$i]['id'];
            $nome_ingrediente = $res[$i]['nome'];

            $query2 = $pdo->query("SELECT * FROM temp WHERE id_item = '$id_ingrediente' and sessao = '$nova_sessao' and tabela = 'ingredientes' and carrinho = '0'");
            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
            $total_reg2 = @count($res2);
    
            if ($total_reg2 == 0) { //item selecionado
                $icone = 'bi-check-square-fill';
                $titulo_link = 'Remover Item';
                $acao = 'Sim';
            } else { //item não selecionado
                $icone = 'bi-square';
                $titulo_link = 'Adicionar Item';
                $acao = 'Não';
            }

echo <<< HTML

            <a href="#" onclick="adicionarIngredientes('{$id_ingrediente}', '{$acao}')" class="link-neutro" title="{$titulo_link}">
                <li class="list-group-item">

                    {$nome_ingrediente}
                    <i class="bi {$icone} direita"></i>
                </li>
            </a>

HTML;

        } //fechamento for ingredientes

echo <<< HTML

    </ol>

HTML;

} //fechamento if ingredientes
