<?php 
require_once("../../../conexao.php");
$tabela = 'usuarios'; //autor não criou uma tabela para funcionários, está usando a tabela usuários para os funcionários

$id = $_POST['id'];

$pdo->query("DELETE FROM $tabela WHERE id = '$id'");

echo "Excluído com Sucesso!";

?>