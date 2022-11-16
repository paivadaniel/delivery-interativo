<?php 
require_once("../../../conexao.php");
$tabela = 'categorias';

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$cor = $_POST['cor'];

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

//validar nome da categoria
$query = $pdo->query("SELECT * FROM $tabela WHERE nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0 and $id != $res[0]['id']) {
    echo "Nome de Categoria já Cadastrado em nosso Banco de Dados, Escolha Outro!";
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
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto-categoria']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img); //remove caracteres especiais do nome da imagem e substitui por -

$caminho = '../../images/categorias/' .$nome_img;

$imagem_temp = @$_FILES['foto-categoria']['tmp_name']; 

if(@$_FILES['foto-categoria']['name'] != ""){ //se existir imagem
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('../../images/categorias/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, descricao = :descricao, cor = '$cor', ativo = 'Sim', foto = '$foto', url =  '$url'");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, descricao = :descricao, cor = '$cor', foto = '$foto', url =  '$url' WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->execute();

echo "Salvo com Sucesso!";