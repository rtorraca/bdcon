<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";

//Recurso para forçar exibição de erro, caso o servidor não esteja exibindo os erros.
//----------------------
//ini_set('display_errors', 1); //Mostra todos os erros.
//error_reporting(0); //Ocultar todos erros.
//error_reporting(E_ALL); //alpshost
//error_reporting(E_STRICT & ~E_STRICT); //Locaweb Linux 5.4
//error_reporting(E_ALL | E_STRICT);
//error_reporting(error_reporting() & ~E_NOTICE);

//Resumido - forte.
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
//----------------------



//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];

$paginaRetorno = "PedidosIndice.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno;

$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.



//Verificação de erro - debug.
//echo "debug=" . "9" . "<br />";
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentPedidos=" . $idParentPedidos . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo htmlentities($GLOBALS['configNomeCliente']); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	Teste Arquivo Ler 01
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

	<?php
	$objStreamReader = Arquivo::ArquivosConteudoLer01($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "teste_emails01.txt", 1, 0);
	$arrObjStreamReader = preg_split('/\r\n|\r|\n/', $objStreamReader);
	
	//Loop pelo conteúdo do arquivo.
	for($countArrayLinhas = 0; $countArrayLinhas < count($arrObjStreamReader); $countArrayLinhas++)
	{
		//Debug.
		echo "arrObjStreamReader=" . $arrObjStreamReader[$countArrayLinhas] . "<br />"; 
	}
	
	//Debug.
    //echo "ArquivosConteudoLer01=" . Arquivo::ArquivosConteudoLer01($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "teste_emails01.txt", 1) . "<br />";
    //echo "objStreamReader=" . $objStreamReader . "<br />";
	
	/*
	$arquivoLer = fopen($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "teste_emails01.txt", "r") or die("Erro ao ler arquivo!"); //ref: https://www.w3schools.com/php/php_file_open.asp
	echo "teste direto = " . fread($arquivoLer, filesize($GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'] . "/" . "teste_emails01.txt"));
	fclose($arquivoLer);
	*/
	?>

<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
//----------
?>


<?php 
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>