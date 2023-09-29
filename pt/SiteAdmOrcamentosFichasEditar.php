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
$idCeOrcamentosFichas = $_GET["idCeOrcamentosFichas"];
$idCeOrcamentos = DbFuncoes::GetCampoGenerico01($idCeOrcamentosFichas, "ce_orcamentos_fichas", "id_ce_orcamentos");

$paginaRetorno = "SiteAdmOrcamento.php";
$paginaRetornoExclusao = "SiteAdmOrcamentosFichasEditar.php";
$variavelRetorno = "idCeOrcamentos";
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
$strSqlOrcamentosFichasDetalhesSelect = "";
$strSqlOrcamentosFichasDetalhesSelect .= "SELECT ";
//$strSqlOrcamentosFichasDetalhesSelect .= "* ";
$strSqlOrcamentosFichasDetalhesSelect .= "id, ";
$strSqlOrcamentosFichasDetalhesSelect .= "id_ce_orcamentos, ";
$strSqlOrcamentosFichasDetalhesSelect .= "data_ficha, ";
$strSqlOrcamentosFichasDetalhesSelect .= "titulo, ";
$strSqlOrcamentosFichasDetalhesSelect .= "obs, ";
$strSqlOrcamentosFichasDetalhesSelect .= "ativacao, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar1, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar2, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar3, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar4, ";
$strSqlOrcamentosFichasDetalhesSelect .= "informacao_complementar5 ";
$strSqlOrcamentosFichasDetalhesSelect .= "FROM ce_orcamentos_fichas ";
$strSqlOrcamentosFichasDetalhesSelect .= "WHERE id <> 0 ";
$strSqlOrcamentosFichasDetalhesSelect .= "AND id = :id ";
//$strSqlOrcamentosFichasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosFichas'] . " ";


$statementOrcamentosFichasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosFichasDetalhesSelect);

if ($statementOrcamentosFichasDetalhesSelect !== false)
{
	
	$statementOrcamentosFichasDetalhesSelect->execute(array(
		"id" => $idCeOrcamentosFichas
	));
	
	/*
	if($idTbOrcamentosFichas <> "")
	{
		$statementOrcamentosFichasDetalhesSelect->bindParam(':id', $idTbOrcamentosFichas, PDO::PARAM_STR);
	}
	$statementOrcamentosFichasDetalhesSelect->execute();
	*/
}

//$resultadoOrcamentosFichasDetalhes = $dbSistemaConPDO->query($strSqlOrcamentosFichasDetalhesSelect);
$resultadoOrcamentosFichasDetalhes = $statementOrcamentosFichasDetalhesSelect->fetchAll();

if (empty($resultadoOrcamentosFichasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoOrcamentosFichasDetalhes as $linhaOrcamentosFichasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbOrcamentosFichasId = $linhaOrcamentosFichasDetalhes['id'];
		$tbOrcamentosFichasIdCeOrcamentos = $linhaOrcamentosFichasDetalhes['id_ce_orcamentos'];
		$tbOrcamentosFichasDataFicha = $linhaOrcamentosFichasDetalhes['data_ficha'];

		$tbOrcamentosFichasTitulo = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['titulo']);

		$tbOrcamentosFichasIdTbCadastro1 = $linhaOrcamentosFichasDetalhes['id_tb_cadastro1'];
		$tbOrcamentosFichasIdTbCadastro2 = $linhaOrcamentosFichasDetalhes['id_tb_cadastro2'];
		$tbOrcamentosFichasIdTbCadastro3 = $linhaOrcamentosFichasDetalhes['id_tb_cadastro3'];
		$tbOrcamentosFichasOBS = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['obs']);

		$tbOrcamentosFichasAtivacao = $linhaOrcamentosFichasDetalhes['ativacao'];
		
		$tbOrcamentosFichasIC1 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar1']);
		$tbOrcamentosFichasIC2 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar2']);
		$tbOrcamentosFichasIC3 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar3']);
		$tbOrcamentosFichasIC4 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar4']);
		$tbOrcamentosFichasIC5 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosFichasDetalhes['informacao_complementar5']);


		//Verificação de erro.
		//echo "tbOrcamentosFichasId=" . $tbOrcamentosFichasId . "<br>";
		//echo "tbOrcamentosFichasTitulo=" . $tbOrcamentosFichasTitulo . "<br>";
		//echo "tbOrcamentosFichasAtivacao=" . $tbOrcamentosFichasAtivacao . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTituloEditar"); ?>
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
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formOrcamentosFichasEditar').validate({ //Inicialização do plug-in.
			
			
				//Estilo da mensagem de erro.
				//----------------------
				errorClass: "TextoErro",
				//----------------------
				
				
				//Validação
				//----------------------
				//rules: {
					//n_classificacao: {
						//required: true,
						////regex: /-?\d+(\.\d{1,3})?/
						//number: true
					//}
					////,
					////field2: {
						////required: true,
						////minlength: 5
					////}
				//},
				
				
				//Mensagens.
				//----------------------
				//messages: {
					////n_classificacao: "Please specify your name"//,
					//n_classificacao: {
					  ////required: "Campo obrigatório.",
					  //required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  ////regex: "Campo numérico."
					  ////number: "Campo numérico."
					  //number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
					//}
				//},		
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
    <form name="formOrcamentosFichasEditar" id="formOrcamentosFichasEditar" action="SiteAdmOrcamentosFichasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasTbOrcamentosFichasEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarOrcamentosFichasTitulo'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichas"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                        <input type="text" name="titulo" id="titulo" class="AdmCampoAdmTexto01" maxlength="255" value="<?php echo $tbOrcamentosFichasTitulo; ?>" />
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosFichasOBS"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="obs" id="obs" class="AdmCampoTextoMultilinhaConteudo"><?php echo $tbOrcamentosFichasOBS; ?></textarea>
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
                            <option value="0"<?php if($tbOrcamentosFichasAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbOrcamentosFichasAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
        </table>

        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idCeOrcamentosFichas" type="hidden" id="idCeOrcamentosFichas" value="<?php echo $tbOrcamentosFichasId; ?>" />
                <input name="id_ce_orcamentos" type="hidden" id="id_ce_orcamentos" value="<?php echo $tbOrcamentosFichasIdCeOrcamentos; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idCeOrcamentos=<?php echo $idCeOrcamentos; ?><?php echo $queryPadrao;?>">
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
unset($strSqlOrcamentosFichasDetalhesSelect);
unset($statementOrcamentosFichasDetalhesSelect);
unset($resultadoOrcamentosFichasDetalhes);
unset($linhaOrcamentosFichasDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>