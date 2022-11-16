<?php 
require_once('../../sistema/conexao.php');

$tel = @$_POST['tel'];

if($tel == ""){
	exit();
}

$query = $pdo->query("SELECT * FROM clientes where telefone = '$tel' "); //poderia ser LIKE ao invés de =, com LIKE trazeria números aproximados, mas não sei como isso ficaria
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome = $res[0]['nome'];
	$id_cliente = $res[0]['id'];
	echo $nome; //tem que ficar dentro do if, pois apenas se encontrar o cliente mostra o nome, se ficar fora, mostraria um warning, mas poderia ser colocado um arroba na frente, mas o melhor e mais prático é só mostrar quando bater o telefone certinho com o que está no banco de dados
}
