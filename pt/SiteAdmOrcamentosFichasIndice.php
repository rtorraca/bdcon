<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
//$idTbCadastroCliente = $_GET["idTbCadastroCliente"];
//$idCeOrcamentosFichas = $_GET["idCeOrcamentosFichas"];
//$idCeOrcamentos = $idCeOrcamentosFichas;
$idCeOrcamentos = $_GET["idCeOrcamentos"];

$paginaRetorno = "SiteAdmOrcamentosFichasIndice.php";
$paginaRetornoExclusao = "SiteAdmOrcamentosFichasIndice.php";
$variavelRetorno = "idCeOrcamentosFichas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&idCeOrcamentosFichas=" . $idCeOrcamentosFichas . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlOrcamentosFichasSelect = "";
$strSqlOrcamentosFichasSelect .= "SELECT ";
//$strSqlOrcamentosFichasSelect .= "* ";
$strSqlOrcamentosFichasSelect .= "id, ";
$strSqlOrcamentosFichasSelect .= "id_ce_orcamentos, ";
$strSqlOrcamentosFichasSelect .= "data_ficha, ";
$strSqlOrcamentosFichasSelect .= "titulo, ";
$strSqlOrcamentosFichasSelect .= "obs, ";
$strSqlOrcamentosFichasSelect .= "ativacao, ";
$strSqlOrcamentosFichasSelect .= "informacao_complementar1, ";
$strSqlOrcamentosFichasSelect .= "informacao_complementar2, ";
$strSqlOrcamentosFichasSelect .= "informacao_complementar3, ";
$strSqlOrcamentosFichasSelect .= "informacao_complementar4, ";
$strSqlOrcamentosFichasSelect .= "informacao_complementar5 ";
$strSqlOrcamentosFichasSelect .= "FROM ce_orcamentos_fichas ";
$strSqlOrcamentosFichasSelect .= "WHERE id <> 0 ";
$strSqlOrcamentosFichasSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
$strSqlOrcamentosFichasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosFichas'] . " ";

$statementOrcamentosFichasSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosFichasSelect);

if ($statementOrcamentosFichasSelect !== false)
{
	/*
	$statementOrcamentosFichasSelect->execute(array(
		"id_ce_orcamentos" => $idCeOrcamentos
	));
	*/
	/*
	if($idCeOrcamentos <> "")
	{
		$statementOrcamentosFichasSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
	}
	*/
	$statementOrcamentosFichasSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos , PDO::PARAM_STR);
	$statementOrcamentosFichasSelect->execute();
	
}

//$resultadoOrcamentosFichas = $dbSistemaConPDO->query($strSqlOrcamentosFichasSelect);
$resultadoOrcamentosFichas = $statementOrcamentosFichasSelect->fetchAll();


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentPedidos=" . $idParentPedidos . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTitulo"); ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
    
	<?php
    if (empty($resultadoOrcamentosFichas))
    {
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
    <form name="formOrcamentosFichasAcoes" id="formOrcamentosFichasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
        <input name="strTabela" id="strTabela" type="hidden" value="ce_orcamentos_fichas" />
        <input name="idTbCadastroCliente" id="idTbCadastroCliente" type="hidden" value="<?php echo $idTbCadastroCliente; ?>" />
        <input name="idCeOrcamentos" id="idCeOrcamentos" type="hidden" value="<?php echo $idCeOrcamentos; ?>" />

        <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
        <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
        <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
        <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
        <div style="position:relative; display: block; clear: both;">
            <div align="right" style="float: right;">
                <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
            </div>
        </div>
        <table width="100%" class="AdmTabelaDados01">
          <tr class="AdmTbFundoEscuro">
            <td width="150" class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasData"); ?>
                </div>
            </td>
            
            <?php if($GLOBALS['habilitarOrcamentosFichasTitulo'] == 1){ ?>
            <td class="AdmTabelaDados01Celula">
                <div class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTitulo"); ?>
                </div>
            </td>
            <?php } ?>
            
            <td width="100" class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                </div>
            </td>
            
            <td width="30" class="AdmTabelaDados01Celula">
                <div align="center" align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                </div>
            </td>
            
            <td width="30" class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                </div>
            </td>
            
            <td width="30" class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto02">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                </div>
            </td>
          </tr>
          <?php
			$countTabelaFundo = 0;
			
			//Loop pelos resultados.
			foreach($resultadoOrcamentosFichas as $linhaOrcamentosFichas)
			{
          ?>
          <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
            <td class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <?php echo Funcoes::DataLeitura01($linhaOrcamentosFichas['data_ficha'], $GLOBALS['configSiteFormatoData'], "2");?>
                </div>
            </td>
            
            <?php if($GLOBALS['habilitarOrcamentosFichasTitulo'] == 1){ ?>
            <td class="AdmTabelaDados01Celula">
                <div class="AdmTexto01">
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichas['titulo']);?>
                </div>
            </td>
            <?php } ?>
            
            <td class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <a href="SiteAdmOrcamento.php?idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciar"); ?>
                    </a>
                </div>
                
				<?php if($GLOBALS['habilitarOrcamentosProdutosVinculosMultiplos'] == 1){ ?>
                <div align="center" class="AdmTexto01">
                    <a href="SiteAdmOrcamentosRelacaoRegistrosIndice.php?idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?>&tipoCategoria=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                    </a>
                </div>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarOrcamentosFichasHistorico'] == 1){ ?>
                <div align="center" class="AdmTexto01">
                    <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaOrcamentosFichas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                    </a>
                </div>
                <?php } ?>
            </td>
            
            <td class="<?php if($linhaOrcamentosFichas['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentosFichas['id'];?>&statusAtivacao=<?php echo $linhaOrcamentosFichas['ativacao'];?>&strTabela=ce_orcamentos_fichas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        <?php if($linhaOrcamentosFichas['ativacao'] == 0){?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                        <?php } ?>
                        <?php if($linhaOrcamentosFichas['ativacao'] == 1){?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                        <?php } ?>
                    </a>
                </div>
            </td>
            
            <td class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <a href="SiteAdmOrcamentosFichasEditar.php?idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </a>
                </div>
            </td>
            
            <td class="AdmTabelaDados01Celula">
                <div align="center" class="AdmTexto01">
                    <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentosFichas['id'];?>" class="AdmCampoCheckBox01" />
                </div>
            </td>
          </tr>
		  <?php 
              //Linha alternativa de tabela.
              //----------
              //$countTabelaFundo = $countTabelaFundo + 1;
              $countTabelaFundo++;
            
               if($countTabelaFundo == 2)
               {
                   $countTabelaFundo = 0;
               }
              //----------
          } 
          ?>
        </table>
    </form>
    <?php } ?>
    
    
    <script type="text/javascript">
        $(document).ready(function () {
        
            //Validação de formulário (JQuery).
            //**************************************************************************************
            $('#formOrcamentosFichas').validate({ //Inicialização do plug-in.
            
            
                //Estilo da mensagem de erro.
                //----------------------
                errorClass: "TextoErro",
                //----------------------
                
                
                //Validação
                //----------------------
                //rules: {
                    //n_classificacao: {
                        //required: true,
                        ////regex: /-?\d+(\.\d{1,3})?/
                        //number: true
                    //}
                    ////,
                    ////field2: {
                        ////required: true,
                        ////minlength: 5
                    ////}
                //},
                
                
                //Mensagens.
                //----------------------
                //messages: {
                    ////n_classificacao: "Please specify your name"//,
                    //n_classificacao: {
                      ////required: "Campo obrigatório.",
                      //required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
                      ////regex: "Campo numérico."
                      ////number: "Campo numérico."
                      //number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                    //}
                //},		
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
    <form name="formOrcamentosFichas" id="formOrcamentosFichas" action="SiteAdmOrcamentosFichasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTbOrcamentoFichas"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarOrcamentosFichasTitulo'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichas"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="titulo" id="titulo" class="AdmCampoTexto01" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasOBS"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="obs" id="obs" class="AdmCampoTextoMultilinhaConteudo"></textarea>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_ce_orcamentos" type="hidden" id="id_ce_orcamentos" value="<?php echo $idCeOrcamentos; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
        <br/>
    </form>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlOrcamentosFichasSelect);
unset($statementOrcamentosFichasSelect);
unset($resultadoOrcamentosFichas);
unset($linhaOrcamentosFichas);
//----------
?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>