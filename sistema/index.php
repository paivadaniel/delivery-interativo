<?php

require_once('conexao.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Página de Login - <?php echo $nome_sistema; ?></title>

    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../css/login.css">

</head>

<body>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">

                <div class="card px-5 py-5" id="form1">
                    <div class="form-data" v-if="!submitted">

                        <div class="logo">
                            <img src="../img/logo.png" alt="" width="100px">
                        </div>

                        <form action="painel" method="post">
                            <div class="forms-inputs mb-4">
                                <span>Email ou CPF</span>
                                <input autocomplete="off" type="text" v-model="email" v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlured}" v-on:blur="emailBlured = true" class="form-control" required>
                            </div>
                            <div class="forms-inputs mb-4">
                                <span>Senha</span>
                                <input autocomplete="off" type="password" v-model="password" v-bind:class="{'form-control':true, 'is-invalid' : !validPassword(password) && passwordBlured}" v-on:blur="passwordBlured = true" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Login</button>
                            </div>

                            <div class="mb-3">
                                <a href="" class="link-rec" data-bs-toggle="modal" data-bs-target="#modal-rec">Recuperar Senha</a>
                            </div>

                    </div>

                    </form>
                    <div class="success-data" v-else>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Modal -->
<div class="modal fade" id="modal-rec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recuperar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-rec">
                    <div class="row">
                        <div class="col-8">
                            <input type="email" name="email-rec" id="email-rec" class="form-control" placeholder="Digite seu Email" required>
                            <!-- required só funciona quando o tipo do botão é submit -->
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary" style="height:40px">Recuperar</button>
                        </div>

                    </div>
                    <br>
                    <small>
                        <div id="mensagem-recuperar"></div>
                    </small>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- jQuery para funcionar o AJAX -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
	$("#form-rec").submit(function () {

		event.preventDefault(); //para forçar página não atualizar
		var formData = new FormData(this); //para recuperar os campos que estão dentro do formulário e jogar na variável formData

		$.ajax({
			url: "recuperar-senha.php",
			type: 'POST',
			data: formData, //formData é para quando se trabalha com imagem, ou seja, desnecessário nesse caso

			success: function (mensagem) {
				$('#mensagem-recuperar').text('');
				$('#mensagem-recuperar').removeClass();

				if (mensagem.trim() == "Email Enviado com Sucesso!") {
					//$('#btn-fechar-rec').click();					
					$('#email-rec').val('');
					$('#mensagem-recuperar').addClass('text-success');
					$('#mensagem-recuperar').text('Senha Enviada para o Email!');	

				} else {

					$('#mensagem-recuperar').addClass('text-danger');
					$('#mensagem-recuperar').text(mensagem);
				}


			},

            //linhas a seguir é para quando se trabalha com imagens no AJAX, ou seja, desnecessárias nesse caso
			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>


