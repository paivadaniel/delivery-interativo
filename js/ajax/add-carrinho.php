<?php

@session_start();
$sessao = $_SESSION['sessao_usuario']; //variável criada em adicionais.php

require_once('../../sistema/conexao.php');

$id_produto = $_POST['id_produto'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$quantidade = $_POST['quantidade'];
$total_item = $_POST['total_item'];
$obs = $_POST['obs'];

$query = $pdo->query("SELECT * FROM clientes where telefone = '$telefone' "); //poderia ser LIKE ao invés de =, com LIKE trazeria números aproximados, mas não sei como isso ficaria
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if (@count($res) > 0) {
    $id_cliente = $res[0]['id'];
} else { //cliente não cadastrado

    $query = $pdo->prepare("INSERT INTO clientes SET nome = :nome, telefone = :telefone, data = curDate()");
    $query->bindValue(":nome", "$nome");
    $query->bindValue(":telefone", "$telefone");
    $query->execute();

    //pega o id do cliente que acabou de inserir
    $id_cliente = $pdo->lastInsertId();
}

$query = $pdo->prepare("INSERT INTO carrinho SET sessao = '$sessao', cliente = '$id_cliente', produto = '$id_produto', quantidade = '$quantidade', total_item = '$total_item', obs = :obs, pedido = '0'");
$query->bindValue(":obs", "$obs");
$query->execute();

$id_carrinho = $pdo->lastInsertId();

echo 'Inserido com Sucesso!';

//limpar os adicionais e ingredientes selecionados para essa compra
$query = $pdo->prepare("UPDATE temp SET carrinho = '$id_carrinho' WHERE sessao = '$sessao' and carrinho = '0'");


