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
$id = $_POST["idCeOrcamentos"];
$idTbCadastro = $_POST["idTbCadastro"];
$flagFinalizar = $_POST["flagFinalizar"];

$idTbCadastroCliente = $_POST["id_tb_cadastro_cliente"];
$idTbCadastroEnderecos = "0";
$idTbCadastroVendedor = "0";
$idTbCadastroUsuario = "0";

$dataOrcamento = Funcoes::DataGravacaoSql($_POST["data_orcamento"], $GLOBALS['configSistemaFormatoData']);
if($dataOrcamento == "")
{
	$dataOrcamento = NULL;	
}

$dataEntrega = Funcoes::DataGravacaoSql($_POST["data_entrega"], $GLOBALS['configSistemaFormatoData']);
if($dataEntrega == "")
{
	$dataEntrega = NULL;	
}


$valorOrcamento = Funcoes::MascaraValorGravar($_POST["valor_orcamento"]);
$valorFrete = Funcoes::MascaraValorGravar($_POST["valor_frete"]);

$periodoContratacao = $_POST["periodo_contratacao"];
$tipoEntrega = Funcoes::ConteudoMascaraLeitura($_POST["tipo_entrega"]);

//$tbOrcamentosValorTotal = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
$valorTotal = Funcoes::MascaraValorGravar($_POST["valor_total"]);

$pesoTotal = Funcoes::MascaraValorGravar($_POST["peso_total"]);
if($pesoTotal == "")
{
	$pesoTotal = 0;
}

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

$obs = Funcoes::ConteudoMascaraLeitura($_POST["obs"]);
$ativacao = $_POST["ativacao"];
$ativacao1 = "0";
$ativacao2 = "0";
$ativacao3 = "0";
$ativacao4 = "0";
$informacaoComplementar1 = Funcoes::ConteudoMascaraLeitura($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraLeitura($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraLeitura($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraLeitura($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraLeitura($_POST["informacao_complementar5"]);
$idCeComplementoStatus = "0";


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
/$dbSistemaConPDO = null;
//exit();
*/


//Update de registro no BD.
//----------
$strSqlOrcamentosUpdate = "";
$strSqlOrcamentosUpdate .= "UPDATE ce_orcamentos ";
$strSqlOrcamentosUpdate .= "SET ";
//$strSqlOrcamentosUpdate .= "id = :id, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro_cliente = :id_tb_cadastro_cliente, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro_enderecos = :id_tb_cadastro_enderecos, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro_vendedor = :id_tb_cadastro_vendedor, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
if($GLOBALS['habilitarOrcamentosEdicaoData'] == 1)
{
	$strSqlOrcamentosUpdate .= "data_orcamento = :data_orcamento, ";
}
$strSqlOrcamentosUpdate .= "data_entrega = :data_entrega, ";
$strSqlOrcamentosUpdate .= "valor_orcamento = :valor_orcamento, ";
$strSqlOrcamentosUpdate .= "valor_frete = :valor_frete, ";
$strSqlOrcamentosUpdate .= "periodo_contratacao = :periodo_contratacao, ";
$strSqlOrcamentosUpdate .= "tipo_entrega = :tipo_entrega, ";
$strSqlOrcamentosUpdate .= "valor_total = :valor_total, ";
$strSqlOrcamentosUpdate .= "peso_total = :peso_total, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlOrcamentosUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlOrcamentosUpdate .= "obs = :obs, ";
$strSqlOrcamentosUpdate .= "ativacao = :ativacao, ";
$strSqlOrcamentosUpdate .= "ativacao1 = :ativacao1, ";
$strSqlOrcamentosUpdate .= "ativacao2 = :ativacao2, ";
$strSqlOrcamentosUpdate .= "ativacao3 = :ativacao3, ";
$strSqlOrcamentosUpdate .= "ativacao4 = :ativacao4, ";
$strSqlOrcamentosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlOrcamentosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlOrcamentosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlOrcamentosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlOrcamentosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlOrcamentosUpdate .= "id_ce_complemento_status = :id_ce_complemento_status ";
$strSqlOrcamentosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlOrcamentosUpdate . "<br />";
//----------


$statementOrcamentosUpdate = $dbSistemaConPDO->prepare($strSqlOrcamentosUpdate);


/*
"data_pedido" => $dataPedido,
*/
if ($statementOrcamentosUpdate !== false)
{
	/*
	$statementOrcamentosUpdate->execute(array(
		"id" => $id,
		"id_ce_complemento_status" => $idCeComplementoStatus
	));
	*/
	
	$statementOrcamentosUpdate->bindParam(':id', $id, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro_enderecos', $idTbCadastroEnderecos, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro_vendedor', $idTbCadastroVendedor, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro_usuario', $idTbCadastroUsuario, PDO::PARAM_STR);
	if($GLOBALS['habilitarOrcamentosEdicaoData'] == 1)
	{
		$statementOrcamentosUpdate->bindParam(':data_orcamento', $dataOrcamento, PDO::PARAM_STR);
	}
	$statementOrcamentosUpdate->bindParam(':data_entrega', $dataEntrega, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':valor_orcamento', $valorOrcamento, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':valor_frete', $valorFrete, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':periodo_contratacao', $periodoContratacao, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':tipo_entrega', $tipoEntrega, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':valor_total', $valorTotal, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':peso_total', $pesoTotal, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro2', $idTbCadastro2, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_tb_cadastro3', $idTbCadastro3, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':obs', $obs, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':ativacao', $ativacao, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':ativacao1', $ativacao1, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':ativacao2', $ativacao2, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':ativacao3', $ativacao3, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':ativacao4', $ativacao4, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':informacao_complementar1', $informacaoComplementar1, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':informacao_complementar2', $informacaoComplementar2, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':informacao_complementar3', $informacaoComplementar3, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':informacao_complementar4', $informacaoComplementar4, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':informacao_complementar5', $informacaoComplementar5, PDO::PARAM_STR);
	$statementOrcamentosUpdate->bindParam(':id_ce_complemento_status', $idCeComplementoStatus, PDO::PARAM_STR);
	$statementOrcamentosUpdate->execute();
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


//Limpeza de objetos.
unset($strSqlOrcamentosUpdate);
unset($statementOrcamentosUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
if ($flagFinalizar == "1")
{
	$paginaRetorno = "OrcamentosDetalhes.php";
	
	//$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
	$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
	"idCeOrcamentos=" . $id . 
	"&masterPageSelect=LayoutSistemaImpressao.php";
}else{
	$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
	"idCeOrcamentos=" . $id .
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