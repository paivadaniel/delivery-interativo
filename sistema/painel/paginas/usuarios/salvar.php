<?php 
require_once("../../../conexao.php");
$tabela = 'usuarios';

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$nivel = $_POST['nivel'];
$senha = '123';
$senha_crip = md5($senha);

//validar email
$query = $pdo->query("SELECT * FROM $tabela WHERE email = '$email");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0 and $id != $res[0]['id']) {
    echo "Email já Cadastrado em Nosso Banco de Dados, Escolha Outro!";
    exit();
}

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela WHERE cpf = '$cpf");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0 and $cpf != $res[0]['cpf']) {
    echo "CPF já Cadastrado em Nosso Banco de Dados, Escolha Outro!";
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
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto-usuario']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img); //remove caracteres especiais do nome da imagem e substitui por -

$caminho = 'images/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto-usuario']['tmp_name']; 

if(@$_FILES['foto-usuario']['name'] != ""){ //se existir imagem
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.jpg"){
				@unlink('images/perfil/'.$foto);
			}

			$foto = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, email = :email, cpf = :cpf, senha = '$senha', senha_crip = '$senha_crip', nivel = '$nivel', data = curDate(), ativo = 'Sim', telefone = :telefone, foto = '$foto'");
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, cpf = :cpf, nivel = '$nivel', telefone = :telefone, foto = '$foto' WHERE id = '$id'");
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":telefone", "$telefone");
$query->execute();

echo "Salvo com Sucesso!";