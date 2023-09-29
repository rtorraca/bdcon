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
$id = $_POST["idTbProdutos"];
$idTbCategorias = $_POST["id_tb_categorias"];

$arrIdsProdutosTipo = $_POST["idsProdutosTipo"];
$arrIdsProdutosFiltroGenerico01 = $_POST["idsProdutosFiltroGenerico01"];
$arrIdsProdutosFiltroGenerico02 = $_POST["idsProdutosFiltroGenerico02"];
$arrIdsProdutosFiltroGenerico03 = $_POST["idsProdutosFiltroGenerico03"];
$arrIdsProdutosFiltroGenerico04 = $_POST["idsProdutosFiltroGenerico04"];
$arrIdsProdutosFiltroGenerico05 = $_POST["idsProdutosFiltroGenerico05"];
$arrIdsProdutosFiltroGenerico06 = $_POST["idsProdutosFiltroGenerico06"];
$arrIdsProdutosFiltroGenerico07 = $_POST["idsProdutosFiltroGenerico07"];
$arrIdsProdutosFiltroGenerico08 = $_POST["idsProdutosFiltroGenerico08"];
$arrIdsProdutosFiltroGenerico09 = $_POST["idsProdutosFiltroGenerico09"];
$arrIdsProdutosFiltroGenerico10 = $_POST["idsProdutosFiltroGenerico10"];
$arrIdsProdutosFiltroGenerico11 = $_POST["idsProdutosFiltroGenerico11"];
$arrIdsProdutosFiltroGenerico12 = $_POST["idsProdutosFiltroGenerico12"];
$arrIdsProdutosFiltroGenerico13 = $_POST["idsProdutosFiltroGenerico13"];
$arrIdsProdutosFiltroGenerico14 = $_POST["idsProdutosFiltroGenerico14"];
$arrIdsProdutosFiltroGenerico15 = $_POST["idsProdutosFiltroGenerico15"];
$arrIdsProdutosFiltroGenerico16 = $_POST["idsProdutosFiltroGenerico16"];
$arrIdsProdutosFiltroGenerico17 = $_POST["idsProdutosFiltroGenerico17"];
$arrIdsProdutosFiltroGenerico18 = $_POST["idsProdutosFiltroGenerico18"];
$arrIdsProdutosFiltroGenerico19 = $_POST["idsProdutosFiltroGenerico19"];
$arrIdsProdutosFiltroGenerico20 = $_POST["idsProdutosFiltroGenerico20"];
$arrIdsProdutosFiltroGenerico21 = $_POST["idsProdutosFiltroGenerico21"];
$arrIdsProdutosFiltroGenerico22 = $_POST["idsProdutosFiltroGenerico22"];
$arrIdsProdutosFiltroGenerico23 = $_POST["idsProdutosFiltroGenerico23"];
$arrIdsProdutosFiltroGenerico24 = $_POST["idsProdutosFiltroGenerico24"];
$arrIdsProdutosFiltroGenerico25 = $_POST["idsProdutosFiltroGenerico25"];
$arrIdsProdutosFiltroGenerico26 = $_POST["idsProdutosFiltroGenerico26"];
$arrIdsProdutosFiltroGenerico27 = $_POST["idsProdutosFiltroGenerico27"];
$arrIdsProdutosFiltroGenerico28 = $_POST["idsProdutosFiltroGenerico28"];
$arrIdsProdutosFiltroGenerico29 = $_POST["idsProdutosFiltroGenerico29"];
$arrIdsProdutosFiltroGenerico30 = $_POST["idsProdutosFiltroGenerico30"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataProduto = Funcoes::DataGravacaoSql($_POST["data_publicacao"], $GLOBALS['configSistemaFormatoData']);
if($dataProduto == "")
{
	//$data_publicacao = NULL;	
	$dataProduto = date("Y") . "-" . date("m") . "-" . date("d");	
}

$codProduto = Funcoes::ConteudoMascaraGravacao01($_POST["cod_produto"]);

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$produto = Funcoes::ConteudoMascaraGravacao01($_POST["produto"]);

$descricao01 = Funcoes::ConteudoMascaraGravacao01($_POST["descricao01"]);
$descricao02 = Funcoes::ConteudoMascaraGravacao01($_POST["descricao02"]);
$descricao03 = Funcoes::ConteudoMascaraGravacao01($_POST["descricao03"]);
$descricao04 = Funcoes::ConteudoMascaraGravacao01($_POST["descricao04"]);
$descricao05 = Funcoes::ConteudoMascaraGravacao01($_POST["descricao05"]);

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

$palavrasChave = Funcoes::ConteudoMascaraGravacao01($_POST["palavras_chave"]);
$valor = Funcoes::MascaraValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;
}

$valor1 = Funcoes::MascaraValorGravar($_POST["valor1"]);
if($valor1 == "")
{
	$valor1 = 0;
}

$valor2 = Funcoes::MascaraValorGravar($_POST["valor2"]);
if($valor2 == "")
{
	$valor2 = 0;
}

$peso = Funcoes::MascaraValorGravar($_POST["peso"]);
if($peso == "")
{
	$peso = 0;
}

$coeficiente = $_POST["coeficiente"];
$estoque = $_POST["estoque"];
$ativacao = $_POST["ativacao"];
$ativacaoPromocao = $_POST["ativacao_promocao"];
$ativacaoHome = $_POST["ativacao_home"];
$ativacaoHomeCategoria = $_POST["ativacao_home_categoria"];
$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}

$nQuestoesAprovacao = $_POST["n_questoes_aprovacao"];
$idTbProdutosStatus = $_POST["id_tb_produtos_status"];
$anotacoesInternas = Funcoes::ConteudoMascaraGravacao01($_POST["anotacoes_internas"]);
$n_visitas = 0;

//$paginaRetorno = $_POST["paginaRetorno"];
$paginaRetorno = "SiteAdmProdutosEditar.php";
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlProdutosUpdate = "";
$strSqlProdutosUpdate .= "UPDATE tb_produtos ";
$strSqlProdutosUpdate .= "SET ";
//$strSqlProdutosUpdate .= "id = :id, ";
$strSqlProdutosUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlProdutosUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlProdutosUpdate .= "data_produto = :data_produto, ";
$strSqlProdutosUpdate .= "cod_produto = :cod_produto, ";
$strSqlProdutosUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlProdutosUpdate .= "produto = :produto, ";

$strSqlProdutosUpdate .= "descricao01 = :descricao01, ";
$strSqlProdutosUpdate .= "descricao02 = :descricao02, ";
$strSqlProdutosUpdate .= "descricao03 = :descricao03, ";
$strSqlProdutosUpdate .= "descricao04 = :descricao04, ";
$strSqlProdutosUpdate .= "descricao05 = :descricao05, ";

$strSqlProdutosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlProdutosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlProdutosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlProdutosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlProdutosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlProdutosUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlProdutosUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlProdutosUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlProdutosUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlProdutosUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlProdutosUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlProdutosUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlProdutosUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlProdutosUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlProdutosUpdate .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlProdutosUpdate .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlProdutosUpdate .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlProdutosUpdate .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlProdutosUpdate .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlProdutosUpdate .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlProdutosUpdate .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlProdutosUpdate .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlProdutosUpdate .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlProdutosUpdate .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlProdutosUpdate .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlProdutosUpdate .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlProdutosUpdate .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlProdutosUpdate .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlProdutosUpdate .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlProdutosUpdate .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlProdutosUpdate .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlProdutosUpdate .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlProdutosUpdate .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlProdutosUpdate .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlProdutosUpdate .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlProdutosUpdate .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlProdutosUpdate .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlProdutosUpdate .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlProdutosUpdate .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlProdutosUpdate .= "informacao_complementar40 = :informacao_complementar40, ";
$strSqlProdutosUpdate .= "informacao_complementar41 = :informacao_complementar41, ";
$strSqlProdutosUpdate .= "informacao_complementar42 = :informacao_complementar42, ";
$strSqlProdutosUpdate .= "informacao_complementar43 = :informacao_complementar43, ";
$strSqlProdutosUpdate .= "informacao_complementar44 = :informacao_complementar44, ";
$strSqlProdutosUpdate .= "informacao_complementar45 = :informacao_complementar45, ";
$strSqlProdutosUpdate .= "informacao_complementar46 = :informacao_complementar46, ";
$strSqlProdutosUpdate .= "informacao_complementar47 = :informacao_complementar47, ";
$strSqlProdutosUpdate .= "informacao_complementar48 = :informacao_complementar48, ";
$strSqlProdutosUpdate .= "informacao_complementar49 = :informacao_complementar49, ";
$strSqlProdutosUpdate .= "informacao_complementar50 = :informacao_complementar50, ";

$strSqlProdutosUpdate .= "palavras_chave = :palavras_chave, ";
$strSqlProdutosUpdate .= "valor = :valor, ";
$strSqlProdutosUpdate .= "valor1 = :valor1, ";
$strSqlProdutosUpdate .= "valor2 = :valor2, ";
$strSqlProdutosUpdate .= "peso = :peso, ";
$strSqlProdutosUpdate .= "coeficiente = :coeficiente, ";
$strSqlProdutosUpdate .= "estoque = :estoque, ";

$strSqlProdutosUpdate .= "ativacao = :ativacao, ";
$strSqlProdutosUpdate .= "ativacao_promocao = :ativacao_promocao, ";
$strSqlProdutosUpdate .= "ativacao_home = :ativacao_home, ";
$strSqlProdutosUpdate .= "ativacao_home_categoria = :ativacao_home_categoria, ";

$strSqlProdutosUpdate .= "acesso_restrito = :acesso_restrito, ";
$strSqlProdutosUpdate .= "n_questoes_aprovacao = :n_questoes_aprovacao, ";
$strSqlProdutosUpdate .= "id_tb_produtos_status = :id_tb_produtos_status, ";
//$strSqlProdutosUpdate .= "imagem = :imagem, ";
//$strSqlProdutosUpdate .= "anotacoes_internas = :anotacoes_internas, ";
$strSqlProdutosUpdate .= "anotacoes_internas = :anotacoes_internas ";
//$strSqlProdutosUpdate .= "n_visitas = :n_visitas ";

$strSqlProdutosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlProdutosUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementProdutosUpdate = $dbSistemaConPDO->prepare($strSqlProdutosUpdate);

/*
"n_visitas" => $n_visitas
*/
if ($statementProdutosUpdate !== false)
{
	$statementProdutosUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"data_produto" => $dataProduto,
		"cod_produto" => $codProduto,
		"n_classificacao" => $nClassificacao,
		"produto" => $produto,
		"descricao01" => $descricao01,
		"descricao02" => $descricao02,
		"descricao03" => $descricao03,
		"descricao04" => $descricao04,
		"descricao05" => $descricao05,
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
		"palavras_chave" => $palavrasChave,
		"valor" => $valor,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"peso" => $peso,
		"coeficiente" => $coeficiente,
		"estoque" => $estoque,	
		"ativacao" => $ativacao,
		"ativacao_promocao" => $ativacaoPromocao,
		"ativacao_home" => $ativacaoHome,
		"ativacao_home_categoria" => $ativacaoHomeCategoria,
		"acesso_restrito" => $acessoRestrito,
		"n_questoes_aprovacao" => $nQuestoesAprovacao,
		"id_tb_produtos_status" => $idTbProdutosStatus,
		"anotacoes_internas" => $anotacoesInternas
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{

	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlProdutosUpdate);
unset($statementProdutosUpdate);
//----------


//Gravação de complementos.
//----------
//Tipo.

//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"2");
									
if(!empty($arrIdsProdutosTipo))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosTipo); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosTipo[$countArray], "2", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 01.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"12");

if(!empty($arrIdsProdutosFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico01[$countArray], "12", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 02.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"13");
if(!empty($arrIdsProdutosFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico02[$countArray], "13", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 03.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"14");
if(!empty($arrIdsProdutosFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico03[$countArray], "14", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 04.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"15");
if(!empty($arrIdsProdutosFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico04[$countArray], "15", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 05.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"16");
if(!empty($arrIdsProdutosFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico05[$countArray], "16", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 06.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"17");
if(!empty($arrIdsProdutosFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico06[$countArray], "17", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 07.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"18");
if(!empty($arrIdsProdutosFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico07[$countArray], "18", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 08.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"19");
if(!empty($arrIdsProdutosFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico08[$countArray], "19", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 09.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"20");
if(!empty($arrIdsProdutosFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico09[$countArray], "20", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 10.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"21");
if(!empty($arrIdsProdutosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico10[$countArray], "21", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 11.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"22");
if(!empty($arrIdsProdutosFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico11[$countArray], "22", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 12.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"23");
if(!empty($arrIdsProdutosFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico12[$countArray], "23", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 13.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"24");
if(!empty($arrIdsProdutosFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico13[$countArray], "24", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 14.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"25");
if(!empty($arrIdsProdutosFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico14[$countArray], "25", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 15.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"26");
if(!empty($arrIdsProdutosFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico15[$countArray], "26", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 16.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"27");
if(!empty($arrIdsProdutosFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico16[$countArray], "27", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 17.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"28");
if(!empty($arrIdsProdutosFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico17[$countArray], "28", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 18.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"29");
if(!empty($arrIdsProdutosFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico18[$countArray], "29", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 19.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"30");
if(!empty($arrIdsProdutosFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico19[$countArray], "30", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 20.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"31");
if(!empty($arrIdsProdutosFiltroGenerico20))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico20); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico20[$countArray], "31", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 21.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"32");
if(!empty($arrIdsProdutosFiltroGenerico21))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico21); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico21[$countArray], "32", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 22.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"33");
if(!empty($arrIdsProdutosFiltroGenerico22))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico22); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico22[$countArray], "33", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 23.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"34");
if(!empty($arrIdsProdutosFiltroGenerico23))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico23); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico23[$countArray], "34", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 24.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"35");
if(!empty($arrIdsProdutosFiltroGenerico24))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico24); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico24[$countArray], "35", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 25.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"36");
if(!empty($arrIdsProdutosFiltroGenerico25))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico25); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico25[$countArray], "36", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 26.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"37");
if(!empty($arrIdsProdutosFiltroGenerico26))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico26); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico26[$countArray], "37", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 27.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"38");
if(!empty($arrIdsProdutosFiltroGenerico27))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico27); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico27[$countArray], "38", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 28.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"39");
if(!empty($arrIdsProdutosFiltroGenerico28))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico28); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico28[$countArray], "39", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 29.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"40");
if(!empty($arrIdsProdutosFiltroGenerico29))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico29); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico29[$countArray], "40", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}


//Filtro genérico 30.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_produtos_relacao_complemento", 
									"id_tb_produtos",
									"tipo_complemento", 
									"41");
if(!empty($arrIdsProdutosFiltroGenerico30))
{
	for($countArray = 0; $countArray < count($arrIdsProdutosFiltroGenerico30); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsProdutosFiltroGenerico30[$countArray], "41", "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento");
	}
}
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemProdutos'];
	if($GLOBALS['ativacaoImagensPadrao'] == 1)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	}
	
	//Definição do diretório de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Definição do nome do arquivo.
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Gravação do arquivo original no servidor.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"o" . $arquivoNome);
	}else{
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"" . $arquivoNome);
	}

	if($resultadoUpload == true){
	
	}else{
		$mensagemErro .= $resultadoUpload;
		//$mensagemSucesso = "";
	}
	
	
	//Verificação de formato do arquivo.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		//Redimensionamento de arquivos.
		Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
									$arquivosDiretorioUpload, 
									$arquivoNome);
	}else{
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
		//$mensagemSucesso = "";
	}
	
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_produtos", "imagem");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParentProdutos=" . $idTbCategorias .
"&idTbProdutos=" . $id .
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