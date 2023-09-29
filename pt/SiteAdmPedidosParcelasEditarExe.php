<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idCePedidosParcelas"];
$idCePedidos = $_POST["idCePedidos"];

$nParcela = $_POST["n_parcela"];
if($nParcela == "")
{
	$nParcela = 0;
}

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

//$idTbCadastroCliente = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente");

$masterPageSelect = $_POST["masterPageSelect"];
$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlProdutosUpdate = "";
$strSqlProdutosUpdate .= "UPDATE ce_pedidos_parcelas ";
$strSqlProdutosUpdate .= "SET ";
//$strSqlProdutosUpdate .= "id = :id, ";
//$strSqlProdutosUpdate .= "id_ce_pedidos = :id_ce_pedidos, ";
$strSqlProdutosUpdate .= "n_parcela = :n_parcela, ";
$strSqlProdutosUpdate .= "data_vencimento = :data_vencimento, ";
$strSqlProdutosUpdate .= "data_pagamento = :data_pagamento, ";
$strSqlProdutosUpdate .= "valor = :valor, ";
$strSqlProdutosUpdate .= "valor_desconto = :valor_desconto, ";
$strSqlProdutosUpdate .= "valor_acrescimo = :valor_acrescimo, ";
$strSqlProdutosUpdate .= "valor_total = :valor_total, ";

$strSqlProdutosUpdate .= "ativacao = :ativacao, ";

$strSqlProdutosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlProdutosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlProdutosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlProdutosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlProdutosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";

$strSqlProdutosUpdate .= "id_ce_complemento_tipo = :id_ce_complemento_tipo, ";
$strSqlProdutosUpdate .= "id_ce_complemento_status = :id_ce_complemento_status ";
//$strSqlProdutosUpdate .= "n_visitas = :n_visitas ";

$strSqlProdutosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlProdutosUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementProdutosUpdate = $dbSistemaConPDO->prepare($strSqlProdutosUpdate);

/*
"id_ce_pedidos" => $idCePedidos,
*/
if ($statementProdutosUpdate !== false)
{
	$statementProdutosUpdate->execute(array(
		"id" => $id,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
	
	
	if($ativacao == 1){
		//Automação fluxo de caixa.
		//if($habilitarFluxoContabilizacaoAtivacaoPedidos == 1)
		if($GLOBALS['habilitarFluxoContabilizacaoAtivacaoPedidos'] == 1)
		{
			//Pedidos parcelas.
			//----------------------
			//if($strTabela == "ce_pedidos_parcelas")
			//{
				//Definição de algumas variáveis complementares.
				$tbCadastroId = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente");
				//$cePedidosParcelasValor = Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico01($idRegistro, "ce_pedidos_parcelas", "valor"), $GLOBALS['configSistemaMoeda']);
				if($GLOBALS['habilitarPedidosParcelasValorTotal'] == 1)
				{
					$cePedidosParcelasValor = $valorTotal;
				}else{
					$cePedidosParcelasValor = $valor;
				}
				$cePedidosParcelasId = $idCePedidos;
				$lancamento = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFluxoLancamento1") . " (" . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosNumero") . ": " . $id . ")";
				
				//Verificação se já existe registro.
				if(DbFuncoes::GetCampoGenerico06("tb_fluxo", 
												"id", 
												"id_item", 
												$id, 
												"", 
												"", 
												2,
												"", 
												"", 
												"id_tb_cadastro", 
												$tbCadastroId, 
												"debito_credito", 
												"1") == "")
				{
					//Gravação de registro.
					if(DbInsert::FluxoInsert($id, 
											$GLOBALS['configIdFluxoContabilizacaoAtivacaoPedidos'], 
											"1", 
											"ce_pedidos_parcelas", 
											$tbCadastroId, 
											"0", 
											$lancamento, 
											$GLOBALS['configTipoFluxoContabilizacaoAtivacaoPedidos'], 
											$GLOBALS['configStatusFluxoContabilizacaoAtivacaoPedidos'], 
											$cePedidosParcelasValor, 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"", 
											"1", 
											"1") == true)
					{
						//Sucesso.
					}
				}
			//}
			//----------------------
		}
	}
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlProdutosUpdate);
unset($statementProdutosUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
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