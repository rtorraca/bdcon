<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
//$idTbOpcoes = $_POST["id_tb_opcoes"];
$idTbEnquetes = $_POST["idTbEnquetes"];
$idTbOpcoes = $_POST["grupo" . $idTbEnquetes];
$idParentEnquetes = $_POST["idParentEnquetes"];
$tipoEnquete = $_POST["tipoEnquete"];

//$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroUsuarioLogado = $_POST["idTbCadastroUsuarioLogado"];
$idsTbCadastroUsuarioLogado = $_POST["idsTbCadastroUsuarioLogado"];
$idTbCadastroUsuario = $_POST["idTbCadastroUsuario"];
$idsTbCadastroUsuario = $_POST["idsTbCadastroUsuario"];

$palavraChave = $_POST["palavraChave"];
$paginacaoNumero = $_POST["paginacaoNumero"];
$caracterAtual = $_POST["caracterAtual"];

$paginaRetorno = $_POST["paginaRetorno"];
$masterPageSiteSelect = $_POST["masterPageSiteSelect"];
//$variavelRetorno = "idParentEnquetes";
//$idRetorno = $idParentEnquetes;
$mensagemErro = "";
$mensagemSucesso = "";
$mensagemAlerta = "";


//Verificação de erro - debug.
//echo "tipoRedirect=" . $tipoRedirect . "<br>";
/*
echo "idTbOpcoes=" . $idTbOpcoes . "<br>";
echo "idTbEnquetes=" . $idTbEnquetes . "<br>";
echo "idParentEnquetes=" . $idParentEnquetes . "<br>";
echo "tipoEnquete=" . $tipoEnquete . "<br>";
echo "idTbCadastroUsuarioLogado=" . $idTbCadastroUsuarioLogado . "<br>";
echo "idsTbCadastroUsuarioLogado=" . $idsTbCadastroUsuarioLogado . "<br>";
echo "idTbCadastroUsuario=" . $idTbCadastroUsuario . "<br>";
echo "idsTbCadastroUsuario=" . $idsTbCadastroUsuario . "<br>";
*/
//$dbSistemaConPDO = null;
//exit();


//Rotina para contabilização do voto.
//**************************************************************************************
if($idTbOpcoes <> "")
{
	$idTbEnquetesOpcaoSelecionadaNVotos = DbFuncoes::GetCampoGenerico01($idTbOpcoes, "tb_enquetes_opcoes", "n_votos");
	$nVotosAtualizado = idTbEnquetesOpcaoSelecionadaNVotos + 1;
	
	//Atualização de votos.
	if(DbUpdate::DBRegistroGenericoUpdate01($nVotosAtualizado, $idTbOpcoes, "tb_enquetes_opcoes", "n_votos") == true)
	{
		//Sucesso.
		
		//Registro de log da resposta da enquete.
		if(DbInsert::EnquetesLogRegistrar($idTbCadastroUsuarioLogado, $idTbEnquetes, $idTbOpcoes) == true)
		{
			
		}else{
			$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemEnquetesStatusVoto2");
		}
	}
}
//**************************************************************************************



//Fechamento da conexão.
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParentEnquetes=" . $idParentEnquetes .
"&idTbEnquetes=" . $idTbEnquetes .
"&tipoEnquete=" . $tipoEnquete .
"&paginacaoNumero=" . $paginacaoNumero .
"&palavraChave=" . $palavraChave .
"&paginacaoNumero=" . $paginacaoNumero .
"&caracterAtual=" . $caracterAtual .
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;


////Limpeza do buffer de saída.
/*
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