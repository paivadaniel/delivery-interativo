<?php
require_once("../../../conexao.php");
$tabela = 'vendas';

$status = '%' . @$_POST['status'] . '%'; //buscarContas(''), buscarContas('Iniciado'), buscarContas('Preprando'), buscarContas('Entrega')
$ultimo_pedido = @$_POST['id_ultimo_pedido'];

$total_vendas = 0;

$query = $pdo->query("SELECT * FROM $tabela where data = curDate() and status = 'Iniciado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_ini = @count($res);

$query = $pdo->query("SELECT * FROM $tabela where data = curDate() and status = 'Preparando'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_prep = @count($res);

$query = $pdo->query("SELECT * FROM $tabela where data = curDate() and status = 'Entrega'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_ent = @count($res);

$query = $pdo->query("SELECT * FROM $tabela where data = curDate() and status != 'Cancelado' and status != 'Finalizado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_todos = @count($res);

$query = $pdo->query("SELECT * FROM $tabela where data = curDate() and status != 'Cancelado' and status != 'Finalizado' order by id desc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id_ultimo_pedido = @$res[0]['id'];

//id_ultimo_pedido é sempre igual a ultimo_pedido, porém, não no instante em que for feito um novo último pedido
//meu áudio de novo pedido feito não está dando certo
if(($id_ultimo_pedido > $ultimo_pedido) && $ultimo_pedido != '') {
	echo '<audio autoplay="true">
<source src="../../img/audio.mp3" type="audio/mpeg" />
</audio>';

}

$query = $pdo->query("SELECT * FROM $tabela where data = curDate() and status LIKE '$status' and status != 'Cancelado' and status != 'Finalizado' order by hora desc");

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {

	echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Cliente</th>	
	<th class="esc">Valor</th> 	
	<th class="esc">Total Pago</th> 
	<th class="esc">Troco</th>	
	<th class="esc">Forma de Pagamento</th> 	
	<th class="esc">Status</th> 	

	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

	for ($i = 0; $i < $total_reg; $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$id = $res[$i]['id'];
		$cliente = $res[$i]['cliente'];
		$valor = $res[$i]['valor'];
		$total_pago = $res[$i]['total_pago'];
		$troco = $res[$i]['troco'];
		$data = $res[$i]['data'];
		$hora = $res[$i]['hora'];
		$status = $res[$i]['status'];
		$pago = $res[$i]['pago'];
		$obs = $res[$i]['obs'];
		$taxa_entrega = $res[$i]['taxa_entrega'];
		$tipo_pgto = $res[$i]['tipo_pgto'];
		$usuario_baixa = $res[$i]['usuario_baixa'];

		$valorF = number_format($valor, 2, ',', '.');
		$total_pagoF = number_format($total_pago, 2, ',', '.');
		$trocoF = number_format($troco, 2, ',', '.');
		$taxa_entregaF = number_format($taxa_entrega, 2, ',', '.');
		$dataF = implode('/', array_reverse(explode('-', $data)));
		//$horaF = date("H:i", strtotime($hora));	

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$usuario_baixa'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_usuario_pgto = $res2[0]['nome'];
		} else {
			$nome_usuario_pgto = 'Nenhum';
		}

		$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_cliente = $res2[0]['nome'];
		} else {
			$nome_cliente = 'Nenhum';
		}

		if ($status == 'Iniciado') {
			$classe_alerta = 'text-primary';
			$titulo_link = 'Mudar para Preparando';
			$cor_icone_link = 'text-danger';
			$acao_link = 'Preparando'; //próximo status
		} else if ($status == 'Preparando') {
			$classe_alerta = 'text-laranja';
			$titulo_link = 'Mudar para Em Rota de Entrega';
			$cor_icone_link = 'text-laranja';
			$acao_link = 'Entrega'; //próximo status

		} else {
			$classe_alerta = 'text-verde';
			$titulo_link = 'Mudar para Finalizado';
			$cor_icone_link = 'text-verde';
			$acao_link = 'Finalizado'; //próximo status
		}

		if ($pago == 'Sim') {
			$classe_excluir = 'ocultar';
			$visivel = 'ocultar';
		} else {
			$classe_excluir = '';
			$visivel = '';
		}

		if ($obs != '') {
			$classe_info = 'text-laranja';
		} else {
			$classe_info = 'text-secondary';
		}

		$total_vendas += $valor;

		echo <<<HTML
<tr>
<td><i class="fa fa-square {$classe_alerta}"></i> <b>Pedido ({$id})</b> / {$nome_cliente}</td>
<td class="esc">R$ {$valorF}</td>
<td class="esc">R$ {$total_pagoF}</td>
<td class="esc">R$ {$trocoF}</td>
<td class="esc">{$tipo_pgto}</td>
<td class="esc">{$status} <a href="#" class="{$titulo_link}" onclick="ativar('{$id}', '{$acao_link}')"> <i class="fa fa-arrow-right {$cor_icone_link}"></i> </a></td> <!-- ativar é na verdade o alterarStatus de Iniciado para Preparando, de Preparando para Rota de Entrega, de Rota de Entrega para finalizado, e foi usado o nome ativar na função pois ela já estava criada no ajax.js -->
<td>	

<big><a href="#" onclick="mostrar('{$nome_cliente}', '{$valorF}', '{$total_pagoF}', '{$trocoF}',  '{$dataF}', '{$hora}', '{$status}', '{$pago}', '{$obs}', '{$taxa_entregaF}', '{$tipo_pgto}', '{$nome_usuario_pgto}')" title="Ver Dados"><i class="fa fa-info-circle {$classe_info}"></i></a></big>

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a title="Cancelar Venda" href="#" class="dropdown-toggle {$classe_excluir}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Cancelamento? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>
	

		<li class="dropdown head-dpdn2" style="display: inline-block;">
		<!-- se a conta tiver sido paga não mostra o botão de dar baixa na conta, a classe visivel se encarrega disso -->
		<a title="Confirmar Pagamento" href="#" class="dropdown-toggle {$visivel}" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square text-verde"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Pagamento? <a href="#" onclick="baixar('{$id}')"><span class="text-verde">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>



		</td>
</tr>
HTML;
	}

	$total_vendasF = number_format($total_vendas, 2, ',', '.');

	echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>

<br>	
<div align="right">Total Vendas: <span class="text-verde">R$ {$total_vendasF}</span> </div>

</small>
HTML;
} else {
	echo '<small>Não possui nenhum registro Cadastrado!</small>';
}

?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#todos_pedidos').text("<?= $total_todos ?>");
		$('#iniciado_pedidos').text("<?= $total_ini ?>");
		$('#preparando_pedidos').text("<?= $total_prep ?>");
		$('#entrega_pedidos').text("<?= $total_ent ?>");
		$('#id_ultimo_pedido').val("<?= $id_ultimo_pedido ?>");

		

		$('#tabela').DataTable({
			"ordering": false,
			"stateSave": true
		});
		$('#tabela_filter label input').focus();
	});
</script>