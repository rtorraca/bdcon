<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbAfiliacoes = $_GET["idTbAfiliacoes"];
$idParentAfiliacoes = DbFuncoes::GetCampoGenerico01($idTbAfiliacoes, "tb_afiliacoes", "id_tb_categorias");

$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer()), 2);

$tituloLinkAtual = "";
$tituloCategoriaAtual = DbFuncoes::GetCampoGenerico01($idParentAfiliacoes, "tb_categorias", "categoria");
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAfiliacoesDetalhes.php";
//$paginaRetornoExclusao = "SiteProdutosDetalhes.php";
$variavelRetorno = "idTbAfiliacoes";
$idRetorno = $idTbAfiliacoes;
//$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentAfiliacoes=" . $idParentAfiliacoes . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
"&idRetorno=" . $idRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlAfiliacoesDetalhesSelect = "";
$strSqlAfiliacoesDetalhesSelect .= "SELECT ";
//$strSqlAfiliacoesDetalhesSelect .= "* ";
$strSqlAfiliacoesDetalhesSelect .= "id, ";
$strSqlAfiliacoesDetalhesSelect .= "id_tb_categorias, ";
$strSqlAfiliacoesDetalhesSelect .= "n_classificacao, ";
$strSqlAfiliacoesDetalhesSelect .= "afiliacao, ";
$strSqlAfiliacoesDetalhesSelect .= "descricao, ";
$strSqlAfiliacoesDetalhesSelect .= "tipo_cobranca, ";
$strSqlAfiliacoesDetalhesSelect .= "valor, ";
$strSqlAfiliacoesDetalhesSelect .= "ativacao, ";
$strSqlAfiliacoesDetalhesSelect .= "imagem, ";
$strSqlAfiliacoesDetalhesSelect .= "configuracao_periodo_contratacao, ";
$strSqlAfiliacoesDetalhesSelect .= "configuracao_complementar ";
$strSqlAfiliacoesDetalhesSelect .= "FROM tb_afiliacoes ";
$strSqlAfiliacoesDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlAfiliacoesDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlAfiliacoesDetalhesSelect .= "AND id = :id ";
//$strSqlAfiliacoesDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


//Parâmetros.
//----------
$statementAfiliacoesDetalhesSelect = $dbSistemaConPDO->prepare($strSqlAfiliacoesDetalhesSelect);

if ($statementAfiliacoesDetalhesSelect !== false)
{
	$statementAfiliacoesDetalhesSelect->execute(array(
		"id" => $idTbAfiliacoes
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoAfiliacoesDetalhes = $dbSistemaConPDO->query($strSqlAfiliacoesDetalhesSelect);
$resultadoAfiliacoesDetalhes = $statementAfiliacoesDetalhesSelect->fetchAll();

if (empty($resultadoAfiliacoesDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoAfiliacoesDetalhes as $linhaAfiliacoesDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbAfiliacoesId = $linhaAfiliacoesDetalhes['id'];
		$tbAfiliacoesIdTbCategorias = $linhaAfiliacoesDetalhes['id_tb_categorias'];
		$tbAfiliacoesNClassificacao = $linhaAfiliacoesDetalhes['n_classificacao'];

		$tbAfiliacoesAfiliacao = Funcoes::ConteudoMascaraLeitura($linhaAfiliacoesDetalhes['afiliacao']);
		$tbAfiliacoesDescricao = Funcoes::ConteudoMascaraLeitura($linhaAfiliacoesDetalhes['descricao']);
		$tbAfiliacoesTipoCobranca = $linhaAfiliacoesDetalhes['tipo_cobranca'];
		$tbAfiliacoesValor = Funcoes::MascaraValorLer($linhaAfiliacoesDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbAfiliacoesAtivacao = $linhaAfiliacoesDetalhes['ativacao'];
		$tbAfiliacoesImagem = $linhaAfiliacoesDetalhes['imagem'];

		$tbAfiliacoesConfiguracaoPeriodoContratacao = $linhaAfiliacoesDetalhes['configuracao_periodo_contratacao'];
		$tbAfiliacoesConfiguracaoComplementar = $linhaAfiliacoesDetalhes['configuracao_complementar'];

		//Verificação de erro.
		//echo "tbAfiliacoesTipoCobranca=" . $tbAfiliacoesTipoCobranca . "<br>";
		//echo "tbAfiliacoesProcesso=" . $tbAfiliacoesProcesso . "<br>";
	}
}
//----------


//Definição de variáveis.
$tituloLinkAtual = Funcoes::RemoverHTML01($tbAfiliacoesAfiliacao);


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = Funcoes::RemoverHTML01($tbAfiliacoesDescricao);
$metaPalavrasChave = $metaDescricao;
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
    <meta property="og:url" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/SiteAfiliacoesDetalhes.php?idTbAfiliacoes=" . $idTbAfiliacoes; ?>" />
    <meta property="og:description" content="<?php echo $metaDescricao; ?>"><?php //155 caracteres - Funcoes.LimitadorCatecteres($metaDescricao, 155).?>
    <?php if($tbAfiliacoesImagem <> ""){ ?>
    <meta property="og:image" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/r" . $tbAfiliacoesImagem; ?>"><?php //JPG ou PNG, menos que 300k e dimensão mínima de 300x200 pixels.?>
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


	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block;">
    	
		<?php //Imagem Principal.?>
        <?php if($tbAfiliacoesImagem <> ""){ ?>
            <div align="center">
                <?php //SlimBox 2 - JQuery.?>
                <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                    <div class="AfiliacoesImagemDetalhes"><a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbAfiliacoesImagem;?>" rel="lightbox" title="<?php echo $tbAfiliacoesAfiliacao; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $tbAfiliacoesImagem;?>" alt="<?php echo $tbAfiliacoesAfiliacao; ?>" /></a></div>
                <?php } ?>
                
                <?php //Pop-up div com comentários.?>
                <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>

                <?php } ?>
            </div>
        <?php } ?>
        
        <table border="0" cellspacing="4" cellpadding="0">
            <tr valign="top">
                <td>
                    <div class="AfiliacoesDetalhesConteudo">
                        <strong>
                             <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="AfiliacoesDetalhesConteudo">
                    	<?php echo $tbAfiliacoesAfiliacao;?>
                    </div>
                </td>
            </tr>
    
            <tr valign="top">
                <td>
                    <div class="AfiliacoesDetalhesConteudo">
                        <strong>
                            <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTipo");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="AfiliacoesDetalhesConteudo">
						<?php echo $tbAfiliacoesDescricao;?>
                    </div>
                </td>
            </tr>
    
            <tr valign="top">
                <td>
                    <div class="AfiliacoesDetalhesConteudo">
                        <strong>
                             <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="AfiliacoesDetalhesConteudo">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig");?> 
                        <?php echo $tbAfiliacoesValor;?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php //**************************************************************************************?>


	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbAfiliacoesId;
	$includeArquivosImagens_tipoVisualizacao = "1";
	
	$includeArquivosImagens_limiteRegistros = "";
	$includeArquivosImagens_nImagensVisivelScroll = "3";
	$includeArquivosImagens_configImagemZoom = "1";
	?>
    
    <?php include "IncludeArquivosImagens.php";?>
    <?php //----------------------?>
    
    
	<?php //Arquivos complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivos_idTbArquivos = $tbAfiliacoesId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
    
    
	<?php //Conteúdo.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeConteudo_idParentConteudo = $tbAfiliacoesId;
	$includeConteudo_idTbConteudo = "";
	$includeConteudo_tipoConteudo = "";
	
	$includeConteudo_configTipoDiagramacao = "1";
	$includeConteudo_configConteudoNRegistros = "";
	$includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
	?>
    
    <?php include "IncludeConteudo.php";?>
    <?php //----------------------?>


    <div align="center">
		<a href="javascript:history.go(-1);">
			<img src="img/btoVoltar.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>" />
		</a>
    </div>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlAfiliacoesDetalhesSelect);
unset($statementAfiliacoesDetalhesSelect);
unset($resultadoAfiliacoesDetalhes);
unset($linhaAfiliacoesDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>