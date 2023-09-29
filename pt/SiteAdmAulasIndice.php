<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idParentAulas = $_GET["idParentAulas"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

//$idTbCadastro1 = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "SiteAdmAulasIndice.php";
$paginaRetornoExclusao = "SiteAdmAulasEditar.php";
$variavelRetorno = "idParentAulas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarAulasSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configAulasSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_aulas", "id_parent", $idParentAulas); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentAulas=" . $idParentAulas . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


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

//Paginação (subquery).
if($GLOBALS['habilitarAulasSitePaginacao'] == "1"){
	$strSqlAulasSelect .= ", (SELECT COUNT(id) ";
	$strSqlAulasSelect .= "FROM tb_aulas ";
	$strSqlAulasSelect .= "WHERE id <> 0 ";
	if($idParentAulas <> "")
	{
		$strSqlAulasSelect .= "AND id_parent = :id_parent ";
	}
	if($palavraChave <> "")
	{
		$strSqlAulasSelect .= "AND (tema LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlAulasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR url4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR url5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAulasSelect .= ") ";
	}
	$strSqlAulasSelect .= ") totalRegistros ";
}

$strSqlAulasSelect .= "FROM tb_aulas ";
$strSqlAulasSelect .= "WHERE id <> 0 ";
if($idParentAulas <> "")
{
	$strSqlAulasSelect .= "AND id_parent = :id_parent ";
}
if($palavraChave <> "")
{
	$strSqlAulasSelect .= "AND (tema LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlAulasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR url4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR url5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAulasSelect .= ") ";
}

$strSqlAulasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoAulas'] . " ";

//Paginação.
if($GLOBALS['habilitarAulasSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlAulasSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
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


//Paginação.
if($GLOBALS['habilitarAulasSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoAulas[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelAulasIndice");
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

        <form name="formAulasAcoes" id="formAulasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_aulas" />
            <input name="idParentAulas" id="idParentAulas" type="hidden" value="<?php echo $idParentAulas; ?>" />

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
              	<?php if($GLOBALS['habilitarAulasNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
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
                
                <?php if($GLOBALS['habilitarAulasStatus'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                                
                <?php if($GLOBALS['habilitarAulasAcessoRestrito'] == 1){ ?>
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
			  	$arrAulasStatus = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 1);
			  
                //Loop pelos resultados.
                foreach($resultadoAulas as $linhaAulas)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarAulasNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaAulas['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
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
                    
					<?php if($linhaAulas['local'] <> ""){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasLocal"); ?>: 
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['local']);?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarAulasCargaHoraria'] == 1){ ?>
                        <div class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasCargaHoraria"); ?>: 
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['carga_horaria']);?> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemMinutos"); ?>
                        </div>
                    <?php } ?>

                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarAulasFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaAulas['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarAulasVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaAulas['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarAulasArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaAulas['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarAulasZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaAulas['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarAulasSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaAulas['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarAulasHistorico'] == 1){ ?>
                            [
                            <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaAulas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarAulasVinculo1'] == 1){ ?>
						<?php if($linhaAulas['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configAulasVinculo1Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaAulas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAulasVinculo2'] == 1){ ?>
						<?php if($linhaAulas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configAulasVinculo2Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaAulas['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAulasVinculo3'] == 1){ ?>
						<?php if($linhaAulas['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configAulasVinculo3Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaAulas['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>  
                    <?php if($GLOBALS['habilitarAulasVinculo4'] == 1){ ?>
						<?php if($linhaAulas['id_tb_cadastro4'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configAulasVinculo4Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaAulas['id_tb_cadastro4'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro4'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro4'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro4'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>   
                    <?php if($GLOBALS['habilitarAulasVinculo5'] == 1){ ?>
						<?php if($linhaAulas['id_tb_cadastro5'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configAulasVinculo5Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaAulas['id_tb_cadastro5'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro5'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro5'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaAulas['id_tb_cadastro5'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>                    
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteAulasDetalhes.php?idTbAulas=<?php echo $linhaAulas['id'];?>&masterPageSiteSelect=LayoutSitePrincipal.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    
					<?php if($GLOBALS['habilitarAulasGerenciar'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmAulasAdministrar.php?idTbAulas=<?php echo $linhaAulas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linharAulas['tema']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciarAula"); ?>
                        </a>
                    </div>
                    <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarAulasStatus'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrAulasStatus); $countArray++)
                        {
                        ?>
                        	<?php if($arrAulasStatus[$countArray][0] == $linhaAulas['id_tb_aulas_status']){ ?>
								<?php echo $arrAulasStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarAulasAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaAulas['acesso_restrito'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaAulas['id'];?>&statusAtivacao=<?php echo $linhaAulas['acesso_restrito'];?>&strTabela=tb_aulas&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaAulas['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaAulas['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaAulas['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaAulas['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaAulas['id'];?>&statusAtivacao=<?php echo $linhaAulas['ativacao'];?>&strTabela=tb_aulas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaAulas['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaAulas['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaAulas['ativacao'];?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmAulasEditar.php?idTbAulas=<?php echo $linhaAulas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaAulas['id'];?>" class="CampoCheckBox01" />
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
    <?php if($GLOBALS['habilitarAulasSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarPaginasSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
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
    
    
    <?php if(!empty($idParentAulas)){ ?>
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
			$('#formAulas').validate({ //Inicialização do plug-in.
			
			
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
					},
					carga_horaria: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
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
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					carga_horaria: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
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
    <form name="formAulas" id="formAulas" action="SiteAdmAulasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasTbAulas"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarAulasVinculo1'] == 1){ ?>
				<?php if($idTbCadastro1 == ""){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo htmlentities($GLOBALS['configAulasVinculo1Nome']); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrAulasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo1'], $GLOBALS['configIdTbTipoAulasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo1'], $GLOBALS['configAulasVinculo1Metodo']);
                            ?>
                            <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasVinculo1); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasVinculo1[$countArray][0];?>"><?php echo $arrAulasVinculo1[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php }else{ ?>
                    <input name="id_tb_cadastro1" type="hidden" id="id_tb_cadastro1" value="<?php echo $idTbCadastro1; ?>" />
                <?php } ?>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo2'], $GLOBALS['configIdTbTipoAulasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo2'], $GLOBALS['configAulasVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo2[$countArray][0];?>"><?php echo $arrAulasVinculo2[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo3'], $GLOBALS['configIdTbTipoAulasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo3'], $GLOBALS['configAulasVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo3[$countArray][0];?>"><?php echo $arrAulasVinculo3[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo4Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo4'], $GLOBALS['configIdTbTipoAulasVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo4'], $GLOBALS['configAulasVinculo4Metodo']);
                        ?>
                        <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo4); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo4[$countArray][0];?>"><?php echo $arrAulasVinculo4[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo5Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo5 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo5'], $GLOBALS['configIdTbTipoAulasVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo5'], $GLOBALS['configAulasVinculo5Metodo']);
                        ?>
                        <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo5); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo5[$countArray][0];?>"><?php echo $arrAulasVinculo5[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasDataAula"); ?>:
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
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_aula;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_distribuicao";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_aula;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_aula" id="data_aula" class="AdmCampoData01" maxlength="10" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
                                    
            <?php if($GLOBALS['habilitarAulasData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasData1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoAulasData1'] == 1){ ?>
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
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasTema"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula"<?php if($GLOBALS['habilitarAulasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="tema" id="tema" class="AdmCampoAdmTexto01" maxlength="255" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarAulasNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 AdmTabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasDescricao"); ?>:
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
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasLocal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="local" id="local" class="AdmCampoAdmTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarAulasStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasStatus = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 1);
                        ?>
                        <select name="id_tb_aulas_status" id="id_tb_aulas_status" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasStatus[$countArray][0];?>"><?php echo $arrAulasStatus[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasPalavrasChave'] == 1){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasValor"); ?>:
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
            
            <?php if($GLOBALS['habilitarAulasCargaHoraria'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasCargaHoraria"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="carga_horaria" id="carga_horaria" class="CampoNumerico01" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasCargaHorariaInstrucoesM"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasAnotacoesInternas"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<textarea name="anotacoes_internas" id="anotacoes_internas" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico01[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico01[]" name="idsAulasFiltroGenerico01[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico01[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico01[]" name="idsAulasFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico01[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico01)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico02[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico02[]" name="idsAulasFiltroGenerico02[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico02[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico02[]" name="idsAulasFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico02[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico02)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico03[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico03[]" name="idsAulasFiltroGenerico03[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico03[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico03[]" name="idsAulasFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico03[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico03)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico04[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico04[]" name="idsAulasFiltroGenerico04[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico04[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico04[]" name="idsAulasFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico04[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico04)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico05[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico05[]" name="idsAulasFiltroGenerico05[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico05[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico05[]" name="idsAulasFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico05[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico05)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico06[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico06[]" name="idsAulasFiltroGenerico06[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico06[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico06[]" name="idsAulasFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico06[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico06)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico07[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico07[]" name="idsAulasFiltroGenerico07[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico07[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico07[]" name="idsAulasFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico07[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico07)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico08[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico08[]" name="idsAulasFiltroGenerico08[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico08[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico08[]" name="idsAulasFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico08[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico08)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico09[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico09[]" name="idsAulasFiltroGenerico09[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico09[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico09[]" name="idsAulasFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico09[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico09)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico10[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico10[]" name="idsAulasFiltroGenerico10[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico10[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico10[]" name="idsAulasFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico10[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico10)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico11Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico11[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico11[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico11[]" name="idsAulasFiltroGenerico11[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico11[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico11[]" name="idsAulasFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico11[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico11)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico12Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 23);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico12[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico12[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico12[]" name="idsAulasFiltroGenerico12[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico12[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico12[]" name="idsAulasFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico12[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico12)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico13Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 24);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico13[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico13[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico13[]" name="idsAulasFiltroGenerico13[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico13[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico13[]" name="idsAulasFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico13[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico13)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico14Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico14[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico14[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico14[]" name="idsAulasFiltroGenerico14[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico14[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico14[]" name="idsAulasFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico14[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico14)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico15Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico15[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico15[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico15[]" name="idsAulasFiltroGenerico15[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico15[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico15[]" name="idsAulasFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico15[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico15)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico16Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico16[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico16[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico16[]" name="idsAulasFiltroGenerico16[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico16); $countArray++)
                                {

                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico16[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico16[]" name="idsAulasFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico16[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico16)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico17Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico17[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico17[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico17[]" name="idsAulasFiltroGenerico17[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico17[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico17[]" name="idsAulasFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico17[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico17)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico18Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico18[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico18[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico18[]" name="idsAulasFiltroGenerico18[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico18[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico18[]" name="idsAulasFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico18[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico18)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico19Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico19[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico19[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico19[]" name="idsAulasFiltroGenerico19[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico19[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico19[]" name="idsAulasFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico19[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico19)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico20Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico20[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico20[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrAulasFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico20[]" name="idsAulasFiltroGenerico20[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico20[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico20CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico20[]" name="idsAulasFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico20[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico20)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <?php if($GLOBALS['habilitarAulasURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasURL1Titulo']); ?>:
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
            
            <?php if($GLOBALS['habilitarAulasReposicao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasReposicao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="reposicao" id="reposicao" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNao"); ?></option>
                            <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSim"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc1'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc2'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc3'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc4'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc5'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc6'] == 1){ ?>

                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc6'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc2'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc8'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc9'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc10'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc11'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc12'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc13'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc14'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc15'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc16']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc16'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc17']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc12'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc18']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc18'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc19']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc19'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc20']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc20'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc21']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc21'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc22']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc22'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc23']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc23'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc24']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc24'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc25']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc25'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc26']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc26'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc27']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc22'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc28']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc28'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc29']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc29'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc30']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc30'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc31']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc31'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc32']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc32'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc33']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc33'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc34']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc34'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc35']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc35'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc36']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc36'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc37']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc37'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc38']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc38'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc39']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc39'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc40']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc40'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc41']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc41'] == 1){ ?>
                            <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc41'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc42']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc42'] == 1){ ?>
                            <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc42'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc43']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc43'] == 1){ ?>
                            <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc43'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc44']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc44'] == 1){ ?>
                            <input type="text" name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc44'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc45']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc45'] == 1){ ?>
                            <input type="text" name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc45'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc46']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc46'] == 1){ ?>
                            <input type="text" name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc46'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc47']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc47'] == 1){ ?>
                            <input type="text" name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc42'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc48']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc48'] == 1){ ?>
                            <input type="text" name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc48'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc49']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc49'] == 1){ ?>
                            <input type="text" name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc49'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc50']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc50'] == 1){ ?>
                            <input type="text" name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc50'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc51']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc51'] == 1){ ?>
                            <input type="text" name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc51'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc52']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc52'] == 1){ ?>
                            <input type="text" name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc52'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc53']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc53'] == 1){ ?>
                            <input type="text" name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc53'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc54']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc54'] == 1){ ?>
                            <input type="text" name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc54'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc55']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc55'] == 1){ ?>
                            <input type="text" name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc55'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc56']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc56'] == 1){ ?>
                            <input type="text" name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc56'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarAulasIc57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc57']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc57'] == 1){ ?>
                            <input type="text" name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc52'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc58']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc58'] == 1){ ?>
                            <input type="text" name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc58'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc59']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc59'] == 1){ ?>
                            <input type="text" name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc59'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarAulasIc60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc60']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc60'] == 1){ ?>
                            <input type="text" name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoAdmTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc60'] == 2){ ?>
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
                
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParentAulas; ?>" />
                <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="0" />
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
unset($strSqlAulasSelect);
unset($statementAulasSelect);
unset($resultadoAulas);
unset($linhaAulas);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>