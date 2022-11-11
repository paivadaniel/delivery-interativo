<?php
require_once("../../../conexao.php");
$tabela = 'vendas';

$id = $_POST['id'];
$acao = $_POST['acao'];

if ($acao == 'Finalizado') {
    $pdo->query("UPDATE $tabela SET status = '$acao', pago = 'Sim' WHERE id = '$id'");
} else {
    $pdo->query("UPDATE $tabela SET status = '$acao' WHERE id = '$id'");
}

echo "Alterado com Sucesso!";
