<?php 
require_once("../../../conexao.php");
$tabela = 'produtos';

$id = $_POST['id'];
$nome = $_POST['nome'];
$valor_compra = $_POST['valor_compra'];
$valor_compra = str_replace(',', '.', $valor_compra);
$valor_venda = $_POST['valor_venda'];
$valor_venda = str_replace(',', '.', $valor_venda);
$descricao = $_POST['descricao'];
$nivel_estoque = $_POST['nivel_estoque'];
$tem_estoque = $_POST['tem_estoque'];

//formatação do nome da categoria
$nome_novo = strtolower(preg_replace(
	"[^a-zA-Z0-9-]",
	"-",
	strtr(
		utf8_decode(trim($nome)),
		utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
		"aaaaeeiooouuncAAAAEEIOOOUUNC-"
	)
));
$url = preg_replace('/[ -]+/', '-', $nome_novo);

$categoria = @$_POST['categoria'];

if($categoria == 0 || $categoria == ""){ //categoria == 0 se não tiver categoria cadastrada
	echo 'Cadastre uma Categoria para o Produto';
	exit();
}

//validar nome do produto
$query = $pdo->query("SELECT * FROM $tabela WHERE nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0 and $id != $res[0]['id']) {
    echo "Nome de Produto já Cadastrado em nosso Banco de Dados, Escolha Outro!";
    exit();
}

//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){ //se encontrar o usuário
	$foto = $res[0]['foto'];
}else{ //se não encontrar o usuário
	$foto = 'sem-foto.jpg';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto-produto']['name']; //foto-produto está no campo name em produtos.php
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img); //remove caracteres especiais do nome da imagem e substitui por -

$caminho = '../../images/produtos/' .$nome_img;

$imagem_temp = @$_FILES['foto-produto']['tmp_name']; 

if(@$_FILES['foto-produto']['name'] != ""){ //se existir imagem
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/produtos/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, categoria = '$categoria', valor_compra = :valor_compra, valor_venda = :valor_venda, descricao = :descricao, foto = '$foto', nivel_estoque = '$nivel_estoque', tem_estoque = '$tem_estoque', ativo = 'Sim', url = '$url'");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, categoria = '$categoria', valor_compra = :valor_compra, valor_venda = :valor_venda, descricao = :descricao, foto = '$foto', nivel_estoque = '$nivel_estoque', tem_estoque = '$tem_estoque', url = '$url' WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":valor_venda", "$valor_venda");
$query->bindValue(":valor_compra", "$valor_compra");
$query->bindValue(":descricao", "$descricao");
$query->execute();

echo "Salvo com Sucesso!";