<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
//ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
//LoginAutenticacao::CadastroLoginVerificacao();


//Verificação de qual botão foi acionado (form).
$strOperacao = ""; //'1 - adicionar | -1 - subtrair | 0 - cancelar

//if(isset($_POST['submitProdutosComprar']))
if(isset($_POST['submitProdutosComprar_x'])) //Para funcionar no firefox também.
{
	$strOperacao = "1";
}else{
	
}
//if(isset($_POST['submitProdutosCancelar'])) 
if(isset($_POST['submitProdutosCancelar_x'])) 
{
	$strOperacao = "0";
}else{
	
}

//Ajax.
$strOperacaoAjax = $_POST["strOperacaoAjax"];
if($strOperacaoAjax <> "") 
{
	$strOperacao = $strOperacaoAjax;
}


//Resgate de variáveis.
$idItem = $_POST["idItem"];
$strObs = $_POST["strObs"];
$strTabela = $_POST["strTabela"];
$strQuantidade = $_POST["strQuantidade"];


$idTbCadastroCliente = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2);
$idTbCadastroUsuario = "0";

$tipoPublicacao = $_POST["tipoPublicacao"];
$tipoArquivo = $_POST["tipoArquivo"];
$tipoComplemento = $_POST["tipoComplemento"];

$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
$paginaRetorno = $_POST["paginaRetorno"];
//$paginaRetornoExclusao = $_POST["paginaRetornoExclusao"];
$variavelRetorno = $_POST["variavelRetorno"];
$idRetorno = $_POST["idRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

$paginacaoNumero = $_POST["paginacaoNumero"];


//Verificação de erro - debug.
/*
echo "idItem=" . $idItem . "<br>";
echo "strTabela=" . $strTabela . "<br>";
echo "strQuantidade=" . $strQuantidade . "<br>";
echo "strOperacao=" . $strOperacao . "<br>";
echo "submitProdutosComprar_x=" . $_POST["submitProdutosComprar_x"] . "<br>";
echo "submitProdutosComprar_y=" . $_POST["submitProdutosComprar_y"] . "<br>";
echo "strPost=" . var_dump($_POST) . "<br>";

echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
echo "idTbCadastroUsuario=" . $idTbCadastroUsuario . "<br>";

echo "masterPageSiteSelect=" . $masterPageSiteSelect . "<br>";
echo "paginaRetorno=" . $paginaRetorno . "<br>";
echo "variavelRetorno=" . $variavelRetorno . "<br>";
echo "idRetorno=" . $idRetorno . "<br>";
echo "mensagemErro=" . $mensagemErro . "<br>";
echo "mensagemSucesso=" . $mensagemSucesso . "<br>";
echo "paginacaoNumero=" . $paginacaoNumero . "<br>";
*/


//Carrinho.
//----------
/**/
$resultadoCarrinhoTemporario = Carrinho::CarrinhoTemporario($idTbCadastroCliente,
															$idTbCadastroUsuario,
															$idItem,
															$strTabela,
															$strQuantidade,
															$strObs,
															$strOperacao,
															"",
															"",
															"",
															"");

/*
Testes.
if(Carrinho::CarrinhoTemporarioInsert($idTbCadastroCliente,
										$idTbCadastroUsuario,
										$idItem,
										$strTabela,
										$strQuantidade,
										$strObs) == true)
										{
											echo "CarrinhoTemporarioInsert=" . "true" . "<br>";
										}
if(Carrinho::CarrinhoTemporarioUpdate("3528",
									"1",
									"") == true)
									{
										echo "CarrinhoTemporarioUpdate=" . "true" . "<br>";
									}
*/
															
//'strRetorno: 1 - item adicionado | 2 - item atualizado | 3 - item cancelado
if($resultadoCarrinhoTemporario == "1" || $resultadoCarrinhoTemporario == "2" || $resultadoCarrinhoTemporario == "3")
{
	if($GLOBALS['configProdutosPaginaRetornoCompra'] == 1)
	{
		$paginaRetorno = "SiteCarrinho.php";
	}
}
//----------


//echo "flag01=" . "true" . "<br>";


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
/*
while (ob_get_status()) 
{
    ob_end_clean();
}
*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>