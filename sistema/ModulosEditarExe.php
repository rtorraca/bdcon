<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbModulos"];
$idParent = $_POST["id_parent"];
$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];

$arrIdsModulosFiltroGenerico01 = $_POST["idsModulosFiltroGenerico01"];
$arrIdsModulosFiltroGenerico02 = $_POST["idsModulosFiltroGenerico02"];
$arrIdsModulosFiltroGenerico03 = $_POST["idsModulosFiltroGenerico03"];
$arrIdsModulosFiltroGenerico04 = $_POST["idsModulosFiltroGenerico04"];
$arrIdsModulosFiltroGenerico05 = $_POST["idsModulosFiltroGenerico05"];
$arrIdsModulosFiltroGenerico06 = $_POST["idsModulosFiltroGenerico06"];
$arrIdsModulosFiltroGenerico07 = $_POST["idsModulosFiltroGenerico07"];
$arrIdsModulosFiltroGenerico08 = $_POST["idsModulosFiltroGenerico08"];
$arrIdsModulosFiltroGenerico09 = $_POST["idsModulosFiltroGenerico09"];
$arrIdsModulosFiltroGenerico10 = $_POST["idsModulosFiltroGenerico10"];
$arrIdsModulosFiltroGenerico11 = $_POST["idsModulosFiltroGenerico11"];
$arrIdsModulosFiltroGenerico12 = $_POST["idsModulosFiltroGenerico12"];
$arrIdsModulosFiltroGenerico13 = $_POST["idsModulosFiltroGenerico13"];
$arrIdsModulosFiltroGenerico14 = $_POST["idsModulosFiltroGenerico14"];
$arrIdsModulosFiltroGenerico15 = $_POST["idsModulosFiltroGenerico15"];
$arrIdsModulosFiltroGenerico16 = $_POST["idsModulosFiltroGenerico16"];
$arrIdsModulosFiltroGenerico17 = $_POST["idsModulosFiltroGenerico17"];
$arrIdsModulosFiltroGenerico18 = $_POST["idsModulosFiltroGenerico18"];
$arrIdsModulosFiltroGenerico19 = $_POST["idsModulosFiltroGenerico19"];
$arrIdsModulosFiltroGenerico20 = $_POST["idsModulosFiltroGenerico20"];

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
$idTbCadastro4 = $_POST["id_tb_cadastro4"];
if($idTbCadastro4 == "")
{
	$idTbCadastro4 = 0;
}

$idTbCadastro5 = $_POST["id_tb_cadastro5"];
if($idTbCadastro5 == "")
{
	$idTbCadastro5 = 0;
}

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$dataCriacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$dataInicio = Funcoes::DataGravacaoSql($_POST["data_inicio"], $GLOBALS['configSistemaFormatoData']);
if($dataInicio == "")
{
	$dataInicio = NULL;	
}
$dataFinal = Funcoes::DataGravacaoSql($_POST["data_final"], $GLOBALS['configSistemaFormatoData']);
if($dataFinal == "")
{
	$dataFinal = NULL;	
}

$data1 = Funcoes::DataGravacaoSql($_POST["data1"], $GLOBALS['configSistemaFormatoData']);
if($data1 == "")
{
	$data1 = NULL;	
}
$data2 = Funcoes::DataGravacaoSql($_POST["data2"], $GLOBALS['configSistemaFormatoData']);
if($data2 == "")
{
	$data2 = NULL;	
}
$data3 = Funcoes::DataGravacaoSql($_POST["data3"], $GLOBALS['configSistemaFormatoData']);
if($data3 == "")
{
	$data3 = NULL;	
}
$data4 = Funcoes::DataGravacaoSql($_POST["data4"], $GLOBALS['configSistemaFormatoData']);
if($data4 == "")
{
	$data4 = NULL;	
}
$data5 = Funcoes::DataGravacaoSql($_POST["data5"], $GLOBALS['configSistemaFormatoData']);
if($data5 == "")
{
	$data5 = NULL;	
}
$data6 = Funcoes::DataGravacaoSql($_POST["data6"], $GLOBALS['configSistemaFormatoData']);
if($data6 == "")
{
	$data6 = NULL;	
}
$data7 = Funcoes::DataGravacaoSql($_POST["data7"], $GLOBALS['configSistemaFormatoData']);
if($data7 == "")
{
	$data7 = NULL;	
}
$data8 = Funcoes::DataGravacaoSql($_POST["data8"], $GLOBALS['configSistemaFormatoData']);
if($data8 == "")
{
	$data8 = NULL;	
}
$data9 = Funcoes::DataGravacaoSql($_POST["data9"], $GLOBALS['configSistemaFormatoData']);
if($data9 == "")
{
	$data9 = NULL;	
}
$data10 = Funcoes::DataGravacaoSql($_POST["data10"], $GLOBALS['configSistemaFormatoData']);
if($data10 == "")
{
	$data10 = NULL;	
}

$nomeModulo = Funcoes::ConteudoMascaraGravacao01($_POST["nome_modulo"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$idTbModulosStatus = $_POST["id_tb_modulos_status"];
if($idTbModulosStatus == "")
{
	$idTbModulosStatus = 0;
}

$palavrasChave = $_POST["palavras_chave"];

$valor = Funcoes::FormatarValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;	
}

$valor1 = 0;
$valor2 = 0;
$valor3 = 0;
$valor4 = 0;
$valor5 = 0;

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
$informacaoComplementar51 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar51"]);
$informacaoComplementar52 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar52"]);
$informacaoComplementar53 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar53"]);
$informacaoComplementar54 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar54"]);
$informacaoComplementar55 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar55"]);
$informacaoComplementar56 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar56"]);
$informacaoComplementar57 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar57"]);
$informacaoComplementar58 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar58"]);
$informacaoComplementar59 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar59"]);
$informacaoComplementar60 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar60"]);

$cargaHoraria = $_POST["carga_horaria"];
if($cargaHoraria == "")
{
	$cargaHoraria = 0;
}

$duracaoAula = $_POST["duracao_aula"];
if($duracaoAula == "")
{
	$duracaoAula = 0;
}

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

$anotacoesInternas = Funcoes::ConteudoMascaraGravacao01($_POST["anotacoes_internas"]);
$nVisitas = 0;

$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlModulosUpdate = "";
$strSqlModulosUpdate .= "UPDATE tb_modulos ";
$strSqlModulosUpdate .= "SET ";
//$strSqlModulosUpdate .= "id = :id, ";
//$strSqlModulosUpdate .= "id_parent = :id_parent, ";
//$strSqlModulosUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";

$strSqlModulosUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlModulosUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlModulosUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlModulosUpdate .= "id_tb_cadastro4 = :id_tb_cadastro4, ";
$strSqlModulosUpdate .= "id_tb_cadastro5 = :id_tb_cadastro5, ";

$strSqlModulosUpdate .= "n_classificacao = :n_classificacao, ";

//$strSqlModulosUpdate .= "data_criacao = :data_criacao, ";
$strSqlModulosUpdate .= "data_inicio = :data_inicio, ";
$strSqlModulosUpdate .= "data_final = :data_final, ";

$strSqlModulosUpdate .= "data1 = :data1, ";
$strSqlModulosUpdate .= "data2 = :data2, ";
$strSqlModulosUpdate .= "data3 = :data3, ";
$strSqlModulosUpdate .= "data4 = :data4, ";
$strSqlModulosUpdate .= "data5 = :data5, ";
$strSqlModulosUpdate .= "data6 = :data6, ";
$strSqlModulosUpdate .= "data7 = :data7, ";
$strSqlModulosUpdate .= "data8 = :data8, ";
$strSqlModulosUpdate .= "data9 = :data9, ";
$strSqlModulosUpdate .= "data10 = :data10, ";

$strSqlModulosUpdate .= "nome_modulo = :nome_modulo, ";
$strSqlModulosUpdate .= "descricao = :descricao, ";
$strSqlModulosUpdate .= "id_tb_modulos_status = :id_tb_modulos_status, ";
$strSqlModulosUpdate .= "palavras_chave = :palavras_chave, ";

$strSqlModulosUpdate .= "valor = :valor, ";
$strSqlModulosUpdate .= "valor1 = :valor1, ";
$strSqlModulosUpdate .= "valor2 = :valor2, ";
$strSqlModulosUpdate .= "valor3 = :valor3, ";
$strSqlModulosUpdate .= "valor4 = :valor4, ";
$strSqlModulosUpdate .= "valor5 = :valor5, ";

$strSqlModulosUpdate .= "url1 = :url1, ";
$strSqlModulosUpdate .= "url2 = :url2, ";
$strSqlModulosUpdate .= "url3 = :url3, ";
$strSqlModulosUpdate .= "url4 = :url4, ";
$strSqlModulosUpdate .= "url5 = :url5, ";

$strSqlModulosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlModulosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlModulosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlModulosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlModulosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlModulosUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlModulosUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlModulosUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlModulosUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlModulosUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlModulosUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlModulosUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlModulosUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlModulosUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlModulosUpdate .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlModulosUpdate .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlModulosUpdate .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlModulosUpdate .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlModulosUpdate .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlModulosUpdate .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlModulosUpdate .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlModulosUpdate .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlModulosUpdate .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlModulosUpdate .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlModulosUpdate .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlModulosUpdate .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlModulosUpdate .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlModulosUpdate .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlModulosUpdate .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlModulosUpdate .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlModulosUpdate .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlModulosUpdate .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlModulosUpdate .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlModulosUpdate .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlModulosUpdate .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlModulosUpdate .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlModulosUpdate .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlModulosUpdate .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlModulosUpdate .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlModulosUpdate .= "informacao_complementar40 = :informacao_complementar40, ";
$strSqlModulosUpdate .= "informacao_complementar41 = :informacao_complementar41, ";
$strSqlModulosUpdate .= "informacao_complementar42 = :informacao_complementar42, ";
$strSqlModulosUpdate .= "informacao_complementar43 = :informacao_complementar43, ";
$strSqlModulosUpdate .= "informacao_complementar44 = :informacao_complementar44, ";
$strSqlModulosUpdate .= "informacao_complementar45 = :informacao_complementar45, ";
$strSqlModulosUpdate .= "informacao_complementar46 = :informacao_complementar46, ";
$strSqlModulosUpdate .= "informacao_complementar47 = :informacao_complementar47, ";
$strSqlModulosUpdate .= "informacao_complementar48 = :informacao_complementar48, ";
$strSqlModulosUpdate .= "informacao_complementar49 = :informacao_complementar49, ";
$strSqlModulosUpdate .= "informacao_complementar50 = :informacao_complementar50, ";
$strSqlModulosUpdate .= "informacao_complementar51 = :informacao_complementar51, ";
$strSqlModulosUpdate .= "informacao_complementar52 = :informacao_complementar52, ";
$strSqlModulosUpdate .= "informacao_complementar53 = :informacao_complementar53, ";
$strSqlModulosUpdate .= "informacao_complementar54 = :informacao_complementar54, ";
$strSqlModulosUpdate .= "informacao_complementar55 = :informacao_complementar55, ";
$strSqlModulosUpdate .= "informacao_complementar56 = :informacao_complementar56, ";
$strSqlModulosUpdate .= "informacao_complementar57 = :informacao_complementar57, ";
$strSqlModulosUpdate .= "informacao_complementar58 = :informacao_complementar58, ";
$strSqlModulosUpdate .= "informacao_complementar59 = :informacao_complementar59, ";
$strSqlModulosUpdate .= "informacao_complementar60 = :informacao_complementar60, ";

$strSqlModulosUpdate .= "carga_horaria = :carga_horaria, ";
$strSqlModulosUpdate .= "duracao_aula = :duracao_aula, ";

$strSqlModulosUpdate .= "ativacao = :ativacao, ";
$strSqlModulosUpdate .= "ativacao1 = :ativacao1, ";
$strSqlModulosUpdate .= "ativacao2 = :ativacao2, ";
$strSqlModulosUpdate .= "ativacao3 = :ativacao3, ";
$strSqlModulosUpdate .= "ativacao4 = :ativacao4, ";

$strSqlModulosUpdate .= "anotacoes_internas = :anotacoes_internas, ";
$strSqlModulosUpdate .= "n_visitas = :n_visitas, ";
$strSqlModulosUpdate .= "acesso_restrito = :acesso_restrito ";

$strSqlModulosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlModulosUpdate . "<br />";
//----------


$statementModulosUpdate = $dbSistemaConPDO->prepare($strSqlModulosUpdate);


/*
"id_parent" => $idParent,
"data_criacao" => $dataCriacao,
*/
if ($statementModulosUpdate !== false)
{
	$statementModulosUpdate->execute(array(
		"id" => $id,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro4" => $idTbCadastro4,
		"id_tb_cadastro5" => $idTbCadastro5,
		"n_classificacao" => $nClassificacao,
		"data_inicio" => $dataInicio,
		"data_final" => $dataFinal,
		"data1" => $data1,
		"data2" => $data2,
		"data3" => $data3,
		"data4" => $data4,
		"data5" => $data5,
		"data6" => $data6,
		"data7" => $data7,
		"data8" => $data8,
		"data9" => $data9,
		"data10" => $data10,
		"nome_modulo" => $nomeModulo,
		"descricao" => $descricao,
		"id_tb_modulos_status" => $idTbModulosStatus,
		"palavras_chave" => $palavrasChave,
		"valor" => $valor,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"valor3" => $valor3,
		"valor4" => $valor4,
		"valor5" => $valor5,
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
		"informacao_complementar51" => $informacaoComplementar51,
		"informacao_complementar52" => $informacaoComplementar52,
		"informacao_complementar53" => $informacaoComplementar53,
		"informacao_complementar54" => $informacaoComplementar54,
		"informacao_complementar55" => $informacaoComplementar55,
		"informacao_complementar56" => $informacaoComplementar56,
		"informacao_complementar57" => $informacaoComplementar57,
		"informacao_complementar58" => $informacaoComplementar58,
		"informacao_complementar59" => $informacaoComplementar59,
		"informacao_complementar60" => $informacaoComplementar60,
		"carga_horaria" => $cargaHoraria,
		"duracao_aula" => $duracaoAula,
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"anotacoes_internas" => $anotacoesInternas,
		"n_visitas" => $nVisitas,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}


unset($strSqlModulosUpdate);
unset($statementModulosUpdate);
//----------


//Gravação de complementos.
//----------

//Filtro genérico 01.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"12");
if(!empty($arrIdsModulosFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico01[$countArray], "12", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 02.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"13");
if(!empty($arrIdsModulosFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico02[$countArray], "13", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 03.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"14");
if(!empty($arrIdsModulosFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico03[$countArray], "14", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 04.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"15");
if(!empty($arrIdsModulosFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico04[$countArray], "15", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 05.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"16");
if(!empty($arrIdsModulosFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico05[$countArray], "16", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 06.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"17");
if(!empty($arrIdsModulosFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico06[$countArray], "17", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 07.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"18");
if(!empty($arrIdsModulosFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico07[$countArray], "18", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 08.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"19");
if(!empty($arrIdsModulosFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico08[$countArray], "19", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 09.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"20");
if(!empty($arrIdsModulosFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico09[$countArray], "20", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 10.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"21");
if(!empty($arrIdsModulosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico10[$countArray], "21", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 11.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"22");
if(!empty($arrIdsModulosFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico11[$countArray], "22", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 12.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"23");
if(!empty($arrIdsModulosFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico12[$countArray], "23", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 13.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"24");
if(!empty($arrIdsModulosFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico13[$countArray], "24", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 14.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"25");
if(!empty($arrIdsModulosFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico14[$countArray], "25", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 15.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"26");
if(!empty($arrIdsModulosFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico15[$countArray], "26", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 16.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"27");
if(!empty($arrIdsModulosFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico16[$countArray], "27", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 17.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"28");
if(!empty($arrIdsModulosFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico17[$countArray], "28", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 18.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"29");
if(!empty($arrIdsModulosFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico18[$countArray], "29", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 19.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"30");
if(!empty($arrIdsModulosFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico19[$countArray], "30", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}


//Filtro genérico 20.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_modulos_relacao_complemento", 
									"id_tb_modulos",
									"tipo_complemento", 
									"31");
if(!empty($arrIdsModulosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsModulosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsModulosFiltroGenerico10[$countArray], "31", "tb_modulos_relacao_complemento", "id_tb_modulos", "id_tb_modulos_complemento");
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentModulos=" . $idParent .
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