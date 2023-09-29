<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
//ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de login Master.
$idTbEnquetes = $_GET["idTbEnquetes"];
$idTbEnquetesOpcoes = $_GET["idTbEnquetesOpcoes"];

$paginaRetorno = $_GET["paginaRetorno"];
$masterPageSelect = $_GET["masterPageSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];
$palavraChave = $_GET["palavraChave"];


//Verificação de erro - debug.
//echo "tipoRedirect=" . $tipoRedirect . "<br>";
/*
echo "idTbEnquetes=" . $idTbEnquetes . "<br>";
echo "idTbEnquetesOpcoes=" . $idTbEnquetesOpcoes . "<br>";
*/
//$dbSistemaConPDO = null;
//exit();


//Atualização de resposta.
if(DbUpdate::DBRegistroGenericoUpdate01($idTbEnquetesOpcoes, $idTbEnquetes, "tb_enquetes", "resposta") == true)
{
	$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
}


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbEnquetes=" . $idTbEnquetes .
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&masterPageSelect=" . $masterPageSelect .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;


//Limpeza do buffer de saída.
/*
while (ob_get_status()) 
{
    ob_end_clean();
}
*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>