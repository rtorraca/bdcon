<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importa��o dos arquivos de configura��o.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de vari�veis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbConteudo"];
$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastro = $_POST["idTbCadastro"];
if($idTbCadastro == "")
{
	$idTbCadastro = 0;
}

$tipoConteudo = $_POST["tipo_conteudo"];
$alinhamentoTexto = $_POST["alinhamento_texto"];
$alinhamentoImagem = $_POST["alinhamento_imagem"];
if($alinhamentoImagem == "")
{
	$alinhamentoImagem = 0;
}

$strConteudo = "";
$conteudo = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo"]);
$conteudoImagem = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo_imagem"]);
if($strConteudo == "")
{
	$strConteudo = $conteudo;
}
if($strConteudo == "")
{
	$strConteudo = $conteudoImagem;
}

$conteudoLink = Funcoes::ConteudoMascaraGravacao01($_POST["conteudo_link"]);

$configArquivo = $_POST["config_arquivo"];
if($configArquivo == "")
{
	$configArquivo = 0;
}

$dimensaoArquivo = $_POST["dimensao_w"] . "," . $_POST["dimensao_h"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlConteudoUpdate = "";
$strSqlConteudoUpdate .= "UPDATE tb_conteudo ";
$strSqlConteudoUpdate .= "SET ";
//$strSqlConteudoUpdate .= "id = :id, ";
$strSqlConteudoUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlConteudoUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlConteudoUpdate .= "id_tb_cadastro = :id_tb_cadastro, ";
$strSqlConteudoUpdate .= "tipo_conteudo = :tipo_conteudo, ";
$strSqlConteudoUpdate .= "alinhamento_texto = :alinhamento_texto, ";
$strSqlConteudoUpdate .= "alinhamento_imagem = :alinhamento_imagem, ";
$strSqlConteudoUpdate .= "conteudo = :conteudo, ";
$strSqlConteudoUpdate .= "conteudo_link = :conteudo_link, ";
//$strSqlConteudoUpdate .= "arquivo = :arquivo, ";
$strSqlConteudoUpdate .= "config_arquivo = :config_arquivo, ";
$strSqlConteudoUpdate .= "dimensao_arquivo = :dimensao_arquivo ";
$strSqlConteudoUpdate .= "WHERE id = :id ";

$statementConteudoUpdate = $dbSistemaConPDO->prepare($strSqlConteudoUpdate);

if ($statementConteudoUpdate !== false)
{
	$statementConteudoUpdate->execute(array(
		"id" => $id,
		"n_classificacao" => $nClassificacao,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro" => $idTbCadastro,
		"tipo_conteudo" => $tipoConteudo,
		"alinhamento_texto" => $alinhamentoTexto,
		"alinhamento_imagem" => $alinhamentoImagem,
		"conteudo" => $strConteudo,
		"conteudo_link" => $conteudoLink,
		"config_arquivo" => $configArquivo,
		"dimensao_arquivo" => $dimensaoArquivo
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}

//Limpeza de objetos.
unset($strSqlConteudoUpdate);
unset($statementConteudoUpdate);
//----------


//Divis�o de colunas.
//Obs: Modificar esta l�gica no futuro para entrar no modo de exclus�o e inclus�o de colunas individualmente.
//*********************************************************************************************************************
if($tipoConteudo == "10")
{
	$idTbConteudo = $id;
	
	//Exclus�o das colunas anteriores.
	DbExcluir::ExcluirRegistrosGenerico01($idTbConteudo, "tb_conteudo_colunas", "id_tb_conteudo");
	
	for($countColunas = 1; $countColunas <= $strConteudo; $countColunas++)
	{
		$idTbConteudoColunas = ContadorUniversal::ContadorUniversalUpdate(1);
		
		//Inclus�o de registro no BD.
		//----------
		$strSqlConteudoColunasInsert = "";
		$strSqlConteudoColunasInsert .= "INSERT INTO tb_conteudo_colunas ";
		$strSqlConteudoColunasInsert .= "SET ";
		$strSqlConteudoColunasInsert .= "id = :id, ";
		$strSqlConteudoColunasInsert .= "id_tb_conteudo = :id_tb_conteudo, ";
		$strSqlConteudoColunasInsert .= "n_classificacao = :n_classificacao ";
		
		$statementConteudoColunasInsert = $dbSistemaConPDO->prepare($strSqlConteudoColunasInsert);
		
		if ($statementConteudoColunasInsert !== false)
		{
			$statementConteudoColunasInsert->execute(array(
				"id" => $idTbConteudoColunas,
				"id_tb_conteudo" => $idTbConteudo,
				"n_classificacao" => $nClassificacao
			));
			//"conteudo" => $conteudo,
			
			$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
		}else{
			//echo "erro";
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
		}
		
		//Limpeza de objetos.
		unset($strSqlConteudoColunasInsert);
		unset($statementConteudoColunasInsert);
		//----------
	}
}
//*********************************************************************************************************************


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{
	//Defini��o do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemConteudo'];
	if($GLOBALS['ativacaoImagensPadrao'] == 1)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	}
	
	
	//Exclus�o dos arquivo antigos.
	Arquivo::ExcluirArquivos(DbFuncoes::GetCampoGenerico01($id, "tb_conteudo", "arquivo"), $arrImagemTamanhos); //Exclus�o de arquivos.
	
	
	//Defini��o do diret�rio de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Defini��o do nome do arquivo.
	//$allowedExts = array("gif", "jpeg", "jpg", "png");
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Grava��o do arquivo original no servidor.
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

	
	//Verifica��o de formato do arquivo.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		//Redimensionamento de arquivos.
		Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
									$arquivosDiretorioUpload, 
									$arquivoNome);
	}else{
		if($tipoConteudo <> 8 && $tipoConteudo <> 6 && $tipoConteudo <> 11){
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
		}
		//$mensagemSucesso = "";
	}
	
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_conteudo", "arquivo");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
//----------


//Fechamento da conex�o.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentConteudo=" . $idTbCategorias .
"&masterPageSelect=" . $masterPageSelect .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de sa�da.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de p�gina.
//exit();
header("Location: " . $URLRetorno);
die();
?>
