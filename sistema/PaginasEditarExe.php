<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbPaginas"];
$idParent = $_POST["id_parent"];

$arrIdsPaginasFiltroGenerico01 = $_POST["idsPaginasFiltroGenerico01"];
$arrIdsPaginasFiltroGenerico02 = $_POST["idsPaginasFiltroGenerico02"];
$arrIdsPaginasFiltroGenerico03 = $_POST["idsPaginasFiltroGenerico03"];
$arrIdsPaginasFiltroGenerico04 = $_POST["idsPaginasFiltroGenerico04"];
$arrIdsPaginasFiltroGenerico05 = $_POST["idsPaginasFiltroGenerico05"];
$arrIdsPaginasFiltroGenerico06 = $_POST["idsPaginasFiltroGenerico06"];
$arrIdsPaginasFiltroGenerico07 = $_POST["idsPaginasFiltroGenerico07"];
$arrIdsPaginasFiltroGenerico08 = $_POST["idsPaginasFiltroGenerico08"];
$arrIdsPaginasFiltroGenerico09 = $_POST["idsPaginasFiltroGenerico09"];
$arrIdsPaginasFiltroGenerico10 = $_POST["idsPaginasFiltroGenerico10"];

$idTbCadastro1 = $_POST["id_tb_cadastro1"];
if($idTbCadastro1 == "")
{
	$idTbCadastro1 = 0;
}
$idTbCadastro2 = $_POST["id_tb_cadastro2"];
if($idTbCadastro2 == "")
{
	$idTbCadastro2 = 0;
}
$idTbCadastro3 = $_POST["id_tb_cadastro3"];
if($idTbCadastro3 == "")
{
	$idTbCadastro3 = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$dataCriacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$titulo = Funcoes::ConteudoMascaraGravacao01($_POST["titulo"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);
$palavrasChave = $_POST["palavras_chave"];

$URL1 = Funcoes::ConteudoMascaraGravacao01($_POST["url1"]);
$URL2 = Funcoes::ConteudoMascaraGravacao01($_POST["url2"]);
$URL3 = Funcoes::ConteudoMascaraGravacao01($_POST["url3"]);
$URL4 = Funcoes::ConteudoMascaraGravacao01($_POST["url4"]);
$URL5 = Funcoes::ConteudoMascaraGravacao01($_POST["url5"]);

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

$ativacao = $_POST["ativacao"];
$ativacao1 = $_POST["ativacao1"];
if($ativacao1 == "")
{
	$ativacao1 = 0;
}
$ativacao2 = $_POST["ativacao2"];
if($ativacao2 == "")
{
	$ativacao2 = 0;
}
$ativacao3 = $_POST["ativacao3"];
if($ativacao3 == "")
{
	$ativacao3 = 0;
}
$ativacao4 = $_POST["ativacao4"];
if($ativacao4 == "")
{
	$ativacao4 = 0;
}

$nVisitas = 0;

$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlPaginasUpdate = "";
$strSqlPaginasUpdate .= "UPDATE tb_paginas ";
$strSqlPaginasUpdate .= "SET ";
//$strSqlPaginasUpdate .= "id = :id, ";
$strSqlPaginasUpdate .= "id_parent = :id_parent, ";

$strSqlPaginasUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlPaginasUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlPaginasUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";

$strSqlPaginasUpdate .= "n_classificacao = :n_classificacao, ";
//$strSqlPaginasUpdate .= "data_criacao = :data_criacao, ";

$strSqlPaginasUpdate .= "titulo = :titulo, ";
$strSqlPaginasUpdate .= "descricao = :descricao, ";
$strSqlPaginasUpdate .= "palavras_chave = :palavras_chave, ";

$strSqlPaginasUpdate .= "url1 = :url1, ";
$strSqlPaginasUpdate .= "url2 = :url2, ";
$strSqlPaginasUpdate .= "url3 = :url3, ";
$strSqlPaginasUpdate .= "url4 = :url4, ";
$strSqlPaginasUpdate .= "url5 = :url5, ";

//$strSqlPaginasUpdate .= "imagem = :imagem ";

$strSqlPaginasUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlPaginasUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlPaginasUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlPaginasUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlPaginasUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlPaginasUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlPaginasUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlPaginasUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlPaginasUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlPaginasUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlPaginasUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlPaginasUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlPaginasUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlPaginasUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlPaginasUpdate .= "informacao_complementar15 = :informacao_complementar15, ";

$strSqlPaginasUpdate .= "ativacao = :ativacao, ";
$strSqlPaginasUpdate .= "ativacao1 = :ativacao1, ";
$strSqlPaginasUpdate .= "ativacao2 = :ativacao2, ";
$strSqlPaginasUpdate .= "ativacao3 = :ativacao3, ";
$strSqlPaginasUpdate .= "ativacao4 = :ativacao4, ";

$strSqlPaginasUpdate .= "n_visitas = :n_visitas, ";
$strSqlPaginasUpdate .= "acesso_restrito = :acesso_restrito ";

$strSqlPaginasUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlPaginasUpdate . "<br />";
//----------


$statementPaginasUpdate = $dbSistemaConPDO->prepare($strSqlPaginasUpdate);


/*
"data_criacao" => $dataCriacao,
*/
if ($statementPaginasUpdate !== false)
{
	$statementPaginasUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"n_classificacao" => $nClassificacao,
		"titulo" => $titulo,
		"descricao" => $descricao,
		"palavras_chave" => $palavrasChave,
		"url1" => $URL1,
		"url2" => $URL2,
		"url3" => $URL3,
		"url4" => $URL4,
		"url5" => $URL5,
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
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"n_visitas" => $nVisitas,
		"acesso_restrito" => $acesso_restrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemPaginas'];
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
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_paginas", "imagem");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
//----------


//Limpeza de objetos.
unset($strSqlPaginasUpdate);
unset($statementPaginasUpdate);
//----------


//Gravação de complementos.
//----------

//Filtro genérico 01.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"12");
if(!empty($arrIdsPaginasFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico01[$countArray], "12", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 02.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"13");
if(!empty($arrIdsPaginasFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico02[$countArray], "13", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 03.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"14");
if(!empty($arrIdsPaginasFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico03[$countArray], "14", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 04.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"15");
if(!empty($arrIdsPaginasFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico04[$countArray], "15", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 05.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"16");
if(!empty($arrIdsPaginasFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico05[$countArray], "16", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 06.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"17");
if(!empty($arrIdsPaginasFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico06[$countArray], "17", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 07.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"18");
if(!empty($arrIdsPaginasFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico07[$countArray], "18", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 08.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"19");
if(!empty($arrIdsPaginasFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico08[$countArray], "19", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 09.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"20");
if(!empty($arrIdsPaginasFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico09[$countArray], "20", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}


//Filtro genérico 10.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_paginas_relacao_complemento", 
									"id_tb_paginas",
									"tipo_complemento", 
									"21");
if(!empty($arrIdsPaginasFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsPaginasFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsPaginasFiltroGenerico10[$countArray], "21", "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento");
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentPaginas=" . $idParent .
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
