<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis
$idParentPaginas = $_GET["idParentPaginas"];
//$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
//if($idParentCategoriasRaiz == "")
//{
	//$idParentCategoriasRaiz = 0;
//}

$palavraChave = $_GET["palavraChave"];

$paginaRetorno = "SitePaginasIndice.php";
$paginaRetornoExclusao = "SitePaginasEditar.php";
$variavelRetorno = "idParentPaginas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];

//Paginação.
if($GLOBALS['habilitarPaginasSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configPaginasSitePaginacaoNRegistros'];
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
$strSqlPaginasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPaginas'] . " ";

//Paginação.
if($GLOBALS['habilitarPaginasSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlPaginasSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Componentes e parâmetros.
//----------
$statementPaginasSelect = $dbSistemaConPDO->prepare($strSqlPaginasSelect);

if ($statementPaginasSelect !== false)
{
	$statementPaginasSelect->execute(array(
		"id_parent" => $idParentPaginas
	));
}

//$resultadoPaginas = $dbSistemaConPDO->query($strSqlPaginasSelect);
$resultadoPaginas = $statementPaginasSelect->fetchAll();
//----------


//Paginação.
if($GLOBALS['habilitarPaginasSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoPaginas[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentPaginas <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentPaginas, "tb_categorias", "categoria");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
$metaPalavrasChave .= $tituloLinkAtual . ", ";

if(!empty($resultadoPaginas))
{
	//Loop pelos resultados.
	foreach($resultadoPaginas as $linhaPaginas)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']) . ", ";
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
//echo "idParentPaginas=" . $idParentPaginas . "<br />";
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
		<?php //Diagramação 1.?>
        <?php //**************************************************************************************?>
        <div align="center" style="position: relative; display: block;">
            <?php
            //Loop pelos resultados.
            foreach($resultadoPaginas as $linhaPaginas)
            {
            ?>

                <div class="PaginasIndiceContainer">
                
                    <?php //Imagem.?>
                    <?php if(!empty($linhaPaginas['imagem'])){ ?>
                        <div class="PaginasImagemIndice">
                            <?php //Sem pop-up. ?>
                            <?php //if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                <a href="SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id']; ?>">
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>r<?php echo $linhaPaginas['imagem'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" />
                                </a>
                            <?php //} ?>
                        </div>
                    <?php } ?>
                
                    <?php if($GLOBALS['configPaginasImagemPlaceholder'] == 1){ ?>
                        <?php if(empty($linhaPaginas['imagem'])){ ?>
                            <div class="PaginasImagemIndice">
                            	<?php //OBS: fazer função para resgatar a dimensão (w e h).?>
                                <table bgcolor="#ccc" width="<?php echo $GLOBALS['$arrImagemPaginas'][2][1];?>" height="<?php echo $GLOBALS['$arrImagemPaginas'][2][2];?>" border="0" cellspacing="0">
                                  <tr align="center" valign="middle">
                                    <td>
                                        <a href="SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id']; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>icone_imgem01.png" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']); ?>" /></a>
                                        <br />
                                        <br />
                                        <div class="AdmTexto01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemImagemPlaceholder");?>
                                        </div>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    
                    <?php //Título.?>
                    <h2 style="/*position: absolute;*/ display:inline; margin: 0px; padding: 0px; font-size: inherit; float: left;">
                        <a href="SitePaginasDetalhes.php?idTbPaginas=<?php echo $linhaPaginas['id']; ?>" class="PaginasIndiceTitulo">
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['titulo']);?>
                        </a>
                    </h2>
                    
                    <div class="PaginasIndiceConteudo">
                        <?php //if($GLOBALS['ConfigProdutosDescricao01LimiteCaracteres'] == 0){ ?>
                            <?php //echo Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao']);?>
                        <?php //}else{ ?>
                            <?php echo Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao'])), 90);?>
                            <?php if(strlen(Funcoes::RemoverHTML01(Funcoes::ConteudoMascaraLeitura($linhaPaginas['descricao']))) > 90){ ?>
                                ...
                            <?php } ?>
                        <?php //} ?>
                    </div>

                </div>

            <?php } ?>
        </div>
		<?php //**************************************************************************************?>
	<?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarPaginasPaginacaoSimples'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="Texto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarPaginasSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="Links03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="Links03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="Texto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>

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