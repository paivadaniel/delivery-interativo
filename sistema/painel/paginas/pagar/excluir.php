<?php 
require_once("../../../conexao.php");
$tabela = 'pagar';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['foto'];
$produto = $res[0]['produto'];
$quantidade = $res[0]['quantidade']; //quantidade de produto comprado

if($foto != "sem-foto.jpg"){
	@unlink('../../images/contas/'.$foto);
}

if($produto > 0){ //se existir um produto, aqui pode ser também != 0. produto é o id do produto
	$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$estoque = $res[0]['estoque'];

$total_estoque = $estoque - $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_estoque', valor_compra = '0' WHERE id = '$produto'");
} //valor_compra é da última compra feita

$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso!';
 ?>