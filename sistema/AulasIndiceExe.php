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
$id = ContadorUniversal::ContadorUniversalUpdate(1);
$idParent = $_POST["id_parent"];
$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$arrIdsAulasFiltroGenerico01 = $_POST["idsAulasFiltroGenerico01"];
$arrIdsAulasFiltroGenerico02 = $_POST["idsAulasFiltroGenerico02"];
$arrIdsAulasFiltroGenerico03 = $_POST["idsAulasFiltroGenerico03"];
$arrIdsAulasFiltroGenerico04 = $_POST["idsAulasFiltroGenerico04"];
$arrIdsAulasFiltroGenerico05 = $_POST["idsAulasFiltroGenerico05"];
$arrIdsAulasFiltroGenerico06 = $_POST["idsAulasFiltroGenerico06"];
$arrIdsAulasFiltroGenerico07 = $_POST["idsAulasFiltroGenerico07"];
$arrIdsAulasFiltroGenerico08 = $_POST["idsAulasFiltroGenerico08"];
$arrIdsAulasFiltroGenerico09 = $_POST["idsAulasFiltroGenerico09"];
$arrIdsAulasFiltroGenerico10 = $_POST["idsAulasFiltroGenerico10"];
$arrIdsAulasFiltroGenerico11 = $_POST["idsAulasFiltroGenerico11"];
$arrIdsAulasFiltroGenerico12 = $_POST["idsAulasFiltroGenerico12"];
$arrIdsAulasFiltroGenerico13 = $_POST["idsAulasFiltroGenerico13"];
$arrIdsAulasFiltroGenerico14 = $_POST["idsAulasFiltroGenerico14"];
$arrIdsAulasFiltroGenerico15 = $_POST["idsAulasFiltroGenerico15"];
$arrIdsAulasFiltroGenerico16 = $_POST["idsAulasFiltroGenerico16"];
$arrIdsAulasFiltroGenerico17 = $_POST["idsAulasFiltroGenerico17"];
$arrIdsAulasFiltroGenerico18 = $_POST["idsAulasFiltroGenerico18"];
$arrIdsAulasFiltroGenerico19 = $_POST["idsAulasFiltroGenerico19"];
$arrIdsAulasFiltroGenerico20 = $_POST["idsAulasFiltroGenerico20"];

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

$dataAula = Funcoes::DataGravacaoSql($_POST["data_aula"], $GLOBALS['configSistemaFormatoData']);
if($dataAula == "")
{
	$dataAula = NULL;	
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

$tema = Funcoes::ConteudoMascaraGravacao01($_POST["tema"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);
$local = Funcoes::ConteudoMascaraGravacao01($_POST["local"]);

$idTbAulasStatus = $_POST["id_tb_aulas_status"];
if($idTbAulasStatus == "")
{
	$idTbAulasStatus = 0;
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
$reposicao = $_POST["reposicao"];
if($reposicao == "")
{
	$reposicao = 0;
}

$anotacoesInternas = Funcoes::ConteudoMascaraGravacao01($_POST["anotacoesInternas"]);
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


//Inclusão de registro no BD.
//----------
$strSqlAulasInsert = "";
$strSqlAulasInsert .= "INSERT INTO tb_aulas ";
$strSqlAulasInsert .= "SET ";
$strSqlAulasInsert .= "id = :id, ";
$strSqlAulasInsert .= "id_parent = :id_parent, ";
$strSqlAulasInsert .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";

$strSqlAulasInsert .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlAulasInsert .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlAulasInsert .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlAulasInsert .= "id_tb_cadastro4 = :id_tb_cadastro4, ";
$strSqlAulasInsert .= "id_tb_cadastro5 = :id_tb_cadastro5, ";

$strSqlAulasInsert .= "n_classificacao = :n_classificacao, ";

$strSqlAulasInsert .= "data_criacao = :data_criacao, ";
$strSqlAulasInsert .= "data_aula = :data_aula, ";

$strSqlAulasInsert .= "data1 = :data1, ";
$strSqlAulasInsert .= "data2 = :data2, ";
$strSqlAulasInsert .= "data3 = :data3, ";
$strSqlAulasInsert .= "data4 = :data4, ";
$strSqlAulasInsert .= "data5 = :data5, ";
$strSqlAulasInsert .= "data6 = :data6, ";
$strSqlAulasInsert .= "data7 = :data7, ";
$strSqlAulasInsert .= "data8 = :data8, ";
$strSqlAulasInsert .= "data9 = :data9, ";
$strSqlAulasInsert .= "data10 = :data10, ";

$strSqlAulasInsert .= "tema = :tema, ";
$strSqlAulasInsert .= "descricao = :descricao, ";
$strSqlAulasInsert .= "local = :local, ";
$strSqlAulasInsert .= "id_tb_aulas_status = :id_tb_aulas_status, ";
$strSqlAulasInsert .= "palavras_chave = :palavras_chave, ";

$strSqlAulasInsert .= "valor = :valor, ";
$strSqlAulasInsert .= "valor1 = :valor1, ";
$strSqlAulasInsert .= "valor2 = :valor2, ";
$strSqlAulasInsert .= "valor3 = :valor3, ";
$strSqlAulasInsert .= "valor4 = :valor4, ";
$strSqlAulasInsert .= "valor5 = :valor5, ";

$strSqlAulasInsert .= "url1 = :url1, ";
$strSqlAulasInsert .= "url2 = :url2, ";
$strSqlAulasInsert .= "url3 = :url3, ";
$strSqlAulasInsert .= "url4 = :url4, ";
$strSqlAulasInsert .= "url5 = :url5, ";

$strSqlAulasInsert .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlAulasInsert .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlAulasInsert .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlAulasInsert .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlAulasInsert .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlAulasInsert .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlAulasInsert .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlAulasInsert .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlAulasInsert .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlAulasInsert .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlAulasInsert .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlAulasInsert .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlAulasInsert .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlAulasInsert .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlAulasInsert .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlAulasInsert .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlAulasInsert .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlAulasInsert .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlAulasInsert .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlAulasInsert .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlAulasInsert .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlAulasInsert .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlAulasInsert .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlAulasInsert .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlAulasInsert .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlAulasInsert .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlAulasInsert .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlAulasInsert .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlAulasInsert .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlAulasInsert .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlAulasInsert .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlAulasInsert .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlAulasInsert .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlAulasInsert .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlAulasInsert .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlAulasInsert .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlAulasInsert .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlAulasInsert .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlAulasInsert .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlAulasInsert .= "informacao_complementar40 = :informacao_complementar40, ";
$strSqlAulasInsert .= "informacao_complementar41 = :informacao_complementar41, ";
$strSqlAulasInsert .= "informacao_complementar42 = :informacao_complementar42, ";
$strSqlAulasInsert .= "informacao_complementar43 = :informacao_complementar43, ";
$strSqlAulasInsert .= "informacao_complementar44 = :informacao_complementar44, ";
$strSqlAulasInsert .= "informacao_complementar45 = :informacao_complementar45, ";
$strSqlAulasInsert .= "informacao_complementar46 = :informacao_complementar46, ";
$strSqlAulasInsert .= "informacao_complementar47 = :informacao_complementar47, ";
$strSqlAulasInsert .= "informacao_complementar48 = :informacao_complementar48, ";
$strSqlAulasInsert .= "informacao_complementar49 = :informacao_complementar49, ";
$strSqlAulasInsert .= "informacao_complementar50 = :informacao_complementar50, ";
$strSqlAulasInsert .= "informacao_complementar51 = :informacao_complementar51, ";
$strSqlAulasInsert .= "informacao_complementar52 = :informacao_complementar52, ";
$strSqlAulasInsert .= "informacao_complementar53 = :informacao_complementar53, ";
$strSqlAulasInsert .= "informacao_complementar54 = :informacao_complementar54, ";
$strSqlAulasInsert .= "informacao_complementar55 = :informacao_complementar55, ";
$strSqlAulasInsert .= "informacao_complementar56 = :informacao_complementar56, ";
$strSqlAulasInsert .= "informacao_complementar57 = :informacao_complementar57, ";
$strSqlAulasInsert .= "informacao_complementar58 = :informacao_complementar58, ";
$strSqlAulasInsert .= "informacao_complementar59 = :informacao_complementar59, ";
$strSqlAulasInsert .= "informacao_complementar60 = :informacao_complementar60, ";

$strSqlAulasInsert .= "carga_horaria = :carga_horaria, ";

$strSqlAulasInsert .= "ativacao = :ativacao, ";
$strSqlAulasInsert .= "ativacao1 = :ativacao1, ";
$strSqlAulasInsert .= "ativacao2 = :ativacao2, ";
$strSqlAulasInsert .= "ativacao3 = :ativacao3, ";
$strSqlAulasInsert .= "ativacao4 = :ativacao4, ";
$strSqlAulasInsert .= "reposicao = :reposicao, ";

$strSqlAulasInsert .= "anotacoes_internas = :anotacoes_internas, ";
$strSqlAulasInsert .= "n_visitas = :n_visitas, ";
$strSqlAulasInsert .= "acesso_restrito = :acesso_restrito ";


$statementAulasInsert = $dbSistemaConPDO->prepare($strSqlAulasInsert);

if ($statementAulasInsert !== false)
{
	$statementAulasInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro4" => $idTbCadastro4,
		"id_tb_cadastro5" => $idTbCadastro5,
		"n_classificacao" => $nClassificacao,
		"data_criacao" => $dataCriacao,
		"data_aula" => $dataAula,
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
		"tema" => $tema,
		"descricao" => $descricao,
		"local" => $local,
		"id_tb_aulas_status" => $idTbAulasStatus,
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
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"reposicao" => $reposicao,
		"anotacoes_internas" => $anotacoesInternas,
		"n_visitas" => $nVisitas,
		"acesso_restrito" => $acessoRestrito
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}


//Limpeza de objetos.
unset($strSqlAulasInsert);
unset($statementAulasInsert);
//----------


//Gravação de complementos.
//----------

//Filtro genérico 01.
if(!empty($arrIdsAulasFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico01[$countArray], "12", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 02.
if(!empty($arrIdsAulasFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico02[$countArray], "13", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 03.
if(!empty($arrIdsAulasFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico03[$countArray], "14", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 04.
if(!empty($arrIdsAulasFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico04[$countArray], "15", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 05.
if(!empty($arrIdsAulasFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico05[$countArray], "16", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 06.
if(!empty($arrIdsAulasFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico06[$countArray], "17", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 07.
if(!empty($arrIdsAulasFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico07[$countArray], "18", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 08.
if(!empty($arrIdsAulasFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico08[$countArray], "19", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 09.
if(!empty($arrIdsAulasFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico09[$countArray], "20", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 10.
if(!empty($arrIdsAulasFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico10[$countArray], "21", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 11.
if(!empty($arrIdsAulasFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico11); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico11[$countArray], "22", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 12.
if(!empty($arrIdsAulasFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico12[$countArray], "23", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 13.
if(!empty($arrIdsAulasFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico13[$countArray], "24", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 14.
if(!empty($arrIdsAulasFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico14[$countArray], "25", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 15.
if(!empty($arrIdsAulasFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico15[$countArray], "26", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 16.
if(!empty($arrIdsAulasFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico16[$countArray], "27", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 17.
if(!empty($arrIdsAulasFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico17[$countArray], "28", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 18.
if(!empty($arrIdsAulasFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico18[$countArray], "29", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 19.
if(!empty($arrIdsAulasFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico19[$countArray], "30", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}


//Filtro genérico 20.
if(!empty($arrIdsAulasFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsAulasFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsAulasFiltroGenerico10[$countArray], "31", "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento");
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParentAulas=" . $idParent .
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