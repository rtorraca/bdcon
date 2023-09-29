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
$idCePedidos = $_GET["idCePedidos"];
//$idTbCadastroCliente = $_GET["idTbCadastroCliente"];
$idTbCadastroCliente = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente");


$paginaRetorno = "OrcamentosImportar.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idCePedidos=" . $idCePedidos . 
"&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;

$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlOrcamentosSelect = "";
$strSqlOrcamentosSelect .= "SELECT ";
//$strSqlOrcamentosSelect .= "* ";
$strSqlOrcamentosSelect .= "id, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro_cliente, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro_enderecos, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro_vendedor, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro_usuario, ";
$strSqlOrcamentosSelect .= "data_orcamento, ";
$strSqlOrcamentosSelect .= "data_entrega, ";
$strSqlOrcamentosSelect .= "valor_orcamento, ";
$strSqlOrcamentosSelect .= "valor_frete, ";
$strSqlOrcamentosSelect .= "periodo_contratacao, ";
$strSqlOrcamentosSelect .= "tipo_entrega, ";
$strSqlOrcamentosSelect .= "valor_total, ";
$strSqlOrcamentosSelect .= "peso_total, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro1, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro2, ";
$strSqlOrcamentosSelect .= "id_tb_cadastro3, ";
$strSqlOrcamentosSelect .= "obs, ";
$strSqlOrcamentosSelect .= "ativacao, ";
$strSqlOrcamentosSelect .= "ativacao1, ";
$strSqlOrcamentosSelect .= "ativacao2, ";
$strSqlOrcamentosSelect .= "ativacao3, ";
$strSqlOrcamentosSelect .= "ativacao4, ";
$strSqlOrcamentosSelect .= "informacao_complementar1, ";
$strSqlOrcamentosSelect .= "informacao_complementar2, ";
$strSqlOrcamentosSelect .= "informacao_complementar3, ";
$strSqlOrcamentosSelect .= "informacao_complementar4, ";
$strSqlOrcamentosSelect .= "informacao_complementar5, ";
$strSqlOrcamentosSelect .= "id_ce_complemento_status ";
$strSqlOrcamentosSelect .= "FROM ce_orcamentos ";
$strSqlOrcamentosSelect .= "WHERE id <> 0 ";
/*
if($id <> "")
{
	$strSqlOrcamentosSelect .= "AND id = :id ";
}
*/
if($idTbCadastroCliente <> "")
{
	$strSqlOrcamentosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
}
/*
if($idsTbCadastroCliente <> "")
{
	$strSqlOrcamentosSelect .= "AND id_tb_cadastro_cliente IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastroCliente) . ") ";
}

if($idCeComplementoStatus <> "")
{
	$strSqlOrcamentosSelect .= "AND id_ce_complemento_status = :id_ce_complemento_status ";
}
if($criterioClassificacao == "data_orcamento desc" or $criterioClassificacao == "data_orcamento asc")
{
	$strSqlOrcamentosSelect .= "AND data_orcamento BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
}
if($dataInicial <> "" && $dataFinal <> "")
{
	$strSqlOrcamentosSelect .= "AND data_orcamento BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
}
*/
//$strSqlOrcamentosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentos'] . " ";
//if($criterioClassificacao <> "")
//{
	//$strSqlOrcamentosSelect .= "ORDER BY " . $criterioClassificacao . " ";
//}else{
	$strSqlOrcamentosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentos'] . " ";
//}
//echo "strSqlOrcamentosSelect=" . $strSqlOrcamentosSelect . "<br />";
//----------


//Parâmetros.
//----------
$statementOrcamentosSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosSelect);

if ($statementOrcamentosSelect !== false)
{
	/*
	if($id <> "")
	{
		$statementOrcamentosSelect->bindParam(':id', $id, PDO::PARAM_STR);
	}
	*/
	if($idTbCadastroCliente <> "")
	{
		$statementOrcamentosSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
	}
	/*
	if($idCeComplementoStatus <> "")
	{
		$statementOrcamentosSelect->bindParam(':id_ce_complemento_status', $idCeComplementoStatus, PDO::PARAM_STR);
	}
	*/
	$statementOrcamentosSelect->execute();
	
	/*
	$statementOrcamentosSelect->execute(array(
		"id_parent" => $idParentOrcamentos
	));
	*/
}
//----------


//$resultadoOrcamentos = $dbSistemaConPDO->query($strSqlOrcamentosSelect);
$resultadoOrcamentos = $statementOrcamentosSelect->fetchAll();


//Verificação de erro - debug.
//echo "idCePedidos=" . $idCePedidos . "<br />";
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasImportar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasImportar"); ?>
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
	if (empty($resultadoOrcamentos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formOrcamentosImportar" id="formOrcamentosImportar" action="SiteAdmOrcamentosImportarExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_orcamentos" />
            <input name="idCePedidos" id="idCePedidos" type="hidden" value="<?php echo $idCePedidos; ?>" />
            <input name="idTbCadastroCliente" id="idTbCadastroCliente" type="hidden" value="<?php echo $idTbCadastroCliente; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: none; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            
			<?php
            $arrOrcamentosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
            ?>  
            
            <div class="AdmTexto01" style="position: relative; display: block; overflow: hidden; clear: both;">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td width="30" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosNumero"); ?>
                    </div>
                </td>
                
                <td width="150" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosData"); ?>
                    </div>
                </td>
                
                <td class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosCadastroCliente"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarOrcamentosFrete'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorOrcamento"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentoFichas'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTitulo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentoFichas'] == 0){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorTotal"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosStatus'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc1'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc2'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc2'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc3'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc3'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc4'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc4'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc5'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc5'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
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
              </tr>
              
              <?php
				//$arrOrcamentosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
			  
                //Loop pelos resultados.
                foreach($resultadoOrcamentos as $linhaOrcamentos)
                {
					$tbOrcamentosValorOrcamento = 0;
					$tbOrcamentosValorOrcamento = Orcamentos::OrcamentoTotal($linhaOrcamentos['id'], 1);
              ?>
              
              <tr class="AdmTbFundoClaro">
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaOrcamentos['id'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::DataLeitura01($linhaOrcamentos['data_orcamento'], $GLOBALS['configSistemaFormatoData'], "2"); ?>
                    </div>
                    
					<?php if($GLOBALS['habilitarOrcamentosDataEntrega'] == 1){ ?>
                    <br />
                    <div align="center" class="AdmTexto01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosDataEntrega"); ?>: 
                        </strong>
                        <?php echo Funcoes::DataLeitura01($linhaOrcamentos['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                    <?php } ?>
                </td>
              
                <td class="AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto01">
                        <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaOrcamentos['id_tb_cadastro_cliente']; /*$idParent;*/?>&masterPageSiteSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaOrcamentos['id_tb_cadastro_cliente'], "tb_cadastro", "nome"), 
                            DbFuncoes::GetCampoGenerico01($linhaOrcamentos['id_tb_cadastro_cliente'], "tb_cadastro", "razao_social"), 
                            DbFuncoes::GetCampoGenerico01($linhaOrcamentos['id_tb_cadastro_cliente'], "tb_cadastro", "nome_fantasia"), 
                            1)); ?>
                        </a>
                    </div>
                </td>
              
                <?php if($GLOBALS['habilitarOrcamentosFrete'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php //echo Funcoes::MascaraValorLer($linhaOrcamentos['valor_orcamento']);?>
                        <?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento, $GLOBALS['configSistemaMoeda']);?>
                    </div>
                    
					<?php if($GLOBALS['habilitarAdministrarOrcamentosFrete'] == 1){ ?>
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorFrete"); ?>: 
                        </strong>
                        <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php echo Funcoes::MascaraValorLer($linhaOrcamentos['valor_frete']);?>
                    </div>
                    <?php } ?>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentoFichas'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01" style="background-color: #ffffff;">
						<?php //Orçamento - fichas. ?>
                        <?php 
						$idCeOrcamentos = $linhaOrcamentos['id'];
						
						
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
                            <div align="center" class="TextoErro">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                            </div>
                        <?php
                        }else{
                        ?>
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
                                
                                <td width="80" class="AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorTotal"); ?>
                                    </div>
                                </td>
                                
                                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                                    <div align="center" class="AdmTexto02">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                                    </div>
                                </td>
                                
                                <td width="30" class="AdmTabelaDados01Celula">
                                    <div align="center" align="center" class="AdmTexto02">
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
                                
                                <td width="30" class="AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto02">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                                    </div>
                                </td>
                              </tr>
                              <?php
							  	$countTabelaFundo = 0;
								
                                //Loop pelos resultados.
                                foreach($resultadoOrcamentosFichas as $linhaOrcamentosFichas)
                                {
                              ?>
								<?php 
                                //$tbOrcamentosIdTbCadastroCliente = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente");
                                
								//Funcionando.
                                /*
                                $tbCadastroNomePreferencial = "";
                                $tbCadastroNomePreferencial =  Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome_fantasia"), 
                                1)); 
                                
                                $tbCadastroCPF = "";
                                $tbCadastroCPF = DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "cpf_");
                                */
								
                                $tbOrcamentosFichasValorTotal = 0;
                                $tbOrcamentosFichasValorTotal = Orcamentos::OrcamentoTotal($linhaOrcamentosFichas['id'], 1);
                                ?>
                              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                                <td class="AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto01">
                                        <?php echo Funcoes::DataLeitura01($linhaOrcamentosFichas['data_ficha'], $GLOBALS['configSistemaFormatoData'], "2");?>
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
                                    <div align="right" class="AdmTexto01">
										<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                        <?php echo Funcoes::MascaraValorLer($tbOrcamentosFichasValorTotal);?>
                                    	<?php //echo Orcamentos::OrcamentoTotal($linhaOrcamentosFichas['id'], 1);?>
                                    </div>
                                </td>
                                
                                <td class="AdmTabelaDados01Celula" style="display: none;">
                                    <div align="center" class="AdmTexto01">
                                        <a href="Orcamento.php?idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?>&masterPageSiteSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciar"); ?>
                                        </a>
                                    </div>
                                    
                                    <?php if($GLOBALS['habilitarOrcamentosProdutosVinculosMultiplos'] == 1){ ?>
                                    <div align="center" class="AdmTexto01">
                                        <a href="OrcamentosRelacaoRegistrosIndice.php?idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?>&tipoCategoria=2&masterPageSiteSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichas['titulo']);?>&detalhe02=" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                        </a>
                                    </div>
                                    <?php } ?>
                                    
                                    <?php if($GLOBALS['habilitarOrcamentosFichasHistorico'] == 1){ ?>
                                    <div align="center" class="AdmTexto01">
                                        <a href="HistoricoIndice.php?idParent=<?php echo $linhaOrcamentosFichas['id'];?>&masterPageSiteSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichas['titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                                        </a>
                                    </div>
                                    <?php } ?>
                                </td>
                                
                                <td class="<?php if($linhaOrcamentosFichas['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto01">
                                        <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentosFichas['id'];?>&statusAtivacao=<?php echo $linhaOrcamentosFichas['ativacao'];?>&strTabela=ce_orcamentos_fichas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                                        </a>
											<?php if($linhaOrcamentosFichas['ativacao'] == 0){?>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                                            <?php } ?>
                                            <?php if($linhaOrcamentosFichas['ativacao'] == 1){?>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                                            <?php } ?>
                                    </div>
                                </td>
                                
                                <td class="AdmTabelaDados01Celula" style="display: none;">
                                    <div align="center" class="AdmTexto01">
                                        <a href="OrcamentosFichasEditar.php?idCeOrcamentosFichas=<?php echo $linhaOrcamentosFichas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                                        </a>
                                    </div>
                                </td>
                                
                                <td class="AdmTabelaDados01Celula" style="display: none;">
                                    <div align="center" class="AdmTexto01">
                                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentosFichas['id'];?>" class="AdmCampoCheckBox01" />
                                    </div>
                                </td>
                                
                                <td class="AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto01">
                                        <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaOrcamentosFichas['id'];?>" class="AdmCampoCheckBox01" />
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
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentoFichas'] == 0){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php //echo Funcoes::MascaraValorLer($linhaOrcamentos['valor_total']);?>
                        <?php echo Funcoes::MascaraValorLer(($tbOrcamentosValorOrcamento + $linhaOrcamentos['valor_frete']), $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosStatus'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrOrcamentosStatus); $countArray++)
                        {
                        ?>
                            <?php if($arrOrcamentosStatus[$countArray][0] == $linhaOrcamentos['id_ce_complemento_status']){ ?>
                                <?php echo $arrOrcamentosStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc1'] == 1){ ?>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar1']); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc2'] == 1){ ?>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar2']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc3'] == 1){ ?>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar3']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc4'] == 1){ ?>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar4']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc5'] == 1){ ?>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar5']); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01" style="display: none;">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteCarrinhoOrcamentos.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    
                    <div align="center">
                        <a href="Orcamento.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>&idTbCadastroCliente=<?php echo $linhaOrcamentos['id_tb_cadastro_cliente'];?>&masterPageSiteSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciar"); ?>
                        </a>
                    </div>
                    
					<?php if($GLOBALS['habilitarOrcamentosProdutosVinculosMultiplos'] == 1){ ?>
                    <div align="center" class="AdmTexto01">
                        <a href="OrcamentosRelacaoRegistrosIndice.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>&tipoCategoria=2&masterPageSiteSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar1']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if($GLOBALS['habilitarOrcamentosEnvio'] == 1){ ?>
                    <div align="center">

                    </div>
                    <?php } ?>
                    
                    <div align="center">
                    	<a href="OrcamentosDetalhes.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>&masterPageSiteSelect=LayoutSistemaImpressao.php" target="_blank" class="AdmLinks01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaOrcamentos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentos['id'];?>&statusAtivacao=<?php echo $linhaOrcamentos['ativacao'];?>&strTabela=ce_orcamentos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaOrcamentos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaOrcamentos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>

                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="OrcamentosEditar.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentos['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
            </div>
            <div>
                <div style="float:left;">
                    <input type="image" name="btoImportar" value="Submit" src="img/btoImportar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoImportar"); ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
	<?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlOrcamentosSelect);
unset($statementOrcamentosSelect);
unset($resultadoOrcamentos);
unset($linhaOrcamentos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>