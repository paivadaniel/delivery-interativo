<?php

require_once('conexao.php');

@session_start(); //para criar as variáveis de sessão

$email_login = $_POST['email'];
$senha_login = $_POST['senha'];

$query = $pdo->query("SELECT * FROM usuarios WHERE ((email = '$email_login' or cpf = '$email_login') and senha = '$senha_login')");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if (@count($res) > 0) {

    $_SESSION['id_usuario'] = $res[0]['id'];
    $_SESSION['nome_usuario'] = $res[0]['nome'];
    $_SESSION['nivel_usuario'] = $res[0]['nivel'];
    $_SESSION['ativo_usuario'] = $res[0]['ativo'];

    if ($_SESSION['ativo_usuario'] == 'Sim') {
        echo "<script>window.location='painel'</script>";
    } else {
        echo "<script>window.alert('Usuário Inativo!')</script>";
        echo "<script>window.location='index.php'</script>";
    }
} else {
    echo "<script>window.alert('Usuário ou Senha Incorretos!')</script>";
    echo "<script>window.location='index.php'</script>";
}
