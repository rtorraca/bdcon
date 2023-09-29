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
$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$id = $_GET["id"];
//$idTbCadastroCliente = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroCliente = $idTbCadastroLogado;
//$idTbCadastroCliente = $_GET["idTbCadastroCliente"];

$idCeComplementoStatus = $_GET["id_ce_complemento_status"];

//Critério classificação.
$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

if($dataInicial <> "")
{
	$diaDataInicial = date('d', $dataInicialConvert);
	$mesDataInicial = date('m', $dataInicialConvert);
	$anoDataInicial = date('Y', $dataInicialConvert);
	
	$dataInicial_print = Funcoes::DataLeitura01($anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, $GLOBALS['configSiteFormatoData'], "1");
}else{
	//$dataInicial_print = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");
	$dataInicial_print = "";
}
if($dataFinal <> "")
{
	$diaDataFinal = date('d', $dataFinalConvert);
	$mesDataFinal = date('m', $dataFinalConvert);
	$anoDataFinal = date('Y', $dataFinalConvert);
	
	$dataFinal_print = Funcoes::DataLeitura01($anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal, $GLOBALS['configSiteFormatoData'], "1");
}else{
	//$dataFinal_print = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");
	$dataFinal_print = "";
}

//Datas - pesquisa padrão.
$dataPedidosBuscaInicial = date("Y") . "-" . date("m") . "-" . date("d");
//date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s")
$dataPedidosBuscaInicial_print = Funcoes::DataLeitura01($dataPedidosBuscaInicial, $GLOBALS['configSiteFormatoData'], "1");

$dataPedidosBuscaFinal = Funcoes::DataAlterar01($dataPedidosBuscaInicial, "1", "+", "d");
$dataPedidosBuscaFinal_print = Funcoes::DataLeitura01($dataPedidosBuscaFinal, $GLOBALS['configSiteFormatoData'], "1");

$paginaRetorno = "SiteAdmPedidosIndice.php";
//$criterioClassificacao = "";
$criterioClassificacao = $_GET["criterioClassificacao"];
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Paginação.
if($GLOBALS['habilitarPedidosSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configPedidosSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_paginas", "id_parent", $idParentPedidos); //Quantidade de registros.
	//$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
	$paginacaoInicio = ($paginacaoNumero-1) * $paginacaoNRegistros;
}

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;

$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPedidosSelect = "";
$strSqlPedidosSelect .= "SELECT ";
//$strSqlPedidosSelect .= "* ";
$strSqlPedidosSelect .= "id, ";
$strSqlPedidosSelect .= "id_tb_cadastro_cliente, ";
$strSqlPedidosSelect .= "id_tb_cadastro_enderecos, ";
$strSqlPedidosSelect .= "id_tb_cadastro_cartoes, ";
$strSqlPedidosSelect .= "id_tb_cadastro_usuario, ";
$strSqlPedidosSelect .= "tipo_pagamento, ";
$strSqlPedidosSelect .= "data_pedido, ";
$strSqlPedidosSelect .= "data_pagamento, ";
$strSqlPedidosSelect .= "data_entrega, ";
$strSqlPedidosSelect .= "data_validade, ";
$strSqlPedidosSelect .= "valor_pedido, ";
$strSqlPedidosSelect .= "valor_frete, ";
$strSqlPedidosSelect .= "periodo_contratacao, ";
$strSqlPedidosSelect .= "tipo_entrega, ";
$strSqlPedidosSelect .= "valor_total, ";
$strSqlPedidosSelect .= "peso_total, ";
$strSqlPedidosSelect .= "endereco_entrega, ";
$strSqlPedidosSelect .= "endereco_numero_entrega, ";
$strSqlPedidosSelect .= "endereco_complemento_entrega, ";
$strSqlPedidosSelect .= "bairro_entrega, ";
$strSqlPedidosSelect .= "cidade_entrega, ";
$strSqlPedidosSelect .= "estado_entrega, ";
$strSqlPedidosSelect .= "pais_entrega, ";
$strSqlPedidosSelect .= "cep_entrega, ";
$strSqlPedidosSelect .= "id_tb_cadastro1, ";
$strSqlPedidosSelect .= "id_tb_cadastro2, ";
$strSqlPedidosSelect .= "id_tb_cadastro3, ";
$strSqlPedidosSelect .= "obs, ";
$strSqlPedidosSelect .= "ativacao, ";

$strSqlPedidosSelect .= "informacao_complementar1, ";
$strSqlPedidosSelect .= "informacao_complementar2, ";
$strSqlPedidosSelect .= "informacao_complementar3, ";
$strSqlPedidosSelect .= "informacao_complementar4, ";
$strSqlPedidosSelect .= "informacao_complementar5, ";

$strSqlPedidosSelect .= "id_ce_complemento_status, ";
$strSqlPedidosSelect .= "transacao_externa_status, ";
$strSqlPedidosSelect .= "transacao_externa_autenticacao, ";
$strSqlPedidosSelect .= "transacao_externa_log, ";
$strSqlPedidosSelect .= "transacao_externa_data_pagamento_liberado ";

//Paginação (sbuquery).
if($GLOBALS['habilitarPedidosSitePaginacao'] == "1"){
	$strSqlPedidosSelect .= ", (SELECT COUNT(id) ";
	$strSqlPedidosSelect .= "FROM ce_pedidos ";
	$strSqlPedidosSelect .= "WHERE id <> 0 ";
	if($id <> "")
	{
		$strSqlPedidosSelect .= "AND id = :id ";
	}
	//if($idTbCadastroCliente <> "")
	//{
		//$strSqlPedidosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
	//}
	if($idTbCadastroCliente <> "")
	{
		$strSqlPedidosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
	}	
	if($idCeComplementoStatus <> "")
	{
		$strSqlPedidosSelect .= "AND id_ce_complemento_status = :id_ce_complemento_status ";
	}
	if($dataInicial <> "" and $dataFinal <> "")
	{
		$strSqlPedidosSelect .= "AND data_pedido BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
	}
	$strSqlPedidosSelect .= ") totalRegistros ";
}

$strSqlPedidosSelect .= "FROM ce_pedidos ";
$strSqlPedidosSelect .= "WHERE id <> 0 ";
if($id <> "")
{
	$strSqlPedidosSelect .= "AND id = :id ";
}
//if($idTbCadastroCliente <> "")
//{
	//$strSqlPedidosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
//}
if($idTbCadastroCliente <> "")
{
	$strSqlPedidosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
}
if($idCeComplementoStatus <> "")
{
	$strSqlPedidosSelect .= "AND id_ce_complemento_status = :id_ce_complemento_status ";
}
if($dataInicial <> "" and $dataFinal <> "")
{
	$strSqlPedidosSelect .= "AND data_pedido BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' ";
}

if($criterioClassificacao <> "")
{
	$strSqlPedidosSelect .= "ORDER BY " . $criterioClassificacao . " ";
}else{
	$strSqlPedidosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidos'] . " ";
}

//Paginação.
if($GLOBALS['habilitarPedidosSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlPedidosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//echo "strSqlPedidosSelect=" . $strSqlPedidosSelect . "<br />";
//----------


//Parâmetros.
//----------
$statementPedidosSelect = $dbSistemaConPDO->prepare($strSqlPedidosSelect);

if ($statementPedidosSelect !== false)
{
	if($id <> "")
	{
		$statementPedidosSelect->bindParam(':id', $id, PDO::PARAM_STR);
	}
	//if($idTbCadastroCliente <> "")
	//{
		//$statementPedidosSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
	//}
	if($idTbCadastroCliente <> "")
	{
		$statementPedidosSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
	}	
	if($idCeComplementoStatus <> "")
	{
		$statementPedidosSelect->bindParam(':id_ce_complemento_status', $idCeComplementoStatus, PDO::PARAM_STR);
	}
	$statementPedidosSelect->execute();
	
	/*
	$statementPedidosSelect->execute(array(
		"id_parent" => $idParentPedidos
	));
	*/
}
//----------


//$resultadoPedidos = $dbSistemaConPDO->query($strSqlPedidosSelect);
$resultadoPedidos = $statementPedidosSelect->fetchAll();

//Paginação.
if($GLOBALS['habilitarPedidosSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoPedidos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosHistorico"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosHistorico"); ?>
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
    
    <?php if($masterPageSiteSelect <> "LayoutSiteIFrame.php"){ ?>
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
    <?php } ?>
    

    <div class="AdmAdmTexto01" style="position: relative; display: none; margin-bottom: 20px; overflow: hidden;">
		<script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
    
            var strDatapickerAgendaPtCampos = "";
            var strDatapickerAgendaEnCampos = "";
        </script>
        <form name="formPedidosFiltros" id="formPedidosFiltros" action="SiteAdmPedidosIndice.php" method="get" class="FormularioTabela01">
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="idTbCadastro" id="idTbCadastro" type="hidden" value="<?php echo $idTbCadastro; ?>" />
            
            <table width="100%" class="AdmTabelaDados01">
                <tr class="AdmTbFundoEscuro">
                    <td class="AdmTbFundoEscuro TabelaDados01Celula" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltros"); ?> 
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaDataInicial"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#dataInicial;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#dataInicial;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="dataInicial" id="dataInicial" class="AdmCampoData01" maxlength="10" value="<?php echo $dataInicial_print;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaDataFinal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaColuna01">
                        <div>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#dataFinal;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#dataFinal;";
                                    </script>
                                <?php } ?>
                            
                                <input type="text" name="dataFinal" id="dataFinal" class="AdmCampoData01" maxlength="10" value="<?php echo $dataFinal_print;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaCriterioClassificacao"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <select id="criterioClassificacao" name="criterioClassificacao" class="AdmCampoDropDownMenu01">
                                <option value="data_pedido desc"<?php if($criterioClassificacao == "data_pedido desc" or $criterioClassificacao == ""){?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosDataClassificacaoDesc"); ?></option>
                                <option value="data_pedido asc"<?php if($criterioClassificacao == "data_pedido desc"){?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaPedidosDataClassificacaoAsc"); ?></option>
                            </select> 
                        </div>
                    </td>
                </tr>
                
                <?php if($GLOBALS['habilitarAdministrarPedidosStatus'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosStatus"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php 
                                $arrPedidosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
                            ?>
                            <select name="id_ce_complemento_status" id="id_ce_complemento_status" class="AdmCampoDropDownMenu01">
                                <option value=""<?php if($idCeComplementoStatus == ""){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"<?php if($idCeComplementoStatus == "0"){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosStatus[$countArray][0];?>"<?php if($arrPedidosStatus[$countArray][0] == $idCeComplementoStatus){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosStatus[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>            
                <?php } ?>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAplicar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAplicar"); ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    </div>
    
    
    <?php //Obs: Excluir o filtro de cima, pois pode dar conflito com as datas. ?>
    <div class="AdmAdmTexto01" style="position: relative; display: none; margin-bottom: 20px; overflow: hidden;">
		<?php //Busca.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        $includeBusca_tipoBusca = "pedidos2"; //cadastro1 (busca por palavra-chave) | cadastroAdm1 (busca por palavra-chave) | imoveis1 (busca por palavra-chave) | imoveis2 (busca com dropdown) | categoriasDropdown1 (busca com dropdown) | produtos1 (busca por palavra-chave) | cadastro1 (busca por palavra-chave) | cadastro2 (busca detalhada | produtos1 (busca por palavra-chave) | publicacoes1 (busca por palavra-chave) | enquetes1 (busca por palavra-chave) | forum1 (busca por palavra-chave) | videos1 (busca por palavra-chave) | contatosAdm1 (busca por palavra-chave) | tarefas1 (busca por palavra-chave) | cadastroContasBancariasAdm1 (busca por palavra-chave) | paginas1 (busca por palavra-chave) |  paginasAdm1 (busca por palavra-chave)  |  processosAdm1 (busca por palavra-chave)
        $includeBusca_origemBusca = "";
        $includeBusca_idTbCategoriaEscolha = "";
        ?>
        
        <?php include "IncludeBusca.php";?>
        <?php //----------------------?>
    </div>
    
    
    <?php if($GLOBALS['habilitar'] == "1"){ //Variável não existe - apenas para ocultar programação. ?>
    <?php //if($idTbCadastroCliente == ""){ ?>
		<?php if($GLOBALS['habilitarAdministrarPedidosCobrancaAvulsa'] == 1){ ?>
        <div style="position: relative; display: block; overflow: hidden;">
            <div align="left" style="float: left;">
                <img src="img/btoNovo.png" onclick="divShowHide('divPedidosIncluir');" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoNovo"); ?>" style="cursor: pointer;" />
            </div>
        </div>
        
        <div id="divPedidosIncluir" style="position: relative; display: none; overflow: hidden; margin-bottom: 15px;">
            <form name="formPedidos" id="formPedidos" action="SiteAdmPedidosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                <script type="text/javascript">
                    //Variável para conter todos os campos que funcionam com o DatePicker.
                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                    var strDatapickerGenericoPtCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
                </script>
                <?php } ?>
                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                <script type="text/javascript">
                    //Variável para conter todos os campos que funcionam com o DatePicker.
                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                    var strDatapickerGenericoEnCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
                </script>
                <?php } ?>
                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                <table class="AdmTabelaCampos01">
                    <tr>
                        <td class="AdmTbFundoEscuro" colspan="4">
                            <div align="center" class="AdmTexto02">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTbPedidos"); ?>
                                </strong>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosCadastroCliente"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                $arrPedidosClientes = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                                ?>
                                <select name="id_tb_cadastro_cliente" id="id_tb_cadastro_cliente" class="AdmCampoDropDownMenu01">
                                    <!--option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option-->
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosClientes); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosClientes[$countArray][0];?>"><?php echo $arrPedidosClientes[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    
                    <tr style="display: none;">
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <?php //echo $tbPedidosId; ?>
                            </div>
                        </td>
                    </tr>
                    
                    <?php if($GLOBALS['habilitarEdicaoPedidosData'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosData"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                
                                    <?php //JQuery DatePicker. ?>
                                    <?php //---------------------- ?>
                                    <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                        <input type="text" name="data_pedido" id="data_pedido" class="AdmCampoData01" maxlength="10" />
                                        <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                    <?php } ?>
                                    <?php //---------------------- ?>
                                <?php //}else{ ?>
                                    <?php //echo $tbPedidosDataPedido; ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoPagamento"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left">
                                <input type="text" name="tipo_pagamento" id="tipo_pagamento" class="AdmCampoAdmTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php if($GLOBALS['habilitarAdministrarPedidosDataPagamento'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataPagamento"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <input type="text" name="data_pagamento" id="data_pagamento" class="AdmCampoData01" maxlength="10" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAdministrarPedidosDataEntrega'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataEntrega"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <input type="text" name="data_entrega" id="data_entrega" class="AdmCampoData01" maxlength="10" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarAdministrarPedidosDataValidade'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataValidade"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <input type="text" name="data_validade" id="data_validade" class="AdmCampoData01" maxlength="10" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorPedido"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <?php 
                                if($linhaPedidosDetalhes['valor_pedido'] == 0)
                                {
                                    $tbPedidosValorPedido = $itensValorTotal;
                                }
                                
                                //Verificação de erro.
                                //echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
                                //echo "itensValorTotal=" . $itensValorTotal . "<br>";
                                //echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
                                ?>
        
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_pedido" id="valor_pedido" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
        
                                <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorPedido; ?>
                            </div>
                        </td>
                    </tr>
        
                    <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorFrete"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_frete" id="valor_frete" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
        
                                <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
        
                    <?php if($GLOBALS['habilitarAdministrarPedidosTipoEntrega'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoEntrega"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left">
                                <input type="text" name="tipo_entrega" id="tipo_entrega" class="AdmCampoAdmTexto01" maxlength="255" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosValorDesconto'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorDesconto"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_desconto" id="valor_desconto" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
    
                                <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosValorAcrescimo'] == 1){ ?>
                    <?php
                    $tbPedidosValorTotal = $tbPedidosValorTotal + $tbPedidosValorAcrescimo;
                    ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorAcrescimo"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_acrescimo" id="valor_acrescimo" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
    
                                <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
        
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorTotal"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <?php 
                                //if($linhaPedidosDetalhes['valor_total'] == 0)
                                //{
                                    $tbPedidosValorTotal = $tbPedidosValorFrete + $tbPedidosValorPedido;
                                //}
                                
                                //Verificação de erro.
                                //echo "tbPedidosValorTotal=" . $tbPedidosValorTotal . "<br>";
                                //echo "tbPedidosValorFrete=" . $tbPedidosValorFrete . "<br>";
                                //echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
                                //echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
                                ?>
                                
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_total" id="valor_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                                
                                <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorTotal; ?>
                            </div>
                        </td>
                    </tr>
        
                    <?php if($GLOBALS['habilitarAdministrarPedidosPeso'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosPesoTotal"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left" class="AdmTexto01">
                                <input type="text" name="peso_total" id="peso_total" class="AdmCampoNumerico02" maxlength="255" value="0" />
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>
        
                                <?php //echo $tbPedidosPesoTotal; ?> <?php //echo htmlentities($GLOBALS['configSistemaPeso']); ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
        
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosObs"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left">
                                <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosOBS;?></textarea>
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
                                    <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                                    <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    
                    <?php if($GLOBALS['habilitarAdministrarPedidosStatus'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosStatus"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmAdmTexto01">
                                <?php 
                                    $arrPedidosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
                                ?>
                                <select name="id_ce_complemento_status" id="id_ce_complemento_status" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosStatus); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosStatus[$countArray][0];?>"><?php echo $arrPedidosStatus[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosVinculo1'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo1Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrPedidosVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo1'], $GLOBALS['configIdTbTipoPedidosVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo1'], $GLOBALS['configPedidosVinculo1Metodo']);
                                ?>
                                <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosVinculo1[$countArray][0];?>"><?php echo $arrPedidosVinculo1[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosVinculo2'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo2Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrPedidosVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo2'], $GLOBALS['configIdTbTipoPedidosVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo2'], $GLOBALS['configPedidosVinculo2Metodo']);
                                ?>
                                <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosVinculo2); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosVinculo2[$countArray][0];?>"><?php echo $arrPedidosVinculo2[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosVinculo3'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo3Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrPedidosVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo3'], $GLOBALS['configIdTbTipoPedidosVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo3'], $GLOBALS['configPedidosVinculo3Metodo']);
                                ?>
                                <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosVinculo3); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosVinculo3[$countArray][0];?>"><?php echo $arrPedidosVinculo3[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosVinculo4'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo4Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrPedidosVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo4'], $GLOBALS['configIdTbTipoPedidosVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo4'], $GLOBALS['configPedidosVinculo4Metodo']);
                                ?>
                                <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosVinculo4); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosVinculo4[$countArray][0];?>"><?php echo $arrPedidosVinculo4[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosVinculo5'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosVinculo5Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrPedidosVinculo5 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPedidosVinculo5'], $GLOBALS['configIdTbTipoPedidosVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPedidosVinculo5'], $GLOBALS['configPedidosVinculo5Metodo']);
                                ?>
                                <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrPedidosVinculo5); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrPedidosVinculo5[$countArray][0];?>"><?php echo $arrPedidosVinculo5[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarPedidosFiltroGenerico01'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 12);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico01CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico01); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico01[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico01CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico01[]" name="idsPedidosFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico01); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico01[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico01[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico01CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico01[]" name="idsPedidosFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico01); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico01[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico01[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico01)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico02'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 13);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico02CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico02); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico02[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico02CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico02[]" name="idsPedidosFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico02); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico02[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico02[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico02CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico02[]" name="idsPedidosFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico02); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico02[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico02[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico02)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico03'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 14);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico03[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico03[]" name="idsPedidosFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico03); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico03[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico03[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico03[]" name="idsPedidosFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico03); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico03[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico03[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico03)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico04'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 15);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico04[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico04[]" name="idsPedidosFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico04); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico04[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico04[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico04[]" name="idsPedidosFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico04); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico04[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico04[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico04)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico05'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 16);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico05); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico05[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico05[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico05[]" name="idsPedidosFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico05[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico05[]" name="idsPedidosFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico05[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico05)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico06'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 17);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico06); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico06[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico06[]" name="idsPedidosFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico06[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico06[]" name="idsPedidosFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico06[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico06)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico07'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">

                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 18);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico07); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico07[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico07[]" name="idsPedidosFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico07[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico07[]" name="idsPedidosFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico07[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico07)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico08'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 19);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico08); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico08[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico08[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico08[]" name="idsPedidosFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico08[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico08[]" name="idsPedidosFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico08[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico08)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico09'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 20);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico09); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico09[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico09[]" name="idsPedidosFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico09[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico09[]" name="idsPedidosFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico09[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico09)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if($GLOBALS['habilitarPedidosFiltroGenerico10'] == 1){ ?>
                        <tr>
                            <td class="AdmTbFundoMedio TabelaColuna01">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                                </div>
                            </td>
                            <td class="AdmTbFundoClaro" colspan="3">
                                <div class="AdmTexto01">
                                    <?php 
                                        $arrPedidosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 21);
                                    ?>
                                    
                                    <?php if($GLOBALS['configPedidosFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico10); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsPedidosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01" /> <?php echo $arrPedidosFiltroGenerico10[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
        
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                        <select id="idsPedidosFiltroGenerico10[]" name="idsPedidosFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico10[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configPedidosFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                        <select id="idsPedidosFiltroGenerico10[]" name="idsPedidosFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrPedidosFiltroGenerico10[$countArray][0];?>"><?php echo $arrPedidosFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrPedidosFiltroGenerico10)){ ?>
                                        <a href="PedidosManutencao.php" class="AdmLinks01" style="display: none;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
        
                    <?php if($GLOBALS['habilitarPedidosIc1'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc1'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                            <div>
                                <?php if($GLOBALS['configPedidosBoxIc1'] == 1){ ?>
                                    <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoAdmTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configPedidosBoxIc1'] == 2){ ?>
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
                    
                    <?php if($GLOBALS['habilitarPedidosIc2'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc2'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                            <div>
                                <?php if($GLOBALS['configPedidosBoxIc2'] == 1){ ?>
                                    <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoAdmTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configPedidosBoxIc2'] == 2){ ?>
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
                
                    <?php if($GLOBALS['habilitarPedidosIc3'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc3'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                            <div>
                                <?php if($GLOBALS['configPedidosBoxIc3'] == 1){ ?>
                                    <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoAdmTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configPedidosBoxIc3'] == 2){ ?>
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
                
        
                    <?php if($GLOBALS['habilitarPedidosIc4'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc4'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                            <div>
                                <?php if($GLOBALS['configPedidosBoxIc4'] == 1){ ?>
                                    <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoAdmTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configPedidosBoxIc4'] == 2){ ?>
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
                
                    <?php if($GLOBALS['habilitarPedidosIc5'] == 1){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01 AdmTabelaCampos01Celula">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc5'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro AdmTabelaCampos01Celula" colspan="3">
                            <div>
                                <?php if($GLOBALS['configPedidosBoxIc5'] == 1){ ?>
                                    <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoAdmTexto01" maxlength="255" />
                                <?php } ?>
                                <?php if($GLOBALS['configPedidosBoxIc5'] == 2){ ?>
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
                        
                </table>
                <div>
                    <div style="float:left;">
                        <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
    
                        <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                        <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    </div>
                    <div style="float:right;">
                        <a href="<?php echo $paginaRetorno; ?>?variavelBlank=<?php echo $queryPadrao;?>">
                            <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
	<?php //} ?>
	<?php } ?>


	<?php //Pedidos. ?>
    <div class="AdmAdmTexto01" style="position: relative; display: block; overflow: hidden;">
    <?php
	if (empty($resultadoPedidos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmTextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formPedidosAcoes" id="formPedidosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_pedidos" />
            <input name="idTbCadastroCliente" id="idTbCadastroCliente" type="hidden" value="<?php echo $idTbCadastroCliente; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">

            </div>
            
			<?php
            $arrPedidosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
            ?>
            
			<?php //Diagramação 1.?>
            <?php //**************************************************************************************?>
            <div style="position: relative; display: block; overflow: hidden;">
              <?php
				$arrPedidosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
				
			  	$arrPedidosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 13);
				
                //Loop pelos resultados.
                foreach($resultadoPedidos as $linhaPedidos)
                {
              ?>
                <table width="100%" class="AdmTabelaDados01">
                  <tr class="AdmTbFundoClaro">
                    <td class="TabelaDados01Celula">
                    	<?php if($idTbCadastroCliente == ""){ ?>
                        <div align="left" class="AdmTbFundoEscuro AdmTexto02" style="padding: 4px;">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosCadastroCliente"); ?>:
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPedidos['id_tb_cadastro_cliente']; /*$idParent;*/?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks02">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
    
                        <div align="left" class="AdmTexto01" style="border-bottom: 1px solid #ffffff">
                            <div style="width: 25%; height: 100px; display: table; float: left; border-right: 1px solid #ffffff">
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>:
                                    </strong>
                                    <?php echo $linhaPedidos['id'];?>
                                </div>
                                
                                <?php if($GLOBALS['configEdicaoPedidosTipoPagamento'] == 1){ ?>
                                    <?php if($linhaPedidos['tipo_pagamento'] <> ""){ ?>
                                    <div align="left">
                                        <strong>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoPagamento"); ?>: 
                                        </strong>
                                        <?php echo $linhaPedidos['tipo_pagamento'];?>
                                    </div>
                                    <?php } ?>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosTipoEntrega'] == 1){ ?>
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoEntrega"); ?>: 
                                    </strong>
                                    <?php echo Carrinho::GetNomeEntrega($linhaPedidos['tipo_entrega'], 1);?>
                                </div>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosPeso'] == 1){ ?>
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosPesoTotal"); ?>: 
                                    </strong>
                                    <?php echo $linhaPedidos['peso_total'];?>
                                    <?php echo " " . $GLOBALS['configSistemaPeso'];?>
                                </div>
                                <?php } ?>
                            </div>
    
                            <div style="width: 25%; height: 100px; display: table; float: left; border-right: 1px solid #ffffff">
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosData"); ?>:
                                    </strong>
                                    <?php echo Funcoes::DataLeitura01($linhaPedidos['data_pedido'], $GLOBALS['configSistemaFormatoData'], "2"); ?>
                                </div>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosDataPagamento'] == 1){ ?>
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataPagamento"); ?>: 
                                    </strong>
                                    <?php echo Funcoes::DataLeitura01($linhaPedidos['data_pagamento'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                                </div>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosDataEntrega'] == 1){ ?>
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataEntrega"); ?>: 
                                    </strong>
                                    <?php echo Funcoes::DataLeitura01($linhaPedidos['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                                </div>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosDataValidade'] == 1){ ?>
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataValidade"); ?>: 
                                    </strong>
                                    <?php echo Funcoes::DataLeitura01($linhaPedidos['data_validade'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                                </div>
                                <?php } ?>
                            </div>
    
                            <div style="width: 25%; height: 100px; display: table; float: left; border-right: 1px solid #ffffff">
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorPedido"); ?>: 
                                    </strong>
                                    <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                    <?php echo Funcoes::MascaraValorLer($linhaPedidos['valor_pedido']);?>
                                </div>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){ ?>
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorFrete"); ?>: 
                                    </strong>
                                    <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                    <?php echo Funcoes::MascaraValorLer($linhaPedidos['valor_frete']);?>
                                </div>
                                <?php } ?>
    
                                <div align="left">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorTotal"); ?>: 
                                    </strong>
                                    <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                                    <?php echo Funcoes::MascaraValorLer($linhaPedidos['valor_total']);?>
                                </div>
                            </div>
    
                            <div style="height: 100px; display:block; margin-left:auto; margin-right: auto;">
                                
                                <div align="center" style="margin-left: 75%;">
                                    <div class="<?php if($linhaPedidos['ativacao'] == 1){echo "AdmTbFundoAtivado";}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula" style="width: 50%; float: left; display: inline;">
										<?php if($linhaPedidos['ativacao'] == 0){?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                                        <?php } ?>
                                        <?php if($linhaPedidos['ativacao'] == 1){?>
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                                        <?php } ?>
                                        
                                        <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidos['id'];?>&statusAtivacao=<?php echo $linhaPedidos['ativacao'];?>&strTabela=ce_pedidos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01" style="display: none;">
                                            <?php if($linhaPedidos['ativacao'] == 0){?>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                                            <?php } ?>
                                            <?php if($linhaPedidos['ativacao'] == 1){?>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                                            <?php } ?>
                                        </a>
                                    </div>
    
                                    <div align="center" style="display: none;">
                                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidos['id'];?>" class="AdmCampoCheckBox01" />
                                        (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>)
                                    </div>
                                </div>
                                
                                <div align="center" style="display: none;">
                                    <a href="PedidosEditar.php?idCePedidos=<?php echo $linhaPedidos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                                    </a>
                                </div>
                                
                                <?php if($GLOBALS['habilitarAdministrarPedidosCobrancaAvulsa'] == 1){ ?>
                                <div align="center" style="display: none;">
                                    <a href="SiteAdmCadastroCobrancaAvulsa.php?idCePedidos=<?php echo $linhaPedidos['id'];?>&idTbCadastro=<?php echo $linhaPedidos['id_tb_cadastro_cliente'];?>&&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensAvulso"); ?>)
                                    </a>
                                </div>
                                <?php } ?>
                                
                                <?php if($GLOBALS['habilitarOrcamentoFichas'] == 1){ ?>
                                <div align="center">
                                    <a href="SiteAdmOrcamentosImportar.php?idCePedidos=<?php echo $linhaPedidos['id'];?>&masterPageSelect=<?php echo $masterPageSelect;?>" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasImportar"); ?>
                                    </a>
                                    <?php //echo "Pedidos::ItensTotal=" . Pedidos::ItensTotal("", $linhaPedidos['id']);?>
                                </div>
                                <?php } ?>
                                
                                <?php if($GLOBALS['habilitarPedidosParcelas'] == 1){ ?>
                                <div align="center">
                                    <a href="SiteAdmPedidosParcelasIndice.php?idCePedidos=<?php echo $linhaPedidos['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasTitulo"); ?> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasIncluir"); ?>)
                                    </a>
                                </div>
                                <?php } ?>
    
                                <div align="center">
                                    <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteCarrinhoPedidosCobranca.php?idCePedidos=<?php echo $linhaPedidos['id'];?>" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                                    </a>
                                </div>
    
                                <?php if($GLOBALS['habilitarAdministrarPedidosStatus'] == 1){ ?>
                                <div align="center">
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosStatus"); ?>: 
                                    </strong>
                                    <?php //echo $linhaPedidos['id_ce_complemento_status'];?>
                                    
									<?php 
                                    for($countArray = 0; $countArray < count($arrPedidosStatus); $countArray++)
                                    {
                                    ?>
                                        <?php if($arrPedidosStatus[$countArray][0] == $linhaPedidos['id_ce_complemento_status']){ ?>
                                            <?php echo $arrPedidosStatus[$countArray][1];?>
                                        <?php } ?>
                                    <?php 
                                    }
                                    ?>
                                </div>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarPedidosEnvioVoucherManual'] == 1){ ?>
                                <div align="center">
                                    <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/CadastroAdministrarEmailEnviar.php?idCePedidos=<?php echo $linhaPedidos['id'];?><?php echo $queryPadrao;?>" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosEnviarVoucher"); ?>
                                    </a>
                                </div>
                                <?php } ?>
    
                                <?php if($GLOBALS['habilitarCarrinhoEnvioPedido'] == 1){ ?>
                                <div align="center">
    
                                </div>
                                <?php } ?>
                            </div>
                        </div>
    
    
                        <?php if($linhaPedidos['obs'] <> ""){ ?>
                        <div align="left" class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosObs"); ?>: 
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['obs']); ?>
                        </div>
                        <?php } ?>
    
                        <?php if($GLOBALS['habilitarPedidosIc1'] == 1){ ?>
                        <div align="left" class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc1'], "IncludeConfig"); ?>:
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar1']); ?>
                        </div>
                        <?php } ?>
    
                        <?php if($GLOBALS['habilitarPedidosIc2'] == 1){ ?>
                        <div align="left" class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc2'], "IncludeConfig"); ?>:
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar']); ?>
                        </div>
                        <?php } ?>
    
                        <?php if($GLOBALS['habilitarPedidosIc3'] == 1){ ?>
                        <div align="left" class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc3'], "IncludeConfig"); ?>:
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar3']); ?>
                        </div>
                        <?php } ?>
    
                        <?php if($GLOBALS['habilitarPedidosIc4'] == 1){ ?>
                        <div align="left" class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc4'], "IncludeConfig"); ?>:
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar4']); ?>
                        </div>
                        <?php } ?>
    
                        <?php if($GLOBALS['habilitarPedidosIc5'] == 1){ ?>
                        <div align="left" class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc5'], "IncludeConfig"); ?>:
                            </strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar5']); ?>
                        </div>
                        <?php } ?>
    
                        <div align="center" class="AdmTexto01 AdmTbFundoMedio" style="padding: 5px 0px 5px 0px ">
                            <strong>
                               <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosListagemItens"); ?>
                            </strong>
                        </div>
                        
                        <?php //Itens. ?>
                        <?php //************************************************************************************** ?>
                        <div class="TbFundoClaro" style="/*background-color: #ffffff;*/">
                            <?php
                            $idCePedidos = $linhaPedidos['id'];
                            
                            //Query de pesquisa.
                            //----------
                            $strSqlPedidosItensSelect = "";
                            $strSqlPedidosItensSelect .= "SELECT ";
                            //$strSqlPedidosItensSelect .= "* ";
                            $strSqlPedidosItensSelect .= "id, ";
                            $strSqlPedidosItensSelect .= "id_ce_pedidos, ";
                            $strSqlPedidosItensSelect .= "id_tb_cadastro_cliente, ";
                            $strSqlPedidosItensSelect .= "id_tb_cadastro_usuario, ";
                            $strSqlPedidosItensSelect .= "id_item, ";
                            $strSqlPedidosItensSelect .= "cod_item, ";
                            $strSqlPedidosItensSelect .= "descricao, ";
                            $strSqlPedidosItensSelect .= "tabela, ";
                            $strSqlPedidosItensSelect .= "quantidade, ";
                            $strSqlPedidosItensSelect .= "valor_unitario, ";
                            $strSqlPedidosItensSelect .= "id_tb_itens_valores, ";
                            $strSqlPedidosItensSelect .= "id_tb_itens_valores_titulo, ";
                            $strSqlPedidosItensSelect .= "id_tb_itens_data, ";
                            $strSqlPedidosItensSelect .= "valor_total, ";
                            $strSqlPedidosItensSelect .= "ids_opcionais, ";
                            $strSqlPedidosItensSelect .= "ids_opcionais_descricao, ";
                            $strSqlPedidosItensSelect .= "obs, ";
                            
                            $strSqlPedidosItensSelect .= "informacao_complementar1, ";
                            $strSqlPedidosItensSelect .= "informacao_complementar2, ";
                            $strSqlPedidosItensSelect .= "informacao_complementar3, ";
                            $strSqlPedidosItensSelect .= "informacao_complementar4, ";
                            $strSqlPedidosItensSelect .= "informacao_complementar5, ";
                            
                            $strSqlPedidosItensSelect .= "ativacao, ";
                            $strSqlPedidosItensSelect .= "data_pedido, ";
                            $strSqlPedidosItensSelect .= "data_pagamento, ";
                            $strSqlPedidosItensSelect .= "data_entrega, ";
                            $strSqlPedidosItensSelect .= "data_validade, ";
                            $strSqlPedidosItensSelect .= "id_tb_produtos_complemento_status ";
                            
                            $strSqlPedidosItensSelect .= "FROM ce_itens ";
                            $strSqlPedidosItensSelect .= "WHERE id <> 0 ";
                            if($idCePedidos <> "")
                            {
                                $strSqlPedidosItensSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
                            }
                            
                            //$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosItens'] . " ";
                            //if($GLOBALS['habilitarPedidosItensClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) <> "")
                            //{
                                //$strSqlPedidosItensSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) . " ";
                                
                            //}else{
                                $strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoItens'] . " ";
                            //}
                            
                            
                            $statementPedidosItensSelect = $dbSistemaConPDO->prepare($strSqlPedidosItensSelect);
                            
                            if ($statementPedidosItensSelect !== false)
                            {
                                if($idCePedidos <> "")
                                {
                                    //$statementPedidosItensSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
                                    $statementPedidosItensSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
                                }
                                $statementPedidosItensSelect->execute();
                                
                                /*
                                $statementPedidosItensSelect->execute(array(
                                    "id_parent" => $idParentPedidosItens
                                ));
                                */
                            }
                            
                            //$resultadoPedidosItens = $dbSistemaConPDO->query($strSqlPedidosItensSelect);
                            $resultadoPedidosItens = $statementPedidosItensSelect->fetchAll();
                            ?>
                            <?php
                            if (empty($resultadoPedidosItens))
                            {
                                //echo "Nenhum registro encontrado";
                            ?>
                                <div align="center" class="AdmTextoErro">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
                                </div>
                            <?php
                            }else{
                            ?>
                        
                                    <table width="100%" class="AdmTabelaDados01">
                                      <tr class="AdmTbFundoEscuro">
                                        <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                                        <td width="1" class="AdmTbFundoEscuro TabelaDados01Celula">
                                            <div align="center" class="AdmTexto02">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        
                                        <td width="100" class="AdmTbFundoEscuro TabelaDados01Celula">
                                            <div align="center" class="AdmTexto02">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>
                                            </div>
                                        </td>
                                        
                                        <td class="AdmTbFundoEscuro TabelaDados01Celula">
                                            <div class="AdmTexto02">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensDescricao"); ?>
                                            </div>
                                        </td>
                                        
                                        <td width="40" class="AdmTbFundoEscuro TabelaDados01Celula">
                                            <div align="center" class="AdmTexto02">
                                                <strong>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>
                                                </strong>
                                            </div>
                                        </td>
                                        
                                        <td width="100" class="AdmTbFundoEscuro TabelaDados01Celula">
                                            <div align="center" class="AdmTexto02">
                                                <strong>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>
                                                </strong>
                                            </div>
                                        </td>
                                        
                                        <td width="100" class="AdmTbFundoEscuro TabelaDados01Celula">
                                            <div align="center" class="AdmTexto02">
                                                <strong>
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorTotal"); ?>
                                                </strong>
                                            </div>
                                        </td>
                                        
                                        <td width="30" class="TabelaDados01Celula" style="display: none;">
                                            <div align="center" class="AdmTexto02">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                                            </div>
                                        </td>
                                        
                                        <td width="30" class="AdmTbFundoEscuro TabelaDados01Celula" style="display: none;">
                                            <div align="center" class="AdmTexto02">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                                            </div>
                                        </td>
                                        
                                        <td width="30" class="AdmTbFundoEscuro TabelaDados01Celula" style="display: none;">
                                            <div align="center" class="AdmTexto02">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                                            </div>
                                        </td>
                                      </tr>
                                      <?php
                                        //Loop pelos resultados.
                                        foreach($resultadoPedidosItens as $linhaPedidosItens)
                                        {
                                      ?>
                                      <tr class="AdmTbFundoClaro">
                                        <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                                        <td class="TabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
												<?php //Imagem - Produtos. ?>
                                                <?php //---------- ?>
                                                    <?php
                                                    $ceItensImagem = "";
                                                    $ceItensImagem = DbFuncoes::GetCampoGenerico01($linhaPedidosItens['id_item'], "tb_produtos", "imagem");
                                                    ?>
                                                    <?php //if(!empty($ceItensImagem)){ ?>
                                                    <?php if($ceItensImagem <> ""){ ?>
                                                        <?php //Sem pop-up. ?>
                                                        <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                                            <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                                        <?php } ?>
                                                    
                                                        <?php //SlimBox 2 - JQuery. ?>
                                                        <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                                            <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/g<?php echo $ceItensImagem;?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>">
                                                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                                            </a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php //---------- ?>
                                            </div>
                                        </td>
                                        <?php } ?>
                        
                                        <td class="TabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <?php echo $linhaPedidosItens['cod_item'];?>
                                            </div>
                                        </td>
                                        
                                        <td class="TabelaDados01Celula">
                                            <div class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>
                                            </div>
                                            <div class="AdmTexto01">
												<?php if($GLOBALS['habilitarPedidosItensHistorico'] == 1){ ?>
                                                    [
                                                    <a href="SiteAdmHistoricoIndice.php?idParent=<?php echo $linhaPedidosItens['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemInserirHistorico"); ?>
                                                    </a>
                                                    ] 
                                                <?php } ?>
                                            </div>
                                        </td>
                                        
                                        <td class="TabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <?php echo $linhaPedidosItens['quantidade'];?>
                                            </div>
                                        </td>
                                        
                                        <td class="TabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], $GLOBALS['configSistemaMoeda']);?>
                                            </div>
                                        </td>
                                        
                                        <td class="TabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_total'], $GLOBALS['configSistemaMoeda']);?>
                                            </div>
                                        </td>
                                        
                                        <td class="<?php if($linhaPedidosItens['ativacao'] == 1){echo "AdmTbFundoAtivado";}else{echo "AdmTbFundoDesativado";}?> TabelaDados01Celula" style="display: none;">
                                            <div align="center" class="AdmTexto01">
                                                <a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidosItens['id'];?>&statusAtivacao=<?php echo $linhaPedidosItens['ativacao'];?>&strTabela=ce_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                                                    <?php if($linhaPedidosItens['ativacao'] == 0){?>
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                                                    <?php } ?>
                                                    <?php if($linhaPedidosItens['ativacao'] == 1){?>
                                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                                                    <?php } ?>
                                                </a>
                                                <?php //echo $linhaPaginas['ativacao'];?>
                                            </div>
                                        </td>
                                        <td class="TabelaDados01Celula" style="display: none;">
                                            <div align="center" class="AdmTexto01">
                                                <a href="PedidosItensEditar.php?idCeItens=<?php echo $linhaPedidosItens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="TabelaDados01Celula" style="display: none;">
                                            <div align="center" class="AdmTexto01">
                                                <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidosItens['id'];?>" class="AdmCampoCheckBox01" />
                                            </div>
                                        </td>
                                      </tr>
                                      <?php } ?>
                                    </table>
                            <?php } ?>
                            <?php
                            //Limpeza de objetos.
                            //----------
                            unset($strSqlPedidosItensSelect);
                            unset($statementPedidosItensSelect);
                            unset($resultadoPedidosItens);
                            unset($linhaPedidosItens);
                            //----------
                            ?>
                        </div>
                        <?php //************************************************************************************** ?>
                    </td>
                  </tr>
                </table>
                <div style="/*background-color: #ffffff;*/ height: 30px;">
                </div>
              <?php } ?>
            </div>
            <?php //**************************************************************************************?>


			<?php //Diagramação 2 - tabela.?>
            <?php //**************************************************************************************?>
            <div class="AdmTexto01" style="position: relative; display: none; overflow: hidden; clear: both;">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td width="80" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>
                    </div>
                </td>
                
                <td width="150" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="left" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosCadastroCliente"); ?>
                    </div>
                </td>
                
                <td width="100" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>
                    </div>
                </td>
                
              	<?php if($GLOBALS['configEdicaoPedidosTipoPagamento'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoPagamento"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['sistemaPedidosValorFrete'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorPedido"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorTotal"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarAdministrarPedidosStatus'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarPedidosFiltroGenerico02'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosFiltroGenerico02Nome'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosIc1'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosIc2'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc2'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPedidosIc3'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc3'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPedidosIc4'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc4'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPedidosIc5'] == 1){ ?>
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosTituloIc5'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              
              <?php
			  	$valorTotalSoma = 0;
			  	$countRegistros = 0;
			  
			  	$countTabelaFundo = 0;
				//$arrPedidosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
			  
                //Loop pelos resultados.
                foreach($resultadoPedidos as $linhaPedidos)
                {
					$valorTotalSoma = $valorTotalSoma + $linhaPedidos['valor_total'];
					
					//Detalhes do cadastro.
					$tbCadastroClienteNomePreferencial = "";
					$tbCadastroClienteCPF = "";
					
					$tbCadastroClienteNomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "nome_fantasia"), 
																	1));
					$tbCadastroClienteCPF = Funcoes::FormatarCPFLer(DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "cpf_"));
              ?>
              
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidos['id'];?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::DataLeitura01($linhaPedidos['data_pedido'], $GLOBALS['configSistemaFormatoData'], "2"); ?>
                    </div>
                    
					<?php if($GLOBALS['habilitarAdministrarPedidosDataPagamento'] == 1){ ?>
                    <br />
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataPagamento"); ?>: 
                        </strong>
                        <?php echo Funcoes::DataLeitura01($linhaPedidos['data_pagamento'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarAdministrarPedidosDataEntrega'] == 1){ ?>
                    <br />
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataEntrega"); ?>: 
                        </strong>
                        <?php echo Funcoes::DataLeitura01($linhaPedidos['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                    <?php } ?>

                    <?php if($GLOBALS['habilitarAdministrarPedidosDataValidade'] == 1){ ?>
                    <br />
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosDataValidade"); ?>: 
                        </strong>
                        <?php echo Funcoes::DataLeitura01($linhaPedidos['data_validade'], $GLOBALS['configSistemaFormatoData'], "1"); ?>
                    </div>
                    <?php } ?>
                </td>
              
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="left" class="AdmTexto01">
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaPedidos['id_tb_cadastro_cliente']; /*$idParent;*/?>&masterPageSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                            <?php /*echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "nome"), 
                            DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "razao_social"), 
                            DbFuncoes::GetCampoGenerico01($linhaPedidos['id_tb_cadastro_cliente'], "tb_cadastro", "nome_fantasia"), 
                            1));*/ ?>
                            <?php echo $tbCadastroClienteNomePreferencial;?>
                        </a>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php echo $tbCadastroClienteCPF;?>
                    </div>
                </td>
              
              	<?php if($GLOBALS['configEdicaoPedidosTipoPagamento'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidos['tipo_pagamento'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['sistemaPedidosValorFrete'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidos['valor_pedido']);?>
                    </div>
                    
					<?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){ ?>
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorFrete"); ?>: 
                        </strong>
                        <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidos['valor_frete']);?>
                    </div>
                    <?php } ?>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidos['valor_total']);?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarAdministrarPedidosStatus'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrPedidosStatus); $countArray++)
                        {
                        ?>
                            <?php if($arrPedidosStatus[$countArray][0] == $linhaPedidos['id_ce_complemento_status']){ ?>
                                <?php echo $arrPedidosStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarPedidosFiltroGenerico02'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
							<?php
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($linhaPedidos['id'], "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "13", "", ",", "", "1"));
                            ?>
							<?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <?php if(in_array($arrPedidosFiltroGenerico02[$countArray][0], $arrPedidosFiltroGenerico02Selecao)){ ?>
                                    <div>
                                        <?php //echo $arrPedidosFiltroGenerico02[$countArray][0];?>
                                        <?php echo $arrPedidosFiltroGenerico02[$countArray][1];?>
                                    </div>
								<?php } ?>
                            <?php 
                            }
                            ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosIc1'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar1']); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosIc2'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar2']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPedidosIc3'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar3']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPedidosIc4'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar4']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarPedidosIc5'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidos['informacao_complementar5']); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteCarrinhoPedidosCobranca.php?idCePedidos=<?php echo $linhaPedidos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    
					<?php if($GLOBALS['habilitarAdministrarPedidosCobrancaAvulsa'] == 1){ ?>
                    <div align="center">
                        <a href="CadastroCobrancaAvulsa.php?idCePedidos=<?php echo $linhaPedidos['id'];?>&idTbCadastro=<?php echo $linhaPedidos['id_tb_cadastro_cliente'];?>&masterPageSelect=LayoutSistemaSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?> (<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensAvulso"); ?>)
                        </a>
                    </div>
                    <?php } ?>
                    
					<?php if($GLOBALS['habilitarPedidosEnvioVoucherManual'] == 1){ ?>
                    <div align="center">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/CadastroAdministrarEmailEnviar.php?idCePedidos=<?php echo $linhaPedidos['id'];?><?php echo $queryPadrao;?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosEnviarVoucher"); ?>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if($GLOBALS['habilitarCarrinhoEnvioPedido'] == 1){ ?>
                    <div align="center">

                    </div>
                    <?php } ?>
                    
                    <div align="center">
                    	<a href="../<?php echo $GLOBALS['configDiretorioSistema'];?>/PedidosDetalhes.php?idCePedidos=<?php echo $linhaPedidos['id'];?>&masterPageSelect=LayoutSistemaImpressao.php" target="_blank" class="AdmLinks01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaPedidos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidos['id'];?>&statusAtivacao=<?php echo $linhaPedidos['ativacao'];?>&strTabela=ce_pedidos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPedidos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPedidos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaProdutos['ativacao'];?>
                    </div>
                </td>

                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmPedidosEditar.php?idCePedidos=<?php echo $linhaPedidos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaPedidos['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaPedidos['id'];?>" class="AdmCampoRadioButton01" />
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
            </div>
            <div style="display: none;">
            	quantidade de pedidos: <?php echo $countRegistros;?>
                Total: 	<?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                        <?php echo Funcoes::MascaraValorLer($valorTotalSoma);?>

            </div>
            <?php //**************************************************************************************?>
        </form>
	<?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarPedidosSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
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
                <?php if($GLOBALS['habilitarPedidosSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countPedidos = 1; $countPedidos <= $paginacaoTotal; $countPedidos++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countPedidos; ?><?php echo $queryPadrao; ?>" class="Links03">
                                <?php echo $countPedidos; ?>
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
            <div align="center" class="AdmTexto01">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginacaoPaginaContador01"); ?> 
                <?php echo $paginacaoNumero; ?> / <?php echo $paginacaoTotal; ?>
            </div>
        <?php } ?>
	<?php } ?>
	<?php //************************************************************************************** ?>
    </div>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPedidosSelect);
unset($statementPedidosSelect);
unset($resultadoPedidos);
unset($linhaPedidos);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>