<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importaзгo dos arquivos de configuraзгo.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variбveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbBannersArquivos"];
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

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

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


//Update de registro no BD.
//----------
$strSqlBannersArquivosUpdate = "";
$strSqlBannersArquivosUpdate .= "UPDATE tb_banners_arquivos ";
$strSqlBannersArquivosUpdate .= "SET ";
//$strSqlBannersArquivosUpdate .= "id = :id, ";
$strSqlBannersArquivosUpdate .= "id_tb_banners = :id_tb_banners, ";
$strSqlBannersArquivosUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlBannersArquivosUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlBannersArquivosUpdate .= "tipo_publicacao = :tipo_publicacao, ";
//$strSqlBannersArquivosUpdate .= "data_publicacao = :data_publicacao, ";
$strSqlBannersArquivosUpdate .= "data_inicial = :data_inicial, ";
$strSqlBannersArquivosUpdate .= "data_final = :data_final, ";
$strSqlBannersArquivosUpdate .= "banner = :banner, ";
$strSqlBannersArquivosUpdate .= "endereco_eletronico = :endereco_eletronico, ";
$strSqlBannersArquivosUpdate .= "codigo_html = :codigo_html, ";
$strSqlBannersArquivosUpdate .= "obs = :obs, ";
$strSqlBannersArquivosUpdate .= "dimensao_w = :dimensao_w, ";
$strSqlBannersArquivosUpdate .= "dimensao_h = :dimensao_h, ";
//$strSqlBannersArquivosUpdate .= "ativacao = :ativacao, ";
$strSqlBannersArquivosUpdate .= "ativacao = :ativacao ";
//$strSqlBannersArquivosUpdate .= "arquivo = :arquivo, ";
//$strSqlBannersArquivosUpdate .= "n_impressoes = :n_impressoes, ";
//$strSqlBannersArquivosUpdate .= "n_impressoes_contratacao = :n_impressoes_contratacao, ";
//$strSqlBannersArquivosUpdate .= "n_cliques = :n_cliques, ";
//$strSqlBannersArquivosUpdate .= "n_cliques_contratacao = :n_cliques_contratacao ";
$strSqlBannersArquivosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlBannersArquivosUpdate . "<br />";
//----------


//Parвmetros.
//----------
$statementBannersArquivosUpdate = $dbSistemaConPDO->prepare($strSqlBannersArquivosUpdate);

/*
"data_publicacao" => $dataPublicacao,
"n_impressoes" => $nImpressoes,
"n_impressoes_contratacao" => $nImpressoesContratacao,
"n_cliques" => $nCliques,
"n_cliques_contratacao" => $nCliquesContratacao
"arquivo" => $arquivo
*/
if ($statementBannersArquivosUpdate !== false)
{
	$statementBannersArquivosUpdate->execute(array(
		"id" => $id,
		"id_tb_banners" => $idTbBanners,
		"id_tb_cadastro" => $idTbCadastro,
		"n_classificacao" => $nClassificacao,
		"tipo_publicacao" => $tipoPublicacao,
		"data_inicial" => $dataInicial,
		"data_final" => $dataFinal,
		"banner" => $banner,
		"endereco_eletronico" => $enderecoEletronico,
		"codigo_html" => $codigoHTML,
		"obs" => $obs,
		"dimensao_w" => $dimensaoW,
		"dimensao_h" => $dimensaoH,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
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
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_banners_arquivos", "arquivo");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}

//----------


//Limpeza de objetos.
//----------
unset($strSqlBannersArquivosUpdate);
unset($statementBannersArquivosUpdate);
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