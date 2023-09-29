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

//$itensValorTotal = "0";
$itensValorTotal = 0;

$paginaRetorno = "SiteAdmPedidosIndice.php";
$paginaRetornoExclusao = "SiteAdmPedidosEditar.php";
$variavelRetorno = "idCePedidos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastro=" . $idTbCadastro . 
"&idCePedidos=" . $idCePedidos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


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
$strSqlPedidosDetalhesSelect .= "valor_desconto, ";
$strSqlPedidosDetalhesSelect .= "valor_acrescimo, ";
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
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro4, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro5, ";
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
		$tbPedidosIdTbCadastroClienteNomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "nome"), 
																						DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "razao_social"), 
																						DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "nome_fantasia"), 
																						1));
		$tbPedidosIdTbCadastroClienteCPF = Funcoes::FormatarCPFLer(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastroCliente, "tb_cadastro", "cpf_"));
		
		$tbPedidosIdTbCadastroEnderecos = $linhaPedidosDetalhes['id_tb_cadastro_enderecos'];
		$tbPedidosIdTbCadastroCartoes = $linhaPedidosDetalhes['id_tb_cadastro_cartoes'];
		$tbPedidosIdTbCadastroUsuario = $linhaPedidosDetalhes['id_tb_cadastro_usuario'];
		$tbPedidosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_pagamento']);
		
		//$tbPedidosDataPedido = $linhaPedidosDetalhes['data_pedido'];
		if($linhaPedidosDetalhes['data_pedido'] == NULL)
		{
			$tbPedidosDataPedido = "";
		}else{
			$tbPedidosDataPedido = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pedido'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		//$tbPedidosDataPagamento = $linhaPedidosDetalhes['data_pagamento'];
		if($linhaPedidosDetalhes['data_pagamento'] == NULL)
		{
			$tbPedidosDataPagamento = "";
		}else{
			$tbPedidosDataPagamento = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pagamento'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbPedidosDataEntrega = $linhaPedidosDetalhes['data_entrega'];
		if($linhaPedidosDetalhes['data_entrega'] == NULL)
		{
			$tbPedidosDataEntrega = "";
		}else{
			$tbPedidosDataEntrega = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbPedidosDataValidade = $linhaPedidosDetalhes['data_validade'];
		if($linhaPedidosDetalhes['data_validade'] == NULL)
		{
			$tbPedidosDataValidade = "";
		}else{
			$tbPedidosDataValidade = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_validade'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbPedidosValorPedido = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
		$tbPedidosValorPedido = $linhaPedidosDetalhes['valor_pedido'];

		//$tbPedidosValorFrete = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
		$tbPedidosValorFrete = $linhaPedidosDetalhes['valor_frete'];

		$tbPedidosPeriodoContratacao = $linhaPedidosDetalhes['periodo_contratacao'];
		$tbPedidosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_entrega']);

		$tbPedidosValorDesconto = $linhaPedidosDetalhes['valor_desconto'];
		$tbPedidosValorAcrescimo = $linhaPedidosDetalhes['valor_acrescimo'];

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
		$tbPedidosIdTbCadastro1NomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro1, "tb_cadastro", "nome"), 
																					DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro1, "tb_cadastro", "razao_social"), 
																					DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
																					1));

		$tbPedidosIdTbCadastro2 = $linhaPedidosDetalhes['id_tb_cadastro2'];
		$tbPedidosIdTbCadastro3 = $linhaPedidosDetalhes['id_tb_cadastro3'];
		$tbPedidosIdTbCadastro4 = $linhaPedidosDetalhes['id_tb_cadastro4'];
		$tbPedidosIdTbCadastro5 = $linhaPedidosDetalhes['id_tb_cadastro5'];
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


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTituloEditar"); ?>
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


    <form name="formPedidosEditar" id="formPedidosEditar" action="SiteAdmPedidosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
        <script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
            var strDatapickerGenericoPtCampos = "#data_pedido;#data_pagamento;#data_entrega;#data_validade";
        </script>
        <?php } ?>
        <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTbPedidosEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbPedidosId; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php if($GLOBALS['habilitarEdicaoPedidosData'] == 1){ ?>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <input type="text" name="data_pedido" id="data_pedido" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataPedido;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        <?php }else{ ?>
                            <?php echo $tbPedidosDataPedido; ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosTipoPagamento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="tipo_pagamento" id="tipo_pagamento" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosTipoPagamento; ?>" />
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
                        <input type="text" name="data_pagamento" id="data_pagamento" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataPagamento;?>" />
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
                        <input type="text" name="data_entrega" id="data_entrega" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataEntrega;?>" />
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
                        <input type="text" name="data_validade" id="data_validade" class="AdmCampoData01" maxlength="10" value="<?php echo $tbPedidosDataValidade;?>" />
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
                        <input type="text" name="valor_pedido" id="valor_pedido" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorPedido, $GLOBALS['configSistemaMoeda']); ?>" />
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
                        <input type="text" name="valor_frete" id="valor_frete" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorFrete, $GLOBALS['configSistemaMoeda']); ?>" />
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
                        <input type="text" name="tipo_entrega" id="tipo_entrega" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosTipoEntrega; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
                <?php if($GLOBALS['habilitarPedidosValorDesconto'] == 1){ ?>
                <?php
				$tbPedidosValorTotal = $tbPedidosValorTotal - $tbPedidosValorDesconto;
				?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorDesconto"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left" class="AdmTexto01">
							<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                            <input type="text" name="valor_desconto" id="valor_desconto" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorDesconto, $GLOBALS['configSistemaMoeda']); ?>" />
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
                            <input type="text" name="valor_acrescimo" id="valor_acrescimo" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorAcrescimo, $GLOBALS['configSistemaMoeda']); ?>" />
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
                        <input type="text" name="valor_total" id="valor_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorTotal, $GLOBALS['configSistemaMoeda']); ?>" />
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
                        <input type="text" name="peso_total" id="peso_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbPedidosPesoTotal; ?>" />
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
                            <option value="0"<?php if($tbPedidosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbPedidosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
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
                            <option value="0"<?php if($tbPedidosIdCeComplementoStatus == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosStatus[$countArray][0];?>"<?php if($arrPedidosStatus[$countArray][0] == $tbPedidosIdCeComplementoStatus){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosStatus[$countArray][1];?></option>
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
                            <option value="0"<?php if($tbPedidosIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosVinculo1); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosVinculo1[$countArray][0];?>"<?php if($arrPedidosVinculo1[$countArray][0] == $tbPedidosIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo1[$countArray][1];?></option>
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
                            <option value="0"<?php if($tbPedidosIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosVinculo2[$countArray][0];?>"<?php if($arrPedidosVinculo2[$countArray][0] == $tbPedidosIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo2[$countArray][1];?></option>
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
                            <option value="0"<?php if($tbPedidosIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosVinculo3[$countArray][0];?>"<?php if($arrPedidosVinculo3[$countArray][0] == $tbPedidosIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo3[$countArray][1];?></option>
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
                            <option value="0"<?php if($tbPedidosIdTbCadastro4 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosVinculo4); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosVinculo4[$countArray][0];?>"<?php if($arrPedidosVinculo4[$countArray][0] == $tbPedidosIdTbCadastro4){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo4[$countArray][1];?></option>
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
                            <option value="0"<?php if($tbPedidosIdTbCadastro5 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosVinculo5); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPedidosVinculo5[$countArray][0];?>"<?php if($arrPedidosVinculo5[$countArray][0] == $tbPedidosIdTbCadastro5){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosVinculo5[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							//echo "FiltrosGenericosSelect03=" . FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "12", "", ",", "", "1") . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "12", "", ",", "", "1") . "<br />";
							//FiltrosGenericosSelect03($idRegistro, $srtTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
							//FiltrosGenericosSelect03($idRegistro, $strTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
							
							$arrPedidosFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "12", "", ",", "", "1"));
							//echo "arrPedidosFiltroGenerico01Selecao=" . $arrPedidosFiltroGenerico01Selecao[0] . "<br />";
							//echo "in_array=" . in_array("03", $arrPedidosFiltroGenerico01Selecao) . "<br />";
						
                            //echo "arrPedidosFiltroGenerico01Selecao=" . $arrPedidosFiltroGenerico01Selecao . "<br />";
                            //echo "arrPedidosFiltroGenerico01Selecao[0]=" . $arrPedidosFiltroGenerico01Selecao[0] . "<br />";
						?>
                    
						<?php 
                            $arrPedidosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico01[$countArray][0], $arrPedidosFiltroGenerico01Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico01[]" name="idsPedidosFiltroGenerico01[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico01[$countArray][0], $arrPedidosFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico01[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico01[$countArray][0], $arrPedidosFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico01[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "13", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPedidosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 13);
                            //echo "arrPedidosFiltroGenerico02Selecao=" . $arrPedidosFiltroGenerico02Selecao . "<br />";
                            //echo "arrPedidosFiltroGenerico02Selecao[0]=" . $arrPedidosFiltroGenerico02Selecao[0] . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbPedidosId=" . $tbPedidosId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico02[$countArray][0], $arrPedidosFiltroGenerico02Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico02[]" name="idsPedidosFiltroGenerico02[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico02[$countArray][0], $arrPedidosFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico02[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico02[$countArray][0], $arrPedidosFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico02[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "14", "", ",", "", "1"));
						?>

						<?php 
                            $arrPedidosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico03[$countArray][0], $arrPedidosFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico03[]" name="idsPedidosFiltroGenerico03[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico03[$countArray][0], $arrPedidosFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico03[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico03[$countArray][0], $arrPedidosFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico03[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "15", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPedidosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico04[$countArray][0], $arrPedidosFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico04[]" name="idsPedidosFiltroGenerico04[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico04[$countArray][0], $arrPedidosFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico04[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico04[$countArray][0], $arrPedidosFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico04[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "16", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPedidosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico05[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico05[$countArray][0], $arrPedidosFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico05[]" name="idsPedidosFiltroGenerico05[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico05[$countArray][0], $arrPedidosFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico05[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico05[$countArray][0], $arrPedidosFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico05[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "17", "", ",", "", "1"));
						?>

						<?php 
                            $arrPedidosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico06[$countArray][0], $arrPedidosFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico06[]" name="idsPedidosFiltroGenerico06[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico06[$countArray][0], $arrPedidosFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico06[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico06[$countArray][0], $arrPedidosFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico06[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "18", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPedidosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico07[$countArray][0], $arrPedidosFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico07[]" name="idsPedidosFiltroGenerico07[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico07[$countArray][0], $arrPedidosFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico07[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico07[$countArray][0], $arrPedidosFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico07[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "19", "", ",", "", "1"));
						?>

						<?php 
                            $arrPedidosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico08[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico08[$countArray][0], $arrPedidosFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico08[]" name="idsPedidosFiltroGenerico08[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico08[$countArray][0], $arrPedidosFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico08[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico08[$countArray][0], $arrPedidosFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico08[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "20", "", ",", "", "1"));
						?>

						<?php 
                            $arrPedidosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico09[$countArray][0], $arrPedidosFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico09[]" name="idsPedidosFiltroGenerico09[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico09[$countArray][0], $arrPedidosFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico09[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrPedidosFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico09[$countArray][0], $arrPedidosFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico09[$countArray][1];?></option>
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
							//Seleção de ids selecionados para o registro.
							$arrPedidosFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPedidosId, "ce_relacao_complemento", "id_ce_registro", "id_ce_complemento", "21", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPedidosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("ce_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configPedidosFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPedidosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrPedidosFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPedidosFiltroGenerico10[$countArray][0], $arrPedidosFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPedidosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsPedidosFiltroGenerico10[]" name="idsPedidosFiltroGenerico10[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPedidosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPedidosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrPedidosFiltroGenerico10[$countArray][0], $arrPedidosFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPedidosFiltroGenerico10[$countArray][1];?></option>
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
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC1;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC1;?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPedidosIC1;?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPedidosIC1;?></textarea>
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
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC2;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC2;?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPedidosIC2;?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPedidosIC2;?></textarea>
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
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC3;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC3;?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPedidosIC3;?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPedidosIC3;?></textarea>
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
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC4;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC4;?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPedidosIC4;?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPedidosIC4;?></textarea>
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
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosIC5;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPedidosBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosIC5;?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPedidosIC5;?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPedidosIC5;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
                
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idCePedidos" type="hidden" id="idCePedidos" value="<?php echo $tbPedidosId; ?>" />
                <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
                <!--input name="flagFinalizar" type="hidden" id="flagFinalizar" value="1" /-->
                
                <input name="id_tb_cadastro_cliente" type="hidden" id="id_tb_cadastro_cliente" value="<?php echo $tbPedidosIdTbCadastroCliente; ?>" />

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

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlPedidosDetalhesSelect);
unset($statementPedidosDetalhesSelect);
unset($resultadoPedidosDetalhes);
unset($linhaPedidosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>