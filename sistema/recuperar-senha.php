<?php

require_once('conexao.php');

$email_rec = $_POST['email-rec'];

$query = $pdo->query("SELECT * FROM usuarios WHERE email = '$email_rec'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if (@count($res) == 0) {
    echo 'Email não cadastrado em nosso banco de dados';
    exit();
} else {
    $senha = $res[0]['senha'];

    //enviar email com a nova senha
    $destinatario = $email_rec;
    $assunto = $nome_sistema . ' - Recuperação de Senha';
    $mensagem = 'Sua senha é ' . $senha;
    $cabecalhos = "From: " . $email_sistema;

    @mail($destinatario, $assunto, $mensagem, $cabecalhos);
}


echo 'Email Enviado com Sucesso!';
