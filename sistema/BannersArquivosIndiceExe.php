<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importaзгo dos arquivos de configuraзгo.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variбveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idTbBanners = $_POST["id_tb_banners"];

$idTbCadastro = $_POST["id_tb_cadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$tipoPublicacao = $_POST["tipo_publicacao"];

$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$dataInicial = Funcoes::DataGravacaoSql($_POST["data_inicial"], $GLOBALS['configSistemaFormatoData']); // . " " . date("H") . ":" . date("i") . ":" . date("s");
if($dataInicial == "")
{
	$dataInicial = NULL;
}

$dataFinal = Funcoes::DataGravacaoSql($_POST["data_final"], $GLOBALS['configSistemaFormatoData']); //. " " . date("H") . ":" . date("i") . ":" . date("s");
if($dataFinal == "")
{
	$dataFinal = NULL;
}

$banner = Funcoes::ConteudoMascaraGravacao01($_POST["banner"]);
$enderecoEletronico = Funcoes::ConteudoMascaraGravacao01($_POST["endereco_eletronico"]);
$codigoHTML = Funcoes::ConteudoMascaraGravacao01($_POST["codigo_html"]);
$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);

$dimensaoW = $_POST["dimensao_w"];
$dimensaoH = $_POST["dimensao_h"];
$ativacao = $_POST["ativacao"];
$nImpressoes = 0;
$nImpressoesContratacao = $_POST["n_impressoes_contratacao"];
if($nImpressoesContratacao == "")
{
	$nImpressoesContratacao = -1;
}

$nCliques = 0;
$nCliquesContratacao = $_POST["n_cliques_contratacao"];
if($nCliquesContratacao == "")
{
	$nCliquesContratacao = -1;
}

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrгo de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.

//Inclusгo de registro no BD.
//----------
$strSqlBannersArquivosInsert = "";
$strSqlBannersArquivosInsert .= "INSERT INTO tb_banners_arquivos ";
$strSqlBannersArquivosInsert .= "SET ";
$strSqlBannersArquivosInsert .= "id = :id, ";
$strSqlBannersArquivosInsert .= "id_tb_banners = :id_tb_banners, ";
$strSqlBannersArquivosInsert .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlBannersArquivosInsert .= "n_classificacao = :n_classificacao, ";
$strSqlBannersArquivosInsert .= "tipo_publicacao = :tipo_publicacao, ";
$strSqlBannersArquivosInsert .= "data_publicacao = :data_publicacao, ";
$strSqlBannersArquivosInsert .= "data_inicial = :data_inicial, ";
$strSqlBannersArquivosInsert .= "data_final = :data_final, ";
$strSqlBannersArquivosInsert .= "banner = :banner, ";
$strSqlBannersArquivosInsert .= "endereco_eletronico = :endereco_eletronico, ";
$strSqlBannersArquivosInsert .= "codigo_html = :codigo_html, ";
$strSqlBannersArquivosInsert .= "obs = :obs, ";
$strSqlBannersArquivosInsert .= "dimensao_w = :dimensao_w, ";
$strSqlBannersArquivosInsert .= "dimensao_h = :dimensao_h, ";
$strSqlBannersArquivosInsert .= "ativacao = :ativacao, ";
$strSqlBannersArquivosInsert .= "n_impressoes = :n_impressoes, ";
$strSqlBannersArquivosInsert .= "n_impressoes_contratacao = :n_impressoes_contratacao, ";
$strSqlBannersArquivosInsert .= "n_cliques = :n_cliques, ";
$strSqlBannersArquivosInsert .= "n_cliques_contratacao = :n_cliques_contratacao ";


$statementBannersArquivosInsert = $dbSistemaConPDO->prepare($strSqlBannersArquivosInsert);

if ($statementBannersArquivosInsert !== false)
{
	$statementBannersArquivosInsert->execute(array(
		"id" => $id,
		"id_tb_banners" => $idTbBanners,
		"id_tb_cadastro" => $idTbCadastro,
		"n_classificacao" => $nClassificacao,
		"tipo_publicacao" => $tipoPublicacao,
		"data_publicacao" => $dataPublicacao,
		"data_inicial" => $dataInicial,
		"data_final" => $dataFinal,
		"banner" => $banner,
		"endereco_eletronico" => $enderecoEletronico,
		"codigo_html" => $codigoHTML,
		"obs" => $obs,
		"dimensao_w" => $dimensaoW,
		"dimensao_h" => $dimensaoH,
		"ativacao" => $ativacao,
		"n_impressoes" => $nImpressoes,
		"n_impressoes_contratacao" => $nImpressoesContratacao,
		"n_cliques" => $nCliques,
		"n_cliques_contratacao" => $nCliquesContratacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificaзгo de gravaзгo.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{
	//Definiзгo do diretуrio de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Definiзгo do nome do arquivo.
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Gravaзгo do arquivo original no servidor.
	$resultadoUpload = Arquivo::ArquivoUpload($id, 
											$_FILES["ArquivoUpload1"], 
											$arquivosDiretorioUpload,
											"" . $arquivoNome);

	if($resultadoUpload == true){
	
	}else{
		$mensagemErro .= $resultadoUpload;
	}
	
	
}

//Update do registro com o nome do arquivo.
$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_banners_arquivos", "arquivo");
if ($resultadoUpdate == true) 
{

}else{
	$mensagemErro .= $resultadoUpdate;
	//$mensagemSucesso = "";
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlBannersArquivosInsert);
unset($statementBannersArquivosInsert);
//----------


//Fechamento da conexгo.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbBanners=" . $idTbBanners .
$queryPadrao .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de saнda.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de pбgina.
//exit();
header("Location: " . $URLRetorno);
die();
?>