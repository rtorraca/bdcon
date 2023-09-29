<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importa��o dos arquivos de configura��o.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verifica��o de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verifica��o de login Master.
$idRegistro = $_GET["idRegistro"];
$idParentCategorias = $_GET["idParentCategorias"];

$idParentPublicacoes = $_GET["idParentPublicacoes"];
$tipoPublicacao = $_GET["tipoPublicacao"];
$campo = $_GET["campo"];

$statusAtivacao = $_GET["statusAtivacao"];
$strCampo = $_GET["strCampo"];
$strTabela = $_GET["strTabela"];

$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
$masterPageSelect = $_GET["masterPageSelect"];
//$paginaRetorno = $_GET["paginaRetorno"];
$paginaRetornoExclusao = $_GET["paginaRetornoExclusao"];
$variavelRetorno = $_GET["variavelRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_GET["paginacaoNumero"];


//Tratamento de array de imagens.
$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
$nomeCampoArquivo = "";

//tb_categorias
//----------
if($strTabela == "tb_categorias")
{
	if($GLOBALS['ativacaoImagensPadrao'] == 0)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemCategoria'];
	}
	$nomeCampoArquivo = "imagem";
}
//----------


//Resgate do nome do arquivo para exclus�o do arquivo f�sico.
$nomeArquivo = DbFuncoes::GetCampoGenerico01($idRegistro, $strTabela, $nomeCampoArquivo);

//Verifica��o de erro - debug
//echo "idRegistro=" . $idRegistro . "<br />";
//echo "strTabela=" . $strTabela . "<br />";
//echo "strCampo=" . $strCampo . "<br />";
//echo "arrImagemTamanhos=" . $arrImagemTamanhos . "<br />";
//exit();

//Update do registro da exclus�o do arquivo.
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01("", $idRegistro, $strTabela, $strCampo);
if ($resultadoUpdate == true) 
{
	//Exclus�o dos arquivos f�sicos.
	Arquivo::ExcluirArquivos($nomeArquivo, $arrImagemTamanhos); //Exclus�o de arquivos.
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus10");
}else{
	//$mensagemErro .= $resultadoUpdate;
	$mensagemErro .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus15");
	//$mensagemSucesso = "";
}


//Fechamento da conex�o.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetornoExclusao . "?" .
$variavelRetorno . "=" . $idRegistro .
"&idParentCategorias=" . $idParentCategorias .
"&idParentPublicacoes=" . $idParentPublicacoes .
"&tipoPublicacao=" . $tipoPublicacao .
"&campo=" . $campo .
"&idTbCadastroUsuario=" . $idTbCadastroUsuario .
"&masterPageSelect=" . $masterPageSelect .
"&paginacaoNumero=" . $paginacaoNumero .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de sa�da.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de p�gina.
//exit();
header("Location: " . $URLRetorno);
die();
?>