<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Verificação de qual botão foi acionado.
$btoAcionado = "";
//if(isset($_POST['btoSelecionar'])) 
if(isset($_POST['btoImportar_x'])) 
{
	$btoAcionado = "btoImportar";
}else{
	
}


//Variáveis.
$arrIdsRegistrosSelecionar = $_POST["idsRegistrosSelecionar"];
$countRegistrosSelecionar = 0;

$idCePedidos = $_POST["idCePedidos"];
$idTbCadastroCliente = $_POST["idTbCadastroCliente"];

//$paginaRetorno = $_POST["paginaRetorno"];
$paginaRetorno = "PedidosIndice.php";
$variavelRetorno = $_POST["variavelRetorno"];
$idRegistroRetorno = $_POST["idRegistroRetorno"];
$masterPageSelect = $_POST["masterPageSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_POST["paginacaoNumero"];
$palavraChave = $_POST["palavraChave"];


//Verificação de erro.
//echo "idCePedidos=" . $idCePedidos . "<br />";
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br />";

//echo "arrIdsRegistrosSelecionar=";
//var_dump($arrIdsRegistrosSelecionar);
//echo "<br />";


//Fichas.
//**************************************************************************************
if($GLOBALS['habilitarOrcamentoFichas'] == 1){
	//Loop pela seleção de fichas.
	for($countArrayRegistros = 0; count($arrIdsRegistrosSelecionar) > $countArrayRegistros; $countArrayRegistros++)
	{
		//Registros vinculados com as fichas (produtos).
		$itensRelacaoRegistrosSelect2 = "";
		//"informacao_complementar1", 
		//$informacaoComplementar1, 
		//"id_ce_orcamentos", 
		//$idCePedidos, 
		$itensRelacaoRegistrosSelect2 = DbFuncoes::GetCampoGenerico06("ce_orcamentos_itens_relacao_registros", 
																		"id", 
																		"id_ce_orcamentos", 
																		$arrIdsRegistrosSelecionar[$countArrayRegistros], 
																		"", 
																		"", 
																		1, 
																		"", 
																		"", 
																		"tipo_categoria", 
																		"2", 
																		"tipo_relacao", 
																		"1");


		//Loop pelos registros vinculados com as fichas (produtos).
		/**/
		if($itensRelacaoRegistrosSelect2 <> "")
		{
			$arrItensRelacaoRegistrosSelect2 = explode(",", $itensRelacaoRegistrosSelect2);
			for($countArrayRelacaoRegistros = 0; count($arrItensRelacaoRegistrosSelect2) > $countArrayRelacaoRegistros; $countArrayRelacaoRegistros++)
			{
				//Definição de variáveis.
				$tbPedidosItensId = ContadorUniversal::ContadorUniversalUpdate(1);
				$tbProdutosId = "";
				$tbProdutosCodProduto = "";
				$tbProdutosProduto = "";
				$tbProdutosValor = "";
				
				$tbProdutosId = DbFuncoes::GetCampoGenerico01($arrItensRelacaoRegistrosSelect2[$countArrayRelacaoRegistros], "ce_orcamentos_itens_relacao_registros", "id_registro");
				$tbProdutosCodProduto = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "cod_produto");
				$tbProdutosProduto = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "produto");
				$tbProdutosValor = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "valor");
				
				$tbOrcamentosItensRelacaoRegistrosQuantidade = DbFuncoes::GetCampoGenerico01($arrItensRelacaoRegistrosSelect2[$countArrayRelacaoRegistros], "ce_orcamentos_itens_relacao_registros", "quantidade");
				
				
				//Gravação do item.
				if($tbProdutosId <> "")
				{
					if(DbInsert::PedidosItensInsert($tbPedidosItensId, 
					$idCePedidos, 
					$idTbCadastroCliente, 
					"0", 
					$tbProdutosId, 
					$tbProdutosCodProduto, 
					$tbProdutosProduto, 
					"tb_produtos", 
					$tbOrcamentosItensRelacaoRegistrosQuantidade, 
					$tbProdutosValor, 
					"0", 
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
					"", 
					"", 
					"", 
					"", 
					"0") == true)
					{
						//echo "PedidosItensInsert=" . "true" . "<br />";
						$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
					}
				}
				
				
				//Verificação de erro - debug.
				/*
				echo "arrItensRelacaoRegistrosSelect2=" . $arrItensRelacaoRegistrosSelect2[$countArrayRelacaoRegistros] . "<br />";
				echo "tbProdutosId=" . $tbProdutosId . "<br />";
				echo "tbProdutosCodProduto=" . $tbProdutosCodProduto . "<br />";
				echo "tbProdutosProduto=" . $tbProdutosProduto . "<br />";
				echo "tbProdutosValor=" . $tbProdutosValor . "<br />";
				echo "tbOrcamentosItensRelacaoRegistrosQuantidade=" . $tbOrcamentosItensRelacaoRegistrosQuantidade . "<br />";
				echo "<br />";
				*/
			}
		}
		
		
		//Verificação de erro - debug.
		/*
		echo "arrIdsRegistrosSelecionar=" . $arrIdsRegistrosSelecionar[$countArrayRegistros] . "<br />";
		echo "itensRelacaoRegistrosSelect2=" . $itensRelacaoRegistrosSelect2 . "<br />";
		echo "<br />";
		*/
	}
	
	
	//Atualização de valores do pedido.
	//Obs: falta colocar peso.
	$tbPedidosValorPedido = Pedidos::ItensTotal("", $idCePedidos);
	$tbPedidosValorFrete = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "valor_frete");
	$tbPedidosValorDesconto = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "valor_desconto");
	$tbPedidosValorAcrescimo = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "valor_acrescimo");
	//$tbPedidosValorTotal = $tbPedidosValorPedido + $tbPedidosValorFrete;
	$tbPedidosValorTotal = $tbPedidosValorPedido + $tbPedidosValorFrete + $tbPedidosValorAcrescimo - $tbPedidosValorDesconto;
	
	//Update.
	/**/
	if(DbUpdate::DbRegistroGenericoUpdate02($tbPedidosValorPedido, $idCePedidos, "ce_pedidos", "valor_pedido", "id") == true)
	{
		
	}
	if(DbUpdate::DbRegistroGenericoUpdate02($tbPedidosValorTotal, $idCePedidos, "ce_pedidos", "valor_total", "id") == true)
	{
		
	}
}
//**************************************************************************************


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//"&idTbCadastroCliente=" . $idTbCadastroCliente .
//"idCePedidos=" . $idCePedidos .
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&masterPageSelect=" . $masterPageSelect .
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