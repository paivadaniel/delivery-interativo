<?php 
require_once("../../../conexao.php");
$tabela = 'vendas';

@session_start();
$id_usuario = $_SESSION['id_usuario'];

$id = $_POST['id'];

$pdo->query("UPDATE $tabela SET pago = 'Sim', usuario_baixa = '$id_usuario' where id = '$id'"); //fiz como o autor que removeu data_pgto = curDate(), todos os pedidos feitos são para serem pagos no dia, caso contrário, deve entrar como contas à receber e não vendas, porém, no varejo será comum uma compra feita às 19h, ser entregue e paga no dia seguinte

echo 'Baixado com Sucesso!';
 ?>