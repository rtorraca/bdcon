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
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idCeItens = $_GET["idCeItens"];
//$idCePedidos = DbFuncoes::GetCampoGenerico01($idCeItens, "ce_itens", "id_ce_pedidos");
$idCePedidos = $_GET["idCePedidos"];
$idTbCadastro = $_GET["idTbCadastro"];
$idTbCadastroCliente = $_GET["idTbCadastroCliente"];

//$paginaRetorno = "PedidosItensIndice.php";
$paginaRetorno = $_GET["paginaRetorno"];
$paginaRetornoExclusao = "SiteAdmPedidosItensEditar.php";
$variavelRetorno = "idCePedidos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPedidosItensDetalhesSelect = "";
$strSqlPedidosItensDetalhesSelect .= "SELECT ";
//$strSqlPedidosItensDetalhesSelect .= "* ";
$strSqlPedidosItensDetalhesSelect .= "id, ";
$strSqlPedidosItensDetalhesSelect .= "id_ce_pedidos, ";
$strSqlPedidosItensDetalhesSelect .= "id_tb_cadastro_cliente, ";
$strSqlPedidosItensDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlPedidosItensDetalhesSelect .= "id_item, ";
$strSqlPedidosItensDetalhesSelect .= "cod_item, ";
$strSqlPedidosItensDetalhesSelect .= "descricao, ";
$strSqlPedidosItensDetalhesSelect .= "tabela, ";
$strSqlPedidosItensDetalhesSelect .= "quantidade, ";
$strSqlPedidosItensDetalhesSelect .= "valor_unitario, ";
$strSqlPedidosItensDetalhesSelect .= "valor_desconto, ";
$strSqlPedidosItensDetalhesSelect .= "valor_acrescimo, ";
$strSqlPedidosItensDetalhesSelect .= "id_tb_itens_valores, ";
$strSqlPedidosItensDetalhesSelect .= "id_tb_itens_valores_titulo, ";
$strSqlPedidosItensDetalhesSelect .= "id_tb_itens_data, ";
$strSqlPedidosItensDetalhesSelect .= "valor_total, ";
$strSqlPedidosItensDetalhesSelect .= "ids_opcionais, ";
$strSqlPedidosItensDetalhesSelect .= "ids_opcionais_descricao, ";
$strSqlPedidosItensDetalhesSelect .= "obs, ";

$strSqlPedidosItensDetalhesSelect .= "informacao_complementar1, ";
$strSqlPedidosItensDetalhesSelect .= "informacao_complementar2, ";
$strSqlPedidosItensDetalhesSelect .= "informacao_complementar3, ";
$strSqlPedidosItensDetalhesSelect .= "informacao_complementar4, ";
$strSqlPedidosItensDetalhesSelect .= "informacao_complementar5, ";

$strSqlPedidosItensDetalhesSelect .= "ativacao, ";
$strSqlPedidosItensDetalhesSelect .= "data_pedido, ";
$strSqlPedidosItensDetalhesSelect .= "data_pagamento, ";
$strSqlPedidosItensDetalhesSelect .= "data_entrega, ";
$strSqlPedidosItensDetalhesSelect .= "data_validade, ";
$strSqlPedidosItensDetalhesSelect .= "id_tb_produtos_complemento_status ";
$strSqlPedidosItensDetalhesSelect .= "FROM ce_itens ";
$strSqlPedidosItensDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlPedidosItensDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlPedidosItensDetalhesSelect .= "AND id = :id ";
//$strSqlPedidosItensDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementPedidosItensDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPedidosItensDetalhesSelect);

if ($statementPedidosItensDetalhesSelect !== false)
{
	$statementPedidosItensDetalhesSelect->execute(array(
		"id" => $idCeItens
	));
}

//$resultadoPedidosItensDetalhes = $dbSistemaConPDO->query($strSqlPedidosItensDetalhesSelect);
$resultadoPedidosItensDetalhes = $statementPedidosItensDetalhesSelect->fetchAll();

if (empty($resultadoPedidosItensDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoPedidosItensDetalhes as $linhaPedidosItensDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbPedidosItensId = $linhaPedidosItensDetalhes['id'];
		$tbPedidosItensIdCePedidos = $linhaPedidosItensDetalhes['id_ce_pedidos'];
		$tbPedidosItensIdTbCadastroCliente = $linhaPedidosItensDetalhes['id_tb_cadastro_cliente'];
		$tbPedidosItensIdTbCadastroUsuario = $linhaPedidosItensDetalhes['id_tb_cadastro_usuario'];
		$tbPedidosItensIdItem = $linhaPedidosItensDetalhes['id_item'];
		$tbPedidosItensCodItem = $linhaPedidosItensDetalhes['cod_item'];
		$tbPedidosItensDescricao = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['descricao']);
		$tbPedidosItensTabela = $linhaPedidosItensDetalhes['tabela'];
		$tbPedidosItensQuantidade = $linhaPedidosItensDetalhes['quantidade'];
		
		$tbPedidosItensValorUnitario = Funcoes::MascaraValorLer($linhaPedidosItensDetalhes['valor_unitario'], $GLOBALS['configSistemaMoeda']);
		$tbPedidosItensValorDesconto = Funcoes::MascaraValorLer($linhaPedidosItensDetalhes['valor_desconto'], $GLOBALS['configSistemaMoeda']);
		$tbPedidosItensValorAcrescimo = Funcoes::MascaraValorLer($linhaPedidosItensDetalhes['valor_acrescimo'], $GLOBALS['configSistemaMoeda']);
		
		$tbPedidosItensIdTbItensValores = $linhaPedidosItensDetalhes['id_tb_itens_valores'];
		$tbPedidosItensIdTbItensValoresTitulo = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['id_tb_itens_valores_titulo']);
		$tbPedidosItensIdTbItensData = $linhaPedidosItensDetalhes['id_tb_itens_data'];
		$tbPedidosItensValorTotal = $linhaPedidosItensDetalhes['valor_total'];
		$tbPedidosItensIdsOpcionais = $linhaPedidosItensDetalhes['ids_opcionais'];
		$tbPedidosItensIdsOpcionaisDescricao = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['ids_opcionais_descricao']);
		$tbPedidosItensOBS = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['obs']);
		$tbPedidosItensIC1 = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['informacao_complementar1']);
		$tbPedidosItensIC2 = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['informacao_complementar2']);
		$tbPedidosItensIC3 = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['informacao_complementar3']);
		$tbPedidosItensIC4 = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['informacao_complementar4']);
		$tbPedidosItensIC5 = Funcoes::ConteudoMascaraLeitura($linhaPedidosItensDetalhes['informacao_complementar5']);
		$tbPedidosItensAtivacao = $linhaPedidosItensDetalhes['ativacao'];
		//$tbPedidosItensDataPedido = $linhaPedidosItensDetalhes['data_pedido'];
		if($linhaPedidosItensDetalhes['data_pedido'] == NULL)
		{
			$tbPedidosItensDataPedido = "";
		}else{
			$tbPedidosItensDataPedido = Funcoes::DataLeitura01($linhaPedidosItensDetalhes['data_pedido'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		//$tbPedidosItensDataPagamento = $linhaPedidosItensDetalhes['data_pagamento'];
		if($linhaPedidosItensDetalhes['data_pagamento'] == NULL)
		{
			$tbPedidosItensDataPagamento = "";
		}else{
			$tbPedidosItensDataPagamento = Funcoes::DataLeitura01($linhaPedidosItensDetalhes['data_pagamento'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		//$tbPedidosItensDataEntrega = $linhaPedidosItensDetalhes['data_entrega'];
		if($linhaPedidosItensDetalhes['data_entrega'] == NULL)
		{
			$tbPedidosItensDataEntrega = "";
		}else{
			$tbPedidosItensDataEntrega = Funcoes::DataLeitura01($linhaPedidosItensDetalhes['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		//$tbPedidosItensDataValidade = $linhaPedidosItensDetalhes['data_validade'];
		if($linhaPedidosItensDetalhes['data_validade'] == NULL)
		{
			$tbPedidosItensDataValidade = "";
		}else{
			$tbPedidosItensDataValidade = Funcoes::DataLeitura01($linhaPedidosItensDetalhes['data_validade'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		//Verificação de erro.
		//echo "tbPedidosItensId=" . $tbPedidosItensId . "<br>";
		//echo "tbPedidosItensTitulo=" . $tbPedidosItensTitulo . "<br>";
		//echo "tbPedidosItensAtivacao=" . $tbPedidosItensAtivacao . "<br>";
	}
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosListagemItens"); ?>
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
			$('#formPedidosItens').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					quantidade: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					valor_unitario: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					quantidade: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					},
					valor_unitario: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
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
    
    <form name="formPedidosItens" id="formPedidosItens" action="SiteAdmPedidosItensEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensTbPedidosEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula">
                    <div align="left">
                        <input type="text" name="descricao" id="descricao" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosItensDescricao;?>" />
                    </div>
                </td>

                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="quantidade" id="quantidade" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbPedidosItensQuantidade;?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<input type="text" name="cod_item" id="cod_item" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbPedidosItensCodItem;?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_unitario" id="valor_unitario" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbPedidosItensValorUnitario;?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
            
			<?php if($GLOBALS['habilitarPedidosItensValorDesconto'] == 1){ ?>
            <?php
            $tbPedidosItensValorTotal = $tbPedidosItensValorTotal - $tbPedidosItensValorDesconto;
            ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorDesconto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_desconto" id="valor_desconto" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosItensValorDesconto, $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                        <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPedidosItensValorAcrescimo'] == 1){ ?>
            <?php
            $tbPedidosItensValorTotal = $tbPedidosItensValorTotal + $tbPedidosItensValorAcrescimo;
            ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorAcrescimo"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <input type="text" name="valor_acrescimo" id="valor_acrescimo" class="AdmCampoNumerico02" maxlength="255" value="<?php echo Funcoes::MascaraValorLer($tbPedidosItensValorAcrescimo, $GLOBALS['configSistemaMoeda']); ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>

                        <?php //echo htmlentities($GLOBALS['configSistemaMoeda']); ?> <?php //echo $tbPedidosValorFrete; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensOBS"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="obs" id="obs" class="AdmCampoTextoMultilinha01"><?php echo $tbPedidosItensOBS;?></textarea>
                    </div>
                </td>
            </tr>

        </table>
         
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idCeItens" type="hidden" id="idCeItens" value="<?php echo $idCeItens; ?>" />
                <input name="idCePedidos" type="hidden" id="idCePedidos" value="<?php echo $idCePedidos; ?>" />
                <input name="idTbCadastro" type="hidden" id="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
                <input name="idTbCadastroCliente" type="hidden" id="idTbCadastroCliente" value="<?php echo $idTbCadastroCliente; ?>" />
                
                <input name="id_ce_pedidos" type="hidden" id="id_ce_pedidos" value="<?php echo $idCePedidos; ?>" />
                <input name="id_tb_cadastro_cliente" type="hidden" id="id_tb_cadastro_cliente" value="<?php echo $idTbCadastro; ?>" />
                <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="<?php echo $tbPedidosItensIdTbCadastroUsuario; ?>" />
                <input name="id_item" type="hidden" id="id_item" value="<?php echo $tbPedidosItensIdItem; ?>" />
                <input name="tabela" type="hidden" id="tabela" value="<?php echo $tbPedidosItensTabela; ?>" />
                <input name="informacao_complementar1" type="hidden" id="informacao_complementar1" value="<?php echo $tbPedidosItensIC1; ?>" />
                <input name="informacao_complementar2" type="hidden" id="informacao_complementar2" value="<?php echo $tbPedidosItensIC2; ?>" />
                <input name="informacao_complementar3" type="hidden" id="informacao_complementar3" value="<?php echo $tbPedidosItensIC3; ?>" />
                <input name="informacao_complementar4" type="hidden" id="informacao_complementar4" value="<?php echo $tbPedidosItensIC4; ?>" />
                <input name="informacao_complementar5" type="hidden" id="informacao_complementar5" value="<?php echo $tbPedidosItensIC5; ?>" />
                <input name="ativacao" type="hidden" id="ativacao" value="<?php echo $tbPedidosItensAtivacao; ?>" />
                
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idCePedidos=<?php echo $idCePedidos; ?>&idTbCadastro=<?php echo $idTbCadastro; ?>&idTbCadastroCliente=<?php echo $idTbCadastroCliente; ?><?php echo $queryPadrao;?>">
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
unset($strSqlPedidosItensDetalhesSelect);
unset($statementPedidosItensDetalhesSelect);
unset($resultadoPedidosItensDetalhes);
unset($linhaPedidosItensDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>