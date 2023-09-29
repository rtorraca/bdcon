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
$idTbPaginas = $_GET["idTbPaginas"];
$idParentPaginas = DbFuncoes::GetCampoGenerico01($idTbPaginas, "tb_paginas", "id_parent");

$paginaRetorno = "SiteAdmPaginasIndice.php";
$paginaRetornoExclusao = "SiteAdmPaginasEditar.php";
$variavelRetorno = "idTbPaginas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentPaginas=" . $idParentPaginas . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlPaginasDetalhesSelect = "";
$strSqlPaginasDetalhesSelect .= "SELECT ";
//$strSqlPaginasDetalhesSelect .= "* ";
$strSqlPaginasDetalhesSelect .= "id, ";
$strSqlPaginasDetalhesSelect .= "id_parent, ";
$strSqlPaginasDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlPaginasDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlPaginasDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlPaginasDetalhesSelect .= "n_classificacao, ";
$strSqlPaginasDetalhesSelect .= "data_criacao, ";
$strSqlPaginasDetalhesSelect .= "titulo, ";
$strSqlPaginasDetalhesSelect .= "descricao, ";
$strSqlPaginasDetalhesSelect .= "palavras_chave, ";
$strSqlPaginasDetalhesSelect .= "url1, ";
$strSqlPaginasDetalhesSelect .= "url2, ";
$strSqlPaginasDetalhesSelect .= "url3, ";
$strSqlPaginasDetalhesSelect .= "url4, ";
$strSqlPaginasDetalhesSelect .= "url5, ";
$strSqlPaginasDetalhesSelect .= "imagem, ";
$strSqlPaginasDetalhesSelect .= "arquivo1, ";
$strSqlPaginasDetalhesSelect .= "arquivo2, ";
$strSqlPaginasDetalhesSelect .= "arquivo3, ";
$strSqlPaginasDetalhesSelect .= "arquivo4, ";
$strSqlPaginasDetalhesSelect .= "arquivo5, ";

$strSqlPaginasDetalhesSelect .= "informacao_complementar1, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar2, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar3, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar4, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar5, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar6, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar7, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar8, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar9, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar10, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar11, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar12, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar13, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar14, ";
$strSqlPaginasDetalhesSelect .= "informacao_complementar15, ";

$strSqlPaginasDetalhesSelect .= "ativacao, ";
$strSqlPaginasDetalhesSelect .= "ativacao1, ";
$strSqlPaginasDetalhesSelect .= "ativacao2, ";
$strSqlPaginasDetalhesSelect .= "ativacao3, ";
$strSqlPaginasDetalhesSelect .= "ativacao4, ";

$strSqlPaginasDetalhesSelect .= "n_visitas, ";
$strSqlPaginasDetalhesSelect .= "acesso_restrito ";
$strSqlPaginasDetalhesSelect .= "FROM tb_paginas ";
$strSqlPaginasDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlPaginasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlPaginasDetalhesSelect .= "AND id = :id ";
//$strSqlPaginasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementPaginasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPaginasDetalhesSelect);

if ($statementPaginasDetalhesSelect !== false)
{
	$statementPaginasDetalhesSelect->execute(array(
		"id" => $idTbPaginas
	));
}

//$resultadoPaginasDetalhes = $dbSistemaConPDO->query($strSqlPaginasDetalhesSelect);
$resultadoPaginasDetalhes = $statementPaginasDetalhesSelect->fetchAll();

if (empty($resultadoPaginasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoPaginasDetalhes as $linhaPaginasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbPaginasId = $linhaPaginasDetalhes['id'];
		$tbPaginasIdParent = $linhaPaginasDetalhes['id_parent'];
		
		$tbPaginasIdTbCadastro1 = $linhaPaginasDetalhes['id_tb_cadastro1'];
		$tbPaginasIdTbCadastro2 = $linhaPaginasDetalhes['id_tb_cadastro2'];
		$tbPaginasIdTbCadastro3 = $linhaPaginasDetalhes['id_tb_cadastro3'];
		
		$tbPaginasNClassificacao = $linhaPaginasDetalhes['n_classificacao'];
		$tbPaginasDataCriacao = Funcoes::DataLeitura01($linhaPaginasDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
		$tbPaginasTitulo = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['titulo']);
		$tbPaginasDescricao = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['descricao']);
		$tbPaginasPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['palavras_chave']);
		$tbPaginasURL1 = $linhaPaginasDetalhes['url1'];
		$tbPaginasURL2 = $linhaPaginasDetalhes['url2'];
		$tbPaginasURL3 = $linhaPaginasDetalhes['url3'];
		$tbPaginasURL4 = $linhaPaginasDetalhes['url4'];
		$tbPaginasURL5 = $linhaPaginasDetalhes['url5'];
		$tbPaginasImagem = $linhaPaginasDetalhes['imagem'];
		$tbPaginasArquivo1 = $linhaPaginasDetalhes['arquivo1'];
		$tbPaginasArquivo2 = $linhaPaginasDetalhes['arquivo2'];
		$tbPaginasArquivo3 = $linhaPaginasDetalhes['arquivo3'];
		$tbPaginasArquivo4 = $linhaPaginasDetalhes['arquivo4'];
		$tbPaginasArquivo5 = $linhaPaginasDetalhes['arquivo5'];
		
		$tbPaginasIC1 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar1']);
		$tbPaginasIC2 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar2']);
		$tbPaginasIC3 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar3']);
		$tbPaginasIC4 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar4']);
		$tbPaginasIC5 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar5']);
		$tbPaginasIC6 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar6']);
		$tbPaginasIC7 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar7']);
		$tbPaginasIC8 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar8']);
		$tbPaginasIC9 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar9']);
		$tbPaginasIC10 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar10']);
		$tbPaginasIC11 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar11']);
		$tbPaginasIC12 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar12']);
		$tbPaginasIC13 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar13']);
		$tbPaginasIC14 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar14']);
		$tbPaginasIC15 = Funcoes::ConteudoMascaraLeitura($linhaPaginasDetalhes['informacao_complementar15']);

		$tbPaginasAtivacao = $linhaPaginasDetalhes['ativacao'];
		$tbPaginasAtivacao1 = $linhaPaginasDetalhes['ativacao1'];
		$tbPaginasAtivacao2 = $linhaPaginasDetalhes['ativacao2'];
		$tbPaginasAtivacao3 = $linhaPaginasDetalhes['ativacao3'];
		$tbPaginasAtivacao4 = $linhaPaginasDetalhes['ativacao4'];
		
		$tbPaginasNVisitas = $linhaPaginasDetalhes['n_visitas'];
		$tbPaginasAcessoRestrito = $linhaPaginasDetalhes['acesso_restrito'];
		
		
		//Verificação de erro.
		//echo "tbPaginasId=" . $tbPaginasId . "<br>";
		//echo "tbPaginasTitulo=" . $tbPaginasTitulo . "<br>";
		//echo "tbPaginasAtivacao=" . $tbPaginasAtivacao . "<br>";
	}
}
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasTituloEditar"); ?>
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
		
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formPaginasEditar').validate({ //Inicialização do plug-in.
			
			
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
					n_classificacao: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
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
    <form name="formPaginasEditar" id="formPaginasEditar" action="SiteAdmPaginasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasTbPaginasEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo1'], $GLOBALS['configIdTbTipoPaginasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo1'], $GLOBALS['configPaginasVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbPaginasIdTbPaginas1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasVinculo1); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPaginasVinculo1[$countArray][0];?>"<?php if($arrPaginasVinculo1[$countArray][0] == $tbPaginasIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasVinculo1[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo2'], $GLOBALS['configIdTbTipoPaginasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo2'], $GLOBALS['configPaginasVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbPaginasIdTbPaginas2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPaginasVinculo2[$countArray][0];?>"<?php if($arrPaginasVinculo2[$countArray][0] == $tbPaginasIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasVinculo2[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrPaginasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbPaginasVinculo3'], $GLOBALS['configIdTbTipoPaginasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoPaginasVinculo3'], $GLOBALS['configPaginasVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbPaginasIdTbPaginas3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrPaginasVinculo3[$countArray][0];?>"<?php if($arrPaginasVinculo3[$countArray][0] == $tbPaginasIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasVinculo3[$countArray][1];?></option>
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
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePagina"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarPaginasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="titulo" id="titulo" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasTitulo; ?>" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarPaginasNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbPaginasNClassificacao; ?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>

            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginaDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasDescricao; ?></textarea>
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
                            <textarea name="descricao" id="descricao"><?php echo $tbPaginasDescricao; ?></textarea>
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
                            <textarea name="descricao" id="descricao"><?php echo $tbPaginasDescricao; ?></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarPaginasPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasPalavrasChave; ?></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasURL1Titulo']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url1" id="url1" class="CampoTextoMultilinhaURL"><?php echo $tbPaginasURL1; ?></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							//echo "FiltrosGenericosSelect03=" . FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "12", "", ",", "", "1") . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "12", "", ",", "", "1") . "<br />";
							//FiltrosGenericosSelect03($idRegistro, $srtTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
							//FiltrosGenericosSelect03($idRegistro, $strTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
							
							$arrPaginasFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "12", "", ",", "", "1"));
							//echo "arrPaginasFiltroGenerico01Selecao=" . $arrPaginasFiltroGenerico01Selecao[0] . "<br />";
							//echo "in_array=" . in_array("03", $arrPaginasFiltroGenerico01Selecao) . "<br />";
						
                            //echo "arrPaginasFiltroGenerico01Selecao=" . $arrPaginasFiltroGenerico01Selecao . "<br />";
                            //echo "arrPaginasFiltroGenerico01Selecao[0]=" . $arrPaginasFiltroGenerico01Selecao[0] . "<br />";
						?>
                    
						<?php 
                            $arrPaginasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico01[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico01[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico01[$countArray][0], $arrPaginasFiltroGenerico01Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico01[]" name="idsPaginasFiltroGenerico01[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico01[$countArray][0], $arrPaginasFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico01[]" name="idsPaginasFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico01[$countArray][0], $arrPaginasFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico01)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "13", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPaginasFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 13);
                            //echo "arrPaginasFiltroGenerico02Selecao=" . $arrPaginasFiltroGenerico02Selecao . "<br />";
                            //echo "arrPaginasFiltroGenerico02Selecao[0]=" . $arrPaginasFiltroGenerico02Selecao[0] . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbPaginasId=" . $tbPaginasId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico02[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico02[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico02[$countArray][0], $arrPaginasFiltroGenerico02Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico02[]" name="idsPaginasFiltroGenerico02[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico02[$countArray][0], $arrPaginasFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico02[]" name="idsPaginasFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico02[$countArray][0], $arrPaginasFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico02)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "14", "", ",", "", "1"));
						?>

						<?php 
                            $arrPaginasFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico03[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico03[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico03[$countArray][0], $arrPaginasFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico03[]" name="idsPaginasFiltroGenerico03[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico03[$countArray][0], $arrPaginasFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico03[]" name="idsPaginasFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico03[$countArray][0], $arrPaginasFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico03)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarPaginasFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "15", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPaginasFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico04[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico04[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico04[$countArray][0], $arrPaginasFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico04[]" name="idsPaginasFiltroGenerico04[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico04[$countArray][0], $arrPaginasFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico04[]" name="idsPaginasFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico04[$countArray][0], $arrPaginasFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico04)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "16", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPaginasFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico05[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico05[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico05[$countArray][0], $arrPaginasFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico05[]" name="idsPaginasFiltroGenerico05[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico05[$countArray][0], $arrPaginasFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico05[]" name="idsPaginasFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico05[$countArray][0], $arrPaginasFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico05)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "17", "", ",", "", "1"));
						?>

						<?php 
                            $arrPaginasFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico06[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico06[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico06[$countArray][0], $arrPaginasFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico06[]" name="idsPaginasFiltroGenerico06[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico06[$countArray][0], $arrPaginasFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico06[]" name="idsPaginasFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico06[$countArray][0], $arrPaginasFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico06)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "18", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPaginasFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico07[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico07[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico07[$countArray][0], $arrPaginasFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico07[]" name="idsPaginasFiltroGenerico07[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico07[$countArray][0], $arrPaginasFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico07[]" name="idsPaginasFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico07[$countArray][0], $arrPaginasFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico07)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "19", "", ",", "", "1"));
						?>

						<?php 
                            $arrPaginasFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico08[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico08[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico08[$countArray][0], $arrPaginasFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico08[]" name="idsPaginasFiltroGenerico08[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico08[$countArray][0], $arrPaginasFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico08[]" name="idsPaginasFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico08[$countArray][0], $arrPaginasFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico08)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "20", "", ",", "", "1"));
						?>

						<?php 
                            $arrPaginasFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico09[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico09[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico09[$countArray][0], $arrPaginasFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico09[]" name="idsPaginasFiltroGenerico09[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico09[$countArray][0], $arrPaginasFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico09[]" name="idsPaginasFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico09[$countArray][0], $arrPaginasFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico09)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrPaginasFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "21", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrPaginasFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configPaginasFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsPaginasFiltroGenerico10[]" type="checkbox" value="<?php echo $arrPaginasFiltroGenerico10[$countArray][0];?>" class="CampoCheckBox01"<?php if(in_array($arrPaginasFiltroGenerico10[$countArray][0], $arrPaginasFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrPaginasFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsPaginasFiltroGenerico10[]" name="idsPaginasFiltroGenerico10[]" size="5" multiple="multiple" class="CampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrPaginasFiltroGenerico10[$countArray][0], $arrPaginasFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrPaginasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsPaginasFiltroGenerico10[]" name="idsPaginasFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrPaginasFiltroGenerico10[$countArray][0];?>"><?php echo $arrPaginasFiltroGenerico10[$countArray][1];?></option>

                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrPaginasFiltroGenerico10)){ ?>
                        	<a href="PaginasManutencao.php" class="AdmLinks01" style="display: none;">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC1;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC1;?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPaginasIC1;?></textarea>
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
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbPaginasIC1;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC2;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC2;?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPaginasIC2;?></textarea>
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
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbPaginasIC2;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC3;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC3;?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPaginasIC3;?></textarea>
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
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbPaginasIC3;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        

            <?php if($GLOBALS['habilitarPaginasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC4;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC4;?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPaginasIC4;?></textarea>
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
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbPaginasIC4;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC5;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC5;?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPaginasIC5;?></textarea>
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
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbPaginasIC5;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc6'] == 1){ ?>
                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC6;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC6;?></textarea>
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
                                <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbPaginasIC6;?></textarea>
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
                                <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbPaginasIC6;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC7;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc2'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC7;?></textarea>
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
                                <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbPaginasIC7;?></textarea>
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
                                <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbPaginasIC7;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC8;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC8;?></textarea>
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
                                <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbPaginasIC8;?></textarea>
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
                                <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbPaginasIC8;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC9;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC9;?></textarea>
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
                                <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbPaginasIC9;?></textarea>
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
                                <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbPaginasIC9;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC10;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC10;?></textarea>
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
                                <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbPaginasIC10;?></textarea>
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
                                <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbPaginasIC10;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbPaginasIC11;?>"/>
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC11;?></textarea>
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
                                <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbPaginasIC11;?></textarea>
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
                                <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbPaginasIC11;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC12;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC12;?></textarea>
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
                                <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbPaginasIC12;?></textarea>
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
                                <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbPaginasIC12;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC13;?>">
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC13;?></textarea>
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
                                <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbPaginasIC13;?></textarea>
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
                                <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbPaginasIC13;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>

                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC14;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC14;?></textarea>
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
                                <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbPaginasIC14;?></textarea>
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
                                <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbPaginasIC14;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configPaginasBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbPaginasIC15;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configPaginasBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"><?php echo $tbPaginasIC15;?></textarea>
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
                                <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbPaginasIC15;?></textarea>
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
                                <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbPaginasIC15;?></textarea>
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
                            <option value="0"<?php if($tbPaginasAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbPaginasAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                <div>
                    <table cellpadding="0" cellspacing="0" style="width: 100%;">
                        <tr>
                            <td width="1">
                                <input type="file" name="ArquivoUpload1" id="ArquivoUpload1" class="AdmCampoArquivoUpload01" />
                            </td>
                            
                            <?php if(!empty($tbPaginasImagem)){ //if($tbCategoriasImagem <> ""){?>
                            <td width="1">
                                <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbPaginasImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbPaginasImagem; ?>" style="margin-left: 4px;" />
                            </td>
                            <td>
                                <a href="SiteAdmRegistrosArquivosExcluirExe.php?idRegistro=<?php echo $tbPaginasId;?>&strTabela=tb_paginas&strCampo=imagem<?php echo $queryPadrao;?>" class="LinksExcluir01" style="margin-left: 4px;">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagemExcluir"); ?>
                                </a>
                            </td>
                            <?php } ?>
                            
                        </tr>
                    </table>
                </div>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbPaginas" type="hidden" id="idTbPaginas" value="<?php echo $tbPaginasId; ?>" />
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbPaginasIdParent; ?>" />
                <input name="n_visitas" type="hidden" id="n_visitas" value="<?php echo $tbPaginasNVisitas; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentPaginas=<?php echo $idParentPaginas; ?>">
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
unset($strSqlPaginasDetalhesSelect);
unset($statementPaginasDetalhesSelect);
unset($resultadoPaginasDetalhes);
unset($linhaPaginasDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>