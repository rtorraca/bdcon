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
$idParentVeiculos = $_GET["idParentVeiculos"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroUsuario = $idTbCadastroLogado;

$dataPublicacaoOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");

$palavraChave = $_GET["palavraChave"];

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
if($idTbCadastroUsuario <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelVeiculosGerenciamento");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "strSqlVeiculosSelect=" . $strSqlVeiculosSelect . "<br />";
//echo "idParentVeiculos=" . $idParentVeiculos . "<br />";
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
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
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

        <form name="formVeiculosAcoes" id="formVeiculosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tb_veiculos" />
            <input type="hidden" id="idParentVeiculos" name="idParentVeiculos" value="<?php echo $idParentVeiculos; ?>" />

            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left; display: none;">
                        <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemClassificacaoPadrao"); ?>
                        </a>
                    </div>
                <?php } ?>
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01" style="table-layout: auto;">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarVeiculosNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarVeiculosVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosVisualizacaoData'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDataPublicacao"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=veiculo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculo"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculo"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoPromocoes'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao_promocao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoPromocoes"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoPromocoes"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoHome'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao_home<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoHome"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoHome"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoCategoria'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao_home_categoria<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoHomeCategoria"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoHomeCategoria"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoAcesso'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;
				
				
                //Loop pelos resultados.
                foreach($resultadoVeiculos as $linhaVeiculos)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarVeiculosNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaVeiculos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarVeiculosVisualizacaoImagem'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(!empty($linhaVeiculos['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaVeiculos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaVeiculos['imagem'];?>" rel="lightbox" title="">
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaVeiculos['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosVisualizacaoData'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaVeiculos['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaVeiculos['data_publicacao'], $GLOBALS['configSiteFormatoData'], "1");?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>
                    </div>
                    <div class="AdmTexto01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade"); ?>: 
                        </strong>
						<?php if($linhaVeiculos['modalidade'] == 0){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade0"); ?>
                        <?php } ?>
						<?php if($linhaVeiculos['modalidade'] == 1){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade1"); ?>
                        <?php } ?>
						<?php if($linhaVeiculos['modalidade'] == 2){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade2"); ?>
                        <?php } ?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosValor"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaVeiculos['valor'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarVeiculosValor1'] == 1){ ?>
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Moeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaVeiculos['valor1'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarVeiculosValor2'] == 1){ ?>
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Moeda'], "IncludeConfig"); ?>
                            <?php echo Funcoes::MascaraValorLer($linhaVeiculos['valor2'], $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarVeiculosFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosConteudo'] == 1){ ?>
                            [
                            <a href="SiteAdmConteudoIndice.php?idParentConteudo=<?php echo $linhaVeiculos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirConteudo"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarVeiculosHistorico'] == 1){ ?>
                            [
                            <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                            </a>
                            ] 
                        <?php } ?>
						<?php if($GLOBALS['habilitarVeiculosTarefas'] == 1){ ?>
                            [
                            <a href="SiteAdmTarefasIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirTarefas"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
					<?php if($idTbCadastroUsuario == ""){ ?>
						<?php if($GLOBALS['habilitarVeiculosCadastroUsuario'] == 1){ ?>
                            <div class="AdmTexto01">
                                <?php if($linhaVeiculos['id_tb_cadastro_usuario'] <> 0){ ?>
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosCadastroUsuario"); ?>:  
                                    </strong>
                                    <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaVeiculos['id_tb_cadastro_usuario'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                        <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                        <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
                                        DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                        DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                        1)); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
					<?php } ?>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteVeiculosDetalhes.php?idTbVeiculos=<?php echo $linhaVeiculos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaVeiculos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao'];?>&strTabela=tb_veiculos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaVeiculos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoPromocoes'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['ativacao_promocao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao_promocao'];?>&strTabela=tb_veiculos&strCampo=ativacao_promocao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaVeiculos['ativacao_promocao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao_promocao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoHome'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['ativacao_home'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao_home'];?>&strTabela=tb_veiculos&strCampo=ativacao_home<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaVeiculos['ativacao_home'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao_home'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoCategoria'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['ativacao_home_categoria'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao_home_categoria'];?>&strTabela=tb_veiculos&strCampo=ativacao_home_categoria<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaVeiculos['ativacao_home_categoria'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao_home_categoria'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoAcesso'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['acesso_restrito'];?>&strTabela=tb_veiculos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaVeiculos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaVeiculos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaVeiculos['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmVeiculosEditar.php?idTbVeiculos=<?php echo $linhaVeiculos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaVeiculos['id'];?>" class="AdmAdmCampoCheckBox01" />
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
    
    
    <?php if(!empty($idParentVeiculos)){ ?>
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
			$('#formVeiculos').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "AdmErro",
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
					valor1: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor2: {
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
					},
					valor1: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor2: {
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
    
    <form name="formVeiculos" id="formVeiculos" action="SiteAdmVeiculosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosTbVeiculos"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
			<?php if($idTbCadastroUsuario == ""){ ?>
				<?php if($GLOBALS['habilitarVeiculosCadastroUsuario'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrVeiculosUsuario = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVeiculosUsuario'], $GLOBALS['configIdTbTipoCadastroVeiculosUsuario'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVeiculosUsuario'], $GLOBALS['configVeiculosCadastroUsuarioMetodo']);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosUsuario[$countArray][0];?>"><?php echo $arrVeiculosUsuario[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            <?php }else{ ?>
            	<input type="hidden" id="id_tb_cadastro_usuario" name="id_tb_cadastro_usuario" value="<?php echo $idTbCadastroUsuario;?>" />
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarVeiculosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <select name="modalidade" id="modalidade" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade0"); ?></option>
                            <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade1"); ?></option>
                            <option value="2" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade2"); ?></option>
                        </select>
                    </div>
                </td>
				<?php if($GLOBALS['habilitarVeiculosNClassificacao'] == 1){ ?>
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
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDataPublicacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_publicacao" id="data_publicacao" class="AdmCampoData01" maxlength="10" value="<?php echo $dataPublicacaoOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
                
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="codigo" id="codigo" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData1'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosData2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData2'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data2" id="data2" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData3'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data3" id="data3" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData4'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data4" id="data4" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData5'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data5" id="data5" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData6'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data6" id="data6" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData7'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data7" id="data7" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData8'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data8" id="data8" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData9'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data9" id="data9" class="AdmCampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosData10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData10'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data10" id="data10" class="AdmCampoData01" maxlength="10" />
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
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<input type="text" name="veiculo" id="veiculo" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosTipo'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosTipo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<?php 
						$arrVeiculosTipo = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 2);
						?>
                        
                        <?php 
						for($countArray = 0; $countArray < count($arrVeiculosTipo); $countArray++)
						{
						?>
                        	<div>
                                <input name="idsVeiculosTipo[]" type="checkbox" value="<?php echo $arrVeiculosTipo[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosTipo[$countArray][1];?>
                            </div>
                        <?php 
						}
						?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico01[]" name="idsVeiculosFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico01[]" name="idsVeiculosFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico02[]" name="idsVeiculosFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico02[]" name="idsVeiculosFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico03[]" name="idsVeiculosFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico03[]" name="idsVeiculosFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico04[]" name="idsVeiculosFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico04[]" name="idsVeiculosFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico05[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico05[]" name="idsVeiculosFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico05[]" name="idsVeiculosFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico06[]" name="idsVeiculosFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico06[]" name="idsVeiculosFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico07[]" name="idsVeiculosFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico07[]" name="idsVeiculosFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico08[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico08[]" name="idsVeiculosFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico08[]" name="idsVeiculosFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico09[]" name="idsVeiculosFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico09[]" name="idsVeiculosFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico11[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico11[]" name="idsVeiculosFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico11[]" name="idsVeiculosFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 23);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico12[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico12[]" name="idsVeiculosFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico12[]" name="idsVeiculosFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 24);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico13[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico13[]" name="idsVeiculosFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico13[]" name="idsVeiculosFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico14[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico14[]" name="idsVeiculosFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico14[]" name="idsVeiculosFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico15[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico15[]" name="idsVeiculosFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico15[]" name="idsVeiculosFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico16[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico16[]" name="idsVeiculosFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico16[]" name="idsVeiculosFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico17[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico17[]" name="idsVeiculosFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico17[]" name="idsVeiculosFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico18[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico18[]" name="idsVeiculosFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico18[]" name="idsVeiculosFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico19[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico19[]" name="idsVeiculosFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico19[]" name="idsVeiculosFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico20[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico20[]" name="idsVeiculosFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico20[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico20CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico20[]" name="idsVeiculosFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico20[$countArray][0];?>"><?php echo $arrVeiculosFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDescricao"); ?>:
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
                                    $("#descricao01").cleditor(
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
                                    $("#descricao01").cleditor(
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
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPortas"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula">
                    <div align="left">
                        <select name="portas" id="portas" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPortas0"); ?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </td>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragem"); ?> 
                        (<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMetricoDistancia'], "IncludeConfig"); ?>):
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div class="AdmTexto01">
                        <input type="text" name="kilometragem" id="kilometragem" class="AdmCampoNumerico02" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragemDescricao01"); ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosPlaca'] == "1"){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPlaca"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<input type="text" name="placa" id="placa" class="AdmCampoTexto02" maxlength="255" />
                        <span id="lblPlacaExistenteAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPlacaExistente"); ?>
                        </span>
                        
                        
                        <?php //JQuery - Ajax - CPF Duplicado.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configVeiculosPlacaVerificacaoDuplicado'] == 1){ ?>
							<script type="text/javascript">
                                $("#placa").keyup(function() {
                                    //Variáveis.
                                    var placaCampo = $(this);
                                    var placaConsulta = removerCaracteresEspeciais(placaCampo.val());
                                    var placaExistenteRetorno = "";
                                    
                                    var divProgressBar = "updtProgressVeiculos";
                                    var btnSubmit = "btnVeiculosIncluir";
                                    var lblAlerta = "lblPlacaExistenteAlerta";
                                    
                                    
                                    //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                    if(placaConsulta.length == 7)
                                    {
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
                                        
                                        
                                        //Ajax - comando.
                                        //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                        //contentType: 'application/json',
                                        //http://api.zippopotam.us/us/90210
                                        //html jsonp json
                                        //success: function(result, success) 
                                        //error: function(result, success) 
                                        //cache: false,
                                        //async: true,
                                        //data: "cepConsulta=" + "02068030",
                                        /**/
                                        $.ajax({
                                            url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiVeiculos.php",
                                            dataType: "html",
                                            type: "GET",
                                            data: "placaConsulta=" + placaConsulta,
                                            success: function(retornoDadosURL, success) 
                                            {
                                                //Ocultação da poleta.
                                                divHide(divProgressBar);
                                                
                                                //Definição de valores.
                                                placaExistenteRetorno = retornoDadosURL; //0 - não exitente | 1 - existente
                                                //alert("cpfExistenteRetorno=" + cpfExistenteRetorno);
                                                
                                                //Preenchimento de dados.
                                                if(placaExistenteRetorno == "0")
                                                {
                                                    //Mostrar aviso.
                                                    divHide(lblAlerta);
                                                    
                                                    //Habilitar botão.
                                                    document.getElementById(btnSubmit).disabled = false;
                                                }
                                                if(placaExistenteRetorno == "1")
                                                {
                                                    //Mostrar aviso.
                                                    divShow(lblAlerta);
                                                    
                                                    //Desabilitar botão.
                                                    document.getElementById(btnSubmit).disabled = true; 
                                                }
                                            },
                                            error: function(retornoDadosURL, success) 
                                            {
                                                //$(".zip-error").show(); // Ruh row
                                                //elementoMensagem01('testeAlvo01', "erro");
                                                divShow(lblAlerta);
                                            }	
                                        });	
                                            
                                                                    
                                        //Degug.
                                        //elementoMensagem01('testeAlvo01', cepNumero);
                                    }
                                    
                                    
                                    //Condição para reabilitar se as informações estiverem sido excluídas.
                                    if(placaConsulta.length == 0)
                                    {
                                        //Mostrar aviso.
                                        divHide(lblAlerta);
                                        
                                        //Habilitar botão.
                                        document.getElementById(btnSubmit).disabled = false;
                                    }
                                });						
                            </script>
                        <?php } ?>
                        <?php //----------------------?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAnoFabricacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula">
                    <div align="left">
                    	<?php
						$countAnoFabricacao = 1900;
						$countAnoFabricacaoFinal = date("Y") + 2;
						?>
                        <select name="ano_fabricacao" id="ano_fabricacao" class="AdmCampoDropDownMenu01">
                        	<?php while($countAnoFabricacao < $countAnoFabricacaoFinal) { ?>
                                <option value="<?php echo $countAnoFabricacao;?>"<?php if(date("Y") == $countAnoFabricacao) { ?>selected="selected"<?php }?>><?php echo $countAnoFabricacao;?></option>
                            <?php 
								$countAnoFabricacao++;
							}
							?>
                        </select>
                    </div>
                </td>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAnoModelo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                    	<?php
						$countAnoModelo = 1900;
						$countAnoModeloFinal = date("Y") + 2;
						?>
                        <select name="ano_modelo" id="ano_modelo" class="AdmCampoDropDownMenu01">
                        	<?php while($countAnoModelo < $countAnoModeloFinal) { ?>
                                <option value="<?php echo $countAnoModelo;?>"<?php if(date("Y") == $countAnoModelo) { ?>selected="selected"<?php }?>><?php echo $countAnoModelo;?></option>
                            <?php 
								$countAnoModelo++;
							}
							?>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo1'], $GLOBALS['configIdTbTipoVeiculosVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo1'], $GLOBALS['configVeiculosVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosVinculo1); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrVeiculosVinculo1[$countArray][0];?>"><?php echo $arrVeiculosVinculo1[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo2'], $GLOBALS['configIdTbTipoVeiculosVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo2'], $GLOBALS['configVeiculosVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrVeiculosVinculo2[$countArray][0];?>"><?php echo $arrVeiculosVinculo2[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo3'], $GLOBALS['configIdTbTipoVeiculosVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo3'], $GLOBALS['configVeiculosVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrVeiculosVinculo3[$countArray][0];?>"><?php echo $arrVeiculosVinculo3[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosVinculo4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo4Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo4'], $GLOBALS['configIdTbTipoVeiculosVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo4'], $GLOBALS['configVeiculosVinculo4Metodo']);
                        ?>
                        <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosVinculo4); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrVeiculosVinculo4[$countArray][0];?>"><?php echo $arrVeiculosVinculo4[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosVinculo5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo5Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo5'], $GLOBALS['configIdTbTipoVeiculosVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo5'], $GLOBALS['configVeiculosVinculo5Metodo']);
                        ?>
                        <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosVinculo5); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrVeiculosVinculo5[$countArray][0];?>"><?php echo $arrVeiculosVinculo5[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc1'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc2'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc3'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc4'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc5'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc6'] == 1){ ?>

                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc6'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc2'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc8'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc9'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc10'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc11'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc12'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc13'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc14'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc15'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc16'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc12'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc18'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc19'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc20'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc21'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc22'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc23'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc24'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc25'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc26'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc22'] == 7){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc28'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc29'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc30'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc31'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc32'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc33'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc34'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc35'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc36'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc37'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc38'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc39'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarVeiculosIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc40'] == 2){ ?>
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
            
            <?php //Endereço (campo livre). ?>
            <?php //---------------------- ?>
            <?php if($GLOBALS['configVeiculosIncluirLocalizacao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoCEP"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="veiculo_cep" id="veiculo_cep" class="AdmCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formVeiculos', 'veiculo_cep');"<?php } ?> />
                        <span id="lblCEPAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCEPNaoEncontrado"); ?>
                        </span>
                        <?php //alertas ?>
                        <?php //echo "FormatarCEPLer=" . Funcoes::FormatarCEPLer("22631455") . "<br />";  ?>
                                    
                                    
                        <?php //JQuery - Ajax - CEP.?>
                        <?php //----------------------?>
                        <?php if($GLOBALS['configVeiculosCEPPreenchimento'] == 1){ ?>
                        <script type="text/javascript">
							$("#veiculo_cep").keyup(function() {
								var cepCampo = $(this);
								var cepNumero = cepCampo.val().replace(/\D/g,'');
								//alert( "Handler for .keyup() called." );
								
								
								//Condição para executar somente depois de todos os caractéres do CEP preenchidos.
								if(cepNumero.length == 8)
								{
									//Acionamento da poleta.
									divShow('updtProgressVeiculos');
									
									
									//Consulta.
									/*
									var xhrAPI = new XMLHttpRequest();
									xhrAPI.open("GET", "http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php", true);
									xhrAPI.onreadystatechange = function() {
										if(xhrAPI.readyState == 4) {
											//alert(client.responseText);
											$("#testeAlvo01").val(xhrAPI.responseText);//teste
										};
									};
									xhrAPI.send();
									*/
									
									
									//Debug.
									/*
									var client = new XMLHttpRequest();
									client.open("GET", "http://api.zippopotam.us/us/90210", true);
									client.onreadystatechange = function() {
										if(client.readyState == 4) {
											//alert(client.responseText);
											$("#testeAlvo01").val(client.responseText);//teste
										};
									};
									client.send();
									*/
									
											
									//Ajax - comando.
									//http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
									//contentType: 'application/json',
									//http://api.zippopotam.us/us/90210
									//html jsonp json
									//success: function(result, success) 
									//error: function(result, success) 
									//cache: false,
									//async: true,
									//data: "cepConsulta=" + "02068030",
									/**/
									$.ajax({
										/*funcionando.
										xhr: function () {
											var xhr = new window.XMLHttpRequest();
											xhr.upload.addEventListener("progress", function (evt) {
												if (evt.lengthComputable) {
													var percentComplete = evt.loaded / evt.total;
													console.log(percentComplete);
													$('.progress').css({
														width: percentComplete * 100 + '%'
													});
													if (percentComplete === 1) {
														$('.progress').addClass('hide');
													}
												}
											}, false);
											xhr.addEventListener("progress", function (evt) {
												if (evt.lengthComputable) {
													var percentComplete = evt.loaded / evt.total;
													console.log(percentComplete);
													$('.progress').css({
														width: percentComplete * 100 + '%'
													});
												}
											}, false);
											return xhr;
										},
										*/
										url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCEP.php",
										dataType: "html",
										type: "GET",
										data: "cepConsulta=" + cepNumero + "&tipoPesquisa=<?php echo $GLOBALS['configVeiculosIncluirLocalizacao'];?>",
										success: function(retornoDadosURL, success) 
										{
											//Ocultação da poleta.
											divHide('updtProgressVeiculos');
											
											//Conversão de dados em json.
											var jsonRetornoDadosURL = jQuery.parseJSON(retornoDadosURL);
											
											//Variáveis.
											var retornoLogradouro = jsonRetornoDadosURL.logradouro;
											var retornoLogradouroCodigo = jsonRetornoDadosURL.logradouroCodigo;
											var retornoBairro = jsonRetornoDadosURL.bairro;
											var retornoBairroCodigo = jsonRetornoDadosURL.bairroCodigo;
											var retornoCidade = jsonRetornoDadosURL.cidade;
											var retornoCidadeCodigo = jsonRetornoDadosURL.cidadeCodigo;
											var retornoEstado = jsonRetornoDadosURL.uf;
											var retornoEstadoCodigo = jsonRetornoDadosURL.ufCodigo;
											var retornoPais = jsonRetornoDadosURL.pais;
											var retornoPaisCodigo = jsonRetornoDadosURL.paisCodigo;
											
											
											//Preenchimento de dados.
											if(retornoLogradouro)
											{
												divHide('lblCEPAlerta');
												$("#veiculo_endereco").val(retornoLogradouro);
												$("#veiculo_bairro").val(retornoBairro);
												$("#veiculo_cidade").val(retornoCidade);
												//$("#testeAlvo04").val(retornoEstado);
												$("#veiculo_estado").val(retornoEstadoCodigo);
												$("#veiculo_pais").val(retornoPais);
												
												$("#id_db_cep_tblBairros").val(retornoBairroCodigo);
												$("#id_db_cep_tblCidades").val(retornoCidadeCodigo);
												$("#id_db_cep_tblLogradouros").val(retornoLogradouroCodigo);
												$("#id_db_cep_tblUF").val(retornoEstadoCodigo);
												
											}else{
												divShow('lblCEPAlerta');
												
												$("#veiculo_endereco").val("");
												$("#veiculo_bairro").val("");
												$("#veiculo_cidade").val("");
												//$("#testeAlvo04").val(retornoEstado);
												$("#veiculo_estado").val("");
												$("#veiculo_pais").val("");
												
												$("#id_db_cep_tblBairros").val("0");
												$("#id_db_cep_tblCidades").val("0");
												$("#id_db_cep_tblLogradouros").val("0");
												$("#id_db_cep_tblUF").val("");
											}
											
											
											//$("#testeAlvo01").val(result.logradouro);
											//$("#testeAlvo01").val(retornoDadosURL);
											
											//elementoMensagem01('testeAlvo01', "teste");
											
											/*
											$(".fancy-form div > div").slideDown(); // Show the fields 
											$("#city").val(result.city); // Fill the data 
											$("#state").val(result.state);
											$(".zip-error").hide(); // In case they failed once before 
											$("#address-line-1").focus(); // Put cursor where they need it 
											*/
										},
										error: function(retornoDadosURL, success) 
										{
											//$(".zip-error").show(); // Ruh row
											//elementoMensagem01('testeAlvo01', "erro");
											divShow('lblCEPAlerta');
										}	
									});	
										
																
									//Degug.
									//elementoMensagem01('testeAlvo01', cepNumero);
								}
							});						
						
                        </script>
                        <?php } ?>
                        <?php //----------------------?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEndereco"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="veiculo_endereco" id="veiculo_endereco" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEnderecoNumero"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="veiculo_endereco_numero" id="veiculo_endereco_numero" class="AdmCampoTexto01" maxlength="255" />
                    </div>
                </td>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEnderecoComplemento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="veiculo_endereco_complemento" id="veiculo_endereco_complemento" class="AdmCampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoBairro"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="veiculo_bairro" id="veiculo_bairro" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoCidade"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="veiculo_cidade" id="veiculo_cidade" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEstado"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left">
                        <input type="text" name="veiculo_estado" id="veiculo_estado" class="AdmCampoTexto01" maxlength="255" />
                    </div>
                </td>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoPais"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="veiculo_pais" id="veiculo_pais" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php //---------------------- ?>
            
            
            <?php //Endereço. ?>
            <?php //---------------------- ?>
            <?php if($GLOBALS['configVeiculosIncluirLocalizacao'] == 3){ ?>
            
            <?php } ?>
            <?php //---------------------- ?>


            <?php if($GLOBALS['habilitarVeiculosContato'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosContato"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="contato" id="contato" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosEmail'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosEMail"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="email" id="email" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURLExterno'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosLinkExterno"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="link_externo" id="link_externo" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL1Titulo'], "IncludeConfig"); ?>:
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
            
            <?php if($GLOBALS['habilitarVeiculosURL2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL2Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url2" id="url2" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL3Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url3" id="url3" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL4Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url4" id="url4" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL5Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url5" id="url5" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosPalavrasChave'] == 1){ ?>
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
            
            <?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor" id="valor" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosValor1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Moeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor1" id="valor1" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosValor2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Moeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor2" id="valor2" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosAtivacaoInfoCadastro'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAtivacaoInfoCadastro"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao_info_cadastro" id="ativacao_info_cadastro" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
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
            
            <?php if($GLOBALS['habilitarVeiculosStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                        $arrVeiculosStatus = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 1);
                        ?>
                        <select name="id_tb_veiculos_status" id="id_tb_veiculos_status" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrVeiculosStatus[$countArray][0];?>"><?php echo $arrVeiculosStatus[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
			<?php if($GLOBALS['habilitarVeiculosImagem'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01">
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemObsInterno"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="anotacoes_internas" id="anotacoes_internas" class="AdmCampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>

        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" id="btnVeiculosIncluir" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $idParentVeiculos; ?>" />
                
                <input type="hidden" id="id_db_cep_tblBairros" name="id_db_cep_tblBairros" value="0" />
                <input type="hidden" id="id_db_cep_tblCidades" name="id_db_cep_tblCidades" value="0" />
                <input type="hidden" id="id_db_cep_tblLogradouros" name="id_db_cep_tblLogradouros" value="0" />
                <input type="hidden" id="id_db_cep_tblUF" name="id_db_cep_tblUF" value="0" />
                
                <input type="hidden" id="ativacao1" name="ativacao1" value="0" />
                <input type="hidden" id="ativacao2" name="ativacao2" value="0" />
                <input type="hidden" id="ativacao3" name="ativacao3" value="0" />
                <input type="hidden" id="ativacao4" name="ativacao4" value="0" />
                
                <input type="hidden" id="ativacao_promocao" name="ativacao_promocao" value="0" />
                <input type="hidden" id="ativacao_home" name="ativacao_home" value="0" />
                <input type="hidden" id="ativacao_home_categoria" name="ativacao_home_categoria" value="0" />
                <?php if($GLOBALS['habilitarVeiculosAtivacaoInfoCadastro'] == 0){ ?>
                	<input type="hidden" id="ativacao_info_cadastro" name="ativacao_info_cadastro" value="1" />
                <?php } ?>
                <input type="hidden" id="acesso_restrito" name="acesso_restrito" value="0" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressVeiculos" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
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