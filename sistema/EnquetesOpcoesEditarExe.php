<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbEnquetesOpcoes"];
$idTbEnquetes = $_POST["id_tb_enquetes"];

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$opcao = Funcoes::ConteudoMascaraGravacao01($_POST["opcao"]);
$ativacao = $_POST["ativacao"];
//$nVotos = "0";

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlEnquetesOpcoesUpdate = "";
$strSqlEnquetesOpcoesUpdate .= "UPDATE tb_enquetes_opcoes ";
$strSqlEnquetesOpcoesUpdate .= "SET ";
//$strSqlEnquetesOpcoesUpdate .= "id = :id, ";
//$strSqlEnquetesOpcoesUpdate .= "id = :id, ";
$strSqlEnquetesOpcoesUpdate .= "id_tb_enquetes = :id_tb_enquetes, ";
$strSqlEnquetesOpcoesUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlEnquetesOpcoesUpdate .= "opcao = :opcao, ";
$strSqlEnquetesOpcoesUpdate .= "ativacao = :ativacao ";
$strSqlEnquetesOpcoesUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlEnquetesOpcoesUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementEnquetesOpcoesUpdate = $dbSistemaConPDO->prepare($strSqlEnquetesOpcoesUpdate);

/*
"n_votos" => $nVotos
*/
if ($statementEnquetesOpcoesUpdate !== false)
{
	$statementEnquetesOpcoesUpdate->execute(array(
		"id" => $id,
		"id_tb_enquetes" => $idTbEnquetes,
		"n_classificacao" => $nClassificacao,
		"opcao" => $opcao,
		"ativacao" => $ativacao,
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

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemEnquetesOpcoes'];
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
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_enquetes_opcoes", "arquivo");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
//----------


//Limpeza de objetos.
unset($strSqlEnquetesOpcoesUpdate);
unset($statementEnquetesOpcoesUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbEnquetes=" . $idTbEnquetes .
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