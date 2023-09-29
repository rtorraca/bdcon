<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis
$idParentTurmas = $_GET["idParentTurmas"];
$idsTbTurmas = $_GET["idsTbTurmas"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastro1 = $_GET["idTbCadastro1"];
$idTbCadastro2 = $_GET["idTbCadastro2"];
$idTbCadastro3 = $_GET["idTbCadastro3"];

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "SiteAdmTurmasIndice.php";
$paginaRetornoExclusao = "SiteAdmTurmasEditar.php";
$variavelRetorno = "idParentTurmas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarTurmasSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configTurmasSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_turmas", "id_parent", $idParentTurmas); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentTurmas=" . $idParentTurmas . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlTurmasSelect = "";
$strSqlTurmasSelect .= "SELECT ";
//$strSqlTurmasSelect .= "* ";
$strSqlTurmasSelect .= "id, ";
$strSqlTurmasSelect .= "id_parent, ";
$strSqlTurmasSelect .= "id_tb_cadastro1, ";
$strSqlTurmasSelect .= "id_tb_cadastro2, ";
$strSqlTurmasSelect .= "id_tb_cadastro3, ";
$strSqlTurmasSelect .= "id_tb_cadastro4, ";
$strSqlTurmasSelect .= "id_tb_cadastro5, ";
$strSqlTurmasSelect .= "id_tb_cadastro6, ";
$strSqlTurmasSelect .= "id_tb_cadastro7, ";
$strSqlTurmasSelect .= "id_tb_cadastro8, ";
$strSqlTurmasSelect .= "id_tb_cadastro9, ";
$strSqlTurmasSelect .= "id_tb_cadastro10, ";
$strSqlTurmasSelect .= "n_classificacao, ";
$strSqlTurmasSelect .= "data_criacao, ";
$strSqlTurmasSelect .= "data_inicio, ";
$strSqlTurmasSelect .= "data_final, ";
$strSqlTurmasSelect .= "data1, ";
$strSqlTurmasSelect .= "data2, ";
$strSqlTurmasSelect .= "data3, ";
$strSqlTurmasSelect .= "data4, ";
$strSqlTurmasSelect .= "data5, ";
$strSqlTurmasSelect .= "data6, ";
$strSqlTurmasSelect .= "data7, ";
$strSqlTurmasSelect .= "data8, ";
$strSqlTurmasSelect .= "data9, ";
$strSqlTurmasSelect .= "data10, ";
$strSqlTurmasSelect .= "nome_turma, ";
$strSqlTurmasSelect .= "cod_turma, ";
$strSqlTurmasSelect .= "descricao, ";
$strSqlTurmasSelect .= "id_tb_turmas_status, ";
$strSqlTurmasSelect .= "palavras_chave, ";
$strSqlTurmasSelect .= "valor, ";
$strSqlTurmasSelect .= "valor1, ";
$strSqlTurmasSelect .= "valor2, ";
$strSqlTurmasSelect .= "valor3, ";
$strSqlTurmasSelect .= "valor4, ";
$strSqlTurmasSelect .= "valor5, ";
$strSqlTurmasSelect .= "url1, ";
$strSqlTurmasSelect .= "url2, ";
$strSqlTurmasSelect .= "url3, ";
$strSqlTurmasSelect .= "url4, ";
$strSqlTurmasSelect .= "url5, ";
$strSqlTurmasSelect .= "informacao_complementar1, ";
$strSqlTurmasSelect .= "informacao_complementar2, ";
$strSqlTurmasSelect .= "informacao_complementar3, ";
$strSqlTurmasSelect .= "informacao_complementar4, ";
$strSqlTurmasSelect .= "informacao_complementar5, ";
$strSqlTurmasSelect .= "informacao_complementar6, ";
$strSqlTurmasSelect .= "informacao_complementar7, ";
$strSqlTurmasSelect .= "informacao_complementar8, ";
$strSqlTurmasSelect .= "informacao_complementar9, ";
$strSqlTurmasSelect .= "informacao_complementar10, ";

$strSqlTurmasSelect .= "informacao_complementar11, ";
$strSqlTurmasSelect .= "informacao_complementar12, ";
$strSqlTurmasSelect .= "informacao_complementar13, ";
$strSqlTurmasSelect .= "informacao_complementar14, ";
$strSqlTurmasSelect .= "informacao_complementar15, ";
$strSqlTurmasSelect .= "informacao_complementar16, ";
$strSqlTurmasSelect .= "informacao_complementar17, ";
$strSqlTurmasSelect .= "informacao_complementar18, ";
$strSqlTurmasSelect .= "informacao_complementar19, ";
$strSqlTurmasSelect .= "informacao_complementar20, ";
$strSqlTurmasSelect .= "informacao_complementar21, ";
$strSqlTurmasSelect .= "informacao_complementar22, ";
$strSqlTurmasSelect .= "informacao_complementar23, ";
$strSqlTurmasSelect .= "informacao_complementar24, ";
$strSqlTurmasSelect .= "informacao_complementar25, ";
$strSqlTurmasSelect .= "informacao_complementar26, ";
$strSqlTurmasSelect .= "informacao_complementar27, ";
$strSqlTurmasSelect .= "informacao_complementar28, ";
$strSqlTurmasSelect .= "informacao_complementar29, ";
$strSqlTurmasSelect .= "informacao_complementar30, ";
$strSqlTurmasSelect .= "informacao_complementar31, ";
$strSqlTurmasSelect .= "informacao_complementar32, ";
$strSqlTurmasSelect .= "informacao_complementar33, ";
$strSqlTurmasSelect .= "informacao_complementar34, ";
$strSqlTurmasSelect .= "informacao_complementar35, ";
$strSqlTurmasSelect .= "informacao_complementar36, ";
$strSqlTurmasSelect .= "informacao_complementar37, ";
$strSqlTurmasSelect .= "informacao_complementar38, ";
$strSqlTurmasSelect .= "informacao_complementar39, ";
$strSqlTurmasSelect .= "informacao_complementar40, ";
$strSqlTurmasSelect .= "informacao_complementar41, ";
$strSqlTurmasSelect .= "informacao_complementar42, ";
$strSqlTurmasSelect .= "informacao_complementar43, ";
$strSqlTurmasSelect .= "informacao_complementar44, ";
$strSqlTurmasSelect .= "informacao_complementar45, ";
$strSqlTurmasSelect .= "informacao_complementar46, ";
$strSqlTurmasSelect .= "informacao_complementar47, ";
$strSqlTurmasSelect .= "informacao_complementar48, ";
$strSqlTurmasSelect .= "informacao_complementar49, ";
$strSqlTurmasSelect .= "informacao_complementar50, ";
$strSqlTurmasSelect .= "informacao_complementar51, ";
$strSqlTurmasSelect .= "informacao_complementar52, ";
$strSqlTurmasSelect .= "informacao_complementar53, ";
$strSqlTurmasSelect .= "informacao_complementar54, ";
$strSqlTurmasSelect .= "informacao_complementar55, ";
$strSqlTurmasSelect .= "informacao_complementar56, ";
$strSqlTurmasSelect .= "informacao_complementar57, ";
$strSqlTurmasSelect .= "informacao_complementar58, ";
$strSqlTurmasSelect .= "informacao_complementar59, ";
$strSqlTurmasSelect .= "informacao_complementar60, ";
$strSqlTurmasSelect .= "ativacao, ";
$strSqlTurmasSelect .= "ativacao1, ";
$strSqlTurmasSelect .= "ativacao2, ";
$strSqlTurmasSelect .= "ativacao3, ";
$strSqlTurmasSelect .= "ativacao4, ";
$strSqlTurmasSelect .= "anotacoes_internas, ";
$strSqlTurmasSelect .= "n_visitas, ";
$strSqlTurmasSelect .= "acesso_restrito ";

//Paginação (subquery).
if($GLOBALS['habilitarTurmasSitePaginacao'] == "1"){
	$strSqlTurmasSelect .= ", (SELECT COUNT(id) ";
	$strSqlTurmasSelect .= "FROM tb_turmas ";
	$strSqlTurmasSelect .= "WHERE id <> 0 ";
	if($idParentTurmas <> "")
	{
		$strSqlTurmasSelect .= "AND id_parent = :id_parent ";
	}
	if($idsTbTurmas <> "")
	{
		$strSqlTurmasSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbTurmas) . ") ";
	}
	if($idTbCadastro1 <> "")
	{
		$strSqlTurmasSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
	}
	if($palavraChave <> "")
	{
		$strSqlTurmasSelect .= "AND (nome_turma LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlTurmasSelect .= "OR cod_turma LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR url4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR url5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlTurmasSelect .= ") ";
	}
	$strSqlTurmasSelect .= ") totalRegistros ";
}

$strSqlTurmasSelect .= "FROM tb_turmas ";
$strSqlTurmasSelect .= "WHERE id <> 0 ";
if($idParentTurmas <> "")
{
	$strSqlTurmasSelect .= "AND id_parent = :id_parent ";
}
if($idsTbTurmas <> "")
{
	$strSqlTurmasSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbTurmas) . ") ";
}
if($idTbCadastro1 <> "")
{
	$strSqlTurmasSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
}
if($palavraChave <> "")
{
	$strSqlTurmasSelect .= "AND (nome_turma LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlTurmasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR cod_turma LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR url4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR url5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTurmasSelect .= ") ";
}

$strSqlTurmasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoTurmas'] . " ";

//Paginação.
if($GLOBALS['habilitarTurmasSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlTurmasSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}

$statementTurmasSelect = $dbSistemaConPDO->prepare($strSqlTurmasSelect);

if ($statementTurmasSelect !== false)
{
	
	if($idTbCadastro1 <> "")
	{
		$statementTurmasSelect->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	}
	if($idParentTurmas <> "")
	{
		$statementTurmasSelect->bindParam(':id_parent', $idParentTurmas, PDO::PARAM_STR);
	}
	$statementTurmasSelect->execute();
	/*
	$statementTurmasSelect->execute(array(
		"id_parent" => $idParentTurmas
	));
	*/
}

//$resultadoTurmas = $dbSistemaConPDO->query($strSqlTurmasSelect);
$resultadoTurmas = $statementTurmasSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarTurmasSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoTurmas[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentTurmas <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentTurmas, "tb_categorias", "categoria");
}
if($idTbCadastro1 <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTurmasIndice");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarTurmasSistemaPaginacao=" . $habilitarTurmasSistemaPaginacao . "<br />";
//echo "strSqlTurmasSelect=" . $strSqlTurmasSelect . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelProcessosAdministrar"); ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    
	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>


    <?php
	if (empty($resultadoTurmas))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formTurmasAcoes" id="formTurmasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_turmas" />
            <input name="idParentTurmas" id="idParentTurmas" type="hidden" value="<?php echo $idParentTurmas; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarTurmasNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTurmasDataInicio'] == 1){ ?>
                <td width="100" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasDataInicio"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTurmasDataFinal'] == 1){ ?>
                <td width="100" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasDataFinal"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasNome"); ?>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarTurmasStatus'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTurmasAcessoRestrito'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
			  	$countTabelaFundo = 0;
			  	$arrTurmasStatus = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 1);
			  
                //Loop pelos resultados.
                foreach($resultadoTurmas as $linhaTurmas)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarTurmasNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaTurmas['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTurmasDataInicio'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTurmas['data_inicio'];?>
                        <?php echo Funcoes::DataLeitura01($linhaTurmas['data_inicio'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTurmasDataFinal'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTurmas['data_final'];?>
                        <?php echo Funcoes::DataLeitura01($linhaTurmas['data_final'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                </td>
                <?php } ?>

                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarTurmasCodigo'] == 1){ ?>
						<?php if($linhaTurmas['cod_turma'] <> ""){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasCodigo"); ?>: 
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['cod_turma']);?>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarTurmasFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaTurmas['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarTurmasVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaTurmas['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarTurmasArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaTurmas['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarTurmasZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaTurmas['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarTurmasSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaTurmas['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarTurmasHistorico'] == 1){ ?>
                            [
                            <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaTurmas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarTurmasModulos'] == 1){ ?>
                            [
                            <a href="SiteAdmModulosIndice.php?idParentModulos=<?php echo $linhaTurmas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirModulos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarTurmasAulas'] == 1){ ?>
                            [
                            <a href="SiteAdmAulasIndice.php?idParentAulas=<?php echo $linhaTurmas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirAulas"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarTurmasVinculo1'] == 1){ ?>
						<?php if($linhaTurmas['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configTurmasVinculo1Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTurmas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTurmasVinculo2'] == 1){ ?>
						<?php if($linhaTurmas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configTurmasVinculo2Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTurmas['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTurmasVinculo3'] == 1){ ?>
						<?php if($linhaTurmas['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configTurmasVinculo3Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTurmas['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>  
                    <?php if($GLOBALS['habilitarTurmasVinculo4'] == 1){ ?>
						<?php if($linhaTurmas['id_tb_cadastro4'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configTurmasVinculo4Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTurmas['id_tb_cadastro4'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro4'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro4'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro4'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>   
                    <?php if($GLOBALS['habilitarTurmasVinculo5'] == 1){ ?>
						<?php if($linhaTurmas['id_tb_cadastro5'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configTurmasVinculo5Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTurmas['id_tb_cadastro5'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro5'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro5'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTurmas['id_tb_cadastro5'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>  
                    
                    
                    <?php //Cadastros vinculados. ?> 
                    <?php //---------------------- ?> 
                    <?php if($GLOBALS['habilitarTurmasCadastroVinculosMultiplos'] == 1){ ?>
						<?php
                        //Cadastros vinculados
                        $itensRelacaoRegistrosSelect13 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
                        "id_registro", 
                        "id_item", 
                        $linhaTurmas['id'], 
                        "", 
                        "", 
                        1, 
                        "", 
                        "", 
                        "tipo_categoria", 
                        "13", 
                        "", 
                        "");
                        ?>
                        
                        <?php if($itensRelacaoRegistrosSelect13 == ""){ ?>
                            <div align="center" class="TextoErro">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                            </div>
                        <?php }else{ ?>
							<?php
                            //Definição de variáveis.
                            $idParentCadastro = "";
                            $idsTbCadastro = $itensRelacaoRegistrosSelect13;
                        
                            
                            //Query de pesquisa.
                            //----------
                            $strSqlCadastroSelect = "";
                            $strSqlCadastroSelect .= "SELECT ";
                            //$strSqlCadastroSelect .= "SELECT SQL_CALC_FOUND_ROWS ";
                            //$strSqlCadastroSelect .= "* ";
                            $strSqlCadastroSelect .= "id, ";
                            $strSqlCadastroSelect .= "id_tb_categorias, ";
                            //$strSqlCadastroSelect .= "id_parent_cadastro, ";
                            $strSqlCadastroSelect .= "data_cadastro, ";
                            $strSqlCadastroSelect .= "pf_pj, ";
                            $strSqlCadastroSelect .= "nome, ";
                            $strSqlCadastroSelect .= "sexo, ";
                            $strSqlCadastroSelect .= "altura, ";
                            $strSqlCadastroSelect .= "peso, ";
                            $strSqlCadastroSelect .= "razao_social, ";
                            $strSqlCadastroSelect .= "nome_fantasia, ";
                            $strSqlCadastroSelect .= "data_nascimento, ";
                            $strSqlCadastroSelect .= "cpf_, ";
                            $strSqlCadastroSelect .= "rg_, ";
                            $strSqlCadastroSelect .= "cnpj_, ";
                            $strSqlCadastroSelect .= "documento, ";
                            $strSqlCadastroSelect .= "i_municipal, ";
                            $strSqlCadastroSelect .= "i_estadual, ";
                            
                            $strSqlCadastroSelect .= "endereco_principal, ";
                            $strSqlCadastroSelect .= "endereco_numero_principal, ";
                            $strSqlCadastroSelect .= "endereco_complemento_principal, ";
                            $strSqlCadastroSelect .= "bairro_principal, ";
                            $strSqlCadastroSelect .= "cidade_principal, ";
                            $strSqlCadastroSelect .= "estado_principal, ";
                            $strSqlCadastroSelect .= "pais_principal, ";
                            $strSqlCadastroSelect .= "cep_principal, ";
                            
                            $strSqlCadastroSelect .= "ponto_referencia, ";
                            $strSqlCadastroSelect .= "email_principal, ";
                            $strSqlCadastroSelect .= "tel_ddd_principal, ";
                            $strSqlCadastroSelect .= "tel_principal, ";
                            $strSqlCadastroSelect .= "cel_ddd_principal, ";
                            $strSqlCadastroSelect .= "cel_principal, ";
                            $strSqlCadastroSelect .= "fax_ddd_principal, ";
                            $strSqlCadastroSelect .= "fax_principal, ";
                            $strSqlCadastroSelect .= "site_principal, ";
                            $strSqlCadastroSelect .= "n_funcionarios, ";
                            $strSqlCadastroSelect .= "obs_interno, ";
                            $strSqlCadastroSelect .= "id_tb_cadastro_status, ";
                            //$strSqlCadastroSelect .= "id_tb_cadastro, ";
                            $strSqlCadastroSelect .= "id_tb_cadastro1, ";
                            $strSqlCadastroSelect .= "id_tb_cadastro2, ";
                            $strSqlCadastroSelect .= "id_tb_cadastro3, ";
                            $strSqlCadastroSelect .= "ativacao, ";
                            $strSqlCadastroSelect .= "ativacao_destaque, ";
                            $strSqlCadastroSelect .= "ativacao_mala_direta, ";
                            $strSqlCadastroSelect .= "usuario, ";
                            $strSqlCadastroSelect .= "senha, ";
                            
                            $strSqlCadastroSelect .= "imagem, ";
                            $strSqlCadastroSelect .= "logo, ";
                            $strSqlCadastroSelect .= "banner, ";
                            $strSqlCadastroSelect .= "mapa, ";
                            
                            $strSqlCadastroSelect .= "mapa_online, ";
                            $strSqlCadastroSelect .= "palavras_chave, ";
                            $strSqlCadastroSelect .= "apresentacao, ";
                            $strSqlCadastroSelect .= "servicos, ";
                            $strSqlCadastroSelect .= "promocoes, ";
                            $strSqlCadastroSelect .= "condicoes_comerciais, ";
                            $strSqlCadastroSelect .= "formas_pagamento, ";
                            $strSqlCadastroSelect .= "horario_atendimento, ";
                            $strSqlCadastroSelect .= "situacao_atual, ";
                            
                            $strSqlCadastroSelect .= "informacao_complementar1, ";
                            $strSqlCadastroSelect .= "informacao_complementar2, ";
                            $strSqlCadastroSelect .= "informacao_complementar3, ";
                            $strSqlCadastroSelect .= "informacao_complementar4, ";
                            $strSqlCadastroSelect .= "informacao_complementar5, ";
                            $strSqlCadastroSelect .= "informacao_complementar6, ";
                            $strSqlCadastroSelect .= "informacao_complementar7, ";
                            $strSqlCadastroSelect .= "informacao_complementar8, ";
                            $strSqlCadastroSelect .= "informacao_complementar9, ";
                            $strSqlCadastroSelect .= "informacao_complementar10, ";
                            $strSqlCadastroSelect .= "informacao_complementar11, ";
                            $strSqlCadastroSelect .= "informacao_complementar12, ";
                            $strSqlCadastroSelect .= "informacao_complementar13, ";
                            $strSqlCadastroSelect .= "informacao_complementar14, ";
                            $strSqlCadastroSelect .= "informacao_complementar15, ";
                            $strSqlCadastroSelect .= "informacao_complementar16, ";
                            $strSqlCadastroSelect .= "informacao_complementar17, ";
                            $strSqlCadastroSelect .= "informacao_complementar18, ";
                            $strSqlCadastroSelect .= "informacao_complementar19, ";
                            $strSqlCadastroSelect .= "informacao_complementar20, ";
                            $strSqlCadastroSelect .= "informacao_complementar21, ";
                            $strSqlCadastroSelect .= "informacao_complementar22, ";
                            $strSqlCadastroSelect .= "informacao_complementar23, ";
                            $strSqlCadastroSelect .= "informacao_complementar24, ";
                            $strSqlCadastroSelect .= "informacao_complementar25, ";
                            $strSqlCadastroSelect .= "informacao_complementar26, ";
                            $strSqlCadastroSelect .= "informacao_complementar27, ";
                            $strSqlCadastroSelect .= "informacao_complementar28, ";
                            $strSqlCadastroSelect .= "informacao_complementar29, ";
                            $strSqlCadastroSelect .= "informacao_complementar30, ";
                            $strSqlCadastroSelect .= "informacao_complementar31, ";
                            $strSqlCadastroSelect .= "informacao_complementar32, ";
                            $strSqlCadastroSelect .= "informacao_complementar33, ";
                            $strSqlCadastroSelect .= "informacao_complementar34, ";
                            $strSqlCadastroSelect .= "informacao_complementar35, ";
                            $strSqlCadastroSelect .= "informacao_complementar36, ";
                            $strSqlCadastroSelect .= "informacao_complementar37, ";
                            $strSqlCadastroSelect .= "informacao_complementar38, ";
                            $strSqlCadastroSelect .= "informacao_complementar39, ";
                            $strSqlCadastroSelect .= "informacao_complementar40, ";
                            $strSqlCadastroSelect .= "n_visitas ";
                            $strSqlCadastroSelect .= "FROM tb_cadastro ";
                            $strSqlCadastroSelect .= "WHERE id <> 0 ";
                            
                            if($idParentCadastro <> "")
                            {
                                $strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
                            }
                            
                            if($idsTbCadastro <> "")
                            {
                                $strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastro) . ") ";
                            }
                            
                            $strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
                            //echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br />";
                            //echo "idParentCadastro=" . $idParentCadastro . "<br />";
                            //----------
                            
                            
                            //Criação de componentes.
                            //----------
                            $statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);
                            
                            if ($statementCadastroSelect !== false)
                            {
                                if($idParentCadastro <> "")
                                {
                                    $statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
                                }
                                $statementCadastroSelect->execute();
                                /*
                                //"idsTdCadastro" => $idsTdCadastro
                                $statementCadastroSelect->execute(array(
                                    "id_tb_categorias" => $idParentCadastro
                                ));
                                */
                            }
                            
                            $resultadoCadastro = $statementCadastroSelect->fetchAll();
                            //----------
                            ?>
                            
                            <?php
                            if(empty($resultadoCadastro))
                            {
                                //echo "Nenhum registro encontrado";
                            }else{
                            ?>
                                <div id="divCadastrosVinculados<?php echo $linhaTurmas['id'];?>" style="position: relative; display: none; margin-top: 10px;">
                                    <table width="100%" class="AdmTabelaDados01">
                                        
                                        <tr class="AdmTbFundoEscuro">
                                            <td class="AdmTabelaDados01Celula">
                                                <div class="AdmTexto02">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastro"); ?>
                                                </div>
                                            </td>
                                            <td width="100" class="AdmTabelaDados01Celula">
                                                <div align="center" class="AdmTexto02">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php
										$countTabelaCadastroFundo = 0;
											
										//Loop pelos resultados.
										foreach($resultadoCadastro as $linhaCadastro)
										{
                                        ?>
                                            <tr class="<?php if($countTabelaCadastroFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                                                <td class="AdmTabelaDados01Celula">
                                                    <div class="AdmTexto01">
														<?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), 
                                                                                            Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), 
                                                                                            Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 
                                                                                            1); 
                                                        ?>
                                                    </div>
                                                </td>
                                                <td width="100" class="AdmTabelaDados01Celula">
                                                    <div align="center" class="AdmTexto01">
                                                    	<a href="SiteAdmCadastroRelatorio01.php?idsTbCadastro=<?php echo $linhaCadastro['id'];?>&idTbTurmas=<?php echo $linhaTurmas['id'];?>&masterPageSiteSelect=LayoutSiteImpressao.php" class="AdmLinks01" target="_blank">
															<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemRelatorio"); ?>
                                                        </a>
                                                    </div>
                                                    
                                                    <?php //Relatórios divididos por meses.?>
													<?php
                                                    //$tbTurmasDataInicio = Funcoes::DataLeitura01($linhaTurmas['data_inicio'], $GLOBALS['configSistemaFormatoData'], "1");
                                                    //$tbTurmasDataInicio = date_create($linhaTurmas['data_inicio']);
                                                    $tbTurmasDataInicio = $linhaTurmas['data_inicio'];
                                                    $tbTurmasDataLoop = new DateTime($tbTurmasDataInicio);
                                                    //$tbTurmasDataInicio = date("Y",strtotime($linhaTurmas['data_inicio'])) . "-" . date("m",strtotime($linhaTurmas['data_inicio'])) . "-" . date("d",strtotime($linhaTurmas['data_inicio']));
                                                    //$tbTurmasDataInicio = new DateTime($tbTurmasDataInicio);
                                                    //$tbTurmasDataFinal = Funcoes::DataLeitura01($linhaTurmas['data_final'], $GLOBALS['configSistemaFormatoData'], "1");
                                                    //$tbTurmasDataFinal = date_create($linhaTurmas['data_final']);
                                                    $tbTurmasDataFinal = $linhaTurmas['data_final'];
                                                    //$tbTurmasDataFinal = date("Y",strtotime($linhaTurmas['data_final'])) . "-" . date("m",strtotime($linhaTurmas['data_final'])) . "-" . date("d",strtotime($linhaTurmas['data_final']));
                                                    //$tbTurmasDataFinal = new DateTime($tbTurmasDataFinal);
                                                    
                                                    //$tbTurmasDataIntervalo = date_diff(strtotime($tbTurmasDataInicio), strtotime($tbTurmasDataFinal));
                                                    //$tbTurmasDataIntervalo = $tbTurmasDataInicio->diff($tbTurmasDataFinal);
                                                    $tbTurmasDataIntervalo = Funcoes::DataIntervalo02("mm", $linhaTurmas['data_inicio'], $linhaTurmas['data_final']);
                                                    
                                                    //Loop pelas datas (funcionando).
                                                    /*
                                                    for($countData = 0; $countData < $tbTurmasDataIntervalo + 1; $countData++)
                                                    {
                                                        
                                                        echo "tbTurmasDataLoop=" . $tbTurmasDataLoop->format('Y-m-d') . "<br />";
                                                        $tbTurmasDataLoop->add(new DateInterval('P1M'));
                                                        
                                                    }
                                                    */
                                                    
                                                    //Verificação de erro - debug.
                                                    //echo "flagTeste=" . "teste" . "<br />";
                                                    //echo "tbTurmasDataInicio=" . $tbTurmasDataInicio . "<br />";
                                                    //echo "tbTurmasDataFinal=" . $tbTurmasDataFinal . "<br />";
                                                    //echo "tbTurmasDataIntervalo=" . $tbTurmasDataIntervalo . "<br />";
                                                    //echo "tbTurmasDataIntervalo->m=" . $tbTurmasDataIntervalo->m . "<br />";
                                                    //echo "Funcoes::DataIntervalo02=" . Funcoes::DataIntervalo02("mm", $tbTurmasDataInicio, $tbTurmasDataFinal) . "<br />";
                                                    //echo "date_diff($tbTurmasDataInicio, $tbTurmasDataFinal)=" . date_diff($tbTurmasDataInicio, $tbTurmasDataFinal) . "<br />";
                                                    ?>
                                                    <div align="center" class="AdmTexto01" style="display: none;">
														<?php 
                                                        for($countData = 0; $countData < $tbTurmasDataIntervalo + 1; $countData++)
                                                        {
                                                        ?>
                                                            <span style="white-space: nowrap;">
                                                                [
                                                                <a href="SiteAdmCadastroRelatorio01.php?idsTbCadastro=<?php echo $linhaCadastro['id'];?>&idTbTurmas=<?php echo $linhaTurmas['id'];?>&dataAulaMes=<?php echo $tbTurmasDataLoop->format('m'); ?>&dataAulaAno=<?php echo $tbTurmasDataLoop->format('Y'); ?>&masterPageSiteSelect=LayoutSiteImpressao.php" class="AdmLinks01" target="_blank">
                                                                    <?php echo $tbTurmasDataLoop->format('m/Y'); ?>
                                                                </a>
                                                                ]
                                                            </span>
                                                        <?php 
                                                            //echo "tbTurmasDataLoop=" . $tbTurmasDataLoop->format('Y-m-d') . "<br />";
                                                            $tbTurmasDataLoop->add(new DateInterval('P1M'));
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                    	<?php 
										  //Linha alternativa de tabela.
										  //----------
										  //$countTabelaFundo = $countTabelaFundo + 1;
										  $countTabelaCadastroFundo++;
										
										   if($countTabelaCadastroFundo == 2)
										   {
											   $countTabelaCadastroFundo = 0;
										   }
										  //----------
										} 
										?>
                                        
                                    </table>
                                </div> 
							<?php } ?>  
                            
							<?php
                            //Limpeza de objetos.
                            //----------
                            unset($strSqlCadastroSelect);
                            unset($statementCadastroSelect);
                            unset($resultadoCadastro);
                            unset($linhaCadastro);
                            //----------
                            ?>
                            
                        <?php } ?>  
                    <?php } ?>  
                    <?php //---------------------- ?> 
                    
                    
                    <?php //Aulas vinculadas. ?> 
                    <?php //---------------------- ?>
                    <?php
					$idParentAulas = $linhaTurmas['id'];
					
					//Query de pesquisa.
					//----------
					$strSqlAulasSelect = "";
					$strSqlAulasSelect .= "SELECT ";
					//$strSqlAulasSelect .= "* ";
					$strSqlAulasSelect .= "id, ";
					$strSqlAulasSelect .= "id_parent, ";
					$strSqlAulasSelect .= "id_tb_cadastro_usuario, ";
					$strSqlAulasSelect .= "id_tb_cadastro1, ";
					$strSqlAulasSelect .= "id_tb_cadastro2, ";
					$strSqlAulasSelect .= "id_tb_cadastro3, ";
					$strSqlAulasSelect .= "id_tb_cadastro4, ";
					$strSqlAulasSelect .= "id_tb_cadastro5, ";
					$strSqlAulasSelect .= "n_classificacao, ";
					$strSqlAulasSelect .= "data_criacao, ";
					$strSqlAulasSelect .= "data_aula, ";
					$strSqlAulasSelect .= "data1, ";
					$strSqlAulasSelect .= "data2, ";
					$strSqlAulasSelect .= "data3, ";
					$strSqlAulasSelect .= "data4, ";
					$strSqlAulasSelect .= "data5, ";
					$strSqlAulasSelect .= "data6, ";
					$strSqlAulasSelect .= "data7, ";
					$strSqlAulasSelect .= "data8, ";
					$strSqlAulasSelect .= "data9, ";
					$strSqlAulasSelect .= "data10, ";
					$strSqlAulasSelect .= "tema, ";
					$strSqlAulasSelect .= "descricao, ";
					$strSqlAulasSelect .= "local, ";
					$strSqlAulasSelect .= "id_tb_aulas_status, ";
					$strSqlAulasSelect .= "palavras_chave, ";
					$strSqlAulasSelect .= "valor, ";
					$strSqlAulasSelect .= "valor1, ";
					$strSqlAulasSelect .= "valor2, ";
					$strSqlAulasSelect .= "valor3, ";
					$strSqlAulasSelect .= "valor4, ";
					$strSqlAulasSelect .= "valor5, ";
					$strSqlAulasSelect .= "url1, ";
					$strSqlAulasSelect .= "url2, ";
					$strSqlAulasSelect .= "url3, ";
					$strSqlAulasSelect .= "url4, ";
					$strSqlAulasSelect .= "url5, ";
					$strSqlAulasSelect .= "informacao_complementar1, ";
					$strSqlAulasSelect .= "informacao_complementar2, ";
					$strSqlAulasSelect .= "informacao_complementar3, ";
					$strSqlAulasSelect .= "informacao_complementar4, ";
					$strSqlAulasSelect .= "informacao_complementar5, ";
					$strSqlAulasSelect .= "informacao_complementar6, ";
					$strSqlAulasSelect .= "informacao_complementar7, ";
					$strSqlAulasSelect .= "informacao_complementar8, ";
					$strSqlAulasSelect .= "informacao_complementar9, ";
					$strSqlAulasSelect .= "informacao_complementar10, ";
					
					$strSqlAulasSelect .= "informacao_complementar11, ";
					$strSqlAulasSelect .= "informacao_complementar12, ";
					$strSqlAulasSelect .= "informacao_complementar13, ";
					$strSqlAulasSelect .= "informacao_complementar14, ";
					$strSqlAulasSelect .= "informacao_complementar15, ";
					$strSqlAulasSelect .= "informacao_complementar16, ";
					$strSqlAulasSelect .= "informacao_complementar17, ";
					$strSqlAulasSelect .= "informacao_complementar18, ";
					$strSqlAulasSelect .= "informacao_complementar19, ";
					$strSqlAulasSelect .= "informacao_complementar20, ";
					$strSqlAulasSelect .= "informacao_complementar21, ";
					$strSqlAulasSelect .= "informacao_complementar22, ";
					$strSqlAulasSelect .= "informacao_complementar23, ";
					$strSqlAulasSelect .= "informacao_complementar24, ";
					$strSqlAulasSelect .= "informacao_complementar25, ";
					$strSqlAulasSelect .= "informacao_complementar26, ";
					$strSqlAulasSelect .= "informacao_complementar27, ";
					$strSqlAulasSelect .= "informacao_complementar28, ";
					$strSqlAulasSelect .= "informacao_complementar29, ";
					$strSqlAulasSelect .= "informacao_complementar30, ";
					$strSqlAulasSelect .= "informacao_complementar31, ";
					$strSqlAulasSelect .= "informacao_complementar32, ";
					$strSqlAulasSelect .= "informacao_complementar33, ";
					$strSqlAulasSelect .= "informacao_complementar34, ";
					$strSqlAulasSelect .= "informacao_complementar35, ";
					$strSqlAulasSelect .= "informacao_complementar36, ";
					$strSqlAulasSelect .= "informacao_complementar37, ";
					$strSqlAulasSelect .= "informacao_complementar38, ";
					$strSqlAulasSelect .= "informacao_complementar39, ";
					$strSqlAulasSelect .= "informacao_complementar40, ";
					$strSqlAulasSelect .= "informacao_complementar41, ";
					$strSqlAulasSelect .= "informacao_complementar42, ";
					$strSqlAulasSelect .= "informacao_complementar43, ";
					$strSqlAulasSelect .= "informacao_complementar44, ";
					$strSqlAulasSelect .= "informacao_complementar45, ";
					$strSqlAulasSelect .= "informacao_complementar46, ";
					$strSqlAulasSelect .= "informacao_complementar47, ";
					$strSqlAulasSelect .= "informacao_complementar48, ";
					$strSqlAulasSelect .= "informacao_complementar49, ";
					$strSqlAulasSelect .= "informacao_complementar50, ";
					$strSqlAulasSelect .= "informacao_complementar51, ";
					$strSqlAulasSelect .= "informacao_complementar52, ";
					$strSqlAulasSelect .= "informacao_complementar53, ";
					$strSqlAulasSelect .= "informacao_complementar54, ";
					$strSqlAulasSelect .= "informacao_complementar55, ";
					$strSqlAulasSelect .= "informacao_complementar56, ";
					$strSqlAulasSelect .= "informacao_complementar57, ";
					$strSqlAulasSelect .= "informacao_complementar58, ";
					$strSqlAulasSelect .= "informacao_complementar59, ";
					$strSqlAulasSelect .= "informacao_complementar60, ";
					$strSqlAulasSelect .= "carga_horaria, ";
					$strSqlAulasSelect .= "ativacao, ";
					$strSqlAulasSelect .= "ativacao1, ";
					$strSqlAulasSelect .= "ativacao2, ";
					$strSqlAulasSelect .= "ativacao3, ";
					$strSqlAulasSelect .= "ativacao4, ";
					$strSqlAulasSelect .= "reposicao, ";
					$strSqlAulasSelect .= "anotacoes_internas, ";
					$strSqlAulasSelect .= "n_visitas, ";
					$strSqlAulasSelect .= "acesso_restrito ";
					$strSqlAulasSelect .= "FROM tb_aulas ";
					$strSqlAulasSelect .= "WHERE id <> 0 ";
					if($idParentAulas <> "")
					{
						$strSqlAulasSelect .= "AND id_parent = :id_parent ";
					}
					
					$strSqlAulasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoAulas'] . " ";
					//----------
					
					
					//Criação de componentes e parâmetros.
					//----------
					$statementAulasSelect = $dbSistemaConPDO->prepare($strSqlAulasSelect);
					
					if ($statementAulasSelect !== false)
					{
						if($idParentAulas <> "")
						{
							$statementAulasSelect->bindParam(':id_parent', $idParentAulas, PDO::PARAM_STR);
						}
						$statementAulasSelect->execute();
						/*
						$statementAulasSelect->execute(array(
							"id_parent" => $idParentAulas
						));
						*/
					}
					
					//$resultadoAulas = $dbSistemaConPDO->query($strSqlAulasSelect);
					$resultadoAulas = $statementAulasSelect->fetchAll();
					//----------
					?>
                    
					<?php
                    if (empty($resultadoAulas))
                    {
                        //echo "Nenhum registro encontrado";
                    ?>
                        <div align="center" class="TextoErro">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div id="divAulasVinculados<?php echo $linhaTurmas['id'];?>" style="position: relative; display: none; margin-top: 10px;">
                            <table width="100%" class="AdmTabelaDados01">
                                
                                <tr class="AdmTbFundoEscuro">
                                    <td class="AdmTabelaDados01Celula">
                                        <div class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasTema"); ?>
                                        </div>
                                    </td>
                                    <td width="100" class="AdmTabelaDados01Celula">
                                        <div align="center" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php
                                $countTabelaAulaFundo = 0;
                                    
                                //Loop pelos resultados.
                                foreach($resultadoAulas as $linhaAulas)
                                {
                                ?>
                                    <tr class="<?php if($countTabelaAulaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                                        <td class="AdmTabelaDados01Celula">
                                            <div class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>
                                            </div>
                                        </td>
                                        <td width="100" class="AdmTabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                Avaliar
                                            </div>
                                        </td>
                                    </tr>
                                <?php 
                                  //Linha alternativa de tabela.
                                  //----------
                                  //$countTabelaFundo = $countTabelaFundo + 1;
                                  $countTabelaAulaFundo++;
                                
                                   if($countTabelaAulaFundo == 2)
                                   {
                                       $countTabelaAulaFundo = 0;
                                   }
                                  //----------
                                } 
                                ?>
                                
                            </table>
                        </div>
                    <?php } ?>
					<?php
                    //Limpeza de objetos.
                    //----------
                    unset($strSqlAulasSelect);
                    unset($statementAulasSelect);
                    unset($resultadoAulas);
                    unset($linhaAulas);
                    //----------
                    ?>
                    <?php //---------------------- ?>
                    
                    
                    <?php //Módulos vinculadas. ?> 
                    <?php //---------------------- ?>
                    <?php
					$idParentModulos = $linhaTurmas['id'];
					
					//Query de pesquisa.
					//----------
					$strSqlModulosSelect = "";
					$strSqlModulosSelect .= "SELECT ";
					//$strSqlModulosSelect .= "* ";
					$strSqlModulosSelect .= "id, ";
					$strSqlModulosSelect .= "id_parent, ";
					$strSqlModulosSelect .= "id_tb_cadastro_usuario, ";
					$strSqlModulosSelect .= "id_tb_cadastro1, ";
					$strSqlModulosSelect .= "id_tb_cadastro2, ";
					$strSqlModulosSelect .= "id_tb_cadastro3, ";
					$strSqlModulosSelect .= "id_tb_cadastro4, ";
					$strSqlModulosSelect .= "id_tb_cadastro5, ";
					$strSqlModulosSelect .= "n_classificacao, ";
					$strSqlModulosSelect .= "data_criacao, ";
					$strSqlModulosSelect .= "data_inicio, ";
					$strSqlModulosSelect .= "data_final, ";
					$strSqlModulosSelect .= "data1, ";
					$strSqlModulosSelect .= "data2, ";
					$strSqlModulosSelect .= "data3, ";
					$strSqlModulosSelect .= "data4, ";
					$strSqlModulosSelect .= "data5, ";
					$strSqlModulosSelect .= "data6, ";
					$strSqlModulosSelect .= "data7, ";
					$strSqlModulosSelect .= "data8, ";
					$strSqlModulosSelect .= "data9, ";
					$strSqlModulosSelect .= "data10, ";
					$strSqlModulosSelect .= "nome_modulo, ";
					$strSqlModulosSelect .= "descricao, ";
					$strSqlModulosSelect .= "id_tb_modulos_status, ";
					$strSqlModulosSelect .= "palavras_chave, ";
					$strSqlModulosSelect .= "valor, ";
					$strSqlModulosSelect .= "valor1, ";
					$strSqlModulosSelect .= "valor2, ";
					$strSqlModulosSelect .= "valor3, ";
					$strSqlModulosSelect .= "valor4, ";
					$strSqlModulosSelect .= "valor5, ";
					$strSqlModulosSelect .= "url1, ";
					$strSqlModulosSelect .= "url2, ";
					$strSqlModulosSelect .= "url3, ";
					$strSqlModulosSelect .= "url4, ";
					$strSqlModulosSelect .= "url5, ";
					$strSqlModulosSelect .= "informacao_complementar1, ";
					$strSqlModulosSelect .= "informacao_complementar2, ";
					$strSqlModulosSelect .= "informacao_complementar3, ";
					$strSqlModulosSelect .= "informacao_complementar4, ";
					$strSqlModulosSelect .= "informacao_complementar5, ";
					$strSqlModulosSelect .= "informacao_complementar6, ";
					$strSqlModulosSelect .= "informacao_complementar7, ";
					$strSqlModulosSelect .= "informacao_complementar8, ";
					$strSqlModulosSelect .= "informacao_complementar9, ";
					$strSqlModulosSelect .= "informacao_complementar10, ";
					
					$strSqlModulosSelect .= "informacao_complementar11, ";
					$strSqlModulosSelect .= "informacao_complementar12, ";
					$strSqlModulosSelect .= "informacao_complementar13, ";
					$strSqlModulosSelect .= "informacao_complementar14, ";
					$strSqlModulosSelect .= "informacao_complementar15, ";
					$strSqlModulosSelect .= "informacao_complementar16, ";
					$strSqlModulosSelect .= "informacao_complementar17, ";
					$strSqlModulosSelect .= "informacao_complementar18, ";
					$strSqlModulosSelect .= "informacao_complementar19, ";
					$strSqlModulosSelect .= "informacao_complementar20, ";
					$strSqlModulosSelect .= "informacao_complementar21, ";
					$strSqlModulosSelect .= "informacao_complementar22, ";
					$strSqlModulosSelect .= "informacao_complementar23, ";
					$strSqlModulosSelect .= "informacao_complementar24, ";
					$strSqlModulosSelect .= "informacao_complementar25, ";
					$strSqlModulosSelect .= "informacao_complementar26, ";
					$strSqlModulosSelect .= "informacao_complementar27, ";
					$strSqlModulosSelect .= "informacao_complementar28, ";
					$strSqlModulosSelect .= "informacao_complementar29, ";
					$strSqlModulosSelect .= "informacao_complementar30, ";
					$strSqlModulosSelect .= "informacao_complementar31, ";
					$strSqlModulosSelect .= "informacao_complementar32, ";
					$strSqlModulosSelect .= "informacao_complementar33, ";
					$strSqlModulosSelect .= "informacao_complementar34, ";
					$strSqlModulosSelect .= "informacao_complementar35, ";
					$strSqlModulosSelect .= "informacao_complementar36, ";
					$strSqlModulosSelect .= "informacao_complementar37, ";
					$strSqlModulosSelect .= "informacao_complementar38, ";
					$strSqlModulosSelect .= "informacao_complementar39, ";
					$strSqlModulosSelect .= "informacao_complementar40, ";
					$strSqlModulosSelect .= "informacao_complementar41, ";
					$strSqlModulosSelect .= "informacao_complementar42, ";
					$strSqlModulosSelect .= "informacao_complementar43, ";
					$strSqlModulosSelect .= "informacao_complementar44, ";
					$strSqlModulosSelect .= "informacao_complementar45, ";
					$strSqlModulosSelect .= "informacao_complementar46, ";
					$strSqlModulosSelect .= "informacao_complementar47, ";
					$strSqlModulosSelect .= "informacao_complementar48, ";
					$strSqlModulosSelect .= "informacao_complementar49, ";
					$strSqlModulosSelect .= "informacao_complementar50, ";
					$strSqlModulosSelect .= "informacao_complementar51, ";
					$strSqlModulosSelect .= "informacao_complementar52, ";
					$strSqlModulosSelect .= "informacao_complementar53, ";
					$strSqlModulosSelect .= "informacao_complementar54, ";
					$strSqlModulosSelect .= "informacao_complementar55, ";
					$strSqlModulosSelect .= "informacao_complementar56, ";
					$strSqlModulosSelect .= "informacao_complementar57, ";
					$strSqlModulosSelect .= "informacao_complementar58, ";
					$strSqlModulosSelect .= "informacao_complementar59, ";
					$strSqlModulosSelect .= "informacao_complementar60, ";
					$strSqlModulosSelect .= "carga_horaria, ";
					$strSqlModulosSelect .= "duracao_aula, ";
					$strSqlModulosSelect .= "ativacao, ";
					$strSqlModulosSelect .= "ativacao1, ";
					$strSqlModulosSelect .= "ativacao2, ";
					$strSqlModulosSelect .= "ativacao3, ";
					$strSqlModulosSelect .= "ativacao4, ";
					$strSqlModulosSelect .= "anotacoes_internas, ";
					$strSqlModulosSelect .= "n_visitas, ";
					$strSqlModulosSelect .= "acesso_restrito ";
					$strSqlModulosSelect .= "FROM tb_modulos ";
					$strSqlModulosSelect .= "WHERE id <> 0 ";
					if($idParentModulos <> "")
					{
						$strSqlModulosSelect .= "AND id_parent = :id_parent ";
					}
					
					$strSqlModulosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoModulos'] . " ";
					
					
					//Criação de componentes e parâmetros.
					//----------
					$statementModulosSelect = $dbSistemaConPDO->prepare($strSqlModulosSelect);
					
					if ($statementModulosSelect !== false)
					{
						if($idParentModulos <> "")
						{
							$statementModulosSelect->bindParam(':id_parent', $idParentModulos, PDO::PARAM_STR);
						}
						$statementModulosSelect->execute();
						/*
						$statementModulosSelect->execute(array(
							"id_parent" => $idParentModulos
						));
						*/
					}
					
					//$resultadoModulos = $dbSistemaConPDO->query($strSqlModulosSelect);
					$resultadoModulos = $statementModulosSelect->fetchAll();
					//----------
					?>
					<?php
                    if (empty($resultadoModulos))
                    {
                        //echo "Nenhum registro encontrado";
                    ?>
                        <div align="center" class="TextoErro">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                        </div>
                    <?php
                    }else{
                    ?>
                        <div id="divModulosVinculados<?php echo $linhaTurmas['id'];?>" style="position: relative; display: none; margin-top: 10px;">
                            <table width="100%" class="AdmTabelaDados01">
                                
                                <tr class="AdmTbFundoEscuro">
                                    <td class="AdmTabelaDados01Celula">
                                        <div class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosNome"); ?>
                                        </div>
                                    </td>
                                    <td width="100" class="AdmTabelaDados01Celula">
                                        <div align="center" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                                        </div>
                                    </td>
                                </tr>
                                
                                <?php
                                $countTabelaModulosFundo = 0;
                                    
                                //Loop pelos resultados.
                                foreach($resultadoModulos as $linhaModulos)
                                {
                                ?>
                                    <tr class="<?php if($countTabelaModulosFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                                        <td class="AdmTabelaDados01Celula">
                                            <div class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>
                                            </div>
                                        </td>
                                        <td width="100" class="AdmTabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                Aulas
                                            </div>
                                        </td>
                                    </tr>
                                <?php 
                                  //Linha alternativa de tabela.
                                  //----------
                                  //$countTabelaFundo = $countTabelaFundo + 1;
                                  $countTabelaModulosFundo++;
                                
                                   if($countTabelaModulosFundo == 2)
                                   {
                                       $countTabelaModulosFundo = 0;
                                   }
                                  //----------
                                } 
                                ?>
                                
                            </table>
                        </div>
                    <?php } ?>
					<?php
                    //Limpeza de objetos.
                    //----------
                    unset($strSqlModulosSelect);
                    unset($statementModulosSelect);
                    unset($resultadoModulos);
                    unset($linhaModulos);
                    //----------
                    ?>
                    <?php //---------------------- ?>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteTurmasDetalhes.php?idTbTurmas=<?php echo $linhaTurmas['id'];?>&masterPageSiteSelect=LayoutSitePrincipal.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['configDiretorioSistema'];?>/<?php echo $GLOBALS['configDiretorioArquivos'];?>/exemplo_relatorio01.pdf" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemRelatorio"); ?>
                        </a>
                    </div>
                    
                    
					<?php if($GLOBALS['habilitarTurmasCadastroVinculosMultiplos'] == 1){ ?>
                        <div align="center" class="AdmTexto01">
                            <a href="SiteAdmItensRelacaoRegistrosIndice.php?idItem=<?php echo $linhaTurmas['id'];?>&tipoCategoria=13&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_turma']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciarCadastros"); ?>
                            </a>
                        </div>
                        
                        <?php //Mostrar cadastros. ?>
                        <div align="center" class="AdmTexto01">
                            <a href="#" class="AdmLinks01" onclick="divShowHide('divCadastrosVinculados<?php echo $linhaTurmas['id'];?>');">
                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemRelatorio"); ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastro"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <?php //echo "habilitarTurmasCadastroVinculosMultiplos=" . $GLOBALS['habilitarTurmasCadastroVinculosMultiplos'];?>
                    
                    
                    <?php if($GLOBALS['habilitarTurmasModulos'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="#" class="AdmLinks01" onclick="divShowHide('divModulosVinculados<?php echo $linhaTurmas['id'];?>');">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirModulos"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
                    
                    <?php if($GLOBALS['habilitarTurmasAulas'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="#" class="AdmLinks01" onclick="divShowHide('divAulasVinculados<?php echo $linhaTurmas['id'];?>');">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirAulas"); ?>
                        </a>
                    </div>
                    <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarTurmasStatus'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrTurmasStatus); $countArray++)
                        {
                        ?>
                        	<?php if($arrTurmasStatus[$countArray][0] == $linhaTurmas['id_tb_turmas_status']){ ?>
								<?php echo $arrTurmasStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTurmasAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaTurmas['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaTurmas['id'];?>&statusAtivacao=<?php echo $linhaTurmas['acesso_restrito'];?>&strTabela=tb_turmas&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaTurmas['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaTurmas['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaTurmas['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaTurmas['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaTurmas['id'];?>&statusAtivacao=<?php echo $linhaTurmas['ativacao'];?>&strTabela=tb_turmas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaTurmas['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaTurmas['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaTurmas['ativacao'];?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmTurmasEditar.php?idTbTurmas=<?php echo $linhaTurmas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaTurmas['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php 
				  //Linha alternativa de tabela.
				  //----------
				  //$countTabelaFundo = $countTabelaFundo + 1;
				  $countTabelaFundo++;
				
				   if($countTabelaFundo == 2)
				   {
					   $countTabelaFundo = 0;
				   }
				  //----------
			  
			  } 
			  ?>
            </table>
        </form>
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarTurmasSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarPaginasSistemaPaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    
    
    <?php if(!empty($idParentTurmas)){ ?>
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formTurmas').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_classificacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					valor: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					}//,
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					},
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					}//,
				},		
				//----------------------
				
				
				/*
				errorPlacement: function(error, element) {
					if(element.attr("name") == "n_classificacao")
					{
						error.insertAfter(".nomedadiv");
					}
					else if  (element.attr("name") == "phone" )
						error.insertAfter(".some-other-class");
					else
						error.insertAfter(element);
				}
				*/
			});
			//**************************************************************************************

		});	
	</script>
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formTurmas" id="formTurmas" action="SiteAdmTurmasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasTbTurmas"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarTurmasVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasVinculo1Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTurmasVinculo1'], $GLOBALS['configIdTbTipoTurmasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTurmasVinculo1'], $GLOBALS['configTurmasVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasVinculo1); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrTurmasVinculo1[$countArray][0];?>"><?php echo $arrTurmasVinculo1[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTurmasVinculo2'], $GLOBALS['configIdTbTipoTurmasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTurmasVinculo2'], $GLOBALS['configTurmasVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrTurmasVinculo2[$countArray][0];?>"><?php echo $arrTurmasVinculo2[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTurmasVinculo3'], $GLOBALS['configIdTbTipoTurmasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTurmasVinculo3'], $GLOBALS['configTurmasVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrTurmasVinculo3[$countArray][0];?>"><?php echo $arrTurmasVinculo3[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasVinculo4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasVinculo4Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTurmasVinculo4'], $GLOBALS['configIdTbTipoTurmasVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTurmasVinculo4'], $GLOBALS['configTurmasVinculo4Metodo']);
                        ?>
                        <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasVinculo4); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrTurmasVinculo4[$countArray][0];?>"><?php echo $arrTurmasVinculo4[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasVinculo5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasVinculo5Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasVinculo5 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTurmasVinculo5'], $GLOBALS['configIdTbTipoTurmasVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTurmasVinculo5'], $GLOBALS['configTurmasVinculo5Metodo']);
                        ?>
                        <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasVinculo5); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrTurmasVinculo5[$countArray][0];?>"><?php echo $arrTurmasVinculo5[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasDataInicio'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasDataInicio"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_distribuicao";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_inicio;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_distribuicao";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_inicio;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_inicio" id="data_inicio" class="AdmCampoData01" maxlength="10" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasDataFinal'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasDataFinal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_admissao";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_final;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_admissao";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_final;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_final" id="data_final" class="AdmCampoData01" maxlength="10" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarTurmasData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasData1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoTurmasData1'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data1" id="data1" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasNome"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarTurmasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="nome_turma" id="nome_turma" class="AdmCampoTexto01" maxlength="255" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarTurmasNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <?php if($GLOBALS['habilitarTurmasCodigo'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="cod_turma" id="cod_turma" class="AdmCampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao" id="descricao"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao" id="descricao"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarTurmasStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasStatus = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 1);
                        ?>
                        <select name="id_tb_turmas_status" id="id_tb_turmas_status" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrTurmasStatus[$countArray][0];?>"><?php echo $arrTurmasStatus[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo htmlentities($GLOBALS['configSistemaMoeda']); ?>
                    	<input type="text" name="valor" id="valor" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
			<?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTurmasAnotacoesInternas"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<textarea name="anotacoes_internas" id="anotacoes_internas" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico01[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico01[]" name="idsTurmasFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico01[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico01[]" name="idsTurmasFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico01[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico01)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico02[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico02[]" name="idsTurmasFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico02[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico02[]" name="idsTurmasFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico02[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico02)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico03[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico03[]" name="idsTurmasFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico03[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico03[]" name="idsTurmasFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico03[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico03)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico04[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico04[]" name="idsTurmasFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico04[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico04[]" name="idsTurmasFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico04[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico04)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico05[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico05[]" name="idsTurmasFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico05[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico05[]" name="idsTurmasFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico05[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico05)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico06[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico06[]" name="idsTurmasFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico06[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico06[]" name="idsTurmasFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico06[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico06)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico07[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico07[]" name="idsTurmasFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico07[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico07[]" name="idsTurmasFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico07[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico07)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico08[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico08[]" name="idsTurmasFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico08[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico08[]" name="idsTurmasFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico08[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico08)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico09[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico09[]" name="idsTurmasFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico09[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico09[]" name="idsTurmasFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico09[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico09)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico10[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico10[]" name="idsTurmasFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico10[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico10[]" name="idsTurmasFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico10[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico10)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico11Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico11[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico11[]" name="idsTurmasFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico11[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico11[]" name="idsTurmasFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico11[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico11)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico12Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 23);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico12[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico12[]" name="idsTurmasFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico12[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico12[]" name="idsTurmasFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico12[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico12)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico13Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 24);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico13[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico13[]" name="idsTurmasFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico13[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico13[]" name="idsTurmasFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico13[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico13)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico14Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico14[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico14[]" name="idsTurmasFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico14[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico14[]" name="idsTurmasFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico14[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico14)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico15Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico15[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico15[]" name="idsTurmasFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico15[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico15[]" name="idsTurmasFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico15[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico15)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico16Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico16[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico16[]" name="idsTurmasFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico16); $countArray++)
                                {

                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico16[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico16[]" name="idsTurmasFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico16[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico16)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico17Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico17[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico17[]" name="idsTurmasFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico17[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico17[]" name="idsTurmasFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico17[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico17)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico18Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico18[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico18[]" name="idsTurmasFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico18[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico18[]" name="idsTurmasFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico18[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico18)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico19Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico19[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico19[]" name="idsTurmasFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico19[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico19[]" name="idsTurmasFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico19[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico19)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasFiltroGenerico20Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrTurmasFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_turmas_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configTurmasFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsTurmasFiltroGenerico20[]" type="checkbox" value="<?php echo $arrTurmasFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrTurmasFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsTurmasFiltroGenerico20[]" name="idsTurmasFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico20[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasFiltroGenerico20CaixaSelecao'] == 3){ ?>
                            <select id="idsTurmasFiltroGenerico20[]" name="idsTurmasFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTurmasFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTurmasFiltroGenerico20[$countArray][0];?>"><?php echo $arrTurmasFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrTurmasFiltroGenerico20)){ ?>
                        	<a href="TurmasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarTurmasURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTurmasURL1Titulo']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url1" id="url1" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarTurmasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc6'] == 1){ ?>

                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc2'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {

                                        $("#informacao_complementar7").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc16']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar16").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar16").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar16" id="informacao_complementar16"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc17']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar17").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar17").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar17" id="informacao_complementar17"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc18']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar18").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar18").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar18" id="informacao_complementar18"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc19']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar19").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar19").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar19" id="informacao_complementar19"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc20']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar20").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar20").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar20" id="informacao_complementar20"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc21']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar21").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar21").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar21" id="informacao_complementar21"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc22']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar22").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar22").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar22" id="informacao_complementar22"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc23']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar23").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar23").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar23" id="informacao_complementar23"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc24']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar24").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );

                                    });
                                </script>
                                <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar24").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar24" id="informacao_complementar24"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc25']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc25'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar25").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar25").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar25" id="informacao_complementar25"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc26']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc26'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar26").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar26").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar26" id="informacao_complementar26"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc27']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc22'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar27").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar27").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar27" id="informacao_complementar27"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc28']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc28'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar28").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar28").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar28" id="informacao_complementar28"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc29']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc29'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar29").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar29").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar29" id="informacao_complementar29"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc30']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc30'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar30").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar30").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar30" id="informacao_complementar30"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc31']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc31'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar31").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar31").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar31" id="informacao_complementar31"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc32']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc32'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar32").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar32").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar32" id="informacao_complementar32"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc33']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc33'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar33").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar33").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar33" id="informacao_complementar33"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc34']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc34'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar34").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar34").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar34" id="informacao_complementar34"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc35']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc35'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar35").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar35").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar35" id="informacao_complementar35"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc36']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc36'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar36").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar36").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar36" id="informacao_complementar36"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc37']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc37'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar37").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar37").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar37" id="informacao_complementar37"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc38']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc38'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar38").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar38").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar38" id="informacao_complementar38"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc39']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc39'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar39").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar39").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar39" id="informacao_complementar39"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc40']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc40'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar40" id="informacao_complementar40"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc41']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc41'] == 1){ ?>
                            <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc41'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar41").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar41" id="informacao_complementar41"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar41").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar41" id="informacao_complementar41"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc42']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc42'] == 1){ ?>
                            <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc42'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar42").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar42" id="informacao_complementar42"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar42").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar42" id="informacao_complementar42"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc43']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc43'] == 1){ ?>
                            <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc43'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar43").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar43" id="informacao_complementar43"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar43").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar43" id="informacao_complementar43"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc44']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc44'] == 1){ ?>
                            <input type="text" name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc44'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar44").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar44" id="informacao_complementar44"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar44").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar44" id="informacao_complementar44"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc45']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc45'] == 1){ ?>
                            <input type="text" name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTexto01" maxlength="255" />

                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc45'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar45").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar45" id="informacao_complementar45"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar45").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar45" id="informacao_complementar45"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc46']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc46'] == 1){ ?>
                            <input type="text" name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc46'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar46").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar46" id="informacao_complementar46"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar46").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar46" id="informacao_complementar46"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc47']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc47'] == 1){ ?>
                            <input type="text" name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc42'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar47").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar47" id="informacao_complementar47"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar47").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar47" id="informacao_complementar47"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc48']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc48'] == 1){ ?>
                            <input type="text" name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc48'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar48").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar48" id="informacao_complementar48"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar48").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar48" id="informacao_complementar48"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc49']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc49'] == 1){ ?>
                            <input type="text" name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc49'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar49").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar49" id="informacao_complementar49"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar49").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar49" id="informacao_complementar49"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc50']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc50'] == 1){ ?>
                            <input type="text" name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc50'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {

                                        $("#informacao_complementar50").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar50" id="informacao_complementar50"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar50").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar50" id="informacao_complementar50"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc51']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc51'] == 1){ ?>
                            <input type="text" name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc51'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar51").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar51" id="informacao_complementar51"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar51").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar51" id="informacao_complementar51"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc52']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc52'] == 1){ ?>
                            <input type="text" name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc52'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar52").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar52" id="informacao_complementar52"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar52").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar52" id="informacao_complementar52"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc53']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc53'] == 1){ ?>
                            <input type="text" name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc53'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar53").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar53" id="informacao_complementar53"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar53").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar53" id="informacao_complementar53"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc54']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc54'] == 1){ ?>
                            <input type="text" name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc54'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar54").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar54" id="informacao_complementar54"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar54").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar54" id="informacao_complementar54"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc55']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc55'] == 1){ ?>
                            <input type="text" name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc55'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar55").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar55" id="informacao_complementar55"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar55").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar55" id="informacao_complementar55"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc56']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc56'] == 1){ ?>
                            <input type="text" name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc56'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar56").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar56" id="informacao_complementar56"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar56").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar56" id="informacao_complementar56"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarTurmasIc57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc57']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc57'] == 1){ ?>
                            <input type="text" name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc52'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar57").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar57" id="informacao_complementar57"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar57").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar57" id="informacao_complementar57"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc58']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc58'] == 1){ ?>
                            <input type="text" name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc58'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar58").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar58" id="informacao_complementar58"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar58").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar58" id="informacao_complementar58"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc59']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc59'] == 1){ ?>
                            <input type="text" name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc59'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar59").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar59" id="informacao_complementar59"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar59").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar59" id="informacao_complementar59"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarTurmasIc60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloTurmasIc60']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configTurmasBoxIc60'] == 1){ ?>
                            <input type="text" name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configTurmasBoxIc60'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar60").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar60" id="informacao_complementar60"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar60").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar60" id="informacao_complementar60"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParentTurmas; ?>" />
                <input name="acesso_restrito" type="hidden" id="acesso_restrito" value="0" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlTurmasSelect);
unset($statementTurmasSelect);
unset($resultadoTurmas);
unset($linhaTurmas);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>