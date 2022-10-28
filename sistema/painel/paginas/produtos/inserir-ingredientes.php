<?php 
require_once("../../../conexao.php");
$tabela = 'ingredientes';

$id_produto = $_POST['id_prod_ing'];
$nome = $_POST['nome_ing'];

//validar sigla
$query = $pdo->query("SELECT * from $tabela where nome = '$nome' and produto = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) > 0){
	echo 'Ingrediente já Cadastrado para Esse Produto, Escolha Outro!';
	exit();
}

$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, produto = '$id_produto', ativo = 'Sim'");

$query->bindValue(":nome", "$nome");
$query->execute();

echo 'Salvo com Sucesso!';

?>