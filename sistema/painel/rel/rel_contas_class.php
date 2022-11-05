<?php 

include('../../conexao.php');

$dataInicial = $_POST['dataInicial'];
$dataFinal = $_POST['dataFinal'];
$pago = urlencode($_POST['pago']); //urlencode usa para passar para depois pegar por GET (logo a seguir) uma url que tenha espaço ou caracteres especiais, aqui é '', Sim e Não
$tabela = urlencode($_POST['tabela']); //aqui é pagar ou receber
$busca = urlencode($_POST['busca']); //aqui é data_venc ou data_pgto

//ALIMENTAR OS DADOS NO RELATÓRIO
$html = file_get_contents($url_sistema."sistema/painel/rel/rel_contas.php?pago=$pago&dataInicial=$dataInicial&dataFinal=$dataFinal&tabela=$tabela&busca=$busca"); //não tem uma ordem certa de passagem para esses parâmetros

if($tipo_rel != 'PDF'){
	echo $html;
	exit();
}

//CARREGAR DOMPDF
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', true);
$pdf = new DOMPDF($options);

//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();

//NOMEAR O PDF GERADO
$pdf->stream(
'contas.pdf',
array("Attachment" => false)
);
?>