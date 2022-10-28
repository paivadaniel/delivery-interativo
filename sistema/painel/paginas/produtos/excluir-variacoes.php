<?php 
require_once("../../../conexao.php");
$tabela = 'variacoes';

$id = $_POST['id']; //vem de listar-variacoes.php

$pdo->query("DELETE FROM $tabela WHERE id = '$id'");

echo "Excluído com Sucesso!";

?>