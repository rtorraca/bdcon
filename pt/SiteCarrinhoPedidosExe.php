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

//Verificação de qual botão foi acionado (form).
$tipoRedirect = ""; //'1 - adicionar | -1 - subtrair | 0 - cancelar

if(isset($_POST['logado_x'])) //Para funcionar no firefox também.
{
	$tipoRedirect = "logado";
}else{
	
}

$idTbCadastroCliente = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer()), 2);


//Verificação de erro - debug.
//echo "tipoRedirect=" . $tipoRedirect . "<br>";
//echo "tipoRedirect=" . $tipoRedirect . "<br>";
//exit();


//Rotina para logado.
//**************************************************************************************
if($tipoRedirect == "logado")
{
	//Funções especiais.
	//----------------------
	//Exclusão do cookie de identificação temporária antiga.
	CookiesFuncoes::CookieExcluir($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario");
	
	//Criação do novo cookie de identificação temporária.
	CookiesFuncoes::IdTbCadastroTemporario_CookieCriar();
	//----------------------
	
	$idCePedidos = ContadorUniversal::ContadorUniversalUpdate(1);
	$idTbCadastroEnderecos = "0";
	$codSedexSelecao = "";
	$valorFreteSelecao = 0;


	//Cálculo do frete com a opção selecionada.
	//----------------------
	/*
	valorFreteSelecao = Funcoes.mascaraValorGravar(Carrinho.CarrinhoCalculoFreteCorreios01(WebConfigurationManager.AppSettings("ConfigCEPOrigem"), _
													DbFuncoes.GetCampoGenerico01(Crypto.DecryptValue(CookiesFuncoes.CookieValorLer_Login()), "tb_cadastro", "cep_principal"), _
													Funcoes.ValorConverterPeso(Carrinho.CarrinhoItensTotal(Crypto.DecryptValue(CookiesFuncoes.CookieValorLer_Login()), "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", ""), 1), _
													"0", _
													"1", _
													"0", "0", "0", "0", _
													codSedexSelecao, _
													1))
	*/
	//----------------------
	
	
	
	//Inclusão de pedidos.
	//----------------------
	//Definição de variáveis.
	$strValorPedido = 0;
	$strPesoTotal = 0; //Carrinho.CarrinhoItensTotal(idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", "")

	//Total (tb_produtos).
	$strValorPedido = Carrinho::CarrinhoItensTotal($idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "valor", "1");
	$strPesoTotal = Carrinho::CarrinhoItensTotal($idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", "1");

	//Gravação do pedido.
	if(Pedidos::PedidosGravar($idTbCadastroCliente, 
							"0", 
							$idCePedidos, 
							"1", 
							$idTbCadastroEnderecos, 
							NULL, 
							$strValorPedido, 
							$valorFreteSelecao, 
							"0", 
							$codSedexSelecao, 
							$strPesoTotal, 
							"0", 
							"0", 
							"0", 
							"", 
							"0") == true)
							{
								
								//Limpar seleção temporária.
								//----------------------
								DbExcluir::ExcluirRegistrosGenerico02($idTbCadastroCliente, 
															"ce_itens_temporario", 
															"id_tb_cadastro_cliente",
															"", 
															"", 
															"ativacao", 
															"1");
								//----------------------
								
								
								//Envio automático de pedidos.
								//----------------------
								if($GLOBALS['habilitarCarrinhoEnvioPedido'] == 1)
								{
									//Envio para o cadastro.
									if(Email::PedidosEnviar($idCePedidos,
															DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "email_principal"),
															Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome_fantasia"), 1),
															1) == true)
															{
															
															}
															
															
									//Envio para id_tb_cadastro1.
									if($GLOBALS['habilitarCadastroVinculo1'] == 1)
									{
										$tbCadastroIdTbCadastro1 = DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "id_tb_cadastro1");
										if($tbCadastroIdTbCadastro1 <> "0")
										{
											if(Email::PedidosEnviar($idCePedidos,
																	DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "email_principal"),
																	Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1),
																	1) == true)
																	{
																	
																	}								  
										}
									}
								}
								//----------------------
							}						
	//----------------------
	
	
	//Fechamento da conexão.
	$dbSistemaConPDO = null;

	//Montagem do URL de retorno.
	$paginaRetorno = "SiteCarrinhoPedidosCobranca.php";
	//$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
	$URLRetorno = $configUrlSSL . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
	"idCePedidos=" . $idCePedidos .
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
}
//**************************************************************************************





//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
$variavelRetorno . "=" . $idRetorno .
"&tipoPublicacao=" . $tipoPublicacao .
"&tipoArquivo=" . $tipoArquivo .
"&tipoComplemento=" . $tipoComplemento .
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&detalhe01=" . $detalhe01 .
"&detalhe02=" . $detalhe02 .
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