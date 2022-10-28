<?php 
require_once("../../../conexao.php");
$tabela = 'variacoes';

$id_produto = $_POST['id_prod_var'];
$sigla = $_POST['sigla'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];

//validar sigla
$query = $pdo->query("SELECT * from $tabela where sigla = '$sigla' and produto = '$id_produto'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) > 0){
	echo 'Sigla já Cadastrada para Esse Produto, Escolha Outra!';
	exit();
}

$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, produto = '$id_produto', sigla = :sigla, valor = :valor, descricao = :descricao, ativo = 'Sim'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":valor", "$valor");
$query->bindValue(":descricao", "$descricao");
$query->bindValue(":sigla", "$sigla");
$query->execute();

echo 'Salvo com Sucesso!';

?>