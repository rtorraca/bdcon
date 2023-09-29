<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";

//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idParent = $_POST["id_parent"];

$arrIdsTurmasFiltroGenerico01 = $_POST["idsTurmasFiltroGenerico01"];
$arrIdsTurmasFiltroGenerico02 = $_POST["idsTurmasFiltroGenerico02"];
$arrIdsTurmasFiltroGenerico03 = $_POST["idsTurmasFiltroGenerico03"];
$arrIdsTurmasFiltroGenerico04 = $_POST["idsTurmasFiltroGenerico04"];
$arrIdsTurmasFiltroGenerico05 = $_POST["idsTurmasFiltroGenerico05"];
$arrIdsTurmasFiltroGenerico06 = $_POST["idsTurmasFiltroGenerico06"];
$arrIdsTurmasFiltroGenerico07 = $_POST["idsTurmasFiltroGenerico07"];
$arrIdsTurmasFiltroGenerico08 = $_POST["idsTurmasFiltroGenerico08"];
$arrIdsTurmasFiltroGenerico09 = $_POST["idsTurmasFiltroGenerico09"];
$arrIdsTurmasFiltroGenerico10 = $_POST["idsTurmasFiltroGenerico10"];
$arrIdsTurmasFiltroGenerico11 = $_POST["idsTurmasFiltroGenerico11"];
$arrIdsTurmasFiltroGenerico12 = $_POST["idsTurmasFiltroGenerico12"];
$arrIdsTurmasFiltroGenerico13 = $_POST["idsTurmasFiltroGenerico13"];
$arrIdsTurmasFiltroGenerico14 = $_POST["idsTurmasFiltroGenerico14"];
$arrIdsTurmasFiltroGenerico15 = $_POST["idsTurmasFiltroGenerico15"];
$arrIdsTurmasFiltroGenerico16 = $_POST["idsTurmasFiltroGenerico16"];
$arrIdsTurmasFiltroGenerico17 = $_POST["idsTurmasFiltroGenerico17"];
$arrIdsTurmasFiltroGenerico18 = $_POST["idsTurmasFiltroGenerico18"];
$arrIdsTurmasFiltroGenerico19 = $_POST["idsTurmasFiltroGenerico19"];
$arrIdsTurmasFiltroGenerico20 = $_POST["idsTurmasFiltroGenerico20"];

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
$idTbCadastro6 = $_POST["id_tb_cadastro6"];
if($idTbCadastro6 == "")
{
	$idTbCadastro6 = 0;
}
$idTbCadastro7 = $_POST["id_tb_cadastro7"];
if($idTbCadastro7 == "")
{
	$idTbCadastro7 = 0;
}
$idTbCadastro8 = $_POST["id_tb_cadastro8"];
if($idTbCadastro8 == "")
{
	$idTbCadastro8 = 0;
}
$idTbCadastro9 = $_POST["id_tb_cadastro9"];
if($idTbCadastro9 == "")
{
	$idTbCadastro9 = 0;
}
$idTbCadastro10 = $_POST["id_tb_cadastro10"];
if($idTbCadastro10 == "")
{
	$idTbCadastro10 = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$dataCriacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$dataInicio = Funcoes::DataGravacaoSql($_POST["data_inicio"], $GLOBALS['configSistemaFormatoData']);
if($dataInicio == "")
{
	$dataInicio = NULL;	
}
$dataFinal = Funcoes::DataGravacaoSql($_POST["data_final"], $GLOBALS['configSistemaFormatoData']);
if($dataFinal == "")
{
	$dataFinal = NULL;	
}

$data1 = Funcoes::DataGravacaoSql($_POST["data1"], $GLOBALS['configSistemaFormatoData']);
if($data1 == "")
{
	$data1 = NULL;	
}
$data2 = Funcoes::DataGravacaoSql($_POST["data2"], $GLOBALS['configSistemaFormatoData']);
if($data2 == "")
{
	$data2 = NULL;	
}
$data3 = Funcoes::DataGravacaoSql($_POST["data3"], $GLOBALS['configSistemaFormatoData']);
if($data3 == "")
{
	$data3 = NULL;	
}
$data4 = Funcoes::DataGravacaoSql($_POST["data4"], $GLOBALS['configSistemaFormatoData']);
if($data4 == "")
{
	$data4 = NULL;	
}
$data5 = Funcoes::DataGravacaoSql($_POST["data5"], $GLOBALS['configSistemaFormatoData']);
if($data5 == "")
{
	$data5 = NULL;	
}
$data6 = Funcoes::DataGravacaoSql($_POST["data6"], $GLOBALS['configSistemaFormatoData']);
if($data6 == "")
{
	$data6 = NULL;	
}
$data7 = Funcoes::DataGravacaoSql($_POST["data7"], $GLOBALS['configSistemaFormatoData']);
if($data7 == "")
{
	$data7 = NULL;	
}
$data8 = Funcoes::DataGravacaoSql($_POST["data8"], $GLOBALS['configSistemaFormatoData']);
if($data8 == "")
{
	$data8 = NULL;	
}
$data9 = Funcoes::DataGravacaoSql($_POST["data9"], $GLOBALS['configSistemaFormatoData']);
if($data9 == "")
{
	$data9 = NULL;	
}
$data10 = Funcoes::DataGravacaoSql($_POST["data10"], $GLOBALS['configSistemaFormatoData']);
if($data10 == "")
{
	$data10 = NULL;	
}

$nomeTurma = Funcoes::ConteudoMascaraGravacao01($_POST["nome_turma"]);
$codTurma = Funcoes::ConteudoMascaraGravacao01($_POST["cod_turma"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$idTbTurmasStatus = $_POST["id_tb_turmas_status"];
if($idTbTurmasStatus == "")
{
	$idTbTurmasStatus = 0;
}

$palavrasChave = $_POST["palavras_chave"];

$valor = Funcoes::FormatarValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;	
}

$valor1 = 0;
$valor2 = 0;
$valor3 = 0;
$valor4 = 0;
$valor5 = 0;

$URL1 = Funcoes::ConteudoMascaraGravacao01($_POST["url1"]);
$URL2 = Funcoes::ConteudoMascaraGravacao01($_POST["url2"]);
$URL3 = Funcoes::ConteudoMascaraGravacao01($_POST["url3"]);
$URL4 = Funcoes::ConteudoMascaraGravacao01($_POST["url4"]);
$URL5 = Funcoes::ConteudoMascaraGravacao01($_POST["url5"]);

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);
$informacaoComplementar6 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar6"]);
$informacaoComplementar7 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar7"]);
$informacaoComplementar8 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar8"]);
$informacaoComplementar9 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar9"]);
$informacaoComplementar10 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar10"]);
$informacaoComplementar11 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar11"]);
$informacaoComplementar12 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar12"]);
$informacaoComplementar13 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar13"]);
$informacaoComplementar14 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar14"]);
$informacaoComplementar15 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar15"]);
$informacaoComplementar16 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar16"]);
$informacaoComplementar17 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar17"]);
$informacaoComplementar18 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar18"]);
$informacaoComplementar19 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar19"]);
$informacaoComplementar20 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar20"]);
$informacaoComplementar21 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar21"]);
$informacaoComplementar22 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar22"]);
$informacaoComplementar23 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar23"]);
$informacaoComplementar24 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar24"]);
$informacaoComplementar25 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar25"]);
$informacaoComplementar26 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar26"]);
$informacaoComplementar27 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar27"]);
$informacaoComplementar28 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar28"]);
$informacaoComplementar29 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar29"]);
$informacaoComplementar30 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar30"]);
$informacaoComplementar31 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar31"]);
$informacaoComplementar32 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar32"]);
$informacaoComplementar33 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar33"]);
$informacaoComplementar34 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar34"]);
$informacaoComplementar35 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar35"]);
$informacaoComplementar36 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar36"]);
$informacaoComplementar37 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar37"]);
$informacaoComplementar38 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar38"]);
$informacaoComplementar39 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar39"]);
$informacaoComplementar40 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar40"]);
$informacaoComplementar41 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar41"]);
$informacaoComplementar42 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar42"]);
$informacaoComplementar43 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar43"]);
$informacaoComplementar44 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar44"]);
$informacaoComplementar45 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar45"]);
$informacaoComplementar46 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar46"]);
$informacaoComplementar47 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar47"]);
$informacaoComplementar48 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar48"]);
$informacaoComplementar49 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar49"]);
$informacaoComplementar50 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar50"]);
$informacaoComplementar51 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar51"]);
$informacaoComplementar52 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar52"]);
$informacaoComplementar53 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar53"]);
$informacaoComplementar54 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar54"]);
$informacaoComplementar55 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar55"]);
$informacaoComplementar56 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar56"]);
$informacaoComplementar57 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar57"]);
$informacaoComplementar58 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar58"]);
$informacaoComplementar59 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar59"]);
$informacaoComplementar60 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar60"]);

$ativacao = $_POST["ativacao"];
$ativacao1 = $_POST["ativacao1"];
if($ativacao1 == "")
{
	$ativacao1 = 0;
}
$ativacao2 = $_POST["ativacao2"];
if($ativacao2 == "")
{
	$ativacao2 = 0;
}
$ativacao3 = $_POST["ativacao3"];
if($ativacao3 == "")
{
	$ativacao3 = 0;
}
$ativacao4 = $_POST["ativacao4"];
if($ativacao4 == "")
{
	$ativacao4 = 0;
}

$anotacoesInternas = Funcoes::ConteudoMascaraGravacao01($_POST["anotacoesInternas"]);
$nVisitas = 0;

$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Inclusão de registro no BD.
//----------
$strSqlTurmasInsert = "";
$strSqlTurmasInsert .= "INSERT INTO tb_turmas ";
$strSqlTurmasInsert .= "SET ";
$strSqlTurmasInsert .= "id = :id, ";
$strSqlTurmasInsert .= "id_parent = :id_parent, ";

$strSqlTurmasInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlTurmasInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlTurmasInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlTurmasInsert .= "id_tb_cadastro4 = :id_tb_cadastro4, ";
$strSqlTurmasInsert .= "id_tb_cadastro5 = :id_tb_cadastro5, ";
$strSqlTurmasInsert .= "id_tb_cadastro6 = :id_tb_cadastro6, ";
$strSqlTurmasInsert .= "id_tb_cadastro7 = :id_tb_cadastro7, ";
$strSqlTurmasInsert .= "id_tb_cadastro8 = :id_tb_cadastro8, ";
$strSqlTurmasInsert .= "id_tb_cadastro9 = :id_tb_cadastro9, ";
$strSqlTurmasInsert .= "id_tb_cadastro10 = :id_tb_cadastro10, ";

$strSqlTurmasInsert .= "n_classificacao = :n_classificacao, ";

$strSqlTurmasInsert .= "data_criacao = :data_criacao, ";
$strSqlTurmasInsert .= "data_inicio = :data_inicio, ";
$strSqlTurmasInsert .= "data_final = :data_final, ";

$strSqlTurmasInsert .= "data1 = :data1, ";
$strSqlTurmasInsert .= "data2 = :data2, ";
$strSqlTurmasInsert .= "data3 = :data3, ";
$strSqlTurmasInsert .= "data4 = :data4, ";
$strSqlTurmasInsert .= "data5 = :data5, ";
$strSqlTurmasInsert .= "data6 = :data6, ";
$strSqlTurmasInsert .= "data7 = :data7, ";
$strSqlTurmasInsert .= "data8 = :data8, ";
$strSqlTurmasInsert .= "data9 = :data9, ";
$strSqlTurmasInsert .= "data10 = :data10, ";

$strSqlTurmasInsert .= "nome_turma = :nome_turma, ";
$strSqlTurmasInsert .= "cod_turma = :cod_turma, ";
$strSqlTurmasInsert .= "descricao = :descricao, ";
$strSqlTurmasInsert .= "id_tb_turmas_status = :id_tb_turmas_status, ";
$strSqlTurmasInsert .= "palavras_chave = :palavras_chave, ";

$strSqlTurmasInsert .= "valor = :valor, ";
$strSqlTurmasInsert .= "valor1 = :valor1, ";
$strSqlTurmasInsert .= "valor2 = :valor2, ";
$strSqlTurmasInsert .= "valor3 = :valor3, ";
$strSqlTurmasInsert .= "valor4 = :valor4, ";
$strSqlTurmasInsert .= "valor5 = :valor5, ";

$strSqlTurmasInsert .= "url1 = :url1, ";
$strSqlTurmasInsert .= "url2 = :url2, ";
$strSqlTurmasInsert .= "url3 = :url3, ";
$strSqlTurmasInsert .= "url4 = :url4, ";
$strSqlTurmasInsert .= "url5 = :url5, ";

$strSqlTurmasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlTurmasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlTurmasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlTurmasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlTurmasInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlTurmasInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlTurmasInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlTurmasInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlTurmasInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlTurmasInsert .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlTurmasInsert .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlTurmasInsert .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlTurmasInsert .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlTurmasInsert .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlTurmasInsert .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlTurmasInsert .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlTurmasInsert .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlTurmasInsert .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlTurmasInsert .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlTurmasInsert .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlTurmasInsert .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlTurmasInsert .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlTurmasInsert .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlTurmasInsert .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlTurmasInsert .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlTurmasInsert .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlTurmasInsert .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlTurmasInsert .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlTurmasInsert .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlTurmasInsert .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlTurmasInsert .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlTurmasInsert .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlTurmasInsert .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlTurmasInsert .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlTurmasInsert .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlTurmasInsert .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlTurmasInsert .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlTurmasInsert .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlTurmasInsert .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlTurmasInsert .= "informacao_complementar40 = :informacao_complementar40, ";
$strSqlTurmasInsert .= "informacao_complementar41 = :informacao_complementar41, ";
$strSqlTurmasInsert .= "informacao_complementar42 = :informacao_complementar42, ";
$strSqlTurmasInsert .= "informacao_complementar43 = :informacao_complementar43, ";
$strSqlTurmasInsert .= "informacao_complementar44 = :informacao_complementar44, ";
$strSqlTurmasInsert .= "informacao_complementar45 = :informacao_complementar45, ";
$strSqlTurmasInsert .= "informacao_complementar46 = :informacao_complementar46, ";
$strSqlTurmasInsert .= "informacao_complementar47 = :informacao_complementar47, ";
$strSqlTurmasInsert .= "informacao_complementar48 = :informacao_complementar48, ";
$strSqlTurmasInsert .= "informacao_complementar49 = :informacao_complementar49, ";
$strSqlTurmasInsert .= "informacao_complementar50 = :informacao_complementar50, ";
$strSqlTurmasInsert .= "informacao_complementar51 = :informacao_complementar51, ";
$strSqlTurmasInsert .= "informacao_complementar52 = :informacao_complementar52, ";
$strSqlTurmasInsert .= "informacao_complementar53 = :informacao_complementar53, ";
$strSqlTurmasInsert .= "informacao_complementar54 = :informacao_complementar54, ";
$strSqlTurmasInsert .= "informacao_complementar55 = :informacao_complementar55, ";
$strSqlTurmasInsert .= "informacao_complementar56 = :informacao_complementar56, ";
$strSqlTurmasInsert .= "informacao_complementar57 = :informacao_complementar57, ";
$strSqlTurmasInsert .= "informacao_complementar58 = :informacao_complementar58, ";
$strSqlTurmasInsert .= "informacao_complementar59 = :informacao_complementar59, ";
$strSqlTurmasInsert .= "informacao_complementar60 = :informacao_complementar60, ";

$strSqlTurmasInsert .= "ativacao = :ativacao, ";
$strSqlTurmasInsert .= "ativacao1 = :ativacao1, ";
$strSqlTurmasInsert .= "ativacao2 = :ativacao2, ";
$strSqlTurmasInsert .= "ativacao3 = :ativacao3, ";
$strSqlTurmasInsert .= "ativacao4 = :ativacao4, ";

$strSqlTurmasInsert .= "anotacoes_internas = :anotacoes_internas, ";
$strSqlTurmasInsert .= "n_visitas = :n_visitas, ";
$strSqlTurmasInsert .= "acesso_restrito = :acesso_restrito ";


$statementTurmasInsert = $dbSistemaConPDO->prepare($strSqlTurmasInsert);

if ($statementTurmasInsert !== false)
{
	$statementTurmasInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro4" => $idTbCadastro4,
		"id_tb_cadastro5" => $idTbCadastro5,
		"id_tb_cadastro6" => $idTbCadastro6,
		"id_tb_cadastro7" => $idTbCadastro7,
		"id_tb_cadastro8" => $idTbCadastro8,
		"id_tb_cadastro9" => $idTbCadastro9,
		"id_tb_cadastro10" => $idTbCadastro10,
		"n_classificacao" => $nClassificacao,
		"data_criacao" => $dataCriacao,
		"data_inicio" => $dataInicio,
		"data_final" => $dataFinal,
		"data1" => $data1,
		"data2" => $data2,
		"data3" => $data3,
		"data4" => $data4,
		"data5" => $data5,
		"data6" => $data6,
		"data7" => $data7,
		"data8" => $data8,
		"data9" => $data9,
		"data10" => $data10,
		"nome_turma" => $nomeTurma,
		"cod_turma" => $codTurma,
		"descricao" => $descricao,
		"id_tb_turmas_status" => $idTbTurmasStatus,
		"palavras_chave" => $palavrasChave,
		"valor" => $valor,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"valor3" => $valor3,
		"valor4" => $valor4,
		"valor5" => $valor5,
		"url1" => $URL1,
		"url2" => $URL2,
		"url3" => $URL3,
		"url4" => $URL4,
		"url5" => $URL5,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"informacao_complementar6" => $informacaoComplementar6,
		"informacao_complementar7" => $informacaoComplementar7,
		"informacao_complementar8" => $informacaoComplementar8,
		"informacao_complementar9" => $informacaoComplementar9,
		"informacao_complementar10" => $informacaoComplementar10,
		"informacao_complementar11" => $informacaoComplementar11,
		"informacao_complementar12" => $informacaoComplementar12,
		"informacao_complementar13" => $informacaoComplementar13,
		"informacao_complementar14" => $informacaoComplementar14,
		"informacao_complementar15" => $informacaoComplementar15,
		"informacao_complementar16" => $informacaoComplementar16,
		"informacao_complementar17" => $informacaoComplementar17,
		"informacao_complementar18" => $informacaoComplementar18,
		"informacao_complementar19" => $informacaoComplementar19,
		"informacao_complementar20" => $informacaoComplementar20,
		"informacao_complementar21" => $informacaoComplementar21,
		"informacao_complementar22" => $informacaoComplementar22,
		"informacao_complementar23" => $informacaoComplementar23,
		"informacao_complementar24" => $informacaoComplementar24,
		"informacao_complementar25" => $informacaoComplementar25,
		"informacao_complementar26" => $informacaoComplementar26,
		"informacao_complementar27" => $informacaoComplementar27,
		"informacao_complementar28" => $informacaoComplementar28,
		"informacao_complementar29" => $informacaoComplementar29,
		"informacao_complementar30" => $informacaoComplementar30,
		"informacao_complementar31" => $informacaoComplementar31,
		"informacao_complementar32" => $informacaoComplementar32,
		"informacao_complementar33" => $informacaoComplementar33,
		"informacao_complementar34" => $informacaoComplementar34,
		"informacao_complementar35" => $informacaoComplementar35,
		"informacao_complementar36" => $informacaoComplementar36,
		"informacao_complementar37" => $informacaoComplementar37,
		"informacao_complementar38" => $informacaoComplementar38,
		"informacao_complementar39" => $informacaoComplementar39,
		"informacao_complementar40" => $informacaoComplementar40,
		"informacao_complementar41" => $informacaoComplementar41,
		"informacao_complementar42" => $informacaoComplementar42,
		"informacao_complementar43" => $informacaoComplementar43,
		"informacao_complementar44" => $informacaoComplementar44,
		"informacao_complementar45" => $informacaoComplementar45,
		"informacao_complementar46" => $informacaoComplementar46,
		"informacao_complementar47" => $informacaoComplementar47,
		"informacao_complementar48" => $informacaoComplementar48,
		"informacao_complementar49" => $informacaoComplementar49,
		"informacao_complementar50" => $informacaoComplementar50,
		"informacao_complementar51" => $informacaoComplementar51,
		"informacao_complementar52" => $informacaoComplementar52,
		"informacao_complementar53" => $informacaoComplementar53,
		"informacao_complementar54" => $informacaoComplementar54,
		"informacao_complementar55" => $informacaoComplementar55,
		"informacao_complementar56" => $informacaoComplementar56,
		"informacao_complementar57" => $informacaoComplementar57,
		"informacao_complementar58" => $informacaoComplementar58,
		"informacao_complementar59" => $informacaoComplementar59,
		"informacao_complementar60" => $informacaoComplementar60,
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"anotacoes_internas" => $anotacoesInternas,
		"n_visitas" => $nVisitas,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Limpeza de objetos.
unset($strSqlTurmasInsert);
unset($statementTurmasInsert);
//----------


//Gravação de complementos.
//----------

//Filtro genérico 01.
if(!empty($arrIdsTurmasFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico01[$countArray], "12", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 02.
if(!empty($arrIdsTurmasFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico02[$countArray], "13", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 03.
if(!empty($arrIdsTurmasFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico03[$countArray], "14", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 04.
if(!empty($arrIdsTurmasFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico04[$countArray], "15", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 05.
if(!empty($arrIdsTurmasFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico05[$countArray], "16", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 06.
if(!empty($arrIdsTurmasFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico06[$countArray], "17", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 07.
if(!empty($arrIdsTurmasFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico07[$countArray], "18", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 08.
if(!empty($arrIdsTurmasFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico08[$countArray], "19", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 09.
if(!empty($arrIdsTurmasFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico09[$countArray], "20", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 10.
if(!empty($arrIdsTurmasFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico10[$countArray], "21", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 11.
if(!empty($arrIdsTurmasFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico11[$countArray], "22", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 12.
if(!empty($arrIdsTurmasFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico12[$countArray], "23", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 13.
if(!empty($arrIdsTurmasFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico13[$countArray], "24", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 14.
if(!empty($arrIdsTurmasFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico14[$countArray], "25", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 15.
if(!empty($arrIdsTurmasFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico15[$countArray], "26", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 16.
if(!empty($arrIdsTurmasFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico16[$countArray], "27", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 17.
if(!empty($arrIdsTurmasFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico17[$countArray], "28", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 18.
if(!empty($arrIdsTurmasFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico18[$countArray], "29", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 19.
if(!empty($arrIdsTurmasFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico19[$countArray], "30", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}


//Filtro genérico 20.
if(!empty($arrIdsTurmasFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsTurmasFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsTurmasFiltroGenerico10[$countArray], "31", "tb_turmas_relacao_complemento", "id_tb_turmas", "id_tb_turmas_complemento");
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentTurmas=" . $idParent .
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