<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbEnquetes"];
$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastro = $_POST["id_tb_cadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$tipoEnquete = $_POST["tipoEnquete"];
if($GLOBALS['ativacaoEnquetesTipo'] == 1)
{
	$tipoEnquete = $_POST["tipo_enquete"];
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataEnquete = Funcoes::DataGravacaoSql($_POST["data_enquete"], $GLOBALS['configSistemaFormatoData']);
if($dataEnquete == "")
{
	//$data_publicacao = NULL;	
	$dataEnquete = date("Y") . "-" . date("m") . "-" . date("d");	
}

$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);
$ativacao = $_POST["ativacao"];
//$resposta = "0";

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect . 
"&tipoEnquete=" . $tipoEnquete;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlEnquetesUpdate = "";
$strSqlEnquetesUpdate .= "UPDATE tb_enquetes ";
$strSqlEnquetesUpdate .= "SET ";
$strSqlEnquetesUpdate .= "id = :id, ";
$strSqlEnquetesUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlEnquetesUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlEnquetesUpdate .= "tipo_enquete = :tipo_enquete, ";
$strSqlEnquetesUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlEnquetesUpdate .= "data_enquete = :data_enquete, ";
$strSqlEnquetesUpdate .= "descricao = :descricao, ";
$strSqlEnquetesUpdate .= "ativacao = :ativacao ";
//$strSqlEnquetesUpdate .= "resposta = :resposta ";

$strSqlEnquetesUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlEnquetesUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementEnquetesUpdate = $dbSistemaConPDO->prepare($strSqlEnquetesUpdate);

/*
"resposta" => $resposta
*/
if ($statementEnquetesUpdate !== false)
{
	$statementEnquetesUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro" => $idTbCadastro,
		"tipo_enquete" => $tipoEnquete,
		"n_classificacao" => $nClassificacao,
		"data_enquete" => $dataEnquete,
		"descricao" => $descricao,
		"ativacao" => $ativacao
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlEnquetesUpdate);
unset($statementEnquetesUpdate);
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemEnquetes'];
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
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_enquetes", "imagem");
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
"idParentEnquetes=" . $idTbCategorias . 
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