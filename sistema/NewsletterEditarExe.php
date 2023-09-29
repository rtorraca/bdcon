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
$id = $_POST["idTbNewsletter"];
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

//$dataNewsletter = Funcoes::DataGravacaoSql($_POST["data_newsletter"], $GLOBALS['configSistemaFormatoData']);
//if($dataNewsletter == "")
//{
	//$data_publicacao = NULL;	
	//$dataNewsletter = date("Y") . "-" . date("m") . "-" . date("d");
	//$dataNewsletter = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
	 
//}

//$dataEnvio = NULL;

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

//$nEnvios = 0;
//$nEmails = 0;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlNewsletterUpdate = "";
$strSqlNewsletterUpdate .= "UPDATE tb_newsletter ";
$strSqlNewsletterUpdate .= "SET ";

//$strSqlNewsletterUpdate .= "id = :id, ";
$strSqlNewsletterUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlNewsletterUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlNewsletterUpdate .= "n_classificacao = :n_classificacao, ";

//$strSqlNewsletterUpdate .= "data_newsletter = :data_newsletter, ";
//$strSqlNewsletterUpdate .= "data_envio = :data_envio, ";

$strSqlNewsletterUpdate .= "campanha = :campanha, ";
$strSqlNewsletterUpdate .= "nome_remetente = :nome_remetente, ";
$strSqlNewsletterUpdate .= "email_remetente = :email_remetente, ";
$strSqlNewsletterUpdate .= "assunto = :assunto, ";
$strSqlNewsletterUpdate .= "obs = :obs, ";

$strSqlNewsletterUpdate .= "cor_interna = :cor_interna, ";
$strSqlNewsletterUpdate .= "cor_fundo = :cor_fundo, ";
$strSqlNewsletterUpdate .= "cor_borda = :cor_borda, ";
$strSqlNewsletterUpdate .= "largura = :largura ";

//$strSqlNewsletterUpdate .= "n_envios = :n_envios, ";
//$strSqlNewsletterUpdate .= "n_emails = :n_emails ";


$strSqlNewsletterUpdate .= "WHERE id = :id ";


//echo "strSqlCategoriasUpdate = " . $strSqlNewsletterUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementNewsletterUpdate = $dbSistemaConPDO->prepare($strSqlNewsletterUpdate);

/*
		"data_newsletter" => $dataNewsletter,
		
		"n_envios" => $nEnvios,
		"n_emails" => $nEmails
*/
if ($statementNewsletterUpdate !== false)
{
	$statementNewsletterUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro" => $idTbCadastro,
		"n_classificacao" => $nClassificacao,
		"campanha" => $campanha,
		"nome_remetente" => $nomeRemetente,
		"email_remetente" => $emailRemetente,
		"assunto" => $assunto,
		"obs" => $obs,
		"cor_interna" => $corInterna,
		"cor_fundo" => $corFundo,
		"cor_borda" => $corBorda,
		"largura" => $largura
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------

//Limpeza de objetos.
//----------
unset($strSqlNewsletterUpdate);
unset($statementNewsletterUpdate);
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