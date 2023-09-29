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

$dataInclusao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");

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


//Inclusão de registro no BD.
//----------
$strSqlNewsletterIPsRotativoInsert = "";
$strSqlNewsletterIPsRotativoInsert .= "INSERT INTO tb_newsletter_ips ";
$strSqlNewsletterIPsRotativoInsert .= "SET ";
$strSqlNewsletterIPsRotativoInsert .= "id = :id, ";
$strSqlNewsletterIPsRotativoInsert .= "id_parent = :id_parent, ";
$strSqlNewsletterIPsRotativoInsert .= "data_inclusao = :data_inclusao, ";
$strSqlNewsletterIPsRotativoInsert .= "titulo = :titulo, ";

$strSqlNewsletterIPsRotativoInsert .= "ip_rotativo = :ip_rotativo, ";

$strSqlNewsletterIPsRotativoInsert .= "servidor_smtp = :servidor_smtp, ";
$strSqlNewsletterIPsRotativoInsert .= "usuario = :usuario, ";
$strSqlNewsletterIPsRotativoInsert .= "senha = :senha, ";
$strSqlNewsletterIPsRotativoInsert .= "porta_smtp = :porta_smtp, ";
$strSqlNewsletterIPsRotativoInsert .= "encryption = :encryption, ";

$strSqlNewsletterIPsRotativoInsert .= "habilitar_autenticacao = :habilitar_autenticacao, ";
$strSqlNewsletterIPsRotativoInsert .= "ativacao = :ativacao, ";
$strSqlNewsletterIPsRotativoInsert .= "ativacao_selecao = :ativacao_selecao, ";

$strSqlNewsletterIPsRotativoInsert .= "informacao_configuracao1 = :informacao_configuracao1, ";
$strSqlNewsletterIPsRotativoInsert .= "informacao_configuracao2 = :informacao_configuracao2, ";
$strSqlNewsletterIPsRotativoInsert .= "informacao_configuracao3 = :informacao_configuracao3, ";
$strSqlNewsletterIPsRotativoInsert .= "informacao_configuracao4 = :informacao_configuracao4, ";
$strSqlNewsletterIPsRotativoInsert .= "informacao_configuracao5 = :informacao_configuracao5, ";

$strSqlNewsletterIPsRotativoInsert .= "obs = :obs ";
/**/
//----------


//Debug.
/*
echo "strSqlNewsletterIPsRotativoInsert=" . $strSqlNewsletterIPsRotativoInsert . "<br />";
echo "id=" . $id . "<br />";
echo "idTbCategorias=" . $idTbCategorias . "<br />";
$dbSistemaConPDO = null;
die();
*/


//Parâmetros.
//----------
$statementNewsletterIPsRotativoInsert = $dbSistemaConPDO->prepare($strSqlNewsletterIPsRotativoInsert);

/*
*/
if ($statementNewsletterIPsRotativoInsert !== false)
{
	$statementNewsletterIPsRotativoInsert->execute(array(
		"id" => $id,
		"id_parent" => $idParent,
		"data_inclusao" => $dataInclusao,
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
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus2");
	//Obs: Colocar um flag de verificação de gravação.
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus3");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlNewsletterIPsRotativoInsert);
unset($statementNewsletterIPsRotativoInsert);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idParent=" . $idParent .
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