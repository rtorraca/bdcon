<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbNewsletterEmailsAvulsoGrupos = $_GET["idTbNewsletterEmailsAvulsoGrupos"];
$idTbNewsletter = DbFuncoes::GetCampoGenerico01($idTbNewsletterEmailsAvulsoGrupos, "tb_newsletter_emails_avulso_grupos", "id_tb_newsletter");

$paginaRetorno = "NewsletterEmailAvulsoGruposIndice.php";
$paginaRetornoExclusao = "NewsletterEmailsAvulsoGruposEditar.php";
$variavelRetorno = "idTbNewsletterEmailsAvulsoGrupos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbNewsletter=" . $idTbNewsletter . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
//$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
//$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect = "";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "SELECT ";
//$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "* ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "id, ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "id_tb_newsletter, ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "data_grupo, ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "grupo_emails, ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "ativacao ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "FROM  tb_newsletter_emails_avulso_grupos ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "AND id = :id ";
//$strSqlNewsletterEmailsAvulsoGruposDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementNewsletterEmailsAvulsoGruposDetalhesSelect = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoGruposDetalhesSelect);

if ($statementNewsletterEmailsAvulsoGruposDetalhesSelect !== false)
{
	$statementNewsletterEmailsAvulsoGruposDetalhesSelect->execute(array(
		"id" => $idTbNewsletterEmailsAvulsoGrupos
	));
}

//$resultadoNewsletterEmailsAvulsoGruposDetalhes = $dbSistemaConPDO->query($strSqlNewsletterEmailsAvulsoGruposDetalhesSelect);
$resultadoNewsletterEmailsAvulsoGruposDetalhes = $statementNewsletterEmailsAvulsoGruposDetalhesSelect->fetchAll();
//----------


if (empty($resultadoNewsletterEmailsAvulsoGruposDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoNewsletterEmailsAvulsoGruposDetalhes as $linhaNewsletterEmailsAvulsoGruposDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbNewsletterEmailsAvulsoGruposId = $linhaNewsletterEmailsAvulsoGruposDetalhes['id'];
		$tbNewsletterEmailsAvulsoGruposIdTbNewsletter = $linhaNewsletterEmailsAvulsoGruposDetalhes['id_tb_newsletter'];
		$tbNewsletterEmailsAvulsoGruposDataGrupo = $linhaNewsletterEmailsAvulsoGruposDetalhes['data_grupo'];

		$tbNewsletterEmailsAvulsoGruposGrupoEmails = Funcoes::ConteudoMascaraLeitura($linhaNewsletterEmailsAvulsoGruposDetalhes['grupo_emails']);
		$tbNewsletterEmailsAvulsoGruposAtivacao = $linhaNewsletterEmailsAvulsoGruposDetalhes['ativacao'];

		
		//Verificação de erro.
		//echo "tbNewsletterEmailsAvulsoGruposId=" . $tbNewsletterEmailsAvulsoGruposId . "<br>";
		//echo "tbNewsletterEmailsAvulsoGruposGrupoEmails=" . $tbNewsletterEmailsAvulsoGruposGrupoEmails . "<br>";
	}
}


//Verificação de erro.
//echo "idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
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
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersTituloEditar"); ?> - <?php echo "titulo"; ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idTbNewsletter, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
	
    <form name="formNewsletterEmailsAvulsoGruposEditar" id="formNewsletterEmailsAvulsoGruposEditar" action="NewsletterEmailsAvulsoGruposEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoTbGrupoEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['configNewsletterEmailsAvulso'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoTbGrupoVinculo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">

                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoGrupoEmails"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="grupo_emails" id="grupo_emails" class="CampoTexto01" maxlength="255" value="<?php echo $tbNewsletterEmailsAvulsoGruposGrupoEmails; ?>" />
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbNewsletterEmailsAvulsoGruposAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbNewsletterEmailsAvulsoGruposAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbNewsletterEmailsAvulsoGrupos" type="hidden" id="idTbNewsletterEmailsAvulsoGrupos" value="<?php echo $idTbNewsletterEmailsAvulsoGrupos; ?>" />
                <input name="id_tb_newsletter" type="hidden" id="id_tb_newsletter" value="<?php echo $idTbNewsletter; ?>" /><!--inclur condição para trocar de grupo-->
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentBanners=<?php echo $idParentBanners; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
        
    </form>
    <br />
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlNewsletterEmailsAvulsoGruposDetalhesSelect);
unset($statementNewsletterEmailsAvulsoGruposDetalhesSelect);
unset($resultadoNewsletterEmailsAvulsoGruposDetalhes);
unset($linhaNewsletterEmailsAvulsoGruposDetalhes);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>