<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastroCliente = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer()), 2);
$itensTemporarioValorTotal = 0;

$paginaRetorno = "SiteCarrinho.php";
//$paginaRetornoExclusao = "SiteProdutosDetalhes.php";
//$variavelRetorno = "idTbProdutos";
//$idRetorno = $idTbProdutos;
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlItensTemporarioSelect = "";
$strSqlItensTemporarioSelect .= "SELECT ";
//$strSqlItensTemporarioSelect .= "* ";
$strSqlItensTemporarioSelect .= "id, ";
$strSqlItensTemporarioSelect .= "id_tb_cadastro_cliente, ";
$strSqlItensTemporarioSelect .= "id_tb_cadastro_usuario, ";
$strSqlItensTemporarioSelect .= "id_item, ";
$strSqlItensTemporarioSelect .= "data_selecao, ";
$strSqlItensTemporarioSelect .= "tabela, ";
$strSqlItensTemporarioSelect .= "quantidade, ";
$strSqlItensTemporarioSelect .= "valor_unitario, ";
$strSqlItensTemporarioSelect .= "id_tb_itens_valores, ";
$strSqlItensTemporarioSelect .= "id_tb_itens_valores_titulo, ";
$strSqlItensTemporarioSelect .= "id_tb_itens_data, ";
$strSqlItensTemporarioSelect .= "ids_opcionais, ";
$strSqlItensTemporarioSelect .= "ids_opcionais_descricao, ";
$strSqlItensTemporarioSelect .= "obs, ";

$strSqlItensTemporarioSelect .= "informacao_complementar1, ";
$strSqlItensTemporarioSelect .= "informacao_complementar2, ";
$strSqlItensTemporarioSelect .= "informacao_complementar3, ";
$strSqlItensTemporarioSelect .= "informacao_complementar4, ";
$strSqlItensTemporarioSelect .= "informacao_complementar5, ";

$strSqlItensTemporarioSelect .= "ativacao ";

$strSqlItensTemporarioSelect .= "FROM ce_itens_temporario ";
$strSqlItensTemporarioSelect .= "WHERE id <> 0 ";
if($idTbCadastroCliente <> "")
{
	$strSqlItensTemporarioSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
}

//$strSqlItensTemporarioSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosItens'] . " ";
//if($GLOBALS['habilitarPedidosItensClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) <> "")
//{
	//$strSqlItensTemporarioSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) . " ";
	
//}else{
	$strSqlItensTemporarioSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutosCarrinhoDb'] . " ";
//}
//echo "strSqlItensTemporarioSelect=" . $strSqlItensTemporarioSelect . "<br>";
//----------


//Componentes e parâmetros.
//----------
$statementItensTemporarioSelect = $dbSistemaConPDO->prepare($strSqlItensTemporarioSelect);

if ($statementItensTemporarioSelect !== false)
{
	if($idTbCadastroCliente <> "")
	{
		$statementItensTemporarioSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
	}
	$statementItensTemporarioSelect->execute();
	
	/*
	$statementItensTemporarioSelect->execute(array(
		"id_parent" => $idParentPedidosItens
	));
	*/
}

//$resultadoItensTemporario = $dbSistemaConPDO->query($strSqlItensTemporarioSelect);
$resultadoItensTemporario = $statementItensTemporarioSelect->fetchAll();
//----------


//Verificação de erro - debug.
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
//echo "CookieValorLer()=" . CookiesFuncoes::CookieValorLer() . "<br>";
//$dbSistemaConPDO = null;
//exit();
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinho"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinho"); ?>
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
    
    
    <?php //Listagem de itens.?>
    <?php //**************************************************************************************?>
    <div style="position: relative; display: block;">
        <?php
        if (empty($resultadoItensTemporario))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td width="1" class="AdmTbFundoEscuro AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTbFundoEscuro AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>
                    </div>
                </td>
                
                <td class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItemNome"); ?>
                    </div>
                </td>
                
                <td width="50" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="CarrinhoTextoHeader">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItemQuantidade"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="CarrinhoTextoHeader">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItemValorUnitario"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="CarrinhoTextoHeader">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItemValorTotal"); ?>
                        </strong>
                    </div>
                </td>
                
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoItensTemporario as $linhaItensTemporario)
                {
					
				$ceItensTemporarioImagem = "";
				$ceItensTemporarioImagem = DbFuncoes::GetCampoGenerico01($linhaItensTemporario['id_item'], "tb_produtos", "imagem");
				
				$ceItensTemporarioDescricao = "";
				$ceItensTemporarioDescricao = Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($linhaItensTemporario['id_item'], "tb_produtos", "produto"));
				
				$ceItensTemporarioDescricaoCodItem = "";
				$ceItensTemporarioDescricaoCodItem = DbFuncoes::GetCampoGenerico01($linhaItensTemporario['id_item'], "tb_produtos", "cod_produto");
				
				$ceItensTemporarioValor = "";
				$ceItensTemporarioValor = DbFuncoes::GetCampoGenerico01($linhaItensTemporario['id_item'], "tb_produtos", "valor");
              ?>
              <tr class="AdmTbFundoClaro">
              	<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td style="display: none;">
                    <div align="center" class="CarrinhoConteudo01">
                    	<?php //Imagem - Produtos. ?>
                    	<?php //---------- ?>
							<?php
                            ?>
                            <?php //if(!empty($ceItensTemporarioImagem)){ ?>
                            <?php if($ceItensTemporarioImagem <> ""){ ?>
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensTemporarioImagem;?>" alt="<?php echo $ceItensTemporarioDescricao;?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/g<?php echo $ceItensTemporarioImagem;?>" rel="lightbox" title="<?php echo $ceItensTemporarioDescricao;?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensTemporarioImagem;?>" alt="<?php echo $ceItensTemporarioDescricao;?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                    	<?php //---------- ?>
                    </div>
                </td>
                <?php } ?>

                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="CarrinhoConteudo01">
                        <?php //echo $linhaItensTemporario['cod_item'];?>
                        <?php //echo DbFuncoes::GetCampoGenerico01($linhaItensTemporario['id_item'], "tb_produtos", "cod_produto");?>
                        <?php echo $ceItensTemporarioDescricaoCodItem;?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="left" class="CarrinhoConteudo01">
                    	<?php //Imagem.?>
						<?php if($ceItensTemporarioImagem <> ""){ ?>
                            <div class="CarrinhoImagemIndice">
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensTemporarioImagem;?>" alt="<?php echo $ceItensTemporarioDescricao;?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/g<?php echo $ceItensTemporarioImagem;?>" rel="lightbox" title="<?php echo $ceItensTemporarioDescricao;?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensTemporarioImagem;?>" alt="<?php echo $ceItensTemporarioDescricao;?>" />
                                    </a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                        
                        <div>
                            <strong>
                            	<a href="SiteProdutosDetalhes.php?idTbProdutos=<?php echo $linhaItensTemporario['id_item'];?>" class="CarrinhoLinks01">
                                	<?php echo $ceItensTemporarioDescricao;?>
                                </a>
                            </strong>
                        </div>
                        
                        <div>
                            <strong>
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>
                            </strong>
                            <?php echo $ceItensTemporarioDescricaoCodItem;?>
                        </div>
                        
                        <form name="formCarrinhoAtualizarRemover<?php echo $linhaItensTemporario['id'];?>" id="formCarrinhoAtualizarRemover<?php echo $linhaItensTemporario['id'];?>" action="SiteCarrinhoAtualizarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                            <div>
                            	<?php //Ajax.?>
                                <a href="#" class="CarrinhoLinks01" style="display: none; cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItemExcluir"); ?>
                                </a>
                                
                                <a onclick="document.getElementById('formCarrinhoAtualizarRemover<?php echo $linhaItensTemporario['id'];?>').submit();" class="CarrinhoLinks01" style="cursor: pointer;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItemExcluir"); ?>
                                </a>
                            </div>
                            
                            <input name="idCeItensTemporario" type="hidden" id="idCeItensTemporario" value="<?php echo $linhaItensTemporario['id'];?>" />
                            <input name="btoCarrinhoExcluir" type="hidden" id="btoCarrinhoExcluir" value="1" />
                            
                            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                            
                            <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
                            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                        </form>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="CarrinhoConteudo01">
                        <form name="formCarrinhoAtualizarQuantidade<?php echo $linhaItensTemporario['id'];?>" id="formCarrinhoAtualizarQuantidade<?php echo $linhaItensTemporario['id'];?>" action="SiteCarrinhoAtualizarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                            <?php 
                            //echo $linhaItensTemporario['quantidade'];
                            //OnTextChanged="CarrinhoAtualizar"
                            ?>
                            
                            <table  border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                    <td rowspan="2">
                                        <input type="text" name="quantidade" id="quantidade" oninput="document.getElementById('formCarrinhoAtualizarQuantidade<?php echo $linhaItensTemporario['id'];?>').submit();" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $linhaItensTemporario['quantidade'];?>" />
                                        
                                        <!--
                                        <select id="quantidade" name="quantidade" class="AdmCampoDropDownMenu01" onchange="document.getElementById('formCarrinhoAtualizarQuantidade<?php echo $linhaItensTemporario['id'];?>').submit();">
                                            <?php 
											$countQuantidade = 0;
											$countQuantidadeMax = 100;
											
                                            for($countQuantidade = 0; $countQuantidade <= $countQuantidadeMax; $countQuantidade++)
                                            {
                                            ?>
                                                <option value="<?php echo $countQuantidade;?>"<?php if($countQuantidade == $linhaItensTemporario['quantidade']){?> selected="selected"<?php }?>><?php echo $countQuantidade;?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                        -->

										<?php //echo $linhaItensTemporario['quantidade'];?>
                                    </td>
                                    <td>
                                        <div align="center">
                                        	<?php //Ajax.?>
                                            <a id="btoCarrinhoAdicionar" onclick="divShow('updtProgressCarrinho');" style="display: none; cursor: pointer;">
                                                <img src="img/btoCarrinhoSetaAdicionar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAdicionar"); ?>" />
                                            </a>
                                            
                                            <input type="image" name="btoCarrinhoAdicionar" value="Submit" src="img/btoCarrinhoSetaAdicionar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAdicionar"); ?>" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div align="center">
                                        	<?php //Ajax.?>
                                            <a id="btoCarrinhoSubtrair" onclick="divShow('updtProgressCarrinho');" style="display: none; cursor: pointer;">
                                                <img src="img/btoCarrinhoSetaSubtrair.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSubtrair"); ?>" />
                                            </a>
                                            
                                            <input type="image" name="btoCarrinhoSubtrair" value="Submit" src="img/btoCarrinhoSetaSubtrair.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSubtrair"); ?>" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            
                            <input name="idCeItensTemporario" type="hidden" id="idCeItensTemporario" value="<?php echo $linhaItensTemporario['id'];?>" />
                            
                            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                            
                            <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
                            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                        </form>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="CarrinhoConteudo01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php //echo Funcoes::MascaraValorLer($linhaItensTemporario['valor_unitario'], $GLOBALS['configSistemaMoeda']);?>
                        
                        <?php if($GLOBALS['habilitarProdutosValor'] == 1){?>
                        	<?php //echo Funcoes::MascaraValorLer(DbFuncoes::GetCampoGenerico01($linhaItensTemporario['id_item'], "tb_produtos", "valor"), $GLOBALS['configSistemaMoeda']);?>
                        	<?php echo Funcoes::MascaraValorLer($ceItensTemporarioValor, $GLOBALS['configSistemaMoeda']);?>
                        <?php } ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="CarrinhoConteudo01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php //echo Funcoes::MascaraValorLer($linhaItensTemporario['valor_total'], $GLOBALS['configSistemaMoeda']);?>
                        <?php echo Funcoes::MascaraValorLer(($linhaItensTemporario['quantidade'] * $ceItensTemporarioValor), $GLOBALS['configSistemaMoeda']);?>
						
						<?php 
                        //Contabilizado.
                        //----------------------
						$itensTemporarioValorTotal = $itensTemporarioValorTotal + ($linhaItensTemporario['quantidade'] * $ceItensTemporarioValor);
                        //----------------------
						?>
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
            
            
            <?php //Subtotal.?>
            <table width="100%" class="AdmTabelaDados01">
                <tr class="">
                    <td class="">
                        <div align="center" class="CarrinhoConteudo01">

                        </div>
                    </td>
                    
                    <td width="100" class="AdmTbFundoClaro AdmTabelaDados01Celula">
                        <div align="right" class="CarrinhoConteudo01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItensSubtotal"); ?>:
                            </strong>
                        </div>
                    </td>
                    
                    <td width="100" class="AdmTbFundoClaro AdmTabelaDados01Celula">
                        <div align="right" class="CarrinhoConteudo01">
                            <strong>
                            	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?> 
                                <?php echo Funcoes::MascaraValorLer($itensTemporarioValorTotal, $GLOBALS['configSistemaMoeda']);?>
                                <?php //echo Funcoes::MascaraValorLer(Carrinho::CarrinhoItensTotal($idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "valor", "1"), $GLOBALS['configSistemaMoeda']);?>
                                <?php //echo "peso total = " . Carrinho::CarrinhoItensTotal($idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", "1");?>
                            </strong>
                        </div>
                    </td>
                </tr>
            </table>
		<?php } ?>
    </div>
    <?php //**************************************************************************************?>
    
    
    <?php //Verificação de login.?>
    <?php //**************************************************************************************?>
    <?php if(CookiesFuncoes::CookieLogin_Verificar() == false){?>
		<?php //Cálculo de frete.?>
        <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){?>
        <script type="text/javascript">
            $(document).ready(function () {
                //Validação de formulário (JQuery).
                //**************************************************************************************
                $('#formCalculoFrete').validate({ //Inicialização do plug-in.
                
                
                    //Estilo da mensagem de erro.
                    //----------------------
                    errorClass: "AdmErro",
                    //----------------------
                    
                    
                    //Validação
                    //----------------------
                    rules: {
                        /*
                        n_classificacao: {
                            required: true,
                            //regex: /-?\d+(\.\d{1,3})?/
                            number: true
                        },
                        */
                        cep_destino: {
                            required: true,
                            number: true
                        },
                        cod_sedex: {
                            required: true
                        }
                    },
                    
                    
                    //Mensagens.
                    //----------------------
                    messages: {
                        cep_destino: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
                          number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
                        },
                        cod_sedex: {
                          required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao05"); ?>"
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
        <form name="formCalculoFrete" id="formCalculoFrete" action="SiteCarrinhoCalculoFrete.php" method="get" class="FormularioDados01">
            <div align="center" class="CarrinhoConteudo01" style="position: relative; display: block; overflow: hidden; margin-top: 10px;">
                <div id="divCarrinhoFreteMensagemErro01" class="AdmErro" align="center" style="position: relative; display: none; overflow: hidden;">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteMensagemErro01"); ?>
                </div>
    
                <div align="left">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao01"); ?>
                    </strong>
                    <br />
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao02"); ?>
                </div>
                <br />
                <div align="left">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteCalculo"); ?>: 
                    </strong>
                </div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr valign="top">
                    <td>
                        <table width="100%" border="0" cellspacing="1" cellpadding="4">
                            <tr class="AdmTbFundoClaro">
                                <td>
                                    <div align="left">
                                        <div style="height: 100%; margin: 0px 4px 0px 0px; display: inline-block; vertical-align: middle;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao03"); ?>:
                                        </div>
                                        <div style="height: 100%; margin: 0px 4px 0px 0px; display: inline-block; vertical-align: middle;">
                                            <input type="text" id="cep_destino" name="cep_destino" class="AdmCampoTexto01" width="100" maxlength="8" />
                                            
                                            <input type="hidden" id="itensTemporarioValorTotal" name="itensTemporarioValorTotal" value="<?php echo Funcoes::MascaraValorLer($itensTemporarioValorTotal, $GLOBALS['configSistemaMoeda']);?>" />
                                            <input type="hidden" id="itensTemporarioPesoTotal" name="itensTemporarioPesoTotal" value="<?php echo Funcoes::ValorConverterPeso(Carrinho::CarrinhoItensTotal(Crypto::DecryptValue(CookiesFuncoes::CookieValorLer("")), "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", ""), 1); ?>" />
    
                                            <?php //JQuery - Ajax - CPF Duplicado.?>
                                            <?php //----------------------?>
                                            <?php if($GLOBALS['configCarrinhoFreteCorreiosMetodo'] == 1){ ?>
                                                <script type="text/javascript">
                                                    $("#cep_destino").keyup(function() {
                                                        //Variáveis.
                                                        var cepDestinoCampo = $(this);
                                                        var cepDestino = cepDestinoCampo.val().replace(/\D/g,'');
                                                        
                                                        var itensTemporarioValorTotal = $("#itensTemporarioValorTotal").val();
                                                        var itensTemporarioPesoTotal = $("#itensTemporarioPesoTotal").val();
                                                        
                                                        var divProgressBar = "updtProgressCarrinho";
                                                        //var btnSubmit = "btnCadastroIncluir";
                                                        var lblAlerta = "divCarrinhoFreteMensagemErro01";
                                                        
                                                        
                                                        //Condição para executar somente depois de todos os caractéres do CPF preenchidos.
                                                        if(cepDestino.length == 8)
                                                        {
                                                            //Acionamento da poleta.
                                                            divShow(divProgressBar);
                                                            
                                                            
                                                            //Ajax - comando.
                                                            //http://tinton.com.br.solidcp.temp-address.com/api/ApiCEP.php
                                                            //contentType: 'application/json',
                                                            //http://api.zippopotam.us/us/90210
                                                            //html jsonp json
                                                            //success: function(result, success) 
                                                            //error: function(result, success) 
                                                            //cache: false,
                                                            //async: true,
                                                            //data: "cepConsulta=" + "02068030",
                                                            /**/
    
                                                            //OBS: itensTemporarioPesoTotal - talvez tenha que arredondar para cima.
                                                            $.ajax({
                                                                url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiCarrinhoFrete.php",
                                                                async: true,
                                                                dataType: "html",
                                                                type: "GET",
                                                                data: "cepOrigem=<?php echo Funcoes::SomenteNum($GLOBALS['configCEPOrigem']);?>" + 
                                                                "&cepDestino=" + cepDestino + 
                                                                "&nVlPeso=" + itensTemporarioPesoTotal + 
                                                                "&nVlValorDeclarado=" + mascaraValorGravar(itensTemporarioValorTotal) + 
                                                                "&nCdEmpresa=<?php echo $GLOBALS['configCarrinhoFreteCorreios_nCdEmpresa'];?>" + 
                                                                "&nVlPeso=<?php echo $GLOBALS['configCarrinhoFreteCorreiosMetodo_sDsSenha'];?>" + 
                                                                "&nCdFormato=" + "" + 
                                                                "&nVlComprimento=" + "" + 
                                                                "&nVlAltura=" + "" + 
                                                                "&nVlLargura=" + "" + 
                                                                "&nVlDiametro=" + "" + 
                                                                "&sCdMaoPropria=n",
                                                                success: function(retornoDadosURL, success) 
                                                                {
                                                                    //Ocultação da poleta.
                                                                    divHide(divProgressBar);
                                                                    divHide(lblAlerta);
                                                                    
                                                                    
                                                                    //Conversão de dados em json.
                                                                    var jsonRetornoDadosURL = jQuery.parseJSON(retornoDadosURL);
                                                                    
                                                                    
                                                                    //Definição de valores.
                                                                    var fretePACCodigo = jsonRetornoDadosURL.fretePACCodigo;
                                                                    var fretePACValor = jsonRetornoDadosURL.fretePACValor;
                                                                    var fretePACValorMaoPropria = jsonRetornoDadosURL.fretePACValorMaoPropria;
                                                                    var fretePACValorAvisoRecebimento = jsonRetornoDadosURL.fretePACValorAvisoRecebimento;
                                                                    var fretePACPrazoEntrega = jsonRetornoDadosURL.fretePACPrazoEntrega;
                                                                    var fretePACEntregaDomiciliar = jsonRetornoDadosURL.fretePACEntregaDomiciliar;
                                                                    var fretePACEntregaSabado = jsonRetornoDadosURL.fretePACEntregaSabado;
                                                                    
                                                                    var freteSEDEXCodigo = jsonRetornoDadosURL.freteSEDEXCodigo;
                                                                    var freteSEDEXValor = jsonRetornoDadosURL.freteSEDEXValor;
                                                                    var freteSEDEXValorMaoPropria = jsonRetornoDadosURL.freteSEDEXValorMaoPropria;
                                                                    var freteSEDEXValorAvisoRecebimento = jsonRetornoDadosURL.freteSEDEXValorAvisoRecebimento;
                                                                    var freteSEDEXPrazoEntrega = jsonRetornoDadosURL.freteSEDEXPrazoEntrega;
                                                                    var freteSEDEXEntregaDomiciliar = jsonRetornoDadosURL.freteSEDEXEntregaDomiciliar;
                                                                    var freteSEDEXEntregaSabado = jsonRetornoDadosURL.freteSEDEXEntregaSabado;
                                                                    
                                                                    var freteESEDEXCodigo = jsonRetornoDadosURL.freteESEDEXCodigo;
                                                                    var freteESEDEXValor = jsonRetornoDadosURL.freteESEDEXValor;
                                                                    var freteESEDEXValorMaoPropria = jsonRetornoDadosURL.freteESEDEXValorMaoPropria;
                                                                    var freteESEDEXValorAvisoRecebimento = jsonRetornoDadosURL.freteESEDEXValorAvisoRecebimento;
                                                                    var freteESEDEXPrazoEntrega = jsonRetornoDadosURL.freteESEDEXPrazoEntrega;
                                                                    var freteESEDEXEntregaDomiciliar = jsonRetornoDadosURL.freteESEDEXEntregaDomiciliar;
                                                                    var freteESEDEXEntregaSabado = jsonRetornoDadosURL.freteESEDEXEntregaSabado;
                                                                    
                                                                    var freteSEDEXACobrarCodigo = jsonRetornoDadosURL.freteSEDEXACobrarCodigo;
                                                                    var freteSEDEXACobrarValor = jsonRetornoDadosURL.freteSEDEXACobrarValor;
                                                                    var freteSEDEXACobrarValorMaoPropria = jsonRetornoDadosURL.freteSEDEXACobrarValorMaoPropria;
                                                                    var freteSEDEXACobrarValorAvisoRecebimento = jsonRetornoDadosURL.freteSEDEXACobrarValorAvisoRecebimento;
                                                                    var freteSEDEXACobrarPrazoEntrega = jsonRetornoDadosURL.freteSEDEXACobrarPrazoEntrega;
                                                                    var freteSEDEXACobrarEntregaDomiciliar = jsonRetornoDadosURL.freteSEDEXACobrarEntregaDomiciliar;
                                                                    var freteSEDEXACobrarEntregaSabado = jsonRetornoDadosURL.freteSEDEXACobrarEntregaSabado;
                                                                    
                                                                    var freteSEDEX10Codigo = jsonRetornoDadosURL.freteSEDEX10Codigo;
                                                                    var freteSEDEX10Valor = jsonRetornoDadosURL.freteSEDEX10Valor;
                                                                    var freteSEDEX10ValorMaoPropria = jsonRetornoDadosURL.freteSEDEX10ValorMaoPropria;
                                                                    var freteSEDEX10ValorAvisoRecebimento = jsonRetornoDadosURL.freteSEDEX10ValorAvisoRecebimento;
                                                                    var freteSEDEX10PrazoEntrega = jsonRetornoDadosURL.freteSEDEX10PrazoEntrega;
                                                                    var freteSEDEX10EntregaDomiciliar = jsonRetornoDadosURL.freteSEDEX10EntregaDomiciliar;
                                                                    var freteSEDEX10EntregaSabado = jsonRetornoDadosURL.freteSEDEX10EntregaSabado;
                                                                    
                                                                    var freteSEDEXHojeCodigo = jsonRetornoDadosURL.freteSEDEXHojeCodigo;
                                                                    var freteSEDEXHojeValor = jsonRetornoDadosURL.freteSEDEXHojeValor;
                                                                    var freteSEDEXHojeValorMaoPropria = jsonRetornoDadosURL.freteSEDEXHojeValorMaoPropria;
                                                                    var freteSEDEXHojeValorAvisoRecebimento = jsonRetornoDadosURL.freteSEDEXHojeValorAvisoRecebimento;
                                                                    var freteSEDEXHojePrazoEntrega = jsonRetornoDadosURL.freteSEDEXHojePrazoEntrega;
                                                                    var freteSEDEXHojeEntregaDomiciliar = jsonRetornoDadosURL.freteSEDEXHojeEntregaDomiciliar;
                                                                    var freteSEDEXHojeEntregaSabado = jsonRetornoDadosURL.freteSEDEXHojeEntregaSabado;
                                                                    
                                                                    
                                                                    //Soma dos valores e preenchimento nos elementos HTML.
                                                                    /**/
                                                                    if(fretePACCodigo != "" && fretePACValor != "" && fretePACValor != "0,00")
                                                                    {
                                                                        divMensagem01('lblFretePAC', "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> " + fretePACValor);
                                                                        divMensagem01('lblFretePACTotal', mascaraValorLer(parseFloat(mascaraValorGravar(fretePACValor)) + parseFloat(mascaraValorGravar(itensTemporarioValorTotal)), "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>"));
                                                                    }else{
                                                                        divMensagem01('lblFretePAC', '');
                                                                    }
                                                                    
                                                                    if(freteSEDEXCodigo != "" && freteSEDEXValor != "" && freteSEDEXValor != "0,00")
                                                                    {
                                                                        divMensagem01('lblFreteSEDEX', "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> " + freteSEDEXValor);
                                                                        //divMensagem01('lblFreteSEDEXTotal', freteSEDEXValor + itensTemporarioValorTotal);
                                                                        divMensagem01('lblFreteSEDEXTotal', mascaraValorLer(parseFloat(mascaraValorGravar(freteSEDEXValor)) + parseFloat(mascaraValorGravar(itensTemporarioValorTotal)), "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>"));
                                                                    }else{
                                                                        divMensagem01('lblFreteSEDEX', '');
                                                                    }
                                                                    
                                                                    if(freteESEDEXCodigo != "" && freteESEDEXValor != "" && freteESEDEXValor != "0,00")
                                                                    {
                                                                        divMensagem01('lblFreteESEDEX', "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> " + freteESEDEXValor);
                                                                        //divMensagem01('lblFreteESEDEXTotal', freteESEDEXValor + itensTemporarioValorTotal);
                                                                        divMensagem01('lblFreteESEDEXTotal', mascaraValorLer(parseFloat(mascaraValorGravar(freteESEDEXValor)) + parseFloat(mascaraValorGravar(itensTemporarioValorTotal)), "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>"));
                                                                    }else{
                                                                        divMensagem01('lblFreteESEDEX', '');
                                                                    }
                                                                    
                                                                    if(freteSEDEXACobrarCodigo != "" && freteSEDEXACobrarValor != "" && freteSEDEXACobrarValor != "0,00")
                                                                    {
                                                                        divMensagem01('lblFreteSEDEXACobrar', "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> " + freteSEDEXACobrarValor);
                                                                        //divMensagem01('lblFreteSEDEXACobrarTotal', freteSEDEXACobrarValor + itensTemporarioValorTotal);
                                                                        divMensagem01('lblFreteSEDEXACobrarTotal', mascaraValorLer(parseFloat(mascaraValorGravar(freteSEDEXACobrarValor)) + parseFloat(mascaraValorGravar(itensTemporarioValorTotal)), "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>"));
                                                                    }else{
                                                                        divMensagem01('lblFreteSEDEXACobrar', '');
                                                                    }
                                                                    
                                                                    if(freteSEDEX10Codigo != "" && freteSEDEX10Valor != "" && freteSEDEX10Valor != "0,00")
                                                                    {
                                                                        divMensagem01('lblFreteSEDEX10', "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> " + freteSEDEX10Valor);
                                                                        //divMensagem01('lblFreteSEDEX10Total', freteSEDEX10Valor + itensTemporarioValorTotal);
                                                                        divMensagem01('lblFreteSEDEX10Total', mascaraValorLer(parseFloat(mascaraValorGravar(freteSEDEX10Valor)) + parseFloat(mascaraValorGravar(itensTemporarioValorTotal)), "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>"));
                                                                    }else{
                                                                        divMensagem01('lblFreteSEDEX10', '');
                                                                    }
                                                                    
                                                                    if(freteSEDEXHojeCodigo != "" && freteSEDEXHojeValor != "" && freteSEDEXHojeValor != "0,00")
                                                                    {
                                                                        divMensagem01('lblFreteSEDEXHoje', "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> " + freteSEDEXHojeValor);
                                                                        //divMensagem01('lblFreteSEDEXHojeTotal', freteSEDEXHojeValor + itensTemporarioValorTotal);
                                                                        divMensagem01('lblFreteSEDEXHojeTotal', mascaraValorLer(parseFloat(mascaraValorGravar(freteSEDEXHojeValor)) + parseFloat(mascaraValorGravar(itensTemporarioValorTotal)), "<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>"));
                                                                    }else{
                                                                        divMensagem01('lblFreteSEDEXHoje', '');
                                                                    }
                                                                    
                                                                    
                                                                    //Exibição de elementos padrão.
                                                                    $("#cod_sedex option:contains(<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC"); ?>)").attr('selected', true); //Seleção PAC.
                                                                    divShow("lblFretePACTotal");
    
                                                                },
                                                                error: function(retornoDadosURL, success) 
                                                                {
                                                                    //$(".zip-error").show(); // Ruh row
                                                                    //elementoMensagem01('testeAlvo01', "erro");
                                                                    divShow(lblAlerta);
                                                                }	
                                                            });	
                                                                
                                                                                        
                                                            //Degug.
                                                            //elementoMensagem01('testeAlvo01', cepNumero);
                                                        }
                                                        
                                                        
                                                        //Ocultar mensagens de erro.
                                                        if(cepDestino.length == 0)
                                                        {
                                                            //Mostrar aviso.
                                                            divHide(lblAlerta);
                                                            
                                                            //Habilitar botão.
                                                            //document.getElementById(btnSubmit).disabled = false;
                                                        }
                                                        
                                                        
                                                        //Ocultar cálculo de frete em caso de alguma mudança.
                                                        if(cepDestino.length < 8)
                                                        {
                                                            //Ocultação de todos os valores.
                                                            divMensagem01('lblFretePAC', '');
                                                            divMensagem01('lblFreteSEDEX', '');
                                                            divMensagem01('lblFreteESEDEX', '');
                                                            divMensagem01('lblFreteSEDEXACobrar', '');
                                                            divMensagem01('lblFreteSEDEX10', '');
                                                            divMensagem01('lblFreteSEDEXHoje', '');
                                                            
                                                            divHide('lblFretePACTotal');
                                                            divHide('lblFreteSEDEXTotal');
                                                            divHide('lblFreteESEDEXTotal');
                                                            divHide('lblFreteSEDEXACobrarTotal');
                                                            divHide('lblFreteSEDEX10Total');
                                                            divHide('lblFreteSEDEXHojeTotal');
                                                            
                                                            //Seleção de opção padrão.
                                                            $("#cod_sedex").val("");
                                                        }
                                                        
                                                    });						
                                                </script>
                                            <?php } ?>
                                            <?php //----------------------?>
                            
                                        </div>
                                        <div style="height: 100%; margin: 0px 4px 0px 0px; display: inline-block; vertical-align: middle;">
                                            <a href="#" style="display: none;">
                                                <img src="img/btoCalculoFrete.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteCalculo"); ?>" />
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="AdmTbFundoClaro">
                                <td>
                                    <div align="left">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao04"); ?>
                                        <a class="CarrinhoLinks01" href="http://www.buscacep.correios.com.br">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao04Link"); ?>
                                        </a>
                                    </div>
                                </td>
                            </tr>
    
                            <?php if($GLOBALS['habilitarCarrinhoFreteInternacional'] == 1){ ?>
                            <tr class="AdmTbFundoClaro">
                                <td>
                                    <div align="left">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao06"); ?>
                                        </strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao07"); ?>
                                        <br />
                                        <a class="CarrinhoLinks01" href="http://www.correios.com.br/internacional/cfm/precos">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao07Link"); ?>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                    
                            <?php if($GLOBALS['habilitarCarrinhoFretePrazoEntregaVisualizar'] == 1){ ?>
                            <tr class="AdmTbFundoClaro">
                                <td>
                                    <div align="left">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao08"); ?>
                                        </strong>
                                        <br />
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
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </td>
                    <td width="1">
                          <?php if($GLOBALS['habilitarCarrinhoFreteVisualizar'] == 1){ ?>
                              <table width="300" border="0" cellspacing="1" cellpadding="4">
    
                            <!--asp:PlaceHolder ID="plhdFretePAC" runat="server"-->
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFretePAC"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div id="lblFretePAC" align="right">
                                            
                                        </div>
                                    </td>
                                </tr>
    
                            <!--asp:PlaceHolder ID="plhdFreteSEDEX" runat="server"-->
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteSEDEX"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div id="lblFreteSEDEX" align="right">
                                            
                                        </div>
                                    </td>
                                </tr>
    
                            <!--asp:PlaceHolder ID="plhdFreteSEDEX10" runat="server"-->
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteSEDEX10"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div id="lblFreteSEDEX10" align="right">
                                            
                                        </div>
                                    </td>
                                </tr>
    
                            <!--asp:PlaceHolder ID="plhdFreteSEDEXHoje" runat="server"-->
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteSEDEXHoje"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div id="lblFreteSEDEXHoje" align="right">
                                            
                                        </div>
                                    </td>
                                </tr>
    
                            <!--asp:PlaceHolder ID="plhdFreteSEDEXACobrar" runat="server"-->
                                <?php if($GLOBALS['habilitarCarrinhoFreteCorreiosEntregasACobrar'] == 1){ ?>
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteSEDEXACobrar"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div id="lblFreteSEDEXACobrar" align="right">
                                            
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
    
                            <!--asp:PlaceHolder ID="plhdFreteESEDEX" runat="server"-->
                                <?php if($GLOBALS['configCarrinhoFreteCorreios_nCdEmpresa'] <> ""){ ?>
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteESEDEX"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div id="lblFreteESEDEX" align="right">
                                            
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarCarrinhoFretePesoVisualizar'] == 1){ ?>
                                <tr class="AdmTbFundoClaro">
                                    <td>
                                        <div align="right">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoItensPeso"); ?>:
                                        </div>
                                    </td>
                                    <td>
                                        <div align="right">
                                            <?php echo Funcoes::ValorConverterPeso(Carrinho::CarrinhoItensTotal(Crypto::DecryptValue(CookiesFuncoes::CookieValorLer("")), "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", ""), 1); ?>
                                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso2'], "IncludeConfig"); ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
    
                                <tr class="AdmTbFundoClaro">
                                    <td width="200">
                                        <div align="right">
                                            <strong>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoPedidoTotal"); ?>:
                                            </strong>
                                        </div>
                                    </td>
                                    <td width="100">
                                        <div align="right">
                                            <strong>
                                                <div id="lblFretePACTotal" style="display: block;">
                                                    
                                                </div>
                                                <div id="lblFreteSEDEXTotal" style="display: none;">
                                                    
                                                </div>
                                                <div id="lblFreteESEDEXTotal" style="display: none;">
                                                    
                                                </div>
                                                <div id="lblFreteSEDEXACobrarTotal" style="display: none;">
                                                    
                                                </div>
                                                <div id="lblFreteSEDEX10Total" style="display: none;">
                                                    
                                                </div>
                                                <div id="lblFreteSEDEXHojeTotal" style="display: none;">
                                                    
                                                </div>
                                            </strong>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>
    
                        <br />
                        <div align="center" class="CarrinhoConteudo01">
                            <?php if($GLOBALS['habilitarCarrinhoFreteVisualizar'] == 1){ ?>
                                <div style="margin: 10px 0px 10px 0px; display: table;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteInstrucao05"); ?>:
                                </div>
                                <div style="margin: 10px 0px 10px 0px; display: table;">
                                    <!--input type="radio" value="xxx" onclick="divShow('lblFreteSEDEXTotal');" / teste - funcionando-->
                                    <select id="cod_sedex" name="cod_sedex" class="AdmCampoDropDownMenu01">
                                        <option value="" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcao0"); ?></option>
                                        <?php if($GLOBALS['configCarrinhoFreteCorreiosMetodo_sDsSenha'] == ""){ ?>
                                            <option value="41106"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC"); ?></option>
                                            <option value="40010"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX"); ?></option>
                                            <!--option value="40045"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX"); ?></option--><!-- desativado pelos correios -->
                                            <?php if($GLOBALS['habilitarCarrinhoFreteCorreiosEntregasACobrar'] == 1){ ?>
                                            <option value="40045"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXACobrar"); ?></option>
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <option value="<?php echo $GLOBALS['configCarrinhoFreteCorreiosContratoPAC']; ?>"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC"); ?></option>
                                            <option value="<?php echo $GLOBALS['configCarrinhoFreteCorreiosContratoSedex']; ?>"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX"); ?></option>
                                            <!--option value="<?php echo $GLOBALS['configCarrinhoFreteCorreiosContratoESedex']; ?>"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX"); ?></option--><!-- desativado pelos correios -->
                                            <?php if($GLOBALS['habilitarCarrinhoFreteCorreiosEntregasACobrar'] == 1){ ?>
                                            <option value="40126"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXACobrar"); ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                        <option value="40215"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX10"); ?></option>
                                        <option value="40290"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXHoje"); ?></option>
                                        
                                        <?php if($GLOBALS['habilitarCarrinhoFreteRetirar'] == 1){ ?>
                                            <option value="retirada"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoRetirar"); ?></option>
                                        <?php } ?>
                                        
                                        <?php if($GLOBALS['habilitarCarrinhoFreteTransportadora'] == 1){ ?>
                                            <option value="transportadora"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoTransportadora"); ?></option>
                                        <?php } ?>
                                        
                                        <?php if($GLOBALS['habilitarCarrinhoFreteInternacional'] == 1){ ?>
                                            <option value="internacional"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoInternacional"); ?></option>
                                    	<?php } ?>
                                    </select>
                                    <script type="text/javascript">
                                    //Exibir informações de acordo com opção selecionada.
                                    //ref: https://stackoverflow.com/questions/8978328/get-the-value-of-a-dropdown-in-jquery
                                    $(function () {
                                        $("#cod_sedex").live("change", function () {
                                            //Variáveis.
                                            //var codSEDEXSelectedValue = $('#cod_sedex option:selected').val();
                                            var codSEDEXSelectedValue = $('#cod_sedex option:selected').text();
                                            
                                            
                                            //Ocultação de todos os valores.
                                            divHide('lblFretePACTotal');
                                            divHide('lblFreteSEDEXTotal');
                                            divHide('lblFreteESEDEXTotal');
                                            divHide('lblFreteSEDEXACobrarTotal');
                                            divHide('lblFreteSEDEX10Total');
                                            divHide('lblFreteSEDEXHojeTotal');
                                            
                                            
                                            //Exibição dos valores de acordo com a opção selecionada.
                                            if(codSEDEXSelectedValue == "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoPAC"); ?>")
                                            {
                                                divShow('lblFretePACTotal');
                                            }
                                            if(codSEDEXSelectedValue == "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX"); ?>")
                                            {
                                                divShow('lblFreteSEDEXTotal');
                                            }
                                            if(codSEDEXSelectedValue == "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoESEDEX"); ?>")
                                            {
                                                divShow('lblFreteESEDEXTotal');
                                            }
                                            if(codSEDEXSelectedValue == "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXACobrar"); ?>")
                                            {
                                                divShow('lblFreteSEDEXACobrarTotal');
                                            }
                                            if(codSEDEXSelectedValue == "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEX10"); ?>")
                                            {
                                                divShow('lblFreteSEDEX10Total');
                                            }
                                            if(codSEDEXSelectedValue == "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteOpcaoSEDEXHoje"); ?>")
                                            {
                                                divShow('lblFreteSEDEXHojeTotal');
                                            }
                                            
                                            
                                            //Debug.
                                            //alert("codSEDEXSelectedValue=" + codSEDEXSelectedValue);
    
                                            // you want the element to lose focus immediately
                                            // this is key to get this working.
                                            //$('#cod_sedex').blur();
                                        });
                                    });
                                    </script>
                                </div>
                                <div class="AdmErro">
    
                                </div>
                            <?php } ?>
                            <div style="margin: 10px 0px 10px 0px; display: table;">
                                <input type="image" name="prosseguir" value="Submit" src="img/btoProsseguir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoProsseguir"); ?>" />
                            </div>
                        </div>
                    </td>
                  </tr>
                </table>
            </div>
        </form>
        <?php }?>
        
		<?php //Sem cálculo de frete e direcionamento para o cadastro.?>
        <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 0){?>
        	<div align="center" class="CarrinhoConteudo01" style="position: relative; display: block; overflow: hidden;">
            	<a href="SiteCadastro.php?valorPedido=<?php echo $itensTemporarioValorTotal;?>&idTbCadastro=&idTipoCadastro=<?php echo $GLOBALS['configIdCadastroCliente'];?>&idTbCadastroTemporario=<?php echo urlencode(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario"));?>" target="_top">
                    <img src="img/btoProsseguir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoProsseguir"); ?>" />
                </a>
            </div>
        <?php }?>
    <?php }?>
    <?php //**************************************************************************************?>
    
    
    <?php //Cliente Logado.?>
    <?php //**************************************************************************************?>
    <?php if(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroCliente") <> ""){?>
        <div align="center" class="CarrinhoConteudo01">
        	
            <form name="formCarrinhoLogado" id="formCarrinhoLogado" action="SiteCarrinhoPedidosExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01" target="_top">
                <div>
                    <input type="image" name="logado" value="Submit" src="img/btoLogadoProsseguir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoProsseguir"); ?>" />
                </div>
            </form>
        </div>
    <?php }?>
    <?php //**************************************************************************************?>
    
    
    <?php //Verificação de login.?>
    <?php //**************************************************************************************?>
    <?php if(CookiesFuncoes::CookieLogin_Verificar() == false){?>
        <div class="CarrinhoConteudo01">
            <br />
            <div align="center">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoLoginInstrucao01"); ?>
                </strong>
            </div>
            <br />
            
			<?php //Login.?>
            <?php //----------------------?>
            <?php 
            //Definição de variáveis do include.
            $includeLogin_tipoLogin = "1";
            $includeLogin_origemLogin = "2";
            ?>
            
            <?php include "IncludeLogin.php";?>
            <?php //----------------------?>
        </div>
    <?php }?>
    <?php //**************************************************************************************?>


    <?php //Progress bar.?>
    <div id="updtProgressCarrinho" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlItensTemporarioSelect);
unset($statementItensTemporarioSelect);
unset($resultadoItensTemporario);
unset($linhaItensTemporario);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>