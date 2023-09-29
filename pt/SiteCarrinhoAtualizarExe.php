<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de qual botão foi acionado.
$btoAcionado = "";
//if(isset($_POST['btoSelecionar'])) 
if(isset($_POST['btoCarrinhoAdicionar_x'])) 
{
	$btoAcionado = "btoCarrinhoAdicionar";
}else{
	
}

if(isset($_POST['btoCarrinhoSubtrair_x'])) 
{
	$btoAcionado = "btoCarrinhoSubtrair";
}else{
	
}

//Ajax.
$strOperacaoAjax = $_POST["strOperacaoAjax"];
if($strOperacaoAjax <> "") 
{
	$strOperacao = $strOperacaoAjax;
}


//Resgate de variáveis.
$idCeItensTemporario = $_POST["idCeItensTemporario"];
$strQuantidade = $_POST["strQuantidade"];
//$strQuantidade = $_POST["quantidade"];
$strQuantidadeAnterior = DbFuncoes::GetCampoGenerico01($idCeItensTemporario, "ce_itens_temporario", "quantidade");
$btoCarrinhoExcluir = $_POST["btoCarrinhoExcluir"];

//$idTbCadastroCliente = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2);

$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
$paginaRetorno = $_POST["paginaRetorno"];
//$paginaRetornoExclusao = $_POST["paginaRetornoExclusao"];
//$variavelRetorno = $_POST["variavelRetorno"];
//$idRetorno = $_POST["idRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_POST["paginacaoNumero"];


//Adicionar.
//----------
if($btoAcionado == "btoCarrinhoAdicionar")
{
	$strQuantidade = 1;
	$strQuantidadeAtualizar = $strQuantidadeAnterior + $strQuantidade;
	
	if(DbUpdate::DbRegistroGenericoUpdate02($strQuantidadeAtualizar, $idCeItensTemporario, "ce_itens_temporario", "quantidade", "id") == true)
	{
		$mensagemSucesso = "";
		//echo "DbRegistroGenericoUpdate02=" . "true" . "<br>";
	}	
}
//----------


//Subtrair.
//----------
if($btoAcionado == "btoCarrinhoSubtrair")
{
	$strQuantidade = 1;
	$strQuantidadeAtualizar = $strQuantidadeAnterior - $strQuantidade;
	
	if($strQuantidadeAtualizar == 0)
	{
		//Excluir.
		if(DbExcluir::ExcluirRegistrosGenerico01($idCeItensTemporario, "ce_itens_temporario", "id") == true)
		{
			$mensagemSucesso = "";
		}
	}else{
		if(DbUpdate::DbRegistroGenericoUpdate02($strQuantidadeAtualizar, $idCeItensTemporario, "ce_itens_temporario", "quantidade", "id") == true)
		{
			$mensagemSucesso = "";
			//echo "DbRegistroGenericoUpdate02=" . "true" . "<br>";
		}	
	}
	
}
//----------


//Excluir.
//----------
if($btoCarrinhoExcluir <> "")
{
	//Excluir.
	if(DbExcluir::ExcluirRegistrosGenerico01($idCeItensTemporario, "ce_itens_temporario", "id") == true)
	{
		$mensagemSucesso = "";
	}
	
}
//----------


//Alteração de quantidade.
//----------
if($btoAcionado == "")
{
	if($strQuantidade <> "")
	{
		if($strQuantidade == "0")
		{
			if(DbExcluir::ExcluirRegistrosGenerico01($idCeItensTemporario, "ce_itens_temporario", "id") == true)
			{
				$mensagemSucesso = "";
			}
		}else{
			if(DbUpdate::DbRegistroGenericoUpdate02($strQuantidade, $idCeItensTemporario, "ce_itens_temporario", "quantidade", "id") == true)
			{
				$mensagemSucesso = "";
				//echo "DbRegistroGenericoUpdate02=" . "true" . "<br>";
			}	
		}
	}
}
//----------


//Verificação de erro - debug.
/*
echo "idCeItensTemporario=" . $idCeItensTemporario . "<br>";
echo "btoAcionado=" . $btoAcionado . "<br>";
echo "strQuantidade=" . $strQuantidade . "<br>";
echo "strQuantidadeAtualizar=" . $strQuantidadeAtualizar . "<br>";
echo "paginaRetorno=" . $paginaRetorno . "<br>";
*/


//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
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