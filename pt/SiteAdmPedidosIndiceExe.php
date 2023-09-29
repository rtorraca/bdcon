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
$id = $_POST["idCePedidos"];
if($id == "")
{
	$id = ContadorUniversal::ContadorUniversalUpdate(1);
}
//$idTbCadastro = $_POST["idTbCadastro"];
//$flagFinalizar = $_POST["flagFinalizar"];

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


//Criação de registro de pedido.
/*
if(Pedidos::PedidosInsert($id, 
						$idTbCadastroCliente, 
						$idTbCadastroEnderecos, 
						$idTbCadastroUsuario, 
						NULL, 
						$valorPedido, 
						$valorFrete, 
						$periodoContratacao, 
						$tipoEntrega, 
						$pesoTotal, 
						$idTbCadastro1, 
						$idTbCadastro2, 
						$idTbCadastro3, 
						$obs, 
						$idCeComplementoStatus) == true)
*/						
if(DbInsert::PedidosInsert($id, 
$idTbCadastroCliente, 
$idTbCadastroUsuario, 
$idTbCadastroCartoes, 
$idTbCadastroUsuario, 
$tipoPagamento, 
$dataPedido, 
$dataPagamento, 
$dataEntrega, 
$dataValidade, 
$valorPedido, 
$valorFrete, 
$periodoContratacao, 
$tipoEntrega, 
$valorDesconto, 
$valorAcrescimo, 
$valorTotal, 
$pesoTotal, 
$idTbCadastro1, 
$idTbCadastro2, 
$idTbCadastro3, 
$idTbCadastro4, 
$idTbCadastro5, 
$obs, 
$ativacao, 
$informacaoComplementar1, 
$informacaoComplementar2, 
$informacaoComplementar3, 
$informacaoComplementar4, 
$informacaoComplementar5, 
$idCeComplementoStatus) == true)						
{
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
	
	//Filtro genérico 01.
	if(!empty($arrIdsPedidosFiltroGenerico01))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico01); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico01[$countArray], "12", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 02.
	if(!empty($arrIdsPedidosFiltroGenerico02))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico02); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico02[$countArray], "13", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 03.
	if(!empty($arrIdsPedidosFiltroGenerico03))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico03); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico03[$countArray], "14", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 04.
	if(!empty($arrIdsPedidosFiltroGenerico04))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico04); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico04[$countArray], "15", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 05.
	if(!empty($arrIdsPedidosFiltroGenerico05))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico05); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico05[$countArray], "16", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 06.
	if(!empty($arrIdsPedidosFiltroGenerico06))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico06); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico06[$countArray], "17", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 07.
	if(!empty($arrIdsPedidosFiltroGenerico07))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico07); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico07[$countArray], "18", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 08.
	if(!empty($arrIdsPedidosFiltroGenerico08))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico08); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico08[$countArray], "19", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 09.
	if(!empty($arrIdsPedidosFiltroGenerico09))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico09); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico09[$countArray], "20", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	
	
	//Filtro genérico 10.
	if(!empty($arrIdsPedidosFiltroGenerico10))
	{
		for($countArray = 0; $countArray < count($arrIdsPedidosFiltroGenerico10); $countArray++)
		{
			DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPedidosFiltroGenerico10[$countArray], "21", "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento");
		}
	}
	//----------
	
	
	//Inclusão de registro no fluxo de caixa.
	if(DbInsert::FluxoInsert($id, 
	$GLOBALS['configIdFluxoContabilizacaoAtivacaoPedidos'], 
	"1", 
	"ce_pedidos", 
	$idTbCadastroCliente, 
	$idTbCadastroUsuario, 
	XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaFluxoLancamento1"), 
	$GLOBALS['configTipoFluxoContabilizacaoAtivacaoPedidos'], 
	$GLOBALS['configStatusFluxoContabilizacaoAtivacaoPedidos'], 
	$tbPedidosValorTotal, 
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
		
	}
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"variavalBlank=" . "" .
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