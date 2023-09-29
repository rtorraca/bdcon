<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbAfiliacoes"];
$idTbCategorias = $_POST["id_tb_categorias"];

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataProduto = Funcoes::DataGravacaoSql($_POST["data_publicacao"], $GLOBALS['configSistemaFormatoData']);
//if($dataProduto == "")
//{
	//$data_publicacao = NULL;	
	//$dataProduto = date("Y") . "-" . date("m") . "-" . date("d");	
//}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$afiliacao = Funcoes::ConteudoMascaraGravacao01($_POST["afiliacao"]);

$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);
$tipoCobranca = $_POST["tipo_cobranca"];
if($tipoCobranca == "")
{
	$tipoCobranca = 0;
}

$valor = Funcoes::MascaraValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;
}

$ativacao = $_POST["ativacao"];

$configuracaoPeriodoContratacao = $_POST["configuracao_periodo_contratacao"];
if($configuracaoPeriodoContratacao == "")
{
	$configuracaoPeriodoContratacao = 0;
}

$configuracaoComplementar = $_POST["configuracao_complementar"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlAfiliacoesUpdate = "";
$strSqlAfiliacoesUpdate .= "UPDATE tb_afiliacoes ";
$strSqlAfiliacoesUpdate .= "SET ";
//$strSqlAfiliacoesUpdate .= "id = :id, ";
$strSqlAfiliacoesUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlAfiliacoesUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlAfiliacoesUpdate .= "afiliacao = :afiliacao, ";
$strSqlAfiliacoesUpdate .= "descricao = :descricao, ";
$strSqlAfiliacoesUpdate .= "tipo_cobranca = :tipo_cobranca, ";
$strSqlAfiliacoesUpdate .= "valor = :valor, ";
$strSqlAfiliacoesUpdate .= "ativacao = :ativacao, ";
$strSqlAfiliacoesUpdate .= "configuracao_periodo_contratacao = :configuracao_periodo_contratacao, ";
$strSqlAfiliacoesUpdate .= "configuracao_complementar = :configuracao_complementar ";
//$strSqlAfiliacoesUpdate .= "n_visitas = :n_visitas ";

$strSqlAfiliacoesUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlAfiliacoesUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementAfiliacoesUpdate = $dbSistemaConPDO->prepare($strSqlAfiliacoesUpdate);

/*
"n_visitas" => $n_visitas
*/
if ($statementAfiliacoesUpdate !== false)
{
	$statementAfiliacoesUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"n_classificacao" => $nClassificacao,
		"afiliacao" => $afiliacao,
		"descricao" => $descricao,
		"tipo_cobranca" => $tipoCobranca,
		"valor" => $valor,
		"ativacao" => $ativacao,
		"configuracao_periodo_contratacao" => $configuracaoPeriodoContratacao,
		"configuracao_complementar" => $configuracaoComplementar
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlAfiliacoesUpdate);
unset($statementAfiliacoesUpdate);
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemAfiliacoes'];
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
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_afiliacoes", "imagem");
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
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentAfiliacoes=" . $idTbCategorias .
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