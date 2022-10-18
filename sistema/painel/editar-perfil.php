<?php 
require_once("../conexao.php");

$email = $_POST['email_perfil'];
$nome = $_POST['nome_perfil'];
$cpf = $_POST['cpf_perfil'];
$senha = $_POST['senha_perfil'];
$conf_senha = $_POST['conf_senha_perfil'];
$telefone = $_POST['telefone_perfil'];
$id_usuario = $_POST['id_usuario'];

$senha_crip = md5($senha);

if($senha != $conf_senha){
	echo 'Senhas não coincidem!';
	exit();
}

//testar se o email não é duplicado
$query = $pdo->query("SELECT * from usuarios where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) > 0 and $id_usuario != $res[0]['id']){ //$id_usuario != $res[0]['id'] se for outro usuário
	echo 'Email já Cadastrado, Escolha Outro!';
	exit();
}

//testar se o cpf não é duplicado
$query = $pdo->query("SELECT * from usuarios where cpf = '$cpf'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) > 0 and $id_usuario != $res[0]['id']){ //$id_usuario != $res[0]['id'] se for outro usuário
	echo 'CPF já Cadastrado, Escolha Outro!';
	exit();
}

//validar troca da foto
$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){ //se encontrar o usuário
	$foto = $res[0]['foto'];
}else{ //se não encontrar o usuário
	$foto = 'sem-foto.jpg';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto_perfil']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img); //remove caracteres especiais do nome da imagem e substitui por -

$caminho = 'images/perfil/' .$nome_img;

$imagem_temp = @$_FILES['foto_perfil']['tmp_name']; 

if(@$_FILES['foto_perfil']['name'] != ""){ //se existir imagem
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

$query = $pdo->prepare("UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf, senha = :senha, senha_crip = '$senha_crip', foto = '$foto', telefone = :telefone WHERE id = '$id_usuario'");

$query->bindValue(":nome", "$nome"); //bindParam só aceita variáveis, não aceita valor escrito direto entre aspas, como necessitamos de "Sim" para :ativo
$query->bindValue(":email", "$email");
$query->bindValue(":cpf", "$cpf");
$query->bindValue(":senha", "$senha");
$query->bindValue(":telefone", "$telefone");
$query->execute();

echo 'Editado com Sucesso!';

 ?>