<?php 
require_once("../../../conexao.php");
$tabela = 'pagar';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['foto'];
$produto = $res[0]['produto'];
$quantidade = $res[0]['quantidade'];

if($foto != "sem-foto.jpg"){
	@unlink('../../images/contas/'.$foto);
}

$query = $pdo->query("SELECT * FROM produtos where id = '$produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$estoque = $res[0]['estoque'];

//a diminuição de estoque já está sendo feita no excluir.php das contas à pagar, o decremento não está sendo feito duas vezes no estoque de um mesmo produto?

$total_estoque = $estoque - $quantidade;
$pdo->query("UPDATE produtos SET estoque = '$total_estoque', valor_compra = '0' WHERE id = '$produto'");


$pdo->query("DELETE from $tabela where id = '$id'");
echo 'Excluído com Sucesso!';
 ?>