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
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "NewsletterEmailsAvulsoIndice.php";
$paginaRetornoExclusao = "NewsletterEmailsAvulsoEditar.php";
$variavelRetorno = "idTbNewsletterEmailsAvulsoGrupos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlNewsletterEmailsAvulsoSelect = "";
$strSqlNewsletterEmailsAvulsoSelect .= "SELECT ";
//$strSqlNewsletterEmailsAvulsoSelect .= "* ";
$strSqlNewsletterEmailsAvulsoSelect .= "id, ";
$strSqlNewsletterEmailsAvulsoSelect .= "id_tb_newsletter_emails_avulso_grupos, ";
$strSqlNewsletterEmailsAvulsoSelect .= "email, ";
$strSqlNewsletterEmailsAvulsoSelect .= "ativacao_mala_direta ";
$strSqlNewsletterEmailsAvulsoSelect .= "FROM tb_newsletter_emails_avulso ";
$strSqlNewsletterEmailsAvulsoSelect .= "WHERE id <> 0 ";
$strSqlNewsletterEmailsAvulsoSelect .= "AND id_tb_newsletter_emails_avulso_grupos = :id_tb_newsletter_emails_avulso_grupos ";
$strSqlNewsletterEmailsAvulsoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoNewsletterEmailsAvulso'] . " ";

$statementNewsletterEmailsAvulsoSelect = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoSelect);

if ($statementNewsletterEmailsAvulsoSelect !== false)
{
	/**/
	$statementNewsletterEmailsAvulsoSelect->execute(array(
		"id_tb_newsletter_emails_avulso_grupos" => $idTbNewsletterEmailsAvulsoGrupos
	));
}

//$resultadoNewsletterEmailsAvulso = $dbSistemaConPDO->query($strSqlNewsletterEmailsAvulsoSelect);
$resultadoNewsletterEmailsAvulso = $statementNewsletterEmailsAvulsoSelect->fetchAll();


//Verificação de erro - debug.
//echo "idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos . "<br />";
//echo "strSqlNewsletterEmailsAvulsoSelect=" . $strSqlNewsletterEmailsAvulsoSelect . "<br />";
//echo "idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoIncluirEmails"); ?>
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
    
    <?php //Jquery para esconder div, sem prejudicar interatividade com área de texto.?>
    <script type="text/javascript">
        $(window).on('load', function () {
            //divHide('divNewsletterEmailsAvulsoFormulario');
        });
    </script>
    <div id="divNewsletterEmailsAvulsoFormulario" style="position: relative; display: block; overflow: hidden; clear: both;">
    <form name="formEmailsAvulso" id="formEmailsAvulso" action="NewsletterEmailsAvulsoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoTbIncluirEmails"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoIncluirEmails"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <textarea name="emails" id="emails" rows="30" class="CampoTextoMultilinhaConteudo"></textarea>
                    </div>
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoEmailsInstrucoes01"); ?>
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
                        <select name="ativacao_mala_direta" id="ativacao_mala_direta" class="CampoDropDownMenu01">
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
                
                <input name="id_tb_newsletter_emails_avulso_grupos" type="hidden" id="id_tb_newsletter_emails_avulso_grupos" value="<?php echo $idTbNewsletterEmailsAvulsoGrupos; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    </div>
	
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

        <form name="formNewsletterEmailsAvulsoAcoes" id="formNewsletterEmailsAvulsoAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_newsletter_emails_avulso" />
            <input name="idTbNewsletterEmailsAvulsoGrupos" id="idTbNewsletterEmailsAvulsoGrupos" type="hidden" value="<?php echo $idTbNewsletterEmailsAvulsoGrupos; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div style="position: relative; display: none; float: left;">
                    <img src="img/btoNovo.png" onclick="divShowHide('divNewsletterEmailsAvulsoFormulario')" style="cursor: pointer;" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoNovo"); ?>" />
                </div>
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoEmails"); ?>
                    </div>
                </td>
				
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoNewsletterEmailsAvulso as $linhaNewsletterEmailsAvulso)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaNewsletterEmailsAvulso['email']);?>
                    </div>
                </td>
				
                <td class="<?php if($linhaNewsletterEmailsAvulso['ativacao_mala_direta'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaNewsletterEmailsAvulso['id'];?>&statusAtivacao=<?php echo $linhaNewsletterEmailsAvulso['ativacao_mala_direta'];?>&strTabela=tb_newsletter_emails_avulso&strCampo=ativacao_mala_direta<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaNewsletterEmailsAvulso['ativacao_mala_direta'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaNewsletterEmailsAvulso['ativacao_mala_direta'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaNewsletterEmailsAvulso['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="NewsletterEmailsAvulsoEditar.php?idTbNewsletterEmailsAvulso=<?php echo $linhaNewsletterEmailsAvulso['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaNewsletterEmailsAvulso['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlNewsletterEmailsAvulsoSelect);
unset($statementNewsletterEmailsAvulsoSelect);
unset($resultadoNewsletterEmailsAvulso);
unset($linhaNewsletterEmailsAvulso);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>