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
$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastro = $_POST["id_tb_cadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$dataNewsletter = Funcoes::DataGravacaoSql($_POST["data_newsletter"], $GLOBALS['configSistemaFormatoData']);
if($dataNewsletter == "")
{
	//$data_publicacao = NULL;	
	//$dataNewsletter = date("Y") . "-" . date("m") . "-" . date("d");
	$dataNewsletter = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
	 
}

$dataEnvio = NULL;

$campanha = Funcoes::ConteudoMascaraGravacao01($_POST["campanha"]);
$nomeRemetente = Funcoes::ConteudoMascaraGravacao01($_POST["nome_remetente"]);
$emailRemetente = Funcoes::ConteudoMascaraGravacao01($_POST["email_remetente"]);
$assunto = Funcoes::ConteudoMascaraGravacao01($_POST["assunto"]);
$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);

$corInterna = Funcoes::ConteudoMascaraGravacao01($_POST["cor_interna"]);
$corFundo = Funcoes::ConteudoMascaraGravacao01($_POST["cor_fundo"]);
$corBorda = Funcoes::ConteudoMascaraGravacao01($_POST["cor_borda"]);
$largura = Funcoes::ConteudoMascaraGravacao01($_POST["largura"]);
if($largura == "")
{
	$largura = 0;
}

$nEnvios = 0;
$nEmails = 0;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlNewsletterInsert = "";
$strSqlNewsletterInsert .= "INSERT INTO tb_newsletter ";
$strSqlNewsletterInsert .= "SET ";
$strSqlNewsletterInsert .= "id = :id, ";
$strSqlNewsletterInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlNewsletterInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlNewsletterInsert .= "n_classificacao = :n_classificacao, ";

$strSqlNewsletterInsert .= "data_newsletter = :data_newsletter, ";
//$strSqlNewsletterInsert .= "data_envio = :data_envio, ";

$strSqlNewsletterInsert .= "campanha = :campanha, ";
$strSqlNewsletterInsert .= "nome_remetente = :nome_remetente, ";
$strSqlNewsletterInsert .= "email_remetente = :email_remetente, ";
$strSqlNewsletterInsert .= "assunto = :assunto, ";
$strSqlNewsletterInsert .= "obs = :obs, ";

$strSqlNewsletterInsert .= "cor_interna = :cor_interna, ";
$strSqlNewsletterInsert .= "cor_fundo = :cor_fundo, ";
$strSqlNewsletterInsert .= "cor_borda = :cor_borda, ";
$strSqlNewsletterInsert .= "largura = :largura, ";

$strSqlNewsletterInsert .= "n_envios = :n_envios, ";
$strSqlNewsletterInsert .= "n_emails = :n_emails ";
/**/
//----------


//Debug.
/*
echo "strSqlNewsletterInsert=" . $strSqlNewsletterInsert . "<br />";
echo "id=" . $id . "<br />";
echo "idTbCategorias=" . $idTbCategorias . "<br />";
$dbSistemaConPDO = null;
die();
*/


//Parâmetros.
//----------
$statementNewsletterInsert = $dbSistemaConPDO->prepare($strSqlNewsletterInsert);

/*
*/
if ($statementNewsletterInsert !== false)
{
	$statementNewsletterInsert->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro" => $idTbCadastro,
		"n_classificacao" => $nClassificacao,
		"data_newsletter" => $dataNewsletter,
		"campanha" => $campanha,
		"nome_remetente" => $nomeRemetente,
		"email_remetente" => $emailRemetente,
		"assunto" => $assunto,
		"obs" => $obs,
		"cor_interna" => $corInterna,
		"cor_fundo" => $corFundo,
		"cor_borda" => $corBorda,
		"largura" => $largura,
		"n_envios" => $nEnvios,
		"n_emails" => $nEmails
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
unset($strSqlNewsletterInsert);
unset($statementNewsletterInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentNewsletter=" . $idTbCategorias .
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