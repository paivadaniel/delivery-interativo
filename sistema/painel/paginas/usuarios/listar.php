<?php
require_once("../../../conexao.php");
$tabela = 'usuarios';

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
	<th class="esc">Email</th> 	
	<th class="esc">Senha</th> 
	<th class="esc">Nível</th>	
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
        $email = $res[$i]['email'];
        $cpf = $res[$i]['cpf'];
        $senha = $res[$i]['senha'];
        $nivel = $res[$i]['nivel'];
        $ativo = $res[$i]['ativo'];
        $data = $res[$i]['data'];
        $foto = $res[$i]['foto'];
        $telefone = $res[$i]['telefone'];

        if ($nivel == 'Administrador') { //não exibe a senha de administradores
            $senha = '*********';
        }

        $dataF = implode('/', array_reverse(explode('-', $data)));

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
<td class="esc">{$email}</td>
<td class="esc">{$senha}</td>
<td class="esc">{$nivel}</td>
<td class="esc"><img src="images/perfil/{$foto}" width="30px"></td> <!-- listar.php é chamado em ajax.js que por sua vez é chamado em usuarios.php, que está dentro de painel/index.php -->
<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}', '{$email}', '{$senha}', '{$nivel}', '{$foto}', '{$telefone}', '{$cpf}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

	<big><a href="#" onclick="mostrar('{$nome}', '{$email}', '{$cpf}', '{$senha}', '{$nivel}', '{$dataF}', '{$ativo}', '{$telefone}', '{$foto}')" title="Ver Dados"><i class="fa fa-info-circle text-secondary"></i></a></big>


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
<small><div id="mensagem-excluir2" align="center"></div></small>
</table>
</small>
HTML;
} else {
    echo 'Não possui registros cadastrados!';
}
