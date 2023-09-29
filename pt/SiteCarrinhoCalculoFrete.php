<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastroCliente = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer()), 2);

$codSedex = $_GET["cod_sedex"];
$CEPEntrega = $_GET["cep_destino"];
$enderecoCobranca = $_GET["mensagemErro"]; //0 - Endereço de entrega não é o mesmo do de cobrança/cadastro | 1 - Endereço de entrega é o mesmo do endereço de cobrança/cadastro.
if($enderecoCobranca == "")
{
	$enderecoCobranca = "0";
}

$pesoTotalCarrinho = Funcoes::ValorConverterPeso(Carrinho::CarrinhoItensTotal(Crypto::DecryptValue(CookiesFuncoes::CookieValorLer("")), "", "ce_itens_temporario", "", "tb_produtos", "id", "peso", ""), 1);
$valorFrete = Funcoes::mascaraValorGravar(Carrinho::CarrinhoCalculoFreteCorreios01($GLOBALS['configCEPOrigem'], $CEPEntrega,
																					$pesoTotalCarrinho,
																					"0",
																					"1",
																					"0", "0", "0", "0",
																					$codSedex,
																					1));
$valorPedido = Carrinho::CarrinhoItensTotal($idTbCadastroCliente, "", "ce_itens_temporario", "", "tb_produtos", "id", "valor", "");
$valorTotal = $valorPedido + $valorFrete;

$paginaRetorno = "SiteCarrinhoCalculoFrete.php";
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
"&codSedex=" . $codSedex . 
"&CEPEntrega=" . $CEPEntrega . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Pesquisa endereço.
if($CEPEntrega <> "")
{
	$CEPEntregaLogradouro = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "logradouro"));
	$CEPEntregaBairro = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "bairro"));
	$CEPEntregaCidade = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "cidade"));
	$CEPEntregaUF = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "ufCodigo"));
	$CEPEntregaPais = Funcoes::ConteudoMascaraLeitura(CEP::CEPFill($CEPEntrega, "pais"));
}


//Verificação de erro - debug.
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
//echo "configCEPOrigem=" . $GLOBALS['configCEPOrigem'] . "<br>";
//echo "CEPEntrega=" . $CEPEntrega . "<br>";

//echo "pesoTotalCarrinho=" . $pesoTotalCarrinho . "<br>";
//echo "valorFrete=" . $valorFrete . "<br>";
//echo "valorPedido=" . $valorPedido . "<br>";
//echo "valorTotal=" . $valorTotal . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoCalculoFrete"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoCalculoFrete"); ?>
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
    
    <div style="position: relative; display: block; overflow: hidden;">
        <table class="AdmTabelaDados01" width="100%"  border="0" cellspacing="1" cellpadding="2">
          <tr>
            <td width="150" class="AdmTbFundoEscuro">
                <div align="left" class="CarrinhoTextoHeader">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFrete"); ?>:
                </div>
            </td>
            <td class="AdmTbFundoClaro">
                <div align="left" class="CarrinhoConteudo01">
                    <?php if($valorFrete == "" || $valorFrete == "0"){ ?>
                    	<span class="AdmAlerta">
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoFreteMensagemErro02"); ?>
                        </span>
                    <?php }else{ ?>
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?> 
                        <?php echo Funcoes::MascaraValorLer($valorFrete, $GLOBALS['configSistemaMoeda']);?>
                    <?php } ?>
                </div>
            </td>
          </tr>
    
          <tr>
            <td width="150" class="AdmTbFundoEscuro">
                <div align="left" class="CarrinhoTextoHeader">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoCalculoFreteTotalPedido"); ?>:
                </div>
            </td>
            <td class="AdmTbFundoClaro">
                <div align="left" class="CarrinhoConteudo01">
					<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?> 
                    <?php echo Funcoes::MascaraValorLer($valorPedido, $GLOBALS['configSistemaMoeda']);?>
                </div>
            </td>
          </tr>
    
          <tr>
            <td width="150" class="AdmTbFundoEscuro">
                <div align="left" class="CarrinhoTextoHeader">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoCalculoFreteTotal"); ?>:
                </div>
            </td>
            <td class="AdmTbFundoClaro">
                <div align="left" class="CarrinhoConteudo01">
					<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?> 
                    <?php echo Funcoes::MascaraValorLer($valorTotal, $GLOBALS['configSistemaMoeda']);?>
                </div>
            </td>
          </tr>
        </table>
    </div>
    
    
    <div style="position: relative; display: block; overflow: hidden; margin-top: 15px;">
    <form name="formCadastroEndereco" id="formCadastroEndereco" action="<?php echo $GLOBALS['configUrlSSL'];?>/<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteCadastro.php" method="get" target="_top" class="FormularioDados01">
        <input type="hidden" id="CEPEntrega" name="CEPEntrega" value="<?php echo $CEPEntrega;?>" />
        <input type="hidden" id="codSedex" name="codSedex" value="<?php echo $codSedex;?>" />
        
        <input type="hidden" id="valorPedido" name="valorPedido" value="<?php echo $valorPedido;?>" />
        <input type="hidden" id="valorFrete" name="valorFrete" value="<?php echo $valorFrete;?>" />
        <input type="hidden" id="pesoTotalCarrinho" name="pesoTotalCarrinho" value="<?php echo $pesoTotalCarrinho;?>" />
        
        <input type="hidden" id="idTipoCadastro" name="idTipoCadastro" value="<?php echo $GLOBALS['configIdCadastroCliente'];?>" />
        <input type="hidden" id="idTbCadastroTemporario" name="idTbCadastroTemporario" value="<?php echo urlencode(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario"));?>" />
    
        <table class="AdmTabelaDados01" width="100%" border="0" cellpadding="2" cellspacing="1">
              <tr>
                <td colspan="4" class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoCalculoFreteEndereco"); ?>: 
                    </div>
                </td>
              </tr>
              <tr>
                <td width="80" class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEndereco"); ?>: 
                    </div>
                </td>
                  <td colspan="3" class="AdmTbFundoClaro">
                      <div align="left" class="CarrinhoConteudo01">
                      	<?php if($CEPEntregaLogradouro <> ""){ ?>
							<?php echo $CEPEntregaLogradouro; ?>
                            <input type="hidden" id="endereco_entrega" name="endereco_entrega" value="<?php echo $CEPEntregaLogradouro; ?>"/>
                      	<?php }else{ ?>
                            <input type="text" id="endereco_entrega" name="endereco_entrega" class="CadastroCampoTexto01" maxlength="255" />
                      	<?php } ?>
                      </div>
                  </td>
              </tr>
            <tr>
                <td class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoNumero"); ?>: 
                    </div>
                </td>
                <td width="150" class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                        <input type="text" id="endereco_numero_entrega" name="endereco_numero_entrega" class="CadastroCampoTexto02" maxlength="255" />
                    </div>
                </td>
                <td width="80" class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoComplemento"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                        <input type="text" id="endereco_complemento_entrega"  name="endereco_complemento_entrega" class="CadastroCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairro"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                      	<?php if($CEPEntregaLogradouro <> ""){ ?>
							<?php echo $CEPEntregaBairro; ?>
                            <input type="hidden" id="endereco_bairro_entrega" name="endereco_bairro_entrega" value="<?php echo $CEPEntregaBairro; ?>"/>
                      	<?php }else{ ?>
                            <input type="text" id="endereco_bairro_entrega"  name="endereco_bairro_entrega" class="CadastroCampoTexto01" maxlength="255" />
                      	<?php } ?>
                    </div>
                </td>
                <td class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCidade"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                      	<?php if($CEPEntregaLogradouro <> ""){ ?>
							<?php echo $CEPEntregaCidade; ?>
                            <input type="hidden" id="endereco_cidade_entrega" name="endereco_cidade_entrega" value="<?php echo $CEPEntregaCidade; ?>"/>
                      	<?php }else{ ?>
                            <input type="text" id="endereco_cidade_entrega"  name="endereco_cidade_entrega" class="CadastroCampoTexto01" maxlength="255" />
                      	<?php } ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstado"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                      	<?php if($CEPEntregaLogradouro <> ""){ ?>
							<?php echo $CEPEntregaUF; ?>
                            <input type="hidden" id="endereco_estado_entrega" name="endereco_estado_entrega" value="<?php echo $CEPEntregaUF; ?>"/>
                      	<?php }else{ ?>
                            <input type="text" id="endereco_estado_entrega"  name="endereco_estado_entrega" class="CadastroCampoTexto01" maxlength="255" />
                      	<?php } ?>
                    </div>
                </td>
                <td class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPais"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                      	<?php if($CEPEntregaLogradouro <> ""){ ?>
							<?php echo $CEPEntregaPais; ?>
                            <input type="hidden" id="endereco_pais_entrega" name="endereco_pais_entrega" value="<?php echo $CEPEntregaPais; ?>"/>
                      	<?php }else{ ?>
                            <input type="text" id="endereco_pais_entrega"  name="endereco_pais_entrega" class="CadastroCampoTexto01" maxlength="255" />
                      	<?php } ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoEscuro">
                    <div align="left" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEP"); ?>: 
                    </div>
                </td>
                <td colspan="3" class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                        <?php echo Funcoes::FormatarCEPLer($CEPEntrega); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="AdmTbFundoClaro">
                    <div align="left" class="CarrinhoConteudo01">
                        <input type="checkbox" name="enderecoCobranca" value="1" checked="checked" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCarrinhoCalculoFreteEnderecoCobrancaCheckBox"); ?>
                    </div>
                </td>
            </tr>
        </table>
        
        <div align="center" style="position: relative; display: block; margin: 10px 0px 10px 0px;">
            <input type="image" name="prosseguir" value="Submit" src="img/btoConfirmarProsseguir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoProsseguir"); ?>" />
        </div>
    </form>
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