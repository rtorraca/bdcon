<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de paginas.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$tipoComplemento = $_GET["tipoComplemento"];

$paginaRetorno = "SiteAdmPedidosManutencao.php";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "cookie(idTbPedidosCliente)=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . "idTbPedidosCliente"] . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosManutencaoTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosManutencaoTitulo"); ?>
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


	<?php //Opções gerais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
    <br />
	<?php //Opções principais.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "2";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>

    
    <br />
	<?php //Opções de informações complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmOpcoes_tipoOpcoes = "ic1";
	$includeAdmOpcoes_configOpcoes = "";
	?>
    
    <?php include "IncludeAdmOpcoes.php";?>
    <?php //----------------------?>
    
    
	<?php //Pedidos - Filtro Genérico 01.?>
    <?php //----------?>
    <?php //if($GLOBALS['habilitarPedidosFiltroGenerico01'] == 1){ ?>
        <?php
		//Definição de variáveis.
		//$tipoComplemento = 12;
		
        //Query de pesquisa.
        //----------
        $strSqlPedidosManutencaoSelect = "";
        $strSqlPedidosManutencaoSelect .= "SELECT ";
        $strSqlPedidosManutencaoSelect .= "id, ";
        $strSqlPedidosManutencaoSelect .= "tipo_complemento, ";
        $strSqlPedidosManutencaoSelect .= "complemento, ";
        $strSqlPedidosManutencaoSelect .= "descricao ";
        $strSqlPedidosManutencaoSelect .= "FROM ce_complemento ";
        $strSqlPedidosManutencaoSelect .= "WHERE id <> 0 ";
        $strSqlPedidosManutencaoSelect .= "AND tipo_complemento = :tipo_complemento ";
        //$strSqlPedidosManutencaoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidos'] . " ";
        $strSqlPedidosManutencaoSelect .= "ORDER BY complemento";
        
        $statementPedidosManutencaoSelect = $dbSistemaConPDO->prepare($strSqlPedidosManutencaoSelect);
        
        if ($statementPedidosManutencaoSelect !== false)
        {
            $statementPedidosManutencaoSelect->execute(array(
                "tipo_complemento" => $tipoComplemento
            ));
        }
        
        //$resultadoPedidosManutencao = $dbSistemaConPDO->query($strSqlPedidosManutencaoSelect);
        $resultadoPedidosManutencao = $statementPedidosManutencaoSelect->fetchAll();
        ?>
        
        <!--table border="0" width="100%" cellpadding="0" cellspacing="0" class="AdmTabelaDados01">
            <tr class="AdmTbFundoEscuro">
                <td>
                    <div align="center" class="AdmTexto02">
                    	<?php if($tipoComplemento == "12"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "13"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "14"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "15"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "16"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "17"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "18"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "19"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "20"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "21"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
        </table-->
		<?php
        if(empty($resultadoPedidosManutencao))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmAlerta">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemRegistrosVazio"); ?>
            </div>
        <?php
        }else{
        ?>
        <form name="formPedidosManutencaoAcoes" id="formPedidosManutencaoAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_complemento" />
            <input name="tipoComplemento" type="hidden" id="tipoComplemento" value="<?php echo $tipoComplemento; ?>" />

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
                <td>
                    <div align="center" class="AdmTexto02">
                    	<?php if($tipoComplemento == "12"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico01Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "13"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "14"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico03Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "15"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico04Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "16"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico05Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "17"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico06Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "18"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico07Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "19"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico08Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "20"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico09Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    	<?php if($tipoComplemento == "21"){ ?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico10Nome'], "IncludeConfig"); ?>
                        <?php } ?>
                    </div>
                </td>
                <td width="30">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <td width="30">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoPedidosManutencao as $linhaPedidosManutencao)
                {
                    //echo "id=" . $linhaCategorias['id'] . "<br />";
              ?>
              <tr class="AdmTbFundoClaro">
                <td>
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosManutencao['complemento']);?>
                    </div>
                </td>
                
                <td>
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmPedidosManutencaoEditar.php?idTbPedidosComplemento=<?php echo $linhaPedidosManutencao['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td>
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidosManutencao['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
		<?php } ?>
        
        <form name="formPedidosManutencao" id="formPedidosManutencao" action="SiteAdmPedidosManutencaoExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="2">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserir"); ?> <?php //echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico01Nome']); ?>
                                
                                <?php if($tipoComplemento == "12"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico01Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "13"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico02Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "14"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico03Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "15"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico04Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "16"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico05Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "17"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico06Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "18"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico07Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "19"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico08Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "20"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico09Nome']); ?>
                                <?php } ?>
                                <?php if($tipoComplemento == "21"){ ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico10Nome']); ?>
                                <?php } ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php if($tipoComplemento == "12"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico01Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "13"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico02Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "14"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico03Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "15"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico04Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "16"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico05Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "17"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico06Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "18"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico07Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "19"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico08Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "20"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico09Nome']); ?>:
                            <?php } ?>
                            <?php if($tipoComplemento == "21"){ ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico10Nome']); ?>:
                            <?php } ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div align="left">
                            <input type="text" name="complemento" id="complemento" class="AdmCampoTexto02" maxlength="255" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosManutencaoDescricao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"></textarea>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                    <input name="tipo_complemento" type="hidden" id="tipo_complemento" value="<?php echo $tipoComplemento; ?>" />
                    
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        
        <?php 
        //Limpeza de objetos.
        //----------
        unset($strSqlPedidosManutencaoSelect);
        unset($statementPedidosManutencaoSelect);
        unset($resultadoPedidosManutencao);
        unset($linhaPedidosManutencao);
        //----------
        ?>
	<?php //} ?>
    <?php //----------?>


<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>