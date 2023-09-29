<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
//$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
//$idTbCadastroUsuario = $idTbCadastroLogado;

$idParentVeiculos = $_GET["idParentVeiculos"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}


$dataPublicacaoOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");

$palavraChave = $_GET["palavraChave"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmVeiculosIndice.php";
$paginaRetornoExclusao = "SiteAdmVeiculosEditar.php";
$variavelRetorno = "idParentVeiculos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarVeiculosSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configVeiculosSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_veiculos", "id_parent", $idParentVeiculos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentVeiculos=" . $idParentVeiculos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlVeiculosSelect = "";
$strSqlVeiculosSelect .= "SELECT ";
//$strSqlVeiculosSelect .= "* ";
$strSqlVeiculosSelect .= "id, ";
$strSqlVeiculosSelect .= "id_tb_categorias, ";
$strSqlVeiculosSelect .= "id_tb_cadastro_usuario, ";
$strSqlVeiculosSelect .= "modalidade, ";
$strSqlVeiculosSelect .= "data_publicacao, ";

$strSqlVeiculosSelect .= "data1, ";
$strSqlVeiculosSelect .= "data2, ";
$strSqlVeiculosSelect .= "data3, ";
$strSqlVeiculosSelect .= "data4, ";
$strSqlVeiculosSelect .= "data5, ";
$strSqlVeiculosSelect .= "data6, ";
$strSqlVeiculosSelect .= "data7, ";
$strSqlVeiculosSelect .= "data8, ";
$strSqlVeiculosSelect .= "data9, ";
$strSqlVeiculosSelect .= "data10, ";

$strSqlVeiculosSelect .= "codigo, ";
$strSqlVeiculosSelect .= "n_classificacao, ";
$strSqlVeiculosSelect .= "veiculo, ";
$strSqlVeiculosSelect .= "descricao, ";
$strSqlVeiculosSelect .= "portas, ";
$strSqlVeiculosSelect .= "kilometragem, ";
$strSqlVeiculosSelect .= "placa, ";
$strSqlVeiculosSelect .= "ano_fabricacao, ";
$strSqlVeiculosSelect .= "ano_modelo, ";

$strSqlVeiculosSelect .= "id_tb_cadastro1, ";
$strSqlVeiculosSelect .= "id_tb_cadastro2, ";
$strSqlVeiculosSelect .= "id_tb_cadastro3, ";
$strSqlVeiculosSelect .= "id_tb_cadastro4, ";
$strSqlVeiculosSelect .= "id_tb_cadastro5, ";

$strSqlVeiculosSelect .= "informacao_complementar1, ";
$strSqlVeiculosSelect .= "informacao_complementar2, ";
$strSqlVeiculosSelect .= "informacao_complementar3, ";
$strSqlVeiculosSelect .= "informacao_complementar4, ";
$strSqlVeiculosSelect .= "informacao_complementar5, ";
$strSqlVeiculosSelect .= "informacao_complementar6, ";
$strSqlVeiculosSelect .= "informacao_complementar7, ";
$strSqlVeiculosSelect .= "informacao_complementar8, ";
$strSqlVeiculosSelect .= "informacao_complementar9, ";
$strSqlVeiculosSelect .= "informacao_complementar10, ";
$strSqlVeiculosSelect .= "informacao_complementar11, ";
$strSqlVeiculosSelect .= "informacao_complementar12, ";
$strSqlVeiculosSelect .= "informacao_complementar13, ";
$strSqlVeiculosSelect .= "informacao_complementar14, ";
$strSqlVeiculosSelect .= "informacao_complementar15, ";
$strSqlVeiculosSelect .= "informacao_complementar16, ";
$strSqlVeiculosSelect .= "informacao_complementar17, ";
$strSqlVeiculosSelect .= "informacao_complementar18, ";
$strSqlVeiculosSelect .= "informacao_complementar19, ";
$strSqlVeiculosSelect .= "informacao_complementar20, ";
$strSqlVeiculosSelect .= "informacao_complementar21, ";
$strSqlVeiculosSelect .= "informacao_complementar22, ";
$strSqlVeiculosSelect .= "informacao_complementar23, ";
$strSqlVeiculosSelect .= "informacao_complementar24, ";
$strSqlVeiculosSelect .= "informacao_complementar25, ";
$strSqlVeiculosSelect .= "informacao_complementar26, ";
$strSqlVeiculosSelect .= "informacao_complementar27, ";
$strSqlVeiculosSelect .= "informacao_complementar28, ";
$strSqlVeiculosSelect .= "informacao_complementar29, ";
$strSqlVeiculosSelect .= "informacao_complementar30, ";
$strSqlVeiculosSelect .= "informacao_complementar31, ";
$strSqlVeiculosSelect .= "informacao_complementar32, ";
$strSqlVeiculosSelect .= "informacao_complementar33, ";
$strSqlVeiculosSelect .= "informacao_complementar34, ";
$strSqlVeiculosSelect .= "informacao_complementar35, ";
$strSqlVeiculosSelect .= "informacao_complementar36, ";
$strSqlVeiculosSelect .= "informacao_complementar37, ";
$strSqlVeiculosSelect .= "informacao_complementar38, ";
$strSqlVeiculosSelect .= "informacao_complementar39, ";
$strSqlVeiculosSelect .= "informacao_complementar40, ";

$strSqlVeiculosSelect .= "id_db_cep_tblBairros, ";
$strSqlVeiculosSelect .= "id_db_cep_tblCidades, ";
$strSqlVeiculosSelect .= "id_db_cep_tblLogradouros, ";
$strSqlVeiculosSelect .= "id_db_cep_tblUF, ";

$strSqlVeiculosSelect .= "veiculo_endereco, ";
$strSqlVeiculosSelect .= "veiculo_endereco_numero, ";
$strSqlVeiculosSelect .= "veiculo_endereco_complemento, ";
$strSqlVeiculosSelect .= "veiculo_bairro, ";
$strSqlVeiculosSelect .= "veiculo_cidade, ";
$strSqlVeiculosSelect .= "veiculo_estado, ";
$strSqlVeiculosSelect .= "veiculo_pais, ";
$strSqlVeiculosSelect .= "veiculo_cep, ";

$strSqlVeiculosSelect .= "contato, ";
$strSqlVeiculosSelect .= "email, ";
$strSqlVeiculosSelect .= "link_externo, ";

$strSqlVeiculosSelect .= "url1, ";
$strSqlVeiculosSelect .= "url2, ";
$strSqlVeiculosSelect .= "url3, ";
$strSqlVeiculosSelect .= "url4, ";
$strSqlVeiculosSelect .= "url5, ";

$strSqlVeiculosSelect .= "url_amigavel, ";
$strSqlVeiculosSelect .= "palavras_chave, ";

$strSqlVeiculosSelect .= "valor, ";
$strSqlVeiculosSelect .= "valor1, ";
$strSqlVeiculosSelect .= "valor2, ";

$strSqlVeiculosSelect .= "ativacao, ";
$strSqlVeiculosSelect .= "ativacao1, ";
$strSqlVeiculosSelect .= "ativacao2, ";
$strSqlVeiculosSelect .= "ativacao3, ";
$strSqlVeiculosSelect .= "ativacao4, ";
$strSqlVeiculosSelect .= "ativacao_promocao, ";
$strSqlVeiculosSelect .= "ativacao_home, ";
$strSqlVeiculosSelect .= "ativacao_home_categoria, ";
$strSqlVeiculosSelect .= "ativacao_info_cadastro, ";
$strSqlVeiculosSelect .= "acesso_restrito, ";
$strSqlVeiculosSelect .= "id_tb_veiculos_status, ";

$strSqlVeiculosSelect .= "imagem, ";
$strSqlVeiculosSelect .= "arquivo1, ";
$strSqlVeiculosSelect .= "arquivo2, ";
$strSqlVeiculosSelect .= "arquivo3, ";
$strSqlVeiculosSelect .= "arquivo4, ";
$strSqlVeiculosSelect .= "arquivo5, ";

$strSqlVeiculosSelect .= "anotacoes_internas, ";
$strSqlVeiculosSelect .= "n_visitas ";

//Paginação (subquery).
if($GLOBALS['habilitarVeiculosSitePaginacao'] == "1"){
	$strSqlVeiculosSelect .= ", (SELECT COUNT(id) ";
	$strSqlVeiculosSelect .= "FROM tb_veiculos ";
	$strSqlVeiculosSelect .= "WHERE id <> 0 ";
	if($idParentVeiculos <> "")
	{
		$strSqlVeiculosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($idTbCadastroUsuario <> "")
	{
		$strSqlVeiculosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
	}
	if($palavraChave <> "")
	{
		$strSqlVeiculosSelect .= "AND (veiculo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlVeiculosSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= ") ";
	}
	$strSqlVeiculosSelect .= ") totalRegistros ";
}

$strSqlVeiculosSelect .= "FROM tb_veiculos ";
$strSqlVeiculosSelect .= "WHERE id <> 0 ";
if($idParentVeiculos <> "")
{
	$strSqlVeiculosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idTbCadastroUsuario <> "")
{
	$strSqlVeiculosSelect .= "AND id_tb_cadastro_usuario = :id_tb_cadastro_usuario ";
}
if($palavraChave <> "")
{
		$strSqlVeiculosSelect .= "AND (veiculo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlVeiculosSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlVeiculosSelect .= ") ";
}

$strSqlVeiculosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoVeiculos'] . " ";

//Paginação.
if($GLOBALS['habilitarVeiculosSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlVeiculosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementVeiculosSelect = $dbSistemaConPDO->prepare($strSqlVeiculosSelect);

if ($statementVeiculosSelect !== false)
{
	/*
	$statementVeiculosSelect->execute(array(
		"id_tb_categorias" => $idParentVeiculos
	));
	*/
	if($idParentVeiculos <> "")
	{
		$statementVeiculosSelect->bindParam(':id_tb_categorias', $idParentVeiculos, PDO::PARAM_STR);
	}
	if($idTbCadastroUsuario <> "")
	{
		$statementVeiculosSelect->bindParam(':id_tb_cadastro_usuario', $idTbCadastroUsuario, PDO::PARAM_STR);
	}
	$statementVeiculosSelect->execute();
}
//----------

//$resultadoVeiculos = $dbSistemaConPDO->query($strSqlVeiculosSelect);
$resultadoVeiculos = $statementVeiculosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarVeiculosSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoVeiculos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentVeiculos <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentVeiculos, "tb_categorias", "categoria");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaPalavrasChave .= $tituloLinkAtual . ", ";

if(!empty($resultadoVeiculos))
{
	//Loop pelos resultados.
	foreach($resultadoVeiculos as $linhaVeiculos)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']) . ", ";
		//echo "loop=" . $linhaVeiculos['produto'] . "<br />";
	}
}

//Retirada da vírgula do final.
if($metaDescricao <> "")
{
	$metaDescricao = substr($metaDescricao, 0, strlen($metaDescricao) - 2);
}
if($metaPalavrasChave <> "")
{
	$metaPalavrasChave = substr($metaPalavrasChave, 0, strlen($metaPalavrasChave) - 2);
}

//Retirada de código HTML.
$metaDescricao = Funcoes::RemoverHTML01($metaDescricao);
$metaPalavrasChave = Funcoes::RemoverHTML01($metaPalavrasChave);
//$metaPalavrasChave = strip_tags($metaPalavrasChave);

//Limitação de caractéres.
$metaTitulo = Funcoes::LimitadorCatecteres($metaTitulo, 60);
$metaDescricao = Funcoes::LimitadorCatecteres($metaDescricao, 160);
$metaPalavrasChave = Funcoes::LimitadorCatecteres($metaPalavrasChave, 100);
//----------


//Verificação de erro - debug.
//echo "metaTitulo=" . $metaTitulo . "<br />";
//echo "metaPalavrasChave=" . $metaPalavrasChave . "<br />";
//echo "strSqlVeiculosSelect=" . $strSqlVeiculosSelect . "<br />";
//echo "codProduto=" . $codProduto . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; //Verificar acentuação. ?>
	<?php //echo Funcoes::ConteudoMascaraLeitura($metaTitulo); //Verificar acentuação. ?>
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
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
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
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>
    
    <?php
	if (empty($resultadoVeiculos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemVeiculosVazio"); ?>
        </div>
    <?php
    }else{
    ?>
		<?php //Diagramação 1.?>
        <?php //**************************************************************************************?>
        <div align="center" style="position: relative; display: block; overflow: hidden;">
              <?php
				$countTabelaFundo = 0;
				
				
                //Loop pelos resultados.
                foreach($resultadoVeiculos as $linhaVeiculos)
                {
              ?>
                <div class="VeiculosIndiceContainer">
                    <?php //Título.?>
                    <h2 style="/*position: absolute;*/ display:inline; margin: 0px; padding: 0px; font-size: inherit; float: left;">
                        <div class="VeiculosIndiceTituloFundo">
                            <a href="SiteVeiculosDetalhes.php?idTbVeiculos=<?php echo $linhaVeiculos['id']; ?>" class="VeiculosIndiceTitulo">
                                <?php if($GLOBALS['configVeiculosTituloLimiteCaracteres'] == 0){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>
                                <?php }else{ ?>
                                    <?php //echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['produto']);?>
                                    <?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo'])), $GLOBALS['configVeiculosTituloLimiteCaracteres']);?>
                                    <?php if(strlen(Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo'])), $GLOBALS['configVeiculosTituloLimiteCaracteres'])) > $GLOBALS['configVeiculosTituloLimiteCaracteres']){ ?>
                                        ...
									<?php } ?>
                                <?php } ?>
                                
                                
                                <?php
                                    //Obs: acertar lógina da função GetCampoGenerico06.
                                    //"&idsTbVeiculosComplemento=" & DbFuncoes.GetCampoGenerico06("tb_veiculos_relacao_complemento", "id_tb_veiculos_complemento", "id_tb_veiculos", Eval("id"), tipoRetorno:=2, strCampoComplementar1Referencia:="tipo_complemento", strCampoComplementar1Valor:="2") 
                                    //"&idParentVeiculos=" & Eval("id_tb_categorias")
                                ?>
                            </a>
                        </div>
                    </h2>
        
                    <?php //Imagem.?>
                    <?php if(!empty($linhaVeiculos['imagem'])){ ?>
                        <div class="VeiculosImagemIndice">
                            <?php //Sem pop-up. ?>
                            <?php //if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <a href="SiteVeiculosDetalhes.php?idTbVeiculos=<?php echo $linhaVeiculos['id']; ?>">
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaVeiculos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']); ?>" />
                                </a>
                            <?php //} ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['configVeiculosImagemPlaceholder'] == 1){ ?>
                        <?php if(empty($linhaVeiculos['imagem'])){ ?>
                            <div class="VeiculosImagemIndice">
                            	<?php //OBS: fazer função para resgatar a dimensão (w e h).?>
                                <table bgcolor="#ccc" width="<?php echo $GLOBALS['$arrImagemVeiculos'][2][1];?>" height="<?php echo $GLOBALS['$arrImagemVeiculos'][2][2];?>" border="0" cellspacing="0">
                                  <tr align="center" valign="middle">
                                    <td>
                                        <a href="SiteVeiculosDetalhes.php?idTbVeiculos=<?php echo $linhaVeiculos['id']; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>icone_imgem01.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']); ?>" /></a>
                                        <br />
                                        <br />
                                        <div class="AdmTexto01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemImagemPlaceholder");?>
                                        </div>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php //if($GLOBALS['habilitarVeiculosDescricao01'] == 1){ ?>
                        <div class="VeiculosIndiceConteudo">
                            <?php if($GLOBALS['configVeiculosDescricaoLimiteCaracteres'] == 0){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['descricao']);?>
                            <?php }else{ ?>
								<?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaVeiculos['descricao'])), $GLOBALS['configVeiculosDescricaoLimiteCaracteres']);?>
                                <?php if(strlen(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaVeiculos['descricao']))) > $GLOBALS['configVeiculosDescricaoLimiteCaracteres']){ ?>
                                    ...
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php //} ?>
                    
                    <?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                        <div class="VeiculosIndiceValor">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosValor");?>: 
                            </strong>
                        
                            <?php if($linhaVeiculos['valor'] > 0){ ?>
                                <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                <?php echo Funcoes::mascaraValorLer($linhaVeiculos['valor']);?>
                            <?php }else{ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosValor0");?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php //Detalhes.?>
                    <div style="position: relative; display: block;">
                        <a href="SiteVeiculosDetalhes.php?idTbVeiculos=<?php echo $linhaVeiculos['id']; ?>">
                            <img src="img/btoDetalhesVeiculos.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes");?>" />
                        </a>
                    </div>
                    
                    <?php //Informações complementares.?>
                    <div class="VeiculosIndiceConteudo">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDataPublicacao");?>: 
                        <?php echo Funcoes::DataLeitura01($linhaVeiculos['data_publicacao'], $GLOBALS['configSiteFormatoData'], "1");?>
                        
                        <?php if($GLOBALS['habilitarVeiculosIc1'] == 1){ ?>
                            <?php if($linhaVeiculos['informacao_complementar1'] <> ""){ ?>
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc1'], "IncludeConfig");?>: 
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['informacao_complementar1']);?>
                                <br />
                            <?php } ?>
                        <?php } ?>
                    </div>
        
                    <?php if($GLOBALS['habilitarVeiculosStatus'] == 1){ ?>
                        <div align="left" class="VeiculosIndiceConteudo">
                            <?php if($linhaVeiculos['id_tb_veiculos_status'] <> 0){ ?>
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosStatus");?>: 
                                </strong>
                                <?php echo DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_veiculos_status'], "tb_veiculos_complemento", "complemento");?>
                                <br />
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <div class="VeiculosSeparador1">
        
                    </div>
                </div>
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
        </div>
        <?php //**************************************************************************************?>
	<?php } ?>


	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarVeiculosSitePaginacao'] == "1"){ ?>

		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarVeiculosSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
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
unset($strSqlVeiculosSelect);
unset($statementVeiculosSelect);
unset($resultadoVeiculos);
unset($linhaVeiculos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>