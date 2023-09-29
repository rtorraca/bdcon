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
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idCePedidos = $_GET["idCePedidos"];
$idsCePedidos = $_GET["idsCePedidos"];

$countValorTotal = 0;

$paginaRetorno = "SiteAdmPedidosIndice.php";
//$criterioClassificacao = "";
$criterioClassificacao = $_GET["criterioClassificacao"];;
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;

$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPedidosItensSelect = "";
$strSqlPedidosItensSelect .= "SELECT ";
//$strSqlPedidosItensSelect .= "* ";
$strSqlPedidosItensSelect .= "id, ";
$strSqlPedidosItensSelect .= "id_ce_pedidos, ";
$strSqlPedidosItensSelect .= "id_tb_cadastro_cliente, ";
$strSqlPedidosItensSelect .= "id_tb_cadastro_usuario, ";
$strSqlPedidosItensSelect .= "id_item, ";
$strSqlPedidosItensSelect .= "cod_item, ";
$strSqlPedidosItensSelect .= "descricao, ";
$strSqlPedidosItensSelect .= "tabela, ";
$strSqlPedidosItensSelect .= "quantidade, ";

$strSqlPedidosItensSelect .= "valor_unitario, ";
$strSqlPedidosItensSelect .= "valor_desconto, ";
$strSqlPedidosItensSelect .= "valor_acrescimo, ";
$strSqlPedidosItensSelect .= "id_tb_itens_valores, ";
$strSqlPedidosItensSelect .= "id_tb_itens_valores_titulo, ";
$strSqlPedidosItensSelect .= "id_tb_itens_data, ";
$strSqlPedidosItensSelect .= "valor_total, ";

$strSqlPedidosItensSelect .= "ids_opcionais, ";
$strSqlPedidosItensSelect .= "ids_opcionais_descricao, ";
$strSqlPedidosItensSelect .= "obs, ";

$strSqlPedidosItensSelect .= "informacao_complementar1, ";
$strSqlPedidosItensSelect .= "informacao_complementar2, ";
$strSqlPedidosItensSelect .= "informacao_complementar3, ";
$strSqlPedidosItensSelect .= "informacao_complementar4, ";
$strSqlPedidosItensSelect .= "informacao_complementar5, ";

$strSqlPedidosItensSelect .= "ativacao, ";
$strSqlPedidosItensSelect .= "data_pedido, ";
$strSqlPedidosItensSelect .= "data_pagamento, ";
$strSqlPedidosItensSelect .= "data_entrega, ";
$strSqlPedidosItensSelect .= "data_validade, ";
$strSqlPedidosItensSelect .= "id_tb_produtos_complemento_status ";

$strSqlPedidosItensSelect .= "FROM ce_itens ";
$strSqlPedidosItensSelect .= "WHERE id <> 0 ";
if($idCePedidos <> "")
{
	$strSqlPedidosItensSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
}
if($idsCePedidos <> "")
{
	$strSqlPedidosItensSelect .= "AND id_ce_pedidos IN (" . Funcoes::ConteudoMascaraGravacao01($idsCePedidos) . ") ";
}
//$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosItens'] . " ";
//if($GLOBALS['habilitarPedidosItensClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) <> "")
//{
	//$strSqlPedidosItensSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) . " ";
	
//}else{
	$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoItens'] . " ";
//}
//----------


//Parâmetros.
//----------
$statementPedidosItensSelect = $dbSistemaConPDO->prepare($strSqlPedidosItensSelect);

if ($statementPedidosItensSelect !== false)
{
	if($idCePedidos <> "")
	{
		//$statementPedidosItensSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
		$statementPedidosItensSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
	}
	$statementPedidosItensSelect->execute();
	
	/*
	$statementPedidosItensSelect->execute(array(
		"id_parent" => $idParentPedidosItens
	));
	*/
}

//$resultadoPedidosItens = $dbSistemaConPDO->query($strSqlPedidosItensSelect);
$resultadoPedidosItens = $statementPedidosItensSelect->fetchAll();
//----------


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosHistorico"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosListagemItens"); ?>
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
    if (empty($resultadoPedidosItens))
    {
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmTextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>
        <div style="position: relative; display: block; overflow: hidden;">
        <form name="formPedidosItensAcoes" id="formPedidosItensAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_pedidos_itens" />
            <!--input name="idTbCadastroCliente" id="idTbCadastroCliente" type="hidden" value="<?php echo $idTbCadastroCliente; ?>" /-->
            <input name="idCePedidos" id="idCePedidos" type="hidden" value="<?php echo $idCePedidos; ?>" />
            <input name="idsCePedidos" id="idsCePedidos" type="hidden" value="<?php echo $idsCePedidos; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">

            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td width="1" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensDescricao"); ?>
                    </div>
                </td>
                
                <td width="40" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>
                    </div>
                </td>
                
				<?php if($GLOBALS['habilitarPedidosItensValorDesconto'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorDesconto"); ?>
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarPedidosItensValorAcrescimo'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorAcrescimo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorTotal"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
			  	$countTabelaFundo = 0;
			  
                //Loop pelos resultados.
                foreach($resultadoPedidosItens as $linhaPedidosItens)
                {
					$countValorTotal = $countValorTotal + $linhaPedidosItens['valor_total'];
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //Imagem - Produtos. ?>
                        <?php //---------- ?>
                            <?php
                            $ceItensImagem = "";
                            $ceItensImagem = DbFuncoes::GetCampoGenerico01($linhaPedidosItens['id_item'], "tb_produtos", "imagem");
                            ?>
                            <?php //if(!empty($ceItensImagem)){ ?>
                            <?php if($ceItensImagem <> ""){ ?>
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/g<?php echo $ceItensImagem;?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        <?php //---------- ?>
                    </div>
                </td>
                <?php } ?>

                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidosItens['cod_item'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidosItens['quantidade'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
				<?php if($GLOBALS['habilitarPedidosItensValorDesconto'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_desconto'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                <?php if($GLOBALS['habilitarPedidosItensValorAcrescimo'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_acrescimo'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_total'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
                <td class="<?php if($linhaPedidosItens['ativacao'] == 1){echo "AdmTbFundoAtivado";}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidosItens['id'];?>&statusAtivacao=<?php echo $linhaPedidosItens['ativacao'];?>&strTabela=ce_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                            <?php if($linhaPedidosItens['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaPedidosItens['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaPaginas['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="PedidosItensEditar.php?idCeItens=<?php echo $linhaPedidosItens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidosItens['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<!--
                        parent.elementoMensagem01('cePedidosItensValorTotal', '<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " " .Funcoes::MascaraValorLer($linhaPedidosItens['valor_total'], $GLOBALS['configSistemaMoeda']);?>');
                        -->
                    
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaPedidosItens['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaPedidosItens['id'];?>" class="AdmCampoRadioButton01" />
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
        </div>
        <div align="right" class="AdmTexto01" style="display: block; position: relative; overflow: hidden;">
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorTotal"); ?>: 
            </strong>
			<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
            <?php echo Funcoes::MascaraValorLer($countValorTotal, $GLOBALS['configSistemaMoeda']);?>
        </div>
    <?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPedidosItensSelect);
unset($statementPedidosItensSelect);
unset($resultadoPedidosItens);
unset($linhaPedidosItens);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>