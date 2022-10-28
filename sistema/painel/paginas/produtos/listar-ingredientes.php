<?php
require_once("../../../conexao.php");
$tabela = 'ingredientes';

$id_prod_ing = $_POST['id_prod_ing'];

$query = $pdo->query("SELECT * FROM $tabela WHERE produto = '$id_prod_ing' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
 
if ($total_reg > 0) {

    echo <<<HTML
	<small>
	<table class="table table-hover" id="tabela-ing"> <!-- id é para referenciar a tabela depois para o DataTable -->
	<thead> 
	<tr> 
	<th>Nome</th>	
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
        $ativo = $res[$i]['ativo'];

        $nomeF = mb_strimwidth($nome, 0, 25, "...");
                
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
   
        echo <<<HTML

<tr class="$classe_linha">
<td>{$nomeF}</td>
<td>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluirIng('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>

		<big><a href="#" onclick="ativarIng('{$id}', '{$acao}')" title="{$titulo_link}"><i class="fa {$icone} text-success"></i></a></big>

</td>
</tr>

HTML;
    }

    echo <<<HTML
</tbody>
<small><div id="mensagem-var" align="center"></div></small>
</table>
</small>
HTML;
} else {
    echo '<small>Não possui ingredientes cadastrados!</small>';
}

?>


<script type="text/javascript">

//como existem poucas variações, pode-se optar por deletar o script abaixo do DataTables
$(document).ready(function() {
        $('#tabela-ing').DataTable({
            "ordering": false, //para retirar a ordenação por order by no SQL
            "stateSave": true //quando editar um registro na página 5, não volta para a primeira página, permanece na 5
        });
        $('#tabela_filter label input').focus(); //foca no campo de busca da tabela ao entrar na tabela
    });
</script>