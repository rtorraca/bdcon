<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


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
$id = $_POST["idTbFluxo"];
$idTbCategorias = $_POST["id_tb_categorias"];

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataLancamento = Funcoes::DataGravacaoSql($_POST["data_lancamento"], $GLOBALS['configSistemaFormatoData']);
if($dataLancamento == "")
{
	//$data_publicacao = NULL;	
	$dataLancamento = date("Y") . "-" . date("m") . "-" . date("d");	
}

$dataContabilizacao = Funcoes::DataGravacaoSql($_POST["data_contabilizacao"], $GLOBALS['configSistemaFormatoData']);
if($dataContabilizacao == "")
{
	$dataContabilizacao = NULL;	
}


$debitoCredito = $_POST["debito_credito"];
$idItem = $_POST["idItem"];
if($idItem == "")
{
	$idItem = 0;
}

$tabela = $_POST["tabela"];

$idTbCadastro = $_POST["id_tb_cadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}


$lancamento = Funcoes::ConteudoMascaraGravacao01($_POST["lancamento"]);
$idTbFluxoTipo = $_POST["id_tb_fluxo_tipo"];
$idTbFluxoStatus = $_POST["id_tb_fluxo_status"];
//$valor = $_POST["valor"];
$valor = Funcoes::MascaraValorGravar($_POST["valor"]);
$nDocumento = Funcoes::ConteudoMascaraGravacao01($_POST["n_documento"]);
$autenticacao = Funcoes::ConteudoMascaraGravacao01($_POST["autenticacao"]);

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);
$informacaoComplementar6 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar6"]);
$informacaoComplementar7 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar7"]);
$informacaoComplementar8 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar8"]);
$informacaoComplementar9 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar9"]);
$informacaoComplementar10 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar10"]);

$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);

$ativacao = $_POST["ativacao"];
$ativacaoContabilizacao = $_POST["ativacao_contabilizacao"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlFluxoUpdate = "";
$strSqlFluxoUpdate .= "UPDATE tb_fluxo ";
$strSqlFluxoUpdate .= "SET ";
//$strSqlFluxoUpdate .= "id = :id, ";
$strSqlFluxoUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlFluxoUpdate .= "data_lancamento = :data_lancamento, ";
$strSqlFluxoUpdate .= "data_contabilizacao = :data_contabilizacao, ";
$strSqlFluxoUpdate .= "debito_credito = :debito_credito, ";
$strSqlFluxoUpdate .= "id_item = :id_item, ";
$strSqlFluxoUpdate .= "tabela = :tabela, ";
$strSqlFluxoUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlFluxoUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlFluxoUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlFluxoUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlFluxoUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlFluxoUpdate .= "lancamento = :lancamento, ";
$strSqlFluxoUpdate .= "id_tb_fluxo_tipo = :id_tb_fluxo_tipo, ";
$strSqlFluxoUpdate .= "id_tb_fluxo_status = :id_tb_fluxo_status, ";
$strSqlFluxoUpdate .= "valor = :valor, ";
$strSqlFluxoUpdate .= "valor1 = :valor1, ";
$strSqlFluxoUpdate .= "valor2 = :valor2, ";
$strSqlFluxoUpdate .= "valor3 = :valor3, ";
$strSqlFluxoUpdate .= "valor4 = :valor4, ";
$strSqlFluxoUpdate .= "valor5 = :valor5, ";
$strSqlFluxoUpdate .= "n_documento = :n_documento, ";
$strSqlFluxoUpdate .= "autenticacao = :autenticacao, ";
$strSqlFluxoUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlFluxoUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlFluxoUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlFluxoUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlFluxoUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlFluxoUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlFluxoUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlFluxoUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlFluxoUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlFluxoUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlFluxoUpdate .= "obs = :obs, ";
$strSqlFluxoUpdate .= "ativacao = :ativacao, ";
$strSqlFluxoUpdate .= "ativacao_contabilizacao = :ativacao_contabilizacao ";
$strSqlFluxoUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlFluxoUpdate . "<br />";
//----------


//Parametrização.
//----------
$statementFluxoUpdate = $dbSistemaConPDO->prepare($strSqlFluxoUpdate);
/*
		"id" => $id,
*/
if ($statementFluxoUpdate !== false)
{
	$statementFluxoUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"data_contabilizacao" => $dataContabilizacao,
		"data_lancamento" => $dataLancamento,
		"debito_credito" => $debitoCredito,
		"id_item" => $idItem,
		"tabela" => $tabela,
		"id_tb_cadastro" => $idTbCadastro,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"id_tb_cadastro1" => 0,
		"id_tb_cadastro2" => 0,
		"id_tb_cadastro3" => 0,
		"lancamento" => $lancamento,
		"id_tb_fluxo_tipo" => $idTbFluxoTipo,
		"id_tb_fluxo_status" => $idTbFluxoStatus,
		"valor" => $valor,
		"valor1" => 0,
		"valor2" => 0,
		"valor3" => 0,
		"valor4" => 0,
		"valor5" => 0,
		"n_documento" => $nDocumento,
		"autenticacao" => $autenticacao,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"informacao_complementar6" => $informacaoComplementar6,
		"informacao_complementar7" => $informacaoComplementar7,
		"informacao_complementar8" => $informacaoComplementar8,
		"informacao_complementar9" => $informacaoComplementar9,
		"informacao_complementar10" => $informacaoComplementar10,
		"obs" => $obs,
		"ativacao" => $ativacao,
		"ativacao_contabilizacao" => $ativacaoContabilizacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlFluxoUpdate);
unset($statementFluxoUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParentFluxo=" . $idTbCategorias .
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