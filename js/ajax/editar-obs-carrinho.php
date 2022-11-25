<?php

require_once('../../sistema/conexao.php');

$id_carrinho = $_POST['id_carrinho'];
$obs = $_POST['obs'];

$query = $pdo->prepare("UPDATE carrinho SET obs = :obs WHERE id = '$id_carrinho'");
$query->bindValue(":obs", "$obs");
$query->execute();

echo 'Salvo com Sucesso!';
