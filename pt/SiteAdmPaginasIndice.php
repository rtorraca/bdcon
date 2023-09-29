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
$idParentPaginas = $_GET["idParentPaginas"];

$palavraChave = $_GET["palavraChave"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmPaginasIndice.php";
$paginaRetornoExclusao = "SiteAdmPaginasEditar.php";
$variavelRetorno = "idParentPaginas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Paginação.
if($GLOBALS['habilitarPaginasSistemaPaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configPaginasSistemaPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_paginas", "id_parent", $idParentPaginas); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentPaginas=" . $idParentPaginas . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPaginasSelect = "";
$strSqlPaginasSelect .= "SELECT ";
//$strSqlPaginasSelect .= "* ";
$strSqlPaginasSelect .= "id, ";
$strSqlPaginasSelect .= "id_parent, ";
$strSqlPaginasSelect .= "id_tb_cadastro1, ";
$strSqlPaginasSelect .= "id_tb_cadastro2, ";
$strSqlPaginasSelect .= "id_tb_cadastro3, ";
$strSqlPaginasSelect .= "n_classificacao, ";
$strSqlPaginasSelect .= "data_criacao, ";
$strSqlPaginasSelect .= "titulo, ";
$strSqlPaginasSelect .= "descricao, ";
$strSqlPaginasSelect .= "palavras_chave, ";
$strSqlPaginasSelect .= "url1, ";
$strSqlPaginasSelect .= "url2, ";
$strSqlPaginasSelect .= "url3, ";
$strSqlPaginasSelect .= "url4, ";
$strSqlPaginasSelect .= "url5, ";
$strSqlPaginasSelect .= "imagem, ";
$strSqlPaginasSelect .= "arquivo1, ";
$strSqlPaginasSelect .= "arquivo2, ";
$strSqlPaginasSelect .= "arquivo3, ";
$strSqlPaginasSelect .= "arquivo4, ";
$strSqlPaginasSelect .= "arquivo5, ";

$strSqlPaginasSelect .= "informacao_complementar1, ";
$strSqlPaginasSelect .= "informacao_complementar2, ";
$strSqlPaginasSelect .= "informacao_complementar3, ";
$strSqlPaginasSelect .= "informacao_complementar4, ";
$strSqlPaginasSelect .= "informacao_complementar5, ";
$strSqlPaginasSelect .= "informacao_complementar6, ";
$strSqlPaginasSelect .= "informacao_complementar7, ";
$strSqlPaginasSelect .= "informacao_complementar8, ";
$strSqlPaginasSelect .= "informacao_complementar9, ";
$strSqlPaginasSelect .= "informacao_complementar10, ";
$strSqlPaginasSelect .= "informacao_complementar11, ";
$strSqlPaginasSelect .= "informacao_complementar12, ";
$strSqlPaginasSelect .= "informacao_complementar13, ";
$strSqlPaginasSelect .= "informacao_complementar14, ";
$strSqlPaginasSelect .= "informacao_complementar15, ";

$strSqlPaginasSelect .= "ativacao, ";
$strSqlPaginasSelect .= "ativacao1, ";
$strSqlPaginasSelect .= "ativacao2, ";
$strSqlPaginasSelect .= "ativacao3, ";
$strSqlPaginasSelect .= "ativacao4, ";

$strSqlPaginasSelect .= "n_visitas, ";
$strSqlPaginasSelect .= "acesso_restrito ";

//Paginação (sbuquery).
if($GLOBALS['habilitarPaginasSistemaPaginacao'] == "1"){
	$strSqlPaginasSelect .= ", (SELECT COUNT(id) ";
	$strSqlPaginasSelect .= "FROM tb_paginas ";
	$strSqlPaginasSelect .= "WHERE id <> 0 ";
	if($idParentPaginas <> "")
	{
		$strSqlPaginasSelect .= "AND id_parent = :id_parent ";
	}
	if($palavraChave <> "")
	{
		$strSqlPaginasSelect .= "AND (titulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		
		$strSqlPaginasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		$strSqlPaginasSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
		
		$strSqlPaginasSelect .= ") ";
	}
	$strSqlPaginasSelect .= ") totalRegistros ";
}

$strSqlPaginasSelect .= "FROM tb_paginas ";
$strSqlPaginasSelect .= "WHERE id <> 0 ";
if($idParentPaginas <> "")
{
	$strSqlPaginasSelect .= "AND id_parent = :id_parent ";
}
if($palavraChave <> "")
{
	$strSqlPaginasSelect .= "AND (titulo LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	
	$strSqlPaginasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR palavras_chave LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR url1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR url2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR url3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar11 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar12 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar13 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar14 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlPaginasSelect .= "OR informacao_complementar15 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	
	$strSqlPaginasSelect .= ") ";
}
//$strSqlPaginasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPaginas'] . " ";
//if($GLOBALS['habilitarPaginasClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPaginas) <> "")
//{
	//$strSqlPaginasSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPaginas) . " ";
	
//}else{
	$strSqlPaginasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPaginas'] . " ";
//}

//Paginação.
if($GLOBALS['habilitarPaginasSistemaPaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlPaginasSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}

$statementPaginasSelect = $dbSistemaConPDO->prepare($strSqlPaginasSelect);

if ($statementPaginasSelect !== false)
{
	$statementPaginasSelect->execute(array(
		"id_parent" => $idParentPaginas
	));
}

//$resultadoPaginas = $dbSistemaConPDO->query($strSqlPaginasSelect);
$resultadoPaginas = $statementPaginasSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarPaginasSistemaPaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoPaginas[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentCadastro <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelPaginasAdministrar");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
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
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelPaginasAdministrar"); ?>
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


    <?php
	if (empty($resultadoPaginas))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemPaginasVazio"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formPaginasAcoes" id="formPaginasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_paginas" />
            <input name="idParentPaginas" id="idParentPaginas" type="hidden" value="<?php echo $idParentPaginas; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
              	<?php if($GLOBALS['habilitarPaginasNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
                <td width="1" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePagina"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPaginasAcessoRestrito'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTbFundoEscuro TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;

                //Loop pelos resultados.
                foreach($resultadoPaginas as $linhaPaginas)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
              	<?php if($GLOBALS['habilitarPaginasNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPaginas['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
              	<?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php if(!empty($linhaPaginas['imagem'])){ ?>
							<?php //Sem pop-up. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                            <?php } ?>
                        
                            <?php //SlimBox 2 - JQuery. ?>
                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                <a href="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaPaginas['imagem'];?>" rel="lightbox" title="">
                                    <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                                </a>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>
                    </div>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao']);?>
                    </div>
                    <div class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarPaginasFotos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirFotos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasVideos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirVideos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasArquivos'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirArquivos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasZip'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=4&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirZip"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    	<?php if($GLOBALS['habilitarPaginasSwfs'] == 1){ ?>
                            [
                            <a href="SiteAdmArquivosIndice.php?idParent=<?php echo $linhaPaginas['id'];?>&tipoArquivo=5&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirSWFs"); ?>
                            </a>
                            ] 
                        <?php } ?>
                        
                    	<?php if($GLOBALS['habilitarPaginasProcessos'] == 1){ ?>
                            [
                            <a href="SiteAdmProcessosIndice.php?idParentProcessos=<?php echo $linhaPaginas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirProcessos"); ?>
                            </a>
                            ] 
                        <?php } ?>
                    </div>
                    <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro1'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPaginasVinculo2'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configPaginasVinculo2Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarPaginasVinculo3'] == 1){ ?>
						<?php if($linhaPaginas['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo htmlentities($GLOBALS['configPaginasVinculo3Nome']); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPaginas['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
								<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPaginas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPaginasAcessoRestrito'] == 1){ ?>
                <td class="<?php if($linhaPaginas['acesso_restrito'] == 0){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPaginas['id'];?>&statusAtivacao=<?php echo $linhaPaginas['acesso_restrito'];?>&strTabela=tb_paginas&strCampo=acesso_restrito<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPaginas['acesso_restrito'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso0"); ?>
                            <?php } ?>
                        	<?php if($linhaPaginas['acesso_restrito'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAcesso1"); ?>
                            <?php } ?>
                        </a>
                        <?php //echo $linhaPaginas['acesso_restrito'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaPaginas['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPaginas['id'];?>&statusAtivacao=<?php echo $linhaPaginas['ativacao'];?>&strTabela=tb_paginas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPaginas['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPaginas['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPaginas['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmPaginasEditar.php?idTbPaginas=<?php echo $linhaPaginas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPaginas['id'];?>" class="AdmCampoCheckBox01" />
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
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarPaginasSistemaPaginacao'] == "1"){ ?>
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
                <?php if($GLOBALS['habilitarPaginasSistemaPaginacaoNumeracao'] == "1"){ ?>
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


	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formPaginas').validate({ //Inicialização do plug-in.
			
			
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
					}//,
					//field2: {
						//required: true,
						//minlength: 5
					//}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
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
    <form name="formPaginas" id="formPaginas" action="SiteAdmPaginasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasTbPaginas"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo1'], $GLOBALS['configIdTbTipoPaginasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo1'], $GLOBALS['configPaginasVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasVinculo1); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPaginasVinculo1[$countArray][0];?>"><?php echo $arrPaginasVinculo1[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo2'], $GLOBALS['configIdTbTipoPaginasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo2'], $GLOBALS['configPaginasVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPaginasVinculo2[$countArray][0];?>"><?php echo $arrPaginasVinculo2[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo3'], $GLOBALS['configIdTbTipoPaginasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo3'], $GLOBALS['configPaginasVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPaginasVinculo3[$countArray][0];?>"><?php echo $arrPaginasVinculo3[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePagina"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarPaginasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="titulo" id="titulo" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarPaginasNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="0" />
                    </div>
                </td>
                <?php } ?>
            </tr>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginaDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao").cleditor(
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
                            <textarea name="descricao" id="descricao"></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao").cleditor(
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
                            <textarea name="descricao" id="descricao"></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarPaginasPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasURL1Titulo']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url1" id="url1" class="AdmCampoTextoMultilinhaURL"></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico01[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico01[]" name="idsPaginasFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico01[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico01[]" name="idsPaginasFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico01[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico01)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 13);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico02[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico02[]" name="idsPaginasFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico02[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico02[]" name="idsPaginasFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico02[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico02)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico03[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico03[]" name="idsPaginasFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico03[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico03[]" name="idsPaginasFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico03[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico03)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico04[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico04[]" name="idsPaginasFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico04[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico04[]" name="idsPaginasFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico04[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico04)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico05[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico05[]" name="idsPaginasFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico05[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico05[]" name="idsPaginasFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico05[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico05)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico06[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico06[]" name="idsPaginasFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico06[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico06[]" name="idsPaginasFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico06[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico06)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico07[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico07[]" name="idsPaginasFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico07[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico07[]" name="idsPaginasFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico07[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico07)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico08[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico08[]" name="idsPaginasFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico08[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico08[]" name="idsPaginasFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico08[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico08)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico09[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico09[]" name="idsPaginasFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico09[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico09[]" name="idsPaginasFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico09[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico09)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico10[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPaginasFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico10[]" name="idsPaginasFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico10[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico10[]" name="idsPaginasFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico10[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico10)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc6'] == 1){ ?>
                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
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
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
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
                                <textarea name="informacao_complementar6" id="informacao_complementar6"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc2'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
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
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
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
                                <textarea name="informacao_complementar7" id="informacao_complementar7"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
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
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
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
                                <textarea name="informacao_complementar8" id="informacao_complementar8"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
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
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
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
                                <textarea name="informacao_complementar9" id="informacao_complementar9"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
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
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
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
                                <textarea name="informacao_complementar10" id="informacao_complementar10"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
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
                                <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
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
                                <textarea name="informacao_complementar11" id="informacao_complementar11"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
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
                                <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
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
                                <textarea name="informacao_complementar12" id="informacao_complementar12"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
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
                                <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
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
                                <textarea name="informacao_complementar13" id="informacao_complementar13"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
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
                                <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
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
                                <textarea name="informacao_complementar14" id="informacao_complementar14"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
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
                                <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
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
                                <textarea name="informacao_complementar15" id="informacao_complementar15"></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

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
            
			<?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01">
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $idParentPaginas; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPaginasSelect);
unset($statementPaginasSelect);
unset($resultadoPaginas);
unset($linhaPaginas);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>