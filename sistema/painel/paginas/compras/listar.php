<?php
require_once("../../../conexao.php");
$tabela = 'pagar';
$data_hoje = date('Y-m-d');

$dataInicial = @$_POST['dataInicial'];
$dataFinal = @$_POST['dataFinal'];
$status = '%' . @$_POST['status'] . '%';

$total_pago = 0;
$total_a_pagar = 0;

$query = $pdo->query("SELECT * FROM $tabela where data_venc >= '$dataInicial' and data_venc <= '$dataFinal' and pago LIKE '$status' and produto != 0 ORDER BY pago asc, data_venc asc"); //aqui acrescenta produto != 0 em relação ao listar.php de pagar
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {

	echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Produto</th>	
	<th class="esc">Valor</th> 	
	<th class="esc">Vencimento</th> 	
	<th class="esc">Data PGTO</th> 
	
	<th class="esc">Fornecedor</th>	
	<th class="esc">Arquivo</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

	for ($i = 0; $i < $total_reg; $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$id = $res[$i]['id'];
		$descricao = $res[$i]['descricao'];
		$tipo = $res[$i]['tipo'];
		$valor = $res[$i]['valor'];
		$data_lanc = $res[$i]['data_lanc'];
		$data_pgto = $res[$i]['data_pgto'];
		$data_venc = $res[$i]['data_venc'];
		$usuario_lanc = $res[$i]['usuario_lanc'];
		$usuario_baixa = $res[$i]['usuario_baixa'];
		$foto = $res[$i]['foto'];
		$fornecedor = $res[$i]['fornecedor'];
		$produto = $res[$i]['produto'];
		$quantidade = $res[$i]['quantidade'];
		$pago = $res[$i]['pago'];

		$valorF = number_format($valor, 2, ',', '.');
		$data_lancF = implode('/', array_reverse(explode('-', $data_lanc)));
		$data_pgtoF = implode('/', array_reverse(explode('-', $data_pgto)));
		$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));


		$query2 = $pdo->query("SELECT * FROM fornecedores where id = '$fornecedor'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_fornecedor = $res2[0]['nome'];
			$telefone_fornecedor = $res2[0]['telefone'];
		} else {
			$nome_fornecedor = 'Nenhum!';
			$telefone_fornecedor = 'Nenhum';
		}


		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_usuario_pgto = $res2[0]['nome'];
		} else {
			$nome_usuario_pgto = 'Nenhum!';
		}



		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_lanc'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_usuario_lanc = $res2[0]['nome'];
		} else {
			$nome_usuario_lanc = 'Sem Referência!';
		}


		if ($data_pgto == '0000-00-00') {
			$classe_alerta = 'text-danger';
			$data_pgtoF = 'Pendente';
			$visivel = '';
			$total_a_pagar += $valor;
		} else {
			$classe_alerta = 'text-verde';
			$visivel = 'ocultar';
			$total_pago += $valor;
		}


		//extensão do arquivo
		$ext = pathinfo($foto, PATHINFO_EXTENSION);
		if ($ext == 'pdf') {
			$tumb_arquivo = 'pdf.png';
		} else if ($ext == 'rar' || $ext == 'zip') {
			$tumb_arquivo = 'rar.png';
		} else {
			$tumb_arquivo = $foto;
		}

		if ($data_venc < $data_hoje and $pago != 'Sim') {
			$classe_debito = 'vermelho-escuro';
		} else {
			$classe_debito = '';
		}

		echo <<<HTML
<tr class="{$classe_debito}">
<td><i class="fa fa-square {$classe_alerta}"></i> {$descricao}</td>
<td class="esc">R$ {$valorF}</td>
<td class="esc">{$data_vencF}</td>
<td class="esc">{$data_pgtoF}</td>

<td class="esc">{$nome_fornecedor}</td>
<td><a href="images/contas/{$foto}" target="_blank"><img src="images/contas/{$tumb_arquivo}" width="27px" class="mr-2"></a></td>
<td>

<big><a href="#" onclick="editar('{$id}','{$produto}', '{$fornecedor}', '{$valor}', '{$data_venc}', '{$data_pgto}', '{$tumb_arquivo}', '{$quantidade}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

		<big><a href="#" onclick="mostrar('{$descricao}', '{$valorF}', '{$data_lancF}', '{$data_vencF}',  '{$data_pgtoF}', '{$nome_usuario_lanc}', '{$nome_usuario_pgto}', '{$tumb_arquivo}', '{$nome_fornecedor}', '{$foto}', '{$telefone_fornecedor}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a title="Baixar Conta" href="#" class="dropdown-toggle {$visivel}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square text-verde"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Baixa na Conta? <a href="#" onclick="baixar('{$id}')"><span class="text-verde">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>
	
		</td>
</tr>
HTML;
	}

	$total_pagoF = number_format($total_pago, 2, ',', '.');
	$total_a_pagarF = number_format($total_a_pagar, 2, ',', '.');

	echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>

<br>	
<div align="right">Total Pago: <span class="text-verde">R$ {$total_pagoF}</span> </div>
<div align="right">Total à Pagar: <span class="text-danger">R$ {$total_a_pagarF}</span> </div>

</small>
HTML;
} else {
	echo '<small>Não possui nenhum registro Cadastrado!</small>';
}

?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true
		});
		$('#tabela_filter label input').focus();
	});
</script>