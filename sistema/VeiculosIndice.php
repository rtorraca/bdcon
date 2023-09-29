<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentVeiculos = $_GET["idParentVeiculos"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idsTdVeiculos = $_GET["idsTdVeiculos"];
$idsTbVeiculosComplemento = $_GET["idsTbVeiculosComplemento"];
if(is_array($idsTbVeiculosComplemento) == true)
{
	//$idsTbCadastroComplemento = implode(",", $_GET["idsTbCadastroComplemento"]);
	$idsTbVeiculosComplemento = implode(",", $idsTbVeiculosComplemento);
}
if($idsTbVeiculosComplemento <> "")
{
	if($idsTdVeiculos <> "")
	{
		$idsTdVeiculos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray($idsTbVeiculosComplemento, 
																			"tb_veiculos_relacao_complemento", 
																			"id_tb_veiculos_complemento", 
																			"id_tb_veiculos");
		/*
		$idsTdCadastro .= "," . DbFuncoes::GetCampoGenerico06("tb_cadastro_relacao_complemento", 
																"id_tb_cadastro", 
																"id_tb_cadastro_complemento", 
																$idsTbCadastroComplemento, 
																"", 
																"", 
																1, 
																"", 
																"", 
																"tipo_complemento", 
																"14", 
																"", 
																"");
		*/
		
	}else{
		$idsTdVeiculos .= DbFuncoes::GetIdsByTipoComplemento_FromArray($idsTbVeiculosComplemento, 
																		"tb_veiculos_relacao_complemento", 
																		"id_tb_veiculos_complemento", 
																		"id_tb_veiculos");
	}
	
	if($idsTdVeiculos == "")
	{
		$idsTdVeiculos = "0";
	}
}


$dataPublicacaoOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSistemaFormatoData'], "1");

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "VeiculosIndice.php";
$paginaRetornoExclusao = "VeiculosEditar.php";
$variavelRetorno = "idParentVeiculos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarVeiculosSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configVeiculosSistemaPaginacaoNRegistros'];
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
"&idsTbVeiculosComplemento=" . $idsTbVeiculosComplemento . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
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
if($GLOBALS['habilitarVeiculosSistemaPaginacao'] == "1"){
	$strSqlVeiculosSelect .= ", (SELECT COUNT(id) ";
	$strSqlVeiculosSelect .= "FROM tb_veiculos ";
	$strSqlVeiculosSelect .= "WHERE id <> 0 ";
	if($idParentVeiculos <> "")
	{
		$strSqlVeiculosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
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
if($GLOBALS['habilitarVeiculosSistemaPaginacao'] == "1"){ 
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
	$statementVeiculosSelect->execute();
}
//----------

//$resultadoVeiculos = $dbSistemaConPDO->query($strSqlVeiculosSelect);
$resultadoVeiculos = $statementVeiculosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarVeiculosSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoVeiculos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarVeiculosSistemaPaginacao=" . $habilitarVeiculosSistemaPaginacao . "<br />";
//echo "strSqlVeiculosSelect=" . $strSqlVeiculosSelect . "<br />";
//echo "CEP::CEPFill (logradouro)=" . CEP::CEPFill("22631455", "logradouro") . "<br />";
//echo "CEP::CEPFill (logradouroCodigo)=" . CEP::CEPFill("22631455", "logradouroCodigo") . "<br />";
//echo "CEP::CEPFill (bairro)=" . CEP::CEPFill("22631455", "bairro") . "<br />";
//echo "CEP::CEPFill (bairroCodigo)=" . CEP::CEPFill("22631455", "bairroCodigo") . "<br />";
//echo "CEP::CEPFill (cidade)=" . CEP::CEPFill("22631455", "cidade") . "<br />";
//echo "CEP::CEPFill (cidadeCodigo)=" . CEP::CEPFill("22631455", "cidadeCodigo") . "<br />";
//echo "CEP::CEPFill (uf)=" . CEP::CEPFill("22631455", "uf") . "<br />";
//echo "CEP::CEPFill (ufCodigo)=" . CEP::CEPFill("22631455", "ufCodigo") . "<br />";
//echo "CEP::CEPFill (pais)=" . CEP::CEPFill("22631455", "pais") . "<br />";
//echo "CEP::CEPFill=" . "teste" . "<br />";
//pais | uf | ufCodigo | cidade | cidadeCodigo | bairroCodigo | logradouroCodigo
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosTitulo"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentVeiculos, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

    <?php
	if (empty($resultadoVeiculos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formVeiculosAcoes" id="formVeiculosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tb_veiculos" />
            <input type="hidden" id="idParentVeiculos" name="idParentVeiculos" value="<?php echo $idParentVeiculos; ?>" />

            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
            	<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                    <div align="left" style="float: left;">
                        <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemClassificacaoPadrao"); ?>
                        </a>
                    </div>
                <?php } ?>
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarVeiculosNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarVeiculosVisualizacaoImagem'] == 1){ ?>
                <td width="1" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosVisualizacaoData'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosDataPublicacao"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=veiculo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculo"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculo"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoPromocoes'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao_promocao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoPromocoes"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoPromocoes"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoHome'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao_home<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoHome"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoHome"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoCategoria'] == 1){ ?>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarVeiculosClassificacaoPersonalizada'] == 1){ ?>
                            <a href="ClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentVeiculos; ?>&strTabela=tb_veiculos&criterioClassificacao=ativacao_home_categoria<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="Links02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoHomeCategoria"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoHomeCategoria"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoAcesso'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoVeiculos as $linhaVeiculos)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarVeiculosNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaVeiculos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarVeiculosVisualizacaoImagem'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
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
                    <div align="center" class="Texto01">
                        <?php //echo $linhaVeiculos['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaVeiculos['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>
                    </div>
                    <div class="Texto01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade"); ?>: 
                        </strong>
						<?php if($linhaVeiculos['modalidade'] == 0){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade0"); ?>
                        <?php } ?>
						<?php if($linhaVeiculos['modalidade'] == 1){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade1"); ?>
                        <?php } ?>
						<?php if($linhaVeiculos['modalidade'] == 2){ ?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade2"); ?>
                        <?php } ?>
                    </div>
                    <div class="Texto01">
                    	<?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosValor"); ?>: 
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
                    <div class="Texto01">
                    	<?php if($GLOBALS['habilitarVeiculosFotos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=1&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosVideos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=2&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosArquivos'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosZip'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=4&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosSwfs'] == 1){ ?>
                            [
                            <a href="ArquivosIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&tipoArquivo=5&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarVeiculosConteudo'] == 1){ ?>
                            [
                            <a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaVeiculos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirConteudo"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarVeiculosHistorico'] == 1){ ?>
                            [
                            <a href="HistoricoIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirHistorico"); ?>
                            </a>
                            ] 
                        <?php } ?>
						<?php if($GLOBALS['habilitarVeiculosTarefas'] == 1){ ?>
                            [
                            <a href="TarefasIndice.php?idParent=<?php echo $linhaVeiculos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculos['veiculo']);?>&detalhe02=" target="_blank" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemInserirTarefas"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    
					<?php if($GLOBALS['habilitarVeiculosCadastroUsuario'] == 1){ ?>
                        <div class="Texto01">
							<?php if($linhaVeiculos['id_tb_cadastro_usuario'] <> 0){ ?>
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosCadastroUsuario"); ?>:  
                                </strong>
                                <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaVeiculos['id_tb_cadastro_usuario'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_cadastro_usuario'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaVeiculos['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            <?php } ?>
                        </div>
					<?php } ?>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteVeiculosDetalhes.php?idTbVeiculos=<?php echo $linhaVeiculos['id'];?>" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaVeiculos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao'];?>&strTabela=tb_veiculos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaVeiculos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoPromocoes'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['ativacao_promocao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao_promocao'];?>&strTabela=tb_veiculos&strCampo=ativacao_promocao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaVeiculos['ativacao_promocao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao_promocao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoHome'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['ativacao_home'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao_home'];?>&strTabela=tb_veiculos&strCampo=ativacao_home<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaVeiculos['ativacao_home'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao_home'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoCategoria'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['ativacao_home_categoria'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['ativacao_home_categoria'];?>&strTabela=tb_veiculos&strCampo=ativacao_home_categoria<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaVeiculos['ativacao_home_categoria'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaVeiculos['ativacao_home_categoria'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaVeiculos['ativacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarVeiculosAtivacaoAcesso'] == 1){ ?>
                <td class="<?php if($linhaVeiculos['acesso_restrito'] == 0){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaVeiculos['id'];?>&statusAtivacao=<?php echo $linhaVeiculos['acesso_restrito'];?>&strTabela=tb_veiculos&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaVeiculos['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso0"); ?>
                            <?php } ?>

                        	<?php if($linhaVeiculos['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaVeiculos['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="VeiculosEditar.php?idTbVeiculos=<?php echo $linhaVeiculos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaVeiculos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarVeiculosSistemaPaginacao'] == "1"){ ?>

		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="Texto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarVeiculosSistemaPaginacaoNumeracao'] == "1"){ ?>
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="Texto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPaginacaoPaginaContador01"); ?> 
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
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					},
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor1: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor2: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica3"); ?>"
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
    
    <form name="formVeiculos" id="formVeiculos" action="VeiculosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosTbVeiculos"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosCadastroUsuario'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                            $arrVeiculosUsuario = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbCadastroVeiculosUsuario'], $GLOBALS['configIdTbTipoCadastroVeiculosUsuario'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoCadastroVeiculosUsuario'], $GLOBALS['configVeiculosCadastroUsuarioMetodo']);
                        ?>
                        <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarVeiculosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <select name="modalidade" id="modalidade" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade0"); ?></option>
                            <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade1"); ?></option>
                            <option value="2" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosModalidade2"); ?></option>
                        </select>
                    </div>
                </td>
				<?php if($GLOBALS['habilitarVeiculosNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosDataPublicacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_publicacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_publicacao" id="data_publicacao" class="CampoData01" maxlength="10" value="<?php echo $dataVeiculosOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
                
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosCodigo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="codigo" id="codigo" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosData1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData1'] == 1){ ?>
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
                            
                                <input type="text" name="data1" id="data1" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData2'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data2;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data2" id="data2" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData3'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data3;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data3" id="data3" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData4'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data4;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data4" id="data4" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData5'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data5;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data5" id="data5" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData6'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data6;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data6" id="data6" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData7'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data7;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data7" id="data7" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData8'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data8;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data8" id="data8" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData9'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data9;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data9" id="data9" class="CampoData01" maxlength="10" />
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoVeiculosData10'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data10;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data10" id="data10" class="CampoData01" maxlength="10" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<input type="text" name="veiculo" id="veiculo" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosTipo'] == "1"){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosTipo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<?php 
						$arrVeiculosTipo = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 2);
						?>
                        
                        <?php 
						for($countArray = 0; $countArray < count($arrVeiculosTipo); $countArray++)
						{
						?>
                        	<div>
                                <input name="idsVeiculosTipo[]" type="checkbox" value="<?php echo $arrVeiculosTipo[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosTipo[$countArray][1];?>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico01[]" name="idsVeiculosFiltroGenerico01[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico01[]" name="idsVeiculosFiltroGenerico01[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico01)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico02[]" name="idsVeiculosFiltroGenerico02[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico02[]" name="idsVeiculosFiltroGenerico02[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico02)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico03[]" name="idsVeiculosFiltroGenerico03[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico03[]" name="idsVeiculosFiltroGenerico03[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico03)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico04[]" name="idsVeiculosFiltroGenerico04[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico04[]" name="idsVeiculosFiltroGenerico04[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico04)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico05[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico05[]" name="idsVeiculosFiltroGenerico05[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico05[]" name="idsVeiculosFiltroGenerico05[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico05)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico06[]" name="idsVeiculosFiltroGenerico06[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico06[]" name="idsVeiculosFiltroGenerico06[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico06)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico07[]" name="idsVeiculosFiltroGenerico07[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico07[]" name="idsVeiculosFiltroGenerico07[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico07)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico08[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico08[]" name="idsVeiculosFiltroGenerico08[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico08[]" name="idsVeiculosFiltroGenerico08[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico08)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico09[]" name="idsVeiculosFiltroGenerico09[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico09[]" name="idsVeiculosFiltroGenerico09[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico09)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico10)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico11[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico11[]" name="idsVeiculosFiltroGenerico11[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico11[]" name="idsVeiculosFiltroGenerico11[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico11)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 23);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico12[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico12[]" name="idsVeiculosFiltroGenerico12[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico12[]" name="idsVeiculosFiltroGenerico12[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico12)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 24);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico13[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico13[]" name="idsVeiculosFiltroGenerico13[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico13[]" name="idsVeiculosFiltroGenerico13[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico13)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico14[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico14[]" name="idsVeiculosFiltroGenerico14[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico14[]" name="idsVeiculosFiltroGenerico14[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico14)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico15[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico15[]" name="idsVeiculosFiltroGenerico15[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico15[]" name="idsVeiculosFiltroGenerico15[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico15)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico16[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico16[]" name="idsVeiculosFiltroGenerico16[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico16[]" name="idsVeiculosFiltroGenerico16[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico16)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico17[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico17[]" name="idsVeiculosFiltroGenerico17[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico17[]" name="idsVeiculosFiltroGenerico17[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico17)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico18[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico18[]" name="idsVeiculosFiltroGenerico18[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico18[]" name="idsVeiculosFiltroGenerico18[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico18)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico19[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico19[]" name="idsVeiculosFiltroGenerico19[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico19[]" name="idsVeiculosFiltroGenerico19[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico19)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configVeiculosFiltroGenerico20CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico20[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico20[$countArray][0];?>" class="CampoCheckBox01" /> <?php echo $arrVeiculosFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico20[]" name="idsVeiculosFiltroGenerico20[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico20CaixaSelecao'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico20[]" name="idsVeiculosFiltroGenerico20[]" class="CampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                        
                        <?php if(empty($arrVeiculosFiltroGenerico20)){ ?>
                        	<a href="VeiculosManutencao.php" class="Links01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                        
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosDescricao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao" id="descricao" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosPortas"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula">
                    <div align="left">
                        <select name="portas" id="portas" class="CampoDropDownMenu01">
                            <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosPortas0"); ?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosQuilometragem"); ?> 
                        (<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMetricoDistancia'], "IncludeConfig"); ?>):
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div class="Texto01">
                        <input type="text" name="kilometragem" id="kilometragem" class="CampoNumerico02" maxlength="10" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosQuilometragemDescricao01"); ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosPlaca'] == "1"){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosPlaca"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                    	<input type="text" name="placa" id="placa" class="CampoTexto01" maxlength="255" />
                        <span id="lblPlacaExistenteAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosPlacaExistente"); ?>
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
                                    
                                    var divProgressBar = "updtProgressGenerico";
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAnoFabricacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula">
                    <div align="left">
                    	<?php
						$countAnoFabricacao = 1900;
						$countAnoFabricacaoFinal = date("Y") + 2;
						?>
                        <select name="ano_fabricacao" id="ano_fabricacao" class="CampoDropDownMenu01">
                        	<?php while($countAnoFabricacao < $countAnoFabricacaoFinal) { ?>
                                <option value="<?php echo $countAnoFabricacao;?>"<?php if(date("Y") == $countAnoFabricacao) { ?>selected="selected"<?php }?>><?php echo $countAnoFabricacao;?></option>
                            <?php 
								$countAnoFabricacao++;
							}
							?>
                        </select>
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAnoModelo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                    	<?php
						$countAnoModelo = 1900;
						$countAnoModeloFinal = date("Y") + 2;
						?>
                        <select name="ano_modelo" id="ano_modelo" class="CampoDropDownMenu01">
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo1'], $GLOBALS['configIdTbTipoVeiculosVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo1'], $GLOBALS['configVeiculosVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo2'], $GLOBALS['configIdTbTipoVeiculosVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo2'], $GLOBALS['configVeiculosVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo3'], $GLOBALS['configIdTbTipoVeiculosVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo3'], $GLOBALS['configVeiculosVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo4Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo4'], $GLOBALS['configIdTbTipoVeiculosVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo4'], $GLOBALS['configVeiculosVinculo4Metodo']);
                        ?>
                        <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosVinculo5Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbVeiculosVinculo5'], $GLOBALS['configIdTbTipoVeiculosVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoVeiculosVinculo5'], $GLOBALS['configVeiculosVinculo5Metodo']);
                        ?>
                        <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="CampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc6'] == 1){ ?>

                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc2'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc25'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar25" id="informacao_complementar25" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc26'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar26" id="informacao_complementar26" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc22'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar27" id="informacao_complementar27" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc28'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar28" id="informacao_complementar28" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc29'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar29" id="informacao_complementar29" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc30'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar30" id="informacao_complementar30" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc31'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc32'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc33'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc34'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc35'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc36'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc37'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc38'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc39'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar39" id="informacao_complementar39" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configVeiculosBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="CampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosBoxIc40'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar40" id="informacao_complementar40" class="CampoTextoMultilinha01"></textarea>
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoCEP"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="veiculo_cep" id="veiculo_cep" class="CampoTexto02" maxlength="255"<?php if($GLOBALS['configCadastroCEPMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('##.###-###', this, 'formVeiculos', 'veiculo_cep');"<?php } ?> />
                        <span id="lblCEPAlerta" class="TextoAlerta" style="display: none;">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaCEPNaoEncontrado"); ?>
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
									divShow('updtProgressGenerico');
									
									
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
											divHide('updtProgressGenerico');
											
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
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoEndereco"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="veiculo_endereco" id="veiculo_endereco" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoEnderecoNumero"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="veiculo_endereco_numero" id="veiculo_endereco_numero" class="CampoTexto02" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoEnderecoComplemento"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="veiculo_endereco_complemento" id="veiculo_endereco_complemento" class="CampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoBairro"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="veiculo_bairro" id="veiculo_bairro" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoCidade"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="veiculo_cidade" id="veiculo_cidade" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoEstado"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="veiculo_estado" id="veiculo_estado" class="CampoTexto02" maxlength="255" />
                    </div>
                </td>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosVeiculoPais"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01">
                    <div align="left">
                        <input type="text" name="veiculo_pais" id="veiculo_pais" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            <?php //---------------------- ?>
            
            
            <?php //Endereço (campo livre). ?>
            <?php //---------------------- ?>
            <?php if($GLOBALS['configVeiculosIncluirLocalizacao'] == 3){ ?>
            
            <?php } ?>
            <?php //---------------------- ?>


            <?php if($GLOBALS['habilitarVeiculosContato'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosContato"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="contato" id="contato" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosEmail'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosEMail"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <input type="text" name="email" id="email" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURLExterno'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosLinkExterno"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<textarea name="link_externo" id="link_externo" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL1Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<textarea name="url1" id="url1" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL2Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<textarea name="url2" id="url2" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL3'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL3Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<textarea name="url3" id="url3" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL4'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL4Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<textarea name="url4" id="url4" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosURL5'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL5Titulo'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                    	<textarea name="url5" id="url5" class="CampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosPalavrasChave'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="CampoTextoMultilinha01"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosValor"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor" id="valor" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosValor1'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Moeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor1" id="valor1" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosValor2'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Moeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor2" id="valor2" class="CampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosAtivacaoInfoCadastro'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosAtivacaoInfoCadastro"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao_info_cadastro" id="ativacao_info_cadastro" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarVeiculosStatus'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaVeiculosStatus"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
						<?php 
                        $arrVeiculosStatus = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 1);
                        ?>
                        <select name="id_tb_veiculos_status" id="id_tb_veiculos_status" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFiltroGenerico03"); ?></option>
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
                <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemImagem"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01">
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemObsInterno"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="anotacoes_internas" id="anotacoes_internas" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>

        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" id="btnVeiculosIncluir" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
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
                <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
    
    <div id="updtProgressGenerico" style="display: none;">
        <div class="ProgressBarGenerico01Container">
            <div class="ProgressBarGenerico01">
                <img src="img/ProgressBar01.gif" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaImagemProgressBarra"); ?>" />
            </div>
        </div>
    </div>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
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
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>