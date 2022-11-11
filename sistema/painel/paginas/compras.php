<?php
@session_start();
require_once("verificar.php");
require_once("../conexao.php");

$pag = 'compras';

//verificar se ele tem a permissão de estar nessa página
if (@$compras == 'ocultar') {
	echo "<script>window.location='../index.php'</script>";
	exit();
}

$data_hoje = date('Y-m-d');
$data_ontem = date('Y-m-d', strtotime("-1 days", strtotime($data_hoje)));

$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_inicio_mes = $ano_atual . "-" . $mes_atual . "-01";

if ($mes_atual == '4' || $mes_atual == '6' || $mes_atual == '9' || $mes_atual == '11') {
	$dia_final_mes = '30';
} else if ($mes_atual == '2') {
	$dia_final_mes = '28';
} else {
	$dia_final_mes = '31';
}

$data_final_mes = $ano_atual . "-" . $mes_atual . "-" . $dia_final_mes;

?>

<div class="">
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Compra</a>
</div>

<div class="bs-example widget-shadow" style="padding:15px">

	<div class="row">
		<div class="col-md-5" style="margin-bottom:5px;">
			<div style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
			<div style="float:left; margin-right:20px">
				<input type="date" class="form-control " name="data-inicial" id="data-inicial-caixa" value="<?php echo $data_inicio_mes ?>" required>
			</div>

			<div style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
			<div style="float:left; margin-right:30px">
				<input type="date" class="form-control " name="data-final" id="data-final-caixa" value="<?php echo $data_final_mes ?>" required>
			</div>
		</div>

		<div class="col-md-2" style="margin-top:5px;" align="center">
			<div>
				<small>
					<a title="Conta de Ontem" class="text-muted" href="#" onclick="valorData('<?php echo $data_ontem ?>', '<?php echo $data_ontem ?>')"><span>Ontem</span></a> /
					<a title="Conta de Hoje" class="text-muted" href="#" onclick="valorData('<?php echo $data_hoje ?>', '<?php echo $data_hoje ?>')"><span>Hoje</span></a> /
					<a title="Conta do Mês" class="text-muted" href="#" onclick="valorData('<?php echo $data_inicio_mes ?>', '<?php echo $data_final_mes ?>')"><span>Mês</span></a>
				</small>
			</div>
		</div>

		<div class="col-md-3" style="margin-top:5px;" align="center">
			<div>
				<small>
					<a title="Todas as Contas" class="text-muted" href="#" onclick="buscarContas('')"><span>Todas</span></a> /
					<a title="Contas Pendentes" class="text-muted" href="#" onclick="buscarContas('Não')"><span>Pendentes</span></a> /
					<a title="Contas Pagas" class="text-muted" href="#" onclick="buscarContas('Sim')"><span>Pagas</span></a>
				</small>
			</div>
		</div>

		<input type="hidden" id="buscar-contas">

	</div>

	<hr>
	<div id="listar">

	</div>

</div>

<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="exampleInputEmail1">Produto</label>
								<select class="form-control sel2" id="produto" name="produto" style="width:100%;">

									<?php
									$query = $pdo->query("SELECT * FROM produtos WHERE tem_estoque = 'Sim' ORDER BY nome asc"); //se tem_estoque for diferente de Sim, pode ser um produto que não está à venda mas necessita de controle de estoque, por exemplo, uma lata de ervilha se for uma pizzaria, já que esta usa ervilha na pizza
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);



									if ($total_reg > 0) {
										for ($i = 0; $i < $total_reg; $i++) {
											foreach ($res[$i] as $key => $value) {
											}
											echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
										}
									} else {
										echo '<option value="0">Cadastre um Produto</option>';
									}
									?>


								</select>
							</div>
						</div>

						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Fornecedor</label>
								<select class="form-control sel2" id="fornecedor" name="fornecedor" style="width:100%;">

									<?php
									$query = $pdo->query("SELECT * FROM fornecedores ORDER BY nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									$total_reg = @count($res);

									echo '<option value="0">Selecione um Fornecedor</option>';

									if ($total_reg > 0) {
										for ($i = 0; $i < $total_reg; $i++) {
											foreach ($res[$i] as $key => $value) {
											}
											echo '<option value="' . $res[$i]['id'] . '">' . $res[$i]['nome'] . '</option>';
										}
									}
									?>


								</select>
							</div>
						</div>

						<div class="col-md-3">

							<div class="form-group">
								<label for="exampleInputEmail1">Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" required>
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Valor Total Compra</label>
								<input type="text" class="form-control" id="valor" name="valor" placeholder="Valor" required>
							</div>
						</div>

						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Vencimento</label>
								<input type="date" class="form-control" id="data_venc" name="data_venc" value="<?php echo $data_hoje ?>">
							</div>
						</div>

						<div class="col-md-4">

							<div class="form-group">
								<label for="exampleInputEmail1">Pago Em</label>
								<input type="date" class="form-control" id="data_pgto" name="data_pgto">
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Arquivo (Nota Fiscal)</label>
								<input class="form-control" type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>
						</div>
						<div class="col-md-4">
							<div id="divImg">
								<img src="images/contas/sem-foto.jpg" width="80px" id="target">
							</div>
						</div>

					</div>

					<input type="hidden" name="id" id="id">

					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>

				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>

		</div>
	</div>
</div>

<!-- Modal Dados-->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="nome_dados"></span></h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">
						<span><b>Valor : </b></span>
						<span id="valor_dados"></span>
					</div>

					<div class="col-md-6">
						<span><b>Data Lançamento: </b></span>
						<span id="data_lanc_dados"></span>
					</div>

				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">
						<span><b>Data Vencimento: </b></span>
						<span id="data_venc_dados"></span>
					</div>

					<div class="col-md-6">
						<span><b>Data PGTO: </b></span>
						<span id="data_pgto_dados"></span>
					</div>

				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">
					<div class="col-md-6">
						<span><b>Usuário Lanc: </b></span>
						<span id="usuario_lanc_dados"></span>
					</div>

					<div class="col-md-6">
						<span><b>Usuário Baixa: </b></span>
						<span id="usuario_baixa_dados"></span>
					</div>

				</div>

				<div class="row" style="border-bottom: 1px solid #cac7c7;">

					<div class="col-md-6">
						<span><b>Fornecedor: </b></span>
						<span id="fornecedor_dados"></span>
					</div>

					<div class="col-md-6">
						<span><b>Telefone: </b></span>
						<span id="telefone_dados"></span>
					</div>

				</div>

				<div class="row">
					<div class="col-md-12" align="center">
						<a id="link_mostrar" target="_blank" title="Clique para abrir o arquivo!">
							<img width="250px" id="target_mostrar">
						</a>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
	});
</script>

<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];


		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);

		if (resultado[1] === 'pdf') {
			$('#target').attr('src', "images/pdf.png");
			return;
		}

		if (resultado[1] === 'rar' || resultado[1] === 'zip') {
			$('#target').attr('src', "images/rar.png");
			return;
		}

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
	function valorData(dataInicio, dataFinal) {
		$('#data-inicial-caixa').val(dataInicio);
		$('#data-final-caixa').val(dataFinal);
		listar();
	}
</script>

<script type="text/javascript">
	$('#data-inicial-caixa').change(function() {
		//$('#tipo-busca').val('');
		listar();
	});

	$('#data-final-caixa').change(function() {
		//$('#tipo-busca').val('');
		listar();
	});
</script>

<script type="text/javascript">
	function listar() {

		var dataInicial = $('#data-inicial-caixa').val();
		var dataFinal = $('#data-final-caixa').val();
		var status = $('#buscar-contas').val();

		$.ajax({
			url: 'paginas/' + pag + "/listar.php",
			method: 'POST',
			data: {
				dataInicial,
				dataFinal,
				status
			},
			dataType: "html",

			success: function(result) {
				$("#listar").html(result);
				$('#mensagem-excluir').text('');
			}
		});
	}
</script>

<script type="text/javascript">
	function buscarContas(status) {
		$('#buscar-contas').val(status);
		listar();
	}
</script>

<script type="text/javascript">
	function baixar(id) {
		$.ajax({
			url: 'paginas/' + pag + "/baixar.php",
			method: 'POST',
			data: {
				id
			},
			dataType: "text",

			success: function(mensagem) {
				if (mensagem.trim() == "Baixado com Sucesso!") {
					listar();
				} else {
					$('#mensagem-excluir').addClass('text-danger')
					$('#mensagem-excluir').text(mensagem)
				}

			},

		});
	}

	function editar(id, produto, fornecedor, valor, data_venc, data_pgto, foto, quantidade) {
		$('#id').val(id);
		$('#produto').val(produto).change();
		$('#fornecedor').val(fornecedor).change();
		$('#valor').val(valor);
		$('#data_venc').val(data_venc);
		$('#data_pgto').val(data_pgto);
		$('#quantidade').val(quantidade);

		$('#titulo_inserir').text('Editar Registro');
		$('#modalForm').modal('show');

		$('#target').attr('src', 'images/contas/' + foto);
	}

	function limparCampos() {
		$('#id').val('');
		$('#fornecedor').val(0).change();
		$('#valor').val('');
		$('#data_pgto').val('');
		$('#data_venc').val('<?= $data_hoje ?>');
		$('#foto').val('');
		$('#quantidade').val('1');
		$('#target').attr('src', 'images/contas/sem-foto.jpg');
	}

	function mostrar(descricao, valor, data_lanc, data_venc, data_pgto, usuario_lanc, usuario_pgto, foto, fornecedor, link, telefone) {

		$('#nome_dados').text(descricao);
		$('#valor_dados').text(valor);
		$('#data_lanc_dados').text(data_lanc);
		$('#data_venc_dados').text(data_venc);
		$('#data_pgto_dados').text(data_pgto);
		$('#usuario_lanc_dados').text(usuario_lanc);
		$('#usuario_baixa_dados').text(usuario_pgto);
		$('#fornecedor_dados').text(fornecedor);
		$('#telefone_dados').text(telefone);

		$('#link_mostrar').attr('href', 'images/contas/' + link);
		$('#target_mostrar').attr('src', 'images/contas/' + foto);

		$('#modalDados').modal('show');
	}

	function saida(id, nome, estoque) {

		$('#nome_saida').text(nome);
		$('#estoque_saida').val(estoque);
		$('#id_saida').val(id);

		$('#modalSaida').modal('show');
	}

	function entrada(id, nome, estoque) {

		$('#nome_entrada').text(nome);
		$('#estoque_entrada').val(estoque);
		$('#id_entrada').val(id);

		$('#modalEntrada').modal('show');
	}
</script>