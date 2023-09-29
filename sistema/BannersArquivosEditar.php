<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbBannersArquivos = $_GET["idTbBannersArquivos"];
$idTbBanners = DbFuncoes::GetCampoGenerico01($idTbBannersArquivos, "tb_banners_arquivos", "id_tb_banners");

$paginaRetorno = "BannersArquivosIndice.php";
$paginaRetornoExclusao = "BannersArquivosEditar.php";
$variavelRetorno = "idTbBannersArquivos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlBannersArquivosDetalhesSelect = "";
$strSqlBannersArquivosDetalhesSelect .= "SELECT ";
//$strSqlBannersArquivosDetalhesSelect .= "* ";
$strSqlBannersArquivosDetalhesSelect .= "id, ";
$strSqlBannersArquivosDetalhesSelect .= "id_tb_banners, ";
$strSqlBannersArquivosDetalhesSelect .= "id_tb_cadastro, ";
$strSqlBannersArquivosDetalhesSelect .= "n_classificacao, ";
$strSqlBannersArquivosDetalhesSelect .= "tipo_publicacao, ";
$strSqlBannersArquivosDetalhesSelect .= "data_publicacao, ";
$strSqlBannersArquivosDetalhesSelect .= "data_inicial, ";
$strSqlBannersArquivosDetalhesSelect .= "data_final, ";
$strSqlBannersArquivosDetalhesSelect .= "banner, ";
$strSqlBannersArquivosDetalhesSelect .= "endereco_eletronico, ";
$strSqlBannersArquivosDetalhesSelect .= "codigo_html, ";
$strSqlBannersArquivosDetalhesSelect .= "obs, ";
$strSqlBannersArquivosDetalhesSelect .= "dimensao_w, ";
$strSqlBannersArquivosDetalhesSelect .= "dimensao_h, ";
$strSqlBannersArquivosDetalhesSelect .= "ativacao, ";
$strSqlBannersArquivosDetalhesSelect .= "arquivo, ";
$strSqlBannersArquivosDetalhesSelect .= "n_impressoes, ";
$strSqlBannersArquivosDetalhesSelect .= "n_impressoes_contratacao, ";
$strSqlBannersArquivosDetalhesSelect .= "n_cliques, ";
$strSqlBannersArquivosDetalhesSelect .= "n_cliques_contratacao ";
$strSqlBannersArquivosDetalhesSelect .= "FROM tb_banners_arquivos ";
$strSqlBannersArquivosDetalhesSelect .= "WHERE id <> 0 ";
$strSqlBannersArquivosDetalhesSelect .= "AND id = :id ";
//$strSqlBannersArquivosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementBannersArquivosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlBannersArquivosDetalhesSelect);

if ($statementBannersArquivosDetalhesSelect !== false)
{
	$statementBannersArquivosDetalhesSelect->execute(array(
		"id" => $idTbBannersArquivos
	));
}

//$resultadoBannersArquivosDetalhes = $dbSistemaConPDO->query($strSqlBannersArquivosDetalhesSelect);
$resultadoBannersArquivosDetalhes = $statementBannersArquivosDetalhesSelect->fetchAll();

if (empty($resultadoBannersArquivosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoBannersArquivosDetalhes as $linhaBannersArquivosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbBannersArquivosId = $linhaBannersArquivosDetalhes['id'];
		$tbBannersArquivosIdTbBanners = $linhaBannersArquivosDetalhes['id_tb_banners'];
		$tbBannersArquivosIdTbCadastro = $linhaBannersArquivosDetalhes['id_tb_cadastro'];
		$tbBannersArquivosNClassificacao = $linhaBannersArquivosDetalhes['n_classificacao'];
		$tbBannersArquivosTipoPublicacao = $linhaBannersArquivosDetalhes['tipo_publicacao'];
		
		$tbBannersArquivosDataPublicacao = Funcoes::DataLeitura01($linhaBannersArquivosDetalhes['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");
		
		//$tbBannersArquivosDataInicial = Funcoes::DataLeitura01($linhaBannersArquivosDetalhes['data_inicial'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaBannersArquivosDetalhes['data_inicial'] == NULL)
		{
			$tbBannersArquivosDataInicial = "";
		}else{
			$tbBannersArquivosDataInicial = Funcoes::DataLeitura01($linhaBannersArquivosDetalhes['data_inicial'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbBannersArquivosDataFinal = Funcoes::DataLeitura01($linhaBannersArquivosDetalhes['data_final'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaBannersArquivosDetalhes['data_inicial'] == NULL)
		{
			$tbBannersArquivosDataFinal = "";
		}else{
			$tbBannersArquivosDataFinal = Funcoes::DataLeitura01($linhaBannersArquivosDetalhes['data_final'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		$tbBannersArquivosBanner = Funcoes::ConteudoMascaraLeitura($linhaBannersArquivosDetalhes['banner']);
		$tbBannersArquivosEnderecoEletronico = Funcoes::ConteudoMascaraLeitura($linhaBannersArquivosDetalhes['endereco_eletronico']);
		$tbBannersArquivosCodigoHTML = Funcoes::ConteudoMascaraLeitura($linhaBannersArquivosDetalhes['codigo_html']);
		$tbBannersArquivosOBS = Funcoes::ConteudoMascaraLeitura($linhaBannersArquivosDetalhes['obs']);
		
		$tbBannersArquivosDimensaoW = $linhaBannersArquivosDetalhes['dimensao_w'];
		$tbBannersArquivosDimensaoH = $linhaBannersArquivosDetalhes['dimensao_h'];
		$tbBannersArquivosAtivacao = $linhaBannersArquivosDetalhes['ativacao'];
		$tbBannersArquivosArquivo = $linhaBannersArquivosDetalhes['arquivo'];
		$tbBannersArquivosNImpressoes = $linhaBannersArquivosDetalhes['n_impressoes'];
		$tbBannersArquivosNImpressoesContratacao = $linhaBannersArquivosDetalhes['n_impressoes_contratacao'];
		$tbBannersArquivosNCliques = $linhaBannersArquivosDetalhes['n_cliques'];
		$tbBannersArquivosNCliquesContratacao = $linhaBannersArquivosDetalhes['n_cliques_contratacao'];
		
		//Verificação de erro.
		//echo "tbBannersArquivosId=" . $tbBannersArquivosId . "<br>";
		//echo "tbBannersArquivosTitulo=" . $tbBannersArquivosTitulo . "<br>";
		//echo "tbBannersArquivosAtivacao=" . $tbBannersArquivosAtivacao . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTituloEditar"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    
	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formBannersArquivosEditar').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				rules: {
					n_classificacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					dimensao_w: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					dimensao_h: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					n_impressoes_contratacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					},
					n_cliques_contratacao: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
					}
					//,
					//field2: {
						//required: true,
						//minlength: 5
					//}
				},
				
				
				//Mensagens.
				//----------------------
				messages: {
					//n_classificacao: "Please specify your name"//,
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					},
					dimensao_w: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					},
					dimensao_h: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					},
					n_impressoes_contratacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
					},
					n_cliques_contratacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusCritica1"); ?>"
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
    <form name="formBannersArquivosEditar" id="formBannersArquivosEditar" action="BannersArquivosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTbTituloEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarBannersArquivosPeriodos'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDataInicial"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
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
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_inicial;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_inicial;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_inicial" id="data_inicial" class="CampoData01" maxlength="10" value="<?php echo $tbBannersArquivosDataInicial; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
			
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDataFinal"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSistemaFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_abertura";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_final;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSistemaFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_abertura";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_final;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_final" id="data_final" class="CampoData01" maxlength="10" value="<?php echo $tbBannersArquivosDataFinal; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
			
            <?php if($GLOBALS['habilitarBannersArquivosTipoPublicacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="tipo_publicacao" id="tipo_publicacao" class="CampoDropDownMenu01">
                            <option value="1"<?php if($tbBannersArquivosTipoPublicacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao1"); ?></option>
                            <option value="2"<?php if($tbBannersArquivosTipoPublicacao == "2"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao2"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosBanner"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro Tabela01Celula"<?php if($GLOBALS['habilitarBannersArquivosNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="banner" id="banner" class="CampoTexto01" maxlength="255" value="<?php echo $tbBannersArquivosBanner; ?>" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarBannersArquivosNClassificacao'] == 1){ ?>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro TabelaColuna01 Tabela01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbBannersArquivosNClassificacao; ?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
			
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosEnderecoEletronico"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
						<textarea name="endereco_eletronico" id="endereco_eletronico" class="CampoTextoMultilinhaURL"><?php echo $tbBannersArquivosEnderecoEletronico; ?></textarea>
                        <div>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemURL02"); ?>
						</div>
                    </div>
                </td>
            </tr>
			
			<?php if($GLOBALS['habilitarBannersArquivosCodigoHTML'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemHTML01"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
						<textarea name="codigo_html" id="codigo_html" class="CampoTextoMultilinhaHTML"><?php echo $tbBannersArquivosCodigoHTML; ?></textarea>
                        <div>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemHTML02"); ?>
						</div>
                    </div>
                </td>
            </tr>
			<?php } ?>
			
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosOBS"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
						<textarea name="obs" id="obs" class="CampoTextoMultilinhaConteudo"><?php echo $tbBannersArquivosOBS; ?></textarea>
                    </div>
                </td>
            </tr>
			
			<?php if($GLOBALS['habilitarBannersArquivosDimensoes'] == 1){ ?>
			<tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosDimensoes"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div class="Texto01">
                        <input type="text" name="dimensao_w" id="dimensao_w" class="CampoNumerico01" maxlength="10" value="<?php echo $tbBannersArquivosDimensaoW; ?>" />
						(<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosDimensoesW"); ?>)
						
                        <input type="text" name="dimensao_h" id="dimensao_h" class="CampoNumerico01" maxlength="10" value="<?php echo $tbBannersArquivosDimensaoH; ?>" />
						(<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosDimensoesH"); ?>)
                    </div>
                </td>
			</tr>
            <?php } ?>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbBannersArquivosAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbBannersArquivosAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
			<?php if($GLOBALS['habilitarBannersArquivosContratacao'] == 1){ ?>
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosContratacao"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosImpressoes"); ?>:
                        <input type="text" name="n_impressoes_contratacao" id="n_impressoes_contratacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbBannersArquivosNImpressoesContratacao; ?>" />

						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosCliques"); ?>:
                        <input type="text" name="n_cliques_contratacao" id="n_cliques_contratacao" class="CampoNumerico01" maxlength="10" value="<?php echo $tbBannersArquivosNCliquesContratacao; ?>" />
						(<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosContratacaoInstrucoes"); ?>)
                    </div>
                </td>
            </tr>
			<?php } ?>
			
			<tr id="cell_imagem">
				<td class="TbFundoMedio TabelaColuna01">
					<div align="left" class="Texto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemArquivo"); ?>:
					</div>
				</td>
				<td class="TbFundoClaro" colspan="3">
					<div>
						<input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="CampoArquivoUploadArquivos" />
					</div>
				</td>
			</tr>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input name="idTbBannersArquivos" type="hidden" id="idTbBannersArquivos" value="<?php echo $tbBannersArquivosId; ?>" />
                <input name="id_tb_banners" type="hidden" id="id_tb_banners" value="<?php echo $tbBannersArquivosIdTbBanners; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idTbBanners=<?php echo $tbBannersArquivosIdTbBanners; ?><?php echo $queryPadrao;?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlBannersArquivosDetalhesSelect);
unset($statementBannersArquivosDetalhesSelect);
unset($resultadoBannersArquivosDetalhes);
unset($linhaBannersArquivosDetalhes);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>