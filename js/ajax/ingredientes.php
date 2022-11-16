<?php

@session_start();

require_once('../../sistema/conexao.php');

$tabela = 'temp';

$id_ingrediente = $_POST['id_ingrediente'];
$acao = $_POST['acao'];
$id_variacao = $_POST['id_variacao'];

$nova_sessao = @$_SESSION['sessao_usuario'];

if($acao == 'Sim') { //inserção na tabela temp
    $pdo->query("INSERT INTO $tabela SET sessao = '$nova_sessao', tabela = 'ingredientes', id_item = '$id_ingrediente', id_variacao = '$id_variacao', carrinho = '0'"); //ainda que seja inteiro e não fosse obrigatório colocar carrinho = '0', que deveria ainda assim ir como 0, alguns servidores ruins precisam que preencha valor mesmo para campos nulos

} else {
    $pdo->query("DELETE FROM $tabela WHERE sessao = '$nova_sessao' and id_item = '$id_ingrediente' and tabela = 'ingredientes' and id_variacao = '$id_variacao' and carrinho = '0'");
}

echo 'Alterado com Sucesso!';

?>