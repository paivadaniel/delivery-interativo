<?php 
require_once("../../../conexao.php");
$tabela = 'vendas';

$id = $_POST['id'];

//o autor disse que vendas não tem nada a ver com produto, mas não entendi porque não volta ao estoque anterior de um produto na tabela produtos ao cancelar uma venda

$pdo->query("UPDATE $tabela SET status = 'Cancelado' where id = '$id'");
echo 'Excluído com Sucesso!';

?>