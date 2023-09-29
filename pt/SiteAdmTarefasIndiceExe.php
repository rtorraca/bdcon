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
$idParent = $_POST["id_parent"];
$idTbCadastro1Retorno = $_POST["idTbCadastro1"];

$dataRegistroTarefa = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataTarefa = Funcoes::DataGravacaoSql($_POST["data_tarefa"], $GLOBALS['configSiteFormatoData']) . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataTarefa = Funcoes::DataGravacaoSql($_POST["data_tarefa"], $GLOBALS['configSiteFormatoData']); //. " " . date("H") . ":" . date("i") . ":" . date("s");
if($GLOBALS['habilitarTarefasDataHorario'] == 1)
{
	$dataTarefa = $dataTarefa . " " . $_POST["data_tarefa_hora"] . ":" . $_POST["data_tarefa_minuto"] . ":" . "0";
}

$dataTarefaFinal = Funcoes::DataGravacaoSql($_POST["data_tarefa_final"], $GLOBALS['configSiteFormatoData']); //. " " . date("H") . ":" . date("i") . ":" . date("s")
if($dataTarefaFinal == "")
{
	$dataTarefaFinal = NULL;	
}

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$tarefa = Funcoes::ConteudoMascaraGravacao01($_POST["tarefa"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

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

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);

$idTbTarefaStatus = $_POST["id_tb_tarefa_status"];
if($idTbTarefaStatus == "")
{
	$idTbTarefaStatus = 0;
}
$idTbTarefaProcessos = $_POST["id_tb_processos"];

$ativacao = Funcoes::ConteudoMascaraGravacao01($_POST["ativacao"]);

$dataTarefaPesquisaInicial = $_POST["dataTarefaPesquisaInicial"];
$dataTarefaPesquisaFinal = $_POST["dataTarefaPesquisaFinal"];

$habilitarListagem = $_POST["habilitarListagem"];
$habilitarInclusao = $_POST["habilitarInclusao"];
$habilitarDetalhes = $_POST["habilitarDetalhes"];
$habilitarBusca = $_POST["habilitarBusca"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&idTbCadastro1=" . $idTbCadastro1Retorno . 
"&habilitarListagem=" . $habilitarListagem . 
"&habilitarInclusao=" . $habilitarInclusao . 
"&habilitarDetalhes=" . $habilitarDetalhes . 
"&habilitarBusca=" . $habilitarBusca . 
"&dataTarefaPesquisaInicial=" . $dataTarefaPesquisaInicial . 
"&dataTarefaPesquisaFinal=" . $dataTarefaPesquisaFinal;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.

//Inclusão de registro no BD.
//----------
$strSqlTarefasInsert = "";
$strSqlTarefasInsert .= "INSERT INTO tb_tarefas ";
$strSqlTarefasInsert .= "SET ";
$strSqlTarefasInsert .= "id = :id, ";
$strSqlTarefasInsert .= "id_parent = :id_parent, ";
$strSqlTarefasInsert .= "data_registro_tarefa = :data_registro_tarefa, ";
$strSqlTarefasInsert .= "data_tarefa = :data_tarefa, ";
$strSqlTarefasInsert .= "data_tarefa_final = :data_tarefa_final, ";
$strSqlTarefasInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlTarefasInsert .= "tarefa = :tarefa, ";
$strSqlTarefasInsert .= "descricao = :descricao, ";
$strSqlTarefasInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlTarefasInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlTarefasInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlTarefasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlTarefasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlTarefasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlTarefasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlTarefasInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlTarefasInsert .= "id_tb_tarefa_status = :id_tb_tarefa_status, ";
$strSqlTarefasInsert .= "ativacao = :ativacao ";
//----------


//Parâmetros.
//----------
$statementTarefasInsert = $dbSistemaConPDO->prepare($strSqlTarefasInsert);

if ($statementTarefasInsert !== false)
{
	$statementTarefasInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"data_registro_tarefa" => $dataRegistroTarefa,
		"data_tarefa" => $dataTarefa,
		"data_tarefa_final" => $dataTarefaFinal,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"tarefa" => $tarefa,
		"descricao" => $descricao,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"id_tb_tarefa_status" => $idTbTarefaStatus,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlTarefasInsert);
unset($statementTarefasInsert);
//----------


//Gravação de vínculos.
//**************************************************************************************
//Processos.
//----------
if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1)
{
	if(!empty($idTbTarefaProcessos) && $idTbTarefaProcessos <> 0){
		if(DbFuncoes::ItensRelacaoRegistroInsert($id, $idTbTarefaProcessos, "29", "tb_processos") == true)
		{
			//Gravou.
		}else{
			//Não gravou.
		}
	}
}
//----------
//**************************************************************************************


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idParent .
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