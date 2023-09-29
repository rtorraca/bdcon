<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importa��o dos arquivos de configura��o.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de vari�veis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idParentCategorias = $_POST["id_tb_categorias"];

$grupo = Funcoes::ConteudoMascaraGravacao01($_POST["grupo"]);
$nBanners = $_POST["n_banners"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padr�o de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclus�o de registro no BD.
//----------
$strSqlBannersInsert = "";
$strSqlBannersInsert .= "INSERT INTO tb_banners ";
$strSqlBannersInsert .= "SET ";
$strSqlBannersInsert .= "id = :id, ";
$strSqlBannersInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlBannersInsert .= "grupo = :grupo, ";
$strSqlBannersInsert .= "n_banners = :n_banners, ";
$strSqlBannersInsert .= "descricao = :descricao ";
//----------


//Par�metros.
//----------
$statementBannersInsert = $dbSistemaConPDO->prepare($strSqlBannersInsert);

if ($statementBannersInsert !== false)
{
	$statementBannersInsert->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idParentCategorias,
		"grupo" => $grupo,
		"n_banners" => $nBanners,
		"descricao" => $descricao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verifica��o de grava��o.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlBannersInsert);
unset($statementBannersInsert);
//----------


//Fechamento da conex�o.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentBanners=" . $idParentCategorias .
$queryPadrao .
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