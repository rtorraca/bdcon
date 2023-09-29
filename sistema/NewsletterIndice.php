<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idParentNewsletter = $_GET["idParentNewsletter"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$dataNewsletterOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSistemaFormatoData'], "1");


$paginaRetorno = "NewsletterIndice.php";
$paginaRetornoExclusao = "NewsletterEditar.php";
$variavelRetorno = "idParentNewsletter";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentNewsletter=" . $idParentNewsletter . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
//$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
//$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlNewsletterSelect = "";
$strSqlNewsletterSelect .= "SELECT ";
//$strSqlNewsletterSelect .= "* ";
/**/
$strSqlNewsletterSelect .= "id, ";
$strSqlNewsletterSelect .= "id_tb_categorias, ";
$strSqlNewsletterSelect .= "id_tb_cadastro, ";
$strSqlNewsletterSelect .= "n_classificacao, ";
$strSqlNewsletterSelect .= "data_newsletter, ";
$strSqlNewsletterSelect .= "data_envio, ";
$strSqlNewsletterSelect .= "campanha, ";
$strSqlNewsletterSelect .= "nome_remetente, ";
$strSqlNewsletterSelect .= "email_remetente, ";
$strSqlNewsletterSelect .= "assunto, ";
$strSqlNewsletterSelect .= "obs, ";
$strSqlNewsletterSelect .= "cor_interna, ";
$strSqlNewsletterSelect .= "cor_fundo, ";
$strSqlNewsletterSelect .= "cor_borda, ";
$strSqlNewsletterSelect .= "largura, ";
$strSqlNewsletterSelect .= "n_envios, ";
$strSqlNewsletterSelect .= "n_emails ";
$strSqlNewsletterSelect .= "FROM tb_newsletter ";
$strSqlNewsletterSelect .= "WHERE id <> 0 ";

if($idParentNewsletter <> "")
{
	$strSqlNewsletterSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}

$strSqlNewsletterSelect .= "ORDER BY " . $GLOBALS['configClassificacaoNewsletter'] . " ";
//----------


//Parâmetros.
//----------
$statementNewsletterSelect = $dbSistemaConPDO->prepare($strSqlNewsletterSelect);

if ($statementNewsletterSelect !== false)
{
	/*
	$statementNewsletterSelect->execute(array(
		"id_tb_categorias" => $idParentNewsletter
	));
	*/
	if($idParentNewsletter <> "")
	{
		$statementNewsletterSelect->bindParam(':id_tb_categorias', $idParentNewsletter, PDO::PARAM_STR);
	}
	$statementNewsletterSelect->execute();
}

//$resultadoNewsletter = $dbSistemaConPDO->query($strSqlNewsletterSelect);
$resultadoNewsletter = $statementNewsletterSelect->fetchAll();
//----------


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarNewsletterSistemaPaginacao=" . $habilitarNewsletterSistemaPaginacao . "<br />";
//echo "strSqlNewsletterSelect=" . $strSqlNewsletterSelect . "<br />";
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
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletter"); ?> - 
        <a href="CategoriasIndice.php?idParentCategorias=<?php echo $idParentCategoriasRaiz; ?>&idParentCategoriasRaiz=<?php echo $idParentCategoriasRaiz; ?>" class="Links04">
        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemRoot"); ?>
        </a>
        <?php echo DbFuncoes::CategoriasCaminho($idParentNewsletter, $idParentCategoriasRaiz, " - ", "Links04", "backend"); ?>
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
	if (empty($resultadoNewsletter))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formNewsletterAcoes" id="formNewsletterAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_newsletter" />
            <input name="idParentNewsletter" id="idParentNewsletter" type="hidden" value="<?php echo $idParentNewsletter; ?>" />

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
              	<?php if($GLOBALS['habilitarNewsletterNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterCampanha"); ?>
                    </div>
                </td>
				
                <td width="200" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
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
                foreach($resultadoNewsletter as $linhaNewsletter)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarNewsletterNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaNewsletter['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo Funcoes::DataLeitura01($linhaNewsletter['data_newsletter'], $GLOBALS['configSistemaFormatoData'], "1");?>
                    </div>
                </td>

                <td class="TabelaDados01Celula">
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaNewsletter['campanha']);?>
                    </div>
                    <div align="left" class="Texto01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAssunto"); ?>: 
                        </strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaNewsletter['assunto']);?>
                    </div>
                    <div align="left" class="Texto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaNewsletter['obs']);?>
                    </div>
                    <div align="left" class="Texto01">
                    	<a href="NewsletterEnviar.php?idTbNewsletter=<?php echo $linhaNewsletter['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEnviar"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <div>
                        	<a href="ConteudoIndice.php?idParentConteudo=<?php echo $linhaNewsletter['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterMontarConteudo"); ?>
                            </a>
                        </div>
                        
                        <?php if($GLOBALS['habilitarNewsletterEmailsAvulso'] == 1){ ?>
							<?php if($GLOBALS['configNewsletterEmailsAvulso'] == 1){ ?>
                                <div>
                                    <a href="NewsletterEmailAvulsoGruposIndice.php?idTbNewsletter=<?php echo $linhaNewsletter['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="Links01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailAvulsoIncluir"); ?>
                                    </a>
                                </div>
                            <?php } ?>
						<?php } ?>
                        
                        <div>
                        	<a href="NewsletterVisualizar.php?idTbNewsletter=<?php echo $linhaNewsletter['id'];?>&masterPageSelect=LayoutSistemaIFrame.php" target="_blank" class="Links01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterVisualizarNovaJanela"); ?>
                            </a>
                        </div>

                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="NewsletterEditar.php?idTbNewsletter=<?php echo $linhaNewsletter['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaNewsletter['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    

    <?php if($idParentNewsletter <> ""){ ?>
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formNewsletter').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_classificacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					}
				},		
				//----------------------
				
				
				/*
				errorPlacement: function(error, element) {
					if(element.attr("name") == "n_classificacao")
					{
						error.insertAfter(".nomedadiv");
					}
					else if  (element.attr("name") == "phone" )
						error.insertAfter(".some-other-class");
					else
						error.insertAfter(element);
				}
				*/
			});
			//**************************************************************************************

		});	
	</script>
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerGenericoPtCampos = "";
        var strDatapickerGenericoEnCampos = "";
    </script>
    <form name="formNewsletter" id="formNewsletter" action="NewsletterIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterTbNewsletter"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemData"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerGenericoPtCampos = strDatapickerGenericoPtCampos + "#data_newsletter;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerGenericoEnCampos = strDatapickerGenericoEnCampos + "#data_newsletter;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_newsletter" id="data_newsletter" class="CampoData01" maxlength="10" value="<?php echo $dataNewsletterOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarNewsletterSelecaoFiltroAvancado'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterTipoCadastro"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left" class="Texto01">
                        tipo de cadastro
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarNewsletterNClassificacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div>
                    	<input type="text" name="classificacao" id="classificacao" class="CampoNumerico01" maxlength="4" value="0" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterCampanha"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="campanha" id="campanha" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNomeRemetente"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="nome_remetente" id="nome_remetente" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEmailRemetente"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="email_remetente" id="email_remetente" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAssunto"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="assunto" id="assunto" class="CampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemObsInterno"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <textarea name="obs" id="obs" class="CampoTextoMultilinha01"></textarea>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarNewsletterDefinicaoCores'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterCorInterna"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="cor_interna" id="cor_interna" class="CampoTexto01" maxlength="255" value="<?php echo $GLOBALS['configNewsletterCorInternaPadrao'];?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterCorFundo"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="cor_fundo" id="cor_fundo" class="CampoTexto01" maxlength="255" value="<?php echo $GLOBALS['configNewsletterCorFundoPadrao'];?>" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterCorBorda"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="cor_borda" id="cor_borda" class="CampoTexto01" maxlength="255" value="<?php echo $GLOBALS['configNewsletterCorBordaPadrao'];?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarNewsletterLargura'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterLargura"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="largura" id="largura" class="CampoTexto01" maxlength="255" value="<?php echo $GLOBALS['configNewsletterLarguraPadrao'];?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentNewsletter; ?>" />
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
unset($strSqlNewsletterSelect);
unset($statementNewsletterSelect);
unset($resultadoNewsletter);
unset($linhaNewsletter);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>