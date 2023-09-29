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
$id = $_POST["idTbNewsletterIPsRotativo"];
$idParent = $_POST["id_parent"];

//$dataInclusao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

$titulo = Funcoes::ConteudoMascaraGravacao01($_POST["titulo"]);
$ipRotativo = $_POST["ip_rotativo"];

$servidorSMTP = $_POST["servidor_smtp"];
$usuario = Funcoes::ConteudoMascaraGravacao01($_POST["usuario"]);
$senha = Funcoes::ConteudoMascaraGravacao01($_POST["senha"]);
$portaSMTP = $_POST["porta_smtp"];
$encryption = $_POST["encryption"];
$habilitarAutenticacao = $_POST["habilitar_autenticacao"];
$ativacao = $_POST["ativacao"];
$ativacaoSelecao = $_POST["ativacao_selecao"];

$informacaoConfiguracao1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_configuracao1"]);
$informacaoConfiguracao2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_configuracao2"]);
$informacaoConfiguracao3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_configuracao3"]);
$informacaoConfiguracao4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_configuracao4"]);
$informacaoConfiguracao5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_configuracao5"]);

$obs = Funcoes::ConteudoMascaraGravacao01($_POST["obs"]);

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlNewsletterIPsRotativoUpdate = "";
$strSqlNewsletterIPsRotativoUpdate .= "UPDATE tb_newsletter_ips ";
$strSqlNewsletterIPsRotativoUpdate .= "SET ";
//$strSqlNewsletterIPsRotativoUpdate .= "id = :id, ";
//$strSqlNewsletterIPsRotativoUpdate .= "id = :id, ";
$strSqlNewsletterIPsRotativoUpdate .= "id_parent = :id_parent, ";
//$strSqlNewsletterIPsRotativoUpdate .= "data_inclusao = :data_inclusao, ";
$strSqlNewsletterIPsRotativoUpdate .= "titulo = :titulo, ";

$strSqlNewsletterIPsRotativoUpdate .= "ip_rotativo = :ip_rotativo, ";

$strSqlNewsletterIPsRotativoUpdate .= "servidor_smtp = :servidor_smtp, ";
$strSqlNewsletterIPsRotativoUpdate .= "usuario = :usuario, ";
$strSqlNewsletterIPsRotativoUpdate .= "senha = :senha, ";
$strSqlNewsletterIPsRotativoUpdate .= "porta_smtp = :porta_smtp, ";
$strSqlNewsletterIPsRotativoUpdate .= "encryption = :encryption, ";

$strSqlNewsletterIPsRotativoUpdate .= "habilitar_autenticacao = :habilitar_autenticacao, ";
$strSqlNewsletterIPsRotativoUpdate .= "ativacao = :ativacao, ";
$strSqlNewsletterIPsRotativoUpdate .= "ativacao_selecao = :ativacao_selecao, ";

$strSqlNewsletterIPsRotativoUpdate .= "informacao_configuracao1 = :informacao_configuracao1, ";
$strSqlNewsletterIPsRotativoUpdate .= "informacao_configuracao2 = :informacao_configuracao2, ";
$strSqlNewsletterIPsRotativoUpdate .= "informacao_configuracao3 = :informacao_configuracao3, ";
$strSqlNewsletterIPsRotativoUpdate .= "informacao_configuracao4 = :informacao_configuracao4, ";
$strSqlNewsletterIPsRotativoUpdate .= "informacao_configuracao5 = :informacao_configuracao5, ";

$strSqlNewsletterIPsRotativoUpdate .= "obs = :obs ";
$strSqlNewsletterIPsRotativoUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlNewsletterIPsRotativoUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementNewsletterIPsRotativoUpdate = $dbSistemaConPDO->prepare($strSqlNewsletterIPsRotativoUpdate);

/*
"data_inclusao" => $dataInclusao,
*/
if ($statementNewsletterIPsRotativoUpdate !== false)
{
	$statementNewsletterIPsRotativoUpdate->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"titulo" => $titulo,
		"ip_rotativo" => $ipRotativo,
		"servidor_smtp" => $servidorSMTP,
		"usuario" => $usuario,
		"senha" => $senha,
		"porta_smtp" => $portaSMTP,
		"encryption" => $encryption,
		"habilitar_autenticacao" => $habilitarAutenticacao,
		"ativacao" => $ativacao,
		"ativacao_selecao" => $ativacaoSelecao,
		"informacao_configuracao1" => $informacaoConfiguracao1,
		"informacao_configuracao2" => $informacaoConfiguracao2,
		"informacao_configuracao3" => $informacaoConfiguracao3,
		"informacao_configuracao4" => $informacaoConfiguracao4,
		"informacao_configuracao5" => $informacaoConfiguracao5,
		"obs" => $obs
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlNewsletterIPsRotativoUpdate);
unset($statementNewsletterIPsRotativoUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbNewsletterIPsRotativoGrupos=" . $idTbNewsletterIPsRotativoGrupos .
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