<?php 
require_once("../../../conexao.php");
$tabela = 'bairros';

$id = $_POST['id'];
$nome = $_POST['nome'];
$valor = $_POST['valor'];

//validar nome (ou poderia ser CEP)
$query = $pdo->query("SELECT * FROM $tabela WHERE nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0 and $id != $res[0]['id']) {
    echo "Bairro já Cadastrado em Nosso Banco de Dados, Escolha Outro!";
    exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, valor = :valor");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, valor = :valor WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":valor", "$valor");
$query->execute();

echo "Salvo com Sucesso!";