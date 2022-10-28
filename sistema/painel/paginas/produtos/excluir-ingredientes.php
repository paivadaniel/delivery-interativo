<?php 
require_once("../../../conexao.php");
$tabela = 'ingredientes';

$id = $_POST['id']; //vem de listar-ingreientes.php

$pdo->query("DELETE FROM $tabela WHERE id = '$id'");

echo "Excluído com Sucesso!";

?>