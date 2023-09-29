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
$idParentFluxo = DbFuncoes::GetCampoGenerico01($idTbFluxo, "tb_fluxo", "id_tb_categorias");

$paginaRetorno = "SiteAdmFluxoIndice.php";
$paginaRetornoExclusao = "SiteAdmFluxoEditar.php";
$variavelRetorno = "idTbFluxo";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentFluxo=" . $idParentFluxo . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlFluxoDetalhesSelect = "";
$strSqlFluxoDetalhesSelect .= "SELECT ";
//$strSqlFluxoDetalhesSelect .= "* ";
$strSqlFluxoDetalhesSelect .= "id, ";
$strSqlFluxoDetalhesSelect .= "id_tb_categorias, ";
$strSqlFluxoDetalhesSelect .= "data_lancamento, ";
$strSqlFluxoDetalhesSelect .= "data_contabilizacao, ";
$strSqlFluxoDetalhesSelect .= "debito_credito, ";
$strSqlFluxoDetalhesSelect .= "id_item, ";
$strSqlFluxoDetalhesSelect .= "tabela, ";
$strSqlFluxoDetalhesSelect .= "id_tb_cadastro, ";
$strSqlFluxoDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlFluxoDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlFluxoDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlFluxoDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlFluxoDetalhesSelect .= "lancamento, ";
$strSqlFluxoDetalhesSelect .= "id_tb_fluxo_tipo, ";
$strSqlFluxoDetalhesSelect .= "id_tb_fluxo_status, ";
$strSqlFluxoDetalhesSelect .= "valor, ";
$strSqlFluxoDetalhesSelect .= "valor1, ";
$strSqlFluxoDetalhesSelect .= "valor2, ";
$strSqlFluxoDetalhesSelect .= "valor3, ";
$strSqlFluxoDetalhesSelect .= "valor4, ";
$strSqlFluxoDetalhesSelect .= "valor5, ";
$strSqlFluxoDetalhesSelect .= "n_documento, ";
$strSqlFluxoDetalhesSelect .= "autenticacao, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar1, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar2, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar3, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar4, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar5, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar6, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar7, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar8, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar9, ";
$strSqlFluxoDetalhesSelect .= "informacao_complementar10, ";
$strSqlFluxoDetalhesSelect .= "obs, ";
$strSqlFluxoDetalhesSelect .= "ativacao, ";
$strSqlFluxoDetalhesSelect .= "ativacao_contabilizacao ";
$strSqlFluxoDetalhesSelect .= "FROM tb_fluxo ";
$strSqlFluxoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFluxoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFluxoDetalhesSelect .= "AND id = :id ";
//$strSqlFluxoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFluxoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFluxoDetalhesSelect);

if ($statementFluxoDetalhesSelect !== false)
{
	$statementFluxoDetalhesSelect->execute(array(
		"id" => $idTbFluxo
	));
}

//$resultadoFluxoDetalhes = $dbSistemaConPDO->query($strSqlFluxoDetalhesSelect);
$resultadoFluxoDetalhes = $statementFluxoDetalhesSelect->fetchAll();

if (empty($resultadoFluxoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFluxoDetalhes as $linhaFluxoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFluxoId = $linhaFluxoDetalhes['id'];
		$tbFluxoIdTbCategorias = $linhaFluxoDetalhes['id_tb_categorias'];
		
		//$tbFluxoDataLancamento = Funcoes::DataLeitura01($linhaFluxoDetalhes['data_lancamento'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaFluxoDetalhes['data_lancamento'] == NULL)
		{
			$tbFluxoDataLancamento = "";
		}else{
			$tbFluxoDataLancamento = Funcoes::DataLeitura01($linhaFluxoDetalhes['data_lancamento'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbFluxoDataContabilizacao = Funcoes::DataLeitura01($linhaFluxoDetalhes['data_contabilizacao'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaFluxoDetalhes['data_contabilizacao'] == NULL)
		{
			$tbFluxoDataContabilizacao = "";
		}else{
			$tbFluxoDataContabilizacao = Funcoes::DataLeitura01($linhaFluxoDetalhes['data_contabilizacao'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		$tbFluxoDebitoCredito = $linhaFluxoDetalhes['debito_credito'];
		$tbFluxoIdItem = $linhaFluxoDetalhes['id_item'];
		$tbFluxoTabela = $linhaFluxoDetalhes['tabela'];
		$tbFluxoIdTbCadastro = $linhaFluxoDetalhes['id_tb_cadastro'];
		$tbFluxoIdTbCadastroUsuario = $linhaFluxoDetalhes['id_tb_cadastro_usuario'];
		$tbFluxoLancamento = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['lancamento']);
		$tbFluxoIdTbFluxoTipo = $linhaFluxoDetalhes['id_tb_fluxo_tipo'];
		$tbFluxoIdTbFluxoStatus = $linhaFluxoDetalhes['id_tb_fluxo_status'];
		//$tbFluxoValor = $linhaFluxoDetalhes['valor'];
		$tbFluxoValor = Funcoes::MascaraValorLer($linhaFluxoDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbFluxoNDocumento = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['n_documento']);
		$tbFluxoAutenticacao = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['autenticacao']);
		$tbFluxoIC1 = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['informacao_complementar1']);
		$tbFluxoIC2 = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['informacao_complementar2']);
		$tbFluxoIC3 = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['informacao_complementar3']);
		$tbFluxoIC4 = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['informacao_complementar4']);
		$tbFluxoIC5 = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['informacao_complementar5']);
		$tbFluxoOBS = Funcoes::ConteudoMascaraLeitura($linhaFluxoDetalhes['obs']);
		$tbFluxoAtivacao = $linhaFluxoDetalhes['ativacao'];
		$tbFluxoAtivacaoContabilizacao = $linhaFluxoDetalhes['ativacao_contabilizacao'];
		
		//Verificação de erro.
		//echo "tbFluxoId=" . $tbFluxoId . "<br>";
		//echo "tbFluxoIdTbCategorias=" . $tbFluxoIdTbCategorias . "<br>";
		
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTituloEditar"); ?>
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
			$('#formFluxoEditar').validate({ //Inicialização do plug-in.
			
			
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
    <form name="formFluxoEditar" id="formFluxoEditar" action="SiteAdmFluxoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTbFluxoEditar"); ?>
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
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_lancamento;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_lancamento;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_lancamento" id="data_lancamento" class="AdmCampoData01" maxlength="10" value="<?php echo $tbFluxoDataLancamento; ?>" />
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
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_contabilizacao;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_contabilizacao;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_contabilizacao" id="data_contabilizacao" class="AdmCampoData01" maxlength="10" value="<?php echo $tbFluxoDataContabilizacao; ?>" />
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
                                <option value="<?php echo $arrFluxoCadastro[$countArray][0];?>"<?php if($arrFluxoCadastro[$countArray][0] == $tbFluxoIdTbCadastro){ ?> selected="selected"<?php } ?>><?php echo $arrFluxoCadastro[$countArray][1];?></option>
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
                                <option value="<?php echo $arrFluxoCadastroUsuario[$countArray][0];?>"<?php if($arrFluxoCadastroUsuario[$countArray][0] == $tbFluxoIdTbCadastroUsuario){ ?> selected="selected"<?php } ?>><?php echo $arrFluxoCadastroUsuario[$countArray][1];?></option>
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
                        <input type="text" name="lancamento" id="lancamento" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoLancamento;?>" />
						<div style="display: inline;">
							<input name="debito_credito" type="radio" value="0" class="AdmCampoCheckBox01" <?php if($tbFluxoDebitoCredito == "0"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoDebito"); ?>
						</div>
						<div style="display: inline;">
							<input name="debito_credito" type="radio" value="1" class="AdmCampoCheckBox01" <?php if($tbFluxoDebitoCredito == "1"){?>checked="true" <?php }?>/> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoCredito"); ?>
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
                                <option value="<?php echo $arrFluxoTipo[$countArray][0];?>"<?php if($arrFluxoTipo[$countArray][0] == $tbFluxoIdTbFluxoTipo){ ?> selected="selected"<?php } ?>><?php echo $arrFluxoTipo[$countArray][1];?></option>
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
                                <option value="<?php echo $arrFluxoStatus[$countArray][0];?>"<?php if($arrFluxoStatus[$countArray][0] == $tbFluxoIdTbFluxoStatus){ ?> selected="selected"<?php } ?>><?php echo $arrFluxoStatus[$countArray][1];?></option>
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
                    	<?php echo htmlentities($GLOBALS['configSistemaMoeda']); ?>
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
                        <input type="text" name="valor" id="valor" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbFluxoValor; ?>" />
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
                        <input type="text" name="n_documento" id="n_documento" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoNDocumento; ?>" />
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
                        <input type="text" name="autenticacao" id="autenticacao" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoAutenticacao; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarFluxoIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloFluxoIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoIC1; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbFluxoIC1; ?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbFluxoIC1; ?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbFluxoIC1; ?></textarea>
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
                        <?php echo htmlentities($GLOBALS['configTituloFluxoIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoIC2; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbFluxoIC2; ?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbFluxoIC2; ?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbFluxoIC2; ?></textarea>
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
                        <?php echo htmlentities($GLOBALS['configTituloFluxoIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoIC3; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbFluxoIC3; ?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbFluxoIC3; ?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbFluxoIC3; ?></textarea>
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
                        <?php echo htmlentities($GLOBALS['configTituloFluxoIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoIC4; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbFluxoIC4; ?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbFluxoIC4; ?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbFluxoIC4; ?></textarea>
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
                        <?php echo htmlentities($GLOBALS['configTituloFluxoIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configFluxoBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbFluxoIC5; ?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configFluxoBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbFluxoIC5; ?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbFluxoIC5; ?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbFluxoIC5; ?></textarea>
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
                            <option value="0"<?php if($tbFluxoAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbFluxoAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
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
                            <option value="0"<?php if($tbFluxoAtivacaoContabilizacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbFluxoAtivacaoContabilizacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
                        
        </table>
        
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbFluxo" type="hidden" id="idTbFluxo" value="<?php echo $idTbFluxo; ?>" />
                <input name="id_tb_categorias" type="hidden" id="id_tb_categorias" value="<?php echo $tbFluxoIdTbCategorias; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentFluxo=<?php echo $idParentFluxo; ?>">
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
unset($strSqlFluxoDetalhesSelect);
unset($statementFluxoDetalhesSelect);
unset($resultadoFluxoDetalhes);
unset($linhaFluxoDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>