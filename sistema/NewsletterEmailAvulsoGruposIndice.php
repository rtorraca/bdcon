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
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "NewsletterEmailAvulsoGruposIndice.php";
$paginaRetornoExclusao = "NewsletterEmailAvulsoGruposEditar.php";
$variavelRetorno = "idParentEmailsAvulsoGrupos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbNewsletter=" . $idTbNewsletter . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
//$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
//$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlNewsletterEmailsAvulsoGruposSelect = "";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "SELECT ";
//$strSqlNewsletterEmailsAvulsoGruposSelect .= "* ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "id, ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "id_tb_newsletter, ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "data_grupo, ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "grupo_emails, ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "ativacao ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "FROM tb_newsletter_emails_avulso_grupos ";
$strSqlNewsletterEmailsAvulsoGruposSelect .= "WHERE id <> 0 ";

if($idTbNewsletter <> "")
{
	$strSqlNewsletterEmailsAvulsoGruposSelect .= "AND id_tb_newsletter = :id_tb_newsletter ";
}

$strSqlNewsletterEmailsAvulsoGruposSelect .= "ORDER BY " . $GLOBALS['configClassificacaoNewsletterEmailsAvulsoGrupos'] . " ";
//----------


//Parâmetros.
//----------
$statementNewsletterEmailsAvulsoGruposSelect = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoGruposSelect);

if ($statementNewsletterEmailsAvulsoGruposSelect !== false)
{
	/*
	$statementNewsletterEmailsAvulsoGruposSelect->execute(array(
		"id_tb_categorias" => $idParentEmailsAvulsoGrupos
	));
	*/
	if($idTbNewsletter <> "")
	{
		$statementNewsletterEmailsAvulsoGruposSelect->bindParam(':id_tb_newsletter', $idTbNewsletter, PDO::PARAM_STR);
	}
	$statementNewsletterEmailsAvulsoGruposSelect->execute();
}

//$resultadoNewsletterEmailsAvulsoGrupos = $dbSistemaConPDO->query($strSqlNewsletterEmailsAvulsoGruposSelect);
$resultadoNewsletterEmailsAvulsoGrupos = $statementNewsletterEmailsAvulsoGruposSelect->fetchAll();
//----------


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarEmailsAvulsoGruposSistemaPaginacao=" . $habilitarEmailsAvulsoGruposSistemaPaginacao . "<br />";
//echo "strSqlNewsletterEmailsAvulsoGruposSelect=" . $strSqlNewsletterEmailsAvulsoGruposSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoTitulo"); ?> - 
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

    <?php
	if (empty($resultadoNewsletterEmailsAvulsoGrupos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formNewsletterEmailsAvulsoGruposAcoes" id="formNewsletterEmailsAvulsoGruposAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_newsletter_emails_avulso_grupos" />
            <input name="idTbNewsletter" id="idTbNewsletter" type="hidden" value="<?php echo $idTbNewsletter; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDataCriacao"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoGrupoEmails"); ?>
                    </div>
                </td>
				
                <td width="40" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoNEmails"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoNewsletterEmailsAvulsoGrupos as $linhaNewsletterEmailsAvulsoGrupos)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php //echo $linhaNewsletterEmailsAvulsoGrupos['id'];?>
                        <?php echo Funcoes::DataLeitura01($linhaNewsletterEmailsAvulsoGrupos['data_grupo'], $GLOBALS['configSistemaFormatoData'], "1");?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
					<div align="left" class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaNewsletterEmailsAvulsoGrupos['grupo_emails']);?>
					</div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo DbFuncoes::CountRegistrosGenericos("tb_newsletter_emails_avulso", "id_tb_newsletter_emails_avulso_grupos", $linhaNewsletterEmailsAvulsoGrupos['id']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="NewsletterEmailsAvulsoIndice.php?idTbNewsletterEmailsAvulsoGrupos=<?php echo $linhaNewsletterEmailsAvulsoGrupos['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoIncluirEmails"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaNewsletterEmailsAvulsoGrupos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaNewsletterEmailsAvulsoGrupos['id'];?>&statusAtivacao=<?php echo $linhaNewsletterEmailsAvulsoGrupos['ativacao'];?>&strTabela=tb_newsletter_emails_avulso_grupos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaNewsletterEmailsAvulsoGrupos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaNewsletterEmailsAvulsoGrupos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPublicacoes['ativacao'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="NewsletterEmailsAvulsoGruposEditar.php?idTbNewsletterEmailsAvulsoGrupos=<?php echo $linhaNewsletterEmailsAvulsoGrupos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaNewsletterEmailsAvulsoGrupos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    

    <?php if($idTbNewsletter <> ""){ ?>
    <form name="formEmailsAvulsoGrupos" id="formEmailsAvulsoGrupos" action="NewsletterEmailAvulsoGruposIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoTbGrupo"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoGrupoEmails"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="grupo_emails" id="grupo_emails" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarNewsletterEmailsAvulsoArquivo'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUpload01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoLimite03"); ?>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoLimite01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                        <input type="text" name="limite_emails" id="limite_emails" class="CampoNumericoGenerico01" maxlength="15" width="50" value="0" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoLimite02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_newsletter" type="hidden" id="id_tb_newsletter" value="<?php echo $idTbNewsletter; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
	<?php } ?>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlNewsletterEmailsAvulsoGruposSelect);
unset($statementNewsletterEmailsAvulsoGruposSelect);
unset($resultadoNewsletterEmailsAvulsoGrupos);
unset($linhaNewsletterEmailsAvulsoGrupos);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>