<?php
require_once("../../../conexao.php");
$tabela = 'categorias';

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
	<th class="esc">Descrição</th> 	
	<th class="esc">Cor</th> 
	<th class="esc">Foto</th>		
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
        $foto = $res[$i]['foto'];
        $cor = $res[$i]['cor'];
        $ativo = $res[$i]['ativo'];
       
        $descricaoF = mb_strimwidth($descricao, 0, 85, '...'); //mostra do caracter 0 até o 85, depois adiciona '...'

        if ($ativo == 'Sim') {
            $icone = 'fa-check-square';
            $titulo_link = 'Desativar Item';
            $acao = 'Não';
            $classe_linha = '';
        } else { //usuário inativo
            $icone = 'fa-square-o';
            $titulo_link = 'Ativar Item';
            $acao = 'Sim';
            $classe_linha = 'text-muted';
        }

        echo <<<HTML

<tr class="{$classe_linha}">
<td>{$nome}</td>
<td class="esc">{$descricaoF}</td>
<td class="esc"><div class="divcor {$cor}"></div></td>
<td class="esc"><img src="images/{$tabela}/{$foto}" width="30px"></td> <!-- listar.php é chamado em ajax.js que por sua vez é chamado em usuarios.php, que está dentro de painel/index.php -->
<td>
<big><a href="#" onclick="editar('{$id}','{$nome}', '{$descricao}', '{$foto}', '{$cor}', '{$ativo}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

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

