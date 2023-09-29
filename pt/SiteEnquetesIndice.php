<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
//LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idParentEnquetes = $_GET["idParentEnquetes"];
$tipoEnquete = $_GET["tipoEnquete"];

$idTbCadastroUsuarioLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idsTbCadastroUsuarioLogado = $_GET["idsTbCadastroUsuarioLogado"];
$idTbCadastroUsuario = $_GET["idTbCadastroUsuario"];
$idsTbCadastroUsuario = $_GET["idsTbCadastroUsuario"];

$palavraChave = $_GET["palavraChave"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteEnquetesIndice.php";
//$variavelRetorno = "idParentEnquetes";
//$idRetorno = $idParentEnquetes;
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];
$mensagemAlerta = $_GET["mensagemAlerta"];


//Paginação.
if($GLOBALS['habilitarEnquetesFrontendPaginacaoSimples'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configEnquetesFrontendPaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_produtos", "id_parent", $idParentProdutos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentEnquetes=" . $idParentEnquetes . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlEnquetesSelect = "";
$strSqlEnquetesSelect .= "SELECT ";
//$strSqlEnquetesSelect .= "* ";
$strSqlEnquetesSelect .= "id, ";
$strSqlEnquetesSelect .= "id_tb_categorias, ";
$strSqlEnquetesSelect .= "id_tb_cadastro, ";
$strSqlEnquetesSelect .= "tipo_enquete, ";
$strSqlEnquetesSelect .= "n_classificacao, ";
$strSqlEnquetesSelect .= "data_enquete, ";
$strSqlEnquetesSelect .= "descricao, ";
$strSqlEnquetesSelect .= "ativacao, ";
$strSqlEnquetesSelect .= "imagem, ";
$strSqlEnquetesSelect .= "resposta ";

//Paginação (subquery).
if($GLOBALS['habilitarEnquetesFrontendPaginacaoSimples'] == "1"){
	$strSqlEnquetesSelect .= ", (SELECT COUNT(id) ";
	$strSqlEnquetesSelect .= "FROM tb_enquetes ";
	$strSqlEnquetesSelect .= "WHERE id <> 0 ";
	$strSqlEnquetesSelect .= "AND ativacao = 1 ";
	if($idParentEnquetes <> "")
	{
		$strSqlEnquetesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	}
	$strSqlEnquetesSelect .= ") totalRegistros ";
}

$strSqlEnquetesSelect .= "FROM tb_enquetes ";
$strSqlEnquetesSelect .= "WHERE id <> 0 ";
$strSqlEnquetesSelect .= "AND ativacao = 1 ";
if($idParentEnquetes <> "")
{
	$strSqlEnquetesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
$strSqlEnquetesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoEnquetes'] . " ";

//Paginação.
if($GLOBALS['habilitarEnquetesFrontendPaginacaoSimples'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlEnquetesSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//----------


//Parâmetros.
//----------
$statementEnquetesSelect = $dbSistemaConPDO->prepare($strSqlEnquetesSelect);

if ($statementEnquetesSelect !== false)
{
	if($idParentEnquetes <> "")
	{
		$statementEnquetesSelect->bindParam(':id_tb_categorias', $idParentEnquetes, PDO::PARAM_STR);
	}
	$statementEnquetesSelect->execute();
	/*
	$statementEnquetesSelect->execute(array(
		"id_tb_categorias" => $idParentEnquetes
	));
	*/
}
//----------


//$resultadoEnquetes = $dbSistemaConPDO->query($strSqlEnquetesSelect);
$resultadoEnquetes = $statementEnquetesSelect->fetchAll();


//Paginação.
if($GLOBALS['habilitarEnquetesFrontendPaginacaoSimples'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoEnquetes[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Definição de variáveis.
if($idParentEnquetes <> ""){
	$tituloLinkAtual = DbFuncoes::GetCampoGenerico01($idParentEnquetes, "tb_categorias", "categoria");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}



//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaPalavrasChave .= $tituloLinkAtual . ", ";

if(!empty($resultadoEnquetes))
{
	//Loop pelos resultados.
	foreach($resultadoEnquetes as $linhaEnquetes)
	{
		$metaDescricao .= Funcoes::ConteudoMascaraLeitura($linhaEnquetes['descricao']) . ", ";
		$metaPalavrasChave .= Funcoes::ConteudoMascaraLeitura($linhaEnquetes['descricao']) . ", ";
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
//echo "metaTitulo=" . $metaTitulo . "<br />";
//echo "metaPalavrasChave=" . $metaPalavrasChave . "<br />";
//echo "idTbCadastroUsuarioLogado=" . $idTbCadastroUsuarioLogado . "<br />";
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
    
    
    <?php
	if (empty($resultadoEnquetes))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemEnquetesVazio"); ?>
        </div>
    <?php
    }else{
    ?>
		<?php //Diagramação 1.?>
        <?php //**************************************************************************************?>
        <div style="position: relative; display: block; overflow: hidden;">
            <?php
            //Loop pelos resultados.
            foreach($resultadoEnquetes as $linhaEnquetes)
            {
            ?>
            
                <div class="EnquetesIndiceTitulo">
                    <?php echo Funcoes::ConteudoMascaraLeitura($linhaEnquetes['descricao']);?>
                    
                    <a href="SiteEnquetesDetalhes.php?idTbEnquetes=<?php echo$linhaEnquetes['id'];?>" class="EnquetesIndiceTituloLink" style="display: none;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaEnquetes['descricao']);?>
                    </a>
                </div>
                
                
                <?php //Opções.?>
				<?php //----------?>
                <?php
				$idTbEnquetes = $linhaEnquetes['id'];
				
				//Query de pesquisa.
				//----------
				$strSqlEnquetesOpcoesSelect = "";
				$strSqlEnquetesOpcoesSelect .= "SELECT ";
				//$strSqlEnquetesOpcoesSelect .= "* ";
				$strSqlEnquetesOpcoesSelect .= "id, ";
				$strSqlEnquetesOpcoesSelect .= "id_tb_enquetes, ";
				$strSqlEnquetesOpcoesSelect .= "n_classificacao, ";
				$strSqlEnquetesOpcoesSelect .= "opcao, ";
				$strSqlEnquetesOpcoesSelect .= "ativacao, ";
				$strSqlEnquetesOpcoesSelect .= "imagem, ";
				$strSqlEnquetesOpcoesSelect .= "n_votos ";
				$strSqlEnquetesOpcoesSelect .= "FROM tb_enquetes_opcoes ";
				$strSqlEnquetesOpcoesSelect .= "WHERE id <> 0 ";
				$strSqlEnquetesOpcoesSelect .= "AND id_tb_enquetes = :id_tb_enquetes ";
				$strSqlEnquetesOpcoesSelect .= "AND ativacao = 1 ";
				$strSqlEnquetesOpcoesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoEnquetesOpcoes'] . " ";
				//echo "strSqlEnquetesOpcoesSelect=" . $strSqlEnquetesOpcoesSelect . "<br />";
				//----------
				
				
				//Parâmetros.
				//----------
				$statementEnquetesOpcoesSelect = $dbSistemaConPDO->prepare($strSqlEnquetesOpcoesSelect);
				
				if ($statementEnquetesOpcoesSelect !== false)
				{
					$statementEnquetesOpcoesSelect->execute(array(
						"id_tb_enquetes" => $idTbEnquetes
					));
				}
				//----------
				
				
				//$resultadoEnquetesOpcoes = $dbSistemaConPDO->query($strSqlEnquetesOpcoesSelect);
				$resultadoEnquetesOpcoes = $statementEnquetesOpcoesSelect->fetchAll();
				
				
				//Verificação de erro - debug.
				//echo "resultadoEnquetesOpcoes=" . $resultadoEnquetesOpcoes . "<br />";
				//echo "resultadoEnquetesOpcoes=" . print_r($resultadoEnquetesOpcoes) . "<br />";
				?>
                
                
				<?php
                if (empty($resultadoEnquetesOpcoes))
                {
                    //echo "Nenhum registro encontrado";
                ?>

				<?php
                }else{
                ?>
					<?php //Registro não votado. ?>
                    <?php //************************************************************************************** ?>
                	<?php if(DbFuncoes::EnquetesLogVerificar($idTbCadastroUsuarioLogado, "count_resposta", $idTbEnquetes, "", 1) == ""){ ?>
                        <div style="position: relative; display: block; overflow: hidden;">
                            <form name="formEnquetesOpcoes<?php echo $linhaEnquetes['id']; ?>" id="formEnquetesOpcoes<?php echo $linhaEnquetes['id']; ?>" action="SiteEnquetesVotar.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoEnquetesOpcoes as $linhaEnquetesOpcoes)
                                {
                                ?>
                                    <?php //Diagramação 1.?>
                                    <?php //----------?>
                                    <div align="left" class="EnquetesOpcoesIndice">
                                        <div style="float: left; margin-right: 5px;">
                                            <!--input id="rdbtn<?php echo $linhaEnquetes['id']; ?>" type="radio" name="grupo<?php echo $linhaEnquetes['id_tb_enquetes']; ?>" value="<?php echo $linhaEnquetes['id']; ?>" /-->
                                            <input id="id_tb_opcoes<?php echo $linhaEnquetes['id']; ?>" type="radio" name="grupo<?php echo $linhaEnquetesOpcoes['id_tb_enquetes']; ?>" value="<?php echo $linhaEnquetesOpcoes['id']; ?>" />
                                        </div>
                                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaEnquetesOpcoes['opcao']);?>
                                    </div>
                                    <?php //----------?>
                                <?php } ?>
                                
                                <div align="left" style="margin-top: 20px;">
                                    <input type="image" value="Submit" src="img/btoEnquetesVotar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoComprar"); ?>" />
                                </div>
                                
                                <input name="idTbEnquetes" type="hidden" id="idTbEnquetes" value="<?php echo $idTbEnquetes;?>" />
                                <input name="idParentEnquetes" type="hidden" id="idParentEnquetes" value="<?php echo $idParentEnquetes;?>" />
                                <input name="tipoEnquete" type="hidden" id="tipoEnquete" value="<?php echo $tipoEnquete;?>" />
                                
                                <input name="idTbCadastroUsuarioLogado" type="hidden" id="idTbCadastroUsuarioLogado" value="<?php echo $idTbCadastroUsuarioLogado;?>" />
                                <input name="idsTbCadastroUsuarioLogado" type="hidden" id="idsTbCadastroUsuarioLogado" value="<?php echo $idsTbCadastroUsuarioLogado;?>" />
                                <input name="idTbCadastroUsuario" type="hidden" id="idTbCadastroUsuario" value="<?php echo $idTbCadastroUsuario;?>" />
                                <input name="idsTbCadastroUsuario" type="hidden" id="idsTbCadastroUsuario" value="<?php echo $idsTbCadastroUsuario;?>" />
                                
                                <!--input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno;?>" /-->
                                <!--input name="idRetorno" type="hidden" id="idRetorno" value="<?php echo $idRetorno;?>" /-->
                                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                                
                                <input name="palavraChave" type="hidden" id="palavraChave" value="<?php echo $palavraChave; ?>" />
                                <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                                <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                            </form>
                        </div>
					<?php } ?>
                    <?php //************************************************************************************** ?>
                    
                    
					<?php //Registro votado. ?>
                    <?php //************************************************************************************** ?>
                	<?php if(DbFuncoes::EnquetesLogVerificar($idTbCadastroUsuarioLogado, "count_resposta", $idTbEnquetes, "", 1) <> ""){ ?>
                        <div style="position: relative; display: block; overflow: hidden;">
                            
                            <?php //Enquete - resultados. ?>
                            <?php if($linhaEnquetes['tipo_enquete'] == 1){ ?>
                                <div class="AdmAlerta">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemEnquetesStatusVoto1"); ?>
                                </div>

								<?php
								//Loop pelos resultados.
								foreach($resultadoEnquetesOpcoes as $linhaEnquetesOpcoes)
								{
								?>
									<?php //Resultados. ?>
									<?php //Diagramação 1.?>
									<?php //----------?>
									<div align="left" class="EnquetesOpcoesIndice">
										<?php echo Funcoes::ConteudoMascaraLeitura($linhaEnquetesOpcoes['opcao']);?>
										<strong>
											<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteEnquetesNVotos"); ?>:&nbsp;
											<?php echo $linhaEnquetesOpcoes['n_votos']; ?>
										</strong>
									</div>
									<?php //----------?>
								<?php } ?>
                            <?php } ?>
                            
                            <?php //Quiz - resultados. ?>
                            <?php if($linhaEnquetes['tipo_enquete'] == 2){ ?>
                                <div class="AdmAlerta">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemQuestoesStatusResposta1"); ?>
                                </div>
                            
                            	<?php
								$idTbOpcoesLogCadastroUsuarioLogado = DbFuncoes::GetCampoGenerico06("tb_enquetes_log", 
																									"id_tb_opcoes", 
																									"id_tb_enquetes", 
																									$linhaEnquetes['id'], 
																									"", 
																									"", 
																									2, 
																									"", 
																									"", 
																									"id_tb_cadastro", 
																									$idTbCadastroUsuarioLogado, 
																									"", 
																									"");
								
								$tbEnquetesResposta = $linhaEnquetes['resposta'];
								?>
                                
                                <?php if($idTbOpcoesLogCadastroUsuarioLogado == $tbEnquetesResposta){ ?>
                                	<div class="EnquetesRespostaCerta">
                                    	<img src="img/imgCorreto01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteQuestoesRepostaCorreta"); ?>" style="position: relative; display: block; margin-top: 20px; margin-bottom: 10px;" />
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteQuestoesRepostaCorreta"); ?>
                                    </div>
                                <?php }else{ ?>
                                	<div class="EnquetesRespostaErrada">
                                    	<img src="img/imgIncorreto01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteQuestoesRepostaIncorreta"); ?>" style="position: relative; display: block; margin-top: 20px; margin-bottom: 10px;" />
                                    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteQuestoesRepostaIncorreta"); ?>
                                        
                                        <?php //Resposta correta. ?>
                                        <div style="position: relative; display: none;">
                                            <div style="margin-top: 20px;">
                                                A resposta correta é:
                                            </div>
                                            <div style="font-weight: bold;">
                                                <?php echo DbFuncoes::GetCampoGenerico01($tbEnquetesResposta, "tb_enquetes_opcoes", "opcao"); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                
                            	<?php 
								//Verificação de erro - debug.
								/*
								echo "GetCampoGenerico06=" . DbFuncoes::GetCampoGenerico06("tb_enquetes_log", 
																							"id_tb_opcoes", 
																							"id_tb_enquetes", 
																							$linhaEnquetes['id'], 
																							"", 
																							"", 
																							2, 
																							"", 
																							"", 
																							"id_tb_cadastro", 
																							$idTbCadastroUsuarioLogado, 
																							"", 
																							"");
								echo "resposta=" . $linhaEnquetes['resposta'];	
								*/														
								?>
                                                                        
								
                            <?php } ?>
                        </div>
					<?php } ?>
                    <?php //************************************************************************************** ?>
				<?php } ?>
                
                
                <?php
				//Limpeza de objetos.
				//----------
				unset($strSqlEnquetesOpcoesSelect);
				unset($statementEnquetesOpcoesSelect);
				unset($resultadoEnquetesOpcoes);
				unset($linhaEnquetesOpcoes);
				//----------
				?>
				<?php //----------?>


                <div class="EnquetesSeparador1">
                
                </div>
            
            <?php } ?>
        </div>
		<?php //**************************************************************************************?>
	<?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarEnquetesFrontendPaginacaoSimples'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="EnquetesPaginacao">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="EnquetesPaginacaoLink">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="EnquetesPaginacaoLink">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarEnquetesFrontendPaginacaoQtdPaginas'] == "1"){ ?>
                    <?php for($countPaginas = 1; $countPaginas <= $paginacaoTotal; $countPaginas++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPaginas; ?><?php echo $queryPadrao; ?>" class="EnquetesPaginacaoLink">
                                <?php echo $countPaginas; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="EnquetesPaginacaoLink">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="EnquetesPaginacaoLink">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoUltima"); ?>
                    </a>
                </div>
            </div>
            
            <?php //Contagem de páginas. ?>
            <div align="center" class="EnquetesPaginacao">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    
    
	<?php //Log das respostas. ?>
	<?php //**************************************************************************************?>
	<?php 
    /**/
    //Criação de variáveis.
    $idsTbEnquetesCategorias = DbFuncoes::GetCampoGenerico06("tb_enquetes", 
                                                            "id", 
                                                            "id_tb_categorias", 
                                                            $idParentEnquetes, 
                                                            "", 
                                                            "", 
                                                            1, 
                                                            "", 
                                                            "", 
                                                            "", 
                                                            "", 
                                                            "ativacao", 
                                                            "1");
    $countEnquetesRespostasCorratas = 0;
                                                            
    if($idsTbEnquetesCategorias <> "")
    {
        //Criação de array.
        $arrIdsTbEnquetesCategorias = explode(",", $idsTbEnquetesCategorias);
        
        //Loop pelas enquetes.
        for($countArrayEnquetes = 0; $countArrayEnquetes < count($arrIdsTbEnquetesCategorias); $countArrayEnquetes++)
        {
            $tbEnquetesResposta = "";
            $tbEnquetesResposta = DbFuncoes::GetCampoGenerico01($arrIdsTbEnquetesCategorias[$countArrayEnquetes], "tb_enquetes", "resposta");
            
            $tbEnquetesLogResposta = "";
            $tbEnquetesLogResposta = DbFuncoes::GetCampoGenerico06("tb_enquetes_log", 
                                                                    "id_tb_opcoes", 
                                                                    "id_tb_enquetes", 
                                                                    $arrIdsTbEnquetesCategorias[$countArrayEnquetes], 
                                                                    "", 
                                                                    "", 
                                                                    2, 
                                                                    "", 
                                                                    "", 
                                                                    "id_tb_cadastro", 
                                                                    $idTbCadastroUsuarioLogado, 
                                                                    "", 
                                                                    "");
                                                                    
            //Contabilização das respostas corretas.
            if($tbEnquetesResposta == $tbEnquetesLogResposta)
            {
                $countEnquetesRespostasCorratas++;
            }
            
            //verificação de erro - debug.
            /*
            echo "arrIdsTbEnquetesCategorias[]=" . $arrIdsTbEnquetesCategorias[$countArrayEnquetes] . "<br />"; 
            echo "tbEnquetesResposta=" . $tbEnquetesResposta . "<br />"; 
            echo "tbEnquetesLogResposta=" . $tbEnquetesLogResposta . "<br />"; 
            echo "countEnquetesRespostasCorratas=" . $countEnquetesRespostasCorratas . "<br />"; 
            */
        }
    }														
                                                            
    //verificação de erro - debug.
    //echo "idsTbEnquetesCategorias=" . $idsTbEnquetesCategorias . "<br />"; 
    //echo "countEnquetesRespostasCorratas=" . $countEnquetesRespostasCorratas . "<br />"; 
    ?>
    <div style="position: relative; display: block; overflow: hidden;">
        Acertou <?php echo $countEnquetesRespostasCorratas;?> de <?php echo $paginacaoTotal; //alterar para contagem de enquetes. ?>.
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
unset($strSqlEnquetesSelect);
unset($statementEnquetesSelect);
unset($resultadoEnquetes);
unset($linhaEnquetes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>