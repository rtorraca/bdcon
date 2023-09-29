<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
//ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Função para definição do nome do grupo de e-mails que será usado na gravação do DB.
//**************************************************************************************
function DefinicaoNomeGrupo($numeroParte, $strArquivosUploadNome, $_grupoEmails, $_limiteEmails)
{
	//Variáveis.
	//----------
	$strDefinicaoNomeGrupo = "";
	
	$arrArquivoExtensao = explode(".", $strArquivosUploadNome);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	
	$arquivoNomeSemExtensao = str_replace(("." . $arrArquivoExtensao), "", $strArquivosUploadNome);
	//----------
	
	
	if($_grupoEmails == "")
	{
		//if($strArquivosUploadNome != "")
		if(!empty($strArquivosUploadNome))
		{
			if($_limiteEmails == "0")
			{
				//$strDefinicaoNomeGrupo = $strArquivosUploadNome;
				$strDefinicaoNomeGrupo = $arquivoNomeSemExtensao;
			}else{
				//$strDefinicaoNomeGrupo = $strArquivosUploadNome . " (" . $numeroParte . ")";
				$strDefinicaoNomeGrupo = $arquivoNomeSemExtensao . " (" . $numeroParte . ")";
			}
		}else{
			if($_limiteEmails == "0")
			{
				$strDefinicaoNomeGrupo = $_grupoEmails;
			}else{
				$strDefinicaoNomeGrupo = "(" . $numeroParte . ")";
			}
		}
	}else{
		if($_limiteEmails == "0")
		{
			$strDefinicaoNomeGrupo = $_grupoEmails;
		}else{
			$strDefinicaoNomeGrupo = $_grupoEmails . " (" . $numeroParte . ")";
		}
	}
	
	
	return $strDefinicaoNomeGrupo;
}
//**************************************************************************************


//Rotina para gravar e-mails enviados por arquivo em banco de dados.
//**************************************************************************************
function ArquivoNewsletterEmailAvulsoGravar($idTbNewsletterEmailsAvulsoGrupos, $strArquivosUploadNome, $_limiteEmails, $_grupoEmails, $_ativacao, $_idTbNewsletter)
{
	//Variáveis.
	//----------
	$countEmails = 0;
	$countEmailsErro = 0;
	$countGrupoEmails = 0;
	$countLimiteEmails = 0;
	
	$arrArquivoExtensao = explode(".", $strArquivosUploadNome);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	//$arquivoNome = $id . "." . $arquivoExtensao;

	$nomeGrupoEmail = str_replace(("." . $arrArquivoExtensao), "", $strArquivosUploadNome);
	$arquivoNome = $idTbNewsletterEmailsAvulsoGrupos . "." . $arquivoExtensao;

	$arquivoOriginalCaminhoCompleto = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . $arquivoNome;
	//----------
	
	
	//Mecanismo para começar tentativa de leitura.
	//----------
	$objStreamReader = Arquivo::ArquivosConteudoLer01($arquivoOriginalCaminhoCompleto, 1);
	$arrObjStreamReader = preg_split('/\r\n|\r|\n/', $objStreamReader); //Separa por quebra de linha.
	
	
	//Loop pelo conteúdo do arquivo.
	for($countArrayLinhas = 0; $countArrayLinhas < count($arrObjStreamReader); $countArrayLinhas++)
	{
		$idContedorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
		$strEmailTratado = "";
		$strEmailTratado = trim($arrObjStreamReader[$countArrayLinhas]);
		
		
		//Inclusão em DB por conexões individuais.
		//----------
		//if(!empty($strEmailTratado))
		if($strEmailTratado != "")
		{
			if(DbInsert::InsertNewsletterEmailsAvulso($idContedorUniversal,
			$idTbNewsletterEmailsAvulsoGrupos,
			$strEmailTratado,
			"1") == true)
			{
				$countEmails++;
			}else{
				$countEmailsErro++;
			}
			
			
			$countLimiteEmails++;

		
			if($_limiteEmails != 0)
			{
				if($countLimiteEmails == $_limiteEmails)
				{
					$countLimiteEmails = 0;
					$countGrupoEmails++;
					
					$idContedorUniversal = ContadorUniversal::ContadorUniversalUpdate(1);
					$idTbNewsletterEmailsAvulsoGrupos = $idContedorUniversal;
					
					//Função para gravar grupo de e-mails no DB.
					DbInsert::InsertNewsletterEmailsAvulsoGrupos($idContedorUniversal, 
																$_idTbNewsletter, 
																"",
																DefinicaoNomeGrupo((string)($countGrupoEmails + 1), $strArquivosUploadNome, $_grupoEmails, $_limiteEmails), 
																$_ativacao);
																
					//Debug.
					/*
					echo "idContedorUniversal=" . $idContedorUniversal . "<br />"; 
					echo "idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos . "<br />"; 
					echo "DefinicaoNomeGrupo=" . DefinicaoNomeGrupo((string)($countGrupoEmails + 1), $strArquivosUploadNome, $_grupoEmails, $_limiteEmails) . "<br />"; 
					echo "_ativacao=" . $_ativacao . "<br />"; 
					echo "InsertNewsletterEmailsAvulsoGrupos=" . DbInsert::InsertNewsletterEmailsAvulsoGrupos($idContedorUniversal, 
																$idTbNewsletterEmailsAvulsoGrupos, 
																"",
																DefinicaoNomeGrupo((string)($countGrupoEmails + 1), $strArquivosUploadNome, $_grupoEmails, $_limiteEmails), 
																$_ativacao) . "<br />"; 
					*/
				}
			}
		}
		//----------
		
		//Debug.
		//echo "arrObjStreamReader=" . $arrObjStreamReader[$countArrayLinhas] . "<br />"; 
	}
	//----------
	
	
	//Exclusão do arquivo do servidor.
	Arquivo::ExcluirArquivos02($arquivoNome, $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'], "");
}
//**************************************************************************************


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idTbNewsletter = $_POST["id_tb_newsletter"];

$dataGrupo = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$grupoEmails = Funcoes::ConteudoMascaraGravacao01($_POST["grupo_emails"]);
$ativacao = $_POST["ativacao"];

$limiteEmails = $_POST["limite_emails"];
if($limiteEmails == "")
{
	$limiteEmails = "0";	
}
//$grupoEmails = DefinicaoNomeGrupo("1", $_FILES["ArquivoUpload1"]["name"], $grupoEmails, $limiteEmails);//Redefinição de variáveis.

$gravacaoDb = false;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Debug.
//echo "DefinicaoNomeGrupo=" . DefinicaoNomeGrupo("1", $_FILES["ArquivoUpload1"]["name"], $grupoEmails, $limiteEmails) . "<br />"; 

//$dbSistemaConPDO = null;
//Redirecionamento de página.
//exit();
//header("Location: " . $URLRetorno);
//die();


//Função para gravar grupo de e-mails no DB.
//**************************************************************************************
if(DbInsert::InsertNewsletterEmailsAvulsoGrupos($id, 
												$idTbNewsletter, 
												"",
												DefinicaoNomeGrupo("1", $_FILES["ArquivoUpload1"]["name"], $grupoEmails, $limiteEmails), 
												$ativacao) == true)
{
	$gravacaoDb = true;
}


if($gravacaoDb == true)
{
	if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do diretório de upload.
		$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
		
		//Definição do nome do arquivo.
		$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
		$arquivoExtensao = strtolower(end($arrArquivoExtensao));
		$arquivoNome = $id . "." . $arquivoExtensao;
		
		
		//Gravação do arquivo original no servidor.
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"" . $arquivoNome);
	
		if($resultadoUpload == true){
			ArquivoNewsletterEmailAvulsoGravar($id, $_FILES["ArquivoUpload1"]["name"], $limiteEmails, $grupoEmails, $ativacao, $idTbNewsletter);
		}else{
			//$mensagemErro .= $resultadoUpload;
		}
	}else{
		//Não tem arquivo.
	}
}
//**************************************************************************************


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbNewsletter=" . $idTbNewsletter .
$queryPadrao .
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de saída.
/*
while (ob_get_status()) 
{
    ob_end_clean();
}
*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>