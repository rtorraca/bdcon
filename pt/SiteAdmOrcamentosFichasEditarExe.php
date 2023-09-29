<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idCeOrcamentosFichas"];
//$idCeOrcamentos = $_POST["id_ce_orcamentos"];
$idCeOrcamentos = DbFuncoes::GetCampoGenerico01($id, "ce_orcamentos_fichas", "id_ce_orcamentos");

//$dataFicha = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$titulo = Funcoes::ConteudoMascaraGravacao01($_POST["titulo"]);

$idTbCadastro1 = "0";
$idTbCadastro2 = "0";
$idTbCadastro3 = "0";
$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);
$ativacao = $_POST["ativacao"];

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlOrcamentosFichasUpdate = "";
$strSqlOrcamentosFichasUpdate .= "UPDATE ce_orcamentos_fichas ";
$strSqlOrcamentosFichasUpdate .= "SET ";
//$strSqlOrcamentosFichasUpdate .= "id = :id, ";
$strSqlOrcamentosFichasUpdate .= "id_ce_orcamentos = :id_ce_orcamentos, ";
//$strSqlOrcamentosFichasUpdate .= "data_ficha = :data_ficha, ";
$strSqlOrcamentosFichasUpdate .= "titulo = :titulo, ";
$strSqlOrcamentosFichasUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlOrcamentosFichasUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlOrcamentosFichasUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlOrcamentosFichasUpdate .= "obs = :obs, ";
$strSqlOrcamentosFichasUpdate .= "ativacao = :ativacao, ";
$strSqlOrcamentosFichasUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlOrcamentosFichasUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlOrcamentosFichasUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlOrcamentosFichasUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlOrcamentosFichasUpdate .= "informacao_complementar5 = :informacao_complementar5 ";
$strSqlOrcamentosFichasUpdate .= "WHERE id = :id ";
//echo "strSqlOrcamentosFichasUpdate = " . $strSqlOrcamentosFichasUpdate . "<br />";
//----------


//Componentes e parâmetros.
//----------
$statementOrcamentosFichasUpdate = $dbSistemaConPDO->prepare($strSqlOrcamentosFichasUpdate);


/*
		"data_ficha" => $dataFicha,
*/
if ($statementOrcamentosFichasUpdate !== false)
{
	$statementOrcamentosFichasUpdate->execute(array(
		"id" => $id,
		"id_ce_orcamentos" => $idCeOrcamentos,
		"titulo" => $titulo,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"obs" => $obs,
		"ativacao" => $ativacao,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlOrcamentosFichasUpdate);
unset($statementOrcamentosFichasUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idCeOrcamentos=" . $idCeOrcamentos .
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