<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idCeOrcamentos = $_POST["id_ce_orcamentos"];
$dataFicha = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$titulo = Funcoes::ConteudoMascaraGravacao01($_POST["titulo"]);
$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);


$idTbCadastro1 = "0";
$idTbCadastro2 = "0";
$idTbCadastro3 = "0";

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
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlOrcamentosFichasInsert = "";
$strSqlOrcamentosFichasInsert .= "INSERT INTO ce_orcamentos_fichas ";
$strSqlOrcamentosFichasInsert .= "SET ";
$strSqlOrcamentosFichasInsert .= "id = :id, ";
$strSqlOrcamentosFichasInsert .= "id_ce_orcamentos = :id_ce_orcamentos, ";
$strSqlOrcamentosFichasInsert .= "data_ficha = :data_ficha, ";
$strSqlOrcamentosFichasInsert .= "titulo = :titulo, ";
$strSqlOrcamentosFichasInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlOrcamentosFichasInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlOrcamentosFichasInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlOrcamentosFichasInsert .= "obs = :obs, ";
$strSqlOrcamentosFichasInsert .= "ativacao = :ativacao, ";
$strSqlOrcamentosFichasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlOrcamentosFichasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlOrcamentosFichasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlOrcamentosFichasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlOrcamentosFichasInsert .= "informacao_complementar5 = :informacao_complementar5 ";


$statementOrcamentosFichasInsert = $dbSistemaConPDO->prepare($strSqlOrcamentosFichasInsert);

if ($statementOrcamentosFichasInsert !== false)
{
	$statementOrcamentosFichasInsert->execute(array(
		"id" => $id,
		"id_ce_orcamentos" => $idCeOrcamentos,
		"data_ficha" => $dataFicha,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------



//Limpeza de objetos.
//----------
unset($strSqlOrcamentosFichasInsert);
unset($statementOrcamentosFichasInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
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