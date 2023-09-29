<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = $_POST["idTbFluxoComplemento"];
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Montagem do query de update.
//----------
$strSqlFluxoManutencaoUpdate = "";
$strSqlFluxoManutencaoUpdate .= "UPDATE tb_fluxo_complemento ";
$strSqlFluxoManutencaoUpdate .= "SET ";
//$strSqlFluxoManutencaoUpdate .= "id = :id, ";
$strSqlFluxoManutencaoUpdate .= "tipo_complemento = :tipo_complemento, ";
$strSqlFluxoManutencaoUpdate .= "complemento = :complemento, ";
$strSqlFluxoManutencaoUpdate .= "descricao = :descricao ";
$strSqlFluxoManutencaoUpdate .= "WHERE id = :id ";
//----------


//Parâmetros.
//----------
$statementFluxoManutencaoUpdate = $dbSistemaConPDO->prepare($strSqlFluxoManutencaoUpdate);

if ($statementFluxoManutencaoUpdate !== false)
{
	$statementFluxoManutencaoUpdate->execute(array(
		"id" => $id,
		"tipo_complemento" => $tipoComplemento,
		"complemento" => $complemento,
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
unset($strSqlFluxoManutencaoUpdate);
unset($statementFluxoManutencaoUpdate);
//----------


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//"idParentCategorias=" . $idParentCategorias .
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"mensagemSucesso=" . $mensagemSucesso .
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