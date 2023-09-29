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
$id = $_POST["idTbVeiculosComplemento"];
$tipoComplemento = $_POST["tipo_complemento"];
//$complemento = $_POST["complemento"];
$complemento = Funcoes::ConteudoMascaraGravacao01($_POST["complemento"]);
//$descricao = $_POST["descricao"];
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlVeiculosManutencaoUpdate = "";
$strSqlVeiculosManutencaoUpdate .= "UPDATE tb_veiculos_complemento ";
$strSqlVeiculosManutencaoUpdate .= "SET ";
//$strSqlVeiculosManutencaoUpdate .= "id = :id, ";
$strSqlVeiculosManutencaoUpdate .= "tipo_complemento = :tipo_complemento, ";
$strSqlVeiculosManutencaoUpdate .= "complemento = :complemento, ";
$strSqlVeiculosManutencaoUpdate .= "descricao = :descricao ";
$strSqlVeiculosManutencaoUpdate .= "WHERE id = :id ";
//----------


//Parâmetros.
//----------
$statementVeiculosManutencaoUpdate = $dbSistemaConPDO->prepare($strSqlVeiculosManutencaoUpdate);

if ($statementVeiculosManutencaoUpdate !== false)
{
	$statementVeiculosManutencaoUpdate->execute(array(
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
unset($strSqlVeiculosManutencaoUpdate);
unset($statementVeiculosManutencaoUpdate);
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