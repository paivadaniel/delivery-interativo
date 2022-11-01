<?php 
require_once("../../../conexao.php");
$tabela = 'adicionais';

$id_produto = $_POST['id_prod_adc'];
$nome = $_POST['nome_adc'];
$valor = $_POST['valor_adc'];

$valor = str_replace(',', '.', $valor);

//validar nome
$query = $pdo->query("SELECT * from $tabela where nome = '$nome' and produto = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) > 0){
	echo 'Adicional já Cadastrado para Esse Produto, Escolha Outro!';
	exit();
}

$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, valor = :valor, produto = '$id_produto', ativo = 'Sim'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":valor", "$valor");
$query->execute();

echo 'Salvo com Sucesso!';

?>