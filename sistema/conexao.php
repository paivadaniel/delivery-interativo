<?php 

$usuario = 'root';
$senha = '';
$banco = 'delivery_interativo';
$servidor = 'localhost';

date_default_timezone_set('America/Sao_Paulo'); //se o servidor estiver nos Estados Unidos, não vai pegar o fuso horário do servidor, mas sim o de São Paulo

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não conectado ao Banco de Dados! <br><br>' .$e;
}

$nome_sistema = 'Delivery Interativo';
$email_sistema = 'danielantunespaiva@gmail.com';
$telefone_sistema = '(15) 99180-5895';
$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema); //substitui colchetes, espaço, parenteses e hífen por nada
$endereco_sistema = 'Rua X Número 0 Bairro Centro';

//VERIFICAR SE EXISTE DADOS NO CONFIG
$query = $pdo->query("SELECT * FROM config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg == 0){ //se não tiver nenhuma linha na tabela config, cria dados para ela

	$pdo->query("INSERT INTO config SET nome_sistema = '$nome_sistema', email_sistema = '$email_sistema', telefone_sistema = '$telefone_sistema', endereco_sistema = '$endereco_sistema', tipo_rel = 'PDF', tipo_miniatura = 'Cores', status_whatsapp = 'Sim', previsao_entrega = '60', horario_abertura = '18:00', horario_fechamento = '00:00', status_estabelecimento = 'Aberto', logo_sistema = 'logo.png', favicon_sistema = 'favicon.png', logo_rel = 'logo_rel.jpg' ");
	//logo_rel não pode ser imagem em .png por conta do DOMPDF não trabalhar com .png, por isso salvamos com a extensão .jpg

}else{
$nome_sistema = $res[0]['nome_sistema'];
$email_sistema = $res[0]['email_sistema'];
$telefone_sistema = $res[0]['telefone_sistema'];
$telefone_fixo = $res[0]['telefone_fixo'];
$endereco_sistema = $res[0]['endereco_sistema'];
$instagram_sistema = $res[0]['instagram_sistema'];
$tipo_rel = $res[0]['tipo_rel'];
$tipo_miniatura = $res[0]['tipo_miniatura'];
$status_whatsapp = $res[0]['status_whatsapp'];
$previsao_entrega = $res[0]['previsao_entrega'];
$horario_abertura = $res[0]['horario_abertura'];
$horario_fechamento = $res[0]['horario_fechamento'];
$texto_fechamento_horario = $res[0]['texto_fechamento_horario'];
$status_estabelecimento = $res[0]['status_estabelecimento'];
$texto_fechamento_imprevisto = $res[0]['texto_fechamento_imprevisto'];
$logo_sistema = $res[0]['logo_sistema'];
$favicon_sistema = $res[0]['favicon_sistema'];
$logo_rel = $res[0]['logo_rel'];

}
