<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$tipoPagamento = $_GET["tipoPagamento"];


//Verificação de erro - debug.
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluido"); ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluido"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div id="lblMensagemErro" align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div id="lblMensagemSucesso" align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div id="lblMensagemAlerta" align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>


    <div align="center" class="CadastroTexto" style="position: relative; display: block; overflow: hidden;">
		<?php if($GLOBALS['habilitarCadastroConfirmacaoAtivacaoEmail'] == 1){ ?>
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluidoMensagemSucesso2"); ?>
		<?php }else{ ?>
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroConcluidoMensagemSucesso1"); ?>
		<?php } ?>
    </div>


	<?php //Conteúdo.?>
    <?php //----------------------?>
    <?php 
    //Definição de variáveis do include.
    $includeConteudo_idParentConteudo = "0";
    $includeConteudo_idTbConteudo = "";
    $includeConteudo_tipoConteudo = "";
    
    $includeConteudo_configTipoDiagramacao = "1";
    $includeConteudo_configConteudoNRegistros = "";
    $includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
    ?>
    
    <?php include "IncludeConteudo.php";?>
    <?php //----------------------?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>