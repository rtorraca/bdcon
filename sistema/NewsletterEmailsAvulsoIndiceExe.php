<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);

$idTbNewsletterEmailsAvulsoGrupos = $_POST["id_tb_newsletter_emails_avulso_grupos"];
$emails = Funcoes::ConteudoMascaraGravacao01($_POST["emails"]);
//$email = Funcoes::ConteudoMascaraGravacao01($_POST["email"]);
$ativacaoMalaDireta = $_POST["ativacao_mala_direta"];

$gravacaoDb = false;
$countEmails = 0;
$countEmailsErro = 0;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Separação dos e-mails.
//----------
$arrEmails = array();
//$arrEmails = explode(PHP_EOL, $emails);
$arrEmails = preg_split('/\r\n|\r|\n/', $emails);

for($countArrayEmails = 0; $countArrayEmails < count($arrEmails); $countArrayEmails++)
{
	$id = ContadorUniversal::ContadorUniversalUpdate(1);

	$strEmailTratado = "";
	$strEmailTratado = trim($arrEmails[$countArrayEmails]);
	
	if($strEmailTratado != "")
	{
		//Gravação dos e-mails.
		if(DbInsert::InsertNewsletterEmailsAvulso($id,
		$idTbNewsletterEmailsAvulsoGrupos,
		$strEmailTratado,
		$ativacaoMalaDireta) == true)
		{
			$countEmails++;
		}else{
			$countEmailsErro++;
		}
	}
	
	$gravacaoDb = true;
	
	//Debug.
	//echo "arrEmails=" . $arrEmails[$countArrayEmails] . "<br />"; 
	//echo "strEmailTratado=" . $strEmailTratado . "<br />"; 
}



if($gravacaoDb == true)
{
	if($countEmails > 0)
	{
		$mensagemSucesso = $countEmails . " " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoStatusSucessoInclusao");
	}else{
		$mensagemErro = $countEmailsErro . " " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoStatusErroInclusao");
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos .
$queryPadrao .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de saída.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>