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
$idTbFluxo = $_GET["idTbFluxo"];

$idParentFluxo = $_GET["idParentFluxo"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}
$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2);

$idsTbFluxoTipo = $_GET["idsTbFluxoTipo"];
if(is_array($idsTbFluxoTipo) == true)
{
	//$idsTbCadastroComplemento = implode(",", $_GET["idsTbCadastroComplemento"]);
	$idsTbFluxoTipo = implode(",", $idsTbFluxoTipo);
}

$palavraChave = $_GET["palavraChave"];

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataPublicacaoOnLoad = date("Y") . "-" . date("m") . "-" . date("d");
$dataLancamentoOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");

//Definição de valores de variáveis.
if($dataInicial <> "" && $dataFinal <> "")
{
	//$diaDataInicial = $_GET["diaDataInicial"];
	//$mesDataInicial = $_GET["mesDataInicial"];
	//$anoDataInicial = $_GET["anoDataInicial"];
//}else{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
	
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
}

$paginaRetorno = "SiteAdmFluxoIndice.php";
$paginaRetornoExclusao = "SiteAdmFluxoEditar.php";
$variavelRetorno = "idParentFluxo";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentFluxo=" . $idParentFluxo . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Montagem de query de pesquisa.
//----------
$strSqlFluxoSelect = "";
$strSqlFluxoSelect .= "SELECT ";
//$strSqlFluxoSelect .= "* ";
$strSqlFluxoSelect .= "id, ";
$strSqlFluxoSelect .= "id_tb_categorias, ";
$strSqlFluxoSelect .= "data_lancamento, ";
$strSqlFluxoSelect .= "data_contabilizacao, ";
$strSqlFluxoSelect .= "debito_credito, ";
$strSqlFluxoSelect .= "id_item, ";
$strSqlFluxoSelect .= "tabela, ";
$strSqlFluxoSelect .= "id_tb_cadastro, ";
$strSqlFluxoSelect .= "id_tb_cadastro_usuario, ";
$strSqlFluxoSelect .= "id_tb_cadastro1, ";
$strSqlFluxoSelect .= "id_tb_cadastro2, ";
$strSqlFluxoSelect .= "id_tb_cadastro3, ";
$strSqlFluxoSelect .= "lancamento, ";
$strSqlFluxoSelect .= "id_tb_fluxo_tipo, ";
$strSqlFluxoSelect .= "id_tb_fluxo_status, ";
$strSqlFluxoSelect .= "valor, ";
$strSqlFluxoSelect .= "valor1, ";
$strSqlFluxoSelect .= "valor2, ";
$strSqlFluxoSelect .= "valor3, ";
$strSqlFluxoSelect .= "valor4, ";
$strSqlFluxoSelect .= "valor5, ";
$strSqlFluxoSelect .= "n_documento, ";
$strSqlFluxoSelect .= "autenticacao, ";
$strSqlFluxoSelect .= "informacao_complementar1, ";
$strSqlFluxoSelect .= "informacao_complementar2, ";
$strSqlFluxoSelect .= "informacao_complementar3, ";
$strSqlFluxoSelect .= "informacao_complementar4, ";
$strSqlFluxoSelect .= "informacao_complementar5, ";
$strSqlFluxoSelect .= "informacao_complementar6, ";
$strSqlFluxoSelect .= "informacao_complementar7, ";
$strSqlFluxoSelect .= "informacao_complementar8, ";
$strSqlFluxoSelect .= "informacao_complementar9, ";
$strSqlFluxoSelect .= "informacao_complementar10, ";
$strSqlFluxoSelect .= "obs, ";
$strSqlFluxoSelect .= "ativacao, ";
$strSqlFluxoSelect .= "ativacao_contabilizacao ";
$strSqlFluxoSelect .= "FROM tb_fluxo ";
$strSqlFluxoSelect .= "WHERE id <> 0 ";
if($idTbFluxo <> "")
{
	$strSqlFluxoSelect .= "AND id = :id ";
}
if($idParentFluxo <> "")
{
	$strSqlFluxoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
}
if($idsTbFluxoTipo <> "")
{
	//$strSqlFluxoSelect .= "AND id_tb_categorias = :id_tb_categorias ";
	$strSqlFluxoSelect .= "AND id_tb_fluxo_tipo IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbFluxoTipo) . ") ";
}

if($dataInicial <> "" && $dataFinal <> "")
{
	$strSqlFluxoSelect .= "AND data_lancamento BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
}
if($palavraChave <> "")
{
	///*
	$strSqlFluxoSelect .= "AND (lancamento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	///*
	$strSqlFluxoSelect .= "OR n_documento LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR autenticacao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR obs LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar6 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar7 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar8 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar9 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlFluxoSelect .= "OR informacao_complementar10 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%'";
	//*/
	$strSqlFluxoSelect .= ") ";
	//*/
}
//$strSqlFluxoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFluxo'] . " ";
if($GLOBALS['habilitarFluxoClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentFluxo) <> "")
{
	$strSqlFluxoSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentFluxo) . " ";
	
}else{
	$strSqlFluxoSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFluxo'] . " ";
}
//echo "strSqlFluxoSelect=" . $strSqlFluxoSelect . "<br />";
//----------


//Parâmetros.
//----------
$statementFluxoSelect = $dbSistemaConPDO->prepare($strSqlFluxoSelect);

if ($statementFluxoSelect !== false)
{
	if($idTbFluxo <> "")
	{
		$statementFluxoSelect->bindParam(':id', $idTbFluxo, PDO::PARAM_STR);
	}
	if($idParentFluxo <> "")
	{
		$statementFluxoSelect->bindParam(':id_tb_categorias', $idParentFluxo, PDO::PARAM_STR);
	}
	$statementFluxoSelect->execute();
	
	/*
	$statementFluxoSelect->execute(array(
		"id_tb_categorias" => $idParentFluxo,
		"tipo_publicacao" => $tipoPublicacao
	));
	*/
}
//----------


//$resultadoFluxo = $dbSistemaConPDO->query($strSqlFluxoSelect);
$resultadoFluxo = $statementFluxoSelect->fetchAll();


//Verificação de erro - debug.
//echo "strSqlFluxoSelect=" . $strSqlFluxoSelect . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelFluxoAdministrar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelFluxoAdministrar"); ?>
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
    
    
    <div style="position:relative; display: block; overflow: hidden;">
		<?php //Busca.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        $includeBusca_tipoBusca = "fluxoAdm2";
        $includeBusca_origemBusca = "";
        $includeBusca_idTbCategoriaEscolha = "";
        ?>
        
        <?php include "IncludeBusca.php";?>
        <?php //----------------------?>
	</div>
    
    
    <?php //Informações básicas.?>
    <div align="left" style="position: relative; display: block; overflow: hidden;">
        <div class="AdmTexto01" style="position: relative; display: block;">
        	<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaPeriodo"); ?>: 
            </strong>
            <?php echo $dataInicial; ?> - <?php echo $dataFinal; ?>
        </div>
        <div class="AdmTexto01" style="position: relative; display: block;">
        	<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaData"); ?>: 
            </strong>
            <?php echo Funcoes::DataLeitura01($dataAtual, $GLOBALS['configSiteFormatoData'], "2"); ?>
        </div>
	</div>
    
    
    <?php
	if (empty($resultadoFluxo))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formFluxoAcoes" id="formFluxoAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_fluxo" />
            <input name="idParentFluxo" id="idParentFluxo" type="hidden" value="<?php echo $idParentFluxo; ?>" />

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
                
                <td width="100">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDataLancamento"); ?>
                    </div>
                </td>
                
                <td>
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoLancamento"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarFluxoTipo'] == 1){ ?>
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTipo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarFluxoStatus'] == 1){ ?>
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoStatus"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="30">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoAtivacaoContabilizacaoA"); ?>
                    </div>
                </td>
                
                <td width="30">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDebitoCreditoA"); ?>
                    </div>
                </td>
                <td width="100" style="display: none;">
                    <div align="right" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCredito"); ?>
                    </div>
                </td>
                <td width="100" style="display: none;">
                    <div align="right" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDebito"); ?>
                    </div>
                </td>
                
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValor"); ?>
                    </div>
                </td>
                
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldo"); ?>
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
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;

				//Valores.
				$valorSaldo = 0;
				$valorCredito = 0;
				$valorDebito = 0;

				$valorSaldoAtivado = 0;
				$valorSaldoAtivadoContabilizacao = 0;
				$valorSaldoCombinado = 0;
				$valorSaldoNaoContabilizacao = 0;
				$valorSaldoNaoAtivado = 0;
			  
				$arrFluxoTipo = DbFuncoes::FiltrosGenericosFill01("tb_fluxo_complemento", 1);
				$arrFluxoStatus = DbFuncoes::FiltrosGenericosFill01("tb_fluxo_complemento", 2);
				
                //Loop pelos resultados.
                foreach($resultadoFluxo as $linhaFluxo)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaFluxo['data_lancamento'];?>
                        <?php //echo Funcoes::DataLeitura01($linhaFluxo['data_lancamento'], $GLOBALS['configSiteFormatoData'], "2");?>
                        <?php echo Funcoes::DataLeitura01($linhaFluxo['data_lancamento'], $GLOBALS['configSiteFormatoData'], "1");?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaFluxo['lancamento']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarFluxoIc1'] == 1){ ?>
                    	<?php if(!empty($linhaFluxo['informacao_complementar1'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc1'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaFluxo['informacao_complementar1']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarFluxoIc2'] == 1){ ?>
                    	<?php if(!empty($linhaFluxo['informacao_complementar2'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc2'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaFluxo['informacao_complementar2']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarFluxoIc3'] == 1){ ?>
                    	<?php if(!empty($linhaFluxo['informacao_complementar3'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc3'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaFluxo['informacao_complementar3']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarFluxoIc4'] == 1){ ?>
                    	<?php if(!empty($linhaFluxo['informacao_complementar4'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc4'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaFluxo['informacao_complementar4']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarFluxoIc5'] == 1){ ?>
                    	<?php if(!empty($linhaFluxo['informacao_complementar5'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc5'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaFluxo['informacao_complementar5']);?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    
                    <?php if(!empty($linhaFluxo['id_tb_cadastro'])){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaFluxo['id_tb_cadastro'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCadastro"); ?>: 
                                </strong>
                                <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaFluxo['id_tb_cadastro'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaFluxo['id_tb_cadastro'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaFluxo['id_tb_cadastro'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaFluxo['id_tb_cadastro'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                </td>
                
                <?php if($GLOBALS['habilitarFluxoTipo'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrFluxoTipo); $countArray++)
                        {
                        ?>
                        	<?php if($arrFluxoTipo[$countArray][0] == $linhaFluxo['id_tb_fluxo_tipo']){ ?>
                                <div>
                                    <?php echo $arrFluxoTipo[$countArray][1];?>
                                </div>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarFluxoStatus'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrFluxoStatus); $countArray++)
                        {
                        ?>
                        	<?php if($arrFluxoStatus[$countArray][0] == $linhaFluxo['id_tb_fluxo_status']){ ?>
                                <div>
                                    <?php echo $arrFluxoStatus[$countArray][1];?>
                                </div>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>

                <td class="<?php if($linhaFluxo['ativacao'] == 1){/*echo "AdmTbFundoAtivado";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaFluxo['id'];?>&statusAtivacao=<?php echo $linhaFluxo['ativacao'];?>&strTabela=tb_fluxo&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaFluxo['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaFluxo['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaFluxo['ativacao'];?>
                    </div>
                </td>
                
                <td class="<?php if($linhaFluxo['ativacao_contabilizacao'] == 1){/*echo "AdmTbFundoAtivado";*/}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaFluxo['id'];?>&statusAtivacao=<?php echo $linhaFluxo['ativacao_contabilizacao'];?>&strTabela=tb_fluxo&strCampo=ativacao_contabilizacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaFluxo['ativacao_contabilizacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaFluxo['ativacao_contabilizacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaFluxo['ativacao'];?>
                    </div>
                </td>
                
                <td class="<?php if($linhaFluxo['debito_credito'] == 1){echo "AdmTbFundoPositivo";}else{echo "AdmTbFundoNegativo";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php if($linhaFluxo['debito_credito'] == 0){?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDebitoA"); ?>
						<?php } ?>
                    	<?php if($linhaFluxo['debito_credito'] == 1){?>
                        	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCreditoA"); ?>
						<?php } ?>
                        <?php //echo $linhaFluxo['debito_credito'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="right" class="AdmTexto01">
                    	<?php if($linhaFluxo['debito_credito'] == 1){?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                            <?php echo Funcoes::MascaraValorLer($linhaFluxo['valor'], $GLOBALS['configSistemaMoeda']);?>
                            <?php //echo $linhaFluxo['valor'];?>
						<?php } ?>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="right" class="AdmTexto01">
                    	<?php if($linhaFluxo['debito_credito'] == 0){?>
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                            <?php echo Funcoes::MascaraValorLer($linhaFluxo['valor'], $GLOBALS['configSistemaMoeda']);?>
                            <?php //echo $linhaFluxo['valor'];?>
						<?php } ?>
                    </div>
                </td>

                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                        <?php echo Funcoes::MascaraValorLer($linhaFluxo['valor'], $GLOBALS['configSistemaMoeda']);?>
                        <?php //echo $linhaFluxo['valor'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php
                        //Cálculo.
                        /*
                        $valorSaldo = 0;
                        $valorSaldoAtivado = 0;
                        $valorSaldoAtivadoContabilizacao = 0;
                        $valorSaldoCombinado = 0;
                        $valorSaldoNaoContabilizacao = 0;
                        $valorSaldoNaoAtivado = 0;
                        */
                        
                        //Saldo
                        //----------------------
                        //Subtração.
                        if($linhaFluxo['debito_credito'] == 0)
                        {
                            $valorSaldo = $valorSaldo - $linhaFluxo['valor'];
							$valorDebito = $valorDebito - $linhaFluxo['valor'];
                        }
                        
                        //Adição.
                        if($linhaFluxo['debito_credito'] == 1)
                        {
                            $valorSaldo = $valorSaldo + $linhaFluxo['valor'];
							$valorCredito = $valorCredito + $linhaFluxo['valor'];
                        }
                        //----------------------
                        
                        
                        //Não ativado.
                        //----------------------
                        if($linhaFluxo['ativacao'] == 0)
                        {
                            //Subtração.
                            if($linhaFluxo['debito_credito'] == 0)
                            {
                                $valorSaldoNaoAtivado = $valorSaldoNaoAtivado - $linhaFluxo['valor'];
                            }
                            
                            //Adição.
                            if($linhaFluxo['debito_credito'] == 1)
                            {
                                $valorSaldoNaoAtivado = $valorSaldoNaoAtivado + $linhaFluxo['valor'];
                            }
                        }
                        //----------------------
                        
                        
                        //Ativado.
                        //----------------------
                        if($linhaFluxo['ativacao'] == 1)
                        {
                            //Subtração.
                            if($linhaFluxo['debito_credito'] == 0)
                            {
                                $valorSaldoAtivado = $valorSaldoAtivado - $linhaFluxo['valor'];
                            }
                            
                            //Adição.
                            if($linhaFluxo['debito_credito'] == 1)
                            {
                                $valorSaldoAtivado = $valorSaldoAtivado + $linhaFluxo['valor'];
                            }
                        }
                        //----------------------
                        
                        
                        //Não contabilizado.
                        //----------------------
                        if($linhaFluxo['ativacao_contabilizacao'] == 0)
                        {
                            //Subtração.
                            if($linhaFluxo['debito_credito'] == 0)
                            {
                                $valorSaldoNaoContabilizacao = $valorSaldoNaoContabilizacao - $linhaFluxo['valor'];
                            }
                            
                            //Adição.
                            if($linhaFluxo['debito_credito'] == 1)
                            {
                                $valorSaldoNaoContabilizacao = $valorSaldoNaoContabilizacao + $linhaFluxo['valor'];
                            }
                        }
                        //----------------------
                        
                        
                        //Contabilizado.
                        //----------------------
                        if($linhaFluxo['ativacao_contabilizacao'] == 1)
                        {
                            //Subtração.
                            if($linhaFluxo['debito_credito'] == 0)
                            {
                                $valorSaldoAtivadoContabilizacao = $valorSaldoAtivadoContabilizacao - $linhaFluxo['valor'];
                            }
                            
                            //Adição.
                            if($linhaFluxo['debito_credito'] == 1)
                            {
                                $valorSaldoAtivadoContabilizacao = $valorSaldoAtivadoContabilizacao + $linhaFluxo['valor'];
                            }
                        }
                        //----------------------
                        ?>
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                        <?php echo Funcoes::MascaraValorLer($valorSaldo, $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmFluxoEditar.php?idTbFluxo=<?php echo $linhaFluxo['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaFluxo['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaFluxo['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaFluxo['id'];?>" class="AdmCampoRadioButton01" />
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
        <div class="AdmTexto01" align="right">
        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotal"); ?>: 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorSaldo, $GLOBALS['configSistemaMoeda']);?>
                <?php //echo $valorSaldo; ?>
            </div>
            
        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotal"); ?> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCredito"); ?>): 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorCredito, $GLOBALS['configSistemaMoeda']);?>
            </div>
            
        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotal"); ?> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDebito"); ?>): 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorDebito, $GLOBALS['configSistemaMoeda']);?>
            </div>
            
            <br />

        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotalAtivado"); ?>: 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorSaldoAtivado, $GLOBALS['configSistemaMoeda']);?>
                <?php //echo $valorSaldo; ?>
            </div>
            
        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotalAtivadoCantabilizacao"); ?>: 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorSaldoAtivadoContabilizacao, $GLOBALS['configSistemaMoeda']);?>
                <?php //echo $valorSaldo; ?>
            </div>
            
        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotalDesativado"); ?>: 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorSaldoNaoAtivado, $GLOBALS['configSistemaMoeda']);?>
                <?php //echo $valorSaldo; ?>
            </div>
            
        	<div>
            	<strong>
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValorSaldoTotalDesativadoCantabilizacao"); ?>: 
                </strong>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                <?php echo Funcoes::MascaraValorLer($valorSaldoNaoContabilizacao, $GLOBALS['configSistemaMoeda']);?>
                <?php //echo $valorSaldo; ?>
            </div>
        </div>
	<?php } ?>
    
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formFluxo').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					valor: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
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
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
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

    <form name="formFluxo" id="formFluxo" action="SiteAdmFluxoIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTbFluxo"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDataLancamento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<script type="text/javascript">
                            //Variável para conter todos os campos que funcionam com o DatePicker.
                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                            var strDatapickerAgendaPtCampos = "";
							var strDatapickerAgendaEnCampos = "";
                        </script>
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_lancamento;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_lancamento;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_lancamento" id="data_lancamento" class="AdmCampoData01" maxlength="10" value="<?php echo $dataLancamentoOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDataContabilizacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_contabilizacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_contabilizacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_contabilizacao" id="data_contabilizacao" class="AdmCampoData01" maxlength="10" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCadastro"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php 
                            $arrFluxoCadastro = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                        ?>
                        <select name="id_tb_cadastro" id="id_tb_cadastro" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrFluxoCadastro); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrFluxoCadastro[$countArray][0];?>"><?php echo $arrFluxoCadastro[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarFluxoUsuario'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php 
                            $arrFluxoCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                        ?>
                        <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrFluxoCadastroUsuario); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrFluxoCadastroUsuario[$countArray][0];?>"><?php echo $arrFluxoCadastroUsuario[$countArray][1];?></option>
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
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoLancamento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="lancamento" id="lancamento" class="AdmCampoTexto02" maxlength="255" />
						<div style="display: inline;">
							<input name="debito_credito" type="radio" value="0" class="AdmCampoCheckBox01" checked="true" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDebito"); ?>
						</div>
						<div style="display: inline;">
							<input name="debito_credito" type="radio" value="1" class="AdmCampoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCredito"); ?>
						</div>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarFluxoTipo'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTipo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php 
                            $arrFluxoTipo = DbFuncoes::FiltrosGenericosFill01("tb_fluxo_complemento", 1);
                        ?>
                        <select name="id_tb_fluxo_tipo" id="id_tb_fluxo_tipo" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrFluxoTipo); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrFluxoTipo[$countArray][0];?>"><?php echo $arrFluxoTipo[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarFluxoStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php 
                            $arrFluxoStatus = DbFuncoes::FiltrosGenericosFill01("tb_fluxo_complemento", 2);
                        ?>
                        <select name="id_tb_fluxo_status" id="id_tb_fluxo_status" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrFluxoStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrFluxoStatus[$countArray][0];?>"><?php echo $arrFluxoStatus[$countArray][1];?></option>
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
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda']); ?>
                    	<?php //echo Funcoes::MascaraValorGravar("2,05") . "<br />"; ?> 
                    	<?php //echo Funcoes::MascaraValorGravar("2.05") . "<br />"; ?> 
                    	<?php //echo Funcoes::MascaraValorGravar("100,002.05") . "<br />"; ?> 
                    	<?php //echo Funcoes::MascaraValorGravar("100.002,05") . "<br />"; ?> 
                        
                    	<?php //echo number_format(10000205, 2, ',', '.') . "<br />"; ?> 
                    	<?php //echo number_format(100000, 2, ',', '.') . "<br />"; ?> 
                    	<?php //echo number_format(10000205, 2, '.', ',') . "<br />"; ?> 
                    	<?php //echo Funcoes::MascaraValorLer("10000205", $GLOBALS['configSistemaMoeda']) . "<br />"; ?> 
                    	<?php //echo MascaraValorLer("100000", $GLOBALS['configSistemaMoeda']) . "<br />"; ?> 
                    	<?php //echo Funcoes::MascaraValorLer("10000205", "$") . "<br />"; ?> 
                    	<?php //echo number_format(-10000205, 2, ',', '.') . "<br />"; ?> 
                    	<?php //echo number_format(-10000205, 2, '.', ',') . "<br />"; ?> 
                        <input type="text" name="valor" id="valor" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarFluxoNDocumento'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoNDocumento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="n_documento" id="n_documento" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarFluxoAutenticacao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoAutenticacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left">
                        <input type="text" name="autenticacao" id="autenticacao" class="AdmCampoTexto02" maxlength="255" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarFluxoIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc1'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarFluxoIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc2'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarFluxoIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc3'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarFluxoIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc4'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarFluxoIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloFluxoIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc5'] == 2){ ?>
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
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoAtivacaoContabilizacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao_contabilizacao" id="ativacao_contabilizacao" class="AdmCampoDropDownMenu01">
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
                
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $idParentFluxo; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
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
unset($strSqlFluxoSelect);
unset($statementFluxoSelect);
unset($resultadoFluxo);
unset($linhaFluxo);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>