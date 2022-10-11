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
$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);
$endereco_sistema = 'Rua X Número 0 Bairro Centro';

?>