<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis
$idParentHistorico = $_GET["idParentHistorico"];
$idsParentHistorico = $_GET["idsParentHistorico"];
$idsTbHistorico = $_GET["idsTbHistorico"];

$idTbHistoricoStatus = $_GET["idTbHistoricoStatus"];
$idTbCadastroUsuarioSelect = $_GET["idTbCadastroUsuarioSelect"];
$idTbHistoricoStatusSelect = $_GET["idTbHistoricoStatusSelect"];

$informacaoComplementar3 = $_GET["informacao_complementar3"];
$informacaoComplementar7 = $_GET["informacao_complementar7"];
$informacaoComplementar35 = $_GET["informacao_complementar35"];
$informacaoComplementar55 = $_GET["informacao_complementar55"];

$palavraChave = $_GET["palavraChave"];

$dataAtual = "";
if($configSistemaFormatoData == 1)
{
	$dataAtual = date("d") . "/" . date("m") . "/" . date("Y");
	
}
if($configSistemaFormatoData == 2)
{
	$dataAtual = date("m") . "/" . date("d") . "/" . date("Y");
}

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

//Definição de valores de variáveis.
if($dataInicial <> "" && $dataFinal <> "")
{
	//$diaDataInicial = $_GET["diaDataInicial"];
	//$mesDataInicial = $_GET["mesDataInicial"];
	//$anoDataInicial = $_GET["anoDataInicial"];
//}else{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
	
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
}

//Busca detalhada - filtros.
$arrIdsHistoricoFiltroGenerico = array();

$arrIdsHistoricoFiltroGenerico01 = $_GET["idsHistoricoFiltroGenerico01"];
$arrIdsHistoricoFiltroGenerico02 = $_GET["idsHistoricoFiltroGenerico02"];
$arrIdsHistoricoFiltroGenerico03 = $_GET["idsHistoricoFiltroGenerico03"];
$arrIdsHistoricoFiltroGenerico04 = $_GET["idsHistoricoFiltroGenerico04"];
$arrIdsHistoricoFiltroGenerico05 = $_GET["idsHistoricoFiltroGenerico05"];
$arrIdsHistoricoFiltroGenerico06 = $_GET["idsHistoricoFiltroGenerico06"];
$arrIdsHistoricoFiltroGenerico07 = $_GET["idsHistoricoFiltroGenerico07"];
$arrIdsHistoricoFiltroGenerico08 = $_GET["idsHistoricoFiltroGenerico08"];
$arrIdsHistoricoFiltroGenerico09 = $_GET["idsHistoricoFiltroGenerico09"];
$arrIdsHistoricoFiltroGenerico10 = $_GET["idsHistoricoFiltroGenerico10"];
$arrIdsHistoricoFiltroGenerico11 = $_GET["idsHistoricoFiltroGenerico11"];
$arrIdsHistoricoFiltroGenerico12 = $_GET["idsHistoricoFiltroGenerico12"];
$arrIdsHistoricoFiltroGenerico13 = $_GET["idsHistoricoFiltroGenerico13"];
$arrIdsHistoricoFiltroGenerico14 = $_GET["idsHistoricoFiltroGenerico14"];
$arrIdsHistoricoFiltroGenerico15 = $_GET["idsHistoricoFiltroGenerico15"];
$arrIdsHistoricoFiltroGenerico16 = $_GET["idsHistoricoFiltroGenerico16"];
$arrIdsHistoricoFiltroGenerico17 = $_GET["idsHistoricoFiltroGenerico17"];
$arrIdsHistoricoFiltroGenerico18 = $_GET["idsHistoricoFiltroGenerico18"];
$arrIdsHistoricoFiltroGenerico19 = $_GET["idsHistoricoFiltroGenerico19"];
$arrIdsHistoricoFiltroGenerico20 = $_GET["idsHistoricoFiltroGenerico20"];
$arrIdsHistoricoFiltroGenerico21 = $_GET["idsHistoricoFiltroGenerico21"];
$arrIdsHistoricoFiltroGenerico22 = $_GET["idsHistoricoFiltroGenerico22"];
$arrIdsHistoricoFiltroGenerico23 = $_GET["idsHistoricoFiltroGenerico23"];
$arrIdsHistoricoFiltroGenerico24 = $_GET["idsHistoricoFiltroGenerico24"];
$arrIdsHistoricoFiltroGenerico25 = $_GET["idsHistoricoFiltroGenerico25"];
$arrIdsHistoricoFiltroGenerico26 = $_GET["idsHistoricoFiltroGenerico26"];
$arrIdsHistoricoFiltroGenerico27 = $_GET["idsHistoricoFiltroGenerico27"];
$arrIdsHistoricoFiltroGenerico28 = $_GET["idsHistoricoFiltroGenerico28"];
$arrIdsHistoricoFiltroGenerico29 = $_GET["idsHistoricoFiltroGenerico29"];
$arrIdsHistoricoFiltroGenerico30 = $_GET["idsHistoricoFiltroGenerico30"];
$arrIdsHistoricoFiltroGenerico31 = $_GET["idsHistoricoFiltroGenerico31"];
$arrIdsHistoricoFiltroGenerico32 = $_GET["idsHistoricoFiltroGenerico32"];
$arrIdsHistoricoFiltroGenerico33 = $_GET["idsHistoricoFiltroGenerico33"];
$arrIdsHistoricoFiltroGenerico34 = $_GET["idsHistoricoFiltroGenerico34"];
$arrIdsHistoricoFiltroGenerico35 = $_GET["idsHistoricoFiltroGenerico35"];
$arrIdsHistoricoFiltroGenerico36 = $_GET["idsHistoricoFiltroGenerico36"];
$arrIdsHistoricoFiltroGenerico37 = $_GET["idsHistoricoFiltroGenerico37"];
$arrIdsHistoricoFiltroGenerico38 = $_GET["idsHistoricoFiltroGenerico38"];
$arrIdsHistoricoFiltroGenerico39 = $_GET["idsHistoricoFiltroGenerico39"];
$arrIdsHistoricoFiltroGenerico40 = $_GET["idsHistoricoFiltroGenerico40"];
$arrIdsHistoricoFiltroGenerico41 = $_GET["idsHistoricoFiltroGenerico41"];
$arrIdsHistoricoFiltroGenerico42 = $_GET["idsHistoricoFiltroGenerico42"];
$arrIdsHistoricoFiltroGenerico43 = $_GET["idsHistoricoFiltroGenerico43"];
$arrIdsHistoricoFiltroGenerico44 = $_GET["idsHistoricoFiltroGenerico44"];
$arrIdsHistoricoFiltroGenerico45 = $_GET["idsHistoricoFiltroGenerico45"];
$arrIdsHistoricoFiltroGenerico46 = $_GET["idsHistoricoFiltroGenerico46"];
$arrIdsHistoricoFiltroGenerico47 = $_GET["idsHistoricoFiltroGenerico47"];
$arrIdsHistoricoFiltroGenerico48 = $_GET["idsHistoricoFiltroGenerico48"];
$arrIdsHistoricoFiltroGenerico49 = $_GET["idsHistoricoFiltroGenerico49"];
$arrIdsHistoricoFiltroGenerico50 = $_GET["idsHistoricoFiltroGenerico50"];
$arrIdsHistoricoFiltroGenerico51 = $_GET["idsHistoricoFiltroGenerico51"];
$arrIdsHistoricoFiltroGenerico52 = $_GET["idsHistoricoFiltroGenerico52"];
$arrIdsHistoricoFiltroGenerico53 = $_GET["idsHistoricoFiltroGenerico53"];
$arrIdsHistoricoFiltroGenerico54 = $_GET["idsHistoricoFiltroGenerico54"];
$arrIdsHistoricoFiltroGenerico55 = $_GET["idsHistoricoFiltroGenerico55"];
$arrIdsHistoricoFiltroGenerico56 = $_GET["idsHistoricoFiltroGenerico56"];
$arrIdsHistoricoFiltroGenerico57 = $_GET["idsHistoricoFiltroGenerico57"];
$arrIdsHistoricoFiltroGenerico58 = $_GET["idsHistoricoFiltroGenerico58"];
$arrIdsHistoricoFiltroGenerico59 = $_GET["idsHistoricoFiltroGenerico59"];
$arrIdsHistoricoFiltroGenerico60 = $_GET["idsHistoricoFiltroGenerico60"];
$arrIdsHistoricoFiltroGenerico61 = $_GET["idsHistoricoFiltroGenerico61"];
$arrIdsHistoricoFiltroGenerico62 = $_GET["idsHistoricoFiltroGenerico62"];
$arrIdsHistoricoFiltroGenerico63 = $_GET["idsHistoricoFiltroGenerico63"];
$arrIdsHistoricoFiltroGenerico64 = $_GET["idsHistoricoFiltroGenerico64"];
$arrIdsHistoricoFiltroGenerico65 = $_GET["idsHistoricoFiltroGenerico65"];
$arrIdsHistoricoFiltroGenerico66 = $_GET["idsHistoricoFiltroGenerico66"];
$arrIdsHistoricoFiltroGenerico67 = $_GET["idsHistoricoFiltroGenerico67"];
$arrIdsHistoricoFiltroGenerico68 = $_GET["idsHistoricoFiltroGenerico68"];
$arrIdsHistoricoFiltroGenerico69 = $_GET["idsHistoricoFiltroGenerico69"];
$arrIdsHistoricoFiltroGenerico70 = $_GET["idsHistoricoFiltroGenerico70"];
$arrIdsHistoricoFiltroGenerico71 = $_GET["idsHistoricoFiltroGenerico71"];
$arrIdsHistoricoFiltroGenerico72 = $_GET["idsHistoricoFiltroGenerico72"];
$arrIdsHistoricoFiltroGenerico73 = $_GET["idsHistoricoFiltroGenerico73"];
$arrIdsHistoricoFiltroGenerico74 = $_GET["idsHistoricoFiltroGenerico74"];
$arrIdsHistoricoFiltroGenerico75 = $_GET["idsHistoricoFiltroGenerico75"];
$arrIdsHistoricoFiltroGenerico76 = $_GET["idsHistoricoFiltroGenerico76"];
$arrIdsHistoricoFiltroGenerico77 = $_GET["idsHistoricoFiltroGenerico77"];
$arrIdsHistoricoFiltroGenerico78 = $_GET["idsHistoricoFiltroGenerico78"];
$arrIdsHistoricoFiltroGenerico79 = $_GET["idsHistoricoFiltroGenerico79"];
$arrIdsHistoricoFiltroGenerico80 = $_GET["idsHistoricoFiltroGenerico80"];

//Combinar arrays.
if(!empty($arrIdsHistoricoFiltroGenerico01) && $arrIdsHistoricoFiltroGenerico01[0] <> "")
{
	//array_merge($arrIdsHistoricoFiltroGenerico, $arrIdsHistoricoFiltroGenerico01);
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico01;
}
if(!empty($arrIdsHistoricoFiltroGenerico02) && $arrIdsHistoricoFiltroGenerico02[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico02;
}
if(!empty($arrIdsHistoricoFiltroGenerico03) && $arrIdsHistoricoFiltroGenerico03[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico03;
}
if(!empty($arrIdsHistoricoFiltroGenerico04) && $arrIdsHistoricoFiltroGenerico04[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico04;
}
if(!empty($arrIdsHistoricoFiltroGenerico05) && $arrIdsHistoricoFiltroGenerico05[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico05;
}
if(!empty($arrIdsHistoricoFiltroGenerico06) && $arrIdsHistoricoFiltroGenerico06[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico06;
}
if(!empty($arrIdsHistoricoFiltroGenerico07) && $arrIdsHistoricoFiltroGenerico07[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico07;
}
if(!empty($arrIdsHistoricoFiltroGenerico08) && $arrIdsHistoricoFiltroGenerico08[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico08;
}
if(!empty($arrIdsHistoricoFiltroGenerico09) && $arrIdsHistoricoFiltroGenerico09[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico09;
}
if(!empty($arrIdsHistoricoFiltroGenerico10) && $arrIdsHistoricoFiltroGenerico10[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico10;
}
if(!empty($arrIdsHistoricoFiltroGenerico11) && $arrIdsHistoricoFiltroGenerico11[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico11;
}
if(!empty($arrIdsHistoricoFiltroGenerico12) && $arrIdsHistoricoFiltroGenerico12[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico12;
}
if(!empty($arrIdsHistoricoFiltroGenerico13) && $arrIdsHistoricoFiltroGenerico13[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico13;
}
if(!empty($arrIdsHistoricoFiltroGenerico14) && $arrIdsHistoricoFiltroGenerico14[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico14;
}
if(!empty($arrIdsHistoricoFiltroGenerico15) && $arrIdsHistoricoFiltroGenerico15[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico15;
}
if(!empty($arrIdsHistoricoFiltroGenerico16) && $arrIdsHistoricoFiltroGenerico16[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico16;
}
if(!empty($arrIdsHistoricoFiltroGenerico17) && $arrIdsHistoricoFiltroGenerico17[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico17;
}
if(!empty($arrIdsHistoricoFiltroGenerico18) && $arrIdsHistoricoFiltroGenerico18[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico18;
}
if(!empty($arrIdsHistoricoFiltroGenerico19) && $arrIdsHistoricoFiltroGenerico19[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico19;
}
if(!empty($arrIdsHistoricoFiltroGenerico20) && $arrIdsHistoricoFiltroGenerico20[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico20;
}
if(!empty($arrIdsHistoricoFiltroGenerico21) && $arrIdsHistoricoFiltroGenerico21[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico21;
}
if(!empty($arrIdsHistoricoFiltroGenerico22) && $arrIdsHistoricoFiltroGenerico22[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico22;
}
if(!empty($arrIdsHistoricoFiltroGenerico23) && $arrIdsHistoricoFiltroGenerico23[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico23;
}
if(!empty($arrIdsHistoricoFiltroGenerico24) && $arrIdsHistoricoFiltroGenerico24[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico24;
}
if(!empty($arrIdsHistoricoFiltroGenerico25) && $arrIdsHistoricoFiltroGenerico25[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico25;
}
if(!empty($arrIdsHistoricoFiltroGenerico26) && $arrIdsHistoricoFiltroGenerico26[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico26;
}
if(!empty($arrIdsHistoricoFiltroGenerico27) && $arrIdsHistoricoFiltroGenerico27[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico27;
}
if(!empty($arrIdsHistoricoFiltroGenerico28) && $arrIdsHistoricoFiltroGenerico28[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico28;
}
if(!empty($arrIdsHistoricoFiltroGenerico29) && $arrIdsHistoricoFiltroGenerico29[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico29;
}
if(!empty($arrIdsHistoricoFiltroGenerico30) && $arrIdsHistoricoFiltroGenerico30[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico30;
}
if(!empty($arrIdsHistoricoFiltroGenerico31) && $arrIdsHistoricoFiltroGenerico31[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico31;
}
if(!empty($arrIdsHistoricoFiltroGenerico32) && $arrIdsHistoricoFiltroGenerico32[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico32;
}
if(!empty($arrIdsHistoricoFiltroGenerico33) && $arrIdsHistoricoFiltroGenerico33[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico33;
}
if(!empty($arrIdsHistoricoFiltroGenerico34) && $arrIdsHistoricoFiltroGenerico34[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico34;
}
if(!empty($arrIdsHistoricoFiltroGenerico35) && $arrIdsHistoricoFiltroGenerico35[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico35;
}
if(!empty($arrIdsHistoricoFiltroGenerico36) && $arrIdsHistoricoFiltroGenerico36[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico36;
}
if(!empty($arrIdsHistoricoFiltroGenerico37) && $arrIdsHistoricoFiltroGenerico37[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico37;
}
if(!empty($arrIdsHistoricoFiltroGenerico38) && $arrIdsHistoricoFiltroGenerico38[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico38;
}
if(!empty($arrIdsHistoricoFiltroGenerico39) && $arrIdsHistoricoFiltroGenerico39[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico39;
}
if(!empty($arrIdsHistoricoFiltroGenerico40) && $arrIdsHistoricoFiltroGenerico40[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico40;
}
if(!empty($arrIdsHistoricoFiltroGenerico41) && $arrIdsHistoricoFiltroGenerico41[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico41;
}
if(!empty($arrIdsHistoricoFiltroGenerico42) && $arrIdsHistoricoFiltroGenerico42[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico42;
}
if(!empty($arrIdsHistoricoFiltroGenerico43) && $arrIdsHistoricoFiltroGenerico43[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico43;
}
if(!empty($arrIdsHistoricoFiltroGenerico44) && $arrIdsHistoricoFiltroGenerico44[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico44;
}
if(!empty($arrIdsHistoricoFiltroGenerico45) && $arrIdsHistoricoFiltroGenerico45[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico45;
}
if(!empty($arrIdsHistoricoFiltroGenerico46) && $arrIdsHistoricoFiltroGenerico46[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico46;
}
if(!empty($arrIdsHistoricoFiltroGenerico47) && $arrIdsHistoricoFiltroGenerico47[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico47;
}
if(!empty($arrIdsHistoricoFiltroGenerico48) && $arrIdsHistoricoFiltroGenerico48[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico48;
}
if(!empty($arrIdsHistoricoFiltroGenerico49) && $arrIdsHistoricoFiltroGenerico49[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico49;
}
if(!empty($arrIdsHistoricoFiltroGenerico50) && $arrIdsHistoricoFiltroGenerico50[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico50;
}
if(!empty($arrIdsHistoricoFiltroGenerico51) && $arrIdsHistoricoFiltroGenerico51[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico51;
}
if(!empty($arrIdsHistoricoFiltroGenerico52) && $arrIdsHistoricoFiltroGenerico52[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico52;
}
if(!empty($arrIdsHistoricoFiltroGenerico53) && $arrIdsHistoricoFiltroGenerico53[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico53;
}
if(!empty($arrIdsHistoricoFiltroGenerico54) && $arrIdsHistoricoFiltroGenerico54[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico54;
}
if(!empty($arrIdsHistoricoFiltroGenerico55) && $arrIdsHistoricoFiltroGenerico55[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico55;
}
if(!empty($arrIdsHistoricoFiltroGenerico56) && $arrIdsHistoricoFiltroGenerico56[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico56;
}
if(!empty($arrIdsHistoricoFiltroGenerico57) && $arrIdsHistoricoFiltroGenerico57[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico57;
}
if(!empty($arrIdsHistoricoFiltroGenerico58) && $arrIdsHistoricoFiltroGenerico58[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico58;
}
if(!empty($arrIdsHistoricoFiltroGenerico59) && $arrIdsHistoricoFiltroGenerico59[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico59;
}
if(!empty($arrIdsHistoricoFiltroGenerico60) && $arrIdsHistoricoFiltroGenerico60[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico60;
}
if(!empty($arrIdsHistoricoFiltroGenerico61) && $arrIdsHistoricoFiltroGenerico61[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico61;
}
if(!empty($arrIdsHistoricoFiltroGenerico62) && $arrIdsHistoricoFiltroGenerico62[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico62;
}
if(!empty($arrIdsHistoricoFiltroGenerico63) && $arrIdsHistoricoFiltroGenerico63[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico63;
}
if(!empty($arrIdsHistoricoFiltroGenerico64) && $arrIdsHistoricoFiltroGenerico64[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico64;
}
if(!empty($arrIdsHistoricoFiltroGenerico65) && $arrIdsHistoricoFiltroGenerico65[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico65;
}
if(!empty($arrIdsHistoricoFiltroGenerico66) && $arrIdsHistoricoFiltroGenerico66[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico66;
}
if(!empty($arrIdsHistoricoFiltroGenerico67) && $arrIdsHistoricoFiltroGenerico67[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico67;
}
if(!empty($arrIdsHistoricoFiltroGenerico68) && $arrIdsHistoricoFiltroGenerico68[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico68;
}
if(!empty($arrIdsHistoricoFiltroGenerico69) && $arrIdsHistoricoFiltroGenerico69[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico69;
}
if(!empty($arrIdsHistoricoFiltroGenerico70) && $arrIdsHistoricoFiltroGenerico70[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico70;
}
if(!empty($arrIdsHistoricoFiltroGenerico71) && $arrIdsHistoricoFiltroGenerico71[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico71;
}
if(!empty($arrIdsHistoricoFiltroGenerico72) && $arrIdsHistoricoFiltroGenerico72[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico72;
}
if(!empty($arrIdsHistoricoFiltroGenerico73) && $arrIdsHistoricoFiltroGenerico73[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico73;
}
if(!empty($arrIdsHistoricoFiltroGenerico74) && $arrIdsHistoricoFiltroGenerico74[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico74;
}
if(!empty($arrIdsHistoricoFiltroGenerico75) && $arrIdsHistoricoFiltroGenerico75[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico75;
}
if(!empty($arrIdsHistoricoFiltroGenerico76) && $arrIdsHistoricoFiltroGenerico76[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico76;
}
if(!empty($arrIdsHistoricoFiltroGenerico77) && $arrIdsHistoricoFiltroGenerico77[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico77;
}
if(!empty($arrIdsHistoricoFiltroGenerico78) && $arrIdsHistoricoFiltroGenerico78[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico78;
}
if(!empty($arrIdsHistoricoFiltroGenerico79) && $arrIdsHistoricoFiltroGenerico79[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico79;
}
if(!empty($arrIdsHistoricoFiltroGenerico80) && $arrIdsHistoricoFiltroGenerico80[0] <> "")
{
	$arrIdsHistoricoFiltroGenerico = $arrIdsHistoricoFiltroGenerico + $arrIdsHistoricoFiltroGenerico80;
}

if(!empty($arrIdsHistoricoFiltroGenerico))
{
	/**/
	if($idsTbHistorico <> "")
	{
		//Lógica or.
		/*$idsTbVeiculos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");*/
																			
		//Lógica and.
		$idsTbHistorico .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsHistoricoFiltroGenerico), 
																			"tb_historico_relacao_complemento", 
																			"id_tb_historico_complemento", 
																			"id_tb_historico", 
																			"2");
	}else{
		//Lógica or.
		/*$idsTbVeiculos .= DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");*/
																		
		//Lógica and.
		$idsTbHistorico .= DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsHistoricoFiltroGenerico), 
																		"tb_historico_relacao_complemento", 
																		"id_tb_historico_complemento", 
																		"id_tb_historico", 
																		"2");
	}
	
	if($idsTbHistorico == "")
	{
		$idsTbHistorico = "0";
	}
}


//Obras.
//----------
//$idsTbProdutos = $_GET["idsTbProdutos"];
$idsTbProdutos = "";

$produto = $_GET["produto"];
$informacaoComplementar1 = $_GET["informacao_complementar1"]; //Obs: Atenção para não dar conflito me futura alteração que leve em conta informacao_complementar1 no nível do histório.

//Busca detalhada - filtros.
$arrIdsProdutosFiltroGenerico = array();

$idsProdutosTipo = $_GET["idsProdutosTipo"];

$arrIdsProdutosFiltroGenerico01 = $_GET["idsProdutosFiltroGenerico01"];
$arrIdsProdutosFiltroGenerico02 = $_GET["idsProdutosFiltroGenerico02"];
$arrIdsProdutosFiltroGenerico03 = $_GET["idsProdutosFiltroGenerico03"];
$arrIdsProdutosFiltroGenerico04 = $_GET["idsProdutosFiltroGenerico04"];
$arrIdsProdutosFiltroGenerico05 = $_GET["idsProdutosFiltroGenerico05"];
$arrIdsProdutosFiltroGenerico06 = $_GET["idsProdutosFiltroGenerico06"];
$arrIdsProdutosFiltroGenerico07 = $_GET["idsProdutosFiltroGenerico07"];
$arrIdsProdutosFiltroGenerico08 = $_GET["idsProdutosFiltroGenerico08"];
$arrIdsProdutosFiltroGenerico09 = $_GET["idsProdutosFiltroGenerico09"];
$arrIdsProdutosFiltroGenerico10 = $_GET["idsProdutosFiltroGenerico10"];
$arrIdsProdutosFiltroGenerico11 = $_GET["idsProdutosFiltroGenerico11"];
$arrIdsProdutosFiltroGenerico12 = $_GET["idsProdutosFiltroGenerico12"];
$arrIdsProdutosFiltroGenerico13 = $_GET["idsProdutosFiltroGenerico13"];
$arrIdsProdutosFiltroGenerico14 = $_GET["idsProdutosFiltroGenerico14"];
$arrIdsProdutosFiltroGenerico15 = $_GET["idsProdutosFiltroGenerico15"];
$arrIdsProdutosFiltroGenerico16 = $_GET["idsProdutosFiltroGenerico16"];
$arrIdsProdutosFiltroGenerico17 = $_GET["idsProdutosFiltroGenerico17"];
$arrIdsProdutosFiltroGenerico18 = $_GET["idsProdutosFiltroGenerico18"];
$arrIdsProdutosFiltroGenerico19 = $_GET["idsProdutosFiltroGenerico19"];
$arrIdsProdutosFiltroGenerico20 = $_GET["idsProdutosFiltroGenerico20"];
$arrIdsProdutosFiltroGenerico21 = $_GET["idsProdutosFiltroGenerico21"];
$arrIdsProdutosFiltroGenerico22 = $_GET["idsProdutosFiltroGenerico22"];
$arrIdsProdutosFiltroGenerico23 = $_GET["idsProdutosFiltroGenerico23"];
$arrIdsProdutosFiltroGenerico24 = $_GET["idsProdutosFiltroGenerico24"];
$arrIdsProdutosFiltroGenerico25 = $_GET["idsProdutosFiltroGenerico25"];
$arrIdsProdutosFiltroGenerico26 = $_GET["idsProdutosFiltroGenerico26"];
$arrIdsProdutosFiltroGenerico27 = $_GET["idsProdutosFiltroGenerico27"];
$arrIdsProdutosFiltroGenerico28 = $_GET["idsProdutosFiltroGenerico28"];
$arrIdsProdutosFiltroGenerico29 = $_GET["idsProdutosFiltroGenerico29"];
$arrIdsProdutosFiltroGenerico30 = $_GET["idsProdutosFiltroGenerico30"];

//Combinar arrays.
if(!empty($arrIdsProdutosFiltroGenerico01) && $idsProdutosTipo[0] <> "")
{
	//array_merge($arrIdsProdutosFiltroGenerico, $arrIdsProdutosFiltroGenerico01);
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $idsProdutosTipo;
}

if(!empty($arrIdsProdutosFiltroGenerico01) && $arrIdsProdutosFiltroGenerico01[0] <> "")
{
	//array_merge($arrIdsProdutosFiltroGenerico, $arrIdsProdutosFiltroGenerico01);
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico01;
}
if(!empty($arrIdsProdutosFiltroGenerico02) && $arrIdsProdutosFiltroGenerico02[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico02;
}
if(!empty($arrIdsProdutosFiltroGenerico03) && $arrIdsProdutosFiltroGenerico03[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico03;
}
if(!empty($arrIdsProdutosFiltroGenerico04) && $arrIdsProdutosFiltroGenerico04[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico04;
}
if(!empty($arrIdsProdutosFiltroGenerico05) && $arrIdsProdutosFiltroGenerico05[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico05;
}
if(!empty($arrIdsProdutosFiltroGenerico06) && $arrIdsProdutosFiltroGenerico06[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico06;
}
if(!empty($arrIdsProdutosFiltroGenerico07) && $arrIdsProdutosFiltroGenerico07[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico07;
}
if(!empty($arrIdsProdutosFiltroGenerico08) && $arrIdsProdutosFiltroGenerico08[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico08;
}
if(!empty($arrIdsProdutosFiltroGenerico09) && $arrIdsProdutosFiltroGenerico09[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico09;
}
if(!empty($arrIdsProdutosFiltroGenerico10) && $arrIdsProdutosFiltroGenerico10[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico10;
}
if(!empty($arrIdsProdutosFiltroGenerico11) && $arrIdsProdutosFiltroGenerico11[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico11;
}
if(!empty($arrIdsProdutosFiltroGenerico12) && $arrIdsProdutosFiltroGenerico12[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico12;
}
if(!empty($arrIdsProdutosFiltroGenerico13) && $arrIdsProdutosFiltroGenerico13[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico13;
}
if(!empty($arrIdsProdutosFiltroGenerico14) && $arrIdsProdutosFiltroGenerico14[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico14;
}
if(!empty($arrIdsProdutosFiltroGenerico15) && $arrIdsProdutosFiltroGenerico15[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico15;
}
if(!empty($arrIdsProdutosFiltroGenerico16) && $arrIdsProdutosFiltroGenerico16[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico16;
}
if(!empty($arrIdsProdutosFiltroGenerico17) && $arrIdsProdutosFiltroGenerico17[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico17;
}
if(!empty($arrIdsProdutosFiltroGenerico18) && $arrIdsProdutosFiltroGenerico18[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico18;
}
if(!empty($arrIdsProdutosFiltroGenerico19) && $arrIdsProdutosFiltroGenerico19[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico19;
}
if(!empty($arrIdsProdutosFiltroGenerico20) && $arrIdsProdutosFiltroGenerico20[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico20;
}
if(!empty($arrIdsProdutosFiltroGenerico21) && $arrIdsProdutosFiltroGenerico21[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico21;
}
if(!empty($arrIdsProdutosFiltroGenerico22) && $arrIdsProdutosFiltroGenerico22[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico22;
}
if(!empty($arrIdsProdutosFiltroGenerico23) && $arrIdsProdutosFiltroGenerico23[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico23;
}
if(!empty($arrIdsProdutosFiltroGenerico24) && $arrIdsProdutosFiltroGenerico24[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico24;
}
if(!empty($arrIdsProdutosFiltroGenerico25) && $arrIdsProdutosFiltroGenerico25[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico25;
}
if(!empty($arrIdsProdutosFiltroGenerico26) && $arrIdsProdutosFiltroGenerico26[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico26;
}
if(!empty($arrIdsProdutosFiltroGenerico27) && $arrIdsProdutosFiltroGenerico27[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico27;
}
if(!empty($arrIdsProdutosFiltroGenerico28) && $arrIdsProdutosFiltroGenerico28[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico28;
}
if(!empty($arrIdsProdutosFiltroGenerico29) && $arrIdsProdutosFiltroGenerico29[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico29;
}
if(!empty($arrIdsProdutosFiltroGenerico30) && $arrIdsProdutosFiltroGenerico30[0] <> "")
{
	$arrIdsProdutosFiltroGenerico = $arrIdsProdutosFiltroGenerico + $arrIdsProdutosFiltroGenerico30;
}

if(!empty($arrIdsProdutosFiltroGenerico))
{
	/**/
	if($idsTbProdutos <> "")
	{
		//Lógica or.
		/*$idsTbVeiculos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																			"tb_cadastro_relacao_complemento", 
																			"id_tb_cadastro_complemento", 
																			"id_tb_cadastro");*/
																			
		//Lógica and.
		$idsTbProdutos .= "," . DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsProdutosFiltroGenerico), 
																			"tb_produtos_relacao_complemento", 
																			"id_tb_produtos_complemento", 
																			"id_tb_produtos", 
																			"2");
	}else{
		//Lógica or.
		/*$idsTbVeiculos .= DbFuncoes::GetIdsByTipoComplemento_FromArray(implode(",",$arrIdsVeiculosFiltroGenerico), 
																		"tb_cadastro_relacao_complemento", 
																		"id_tb_cadastro_complemento", 
																		"id_tb_cadastro");*/
																		
		//Lógica and.
		$idsTbProdutos .= DbFuncoes::GetIdsByTipoComplemento_FromArray02(implode(",",$arrIdsProdutosFiltroGenerico), 
																		"tb_produtos_relacao_complemento", 
																		"id_tb_produtos_complemento", 
																		"id_tb_produtos", 
																		"2");
	}
	
	if($idsTbProdutos == "")
	{
		$idsTbProdutos = "0";
	}
}


//Pesquisa com campos.
$arrPesquisaProdutos = array();
array_push($arrPesquisaProdutos, "id;0;!i");

if($produto <> "")
{
	array_push($arrPesquisaProdutos, "produto;" . $produto . ";like");
}
if($informacaoComplementar1 <> "")
{
	array_push($arrPesquisaProdutos, "informacao_complementar1;" . $informacaoComplementar1 . ";like");
}
if($idsTbProdutos <> "")
{
	array_push($arrPesquisaProdutos, "id;" . $idsTbProdutos . ";ids");
}

$idsTbProdutosPesquisaCampos = DbFuncoes::GetCampoGenerico11("tb_produtos", 
															"id", 
															$arrPesquisaProdutos, 
															"", 
															"", 
															1,
															array());
//Transferência de variável.
if($idsTbProdutosPesquisaCampos <> "")
{
	$idsParentHistorico = $idsTbProdutosPesquisaCampos;
}else{
	$idsParentHistorico = $idsTbProdutos;
}


//Debug.
//echo "produto=" . $produto . "<br>";
//echo "informacaoComplementar1=" . $informacaoComplementar1 . "<br>";

//echo "idsTbProdutos=" . $idsTbProdutos . "<br>";
//echo "idsTbProdutosPesquisaCampos=" . $idsTbProdutosPesquisaCampos . "<br>";

//echo "arrIdsProdutosFiltroGenerico=<pre>";
//echo var_dump($arrIdsProdutosFiltroGenerico);
//echo "</pre><br>";

//echo "arrPesquisaProdutos=<pre>";
//echo var_dump($arrPesquisaProdutos);
//echo "</pre><br>";
//----------




//Definição de exibição de colunas (diagramação tabela).
$arrExibirColunas = $_GET["relatoriosExibirColunas"];
if(empty($arrExibirColunas) == true)
{
	$arrExibirColunas = array("data_historico", "historico", "funcoes"); //padrão
}
array_push($arrExibirColunas, "data_historico", "data1", "produto", "tipo_produto", "data_produto", "id_tb_cadastro1", "id_tb_cadastro2", "id_tb_cadastro3"); //Adicionar parâmetros.
//array_push($arrExibirColunas, "data_historico", "data1", "historico_filtro_generico01", "historico_filtro_generico30", "historico_filtro_generico31", "historico_filtro_generico32", "historico_filtro_generico33", "historico_filtro_generico34", "historico_filtro_generico35", "historico_filtro_generico36", "historico_filtro_generico37", "historico_filtro_generico38", "historico_filtro_generico39", "historico_filtro_generico40"); //Debug.
//array_push($arrExibirColunas, "produto", "tipo_produto", "data_produto", "produtos_informacao_complementar1", "produtos_filtro_generico01", "produtos_filtro_generico02", "produtos_filtro_generico03", "produtos_filtro_generico04", "produtos_filtro_generico05", "produtos_filtro_generico08", "data_historico", "data1", "historico_filtro_generico01", "historico_filtro_generico30", "historico_filtro_generico31", "historico_filtro_generico32", "historico_filtro_generico33", "historico_filtro_generico34", "historico_filtro_generico35", "informacao_complementar1", "informacao_complementar2", "informacao_complementar3", "informacao_complementar4", "informacao_complementar5", "informacao_complementar6", "informacao_complementar7", "informacao_complementar8", "informacao_complementar9", "informacao_complementar10"); //Debug.


$paginaRetorno = "SiteHistoricoIndice.php";
$paginaRetornoExclusao = "SiteHistoricoIndice.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlHistoricoSelect = "";
$strSqlHistoricoSelect .= "SELECT ";
//$strSqlHistoricoSelect .= "* ";
$strSqlHistoricoSelect .= "id, ";
$strSqlHistoricoSelect .= "id_parent, ";
$strSqlHistoricoSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoSelect .= "data_historico, ";

if($GLOBALS['habilitarHistoricoData1'] == 1){
	$strSqlHistoricoSelect .= "data1, ";
}
if($GLOBALS['habilitarHistoricoData2'] == 1){
	$strSqlHistoricoSelect .= "data2, ";
}
if($GLOBALS['habilitarHistoricoData3'] == 1){
	$strSqlHistoricoSelect .= "data3, ";
}
if($GLOBALS['habilitarHistoricoData4'] == 1){
	$strSqlHistoricoSelect .= "data4, ";
}
if($GLOBALS['habilitarHistoricoData5'] == 1){
	$strSqlHistoricoSelect .= "data5, ";
}

$strSqlHistoricoSelect .= "assunto, ";
$strSqlHistoricoSelect .= "historico, ";

$strSqlHistoricoSelect .= "id_tb_cadastro1, ";
$strSqlHistoricoSelect .= "id_tb_cadastro2, ";
$strSqlHistoricoSelect .= "id_tb_cadastro3, ";

/*
$strSqlHistoricoSelect .= "informacao_complementar1, ";
$strSqlHistoricoSelect .= "informacao_complementar2, ";
$strSqlHistoricoSelect .= "informacao_complementar3, ";
$strSqlHistoricoSelect .= "informacao_complementar4, ";
$strSqlHistoricoSelect .= "informacao_complementar5, ";
$strSqlHistoricoSelect .= "informacao_complementar6, ";
$strSqlHistoricoSelect .= "informacao_complementar7, ";
$strSqlHistoricoSelect .= "informacao_complementar8, ";
$strSqlHistoricoSelect .= "informacao_complementar9, ";
$strSqlHistoricoSelect .= "informacao_complementar10, ";
*/
if($GLOBALS['habilitarHistoricoIc1'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar1, ";
}
if($GLOBALS['habilitarHistoricoIc2'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar2, ";
}
if($GLOBALS['habilitarHistoricoIc3'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar3, ";
}
if($GLOBALS['habilitarHistoricoIc4'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar4, ";
}
if($GLOBALS['habilitarHistoricoIc5'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar5, ";
}
if($GLOBALS['habilitarHistoricoIc6'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar6, ";
}
if($GLOBALS['habilitarHistoricoIc7'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar7, ";
}
if($GLOBALS['habilitarHistoricoIc8'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar8, ";
}
if($GLOBALS['habilitarHistoricoIc9'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar9, ";
}
if($GLOBALS['habilitarHistoricoIc10'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar10, ";
}
if($GLOBALS['habilitarHistoricoIc11'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar11, ";
}
if($GLOBALS['habilitarHistoricoIc12'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar12, ";
}
if($GLOBALS['habilitarHistoricoIc13'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar13, ";
}
if($GLOBALS['habilitarHistoricoIc14'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar14, ";
}
if($GLOBALS['habilitarHistoricoIc15'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar15, ";
}
if($GLOBALS['habilitarHistoricoIc16'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar16, ";
}
if($GLOBALS['habilitarHistoricoIc17'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar17, ";
}
if($GLOBALS['habilitarHistoricoIc18'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar18, ";
}
if($GLOBALS['habilitarHistoricoIc19'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar19, ";
}
if($GLOBALS['habilitarHistoricoIc20'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar20, ";
}
if($GLOBALS['habilitarHistoricoIc21'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar21, ";
}
if($GLOBALS['habilitarHistoricoIc22'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar22, ";
}
if($GLOBALS['habilitarHistoricoIc23'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar23, ";
}
if($GLOBALS['habilitarHistoricoIc24'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar24, ";
}
if($GLOBALS['habilitarHistoricoIc25'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar25, ";
}
if($GLOBALS['habilitarHistoricoIc26'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar26, ";
}
if($GLOBALS['habilitarHistoricoIc27'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar27, ";
}
if($GLOBALS['habilitarHistoricoIc28'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar28, ";
}
if($GLOBALS['habilitarHistoricoIc29'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar29, ";
}
if($GLOBALS['habilitarHistoricoIc30'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar30, ";
}
if($GLOBALS['habilitarHistoricoIc31'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar31, ";
}
if($GLOBALS['habilitarHistoricoIc32'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar32, ";
}
if($GLOBALS['habilitarHistoricoIc33'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar33, ";
}
if($GLOBALS['habilitarHistoricoIc34'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar34, ";
}
if($GLOBALS['habilitarHistoricoIc35'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar35, ";
}
if($GLOBALS['habilitarHistoricoIc36'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar36, ";
}
if($GLOBALS['habilitarHistoricoIc37'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar37, ";
}
if($GLOBALS['habilitarHistoricoIc38'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar38, ";
}
if($GLOBALS['habilitarHistoricoIc39'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar39, ";
}
if($GLOBALS['habilitarHistoricoIc40'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar40, ";
}
if($GLOBALS['habilitarHistoricoIc41'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar41, ";
}
if($GLOBALS['habilitarHistoricoIc42'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar42, ";
}
if($GLOBALS['habilitarHistoricoIc43'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar43, ";
}
if($GLOBALS['habilitarHistoricoIc44'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar44, ";
}
if($GLOBALS['habilitarHistoricoIc45'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar45, ";
}
if($GLOBALS['habilitarHistoricoIc46'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar46, ";
}
if($GLOBALS['habilitarHistoricoIc47'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar47, ";
}
if($GLOBALS['habilitarHistoricoIc48'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar48, ";
}
if($GLOBALS['habilitarHistoricoIc49'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar49, ";
}
if($GLOBALS['habilitarHistoricoIc50'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar50, ";
}
if($GLOBALS['habilitarHistoricoIc51'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar51, ";
}
if($GLOBALS['habilitarHistoricoIc52'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar52, ";
}
if($GLOBALS['habilitarHistoricoIc53'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar53, ";
}
if($GLOBALS['habilitarHistoricoIc54'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar54, ";
}
if($GLOBALS['habilitarHistoricoIc55'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar55, ";
}
if($GLOBALS['habilitarHistoricoIc56'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar56, ";
}
if($GLOBALS['habilitarHistoricoIc57'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar57, ";
}
if($GLOBALS['habilitarHistoricoIc58'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar58, ";
}
if($GLOBALS['habilitarHistoricoIc59'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar59, ";
}
if($GLOBALS['habilitarHistoricoIc60'] == 1){
	$strSqlHistoricoSelect .= "informacao_complementar60, ";
}

$strSqlHistoricoSelect .= "id_tb_historico_status ";
$strSqlHistoricoSelect .= "FROM tb_historico ";
$strSqlHistoricoSelect .= "WHERE id <> 0 ";
if($idParentHistorico <> "")
{
	$strSqlHistoricoSelect .= "AND id_parent = :id_parent ";
}
if($idsTbHistorico <> "")
{
	$strSqlHistoricoSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbHistorico) . ") ";
}
if($idsParentHistorico <> "")
{
	$strSqlHistoricoSelect .= "AND id_parent IN (" . Funcoes::ConteudoMascaraGravacao01($idsParentHistorico) . ") ";
}

if($idTbHistoricoStatus <> "")
{
	$strSqlHistoricoSelect .= "AND id_tb_historico_status = :id_tb_historico_status ";
}
if($dataInicial <> "" && $dataFinal <> "")
{
	$strSqlHistoricoSelect .= "AND data_historico BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
	//$strSqlHistoricoSelect .= "AND data_historico BETWEEN DATE(:dataInicial) AND DATE(:dataFinal) ";
	//$strSqlHistoricoSelect .= "AND data_historico BETWEEN :dataInicial AND :dataFinal ";
}

if($informacaoComplementar3 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar3 = :informacao_complementar3 ";
}
if($informacaoComplementar7 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar7 = :informacao_complementar7 ";
}
if($informacaoComplementar35 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar35 = :informacao_complementar35 ";
}
if($informacaoComplementar55 <> "")
{
	$strSqlHistoricoSelect .= "AND informacao_complementar55 = :informacao_complementar55 ";
}

if($palavraChave <> "")
{
	/*
	*/
	$strSqlHistoricoSelect .= "AND (assunto LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlHistoricoSelect .= "OR historico LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlHistoricoSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";

	if($GLOBALS['habilitarHistoricoIc1'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc2'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc3'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc4'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc5'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc6'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc7'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc8'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc9'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc10'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc11'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc12'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc13'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc14'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc15'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc16'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar16 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc17'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar17 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc18'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar18 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc19'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar19 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc20'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar20 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc21'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar21 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc22'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar22 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc23'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar23 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc24'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar24 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc25'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar25 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc26'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar26 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc27'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar27 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc28'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar28 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc29'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar29 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc30'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar30 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc31'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar31 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc32'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar32 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc33'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar33 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc34'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar34 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc35'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar35 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc36'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar36 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc37'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar37 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc38'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar38 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc39'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar39 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc40'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar40 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc41'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar41 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc42'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar42 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc43'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar43 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc44'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar44 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc45'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar45 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc46'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar46 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc47'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar47 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc48'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar48 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc49'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar49 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc50'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar50 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc51'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar51 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc52'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar52 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc53'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar53 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc54'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar54 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc55'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar55 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc56'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar56 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc57'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar57 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc58'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar58 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc59'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar59 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	if($GLOBALS['habilitarHistoricoIc60'] == 1){
		$strSqlHistoricoSelect .= "OR informacao_complementar60 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	}
	
	$strSqlHistoricoSelect .= ") ";
}

$strSqlHistoricoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastroHistorico'] . " ";
//echo "strSqlHistoricoSelect=" . $strSqlHistoricoSelect . "<br />";
//----------

//Criação de componentes e parâmetros.
//----------
$statementHistoricoSelect = $dbSistemaConPDO->prepare($strSqlHistoricoSelect);

if ($statementHistoricoSelect !== false)
{
	/*
	$statementHistoricoSelect->execute(array(
		"id_parent" => $idParent
	));
	*/
	if($idParentHistorico <> "")
	{
		$statementHistoricoSelect->bindParam(':id_parent', $idParentHistorico, PDO::PARAM_STR);
	}
	if($idTbHistoricoStatus <> "")
	{
		$statementHistoricoSelect->bindParam(':id_tb_historico_status', $idTbHistoricoStatus, PDO::PARAM_STR);
	}
	if($dataInicial <> "" && $dataFinal <> "")
	{
		//Não funcionou.
		//$statementHistoricoSelect->bindParam(':dataInicial', $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, PDO::PARAM_STR);
		//$statementHistoricoSelect->bindParam(':dataFinal', $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, PDO::PARAM_STR);
	}
	
	if($informacaoComplementar3 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar3', $informacaoComplementar3, PDO::PARAM_STR);
	}
	if($informacaoComplementar7 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar7', $informacaoComplementar7, PDO::PARAM_STR);
	}
	if($informacaoComplementar35 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar35', $informacaoComplementar35, PDO::PARAM_STR);
	}
	if($informacaoComplementar55 <> "")
	{
		$strSqlHistoricoSelect->bindParam(':informacao_complementar55', $informacaoComplementar55, PDO::PARAM_STR);
	}
	
	$statementHistoricoSelect->execute();
}

//$resultadoHistorico = $dbSistemaConPDO->query($strSqlHistoricoSelect);
$resultadoHistorico = $statementHistoricoSelect->fetchAll();
//----------


//Definição de variáveis.
if($idParentHistorico <> "")
{
	//$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo");
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteRelatoriosTitulo");
}
if($palavraChave <> "")
{
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == "")
{
	//$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo");
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteRelatoriosTitulo");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
/*
echo "arrExibirColunas=<pre>";
echo var_dump($arrExibirColunas);
echo "</pre><br>";
*/
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTitulo"); ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    
    
    <?php
	if (empty($resultadoHistorico))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemHistoricoVazio"); ?>
        </div>
    <?php
    }else{
    ?>
		<?php //Diagramação 01 - Tabela.?>
        <?php //**************************************************************************************?>
		<div class="AdmTexto01" style="position: relative; display: block; clear: both;/* overflow: hidden;*/">
            <table width="100%" class="AdmTabelaDados01" style="/*table-layout: auto;*/">
              <tr class="AdmTbFundoEscuro AdmTexto02">
              	<?php if(in_array("id", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                    <td width="50" class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoProtocolo"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("data_historico", $arrExibirColunas) == true){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if(in_array("data1", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
                    <td width="50" class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData1'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("produto", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("tipo_produto", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("data_produto", $arrExibirColunas) == true){ ?>
                    <td width="50" class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosData"); ?> (Obra)
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_informacao_complementar1", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico01", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico02", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico03", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico04", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico05", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico06", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico07", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico08", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico09", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico10", $arrExibirColunas) == true){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProdutosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                <?php } ?>

                <?php if(in_array("historico", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if(in_array("id_tb_cadastro1", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                    <td width="100" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("id_tb_cadastro2", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                    <td width="100" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("id_tb_cadastro3", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                    <td width="100" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico01", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico02", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico03", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico04", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico05", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico06", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico07", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico08", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico09", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico10", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>

                <?php if(in_array("historico_filtro_generico11", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico12", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico13", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico14", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico15", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico16", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico17", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico18", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico19", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico20", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico21", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico22", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico23", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico24", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico25", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico26", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico27", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico28", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico29", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico30", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico31", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico32", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico33", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico34", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico35", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico36", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico37", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico38", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico39", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico40", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico41", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico42", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico43", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico44", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico45", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico46", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico47", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico48", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico49", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico50", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico51", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico52", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico53", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico54", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico55", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico56", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico57", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico58", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico59", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico60", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico61", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico62", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico63", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico64", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico65", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico66", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico67", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico68", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico69", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico70", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico71", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico72", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico73", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico74", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico75", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico76", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico77", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico78", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico79", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico80", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar1", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc1'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar2", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc2'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar3", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar4", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar5", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar6", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar7", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc7'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar8", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc8'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc8'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar9", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc9'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc9'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar10", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc10'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc10'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar11", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc11'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc11'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar12", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc12'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc12'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar13", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc13'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc13'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar14", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc14'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc14'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar15", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc15'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc15'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar16", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc16'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc16'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar17", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar18", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar19", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc19'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar20", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar21", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar22", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc22'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc22'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar23", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc23'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc23'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar24", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc24'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc24'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar25", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc25'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc25'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar26", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc26'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc26'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar27", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc27'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc27'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar28", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc28'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc28'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar29", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc29'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc29'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar30", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc30'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc30'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar31", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc31'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc31'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar32", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc32'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc32'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar33", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc33'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc33'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar34", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc34'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc34'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar35", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc35'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar36", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc36'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc36'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar37", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc37'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc37'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar38", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc38'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc38'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar39", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc39'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc39'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar40", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc40'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc40'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar41", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc41'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc41'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar42", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc42'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc42'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar43", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar44", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc44'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc44'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar45", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc45'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc45'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar46", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc46'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc46'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar47", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc47'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc47'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar48", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc48'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc48'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar49", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc49'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar50", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc50'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar51", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc51'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar52", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc52'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar53", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc53'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar54", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc54'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar55", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar56", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc56'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar57", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar58", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc58'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar59", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc59'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar60", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
                    <td width="150" class="AdmTabelaDados01Celula">
                        <div>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc60'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("funcoes", $arrExibirColunas) == true){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if(in_array("id_tb_historico_status", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                    <td width="100">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("editar", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                    <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("excluir", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                    <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("selecionar", $arrExibirColunas) == true){ ?>
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php
				$countRegistros = 0;
				
				
				$countTabelaFundo = 0;
			  	$arrHistoricoStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 4);

				//Carregamento dos registros da tabela auxiliar.
				//Obs: Talvez modificar para variáveis individualizadas de acordo com liberação e exibição de colunas.
				$resultadoHistoricoComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_historico_complemento", 
																						NULL, 
																						"complemento", 
																						"");
				/*																		
				$resultadoProdutosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_produtos_complemento", 
																						NULL, 
																						"complemento", 
																						"");
				*/
			  
                //Loop pelos resultados.
                foreach($resultadoHistorico as $linhaHistorico)
                {
					$countRegistros++;
					
					//Complementos vinculados.
					$resultadoHistoricoComplementoRelacao = ""; //Limpar variável.
					$resultadoHistoricoComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_historico_relacao_complemento", 
																										$linhaHistorico['id'], 
																										"id_tb_historico");
																										
					//Objeto - Produtos.
					//----------
					//Detalhes do produto vinculado.
					$opdProdutoVinculado = "";
					$opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do cadastro.
					
					//Definição dos valores do cadastro logado.
					$opdProdutoVinculado->ProdutosDetalhesResultado($linhaHistorico['id_parent'], 1); //Detalhes da tabela principal.
					$opdProdutoVinculado->ProdutosDetalhesComplemento($linhaHistorico['id_parent'], 1); //Detalhes (ids) da tabela complementar.
					$opdProdutoVinculado->ProdutosDetalhesComplemento_print($linhaHistorico['id_parent'], 1);//Detalhes (ids/complamento) da tabela complementar.
					
					//Definição de valores.
					//$tbProdutosId = $opdProdutoVinculado->tbProdutosId;
					//$tbProdutosCodProduto = $opdProdutoVinculado->tbProdutosCodProduto;
					//$tbProdutosProduto = $opdProdutoVinculado->tbProdutosProduto;
					//----------
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?> AdmTexto01">
              	<?php if(in_array("id", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarCadastroHistoricoVisualizarProtocolo'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php echo $linhaHistorico['id'];?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("data_historico", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center">
                        <?php //echo $linhaHistorico['data_historico'];?>
                        <?php echo Funcoes::DataLeitura01($linhaHistorico['data_historico'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                        <?php //echo Funcoes::DataLeitura01($linhaHistorico['data_historico'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if(in_array("data1", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php //echo $linhaHistorico['data_historico'];?>
                            <?php echo Funcoes::DataLeitura01($linhaHistorico['data1'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                            <?php //echo Funcoes::DataLeitura01($linhaHistorico['data1'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>

                <?php if(in_array("produto", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php echo $opdProdutoVinculado->tbProdutosProduto;?>
                        <?php 
						//Debug.
						/*
						echo "opdProdutoVinculado=<pre>";
						var_dump($opdProdutoVinculado);
						echo "</pre><br/>";
						*/
						?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("tipo_produto", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
						<?php //echo $opdProdutoVinculado->arrProdutosTipoSelecao;?>
						<?php
                        //Loop pelos resultados.
                        //foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        //{
                        ?>
                            <!--div align="left">
                                <?php //if($linhaProdutosComplemento["tipo_complemento"] == "2"){ ?> 
                                    <?php //if(in_array($linhaProdutosComplemento["id"], $opdProdutoVinculado->arrProdutosTipoSelecao)){ ?> 
                                        - <?php //echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php //} ?>
                                <?php //} ?>
                            </div-->
                        <?php //} ?>
                        
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosTipoSelecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosTipoSelecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                        
                        <?php 
						//Debug.
						/*
						echo "arrProdutosTipoSelecao=<pre>";
						var_dump($opdProdutoVinculado->arrProdutosTipoSelecao);
						echo "</pre><br/>";
						*/
						
						//echo "arrProdutosTipoSelecao_print=<pre>";
						//var_dump($opdProdutoVinculado->arrProdutosTipoSelecao_print);
						//echo "</pre><br/>";
						?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("data_produto", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center">
						<?php echo $opdProdutoVinculado->tbProdutosDataProduto;?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_informacao_complementar1", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
						<?php echo $opdProdutoVinculado->tbProdutosIC1;?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico01", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico01Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico01Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico02", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico02Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico02Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico03", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico03Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico03Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico04", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico04Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico04Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico05", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico05Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico05Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico06", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico06Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico06Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico07", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico07Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico07Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico08", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
						<?php
                        //Loop pelos resultados.
                        //foreach($resultadoProdutosComplemento as $linhaProdutosComplemento)
                        //{
                        ?>
                            <!--div align="left">
                                <?php //if($linhaProdutosComplemento["tipo_complemento"] == "19"){ ?> 
                                    <?php //if(in_array($linhaProdutosComplemento["id"], $opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao)){ ?> 
                                        - <?php //echo Funcoes::ConteudoMascaraLeitura($linhaProdutosComplemento["complemento"]);?>
                                    <?php //} ?>
                                <?php //} ?>
                            </div-->
                        <?php //} ?>
                    
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                        
                        <?php 
						//Debug.
						//echo "arrProdutosFiltroGenerico08Selecao_print=<pre>";
						//var_dump($opdProdutoVinculado->arrProdutosFiltroGenerico08Selecao_print);
						//echo "</pre><br/>";
						?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico09", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico09Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico09Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                <?php if(in_array("produtos_filtro_generico10", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div>
                        <?php 
						//Loop pelos resultados.
						for($countArray = 0; $countArray < count($opdProdutoVinculado->arrProdutosFiltroGenerico10Selecao_print); $countArray++)
						{ 
						?>
                            <div align="left">
                            	- <?php echo $opdProdutoVinculado->arrProdutosFiltroGenerico10Selecao_print[$countArray]["complemento"];?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if(in_array("historico", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div >
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['assunto']);?>
                        </strong>
                    </div>
                    <div >
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['historico']);?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if(in_array("id_tb_cadastro1", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div >
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            </a>
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("id_tb_cadastro2", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            </a>
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("id_tb_cadastro3", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div >
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaHistorico['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            </a>
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaHistorico['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico01", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "12"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico02", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "13"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico03", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "14"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico04", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "15"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico05", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "16"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico06", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "17"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico07", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "18"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico08", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "19"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico09", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "20"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico10", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "21"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico11", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "22"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico12", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "23"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico13", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "24"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico14", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "25"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico15", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "26"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico16", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "27"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico17", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "28"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico18", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "29"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico19", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "30"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico20", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "31"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico21", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "32"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico22", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "33"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico23", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "34"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico24", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "35"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico25", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "36"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico26", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "37"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico27", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "38"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico28", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "39"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico29", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "40"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico30", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "41"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico31", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "42"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico32", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "43"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico33", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "44"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico34", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "45"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico35", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "46"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico36", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "47"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico37", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "48"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico38", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "49"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico39", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "50"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico40", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "51"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico41", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "52"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico42", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "53"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico43", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "54"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico44", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "55"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico45", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "56"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico46", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "57"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico47", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "58"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico48", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "59"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico49", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "60"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico50", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "61"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico51", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "62"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico52", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "63"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico53", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "64"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico54", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "65"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico55", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "66"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico56", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "67"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico57", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "68"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico58", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "69"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico59", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "70"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico60", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "71"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico61", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "72"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico62", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "73"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico63", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "74"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico64", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "75"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico65", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "76"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico66", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "77"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico67", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "78"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico68", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "79"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico69", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "80"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico70", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "81"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("historico_filtro_generico71", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "82"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico72", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "83"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico73", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "84"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico74", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "85"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico75", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "86"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico76", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "87"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico77", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "88"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico78", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "89"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico79", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "90"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("historico_filtro_generico80", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                            {
                            ?>
                                <div align="left">
                                    <?php if($linhaHistoricoComplemento["tipo_complemento"] == "91"){ ?> 
                                        <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar1", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar1']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar2", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar2']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar3", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar3']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar4", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar4']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar5", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar5']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar6", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar6']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar7", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc7'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar7']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar8", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc8'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar8']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar9", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc9'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar9']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar10", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc10'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar10']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar11", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc11'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar11']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar12", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc12'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar12']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar13", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc13'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar13']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar14", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc14'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar14']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar15", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc15'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar15']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar16", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc16'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar16']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar17", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar17']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar18", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar18']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar19", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar19']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar20", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar20']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar21", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar21']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar22", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc22'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar22']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar23", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc23'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar23']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar24", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc24'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar24']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar25", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc25'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar25']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar26", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc26'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar26']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar27", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc27'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar27']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar28", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc28'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar28']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar29", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc29'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar29']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar30", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc30'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar30']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar31", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc31'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar31']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar32", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc32'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar32']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar33", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc33'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar33']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar34", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc34'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar34']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar35", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc35'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar35']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar36", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc36'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar36']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar37", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc37'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar37']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar38", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc38'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar38']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar39", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc39'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar39']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar40", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc40'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar40']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar41", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc41'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar41']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar42", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc42'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar42']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar43", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar43']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar44", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc44'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar44']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar45", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc45'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar45']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar46", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc46'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar46']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar47", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc47'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar47']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar48", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc48'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar48']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar49", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar49']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar50", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar50']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("informacao_complementar51", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar51']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar52", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar52']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar53", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar53']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar54", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar54']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar55", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar55']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar56", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar56']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar57", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar57']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar58", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar58']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar59", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar59']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("informacao_complementar60", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="left">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaHistorico['informacao_complementar60']);?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                                
                <?php if(in_array("funcoes", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center">
                    	<a href="SiteAdmHistoricoEditar.php?idTbHistorico=<?php echo $linhaHistorico['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </a>
                    </div>
                    <?php if($GLOBALS['habilitarCadastroHistoricoInteracao'] == 1){ ?>
                        <div align="center">
                            <a href="SiteAdmHistoricoInteracaoIndice.php?idParent=<?php echo $linhaHistorico['id'];?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInteracao"); ?>
                            </a>
                        </div>
                    <?php } ?>
                </td>
                <?php } ?>

                <?php if(in_array("id_tb_historico_status", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center">
                            <?php 
                            for($countArray = 0; $countArray < count($arrHistoricoStatus); $countArray++)
                            {
                            ?>
                                <?php if($arrHistoricoStatus[$countArray][0] == $linhaHistorico['id_tb_historico_status']){ ?>
                                    <?php echo $arrHistoricoStatus[$countArray][1];?>
                                <?php } ?>
                            <?php 
                            }
                            ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("editar", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoAdmEdicao'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <a href="SiteAdmHistoricoEditar.php?idTbHistorico=<?php echo $linhaHistorico['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            </a>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <?php if(in_array("excluir", $arrExibirColunas) == true){ ?>
					<?php if($GLOBALS['habilitarHistoricoAdmExclusao'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula" style="display: none;">
                        <div align="center">
                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaHistorico['id'];?>" class="CampoCheckBox01" />
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                <?php if(in_array("selecionar", $arrExibirColunas) == true){ ?>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaHistorico['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaHistorico['id'];?>" class="AdmCampoRadioButton01" />
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php 
					//Limpeza de objetos.
					//----------
					unset($opdProdutoVinculado);


				  //Linha alternativa de tabela.
				  //----------
				  //$countTabelaFundo = $countTabelaFundo + 1;
				  $countTabelaFundo++;
				
				   if($countTabelaFundo == 2)
				   {
					   $countTabelaFundo = 0;
				   }
				  //----------
				} 
			  ?>
            </table>
        </div>
        
        <div class="AdmTexto01" style="position: relative; display: none;">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteRelatoriosTotal"); ?>: <?php echo $countRegistros;?>
        </div>
	<?php } ?>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoSelect);
unset($statementHistoricoSelect);
unset($resultadoHistorico);
unset($linhaHistorico);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>