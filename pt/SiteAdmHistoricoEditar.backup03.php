<?php
$_GET["masterPageSiteSelect"] = "LayoutSiteHistorico.php";


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$idTbHistorico = $_GET["idTbHistorico"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbHistorico, "tb_historico", "id_parent");
$idTbHistoricoStatusSelect = $_GET["idTbHistoricoStatusSelect"];

//Manutenção - acesso.
$configManutencaoLink = 3;//0 - não exibir | 1 - página com todos as opções | 2 - página com opções específicas | 3 - ajax
$configManutencaoLinkFlag = true;

//$paginaRetorno = "SiteAdmHistoricoIndice.php";
$paginaRetorno = "SiteAdmHistoricoEditar.php";
$paginaRetornoExclusao = "SiteAdmHistoricoEditar.php";
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


$statementHistoricoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlHistoricoDetalhesSelect);

if ($statementHistoricoDetalhesSelect !== false)
{
	$statementHistoricoDetalhesSelect->execute(array(
		"id" => $idTbHistorico
	));
}

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
		$tbHistoricoDataHistorico = Funcoes::DataLeitura01($linhaHistoricoDetalhes['data_historico'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbHistoricoAssunto = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['assunto']);
		$tbHistoricoHistorico = Funcoes::ConteudoMascaraLeitura($linhaHistoricoDetalhes['historico']);
		$tbHistoricoIdTbCadastro1 = $linhaHistoricoDetalhes['id_tb_cadastro1'];
		$tbHistoricoIdTbCadastro2 = $linhaHistoricoDetalhes['id_tb_cadastro2'];
		$tbHistoricoIdTbCadastro3 = $linhaHistoricoDetalhes['id_tb_cadastro3'];

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
		
		//Verificação de erro.
		//echo "tbHistoricoId=" . $tbHistoricoId . "<br>";
		//echo "tbHistoricoAssunto=" . $tbHistoricoAssunto . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}


//Definição de variáveis.
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteHistoricoEditarTitulo");
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");


//Detalhes do produto.
/*
$tbProdutosId = $idParent;
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");

$tbProdutosCodProduto = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "cod_produto");
$tbProdutosProduto = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "produto");
$tbProdutosIC1 = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "informacao_complementar1");
*/

$tbProdutosId = $idParent;
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");

$tbProdutosCodProduto = "";
$tbProdutosProduto = "";
$tbProdutosIC1 = "";

//Objeto - Produtos.
//----------
//Detalhes do produto vinculado.
/*
$opdProdutoVinculado = new ObjetoProdutosDetalhes(); //Criação de objeto com os detalhes do cadastro.
if(DbFuncoes::GetCampoGenerico01($idParent, "tb_produtos", "id") <> "")
{
	//$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", array("id;" . $idTbCadastroLogado . ";i"));	
	
	//Definição dos valores do cadastro logado.
	$opdProdutoVinculado->ProdutosDetalhesResultado($idParent, 1);
	
	//Definição de valores.
	//$tbProdutosId = $opdProdutoVinculado->tbProdutosId;
	$tbProdutosCodProduto = $opdProdutoVinculado->tbProdutosCodProduto;
	$tbProdutosProduto = $opdProdutoVinculado->tbProdutosProduto;
	$tbProdutosIC1 = $opdProdutoVinculado->tbProdutosIC1;
	
	
	//Verificação de erro - debug.
	//echo "tbProdutosId=" . $opdProdutoVinculado->tbProdutosId . "<br />";
	//echo "tbProdutosProduto=" . $opdProdutoVinculado->tbProdutosProduto . "<br />";
}
*/
//----------


//Verificação de erro - debug.
/*
echo "tbProdutosId=" . $tbProdutosId . "<br>";
echo "tbProdutosCodProduto=" . $tbProdutosCodProduto . "<br>";
echo "tbProdutosProduto=" . $tbProdutosProduto . "<br>";
echo "tbProdutosIC1=" . $tbProdutosIC1 . "<br>";
*/
//echo "idTipoProduto=" . $idTipoProduto . "<br>";

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
	<script type="text/javascript">
			//Remover todas opções não selecionadas de listbox ao carregar.
			$(function() {
			  $('.AdmCampoFiltroGenericoListBox01').load('change', function() {
				$(this).find('option').not(':selected').remove();
			  });
			});			
	
		/*
		$(document).ready(function () {
			//Remover todas opções não selecionadas de listbox ao carregar.
			$(function() {
			  $('.AdmCampoFiltroGenericoListBox01').load('change', function() {
				$(this).find('option').not(':selected').remove();
			  });
			});			
		});	
		*/
			
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
		
		//Abas.
		$(document).ready(function () {

			
			parent.divHide('imgUpdtProgress');
			
			
		});	
    </script>
    <form name="formHistoricoEditar" id="formHistoricoEditar" action="SiteAdmHistoricoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">

        <div style="position: absolute; display: block; top: 0px; right: 0px; z-index: 1;">
        	<div style="position: relative; display: inline-block; height: 20px; width: 100px; /*background-color: #ccc;*/">
                <img id="imgUpdtProgress" src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" style="display: none;" />
            
                <iframe id="iframeHistoricoEditarAbas" name="iframeHistoricoEditarAbas" src="" class="AdmTabelaIFrame01" scrolling="no" frameborder="0" width="100%" height="100%" style="display: none;">
                </iframe>
            </div>
            
            
            <a href="SiteAdmProdutosEditar.php?idTbProdutos=<?php echo $idParent; ?>" style="display: inline; text-decoration: none;">
                <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
            </a>
            
            <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
            
            <input name="idTbHistorico" type="hidden" id="idTbHistorico" value="<?php echo $idTbHistorico; ?>" />
            <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbHistoricoIdParent; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            
            <input name="idTbHistoricoStatusSelect" type="hidden" id="idTbHistoricoStatusSelect" value="<?php echo $idTbHistoricoStatusSelect; ?>" />
            <input type="hidden" id="abaSelect" name="abaSelect" />
        </div>

                <!--Informações - Controles.-->
                <div style="position: relative; display: table-cell; width: 1%; height: 20px; overflow: hidden; vertical-align: bottom;">
					<?php 
                    $divAbaInfo1Diplay = "none";
                    if($idTipoProduto == "3486"){
						$divAbaInfo1Diplay = "inline-block";
                    } 
                    ?>
                    <div style="display: <?php echo $divAbaInfo1Diplay?>;">
                        <div id="divAbaInfo1" class="DivAbaInfo01" >
                            <a class="SiteLinks01" onClick="divShow('divInfo1');
                                                            divHide('divAbaInfo1');
                                                            HTMLEstiloGenerico01('divAbaInfo1a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaInfo2', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaInfo3', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaInfo4', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaInfo5', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaInfo6', 'display', 'inline-block');
                                                            divHide('divInfo2');
                                                            divHide('divInfo3');
                                                            divHide('divInfo4');
                                                            divHide('divInfo5');
                                                            divHide('divInfo6');
                                                            divHide('divAbaInfo2a');
                                                            divHide('divAbaInfo3a');
                                                            divHide('divAbaInfo4a');
                                                            divHide('divAbaInfo5a');
                                                            divHide('divAbaInfo6a');
                                                            divShow('imgUpdtProgress');
                                                            formularioSubmit('formHistoricoEditar', 'iframeHistoricoEditarAbas', '', '');
                                                            " style="cursor: pointer;">
                                Descri&ccedil;&atilde;o
                            </a>
                        </div>
                        <div id="divAbaInfo1a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                            Descri&ccedil;&atilde;o
                        </div>
                    </div>
                    
                    <div id="divAbaInfo2" class="DivAbaInfo01">
                        <a class="SiteLinks01" onClick="divShow('divInfo2');
                        								divHide('divAbaInfo2');
                        								HTMLEstiloGenerico01('divAbaInfo2a', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo1', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo3', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo4', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo5', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo6', 'display', 'inline-block');
                                                        divHide('divInfo1');
                                                        divHide('divInfo3');
                                                        divHide('divInfo4');
                                                        divHide('divInfo5');
                                                        divHide('divInfo6');
                                                        divHide('divAbaInfo1a');
                                                        divHide('divAbaInfo3a');
                                                        divHide('divAbaInfo4a');
                                                        divHide('divAbaInfo5a');
                                                        divHide('divAbaInfo6a');
                                                        divShow('imgUpdtProgress');
                                                        formularioSubmit('formHistoricoEditar', 'iframeHistoricoEditarAbas', '', '');
                                                        " style="cursor: pointer;">
                            Estado de Conserva&ccedil;&atilde;o
                        </a>
                    </div>
                    <div id="divAbaInfo2a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                        Estado de Conserva&ccedil;&atilde;o
                    </div>
            
                    <div id="divAbaInfo3" class="DivAbaInfo01">
                        <a class="SiteLinks01" onClick="divShow('divInfo3');
                        								divHide('divAbaInfo3');
                        								HTMLEstiloGenerico01('divAbaInfo3a', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo1', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo2', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo4', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo5', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo6', 'display', 'inline-block');
                                                        divHide('divInfo1');
                                                        divHide('divInfo2');
                                                        divHide('divInfo4');
                                                        divHide('divInfo5');
                                                        divHide('divInfo6');
                                                        divHide('divAbaInfo1a');
                                                        divHide('divAbaInfo2a');
                                                        divHide('divAbaInfo4a');
                                                        divHide('divAbaInfo5a');
                                                        divHide('divAbaInfo6a');
                                                        divShow('imgUpdtProgress');
                                                        formularioSubmit('formHistoricoEditar', 'iframeHistoricoEditarAbas', '', '');
                                                        " style="cursor: pointer;">
                            Tratamento
                        </a>
                    </div>
                    <div id="divAbaInfo3a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                        Tratamento
                    </div>
                    
                    <div id="divAbaInfo4" class="DivAbaInfo01">
                        <a class="SiteLinks01" onClick="divShow('divInfo4');
                                                        divHide('divAbaInfo4');
                        								HTMLEstiloGenerico01('divAbaInfo4a', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo1', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo2', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo3', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo5', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo6', 'display', 'inline-block');
                                                        divHide('divInfo1');
                                                        divHide('divInfo2');
                                                        divHide('divInfo3');
                                                        divHide('divInfo5');
                                                        divHide('divInfo6');
                                                        divHide('divAbaInfo1a');
                                                        divHide('divAbaInfo2a');
                                                        divHide('divAbaInfo3a');
                                                        divHide('divAbaInfo5a');
                                                        divHide('divAbaInfo6a');
                                                        divShow('imgUpdtProgress');
                                                        formularioSubmit('formHistoricoEditar', 'iframeHistoricoEditarAbas', '', '');
                                                        " style="cursor: pointer;">
                            Acondicionamento
                        </a>
                    </div>
                    <div id="divAbaInfo4a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                        Acondicionamento
                    </div>
                    
                    <div id="divAbaInfo5" class="DivAbaInfo01">
                        <a class="SiteLinks01" onClick="divShow('divInfo5');
                        								divHide('divAbaInfo5');
                        								HTMLEstiloGenerico01('divAbaInfo5a', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo1', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo2', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo3', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo4', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo6', 'display', 'inline-block');
                                                        divHide('divInfo1');
                                                        divHide('divInfo2');
                                                        divHide('divInfo3');
                                                        divHide('divInfo4');
                                                        divHide('divInfo6');
                                                        divHide('divAbaInfo1a');
                                                        divHide('divAbaInfo2a');
                                                        divHide('divAbaInfo3a');
                                                        divHide('divAbaInfo4a');
                                                        divHide('divAbaInfo6a');
                                                        divShow('imgUpdtProgress');
                                                        formularioSubmit('formHistoricoEditar', 'iframeHistoricoEditarAbas', '', '');
                                                        " style="cursor: pointer;">
                            Informa&ccedil;&otilde;es Complementares
                        </a>
                    </div>
                    <div id="divAbaInfo5a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                        Informa&ccedil;&otilde;es Complementares
                    </div>
                    
                    <div id="divAbaInfo6" class="DivAbaInfo01">
                        <a class="SiteLinks01" onClick="divShow('divInfo6');
                        								divHide('divAbaInfo6');
                        								HTMLEstiloGenerico01('divAbaInfo6a', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo1', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo2', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo3', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo4', 'display', 'inline-block');
                        								HTMLEstiloGenerico01('divAbaInfo5', 'display', 'inline-block');
                                                        divHide('divInfo1');
                                                        divHide('divInfo2');
                                                        divHide('divInfo3');
                                                        divHide('divInfo4');
                                                        divHide('divInfo5');
                                                        divHide('divAbaInfo1a');
                                                        divHide('divAbaInfo2a');
                                                        divHide('divAbaInfo3a');
                                                        divHide('divAbaInfo4a');
                                                        divHide('divAbaInfo5a');
                                                        divShow('imgUpdtProgress');
                                                        formularioSubmit('formHistoricoEditar', 'iframeHistoricoEditarAbas', '', '');
                                                        " style="cursor: pointer;">
                            Fotos
                        </a>
                    </div>
                    <div id="divAbaInfo6a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                        Fotos
                    </div>
                </div>
                <!--Informações - Controles.-->
                
                <!--Informações.-->
				<?php 
                $divInfo1Diplay = "block";
                if($idTipoProduto == "3483" || $idTipoProduto == "3484" || $idTipoProduto == "3485" || $idTipoProduto == "3487" || $idTipoProduto == "3488")
				{
                    $divInfo1Diplay = "none";
                } 
                ?>
                <!--Descrição.-->
                <div id="divInfo1" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: <?php echo $divInfo1Diplay;?>; height: 535px; border: 1px solid #000000;">
                    <!--Livro.-->
                    <?php if($idTipoProduto == "3486"){ ?>
						<?php include "SiteAdmHistoricoEditarIncludeDescricao3486.php"; ?>
                    <?php } ?>
                    <!--Livro.-->
                </div>
                <!--Descrição.-->
                
                <!--Estado de conservação.-->
				<?php 
                $divInfo2Diplay = "none";
                if($idTipoProduto == "3483" || $idTipoProduto == "3484" || $idTipoProduto == "3485" || $idTipoProduto == "3487" || $idTipoProduto == "3488")
				{
                    $divInfo2Diplay = "block";
                } 
                ?>
                <div id="divInfo2" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: <?php echo $divInfo2Diplay;?>; height: 535px; border: 1px solid #000000;">
                    <!--Livro.-->
                    <?php if($idTipoProduto == "3486"){ ?>
						<?php include "SiteAdmHistoricoEditarIncludeEstadoConservacao3486.php"; ?>
                    <?php } ?>
                    <!--Livro.-->
                    
                    
                    <!--Diplomas.-->
                    <?php if($idTipoProduto == "3483"){ ?>
                    <div style="position: relative; display: block;">
						<?php include "SiteAdmHistoricoEditarIncludeEstadoConservacao3483.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Diplomas.-->
                    
                    
                    <!--Documentos.-->
                    <?php if($idTipoProduto == "3484"){ ?>
                    <div style="position: relative; display: block;">
						<?php include "SiteAdmHistoricoEditarIncludeEstadoConservacao3484.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Documentos.-->
                    
                    
                    <!--Fotografia.-->
                    <?php if($idTipoProduto == "3485"){ ?>
                    <div style="position: relative; display: block;">
						<?php include "SiteAdmHistoricoEditarIncludeEstadoConservacao3485.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Fotografia.-->
                    
                    
                    <!--Mapa.-->
                    <?php if($idTipoProduto == "3487"){ ?>
                    <div style="position: relative; display: block;">
						<?php include "SiteAdmHistoricoEditarIncludeEstadoConservacao3487.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Mapa.-->
                    
                    
                    <!--Obras de Arte.-->
                    <?php if($idTipoProduto == "3488"){ ?>
                    <div style="position: relative; display: block;">
						<?php include "SiteAdmHistoricoEditarIncludeEstadoConservacao3488.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Obras de Arte.-->
                </div>
                <!--Estado de conservação.-->

                <!--Tratamento.-->
                <div id="divInfo3" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <!--Livro.-->
                    <?php if($idTipoProduto == "3486"){ ?>
                    <!--Botões.-->
                    <div style="position: absolute; display: table-cell; left: 5px; top: 2px; width: 200px; height: 18px; overflow: hidden; vertical-align: bottom;">
                        <div id="divAbaTratamentoParte1" class="DivAbaInfo01" style="height: 18px; line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2', 'display', 'inline-block');
                                                            divHide('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2a');
                                                            " style="cursor: pointer;">
                                Parte 1
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte1a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 1
                        </div>
                        
                        <div id="divAbaTratamentoParte2" class="DivAbaInfo01"  style="height: 18px;  line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1', 'display', 'inline-block');
                                                            divHide('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1a');
                                                            " style="cursor: pointer;">
                                Parte 2
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte2a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 2
                        </div>
                    </div>
                    
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento01_3486.php"; ?>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento02_3486.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Livro.-->
                    
                    
                    <!--Diplomas.-->
                    <?php if($idTipoProduto == "3483"){ ?>
                    <!--Botões.-->
                    <div style="position: absolute; display: table-cell; left: 5px; top: 2px; width: 200px; height: 18px; overflow: hidden; vertical-align: bottom;">
                        <div id="divAbaTratamentoParte1" class="DivAbaInfo01" style="height: 18px; line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2', 'display', 'inline-block');
                                                            divHide('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2a');
                                                            " style="cursor: pointer;">
                                Parte 1
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte1a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 1
                        </div>
                        
                        <div id="divAbaTratamentoParte2" class="DivAbaInfo01"  style="height: 18px;  line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1', 'display', 'inline-block');
                                                            divHide('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1a');
                                                            " style="cursor: pointer;">
                                Parte 2
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte2a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 2
                        </div>
                    </div>
                    
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento01_3483.php"; ?>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento02_3483.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Diplomas.-->
                    
                    
                    <!--Documentos.-->
                    <?php if($idTipoProduto == "3484"){ ?>
                    <!--Botões.-->
                    <div style="position: absolute; display: table-cell; left: 5px; top: 2px; width: 200px; height: 18px; overflow: hidden; vertical-align: bottom;">
                        <div id="divAbaTratamentoParte1" class="DivAbaInfo01" style="height: 18px; line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2', 'display', 'inline-block');
                                                            divHide('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2a');
                                                            " style="cursor: pointer;">
                                Parte 1
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte1a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 1
                        </div>
                        
                        <div id="divAbaTratamentoParte2" class="DivAbaInfo01"  style="height: 18px;  line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1', 'display', 'inline-block');
                                                            divHide('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1a');
                                                            " style="cursor: pointer;">
                                Parte 2
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte2a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 2
                        </div>
                    </div>
                    
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento01_3484.php"; ?>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento02_3484.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Documentos.-->
                    
                    
                    <!--Fotografia.-->
                    <?php if($idTipoProduto == "3485"){ ?>
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento_3485.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Fotografia.-->
                    
                    
                    <!--Mapas.-->
                    <?php if($idTipoProduto == "3487"){ ?>
                    <!--Botões.-->
                    <div style="position: absolute; display: table-cell; left: 5px; top: 2px; width: 200px; height: 18px; overflow: hidden; vertical-align: bottom;">
                        <div id="divAbaTratamentoParte1" class="DivAbaInfo01" style="height: 18px; line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2', 'display', 'inline-block');
                                                            divHide('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2a');
                                                            " style="cursor: pointer;">
                                Parte 1
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte1a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 1
                        </div>
                        
                        <div id="divAbaTratamentoParte2" class="DivAbaInfo01"  style="height: 18px;  line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1', 'display', 'inline-block');
                                                            divHide('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1a');
                                                            " style="cursor: pointer;">
                                Parte 2
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte2a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 2
                        </div>
                    </div>
                    
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento01_3487.php"; ?>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento02_3487.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Mapas.-->
                    
                    
                    <!--Obras de Arte.-->
                    <?php if($idTipoProduto == "3488"){ ?>
                    <!--Botões.-->
                    <div style="position: absolute; display: table-cell; left: 5px; top: 2px; width: 200px; height: 18px; overflow: hidden; vertical-align: bottom;">
                        <div id="divAbaTratamentoParte1" class="DivAbaInfo01" style="height: 18px; line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2', 'display', 'inline-block');
                                                            divHide('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2a');
                                                            " style="cursor: pointer;">
                                Parte 1
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte1a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 1
                        </div>
                        
                        <div id="divAbaTratamentoParte2" class="DivAbaInfo01"  style="height: 18px;  line-height: 18px;">
                            <a class="SiteLinks01" onClick="divShow('divTratamentoParte2');
                                                            divHide('divAbaTratamentoParte2');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte2a', 'display', 'inline-block');
                                                            HTMLEstiloGenerico01('divAbaTratamentoParte1', 'display', 'inline-block');
                                                            divHide('divTratamentoParte1');
                                                            divHide('divAbaTratamentoParte1a');
                                                            " style="cursor: pointer;">
                                Parte 2
                            </a>
                        </div>
                        <div id="divAbaTratamentoParte2a" class="DivAbaInfo01" style="display: none; height: 18px;  line-height: 18px; background-color: #00a2e8;">
                            Parte 2
                        </div>
                    </div>
                    
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento01_3488.php"; ?>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
						<?php include "SiteAdmHistoricoEditarIncludeTratamento02_3488.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Obras de Arte.-->
                    
                </div>
                <!--Tratamento.-->
                
                
                <!--Acondicionamento.-->
                <div id="divInfo4" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <!--Livro.-->
                    <?php if($idTipoProduto == "3486"){ ?>
                    <div style="position: relative; display: block;">
                    	<?php include "SiteAdmHistoricoEditarIncludeAcondicionamento3486.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Livro.-->
                    
                    
                    <!--Diplomas.-->
                    <?php if($idTipoProduto == "3483"){ ?>
                    <div style="position: relative; display: block;">
                    	<?php include "SiteAdmHistoricoEditarIncludeAcondicionamento3483.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Diplomas.-->
                    
                    
                    <!--Documentos.-->
                    <?php if($idTipoProduto == "3484"){ ?>
                    <div style="position: relative; display: block;">
                    	<?php include "SiteAdmHistoricoEditarIncludeAcondicionamento3484.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Documentos.-->
                    
                    
                    <!--Fotografia.-->
                    <?php if($idTipoProduto == "3485"){ ?>
                    <div style="position: relative; display: block;">
                    	<?php include "SiteAdmHistoricoEditarIncludeAcondicionamento3485.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Fotografia.-->
                    
                    
                    <!--Mapas.-->
                    <?php if($idTipoProduto == "3487"){ ?>
                    <div style="position: relative; display: block;">
                    	<?php include "SiteAdmHistoricoEditarIncludeAcondicionamento3487.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Mapas.-->
                    
                    
                    <!--Obras de Arte.-->
                    <?php if($idTipoProduto == "3488"){ ?>
                    <div style="position: relative; display: block;">
                    	<?php include "SiteAdmHistoricoEditarIncludeAcondicionamento3488.php"; ?>
                    </div>
                    <?php } ?>
                    <!--Obras de Arte.-->
                </div>
                <!--Acondicionamento.-->

                <!--Informações Complementares.-->
                <div id="divInfo5" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <div style="position: absolute; display: block; top: 430px; left: 30px;">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico72Nome'], "IncludeConfig"); ?>: 
                        </div>
                        <div class="AdmTexto01">
                            <?php
                            //Seleção de ids selecionados para o registro.
                            $arrHistoricoFiltroGenerico72Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "83", "", ",", "", "1"));
                            ?>
                        
                            <?php 
                            $arrHistoricoFiltroGenerico72 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 83);
                            //echo "arrHistoricoFiltroGenerico72Selecao=" . $arrHistoricoFiltroGenerico72Selecao . "<br />";
                            //echo "arrHistoricoFiltroGenerico72Selecao[0]=" . $arrHistoricoFiltroGenerico72Selecao[0] . "<br />";
                            //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                            ?>
                            
                            <?php if($GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'] == 1){ ?>
                                <?php 
                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++)
                                {
                                ?>
                                    <div>
                                        <input name="idsHistoricoFiltroGenerico72[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico72[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico72[$countArray][0], $arrHistoricoFiltroGenerico72Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico72[$countArray][1];?>
                                    </div>
                                <?php 
                                }
                                ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'] == 2){ ?>
                                <select id="idsHistoricoFiltroGenerico72" name="idsHistoricoFiltroGenerico72[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01" style="height: 80px;">
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico72[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico72[$countArray][0], $arrHistoricoFiltroGenerico72Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico72[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select> 
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                            <?php } ?>
                            <?php if($GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'] == 3){ ?>
                                <select id="idsHistoricoFiltroGenerico72" name="idsHistoricoFiltroGenerico72[]" class="AdmCampoDropDownMenu01">
                                    <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico72); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoFiltroGenerico72[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico72[$countArray][0], $arrHistoricoFiltroGenerico72Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico72[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            <?php } ?>
                            
                            <?php 
							$flagManutencaoLink = $configManutencaoLinkFlag;
							if($configManutencaoLinkFlag != true)
							{
								if(empty($arrHistoricoFiltroGenerico72))
								{ 
									$flagManutencaoLink = true;
								}else{
									$flagManutencaoLink = false;
								}
							}
							?>
							<?php if($flagManutencaoLink == true){ ?>
								<?php if($configManutencaoLink == 1){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 2){ ?>
                                    <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=83&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                    </a>
                                <?php } ?>
                                <?php if($configManutencaoLink == 3){ ?>
                                    <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=83&masterPageSiteSelect=LayoutSiteIFrame.php&idItem=<?php echo $idTbHistorico;?>', '', '', '');
                                    			divShow('divManutencaoAjax');
                                    			HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=83&tipoRetorno=3&idItem=<?php echo $idTbHistorico;?>\', \'idsHistoricoFiltroGenerico72\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico72CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        <img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                    </a>
                                <?php } ?>                                
                            <?php } ?>                                
                        </div>
                    </div>
                    <div style="position: absolute; display: block; top: 430px; left: 165px;">
                        <div align="left" class="AdmTexto01">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoData1'], "IncludeConfig"); ?>: 
                        </div>
                        <div align="left">
                            <?php //JQuery DatePicker. ?>
                            <?php //---------------------- ?>
                            <?php if($GLOBALS['configTipoCampoHistoricoData1'] == 1){ ?>
                                <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaPtCampos = "#data1";
                                            strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                        </script>
                                    <?php } ?>
                                    <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                        <script type="text/javascript">
                                            //Variável para conter todos os campos que funcionam com o DatePicker.
                                            //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                            //var strDatapickerAgendaEnCampos = "#data1";
                                            strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                        </script>
                                    <?php } ?>
                                    <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                                
                                    <input type="text" name="data1" id="data1" class="AdmCampoData01" maxlength="10" value="<?php echo $tbHistoricoData1; ?>" />
                                    <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                                <?php } ?>
                            <?php } ?>
                            <?php //---------------------- ?>
                        </div>
                    </div>
                    
                    <iframe class="AdmTabelaIFrame01" src="SiteAdmArquivosIndice.php?idParent=<?php echo $idTbHistorico; ?>&tipoArquivo=3&masterPageSiteSelect=LayoutSiteIFrame.php" scrolling="auto" name="arquivos3" frameborder="0" align="left" width="100%" height="100%">
                    </iframe>
                </div>
                
                
                <!--Informações Complementares.-->

                <!--Fotos.-->
                <div id="divInfo6" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <iframe class="AdmTabelaIFrame01" src="SiteAdmArquivosIndice.php?idParent=<?php echo $idTbHistorico; ?>&tipoArquivo=1&masterPageSiteSelect=LayoutSiteIFrame.php" scrolling="auto" name="arquivos1" frameborder="0" align="left" width="100%" height="100%">
                    </iframe>
                </div>
                <!--Fotos.-->
                <!--Informações.-->


        
    </form>
    <?php //Manutenção - Ajax.?>
    <div id="divManutencaoAjax" class="AdmDivPopupAjaxContainer" style="">
        <div class="AdmDivPopupAjax" style="">
        	<div style="position: absolute; display: block; height: 25px; top: -25px; right: 0px;">
            	<a id="linkManutencaoAjaxFechar" onclick="" class="AdmLinksFechar01" style="cursor: pointer;">
                    <img src="img/btoFecharJanela.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoFechar"); ?>" />
                </a>
            </div>
            <iframe id="iframeManutencaoAjax" name="iframeManutencaoAjax" src="" class="AdmTabelaIFrame01" scrolling="auto" frameborder="0" width="100%" height="100%">
            </iframe>
        </div>
    </div>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressManutencao" class="ProgressBarGenerico01Container" style="display: none;">
        <div class="ProgressBarGenerico01">
            <img src="img/ProgressBar01.gif" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteImagemProgressBarra"); ?>" />
        </div>
    </div>
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