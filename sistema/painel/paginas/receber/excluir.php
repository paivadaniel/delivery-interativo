<?php
require_once("../../../conexao.php");
$tabela = 'receber';

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if ($total_reg > 0) {

	$foto = $res[0]['foto'];

	if ($foto != "sem-foto.jpg") {
		@unlink('../../images/contas/' . $foto);
	}

//não precisa subtrair estoque do produto da venda cancelada na tabela produtos, pois a relação entre estoque e venda cancelada será feito entre as tabelas de pedidos e produtos

	$pdo->query("DELETE from $tabela where id = '$id'");
	echo 'Excluído com Sucesso!';
}
