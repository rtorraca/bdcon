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

$paginaRetorno = "NewsletterVisualizar.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

$conteudoHTML = "";


//Query de pesquisa.
//----------
$strSqlNewsletterDetalhesSelect = "";
$strSqlNewsletterDetalhesSelect .= "SELECT ";
//$strSqlNewsletterDetalhesSelect .= "* ";
/**/
$strSqlNewsletterDetalhesSelect .= "id, ";
$strSqlNewsletterDetalhesSelect .= "id_tb_categorias, ";
$strSqlNewsletterDetalhesSelect .= "id_tb_cadastro, ";
$strSqlNewsletterDetalhesSelect .= "n_classificacao, ";
$strSqlNewsletterDetalhesSelect .= "data_newsletter, ";
$strSqlNewsletterDetalhesSelect .= "data_envio, ";
$strSqlNewsletterDetalhesSelect .= "campanha, ";
$strSqlNewsletterDetalhesSelect .= "nome_remetente, ";
$strSqlNewsletterDetalhesSelect .= "email_remetente, ";
$strSqlNewsletterDetalhesSelect .= "assunto, ";
$strSqlNewsletterDetalhesSelect .= "obs, ";
$strSqlNewsletterDetalhesSelect .= "cor_interna, ";
$strSqlNewsletterDetalhesSelect .= "cor_fundo, ";
$strSqlNewsletterDetalhesSelect .= "cor_borda, ";
$strSqlNewsletterDetalhesSelect .= "largura, ";
$strSqlNewsletterDetalhesSelect .= "n_envios, ";
$strSqlNewsletterDetalhesSelect .= "n_emails ";
$strSqlNewsletterDetalhesSelect .= "FROM  tb_newsletter ";
$strSqlNewsletterDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlNewsletterDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlNewsletterDetalhesSelect .= "AND id = :id ";
//$strSqlNewsletterDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//echo "strSqlNewsletterDetalhesSelect=" . $strSqlNewsletterDetalhesSelect . "<br>";
//----------


//Parâmetros.
//----------
$statementNewsletterDetalhesSelect = $dbSistemaConPDO->prepare($strSqlNewsletterDetalhesSelect);

if ($statementNewsletterDetalhesSelect !== false)
{
	$statementNewsletterDetalhesSelect->execute(array(
		"id" => $idTbNewsletter
	));
}

//$resultadoNewsletterDetalhes = $dbSistemaConPDO->query($strSqlNewsletterDetalhesSelect);
$resultadoNewsletterDetalhes = $statementNewsletterDetalhesSelect->fetchAll();
//----------


if (empty($resultadoNewsletterDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoNewsletterDetalhes as $linhaNewsletterDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbNewsletterId = $linhaNewsletterDetalhes['id'];
		
		$tbNewsletterIdTbCategorias = $linhaNewsletterDetalhes['id_tb_categorias'];
		$tbNewsletterIdTbCadastro = $linhaNewsletterDetalhes['id_tb_cadastro'];
		$tbNewsletterNClassificacao = $linhaNewsletterDetalhes['n_classificacao'];
		
		if($linhaNewsletterDetalhes['data_newsletter'] == NULL)
		{
			$tbNewsletterDataNewsletter = "";
		}else{
			$tbNewsletterDataNewsletter = $linhaNewsletterDetalhes['data_newsletter'];
		}
		$tbNewsletterDataNewsletter_print = "";
		if($tbNewsletterDataNewsletter <> "")
		{
			$tbNewsletterDataNewsletter_print = Funcoes::DataLeitura01($tbNewsletterDataNewsletter, $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		if($linhaNewsletterDetalhes['data_envio'] == NULL)
		{
			$tbNewsletterDataEnvio = "";
		}else{
			$tbNewsletterDataEnvio = $linhaNewsletterDetalhes['data_envio'];
		}
		$tbNewsletterDataEnvio_print = "";
		if($tbNewsletterDataEnvio <> "")
		{
			$tbNewsletterDataEnvio_print = Funcoes::DataLeitura01($tbNewsletterDataEnvio, $GLOBALS['configSistemaFormatoData'], "1");
		}

		$tbNewsletterCampanha = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['campanha']);
		$tbNewsletterNomeRemetente = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['nome_remetente']);
		$tbNewsletterEmailRemetente = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['email_remetente']);
		$tbNewsletterAssunto = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['assunto']);
		$tbNewsletterOBS = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['obs']);
		
		$tbNewsletterCorInterna = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['cor_interna']);
		$tbNewsletterCorFundo = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['cor_fundo']);
		$tbNewsletterCorBorda = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['cor_borda']);
		$tbNewsletterLargura = Funcoes::ConteudoMascaraLeitura($linhaNewsletterDetalhes['largura']);
		
		$tbNewsletterNEnvios = $linhaNewsletterDetalhes['n_envios'];
		$tbNewsletterNEmails = $linhaNewsletterDetalhes['n_emails'];
		/**/

		//Verificação de erro.
		//echo "tbNewsletterId=" . $tbNewsletterId . "<br>";
		//echo "tbNewsletterDataNewsletter_print=" . $tbNewsletterDataNewsletter_print . "<br>";
		//echo "tbNewsletterProcesso=" . $tbNewsletterProcesso . "<br>";
		//echo "tbNewsletterIC60=" . $tbNewsletterIC60 . "<br>";
	}
}


//Montagem do HTML
//Montagem da primeira parte da mensagem.
//----------------------
//$conteudoHTML .= "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'><html><head><meta http-equiv='content-type' content='text/html; charset=iso-8859-1'><title>";
$conteudoHTML .= "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html><head><meta http-equiv='content-type' content='text/html; charset=iso-8859-1'><title>";
//$conteudoHTML .= DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "assunto");
$conteudoHTML .= $tbNewsletterAssunto;
$conteudoHTML .= "</title>";
//Criar rotina para imprimir os dados da folha de estilos.
//$conteudoHTML .= "<link href='";
//$conteudoHTML .= $GLOBALS['configUrl'] . "/" . $GLOBALS['visualizacaoAtivaSistema'];
//$conteudoHTML .= "/EstilosSite.css' rel='stylesheet' type='text/css'>";
$conteudoHTML .= "</head><body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0'><table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='";
//$conteudoHTML .= DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "cor_fundo");
$conteudoHTML .= $tbNewsletterCorFundo;
$conteudoHTML .= "'><tr><td align='center' valign='top'><table width='";
//$conteudoHTML .= DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "largura");
$conteudoHTML .= $tbNewsletterLargura;
$conteudoHTML .= "' border='";
//if(DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "cor_borda") == "")
if($tbNewsletterCorBorda == "")
{
	$conteudoHTML .= "0";
}else{
	$conteudoHTML .= "1";
}
$conteudoHTML .= "' cellpadding='0' cellspacing='0' bordercolor='";
//$conteudoHTML .= DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "cor_borda");
$conteudoHTML .= $tbNewsletterCorBorda;
$conteudoHTML .= "' bgcolor='";
//$conteudoHTML .= DbFuncoes::GetCampoGenerico01($idTbNewsletter, "tb_newsletter", "cor_interna");
$conteudoHTML .= $tbNewsletterCorInterna;
$conteudoHTML .= "'><tr><td valign='top'><table width='100%' border='0' cellpadding='0' cellspacing='0'>";

//Conteúdo da newsletter.
$conteudoHTML .= Email::ConteudoMensagem($idTbNewsletter);

$conteudoHTML .= "</table></td></tr></table>";
//----------------------

$conteudoHTML .= "<p class='ConteudoLinks'><a href='";
$conteudoHTML .= $GLOBALS['configUrl'] . "/" . $GLOBALS['visualizacaoAtivaSistema'];
$conteudoHTML .= "/SiteNewsletterDesativarExe.php?idTbRegistro=";
//$conteudoHTML .= $arrEmailDestinatarioId[i].ToString();
$conteudoHTML .= "0";
$conteudoHTML .= "' target='_blank' style='" . $GLOBALS['configNewsletterCSSConteudoLinks'] . "'>";
$conteudoHTML .= XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterLinkDesativar");
$conteudoHTML .= "</a></p><br />";

$conteudoHTML .= "</td></tr></table></body></html>";
//----------------------
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterVisualizar"); ?>
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterVisualizar"); ?>
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


	<?php echo $conteudoHTML;?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlNewsletterDetalhesSelect);
unset($statementNewsletterDetalhesSelect);
unset($resultadoNewsletterDetalhes);
unset($linhaNewsletterDetalhes);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>