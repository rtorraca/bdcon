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
$idsCePedidos = "";

//$itensValorTotal = 0;

$informacaoComplementar1 = $_GET["informacao_complementar1"];
$informacaoComplementar2 = $_GET["informacao_complementar2"];

$dataPedidosParcelaOnLoad = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");

$dataInicial = $_GET["dataInicial"];
$dataFinal = $_GET["dataFinal"];
$dataInicialConvert = strtotime(Funcoes::DataGravacaoSql($dataInicial, $GLOBALS['configSiteFormatoData']));
$dataFinalConvert = strtotime(Funcoes::DataGravacaoSql($dataFinal, $GLOBALS['configSiteFormatoData']));

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

//Seleção de todas as parcelas de um cadastro.
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];
if($idTbCadastroCliente <> "" && $idCePedidos == "")
{
	$idsCePedidos = DbFuncoes::GetCampoGenerico06("ce_pedidos", 
												"id", 
												"id_tb_cadastro_cliente", 
												$idTbCadastroCliente, 
												"", 
												"", 
												1,
												"", 
												"", 
												"", 
												"", 
												"", 
												"");
	if($idsCePedidos == "")
	{
		$idsCePedidos = "0";	
	}
}

$paginaRetorno = "SiteAdmPedidosParcelasIndice.php";
$paginaRetornoExclusao = "SiteAdmPedidosParcelasEditar.php";
$variavelRetorno = "idCePedidos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idCePedidos=" . $idCePedidos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br/>";
//echo "idsCePedidos=" . $idsCePedidos . "<br/>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasTitulo"); ?>
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


    <?php //Pedidos. ?>
    <?php if($idCePedidos <> ""){ ?>
		<?php
        //Query de pesquisa.
        //----------
        $strSqlPedidosDetalhesSelect = "";
        $strSqlPedidosDetalhesSelect .= "SELECT ";
        //$strSqlPedidosDetalhesSelect .= "* ";
        $strSqlPedidosDetalhesSelect .= "id, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cliente, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cartoes, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro_usuario, ";
        $strSqlPedidosDetalhesSelect .= "tipo_pagamento, ";
        $strSqlPedidosDetalhesSelect .= "data_pedido, ";
        $strSqlPedidosDetalhesSelect .= "data_pagamento, ";
        $strSqlPedidosDetalhesSelect .= "data_entrega, ";
        $strSqlPedidosDetalhesSelect .= "data_validade, ";
        $strSqlPedidosDetalhesSelect .= "valor_pedido, ";
        $strSqlPedidosDetalhesSelect .= "valor_frete, ";
        $strSqlPedidosDetalhesSelect .= "periodo_contratacao, ";
        $strSqlPedidosDetalhesSelect .= "tipo_entrega, ";
        $strSqlPedidosDetalhesSelect .= "valor_total, ";
        $strSqlPedidosDetalhesSelect .= "peso_total, ";
        $strSqlPedidosDetalhesSelect .= "endereco_entrega, ";
        $strSqlPedidosDetalhesSelect .= "endereco_numero_entrega, ";
        $strSqlPedidosDetalhesSelect .= "endereco_complemento_entrega, ";
        $strSqlPedidosDetalhesSelect .= "bairro_entrega, ";
        $strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
        $strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
        $strSqlPedidosDetalhesSelect .= "pais_entrega, ";
        $strSqlPedidosDetalhesSelect .= "cep_entrega, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro1, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro2, ";
        $strSqlPedidosDetalhesSelect .= "id_tb_cadastro3, ";
        $strSqlPedidosDetalhesSelect .= "obs, ";
        $strSqlPedidosDetalhesSelect .= "ativacao, ";
        $strSqlPedidosDetalhesSelect .= "informacao_complementar1, ";
        $strSqlPedidosDetalhesSelect .= "informacao_complementar2, ";
        $strSqlPedidosDetalhesSelect .= "informacao_complementar3, ";
        $strSqlPedidosDetalhesSelect .= "informacao_complementar4, ";
        $strSqlPedidosDetalhesSelect .= "informacao_complementar5, ";
        $strSqlPedidosDetalhesSelect .= "id_ce_complemento_status, ";
        $strSqlPedidosDetalhesSelect .= "transacao_externa_status, ";
        $strSqlPedidosDetalhesSelect .= "transacao_externa_autenticacao, ";
        $strSqlPedidosDetalhesSelect .= "transacao_externa_log, ";
        $strSqlPedidosDetalhesSelect .= "transacao_externa_data_pagamento_liberado ";
        $strSqlPedidosDetalhesSelect .= "FROM ce_pedidos ";
        $strSqlPedidosDetalhesSelect .= "WHERE id <> 0 ";
        //$strSqlPedidosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
        $strSqlPedidosDetalhesSelect .= "AND id = :id ";
        //$strSqlPedidosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
        //echo "strSqlPedidosDetalhesSelect=" . $strSqlPedidosDetalhesSelect . "<br>";
        //----------
        
        
        //Parâmetros.
        //----------
        $statementPedidosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPedidosDetalhesSelect);
        
        if ($statementPedidosDetalhesSelect !== false)
        {
            $statementPedidosDetalhesSelect->execute(array(
                "id" => $idCePedidos
            ));
        }
        //----------
        
        
        //$resultadoPedidosDetalhes = $dbSistemaConPDO->query($strSqlPedidosDetalhesSelect);
        $resultadoPedidosDetalhes = $statementPedidosDetalhesSelect->fetchAll();
        
        if (empty($resultadoPedidosDetalhes))
        {
            //echo "Nenhum registro encontrado";
        }else{
            foreach($resultadoPedidosDetalhes as $linhaPedidosDetalhes)
            {
                //Definição das variáveis de detalhes.
                $tbPedidosId = $linhaPedidosDetalhes['id'];
                $tbPedidosIdTbCadastroCliente = $linhaPedidosDetalhes['id_tb_cadastro_cliente'];
                $tbPedidosIdTbCadastroEnderecos = $linhaPedidosDetalhes['id_tb_cadastro_enderecos'];
                $tbPedidosIdTbCadastroCartoes = $linhaPedidosDetalhes['id_tb_cadastro_cartoes'];
                $tbPedidosIdTbCadastroUsuario = $linhaPedidosDetalhes['id_tb_cadastro_usuario'];
                $tbPedidosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_pagamento']);
                
                //$tbPedidosDataPedido = $linhaPedidosDetalhes['data_pedido'];
                if($linhaPedidosDetalhes['data_pedido'] == NULL)
                {
                    $tbPedidosDataPedido = "";
                }else{
                    $tbPedidosDataPedido = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pedido'], $GLOBALS['configSiteFormatoData'], "1");
                }
                
                //$tbPedidosDataPagamento = $linhaPedidosDetalhes['data_pagamento'];
                if($linhaPedidosDetalhes['data_pagamento'] == NULL)
                {
                    $tbPedidosDataPagamento = "";
                }else{
                    $tbPedidosDataPagamento = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pagamento'], $GLOBALS['configSiteFormatoData'], "1");
                }
        
                //$tbPedidosDataEntrega = $linhaPedidosDetalhes['data_entrega'];
                if($linhaPedidosDetalhes['data_entrega'] == NULL)
                {
                    $tbPedidosDataEntrega = "";
                }else{
                    $tbPedidosDataEntrega = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_entrega'], $GLOBALS['configSiteFormatoData'], "1");
                }
        
                //$tbPedidosDataValidade = $linhaPedidosDetalhes['data_validade'];
                if($linhaPedidosDetalhes['data_validade'] == NULL)
                {
                    $tbPedidosDataValidade = "";
                }else{
                    $tbPedidosDataValidade = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_validade'], $GLOBALS['configSiteFormatoData'], "1");
                }
        
                //$tbPedidosValorPedido = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
                $tbPedidosValorPedido = $linhaPedidosDetalhes['valor_pedido'];
        
                //$tbPedidosValorFrete = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
                $tbPedidosValorFrete = $linhaPedidosDetalhes['valor_frete'];
        
                $tbPedidosPeriodoContratacao = $linhaPedidosDetalhes['periodo_contratacao'];
                $tbPedidosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_entrega']);
        
                //$tbPedidosValorTotal = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
                $tbPedidosValorTotal = $linhaPedidosDetalhes['valor_total'];
        
                $tbPedidosPesoTotal = $linhaPedidosDetalhes['peso_total'];
                $tbPedidosEnderecoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_entrega']);
                $tbPedidosEnderecoNumeroEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_numero_entrega']);
                $tbPedidosEnderecoComplementoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_complemento_entrega']);
                $tbPedidosBairroEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['bairro_entrega']);
                $tbPedidosCidadeEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['cidade_entrega']);
                $tbPedidosEstadoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['estado_entrega']);
                $tbPedidosPaisEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['pais_entrega']);
                $tbPedidosCepEntrega = Funcoes::FormatarCEPLer($linhaPedidosDetalhes['cep_entrega']);
                $tbPedidosIdTbCadastro1 = $linhaPedidosDetalhes['id_tb_cadastro1'];
                $tbPedidosIdTbCadastro2 = $linhaPedidosDetalhes['id_tb_cadastro2'];
                $tbPedidosIdTbCadastro3 = $linhaPedidosDetalhes['id_tb_cadastro3'];
                $tbPedidosOBS = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['obs']);
                $tbPedidosAtivacao = $linhaPedidosDetalhes['ativacao'];
                $tbPedidosIC1 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar1']);
                $tbPedidosIC2 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar2']);
                $tbPedidosIC3 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar3']);
                $tbPedidosIC4 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar4']);
                $tbPedidosIC5 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar5']);
                $tbPedidosIdCeComplementoStatus = $linhaPedidosDetalhes['id_ce_complemento_status'];
                $tbPedidosTransacaoExternaStatus = $linhaPedidosDetalhes['transacao_externa_status'];
                $tbPedidosTransacaoExternaAutenticacao = $linhaPedidosDetalhes['transacao_externa_autenticacao'];
                $tbPedidosTransacaoExternaLog = $linhaPedidosDetalhes['transacao_externa_log'];
                $tbPedidosTransacaoExternaDataPagamentoLiberado = $linhaPedidosDetalhes['transacao_externa_data_pagamento_liberado'];
                
                
                //Verificação de erro.
                //echo "tbPedidosId=" . $tbPedidosId . "<br>";
                //echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
                //echo "tbPedidosAtivacao=" . $tbPedidosAtivacao . "<br>";
            }
        }
        ?>
        
        
        <?php
        //Limpeza de objetos.
        //----------
        unset($strSqlPedidosDetalhesSelect);
        unset($statementPedidosDetalhesSelect);
        unset($resultadoPedidosDetalhes);
        unset($linhaPedidosDetalhes);
        //----------
        ?>
    <?php } ?>
    
    
    <?php //Parcelas. ?>
    <?php
	//Query de pesquisa.
	//----------
	$strSqlPedidosParcelasSelect = "";
	$strSqlPedidosParcelasSelect .= "SELECT ";
	//$strSqlPedidosParcelasSelect .= "* ";
	$strSqlPedidosParcelasSelect .= "id, ";
	$strSqlPedidosParcelasSelect .= "id_ce_pedidos, ";
	$strSqlPedidosParcelasSelect .= "n_parcela, ";
	$strSqlPedidosParcelasSelect .= "data_vencimento, ";
	$strSqlPedidosParcelasSelect .= "data_pagamento, ";
	$strSqlPedidosParcelasSelect .= "valor, ";
	$strSqlPedidosParcelasSelect .= "valor_desconto, ";
	$strSqlPedidosParcelasSelect .= "valor_acrescimo, ";
	$strSqlPedidosParcelasSelect .= "valor_total, ";
	
	$strSqlPedidosParcelasSelect .= "ativacao, ";
	$strSqlPedidosParcelasSelect .= "id_tb_cadastro1, ";
	$strSqlPedidosParcelasSelect .= "id_tb_cadastro2, ";
	$strSqlPedidosParcelasSelect .= "id_tb_cadastro3, ";
	
	$strSqlPedidosParcelasSelect .= "informacao_complementar1, ";
	$strSqlPedidosParcelasSelect .= "informacao_complementar2, ";
	$strSqlPedidosParcelasSelect .= "informacao_complementar3, ";
	$strSqlPedidosParcelasSelect .= "informacao_complementar4, ";
	$strSqlPedidosParcelasSelect .= "informacao_complementar5, ";
	
	$strSqlPedidosParcelasSelect .= "id_ce_complemento_tipo, ";
	$strSqlPedidosParcelasSelect .= "id_ce_complemento_status ";

	$strSqlPedidosParcelasSelect .= "FROM ce_pedidos_parcelas ";
	$strSqlPedidosParcelasSelect .= "WHERE id <> 0 ";
	if($idCePedidos <> "")
	{
		$strSqlPedidosParcelasSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
	}
	if($idsCePedidos <> "")
	{
		$strSqlPedidosParcelasSelect .= "AND id_ce_pedidos IN (" . Funcoes::ConteudoMascaraGravacao01($idsCePedidos) . ") ";
	}
	//if($dataInicial <> "" && $dataFinal <> "")
	//{
		$strSqlPedidosParcelasSelect .= "AND data_vencimento BETWEEN '" . $anoDataInicial . "-" . $mesDataInicial . "-" . $diaDataInicial . "' AND '" . $anoDataFinal . "-" . $mesDataFinal . "-" . $diaDataFinal . "' "; //funcionando
		//$strSqlPedidosParcelasSelect .= "AND data_vencimento BETWEEN DATE(:dataInicial) AND DATE(:dataFinal) ";
		//$strSqlPedidosParcelasSelect .= "AND data_vencimento BETWEEN :dataInicial AND :dataFinal ";
	//}
	if($informacaoComplementar1 <> "")
	{
		$strSqlPedidosParcelasSelect .= "AND informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($informacaoComplementar1) . "%' ";
	}
	if($informacaoComplementar2 <> "")
	{
		$strSqlPedidosParcelasSelect .= "AND informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($informacaoComplementar2) . "%' ";
	}
	//$strSqlPedidosParcelasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosParcelas'] . " ";
	//if($GLOBALS['habilitarPedidosParcelasClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosParcelas) <> "")
	//{
		//$strSqlPedidosParcelasSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosParcelas) . " ";
		
	//}else{
		$strSqlPedidosParcelasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosParcelas'] . " ";
	//}
	
	//echo "strSqlPedidosParcelasSelect=" . $strSqlPedidosParcelasSelect . "<br />";
	//----------
	
	
	//Parâmetros.
	//----------
	$statementPedidosParcelasSelect = $dbSistemaConPDO->prepare($strSqlPedidosParcelasSelect);
	
	if ($statementPedidosParcelasSelect !== false)
	{
		if($idCePedidos <> "")
		{
			$statementPedidosParcelasSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
		}
		$statementPedidosParcelasSelect->execute();
		
		/*
		$statementPedidosParcelasSelect->execute(array(
			"id_parent" => $idParentPedidosParcelas
		));
		*/
	}
	//----------
	
	
	//$resultadoPedidosParcelas = $dbSistemaConPDO->query($strSqlPedidosParcelasSelect);
	$resultadoPedidosParcelas = $statementPedidosParcelasSelect->fetchAll();
	?>

    <?php
	if (empty($resultadoPedidosParcelas))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formPedidosParcelasAcoes" id="formPedidosParcelasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="ce_pedidos_parcelas" />
            <input name="idCePedidos" id="idCePedidos" type="hidden" value="<?php echo $idCePedidos; ?>" />

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
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasNParcela"); ?>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasDataVencimento"); ?>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasDataPagamento"); ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosCadastroCliente"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPedidosParcelasTipo'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasTipo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosParcelasStatus'] == 1){ ?>
                <td width="100" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasStatus"); ?>
                    </div>
                </td>
                <?php } ?>

                <td width="80" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValor"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPedidosParcelasValorDesconto'] == 1){ ?>
                <td width="80" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValorDesconto"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosParcelasValorAcrescimo'] == 1){ ?>
                <td width="80" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValorAcrescimo"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosParcelasValorTotal'] == 1){ ?>
                <td width="80" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValorTotal"); ?>
                    </div>
                </td>
                <?php } ?>

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
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;
				
				$countRegistros = 0;
				$valorSoma = 0;
			  
				$arrPedidosParcelasTipo = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 9);
				$arrPedidosParcelasStatus = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 10);
				
				//Loop pelos resultados.
				foreach($resultadoPedidosParcelas as $linhaPedidosParcelas)
				{
					
					$countRegistros++;
					$valorSoma = $valorSoma + $linhaPedidosParcelas['valor'];
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaPedidosParcelas['n_parcela'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaPedidosParcelas['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaPedidosParcelas['data_vencimento'], $GLOBALS['configSiteFormatoData'], "1");?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaPedidosParcelas['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaPedidosParcelas['data_pagamento'], $GLOBALS['configSiteFormatoData'], "1");?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php //echo Funcoes::ConteudoMascaraLeitura($linhaPedidosParcelas['id_ce_pedidos']);?>
                        <?php if($idCePedidos <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbPedidosIdTbCadastroCliente;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        <?php } ?>
                        
                        <?php if($idCePedidos == ""){ ?>
							<?php
                            $idTbCadastroCliente = DbFuncoes::GetCampoGenerico01($linhaPedidosParcelas['id_ce_pedidos'], "ce_pedidos", "id_tb_cadastro_cliente");
                            ?>
                            <a href="CadastroAdministrar.php?idTbCadastro=<?php echo $idTbCadastroCliente;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($idTbCadastroCliente, "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPedidosParcelasTipo'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrPedidosParcelasTipo); $countArray++)
                        {
                        ?>
                            <?php if($arrPedidosParcelasTipo[$countArray][0] == $linhaPedidosParcelas['id_ce_complemento_tipo']){ ?>
                                <?php echo $arrPedidosParcelasTipo[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosParcelasStatus'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
						<?php 
                        for($countArray = 0; $countArray < count($arrPedidosParcelasStatus); $countArray++)
                        {
                        ?>
                            <?php if($arrPedidosParcelasStatus[$countArray][0] == $linhaPedidosParcelas['id_ce_complemento_status']){ ?>
                                <?php echo $arrPedidosParcelasStatus[$countArray][1];?>
                            <?php } ?>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="right" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosParcelas['valor'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarPedidosParcelasValorDesconto'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="right" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosParcelas['valor_desconto'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosParcelasValorAcrescimo'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="right" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosParcelas['valor_acrescimo'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarPedidosParcelasValorTotal'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="right" class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosParcelas['valor_total'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaPedidosParcelas['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaPedidosParcelas['id'];?>&statusAtivacao=<?php echo $linhaPedidosParcelas['ativacao'];?>&strTabela=ce_pedidos_parcelas&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaPedidosParcelas['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaPedidosParcelas['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaPedidosParcelas['ativacao'];?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmPedidosParcelasEditar.php?idCePedidosParcelas=<?php echo $linhaPedidosParcelas['id'];?>&idCePedidos=<?php echo $idCePedidos;?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaPedidosParcelas['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaPedidosParcelas['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaPedidosParcelas['id'];?>" class="AdmCampoRadioButton01" />
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
        <div class="AdmTexto01" style="position: relative; display: none; border-top: 1px solid #000;">
            TOTAL: 
            <span style="margin-left: 50px;">
                <?php echo $countRegistros;?>
            </span>
            <span style="margin-left: 50px;">
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                <?php echo Funcoes::MascaraValorLer($valorSoma, $GLOBALS['configSistemaMoeda']);?>
            </span>
        </div>
	<?php } ?>
    
    
    <?php if($idCePedidos <> ""){ ?>
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
			$('#formPedidosParcelas').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_parcelas: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
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
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_parcelas: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					},
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					}//,
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
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formPedidosParcelas" id="formPedidosParcelas" action="SiteAdmPedidosParcelasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasTbParcelas"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasDataVencimento"); ?>:
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
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_vencimento;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_vencimento;";
                                </script>
                            <?php } ?>
                            <input type="text" name="data_vencimento" id="data_vencimento" class="AdmCampoData01" maxlength="10" value="<?php echo $dataPedidosParcelaOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
                
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasDataPagamento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_pagamento;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_pagamento;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_pagamento" id="data_pagamento" class="AdmCampoData01" maxlength="10" value="<?php //echo $dataPedidosParcelaOnLoad; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor" id="valor" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasNParcela"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_parcela" id="n_parcela" class="AdmCampoNumerico01" maxlength="10" value="1" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPedidosParcelasValorDesconto'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValorDesconto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_desconto" id="valor_desconto" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPedidosParcelasValorAcrescimo'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValorAcrescimo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_acrescimo" id="valor_acrescimo" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPedidosParcelasValorTotal'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasValorTotal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_total" id="valor_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer("0", $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
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
                            <option value="0" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPedidosParcelasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc1'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarPedidosParcelasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc2'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarPedidosParcelasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc3'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarPedidosParcelasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc4'] == 2){ ?>
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
        
            <?php if($GLOBALS['habilitarPedidosParcelasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto01" maxlength="255" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosParcelasBoxIc5'] == 2){ ?>
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
            
            <?php if($GLOBALS['habilitarPedidosParcelasTipo'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasTipo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php 
                            $arrPedidosParcelasTipo = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 9);
                        ?>
                        <select name="id_ce_complemento_tipo" id="id_ce_complemento_tipo" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosParcelasTipo); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosParcelasTipo[$countArray][0];?>"><?php echo $arrPedidosParcelasTipo[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
			<?php } ?>
            
            <?php if($GLOBALS['habilitarPedidosParcelasStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosParcelasStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php 
                            $arrPedidosParcelasStatus = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 10);
                        ?>
                        <select name="id_ce_complemento_status" id="id_ce_complemento_status" class="AdmCampoDropDownMenu01">
                            <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosParcelasStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosParcelasStatus[$countArray][0];?>"><?php echo $arrPedidosParcelasStatus[$countArray][1];?></option>
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
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <input name="id_ce_pedidos" type="hidden" id="id_ce_pedidos" value="<?php echo $idCePedidos; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    <?php } ?>
    
        
    <?php
	//Limpeza de objetos.
	//----------
	unset($strSqlPedidosParcelasSelect);
	unset($statementPedidosParcelasSelect);
	unset($resultadoPedidosParcelas);
	unset($linhaPedidosParcelas);
	//----------
	?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>