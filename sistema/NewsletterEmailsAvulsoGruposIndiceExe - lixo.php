<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idTbNewsletter = $_POST["id_tb_newsletter"];

$dataGrupo = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$grupoEmails = Funcoes::ConteudoMascaraGravacao01($_POST["grupo_emails"]);
$ativacao = $_POST["ativacao"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlNewsletterEmailsAvulsoGruposInsert = "";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "INSERT INTO tb_newsletter_emails_avulso_grupos ";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "SET ";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "id = :id, ";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "id_tb_newsletter = :id_tb_newsletter, ";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "data_grupo = :data_grupo, ";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "grupo_emails = :grupo_emails, ";
$strSqlNewsletterEmailsAvulsoGruposInsert .= "ativacao = :ativacao ";
//----------


//Parâmetros.
//----------
$statementNewsletterEmailsAvulsoGruposInsert = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoGruposInsert);

if ($statementNewsletterEmailsAvulsoGruposInsert !== false)
{
	$statementNewsletterEmailsAvulsoGruposInsert->execute(array(
		"id" => $id,
		"id_tb_newsletter" => $idTbNewsletter,
		"data_grupo" => $dataGrupo,
		"grupo_emails" => $grupoEmails,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlNewsletterEmailsAvulsoGruposInsert);
unset($statementNewsletterEmailsAvulsoGruposInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbNewsletter=" . $idTbNewsletter .
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