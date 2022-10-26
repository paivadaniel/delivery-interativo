<?php
require_once("../../../conexao.php");
$tabela = 'usuarios';

$id = $_POST['id'];
$acao = $_POST['acao'];
/*

if ($acao == 'Não') {
    $pdo->query("UPDATE $tabela SET ativo = 'Não' WHERE id = '$id'");
} else if ($acao == 'Sim') {
    $pdo->query("UPDATE $tabela SET ativo = 'Sim' WHERE id = '$id'");
}

*/

$pdo->query("UPDATE $tabela SET ativo = '$acao' WHERE id = '$id'");


echo "Alterado com Sucesso!";

?>