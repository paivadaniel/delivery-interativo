<?php
require_once("../../../conexao.php");
$tabela = 'produtos';

$query = $pdo->query("SELECT * FROM $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {

    echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela"> <!-- id é para referenciar a tabela depois para o DataTable -->
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
        $ativo = $res[$i]['ativo'];

        $nomeF = mb_strimwidth($nome, 0, 25, "...");
        $valor_vendaF = number_format($valor_venda, 2, ',', '.');
        $valor_compraF = number_format($valor_compra, 2, ',', '.');

        if ($ativo == 'Sim') { //para desativar
            $icone = 'fa-check-square';
            $titulo_link = 'Desativar Item';
            $acao = 'Não';
            $classe_linha = '';
        } else { //para ativar
            $icone = 'fa-square-o';
            $titulo_link = 'Ativar Item';
            $acao = 'Sim';
            $classe_linha = 'text-muted';
        }

        $query2 = $pdo->query("SELECT * FROM categorias where id = '$categoria'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $total_reg2 = @count($res2);

        if ($total_reg2 > 0) {
            $nome_cat = $res2[0]['nome'];
        } else {
            $nome_cat = 'Sem Referência!';
        }

        if ($nivel_estoque >= $estoque and $tem_estoque == 'Sim') { //se está com nível de estoque mínimo do produto
            $alerta_estoque = 'text-danger';
        } else {
            $alerta_estoque = '';
        }

        echo <<<HTML

<tr class="{$alerta_estoque} {$classe_linha}">
<td>
<img src="images/produtos/{$foto}" width="27px" class="mr-2">
{$nomeF}
</td>
<td class="esc">{$nome_cat}</td>
<td class="esc">R$ {$valor_compraF}</td>
<td class="esc">R$ {$valor_vendaF}</td>
<td class="esc">{$estoque}</td>
<td>

<big><a href="#" onclick="editar('{$id}','{$nome}', '{$categoria}', '{$descricao}', '{$valor_compra}', '{$valor_venda}', '{$foto}', '{$nivel_estoque}', '{$tem_estoque}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

<big><a href="#" onclick="mostrar('{$nome}', '{$nome_cat}', '{$descricao}', '{$valor_compraF}',  '{$valor_vendaF}', '{$estoque}', '{$foto}', '{$nivel_estoque}', '{$tem_estoque}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

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

		<big><a href="#" onclick="ativar('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>

		<big><a href="#" onclick="saida('{$id}','{$nome}', '{$estoque}')" title="Saída de Produto"><i class="fa fa-sign-out text-danger"></i></a></big>

		<big><a href="#" onclick="entrada('{$id}','{$nome}', '{$estoque}')" title="Entrada de Produto"><i class="fa fa-sign-in text-verde"></i></a></big>
		
        <big><a href="#" onclick="variacoes('{$id}','{$nome}')" title="Variações do Produto"><i class="fa fa-list text-primary"></i></a></big>

        <big><a href="#" onclick="ingredientes('{$id}','{$nome}')" title="Ingredientes do Produto"><i class="fa fa-cutlery text-cinza"></i></a></big>

        <big><a href="#" onclick="adicionais('{$id}','{$nome}')" title="Adicionais do Produto"><i class="fa fa-plus text-verde"></i></a></big>

</td>
</tr>

HTML;
    }

    echo <<<HTML
</tbody>
<small><div id="mensagem-excluir" align="center"></div></small>
</table>
</small>
HTML;
} else {
    echo 'Não possui registros cadastrados!';
}

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#tabela').DataTable({
            "ordering": false, //para retirar a ordenação por order by no SQL
            "stateSave": true //quando editar um registro na página 5, não volta para a primeira página, permanece na 5
        });
        $('#tabela_filter label input').focus(); //foca no campo de busca da tabela ao entrar na tabela
    });
</script>