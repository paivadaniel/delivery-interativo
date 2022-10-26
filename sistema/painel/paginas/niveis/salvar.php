<?php 
require_once("../../../conexao.php");
$tabela = 'niveis';

$id = $_POST['id'];
$nome = $_POST['nome'];

//validar email
$query = $pdo->query("SELECT * FROM $tabela WHERE nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0 and $id != $res[0]['id']) {
    echo "Nível já Cadastrado em Nosso Banco de Dados, Escolha Outro Nome!";
    exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->execute();

echo "Salvo com Sucesso!";