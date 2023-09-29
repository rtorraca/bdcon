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
$idParentModulos = $_GET["idParentModulos"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "SiteAdmModulosIndice.php";
$paginaRetornoExclusao = "SiteAdmModulosEditar.php";
$variavelRetorno = "idParentModulos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarModulosSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configModulosSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_modulos", "id_parent", $idParentModulos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentModulos=" . $idParentModulos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


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

//Paginação (subquery).
if($GLOBALS['habilitarModulosSitePaginacao'] == "1"){
	$strSqlModulosSelect .= ", (SELECT COUNT(id) ";
	$strSqlModulosSelect .= "FROM tb_modulos ";
	$strSqlModulosSelect .= "WHERE id <> 0 ";
	if($idParentModulos <> "")
	{
		$strSqlModulosSelect .= "AND id_parent = :id_parent ";
	}
	if($palavraChave <> "")
	{
		$strSqlModulosSelect .= "AND (nome_modulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlModulosSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR url4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR url5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlModulosSelect .= ") ";
	}
	$strSqlModulosSelect .= ") totalRegistros ";
}

$strSqlModulosSelect .= "FROM tb_modulos ";
$strSqlModulosSelect .= "WHERE id <> 0 ";
if($idParentModulos <> "")
{
	$strSqlModulosSelect .= "AND id_parent = :id_parent ";
}
if($palavraChave <> "")
{
	$strSqlModulosSelect .= "AND (nome_modulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlModulosSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR url4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR url5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlModulosSelect .= ") ";
}

$strSqlModulosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoModulos'] . " ";

//Paginação.
if($GLOBALS['habilitarModulosSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlModulosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


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


//Paginação.
if($GLOBALS['habilitarModulosSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoModulos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelModulosIndice");
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

        <form name="formModulosAcoes" id="formModulosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_modulos" />
            <input name="idParentModulos" id="idParentModulos" type="hidden" value="<?php echo $idParentModulos; ?>" />

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
              	<?php if($GLOBALS['habilitarModulosNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarModulosDataInicio'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosDataInicio"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarModulosDataFinal'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosDataFinal"); ?>
                    </div>
                </td>
                <?php } ?>
                
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
                
                <?php if($GLOBALS['habilitarModulosStatus'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarModulosAcessoRestrito'] == 1){ ?>
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
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
			  	$countTabelaFundo = 0;
			  	$arrModulosStatus = DbFuncoes::FiltrosGenericosFill01("tb_modulos_complemento", 1);
			  
                //Loop pelos resultados.
                foreach($resultadoModulos as $linhaModulos)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarModulosNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaModulos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarModulosDataInicio'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTurmas['data_inicio'];?>
                        <?php echo Funcoes::DataLeitura01($linhaModulos['data_inicio'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarModulosDataFinal'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTurmas['data_final'];?>
                        <?php echo Funcoes::DataLeitura01($linhaModulos['data_final'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarModulosCargaHoraria'] == 1){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosCargaHoraria"); ?>: 
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['carga_horaria']);?> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemMinutos"); ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarModulosDuracaoAula'] == 1){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteModulosDuracaoAula"); ?>: 
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['duracao_aula']);?> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemMinutos"); ?>
                        </div>
                    <?php } ?>

                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarModulosFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaModulos['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarModulosVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaModulos['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarModulosArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaModulos['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarModulosZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaModulos['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarModulosSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaModulos['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarModulosHistorico'] == 1){ ?>
                            [
                            <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaModulos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarModulosModulos'] == 1){ ?>
                            [
                            <a href="SiteAdmModulosIndice.php?idParentModulos=<?php echo $linhaModulos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirModulos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarModulosAulas'] == 1){ ?>
                            [
                            <a href="SiteAdmAulasIndice.php?idParentAulas=<?php echo $linhaModulos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaModulos['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirAulas"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    <?php if($GLOBALS['habilitarModulosVinculo1'] == 1){ ?>
						<?php if($linhaModulos['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configModulosVinculo1Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaModulos['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarModulosVinculo2'] == 1){ ?>
						<?php if($linhaModulos['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configModulosVinculo2Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaModulos['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarModulosVinculo3'] == 1){ ?>
						<?php if($linhaModulos['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configModulosVinculo3Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaModulos['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>  
                    <?php if($GLOBALS['habilitarModulosVinculo4'] == 1){ ?>
						<?php if($linhaModulos['id_tb_cadastro4'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configModulosVinculo4Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaModulos['id_tb_cadastro4'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro4'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro4'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro4'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>   
                    <?php if($GLOBALS['habilitarModulosVinculo5'] == 1){ ?>
						<?php if($linhaModulos['id_tb_cadastro5'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configModulosVinculo5Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaModulos['id_tb_cadastro5'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro5'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro5'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaModulos['id_tb_cadastro5'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?> 
                    
                    <?php if($GLOBALS['habilitarModulosAulas'] == 1){ ?>
                        <?php
                        //Aulas vinculadas.
						$aulasVinculadasModulo = "";
						
                        $aulasVinculadasModulo = DbFuncoes::GetCampoGenerico06("tb_aulas", 
                        "id", 
                        "id_parent", 
                        $linhaModulos['id'], 
                        "", 
                        "", 
                        1, 
                        "", 
                        "", 
                        "", 
                        "", 
                        "", 
                        "");
						
						//echo "aulasVinculadasModulo=" . $aulasVinculadasModulo . "<br />"
						?>
                        <?php if($aulasVinculadasModulo == ""){ ?>
                            <div align="center" class="TextoErro">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                            </div>
                        <?php }else{ ?>
                        	<?php
							$idParentAulas = "";
							$idsTbAulas = $aulasVinculadasModulo;
							
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
							if($idsTbAulas <> "")
							{
								$strSqlAulasSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbAulas) . ") ";
							}
							$strSqlAulasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoAulas'] . " ";
							//----------


							//Componentes parâmetros
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
                            <div id="divAulas<?php echo $linhaModulos['id'];?>" style="position: relative; display: none; margin-top: 10px;">
                                <table width="100%" class="AdmTabelaDados01">
                                  <tr class="AdmTbFundoEscuro">
                                    <?php //if($GLOBALS['habilitarAulasDataInicio'] == 1){ ?>
                                    <td width="100" class="AdmTabelaDados01Celula">
                                        <div align="center" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasDataAula"); ?>
                                        </div>
                                    </td>
                                    <?php //} ?>
                                    
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
                                    $arrAulasStatus = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 1);
                                  
                                    //Loop pelos resultados.
                                    foreach($resultadoAulas as $linhaAulas)
                                    {
                                  ?>
                                  <tr class="<?php if($countTabelaAulaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                                    <?php //if($GLOBALS['habilitarAulasDataInicio'] == 1){ ?>
                                    <td class="AdmTabelaDados01Celula">
                                        <div align="center" class="AdmTexto01">
                                            <?php //echo $linhaAulas['data_inicio'];?>
                                            <?php echo Funcoes::DataLeitura01($linhaAulas['data_aula'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                                        </div>
                                    </td>
                                    <?php //} ?>
                                                    
                                    <td class="AdmTabelaDados01Celula">
                                        <div class="AdmTexto01">
                                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>
                                        </div>
                                    </td>
                                    
                                    <td class="AdmTabelaDados01Celula">
                                        <?php if($GLOBALS['habilitarAulasGerenciar'] == 1){ ?>
                                        <div align="center" class="AdmTexto01">
                                            <a href="SiteAdmAulasAdministrar.php?idTbAulas=<?php echo $linhaAulas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linharAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciarAula"); ?>
                                            </a>
                                        </div>
                                        <?php } ?>
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
                            <?php
							//Limpeza de objetos.
							//----------
							unset($strSqlAulasSelect);
							unset($statementAulasSelect);
							unset($resultadoAulas);
							unset($linhaAulas);
							//----------
                            ?>
						<?php } ?> 
                    <?php } ?> 
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteModulosDetalhes.php?idTbModulos=<?php echo $linhaModulos['id'];?>&masterPageSiteSelect=LayoutSitePrincipal.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    
					<?php if($GLOBALS['habilitarModulosPaginasVinculosMultiplos'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmItensRelacaoRegistrosIndice.php?idItem=<?php echo $linhaModulos['id'];?>&tipoCategoria=26&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaTurmas['nome_modulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciarPaginas"); ?>
                        </a>
                    </div>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarModulosAulas'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                    	<a href="#" class="AdmLinks01" onclick="divShowHide('divAulas<?php echo $linhaModulos['id'];?>');">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelAulasIndice"); ?>
                        </a>
                    </div>
                    <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarModulosStatus'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrModulosStatus); $countArray++)
                        {
                        ?>
                        	<?php if($arrModulosStatus[$countArray][0] == $linhaModulos['id_tb_modulos_status']){ ?>
								<?php echo $arrModulosStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarModulosAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaModulos['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaModulos['id'];?>&statusAtivacao=<?php echo $linhaModulos['acesso_restrito'];?>&strTabela=tb_modulos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaModulos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaModulos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaModulos['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaModulos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaModulos['id'];?>&statusAtivacao=<?php echo $linhaModulos['ativacao'];?>&strTabela=tb_modulos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaModulos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaModulos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaModulos['ativacao'];?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmModulosEditar.php?idTbModulos=<?php echo $linhaModulos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaModulos['id'];?>" class="CampoCheckBox01" />
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
    <?php if($GLOBALS['habilitarModulosSitePaginacao'] == "1"){ ?>
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
                <?php if($GLOBALS['habilitarPaginasSitePaginacaoNumeracao'] == "1"){ ?>
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
    
        
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlModulosSelect);
unset($statementModulosSelect);
unset($resultadoModulos);
unset($linhaModulos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>