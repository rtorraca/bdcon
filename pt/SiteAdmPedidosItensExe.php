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
$idCePedidos = $_POST["id_ce_pedidos"];
$idTbCadastroCliente = $_POST["id_tb_cadastro_cliente"];
$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$idItem = $_POST["id_item"];

$codItem = Funcoes::ConteudoMascaraGravacao01($_POST["cod_item"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);
$tabela = $_POST["tabela"];
$quantidade = $_POST["quantidade"];

$valorUnitario = Funcoes::MascaraValorGravar($_POST["valor_unitario"]);
if($valorUnitario == "")
{
	$valorUnitario = 0;
}

$valorTotal = $quantidade * $valorUnitario;

$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);
$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$ativacao = $_POST["ativacao"];
$id_tb_produtos_complemento_status = 0;


$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSiteSelect=" . $masterPageSiteSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//**************************************************************************************

//Produtos.
if($tabela == "tb_produtos")
{
	if(Pedidos::PedidosItensInsert($idTbCadastroCliente, 
							  $idCePedidos, 
							  $idTbCadastroUsuario, 
							  $idItem, 
							  DbFuncoes::GetCampoGenerico01($idItem, "tb_produtos", "cod_produto"), 
							  DbFuncoes::GetCampoGenerico01($idItem, "tb_produtos", "produto"), 
							  $tabela, 
							  $quantidade, 
							  DbFuncoes::GetCampoGenerico01($idItem, "tb_produtos", "valor"), 
							  0, 
							  $obs) == true)
	{
		$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
	}else{
		//echo "erro";
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
	}
}


//Item avulso.
///*
if($tabela == "")
{
	if(Pedidos::PedidosItensInsert($idTbCadastroCliente, 
							  $idCePedidos, 
							  $idTbCadastroUsuario, 
							  $idItem, 
							  $codItem, 
							  $descricao, 
							  $tabela, 
							  $quantidade, 
							  $valorUnitario, 
							  0, 
							  $obs) == true)
	{
		$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
	}else{
		//echo "erro";
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
	}
}
//*/

//**************************************************************************************


//Limpeza de objetos.
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idCePedidos=" . $idCePedidos .
"&idTbCadastro=" . $idTbCadastroCliente .
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