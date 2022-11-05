<?php 
require_once("../../../conexao.php");
$tabela = 'pagar'; //baixa das compras é feito na tabela de contas à pagar
@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = $_POST['id'];

$pdo->query("UPDATE $tabela SET pago = 'Sim', usuario_baixa = '$id_usuario', data_pgto = curDate() where id = '$id'");

echo 'Baixado com Sucesso!';
 ?>