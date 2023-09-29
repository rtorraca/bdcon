<?php
//Definição de variáveis.
$TipoBusca = $includeBusca_tipoBusca; //cadastro1 (busca por palavra-chave) | cadastro2 (busca detalhada) | cadastroAdm1 (busca por palavra-chave) | cadastroAdm2 (busca detalhada) | imoveis1 (busca por palavra-chave) | imoveis2 (busca com dropdown) | categoriasDropdown1 (busca com dropdown) | produtos1 (busca por palavra-chave) | produtos2 (busca detalhada) | cadastro1 (busca por palavra-chave) | cadastro2 (busca detalhada | publicacoes1 (busca por palavra-chave) | enquetes1 (busca por palavra-chave) | forum1 (busca por palavra-chave) | videos1 (busca por palavra-chave) | contatosAdm1 (busca por palavra-chave) | tarefas1 (busca por palavra-chave) | cadastroContasBancariasAdm1 (busca por palavra-chave) | paginas1 (busca por palavra-chave) |  paginasAdm1 (busca por palavra-chave) | veiculos1 (busca por palavra-chave) | veiculos2 (busca detalhada) |  processosAdm1 (busca por palavra-chave) |  fluxoAdm1 (busca por palavra-chave) | fluxoAdm2 (busca detalhada) | orcamentos2 | pedidosParcelas2 (busca detalhada)
$OrigemBusca = $includeBusca_origemBusca;
$IdTbCategoriaEscolha = $includeBusca_idTbCategoriaEscolha;

$PaginaDestino = $includeBusca_paginaDestino;
$FormTarget = $includeBusca_formTarget;

//$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
//$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataAtual = Funcoes::DataLeitura01(date("Y") . "-" . date("m") . "-" . date("d"), $GLOBALS['configSiteFormatoData'], "1");

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


//Filtros - Cadastro.
$configCadastroIDBusca = 0; //0 - desativado | 4 - campo livre
$configCadastroNomeBusca = 0; //0 - desativado | 4 - campo livre
$configCadastroCPFBusca = 0; //0 - desativado | 4 - campo livre

$configCadastroFiltroGenerico01CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico02CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico03CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico04CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico05CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico06CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico07CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico08CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico09CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico10CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico11CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico12CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico13CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico14CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico15CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico16CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico17CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico18CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico19CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configCadastroFiltroGenerico20CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu


//Filtros - Produtos.
$configProdutosIDBusca = 0; //0 - desativado | 4 - campo livre
$configProdutosCodProdutoBusca = 0; //0 - desativado | 4 - campo livre
$configProdutosProdutoBusca = 0; //0 - desativado | 4 - campo livre

$configProdutosFiltroGenerico01CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico02CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico03CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico04CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico05CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico06CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico07CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico08CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico09CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configProdutosFiltroGenerico10CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu

$configProdutosIC1CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre
$configProdutosIC2CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre


//Filtros - Veículos.
$configVeiculosIDBusca = 0; //0 - desativado | 4 - campo livre
$configVeiculosModalidadeBusca = 0; //0 - desativado | 1 - checkbox
$configVeiculosCodigoBusca = 0; //0 - desativado | 4 - campo livre
$configVeiculosPortasBusca = 0; //0 - desativado | 3 - dropdown menu | 4 - campo livre
$configVeiculosAnoFabricacaoBusca = 0; //0 - desativado | 3 - dropdown menu | 4 - campo livre
$configVeiculosAnoModeloBusca = 0; //0 - desativado | 3 - dropdown menu | 4 - campo livre

$configVeiculosLocalidadeBusca = 0; //0 - desativado | 3 - combo box com o db_cep (dropdown)

$configVeiculosFiltroGenerico01CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico02CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico03CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico04CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico05CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico06CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico07CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico08CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico09CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico10CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico11CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico12CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico13CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico14CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico15CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico16CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico17CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico18CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico19CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configVeiculosFiltroGenerico20CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu

$configVeiculosKilometragemMinimoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre
$configVeiculosKilometragemMaximoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre

$configVeiculosValorMinimoCaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre
$configVeiculosValorMaximoCaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre

$configVeiculosIC1CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre
$configVeiculosIC2CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre


//Filtros - Pedidos.
$configPedidosIDBusca = 0; //0 - desativado | 4 - campo livre
$configPedidosDataSelecaoBusca = 1; //0 - desativado | 1 - data inicial e data final
$configPedidosClassificacaoBusca = 0; //0 - desativado | 1 - ativado
$configPedidosStatusSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu


//Filtros - Pedidos Parcelas.
$configPedidosParcelasIC1CaixaSelecaoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre
$configPedidosParcelasIC2CaixaSelecaoBusca = 4; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 4 - campo livre


//Filtros - Fluxo.
$configFluxoIDBusca = 0; //0 - desativado | 4 - campo livre
$configFluxoIdTbCategoriasBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 6 - radiobox
$configFluxoDataLancamentoBusca = 7; //0 - desativado | 7 - período
$configFluxoIdTbCadastroUsuarioBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu
$configFluxoIdTbFluxoTipoBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 6 - radiobox
$configFluxoIdTbFluxoStatusBusca = 0; //0 - desativado | 1 - checkbox | 2 - listbox | 3 - dropdown menu | 6 - radiobox


//Código auxiliar:
//placeholder="Instrução" //Instrução dentro do campo.
//onchange="$('#formBuscaCadastro2').submit();" //Submit de formulário ao clicar.


//Verificação de erro - debug.
//echo "TipoBusca=" . $TipoBusca . "<br />";
//echo "OrigemBusca=" . $OrigemBusca . "<br />";
//echo "IdTbCategoriaEscolha=" . $IdTbCategoriaEscolha . "<br />";
?>


<?php //Busca cadastro (palavra-chave).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "cadastro1"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaCadastro" id="formBuscaCadastro" action="SiteCadastroIndice.php" method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca cadastro (detalhado).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "cadastro2"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaCadastro2" id="formBuscaCadastro2" action="SiteCadastroIndice.php" method="get" class="FormularioDados01">
            <?php if($GLOBALS['configCadastroCPFBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configCadastroCPFBusca'] == 4){ ?>
                            <input type="text" name="cpf_" id="cpf_" class="BuscaCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formBuscaCadastro2', 'cpf_');"<?php } ?> value="<?php echo $cpf_;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>

			<?php //Diagramação com div JQuery (animação)?>
        	<?php //----------?>
            <div style="position: relative; display: block; overflow: hidden;">
				<?php //Filtro Genérico 01.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico01'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico01)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									//HTMLAnimacaoGenerico01('divBuscaCadastroFG1Opcoes', 'min-height', '', '', null);
									HTMLEstiloGenerico01('divBuscaCadastroFG1Opcoes', 'height', '');
									//HTMLEstiloGenerico01('divBuscaCadastroFG1Opcoes', 'min-height', 'scrollHeight');
									
									divHide('divBuscaCadastroFG1');
									divShow('divBuscaCadastroFG1a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG1" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG1Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG1');divShow('divBuscaCadastroFG1a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG1a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG1Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG1a');divShow('divBuscaCadastroFG1');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico01Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG1Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 12);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                {
                                ?>
                                	<?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                	<?php //if(empty($arrIdsCadastroFiltroGenerico01)){ ?>
										<?php //HTML. ?>
                                    <?php //}else{ ?>
                                    	<?php //if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrIdsCadastroFiltroGenerico01)){ ?>
											<?php //HTML. ?>
										<?php //} ?>
									<?php //} ?>

                                    <div>
                                        <input name="idsCadastroFiltroGenerico01[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrIdsCadastroFiltroGenerico01)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico01[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrIdsCadastroFiltroGenerico01)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico01CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico01[]" name="idsCadastroFiltroGenerico01[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico01); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrIdsCadastroFiltroGenerico01)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico01[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 02.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico02'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico02)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG2Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG2');
									divShow('divBuscaCadastroFG2a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG2" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG2Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG2');divShow('divBuscaCadastroFG2a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG2a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG2Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG2a');divShow('divBuscaCadastroFG2');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico02Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG2Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 13);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico02[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrIdsCadastroFiltroGenerico02)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico02[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrIdsCadastroFiltroGenerico02)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico02CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico02[]" name="idsCadastroFiltroGenerico02[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico02); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico02[$countArray][0], $arrIdsCadastroFiltroGenerico02)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico02[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 03.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico03'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico03)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG3Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG3');
									divShow('divBuscaCadastroFG3a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG3" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG3Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG3');divShow('divBuscaCadastroFG3a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG3a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG3Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG3a');divShow('divBuscaCadastroFG3');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico03Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG3Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 14);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico03[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrIdsCadastroFiltroGenerico03)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico03[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrIdsCadastroFiltroGenerico03)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico03CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico03[]" name="idsCadastroFiltroGenerico03[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico03[$countArray][0], $arrIdsCadastroFiltroGenerico03)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico03[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 04.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico04'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico04)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG4Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG4');
									divShow('divBuscaCadastroFG4a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG4" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG4Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG4');divShow('divBuscaCadastroFG4a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG4a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG4Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG4a');divShow('divBuscaCadastroFG4');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico04Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG4Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 15);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico04[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrIdsCadastroFiltroGenerico04)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico04[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrIdsCadastroFiltroGenerico04)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico04CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico04[]" name="idsCadastroFiltroGenerico04[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico04[$countArray][0], $arrIdsCadastroFiltroGenerico04)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico04[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 05.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico05'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico05)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG5Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG5');
									divShow('divBuscaCadastroFG5a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG5" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG5Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG5');divShow('divBuscaCadastroFG5a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG5a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG5Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG5a');divShow('divBuscaCadastroFG5');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico05Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG5Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 16);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico05[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrIdsCadastroFiltroGenerico05)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico05[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrIdsCadastroFiltroGenerico05)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico05CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico05[]" name="idsCadastroFiltroGenerico05[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico05); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico05[$countArray][0], $arrIdsCadastroFiltroGenerico05)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico05[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 06.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico06'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico06)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG6Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG6');
									divShow('divBuscaCadastroFG6a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG6" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG6Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG6');divShow('divBuscaCadastroFG6a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG6a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG6Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG6a');divShow('divBuscaCadastroFG6');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico06Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG6Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 17);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico06[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrIdsCadastroFiltroGenerico06)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico06[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrIdsCadastroFiltroGenerico06)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico06CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico06[]" name="idsCadastroFiltroGenerico06[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico06); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico06[$countArray][0], $arrIdsCadastroFiltroGenerico06)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico06[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 07.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico07'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico07)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG7Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG7');
									divShow('divBuscaCadastroFG7a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG7" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG7Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG7');divShow('divBuscaCadastroFG7a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG7a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG7Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG7a');divShow('divBuscaCadastroFG7');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico07Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG7Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 18);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico07[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrIdsCadastroFiltroGenerico07)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico07[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrIdsCadastroFiltroGenerico07)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico07CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico07[]" name="idsCadastroFiltroGenerico07[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico07); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico07[$countArray][0], $arrIdsCadastroFiltroGenerico07)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico07[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 08.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico08'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico08)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG8Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG8');
									divShow('divBuscaCadastroFG8a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG8" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG8Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG8');divShow('divBuscaCadastroFG8a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG8a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG8Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG8a');divShow('divBuscaCadastroFG8');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico08Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG8Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 19);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico08[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrIdsCadastroFiltroGenerico08)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico08[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrIdsCadastroFiltroGenerico08)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico08CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico08[]" name="idsCadastroFiltroGenerico08[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico08); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico08[$countArray][0], $arrIdsCadastroFiltroGenerico08)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico08[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 09.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico09'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico09)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG9Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG9');
									divShow('divBuscaCadastroFG9a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG9" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG9Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG9');divShow('divBuscaCadastroFG9a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG9a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG9Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG9a');divShow('divBuscaCadastroFG9');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico09Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG9Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 20);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico09[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrIdsCadastroFiltroGenerico09)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico09[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrIdsCadastroFiltroGenerico09)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico09CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico09[]" name="idsCadastroFiltroGenerico09[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico09); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico09[$countArray][0], $arrIdsCadastroFiltroGenerico09)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico09[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 10.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico10'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico10)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG10Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG10');
									divShow('divBuscaCadastroFG10a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG10" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG10Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG10');divShow('divBuscaCadastroFG10a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG10a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG10Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG10a');divShow('divBuscaCadastroFG10');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico10Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG10Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 21);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico10[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrIdsCadastroFiltroGenerico10)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico10[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrIdsCadastroFiltroGenerico10)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico10CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico10[]" name="idsCadastroFiltroGenerico10[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico10); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico10[$countArray][0], $arrIdsCadastroFiltroGenerico10)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico10[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 11.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico11'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico11)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG11Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG11');
									divShow('divBuscaCadastroFG11a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG11" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG11Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG11');divShow('divBuscaCadastroFG11a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG11a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG11Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG11a');divShow('divBuscaCadastroFG11');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico11Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG11Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 60);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico11[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrIdsCadastroFiltroGenerico11)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico11[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrIdsCadastroFiltroGenerico11)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico11CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico11[]" name="idsCadastroFiltroGenerico11[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico11); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico11[$countArray][0], $arrIdsCadastroFiltroGenerico11)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico11[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 12.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico12'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico12)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG12Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG12');
									divShow('divBuscaCadastroFG12a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG12" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG12Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG12');divShow('divBuscaCadastroFG12a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG12a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG12Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG12a');divShow('divBuscaCadastroFG12');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico12Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG12Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 61);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico12[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrIdsCadastroFiltroGenerico12)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico12[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrIdsCadastroFiltroGenerico12)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico12CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico12[]" name="idsCadastroFiltroGenerico12[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico12); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico12[$countArray][0], $arrIdsCadastroFiltroGenerico12)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico12[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 13.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico13'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico13)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG13Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG13');
									divShow('divBuscaCadastroFG13a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG13" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG13Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG13');divShow('divBuscaCadastroFG13a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG13a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG13Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG13a');divShow('divBuscaCadastroFG13');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico13Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG13Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 62);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico13[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrIdsCadastroFiltroGenerico13)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico13[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrIdsCadastroFiltroGenerico13)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico13CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico13[]" name="idsCadastroFiltroGenerico13[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico13); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico13[$countArray][0], $arrIdsCadastroFiltroGenerico13)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico13[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 14.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico14'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico14)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG14Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG14');
									divShow('divBuscaCadastroFG14a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG14" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG14Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG14');divShow('divBuscaCadastroFG14a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG14a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG14Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG14a');divShow('divBuscaCadastroFG14');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico14Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG14Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 63);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico14[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrIdsCadastroFiltroGenerico14)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico14[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrIdsCadastroFiltroGenerico14)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico14CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico14[]" name="idsCadastroFiltroGenerico14[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico14); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico14[$countArray][0], $arrIdsCadastroFiltroGenerico14)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico14[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 15.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico15'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico15)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG15Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG15');
									divShow('divBuscaCadastroFG15a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG15" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG15Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG15');divShow('divBuscaCadastroFG15a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG15a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG15Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG15a');divShow('divBuscaCadastroFG15');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico15Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG15Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 64);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico15[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrIdsCadastroFiltroGenerico15)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico15[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrIdsCadastroFiltroGenerico15)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico15CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico15[]" name="idsCadastroFiltroGenerico15[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico15); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico15[$countArray][0], $arrIdsCadastroFiltroGenerico15)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico15[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 16.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico16'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico16)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG16Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG16');
									divShow('divBuscaCadastroFG16a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG16" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG16Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG16');divShow('divBuscaCadastroFG16a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG16a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG16Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG16a');divShow('divBuscaCadastroFG16');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico16Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG16Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 65);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico16[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrIdsCadastroFiltroGenerico16)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico16[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrIdsCadastroFiltroGenerico16)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico16CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico16[]" name="idsCadastroFiltroGenerico16[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico16); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico16[$countArray][0], $arrIdsCadastroFiltroGenerico16)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico16[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 17.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico17'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico17)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG17Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG17');
									divShow('divBuscaCadastroFG17a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG17" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG17Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG17');divShow('divBuscaCadastroFG17a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG17a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG17Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG17a');divShow('divBuscaCadastroFG17');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico17Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG17Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 66);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico17[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrIdsCadastroFiltroGenerico17)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico17[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrIdsCadastroFiltroGenerico17)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico17CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico17[]" name="idsCadastroFiltroGenerico17[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico17); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico17[$countArray][0], $arrIdsCadastroFiltroGenerico17)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico17[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 18.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico18'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico18)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG18Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG18');
									divShow('divBuscaCadastroFG18a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG18" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG18Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG18');divShow('divBuscaCadastroFG18a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG18a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG18Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG18a');divShow('divBuscaCadastroFG18');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico18Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG18Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 67);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico18[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrIdsCadastroFiltroGenerico18)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico18[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrIdsCadastroFiltroGenerico18)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico18CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico18[]" name="idsCadastroFiltroGenerico18[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico18); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico18[$countArray][0], $arrIdsCadastroFiltroGenerico18)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico18[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
                
				<?php //Filtro Genérico 19.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico19'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico19)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG19Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG19');
									divShow('divBuscaCadastroFG19a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG19" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG19Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG19');divShow('divBuscaCadastroFG19a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG19a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG19Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG19a');divShow('divBuscaCadastroFG19');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico19Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG19Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 68);
                            ?>
                            
                            <?php //Checkbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico19[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrIdsCadastroFiltroGenerico19)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico19[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrIdsCadastroFiltroGenerico19)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico19CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico19[]" name="idsCadastroFiltroGenerico19[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico19); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico19[$countArray][0], $arrIdsCadastroFiltroGenerico19)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico19[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>


				<?php //Filtro Genérico 20.?>
                <?php if($GLOBALS['habilitarCadastroFiltroGenerico20'] == 1){ ?>
                    <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecaoBusca'] <> 0){ ?>
                    	<?php if(!empty($arrIdsCadastroFiltroGenerico20)){ ?>
                        	<script type="text/javascript">
								$(document).ready(function() {
									HTMLEstiloGenerico01('divBuscaCadastroFG20Opcoes', 'height', '');
									
									divHide('divBuscaCadastroFG20');
									divShow('divBuscaCadastroFG20a');
								});
                            </script>
                        <?php } ?>
                        <div id="divBuscaCadastroFG20" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG20Opcoes', 'min-height', '', '', null);divHide('divBuscaCadastroFG20');divShow('divBuscaCadastroFG20a');">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>
                        <div id="divBuscaCadastroFG20a" class="BuscaDivFiltrosDiagramacao01" onclick="HTMLAnimacaoGenerico01('divBuscaCadastroFG20Opcoes', 'height', '0', '', null);divHide('divBuscaCadastroFG20a');divShow('divBuscaCadastroFG20');" style="display: none;">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroFiltroGenerico20Nome'], "IncludeConfig"); ?>
                            <img class="BuscaImgBullet01 DivFlip01" src="img/imgBullet04.gif" alt="Bullet" />
                        </div>

                        <div id="divBuscaCadastroFG20Opcoes" class="BuscaDivFiltrosOpcoesDiagramacao01" style="display: block; height: 0px;">
                            <?php 
                            $arrCadastroFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 69);
                            ?>
                            
                            <?php //Checkbox.?>

                            <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecaoBusca'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsCadastroFiltroGenerico20[]" type="checkbox" value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrIdsCadastroFiltroGenerico20)){ ?> checked="checked"<?php } ?> /> <?php echo $arrCadastroFiltroGenerico20[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            
                            <?php //Listbox.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecaoBusca'] == 2){ ?>
                                <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrIdsCadastroFiltroGenerico20)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                            <?php } ?>
                            
                            <?php //Dropdown Menu.?>
                            <?php if($GLOBALS['configCadastroFiltroGenerico20CaixaSelecaoBusca'] == 3){ ?>
                                <select id="idsCadastroFiltroGenerico20[]" name="idsCadastroFiltroGenerico20[]" class="BuscaCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrCadastroFiltroGenerico20); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrCadastroFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrCadastroFiltroGenerico20[$countArray][0], $arrIdsCadastroFiltroGenerico20)){ ?> selected="selected"<?php } ?>><?php echo $arrCadastroFiltroGenerico20[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
                
            </div>
        	<?php //----------?>


			<div>
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca cadastro (adm).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "cadastroAdm1"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteAdmCadastroIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<form name="formBuscaCadastroAdm" id="formBuscaCadastroAdm" action="<?php echo $PaginaDestino;?>" method="get"<?php if($FormTarget <> ""){?> target="<?php echo $FormTarget;?>"<?php }?> class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" value="<?php echo $palavraChave; ?>" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="idParentCadastro" id="idParentCadastro" value="<?php echo $IdTbCategoriaEscolha; ?>" />
                <!--input type="hidden" name="idTipoCadastro" id="idTipoCadastro" value="<?php echo $idTipoCadastro; ?>" /-->
                <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca cadastro (adm).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "cadastroAdm2"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteAdmCadastroIndice.php";
	}
	?>
	<div class="BuscaTexto01 DivFormularioDados01">
        <form name="formBuscaCadastroAdm2" id="formBuscaCadastroAdm2" action="<?php echo $PaginaDestino;?>" method="get" class="FormularioDados01">
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $palavraChave; ?>" />
                </div>
            </div>
            
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <div>
                        <input name="idsCadastroTipo[]" type="checkbox" value="3483" class="BuscaCampoFiltroGenericoCheckBox01" /> Cliente
                    </div>
                    <div>
                        <input name="idsCadastroTipo[]" type="checkbox" value="3492" class="BuscaCampoFiltroGenericoCheckBox01" /> Titulares
                    </div>
                    <div>
                        <input name="idsCadastroTipo[]" type="checkbox" value="3576" class="BuscaCampoFiltroGenericoCheckBox01" /> Dependentes
                    </div>
                </div>
            </div>
            
            <?php if($GLOBALS['configCadastroIDBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroID"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configCadastroIDBusca'] == 4){ ?>
                            <input type="text" name="idTbCadastro" id="idTbCadastro" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $idTbCadastro;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configCadastroNomeBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configCadastroNomeBusca'] == 4){ ?>
                            <input type="text" name="nome" id="nome" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $nome;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configCadastroCPFBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configCadastroCPFBusca'] == 4){ ?>
                            <input type="text" name="cpf_" id="cpf_" class="BuscaCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formBuscaCadastroAdm2', 'cpf_');"<?php } ?> value="<?php echo $cpf_;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				
                <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
				
                <input type="hidden" name="idParentCadastro" id="idParentCadastro" value="<?php echo $IdTbCategoriaEscolha; ?>" />
				<input type="hidden" name="idTipoCadastro" id="idTipoCadastro" value="<?php echo $idTipoCadastro; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca produtos.?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "produtos1"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteProdutosIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<form name="formBuscaProdutos1" id="formBuscaProdutos1" action="<?php echo $PaginaDestino?>"<?php if($FormTarget <> ""){?>target="<?php echo $FormTarget;?>"<?php }?> method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" value="<?php echo $palavraChave;?>" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca produtos (busca detalhada).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "produtos2"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteProdutosIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<form name="formBuscaProdutos2" id="formBuscaProdutos2" action="<?php echo $PaginaDestino?>"<?php if($FormTarget <> ""){?>target="<?php echo $FormTarget;?>"<?php }?> method="get" class="FormularioDados01">
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $palavraChave;?>" />
                </div>
            </div>

            <?php if($GLOBALS['configProdutosIDBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosID"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configProdutosIDBusca'] == 4){ ?>
                            <input type="text" name="idTbProdutos" id="idTbProdutos" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $idTbProdutos;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configProdutosCodProdutoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosCodigo"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configProdutosCodProdutoBusca'] == 4){ ?>
                            <input type="text" name="cod_produto" id="cod_produto" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $codProduto;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configProdutosProdutoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configProdutosProdutoBusca'] == 4){ ?>
                            <input type="text" name="produto" id="produto" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $produto;?>" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configProdutosIC1CaixaSelecaoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarProdutosIc1'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloProdutosIc1'], "IncludeConfig"); ?>: 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                             <?php if($GLOBALS['configProdutosIC1CaixaSelecaoBusca'] == 4){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $informacaoComplementar1;?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>
            
			<div style="position: relative; display: block; margin-top: 10px;">
				<input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca páginas (adm).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "paginasAdm1"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaPaginasAdm" id="formBuscaPaginasAdm" action="SiteAdmPaginasIndice.php" method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca contatos.?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "contatosAdm1"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaContatosAdm" id="formBuscaContatosAdm" action="SiteAdmCadastroContatosIndice.php" method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca tarefas.?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "tarefas1"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaTarefas" id="formBuscaTarefas" action="SiteTarefasIndice.php" method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca tarefas (busca detalhada).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "tarefas2"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteTarefasIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
    
            var strDatapickerAgendaPtCampos = "";
            var strDatapickerAgendaEnCampos = "";
        </script>
    
		<form name="formBuscaTarefas" id="formBuscaTarefas" action="<?php echo $PaginaDestino;?>" method="get"<?php if($FormTarget <> ""){?> target="<?php echo $FormTarget;?>"<?php }?> class="FormularioDados01">
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            
            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            
            <!--input type="hidden" id="idTbCadastro1" name="idTbCadastro1" value="0" /-->
            
            <table width="100%" class="AdmTabelaDados01">
                <tr class="AdmTbFundoEscuro">
                    <td class="AdmTabelaDados01Celula" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltros"); ?> 
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>:
                        </div>
                    </td>
                    <td colspan="3" class="AdmTbFundoClaro">
                        <div align="left">
                            <input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoTexto01" maxlength="255" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
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
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#dataTarefaPesquisaInicial;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#dataTarefaPesquisaInicial;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="dataTarefaPesquisaInicial" id="dataTarefaPesquisaInicial" class="BuscaCampoTexto01" maxlength="10" value="<?php echo $dataTarefaPesquisaInicial;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
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
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#dataTarefaPesquisaFinal;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#dataTarefaPesquisaFinal;";
                                    </script>
                                <?php } ?>
                            
                                <input type="text" name="dataTarefaPesquisaFinal" id="dataTarefaPesquisaFinal" class="BuscaCampoTexto01" maxlength="10" value="<?php echo $dataTarefaPesquisaFinal;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
            </table>
            
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca cadastro contas bancárias.?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "cadastroContasBancariasAdm1"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaCadastroContasBancarias" id="formBuscaCadastroContasBancarias" action="SiteAdmCadastroContasBancariasIndice.php" method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca veículos.?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "veiculos1"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteVeiculosIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<form name="formBuscaVeiculos1" id="formBuscaVeiculos1" action="<?php echo $PaginaDestino?>"<?php if($FormTarget <> ""){?>target="<?php echo $FormTarget;?>"<?php }?> method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" value="<?php echo $palavraChave;?>" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca veículos (busca detalhada).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "veiculos2"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteVeiculosIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<form name="formBuscaVeiculos2" id="formBuscaVeiculos2" action="<?php echo $PaginaDestino?>"<?php if($FormTarget <> ""){?>target="<?php echo $FormTarget;?>"<?php }?> method="get" class="FormularioDados01">
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01">
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $palavraChave;?>" />
                </div>
            </div>

            <?php if($GLOBALS['configVeiculosIDBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosID"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configVeiculosIDBusca'] == 4){ ?>
                            <input type="text" name="idTbVeiculos" id="idTbVeiculos" class="BuscaCampoTexto01" maxlength="255" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configVeiculosModalidadeBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
						<?php if($GLOBALS['configVeiculosModalidadeBusca'] == 1){ ?>
                            <div>
                                <input name="modalidade[]" type="checkbox" value="1" class="BuscaCampoFiltroGenericoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade1"); ?>
                            </div>
                            <div>
                                <input name="modalidade[]" type="checkbox" value="2" class="BuscaCampoFiltroGenericoCheckBox01" /> <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade2"); ?>
                            </div>
                        <?php } ?>
                    
						<?php if($GLOBALS['configVeiculosModalidadeBusca'] == 3){ ?>
                            <select name="modalidade[]" id="modalidade[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPortas0"); ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configVeiculosCodigoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosCodigo"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configVeiculosPortasBusca'] == 1){ ?>
                            
                        <?php } ?>
                         <?php if($GLOBALS['configVeiculosCodigoBusca'] == 4){ ?>
                            <input type="text" name="codigo" id="codigo" class="BuscaCampoTexto01" maxlength="255" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configVeiculosPortasBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPortas"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                         <?php if($GLOBALS['configVeiculosPortasBusca'] == 3){ ?>
                            <select name="portas" id="portas" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPortas0"); ?></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configVeiculosAnoFabricacaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAnoFabricacao"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
						<?php if($GLOBALS['configVeiculosAnoFabricacaoBusca'] == 3){ ?>
							<?php
                            $countAnoFabricacao = 1900;
                            $countAnoFabricacaoFinal = date("Y") + 2;
                            ?>
                            <select name="ano_fabricacao" id="ano_fabricacao" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <?php while($countAnoFabricacao < $countAnoFabricacaoFinal) { ?>
                                    <option value="<?php echo $countAnoFabricacao;?>"<?php if(date("Y") == $countAnoFabricacao) { ?>selected="selected"<?php }?>><?php echo $countAnoFabricacao;?></option>
                                <?php 
                                    $countAnoFabricacao++;
                                }
                                ?>
                            </select>
                        <?php } ?>
                        <?php if($GLOBALS['configVeiculosAnoFabricacaoBusca'] == 4){ ?>
                        	<input type="text" name="ano_fabricacao" id="ano_fabricacao" class="BuscaCampoTexto01" maxlength="255" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            <?php if($GLOBALS['configVeiculosAnoModeloBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAnoModelo"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
						<?php if($GLOBALS['configVeiculosAnoModeloBusca'] == 3){ ?>
							<?php
                            $countAnoModelo = 1900;
                            $countAnoModeloFinal = date("Y") + 2;
                            ?>
                            <select name="ano_modelo" id="ano_modelo" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <?php while($countAnoModelo < $countAnoModeloFinal) { ?>
                                    <option value="<?php echo $countAnoModelo;?>"<?php if(date("Y") == $countAnoModelo) { ?>selected="selected"<?php }?>><?php echo $countAnoModelo;?></option>
                                <?php 
                                    $countAnoModelo++;
                                }
                                ?>
                            </select>
                            <?php } ?>
                        <?php if($GLOBALS['configVeiculosAnoModeloBusca'] == 4){ ?>
                        	<input type="text" name="ano_modelo" id="ano_modelo" class="BuscaCampoTexto01" maxlength="255" />
                        <?php } ?>
                    </div>
                </div>
        	<?php } ?>
            
            
            <?php //Localidade.?>
            <?php if($GLOBALS['configVeiculosLocalidadeBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaLocalidade"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                    	<?php //db_cep.?>
                    	<?php if($GLOBALS['configVeiculosLocalidadeBusca'] == 3){ ?>
                            <div style="position: relative; display: block;">
                                <select id="id_db_cep_tblUF_veiculos" name="id_db_cep_tblUF" class="BuscaCampoDropDownMenu01">
                                    <option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                </select>
                            </div>
                            <div style="position: relative; display: block;">
                                <select id="id_db_cep_tblCidades_veiculos" name="id_db_cep_tblCidades" class="BuscaCampoDropDownMenu01" style="display: none;">
                                    <option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                </select>
                            </div>
                            <div style="position: relative; display: block;">
                                <select id="id_db_cep_tblBairros_veiculos" name="id_db_cep_tblBairros" class="BuscaCampoDropDownMenu01" style="display: none;">
                                    <option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                </select>
                            </div>
                            <div style="position: relative; display: block;">
                                <select id="id_db_cep_tblLogradouros_veiculos" name="id_db_cep_tblLogradouros" class="BuscaCampoDropDownMenu01" style="display: none;">
                                    <option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                </select>
                            </div>
                            
                            
                            <?php //JQuery - Ajax - CPF Duplicado.?>
                            <?php //----------------------?>
                            <script type="text/javascript">
                                $(document).ready(function(){
                                    //Teste.
                                    //$('#id_db_cep_tblUF_veiculos').html('<option value="">Select state first</option>'); 
                                    //$('#id_db_cep_tblUF_veiculos').append('<option value="">Select state first</option>'); 
                                    
                                    
                                    //Variáveis.
                                    var divProgressBar = "updtProgressBuscaVeiculos";
									
                                    var divCidades = "id_db_cep_tblCidades_veiculos";
                                    var divBairros = "id_db_cep_tblBairros_veiculos";
                                    var divLogradouros = "id_db_cep_tblLogradouros_veiculos";
									
									var tipoLocalizacao = 3;
									var tipoRetorno = 3;
									
                                    //divShow(divProgressBar);
                                    
                                    
                                    //UF - preenchimento.
                                    //**************************************************************************************
                                    $.ajax({
                                        /*funcionando.
                                        xhr: function () {
                                            var xhr = new window.XMLHttpRequest();
                                            xhr.upload.addEventListener("progress", function (evt) {
                                                if (evt.lengthComputable) {
                                                    var percentComplete = evt.loaded / evt.total;
                                                    console.log(percentComplete);
                                                    $('.progress').css({
                                                        width: percentComplete * 100 + '%'
                                                    });
                                                    if (percentComplete === 1) {
                                                        $('.progress').addClass('hide');
                                                    }
                                                }
                                            }, false);
                                            xhr.addEventListener("progress", function (evt) {
                                                if (evt.lengthComputable) {
                                                    var percentComplete = evt.loaded / evt.total;
                                                    console.log(percentComplete);
                                                    $('.progress').css({
                                                        width: percentComplete * 100 + '%'
                                                    });
                                                }
                                            }, false);
                                            return xhr;
                                        },
                                        */
                                        url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiLocalidade.php",
                                        dataType: "html",
                                        type: "GET",
                                        data: "id_db_cep_tblUF=&id_db_cep_tblCidades=&id_db_cep_tblBairros=&tipoLocalizacao=" + tipoLocalizacao + "&tipoRetorno=" + tipoRetorno + "&apiFormato=html&apiKey=",
                                        success: function(retornoDadosURL, success) 
                                        {
                                            //Preenchimento de resultados.
                                            $('#id_db_cep_tblUF_veiculos').append(retornoDadosURL); 
                                            //$('#id_db_cep_tblUF_veiculos').append('<option value="">Select state first</option>'); //teste 
                                        },
                                        error: function(retornoDadosURL, success) 
                                        {
                                            //$(".zip-error").show(); // Ruh row
                                            //elementoMensagem01('testeAlvo01', "erro");
                                            //divShow('lblCEPAlerta');
                                        }	
                                    });	
                                    //**************************************************************************************
                                    
                                    
                                    //Cidades - preenchimento.
                                    //**************************************************************************************
                                    $('#id_db_cep_tblUF_veiculos').on('change',function(){
                                        //Resgate de valor selecionado.
                                        var id_db_cep_tblUF = $(this).val();
                                        
                                        
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
    
    
                                        if(id_db_cep_tblUF != "")
                                        {
                                            $.ajax({
                                                /*funcionando.
                                                xhr: function () {
                                                    var xhr = new window.XMLHttpRequest();
                                                    xhr.upload.addEventListener("progress", function (evt) {
                                                        if (evt.lengthComputable) {
                                                            var percentComplete = evt.loaded / evt.total;
                                                            console.log(percentComplete);
                                                            $('.progress').css({
                                                                width: percentComplete * 100 + '%'
                                                            });
                                                            if (percentComplete === 1) {
                                                                $('.progress').addClass('hide');
                                                            }
                                                        }
                                                    }, false);
                                                    xhr.addEventListener("progress", function (evt) {
                                                        if (evt.lengthComputable) {
                                                            var percentComplete = evt.loaded / evt.total;
                                                            console.log(percentComplete);
                                                            $('.progress').css({
                                                                width: percentComplete * 100 + '%'
                                                            });
                                                        }
                                                    }, false);
                                                    return xhr;
                                                },
                                                */
                                                url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiLocalidade.php",
                                                dataType: "html",
                                                type: "GET",
                                                data: "id_db_cep_tblUF=" + id_db_cep_tblUF + "&id_db_cep_tblCidades=&id_db_cep_tblBairros=&tipoLocalizacao=" + tipoLocalizacao + "&tipoRetorno=" + tipoRetorno + "&apiFormato=html&apiKey=",
                                                success: function(retornoDadosURL, success) 
                                                {
                                                    //Ocultação da poleta.
                                                    divHide(divProgressBar);
                                                    
                                                    //Limpeza de opções dos elementos.
                                                    $('#' + divCidades).html('<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>'); 
                                                    $('#' + divBairros).html('<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>'); 
                                                    $('#' + divLogradouros).html('<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>'); 
                                                    
                                                    //Ocultação elementos adicionais.
                                                    elementoOcultar(divBairros);
                                                    elementoOcultar(divLogradouros);
                                                    
                                                    //Exibição do elemento com os resultados.
                                                    elementoMostrar(divCidades);
                                                    
                                                    //Preenchimento de resultados.
                                                    $('#' + divCidades).append(retornoDadosURL); 
                                                    //$('#id_db_cep_tblUF_veiculos').append('<option value="">Select state first</option>'); //teste 
                                                    
                                                },
                                                error: function(retornoDadosURL, success) 
                                                {
                                                    //$(".zip-error").show(); // Ruh row
                                                    //elementoMensagem01('testeAlvo01', "erro");
                                                    //divShow('lblCEPAlerta');
                                                }	
                                            });
                                        }else{
                                            //$('#city').html('<option value="">Select state first</option>'); 
                                        }
                                    });
                                    //**************************************************************************************
                                    
                                    
                                    //Bairros - preenchimento.
                                    //**************************************************************************************
                                    $('#id_db_cep_tblCidades_veiculos').on('change',function(){
                                        //Resgate de valor selecionado.
                                        var id_db_cep_tblCidades = $(this).val();
    
                                        
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
    
    
                                        if(id_db_cep_tblCidades != "")
                                        {
                                            $.ajax({
                                                /*funcionando.
                                                xhr: function () {
                                                    var xhr = new window.XMLHttpRequest();
                                                    xhr.upload.addEventListener("progress", function (evt) {
                                                        if (evt.lengthComputable) {
                                                            var percentComplete = evt.loaded / evt.total;
                                                            console.log(percentComplete);
                                                            $('.progress').css({
                                                                width: percentComplete * 100 + '%'
                                                            });
                                                            if (percentComplete === 1) {
                                                                $('.progress').addClass('hide');
                                                            }
                                                        }
                                                    }, false);
                                                    xhr.addEventListener("progress", function (evt) {
                                                        if (evt.lengthComputable) {
                                                            var percentComplete = evt.loaded / evt.total;
                                                            console.log(percentComplete);
                                                            $('.progress').css({
                                                                width: percentComplete * 100 + '%'
                                                            });
                                                        }
                                                    }, false);
                                                    return xhr;
                                                },
                                                */
                                                url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiLocalidade.php",
                                                dataType: "html",
                                                type: "GET",
                                                data: "id_db_cep_tblUF=&id_db_cep_tblCidades=" + id_db_cep_tblCidades + "&id_db_cep_tblBairros=&tipoLocalizacao=" + tipoLocalizacao + "&tipoRetorno=" + tipoRetorno + "&apiFormato=html&apiKey=",
                                                success: function(retornoDadosURL, success) 
                                                {
                                                    //Ocultação da poleta.
                                                    divHide(divProgressBar);
                                                    
                                                    //Exibição do elemento com os resultados.
                                                    elementoMostrar(divBairros);
                                                    
                                                    //Preenchimento de resultados.
                                                    $('#' + divBairros).append(retornoDadosURL); 
                                                    //$('#id_db_cep_tblUF_veiculos').append('<option value="">Select state first</option>'); //teste 
                                                    
                                                },
                                                error: function(retornoDadosURL, success) 
                                                {
                                                    //$(".zip-error").show(); // Ruh row
                                                    //elementoMensagem01('testeAlvo01', "erro");
                                                    //divShow('lblCEPAlerta');
                                                }	
                                            });
                                        }else{
                                            //$('#city').html('<option value="">Select state first</option>'); 
                                        }
                                    });
                                    //**************************************************************************************	
                                    
                                    
                                    //Logradouros - preenchimento.
                                    //**************************************************************************************
                                    $('#id_db_cep_tblBairros_veiculos').on('change',function(){
                                        //Resgate de valor selecionado.
                                        var id_db_cep_tblBairros = $(this).val();
    
                                        
                                        //Acionamento da poleta.
                                        divShow(divProgressBar);
    
    
                                        if(id_db_cep_tblBairros != "")
                                        {
                                            $.ajax({
                                                /*funcionando.
                                                xhr: function () {
                                                    var xhr = new window.XMLHttpRequest();
                                                    xhr.upload.addEventListener("progress", function (evt) {
                                                        if (evt.lengthComputable) {
                                                            var percentComplete = evt.loaded / evt.total;
                                                            console.log(percentComplete);
                                                            $('.progress').css({
                                                                width: percentComplete * 100 + '%'
                                                            });
                                                            if (percentComplete === 1) {
                                                                $('.progress').addClass('hide');
                                                            }
                                                        }
                                                    }, false);
                                                    xhr.addEventListener("progress", function (evt) {
                                                        if (evt.lengthComputable) {
                                                            var percentComplete = evt.loaded / evt.total;
                                                            console.log(percentComplete);
                                                            $('.progress').css({
                                                                width: percentComplete * 100 + '%'
                                                            });
                                                        }
                                                    }, false);
                                                    return xhr;
                                                },
                                                */
                                                url: "<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiLocalidade.php",
                                                dataType: "html",
                                                type: "GET",
                                                data: "id_db_cep_tblUF=&id_db_cep_tblCidades=&id_db_cep_tblBairros=" + id_db_cep_tblBairros + "&tipoLocalizacao=" + tipoLocalizacao + "&tipoRetorno=" + tipoRetorno + "&apiFormato=html&apiKey=",
                                                success: function(retornoDadosURL, success) 
                                                {
                                                    //Ocultação da poleta.
                                                    divHide(divProgressBar);
                                                    
                                                    //Exibição do elemento com os resultados.
                                                    elementoMostrar(divLogradouros);
                                                    
                                                    //Preenchimento de resultados.
                                                    $('#' + divLogradouros).append(retornoDadosURL); 
                                                    //$('#id_db_cep_tblUF_veiculos').append('<option value="">Select state first</option>'); //teste 
                                                    
                                                },
                                                error: function(retornoDadosURL, success) 
                                                {
                                                    //$(".zip-error").show(); // Ruh row
                                                    //elementoMensagem01('testeAlvo01', "erro");
                                                    //divShow('lblCEPAlerta');
                                                }	
                                            });
                                        }else{
                                            //$('#city').html('<option value="">Select state first</option>'); 
                                        }
                                    });
                                    //**************************************************************************************	
                                });
                            </script>
                            <?php //----------------------?>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            
            
			<?php //Filtro Genérico 01.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico01'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 12);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                <?php //if(empty($arrIdsVeiculosFiltroGenerico01)){ ?>
                                    <?php //HTML. ?>
                                <?php //}else{ ?>
                                    <?php //if(in_array($arrVeiculosFiltroGenerico01[$countArray][0], $arrIdsVeiculosFiltroGenerico01)){ ?>
                                        <?php //HTML. ?>
                                    <?php //} ?>
                                <?php //} ?>

                                <div>
                                    <input name="idsVeiculosFiltroGenerico01[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico01[$countArray][0], $arrIdsVeiculosFiltroGenerico01)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico01[]" name="idsVeiculosFiltroGenerico01[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico01[$countArray][0], $arrIdsVeiculosFiltroGenerico01)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico01CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico01[]" name="idsVeiculosFiltroGenerico01[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico01[$countArray][0], $arrIdsVeiculosFiltroGenerico01)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 02.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico02'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 13);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                <?php //if(empty($arrIdsVeiculosFiltroGenerico02)){ ?>
                                    <?php //HTML. ?>
                                <?php //}else{ ?>
                                    <?php //if(in_array($arrVeiculosFiltroGenerico02[$countArray][0], $arrIdsVeiculosFiltroGenerico02)){ ?>
                                        <?php //HTML. ?>
                                    <?php //} ?>
                                <?php //} ?>

                                <div>
                                    <input name="idsVeiculosFiltroGenerico02[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico02[$countArray][0], $arrIdsVeiculosFiltroGenerico02)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico02[]" name="idsVeiculosFiltroGenerico02[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico02[$countArray][0], $arrIdsVeiculosFiltroGenerico02)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico02CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico02[]" name="idsVeiculosFiltroGenerico02[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico02[$countArray][0], $arrIdsVeiculosFiltroGenerico02)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 03.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico03'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 14);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                <?php //if(empty($arrIdsVeiculosFiltroGenerico03)){ ?>
                                    <?php //HTML. ?>
                                <?php //}else{ ?>
                                    <?php //if(in_array($arrVeiculosFiltroGenerico03[$countArray][0], $arrIdsVeiculosFiltroGenerico03)){ ?>
                                        <?php //HTML. ?>
                                    <?php //} ?>
                                <?php //} ?>

                                <div>
                                    <input name="idsVeiculosFiltroGenerico03[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico03[$countArray][0], $arrIdsVeiculosFiltroGenerico03)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico03[]" name="idsVeiculosFiltroGenerico03[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico03[$countArray][0], $arrIdsVeiculosFiltroGenerico03)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico03CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico03[]" name="idsVeiculosFiltroGenerico03[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico03[$countArray][0], $arrIdsVeiculosFiltroGenerico03)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 04.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico04'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 15);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico04[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico04[$countArray][0], $arrIdsVeiculosFiltroGenerico04)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico04[]" name="idsVeiculosFiltroGenerico04[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico04[$countArray][0], $arrIdsVeiculosFiltroGenerico04)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico04CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico04[]" name="idsVeiculosFiltroGenerico04[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico04[$countArray][0], $arrIdsVeiculosFiltroGenerico04)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 05.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico05'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 16);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico05[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico05[$countArray][0], $arrIdsVeiculosFiltroGenerico05)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico05[]" name="idsVeiculosFiltroGenerico05[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico05[$countArray][0], $arrIdsVeiculosFiltroGenerico05)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico05CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico05[]" name="idsVeiculosFiltroGenerico05[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico05[$countArray][0], $arrIdsVeiculosFiltroGenerico05)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 06.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico06'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 17);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico06[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico06[$countArray][0], $arrIdsVeiculosFiltroGenerico06)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico06[]" name="idsVeiculosFiltroGenerico06[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico06[$countArray][0], $arrIdsVeiculosFiltroGenerico06)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico06CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico06[]" name="idsVeiculosFiltroGenerico06[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico06[$countArray][0], $arrIdsVeiculosFiltroGenerico06)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 07.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico07'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 18);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico07[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico07[$countArray][0], $arrIdsVeiculosFiltroGenerico07)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico07[]" name="idsVeiculosFiltroGenerico07[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico07[$countArray][0], $arrIdsVeiculosFiltroGenerico07)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico07CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico07[]" name="idsVeiculosFiltroGenerico07[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico07[$countArray][0], $arrIdsVeiculosFiltroGenerico07)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 08.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico08'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 19);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico08[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico08[$countArray][0], $arrIdsVeiculosFiltroGenerico08)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico08[]" name="idsVeiculosFiltroGenerico08[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico08[$countArray][0], $arrIdsVeiculosFiltroGenerico08)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico08CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico08[]" name="idsVeiculosFiltroGenerico08[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico08[$countArray][0], $arrIdsVeiculosFiltroGenerico08)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 09.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico09'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 20);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico09[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico09[$countArray][0], $arrIdsVeiculosFiltroGenerico09)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico09[]" name="idsVeiculosFiltroGenerico09[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico09[$countArray][0], $arrIdsVeiculosFiltroGenerico09)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico09CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico09[]" name="idsVeiculosFiltroGenerico09[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico09[$countArray][0], $arrIdsVeiculosFiltroGenerico09)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 10.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico10'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 21);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico10[$countArray][0], $arrIdsVeiculosFiltroGenerico10)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico10[$countArray][0], $arrIdsVeiculosFiltroGenerico10)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico10[$countArray][0], $arrIdsVeiculosFiltroGenerico10)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 11.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico11'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 22);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                <?php //if(empty($arrIdsVeiculosFiltroGenerico11)){ ?>
                                    <?php //HTML. ?>
                                <?php //}else{ ?>
                                    <?php //if(in_array($arrVeiculosFiltroGenerico11[$countArray][0], $arrIdsVeiculosFiltroGenerico11)){ ?>
                                        <?php //HTML. ?>
                                    <?php //} ?>
                                <?php //} ?>

                                <div>
                                    <input name="idsVeiculosFiltroGenerico11[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico11[$countArray][0], $arrIdsVeiculosFiltroGenerico11)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico11[]" name="idsVeiculosFiltroGenerico11[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico11[$countArray][0], $arrIdsVeiculosFiltroGenerico11)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico11CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico11[]" name="idsVeiculosFiltroGenerico11[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico11[$countArray][0], $arrIdsVeiculosFiltroGenerico11)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 12.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico12'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 23);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                <?php //if(empty($arrIdsVeiculosFiltroGenerico12)){ ?>
                                    <?php //HTML. ?>
                                <?php //}else{ ?>
                                    <?php //if(in_array($arrVeiculosFiltroGenerico12[$countArray][0], $arrIdsVeiculosFiltroGenerico12)){ ?>
                                        <?php //HTML. ?>
                                    <?php //} ?>
                                <?php //} ?>

                                <div>
                                    <input name="idsVeiculosFiltroGenerico12[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico12[$countArray][0], $arrIdsVeiculosFiltroGenerico12)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico12[]" name="idsVeiculosFiltroGenerico12[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico12[$countArray][0], $arrIdsVeiculosFiltroGenerico12)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico12CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico12[]" name="idsVeiculosFiltroGenerico12[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico12[$countArray][0], $arrIdsVeiculosFiltroGenerico12)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 13.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico13'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 24);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                                <?php //if(empty($arrIdsVeiculosFiltroGenerico13)){ ?>
                                    <?php //HTML. ?>
                                <?php //}else{ ?>
                                    <?php //if(in_array($arrVeiculosFiltroGenerico13[$countArray][0], $arrIdsVeiculosFiltroGenerico13)){ ?>
                                        <?php //HTML. ?>
                                    <?php //} ?>
                                <?php //} ?>

                                <div>
                                    <input name="idsVeiculosFiltroGenerico13[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico13[$countArray][0], $arrIdsVeiculosFiltroGenerico13)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico13[]" name="idsVeiculosFiltroGenerico13[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico13[$countArray][0], $arrIdsVeiculosFiltroGenerico13)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico13CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico13[]" name="idsVeiculosFiltroGenerico13[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico13[$countArray][0], $arrIdsVeiculosFiltroGenerico13)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 14.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico14'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 25);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico14[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico14[$countArray][0], $arrIdsVeiculosFiltroGenerico14)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico14[]" name="idsVeiculosFiltroGenerico14[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico14[$countArray][0], $arrIdsVeiculosFiltroGenerico14)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico14CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico14[]" name="idsVeiculosFiltroGenerico14[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico14[$countArray][0], $arrIdsVeiculosFiltroGenerico14)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 15.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico15'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 26);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico15[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico15[$countArray][0], $arrIdsVeiculosFiltroGenerico15)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico15[]" name="idsVeiculosFiltroGenerico15[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico15[$countArray][0], $arrIdsVeiculosFiltroGenerico15)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico15CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico15[]" name="idsVeiculosFiltroGenerico15[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico15[$countArray][0], $arrIdsVeiculosFiltroGenerico15)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 16.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico16'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 27);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico16[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico16[$countArray][0], $arrIdsVeiculosFiltroGenerico16)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico16[]" name="idsVeiculosFiltroGenerico16[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico16[$countArray][0], $arrIdsVeiculosFiltroGenerico16)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico16CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico16[]" name="idsVeiculosFiltroGenerico16[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico16[$countArray][0], $arrIdsVeiculosFiltroGenerico16)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 17.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico17'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 28);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico17[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico17[$countArray][0], $arrIdsVeiculosFiltroGenerico17)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico17[]" name="idsVeiculosFiltroGenerico17[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico17[$countArray][0], $arrIdsVeiculosFiltroGenerico17)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico17CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico17[]" name="idsVeiculosFiltroGenerico17[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico17[$countArray][0], $arrIdsVeiculosFiltroGenerico17)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
			<?php //Filtro Genérico 18.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico18'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 29);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico18[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico18[$countArray][0], $arrIdsVeiculosFiltroGenerico18)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico18[]" name="idsVeiculosFiltroGenerico18[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico18[$countArray][0], $arrIdsVeiculosFiltroGenerico18)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico18CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico18[]" name="idsVeiculosFiltroGenerico18[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico18[$countArray][0], $arrIdsVeiculosFiltroGenerico18)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 19.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico19'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 30);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico19[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico19[$countArray][0], $arrIdsVeiculosFiltroGenerico19)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico19[]" name="idsVeiculosFiltroGenerico19[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico19[$countArray][0], $arrIdsVeiculosFiltroGenerico19)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico19CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico19[]" name="idsVeiculosFiltroGenerico19[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico19[$countArray][0], $arrIdsVeiculosFiltroGenerico19)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>

			<?php //Filtro Genérico 20.?>
            <?php if($GLOBALS['habilitarVeiculosFiltroGenerico10'] == 1){ ?>
                <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] <> 0){ ?>
                <div class="BuscaDivItensDiagramacao01">
                    <div class="BuscaDivCamposDiagramacao01">
                        <strong>
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                        </strong>
                    </div>

                    <div class="BuscaDivCamposDiagramacao01">
                        <?php 
                        $arrVeiculosFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_veiculos_complemento", 31);
                        ?>
                        
                        <?php //Checkbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsVeiculosFiltroGenerico10[]" type="checkbox" value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrVeiculosFiltroGenerico10[$countArray][0], $arrIdsVeiculosFiltroGenerico10)){ ?> checked="checked"<?php } ?> /> <?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        
                        <?php //Listbox.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] == 2){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico10[$countArray][0], $arrIdsVeiculosFiltroGenerico10)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                        <?php } ?>
                        
                        <?php //Dropdown Menu.?>
                        <?php if($GLOBALS['configVeiculosFiltroGenerico10CaixaSelecaoBusca'] == 3){ ?>
                            <select id="idsVeiculosFiltroGenerico10[]" name="idsVeiculosFiltroGenerico10[]" class="BuscaCampoDropDownMenu01">
                            	<option value="" selected="true"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltroSelecaoIndiferente"); ?></option>
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrVeiculosFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrVeiculosFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrVeiculosFiltroGenerico10[$countArray][0], $arrIdsVeiculosFiltroGenerico10)){ ?> selected="selected"<?php } ?>><?php echo $arrVeiculosFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            <?php } ?>
            
            
            <?php //Quilometragem. ?>
            <?php if($GLOBALS['configVeiculosKilometragemMinimoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragem"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaMinimo"); ?> (<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMetricoDistancia'], "IncludeConfig"); ?>): 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                            <?php if($GLOBALS['configVeiculosKilometragemMinimoBusca'] == 4){ ?>
                                <input type="text" name="kilometragem_minimo" id="kilometragem_minimo" class="BuscaCampoTexto01" maxlength="255" />
                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragemDescricao01"); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>

            <?php if($GLOBALS['configVeiculosKilometragemMaximoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragem"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaMaximo"); ?> (<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMetricoDistancia'], "IncludeConfig"); ?>): 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                            <?php if($GLOBALS['configVeiculosKilometragemMaximoBusca'] == 4){ ?>
                                <input type="text" name="kilometragem_maximo" id="kilometragem_maximo" class="BuscaCampoTexto01" maxlength="255" />
                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragemDescricao01"); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>


            <?php //Valores. ?>
            <?php if($GLOBALS['configVeiculosValorMinimoCaixaSelecaoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaValorMinimo"); ?>: 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                            <?php if($GLOBALS['configVeiculosIC1CaixaSelecaoBusca'] == 4){ ?>
								<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_minimo" id="valor_minimo" class="BuscaCampoTexto01" maxlength="255" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>

            <?php if($GLOBALS['configVeiculosValorMaximoCaixaSelecaoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaValorMaximo"); ?>: 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                            <?php if($GLOBALS['configVeiculosIC1CaixaSelecaoBusca'] == 4){ ?>
								<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                <input type="text" name="valor_maximo" id="valor_maximo" class="BuscaCampoTexto01" maxlength="255" />
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>


            <?php if($GLOBALS['configVeiculosIC1CaixaSelecaoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarVeiculosIc1'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc1'], "IncludeConfig"); ?>: 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                             <?php if($GLOBALS['configVeiculosIC1CaixaSelecaoBusca'] == 4){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $informacaoComplementar1;?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>
            
			<div style="position: relative; display: block; margin-top: 10px;">
				<input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca processos (adm).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "processosAdm1"){ ?>
	<div class="BuscaTexto01">
		<form name="formBuscaProcessosAdm" id="formBuscaProcessosAdm" action="SiteAdmProcessosIndice.php" method="get" class="FormularioDados01">
			<strong>
				<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
			</strong>
			<input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoHome" maxlength="255" />
			<div style="display: inline-block; /*margin-top: 10px;*/ height: 24px; vertical-align: middle; margin-left: 0px;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca pedidos (busca detalhada).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "pedidos2"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteAdmPedidosIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<?php //Substituir por strDatapickerGenericoPtCampos (e verificar falha de carregamento do calendário).?>
		<script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
    
            var strDatapickerNascimentoPtCampos = "";
            var strDatapickerNascimentoEnCampos = "";
        </script>
        <form name="formPedidosFiltros" id="formPedidosFiltros" action="<?php echo $PaginaDestino;?>" method="get"<?php if($FormTarget <> ""){?> target="<?php echo $FormTarget;?>"<?php }?> method="get" class="FormularioTabela01">
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            
            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
            <input type="hidden" id="idTbCadastro" name="idTbCadastro" value="<?php echo $idTbCadastro; ?>" />
            
            <table width="100%" class="AdmTabelaDados01">
                <tr class="AdmTbFundoEscuro">
                    <td class="AdmTbFundoEscuro TabelaDados01Celula" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltros"); ?> 
                        </div>
                    </td>
                </tr>
                
                <?php if($configPedidosIDBusca == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="id" id="id" class="AdmCampoNumerico02" maxlength="10" />
                        </div>
                    </td>
                </tr>
				<?php } ?>
                
                <?php if($configPedidosDataSelecaoBusca == 1){ ?>
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
                                        strDatapickerNascimentoPtCampos = strDatapickerNascimentoPtCampos + "#dataInicial;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerNascimentoEnCampos = strDatapickerNascimentoEnCampos + "#dataInicial;";
                                    </script>
                                <?php } ?>
                            
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
                                        strDatapickerNascimentoPtCampos = strDatapickerNascimentoPtCampos + "#dataFinal;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickeNascimentoEnCampos = strDatapickerNascimentoEnCampos + "#dataFinal;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                <input type="text" name="dataFinal" id="dataFinal" class="AdmCampoData01" maxlength="10" value="<?php echo $dataFinal_print;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($configPedidosClassificacaoBusca == 1){ ?>
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
                <?php } ?>
                
                <?php if($configPedidosStatusSelecaoBusca <> 0){ ?>
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
                                
                                <?php if($configPedidosStatusSelecaoBusca == 3){ ?>
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
                                <?php } ?> 
                            </div>
                        </td>
                    </tr>            
                    <?php } ?>
                <?php } ?>
            </table>
            <div>
                <div style="float:left;">
                    <input type="image" name="submit" value="Submit" src="img/btoAplicar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAplicar"); ?>" style="display: none;" />
                    <input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca pedidos parcelas (busca detalhada).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "pedidosParcelas2"){ ?>
	<?php
	if($PaginaDestino == "")
	{
		$PaginaDestino = "SiteAdmPedidosParcelasIndice.php";
	}
	?>
	<div class="BuscaTexto01">
		<form name="formBuscaProcessosAdm" id="formBuscaProcessosAdm" action="<?php echo $PaginaDestino;?>" method="get" class="FormularioDados01">
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01">
                    <strong>
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoTexto01" maxlength="255" />
                </div>
            </div>
            
            
            <?php if($GLOBALS['configPedidosParcelasIC1CaixaSelecaoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarPedidosParcelasIc1'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc1'], "IncludeConfig"); ?>: 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                             <?php if($GLOBALS['configPedidosParcelasIC1CaixaSelecaoBusca'] == 4){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $informacaoComplementar1;?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>
            
            <?php if($GLOBALS['configPedidosParcelasIC2CaixaSelecaoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarPedidosParcelasIc2'] == 1){ ?>
                    <div class="BuscaDivItensDiagramacao01">
                        <div class="BuscaDivCamposDiagramacao01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPedidosParcelasTituloIc2'], "IncludeConfig"); ?>: 
                            </strong>
                        </div>
    
                        <div class="BuscaDivCamposDiagramacao01">
                             <?php if($GLOBALS['configPedidosParcelasIC2CaixaSelecaoBusca'] == 4){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $informacaoComplementar2;?>" />
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
        	<?php } ?>
            
            <input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
            <input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
        </form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca Fluxo (adm) - Detalhada.?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "fluxoAdm2"){ ?>
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.

        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
	<div class="BuscaTexto01">
		<form name="formBuscaFluxoAdm2" id="formBuscaFluxoAdm2" action="SiteAdmFluxoIndice.php" method="get" class="FormularioDados01">
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01" >
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBusca"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <input type="text" name="palavraChave" id="palavraChave" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $palavraChave;?>" />
                </div>
            </div>
            
            <?php if($GLOBALS['configFluxoIDBusca'] == 4){ ?>
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01" >
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoID"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
                    <input type="text" name="idTbFluxo" id="idTbFluxo" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $idTbFluxo;?>" />
                </div>
            </div>
			<?php } ?>
            
            <?php if($GLOBALS['configFluxoDataLancamentoBusca'] == 7){ ?>
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01" >
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaDataInicial"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
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
            </div>
            
            <div class="BuscaDivItensDiagramacao01">
                <div class="BuscaDivCamposDiagramacao01" >
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaDataFinal"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
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
            </div>
			<?php } ?>

            <?php if($GLOBALS['configFluxoIdTbFluxoTipoBusca'] <> 0){ ?>
				<?php if($GLOBALS['habilitarFluxoTipo'] == 1){ ?>
                <div class="BuscaDivCamposDiagramacao01" >
                    <strong>
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteFluxoTipo"); ?>: 
                    </strong>
                </div>

                <div class="BuscaDivCamposDiagramacao01">
					<?php 
                    $arrFluxoTipo = DbFuncoes::FiltrosGenericosFill01("tb_fluxo_complemento", 1);
                    ?>
                    
                    <?php //Checkbox.?>
                    <?php if($GLOBALS['configFluxoIdTbFluxoTipoBusca'] == 1){ ?>
                        <?php 
                        for($countArray = 0; $countArray < count($arrFluxoTipo); $countArray++)
                        {
                        ?>
                            <?php //Lógica para mostrar somente opção selecionada, depois da seleção - funcionando.?>
                            <?php //if(empty($arrIdsCadastroFiltroGenerico01)){ ?>
                                <?php //HTML. ?>
                            <?php //}else{ ?>
                                <?php //if(in_array($arrCadastroFiltroGenerico01[$countArray][0], $arrIdsCadastroFiltroGenerico01)){ ?>
                                    <?php //HTML. ?>
                                <?php //} ?>
                            <?php //} ?>

                            <div>
                                <input name="idsTbFluxoTipo[]" type="checkbox" value="<?php echo $arrFluxoTipo[$countArray][0];?>" class="BuscaCampoFiltroGenericoCheckBox01"<?php if(in_array($arrFluxoTipo[$countArray][0], $arrIdsFluxoTipo)){ ?> checked="checked"<?php } ?> /> <?php echo $arrFluxoTipo[$countArray][1];?>
                            </div>
                        <?php 
                        }
                        ?>
                    <?php } ?>
                    
                    <?php //Listbox.?>
                    <?php if($GLOBALS['configFluxoIdTbFluxoTipoBusca'] == 2){ ?>
                        <select id="idsTbFluxoTipo[]" name="idsTbFluxoTipo[]" size="5" multiple="multiple" class="BuscaCampoFiltroGenericoListBox01">
                            <?php 
                            for($countArray = 0; $countArray < count($arrFluxoTipo); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrFluxoTipo[$countArray][0];?>"<?php if(in_array($arrFluxoTipo[$countArray][0], $arrIdsFluxoTipo)){ ?> selected="selected"<?php } ?>><?php echo $arrFluxoTipo[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select> 
                    <?php } ?>
                    
                    <?php //Dropdown Menu.?>
                    <?php if($GLOBALS['configFluxoIdTbFluxoTipoBusca'] == 3){ ?>
                        <select id="idsTbFluxoTipo[]" name="idsTbFluxoTipo[]" class="BuscaCampoDropDownMenu01">
                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrFluxoTipo); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrFluxoTipo[$countArray][0];?>"<?php if(in_array($arrFluxoTipo[$countArray][0], $arrIdsFluxoTipo)){ ?> selected="selected"<?php } ?>><?php echo $arrFluxoTipo[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    <?php } ?>
                </div>
				<?php } ?>
			<?php } ?>
            
			<div style="position: relative; display: block;">
				<input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
				<input type="hidden" name="masterPageSiteSelect" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
			</div>
		</form>
	</div>
<?php } ?>
<?php //**************************************************************************************?>


<?php //Busca orçamentos (detalhado).?>
<?php //**************************************************************************************?>
<?php if($TipoBusca == "orcamentos2"){ ?>
	<div class="BuscaTexto01">
		<script type="text/javascript">
            //Variável para conter todos os campos que funcionam com o DatePicker.
            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
    
            var strDatapickerAgendaPtCampos = "";
            var strDatapickerAgendaEnCampos = "";
        </script>
    
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
                        <div align="center">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaFiltros"); ?> 
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
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
                            
                                <input type="text" name="dataInicial" id="dataInicial" class="BuscaCampoTexto01" maxlength="10" value="<?php echo $dataInicial;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
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
                            
                                <input type="text" name="dataFinal" id="dataFinal" class="BuscaCampoTexto01" maxlength="10" value="<?php echo $dataFinal;?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroNome"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="nome" id="nome" class="BuscaCampoTexto01" maxlength="255" value="<?php echo $nome;?>" />
                        </div>
                    </td>
                </tr>    
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="cpf_" id="cpf_" class="BuscaCampoTexto01" maxlength="255"<?php if($GLOBALS['configCadastroCPFMascara'] == "1") { ?> onkeypress="javascript:mascaraGenerica('###.###.###-##', this, 'formOrcamentosFiltros', 'cpf_');"<?php } ?> value="<?php echo $cpf_;?>" />
                        </div>
                    </td>
                </tr>            
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosNumero"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="id" id="id" class="BuscaCampoNumerico01" maxlength="10" value="<?php echo $id;?>" />
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
                            <select name="id_ce_complemento_status" id="id_ce_complemento_status" class="BuscaCampoDropDownMenu01">
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
                    <input type="image" name="submit" value="Submit" src="img/btoBusca01.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
                </div>
                <div style="float:right;">
                    &nbsp;
                </div>
            </div>
        </form>
    </div>
<?php } ?>
<?php //**************************************************************************************?>