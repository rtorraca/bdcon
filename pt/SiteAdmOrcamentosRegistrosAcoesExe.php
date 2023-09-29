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


//Verificação de qual botão foi acionado.
$btoAcionado = "";
//if(isset($_POST['btoSelecionar'])) 
if(isset($_POST['btoSelecionar_x'])) 
{
	$btoAcionado = "btoSelecionar";
}else{
	
}


//Variáveis.
$idCeOrcamentos = $_POST["idCeOrcamentos"];
$idCeOrcamentosFichas = $_POST["idCeOrcamentosFichas"];
//$idCeOrcamentosItens = $_POST["idCeOrcamentosItens"];
//$informacaoComplementar1 = $_POST["informacaoComplementar1"];
$idCeOrcamentosGravacao = $idCeOrcamentos;
if($idCeOrcamentosFichas <> "")
{
	$idCeOrcamentosGravacao = $idCeOrcamentosFichas;
}

$strTabela = $_POST["strTabela"];
$tipoCategoria = $_POST["tipoCategoria"];
$arrIdsRegistrosSelecionar = $_POST["idsRegistrosSelecionar"];
$countRegistrosIncluidos = 0;

$detalhe01 = $_POST["detalhe01"];
$detalhe02 = $_POST["detalhe02"];

$paginaRetorno = $_POST["paginaRetorno"];
$variavelRetorno = $_POST["variavelRetorno"];
$idRegistroRetorno = $_POST["idRegistroRetorno"];
$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_POST["paginacaoNumero"];
$palavraChave = $_POST["palavraChave"];


//Seleção.
//**************************************************************************************
if($btoAcionado == "btoSelecionar") //Verificação do botão acionado.
{
	//Limpeza dos registros anteriores.
	DbExcluir::ExcluirRegistrosGenerico02($idCeOrcamentosGravacao, 
										"ce_orcamentos_relacao_registros", 
										"id_ce_orcamentos",
										"tipo_categoria", 
										"2", 
										"tipo_relacao", 
										"1", 
										"", 
										"",
										"", 
										"");
										
	if(!empty($arrIdsRegistrosSelecionar))
	{
		//Loop pela seleção.
		foreach($arrIdsRegistrosSelecionar as $idRegistro)
		{
			//Quantidade.
			$quantidade = "1";
			if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1)
			{
				$quantidade = $_POST["quantidade" . $idRegistro];
			}
			
			if(DbInsert::OrcamentosRelacaoRegistroInsert("", 
			"", 
			$idCeOrcamentosGravacao, 
			$idRegistro, 
			$tipoCategoria, 
			"1", 
			$strTabela, 
			$quantidade, 
			"0", 
			"0", 
			"0", 
			"1", 
			"0", 
			"0", 
			"0", 
			"0", 
			"", 
			"", 
			"", 
			"", 
			"", 
			"") == true)
			{
				
				$countRegistrosIncluidos = $countRegistrosIncluidos + 1;
				$mensagemSucesso = $countRegistrosIncluidos . " " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
			}else{
				$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
			}
			
			//ItensRelacaoRegistroInsert($idItem, $idRegistro, $tipoCategoria, $strTabela)
		}
	}else{
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus23");
	}
	
}
//**************************************************************************************


//Debug.
/*
echo "idCeOrcamentos=" . $idCeOrcamentos . "<br />";
echo "idCeOrcamentosFichas=" . $idCeOrcamentosFichas . "<br />";
echo "idCeOrcamentosItens=" . $idCeOrcamentosItens . "<br />";
echo "informacaoComplementar1=" . $informacaoComplementar1 . "<br />";
echo "informacaoComplementar2=" . $informacaoComplementar2 . "<br />";
echo "strTabela=" . $informacaoComplementar2 . "<br />";
echo "tipoCategoria=" . $tipoCategoria . "<br />";
print_r("arrIdsRegistrosSelecionar=" . $arrIdsRegistrosSelecionar . "<br />");

echo "mensagemErro=" . $mensagemErro . "<br />";
echo "mensagemSucesso=" . $mensagemSucesso . "<br />";
echo "btoAcionado=" . $btoAcionado . "<br />";
print_r("empty(arrIdsRegistrosSelecionar)=" . empty($arrIdsRegistrosSelecionar) . "<br />");
*/


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
//"&idCeOrcamentosItens=" . $idCeOrcamentosItens .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"&tipoCategoria=" . $tipoCategoria .
"&idCeOrcamentos=" . $idCeOrcamentos .
"&idCeOrcamentosFichas=" . $idCeOrcamentosFichas .
"&informacaoComplementar1=" . $informacaoComplementar1 .
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