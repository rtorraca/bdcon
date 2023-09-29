<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importaзгo dos arquivos de configuraзгo.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variбveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbBanners"];
$idTbCategorias = $_POST["id_tb_categorias"];

$grupo = Funcoes::ConteudoMascaraGravacao01($_POST["grupo"]);
$nBanners = $_POST["n_banners"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrгo de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlBannersUpdate = "";
$strSqlBannersUpdate .= "UPDATE tb_banners ";
$strSqlBannersUpdate .= "SET ";
//$strSqlBannersUpdate .= "id = :id, ";
$strSqlBannersUpdate .= "id_tb_categorias = :id_tb_categorias, ";

$strSqlBannersUpdate .= "grupo = :grupo, ";
$strSqlBannersUpdate .= "n_banners = :n_banners, ";
$strSqlBannersUpdate .= "descricao = :descricao ";

$strSqlBannersUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlBannersUpdate . "<br />";
//----------


//Parвmetros.
//----------
$statementBannersUpdate = $dbSistemaConPDO->prepare($strSqlBannersUpdate);

/*
"id_parent" => $idParent,
"data_criacao" => $dataCriacao,
*/
if ($statementBannersUpdate !== false)
{
	$statementBannersUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"grupo" => $grupo,
		"n_banners" => $nBanners,
		"descricao" => $descricao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------

//Limpeza de objetos.
//----------
unset($strSqlBannersUpdate);
unset($statementBannersUpdate);
//----------


//Fechamento da conexгo.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentBanners=" . $idTbCategorias .
$queryPadrao . 
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de saнda.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de pбgina.
//exit();
header("Location: " . $URLRetorno);
die();
?>