<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idCeOrcamentos = $_POST["id_ce_orcamentos"];

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$itemTitulo = Funcoes::ConteudoMascaraGravacao01($_POST["item_titulo"]);
$itemDescricao = Funcoes::ConteudoMascaraGravacao01($_POST["item_descricao"]);

$data1 = NULL;
$data2 = NULL;
$data3 = NULL;
$data4 = NULL;
$data5 = NULL;

$url1 = "";
$url2 = "";
$url3 = "";

$idTbCadastro1 = "0";
$idTbCadastro2 = "0";
$idTbCadastro3 = "0";

$ativacao = $_POST["ativacao"];
$ativacao1 = "0";
$ativacao2 = "0";
$ativacao3 = "0";
$ativacao4 = "0";

$valor = "0";
$valor1 = "0";
$valor2 = "0";

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

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.

//Inclusão de registro no BD.
//----------
$strSqlOrcamentosItensInsert = "";
$strSqlOrcamentosItensInsert .= "INSERT INTO ce_orcamentos_itens ";
$strSqlOrcamentosItensInsert .= "SET ";
$strSqlOrcamentosItensInsert .= "id = :id, ";
$strSqlOrcamentosItensInsert .= "id_ce_orcamentos = :id_ce_orcamentos, ";
$strSqlOrcamentosItensInsert .= "n_classificacao = :n_classificacao, ";
$strSqlOrcamentosItensInsert .= "item_titulo = :item_titulo, ";
$strSqlOrcamentosItensInsert .= "item_descricao = :item_descricao, ";
$strSqlOrcamentosItensInsert .= "data1 = :data1, ";
$strSqlOrcamentosItensInsert .= "data2 = :data2, ";
$strSqlOrcamentosItensInsert .= "data3 = :data3, ";
$strSqlOrcamentosItensInsert .= "data4 = :data4, ";
$strSqlOrcamentosItensInsert .= "data5 = :data5, ";
$strSqlOrcamentosItensInsert .= "url1 = :url1, ";
$strSqlOrcamentosItensInsert .= "url2 = :url2, ";
$strSqlOrcamentosItensInsert .= "url3 = :url3, ";
$strSqlOrcamentosItensInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlOrcamentosItensInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlOrcamentosItensInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlOrcamentosItensInsert .= "valor = :valor, ";
$strSqlOrcamentosItensInsert .= "valor1 = :valor1, ";
$strSqlOrcamentosItensInsert .= "valor2 = :valor2, ";
$strSqlOrcamentosItensInsert .= "ativacao = :ativacao, ";
$strSqlOrcamentosItensInsert .= "ativacao1 = :ativacao1, ";
$strSqlOrcamentosItensInsert .= "ativacao2 = :ativacao2, ";
$strSqlOrcamentosItensInsert .= "ativacao3 = :ativacao3, ";
$strSqlOrcamentosItensInsert .= "ativacao4 = :ativacao4, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlOrcamentosItensInsert .= "informacao_complementar10 = :informacao_complementar10 ";


$statementOrcamentosItensInsert = $dbSistemaConPDO->prepare($strSqlOrcamentosItensInsert);

if ($statementOrcamentosItensInsert !== false)
{
	$statementOrcamentosItensInsert->execute(array(
		"id" => $id,
		"id_ce_orcamentos" => $idCeOrcamentos,
		"n_classificacao" => $nClassificacao,
		"item_titulo" => $itemTitulo,
		"item_descricao" => $itemDescricao,
		"data1" => $data1,
		"data2" => $data2,
		"data3" => $data3,
		"data4" => $data4,
		"data5" => $data5,
		"url1" => $url1,
		"url2" => $url2,
		"url3" => $url3,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"valor" => $valor,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"informacao_complementar6" => $informacaoComplementar6,
		"informacao_complementar7" => $informacaoComplementar7,
		"informacao_complementar8" => $informacaoComplementar8,
		"informacao_complementar9" => $informacaoComplementar9,
		"informacao_complementar10" => $informacaoComplementar10
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Upload de arquivos.
//----------

//Definição do tamanho das imagens.
$arrImagemTamanhos = $GLOBALS['arrImagemOrcamentosItens'];
if($GLOBALS['ativacaoImagensPadrao'] == 1)
{
	$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
}

//Definição do diretório de upload.
$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
$countArquivosUpload = 0;


//Arquivo 1.
if($GLOBALS['habilitarOrcamentosItensArquivo1'] == 1)
{
	if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo1Extensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
		$arquivo1Extensao = strtolower(end($arrArquivo1Extensao));
		$arquivo1Nome = $id . "-1" . "." . $arquivo1Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo1Extensao) !== false) {
			$resultadoUpload1 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload1"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo1Nome);
		}else{
			$resultadoUpload1 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload1"], 
													$arquivosDiretorioUpload,
													"" . $arquivo1Nome);
		}
	
		if($resultadoUpload1 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate1 = DbUpdate::DbRegistroGenericoUpdate01($arquivo1Nome, $id, "ce_orcamentos_itens", "arquivo1");
			if ($resultadoUpdate1 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo1Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo1Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate1;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload1;
		}
	}
}


//Arquivo 2.
if($GLOBALS['habilitarOrcamentosItensArquivo2'] == 1)
{
	if(!empty($_FILES["ArquivoUpload2"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo2Extensao = explode(".", $_FILES["ArquivoUpload2"]["name"]);
		$arquivo2Extensao = strtolower(end($arrArquivo2Extensao));
		$arquivo2Nome = $id . "-2" . "." . $arquivo2Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo2Extensao) !== false) {
			$resultadoUpload2 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload2"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo2Nome);
		}else{
			$resultadoUpload2 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload2"], 
													$arquivosDiretorioUpload,
													"" . $arquivo2Nome);
		}
	
		if($resultadoUpload2 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate2 = DbUpdate::DbRegistroGenericoUpdate01($arquivo2Nome, $id, "ce_orcamentos_itens", "arquivo2");
			if ($resultadoUpdate2 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo2Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo2Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate2;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload2;
		}
	}
}


//Arquivo 3.
if($GLOBALS['habilitarOrcamentosItensArquivo3'] == 1)
{
	if(!empty($_FILES["ArquivoUpload3"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo3Extensao = explode(".", $_FILES["ArquivoUpload3"]["name"]);
		$arquivo3Extensao = strtolower(end($arrArquivo3Extensao));
		$arquivo3Nome = $id . "-3" . "." . $arquivo3Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo3Extensao) !== false) {
			$resultadoUpload3 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload3"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo3Nome);
		}else{
			$resultadoUpload3 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload3"], 
													$arquivosDiretorioUpload,
													"" . $arquivo3Nome);
		}
	
		if($resultadoUpload3 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate3 = DbUpdate::DbRegistroGenericoUpdate01($arquivo3Nome, $id, "ce_orcamentos_itens", "arquivo3");
			if ($resultadoUpdate3 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo3Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo3Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate3;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload3;
		}
	}
}


//Arquivo 4.
if($GLOBALS['habilitarOrcamentosItensArquivo4'] == 1)
{
	if(!empty($_FILES["ArquivoUpload4"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo4Extensao = explode(".", $_FILES["ArquivoUpload4"]["name"]);
		$arquivo4Extensao = strtolower(end($arrArquivo4Extensao));
		$arquivo4Nome = $id . "-4" . "." . $arquivo4Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo4Extensao) !== false) {
			$resultadoUpload4 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload4"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo4Nome);
		}else{
			$resultadoUpload4 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload4"], 
													$arquivosDiretorioUpload,
													"" . $arquivo4Nome);
		}
	
		if($resultadoUpload4 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate4 = DbUpdate::DbRegistroGenericoUpdate01($arquivo4Nome, $id, "ce_orcamentos_itens", "arquivo4");
			if ($resultadoUpdate4 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo4Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo4Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate4;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload4;
		}
	}
}


//Arquivo 5.
if($GLOBALS['habilitarOrcamentosItensArquivo5'] == 1)
{
	if(!empty($_FILES["ArquivoUpload5"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo5Extensao = explode(".", $_FILES["ArquivoUpload5"]["name"]);
		$arquivo5Extensao = strtolower(end($arrArquivo5Extensao));
		$arquivo5Nome = $id . "-5" . "." . $arquivo5Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo5Extensao) !== false) {
			$resultadoUpload5 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload5"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo5Nome);
		}else{
			$resultadoUpload5 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload5"], 
													$arquivosDiretorioUpload,
													"" . $arquivo5Nome);
		}
	
		if($resultadoUpload5 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate5 = DbUpdate::DbRegistroGenericoUpdate01($arquivo5Nome, $id, "ce_orcamentos_itens", "arquivo5");
			if ($resultadoUpdate5 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo5Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo5Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate5;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload5;
		}
	}
}


//Arquivo 6.
if($GLOBALS['habilitarOrcamentosItensArquivo6'] == 1)
{
	if(!empty($_FILES["ArquivoUpload6"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo6Extensao = explode(".", $_FILES["ArquivoUpload6"]["name"]);
		$arquivo6Extensao = strtolower(end($arrArquivo6Extensao));
		$arquivo6Nome = $id . "-6" . "." . $arquivo6Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo6Extensao) !== false) {
			$resultadoUpload6 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload6"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo6Nome);
		}else{
			$resultadoUpload6 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload6"], 
													$arquivosDiretorioUpload,
													"" . $arquivo6Nome);
		}
	
		if($resultadoUpload6 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate6 = DbUpdate::DbRegistroGenericoUpdate01($arquivo6Nome, $id, "ce_orcamentos_itens", "arquivo6");
			if ($resultadoUpdate6 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo6Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo6Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate6;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload6;
		}
	}
}


//Arquivo 7.
if($GLOBALS['habilitarOrcamentosItensArquivo7'] == 1)
{
	if(!empty($_FILES["ArquivoUpload7"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo7Extensao = explode(".", $_FILES["ArquivoUpload7"]["name"]);
		$arquivo7Extensao = strtolower(end($arrArquivo7Extensao));
		$arquivo7Nome = $id . "-7" . "." . $arquivo7Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo7Extensao) !== false) {
			$resultadoUpload7 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload7"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo7Nome);
		}else{
			$resultadoUpload7 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload7"], 
													$arquivosDiretorioUpload,
													"" . $arquivo7Nome);
		}
	
		if($resultadoUpload7 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate7 = DbUpdate::DbRegistroGenericoUpdate01($arquivo7Nome, $id, "ce_orcamentos_itens", "arquivo7");
			if ($resultadoUpdate7 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo7Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo7Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate7;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload7;
		}
	}
}


//Arquivo 8.
if($GLOBALS['habilitarOrcamentosItensArquivo8'] == 1)
{
	if(!empty($_FILES["ArquivoUpload8"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo8Extensao = explode(".", $_FILES["ArquivoUpload8"]["name"]);
		$arquivo8Extensao = strtolower(end($arrArquivo8Extensao));
		$arquivo8Nome = $id . "-8" . "." . $arquivo8Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo8Extensao) !== false) {
			$resultadoUpload8 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload8"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo8Nome);
		}else{
			$resultadoUpload8 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload8"], 
													$arquivosDiretorioUpload,
													"" . $arquivo8Nome);
		}
	
		if($resultadoUpload8 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate8 = DbUpdate::DbRegistroGenericoUpdate01($arquivo8Nome, $id, "ce_orcamentos_itens", "arquivo8");
			if ($resultadoUpdate8 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo8Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo8Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate8;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload8;
		}
	}
}


//Arquivo 9.
if($GLOBALS['habilitarOrcamentosItensArquivo9'] == 1)
{
	if(!empty($_FILES["ArquivoUpload9"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo9Extensao = explode(".", $_FILES["ArquivoUpload9"]["name"]);
		$arquivo9Extensao = strtolower(end($arrArquivo9Extensao));
		$arquivo9Nome = $id . "-9" . "." . $arquivo9Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo9Extensao) !== false) {
			$resultadoUpload9 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload9"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo9Nome);
		}else{
			$resultadoUpload9 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload9"], 
													$arquivosDiretorioUpload,
													"" . $arquivo9Nome);
		}
	
		if($resultadoUpload9 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate9 = DbUpdate::DbRegistroGenericoUpdate01($arquivo9Nome, $id, "ce_orcamentos_itens", "arquivo9");
			if ($resultadoUpdate9 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo9Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo9Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate9;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload9;
		}
	}
}


//Arquivo 10.
if($GLOBALS['habilitarOrcamentosItensArquivo10'] == 1)
{
	if(!empty($_FILES["ArquivoUpload10"]["name"])) //Verifica se arquivos foram postados.
	{
		//Definição do nome do arquivo.
		$arrArquivo10Extensao = explode(".", $_FILES["ArquivoUpload10"]["name"]);
		$arquivo10Extensao = strtolower(end($arrArquivo10Extensao));
		$arquivo10Nome = $id . "-10" . "." . $arquivo10Extensao;
		
		
		//Gravação do arquivo original no servidor.
		if(strpos($GLOBALS['configImagensFormatos'], $arquivo10Extensao) !== false) {
			$resultadoUpload10 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload10"], 
													$arquivosDiretorioUpload,
													"o" . $arquivo10Nome);
		}else{
			$resultadoUpload10 = Arquivo::ArquivoUpload($id, 
													$_FILES["ArquivoUpload10"], 
													$arquivosDiretorioUpload,
													"" . $arquivo10Nome);
		}
	
		if($resultadoUpload10 == true){
			//Update do registro com o nome do arquivo.
			$resultadoUpdate10 = DbUpdate::DbRegistroGenericoUpdate01($arquivo10Nome, $id, "ce_orcamentos_itens", "arquivo10");
			if ($resultadoUpdate10 == true) 
			{
				//Verificação de formato do arquivo.
				if(strpos($GLOBALS['configImagensFormatos'], $arquivo10Extensao) !== false) {
					//Redimensionamento de arquivos.
					Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
												$arquivosDiretorioUpload, 
												$arquivo10Nome);
				}else{
					$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
					//$mensagemSucesso = "";
				}
				
				$countArquivosUpload = $countArquivosUpload + 1;
			}else{
				$mensagemErro .= $resultadoUpdate10;
				//$mensagemSucesso = "";
			}
		}else{
			$mensagemErro .= $resultadoUpload10;
		}
	}
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlOrcamentosItensInsert);
unset($statementOrcamentosItensInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idCeOrcamentos=" . $idCeOrcamentos .
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