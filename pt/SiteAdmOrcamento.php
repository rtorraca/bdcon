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
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];
$idCeOrcamentosFichas = $_GET["idCeOrcamentosFichas"];
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

if($idCeOrcamentosFichas <> "")
{
	$idCeOrcamentos = $idCeOrcamentosFichas;
}else{
	$idCeOrcamentos = $_GET["idCeOrcamentos"];
	if($idCeOrcamentos == "")
	{
		$idCeOrcamentos = ContadorUniversal::ContadorUniversalUpdate(1);
		
		//Criação de registro de pedido.
		if(DbInsert::OrcamentosInsert($idCeOrcamentos, 
		$idTbCadastroCliente, 
		"0", 
		"0", 
		"0", 
		"", 
		"", 
		"0", 
		"0", 
		"", 
		"", 
		"0", 
		"0", 
		"0", 
		"0", 
		"0", 
		"", 
		"1", 
		"0", 
		"0", 
		"0", 
		"0", 
		"", 
		"", 
		"", 
		"", 
		"", 
		"0") == true)
		{
			
		}
	}
	
	if($idTbCadastroCliente == "")
	{
		$idTbCadastroCliente = DbFuncoes::GetCampoGenerico01($idCeOrcamentos, "ce_orcamentos", "id_tb_cadastro_cliente");
	}
}

//$itensValorTotal = "0";
$itensValorTotal = 0;

$paginaRetorno = "SiteAdmOrcamento.php";
$paginaRetornoExclusao = "SiteAdmOrcamento.php";
$variavelRetorno = "idTbCadastroCliente";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&idCeOrcamentos=" . $idCeOrcamentos . 
"&idCeOrcamentosFichas=" . $idCeOrcamentosFichas . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentPedidos=" . $idParentPedidos . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome_fantasia"), 1)); ?>
     - 
    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTituloEditar"); ?> 
     - 
    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "site"); ?> 
     - 
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTituloEditar"); ?>
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
    

	<?php //Orçamento - itens. ?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['configOrcamentosItens'] <> 0){ ?>
    <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
		<?php 
        //Query de pesquisa.
        //----------
        $strSqlOrcamentosItensSelect = "";
        $strSqlOrcamentosItensSelect .= "SELECT ";
        //$strSqlOrcamentosItensSelect .= "* ";
        $strSqlOrcamentosItensSelect .= "id, ";
        $strSqlOrcamentosItensSelect .= "id_ce_orcamentos, ";
        $strSqlOrcamentosItensSelect .= "n_classificacao, ";
        $strSqlOrcamentosItensSelect .= "item_titulo, ";
        $strSqlOrcamentosItensSelect .= "item_descricao, ";
        $strSqlOrcamentosItensSelect .= "data1, ";
        $strSqlOrcamentosItensSelect .= "data2, ";
        $strSqlOrcamentosItensSelect .= "data3, ";
        $strSqlOrcamentosItensSelect .= "data4, ";
        $strSqlOrcamentosItensSelect .= "data5, ";
        $strSqlOrcamentosItensSelect .= "url1, ";
        $strSqlOrcamentosItensSelect .= "url2, ";
        $strSqlOrcamentosItensSelect .= "url3, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro1, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro2, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro3, ";
        $strSqlOrcamentosItensSelect .= "valor, ";
        $strSqlOrcamentosItensSelect .= "valor1, ";
        $strSqlOrcamentosItensSelect .= "valor2, ";
        $strSqlOrcamentosItensSelect .= "ativacao, ";
        $strSqlOrcamentosItensSelect .= "ativacao1, ";
        $strSqlOrcamentosItensSelect .= "ativacao2, ";
        $strSqlOrcamentosItensSelect .= "ativacao3, ";
        $strSqlOrcamentosItensSelect .= "ativacao4, ";
        $strSqlOrcamentosItensSelect .= "arquivo1, ";
        $strSqlOrcamentosItensSelect .= "arquivo2, ";
        $strSqlOrcamentosItensSelect .= "arquivo3, ";
        $strSqlOrcamentosItensSelect .= "arquivo4, ";
        $strSqlOrcamentosItensSelect .= "arquivo5, ";
        $strSqlOrcamentosItensSelect .= "arquivo6, ";
        $strSqlOrcamentosItensSelect .= "arquivo7, ";
        $strSqlOrcamentosItensSelect .= "arquivo8, ";
        $strSqlOrcamentosItensSelect .= "arquivo9, ";
        $strSqlOrcamentosItensSelect .= "arquivo10, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar1, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar2, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar3, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar4, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar5, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar6, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar7, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar8, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar9, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar10 ";
        $strSqlOrcamentosItensSelect .= "FROM ce_orcamentos_itens ";
        $strSqlOrcamentosItensSelect .= "WHERE id <> 0 ";
        $strSqlOrcamentosItensSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
        $strSqlOrcamentosItensSelect .= "AND ativacao = 1 ";
        $strSqlOrcamentosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
        
        $statementOrcamentosItensSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosItensSelect);
        
        if ($statementOrcamentosItensSelect !== false)
        {
            /*
            $statementOrcamentosItensSelect->execute(array(
                "id_ce_orcamentos" => $idCeOrcamentos
            ));
            */
			/*
			if($idCeOrcamentos <> "")
			{
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
			}
			*/
            if($GLOBALS['configOrcamentosItens'] == 1)
			{
				$idCeOrcamentosPadrao = "0";
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentosPadrao, PDO::PARAM_STR);
            }
            $statementOrcamentosItensSelect->execute();
            
        }
        
        //$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosItensSelect);
        $resultadoOrcamentosItens = $statementOrcamentosItensSelect->fetchAll();
        ?>
        
        
		<?php
        if (empty($resultadoOrcamentosItens))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        <div style="position: relative; display: none; overflow: hidden;">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['habilitarOrcamentosItensNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosItensArquivo1'] == 1){ ?>
                    <?php if($GLOBALS['configOrcamentosItensArquivo1'] == 1){ ?>
                    <td width="1" class="AdmTabelaDados01Celula">
                        <div align="center" class="AdmTexto02">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloArquivo1'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensTitulo"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosMultiplos'] == 1){ ?>
                <td width="300" class="AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosVinculados"); ?>
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
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td width="30" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td width="30" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoOrcamentosItens as $linhaOrcamentosItens)
                {
              ?>
              <tr class="AdmTbFundoClaro">
                <?php if($GLOBALS['habilitarOrcamentosItensNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaOrcamentosItens['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosItensArquivo1'] == 1){ ?>
                    <?php if($GLOBALS['configOrcamentosItensArquivo1'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center" class="AdmTexto01">
                            <?php if(!empty($linhaOrcamentosItens['arquivo1'])){ ?>
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $linhaOrcamentosItens['arquivo1'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $linhaOrcamentosItens['arquivo1'];?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $linhaOrcamentosItens['arquivo1'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarOrcamentosItensIc1'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar1'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc1'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar1']);?> 
                                
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                    [
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc2'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar2'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc2'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar2']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                    [
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc3'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar3'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc3'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar3']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc4'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar4'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc4'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar4']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar4'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc5'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar5'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc5'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar5']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar5'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc6'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar6'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc6'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar6']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar6'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc7'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar7'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc7'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar7']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar7'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc8'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar8'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc8'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar8']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar8'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc9'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar9'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc9'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar9']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar9'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc10'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar10'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc10'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar10']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar10'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosMultiplos'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto01">
                    	<?php
						//Query de pesquisa.
						//----------
						$strSqlOrcamentosItensRelacaoRegistrosSelect = "";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "SELECT ";
						//$strSqlOrcamentosItensRelacaoRegistrosSelect .= "* ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "data_atualizacao, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_ce_orcamentos, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_ce_orcamentos_itens, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_registro, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_registro, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_categoria, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_relacao, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tabela, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "quantidade, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor1, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor2, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao1, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao2, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao3, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao4, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar1, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar2, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar3, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar4, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar5, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "obs ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "FROM ce_orcamentos_itens_relacao_registros ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "WHERE id <> 0 ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "AND id_ce_orcamentos_itens = :id_ce_orcamentos_itens ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
						//$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ORDER BY id ";
						
						$statementOrcamentosItensRelacaoRegistrosSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosItensRelacaoRegistrosSelect);
						
						if ($statementOrcamentosItensRelacaoRegistrosSelect !== false)
						{
							/*
							$statementOrcamentosItensSelect->execute(array(
								"id_ce_orcamentos" => $idCeOrcamentos
							));
							*/
							/*
							if($idCeOrcamentos <> "")
							{
								$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
							}
							*/
							//if($GLOBALS['configOrcamentosItens'] == 1)
							//{
								$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $linhaOrcamentosItens['id'], PDO::PARAM_STR);
							//}
							
							$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
							$statementOrcamentosItensRelacaoRegistrosSelect->execute();
							
						}
						
						//$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosItensRelacaoRegistrosSelect);
						$resultadoOrcamentosItensRelacaoRegistros = $statementOrcamentosItensRelacaoRegistrosSelect->fetchAll();

						?>
						<?php
                        if(empty($resultadoOrcamentosItensRelacaoRegistros))
                        {
                            //echo "Nenhum registro encontrado";
                        }else{
                        ?>
                            <table class="AdmTabelaDados01" width="100%">
                                <tr class="AdmTbFundoEscuro">
                                    <td width="100" class="AdmTabelaDados01Celula">
                                        <div align="left" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="50" class="AdmTabelaDados01Celula">
                                        <div align="right" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>
                                        </div>
                                    </td>
                                    
                                    <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                                    <td width="20" class="AdmTabelaDados01Celula">
                                        <div align="center" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensQuantidadeA"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="20" class="AdmTabelaDados01Celula">
                                        <div align="right" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensValorSubtotal"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoOrcamentosItensRelacaoRegistros as $linhaOrcamentosItensRelacaoRegistros)
                                {
                                    $tbProdutosValor = 0;
                                    $tbProdutosValor = DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "valor");
                                    
                                    //Valor total.
                                    if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1)
                                    {
                                        $orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + ($linhaOrcamentosItensRelacaoRegistros["quantidade"] * $tbProdutosValor);
                                    }else{
                                        $orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + $tbProdutosValor;
                                    }
                                    
                                    //Quantidade de itens.
                                    $orcamentosItensRelacaoRegistrosQtdTotal = $orcamentosItensRelacaoRegistrosQtdTotal + $linhaOrcamentosItensRelacaoRegistros["quantidade"];
                                ?>
                                
                                    <div style="position: relative; display: none; margin-bottom: 15px;">
                                        <div>
                                            <strong>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>: 
                                            </strong>
                                            <?php echo DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "produto"); ?>
                                        </div>
                                        <div>
                                            <strong>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>: 
                                            </strong>
                                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                            <?php echo Funcoes::MascaraValorLer($tbProdutosValor, $GLOBALS['configSistemaMoeda']);?>
                                        </div>
                                        <div>
                                            <?php echo $linhaOrcamentosItensRelacaoRegistros["informacao_complementar1"]; ?>
                                        </div>
                                    </div>
                                    
                                    <tr class="AdmTbFundoClaro">
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="left" class="AdmTexto01">
                                                <?php echo DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "produto"); ?>
                                                <div>
                                                    <?php echo $linhaOrcamentosItensRelacaoRegistros["informacao_complementar1"]; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="right" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($tbProdutosValor, $GLOBALS['configSistemaMoeda']);?>
                                            </div>
                                        </td>
                                        <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <?php echo $linhaOrcamentosItensRelacaoRegistros["quantidade"]; ?>
                                            </div>
                                        </td>
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="right" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                                                <?php echo Funcoes::MascaraValorLer(($linhaOrcamentosItensRelacaoRegistros["quantidade"] * $tbProdutosValor), $GLOBALS['configSistemaMoeda']); ?>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>
                        <?php
						//Limpeza de objetos.
						//----------
						unset($strSqlOrcamentosItensRelacaoRegistrosSelect);
						unset($statementOrcamentosItensRelacaoRegistrosSelect);
						unset($resultadoOrcamentosItensRelacaoRegistros);
						unset($linhaOrcamentosItensRelacaoRegistros);
						//----------
						?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosMultiplos'] == 1){ ?>
                            <a href="SiteAdmOrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&tipoCategoria=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                
                <td class="<?php if($linhaOrcamentosItens['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php if($GLOBALS['configOrcamentosItens'] == 2){ ?>
                        <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentosItens['id'];?>&statusAtivacao=<?php echo $linhaOrcamentosItens['ativacao'];?>&strTabela=ce_orcamentos_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                            <?php if($linhaOrcamentosItens['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
                        <?php } ?>
                        
                        <?php if($GLOBALS['configOrcamentosItens'] == 1){ ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php //echo $linhaOrcamentosItens['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmOrcamentosItensEditar.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentosItens['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php } ?>
            </table>
        </div>
        
        <div style="position: relative; display: block; overflow: hidden;">
              <?php
                //Loop pelos resultados.
                foreach($resultadoOrcamentosItens as $linhaOrcamentosItens)
                {
              ?>
                    <!--Registro - Orçamento Item.-->
                    <div align="center" class="OrcamentosItensIndiceContainer OrcamentosItensIndiceConteudo">
                        <div align="center" style="position: relative; display: block;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>
                        </div>
                        <div align="center" style="position: relative; display: block;">
                            <?php if(!empty($linhaOrcamentosItens['arquivo1'])){ ?>
                            <div class="OrcamentosItensImagemIndice">
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $linhaOrcamentosItens['arquivo1'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $linhaOrcamentosItens['arquivo1'];?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $linhaOrcamentosItens['arquivo1'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>" />
                                    </a>
                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div align="center" style="position: relative; display: block;">
                            grafico
                        </div>
                    </div>
              
              
              <?php } ?>
        </div>
        <?php } ?>
        
        <?php
        //Limpeza de objetos.
        //----------
        unset($strSqlOrcamentosItensSelect);
        unset($statementOrcamentosItensSelect);
        unset($resultadoOrcamentosItens);
        unset($linhaOrcamentosItens);
        //----------
        ?>
    </div>
    <?php } ?>
	<?php //**************************************************************************************?>
    
    
	<?php //Orçamento - fichas. ?>
	<?php //**************************************************************************************?>
    <?php if($idCeOrcamentosFichas == ""){ ?>
		<?php if($GLOBALS['habilitarOrcamentoFichas'] == 1){ ?>
        <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
            <?php 
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
            ?>
            
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
                    //Loop pelos resultados.
                    foreach($resultadoOrcamentosFichas as $linhaOrcamentosFichas)
                    {
                  ?>
                  <tr class="AdmTbFundoClaro">
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
                            <a href="SiteAdmOrcamento.php?idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
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
                  <?php } ?>
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
            //Limpeza de objetos.
            //----------
            unset($strSqlOrcamentosFichasSelect);
            unset($statementOrcamentosFichasSelect);
            unset($resultadoOrcamentosFichas);
            unset($linhaOrcamentosFichas);
            //----------
            ?>
            </div>
        <?php } ?>
    <?php } ?>
	<?php //**************************************************************************************?>


	<?php //Orçamento - edição. ?>
	<?php //**************************************************************************************?>
    <?php if($idCeOrcamentosFichas == ""){ ?>
    <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
    	<?php
		//Query de pesquisa.
		//----------
		$strSqlOrcamentosDetalhesSelect = "";
		$strSqlOrcamentosDetalhesSelect .= "SELECT ";
		//$strSqlOrcamentosDetalhesSelect .= "* ";
		$strSqlOrcamentosDetalhesSelect .= "id, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_cliente, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_vendedor, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_usuario, ";
		$strSqlOrcamentosDetalhesSelect .= "data_orcamento, ";
		$strSqlOrcamentosDetalhesSelect .= "data_entrega, ";
		$strSqlOrcamentosDetalhesSelect .= "valor_orcamento, ";
		$strSqlOrcamentosDetalhesSelect .= "valor_frete, ";
		$strSqlOrcamentosDetalhesSelect .= "periodo_contratacao, ";
		$strSqlOrcamentosDetalhesSelect .= "tipo_entrega, ";
		$strSqlOrcamentosDetalhesSelect .= "valor_total, ";
		$strSqlOrcamentosDetalhesSelect .= "peso_total, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro1, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro2, ";
		$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro3, ";
		$strSqlOrcamentosDetalhesSelect .= "obs, ";
		$strSqlOrcamentosDetalhesSelect .= "ativacao, ";
		$strSqlOrcamentosDetalhesSelect .= "ativacao1, ";
		$strSqlOrcamentosDetalhesSelect .= "ativacao2, ";
		$strSqlOrcamentosDetalhesSelect .= "ativacao3, ";
		$strSqlOrcamentosDetalhesSelect .= "ativacao4, ";
		$strSqlOrcamentosDetalhesSelect .= "informacao_complementar1, ";
		$strSqlOrcamentosDetalhesSelect .= "informacao_complementar2, ";
		$strSqlOrcamentosDetalhesSelect .= "informacao_complementar3, ";
		$strSqlOrcamentosDetalhesSelect .= "informacao_complementar4, ";
		$strSqlOrcamentosDetalhesSelect .= "informacao_complementar5, ";
		$strSqlOrcamentosDetalhesSelect .= "id_ce_complemento_status ";
		$strSqlOrcamentosDetalhesSelect .= "FROM ce_orcamentos ";
		$strSqlOrcamentosDetalhesSelect .= "WHERE id <> 0 ";
		//$strSqlOrcamentosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
		$strSqlOrcamentosDetalhesSelect .= "AND id = :id ";
		//$strSqlOrcamentosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//echo "strSqlOrcamentosDetalhesSelect=" . $strSqlOrcamentosDetalhesSelect . "<br>";
		//----------


		//Parâmetros.
		//----------
		$statementOrcamentosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosDetalhesSelect);
		
		if ($statementOrcamentosDetalhesSelect !== false)
		{
			$statementOrcamentosDetalhesSelect->execute(array(
				"id" => $idCeOrcamentos
			));
		}
		//----------


		//$resultadoOrcamentosDetalhes = $dbSistemaConPDO->query($strSqlOrcamentosDetalhesSelect);
		$resultadoOrcamentosDetalhes = $statementOrcamentosDetalhesSelect->fetchAll();
		
		
		if (empty($resultadoOrcamentosDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoOrcamentosDetalhes as $linhaOrcamentosDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbOrcamentosId = $linhaOrcamentosDetalhes['id'];
				$tbOrcamentosIdTbCadastroCliente = $linhaOrcamentosDetalhes['id_tb_cadastro_cliente'];
				$tbOrcamentosIdTbCadastroEnderecos = $linhaOrcamentosDetalhes['id_tb_cadastro_enderecos'];
				$tbOrcamentosIdTbCadastroVendedor = $linhaOrcamentosDetalhes['id_tb_cadastro_vendedor'];
				$tbOrcamentosIdTbCadastroUsuario = $linhaOrcamentosDetalhes['id_tb_cadastro_usuario'];
				//$tbOrcamentosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['tipo_pagamento']);
				
				//$tbOrcamentosDataPedido = $linhaOrcamentosDetalhes['data_pedido'];
				if($linhaOrcamentosDetalhes['data_orcamento'] == NULL)
				{
					$tbOrcamentosDataOrcamento = "";
				}else{
					$tbOrcamentosDataOrcamento = Funcoes::DataLeitura01($linhaOrcamentosDetalhes['data_orcamento'], $GLOBALS['configSistemaFormatoData'], "1");
				}
				
				//$tbOrcamentosDataEntrega = $linhaOrcamentosDetalhes['data_entrega'];
				if($linhaOrcamentosDetalhes['data_entrega'] == NULL)
				{
					$tbOrcamentosDataEntrega = "";
				}else{
					$tbOrcamentosDataEntrega = Funcoes::DataLeitura01($linhaOrcamentosDetalhes['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1");
				}


				//$tbOrcamentosValorPedido = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
				$tbOrcamentosValorOrcamento = $linhaOrcamentosDetalhes['valor_orcamento'];

				//$tbOrcamentosValorFrete = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
				$tbOrcamentosValorFrete = $linhaOrcamentosDetalhes['valor_frete'];

				$tbOrcamentosPeriodoContratacao = $linhaOrcamentosDetalhes['periodo_contratacao'];
				$tbOrcamentosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['tipo_entrega']);

				//$tbOrcamentosValorTotal = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
				$tbOrcamentosValorTotal = $linhaOrcamentosDetalhes['valor_total'];

				$tbOrcamentosPesoTotal = $linhaOrcamentosDetalhes['peso_total'];
				$tbOrcamentosIdTbCadastro1 = $linhaOrcamentosDetalhes['id_tb_cadastro1'];
				$tbOrcamentosIdTbCadastro2 = $linhaOrcamentosDetalhes['id_tb_cadastro2'];
				$tbOrcamentosIdTbCadastro3 = $linhaOrcamentosDetalhes['id_tb_cadastro3'];
				$tbOrcamentosOBS = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['obs']);
				$tbOrcamentosAtivacao = $linhaOrcamentosDetalhes['ativacao'];
				$tbOrcamentosAtivacao1 = $linhaOrcamentosDetalhes['ativacao1'];
				$tbOrcamentosAtivacao2 = $linhaOrcamentosDetalhes['ativacao2'];
				$tbOrcamentosAtivacao3 = $linhaOrcamentosDetalhes['ativacao3'];
				$tbOrcamentosAtivacao4 = $linhaOrcamentosDetalhes['ativacao4'];
				$tbOrcamentosIC1 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar1']);
				$tbOrcamentosIC2 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar2']);
				$tbOrcamentosIC3 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar3']);
				$tbOrcamentosIC4 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar4']);
				$tbOrcamentosIC5 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar5']);
				$tbOrcamentosIdCeComplementoStatus = $linhaOrcamentosDetalhes['id_ce_complemento_status'];
				
				
				//Verificação de erro.
				//echo "tbOrcamentosId=" . $tbOrcamentosId . "<br>";
				//echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
				//echo "tbOrcamentosAtivacao=" . $tbOrcamentosAtivacao . "<br>";
			}
		}
		?>
        
        
        <form name="formOrcamentosEditar" id="formOrcamentosEditar" action="SiteAdmOrcamentosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
			<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
            <script type="text/javascript">
                //Variável para conter todos os campos que funcionam com o DatePicker.
                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                var strDatapickerGenericoPtCampos = "#data_orcamento;#data_entrega;";
            </script>
            <?php } ?>
            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
            <script type="text/javascript">
                //Variável para conter todos os campos que funcionam com o DatePicker.
                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                var strDatapickerGenericoEnCampos = "#orcamento;#data_entrega;";
            </script>
            <?php } ?>
            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTbOrcamentosEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosNumero"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php echo $tbOrcamentosId; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosData"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                        	<?php if($GLOBALS['habilitarOrcamentosEdicaoData'] == 1){ ?>
								<?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <input type="text" name="data_orcamento" id="data_orcamento" class="AdmCampoData01" maxlength="10" value="<?php echo $tbOrcamentosDataOrcamento;?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                        	<?php }else{ ?>
                            	<?php echo $tbOrcamentosDataOrcamento; ?>
                        	<?php } ?>
                        </div>
                    </td>
                </tr>
                <?php if($GLOBALS['habilitarOrcamentosDataEntrega'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosDataEntrega"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="data_entrega" id="data_entrega" class="AdmCampoData01" maxlength="10" value="<?php echo $tbOrcamentosDataEntrega;?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorOrcamento"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php 
							//if($linhaOrcamentosDetalhes['valor_orcamento'] == 0)
							//{
								//$tbOrcamentosValorOrcamento = $itensValorTotal;
								$tbOrcamentosValorOrcamento = Orcamentos::OrcamentoTotal($idCeOrcamentos, 1);
							//}
							
							//Verificação de erro.
							//echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
							//echo "itensValorTotal=" . $itensValorTotal . "<br>";
							//echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
							?>

							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                            
							<?php if($GLOBALS['habilitarOrcamentosEdicaoValorTotal'] == 1){ ?>
                                <input type="text" name="valor_orcamento" id="valor_orcamento" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento, $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                            <?php }else{ ?>
								<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento, $GLOBALS['configSistemaMoeda']); ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarOrcamentosFrete'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorFrete"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_frete" id="valor_frete" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorFrete, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                            <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbOrcamentosValorFrete; ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <?php if($GLOBALS['habilitarOrcamentosTipoEntrega'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTipoEntrega"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tipo_entrega" id="tipo_entrega" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbOrcamentosTipoEntrega; ?>" />
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorTotal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <?php 
							//if($linhaOrcamentosDetalhes['valor_total'] == 0)
							//{
								$tbOrcamentosValorTotal = $tbOrcamentosValorFrete + $tbOrcamentosValorOrcamento;
							//}
							
							//Verificação de erro.
							//echo "tbOrcamentosValorTotal=" . $tbOrcamentosValorTotal . "<br>";
							//echo "tbOrcamentosValorFrete=" . $tbOrcamentosValorFrete . "<br>";
							//echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
							//echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
							?>
							
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                            
							<?php if($GLOBALS['habilitarOrcamentosEdicaoValorTotal'] == 1){ ?>
                                <input type="text" name="valor_total" id="valor_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorTotal, $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                            <?php }else{ ?>
								<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorTotal, $GLOBALS['configSistemaMoeda']); ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarOrcamentosPeso'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosPesoTotal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <input type="text" name="peso_total" id="peso_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbOrcamentosPesoTotal; ?>" />
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>

                            <?php //echo $tbOrcamentosPesoTotal; ?> <?php //echo htmlentities($GLOBALS['configSistemaPeso']); ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosObs"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosOBS;?></textarea>
                        </div>
                    </td>
                </tr>
    
                <tr>
                    <td class="TbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
                            <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbOrcamentosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                <option value="1"<?php if($tbOrcamentosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                            </select>
                        </div>
                    </td>
                </tr>
    
                <?php if($GLOBALS['habilitarOrcamentosIc1'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configOrcamentosBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC1;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configOrcamentosBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC1;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar1").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbOrcamentosIC1;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar1").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbOrcamentosIC1;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc2'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configOrcamentosBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC2;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configOrcamentosBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC2;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar2").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbOrcamentosIC2;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar2").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbOrcamentosIC2;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarOrcamentosIc3'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configOrcamentosBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC3;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configOrcamentosBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC3;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar3").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbOrcamentosIC3;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar3").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbOrcamentosIC3;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarOrcamentosIc4'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configOrcamentosBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC4;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configOrcamentosBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC4;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>

                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar4").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbOrcamentosIC4;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar4").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbOrcamentosIC4;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarOrcamentosIc5'] == 1){ ?>
                <tr>
                    <td class="TbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configOrcamentosBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC5;?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configOrcamentosBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC5;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação básica (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                    
                                    <script type="text/javascript">
                                        //Caixa básica.
                                        $(document).ready(function () {
                                            $("#informacao_complementar5").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorBasicoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorBasicoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbOrcamentosIC5;?></textarea>
                                <?php } ?>
                                
                                <?php //Formatação avançada (CLEditor).?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $("#informacao_complementar5").cleditor(
                                                {
                                                    //Controles disponíveis na barra de ferramentas.
                                                    controls:
                                                    CLEditorAvancadoControles
                                                    , 
                                            
                                                    //Fontes disponíveis.
                                                    fonts:        
                                                    CLEditorAvancadoFontes
                                                }
                                            );
                                        });
                                    </script>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbOrcamentosIC5;?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                    
            </table>
            <div>
                <div style="float:left;">
                    <!--input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" /-->
                    <input type="image" name="submit" value="Submit" src="img/btoFinalizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoFinalizar"); ?>" />
                    
                    <input type="hidden" id="idCeOrcamentos" name="idCeOrcamentos" value="<?php echo $tbOrcamentosId; ?>" />
                    <input type="hidden" id="idTbCadastroCliente" name="idTbCadastroCliente" value="<?php echo $idTbCadastroCliente; ?>" />
                    <input type="hidden" id="flagFinalizar" name="flagFinalizar" value="1" />
                    
                    <input type="hidden" id="id_tb_cadastro_cliente" name="id_tb_cadastro_cliente" value="<?php echo $tbOrcamentosIdTbCadastroCliente; ?>" />

                    <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
        
            
		<?php
        //Limpeza de objetos.
        //----------
        unset($strSqlOrcamentosDetalhesSelect);
        unset($statementOrcamentosDetalhesSelect);
        unset($resultadoOrcamentosDetalhes);
        unset($linhaOrcamentosDetalhes);
        //----------
		?>
    </div>
    <?php } ?>
	<?php //**************************************************************************************?>
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