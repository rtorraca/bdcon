<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idParentAfiliacoes = $_GET["idParentAfiliacoes"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAfiliacoesIndice.php";
$variavelRetorno = "idParentAfiliacoes";
$idRetorno = $idParentAfiliacoes;
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Paginação.
if($GLOBALS['habilitarAfiliacoesSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configAfiliacoesSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_afiliacoes", "id_parent", $idParentAfiliacoes); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentAfiliacoes=" . $idParentAfiliacoes . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlAfiliacoesSelect = "";
$strSqlAfiliacoesSelect .= "SELECT ";
//$strSqlAfiliacoesSelect .= "* ";
$strSqlAfiliacoesSelect .= "id, ";
$strSqlAfiliacoesSelect .= "id_tb_categorias, ";
$strSqlAfiliacoesSelect .= "n_classificacao, ";
$strSqlAfiliacoesSelect .= "afiliacao, ";
$strSqlAfiliacoesSelect .= "descricao, ";
$strSqlAfiliacoesSelect .= "tipo_cobranca, ";
$strSqlAfiliacoesSelect .= "valor, ";
$strSqlAfiliacoesSelect .= "ativacao, ";
$strSqlAfiliacoesSelect .= "imagem, ";
$strSqlAfiliacoesSelect .= "configuracao_periodo_contratacao, ";
$strSqlAfiliacoesSelect .= "configuracao_complementar ";

//Paginação (subquery).
if($GLOBALS['habilitarAfiliacoesSitePaginacao'] == "1"){
	$strSqlAfiliacoesSelect .= ", (SELECT COUNT(id) ";
	$strSqlAfiliacoesSelect .= "FROM tb_afiliacoes ";
	$strSqlAfiliacoesSelect .= "WHERE id <> 0 ";
	if($idParentAfiliacoes <> "")
	{
		$strSqlAfiliacoesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	if($palavraChave <> "")
	{
		$strSqlAfiliacoesSelect .= "AND (afiliacao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		/*
		*/
		$strSqlAfiliacoesSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlAfiliacoesSelect .= ") ";
	}
	$strSqlAfiliacoesSelect .= "AND ativacao = 1 ";
	$strSqlAfiliacoesSelect .= ") totalRegistros ";
}

$strSqlAfiliacoesSelect .= "FROM tb_afiliacoes ";
$strSqlAfiliacoesSelect .= "WHERE id <> 0 ";
if($idParentAfiliacoes <> "")
{
	$strSqlAfiliacoesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($palavraChave <> "")
{
	$strSqlAfiliacoesSelect .= "AND (afiliacao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	/*
	*/
	$strSqlAfiliacoesSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlAfiliacoesSelect .= ") ";
}
$strSqlAfiliacoesSelect .= "AND ativacao = 1 ";
$strSqlAfiliacoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoAfiliacoes'] . " ";

//Paginação.
if($GLOBALS['habilitarAfiliacoesSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlAfiliacoesSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementAfiliacoesSelect = $dbSistemaConPDO->prepare($strSqlAfiliacoesSelect);

if ($statementAfiliacoesSelect !== false)
{
	if($idParentAfiliacoes <> "")
	{
		$statementAfiliacoesSelect->bindParam(':id_tb_categorias', $idParentAfiliacoes, PDO::PARAM_STR);
	}
	$statementAfiliacoesSelect->execute();
	
	/*
	$statementAfiliacoesSelect->execute(array(
		"id_tb_categorias" => $idParentAfiliacoes
	));
	*/
}
//----------

//$resultadoAfiliacoes = $dbSistemaConPDO->query($strSqlAfiliacoesSelect);
$resultadoAfiliacoes = $statementAfiliacoesSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarAfiliacoesSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoAfiliacoes[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaPalavrasChave .= $tituloLinkAtual . ", ";

if(!empty($resultadoAfiliacoes))
{
	//Loop pelos resultados.
	foreach($resultadoAfiliacoes as $linhaAfiliacoes)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['afiliacao']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['afiliacao']) . ", ";
		//echo "loop=" . $linhaProdutos['produto'] . "<br />";
	}
}

//Retirada da vírgula do final.
if($metaDescricao <> "")
{
	$metaDescricao = substr($metaDescricao, 0, strlen($metaDescricao) - 2);
}
if($metaPalavrasChave <> "")
{
	$metaPalavrasChave = substr($metaPalavrasChave, 0, strlen($metaPalavrasChave) - 2);
}

//Retirada de código HTML.
$metaDescricao = Funcoes::RemoverHTML01($metaDescricao);
$metaPalavrasChave = Funcoes::RemoverHTML01($metaPalavrasChave);
//$metaPalavrasChave = strip_tags($metaPalavrasChave);

//Limitação de caractéres.
$metaTitulo = Funcoes::LimitadorCatecteres($metaTitulo, 60);
$metaDescricao = Funcoes::LimitadorCatecteres($metaDescricao, 160);
$metaPalavrasChave = Funcoes::LimitadorCatecteres($metaPalavrasChave, 100);
//----------

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; //Verificar acentuação. ?>
	<?php //echo Funcoes::ConteudoMascaraLeitura($metaTitulo); //Verificar acentuação. ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
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
    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>
    
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block; overflow: hidden;">
		<?php
        if (empty($resultadoAfiliacoes))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
			<?php
			$countTabelaFundo = 0;
			
			
			//Loop pelos resultados.
			foreach($resultadoAfiliacoes as $linhaAfiliacoes)
			{
            ?>
                    <div class="AfiliacoesIndiceContainer">

                        <!--Título -->
                        <div class="AfiliacoesIndiceTituloFundo">
                            <div class="AfiliacaoIndiceTitulo">
                                <h2 style="position: relative; display: block; margin: 0px; padding: 0px; font-size: inherit; font-weight: inherit; line-height: inherit;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['afiliacao']);?>
                                </h2>
                            </div>
                        </div>

                        <!--Imagem -->
                        <?php if($GLOBALS['ativacaoAfiliacoesImagem'] == 1){ ?>
							<?php if(!empty($linhaAfiliacoes['imagem'])){ ?>
                                <div class="AfiliacoesImagemIndice">
                                    <?php //Sem pop-up. ?>
                                    <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaAfiliacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['produto']); ?>" />
                                    <?php } ?>
                                
                                    <?php //SlimBox 2 - JQuery. ?>
                                    <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                        <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaAfiliacoes['imagem'];?>" rel="lightbox" title="">
                                            <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaAfiliacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['produto']); ?>" />
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php if($GLOBALS['habilitarAfiliacoesDescricao'] == 1){ ?>
                        <div class="AfiliacoesIndiceConteudo">
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['descricao']);?>
                        </div>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarAfiliacoesPeriodoContratacao'] == 1){ ?>
                        <div class="AfiliacoesIndiceConteudo">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacao"); ?>: 
                            </strong>
                            <?php echo $linhaAfiliacoes['configuracao_periodo_contratacao'];?> 
                            <?php if($GLOBALS['configAfiliacoesPeriodoContratacao'] == "yyyy"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacaoYYYY"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configAfiliacoesPeriodoContratacao'] == "m"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacaoM"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configAfiliacoesPeriodoContratacao'] == "d"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacaoD"); ?>
                            <?php } ?>
                        </div>
                        <?php } ?>

                        <div class="AfiliacoesIndiceValor">
							<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                            <?php if($linhaAfiliacoes['descricao'] == "0"){ ?>
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesValor0"); ?>
                            <?php } ?>
                            <?php if($linhaAfiliacoes['descricao'] <> "0"){ ?>
                            	<?php echo Funcoes::mascaraValorLer($linhaAfiliacoes['valor']);?>
                            <?php } ?>
                            <?php //echo Funcoes::mascaraValorLer($linhaAfiliacoes['valor']);?>
                        </div>

                        <div style="float: right;">
                        	<a href="<?php echo $GLOBALS['configUrlSSL'];?>/<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteCadastro.php?idItem=<?php echo $linhaAfiliacoes['id'];?>&quantidadeAfiliacao=1&idTbCadastro=3478&idTipoCadastro=<?php echo $GLOBALS['configIdCadastroUsuarioVendedor'];?>&idAtividadesCadastro=<?php echo $linhaAfiliacoes['configuracao_complementar'];?>&idTbCadastroTemporario=<?php echo urlencode(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario"));?>" target="_top" class="AfiliacoesIndiceLinks">
                            	Selecionar e ir direto para o cadastro.
                            </a>

                        	<a href="#">
                                <img src="img/btoAfiliacoesSelecionar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>" />
                            </a>
                        </div>

                        <div class="AfiliacoesSeparador1">

                        </div>
                    </div>
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
        <?php } ?>
    </div>
    <?php //**************************************************************************************?>


	<?php //Diagramação 2 - tabela.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: none; overflow: hidden;">
		<?php
        if (empty($resultadoAfiliacoes))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['habilitarAfiliacoesNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['ativacaoAfiliacoesImagem'] == 1){ ?>
                <td width="1" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesAfiliacao"); ?>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;
			  
			  
                //Loop pelos resultados.
                foreach($resultadoAfiliacoes as $linhaAfiliacoes)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <?php if($GLOBALS['habilitarAfiliacoesNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaAfiliacoes['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['ativacaoAfiliacoesImagem'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php if(!empty($linhaAfiliacoes['imagem'])){ ?>
                            <?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaAfiliacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['produto']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaAfiliacoes['imagem'];?>" rel="lightbox" title="">
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaAfiliacoes['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['produto']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['afiliacao']);?>
                    </div>
                    <?php if($GLOBALS['habilitarAfiliacoesDescricao'] == 1){ ?>
                        <div class="AdmTexto01">
                            <?php if($linhaAfiliacoes['descricao'] <> ""){ ?>
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesDescricao"); ?>: 
                                </strong>
                                <br />
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaAfiliacoes['descricao']);?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarAfiliacoesPeriodoContratacao'] == 1){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacao"); ?>: 
                            </strong>
                            <?php echo $linhaAfiliacoes['configuracao_periodo_contratacao'];?>
                            <?php if($GLOBALS['configAfiliacoesPeriodoContratacao'] == "yyyy"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacaoYYYY"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configAfiliacoesPeriodoContratacao'] == "m"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacaoM"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configAfiliacoesPeriodoContratacao'] == "d"){ ?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAfiliacoesPeriodoContratacaoD"); ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteAfiliacoesDetalhes.php?idTbAfiliacoes=<?php echo $linhaAfiliacoes['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaAfiliacoes['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaAfiliacoes['id'];?>&statusAtivacao=<?php echo $linhaAfiliacoes['ativacao'];?>&strTabela=tb_afiliacoes&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                            <?php if($linhaAfiliacoes['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaAfiliacoes['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaAfiliacoes['ativacao'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmAfiliacoesEditar.php?idTbAfiliacoes=<?php echo $linhaAfiliacoes['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaAfiliacoes['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaAfiliacoes['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaAfiliacoes['id'];?>" class="AdmCampoRadioButton01" />
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
        <?php } ?>
        
        <?php //Paginação. ?>
        <?php //************************************************************************************** ?>
        <?php if($GLOBALS['habilitarAfiliacoesSitePaginacao'] == "1"){ ?>
            <?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
                <div align="center" class="AdmTexto01">
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                        </a>
                    </div>
                    
                    <?php if($paginacaoNumero > 1){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    
                    <?php //Numeração de páginas. ?>
                    <?php if($GLOBALS['habilitarPaginasSitePaginacaoNumeracao'] == "1"){ ?>
                        <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                            <div style="position: relative; display: inline; margin: 2px;">
                                <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                    <?php echo $countPaginas; ?>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                            </a>
                        </div>
                    <?php } ?>
                    
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                        </a>
                    </div>
                </div>
                
                <?php //Contagem de páginas. ?>
                <div align="center" class="AdmTexto01">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                    <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
                </div>
            <?php } ?>
        <?php } ?>
        <?php //************************************************************************************** ?>
    </div>
    <?php //**************************************************************************************?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlAfiliacoesSelect);
unset($statementAfiliacoesSelect);
unset($resultadoAfiliacoes);
unset($linhaAfiliacoes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>