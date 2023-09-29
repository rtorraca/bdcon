<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbHistorico = $_GET["idTbHistorico"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbHistorico, "tb_historico", "id_parent");
$idTbHistoricoStatusSelect = $_GET["idTbHistoricoStatusSelect"];

$resultadoHistoricoComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_historico_complemento", 
								NULL, 
								"complemento", 
								"");
$resultadoHistoricoComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_historico_relacao_complemento", 
																					$idTbHistorico, 
																					"id_tb_historico");

$paginaRetorno = "SiteAdmHistoricoDetalhes.php";
//$paginaRetornoExclusao = "SiteAdmHistoricoEditar.php";
$variavelRetorno = "idTbHistorico";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&idTbHistoricoStatusSelect=" . $idTbHistoricoStatusSelect . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlHistoricoDetalhesSelect = "";
$strSqlHistoricoDetalhesSelect .= "SELECT ";
//$strSqlHistoricoDetalhesSelect .= "* ";
$strSqlHistoricoDetalhesSelect .= "id, ";
$strSqlHistoricoDetalhesSelect .= "id_parent, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlHistoricoDetalhesSelect .= "data_historico, ";
$strSqlHistoricoDetalhesSelect .= "data1, ";
$strSqlHistoricoDetalhesSelect .= "data2, ";
$strSqlHistoricoDetalhesSelect .= "data3, ";
$strSqlHistoricoDetalhesSelect .= "data4, ";
$strSqlHistoricoDetalhesSelect .= "data5, ";
$strSqlHistoricoDetalhesSelect .= "assunto, ";
$strSqlHistoricoDetalhesSelect .= "historico, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar1, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar2, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar3, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar4, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar5, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar6, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar7, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar8, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar9, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar10, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar11, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar12, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar13, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar14, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar15, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar16, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar17, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar18, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar19, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar20, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar21, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar22, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar23, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar24, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar25, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar26, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar27, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar28, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar29, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar30, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar31, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar32, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar33, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar34, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar35, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar36, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar37, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar38, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar39, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar40, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar41, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar42, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar43, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar44, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar45, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar46, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar47, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar48, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar49, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar50, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar51, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar52, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar53, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar54, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar55, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar56, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar57, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar58, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar59, ";
$strSqlHistoricoDetalhesSelect .= "informacao_complementar60, ";
$strSqlHistoricoDetalhesSelect .= "id_tb_historico_status ";
$strSqlHistoricoDetalhesSelect .= "FROM tb_historico ";
$strSqlHistoricoDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlHistoricoDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlHistoricoDetalhesSelect .= "AND id = :id ";
//$strSqlHistoricoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementHistoricoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlHistoricoDetalhesSelect);

if ($statementHistoricoDetalhesSelect !== false)
{
	$statementHistoricoDetalhesSelect->execute(array(
		"id" => $idTbHistorico
	));
}
//----------


//$resultadoHistoricoDetalhes = $dbSistemaConPDO->query($strSqlHistoricoDetalhesSelect);
$resultadoHistoricoDetalhes = $statementHistoricoDetalhesSelect->fetchAll();

if (empty($resultadoHistoricoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoHistoricoDetalhes as $linhaHistoricoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbHistoricoId = $linhaHistoricoDetalhes['id'];
		$tbHistoricoIdParent = $linhaHistoricoDetalhes['id_parent'];
		
		$tbHistoricoIdTbCadastroUsuario = $linhaHistoricoDetalhes['id_tb_cadastro_usuario'];
		$tbHistoricoIdTbCadastroUsuario_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "nome"), 
																			DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastroUsuario, "tb_cadastro", "razao_social"), 
																			DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 
																			1);
		$tbHistoricoDataHistorico = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data_historico'], $GLOBALS['configSiteFormatoData'], "1");
		$tbHistoricoAssunto = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['assunto']);
		$tbHistoricoHistorico = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['historico']);

		$tbHistoricoIdTbCadastro1 = $linhaHistoricoDetalhes['id_tb_cadastro1'];
		$tbHistoricoIdTbCadastro1_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro1, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro1, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
																	1);

		$tbHistoricoIdTbCadastro2 = $linhaHistoricoDetalhes['id_tb_cadastro2'];
		$tbHistoricoIdTbCadastro2_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro2, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro2, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 
																	1);
		$tbHistoricoIdTbCadastro3 = $linhaHistoricoDetalhes['id_tb_cadastro3'];
		$tbHistoricoIdTbCadastro3_print = Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "nome"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "razao_social"), 
																	DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 
																	1);

		$tbHistoricoIC1 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar1']);
		$tbHistoricoIC2 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar2']);
		$tbHistoricoIC3 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar3']);
		$tbHistoricoIC4 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar4']);
		$tbHistoricoIC5 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar5']);
		$tbHistoricoIC6 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar6']);
		$tbHistoricoIC7 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar7']);
		$tbHistoricoIC8 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar8']);
		$tbHistoricoIC9 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar9']);
		$tbHistoricoIC10 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar10']);
		$tbHistoricoIC10 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar10']);
		$tbHistoricoIC11 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar11']);
		$tbHistoricoIC12 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar12']);
		$tbHistoricoIC13 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar13']);
		$tbHistoricoIC14 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar14']);
		$tbHistoricoIC15 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar15']);
		$tbHistoricoIC16 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar16']);
		$tbHistoricoIC17 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar17']);
		$tbHistoricoIC18 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar18']);
		$tbHistoricoIC19 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar19']);
		$tbHistoricoIC20 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar20']);
		$tbHistoricoIC21 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar21']);
		$tbHistoricoIC22 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar22']);
		$tbHistoricoIC23 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar23']);
		$tbHistoricoIC24 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar24']);
		$tbHistoricoIC25 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar25']);
		$tbHistoricoIC26 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar26']);
		$tbHistoricoIC27 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar27']);
		$tbHistoricoIC28 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar28']);
		$tbHistoricoIC29 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar29']);
		$tbHistoricoIC30 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar30']);
		$tbHistoricoIC31 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar31']);
		$tbHistoricoIC32 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar32']);
		$tbHistoricoIC33 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar33']);
		$tbHistoricoIC34 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar34']);
		$tbHistoricoIC35 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar35']);
		$tbHistoricoIC36 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar36']);
		$tbHistoricoIC37 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar37']);
		$tbHistoricoIC38 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar38']);
		$tbHistoricoIC39 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar39']);
		$tbHistoricoIC40 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar40']);
		$tbHistoricoIC41 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar41']);
		$tbHistoricoIC42 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar42']);
		$tbHistoricoIC43 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar43']);
		$tbHistoricoIC44 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar44']);
		$tbHistoricoIC45 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar45']);
		$tbHistoricoIC46 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar46']);
		$tbHistoricoIC47 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar47']);
		$tbHistoricoIC48 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar48']);
		$tbHistoricoIC49 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar49']);
		$tbHistoricoIC50 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar50']);
		$tbHistoricoIC51 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar51']);
		$tbHistoricoIC52 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar52']);
		$tbHistoricoIC53 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar53']);
		$tbHistoricoIC54 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar54']);
		$tbHistoricoIC55 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar55']);
		$tbHistoricoIC56 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar56']);
		$tbHistoricoIC57 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar57']);
		$tbHistoricoIC58 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar58']);
		$tbHistoricoIC59 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar59']);
		$tbHistoricoIC60 = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['informacao_complementar60']);

		$tbHistoricoIdTbHistoricoStatus = $linhaHistoricoDetalhes['id_tb_historico_status'];
		$tbHistoricoIdTbHistoricoStatus_print = Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($tbHistoricoIdTbHistoricoStatus, "tb_cadastro_complemento", "complemento"));

		
		//Verificação de erro.
		//echo "tbHistoricoId=" . $tbHistoricoId . "<br>";
		//echo "tbHistoricoAssunto=" . $tbHistoricoAssunto . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoEditarTitulo");
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


$tbProdutosId = $idParent;
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");


//Verificação de erro - debug.
/*
echo "tbProdutosId=" . $tbProdutosId . "<br>";
echo "tbProdutosCodProduto=" . $tbProdutosCodProduto . "<br>";
echo "tbProdutosProduto=" . $tbProdutosProduto . "<br>";
echo "tbProdutosIC1=" . $tbProdutosIC1 . "<br>";
*/
echo "idTipoProduto=" . $idTipoProduto . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo $tbTarefasTarefa; ?>
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
    <meta name="title" content="<?php echo $metaTitulo;?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php echo $tbTarefasTarefa; ?>
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
    
    <div class="AdmTexto01" style="position: relative; display: block;">
    
        <!--Livro.-->
        <?php if($idTipoProduto == "3486"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3486.php"; ?>
        <?php } ?>
        <!--Livro.-->
        
        
        <!--Diplomas.-->
        <?php if($idTipoProduto == "3483"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3483.php"; ?>
        <?php } ?>
        <!--Diplomas.-->
        
        
        <!--Documentos.-->
        <?php if($idTipoProduto == "3484"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3484.php"; ?>
        <?php } ?>
        <!--Documentos.-->
        
        
        <!--Fotografia.-->
        <?php if($idTipoProduto == "3485"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3485.php"; ?>
        <?php } ?>
        <!--Fotografia.-->
        
        
        <!--Mapa.-->
        <?php if($idTipoProduto == "3487"){ ?>
            <?php include "SiteHistoricoDetalhesInclude3487.php"; ?>
        <?php } ?>
        <!--Mapa.-->
        
        
        <!--Obras de Arte.-->
        <?php if($idTipoProduto == "3488"){ ?>
            <?php include "SiteSiteHistoricoDetalhesInclude3488.php"; ?>
        <?php } ?>
        <!--Obras de Arte.-->
    
    
        <!--Informações Principais-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoInformacoesPrincipais"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoData"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoDataHistorico; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData1; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData2; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData3; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData4; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoData5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoData5; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro1_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro2_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro3_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico72'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "83"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>
        
        
        <!--Descrição-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTratamentoDescicao"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "41"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "42"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "43"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc31'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC31;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc32'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC32;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc33'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC33;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "44"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc34'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC34;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "45"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "46"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "48"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "48"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "49"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "50"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "51"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC35;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc36'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC36;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc37'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC37;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc38'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC38;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc39'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC39;?>
                    </div>
                </td>
            </tr>
            <?php } ?>


            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico41Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "52"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc40'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC40;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc41'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC41;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc42'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC42;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "53"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "54"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>
        
        
        <!--Estado de Conservação-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoEstadoConservacao"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro1_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "55"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "56"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "57"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "58"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "59"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "60"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc44'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC44;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "61"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "62"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc45'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC45;?>
                    </div>
                </td>
            </tr>
            <?php } ?>


            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "63"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "64"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc46'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC46;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "65"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "66"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc47'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC47;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc48'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC48;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>
        
        
        <!--Tratamento-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTratamento"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarHistoricoVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro2_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "14"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC3;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "16"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC4;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC5;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <!--Teste de solubilidade-->
            <tr>
                <td class="AdmTbFundoMedio" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoTratamentoTeste"); ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="AdmTbFundoClaro" colspan="4">
                    <div class="AdmTexto02">
                    <?php
					//Query de pesquisa.
					//----------
					$strSqlForumPostagensSelect = "";
					$strSqlForumPostagensSelect .= "SELECT ";
					//$strSqlForumPostagensSelect .= "* ";
					$strSqlForumPostagensSelect .= "id, ";
					$strSqlForumPostagensSelect .= "id_parent, ";
					$strSqlForumPostagensSelect .= "id_tb_cadastro_usuario, ";
					$strSqlForumPostagensSelect .= "nome, ";
					$strSqlForumPostagensSelect .= "email, ";
					$strSqlForumPostagensSelect .= "n_classificacao, ";
					$strSqlForumPostagensSelect .= "data_postagem, ";
					$strSqlForumPostagensSelect .= "postagem, ";
					$strSqlForumPostagensSelect .= "nota_avaliacao, ";
					$strSqlForumPostagensSelect .= "informacao_complementar1, ";
					$strSqlForumPostagensSelect .= "informacao_complementar2, ";
					$strSqlForumPostagensSelect .= "informacao_complementar3, ";
					$strSqlForumPostagensSelect .= "informacao_complementar4, ";
					$strSqlForumPostagensSelect .= "informacao_complementar5, ";
					$strSqlForumPostagensSelect .= "informacao_complementar6, ";
					$strSqlForumPostagensSelect .= "informacao_complementar7, ";
					$strSqlForumPostagensSelect .= "informacao_complementar8, ";
					$strSqlForumPostagensSelect .= "informacao_complementar9, ";
					$strSqlForumPostagensSelect .= "informacao_complementar10, ";
					$strSqlForumPostagensSelect .= "ativacao ";
					
					//Paginação (subquery).
					if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){
						$strSqlForumPostagensSelect .= ", (SELECT COUNT(id) ";
						$strSqlForumPostagensSelect .= "FROM tb_forum_postagens ";
						$strSqlForumPostagensSelect .= "WHERE id <> 0 ";
						if($idTbForumTopicos <> "")
						{
							$strSqlForumPostagensSelect .= "AND id_parent = :id_parent ";
						}
						if($palavraChave <> "")
						{
						$strSqlForumPostagensSelect .= "AND (postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
						/*
						*/
						$strSqlForumPostagensSelect .= "OR postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
						$strSqlForumPostagensSelect .= ") ";
						}
						$strSqlForumPostagensSelect .= ") totalRegistros ";
					}
					
					$strSqlForumPostagensSelect .= "FROM tb_forum_postagens ";
					$strSqlForumPostagensSelect .= "WHERE id <> 0 ";
					if($idTbForumTopicos <> "")
					{
						$strSqlForumPostagensSelect .= "AND id_parent = :id_parent ";
					}
					if($palavraChave <> "")
					{
						$strSqlForumPostagensSelect .= "AND (postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
						/*
						*/
						$strSqlForumPostagensSelect .= "OR postagem LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
						$strSqlForumPostagensSelect .= ") ";
					}
					
					$strSqlForumPostagensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoForumPostagens'] . " ";
					
					//Paginação.
					if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){ 
						if($configTipoDB == 2)
						{
							$strSqlForumPostagensSelect .= "LIMIT " . $paginacaoInicio . ", " . $paginacaoNRegistros . "";
						}
					}
					//----------
					
					
					//Parâmetros.
					//----------
					$statementForumPostagensSelect = $dbSistemaConPDO->prepare($strSqlForumPostagensSelect);
					
					if ($statementForumPostagensSelect !== false)
					{
						if($idTbHistorico <> "")
						{
							$statementForumPostagensSelect->bindParam(':id_parent', $idTbHistorico, PDO::PARAM_STR);
						}
						$statementForumPostagensSelect->execute();
						/*
						$statementForumPostagensSelect->execute(array(
							"id_tb_categorias" => $idParentForumPostagens
						));
						*/
					}
					//----------
					
					//$resultadoForumPostagens = $dbSistemaConPDO->query($strSqlForumPostagensSelect);
					$resultadoForumPostagens = $statementForumPostagensSelect->fetchAll();
					
					//Paginação.
					if($GLOBALS['habilitarForumPostagensSitePaginacao'] == "1"){
						//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro); //Quantidade de registros.
						//$paginacaoTotalRegistros = DbFuncoes::CountRegistrosGenericos("tb_cadastro", "id_tb_categorias", $idParentCadastro, "", "", "", "", "", ""); //Quantidade de registros.
						$paginacaoTotalRegistros = $resultadoForumPostagens[0]['totalRegistros'];
						$paginacaoTotal = ceil($paginacaoTotalRegistros / $paginacaoNRegistros);
					}
					?>
                    
            <div style="position: relative; display: block; width: 99%; /*height: 300px;border: 1px solid #000000;  */background-color: #ffffff; /*overflow: auto;*/">
            <table width="100%" class="AdmTabelaDados01">
              <tr class="">
              	<?php if($habilitarBusca == 1){ ?>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmErro">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <td width="20" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
              	<?php } ?>
                
              	<?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
						<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=n_classificacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemData"); ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02" style="font-size: 9px !important;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc1'], "IncludeConfig");; ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02" style="font-size: 9px !important;">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloForumPostagensIc2'], "IncludeConfig");; ?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02" style="font-size: 9px !important;">
						<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=processo<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteForumPostagem"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <td width="100" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30" class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
						<?php if($GLOBALS['habilitarForumPostagensClassificacaoPersonalizada'] == 1){ ?>
                            <a href="SiteAdmClassificacaoPersonalizadaExe.php?idRegistro=<?php echo $idParentForumPostagens; ?>&strTabela=tb_forum_postagens&criterioClassificacao=ativacao<?php echo $queryPadrao; ?><?php echo $queryPadraoRetornoPaginacao; ?>" class="AdmLinks02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                            <a>
                         <?php }else{ ?>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                        <?php } ?>
                    </div>
                </td>
                
              </tr>
              <?php
				$countTabelaFundo = 0;
				
				
				//Loop pelos resultados.
				foreach($resultadoForumPostagens as $linhaForumPostagens)
				{
              ?>
              <tr>
              	<?php if($habilitarBusca == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                    	<?php //if($idTbCadastroLogado == $linhaForumPostagens['id_tb_cadastro_usuario']){ ?>
                            <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaForumPostagens['id'];?>" class="CampoCheckBox01" />
                        <?php //} ?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a onclick="" style="cursor: pointer;">
                        	<img onclick="parent.iframeLoad('iframeManutencaoAjax', 'SiteAdmForumPostagensEditar.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?>&masterPageSiteSelect=LayoutSiteIFrame.php&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0', '', '', '');
                                          parent.divShow('divManutencaoAjax');
                                          parent.HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');iframeRecarregar(\'iframeAdmForumPostagens\', \'\');');" src="img/btoEditar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>" />
                        </a>
                        
                    	<?php //if($idTbCadastroLogado == $linhaForumPostagens['id_tb_cadastro_usuario']){ ?>
                            <a href="SiteAdmForumPostagensEditar.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01" style="display: none;">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                            </a>
                        <?php //} ?>
                    </div>
                </td>
				<?php } ?>
                
              	<?php if($GLOBALS['habilitarForumPostagensNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaForumPostagens['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaForumPostagens['data_produto'];?>
                        <?php echo Funcoes::DataLeitura01($linhaForumPostagens['data_postagem'], $GLOBALS['configSiteFormatoData'], "2");?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['informacao_complementar1']);?>
                    </div>
                </td>
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['informacao_complementar2']);?>
                    </div>
                </td>

                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
						<?php echo Funcoes::ConteudoMascaraLeitura($linhaForumPostagens['postagem']);?>
                    </div>
                </td>
                
                <td class="AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteForumPostagensDetalhes.php?idTbForumPostagens=<?php echo $linhaForumPostagens['id'];?>" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                </td>
                
                <td class="<?php if($linhaForumPostagens['ativacao'] == 1){/*echo "AdmTbFundoClaro";*/}else{echo "AdmTbFundoDesativado";}?> AdmTabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                    	<a href="SiteAdmRegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaForumPostagens['id'];?>&statusAtivacao=<?php echo $linhaForumPostagens['ativacao'];?>&strTabela=tb_forum_postagens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                        	<?php if($linhaForumPostagens['ativacao'] == 0){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                        	<?php if($linhaForumPostagens['ativacao'] == 1){?>
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
						<?php //echo $linhaForumPostagens['ativacao'];?>
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
            </div>
                    
                    
					<?php
                    //Limpeza de objetos.
                    //----------
                    unset($strSqlForumPostagensSelect);
                    unset($statementForumPostagensSelect);
                    unset($resultadoForumPostagens);
                    unset($linhaForumPostagens);
                    //----------
					?>
                    </div>
                </td>
            </tr>


            <?php if($GLOBALS['habilitarHistoricoIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC6;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC7;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc8'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC8;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "15"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc9'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC9;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc10'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC10;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc11'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC11;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc12'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC12;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarHistoricoIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc13'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC13;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "17"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "18"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc23'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC23;?>
                    </div>
                </td>
            </tr>
            <?php } ?>


            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "19"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "20"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc14'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC14;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "21"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "22"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "23"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "24"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "25"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "26"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc15'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC15;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc16'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC16;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "27"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "28"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc17'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC17;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "29"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "30"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc18'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC18;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "31"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc19'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC19;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico21Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "32"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc20'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC20;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico22Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "33"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc22'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC22;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico23Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "34"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc24'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC24;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico24Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "35"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc25'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC25;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico25Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "36"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc26'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC26;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico26Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "37"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc27'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC27;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico27Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "38"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc28'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC28;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "39"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc29'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC29;?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico29Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "40"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc30'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC30;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
		</table>


        <!--Acondicionamento-->
        <table class="AdmTabelaCampos02">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoAcondicionamento"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo3Nome'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastro3_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico60Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "71"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico64'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico64Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "75"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc55'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC55;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc54'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC54;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
		</table>


        <table class="AdmTabelaCampos02" style="display: none;">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemDetalhes"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoAssunto"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoAssunto; ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistorico"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoHistorico; ?>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "12"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "13"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            

            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico56Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "67"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico57Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "68"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico58Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "69"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico59Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "70"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico61'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico61Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "72"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico62'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico62Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "73"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico63'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico63Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "74"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico65'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico65Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "76"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico66'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico66Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "77"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico67'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico67Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "78"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico68'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico68Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "79"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico69'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico69Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "80"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico70'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico70Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "81"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico71'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico71Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "82"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico73'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico73Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "84"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico74'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico74Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "85"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico75'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico75Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "86"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico76'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico76Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "87"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico77'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico77Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "88"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico78'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico78Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "89"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico79'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico79Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "90"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoFiltroGenerico80'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico80Nome'], "IncludeConfig"); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php
                        //Loop pelos resultados.
                        foreach($resultadoHistoricoComplemento as $linhaHistoricoComplemento)
                        {
                        ?>
                            <div align="left" class="AdmTexto01">
                                <?php if($linhaHistoricoComplemento["tipo_complemento"] == "91"){ ?> 
                                    <?php if(in_array($linhaHistoricoComplemento["id"], array_column($resultadoHistoricoComplementoRelacao, 'id_tb_historico_complemento'))){ ?> 
                                        - <?php echo Funcoes::ConteudoMascaraLeitura($linhaHistoricoComplemento["complemento"]);?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            
            <?php if($GLOBALS['habilitarHistoricoIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc1'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                       <?php echo $tbHistoricoIC1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc2'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
        
        
            
            
        
        
        
        
        
            
            
        
        
        
            
            <?php if($GLOBALS['habilitarHistoricoIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc21'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC21;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
        
        
        
            
            
        
        
        
            
            
        
        
        
            
            
        
        
        
            
            
        
            <?php if($GLOBALS['habilitarHistoricoIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC43;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
        
            
            
        
        
            <?php if($GLOBALS['habilitarHistoricoIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc49'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC49;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarHistoricoIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc50'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC50;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc51'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC51;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc52'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC52;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarHistoricoIc53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc53'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC53;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
        
            
            <?php if($GLOBALS['habilitarHistoricoIc56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc56'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC56;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc57'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC57;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarHistoricoIc58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc58'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC58;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarHistoricoIc59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc59'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC59;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarHistoricoIc60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc60'], "IncludeConfig"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <?php echo $tbHistoricoIC60;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroHistoricoUsuario'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoCadastroUsuario"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbCadastroUsuario_print;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarCadastroHistoricoStatus'] == 1){ ?>
            <tr<?php if(idTbHistoricoStatusSelect <> ""){ ?> style="display: none;"<?php } ?>>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php echo $tbHistoricoIdTbHistoricoStatus_print; ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php //**************************************************************************************?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlHistoricoDetalhesSelect);
unset($statementHistoricoDetalhesSelect);
unset($resultadoHistoricoDetalhes);
unset($linhaHistoricoDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>