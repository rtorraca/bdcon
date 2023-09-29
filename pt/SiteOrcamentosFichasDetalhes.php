<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idCeOrcamentosFichas = $_GET["idCeOrcamentosFichas"];
$idCeOrcamentos = DbFuncoes::GetCampoGenerico01($idCeOrcamentosFichas, "ce_orcamentos_fichas", "id_ce_orcamentos");

$idTbCadastroCliente = DbFuncoes::GetCampoGenerico01($idCeOrcamentos, "ce_orcamentos", "id_tb_cadastro_cliente");

$paginaRetorno = "SiteOrcamentosFichasDetalhes.php";
$paginaRetornoExclusao = "SiteOrcamentosFichasDetalhes.php";
$variavelRetorno = "idCeOrcamentos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.



//Query de pesquisa.
//----------
$strSqlOrcamentosFichasDetalhesSelect = "";
$strSqlOrcamentosFichasDetalhesSelect .= "SELECT ";
//$strSqlOrcamentosFichasDetalhesSelect .= "* ";
$strSqlOrcamentosFichasDetalhesSelect .= "id, ";
$strSqlOrcamentosFichasDetalhesSelect .= "id_ce_orcamentos, ";
$strSqlOrcamentosFichasDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlOrcamentosFichasDetalhesSelect .= "data_ficha, ";
$strSqlOrcamentosFichasDetalhesSelect .= "titulo, ";
$strSqlOrcamentosFichasDetalhesSelect .= "obs, ";
$strSqlOrcamentosFichasDetalhesSelect .= "ativacao, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar1, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar2, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar3, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar4, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar5 ";
$strSqlOrcamentosFichasDetalhesSelect .= "FROM ce_orcamentos_fichas ";
$strSqlOrcamentosFichasDetalhesSelect .= "WHERE id <> 0 ";
$strSqlOrcamentosFichasDetalhesSelect .= "AND id = :id ";
//$strSqlOrcamentosFichasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosFichas'] . " ";


$statementOrcamentosFichasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosFichasDetalhesSelect);

if ($statementOrcamentosFichasDetalhesSelect !== false)
{
	
	$statementOrcamentosFichasDetalhesSelect->execute(array(
		"id" => $idCeOrcamentosFichas
	));
	
	/*
	if($idTbOrcamentosFichas <> "")
	{
		$statementOrcamentosFichasDetalhesSelect->bindParam(':id', $idTbOrcamentosFichas, PDO::PARAM_STR);
	}
	$statementOrcamentosFichasDetalhesSelect->execute();
	*/
}

//$resultadoOrcamentosFichasDetalhes = $dbSistemaConPDO->query($strSqlOrcamentosFichasDetalhesSelect);
$resultadoOrcamentosFichasDetalhes = $statementOrcamentosFichasDetalhesSelect->fetchAll();

if (empty($resultadoOrcamentosFichasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoOrcamentosFichasDetalhes as $linhaOrcamentosFichasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbOrcamentosFichasId = $linhaOrcamentosFichasDetalhes['id'];
		$tbOrcamentosFichasIdCeOrcamentos = $linhaOrcamentosFichasDetalhes['id_ce_orcamentos'];
		
		$tbOrcamentosFichasIdTbCadastroUsuario = $linhaOrcamentosFichasDetalhes['id_tb_cadastro_usuario'];
		$tbOrcamentosFichasIdTbCadastroUsuarioNomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbOrcamentosFichasIdTbCadastroUsuario, "tb_cadastro", "nome"), 
																								DbFuncoes::GetCampoGenerico01($tbOrcamentosFichasIdTbCadastroUsuario, "tb_cadastro", "razao_social"), 
																								DbFuncoes::GetCampoGenerico01($tbOrcamentosFichasIdTbCadastroUsuario, "tb_cadastro", "nome_fantasia"), 
																								1));

		$tbOrcamentosFichasDataFicha = $linhaOrcamentosFichasDetalhes['data_ficha'];
		$tbOrcamentosFichasDataFicha_print = Funcoes::DataLeitura01($tbOrcamentosFichasDataFicha, $GLOBALS['configSiteFormatoData'], "1");;

		$tbOrcamentosFichasTitulo = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['titulo']);

		$tbOrcamentosFichasIdTbCadastro1 = $linhaOrcamentosFichasDetalhes['id_tb_cadastro1'];
		$tbOrcamentosFichasIdTbCadastro2 = $linhaOrcamentosFichasDetalhes['id_tb_cadastro2'];
		$tbOrcamentosFichasIdTbCadastro3 = $linhaOrcamentosFichasDetalhes['id_tb_cadastro3'];
		$tbOrcamentosFichasOBS = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['obs']);

		$tbOrcamentosFichasAtivacao = $linhaOrcamentosFichasDetalhes['ativacao'];
		
		$tbOrcamentosFichasIC1 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar1']);
		$tbOrcamentosFichasIC2 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar2']);
		$tbOrcamentosFichasIC3 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar3']);
		$tbOrcamentosFichasIC4 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar4']);
		$tbOrcamentosFichasIC5 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar5']);


		//Verificação de erro.
		//echo "tbOrcamentosFichasId=" . $tbOrcamentosFichasId . "<br>";
		//echo "tbOrcamentosFichasTitulo=" . $tbOrcamentosFichasTitulo . "<br>";
		//echo "tbOrcamentosFichasAtivacao=" . $tbOrcamentosFichasAtivacao . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = Funcoes::RemoverHTML01($tbOrcamentosFichasTitulo);


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = Funcoes::RemoverHTML01($tbOrcamentosFichasOBS);
$metaPalavrasChave = Funcoes::RemoverHTML01($metaDescricao);
//----------


//Verificação de erro - debug.
//echo "idTemporario=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    
    <meta property="og:title" content="<?php echo Funcoes::LimitadorCatecteres($metaTitulo, 35); ?>" /> <?php //35 caracteres.?>
    <meta property="og:url" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/SiteProdutosDetalhes.php?idTbProdutos=" . $idTbProdutos; ?>" />
    <meta property="og:description" content="<?php echo $metaDescricao; ?>"><?php //155 caracteres - Funcoes.LimitadorCatecteres($metaDescricao, 155).?>
    <?php if($tbProdutosImagem <> ""){ ?>
    <meta property="og:image" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/r" . $tbProdutosImagem; ?>"><?php //JPG ou PNG, menos que 300k e dimensão mínima de 300x200 pixels.?>
    <?php } ?>
    <meta property="og:image:alt" content="<?php echo $metaTitulo; ?>" />
    <meta property="og:type" content="product.item" /><?php //referencias de tipos: https://developers.facebook.com/docs/reference/opengraph/.?>

    <meta property="og:locale" content="pt_BR" />
    <!--meta property="og:locale:alternate" content="fr_FR" /--><?php //Idiomas adicionais.?>
    <!--meta property="og:locale:alternate" content="es_ES" /-->

    <!--
    Twitter: https://developer.twitter.com/en/docs/tweets/optimize-with-cards/guides/getting-started
    Áudio/Vídeo: http://ogp.me/
    Favicon: https://stackoverflow.com/questions/2268204/favicon-dimensions/43154399#43154399
    -->
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
	<?php echo $tituloLinkAtual; ?>
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
    
    
	<?php //Cadastro - Detalhes.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	//$includePaginas_idParentPaginas = $tbCadastroId;
	$includeCadastroDetalhes_idTbCadastro = $idTbCadastroCliente;
	$includeCadastro_configTipoDiagramacao = "1";
	?>
    
    <?php include "IncludeCadastroDetalhes.php";?>
    <?php //----------------------?>
    
    
	<?php //Diagramação 1.?>
	<?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block; overflow: hidden;">
        <table class="AdmTabelaCampos01 AdmTexto01">
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <?php echo $tbOrcamentosFichasDataFicha_print; ?>
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
                        <?php echo $tbOrcamentosFichasTitulo; ?>
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
                        <?php echo $tbOrcamentosFichasOBS; ?>
                    </div>
                </td>
            </tr>
            
        </table>
    </div>
	<?php //**************************************************************************************?>
    
    
	<?php //Orçamento - Itens - Relação Produtos?>
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
        <div style="position: relative; display: block; overflow: hidden;">
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
                
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
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
                            
                            //$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
                            $statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentosFichas, PDO::PARAM_STR);
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
                
                
                <td class="<?php if($linhaOrcamentosItens['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php if($GLOBALS['configOrcamentosItens'] == 2){ ?>
                        <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentosItens['id'];?>&statusAtivacao=<?php echo $linhaOrcamentosItens['ativacao'];?>&strTabela=ce_orcamentos_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        </a>
							<?php if($linhaOrcamentosItens['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
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
                
              </tr>
              <?php } ?>
            </table>
        </div>
        
        <div style="position: relative; display: none; overflow: hidden;">
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

    
	<?php //Histórico.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeAdmHistorico_idParent = $idCeOrcamentosFichas;
	//$includeAdmHistorico_idParent = $idCeOrcamentos;
	$includeAdmHistorico_idTbCadastroUsuario = "";
	$includeAdmHistorico_idTbHistoricoStatusSelect = "";
	
	$includeAdmHistorico_tipoDiagramacao = "1";
	$includeAdmHistorico_limiteRegistros = "";
	?>
    <?php include "IncludeHistorico.php";?>
    <?php //----------------------?>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlOrcamentosFichasDetalhesSelect);
unset($statementOrcamentosFichasDetalhesSelect);
unset($resultadoOrcamentosFichasDetalhes);
unset($linhaOrcamentosFichasDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>