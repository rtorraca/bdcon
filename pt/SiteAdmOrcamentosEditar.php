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
$idCeOrcamentos = $_GET["idCeOrcamentos"];
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

//$itensValorTotal = "0";
$itensValorTotal = 0;

$paginaRetorno = "SiteAdmOrcamentosIndice.php";
$paginaRetornoExclusao = "SiteAdmOrcamentosEditar.php";
$variavelRetorno = "idCeOrcamentos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroCliente=" . $idTbCadastroCliente . 
"&idCeOrcamentos=" . $idCeOrcamentos . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlOrcamentosDetalhesSelect = "";
$strSqlOrcamentosDetalhesSelect .= "SELECT ";
//$strSqlOrcamentosDetalhesSelect .= "* ";
$strSqlOrcamentosDetalhesSelect .= "id, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_cliente, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_vendedor, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlOrcamentosDetalhesSelect .= "data_orcamento, ";
$strSqlOrcamentosDetalhesSelect .= "data_entrega, ";
$strSqlOrcamentosDetalhesSelect .= "valor_orcamento, ";
$strSqlOrcamentosDetalhesSelect .= "valor_frete, ";
$strSqlOrcamentosDetalhesSelect .= "periodo_contratacao, ";
$strSqlOrcamentosDetalhesSelect .= "tipo_entrega, ";
$strSqlOrcamentosDetalhesSelect .= "valor_total, ";
$strSqlOrcamentosDetalhesSelect .= "peso_total, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlOrcamentosDetalhesSelect .= "obs, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao1, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao2, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao3, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao4, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar1, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar2, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar3, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar4, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar5, ";
$strSqlOrcamentosDetalhesSelect .= "id_ce_complemento_status ";
$strSqlOrcamentosDetalhesSelect .= "FROM ce_orcamentos ";
$strSqlOrcamentosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlOrcamentosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlOrcamentosDetalhesSelect .= "AND id = :id ";
//$strSqlOrcamentosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//echo "strSqlOrcamentosDetalhesSelect=" . $strSqlOrcamentosDetalhesSelect . "<br>";
//----------


//Parâmetros.
//----------
$statementOrcamentosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosDetalhesSelect);

if ($statementOrcamentosDetalhesSelect !== false)
{
	$statementOrcamentosDetalhesSelect->execute(array(
		"id" => $idCeOrcamentos
	));
}
//----------


//$resultadoOrcamentosDetalhes = $dbSistemaConPDO->query($strSqlOrcamentosDetalhesSelect);
$resultadoOrcamentosDetalhes = $statementOrcamentosDetalhesSelect->fetchAll();


if (empty($resultadoOrcamentosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoOrcamentosDetalhes as $linhaOrcamentosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbOrcamentosId = $linhaOrcamentosDetalhes['id'];
		$tbOrcamentosIdTbCadastroCliente = $linhaOrcamentosDetalhes['id_tb_cadastro_cliente'];
		$tbOrcamentosIdTbCadastroEnderecos = $linhaOrcamentosDetalhes['id_tb_cadastro_enderecos'];
		$tbOrcamentosIdTbCadastroVendedor = $linhaOrcamentosDetalhes['id_tb_cadastro_vendedor'];
		$tbOrcamentosIdTbCadastroUsuario = $linhaOrcamentosDetalhes['id_tb_cadastro_usuario'];
		//$tbOrcamentosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['tipo_pagamento']);
		
		//$tbOrcamentosDataPedido = $linhaOrcamentosDetalhes['data_pedido'];
		if($linhaOrcamentosDetalhes['data_orcamento'] == NULL)
		{
			$tbOrcamentosDataOrcamento = "";
		}else{
			$tbOrcamentosDataOrcamento = Funcoes::DataLeitura01($linhaOrcamentosDetalhes['data_orcamento'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		//$tbOrcamentosDataEntrega = $linhaOrcamentosDetalhes['data_entrega'];
		if($linhaOrcamentosDetalhes['data_entrega'] == NULL)
		{
			$tbOrcamentosDataEntrega = "";
		}else{
			$tbOrcamentosDataEntrega = Funcoes::DataLeitura01($linhaOrcamentosDetalhes['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1");
		}


		//$tbOrcamentosValorPedido = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorOrcamento = $linhaOrcamentosDetalhes['valor_orcamento'];

		//$tbOrcamentosValorFrete = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorFrete = $linhaOrcamentosDetalhes['valor_frete'];

		$tbOrcamentosPeriodoContratacao = $linhaOrcamentosDetalhes['periodo_contratacao'];
		$tbOrcamentosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['tipo_entrega']);

		//$tbOrcamentosValorTotal = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorTotal = $linhaOrcamentosDetalhes['valor_total'];

		$tbOrcamentosPesoTotal = $linhaOrcamentosDetalhes['peso_total'];
		$tbOrcamentosIdTbCadastro1 = $linhaOrcamentosDetalhes['id_tb_cadastro1'];
		$tbOrcamentosIdTbCadastro2 = $linhaOrcamentosDetalhes['id_tb_cadastro2'];
		$tbOrcamentosIdTbCadastro3 = $linhaOrcamentosDetalhes['id_tb_cadastro3'];
		$tbOrcamentosOBS = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['obs']);
		$tbOrcamentosAtivacao = $linhaOrcamentosDetalhes['ativacao'];
		$tbOrcamentosAtivacao1 = $linhaOrcamentosDetalhes['ativacao1'];
		$tbOrcamentosAtivacao2 = $linhaOrcamentosDetalhes['ativacao2'];
		$tbOrcamentosAtivacao3 = $linhaOrcamentosDetalhes['ativacao3'];
		$tbOrcamentosAtivacao4 = $linhaOrcamentosDetalhes['ativacao4'];
		$tbOrcamentosIC1 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar1']);
		$tbOrcamentosIC2 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar2']);
		$tbOrcamentosIC3 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar3']);
		$tbOrcamentosIC4 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar4']);
		$tbOrcamentosIC5 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar5']);
		$tbOrcamentosIdCeComplementoStatus = $linhaOrcamentosDetalhes['id_ce_complemento_status'];
		
		
		//Verificação de erro.
		//echo "tbOrcamentosId=" . $tbOrcamentosId . "<br>";
		//echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
		//echo "tbOrcamentosAtivacao=" . $tbOrcamentosAtivacao . "<br>";
	}
}


//Verificação de erro - debug.
//echo "cookie(CookieValorLer_Login)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login(), 2), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sistemaOrcamentosTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sistemaOrcamentosTituloEditar"); ?>
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
    
    
    <form name="formOrcamentosEditar" id="formOrcamentosEditar" action="SiteAdmOrcamentosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
		<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
        <script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
            var strDatapickerGenericoPtCampos = "#data_orcamento;#data_entrega;";
        </script>
        <?php } ?>
        <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
        <script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
            var strDatapickerGenericoEnCampos = "#orcamento;#data_entrega;";
        </script>
        <?php } ?>
        <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTbOrcamentosEditar"); ?>
                        </strong>
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
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbOrcamentosId; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php if($GLOBALS['habilitarOrcamentosEdicaoData'] == 1){ ?>
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <input type="text" name="data_orcamento" id="data_orcamento" class="AdmCampoData01" maxlength="10" value="<?php echo $tbOrcamentosDataOrcamento;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        <?php }else{ ?>
                            <?php echo $tbOrcamentosDataOrcamento; ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php if($GLOBALS['habilitarOrcamentosDataEntrega'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosDataEntrega"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="data_entrega" id="data_entrega" class="AdmCampoData01" maxlength="10" value="<?php echo $tbOrcamentosDataEntrega;?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorOrcamento"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php 
                        //if($linhaOrcamentosDetalhes['valor_orcamento'] == 0)
                        //{
                            //$tbOrcamentosValorOrcamento = $itensValorTotal;
                            $tbOrcamentosValorOrcamento = Orcamentos::OrcamentoTotal($idCeOrcamentos, 1);
                        //}
                        
                        //Verificação de erro.
                        //echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
                        //echo "itensValorTotal=" . $itensValorTotal . "<br>";
                        //echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
                        ?>

                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                        
                        <?php if($GLOBALS['habilitarOrcamentosEdicaoValorTotal'] == 1){ ?>
                            <input type="text" name="valor_orcamento" id="valor_orcamento" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                        <?php }else{ ?>
                            <?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento, $GLOBALS['configSistemaMoeda']); ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarOrcamentosFrete'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorFrete"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_frete" id="valor_frete" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorFrete, $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                        <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbOrcamentosValorFrete; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarOrcamentosTipoEntrega'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTipoEntrega"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="tipo_entrega" id="tipo_entrega" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosTipoEntrega; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorTotal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php 
                        //if($linhaOrcamentosDetalhes['valor_total'] == 0)
                        //{
                            $tbOrcamentosValorTotal = $tbOrcamentosValorFrete + $tbOrcamentosValorOrcamento;
                        //}
                        
                        //Verificação de erro.
                        //echo "tbOrcamentosValorTotal=" . $tbOrcamentosValorTotal . "<br>";
                        //echo "tbOrcamentosValorFrete=" . $tbOrcamentosValorFrete . "<br>";
                        //echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
                        //echo "Funcoes::MascaraValorLer(itensValorTotal)=" . Funcoes::MascaraValorLer($itensValorTotal, $GLOBALS['configSistemaMoeda']) . "<br>";
                        ?>
                        
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                        
                        <?php if($GLOBALS['habilitarOrcamentosEdicaoValorTotal'] == 1){ ?>
                            <input type="text" name="valor_total" id="valor_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbOrcamentosValorTotal, $GLOBALS['configSistemaMoeda']); ?>" />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                        <?php }else{ ?>
                            <?php echo Funcoes::MascaraValorLer($tbOrcamentosValorTotal, $GLOBALS['configSistemaMoeda']); ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarOrcamentosPeso'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosPesoTotal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="peso_total" id="peso_total" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbOrcamentosPesoTotal; ?>" />
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaPeso'], "IncludeConfig"); ?>

                        <?php //echo $tbOrcamentosPesoTotal; ?> <?php //echo htmlentities($GLOBALS['configSistemaPeso']); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosObs"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosOBS;?></textarea>
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
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbOrcamentosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbOrcamentosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarOrcamentosIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configOrcamentosBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC1;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configOrcamentosBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC1;?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbOrcamentosIC1;?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbOrcamentosIC1;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarOrcamentosIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configOrcamentosBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC2;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configOrcamentosBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC2;?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbOrcamentosIC2;?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbOrcamentosIC2;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarOrcamentosIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configOrcamentosBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC3;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configOrcamentosBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC3;?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbOrcamentosIC3;?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbOrcamentosIC3;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarOrcamentosIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configOrcamentosBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC4;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configOrcamentosBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC4;?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbOrcamentosIC4;?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbOrcamentosIC4;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarOrcamentosIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosTituloIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configOrcamentosBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosIC5;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configOrcamentosBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbOrcamentosIC5;?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbOrcamentosIC5;?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbOrcamentosIC5;?></textarea>
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
                <!--input type="image" name="submit" value="Submit" src="img/btoFinalizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoFinalizar"); ?>" /-->
                
                <input type="hidden" name="idCeOrcamentos" id="idCeOrcamentos" value="<?php echo $tbOrcamentosId; ?>" />
                <input type="hidden" name="idTbCadastroCliente" id="idTbCadastroCliente" value="<?php echo $idTbCadastroCliente; ?>" />
                <input type="hidden" name="flagFinalizar" id="flagFinalizar" value="0" />
                
                <input type="hidden" name="id_tb_cadastro_cliente" id="id_tb_cadastro_cliente" value="<?php echo $tbOrcamentosIdTbCadastroCliente; ?>" />

                <input type="hidden" name="paginaRetorno" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
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
unset($strSqlOrcamentosDetalhesSelect);
unset($statementOrcamentosDetalhesSelect);
unset($resultadoOrcamentosDetalhes);
unset($linhaOrcamentosDetalhes);
//----------
?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>