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
$idCePedidos = $_POST["id_ce_pedidos"];

$nParcela = $_POST["n_parcela"];
if($nParcela == "")
{
	$nParcela = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataVencimento = Funcoes::DataGravacaoSql($_POST["data_vencimento"], $GLOBALS['configSistemaFormatoData']);
if($dataVencimento == "")
{
	//$data_publicacao = NULL;	
	$dataVencimento = date("Y") . "-" . date("m") . "-" . date("d");	
}

$dataPagamento = Funcoes::DataGravacaoSql($_POST["data_pagamento"], $GLOBALS['configSistemaFormatoData']);
if($dataPagamento == "")
{
	$dataPagamento = NULL;	
}

$valor = Funcoes::MascaraValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;
}
$valorDesconto = Funcoes::MascaraValorGravar($_POST["valor_desconto"]);
if($valorDesconto == "")
{
	$valorDesconto = 0;
}
$valorAcrescimo = Funcoes::MascaraValorGravar($_POST["valor_acrescimo"]);
if($valorAcrescimo == "")
{
	$valorAcrescimo = 0;
}
$valorTotal = Funcoes::MascaraValorGravar($_POST["valor_total"]);
if($valorTotal == "")
{
	$valorTotal = 0;
}

$ativacao = $_POST["ativacao"];

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$idCeComplementoTipo = $_POST["id_ce_complemento_tipo"];
$idCeComplementoStatus = $_POST["id_ce_complemento_status"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem do query.
//----------
$strSqlPedidosParcelasInsert = "";
$strSqlPedidosParcelasInsert .= "INSERT INTO ce_pedidos_parcelas ";
$strSqlPedidosParcelasInsert .= "SET ";
$strSqlPedidosParcelasInsert .= "id = :id, ";
$strSqlPedidosParcelasInsert .= "id_ce_pedidos = :id_ce_pedidos, ";
$strSqlPedidosParcelasInsert .= "n_parcela = :n_parcela, ";
$strSqlPedidosParcelasInsert .= "data_vencimento = :data_vencimento, ";
$strSqlPedidosParcelasInsert .= "data_pagamento = :data_pagamento, ";

$strSqlPedidosParcelasInsert .= "valor = :valor, ";
$strSqlPedidosParcelasInsert .= "valor_desconto = :valor_desconto, ";
$strSqlPedidosParcelasInsert .= "valor_acrescimo = :valor_acrescimo, ";
$strSqlPedidosParcelasInsert .= "valor_total = :valor_total, ";

$strSqlPedidosParcelasInsert .= "ativacao = :ativacao, ";

$strSqlPedidosParcelasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlPedidosParcelasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlPedidosParcelasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlPedidosParcelasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlPedidosParcelasInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlPedidosParcelasInsert .= "id_ce_complemento_tipo = :id_ce_complemento_tipo, ";
$strSqlPedidosParcelasInsert .= "id_ce_complemento_status = :id_ce_complemento_status ";
//----------


//Parametros e execução.
//----------
$statementPedidosParcelasInsert = $dbSistemaConPDO->prepare($strSqlPedidosParcelasInsert);

if ($statementPedidosParcelasInsert !== false)
{
	$statementPedidosParcelasInsert->execute(array(
		"id" => $id,
		"id_ce_pedidos" => $idCePedidos,
		"n_parcela" => $nParcela,
		"data_vencimento" => $dataVencimento,
		"data_pagamento" => $dataPagamento,
		"valor" => $valor,
		"valor_desconto" => $valorDesconto,
		"valor_acrescimo" => $valorAcrescimo,
		"valor_total" => $valorTotal,
		"ativacao" => $ativacao,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"id_ce_complemento_tipo" => $idCeComplementoTipo,
		"id_ce_complemento_status" => $idCeComplementoStatus
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
unset($strSqlPedidosParcelasInsert);
unset($statementPedidosParcelasInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idCePedidos=" . $idCePedidos . 
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