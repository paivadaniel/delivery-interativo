<?php 
include('../../conexao.php');
//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."sistema/painel/rel/produtos.php"); //variável html recebe esse caminho

if($tipo_rel != 'PDF'){ //tipo_rel está definida em conexao.php, se tipo_rel for diferente de PDF, já mostra o conteúdo da variável html e sai do arquivo, não chama a classe do dompdf
	echo $html;
	exit();
}

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf; //classe dompdf
use Dompdf\Options; //classe options, para passar parâmetros, como de imagem, entre outros

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait'); //portrait ou landscape

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'produtos.pdf',
array("Attachment" => false) //false baixa, true mostra o arquivo pdf no naevgador, e depois você pode imprimir ou fazer o download
);

 ?>