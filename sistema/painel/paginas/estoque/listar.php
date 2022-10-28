<?php
require_once("../../../conexao.php");
$tabela = 'produtos';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {

	echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Categoria</th> 	
	<th class="esc">Valor Compra</th> 	
	<th class="esc">Valor Venda</th> 
	<th class="esc">Estoque</th>	
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

	for ($i = 0; $i < $total_reg; $i++) {
		foreach ($res[$i] as $key => $value) {
		}
		$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$descricao = $res[$i]['descricao'];
		$categoria = $res[$i]['categoria'];
		$valor_compra = $res[$i]['valor_compra'];
		$valor_venda = $res[$i]['valor_venda'];
		$foto = $res[$i]['foto'];
		$estoque = $res[$i]['estoque'];
		$nivel_estoque = $res[$i]['nivel_estoque'];
		$tem_estoque = $res[$i]['tem_estoque'];

		$valor_vendaF = number_format($valor_venda, 2, ',', '.');
		$valor_compraF = number_format($valor_compra, 2, ',', '.');

		$query2 = $pdo->query("SELECT * FROM categorias where id = '$categoria'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$total_reg2 = @count($res2);
		if ($total_reg2 > 0) {
			$nome_cat = $res2[0]['nome'];
		} else {
			$nome_cat = 'Sem Referência!';
		}

		if ($nivel_estoque >= $estoque and $tem_estoque == 'Sim') {

			echo <<<HTML
<tr class="">
<td>
<img src="images/produtos/{$foto}" width="27px" class="mr-2">
{$nome}
</td>
<td class="esc">{$nome_cat}</td>
<td class="esc">R$ {$valor_compraF}</td>
<td class="esc">R$ {$valor_vendaF}</td>
<td class="esc">{$estoque}</td>

<td>
		
		<big><a href="#" onclick="mostrar('{$nome}', '{$nome_cat}', '{$descricao}', '{$valor_compraF}',  '{$valor_vendaF}', '{$estoque}', '{$foto}', '{$nivel_estoque}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>
	
		</td>
</tr>
HTML;
		}
	}

	echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
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