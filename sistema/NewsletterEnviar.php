<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbNewsletter = $_GET["idTbNewsletter"];
if($GLOBALS['configNewsletterEmailsAvulso'] == 0)
{
	$idTbNewsletter = 0;
}

$paginaRetorno = "NewsletterEnviar.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

$arrEmailDestinatario = array();
$arrEmailDestinatarioNome = array();
$arrEmailDestinatarioId = array();
$arrTabela = array();

$countArray = 0;
$countEmails = 0;


//Variáveis para o envio da mensagem.
//-------------
//Dim emailCorpoMensagem As String = ""
$emailCorpoMensagemParte01 = "";
$emailCorpoMensagemParte02 = "";
$emailRemetente = DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "email_remetente");
$emailRemetenteNome = DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "nome_remetente");
$emailAssunto = DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "assunto");
//-------------


//e-mails avulso.
//-------------
$idsNewslettersEmailsAvulsoGrupos = "";
$idsNewslettersEmailsAvulso = "";
$resultadoNewsletterEmailsAvulso = "";

$idsNewslettersEmailsAvulsoGrupos = DbFuncoes::GetCampoGenerico10("tb_newsletter_emails_avulso_grupos", 
																"id", 
																array("id_tb_newsletter;" . $idTbNewsletter . ";i", "ativacao;1;i"), 
																"", 
																"", 
																1);
if($idsNewslettersEmailsAvulsoGrupos <> "")
{
	/*
	$idsNewslettersEmailsAvulso = DbFuncoes::GetCampoGenerico10("tb_newsletter_emails_avulso", 
																"email", 
																array("id_tb_newsletter_emails_avulso_grupos;" . $idsNewslettersEmailsAvulsoGrupos . ";ids", "ativacao_mala_direta;1;i"), 
																"", 
																"", 
																1);
	*/
	
	//array("id_tb_newsletter_emails_avulso_grupos;" . $idsNewslettersEmailsAvulsoGrupos . ";ids", "ativacao_mala_direta;1;i"),
	$resultadoNewsletterEmailsAvulso = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_newsletter_emails_avulso", 
																				array("ativacao_mala_direta;1;i", "id_tb_newsletter_emails_avulso_grupos;" . $idsNewslettersEmailsAvulsoGrupos . ";ids"), 
																				"", 
																				"");
}
//-------------

															
//Verificação de erro - debug.
//echo "idsNewslettersEmailsAvulsoGrupos=" . $idsNewslettersEmailsAvulsoGrupos . "<br />";
//echo "resultadoNewslettersEmailsAvulso=";
//var_dump($resultadoNewslettersEmailsAvulso);
//echo "<br />";

echo "emailRemetente=" . $emailRemetente . "<br />";
echo "emailRemetenteNome=" . $emailRemetenteNome . "<br />";
echo "emailAssunto=" . $emailAssunto . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEnviar"); ?>
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
    
    <?php //e-mails avulsos.?>
    <?php
	if (empty($resultadoNewsletterEmailsAvulso))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <div style="position: relative; display: block; overflow: hidden;">
			<?php
            //Loop pelos resultados.
            foreach($resultadoNewsletterEmailsAvulso as $linhaNewsletterEmailsAvulso)
            {
            ?>
            
                <div class="Texto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaNewsletterEmailsAvulso['email']);?>
                </div>
              
			<?php } ?>
        </div>
	<?php } ?>
    
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>