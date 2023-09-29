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
$idParent = $_GET["idParent"];
//if($idParent == "")
//{
	//$idParent = NULL;
//}
$idTbProcessos = $_GET["idTbProcessos"];

$idsTbTarefas = "";
if($idParent == "")
{
	if($idTbProcessos <> "")
	{
		$idsTbTarefas = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
																	"id_item", 
																	"id_registro", 
																	$idTbProcessos, 
																	"", 
																	"", 
																	1, 
																	"", 
																	"", 
																	"tipo_categoria", 
																	"29", 
																	"", 
																	"");
																	
																	
		//Verificação da retirada da última vírgula.
		$idsTbTarefas = Funcoes::IdsFormatar01($idsTbTarefas);
		
		//Proteção para não mostrar todos os registros.
		if($idsTbTarefas == "")
		{
			$idsTbTarefas = "0";
		}
																		
	}
}

$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

$idTbCadastro1 = $_GET["idTbCadastro1"];

$dataAtual = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataAtual_print = Funcoes::DataLeitura01($dataAtual, $GLOBALS['configSiteFormatoData'], "1");


$palavraChave = $_GET["palavraChave"];
$dataTarefaPesquisa = $_GET["data_tarefa_pesquisa"];
//if($dataTarefaPesquisa <> "")
//{
	//$dataTarefaPesquisa = Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSiteFormatoData']);
	//$dataTarefaPesquisaInicial = $dataTarefaPesquisa . " 00:00:00";
	//$dataTarefaPesquisaFinal = $dataTarefaPesquisa . " 23:59:59";
//}else{
	//$dataTarefaPesquisa = NULL;
//}

//$dataTarefaPesquisaInicial = date("Y") . "-" . date("m") . "-" . date("d");
//$dataTarefaPesquisaInicial_print = Funcoes::DataLeitura01($dataTarefaPesquisaInicial, $GLOBALS['configSiteFormatoData'], "1");

//$dataTarefaPesquisaFinal = Funcoes::DataAlterar01($dataTarefaPesquisaInicial, "1", "+", "d");
//$dataTarefaPesquisaFinal_print = Funcoes::DataLeitura01($dataTarefaPesquisaFinal, $GLOBALS['configSiteFormatoData'], "1");

//Calendário Data Select.
$calendarioDataSelect = $_GET["calendarioDataSelect"];
$calendarioDataHoraSelect = "";
$calendarioDataMinutoSelect = "";
if($calendarioDataSelect <> "")
{
	$calendarioDataSelectConvert = strtotime($calendarioDataSelect);
	//$calendarioDataSelectConvert = strtotime(str_replace("T", " ", $calendarioDataSelect));
	
    $calendarioDataDiaSelect = date('d', $calendarioDataSelectConvert);
    $calendarioDataMesSelect = date('m', $calendarioDataSelectConvert);
    $calendarioDataAnoSelect = date('Y', $calendarioDataSelectConvert);
	
	if($GLOBALS['habilitarTarefasDataHorario'] == 1)
	{
		$calendarioDataHoraSelect = date('H', $calendarioDataSelectConvert);
		$calendarioDataMinutoSelect = date('i', $calendarioDataSelectConvert);
	}
}

$calendarioDataFinalSelect = $_GET["calendarioDataFinalSelect"];
$calendarioDataFinalHoraSelect = "";
$calendarioDataFinalMinutoSelect = "";
if($calendarioDataFinalSelect <> "")
{
	$calendarioDataFinalSelectConvert = strtotime($calendarioDataFinalSelect);
	//$calendarioDataFinalSelectConvert = strtotime(str_replace("T", " ", $calendarioDataFinalSelect));
	
    $calendarioDataFinalDiaSelect = date('d', $calendarioDataFinalSelectConvert);
    $calendarioDataFinalMesSelect = date('m', $calendarioDataFinalSelectConvert);
    $calendarioDataFinalAnoSelect = date('Y', $calendarioDataFinalSelectConvert);
	if($GLOBALS['habilitarTarefasDataHorario'] == 1)
	{
		$calendarioDataFinalHoraSelect = date('H', $calendarioDataFinalSelectConvert);
		$calendarioDataFinalMinutoSelect = date('i', $calendarioDataFinalSelectConvert);
	}
}

//Data OnLoad.
$dataTarefaOnLoad_print = "";
$dataTarefaHoraOnLoad = "";
$dataTarefaMinutoOnLoad = "";
if($calendarioDataSelect <> "")
{
	$dataTarefaOnLoad_print = Funcoes::DataLeitura01($calendarioDataAnoSelect . "-" . $calendarioDataMesSelect . "-" . $calendarioDataDiaSelect, $GLOBALS['configSiteFormatoData'], "1");
	$dataTarefaHoraOnLoad = $calendarioDataHoraSelect;
	$dataTarefaMinutoOnLoad = $calendarioDataMinutoSelect;
}else{
	$dataTarefaOnLoad_print = $dataAtual_print;
}

//&habilitarListagem=1&habilitarInclusao=1&habilitarDetalhes=0&habilitarBusca=0
$habilitarListagem = $_GET["habilitarListagem"];
if($habilitarListagem == "")
{
	$habilitarListagem = 1; //padrão: 1 - habilitar
}
$habilitarInclusao = $_GET["habilitarInclusao"];
if($habilitarInclusao == "")
{
	$habilitarInclusao = 1; //padrão: 1 - habilitar
}
$habilitarDetalhes = $_GET["habilitarDetalhes"];
if($habilitarDetalhes == "")
{
	$habilitarDetalhes = 0; //padrão: 0 - desabilitar
}
$habilitarBusca = $_GET["habilitarBusca"];
if($habilitarBusca == "")
{
	$habilitarBusca = 0; //padrão: 0 - desabilitar
}

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteAdmTarefasIndice.php";
$paginaRetornoExclusao = "SiteAdmTarefasEditar.php";
$variavelRetorno = "idParent";
$variavelRetornoValor = $idParent;
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&idParent=" . $idParent . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno . 
"&variavelRetornoValor=" . $variavelRetornoValor . 
"&idTbCadastro1=" . $idTbCadastro1 . 
"&habilitarListagem=" . $habilitarListagem . 
"&habilitarInclusao=" . $habilitarInclusao . 
"&habilitarDetalhes=" . $habilitarDetalhes . 
"&habilitarBusca=" . $habilitarBusca . 
"&palavraChave=" . $palavraChave . 
"&dataTarefaPesquisa=" . $dataTarefaPesquisa;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlTarefasSelect = "";
$strSqlTarefasSelect .= "SELECT ";
//$strSqlTarefasSelect .= "* ";
$strSqlTarefasSelect .= "id, ";
$strSqlTarefasSelect .= "id_parent, ";
$strSqlTarefasSelect .= "data_registro_tarefa, ";
$strSqlTarefasSelect .= "data_tarefa, ";
$strSqlTarefasSelect .= "data_tarefa_final, ";
$strSqlTarefasSelect .= "id_tb_cadastro_usuario, ";
$strSqlTarefasSelect .= "tarefa, ";
$strSqlTarefasSelect .= "descricao, ";
$strSqlTarefasSelect .= "id_tb_cadastro1, ";
$strSqlTarefasSelect .= "id_tb_cadastro2, ";
$strSqlTarefasSelect .= "id_tb_cadastro3, ";
$strSqlTarefasSelect .= "informacao_complementar1, ";
$strSqlTarefasSelect .= "informacao_complementar2, ";
$strSqlTarefasSelect .= "informacao_complementar3, ";
$strSqlTarefasSelect .= "informacao_complementar4, ";
$strSqlTarefasSelect .= "informacao_complementar5, ";
$strSqlTarefasSelect .= "id_tb_tarefa_status, ";
$strSqlTarefasSelect .= "ativacao ";
$strSqlTarefasSelect .= "FROM tb_tarefas ";
$strSqlTarefasSelect .= "WHERE id <> 0 ";
if($idParent <> "")
{
	$strSqlTarefasSelect .= "AND id_parent = :id_parent ";
}
if($idsTbTarefas <> "")
{
	$strSqlTarefasSelect .= "AND id IN ( " . Funcoes::ConteudoMascaraGravacao01($idsTbTarefas) . ") ";
}
if($idTbCadastro1 <> "")
{
	$strSqlTarefasSelect .= "AND id_tb_cadastro1 = :id_tb_cadastro1 ";
}
if($palavraChave <> "")
{
	/*
	$strSqlTarefasSelect .= "AND (tarefa LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR descricao LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar1 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar2 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar3 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar4 LIKE '%' || :palavraChave || '%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar5 LIKE ''% :palavraChave '%' ";
	$strSqlTarefasSelect .= ") ";
	*/
	
	///*
	$strSqlTarefasSelect .= "AND (tarefa LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR descricao LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar1 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar2 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar3 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar4 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= "OR informacao_complementar5 LIKE '%" . Funcoes::ConteudoMascaraGravacao01($palavraChave) . "%' ";
	$strSqlTarefasSelect .= ") ";
	//*/
	
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%' || :palavraChave || '%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '% :palavraChave %' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE :palavraChave ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE CONCAT('%', :palavraChave, '%') ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%' || :palavraChave || '%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%teste%' ";
	
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%\' || :palavraChave || \'%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE '%\ || :palavraChave || \%' ";
	//$strSqlTarefasSelect .= "AND tarefa LIKE CONCAT('%\', :palavraChave, '\%') ";
	
	//$strSqlTarefasSelect .= "AND tarefa LIKE CONCAT('%',:palavraChave,'%') ";
}
if($dataTarefaPesquisa <> "")
{
	//$strSqlTarefasSelect .= "AND data_tarefa = :data_tarefa ";
	//$strSqlTarefasSelect .= "AND DATE(data_tarefa) = :data_tarefa ";
	//$strSqlTarefasSelect .= "AND data_tarefa LIKE :data_tarefa ";
	//$strSqlTarefasSelect .= "AND data_tarefa = '" . $dataTarefaPesquisa . "' ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN '" . $dataTarefaPesquisa . " 00:00:00' AND '" . $dataTarefaPesquisa . " 23:59:59' ";
	$strSqlTarefasSelect .= "AND data_tarefa BETWEEN '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSiteFormatoData'])) . " 00:00:00' AND '" . Funcoes::ConteudoMascaraGravacao01(Funcoes::DataGravacaoSql($dataTarefaPesquisa, $GLOBALS['configSiteFormatoData'])) . " 23:59:59' ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN ':data_tarefa 00:00:00' AND ':data_tarefa 23:59:59' ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN :data_tarefa 00:00:00 AND :data_tarefa 23:59:59 ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN :data_tarefa_pesquisa_inicial AND :data_tarefa_pesquisa_final ";
	//$strSqlTarefasSelect .= "AND data_tarefa BETWEEN ':data_tarefa_pesquisa_inicial' AND ':data_tarefa_pesquisa_final' ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%Y-%m-%d') = DATE_FORMAT(:data_tarefa, '%Y-%m-%d') ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%Y-%m-%d') = DATE_FORMAT(':data_tarefa', '%Y-%m-%d') ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%d') = DATE_FORMAT(:data_tarefa, '%d') ";
	//$strSqlTarefasSelect .= "AND DATE(data_tarefa) = DATE(:data_tarefa) ";
	//$strSqlTarefasSelect .= "AND DATE_FORMAT(data_tarefa, '%Y-%m-%d') = :data_tarefa ";
}
$strSqlTarefasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoTarefas'] . " ";
//echo "strSqlTarefasSelect=" . $strSqlTarefasSelect . "<br />";

//$dbSistemaConPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //teste para palavra-chave
$statementTarefasSelect = $dbSistemaConPDO->prepare($strSqlTarefasSelect);

//"data_tarefa" => $dataTarefaPesquisa
//"data_tarefa_pesquisa_inicial" => $dataTarefaPesquisaInicial,
//"data_tarefa_pesquisa_final" => $dataTarefaPesquisaFinal,
//"palavraChave" => '%'.$palavraChave.'%'
if ($statementTarefasSelect !== false)
{
	/*
	$statementTarefasSelect->bindParam(':id_parent', $idParent, PDO::PARAM_STR);
	$statementTarefasSelect->bindParam(':palavraChave', $palavraChave, PDO::PARAM_STR);
	//$statementTarefasSelect->bindParam(':palavraChave', "%".$palavraChave."%", PDO::PARAM_STR);
	$statementTarefasSelect->execute();
	*/
	/*
	$statementTarefasSelect->execute(array(
		"id_parent" => $idParent
	));
	*/
	
	if($idTbCadastro1 <> "")
	{
		$statementTarefasSelect->bindParam(':id_tb_cadastro1', $idTbCadastro1, PDO::PARAM_STR);
	}
	if($idParent <> "")
	{
		$statementTarefasSelect->bindParam(':id_parent', $idParent, PDO::PARAM_STR);
	}
	$statementTarefasSelect->execute();
}

//$resultadoTarefas = $dbSistemaConPDO->query($strSqlTarefasSelect);
$resultadoTarefas = $statementTarefasSelect->fetchAll();


//Definição de variáveis.
if($idParent <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelTarefasAdministrar");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Verificação de erro - debug.
//echo "dataTarefaPesquisa=" . $dataTarefaPesquisa . "<br />";
//echo "palavraChave=" . $palavraChave . "<br />";
//echo "idParent=" . $idParent . "<br />";
//echo "strSqlTarefasSelect=" . $strSqlTarefasSelect . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . $statementTarefasSelect->debugDumpParams() . "<br />";
//echo "statementTarefasSelect(debugDumpParams)=" . print_r($statementTarefasSelect->debugDumpParams()) . "<br />";
/*
echo "calendarioDataSelect=" . $calendarioDataSelect . "<br />";
echo "calendarioDataSelectConvert=" . $calendarioDataSelectConvert . "<br />";
echo "calendarioDataFinalSelect=" . $calendarioDataFinalSelect . "<br />";
echo "calendarioDataFinalSelectConvert=" . $calendarioDataFinalSelectConvert . "<br />";

echo "calendarioDataDiaSelect=" . $calendarioDataDiaSelect . "<br />";
echo "calendarioDataMesSelect=" . $calendarioDataMesSelect . "<br />";
echo "calendarioDataAnoSelect=" . $calendarioDataAnoSelect . "<br />";
echo "calendarioDataHoraSelect=" . $calendarioDataHoraSelect . "<br />";
echo "calendarioDataMinutoSelect=" . $calendarioDataMinutoSelect . "<br />";
echo "calendarioDataFinalDiaSelect=" . $calendarioDataFinalDiaSelect . "<br />";
echo "calendarioDataFinalMesSelect=" . $calendarioDataFinalMesSelect . "<br />";
echo "calendarioDataFinalAnoSelect=" . $calendarioDataFinalAnoSelect . "<br />";
echo "calendarioDataFinalHoraSelect=" . $calendarioDataFinalHoraSelect . "<br />";
echo "calendarioDataFinalMinutoSelect=" . $calendarioDataFinalMinutoSelect . "<br />";
*/
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
        //Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
    </script>
    
    
    <?php if($habilitarDetalhes == 1){ ?>
		<?php //Cadastro - Detalhes.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        //$includePaginas_idParentPaginas = $tbCadastroId;
        $includeCadastroDetalhes_idTbCadastro = $idParent;
        $includeCadastro_configTipoDiagramacao = "1";
        ?>
        
        <?php include "IncludeCadastroDetalhes.php";?>
        <?php //----------------------?>
    
    
        <?php //Vínculos - Detalhes.?>
        <?php //----------------------?>
        <?php if($idTbProcessos <> ""){?>
            <?php
            //Variáveis dos detalhes do processo.
            $tbPaginasId = DbFuncoes::GetCampoGenerico01($idTbProcessos, "tb_processos", "id_parent");
            $tbPaginasIdTbCadastro1 = DbFuncoes::GetCampoGenerico01($tbPaginasId, "tb_paginas", "id_tb_cadastro1");
            $tbPaginasIdTbCadastro2 = DbFuncoes::GetCampoGenerico01($tbPaginasId, "tb_paginas", "id_tb_cadastro2");
            $tbPaginasIdTbCadastro3 = DbFuncoes::GetCampoGenerico01($tbPaginasId, "tb_paginas", "id_tb_cadastro3");
            
            $tbProcessosIdTbCadastro1 = DbFuncoes::GetCampoGenerico01($idTbProcessos, "tb_processos", "id_tb_cadastro1"); 
            $tbProcessosIdTbCadastro2 = DbFuncoes::GetCampoGenerico01($idTbProcessos, "tb_processos", "id_tb_cadastro2"); 
            
            //echo "tbPaginasId=" .$tbPaginasId . "<br />";
            //echo "tbPaginasIdTbCadastro1=" .$tbPaginasIdTbCadastro1 . "<br />";
            //echo "tbProcessosIdTbCadastro1=" .$tbProcessosIdTbCadastro1 . "<br />";
            //echo "tbProcessosIdTbCadastro2=" .$tbProcessosIdTbCadastro2 . "<br />";
            ?>
            
            
            <?php //Páginas - Detalhes.?>
            <?php if($tbPaginasIdTbCadastro1 <> ""){ ?>
                <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
                <div align="left" class="AdmTexto01">
                    <strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPaginasVinculo1Nome'], "IncludeConfig"); ?>:
                    </strong>
                    <?php if(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "id") <> ""){ ?>
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbPaginasIdTbCadastro1;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                        </a>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php } ?>
            
            <?php if($tbPaginasIdTbCadastro2 <> ""){ ?>
                <?php if($GLOBALS['habilitarPaginasVinculo2'] == 1){ ?>
                <div align="left" class="AdmTexto01">
                    <strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configPaginasVinculo2Nome'], "IncludeConfig"); ?>:
                    </strong>
                    <?php if(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "id") <> ""){ ?>
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbPaginasIdTbCadastro2;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                        </a>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php } ?>
    
            
            <?php //Processos - Detalhes.?>
            <?php if($tbProcessosIdTbCadastro1 <> ""){ ?>
                <?php if($GLOBALS['habilitarProcessosVinculo1'] == 1){ ?>
                <div align="left" class="AdmTexto01">
                    <strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProcessosVinculo1Nome'], "IncludeConfig"); ?>:
                    </strong>
                    <?php if(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "id") <> ""){ ?>
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbProcessosIdTbCadastro1;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                        </a>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php } ?>
            
            <?php if($tbProcessosIdTbCadastro2 <> ""){ ?>
                <?php if($GLOBALS['habilitarProcessosVinculo2'] == 1){ ?>
                <div align="left" class="AdmTexto01">
                    <strong>
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configProcessosVinculo2Nome'], "IncludeConfig"); ?>:
                    </strong>
                    <?php if(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "id") <> ""){ ?>
                        <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbProcessosIdTbCadastro2;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                            <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbProcessosIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                        </a>
                    <?php } ?>
                </div>
                <?php } ?>
            <?php } ?>
            
        <?php }?>
        <?php //----------------------?>
	<?php } ?>
    
    
    <?php if($habilitarBusca == 1){ ?>
		<?php //Busca.?>
        <?php //----------------------?>
        <?php 
        //Definição de variáveis do include.
        $includeBusca_tipoBusca = "tarefas2"; //cadastro1 (busca por palavra-chave) | cadastroAdm1 (busca por palavra-chave) | imoveis1 (busca por palavra-chave) | imoveis2 (busca com dropdown) | categoriasDropdown1 (busca com dropdown) | produtos1 (busca por palavra-chave) | cadastro1 (busca por palavra-chave) | cadastro2 (busca detalhada | produtos1 (busca por palavra-chave) | publicacoes1 (busca por palavra-chave) | enquetes1 (busca por palavra-chave) | forum1 (busca por palavra-chave) | videos1 (busca por palavra-chave) | contatosAdm1 (busca por palavra-chave) | tarefas1 (busca por palavra-chave) | cadastroContasBancariasAdm1 (busca por palavra-chave) | paginas1 (busca por palavra-chave) |  paginasAdm1 (busca por palavra-chave)  |  processosAdm1 (busca por palavra-chave)
        $includeBusca_origemBusca = "";
        $includeBusca_idTbCategoriaEscolha = "";
        
        $includeBusca_paginaDestino = "SiteAdmTarefasIndice.php";
        $includeBusca_formTarget = "";
        $includeBusca_flagListagem = "1";
        ?>
        
        <?php include "IncludeBusca.php";?>
        <?php //----------------------?>
    
        
        <?php //Filtro/busca.?>
        <?php //**************************************************************************************?>
        <form name="formTarefasBusca" id="formTarefasBusca" action="SiteAdmTarefasIndice.php" method="get" class="FormularioTabela01">
            <div>
                <table class="AdmTabelaCampos01">
                    <tr>
                        <td class="AdmTbFundoEscuro" colspan="4">
                            <div align="center" class="AdmTexto02">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaTbPeriodo"); ?>
                                </strong>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="AdmTbFundoMedio TabelaColuna01">
                            <div align="left" class="AdmTexto01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaData"); ?>
                            </div>
                        </td>
                        <td class="AdmTbFundoClaro" colspan="3">
                            <div align="left">
                                <script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "";
                                    //var strDatapickerAgendaEnCampos = "";
                                </script>
                                <?php //JQuery DatePicker. ?>
                                <?php //---------------------- ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data_tarefa";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_tarefa_pesquisa;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data_tarefa";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_tarefa_pesquisa;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                    
                                    <input type="text" name="data_tarefa_pesquisa" id="data_tarefa_pesquisa" class="AdmCampoData01" maxlength="10" value="<?php echo $dataTarefaPesquisa; ?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                                <?php //---------------------- ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div align="center">
                <input type="image" name="submit" value="Submit" src="img/btoBuscar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoBusca"); ?>" />
                
                <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $idParent; ?>" />
                <input type="hidden" id="idTbCadastro1" name="idTbCadastro1" value="<?php echo $idTbCadastro1; ?>" />
    
                <input type="hidden" id="habilitarListagem" name="habilitarListagem" value="<?php echo $habilitarListagem; ?>" />
                <input type="hidden" id="habilitarInclusao" name="habilitarInclusao" value="<?php echo $habilitarInclusao; ?>" />
                <input type="hidden" id="habilitarDetalhes" name="habilitarDetalhes" value="<?php echo $habilitarDetalhes; ?>" />
                <input type="hidden" id="habilitarBusca" name="habilitarBusca" value="<?php echo $habilitarBusca; ?>" />

                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
        </form>
        <?php //**************************************************************************************?>
	<?php } ?>
	
    
    <?php
	if (empty($resultadoTarefas))
	{
        //echo "Nenhum registro encontrado";
    ?>
        <div align="center" class="AdmAlerta">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemTareafsVazio"); ?>
        </div>
    <?php
    }else{
    ?>
    <div style="display: block; position: relative; overflow: hidden;">
        <form name="formTarefasAcoes" id="formTarefasAcoes" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
            <input type="hidden" id="strTabela" name="strTabela" value="tb_tarefas" />
            <input type="hidden" id="idParent" name="idParent" value="<?php echo $idParent; ?>" />
            <input type="hidden" id="idTbCadastro1" name="idTbCadastro1" value="<?php echo $idTbCadastro1; ?>" />

            <input type="hidden" id="habilitarListagem" name="habilitarListagem" value="<?php echo $habilitarListagem; ?>" />
            <input type="hidden" id="habilitarInclusao" name="habilitarInclusao" value="<?php echo $habilitarInclusao; ?>" />
            <input type="hidden" id="habilitarDetalhes" name="habilitarDetalhes" value="<?php echo $habilitarDetalhes; ?>" />
            <input type="hidden" id="habilitarBusca" name="habilitarBusca" value="<?php echo $habilitarBusca; ?>" />

            <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            <input type="hidden" id="paginacaoNumero" name="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
            <input type="hidden" id="caracterAtual" name="caracterAtual" value="<?php echo $caracterAtual; ?>" />
            
            <input type="hidden" id="dataTarefaPesquisaInicial" name="dataTarefaPesquisaInicial" value="<?php echo $dataTarefaPesquisaInicial; ?>" />
            <input type="hidden" id="dataTarefaPesquisaFinal" name="dataTarefaPesquisaFinal" value="<?php echo $dataTarefaPesquisaFinal; ?>" />
            <div style="position:relative; display: block; clear: both;">
                <div align="right" style="float: right;">
                    <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                </div>
            </div>
            <table width="100%" class="TabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <td width="50">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasData"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarTarefasDataFinal'] == 1){ ?>
                <td width="50">
                    <div align="center" class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasDataFinal"); ?>
                    </div>
                </td>
                <?php } ?>
                
                
                <td>
                    <div class="AdmTexto02">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefas"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarTarefasIc1'] == 1){ ?>
                <td width="100">
                    <div align="center" class="AdmTexto02">
                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc1'], "IncludeConfig"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="150">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                    </div>
                </td>
                
                <td width="30">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                
                <td width="30">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                
                <td width="30" class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                    </div>
                </td>
              </tr>
              <?php
				$countTabelaFundo = 0;

                //Loop pelos resultados.
                foreach($resultadoTarefas as $linhaTarefas)
                {
              ?>
              <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                <td>
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTarefas['data_historico'];?>
                        <?php if($GLOBALS['habilitarTarefasDataHorario'] == 1){ ?>
							<?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                        <?php }else{ ?>
							<?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                        <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarTarefasDataFinal'] == 1){ ?>
                <td>
                    <div align="center" class="AdmTexto01">
                        <?php //echo $linhaTarefas['data_historico'];?>
                        <?php if($GLOBALS['habilitarTarefasDataHorario'] == 1){ ?>
							<?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa_final'], $GLOBALS['configSiteFormatoData'], "2"); ?>
                        <?php }else{ ?>
							<?php echo Funcoes::DataLeitura01($linhaTarefas['data_tarefa_final'], $GLOBALS['configSiteFormatoData'], "1"); ?>
                        <?php } ?>
                    </div>
                </td>
                <?php } ?>
                
                <td>
                    <div class="AdmTexto01">
                    	<strong>
							<?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['tarefa']);?>
                        </strong>
                    </div>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['descricao']);?>
                    </div>
                    
                    <?php if($GLOBALS['habilitarTarefasVinculoProcessos'] == 1){ ?>
						<?php
						$idTbTarefasProcessos = DbFuncoes::GetCampoGenerico04("tb_itens_relacao_registros", "id_registro", "id_item", $linhaTarefas['id'], "", "", 1);
						?>
						<?php if(!empty($idTbTarefasProcessos)){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProcesso"); ?>: 
                            </strong>
                            <a href="SiteAdmProcessosEditar.php?idTbProcessos=<?php echo DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "id"); ?>" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(DbFuncoes::GetCampoGenerico01($idTbTarefasProcessos, "tb_processos", "processo")); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if(empty($idParent)){ ?>
                    <?php //if($idParent == ""){ ?>
						<?php //if(!empty(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id"))){ ?>
						<?php if(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "id") <> ""){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasCadastroVinculado"); ?>: 
                                </strong>
                                <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_parent'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                    <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                    <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"), 
									DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "razao_social"), 
									DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome_fantasia"), 
									1)); ?>
                                </a>
                            </div>
						<?php } ?>
                     <?php } ?>
                     
					<?php if($GLOBALS['habilitarTarefasUsuario'] == 1){ ?>
                        <?php if($idTbCadastroUsuario == ""){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasCadastroUsuario"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro_usuario'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro_usuario'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro_usuario'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                     
					<?php if($GLOBALS['habilitarTarefasVinculo1'] == 1){ ?>
                        <?php if($idTbCadastro1 == ""){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo1Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro1'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro1'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTarefasVinculo2'] == 1){ ?>
                        <?php //if($linhaTarefas['id_tb_cadastro2'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo2Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro2'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro2'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro2'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro2'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarTarefasVinculo3'] == 1){ ?>
                        <?php //if($linhaTarefas['id_tb_cadastro3'] <> 0){ ?>
                        <div class="AdmTexto01">
                            <strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTarefasVinculo3Nome'], "IncludeConfig"); ?>: 
                            </strong>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaTarefas['id_tb_cadastro3'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "nome"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "razao_social"), 
                                DbFuncoes::GetCampoGenerico01($linhaTarefas['id_tb_cadastro3'], "tb_cadastro", "nome_fantasia"), 
                                1)); ?>
                            </a>
                        </div>
                        <?php //} ?>
                    <?php } ?>  
                </td>
                
                <?php if($GLOBALS['habilitarTarefasIc1'] == 1){ ?>
                <td>
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaTarefas['informacao_complementar1']);?>
                    </div>
                </td>
                <?php } ?>
                
                <td>
                	<div align="center" class="AdmTexto01">
                        <a href="../<?php echo $GLOBALS['visualizacaoAtivaSistema'];?>/SiteTarefasDetalhes.php?idTbTarefas=<?php echo $linhaTarefas['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVisualizacao"); ?>
                        </a>
                    </div>
                    <div align="center" class="AdmTexto01">
                    	<?php if($GLOBALS['habilitarTarefasLembreteEnvio'] == 1){ ?>
                            <a href="SiteAdmRegistrosEnvioExe.php?idRegistro=<?php echo $linhaTarefas['id'];?>&strTabela=tb_tarefas&tipoCategoria=71&idTbCadastroDestinatario=<?php echo $linhaTarefas['id_parent'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasLembreteEnvio"); ?>
                            </a>
                            <div>
                                (<?php 
                                echo DbFuncoes::CountRegistrosGenericos("tb_itens_enviados", 
                                "id_item", 
                                $linhaTarefas['id'], 
                                "tipo_interatividade", 
                                1, 
                                "id_tb_cadastro_remetente", 
                                0, 
                                "id_tb_cadastro_destinatario", 
                                $linhaTarefas['id_parent']);
                                ?>)
                            </div>
                        <?php } ?>
                    </div>
                    
                </td>
                
                <td>
                    <div align="center" class="AdmTexto01">
                        <a href="SiteAdmTarefasEditar.php?idTbTarefas=<?php echo $linhaTarefas['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <td>
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaTarefas['id'];?>" class="AdmCampoCheckBox01" />
                    </div>
                </td>
                <td class="TabelaDados01Celula" style="display: none;">
                    <div align="center" class="AdmTexto01">
                        <!--input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaTarefas['id'];?>" class="AdmCampoCheckBox01" /-->
                        <input name="idsRegistrosSelecionar" type="radio" value="<?php echo $linhaTarefas['id'];?>" class="AdmCampoRadioButton01" />
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
        </form>
    </div>
	<?php } ?>
    
    
    <?php //if(!empty($idParent)){ ?>
    <?php if(!empty($idParent) || !empty($idTbProcessos)){ ?>
    <div align="center" class="AdmTexto01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasInstrucoes01"); ?>
    </div>
    <form name="formTarefas" id="formTarefas" action="SiteAdmTarefasIndiceExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <div style="display: block; position: relative; overflow: hidden;">
            <table class="AdmTabelaCampos01">
                <tr>
                    <td class="AdmTbFundoEscuro" colspan="4">
                        <div align="center" class="AdmTexto02">
                            <strong>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTbTarefas"); ?>
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
							<script type="text/javascript">
                                //Variável para conter todos os campos que funcionam com o DatePicker.
                                //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                //var strDatapickerAgendaPtCampos = "";
                                //var strDatapickerAgendaEnCampos = "";
								//Obs: modifiquei o posicionamento da definição de variávei para fora da condição de exibição do formulário.
                            </script>
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
                            
                                <input type="text" name="data_tarefa" id="data_tarefa" class="AdmCampoData01" maxlength="10" value="<?php echo $dataTarefaOnLoad_print; ?>" />
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
                                        <?php if($dataTarefaHoraOnLoad == $arrHoraFill[$countArray]){?> selected="selected"<?php } ?>
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
                                        <?php if($dataTarefaMinutoOnLoad == $arrMinutoFill[$countArray]){?> selected="selected"<?php } ?>
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
                            
                                <input type="text" name="data_tarefa_final" id="data_tarefa_final" class="AdmCampoData01" maxlength="10" value="<?php echo $dataAtual_print; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
				<?php if($idParent == ""){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasCadastroVinculado"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div class="AdmTexto01">
                            <?php 
                                $arrTarefasParent = DbFuncoes::VinculoGenericoSelect02("0", "", "tb_cadastro", "id_tb_categorias", "", "nome", 1);
                            ?>
                            <select name="id_parent" id="id_parent" class="AdmCampoDropDownMenu01">
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasParent); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasParent[$countArray][0];?>"><?php echo $arrTarefasParent[$countArray][1];?></option>
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
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefas"); ?>
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro" colspan="3">
                        <div align="left">
                            <input type="text" name="tarefa" id="tarefa" class="AdmCampoTexto02" />
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
                                <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"></textarea>
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
                                <textarea name="descricao" id="descricao"></textarea>
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
                                <textarea name="descricao" id="descricao"></textarea>
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
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrTarefasVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrTarefasVinculo1[$countArray][0];?>"><?php echo $arrTarefasVinculo1[$countArray][1];?></option>
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
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo2); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo2[$countArray][0];?>"><?php echo $arrTarefasVinculo2[$countArray][1];?></option>
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
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasVinculo3); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasVinculo3[$countArray][0];?>"><?php echo $arrTarefasVinculo3[$countArray][1];?></option>
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
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc1'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 1){ ?>
                                <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc1'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
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
                                    <textarea name="informacao_complementar1" id="informacao_complementar1"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarTarefasIc2'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc2'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 1){ ?>
                                <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc2'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
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
                                    <textarea name="informacao_complementar2" id="informacao_complementar2"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc3'] == 1){ ?>

                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc3'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 1){ ?>
                                <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc3'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
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
                                    <textarea name="informacao_complementar3" id="informacao_complementar3"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc4'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc4'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 1){ ?>
                                <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc4'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
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
                                    <textarea name="informacao_complementar4" id="informacao_complementar4"></textarea>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            
                <?php if($GLOBALS['habilitarTarefasIc5'] == 1){ ?>
                <tr>
                    <td class="AdmTbFundoMedio TabelaColuna01">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloTarefasIc5'], "IncludeConfig"); ?>:
                        </div>
                    </td>
                    <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                        <div>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 1){ ?>
                                <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" />
                            <?php } ?>
                            <?php if($GLOBALS['configTarefasBoxIc5'] == 2){ ?>
                                <?php //Sem formatação.?>
                                <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                    <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
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
                                    <textarea name="informacao_complementar5" id="informacao_complementar5"></textarea>
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
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasCadastroUsuario); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasCadastroUsuario[$countArray][0];?>"><?php echo $arrTarefasCadastroUsuario[$countArray][1];?></option>
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
                                <option value="0" selected="selected"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrTarefasStatus); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrTarefasStatus[$countArray][0];?>"><?php echo $arrTarefasStatus[$countArray][1];?></option>
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
                                    <option value="<?php echo $arrTarefasProcessos[$countArray][0];?>"><?php echo $arrTarefasProcessos[$countArray][1];?></option>
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
        <div style="display: block; position: relative; overflow: hidden;">
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoIncluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoIncluir"); ?>" />
                
                <?php if($idParent <> ""){ ?>
                <input type="hidden" id="id_parent" name="id_parent" value="<?php echo $idParent; ?>" />
                <?php } ?>
                <input type="hidden" id="ativacao" name="ativacao" value="1" />
                
                <input type="hidden" id="habilitarListagem" name="habilitarListagem" value="<?php echo $habilitarListagem; ?>" />
                <input type="hidden" id="habilitarInclusao" name="habilitarInclusao" value="<?php echo $habilitarInclusao; ?>" />
                <input type="hidden" id="habilitarDetalhes" name="habilitarDetalhes" value="<?php echo $habilitarDetalhes; ?>" />
                <input type="hidden" id="habilitarBusca" name="habilitarBusca" value="<?php echo $habilitarBusca; ?>" />
                
                <input type="hidden" id="idTbCadastro1" name="idTbCadastro1" value="<?php echo $idTbCadastro1; ?>" />
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                
                <input type="hidden" id="dataTarefaPesquisaInicial" name="dataTarefaPesquisaInicial" value="<?php echo $dataTarefaPesquisaInicial; ?>" />
                <input type="hidden" id="dataTarefaPesquisaFinal" name="dataTarefaPesquisaFinal" value="<?php echo $dataTarefaPesquisaFinal; ?>" />
            </div>
            <div style="float:right;">
            	<?php if($masterPageSiteSelect <> "LayoutSiteIFrame.php"){ ?>
					<?php if($idParent <> ""){ ?>
                        <?php if(DbFuncoes::GetCampoGenerico01($idParent, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $idParent; ?>" class="AdmLinks01">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteContatosLinkVoltarCadastro"); ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                &nbsp;
            </div>
        </div>
    </form>
    <br />
    <?php } ?>
    	
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlTarefasSelect);
unset($statementTarefasSelect);
unset($resultadoTarefas);
unset($linhaTarefas);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>