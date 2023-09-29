<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParent = $_GET["idParent"];
if($idParent == "")
{
	$idParent = 0;
}

$paginaRetorno = "NewsletterIPsRotativoIndice.php";
$paginaRetornoExclusao = "NewsletterIPsRotativoEditar.php";
$variavelRetorno = "";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
//$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
//$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlNewsletterIPsRotativoSelect = "";
$strSqlNewsletterIPsRotativoSelect .= "SELECT ";
//$strSqlNewsletterIPsRotativoSelect .= "* ";
/**/
$strSqlNewsletterIPsRotativoSelect .= "id, ";
$strSqlNewsletterIPsRotativoSelect .= "id_parent, ";
$strSqlNewsletterIPsRotativoSelect .= "data_inclusao, ";
$strSqlNewsletterIPsRotativoSelect .= "titulo, ";
$strSqlNewsletterIPsRotativoSelect .= "ip_rotativo, ";
$strSqlNewsletterIPsRotativoSelect .= "servidor_smtp, ";
$strSqlNewsletterIPsRotativoSelect .= "usuario, ";
$strSqlNewsletterIPsRotativoSelect .= "senha, ";
$strSqlNewsletterIPsRotativoSelect .= "porta_smtp, ";
$strSqlNewsletterIPsRotativoSelect .= "encryption, ";
$strSqlNewsletterIPsRotativoSelect .= "habilitar_autenticacao, ";
$strSqlNewsletterIPsRotativoSelect .= "ativacao, ";
$strSqlNewsletterIPsRotativoSelect .= "ativacao_selecao, ";

$strSqlNewsletterIPsRotativoSelect .= "informacao_configuracao1, ";
$strSqlNewsletterIPsRotativoSelect .= "informacao_configuracao2, ";
$strSqlNewsletterIPsRotativoSelect .= "informacao_configuracao3, ";
$strSqlNewsletterIPsRotativoSelect .= "informacao_configuracao4, ";
$strSqlNewsletterIPsRotativoSelect .= "informacao_configuracao5, ";

$strSqlNewsletterIPsRotativoSelect .= "obs ";
$strSqlNewsletterIPsRotativoSelect .= "FROM tb_newsletter_ips ";
$strSqlNewsletterIPsRotativoSelect .= "WHERE id <> 0 ";
$strSqlNewsletterIPsRotativoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoNewsletterIPsRotativo'] . " ";
//----------


//Parâmetros.
//----------
$statementNewsletterIPsRotativoSelect = $dbSistemaConPDO->prepare($strSqlNewsletterIPsRotativoSelect);

if ($statementNewsletterIPsRotativoSelect !== false)
{
	/*
	$statementNewsletterIPsRotativoSelect->execute(array(
		"id_tb_categorias" => $idParentNewsletterIPsRotativo
	));
	*/
	//if($idParentNewsletterIPsRotativo <> "")
	//{
		$statementNewsletterIPsRotativoSelect->bindParam(':id_tb_categorias', $idParentNewsletterIPsRotativo, PDO::PARAM_STR);
	//}
	$statementNewsletterIPsRotativoSelect->execute();
}

//$resultadoNewsletterIPsRotativo = $dbSistemaConPDO->query($strSqlNewsletterIPsRotativoSelect);
$resultadoNewsletterIPsRotativo = $statementNewsletterIPsRotativoSelect->fetchAll();
//----------


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarNewsletterIPsRotativoSistemaPaginacao=" . $habilitarNewsletterIPsRotativoSistemaPaginacao . "<br />";
//echo "strSqlNewsletterIPsRotativoSelect=" . $strSqlNewsletterIPsRotativoSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoTitulo"); ?>
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
	if (empty($resultadoNewsletterIPsRotativo))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formNewsletterIPsRotativoAcoes" id="formNewsletterIPsRotativoAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_newsletter_ips" />
            <input name="idParent" id="idParent" type="hidden" value="<?php echo $idParent; ?>" />

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
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoIP"); ?>
                    </div>
                </td>
				
                <td width="150" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoAtivacaoSelecao"); ?>
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
                foreach($resultadoNewsletterIPsRotativo as $linhaNewsletterIPsRotativo)
                {
              ?>
              <tr class="TbFundoClaro">
                <td class="TabelaDados01Celula">
                    <div align="left" class="Texto01">
                        <?php echo $linhaNewsletterIPsRotativo['ip_rotativo'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="Texto01">
                    
                    </div>
                </td>
                
                <td class="<?php if($linhaNewsletterIPsRotativo['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaNewsletterIPsRotativo['id'];?>&statusAtivacao=<?php echo $linhaNewsletterIPsRotativo['ativacao'];?>&strTabela=tb_newsletter_ips&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaNewsletterIPsRotativo['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaNewsletterIPsRotativo['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaNewsletterEmailsAvulso['ativacao'];?>
                    </div>
                </td>
                <td class="<?php if($linhaNewsletterIPsRotativo['ativacao_selecao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaNewsletterIPsRotativo['id'];?>&statusAtivacao=<?php echo $linhaNewsletterIPsRotativo['ativacao_selecao'];?>&strTabela=tb_newsletter_ips&strCampo=ativacao_selecao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaNewsletterIPsRotativo['ativacao_selecao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaNewsletterIPsRotativo['ativacao_selecao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaNewsletterEmailsAvulso['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="NewsletterIPsRotativoEditar.php?idTbNewsletterIPsRotativo=<?php echo $linhaNewsletterIPsRotativo['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaNewsletterIPsRotativo['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    

    <form name="formNewsletterIPsRotativo" id="formNewsletterIPsRotativo" action="NewsletterIPsRotativoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoTbIPs"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoIP"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="ip_rotativo" id="ip_rotativo" class="CampoTexto01" maxlength="255" />
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
                
                <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $idParent; ?>" />
                <input type="hidden" id="ativacao_selecao" name="ativacao_selecao" value="0" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
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
unset($strSqlNewsletterIPsRotativoSelect);
unset($statementNewsletterIPsRotativoSelect);
unset($resultadoNewsletterIPsRotativo);
unset($linhaNewsletterIPsRotativo);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>