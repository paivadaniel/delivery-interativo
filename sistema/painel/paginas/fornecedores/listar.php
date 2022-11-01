<?php
require_once("../../../conexao.php");
$tabela = 'fornecedores';

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
	<th class="esc">Telefone</th> 	
	<th class="esc">Email</th> 
	<th class="esc">Cadastro</th>
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
		$telefone = $res[$i]['telefone'];
		$email = $res[$i]['email'];
		$endereco = $res[$i]['endereco'];		
		$data = $res[$i]['data'];
		$tipo_chave = $res[$i]['tipo_chave'];
		$chave_pix = $res[$i]['chave_pix'];

        $dataF = implode('/', array_reverse(explode('-', $data)));

        echo <<<HTML

<tr>
<td>{$nome}</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$email}</td>
<td class="esc">{$dataF}</td>
<td>

<big><a href="#" onclick="editar('{$id}','{$nome}', '{$telefone}', '{$email}', '{$endereco}', '{$tipo_chave}', '{$chave_pix}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

<big><a href="#" onclick="mostrar('{$nome}', '{$telefone}', '{$email}', '{$endereco}', '{$dataF}', '{$tipo_chave}', '{$chave_pix}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>

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