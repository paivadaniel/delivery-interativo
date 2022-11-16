<?php

@session_start();

require_once('../../sistema/conexao.php');

$tabela = 'temp';

$id_adicional = $_POST['id_adicional'];
$acao = $_POST['acao'];
$id_variacao = $_POST['id_variacao'];

$nova_sessao = @$_SESSION['sessao_usuario'];

if($acao == 'Sim') { //inserção na tabela temp
    $pdo->query("INSERT INTO $tabela SET sessao = '$nova_sessao', tabela = 'adicionais', id_item = '$id_adicional', id_variacao = '$id_variacao', carrinho = '0'");

} else {
    $pdo->query("DELETE FROM $tabela WHERE sessao = '$nova_sessao' and id_item = '$id_adicional' and tabela = 'adicionais' and id_variacao = '$id_variacao' and carrinho = '0'");
}

echo 'Alterado com Sucesso!';


?>