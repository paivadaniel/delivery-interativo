<?php

require_once('verificar.php');
require_once('../conexao.php');

@session_start();
$id_usuario = $_SESSION['id_usuario'];

//RECUPERAR OS DADOS DO USUÁRIO
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_usuario = $res[0]['nome'];
$email_usuario = $res[0]['email'];
$cpf_usuario = $res[0]['cpf'];
$nivel_usuario = $res[0]['nivel'];
$senha_usuario = $res[0]['senha'];
$foto_usuario = $res[0]['foto'];
$telefone_usuario = $res[0]['telefone'];

if (@$_GET['pagina'] != '') {
	$pagina = @$_GET['pagina'];
} else {
	$pagina = 'home';
}

$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual . "-" . $mes_atual . "-01";
$data_ano = $ano_atual . "-01-01";

$partesData = explode('-', $data_atual);
$dataDiaInicial = $partesData[2];
$dataMesInicial = $partesData[1];
//$dataAnoInicial = $partesData[0];

?>
<!-- template utiliza bootstrap 4, portanto data-toggle ao invés de data-bs-toggle, e data-target ao invés de data-bs-target -->

<!DOCTYPE HTML>
<html>

<head>
	<title><?php echo $nome_sistema ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="shortcut icon" href="../../img/<?php echo $favicon_sistema ?>" type="image/x-icon">


	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
	<!-- //side nav css file -->

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts-->

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
	</style>
	<!--pie-chart -->
	<!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#demo-pie-1').pieChart({
				barColor: '#2dde98',
				trackColor: '#eee',
				lineCap: 'round',
				lineWidth: 8,
				onStep: function(from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-2').pieChart({
				barColor: '#8e43e7',
				trackColor: '#eee',
				lineCap: 'butt',
				lineWidth: 8,
				onStep: function(from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-3').pieChart({
				barColor: '#ffc168',
				trackColor: '#eee',
				lineCap: 'square',
				lineWidth: 8,
				onStep: function(from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});


		});
	</script>
	<!-- //pie-chart -->
	<!-- index page sales reviews visitors pie chart -->

	<!-- DataTables -->

	<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
	<script type="text/javascript" src="DataTables/datatables.min.js"></script>

	<!-- Select2 -->
	<!-- é para poder filtrar select, por exemplo, se digitar "Ha", vai aparecer "Vila Haro", "Vila Hamburguer", e esconder os outros bairros -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- CSS para personalizar os campos do Select2 -->
	<style type="text/css">
		.select2-selection__rendered {
			line-height: 36px !important;
			font-size: 16px !important;
			color: #666666 !important;

		}

		.select2-selection {
			height: 36px !important;
			font-size: 16px !important;
			color: #666666 !important;

		}
	</style>

</head>

<body class="cbp-spmenu-push">
	<div class="main-content" style="overflow: scroll; height:100%; scrollbar-width: thin;">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left" style="overflow: scroll; height:100%; scrollbar-width: thin;">
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.php"><span class="fa fa-cutlery"></span> Glance<span class="dashboard_text">Design dashboard</span></a></h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MENU DE NAVEGAÇÃO</li>
							<li class="treeview">
								<a href="index.php">
									<i class="fa fa-dashboard"></i> <span>Home</span>
								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="fa fa-users"></i>
									<span>Pessoas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=usuarios"><i class="fa fa-angle-right"></i> Usuários</a></li>
									<li><a href="index.php?pagina=funcionarios"><i class="fa fa-angle-right"></i> Funcionários</a></li>
									<li><a href="index.php?pagina=clientes"><i class="fa fa-angle-right"></i> Clientes</a></li>
									<li><a href="index.php?pagina=fornecedores"><i class="fa fa-angle-right"></i> Fornecedores</a></li>


								</ul>
							</li>


							<li class="treeview">
								<a href="#">
									<i class="fa fa-plus"></i>
									<span>Cadastros</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>

								<ul class="treeview-menu">
									<li><a href="index.php?pagina=bairros"><i class="fa fa-angle-right"></i> Bairros</a></li>
								</ul>

								<ul class="treeview-menu">
									<li><a href="index.php?pagina=niveis"><i class="fa fa-angle-right"></i> Níveis</a></li>
								</ul>
							</li>


							<li class="treeview">
								<a href="#">
									<i class="fa fa-cutlery"></i>
									<span>Produtos</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=produtos"><i class="fa fa-angle-right"></i> Produtos</a></li>
									<li><a href="index.php?pagina=categorias"><i class="fa fa-angle-right"></i> Categorias</a></li>

									<li><a href="index.php?pagina=entradas"><i class="fa fa-angle-right"></i> Entradas</a></li>
									<li><a href="index.php?pagina=saidas"><i class="fa fa-angle-right"></i> Saídas</a></li>
									<li><a href="index.php?pagina=estoque"><i class="fa fa-angle-right"></i> Estoque Baixo</a></li>


								</ul>
							</li>

							<li class="treeview">
								<a href="#">
									<i class="fa fa-dollar"></i>
									<span>Financeiro</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="index.php?pagina=vendas"><i class="fa fa-angle-right"></i> Vendas</a></li>

									<li><a href="index.php?pagina=compras"><i class="fa fa-angle-right"></i> Compras</a></li>

									<li><a href="index.php?pagina=receber"><i class="fa fa-angle-right"></i> Contas à Receber</a></li>

									<li><a href="index.php?pagina=pagar"><i class="fa fa-angle-right"></i> Contas à Pagar</a></li>

								</ul>
							</li>

							<li class="treeview">
								<a href="#">
									<i class="fa fa-file-pdf-o"></i>
									<span>Relatórios</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li><a href="rel/produtos_class.php" target="_blank"><i class="fa fa-angle-right"></i> Produtos</a></li>

									<li><a href="" data-toggle="modal" data-target="#RelCon"><i class="fa fa-angle-right"></i> Contas</a></li>

									<li><a href="" data-toggle="modal" data-target="#RelLuc"><i class="fa fa-angle-right"></i> Lucro</a></li>

									<li><a href="" data-toggle="modal" data-target="#RelVen"><i class="fa fa-angle-right"></i> Vendas</a></li>


								</ul>
							</li>


						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</aside>
		</div>
		<!--left-fixed -navigation-->

		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush" data-toggle="collapse" data-target=".collapse">
					<!-- acrescentou data-toggle="collapse" data-target=".collapse" para clicar apenas uma única vez no ícone do menu com 3 linhas que aparece no mobile, e ele abrir as opções -->
					<i class="fa fa-bars"></i>
				</button>
				<!--toggle button end-->
				<div class="profile_details_left">
					<!--notifications of menu start -->
					<ul class="nofitications-dropdown">
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">4</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>You have 3 new messages</h3>
									</div>
								</li>
								<li><a href="#">
										<div class="user_img"><img src="images/1.jpg" alt=""></div>
										<div class="notification_desc">
											<p>Lorem ipsum dolor amet</p>
											<p><span>1 hour ago</span></p>
										</div>
										<div class="clearfix"></div>
									</a></li>
								<li class="odd"><a href="#">
										<div class="user_img"><img src="images/4.jpg" alt=""></div>
										<div class="notification_desc">
											<p>Lorem ipsum dolor amet </p>
											<p><span>1 hour ago</span></p>
										</div>
										<div class="clearfix"></div>
									</a></li>
								<li><a href="#">
										<div class="user_img"><img src="images/3.jpg" alt=""></div>
										<div class="notification_desc">
											<p>Lorem ipsum dolor amet </p>
											<p><span>1 hour ago</span></p>
										</div>
										<div class="clearfix"></div>
									</a></li>
								<li><a href="#">
										<div class="user_img"><img src="images/2.jpg" alt=""></div>
										<div class="notification_desc">
											<p>Lorem ipsum dolor amet </p>
											<p><span>1 hour ago</span></p>
										</div>
										<div class="clearfix"></div>
									</a></li>
								<li>
									<div class="notification_bottom">
										<a href="#">See all messages</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">


				<!--search-box
				
				<div class="search-box">
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Search..." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>
				</div>
				
				//end-search-box-->

				<div class="profile_details">
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">
									<span class="prfil-img"><img src="images/perfil/<?php echo $foto_usuario ?>" alt="" width="35px"> </span>
									<div class="user-name">
										<p><?php echo $nome_usuario ?></p>
										<span><?php echo $nivel_usuario ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>
								</div>
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#" data-toggle="modal" data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li>
								<li> <a href="#" data-toggle="modal" data-target="#modalPerfil"><i class="fa fa-user"></i> Perfil</a> </li>
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<?php
			require_once('paginas/' . $pagina . '.php');
			?>

		</div>

		<!--//footer
		<div class="footer">
			<p>&copy; 2018 Glance Design Dashboard. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">w3layouts</a></p>
		</div>
		//footer-->
	</div>

	<!-- new added graphs chart js-->

	<script src="js/Chart.bundle.js"></script>
	<script src="js/utils.js"></script>

	<!-- new added graphs chart js-->

	<!-- Classie -->
	<!-- for toggle left push menu script -->
	<script src="js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById('cbp-spmenu-s1'),
			showLeftPush = document.getElementById('showLeftPush'),
			body = document.body;

		showLeftPush.onclick = function() {
			classie.toggle(this, 'active');
			classie.toggle(body, 'cbp-spmenu-push-toright');
			classie.toggle(menuLeft, 'cbp-spmenu-open');
			disableOther('showLeftPush');
		};


		function disableOther(button) {
			if (button !== 'showLeftPush') {
				classie.toggle(showLeftPush, 'disabled');
			}
		}
	</script>
	<!-- //Classie -->
	<!-- //for toggle left push menu script -->

	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->

	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
		$('.sidebar-menu').SidebarNav()
	</script>
	<!-- //side nav js -->



	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->

</body>

</html>

<!-- Mascaras JS -->
<script type="text/javascript" src="../../js/mascaras.js"></script>

<!-- jQuery para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<!-- Modal Config -->
<div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar Configurações</h4>
				<button id="btn-fechar-config" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-config">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-3">
							<label>Nome do Sistema</label>
							<input type="text" class="form-control" id="nome_sistema" name="nome_sistema" placeholder="Delivery Interativo" value="<?php echo @$nome_sistema ?>" required>
						</div>

						<div class="col-md-3">
							<label>Email do Sistema</label>
							<input type="email" class="form-control" id="email_sistema" name="email_sistema" placeholder="Email do Sistema" value="<?php echo @$email_sistema ?>">
						</div>

						<div class="col-md-3">
							<label>Telefone do Sistema</label>
							<input type="text" class="form-control" id="telefone_sistema" name="telefone_sistema" placeholder="Telefone do Sistema" value="<?php echo @$telefone_sistema ?>" required>
						</div>

						<div class="col-md-3">
							<label>Telefone Fixo</label>
							<input type="text" class="form-control" id="telefone_fixo" name="telefone_fixo" placeholder="Telefone Fixo" value="<?php echo @$telefone_fixo ?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Endereço <small>(Logradouro, Número, Bairro e Cidade)</small></label>
							<input type="text" class="form-control" id="endereco_sistema" name="endereco_sistema" placeholder="Rua X..." value="<?php echo @$endereco_sistema ?>">
						</div>

						<div class="col-md-6">
							<label>Instagram</label>
							<input type="text" class="form-control" id="instagram_sistema" name="instagram_sistema" placeholder="Link do Instagram" value="<?php echo @$instagram_sistema ?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>Tipo Relatório</label>
							<select class="form-control" name="tipo_rel">
								<option value="PDF" <?php if (@$tipo_rel == 'PDF') { ?> selected <?php } ?>>PDF</option>
								<option value="HTML" <?php if (@$tipo_rel == 'HTML') { ?> selected <?php } ?>>HTML</option>
							</select>
						</div>

						<div class="col-md-3">
							<label>Mostrar Miniaturas</label>
							<select class="form-control" name="tipo_miniatura">
								<option value="Cores" <?php if (@$tipo_miniatura == 'Cores') { ?> selected <?php } ?>>Cores</option>
								<option value="Foto" <?php if (@$tipo_miniatura == 'Foto') { ?> selected <?php } ?>>Foto</option>
							</select>
						</div>

						<div class="col-md-3">
							<label>Status do Pedido Via Whatsapp</label> <!-- enviar informações do status do pedido por whatsapp ou não -->
							<select class="form-control" name="status_whatsapp">
								<option value="Sim" <?php if (@$status_whatsapp == 'Sim') { ?> selected <?php } ?>>Sim</option>
								<option value="Não" <?php if (@$status_whatsapp == 'Não') { ?> selected <?php } ?>>Não</option>
							</select>
						</div>

						<div class="col-md-3">
							<label>Previsão de Entrega <small>(Min.)</small></label>
							<input type="number" class="form-control" id="previsao_entrega" name="previsao_entrega" placeholder="Previsão Minutos" value="<?php echo @$previsao_entrega ?>" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
							<label>Abertura</label>
							<input type="time" name="horario_abertura" class="form-control" value="<?php echo @$horario_abertura ?>">
						</div>

						<div class="col-md-2">
							<label>Fechamento</label>
							<input type="time" name="horario_fechamento" class="form-control" value="<?php echo @$horario_fechamento ?>">
						</div>

						<div class="col-md-8">
							<label>Texto Fechamento <small>(Fora do Horário)</small></label>
							<input maxlength="255" type="text" name="texto_fechamento_horario" class="form-control" value="<?php echo @$texto_fechamento_horario ?>" placeholder="Texto que vai aparecer quando o cliente tentar fazer pedido fora do horário de funcionamento">
						</div>
					</div>

					<div class="row">
						<div class="col-md-3">
							<label>Estabelecimento</label>
							<select class="form-control" name="status_estabelecimento">
								<option value="Aberto" <?php if (@$status_estabelecimento == 'Aberto') { ?> selected <?php } ?>>Aberto</option>
								<option value="Fechado" <?php if (@$status_estabelecimento == 'Fechado') { ?> selected <?php } ?>>Fechado</option>
							</select>
						</div>
						<div class="col-md-9">
							<label>Texto Fechamento <small>(Imprevisto)</small></label>
							<input maxlength="255" type="text" name="texto_fechamento_imprevisto" class="form-control" value="<?php echo @$texto_fechamento_imprevisto ?>" placeholder="Caso marque a opção de Estabelecimento Fechado, coloque aqui o texto que deseja aparecer">
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Logo (*PNG)</label>
								<input class="form-control" type="file" name="foto-logo" onChange="carregarImgLogo();" id="foto-logo">
							</div>
						</div>
						<div class="col-md-2">
							<div id="divImg">
								<img src="../../img/<?php echo $logo_sistema ?>" width="80px" id="target-logo">
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Ícone (*Png)</label>
								<input class="form-control" type="file" name="foto-icone" onChange="carregarImgIcone();" id="foto-icone">
							</div>
						</div>
						<div class="col-md-2">
							<div id="divImg">
								<img src="../../img/<?php echo $favicon_sistema ?>" width="50px" id="target-icone">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Logo Relatório (*Jpg)</label>
								<input class="form-control" type="file" name="foto-logo-rel" onChange="carregarImgLogoRel();" id="foto-logo-rel">
							</div>
						</div>
						<div class="col-md-2">
							<div id="divImg">
								<img src="../../img/<?php echo @$logo_rel ?>" width="80px" id="target-logo-rel">
							</div>
						</div>
					</div>
					<br>
					<small>
						<div id="msg-config" align="center"></div>
					</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Perfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Alterar Dados</h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-perfil">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">

							<label>Nome</label>
							<input type="text" class="form-control" id="nome_perfil" name="nome_perfil" placeholder="Seu Nome" value="<?php echo $nome_usuario ?>" required>
						</div>

						<div class="col-md-6">

							<label>Email</label>
							<input type="email" class="form-control" id="email_perfil" name="email_perfil" placeholder="Seu Nome" value="<?php echo $email_usuario ?>" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Telefone</label>
							<input type="text" class="form-control" id="telefone_perfil" name="telefone_perfil" placeholder="Seu Telefone" value="<?php echo $telefone_usuario ?>" required>
						</div>

						<div class="col-md-6">
							<label>CPF</label>
							<input type="text" class="form-control" id="cpf_perfil" name="cpf_perfil" placeholder="Seu CPF" value="<?php echo $cpf_usuario ?>">
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Senha</label>
							<input type="password" class="form-control" id="senha_perfil" name="senha_perfil" placeholder="Senha" value="<?php echo $senha_usuario ?>" required>
						</div>

						<div class="col-md-6">
							<label>Confirmar Senha</label>
							<input type="password" class="form-control" id="conf_senha_perfil" name="conf_senha_perfil" placeholder="Confirmar Senha" value="" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<label>Foto</label>
							<input type="file" class="form-control" id="foto_perfil" name="foto_perfil" onchange="carregarImgPerfil()">
						</div>

						<div class="col-md-6">
							<img src="images/perfil/<?php echo $foto_usuario ?>" width="80px" id="target-usuario">
						</div>

					</div>

					<input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">

					<br>
					<small>
						<div id="msg-perfil" align="center"></div>
					</small>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Rel Contas -->
<div class="modal fade" id="RelCon" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório de Contas
					<small>(
						<a href="#" onclick="datas('1980-01-01', 'tudo-Con', 'Con')">
							<span style="color:#000" id="tudo-Con">Tudo</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Con', 'Con')">
							<span id="hoje-Con">Hoje</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Con', 'Con')">
							<span style="color:#000" id="mes-Con">Mês</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Con', 'Con')">
							<span style="color:#000" id="ano-Con">Ano</span>
						</a>
						)</small>

				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form method="post" action="rel/rel_contas_class.php" target="_blank">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Data Inicial</label>
								<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Con" value="<?php echo date('Y-m-d') ?>" required>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Data Final</label>
								<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Con" value="<?php echo date('Y-m-d') ?>" required>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label>Pago</label>
								<select class="form-control" name="pago" style="width:100%;">
									<option value="">Todas</option>
									<option value="Sim">Somente Pagas</option>
									<option value="Não">Pendentes</option>

								</select>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Pagar / Receber</label>
								<select class="form-control sel13" name="tabela" style="width:100%;">
									<option value="pagar">Contas à Pagar</option>
									<option value="receber">Contas à Receber</option>

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Consultar Por</label>
								<select class="form-control sel13" name="busca" style="width:100%;">
									<option value="data_venc">Data de Vencimento</option>
									<option value="data_pgto">Data de Pagamento</option>

								</select>
							</div>
						</div>

					</div>

				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Gerar Relatório</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Modal Rel Lucro -->
<div class="modal fade" id="RelLuc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Demonstrativo de Lucro
					<small>(
						<a href="#" onclick="datas('1980-01-01', 'tudo-Luc', 'Luc')">
							<span style="color:#000" id="tudo-Luc">Tudo</span>
						</a> / 
						<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Luc', 'Luc')">
							<span id="hoje-Luc">Hoje</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Luc', 'Luc')">
							<span style="color:#000" id="mes-Luc">Mês</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Luc', 'Luc')">
							<span style="color:#000" id="ano-Luc">Ano</span>
						</a> 
					)</small>



				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="rel/rel_lucro_class.php" target="_blank">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-4">						
							<div class="form-group"> 
								<label>Data Inicial</label> 
								<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Luc" value="<?php echo date('Y-m-d') ?>" required> 
							</div>						
						</div>
						<div class="col-md-4">
							<div class="form-group"> 
								<label>Data Final</label> 
								<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Luc" value="<?php echo date('Y-m-d') ?>" required> 
							</div>
						</div>



					</div>




				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Gerar Relatório</button>
				</div>
			</form>

		</div>
	</div>
</div>


<!-- Modal Rel Vendas -->
<div class="modal fade" id="RelVen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório de Vendas
					<small>(
						<a href="#" onclick="datas('1980-01-01', 'tudo-Ven', 'Ven')">
							<span style="color:#000" id="tudo-Ven">Tudo</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_atual ?>', 'hoje-Ven', 'Ven')">
							<span id="hoje-Ven">Hoje</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_mes ?>', 'mes-Ven', 'Ven')">
							<span style="color:#000" id="mes-Ven">Mês</span>
						</a> /
						<a href="#" onclick="datas('<?php echo $data_ano ?>', 'ano-Ven', 'Ven')">
							<span style="color:#000" id="ano-Ven">Ano</span>
						</a>
						)</small>

				</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form method="post" action="rel/rel_vendas_class.php" target="_blank">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Data Inicial</label>
								<input type="date" class="form-control" name="dataInicial" id="dataInicialRel-Ven" value="<?php echo date('Y-m-d') ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Data Final</label>
								<input type="date" class="form-control" name="dataFinal" id="dataFinalRel-Ven" value="<?php echo date('Y-m-d') ?>" required>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-6">						
							<div class="form-group"> 
								<label>Status</label> 
								<select class="form-control" name="status" style="width:100%;">
									<option value="">Todas</option>
									<option value="Finalizado">Finalizadas</option>
									<option value="Cancelado">Canceladas</option>

								</select> 
							</div>						
						</div>
						<div class="col-md-6">
							<div class="form-group"> 
								<label>Forma PGTO</label> 
								<select class="form-control" name="forma_pgto" style="width:100%;">
									<option value="">Todas</option>
									<option value="Dinheiro">Dinheiro</option>
									<option value="Pix">Pix</option>
									<option value="Cartão de Crédito">Cartão de Crédito</option>
									<option value="Cartão de Débito">Cartão de Débito</option>																		
								</select>
							</div>
						</div>



					</div>


				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Gerar Relatório</button>
				</div>
			</form>

		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm') //nome da modal em que será ativo o select2 nos campos select
		});
	});
</script>

<script type="text/javascript">
	$("#form-perfil").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-perfil.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#msg-perfil').text('');
				$('#msg-perfil').removeClass()
				if (mensagem.trim() == "Editado com Sucesso!") {

					$('#btn-fechar-perfil').click();
					location.reload(); //atualiza página, tem que atualizar para ver a nova imagem de perfil do usuário (se trocada)

				} else {

					$('#msg-perfil').addClass('text-danger')
					$('#msg-perfil').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>

<script type="text/javascript">
	function carregarImgPerfil() {
		var target = document.getElementById('target-usuario');
		var file = document.querySelector("#foto_perfil").files[0];

		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>

<script type="text/javascript">
	$("#form-config").submit(function() {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-config.php",
			type: 'POST',
			data: formData,

			success: function(mensagem) {
				$('#msg-config').text('');
				$('#msg-config').removeClass()
				if (mensagem.trim() == "Editado com Sucesso!") {

					$('#btn-fechar-config').click();
					location.reload();


				} else {

					$('#msg-config').addClass('text-danger')
					$('#msg-config').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>

<script type="text/javascript">
	function carregarImgLogo() {
		var target = document.getElementById('target-logo');
		var file = document.querySelector("#foto-logo").files[0];

		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>

<script type="text/javascript">
	function carregarImgLogoRel() {
		var target = document.getElementById('target-logo-rel');
		var file = document.querySelector("#foto-logo-rel").files[0];

		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>

<script type="text/javascript">
	function carregarImgIcone() {
		var target = document.getElementById('target-icone');
		var file = document.querySelector("#foto-icone").files[0];

		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>

<script type="text/javascript">
	function datas(data, id, campo) { //id=tudo-Con, campo = Con

		var data_atual = "<?= $data_atual ?>";
		var separarData = data_atual.split("-");
		var mes = separarData[1];
		var ano = separarData[0];

		var separarId = id.split("-");

		//tudo-Con, hoje-Con, mes-Con, ano-Con

		if (separarId[0] == 'tudo') { //se tiver clicado em tudo
			data_atual = '2100-12-31'; //segunda data (a que vai Da primeira até à Segunda)
		}

		if (separarId[0] == 'ano') { //se tiver clicado em ano
			data_atual = ano + '-12-31';
		}

		if (separarId[0] == 'mes') { //se tiver clicado em mês
			if (mes == 1 || mes == 3 || mes == 5 || mes == 7 || mes == 8 || mes == 10 || mes == 12) {
				data_atual = ano + '-' + mes + '-31';
			} else if (mes == 4 || mes == 6 || mes == 9 || mes == 11) {
				data_atual = ano + '-' + mes + '-30';
			} else {
				data_atual = ano + '-' + mes + '-28';
			}

		}

		//se tiver clicado em hoje vai a data_adtual sem passar pelos if acima

		$('#dataInicialRel-' + campo).val(data); //primeira data
		$('#dataFinalRel-' + campo).val(data_atual);

		document.getElementById('hoje-' + campo).style.color = "#000";
		document.getElementById('mes-' + campo).style.color = "#000";
		document.getElementById(id).style.color = "blue";

		document.getElementById('tudo-' + campo).style.color = "#000";
		document.getElementById('ano-' + campo).style.color = "#000";
		document.getElementById(id).style.color = "blue";
	}
</script>