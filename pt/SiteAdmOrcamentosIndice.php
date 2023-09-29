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
$id = $_GET["id"];
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];
$idsTbCadastroCliente = "";
$idCeComplementoStatus = $_GET["id_ce_complemento_status"];

//$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer("")), 2);

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));
$nome = $_GET["nome"];
$cpf_ = Funcoes::SomenteNum($_GET["cpf_"]);

$paginaRetorno = "SiteAdmOrcamentosIndice.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Critério classificação.
$criterioClassificacao = DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "tabela", "ce_orcamentos");
$diaDataInicial = DbFuncoes::GetCampoGenerico04("classificacao", "dia_data_inicial", "tabela", "ce_orcamentos");
$mesDataInicial = DbFuncoes::GetCampoGenerico04("classificacao", "mes_data_inicial", "tabela", "ce_orcamentos");
$anoDataInicial = DbFuncoes::GetCampoGenerico04("classificacao", "ano_data_inicial", "tabela", "ce_orcamentos");
$diaDataFinal = DbFuncoes::GetCampoGenerico04("classificacao", "dia_data_final", "tabela", "ce_orcamentos");
$mesDataFinal = DbFuncoes::GetCampoGenerico04("classificacao", "mes_data_final", "tabela", "ce_orcamentos");
$anoDataFinal = DbFuncoes::GetCampoGenerico04("classificacao", "ano_data_final", "tabela", "ce_orcamentos");

if($diaDataInicial <> "")
{
	$dataInicial_print = Funcoes::DataLeitura01($anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial, $GLOBALS['configSiteFormatoData'], "1");
}else{
	$dataInicial_print = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");
}
if($diaDataFinal <> "")
{
	$dataFinal_print = Funcoes::DataLeitura01($anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal, $GLOBALS['configSiteFormatoData'], "1");
}else{
	$dataFinal_print = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");
}

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

if($nome <> "")
{
	$idsTbCadastroCliente = DbFuncoes::BuscaGenerica01("tb_cadastro", 
														"id", 
														$nome, 
														array("nome","razao_social","nome_fantasia"));
}
if($cpf_ <> "")
{
	$idTbCadastroCliente = DbFuncoes::GetCampoGenerico04("tb_cadastro", "id", "cpf_", $cpf_, "", "", 2);
}

//Paginação.
if($GLOBALS['habilitarOrcamentosSitePaginacao'] == "1"){
	$paginacaoNRegistros = $GLOBALS['configOrcamentosSitePaginacaoNRegistros'];
	$paginacaoNumero = $_GET["paginacaoNumero"];
	if($paginacaoNumero == "")
	{
		$paginacaoNumero = 1;
	}
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_paginas", "id_parent", $idParentOrcamentos); //Quantidade de registros.
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
		
//Paginação (subquery).
if($GLOBALS['habilitarOrcamentosSitePaginacao'] == "1"){
	$strSqlOrcamentosSelect .= ", (SELECT COUNT(id) ";
	$strSqlOrcamentosSelect .= "FROM ce_orcamentos ";
	$strSqlOrcamentosSelect .= "WHERE id <> 0 ";
	if($id <> "")
	{
		$strSqlOrcamentosSelect .= "AND id = :id ";
	}
	if($idTbCadastroCliente <> "")
	{
		$strSqlOrcamentosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
	}
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
	$strSqlOrcamentosSelect .= ") totalRegistros ";
}

$strSqlOrcamentosSelect .= "FROM ce_orcamentos ";
$strSqlOrcamentosSelect .= "WHERE id <> 0 ";
if($id <> "")
{
	$strSqlOrcamentosSelect .= "AND id = :id ";
}
if($idTbCadastroCliente <> "")
{
	$strSqlOrcamentosSelect .= "AND id_tb_cadastro_cliente = :id_tb_cadastro_cliente ";
}
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
//$strSqlOrcamentosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentos'] . " ";
if($criterioClassificacao <> "")
{
	$strSqlOrcamentosSelect .= "ORDER BY " . $criterioClassificacao . " ";
}else{
	$strSqlOrcamentosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentos'] . " ";
}

//Paginação.
if($GLOBALS['habilitarOrcamentosSitePaginacao'] == "1"){ 
	if($configTipoDB == 2)
	{
		$strSqlOrcamentosSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
	}
}
//echo "strSqlOrcamentosSelect=" . $strSqlOrcamentosSelect . "<br />";
//----------


//Parâmetros.
//----------
$statementOrcamentosSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosSelect);

if ($statementOrcamentosSelect !== false)
{
	if($id <> "")
	{
		$statementOrcamentosSelect->bindParam(':id', $id, PDO::PARAM_STR);
	}
	if($idTbCadastroCliente <> "")
	{
		$statementOrcamentosSelect->bindParam(':id_tb_cadastro_cliente', $idTbCadastroCliente, PDO::PARAM_STR);
	}
	if($idCeComplementoStatus <> "")
	{
		$statementOrcamentosSelect->bindParam(':id_ce_complemento_status', $idCeComplementoStatus, PDO::PARAM_STR);
	}
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

//Paginação.
if($GLOBALS['habilitarOrcamentosSitePaginacao'] == "1"){
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
	//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
	$paginacaoTotalRegistros = $resultadoOrcamentos[0]['totalRegistros'];
	$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
}

//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentOrcamentos=" . $idParentOrcamentos . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTitulo"); ?>
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



	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.

        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formClassificacaoPersonalizada" id="formClassificacaoPersonalizada" action="SiteAdmClassificacaoPersonalizadaExe.php" method="get" class="FormularioTabela01">
        <input type="hidden" id="idRegistro" name="idRegistro" value="0">
        <input type="hidden" id="strTabela" name="strTabela" value="ce_orcamentos">
        <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
        <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
        
        <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
        <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
        <input type="hidden" id="idTbCadastro" name="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
        
        <table width="100%" class="AdmTabelaDados01">
            <tr class="AdmTbFundoEscuro">
                <td class="AdmTbFundoEscuro AdmTabelaDados01Celula" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaPeriodo"); ?> 
                        [
                        <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=0&strTabela=ce_orcamentos&strExcluir=1<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemClassificacaoPadrao"); ?>
                        </a>
                        ]
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
                <td class="AdmTbFundoClaro">
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
                            <option value="data_pedido desc"<?php if($criterioClassificacao == "data_pedido desc" or $criterioClassificacao == ""){?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosDataClassificacaoDesc"); ?></option>
                            <option value="data_pedido asc"<?php if($criterioClassificacao == "data_pedido desc"){?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosDataClassificacaoAsc"); ?></option>
                        </select> 
                    </div>
                </td>
            </tr>
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
			$('#formOrcamentosFiltros').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "AdmErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					id: {
						//required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					id: {
					  //required: "Campo obrigatório.",
					  //required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
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
    <form name="formOrcamentosFiltros" id="formOrcamentosFiltros" action="SiteAdmOrcamentosIndice.php" method="get" class="FormularioTabela01">
        <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
        <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
        
        <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
        <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
        <input type="hidden" id="idTbCadastro" name="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
        
        <table width="100%" class="AdmTabelaDados01">
            <tr class="AdmTbFundoEscuro">
                <td class="AdmTbFundoEscuro AdmTabelaDados01Celula" colspan="4">
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
                        
                            <input type="text" name="dataInicial" id="dataInicial" class="AdmCampoData01" maxlength="10" value="<?php echo $dataInicial;?>" />
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
                <td class="AdmTbFundoClaro">
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
                        
                            <input type="text" name="dataFinal" id="dataFinal" class="AdmCampoData01" maxlength="10" value="<?php echo $dataFinal;?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="nome" id="nome" class="AdmCampoTexto01" maxlength="255" value="<?php echo $nome;?>" />
                    </div>
                </td>
            </tr>    
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="cpf_" id="cpf_" class="AdmCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formOrcamentosFiltros', 'cpf_');"<?php } ?> value="<?php echo $cpf_;?>" />
                    </div>
                </td>
            </tr>            
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosNumero"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="id" id="id" class="AdmCampoNumerico02" maxlength="10" value="<?php echo $id;?>" />
                    </div>
                </td>
            </tr>            
            
            <?php if($GLOBALS['habilitarAdministrarOrcamentosStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <?php 
                            $arrOrcamentosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
                        ?>
                        <select name="id_ce_complemento_status" id="id_ce_complemento_status" class="AdmCampoDropDownMenu01">
                            <option value=""<?php if($idCeComplementoStatus == ""){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                            <option value="0"<?php if($idCeComplementoStatus == "0"){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrOrcamentosStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrOrcamentosStatus[$countArray][0];?>"<?php if($arrOrcamentosStatus[$countArray][0] == $idCeComplementoStatus){ ?> selected="selected"<?php } ?>><?php echo $arrOrcamentosStatus[$countArray][1];?></option>
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


    <?php
	if (empty($resultadoOrcamentos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formOrcamentosAcoes" id="formOrcamentosAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" name="strTabela" id="strTabela" value="ce_orcamentos" />
            <input type="hidden" name="idTbCadastroCliente" id="idTbCadastroCliente" value="<?php echo $idTbCadastroCliente; ?>" />

            <input type="hidden" name="paginaRetorno" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input type="hidden" name="paginacaoNumero" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" name="caracterAtual" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            
			<?php
            $arrOrcamentosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
            ?>  
            
            
			<?php //Diagramação 2 - tabela.?>
            <?php //**************************************************************************************?>
            <div class="AdmTexto01" style="position: relative; display: block; overflow: hidden; clear: both;">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosNumero"); ?>
                    </div>
                </td>
                
                <td width="150" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosData"); ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
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
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorTotal"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarOrcamentosStatus'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosStatus"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc1'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc2'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc2'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc3'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc3'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc4'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc4'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc5'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc5'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
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
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              
              <?php
				$countTabelaFundo = 0;
				//$arrOrcamentosStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 11);
			  
                //Loop pelos resultados.
                foreach($resultadoOrcamentos as $linhaOrcamentos)
                {
					$tbOrcamentosValorOrcamento = 0;
					$tbOrcamentosValorOrcamento = Orcamentos::OrcamentoTotal($linhaOrcamentos['id'], 1);
              ?>
              
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaOrcamentos['id'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo Funcoes::DataLeitura01($linhaOrcamentos['data_orcamento'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                    </div>
                    
					<?php if($GLOBALS['habilitarOrcamentosDataEntrega'] == 1){ ?>
                    <br />
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosDataEntrega"); ?>: 
                        </strong>
                        <?php echo Funcoes::DataLeitura01($linhaOrcamentos['data_entrega'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                    </div>
                    <?php } ?>
                </td>
              
                <td class="AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto01">
                        <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $linhaOrcamentos['id_tb_cadastro_cliente']; /*$idParent;*/?>&masterPageSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
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
						<?php echo $GLOBALS['configSiteMoeda'] . " ";?>
                        <?php //echo Funcoes::MascaraValorLer($linhaOrcamentos['valor_orcamento']);?>
                        <?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento, $GLOBALS['configSiteMoeda']);?>
                    </div>
                    
					<?php if($GLOBALS['habilitarAdministrarOrcamentosFrete'] == 1){ ?>
                    <div align="center">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorFrete"); ?>: 
                        </strong>
                        <?php echo $GLOBALS['configSiteMoeda'] . " ";?>
                        <?php echo Funcoes::MascaraValorLer($linhaOrcamentos['valor_frete']);?>
                    </div>
                    <?php } ?>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo $GLOBALS['configSiteMoeda'] . " ";?>
                        <?php //echo Funcoes::MascaraValorLer($linhaOrcamentos['valor_total']);?>
                        <?php echo Funcoes::MascaraValorLer(($tbOrcamentosValorOrcamento + $linhaOrcamentos['valor_frete']), $GLOBALS['configSiteMoeda']);?>
                    </div>
                </td>
                
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
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar1']); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosIc2'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar2']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc3'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar3']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc4'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar4']); ?>
                    </div>
                </td>
                <?php } ?>

                <?php if($GLOBALS['habilitarOrcamentosIc5'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar5']); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01" style="display: none;">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteCarrinhoOrcamentos.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    
                    <div align="center">
                        <a href="SiteAdmOrcamento.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>&idTbCadastroCliente=<?php echo $linhaOrcamentos['id_tb_cadastro_cliente'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciar"); ?>
                        </a>
                    </div>
                    
					<?php if($GLOBALS['habilitarOrcamentosProdutosVinculosMultiplos'] == 1){ ?>
                    <div align="center" class="Texto01">
                        <a href="SiteAdmOrcamentosRelacaoRegistrosIndice.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>&tipoCategoria=2&masterPageSiteSelect=LayoutSiteSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentos['informacao_complementar1']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                        </a>
                    </div>
                    <?php } ?>

                    <?php if($GLOBALS['habilitarOrcamentosEnvio'] == 1){ ?>
                    <div align="center">

                    </div>
                    <?php } ?>
                    
                    <div align="center">
                    	<a href="../<?php echo $GLOBALS['configDiretorioSistema'];?>/OrcamentosDetalhes.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?>&masterPageSelect=LayoutSiteImpressao.php" target="_blank" class="AdmLinks01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaOrcamentos['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentos['id'];?>&statusAtivacao=<?php echo $linhaOrcamentos['ativacao'];?>&strTabela=ce_orcamentos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
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

                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmOrcamentosEditar.php?idCeOrcamentos=<?php echo $linhaOrcamentos['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentos['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaOrcamentos['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaOrcamentos['id'];?>" class="AdmCampoRadioButton01" />
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
            <?php //**************************************************************************************?>
        </form>
	<?php } ?>
    
    
	<?php //Paginação. ?>
    <?php //************************************************************************************** ?>
    <?php if($GLOBALS['habilitarOrcamentosSitePaginacao'] == "1"){ ?>
		<?php if($paginacaoTotal > 1){ //Verifica se existe mais de uma página.?>
            <div align="center" class="AdmTexto01">
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=1<?php echo $queryPadrao; ?>" class="AdmLinks03">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoPrimeira"); ?>
                    </a>
                </div>
                
                <?php if($paginacaoNumero > 1){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero - 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoAnterior"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <?php //Numeração de páginas. ?>
                <?php if($GLOBALS['habilitarOrcamentosSitePaginacaoNumeracao'] == "1"){ ?>
                    <?php for($countOrcamentos = 1; $countOrcamentos <= $paginacaoTotal; $countOrcamentos++){ ?>
                        <div style="position: relative; display: inline; margin: 2px;">
                            <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $countOrcamentos; ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
                                <?php echo $countOrcamentos; ?>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                <?php if($paginacaoNumero <> $paginacaoTotal){ ?>
                    <div style="position: relative; display: inline; margin: 2px;">
                        <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoNumero + 1 ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPaginacaoProxima"); ?>
                        </a>
                    </div>
                <?php } ?>
                
                <div style="position: relative; display: inline; margin: 2px;">
                    <a href="<?php echo $paginaRetorno; ?>?paginacaoNumero=<?php echo $paginacaoTotal; ?><?php echo $queryPadrao; ?>" class="AdmLinks03">
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
?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>