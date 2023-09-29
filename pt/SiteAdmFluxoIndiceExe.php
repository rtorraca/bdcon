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
$id = ContadorUniversal::ContadorUniversalUpdate(1);
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


//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem do query.
//----------
$strSqlFluxoInsert = "";
$strSqlFluxoInsert .= "INSERT INTO tb_fluxo ";
$strSqlFluxoInsert .= "SET ";
$strSqlFluxoInsert .= "id = :id, ";
$strSqlFluxoInsert .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlFluxoInsert .= "data_lancamento = :data_lancamento, ";
$strSqlFluxoInsert .= "data_contabilizacao = :data_contabilizacao, ";
$strSqlFluxoInsert .= "debito_credito = :debito_credito, ";
$strSqlFluxoInsert .= "id_item = :id_item, ";
$strSqlFluxoInsert .= "tabela = :tabela, ";
$strSqlFluxoInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlFluxoInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlFluxoInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlFluxoInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlFluxoInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";

$strSqlFluxoInsert .= "lancamento = :lancamento, ";
$strSqlFluxoInsert .= "id_tb_fluxo_tipo = :id_tb_fluxo_tipo, ";
$strSqlFluxoInsert .= "id_tb_fluxo_status = :id_tb_fluxo_status, ";

$strSqlFluxoInsert .= "valor = :valor, ";
$strSqlFluxoInsert .= "valor1 = :valor1, ";
$strSqlFluxoInsert .= "valor2 = :valor2, ";
$strSqlFluxoInsert .= "valor3 = :valor3, ";
$strSqlFluxoInsert .= "valor4 = :valor4, ";
$strSqlFluxoInsert .= "valor5 = :valor5, ";

$strSqlFluxoInsert .= "n_documento = :n_documento, ";
$strSqlFluxoInsert .= "autenticacao = :autenticacao, ";

$strSqlFluxoInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlFluxoInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlFluxoInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlFluxoInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlFluxoInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlFluxoInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlFluxoInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlFluxoInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlFluxoInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlFluxoInsert .= "informacao_complementar10 = :informacao_complementar10, ";

$strSqlFluxoInsert .= "obs = :obs, ";
$strSqlFluxoInsert .= "ativacao = :ativacao, ";
$strSqlFluxoInsert .= "ativacao_contabilizacao = :ativacao_contabilizacao ";
//----------


//Parametros e execução.
//----------
$statementFluxoInsert = $dbSistemaConPDO->prepare($strSqlFluxoInsert);

if ($statementFluxoInsert !== false)
{
	$statementFluxoInsert->execute(array(
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Verificação de erro - debug.
echo "id=" . $id . "<br />";
echo "id_tb_categorias=" . $idTbCategorias . "<br />";
echo "data_lancamento=" . $dataLancamento . "<br />";
echo "dataContabilizacao=" . $dataContabilizacao . "<br />";
print "dataContabilizacao=" . $dataContabilizacao . "<br />";
print_r("dataContabilizacao=" . $dataContabilizacao . "<br />");
echo "debitoCredito=" . $debitoCredito . "<br />";
echo "id_item=" . $idItem . "<br />";
echo "ativacao_contabilizacao=" . $ativacaoContabilizacao . "<br />";


//Limpeza de objetos.
//----------
unset($strSqlFluxoInsert);
unset($statementFluxoInsert);
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