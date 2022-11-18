<?php

require_once('../../sistema/conexao.php');

$id_carrinho = $_POST['id_carrinho'];

$query = $pdo->query("DELETE FROM carrinho WHERE id = '$id_carrinho'");

echo 'Excluído com Sucesso!';
