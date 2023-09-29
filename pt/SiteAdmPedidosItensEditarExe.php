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
$id = $_POST["idCeItens"];
$idCePedidos = $_POST["idCePedidos"];
$idTbCadastro = $_POST["idTbCadastro"];
$idTbCadastroCliente = $_POST["idTbCadastroCliente"];

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

//$valorTotal = $quantidade * $valorUnitario;
$valorTotal = ($quantidade * $valorUnitario) + $valorAcrescimo - $valorDesconto;

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


//Update de registro no BD.
//----------
$strSqlPedidosItensUpdate = "";
$strSqlPedidosItensUpdate .= "UPDATE ce_itens ";
$strSqlPedidosItensUpdate .= "SET ";
//$strSqlPedidosItensUpdate .= "id = :id, ";
$strSqlPedidosItensUpdate .= "id_item = :id_item, ";
$strSqlPedidosItensUpdate .= "cod_item = :cod_item, ";
$strSqlPedidosItensUpdate .= "descricao = :descricao, ";
$strSqlPedidosItensUpdate .= "tabela = :tabela, ";
$strSqlPedidosItensUpdate .= "quantidade = :quantidade, ";
$strSqlPedidosItensUpdate .= "valor_unitario = :valor_unitario, ";
$strSqlPedidosItensUpdate .= "valor_desconto = :valor_desconto, ";
$strSqlPedidosItensUpdate .= "valor_acrescimo = :valor_acrescimo, ";
$strSqlPedidosItensUpdate .= "valor_total = :valor_total, ";
$strSqlPedidosItensUpdate .= "obs = :obs, ";
$strSqlPedidosItensUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlPedidosItensUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlPedidosItensUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlPedidosItensUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlPedidosItensUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlPedidosItensUpdate .= "ativacao = :ativacao ";
$strSqlPedidosItensUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlPedidosItensUpdate . "<br />";
//----------


//Componentes e parâmetros.
//----------
$statementPedidosItensUpdate = $dbSistemaConPDO->prepare($strSqlPedidosItensUpdate);


/*
"data_criacao" => $dataCriacao,
*/
if ($statementPedidosItensUpdate !== false)
{
	$statementPedidosItensUpdate->execute(array(
		"id" => $id,
		"id_item" => $idItem,
		"cod_item" => $codItem,
		"descricao" => $descricao,
		"tabela" => $tabela,
		"quantidade" => $quantidade,
		"valor_unitario" => $valorUnitario,
		"valor_desconto" => $valorDesconto,
		"valor_acrescimo" => $valorAcrescimo,
		"valor_total" => $valorTotal,
		"obs" => $obs,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
unset($strSqlPedidosItensUpdate);
unset($statementPedidosItensUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idCePedidos=" . $idCePedidos .
"&idTbCadastro=" . $idTbCadastro .
"&idTbCadastroCliente=" . $idTbCadastroCliente .
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