<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbPaginas = $_GET["idTbPaginas"];
$idParentPaginas = DbFuncoes::GetCampoGenerico01($idTbPaginas, "tb_paginas", "id_parent");

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


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
	<?php echo htmlentities($GLOBALS['configTituloSite']); ?> - <?php echo $tbPaginasTitulo; ?>
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
	<?php echo $tbPaginasTitulo; ?>
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


	<?php //Diagramação 01.?>
    <?php //**************************************************************************************?>
	<div align="center" style="position: relative; display: block;">
		<?php //Imagem Principal.?>
        <?php if($tbPaginasImagem <> ""){ ?>
            <div align="center">
                <?php //SlimBox 2 - JQuery.?>
                <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                    <div class="PaginasImagemDetalhes"><a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbPaginasImagem;?>" rel="lightbox" title="<?php echo $tbPaginasTitulo; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $tbPaginasImagem;?>" alt="<?php echo $tbPaginasTitulo; ?>" /></a></div>
                <?php } ?>
                
                <?php //Pop-up div com comentários.?>
                <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>

                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php //**************************************************************************************?>


	<?php //Diagramação 03 - Tabela.?>
    <?php //**************************************************************************************?>
	<div align="center" style="position: relative; display: none;">
        <table class="AdmTabelaDados01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginasTbPaginasDetalhes"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPaginasVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo1Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
						<?php if(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbPaginasIdTbCadastro1;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
						<?php if(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbPaginasIdTbCadastro2;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
						<?php if(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro3, "tb_cadastro", "id") <> ""){ ?>
                            <a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $tbPaginasIdTbCadastro3;?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
                                <?php //echo Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($linhaTarefas['id_parent'], "tb_cadastro", "nome"); ?>
                                <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro3, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro3, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbPaginasIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 1)); ?>
                            </a>
						<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePagina"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="PaginasDetalhesConteudo">
						<?php echo $tbPaginasTitulo; ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePaginaDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasDescricao; ?>
                    </div>
                </td>
            </tr>

            <?php if($GLOBALS['habilitarPaginasURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasURL1Titulo']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="PaginasDetalhesConteudo">
                    	<a href="<?php echo $tbPaginasURL1; ?>" target="_blank" class="AdmLinks01">
                        	<?php echo $tbPaginasURL1; ?>
                        </a>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "12", "", ",", "", "1"));
						$arrPaginasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 12);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico01); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico01[$countArray][0], $arrPaginasFiltroGenerico01Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico01[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "13", "", ",", "", "1"));
						$arrPaginasFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 13);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico02); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico02[$countArray][0], $arrPaginasFiltroGenerico02Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico02[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "14", "", ",", "", "1"));
						$arrPaginasFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 14);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico03); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico03[$countArray][0], $arrPaginasFiltroGenerico03Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico03[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarPaginasFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "15", "", ",", "", "1"));
						$arrPaginasFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 15);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico04); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico04[$countArray][0], $arrPaginasFiltroGenerico04Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico04[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "16", "", ",", "", "1"));
						$arrPaginasFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 16);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico05); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico05[$countArray][0], $arrPaginasFiltroGenerico05Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico05[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "17", "", ",", "", "1"));
						$arrPaginasFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 17);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico06); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico06[$countArray][0], $arrPaginasFiltroGenerico06Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico06[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "18", "", ",", "", "1"));
						$arrPaginasFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 18);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico07); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico07[$countArray][0], $arrPaginasFiltroGenerico07Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico07[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "19", "", ",", "", "1"));
						$arrPaginasFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 19);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico08); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico08[$countArray][0], $arrPaginasFiltroGenerico08Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico08[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "20", "", ",", "", "1"));
						$arrPaginasFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 20);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico09); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico09[$countArray][0], $arrPaginasFiltroGenerico09Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico09[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configPaginasFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php
						//Seleção de ids selecionados para o registro.
						$arrPaginasFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbPaginasId, "tb_paginas_relacao_complemento", "id_tb_paginas", "id_tb_paginas_complemento", "21", "", ",", "", "1"));
						$arrPaginasFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_paginas_complemento", 21);
                        ?>
                        
						<?php 
                        for($countArray = 0; $countArray < count($arrPaginasFiltroGenerico10); $countArray++)
                        {
                        ?>
                            <div>
                                <?php if(in_array($arrPaginasFiltroGenerico10[$countArray][0], $arrPaginasFiltroGenerico10Selecao)){ ?> 
                                    - <?php echo $arrPaginasFiltroGenerico10[$countArray][1];?>
                                <?php } ?>
                            </div>
                        <?php 
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC1;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC2;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC3;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        

            <?php if($GLOBALS['habilitarPaginasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC4;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC5;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC6;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC7;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC8;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC9;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC10;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC11;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC12;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC13;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC14;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarPaginasIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo htmlentities($GLOBALS['configTituloPaginasIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                        <?php echo $tbPaginasIC15;?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPaginasImagem'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="PaginasDetalhesConteudo">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div class="PaginasDetalhesConteudo">
                    	<?php if(!empty($tbPaginasImagem)){ ?>
                            <img src="../<?php echo $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $tbPaginasImagem; ?>?variavelCache=<?php echo date("s"); ?>" alt="<?php echo $tbPaginasImagem; ?>" style="margin-left: 4px;" />
                    	<?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php //**************************************************************************************?>


	<?php //Conteúdo.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeConteudo_idParentConteudo = $tbPaginasId;
	$includeConteudo_idTbConteudo = "";
	$includeConteudo_tipoConteudo = "";
	
	$includeConteudo_configTipoDiagramacao = "1";
	$includeConteudo_configConteudoNRegistros = "";
	$includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
	?>
    
    <?php include "IncludeConteudo.php";?>
    <?php //----------------------?>
    
    
	<?php //Formulário.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeFormularios_idTbFormularios = $_GET["idTbFormularios"];
	$includeFormularios_configTipoDiagramacao = "1";
	?>
    
    <?php include "IncludeFormularios.php";?>
    <?php //----------------------?>

    
	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbPaginasId;
	$includeArquivosImagens_tipoVisualizacao = "1";
	
	$includeArquivosImagens_limiteRegistros = "";
	$includeArquivosImagens_nImagensVisivelScroll = "3";
	$includeArquivosImagens_configImagemZoom = "1";
	?>
    
    <?php include "IncludeArquivosImagens.php";?>
    <?php //----------------------?>
    
    
	<?php //Arquivos complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivos_idTbArquivos = $tbPaginasId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
    
    
	<?php //Processos vinculados.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeProcessos_idParentProcessos = $tbPaginasId;
	$includeProcessos_idsTbProcessos = "";
	
	$includeProcessos_idTbCadastro1 = "";
	$includeProcessos_idsTbCadastro1 = "";
	
	$includeProcessos_configTipoDiagramacao = "1";
	$includeProcessos_configProcessosNRegistros = "";
	$includeProcessos_configClassificacaoProcessos = "";
	?>
    
    <?php include "IncludeProcessos.php";?>
    <?php //----------------------?>
    
    
    <div align="center">
        <br />
		<a href="javascript:history.go(-1);">
			<img src="img/btoVoltar.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>" />
		</a>
    </div>
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