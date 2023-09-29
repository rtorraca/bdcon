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
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbNewsletterEmailsAvulsoGrupos"];
$idTbNewsletter = $_POST["id_tb_newsletter"];

//$dataGrupo = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$grupoEmails = Funcoes::ConteudoMascaraGravacao01($_POST["grupo_emails"]);
$ativacao = $_POST["ativacao"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlNewsletterEmailsAvulsoGruposUpdate = "";
$strSqlNewsletterEmailsAvulsoGruposUpdate .= "UPDATE tb_newsletter_emails_avulso_grupos ";
$strSqlNewsletterEmailsAvulsoGruposUpdate .= "SET ";
//$strSqlNewsletterEmailsAvulsoGruposUpdate .= "id = :id, ";
$strSqlNewsletterEmailsAvulsoGruposUpdate .= "id_tb_newsletter = :id_tb_newsletter, ";
//$strSqlNewsletterEmailsAvulsoGruposUpdate .= "data_grupo = :data_grupo, ";
$strSqlNewsletterEmailsAvulsoGruposUpdate .= "grupo_emails = :grupo_emails, ";
$strSqlNewsletterEmailsAvulsoGruposUpdate .= "ativacao = :ativacao ";
$strSqlNewsletterEmailsAvulsoGruposUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlNewsletterEmailsAvulsoGruposUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementNewsletterEmailsAvulsoGruposUpdate = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoGruposUpdate);

/*
"id_parent" => $idParent,
"data_criacao" => $dataCriacao,
"data_grupo" => $dataGrupo,
*/
if ($statementNewsletterEmailsAvulsoGruposUpdate !== false)
{
	$statementNewsletterEmailsAvulsoGruposUpdate->execute(array(
		"id" => $id,
		"id_tb_newsletter" => $idTbNewsletter,
		"grupo_emails" => $grupoEmails,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------

//Limpeza de objetos.
//----------
unset($strSqlNewsletterEmailsAvulsoGruposUpdate);
unset($statementNewsletterEmailsAvulsoGruposUpdate);
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