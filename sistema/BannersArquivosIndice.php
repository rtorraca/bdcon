<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbBanners = $_GET["idTbBanners"];
$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$paginaRetorno = "BannersArquivosIndice.php";
$paginaRetornoExclusao = "BannersArquivosEditar.php";
$variavelRetorno = "idTbBannersArquivos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idTbBanners=" . $idTbBanners . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlBannersArquivosSelect = "";
$strSqlBannersArquivosSelect .= "SELECT ";
//$strSqlBannersArquivosSelect .= "* ";
$strSqlBannersArquivosSelect .= "id, ";
$strSqlBannersArquivosSelect .= "id_tb_banners, ";
$strSqlBannersArquivosSelect .= "id_tb_cadastro, ";
$strSqlBannersArquivosSelect .= "n_classificacao, ";
$strSqlBannersArquivosSelect .= "tipo_publicacao, ";
$strSqlBannersArquivosSelect .= "data_publicacao, ";
$strSqlBannersArquivosSelect .= "data_inicial, ";
$strSqlBannersArquivosSelect .= "data_final, ";
$strSqlBannersArquivosSelect .= "banner, ";
$strSqlBannersArquivosSelect .= "endereco_eletronico, ";
$strSqlBannersArquivosSelect .= "codigo_html, ";
$strSqlBannersArquivosSelect .= "obs, ";
$strSqlBannersArquivosSelect .= "dimensao_w, ";
$strSqlBannersArquivosSelect .= "dimensao_h, ";
$strSqlBannersArquivosSelect .= "ativacao, ";
$strSqlBannersArquivosSelect .= "arquivo, ";
$strSqlBannersArquivosSelect .= "n_impressoes, ";
$strSqlBannersArquivosSelect .= "n_impressoes_contratacao, ";
$strSqlBannersArquivosSelect .= "n_cliques, ";
$strSqlBannersArquivosSelect .= "n_cliques_contratacao ";
$strSqlBannersArquivosSelect .= "FROM tb_banners_arquivos ";
$strSqlBannersArquivosSelect .= "WHERE id <> 0 ";
$strSqlBannersArquivosSelect .= "AND id_tb_banners = :id_tb_banners ";
$strSqlBannersArquivosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoBannersArquivos'] . " ";

$statementBannersArquivosSelect = $dbSistemaConPDO->prepare($strSqlBannersArquivosSelect);

if ($statementBannersArquivosSelect !== false)
{
	$statementBannersArquivosSelect->execute(array(
		"id_tb_banners" => $idTbBanners
	));
}

//$resultadoBannersArquivos = $dbSistemaConPDO->query($strSqlBannersArquivosSelect);
$resultadoBannersArquivos = $statementBannersArquivosSelect->fetchAll();


//Verificação de erro - debug.
//echo "DbRegistroGenericoUpdate01=" . DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_banners_arquivos", "arquivo") . "<br />";
//echo "DbRegistroGenericoUpdate01=" . DbUpdate::DbRegistroGenericoUpdate01("teste", "4250", "tb_banners_arquivos", "arquivo") . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
//ob_end_flush();
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
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTitulo"); ?>
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
	
    <?php
	if (empty($resultadoBannersArquivos))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus1"); ?>
        </div>
    <?php
    }else{
    ?>

        <form name="formBannersArquivosAcoes" id="formBannersArquivosAcoes" action="RegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input name="strTabela" id="strTabela" type="hidden" value="tb_banners_arquivos" />
            <input name="idTbBanners" id="idTbBanners" type="hidden" value="<?php echo $idTbBanners; ?>" />

            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="TbFundoEscuro">
              	<?php if($GLOBALS['habilitarBannersArquivosNClassificacao'] == 1){ ?>
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
				
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosData"); ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosBanner"); ?>
                    </div>
                </td>
				
                <td width="100" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosImpressoes"); ?>
                    </div>
                </td>
                
                <td width="50" class="TabelaDados01Celula">
                    <div align="center" align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosCliques"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" align="center" class="Texto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula">
                    <div align="center" class="Texto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemExcluir"); ?>
                    </div>
                </td>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoBannersArquivos as $linhaBannersArquivos)
                {
              ?>
              <tr class="TbFundoClaro">
              	<?php if($GLOBALS['habilitarBannersArquivosNClassificacao'] == 1){ ?>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <?php echo $linhaBannersArquivos['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo Funcoes::DataLeitura01($linhaBannersArquivos['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");?>
                    </div>
					<?php if($GLOBALS['habilitarBannersArquivosPeriodos'] == 1){ ?>
						<?php if($linhaBannersArquivos['data_inicial'] <> ""){ ?>
						<div align="center" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDataInicialA"); ?>: <?php echo Funcoes::DataLeitura01($linhaBannersArquivos['data_inicial'], $GLOBALS['configSistemaFormatoData'], "1");?>
						</div>
						<?php } ?>
						
						<?php if($linhaBannersArquivos['data_final'] <> ""){ ?>
						<div align="center" class="Texto01">
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemDataFinalA"); ?>: <?php echo Funcoes::DataLeitura01($linhaBannersArquivos['data_final'], $GLOBALS['configSistemaFormatoData'], "1");?>
						</div>
						<?php } ?>
					<?php } ?>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaBannersArquivos['banner']);?>
                    </div>
					
					<?php if($linhaBannersArquivos['arquivo'] <> ""){ ?>
					<?php //echo "linhaBannersArquivos=" . $linhaBannersArquivos['arquivo'] . "<br />";?>
					<div>
						<?php
						//Definição do nome do arquivo.
						$arrArquivoExtensao = explode(".", $linhaBannersArquivos['arquivo']);
						$arquivoExtensao = strtolower(end($arrArquivoExtensao));
						?>
					
                    	<?php //Imagem. ?>
                    	<?php //---------------------- ?>
						<?php if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) { ?>
							<?php if($linhaBannersArquivos['endereco_eletronico'] <> ""){ ?>
								<a href="<?php echo Funcoes::ConteudoMascaraLeitura($linhaBannersArquivos['endereco_eletronico']); ?>" target="_blank">
									<img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaBannersArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaBannersArquivos['banner']); ?>" />
								</a>
							<?php }else{ ?>
								<img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaBannersArquivos['arquivo'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaBannersArquivos['banner']); ?>" />
							<?php } ?>
						<?php } ?>
                    	<?php //---------------------- ?>
						
                    	<?php //SWF. ?>
                    	<?php //---------------------- ?>
						<?php //echo "arquivoExtensao=" . $arquivoExtensao . "<br />"; ?>
						<?php if(strpos(".swf, .SWF", $arquivoExtensao) !== false) { ?>
							<?php
							$swfW = $linhaBannersArquivos['dimensao_w'];
							$swfH = $linhaBannersArquivos['dimensao_h'];
							?>		
										
							<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>">
								<param name="movie" value="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaBannersArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>">
								<param name="quality" value="high">
								<embed src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/<?php echo $linhaBannersArquivos['arquivo'];?>?variavelCache=<?php echo date("s"); ?>" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="<?php echo $swfW;?>" height="<?php echo $swfH;?>"></embed>
							</object>
						<?php } ?>
                    	<?php //---------------------- ?>
					</div>
					<?php } ?>


					<?php if($linhaBannersArquivos['codigo_html'] <> ""){ ?>
                    <div class="Texto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaBannersArquivos['codigo_html']);?>
                    </div>
					<?php } ?>
					
					<?php if($linhaBannersArquivos['endereco_eletronico'] <> ""){ ?>
                    <div class="Texto01">
						<br />
						<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosEnderecoEletronico"); ?>:
						</strong>
						<?php echo $linhaBannersArquivos['endereco_eletronico'];?>
                    </div>
					<?php } ?>
					
					<?php if($linhaBannersArquivos['obs'] <> ""){ ?>
                    <div class="Texto01">
						<br />
						<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosOBS"); ?>:
						</strong>
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaBannersArquivos['obs']);?>
                    </div>
					<?php } ?>
                </td>
				
                <td class="TabelaDados01Celula">
					<div align="center" class="Texto01">
						<?php if($GLOBALS['habilitarBannersArquivosTipoPublicacao'] == 1){ ?>
						<div>
                            <?php if($linhaBannersArquivos['tipo_publicacao'] == 1){ ?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao1"); ?>
							<?php } ?>
                            <?php if($linhaBannersArquivos['tipo_publicacao'] == 2){ ?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao2"); ?>
							<?php } ?>
						</div>
						<?php } ?>

						<?php if($GLOBALS['configBannersTipoSistemaPublicacao'] == 2){ ?>
						<div>
                            <a href="BannersRelacaoCategorias.php?idTbBannersArquivos=<?php echo $linhaBannersArquivos['id'];?>" target="_blank" class="Links01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosDefinirCategorias"); ?>
                            </a>
						</div>
						<?php } ?>
					</div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo $linhaBannersArquivos['n_impressoes'];?>
						
						<?php if($GLOBALS['habilitarBannersArquivosContratacao'] == 1){ ?>
						<div>
							<strong>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosContratacao"); ?>
							</strong>
							<?php echo $linhaBannersArquivos['n_impressoes_contratacao'];?>
						</div>
						<?php } ?>
                    </div>
                </td>
                
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
						<?php echo $linhaBannersArquivos['n_cliques'];?>
						
						<?php if($GLOBALS['habilitarBannersArquivosContratacao'] == 1){ ?>
						<div>
							<strong>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosContratacao"); ?>
							</strong>
							<?php echo $linhaBannersArquivos['n_cliques_contratacao'];?>
						</div>
						<?php } ?>
                    </div>
                </td>
                
                <td class="<?php if($linhaBannersArquivos['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> TabelaDados01Celula">
                    <div align="center" class="Texto01">
                    	<a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaBannersArquivos['id'];?>&statusAtivacao=<?php echo $linhaBannersArquivos['ativacao'];?>&strTabela=tb_banners_arquivos&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="Links01">
                        	<?php if($linhaBannersArquivos['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaBannersArquivos['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaBannersArquivos['ativacao'];?>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <a href="BannersArquivosEditar.php?idTbBannersArquivos=<?php echo $linhaBannersArquivos['id'];?><?php echo $queryPadrao;?>" class="Links01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td class="TabelaDados01Celula">
                    <div align="center" class="Texto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaBannersArquivos['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
        </form>
	<?php } ?>
    
	<script type="text/javascript">
		$(document).ready(function () {
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formBannersArquivos').validate({ //Inicialização do plug-in.
			
			
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
    <form name="formBannersArquivos" id="formBannersArquivos" action="BannersArquivosIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="4">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTbTitulo"); ?>
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
                        
                            <input type="text" name="data_inicial" id="data_inicial" class="CampoData01" maxlength="10" />
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
                        
                            <input type="text" name="data_final" id="data_final" class="CampoData01" maxlength="10" />
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
                            <option value="1"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao1"); ?></option>
                            <option value="2" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosTipoPublicacao2"); ?></option>
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
                        <input type="text" name="banner" id="banner" class="CampoTexto01" maxlength="255" />
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
                        <input type="text" name="n_classificacao" id="n_classificacao" class="CampoNumerico01" maxlength="10" value="0" />
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
						<textarea name="endereco_eletronico" id="endereco_eletronico" class="CampoTextoMultilinhaURL"></textarea>
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
						<textarea name="codigo_html" id="codigo_html" class="CampoTextoMultilinhaHTML"></textarea>
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
						<textarea name="obs" id="obs" class="CampoTextoMultilinhaConteudo"></textarea>
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
                        <input type="text" name="dimensao_w" id="dimensao_w" class="CampoNumerico01" maxlength="10" value="0" />
						(<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosDimensoesW"); ?>)
						
                        <input type="text" name="dimensao_h" id="dimensao_h" class="CampoNumerico01" maxlength="10" value="0" />
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
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
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
                        <input type="text" name="n_impressoes_contratacao" id="n_impressoes_contratacao" class="CampoNumerico01" maxlength="10" value="-1" />

						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBannersArquivosCliques"); ?>:
                        <input type="text" name="n_cliques_contratacao" id="n_cliques_contratacao" class="CampoNumerico01" maxlength="10" value="-1" />
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
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoIncluir"); ?>" />
                
                <input name="id_tb_banners" type="hidden" id="id_tb_banners" value="<?php echo $idTbBanners; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSelect" type="hidden" id="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                &nbsp;
            </div>
        </div>
    </form>
    <br />
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlBannersArquivosSelect);
unset($statementBannersArquivosSelect);
unset($resultadoBannersArquivos);
unset($linhaBannersArquivos);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>