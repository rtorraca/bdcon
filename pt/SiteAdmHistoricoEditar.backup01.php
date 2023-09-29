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

$paginaRetorno = "SiteAdmHistoricoIndice.php";
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
$tbProdutosId = $idParent;
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($tbProdutosId, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");

$tbProdutosCodProduto = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "cod_produto");
$tbProdutosProduto = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "produto");
$tbProdutosIC1 = DbFuncoes::GetCampoGenerico01($tbProdutosId, "tb_produtos", "informacao_complementar1");

//Verificação de erro - debug.
echo "tbProdutosId=" . $tbProdutosId . "<br>";
echo "tbProdutosCodProduto=" . $tbProdutosCodProduto . "<br>";
echo "tbProdutosProduto=" . $tbProdutosProduto . "<br>";
echo "tbProdutosIC1=" . $tbProdutosIC1 . "<br>";
echo "idTipoProduto=" . $idTipoProduto . "<br>";
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
    <form name="formHistoricoEditar" id="formHistoricoEditar" action="SiteAdmHistoricoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">

        <div style="position: absolute; display: block; top: 0px; right: 0px;">
            <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
            
            <input name="idTbHistorico" type="hidden" id="idTbHistorico" value="<?php echo $idTbHistorico; ?>" />
            <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbHistoricoIdParent; ?>" />
            <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            
            <input name="idTbHistoricoStatusSelect" type="hidden" id="idTbHistoricoStatusSelect" value="<?php echo $idTbHistoricoStatusSelect; ?>" />
        </div>

                <!--Informações - Controles.-->
                <div style="position: relative; display: table-cell; width: 1%; height: 20px; overflow: hidden; vertical-align: bottom;">
                    <div id="divAbaInfo1" class="DivAbaInfo01">
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
                                                        " style="cursor: pointer;">
                            Descri&ccedil;&atilde;o
                        </a>
                    </div>
                    <div id="divAbaInfo1a" class="DivAbaInfo01" style="display: none; background-color: #00a2e8;">
                        Descri&ccedil;&atilde;o
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
                <!--Descrição.-->
                <div id="divInfo1" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: block; height: 535px; border: 1px solid #000000;">

                    
                    
                    <!--Livro.-->
                    <?php if($idTipoProduto == "3486"){ ?>
                    <div style="position: relative; display: block;">
                    	<div style="position: absolute; display: block; top: 5px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo1Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
                                <?php 
                                    $arrHistoricoVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo1'], $GLOBALS['configIdTbTipoHistoricoVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo1'], $GLOBALS['configHistoricoVinculo1Metodo']);
                                ?>
                                <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo1); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo1[$countArray][0];?>"<?php if($arrHistoricoVinculo1[$countArray][0] == $tbHistoricoIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo1[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <!--Encadernação.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 5px; width: 540px; height: 395px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Encardena&ccedil;&atilde;o
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico30Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico30Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "41", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico30 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 41);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico30[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrHistoricoFiltroGenerico30Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico30" name="idsHistoricoFiltroGenerico30[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrHistoricoFiltroGenerico30Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico30CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico30" name="idsHistoricoFiltroGenerico30[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico30); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico30[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico30[$countArray][0], $arrHistoricoFiltroGenerico30Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico30[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
									<?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico30))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=41&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=41&tipoRetorno=3\', \'idsHistoricoFiltroGenerico30\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 200px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico31Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico31Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "42", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico31 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 42);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico31[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrHistoricoFiltroGenerico31Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico31" name="idsHistoricoFiltroGenerico31[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrHistoricoFiltroGenerico31Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico31CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico31" name="idsHistoricoFiltroGenerico31[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico31); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico31[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico31[$countArray][0], $arrHistoricoFiltroGenerico31Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico31[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico31))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=42&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=42&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=42&tipoRetorno=3\', \'idsHistoricoFiltroGenerico31\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <!--Encadernação.-->
                            <div style="position: absolute; display: block; top: 60px; left: 10px; width: 520px; height: 55px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Revestimento
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico32Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico32Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "43", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico32 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 43);
                                        //echo "arrHistoricoFiltroGenerico32Selecao=" . $arrHistoricoFiltroGenerico32Selecao . "<br />";
                                        //echo "arrHistoricoFiltroGenerico32Selecao[0]=" . $arrHistoricoFiltroGenerico32Selecao[0] . "<br />";
                                        //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                        //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico32[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrHistoricoFiltroGenerico32Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico32" name="idsHistoricoFiltroGenerico32[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrHistoricoFiltroGenerico32Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico32CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico32" name="idsHistoricoFiltroGenerico32[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico32); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico32[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico32[$countArray][0], $arrHistoricoFiltroGenerico32Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico32[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico32))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=43&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=43&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=43&tipoRetorno=3\', \'idsHistoricoFiltroGenerico32\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 140px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc31'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc31'] == 1){ ?>
                                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC31;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc31'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC31;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar31").cleditor(
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
                                                <textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbHistoricoIC31;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar31").cleditor(
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
                                                <textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbHistoricoIC31;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 265px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc32'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc32'] == 1){ ?>
                                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC32;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc32'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC32;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar32").cleditor(
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
                                                <textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbHistoricoIC32;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar32").cleditor(
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
                                                <textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbHistoricoIC32;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 390px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc33'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc33'] == 1){ ?>
                                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC33;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc33'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC33;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar33").cleditor(
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
                                                <textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbHistoricoIC33;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar33").cleditor(
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
                                                <textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbHistoricoIC33;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!--Lombada.-->
                            <div style="position: absolute; display: block; top: 130px; left: 10px; width: 520px; height: 105px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Lombada
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico33Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico33Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "44", "", ",", "", "1"));
                                        ?>
                
                                        <?php 
                                        $arrHistoricoFiltroGenerico33 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 44);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico33[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrHistoricoFiltroGenerico33Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico33" name="idsHistoricoFiltroGenerico33[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrHistoricoFiltroGenerico33Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico33CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico33" name="idsHistoricoFiltroGenerico33[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico33); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico33[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico33[$countArray][0], $arrHistoricoFiltroGenerico33Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico33[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico33))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=44&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=44&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=44&tipoRetorno=3\', \'idsHistoricoFiltroGenerico33\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 140px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc34'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc34'] == 1){ ?>
                                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC34;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc34'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC34;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar34").cleditor(
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
                                                <textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbHistoricoIC34;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar34").cleditor(
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
                                                <textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbHistoricoIC34;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 265px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico34Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico34Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "45", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico34 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 45);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico34[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrHistoricoFiltroGenerico34Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico34" name="idsHistoricoFiltroGenerico34[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrHistoricoFiltroGenerico34Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico34CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico34" name="idsHistoricoFiltroGenerico34[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico34); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico34[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico34[$countArray][0], $arrHistoricoFiltroGenerico34Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico34[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico34))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=45&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=45&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=45&tipoRetorno=3\', \'idsHistoricoFiltroGenerico34\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                
                                <div style="position: absolute; display: block; top: 50px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico35Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico35Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "46", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico35 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 46);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico35[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrHistoricoFiltroGenerico35Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico35" name="idsHistoricoFiltroGenerico35[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrHistoricoFiltroGenerico35Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico35CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico35" name="idsHistoricoFiltroGenerico35[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico35); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico35[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico35[$countArray][0], $arrHistoricoFiltroGenerico35Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico35[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico35))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=46&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=46&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=46&tipoRetorno=3\', \'idsHistoricoFiltroGenerico35\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>                                
                                        <?php } ?>                                
                                    </div>
                                            </div>
                                
                                <div style="position: absolute; display: block; top: 50px; left: 140px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico36Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico36Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "47", "", ",", "", "1"));
                                        ?>
                
                                        <?php 
                                        $arrHistoricoFiltroGenerico36 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 47);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico36[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrHistoricoFiltroGenerico36Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico36" name="idsHistoricoFiltroGenerico36[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrHistoricoFiltroGenerico36Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico36CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico36" name="idsHistoricoFiltroGenerico36[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico36); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico36[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico36[$countArray][0], $arrHistoricoFiltroGenerico36Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico36[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico36))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=47&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=47&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=47&tipoRetorno=3\', \'idsHistoricoFiltroGenerico36\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                                
                                <div style="position: absolute; display: block; top: 50px; left: 265px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico37Nome'], "IncludeConfig"); ?>: 
                                    </div>
                                    <div class="AdmTexto01">
                                        <?php
                                        //Seleção de ids selecionados para o registro.
                                        $arrHistoricoFiltroGenerico37Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "48", "", ",", "", "1"));
                                        ?>
                                    
                                        <?php 
                                        $arrHistoricoFiltroGenerico37 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 48);
                                        ?>
                                        
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 1){ ?>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                            {
                                            ?>
                                                <div>
                                                    <input name="idsHistoricoFiltroGenerico37[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrHistoricoFiltroGenerico37Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?>
                                                </div>
                                            <?php 
                                            }
                                            ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 2){ ?>
                                            <select id="idsHistoricoFiltroGenerico37" name="idsHistoricoFiltroGenerico37[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrHistoricoFiltroGenerico37Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select> 
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoFiltroGenerico37CaixaSelecao'] == 3){ ?>
                                            <select id="idsHistoricoFiltroGenerico37" name="idsHistoricoFiltroGenerico37[]" class="AdmCampoDropDownMenu01">
                                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                                <?php 
                                                for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico37); $countArray++)
                                                {
                                                ?>
                                                    <option value="<?php echo $arrHistoricoFiltroGenerico37[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico37[$countArray][0], $arrHistoricoFiltroGenerico37Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico37[$countArray][1];?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        <?php } ?>
                                        
                                        <?php 
                                        $flagManutencaoLink = $configManutencaoLinkFlag;
                                        if($configManutencaoLinkFlag != true)
                                        {
                                            if(empty($arrHistoricoFiltroGenerico37))
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
                                                <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=48&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                                </a>
                                            <?php } ?>
                                            <?php if($configManutencaoLink == 3){ ?>
                                                <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=48&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                            divShow('divManutencaoAjax');
                                                            HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=48&tipoRetorno=3\', \'idsHistoricoFiltroGenerico37\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                    <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            </div>
                            
                            
                            <div style="position: absolute; display: block; top: 235px; left: 10px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico38Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico38Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "49", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico38 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 49);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico38[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrHistoricoFiltroGenerico38Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico38" name="idsHistoricoFiltroGenerico38[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrHistoricoFiltroGenerico38Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico38CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico38" name="idsHistoricoFiltroGenerico38[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico38); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico38[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico38[$countArray][0], $arrHistoricoFiltroGenerico38Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico38[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico38))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=49&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=49&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=49&tipoRetorno=3\', \'idsHistoricoFiltroGenerico38\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 235px; left: 150px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico39Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico39Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "50", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico39 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 50);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico39[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrHistoricoFiltroGenerico39Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico39" name="idsHistoricoFiltroGenerico39[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrHistoricoFiltroGenerico39Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico39CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico39" name="idsHistoricoFiltroGenerico39[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico39); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico39[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico39[$countArray][0], $arrHistoricoFiltroGenerico39Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico39[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico39))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=50&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=50&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=50&tipoRetorno=3\', \'idsHistoricoFiltroGenerico39\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 235px; left: 270px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico40Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico40Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "51", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico40 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 51);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico40[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrHistoricoFiltroGenerico40Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico40" name="idsHistoricoFiltroGenerico40[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrHistoricoFiltroGenerico40Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico40CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico40" name="idsHistoricoFiltroGenerico40[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico40); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico40[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico40[$countArray][0], $arrHistoricoFiltroGenerico40Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico40[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico40))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=51&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=51&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=51&tipoRetorno=3\', \'idsHistoricoFiltroGenerico40\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            
                            <!--Fechos.-->
                            <div style="position: absolute; display: block; top: 280px; left: 10px; width: 520px; height: 40px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Fechos
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc35'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc35'] == 1){ ?>
                                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC35;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc35'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC35;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar35").cleditor(
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
                                                <textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbHistoricoIC35;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar35").cleditor(
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
                                                <textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbHistoricoIC35;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 140px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc36'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc36'] == 1){ ?>
                                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC36;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc36'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC36;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar36").cleditor(
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
                                                <textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbHistoricoIC36;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar36").cleditor(
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
                                                <textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbHistoricoIC36;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 265px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc37'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc37'] == 1){ ?>
                                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC37;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc37'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC37;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar37").cleditor(
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
                                                <textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbHistoricoIC37;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar37").cleditor(
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
                                                <textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbHistoricoIC37;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 390px;">
                                    <div align="left" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc38'], "IncludeConfig"); ?>:
                                    </div>
                                    <div>
                                        <?php if($GLOBALS['configHistoricoBoxIc38'] == 1){ ?>
                                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC38;?>" />
                                        <?php } ?>
                                        <?php if($GLOBALS['configHistoricoBoxIc38'] == 2){ ?>
                                            <?php //Sem formatação.?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC38;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação básica (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                                
                                                <script type="text/javascript">
                                                    //Caixa básica.
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar38").cleditor(
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
                                                <textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbHistoricoIC38;?></textarea>
                                            <?php } ?>
                                            
                                            <?php //Formatação avançada (CLEditor).?>
                                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $("#informacao_complementar38").cleditor(
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
                                                <textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbHistoricoIC38;?></textarea>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>


                            <div style="position: absolute; display: block; top: 320px; left: 10px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc39'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc39'] == 1){ ?>
                                        <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC39;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc39'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC39;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar39").cleditor(
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
                                            <textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbHistoricoIC39;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar39").cleditor(
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
                                            <textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbHistoricoIC39;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                        
                        
                        <!--Miolo.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 560px; width: 400px; height: 395px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Miolo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico28Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico28Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "39", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico28 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 39);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico28[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrHistoricoFiltroGenerico28Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico28" name="idsHistoricoFiltroGenerico28[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrHistoricoFiltroGenerico28Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico28CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico28" name="idsHistoricoFiltroGenerico28[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico28); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico28[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico28[$countArray][0], $arrHistoricoFiltroGenerico28Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico28[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico28))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=39&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=39&tipoRetorno=3\', \'idsHistoricoFiltroGenerico28\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 145px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc40'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc40'] == 1){ ?>
                                        <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC40;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc40'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC40;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar40").cleditor(
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
                                            <textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbHistoricoIC40;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar40").cleditor(
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
                                            <textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbHistoricoIC40;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 145px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc41'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc41'] == 1){ ?>
                                        <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC41;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc41'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC41;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar41").cleditor(
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
                                            <textarea name="informacao_complementar41" id="informacao_complementar41"><?php echo $tbHistoricoIC41;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar41").cleditor(
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
                                            <textarea name="informacao_complementar41" id="informacao_complementar41"><?php echo $tbHistoricoIC41;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 70px; left: 145px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc42'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc42'] == 1){ ?>
                                        <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC42;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc42'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC42;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar42").cleditor(
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
                                            <textarea name="informacao_complementar42" id="informacao_complementar42"><?php echo $tbHistoricoIC42;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar42").cleditor(
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
                                            <textarea name="informacao_complementar42" id="informacao_complementar42"><?php echo $tbHistoricoIC42;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 100px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico42Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico42Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "53", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico42 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 53);
                                    //echo "arrHistoricoFiltroGenerico42Selecao=" . $arrHistoricoFiltroGenerico42Selecao . "<br />";
                                    //echo "arrHistoricoFiltroGenerico42Selecao[0]=" . $arrHistoricoFiltroGenerico42Selecao[0] . "<br />";
                                    //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                    //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico42[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrHistoricoFiltroGenerico42Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico42" name="idsHistoricoFiltroGenerico42[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrHistoricoFiltroGenerico42Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico42CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico42" name="idsHistoricoFiltroGenerico42[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico42); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico42[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico42[$countArray][0], $arrHistoricoFiltroGenerico42Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico42[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico42))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=53&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=53&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=53&tipoRetorno=3\', \'idsHistoricoFiltroGenerico42\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 130px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico43Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico43Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "54", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico43 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 54);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico43[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrHistoricoFiltroGenerico43Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico43" name="idsHistoricoFiltroGenerico43[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrHistoricoFiltroGenerico43Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico43CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico43" name="idsHistoricoFiltroGenerico43[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico43); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico43[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico43[$countArray][0], $arrHistoricoFiltroGenerico43Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico43[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico43))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=54&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=54&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=54&tipoRetorno=3\', \'idsHistoricoFiltroGenerico43\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 165px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc43'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc43'] == 1){ ?>
                                        <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC43;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc43'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTextoMultilinha01" style="width: 390px; height: 205px;"><?php echo $tbHistoricoIC43;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar43").cleditor(
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
                                            <textarea name="informacao_complementar43" id="informacao_complementar43"><?php echo $tbHistoricoIC43;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar43").cleditor(
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
                                            <textarea name="informacao_complementar43" id="informacao_complementar43"><?php echo $tbHistoricoIC43;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--Miolo.-->
                    </div>
                    <?php } ?>
                    <!--Livro.-->
                </div>
                <!--Descrição.-->
                
                <!--Estado de conservação.-->
                <div id="divInfo2" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <!--Livro.-->
                    <?php if($idTipoProduto == "3486"){ ?>
                    <div style="position: relative; display: block;">
                    	<div style="position: absolute; display: block; top: 5px; left: 5px;">
                        	HistoricoVinculo1
                        </div>
                        
                        <!--Encadernação.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 5px; width: 540px; height: 350px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Encardena&ccedil;&atilde;o
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico44Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico44Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "55", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico44 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 55);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico44[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico44[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico44[$countArray][0], $arrHistoricoFiltroGenerico44Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico44[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico44" name="idsHistoricoFiltroGenerico44[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico44[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico44[$countArray][0], $arrHistoricoFiltroGenerico44Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico44[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico44CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico44" name="idsHistoricoFiltroGenerico44[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico44); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico44[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico44[$countArray][0], $arrHistoricoFiltroGenerico44Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico44[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico44))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=55&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=55&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=55&tipoRetorno=3\', \'idsHistoricoFiltroGenerico44\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 230px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico45Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico45Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "56", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico45 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 56);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico45[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico45[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico45[$countArray][0], $arrHistoricoFiltroGenerico45Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico45[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico45" name="idsHistoricoFiltroGenerico45[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico45[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico45[$countArray][0], $arrHistoricoFiltroGenerico45Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico45[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico45CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico45" name="idsHistoricoFiltroGenerico45[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico45); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico45[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico45[$countArray][0], $arrHistoricoFiltroGenerico45Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico45[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico45))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=56&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=56&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=56&tipoRetorno=3\', \'idsHistoricoFiltroGenerico45\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 90px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico46Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico46Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "57", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico46 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 57);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico46[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico46[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico46[$countArray][0], $arrHistoricoFiltroGenerico46Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico46[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico46" name="idsHistoricoFiltroGenerico46[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico46[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico46[$countArray][0], $arrHistoricoFiltroGenerico46Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico46[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico46CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico46" name="idsHistoricoFiltroGenerico46[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico46); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico46[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico46[$countArray][0], $arrHistoricoFiltroGenerico46Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico46[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico46))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=57&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=57&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=57&tipoRetorno=3\', \'idsHistoricoFiltroGenerico46\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 90px; left: 230px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico47Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico47Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "58", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico47 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 58);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico47[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico47[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico47[$countArray][0], $arrHistoricoFiltroGenerico47Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico47[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico47" name="idsHistoricoFiltroGenerico47[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico47[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico47[$countArray][0], $arrHistoricoFiltroGenerico47Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico47[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico47CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico47" name="idsHistoricoFiltroGenerico47[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico47); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico47[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico47[$countArray][0], $arrHistoricoFiltroGenerico47Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico47[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico47))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=58&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=58&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=58&tipoRetorno=3\', \'idsHistoricoFiltroGenerico47\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 170px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico48Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico48Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "59", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico48 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 59);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico48[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico48[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico48[$countArray][0], $arrHistoricoFiltroGenerico48Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico48[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico48" name="idsHistoricoFiltroGenerico48[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico48[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico48[$countArray][0], $arrHistoricoFiltroGenerico48Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico48[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico48CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico48" name="idsHistoricoFiltroGenerico48[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico48); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico48[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico48[$countArray][0], $arrHistoricoFiltroGenerico48Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico48[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico48))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=59&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=59&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=59&tipoRetorno=3\', \'idsHistoricoFiltroGenerico48\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 170px; left: 230px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico49Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico49Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "60", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico49 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 60);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico49[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico49[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico49[$countArray][0], $arrHistoricoFiltroGenerico49Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico49[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico49" name="idsHistoricoFiltroGenerico49[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico49[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico49[$countArray][0], $arrHistoricoFiltroGenerico49Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico49[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico49CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico49" name="idsHistoricoFiltroGenerico49[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico49); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico49[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico49[$countArray][0], $arrHistoricoFiltroGenerico49Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico49[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico49))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=60&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=60masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=60&tipoRetorno=3\', \'idsHistoricoFiltroGenerico49\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 240px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc44'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc44'] == 1){ ?>
                                        <input type="text" name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC44;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc44'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTextoMultilinha01" style="width: 520px; height: 80px;"><?php echo $tbHistoricoIC44;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar44").cleditor(
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
                                            <textarea name="informacao_complementar44" id="informacao_complementar44"><?php echo $tbHistoricoIC44;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar44").cleditor(
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
                                            <textarea name="informacao_complementar44" id="informacao_complementar44"><?php echo $tbHistoricoIC44;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    	<div style="position: absolute; display: block; top: 420px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico50Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico50Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "61", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico50 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 61);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico50[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrHistoricoFiltroGenerico50Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico50" name="idsHistoricoFiltroGenerico50[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrHistoricoFiltroGenerico50Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico50CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico50" name="idsHistoricoFiltroGenerico50[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico50); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico50[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico50[$countArray][0], $arrHistoricoFiltroGenerico50Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico50[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico50))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=61masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=61&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=61&tipoRetorno=3\', \'idsHistoricoFiltroGenerico50\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                    	<div style="position: absolute; display: block; top: 420px; left: 280px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico51Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico51Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "62", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico51 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 62);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico51[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrHistoricoFiltroGenerico51Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico51" name="idsHistoricoFiltroGenerico51[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrHistoricoFiltroGenerico51Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico51CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico51" name="idsHistoricoFiltroGenerico51[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico51); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico51[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico51[$countArray][0], $arrHistoricoFiltroGenerico51Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico51[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico51))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=62&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=62&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=62&tipoRetorno=3\', \'idsHistoricoFiltroGenerico51\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        
                    	<div style="position: absolute; display: block; top: 490px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc45'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc45'] == 1){ ?>
                                    <input type="text" name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC45;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc45'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC45;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar45").cleditor(
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
                                        <textarea name="informacao_complementar45" id="informacao_complementar45"><?php echo $tbHistoricoIC45;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar45").cleditor(
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
                                        <textarea name="informacao_complementar45" id="informacao_complementar45"><?php echo $tbHistoricoIC45;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                        <!--Miolo.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 560px; width: 400px; height: 350px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Miolo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico52Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico52Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "63", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico52 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 63);
                                    //echo "arrHistoricoFiltroGenerico52Selecao=" . $arrHistoricoFiltroGenerico52Selecao . "<br />";
                                    //echo "arrHistoricoFiltroGenerico52Selecao[0]=" . $arrHistoricoFiltroGenerico52Selecao[0] . "<br />";
                                    //echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "13", "", ",", "", "1")  . "<br />";
                                    //echo "tbHistoricoId=" . $tbHistoricoId . "<br />";
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico52[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico52[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico52[$countArray][0], $arrHistoricoFiltroGenerico52Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico52[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico52" name="idsHistoricoFiltroGenerico52[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico52[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico52[$countArray][0], $arrHistoricoFiltroGenerico52Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico52[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico52CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico52" name="idsHistoricoFiltroGenerico52[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico52); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico52[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico52[$countArray][0], $arrHistoricoFiltroGenerico52Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico52[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico52))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=63&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=63&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=63&tipoRetorno=3\', \'idsHistoricoFiltroGenerico52\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico53Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico53Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "64", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico53 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 64);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico53[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico53[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico53[$countArray][0], $arrHistoricoFiltroGenerico53Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico53[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico53" name="idsHistoricoFiltroGenerico53[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico53[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico53[$countArray][0], $arrHistoricoFiltroGenerico53Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico53[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico53CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico53" name="idsHistoricoFiltroGenerico53[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico53); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico53[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico53[$countArray][0], $arrHistoricoFiltroGenerico53Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico53[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico53))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=64&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=64&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=64&tipoRetorno=3\', \'idsHistoricoFiltroGenerico53\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>

                            <div style="position: absolute; display: block; top: 80px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc46'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc46'] == 1){ ?>
                                        <input type="text" name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC46;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc46'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTextoMultilinha01" style="width: 380px;"><?php echo $tbHistoricoIC46;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar46").cleditor(
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
                                            <textarea name="informacao_complementar46" id="informacao_complementar46"><?php echo $tbHistoricoIC46;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar46").cleditor(
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
                                            <textarea name="informacao_complementar46" id="informacao_complementar46"><?php echo $tbHistoricoIC46;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 165px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico54Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico54Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "65", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico54 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 65);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico54[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico54[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico54[$countArray][0], $arrHistoricoFiltroGenerico54Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico54[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico54" name="idsHistoricoFiltroGenerico54[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico54[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico54[$countArray][0], $arrHistoricoFiltroGenerico54Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico54[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico54CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico54" name="idsHistoricoFiltroGenerico54[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico54); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico54[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico54[$countArray][0], $arrHistoricoFiltroGenerico54Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico54[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico54))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=65&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=65&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=65&tipoRetorno=3\', \'idsHistoricoFiltroGenerico54\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 165px; left: 240px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico55Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico55Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "66", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico55 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 66);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico55[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico55[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico55[$countArray][0], $arrHistoricoFiltroGenerico55Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico55[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico55" name="idsHistoricoFiltroGenerico55[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico55[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico55[$countArray][0], $arrHistoricoFiltroGenerico55Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico55[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico55CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico55" name="idsHistoricoFiltroGenerico55[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico55); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico55[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico55[$countArray][0], $arrHistoricoFiltroGenerico55Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico55[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico55))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=66&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=66&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=66&tipoRetorno=3\', \'idsHistoricoFiltroGenerico55\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 245px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc47'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc47'] == 1){ ?>
                                        <input type="text" name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC47;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc47'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTextoMultilinha01" style="width: 380px;"><?php echo $tbHistoricoIC47;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar47").cleditor(
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
                                            <textarea name="informacao_complementar47" id="informacao_complementar47"><?php echo $tbHistoricoIC37;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar47").cleditor(
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
                                            <textarea name="informacao_complementar47" id="informacao_complementar47"><?php echo $tbHistoricoIC37;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!--Miolo.-->
                        
                        <div style="position: absolute; display: block; top: 405px; left: 560px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc48'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc48'] == 1){ ?>
                                    <input type="text" name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC48;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc48'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTextoMultilinha01" style="width: 380px; height: 100px;"><?php echo $tbHistoricoIC48;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar48").cleditor(
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
                                        <textarea name="informacao_complementar48" id="informacao_complementar48"><?php echo $tbHistoricoIC48;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar48").cleditor(
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
                                        <textarea name="informacao_complementar48" id="informacao_complementar48"><?php echo $tbHistoricoIC48;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                    <!--Livro.-->
                    
                    
                    <!--Diplomas.-->
                    <?php if($idTipoProduto == "3483"){ ?>
                    <div style="position: relative; display: none;">
                    	<div style="position: absolute; display: block; top: 5px; left: 5px;">
                        	HistoricoVinculo1
                        </div>
                        
                        <div style="position: absolute; display: block; top: 60px; left: 5px;">
                            Estado de Conservação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 90px; left: 5px;">
                            Diagnóstico
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Descrição do estado de conservação
                        </div>
                        
                        <!--Encadernação.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 490px; width: 470px; height: 430px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem / embalagem em que o diploma (trocar por material) chegou
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 250px;">
                                Material
                            </div>
                            
                            <!--No caso de moldura.-->
                            <div style="position: absolute; display: block; top: 90px; left: 10px; width: 450px; height: 90px; border: 1px solid #c31907;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    No caso de moldura
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Proteção frontal
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Proteção do verso
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Passe-partout
                            </div>
                            <div style="position: absolute; display: block; top: 180px; left: 250px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 250px; left: 5px;">
                                Descrição da montagem em que o diploma (trocar por material) chegou
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                    <!--Diplomas.-->
                    
                    
                    <!--Documentos.-->
                    <?php if($idTipoProduto == "3484"){ ?>
                    <div style="position: relative; display: none;">
                    	<div style="position: absolute; display: block; top: 5px; left: 5px;">
                        	HistoricoVinculo1
                        </div>
                        
                        <div style="position: absolute; display: block; top: 60px; left: 5px;">
                            Estado de Conservação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 90px; left: 5px;">
                            Diagnóstico
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Descrição do estado de conservação
                        </div>
                        
                        <!--Encadernação.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 490px; width: 470px; height: 430px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem / embalagem em que o documento (trocar por material) chegou
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 250px;">
                                Material
                            </div>
                            
                            <!--No caso de moldura.-->
                            <div style="position: absolute; display: block; top: 90px; left: 10px; width: 450px; height: 90px; border: 1px solid #c31907;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    No caso de moldura
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Proteção frontal
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Proteção do verso
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Passe-partout
                            </div>
                            <div style="position: absolute; display: block; top: 180px; left: 250px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 250px; left: 5px;">
                                Descrição da montagem em que o documento (trocar por material) chegou
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                    <!--Documentos.-->
                    
                    
                    <!--Mapa.-->
                    <?php if($idTipoProduto == "3487"){ ?>
                    <div style="position: relative; display: block;">
                    	<div style="position: absolute; display: block; top: 5px; left: 5px;">
                        	HistoricoVinculo1
                        </div>
                        
                        <div style="position: absolute; display: block; top: 60px; left: 5px;">
                            Estado de Conservação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 90px; left: 5px;">
                            Diagnóstico
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Descrição do estado de conservação
                        </div>
                        
                        <!--Encadernação.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 490px; width: 470px; height: 430px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem / embalagem em que o mapa (trocar por material) chegou
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 250px;">
                                Material
                            </div>
                            
                            <!--No caso de moldura.-->
                            <div style="position: absolute; display: block; top: 90px; left: 10px; width: 450px; height: 90px; border: 1px solid #c31907;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    No caso de moldura
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Proteção frontal
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Proteção do verso
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Passe-partout
                            </div>
                            <div style="position: absolute; display: block; top: 180px; left: 250px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 250px; left: 5px;">
                                Descrição da montagem em que o mapa (trocar por material) chegou
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                    <!--Mapa.-->
                    
                    
                    <!--Obras de Arte.-->
                    <?php if($idTipoProduto == "3488"){ ?>
                    <div style="position: relative; display: block;">
                    	<div style="position: absolute; display: block; top: 5px; left: 5px;">
                        	HistoricoVinculo1
                        </div>
                        
                        <div style="position: absolute; display: block; top: 60px; left: 5px;">
                            Estado de Conservação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 90px; left: 5px;">
                            Diagnóstico
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Descrição do estado de conservação
                        </div>
                        
                        <!--Encadernação.-->
                    	<div style="position: absolute; display: block; top: 50px; left: 490px; width: 470px; height: 430px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem / embalagem em que o obra de arte (trocar por material) chegou
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 250px;">
                                Material
                            </div>
                            
                            <!--No caso de moldura.-->
                            <div style="position: absolute; display: block; top: 90px; left: 10px; width: 450px; height: 90px; border: 1px solid #c31907;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    No caso de moldura
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Proteção frontal
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Proteção do verso
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Passe-partout
                            </div>
                            <div style="position: absolute; display: block; top: 180px; left: 250px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 250px; left: 5px;">
                                Descrição da montagem em que o obra de arte (trocar por material) chegou
                            </div>
                        </div>
                        
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
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico Responsável
                        </div>
                        <div style="position: absolute; display: block; top: 0px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoVinculo2Nome'], "IncludeConfig"); ?>:
                            </div>
                            <div class="AdmTexto01">
                                <?php 
                                    $arrHistoricoVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbHistoricoVinculo2'], $GLOBALS['configIdTbTipoHistoricoVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoHistoricoVinculo2'], $GLOBALS['configHistoricoVinculo2Metodo']);
                                ?>
                                <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                                    <option value="0"<?php if($tbHistoricoIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemNenhumDropDown"); ?></option>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoVinculo2); $countArray++)
                                    {
                                    ?>
                                        <option value="<?php echo $arrHistoricoVinculo2[$countArray][0];?>"<?php if($arrHistoricoVinculo2[$countArray][0] == $tbHistoricoIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoVinculo2[$countArray][1];?></option>
                                    <?php 
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 35px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "14", "", ",", "", "1"));
                                ?>
        
                                <?php 
                                $arrHistoricoFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 14);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico03[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <br />
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico03" name="idsHistoricoFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico03[$countArray][0], $arrHistoricoFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico03[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico03))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=14&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=14&tipoRetorno=3\', \'idsHistoricoFiltroGenerico03\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>                                
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 70px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc3'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc3'] == 1){ ?>
                                    <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC3;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc3'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01" style="width: 465px; height: 30px;"><?php echo $tbHistoricoIC3;?></textarea>
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
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbHistoricoIC3;?></textarea>
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
                                        <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbHistoricoIC3;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 120px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                            </div>
                            <div class="AdmTexto01">
                                <?php
                                //Seleção de ids selecionados para o registro.
                                $arrHistoricoFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "15", "", ",", "", "1"));
                                ?>
                            
                                <?php 
                                $arrHistoricoFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 15);
                                ?>
                                
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                    <?php 
                                    for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                    {
                                    ?>
                                        <div>
                                            <input name="idsHistoricoFiltroGenerico04[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?>
                                        </div>
                                    <?php 
                                    }
                                    ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                    <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select> 
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                    <select id="idsHistoricoFiltroGenerico04" name="idsHistoricoFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                        <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <option value="<?php echo $arrHistoricoFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico04[$countArray][0], $arrHistoricoFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico04[$countArray][1];?></option>
                                        <?php 
                                        }
                                        ?>
                                    </select>
                                <?php } ?>
                                
                                <?php 
                                $flagManutencaoLink = $configManutencaoLinkFlag;
                                if($configManutencaoLinkFlag != true)
                                {
                                    if(empty($arrHistoricoFiltroGenerico04))
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
                                        <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                    <?php if($configManutencaoLink == 3){ ?>
                                        <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=15&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                    divShow('divManutencaoAjax');
                                                    HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=15&tipoRetorno=3\', \'idsHistoricoFiltroGenerico04\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                 <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        <div style="position: absolute; display: block; top: 120px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc4'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc4'] == 1){ ?>
                                    <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC4;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc4'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01" style="width: 270px; height: 40px;"><?php echo $tbHistoricoIC4;?></textarea>
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
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbHistoricoIC4;?></textarea>
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
                                        <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbHistoricoIC4;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 175px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc5'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc5'] == 1){ ?>
                                    <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC5;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc5'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01" style="width: 465px; height: 30px;"><?php echo $tbHistoricoIC5;?></textarea>
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
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbHistoricoIC5;?></textarea>
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
                                        <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbHistoricoIC5;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 225px; left: 5px;">
                            Teste de solubilidade
                        </div>
                        <div style="position: absolute; display: block; top: 225px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc6'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc6'] == 1){ ?>
                                    <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC6;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc6'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01" style="width: 270px; height: 80px;"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
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
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar6").cleditor(
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
                                        <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbHistoricoIC6;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <!--Fixação.-->
                    	<div style="position: absolute; display: block; top: 330px; left: 5px; width: 470px; height: 70px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Fixação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc7'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc7'] == 1){ ?>
                                        <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC7;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc7'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC7;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar7").cleditor(
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
                                            <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbHistoricoIC7;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar7").cleditor(
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
                                            <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbHistoricoIC7;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc8'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc8'] == 1){ ?>
                                        <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC8;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc8'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC8;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar8").cleditor(
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
                                            <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbHistoricoIC8;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar8").cleditor(
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
                                            <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbHistoricoIC8;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 30px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "16", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 16);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico05[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrHistoricoFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico05" name="idsHistoricoFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrHistoricoFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico05" name="idsHistoricoFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico05[$countArray][0], $arrHistoricoFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico05))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=16&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=16&tipoRetorno=3\', \'idsHistoricoFiltroGenerico05\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 30px; left: 205px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc9'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc9'] == 1){ ?>
                                        <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC9;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc9'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC9;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar9").cleditor(
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
                                            <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbHistoricoIC9;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar9").cleditor(
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
                                            <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbHistoricoIC9;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc10'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc10'] == 1){ ?>
                                    <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC10;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc10'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC10;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar10").cleditor(
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
                                        <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbHistoricoIC10;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar10").cleditor(
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
                                        <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbHistoricoIC10;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div style="position: absolute; display: block; top: 420px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc11'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc11'] == 1){ ?>
                                    <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbHistoricoIC11;?>"/>
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc11'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC11;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar11").cleditor(
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
                                        <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbHistoricoIC11;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar11").cleditor(
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
                                        <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbHistoricoIC11;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 450px; left: 5px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc12'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc12'] == 1){ ?>
                                    <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC12;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc12'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC12;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar12").cleditor(
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
                                        <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbHistoricoIC12;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar12").cleditor(
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
                                        <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbHistoricoIC12;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <div style="position: absolute; display: block; top: 450px; left: 205px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc13'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc13'] == 1){ ?>
                                    <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC13;?>">
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc13'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbHistoricoIC13;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar13").cleditor(
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
                                        <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbHistoricoIC13;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar13").cleditor(
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
                                        <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbHistoricoIC13;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                        <!--Tratamento Aquoso.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Tratamento aquoso
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "17", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 17);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico06[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrHistoricoFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico06" name="idsHistoricoFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrHistoricoFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico06" name="idsHistoricoFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico06[$countArray][0], $arrHistoricoFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico06))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=17&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=17&tipoRetorno=3\', \'idsHistoricoFiltroGenerico06\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 245px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc23'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc23'] == 1){ ?>
                                        <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC23;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc23'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 70px;"><?php echo $tbHistoricoIC23;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar23").cleditor(
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
                                            <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbHistoricoIC23;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar23").cleditor(
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
                                            <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbHistoricoIC23;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "18", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 18);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico07[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrHistoricoFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico07" name="idsHistoricoFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrHistoricoFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico07" name="idsHistoricoFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico07[$countArray][0], $arrHistoricoFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico07))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=18&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=18&tipoRetorno=3\', \'idsHistoricoFiltroGenerico07\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        </div>
                        
                        <!--Desacidificação.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 115px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Desacidificação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "19", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 19);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico08[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrHistoricoFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico08" name="idsHistoricoFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrHistoricoFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico08" name="idsHistoricoFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico08[$countArray][0], $arrHistoricoFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico08))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=19&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=19&tipoRetorno=3\', \'idsHistoricoFiltroGenerico08\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 75px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "20", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 20);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico09[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrHistoricoFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico09" name="idsHistoricoFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrHistoricoFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico09" name="idsHistoricoFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico09[$countArray][0], $arrHistoricoFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico09))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=20&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=20&tipoRetorno=3\', \'idsHistoricoFiltroGenerico09\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 245px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc14'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc14'] == 1){ ?>
                                        <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC14;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc14'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01" style="width: 200px; height: 90px;"><?php echo $tbHistoricoIC14;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar14").cleditor(
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
                                            <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbHistoricoIC14;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar14").cleditor(
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
                                            <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbHistoricoIC14;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "21", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 21);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico10[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrHistoricoFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico10" name="idsHistoricoFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrHistoricoFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico10" name="idsHistoricoFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico10[$countArray][0], $arrHistoricoFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico10))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=21&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=21&tipoRetorno=3\', \'idsHistoricoFiltroGenerico10\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "22", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 22);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico11[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrHistoricoFiltroGenerico11Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico11" name="idsHistoricoFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrHistoricoFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico11CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico11" name="idsHistoricoFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico11); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico11[$countArray][0], $arrHistoricoFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico11[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico11))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=22&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=22&tipoRetorno=3\', \'idsHistoricoFiltroGenerico11\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                        </div>
                        
                        <!--Clareamento.-->
                    	<div style="position: absolute; display: block; top: 260px; left: 480px; width: 470px; height: 160px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Clareamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "23", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 23);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico12[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrHistoricoFiltroGenerico12Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico12" name="idsHistoricoFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrHistoricoFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico12CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico12" name="idsHistoricoFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico12); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico12[$countArray][0], $arrHistoricoFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico12[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico12))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=23&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=23&tipoRetorno=3\', \'idsHistoricoFiltroGenerico12\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "24", "", ",", "", "1"));
                                    ?>
            
                                    <?php 
                                    $arrHistoricoFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 24);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico13[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrHistoricoFiltroGenerico13Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico13" name="idsHistoricoFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrHistoricoFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico13CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico13" name="idsHistoricoFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico13); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico13[$countArray][0], $arrHistoricoFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico13[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico13))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=24&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=24&tipoRetorno=3\', \'idsHistoricoFiltroGenerico13\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "25", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 25);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico14[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrHistoricoFiltroGenerico14Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico14" name="idsHistoricoFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrHistoricoFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico14" name="idsHistoricoFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico14); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico14[$countArray][0], $arrHistoricoFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico14[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico14))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=25&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=25&tipoRetorno=3\', \'idsHistoricoFiltroGenerico14\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            <div style="position: absolute; display: block; top: 45px; left: 205px;">
                                <div align="left" class="AdmTexto01" style="display: inline-block; vertical-align: top;">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configHistoricoFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                                </div>
                                <div class="AdmTexto01" style="display: inline-block;">
                                    <?php
                                    //Seleção de ids selecionados para o registro.
                                    $arrHistoricoFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbHistoricoId, "tb_historico_relacao_complemento", "id_tb_historico", "id_tb_historico_complemento", "26", "", ",", "", "1"));
                                    ?>
                                
                                    <?php 
                                    $arrHistoricoFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_historico_complemento", 26);
                                    ?>
                                    
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsHistoricoFiltroGenerico15[]" type="checkbox" value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrHistoricoFiltroGenerico15Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 2){ ?>
                                        <select id="idsHistoricoFiltroGenerico15" name="idsHistoricoFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrHistoricoFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoFiltroGenerico15CaixaSelecao'] == 3){ ?>
                                        <select id="idsHistoricoFiltroGenerico15" name="idsHistoricoFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                            <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrHistoricoFiltroGenerico15); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrHistoricoFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrHistoricoFiltroGenerico15[$countArray][0], $arrHistoricoFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrHistoricoFiltroGenerico15[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php 
                                    $flagManutencaoLink = $configManutencaoLinkFlag;
                                    if($configManutencaoLinkFlag != true)
                                    {
                                        if(empty($arrHistoricoFiltroGenerico15))
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
                                            <a href="SiteAdmHistoricoManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteSemMenu.php" class="AdmLinks01" target="_blank">
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            </a>
                                        <?php } ?>
                                        <?php if($configManutencaoLink == 3){ ?>
                                            <a onclick="iframeLoad('iframeManutencaoAjax', 'SiteAdmHistoricoManutencao.php?tipoComplemento=26&masterPageSiteSelect=LayoutSiteIFrame.php', '', '', '');
                                                        divShow('divManutencaoAjax');
                                                        HTMLModificar01('linkManutencaoAjaxFechar', 'propriedade', 'onclick', 'divHide(\'divManutencaoAjax\');ajaxOptionsFill01(\'<?php echo $GLOBALS['configUrl'];?>/<?php echo $GLOBALS['configDiretorioAPI'];?>/ApiManutencao.php\', \'strTabela=tb_historico_complemento&tipoComplemento=26&tipoRetorno=3\', \'idsHistoricoFiltroGenerico15\', \'<?php echo $GLOBALS['configHistoricoFiltroGenerico14CaixaSelecao'];?>\', \'<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?>\', \'GET\', \'html\', \'updtProgressManutencao\', \'1\');');" class="AdmLinks01" style="cursor: pointer;">
                                                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                            	<img src="img/btoManutencao.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>"/>
                                            </a>
                                        <?php } ?>                                
                                    <?php } ?>                                
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 80px; left: 5px;">
                                <div align="left" class="AdmTexto01">
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc15'], "IncludeConfig"); ?>:
                                </div>
                                <div>
                                    <?php if($GLOBALS['configHistoricoBoxIc15'] == 1){ ?>
                                        <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC15;?>" />
                                    <?php } ?>
                                    <?php if($GLOBALS['configHistoricoBoxIc15'] == 2){ ?>
                                        <?php //Sem formatação.?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                            <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01" style="width: 460px;"><?php echo $tbHistoricoIC15;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação básica (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                            
                                            <script type="text/javascript">
                                                //Caixa básica.
                                                $(document).ready(function () {
                                                    $("#informacao_complementar15").cleditor(
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
                                            <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbHistoricoIC15;?></textarea>
                                        <?php } ?>
                                        
                                        <?php //Formatação avançada (CLEditor).?>
                                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $("#informacao_complementar15").cleditor(
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
                                            <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbHistoricoIC15;?></textarea>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 480px;">
                            <div align="left" class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloHistoricoIc16'], "IncludeConfig"); ?>:
                            </div>
                            <div>
                                <?php if($GLOBALS['configHistoricoBoxIc16'] == 1){ ?>
                                    <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbHistoricoIC16;?>" />
                                <?php } ?>
                                <?php if($GLOBALS['configHistoricoBoxIc16'] == 2){ ?>
                                    <?php //Sem formatação.?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                        <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01" style="width: 460px;"><?php echo $tbHistoricoIC16;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação básica (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                        
                                        <script type="text/javascript">
                                            //Caixa básica.
                                            $(document).ready(function () {
                                                $("#informacao_complementar16").cleditor(
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
                                        <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbHistoricoIC16;?></textarea>
                                    <?php } ?>
                                    
                                    <?php //Formatação avançada (CLEditor).?>
                                    <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                        <script type="text/javascript">
                                            $(document).ready(function () {
                                                $("#informacao_complementar16").cleditor(
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
                                        <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbHistoricoIC16;?></textarea>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
                        <!--Consolidação do suporte.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Consolidação do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Material
                            </div>
                        </div>
                        
                        <!--Reitegração do suporte.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Processo
                            </div>
                        </div>
                        
                        <!--Reitegração cromática.-->
                    	<div style="position: absolute; display: block; top: 230px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div style="position: absolute; display: block; top: 335px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 430px; left: 5px;">
                            Informações adicionais do tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 0px; left: 480px;">
                            Tratamento da Encadernação
                        </div>
                        <div style="position: absolute; display: block; top: 15px; left: 480px;">
                            Revestimento
                        </div>
                        <div style="position: absolute; display: block; top: 15px; left: 700px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 80px; left: 480px;">

                            Lombada
                        </div>
                        <div style="position: absolute; display: block; top: 80px; left: 700px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 135px; left: 480px;">
                            Guardas
                        </div>
                        <div style="position: absolute; display: block; top: 135px; left: 635px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 180px; left: 480px;">
                            Tapas
                        </div>
                        <div style="position: absolute; display: block; top: 180px; left: 635px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 225px; left: 480px;">
                            Nervos
                        </div>
                        <div style="position: absolute; display: block; top: 225px; left: 635px;">
                            Descrição
                        </div>

                        <div style="position: absolute; display: block; top: 265px; left: 480px;">
                            Cabeceado
                        </div>
                        <div style="position: absolute; display: block; top: 265px; left: 700px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 325px; left: 480px;">
                            Costura
                        </div>
                        <div style="position: absolute; display: block; top: 325px; left: 635px;">
                            Descrição
                        </div>

                        <div style="position: absolute; display: block; top: 375px; left: 480px;">
                            Fechos
                        </div>
                        <div style="position: absolute; display: block; top: 375px; left: 635px;">
                            Descrição
                        </div>

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
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico Responsável
                        </div>
                        <div style="position: absolute; display: block; top: 0px; left: 205px;">
                             Tipo de Tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 35px; left: 5px;">
                            Fumigação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 85px; left: 5px;">
                            Higienização
                        </div>
                        <div style="position: absolute; display: block; top: 85px; left: 205px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 140px; left: 5px;">
                            Remoção de Adesivos
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Teste de solubilidade
                        </div>
                        <div style="position: absolute; display: block; top: 190px; left: 205px;">
                            Observações
                        </div>
                        
                        <!--Fixação.-->
                    	<div style="position: absolute; display: block; top: 330px; left: 5px; width: 470px; height: 70px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Fixação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Solúvel em
                            </div>
                            
                            <div style="position: absolute; display: block; top: 30px; left: 5px;">
                                Forma de Aplicação
                            </div>
                            <div style="position: absolute; display: block; top: 30px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 5px;">
                            pH antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 420px; left: 205px;">
                            pH após tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 450px; left: 5px;">
                            Espessura antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 450px; left: 205px;">
                            Espessura após tratamento
                        </div>
                        
                        
                        <!--Tratamento Aquoso.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Tratamento aquoso
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Água
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                        </div>
                        
                        <!--Desacidificação.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 115px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Desacidificação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de Desacidificação
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 75px;">
                                Dropdown
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Produto
                            </div>
                        </div>
                        
                        <!--Clareamento.-->
                    	<div style="position: absolute; display: block; top: 260px; left: 480px; width: 470px; height: 150px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Clareamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto Clareante
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Neutralização
                            </div>
                            <div style="position: absolute; display: block; top: 45px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 480px;">
                            Reencolagem
                        </div>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
                        <!--Consolidação do suporte.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Consolidação do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Material
                            </div>
                        </div>
                        
                        <!--Reitegração do suporte.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Processo
                            </div>
                        </div>
                        
                        <!--Reitegração cromática.-->
                    	<div style="position: absolute; display: block; top: 230px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div style="position: absolute; display: block; top: 335px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 0px; left: 480px;">
                            Informações adicionais do tratamento
                        </div>

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
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico Responsável
                        </div>
                        <div style="position: absolute; display: block; top: 0px; left: 205px;">
                             Tipo de Tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 35px; left: 5px;">
                            Fumigação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 85px; left: 5px;">
                            Higienização
                        </div>
                        <div style="position: absolute; display: block; top: 85px; left: 205px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 140px; left: 5px;">
                            Remoção de Adesivos
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Teste de solubilidade
                        </div>
                        <div style="position: absolute; display: block; top: 190px; left: 205px;">
                            Observações
                        </div>
                        
                        <!--Fixação.-->
                    	<div style="position: absolute; display: block; top: 330px; left: 5px; width: 470px; height: 70px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Fixação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Solúvel em
                            </div>
                            
                            <div style="position: absolute; display: block; top: 30px; left: 5px;">
                                Forma de Aplicação
                            </div>
                            <div style="position: absolute; display: block; top: 30px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 5px;">
                            pH antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 420px; left: 205px;">
                            pH após tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 450px; left: 5px;">
                            Espessura antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 450px; left: 205px;">
                            Espessura após tratamento
                        </div>
                        
                        
                        <!--Tratamento Aquoso.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Tratamento aquoso
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Água
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                        </div>
                        
                        <!--Desacidificação.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 115px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Desacidificação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de Desacidificação
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 75px;">
                                Dropdown
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Produto
                            </div>
                        </div>
                        
                        <!--Clareamento.-->
                    	<div style="position: absolute; display: block; top: 260px; left: 480px; width: 470px; height: 150px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Clareamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto Clareante
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Neutralização
                            </div>
                            <div style="position: absolute; display: block; top: 45px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 480px;">
                            Reencolagem
                        </div>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
                        <!--Consolidação do suporte.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Consolidação do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Material
                            </div>
                        </div>
                        
                        <!--Reitegração do suporte.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Processo
                            </div>
                        </div>
                        
                        <!--Reitegração cromática.-->
                    	<div style="position: absolute; display: block; top: 230px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div style="position: absolute; display: block; top: 335px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 0px; left: 480px;">
                            Informações adicionais do tratamento
                        </div>

                    </div>
                    <?php } ?>
                    <!--Documentos.-->
                    
                    
                    <!--Fotografia.-->
                    <?php if($idTipoProduto == "3485"){ ?>
                    <!--Parte 1.-->
                    <div id="divTratamentoParte1" style="position: absolute; display: block; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico Responsável
                        </div>
                        <div style="position: absolute; display: block; top: 0px; left: 205px;">
                             Tipo de Tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 35px; left: 5px;">
                            Fumigação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 85px; left: 5px;">
                            Higienização
                        </div>
                        <div style="position: absolute; display: block; top: 85px; left: 205px;">
                            Descrição
                        </div>
                        
                        <!--Limpeza com solvente.-->
                    	<div style="position: absolute; display: block; top: 160px; left: 5px; width: 470px; height: 65px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Limpeza com solvente
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Aplicação
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 235px; left: 5px;">
                            Remoção de Adesivos
                        </div>
                        
                        <div style="position: absolute; display: block; top: 280px; left: 5px;">
                            Redução de Manchas
                        </div>
                        
                        <!--Consolidação do Suporte.-->
                    	<div style="position: absolute; display: block; top: 345px; left: 5px; width: 470px; height: 80px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Consolidação do Suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 40px; left: 5px;">
                                Material
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 425px; left: 5px;">
                            Consolidação da imagem / emulsão fotográfica - Descrição
                        </div>
                        
                        
                        <!--Reintegração das partes faltantes do suporte.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reintegração das partes faltantes do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Processo
                            </div>
                        </div>
                        
                        <!--Reintegração Cromática.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reintegração Cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div style="position: absolute; display: block; top: 240px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 340px; left: 480px;">
                            Informações Adicionais do Tratamento
                        </div>
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
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico Responsável
                        </div>
                        <div style="position: absolute; display: block; top: 0px; left: 205px;">
                             Tipo de Tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 35px; left: 5px;">
                            Fumigação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 85px; left: 5px;">
                            Higienização
                        </div>
                        <div style="position: absolute; display: block; top: 85px; left: 205px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 140px; left: 5px;">
                            Remoção de Adesivos
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Teste de solubilidade
                        </div>
                        <div style="position: absolute; display: block; top: 190px; left: 205px;">
                            Observações
                        </div>
                        
                        <!--Fixação.-->
                    	<div style="position: absolute; display: block; top: 330px; left: 5px; width: 470px; height: 70px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Fixação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Solúvel em
                            </div>
                            
                            <div style="position: absolute; display: block; top: 30px; left: 5px;">
                                Forma de Aplicação
                            </div>
                            <div style="position: absolute; display: block; top: 30px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 5px;">
                            pH antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 420px; left: 205px;">
                            pH após tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 450px; left: 5px;">
                            Espessura antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 450px; left: 205px;">
                            Espessura após tratamento
                        </div>
                        
                        
                        <!--Tratamento Aquoso.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Tratamento aquoso
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Água
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                        </div>
                        
                        <!--Desacidificação.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 115px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Desacidificação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de Desacidificação
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 75px;">
                                Dropdown
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Produto
                            </div>
                        </div>
                        
                        <!--Clareamento.-->
                    	<div style="position: absolute; display: block; top: 260px; left: 480px; width: 470px; height: 150px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Clareamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto Clareante
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Neutralização
                            </div>
                            <div style="position: absolute; display: block; top: 45px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 480px;">
                            Reencolagem
                        </div>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
                        <!--Consolidação do suporte.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Consolidação do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Material
                            </div>
                        </div>
                        
                        <!--Reitegração do suporte.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Processo
                            </div>
                        </div>
                        
                        <!--Reitegração cromática.-->
                    	<div style="position: absolute; display: block; top: 230px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div style="position: absolute; display: block; top: 335px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 0px; left: 480px;">
                            Informações adicionais do tratamento
                        </div>

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
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico Responsável
                        </div>
                        <div style="position: absolute; display: block; top: 0px; left: 205px;">
                             Tipo de Tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 35px; left: 5px;">
                            Fumigação
                        </div>
                        
                        <div style="position: absolute; display: block; top: 85px; left: 5px;">
                            Higienização
                        </div>
                        <div style="position: absolute; display: block; top: 85px; left: 205px;">
                            Descrição
                        </div>
                        
                        <div style="position: absolute; display: block; top: 140px; left: 5px;">
                            Remoção de Adesivos
                        </div>
                        
                        <div style="position: absolute; display: block; top: 190px; left: 5px;">
                            Teste de solubilidade
                        </div>
                        <div style="position: absolute; display: block; top: 190px; left: 205px;">
                            Observações
                        </div>
                        
                        <!--Fixação.-->
                    	<div style="position: absolute; display: block; top: 330px; left: 5px; width: 470px; height: 70px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Fixação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Solúvel em
                            </div>
                            
                            <div style="position: absolute; display: block; top: 30px; left: 5px;">
                                Forma de Aplicação
                            </div>
                            <div style="position: absolute; display: block; top: 30px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 5px;">
                            pH antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 420px; left: 205px;">
                            pH após tratamento
                        </div>
                        
                        <div style="position: absolute; display: block; top: 450px; left: 5px;">
                            Espessura antes do tratamento
                        </div>
                        <div style="position: absolute; display: block; top: 450px; left: 205px;">
                            Espessura após tratamento
                        </div>
                        
                        
                        <!--Tratamento Aquoso.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 480px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Tratamento aquoso
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Água
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                        </div>
                        
                        <!--Desacidificação.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 480px; width: 470px; height: 115px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Desacidificação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de Desacidificação
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 75px;">
                                Dropdown
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Técnica
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Produto
                            </div>
                        </div>
                        
                        <!--Clareamento.-->
                    	<div style="position: absolute; display: block; top: 260px; left: 480px; width: 470px; height: 150px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Clareamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Produto Clareante
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Neutralização
                            </div>
                            <div style="position: absolute; display: block; top: 45px; left: 205px;">
                                Aplicação
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 420px; left: 480px;">
                            Reencolagem
                        </div>
                    </div>
                    
                    <!--Parte 2.-->
                    <div id="divTratamentoParte2" style="position: absolute; display: none; top: 20px; left: 5px; width: 955px; height: 505px; border: 1px solid #000000;">
                        <!--Consolidação do suporte.-->
                    	<div style="position: absolute; display: block; top: 20px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Consolidação do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Material
                            </div>
                        </div>
                        
                        <!--Reitegração do suporte.-->
                    	<div style="position: absolute; display: block; top: 125px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração do suporte
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Técnica
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                            
                            <div style="position: absolute; display: block; top: 45px; left: 5px;">
                                Processo
                            </div>
                        </div>
                        
                        <!--Reitegração cromática.-->
                    	<div style="position: absolute; display: block; top: 230px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Reitegração cromática
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <!--Aplanamento.-->
                    	<div style="position: absolute; display: block; top: 335px; left: 5px; width: 470px; height: 90px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Aplanamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            <div style="position: absolute; display: block; top: 0px; left: 205px;">
                                Descrição
                            </div>
                        </div>
                        
                        <div style="position: absolute; display: block; top: 0px; left: 480px;">
                            Informações adicionais do tratamento
                        </div>

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
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico responsável
                        </div>
                        
                        <div style="position: absolute; display: block; top: 45px; left: 5px;">
                            Montagem / Embalagem
                        </div>
                        <div style="position: absolute; display: block; top: 45px; left: 240px;">
                            Material
                        </div>
                        
                        <div style="position: absolute; display: block; top: 120px; left: 5px;">
                            Dimensões
                        </div>
                        
                        <div style="position: absolute; display: block; top: 160px; left: 5px;">
                            Informações Adicionais
                        </div>
                    </div>
                    <?php } ?>
                    <!--Livro.-->
                    
                    
                    <!--Diplomas.-->
                    <?php if($idTipoProduto == "3483"){ ?>
                    <div style="position: relative; display: none;">
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico responsável
                        </div>
                        
                        <!--Acondicionamento.-->
                        <div style="position: absolute; display: block; top: 60px; left: 5px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Acondicionamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Material
                            </div>
                            
                            <div style="position: absolute; display: block; top: 150px; left: 5px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        
                        <!--Montagem.-->
                        <div style="position: absolute; display: block; top: 30px; left: 490px; width: 470px; height: 490px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de moldura
                            </div>
                            
                            <div style="position: absolute; display: block; top: 35px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 230px;">
                                Proteção frontal
                            </div>
                            
                            <div style="position: absolute; display: block; top: 105px; left: 5px;">
                                Proteção do verso
                            </div>
                            <div style="position: absolute; display: block; top: 105px; left: 230px;">
                                Tipo de montagem
                            </div>
                            
                            <!--Passe-partout.-->
                            <div style="position: absolute; display: block; top: 180px; left: 10px; width: 450px; height: 75px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Passe-partout
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Material
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Dimensões
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 260px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--Diplomas.-->
                    
                    
                    <!--Documentos.-->
                    <?php if($idTipoProduto == "3484"){ ?>
                    <div style="position: relative; display: none;">
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico responsável
                        </div>
                        
                        <!--Acondicionamento.-->
                        <div style="position: absolute; display: block; top: 60px; left: 5px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Acondicionamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Material
                            </div>
                            
                            <div style="position: absolute; display: block; top: 150px; left: 5px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        
                        <!--Montagem.-->
                        <div style="position: absolute; display: block; top: 30px; left: 490px; width: 470px; height: 490px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de moldura
                            </div>
                            
                            <div style="position: absolute; display: block; top: 35px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 230px;">
                                Proteção frontal
                            </div>
                            
                            <div style="position: absolute; display: block; top: 105px; left: 5px;">
                                Proteção do verso
                            </div>
                            <div style="position: absolute; display: block; top: 105px; left: 230px;">
                                Tipo de montagem
                            </div>
                            
                            <!--Passe-partout.-->
                            <div style="position: absolute; display: block; top: 180px; left: 10px; width: 450px; height: 75px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Passe-partout
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Material
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Dimensões
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 260px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--Documentos.-->
                    
                    
                    <!--Fotografia.-->
                    <?php if($idTipoProduto == "3485"){ ?>
                    <div style="position: relative; display: block;">
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico responsável
                        </div>
                        
                        <!--Acondicionamento.-->
                        <div style="position: absolute; display: block; top: 60px; left: 5px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Acondicionamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Material
                            </div>
                            
                            <div style="position: absolute; display: block; top: 150px; left: 5px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        
                        <!--Montagem.-->
                        <div style="position: absolute; display: block; top: 30px; left: 490px; width: 470px; height: 490px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de moldura
                            </div>
                            
                            <div style="position: absolute; display: block; top: 35px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 230px;">
                                Proteção frontal
                            </div>
                            
                            <div style="position: absolute; display: block; top: 105px; left: 5px;">
                                Proteção do verso
                            </div>
                            <div style="position: absolute; display: block; top: 105px; left: 230px;">
                                Tipo de montagem
                            </div>
                            
                            <!--Passe-partout.-->
                            <div style="position: absolute; display: block; top: 180px; left: 10px; width: 450px; height: 75px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Passe-partout
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Material
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Dimensões
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 260px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--Fotografia.-->
                    
                    
                    <!--Mapas.-->
                    <?php if($idTipoProduto == "3487"){ ?>
                    <div style="position: relative; display: block;">
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico responsável
                        </div>
                        
                        <!--Acondicionamento.-->
                        <div style="position: absolute; display: block; top: 60px; left: 5px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Acondicionamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Material
                            </div>
                            
                            <div style="position: absolute; display: block; top: 150px; left: 5px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        
                        <!--Montagem.-->
                        <div style="position: absolute; display: block; top: 30px; left: 490px; width: 470px; height: 490px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de moldura
                            </div>
                            
                            <div style="position: absolute; display: block; top: 35px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 230px;">
                                Proteção frontal
                            </div>
                            
                            <div style="position: absolute; display: block; top: 105px; left: 5px;">
                                Proteção do verso
                            </div>
                            <div style="position: absolute; display: block; top: 105px; left: 230px;">
                                Tipo de montagem
                            </div>
                            
                            <!--Passe-partout.-->
                            <div style="position: absolute; display: block; top: 180px; left: 10px; width: 450px; height: 75px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Passe-partout
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Material
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Dimensões
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 260px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--Mapas.-->
                    
                    
                    <!--Obras de Arte.-->
                    <?php if($idTipoProduto == "3488"){ ?>
                    <div style="position: relative; display: block;">
                        <div style="position: absolute; display: block; top: 0px; left: 5px;">
                            Técnico responsável
                        </div>
                        
                        <!--Acondicionamento.-->
                        <div style="position: absolute; display: block; top: 60px; left: 5px; width: 470px; height: 460px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Acondicionamento
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo
                            </div>
                            
                            <div style="position: absolute; display: block; top: 75px; left: 5px;">
                                Material
                            </div>
                            
                            <div style="position: absolute; display: block; top: 150px; left: 5px;">
                                Dimensões
                            </div>
                            
                            <div style="position: absolute; display: block; top: 180px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                        
                        
                        <!--Montagem.-->
                        <div style="position: absolute; display: block; top: 30px; left: 490px; width: 470px; height: 490px; border: 1px solid #c31907;">
                            <!--sub títulos.-->
                            <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                Montagem
                            </div>
                            
                            <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                Tipo de moldura
                            </div>
                            
                            <div style="position: absolute; display: block; top: 35px; left: 5px;">
                                Material
                            </div>
                            <div style="position: absolute; display: block; top: 35px; left: 230px;">
                                Proteção frontal
                            </div>
                            
                            <div style="position: absolute; display: block; top: 105px; left: 5px;">
                                Proteção do verso
                            </div>
                            <div style="position: absolute; display: block; top: 105px; left: 230px;">
                                Tipo de montagem
                            </div>
                            
                            <!--Passe-partout.-->
                            <div style="position: absolute; display: block; top: 180px; left: 10px; width: 450px; height: 75px; border: 1px solid #000000;">
                                <!--sub títulos.-->
                                <div style="position: absolute; display: block; top: -15px; left: 0px;">
                                    Passe-partout
                                </div>
                                
                                <div style="position: absolute; display: block; top: 0px; left: 5px;">
                                    Material
                                </div>
                                <div style="position: absolute; display: block; top: 0px; left: 240px;">
                                    Dimensões
                                </div>
                            </div>
                            
                            <div style="position: absolute; display: block; top: 260px; left: 5px;">
                                Descrição
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--Obras de Arte.-->
                </div>
                <!--Acondicionamento.-->

                <!--Informações Complementares.-->
                <div id="divInfo5" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <div style="position: absolute; display: block; top: 0px; left: 5px;">
                        Arquivos
                    </div>
                    <div style="position: absolute; display: block; top: 270px; left: 5px;">
                        Botões
                    </div>
                    
                    <div style="position: absolute; display: block; top: 20px; left: 295px; width: 665px; height: 505px; border: 1px solid #000000;">
                    
                    </div>
                </div>
                <!--Informações Complementares.-->

                <!--Fotos.-->
                <div id="divInfo6" class="CadastroDetalhesConteudo AdmTbFundoClaro AdmTexto01" style="position: relative; display: none; height: 535px; border: 1px solid #000000;">
                    <div style="position: absolute; display: block; top: 0px; left: 5px;">
                        Técnico responsável
                    </div>
                    <div style="position: absolute; display: block; top: 50px; left: 5px;">
                        Arquivos
                    </div>
                    <div style="position: absolute; display: block; top: 330px; left: 5px;">
                        Botões
                    </div>
                    
                    <div style="position: absolute; display: block; top: 20px; left: 295px; width: 665px; height: 505px; border: 1px solid #000000;">
                    
                    </div>
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