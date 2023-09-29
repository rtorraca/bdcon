<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idCePedidos"];
$idTbCadastro = $_POST["idTbCadastro"];
$flagFinalizar = $_POST["flagFinalizar"];

$idTbCadastroCliente = $_POST["id_tb_cadastro_cliente"];
$idTbCadastroEnderecos = $_POST["id_tb_cadastro_enderecos"];
if($idTbCadastroEnderecos == "")
{
	$idTbCadastroEnderecos = 0;
}

$idTbCadastroCartoes = $_POST["id_tb_cadastro_cartoes"];
if($idTbCadastroCartoes == "")
{
	$idTbCadastroCartoes = 0;
}

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$tipoPagamento = Funcoes::ConteudoMascaraGravacao01($_POST["tipo_pagamento"]);

//$dataPedido = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
if($GLOBALS['habilitarEdicaoPedidosData'] == 1)
{
	if($_POST["data_pedido"] == "")
	{
		$dataPedido = DbFuncoes::GetCampoGenerico01($id, "ce_pedidos", "data_pedido");
	}else{
		$dataPedido = Funcoes::DataGravacaoSql($_POST["data_pedido"], $GLOBALS['configSistemaFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
	}
}else{
	$dataPedido = DbFuncoes::GetCampoGenerico01($id, "ce_pedidos", "data_pedido");
}	

$dataPagamento = Funcoes::DataGravacaoSql($_POST["data_pagamento"], $GLOBALS['configSistemaFormatoData']);
if($dataPagamento == "")
{
	$dataPagamento = NULL;	
}

$dataEntrega = Funcoes::DataGravacaoSql($_POST["data_entrega"], $GLOBALS['configSistemaFormatoData']);
if($dataEntrega == "")
{
	$dataEntrega = NULL;	
}

$dataValidade = Funcoes::DataGravacaoSql($_POST["data_validade"], $GLOBALS['configSistemaFormatoData']);
if($dataValidade == "")
{
	$dataValidade = NULL;	
}

$valorPedido = Funcoes::MascaraValorGravar($_POST["valor_pedido"]);
if($valorPedido == "")
{
	$valorPedido = 0;
}

$valorFrete = Funcoes::MascaraValorGravar($_POST["valor_frete"]);
if($valorFrete == "")
{
	$valorFrete = 0;
}

$periodoContratacao = $_POST["periodo_contratacao"];
$tipoEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["tipo_entrega"]);

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

$pesoTotal = Funcoes::MascaraValorGravar($_POST["peso_total"]);
if($pesoTotal == "")
{
	$pesoTotal = 0;
}

$enderecoEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_entrega"]);
$enderecoNumeroEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_numero_entrega"]);
$enderecoComplementoEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_complemento_entrega"]);
$bairroEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["bairro_entrega"]);
$cidadeEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["cidade_entrega"]);
$cidadeEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["cidade_entrega"]);
$paisEntrega = Funcoes::ConteudoMascaraGravacao01($_POST["pais_entrega"]);
$cepEntrega = Funcoes::SomenteNum($_POST["cep_entrega"]);

$idTbCadastro1 = $_POST["id_tb_cadastro1"];
if($idTbCadastro1 == "")
{
	$idTbCadastro1 = 0;
}
$idTbCadastro2 = $_POST["id_tb_cadastro2"];
if($idTbCadastro2 == "")
{
	$idTbCadastro2 = 0;
}
$idTbCadastro3 = $_POST["id_tb_cadastro3"];
if($idTbCadastro3 == "")
{
	$idTbCadastro3 = 0;
}
$idTbCadastro4 = $_POST["id_tb_cadastro4"];
if($idTbCadastro4 == "")
{
	$idTbCadastro4 = 0;
}
$idTbCadastro5 = $_POST["id_tb_cadastro5"];
if($idTbCadastro5 == "")
{
	$idTbCadastro5 = 0;
}

$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);
$ativacao = $_POST["ativacao"];

$arrIdsPedidosFiltroGenerico01 = $_POST["idsPedidosFiltroGenerico01"];
$arrIdsPedidosFiltroGenerico02 = $_POST["idsPedidosFiltroGenerico02"];
$arrIdsPedidosFiltroGenerico03 = $_POST["idsPedidosFiltroGenerico03"];
$arrIdsPedidosFiltroGenerico04 = $_POST["idsPedidosFiltroGenerico04"];
$arrIdsPedidosFiltroGenerico05 = $_POST["idsPedidosFiltroGenerico05"];
$arrIdsPedidosFiltroGenerico06 = $_POST["idsPedidosFiltroGenerico06"];
$arrIdsPedidosFiltroGenerico07 = $_POST["idsPedidosFiltroGenerico07"];
$arrIdsPedidosFiltroGenerico08 = $_POST["idsPedidosFiltroGenerico08"];
$arrIdsPedidosFiltroGenerico09 = $_POST["idsPedidosFiltroGenerico09"];
$arrIdsPedidosFiltroGenerico10 = $_POST["idsPedidosFiltroGenerico10"];

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$idCeComplementoStatus = $_POST["id_ce_complemento_status"];
if($idCeComplementoStatus == "")
{
	$idCeComplementoStatus = 0;
}

$transacaoExternaStatus = $_POST["transacao_externa_status"];
$transacaoExternaAutenticacao = $_POST["transacao_externa_autenticacao"];
$transacaoExternaLog = $_POST["transacao_externa_log"];

//$transacaoExternaDataPagamentoLiberado = $_POST["transacao_externa_data_pagamento_liberado"];
$transacaoExternaDataPagamentoLiberado = Funcoes::DataGravacaoSql($_POST["transacao_externa_data_pagamento_liberado"], $GLOBALS['configSistemaFormatoData']);
if($transacaoExternaDataPagamentoLiberado == "")
{
	$transacaoExternaDataPagamentoLiberado = NULL;	
}


$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
/*
echo "id=" . $id . "<br />";
echo "idTbCadastro=" . $idTbCadastro . "<br />";
echo "flagFinalizar=" . $flagFinalizar . "<br />";
echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br />";
echo "idTbCadastroEnderecos=" . $idTbCadastroEnderecos . "<br />";
echo "idTbCadastroCartoes=" . $idTbCadastroCartoes . "<br />";
echo "idTbCadastroUsuario=" . $idTbCadastroUsuario . "<br />";
echo "tipoPagamento=" . $tipoPagamento . "<br />";
echo "dataPedido=" . $dataPedido . "<br />";
echo "dataPagamento=" . $dataPagamento . "<br />";
echo "dataEntrega=" . $dataEntrega . "<br />";
echo "dataValidade=" . $dataValidade . "<br />";
echo "valorPedido=" . $valorPedido . "<br />";
echo "valorFrete=" . $valorFrete . "<br />";
echo "periodoContratacao=" . $periodoContratacao . "<br />";
echo "tipoEntrega=" . $tipoEntrega . "<br />";
echo "valorTotal=" . $valorTotal . "<br />";
echo "pesoTotal=" . $pesoTotal . "<br />";
echo "enderecoEntrega=" . $enderecoEntrega . "<br />";
echo "enderecoNumeroEntrega=" . $enderecoNumeroEntrega . "<br />";
echo "enderecoComplementoEntrega=" . $enderecoComplementoEntrega . "<br />";
echo "bairroEntrega=" . $bairroEntrega . "<br />";
echo "cidadeEntrega=" . $cidadeEntrega . "<br />";
echo "cidadeEntrega=" . $xxx . "<br />";
echo "paisEntrega=" . $paisEntrega . "<br />";
echo "cepEntrega=" . $cepEntrega . "<br />";
echo "idTbCadastro1=" . $idTbCadastro1 . "<br />";
echo "idTbCadastro2=" . $idTbCadastro2 . "<br />";
echo "idTbCadastro3=" . $idTbCadastro3 . "<br />";
echo "obs=" . $obs . "<br />";
echo "ativacao=" . $ativacao . "<br />";
echo "informacaoComplementar1=" . $informacaoComplementar1 . "<br />";
echo "informacaoComplementar2=" . $informacaoComplementar2 . "<br />";
echo "informacaoComplementar3=" . $informacaoComplementar3 . "<br />";
echo "informacaoComplementar4=" . $informacaoComplementar4 . "<br />";
echo "informacaoComplementar5=" . $informacaoComplementar5 . "<br />";
echo "idCeComplementoStatus=" . $idCeComplementoStatus . "<br />";
echo "transacaoExternaStatus=" . $transacaoExternaStatus . "<br />";
echo "transacaoExternaAutenticacao=" . $transacaoExternaAutenticacao . "<br />";
echo "transacaoExternaLog=" . $transacaoExternaLog . "<br />";
echo "transacaoExternaDataPagamentoLiberado=" . $transacaoExternaDataPagamentoLiberado . "<br />";
//$dbSistemaConPDO = null;
//exit();
*/


//Update de registro no BD.
//----------
$strSqlPedidosUpdate = "";
$strSqlPedidosUpdate .= "UPDATE ce_pedidos ";
$strSqlPedidosUpdate .= "SET ";
//$strSqlPedidosUpdate .= "id = :id, ";
$strSqlPedidosUpdate .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
//$strSqlPedidosUpdate .= "id_tb_cadastro_enderecos = :id_tb_cadastro_enderecos, ";
//$strSqlPedidosUpdate .= "id_tb_cadastro_cartoes = :id_tb_cadastro_cartoes, ";
$strSqlPedidosUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlPedidosUpdate .= "tipo_pagamento = :tipo_pagamento, ";
$strSqlPedidosUpdate .= "data_pedido = :data_pedido, ";
$strSqlPedidosUpdate .= "data_pagamento = :data_pagamento, ";
$strSqlPedidosUpdate .= "data_entrega = :data_entrega, ";
$strSqlPedidosUpdate .= "data_validade = :data_validade, ";
$strSqlPedidosUpdate .= "valor_pedido = :valor_pedido, ";
$strSqlPedidosUpdate .= "valor_frete = :valor_frete, ";
$strSqlPedidosUpdate .= "periodo_contratacao = :periodo_contratacao, ";
$strSqlPedidosUpdate .= "tipo_entrega = :tipo_entrega, ";
$strSqlPedidosUpdate .= "valor_desconto = :valor_desconto, ";
$strSqlPedidosUpdate .= "valor_acrescimo = :valor_acrescimo, ";
$strSqlPedidosUpdate .= "valor_total = :valor_total, ";
$strSqlPedidosUpdate .= "peso_total = :peso_total, ";
$strSqlPedidosUpdate .= "endereco_entrega = :endereco_entrega, ";
$strSqlPedidosUpdate .= "endereco_numero_entrega = :endereco_numero_entrega, ";
$strSqlPedidosUpdate .= "endereco_complemento_entrega = :endereco_complemento_entrega, ";
$strSqlPedidosUpdate .= "bairro_entrega = :bairro_entrega, ";
$strSqlPedidosUpdate .= "cidade_entrega = :cidade_entrega, ";
$strSqlPedidosUpdate .= "estado_entrega = :estado_entrega, ";
$strSqlPedidosUpdate .= "pais_entrega = :pais_entrega, ";
$strSqlPedidosUpdate .= "cep_entrega = :cep_entrega, ";
$strSqlPedidosUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlPedidosUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlPedidosUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlPedidosUpdate .= "id_tb_cadastro4 = :id_tb_cadastro4, ";
$strSqlPedidosUpdate .= "id_tb_cadastro5 = :id_tb_cadastro5, ";
$strSqlPedidosUpdate .= "obs = :obs, ";
$strSqlPedidosUpdate .= "ativacao = :ativacao, ";
$strSqlPedidosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlPedidosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlPedidosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlPedidosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlPedidosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlPedidosUpdate .= "id_ce_complemento_status = :id_ce_complemento_status ";

$strSqlPedidosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlPedidosUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementPedidosUpdate = $dbSistemaConPDO->prepare($strSqlPedidosUpdate);

/*
"data_pedido" => $dataPedido,
*/
if ($statementPedidosUpdate !== false)
{
	$statementPedidosUpdate->execute(array(
		"id" => $id,
		"id_tb_cadastro_cliente" => $idTbCadastroCliente,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"tipo_pagamento" => $tipoPagamento,
		"data_pedido" => $dataPedido,
		"data_pagamento" => $dataPagamento,
		"data_entrega" => $dataEntrega,
		"data_validade" => $dataValidade,
		"valor_pedido" => $valorPedido,
		"valor_frete" => $valorFrete,
		"periodo_contratacao" => $periodoContratacao,
		"tipo_entrega" => $tipoEntrega,
		"valor_desconto" => $valorDesconto,
		"valor_acrescimo" => $valorAcrescimo,
		"valor_total" => $valorTotal,
		"peso_total" => $pesoTotal,
		"endereco_entrega" => $enderecoEntrega,
		"endereco_numero_entrega" => $enderecoNumeroEntrega,
		"endereco_complemento_entrega" => $enderecoComplementoEntrega,
		"bairro_entrega" => $bairroEntrega,
		"cidade_entrega" => $cidadeEntrega,
		"estado_entrega" => $cidadeEntrega,
		"pais_entrega" => $paisEntrega,
		"cep_entrega" => $cepEntrega,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro4" => $idTbCadastro4,
		"id_tb_cadastro5" => $idTbCadastro5,
		"obs" => $obs,
		"ativacao" => $ativacao,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"id_ce_complemento_status" => $idCeComplementoStatus
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Filtro genérico 01.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"12");

if(!empty($arrIdsPedidosFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico01[$countArray], "12", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 02.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"13");
if(!empty($arrIdsPedidosFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico02[$countArray], "13", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 03.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"14");
if(!empty($arrIdsPedidosFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico03[$countArray], "14", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 04.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"15");
if(!empty($arrIdsPedidosFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico04[$countArray], "15", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 05.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"16");
if(!empty($arrIdsPedidosFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico05[$countArray], "16", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 06.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"17");
if(!empty($arrIdsPedidosFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico06[$countArray], "17", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 07.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"18");
if(!empty($arrIdsPedidosFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico07[$countArray], "18", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 08.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"19");
if(!empty($arrIdsPedidosFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico08[$countArray], "19", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 09.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"20");
if(!empty($arrIdsPedidosFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico09[$countArray], "20", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}


//Filtro genérico 10.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"ce_relacao_complemento", 
									"id_ce_registro",
									"tipo_complemento", 
									"21");
if(!empty($arrIdsPedidosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico10[$countArray], "21", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
	}
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlPedidosUpdate);
unset($statementPedidosUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
if ($flagFinalizar == "1")
{
	$paginaRetorno = "SiteCarrinhoPedidosCobranca.php";
	
	$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
	"idCePedidos=" . $id;
}else{
	$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
	"idCePedidos=" . $id .
	"&idTbCadastro=" . $idTbCadastro .
	$queryPadrao . 
	"&mensagemSucesso=" . $mensagemSucesso .
	"&mensagemErro=" . $mensagemErro;
}

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