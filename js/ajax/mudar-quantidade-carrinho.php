<?php

require_once('../../sistema/conexao.php');

$id_carrinho = $_POST['id_carrinho'];
$quantidade = $_POST['quantidade'];
$acao = $_POST['acao'];

if ($acao == 'menos') {
    $nova_quantidade = $quantidade - 1;
} else { //'mais'
    $nova_quantidade = $quantidade + 1;
}

$query = $pdo->query("SELECT * FROM carrinho WHERE id = '$id_carrinho'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$quantidade = $res[0]['quantidade'];
$total_item = $res[0]['total_item'];
$valor_unitario = $total_item / $quantidade;

$novo_valor = $nova_quantidade*$valor_unitario;

$pdo->query("UPDATE carrinho SET quantidade = '$nova_quantidade', total_item = '$novo_valor' WHERE id = '$id_carrinho'");

echo 'Alterado com Sucesso!';
