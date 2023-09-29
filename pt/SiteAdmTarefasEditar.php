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
$idTbTarefas = $_GET["idTbTarefas"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbTarefas, "tb_tarefas", "id_parent");
$idTbCadastro1 = $_GET["idTbCadastro1"];

$habilitarListagem = $_GET["habilitarListagem"];
$habilitarInclusao = $_GET["habilitarInclusao"];
$habilitarDetalhes = $_GET["habilitarDetalhes"];
$habilitarBusca = $_GET["habilitarBusca"];

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmTarefasIndice.php";
$paginaRetornoExclusao = "SiteAdmTarefasEditar.php";
$variavelRetorno = "idTbTarefas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&idTbCadastro1=" . $idTbCadastro1 . 
"&habilitarListagem=" . $habilitarListagem . 
"&habilitarInclusao=" . $habilitarInclusao . 
"&habilitarDetalhes=" . $habilitarDetalhes . 
"&habilitarBusca=" . $habilitarBusca . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSelect=" . $masterPageSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlTarefasDetalhesSelect = "";
$strSqlTarefasDetalhesSelect .= "SELECT ";
//$strSqlTarefasDetalhesSelect .= "* ";
$strSqlTarefasDetalhesSelect .= "id, ";
$strSqlTarefasDetalhesSelect .= "id_parent, ";
$strSqlTarefasDetalhesSelect .= "data_registro_tarefa, ";
$strSqlTarefasDetalhesSelect .= "data_tarefa, ";
$strSqlTarefasDetalhesSelect .= "data_tarefa_final, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlTarefasDetalhesSelect .= "tarefa, ";
$strSqlTarefasDetalhesSelect .= "descricao, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlTarefasDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar1, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar2, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar3, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar4, ";
$strSqlTarefasDetalhesSelect .= "informacao_complementar5, ";
$strSqlTarefasDetalhesSelect .= "id_tb_tarefa_status, ";
$strSqlTarefasDetalhesSelect .= "ativacao ";
$strSqlTarefasDetalhesSelect .= "FROM tb_tarefas ";
$strSqlTarefasDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlTarefasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlTarefasDetalhesSelect .= "AND id = :id ";
//$strSqlTarefasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementTarefasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlTarefasDetalhesSelect);

if ($statementTarefasDetalhesSelect !== false)
{
	$statementTarefasDetalhesSelect->execute(array(
		"id" => $idTbTarefas
	));
}
//----------


//$resultadoTarefasDetalhes = $dbSistemaConPDO->query($strSqlTarefasDetalhesSelect);
$resultadoTarefasDetalhes = $statementTarefasDetalhesSelect->fetchAll();

if (empty($resultadoTarefasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoTarefasDetalhes as $linhaTarefasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbTarefasId = $linhaTarefasDetalhes['id'];
		$tbTarefasIdParent = $linhaTarefasDetalhes['id_parent'];
		$tbTarefasDataRegistroTarefa = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_registro_tarefa'], $GLOBALS['configSiteFormatoData'], "1");
		
		$tbTarefasDataTarefa = $linhaTarefasDetalhes['data_tarefa'];
		$tbTarefasDataTarefa_print = Funcoes::DataLeitura01($tbTarefasDataTarefa, $GLOBALS['configSistemaFormatoData'], "1");
		$tbTarefasDataTarefaHora = date("H",strtotime($tbTarefasDataTarefa));
		$tbTarefasDataTarefaMinuto = date("i",strtotime($tbTarefasDataTarefa));
		
		$tbTarefasDataTarefaFinal = Funcoes::DataLeitura01($linhaTarefasDetalhes['data_tarefa_final'], $GLOBALS['configSiteFormatoData'], "1");
		$tbTarefasIdTbCadastroUsuario = $linhaTarefasDetalhes['id_tb_cadastro_usuario'];
		$tbTarefasTarefa = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['tarefa']);
		$tbTarefasDescricao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['descricao']);
		
		$tbTarefasIdTbCadastro1 = $linhaTarefasDetalhes['id_tb_cadastro1'];
		$tbTarefasIdTbCadastro2 = $linhaTarefasDetalhes['id_tb_cadastro2'];
		$tbTarefasIdTbCadastro3 = $linhaTarefasDetalhes['id_tb_cadastro3'];

		$tbTarefasIC1 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar1']);
		$tbTarefasIC2 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar2']);
		$tbTarefasIC3 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar3']);
		$tbTarefasIC4 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar4']);
		$tbTarefasIC5 = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['informacao_complementar5']);
		$tbTarefasIdTbTarefaStatus = $linhaTarefasDetalhes['id_tb_tarefa_status'];
		$tbTarefasAtivacao = Funcoes::ConteudoMascaraLeitura($linhaTarefasDetalhes['ativacao']);
		
		$tbTarefasIdTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $tbTarefasId, "", "", 1);
		//Verificação de erro.
		//echo "tbTarefasId=" . $tbTarefasId . "<br>";
		//echo "tbTarefasAssunto=" . $tbTarefasAssunto . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasEditarTitulo");
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tituloLinkAtual; ?>
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
    
    
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formTarefasEditar" id="formTarefasEditar" action="SiteAdmTarefasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div>
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTbTarefasEditar"); ?>
                            </strong>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasData"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
										strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
										strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_tarefa" id="data_tarefa" class="AdmCampoData01" maxlength="10" value="<?php echo $tbTarefasDataTarefa_print; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                            
                            <?php //Horário. ?>
                            <?php if($GLOBALS['habilitarTarefasDataHorario'] == 1){ ?>
								<?php 
                                    $arrHoraFill = Funcoes::HorarioFill01("h", 1);
                                ?>
                                <select name="data_tarefa_hora" id="data_tarefa_hora" class="AdmCampoDropDownMenu01">
                                    <!--option value="" selected="selected"></option-->
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHoraFill); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHoraFill[$countArray];?>"
										<?php if($tbTarefasDataTarefaHora == $arrHoraFill[$countArray]){ ?> selected="selected"<?php } ?>
                                        ><?php echo $arrHoraFill[$countArray];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                                :
								<?php 
                                    $arrMinutoFill = Funcoes::HorarioFill01("m", 1);
                                ?>
                                <select name="data_tarefa_minuto" id="data_tarefa_minuto" class="AdmCampoDropDownMenu01">
                                    <!--option value="" selected="selected"></option-->
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrMinutoFill); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrMinutoFill[$countArray];?>"
                                        <?php if($tbTarefasDataTarefaMinuto == $arrMinutoFill[$countArray]){ ?> selected="selected"<?php } ?>
                                        ><?php echo $arrMinutoFill[$countArray];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarTarefasDataFinal'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasDataFinal"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data_tarefa";
										strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa_final;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data_tarefa";
										strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa_final;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data_tarefa_final" id="data_tarefa_final" class="AdmCampoData01" maxlength="10" value="<?php echo $tbTarefasDataTarefaFinal; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
    
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefas"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tarefa" id="tarefa" class="AdmCampoTexto01" value="<?php echo $tbTarefasTarefa; ?>" />
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasDescricao"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbTarefasDescricao; ?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#descricao").cleditor(
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
                                <textarea name="descricao" id="descricao"><?php echo $tbTarefasDescricao; ?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#descricao").cleditor(
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
                                <textarea name="descricao" id="descricao"><?php echo $tbTarefasDescricao; ?></textarea>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                
				<?php if($GLOBALS['habilitarTarefasVinculo1'] == 1){ ?>
					<?php if($idTbCadastro1 == ""){ ?>
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo1Nome'], "IncludeConfig"); ?>:
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div class="AdmTexto01">
                                <?php 
                                    $arrTarefasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTarefasVinculo1'], $GLOBALS['configIdTbTipoTarefasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTarefasVinculo1'], $GLOBALS['configTarefasVinculo1Metodo']);
                                ?>
                                <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                    <option value="0"<?php if($tbTarefasIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrTarefasVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrTarefasVinculo1[$countArray][0];?>"<?php if($arrTarefasVinculo1[$countArray][0] == $tbTarefasIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasVinculo1[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <?php }else{ ?>
                    	<input type="hidden" id="id_tb_cadastro1" name="id_tb_cadastro1" value="<?php echo $idTbCadastro1; ?>" />
                    <?php } ?>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasVinculo2'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo2Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrTarefasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTarefasVinculo2'], $GLOBALS['configIdTbTipoTarefasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTarefasVinculo2'], $GLOBALS['configTarefasVinculo2Metodo']);
                            ?>
                            <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbTarefasIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo2[$countArray][0];?>"<?php if($arrTarefasVinculo2[$countArray][0] == $tbTarefasIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasVinculo2[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasVinculo3'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo3Nome'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrTarefasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbTarefasVinculo3'], $GLOBALS['configIdTbTipoTarefasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoTarefasVinculo3'], $GLOBALS['configTarefasVinculo3Metodo']);
                            ?>
                            <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbTarefasIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo3[$countArray][0];?>"<?php if($arrTarefasVinculo3[$countArray][0] == $tbTarefasIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasVinculo3[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasIc1'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC1; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbTarefasIC1; ?></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbTarefasIC1; ?></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbTarefasIC1; ?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasIc2'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC2; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbTarefasIC2; ?></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbTarefasIC2; ?></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbTarefasIC2; ?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc3'] == 1){ ?>

                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC3; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbTarefasIC3; ?></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbTarefasIC3; ?></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbTarefasIC3; ?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc4'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC4; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbTarefasIC4; ?></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbTarefasIC4; ?></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbTarefasIC4; ?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc5'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto01" maxlength="255" value="<?php echo $tbTarefasIC5; ?>" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbTarefasIC5; ?></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbTarefasIC5; ?></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbTarefasIC5; ?></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasUsuario'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasCadastroUsuario"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrTarefasCadastroUsuario = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_tb_cadastro_usuario" id="id_tb_cadastro_usuario" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbTarefasIdTbCadastroUsuario == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasCadastroUsuario[$countArray][0];?>"<?php if($arrTarefasCadastroUsuario[$countArray][0] == $tbTarefasIdTbCadastroUsuario){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasCadastroUsuario[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasStatus'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasStatus"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrTarefasStatus = DbFuncoes::FiltrosGenericosFill01("tb_cadastro_complemento", 9);
                            ?>
                            <select name="id_tb_tarefa_status" id="id_tb_tarefa_status" class="AdmCampoDropDownMenu01">
                                <option value="0"<?php if($tbTarefasIdTbTarefaStatus == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasStatus[$countArray][0];?>"<?php if($arrTarefasStatus[$countArray][0] == $tbTarefasIdTbTarefaStatus){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasStatus[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcesso"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrTarefasProcessos = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_processos", "id_parent", "processo", "processo", 1);
                            ?>
                            <select name="id_tb_processos" id="id_tb_processos" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasProcessos); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasProcessos[$countArray][0];?>"<?php if($arrTarefasProcessos[$countArray][0] == $tbTarefasIdTbTarefasProcessos){ ?> selected="selected"<?php } ?>><?php echo $arrTarefasProcessos[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input type="hidden" id="idTbTarefas" name="idTbTarefas" value="<?php echo $idTbTarefas; ?>" />
                <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $tbTarefasIdParent; ?>" />
                <input type="hidden" id="ativacao" name="ativacao" value="<?php echo $tbTarefasAtivacao; ?>" />
                
                <input type="hidden" id="idTbCadastro1" name="idTbCadastro1" value="<?php echo $idTbCadastro1; ?>" />
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?><?php echo $queryPadrao; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
        
    </form>
    <br />

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlTarefasDetalhesSelect);
unset($statementTarefasDetalhesSelect);
unset($resultadoTarefasDetalhes);
unset($linhaTarefasDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>