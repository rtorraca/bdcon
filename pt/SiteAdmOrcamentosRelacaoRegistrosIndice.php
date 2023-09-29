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
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$idCeOrcamentos = $_GET["idCeOrcamentos"];
$idCeOrcamentosFichas = $_GET["idCeOrcamentosFichas"];
//$idCeOrcamentosItens = $_GET["idCeOrcamentosItens"];
$idCeOrcamentosSelecao = $idCeOrcamentos;
if($idCeOrcamentosFichas <> "")
{
	$idCeOrcamentosSelecao = $idCeOrcamentosFichas;
}
//$tipoRegistro = $_GET["tipoRegistro"];
$tipoCategoria = $_GET["tipoCategoria"];

$strTabela = "";
if($tipoCategoria == "2")
{
	$strTabela = "tb_produtos";
}
if($tipoCategoria == "13")
{
	$strTabela = "tb_cadastro";
}
if($tipoCategoria == "26")
{
	$strTabela = "tb_paginas";
}

$idParentCategoriasRaiz = $_GET["idParentCategoriasRaiz"];
if($idParentCategoriasRaiz == "")
{
	$idParentCategoriasRaiz = 0;
}

//$informacaoComplementar1 = (string)$_GET["informacaoComplementar1"]; //Direct cast, para evitar problemas de pesquisa com valores vazios.

$palavraChave = $_GET["palavraChave"];

$tipoDiagramacao = $_GET["tipoDiagramacao"];
if($tipoDiagramacao == "")
{
	$tipoDiagramacao = "1";
}

$paginaRetorno = "SiteAdmOrcamentosRelacaoRegistrosIndice.php";
//$paginaRetornoExclusao = "AulasEditar.php";
//$variavelRetorno = "idItem";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao .
//"&idCeOrcamentosItens=" . $idCeOrcamentosItens .  
$queryPadrao = "&idCeOrcamentos=" . $idCeOrcamentos . 
"&idCeOrcamentosFichas=" . $idCeOrcamentosFichas . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno . 
"&palavraChave=" . $palavraChave;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarAulasSistemaPaginacao=" . $habilitarAulasSistemaPaginacao . "<br />";
//echo "strSqlAulasSelect=" . $strSqlAulasSelect . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItensVinculoTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItensVinculoTitulo"); ?>
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
    
    <?php //Categorias - Diagramação 1. ?>
    <?php if($tipoDiagramacao == "1"){ ?>
		<?php 
        //Query de pesquisa.
        //----------
        $strSqlCategoriasSelect = "";
        $strSqlCategoriasSelect .= "SELECT ";
        $strSqlCategoriasSelect .= "id, ";
        $strSqlCategoriasSelect .= "id_parent, ";
        $strSqlCategoriasSelect .= "id_tb_cadastro_usuario, ";
        $strSqlCategoriasSelect .= "n_classificacao, ";
        $strSqlCategoriasSelect .= "data_categoria, ";
        $strSqlCategoriasSelect .= "categoria, ";
        $strSqlCategoriasSelect .= "descricao, ";
        $strSqlCategoriasSelect .= "informacao_complementar1, ";
        $strSqlCategoriasSelect .= "informacao_complementar2, ";
        $strSqlCategoriasSelect .= "informacao_complementar3, ";
        $strSqlCategoriasSelect .= "informacao_complementar4, ";
        $strSqlCategoriasSelect .= "informacao_complementar5, ";
        $strSqlCategoriasSelect .= "tipo_categoria, ";
        $strSqlCategoriasSelect .= "imagem, ";
        $strSqlCategoriasSelect .= "ativacao, ";
        $strSqlCategoriasSelect .= "acesso_restrito ";	
        $strSqlCategoriasSelect .= "FROM tb_categorias ";
        $strSqlCategoriasSelect .= "WHERE id <> 0 ";
        
        if($idParentCategorias <> "")
        {
            $strSqlCategoriasSelect .= "AND id_parent = :id_parent ";
        }
        if($tipoCategoria <> "")
        {
            $strSqlCategoriasSelect .= "AND tipo_categoria = :tipo_categoria ";
        }
        
        $strSqlCategoriasSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCategorias'] . " ";
        //----------
    
    
        //Criação de componentes.
        //----------
        $statementCategoriasSelect = $dbSistemaConPDO->prepare($strSqlCategoriasSelect);
        
        if ($statementCategoriasSelect !== false)
        {
            if($idParentCategorias <> "")
            {
                $statementCategoriasSelect->bindParam(':id_parent', $idParentCategorias, PDO::PARAM_STR);
            }
            if($tipoCategoria <> "")
            {
                $statementCategoriasSelect->bindParam(':tipo_categoria', $tipoCategoria, PDO::PARAM_STR);
                //$statementCategoriasSelect->bindParam(':tipo_categoria', $tipoRegistro, PDO::PARAM_STR);
            }
            $statementCategoriasSelect->execute();
            
            /*
            $statementCategoriasSelect->execute(array(
                "id_parent" => $idParentCategorias
            ));
            */
        }
    
    
        //$resultadoCategorias = $dbSistemaConPDO->query($strSqlCategoriasSelect);
        $resultadoCategorias = $statementCategoriasSelect->fetchAll();
        //----------
        ?>
        
        
        <?php
        //if(mysqli_num_rows($resultadoCategorias) == 0){ //Verificação se está vazio.
        //if ($resultadoCategorias->fetchColumn() == 0) //Verificação se está vazio.
        if (empty($resultadoCategorias))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
            <div style="position: relative; display: block; overflow: hidden;">
                <form name="formOrcamentosRelacaoRegistrosIndice" id="formOrcamentosRelacaoRegistrosIndice" action="SiteAdmOrcamentosRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                    <input name="idCeOrcamentos" id="idCeOrcamentos" type="hidden" value="<?php echo $idCeOrcamentos; ?>" />
                    <input name="idCeOrcamentosFichas" id="idCeOrcamentosFichas" type="hidden" value="<?php echo $idCeOrcamentosFichas; ?>" />
                    <!--input name="idCeOrcamentosItens" id="idCeOrcamentosItens" type="hidden" value="<?php echo $idCeOrcamentosItens; ?>" /-->
                    <input name="tipoCategoria" id="tipoCategoria" type="hidden" value="<?php echo $tipoCategoria; ?>" />
                    <!--input name="informacaoComplementar1" id="informacaoComplementar1" type="hidden" value="<?php echo $informacaoComplementar1; ?>" /-->
                    <input name="strTabela" id="strTabela" type="hidden" value="<?php echo $strTabela; ?>" />
        
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno; ?>" />
                    
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                    <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                    
                    <table width="100%" class="AdmTabelaDados01">
                      <tr class="AdmTbFundoEscuro">
                      
                        <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                        <td width="50" class="AdmTbFundoEscuro AdmTabelaDados01Celula">
                            <div align="center" class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <td class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCategoriasCategoria"); ?>
                            </div>
                        </td>
                        <td width="30" class="AdmTabelaDados01Celula">
                            <div align="center" class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSelecionarA"); ?>
                            </div>
                        </td>
                      </tr>
                      <?php
                        //Loop pelos resultados.
                        //while($linhaCategorias = mysqli_fetch_array($resultadoCategorias))
                        //foreach ($dbSistemaConPDO->query($strSqlCategoriasSelect) as $linhaCategorias)
                        //while ($linhaCategorias = $statementCategoriasSelect->fetchAll())
                        foreach($resultadoCategorias as $linhaCategorias)
                        {
                            //echo "id=" . $linhaCategorias['id'] . "<br />";
                      ?>
                      <tr class="TbFundoMedio">
                      
                        <?php if($GLOBALS['habilitarCategoriasNClassificacao'] == 1){ ?>
                        <td class="AdmTabelaDados01Celula">
                            <div align="center" class="AdmTexto01">
                                <?php echo $linhaCategorias['n_classificacao'];?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <td colspan="2" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto01">
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);?>
                            </div>
                        </td>
                        <!--td class="AdmTabelaDados01Celula"-->
                            <!--div align="center" class="AdmTexto01"-->
                                <!--input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaCategorias['id'];?>" class="AdmCampoCheckBox01" /-->
                            <!--/div-->
                        <!--/td-->
                      </tr>
                      
                      
                        <?php //Produtos.?>
                        <?php //**************************************************************************************?>
                        <?php if($tipoCategoria == "2"){ ?>
                            <?php
                            //Definição de variáveis.
                            $idParentProdutos = $linhaCategorias['id'];
    
                            //Query de pesquisa.
                            //----------
                            $strSqlProdutosSelect = "";
                            $strSqlProdutosSelect .= "SELECT ";
                            //$strSqlProdutosSelect .= "* ";
                            $strSqlProdutosSelect .= "id, ";
                            $strSqlProdutosSelect .= "id_tb_categorias, ";
                            $strSqlProdutosSelect .= "id_tb_cadastro_usuario, ";
                            $strSqlProdutosSelect .= "data_produto, ";
                            $strSqlProdutosSelect .= "cod_produto, ";
                            $strSqlProdutosSelect .= "n_classificacao, ";
                            $strSqlProdutosSelect .= "produto, ";
                            $strSqlProdutosSelect .= "descricao01, ";
                            $strSqlProdutosSelect .= "descricao02, ";
                            $strSqlProdutosSelect .= "descricao03, ";
                            $strSqlProdutosSelect .= "descricao04, ";
                            $strSqlProdutosSelect .= "descricao05, ";
                            $strSqlProdutosSelect .= "informacao_complementar1, ";
                            $strSqlProdutosSelect .= "informacao_complementar2, ";
                            $strSqlProdutosSelect .= "informacao_complementar3, ";
                            $strSqlProdutosSelect .= "informacao_complementar4, ";
                            $strSqlProdutosSelect .= "informacao_complementar5, ";
                            $strSqlProdutosSelect .= "informacao_complementar6, ";
                            $strSqlProdutosSelect .= "informacao_complementar7, ";
                            $strSqlProdutosSelect .= "informacao_complementar8, ";
                            $strSqlProdutosSelect .= "informacao_complementar9, ";
                            $strSqlProdutosSelect .= "informacao_complementar10, ";
                            $strSqlProdutosSelect .= "informacao_complementar11, ";
                            $strSqlProdutosSelect .= "informacao_complementar12, ";
                            $strSqlProdutosSelect .= "informacao_complementar13, ";
                            $strSqlProdutosSelect .= "informacao_complementar14, ";
                            $strSqlProdutosSelect .= "informacao_complementar15, ";
                            $strSqlProdutosSelect .= "palavras_chave, ";
                            $strSqlProdutosSelect .= "valor, ";
                            $strSqlProdutosSelect .= "valor1, ";
                            $strSqlProdutosSelect .= "valor2, ";
                            $strSqlProdutosSelect .= "peso, ";
                            $strSqlProdutosSelect .= "coeficiente, ";
                            $strSqlProdutosSelect .= "estoque, ";
                            $strSqlProdutosSelect .= "ativacao, ";
                            $strSqlProdutosSelect .= "ativacao_promocao, ";
                            $strSqlProdutosSelect .= "ativacao_home, ";
                            $strSqlProdutosSelect .= "ativacao_home_categoria, ";
                            $strSqlProdutosSelect .= "acesso_restrito, ";
                            $strSqlProdutosSelect .= "n_questoes_aprovacao, ";
                            $strSqlProdutosSelect .= "id_tb_produtos_status, ";
                            $strSqlProdutosSelect .= "imagem, ";
                            $strSqlProdutosSelect .= "anotacoes_internas, ";
                            $strSqlProdutosSelect .= "n_visitas ";
                            $strSqlProdutosSelect .= "FROM tb_produtos ";
                            $strSqlProdutosSelect .= "WHERE id <> 0 ";
                            if($idParentProdutos <> "")
                            {
                                $strSqlProdutosSelect .= "AND id_tb_categorias = :id_tb_categorias ";
                            }
                            $strSqlProdutosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoProdutos'] . " ";
                            //----------
                            
                            
                            //Parâmetros.
                            //----------
                            $statementProdutosSelect = $dbSistemaConPDO->prepare($strSqlProdutosSelect);
                            
                            if ($statementProdutosSelect !== false)
                            {
                                /*
                                $statementProdutosSelect->execute(array(
                                    "id_tb_categorias" => $idParentProdutos
                                ));
                                */
                                if($idParentProdutos <> "")
                                {
                                    $statementProdutosSelect->bindParam(':id_tb_categorias', $idParentProdutos, PDO::PARAM_STR);
                                }
                                $statementProdutosSelect->execute();
                            }
                            //----------
                            
                            //$resultadoProdutos = $dbSistemaConPDO->query($strSqlProdutosSelect);
                            $resultadoProdutos = $statementProdutosSelect->fetchAll();
                            ?>
                            
                            <table class="AdmTabelaDados01" width="100%">
                                <?php
                                if(empty($resultadoProdutos))
                                {
                                    //echo "Nenhum registro encontrado";
                                }else{
                                ?>
                                    <?php
                                    //Seleção.
                                $itensRelacaoRegistrosSelect2 = DbFuncoes::GetCampoGenerico06("ce_orcamentos_relacao_registros", 
                                                                                                "id_registro", 
                                                                                                "id_ce_orcamentos", 
                                                                                                $idCeOrcamentosSelecao, 
                                                                                                "", 
                                                                                                "", 
                                                                                                1, 
                                                                                                "", 
                                                                                                "", 
                                                                                                "", 
                                                                                                "", 
                                                                                                "tipo_relacao", 
                                                                                                "1");
                                    
                                    $arrItensRelacaoRegistrosSelect2 = explode(",", $itensRelacaoRegistrosSelect2);
                                    
                                    
                                    //Loop pelos resultados.
                                    foreach($resultadoProdutos as $linhaProdutos)
                                    {
                                        //echo "id=" . $linhaCategorias['id'] . "<br />";
                                    ?>
                                      <tr class="TbFundoClaro">
                                        <td class="AdmTabelaDados01Celula">
                                            <div class="AdmTexto01" style="padding-left: 20px;">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaProdutos['produto']);?>
                                            </div>
                                            <?php //echo "itensRelacaoRegistrosSelect13=" . $itensRelacaoRegistrosSelect13 . "<br />"; ?>
                                        </td>
                                        
                                        <td width="100" class="AdmTabelaDados01Celula">
                                            <div align="right" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($linhaProdutos['valor'], $GLOBALS['configSistemaMoeda']);?>
                                            </div>
                                        </td>
                                        
                                        <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                                        <td width="1" class="AdmTabelaDados01Celula">
                                            <div align="right" class="AdmTexto01">
                                                
                                                <?php 
                                                $quantidade = "1";
                                                if(in_array($linhaProdutos['id'], $arrItensRelacaoRegistrosSelect2, true) == true)
                                                {
												$quantidade = DbFuncoes::GetCampoGenerico06("ce_orcamentos_relacao_registros", 
																							"quantidade", 
																							"id_ce_orcamentos", 
																							$idCeOrcamentosSelecao, 
																							"", 
																							"", 
																							2, 
																							"", 
																							"", 
																							"", 
																							"", 
																							"id_registro", 
																							$linhaProdutos['id']);
                                                }
                                                ?>
                                                <input type="text" name="quantidade<?php echo $linhaProdutos['id'];?>" id="quantidade<?php echo $linhaProdutos['id'];?>" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $quantidade;?>" />
                                            </div>
                                        </td>
                                        <?php } ?>
    
                                        <td width="30" class="AdmTabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaProdutos['id'];?>" class="AdmCampoCheckBox01"<?php if(in_array($linhaProdutos['id'], $arrItensRelacaoRegistrosSelect2, true) == true){?> checked="checked"<?php } ?> />
                                            </div>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                            
                            <?php
                            //Limpeza de objetos.
                            //----------
                            unset($strSqlProdutosSelect);
                            unset($statementProdutosSelect);
                            unset($resultadoProdutos);
                            unset($linhaProdutos);
                            //----------
                            ?>
                        <?php } ?>
                        <?php //**************************************************************************************?>
                        
                      <?php } ?>
                    </table>
                    
                    <div>
                        <div style="float:left;">
                            <input type="image" name="btoSelecionar" value="Submit" src="img/btoSalvar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSalvar"); ?>" />
                        </div>
                        <div style="float:right;">
							<?php if($idCeOrcamentosFichas <> ""){ ?>
                                <a href="SiteAdmOrcamento.php?idCeOrcamentos=<?php echo $idCeOrcamentos;?>&idCeOrcamentosFichas=<?php echo $idCeOrcamentosFichas;?>&masterPageSiteSelect=<?php echo $masterPageSiteSelect;?>" class="AdmLinks01">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensVoltar"); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    
    
        <?php
        //Limpeza de objetos.
        //----------
        unset($strSqlCategoriasSelect);
        unset($statementCategoriasSelect);
        unset($resultadoCategorias);
        unset($linhaCategorias);
        //----------
        ?>
    <?php } ?>
    
    
    <?php //Diagramação 2 - Listagem de Itens. ?>
    <?php if($tipoDiagramacao == "2"){ ?>
        <div style="position: relative; display: block; overflow: hidden;">
			<?php
            //Query de pesquisa.
            //----------
            $strSqlOrcamentosRelacaoRegistrosSelect = "";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "SELECT ";
            //$strSqlOrcamentosRelacaoRegistrosSelect .= "* ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "id, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "data_atualizacao, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "id_ce_orcamentos, ";
            //$strSqlOrcamentosRelacaoRegistrosSelect .= "id_ce_orcamentos_itens, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "id_registro, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "tipo_registro, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "tipo_categoria, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "tipo_relacao, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "tabela, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "quantidade, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "valor, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "valor1, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "valor2, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao1, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao2, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao3, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "ativacao4, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar1, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar2, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar3, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar4, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "informacao_complementar5, ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "obs ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "FROM ce_orcamentos_relacao_registros ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "WHERE id <> 0 ";
            //$strSqlOrcamentosRelacaoRegistrosSelect .= "AND id_ce_orcamentos_itens = :id_ce_orcamentos_itens ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
            //$strSqlOrcamentosRelacaoRegistrosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
            $strSqlOrcamentosRelacaoRegistrosSelect .= "ORDER BY id ";
            
            $statementOrcamentosRelacaoRegistrosSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosRelacaoRegistrosSelect);
            
            if ($statementOrcamentosRelacaoRegistrosSelect !== false)
            {
                /*
                $statementOrcamentosItensSelect->execute(array(
                    "id_ce_orcamentos" => $idCeOrcamentos
                ));
                */
                /*
                if($idCeOrcamentos <> "")
                {
                    $statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
                }
                */
                //if($GLOBALS['configOrcamentosItens'] == 1)
                //{
                    //$statementOrcamentosRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $linhaOrcamentosItens['id'], PDO::PARAM_STR);
                    //$statementOrcamentosRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $idCeOrcamentosItens, PDO::PARAM_STR);
                //}
                
                $statementOrcamentosRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
                $statementOrcamentosRelacaoRegistrosSelect->execute();
                
            }
            
            //$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosRelacaoRegistrosSelect);
            $resultadoOrcamentosRelacaoRegistros = $statementOrcamentosRelacaoRegistrosSelect->fetchAll();

            ?>
            <?php
            if(empty($resultadoOrcamentosRelacaoRegistros))
            {
                //echo "Nenhum registro encontrado";
            }else{
            ?>	
            	<?php
				//Endereço alternativo: SiteAdmOrcamentosItensRegistrosAcoesExe.php 
				?>
                <form name="formOrcamentosRelacaoRegistrosIndice2" id="formOrcamentosRelacaoRegistrosIndice2" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                    <input name="idCeOrcamentos" id="idCeOrcamentos" type="hidden" value="<?php echo $idCeOrcamentos; ?>" />
                    <input name="idCeOrcamentosFichas" id="idCeOrcamentosFichas" type="hidden" value="<?php echo $idCeOrcamentosFichas; ?>" />
                    <!--input name="idCeOrcamentosItens" id="idCeOrcamentosItens" type="hidden" value="<?php echo $idCeOrcamentosItens; ?>" /-->
                    <input name="tipoCategoria" id="tipoCategoria" type="hidden" value="<?php echo $tipoCategoria; ?>" />
                    <input name="strTabela" id="strTabela" type="hidden" value="ce_orcamentos_relacao_registros" />
        
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno; ?>" />
                    
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    <input name="tipoDiagramacao" id="tipoDiagramacao" type="hidden" value="<?php echo $tipoDiagramacao; ?>" />
                    <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                    <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                    
                    <div style="position:relative; display: block; clear: both;">
                        <div align="right" style="float: right;">
                            <input type="image" name="submit" value="Submit" src="img/btoExcluir.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoExcluir"); ?>">
                        </div>
                    </div>
                    <table class="AdmTabelaDados01" width="100%">
                        <tr class="AdmTbFundoEscuro">
							<?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                            <td width="100" class="AdmTabelaDados01Celula">
                                <div align="left" class="AdmTexto02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                                </div>
                            </td>
                            <?php } ?>

                            <td width="100" class="AdmTabelaDados01Celula">
                                <div align="left" class="AdmTexto02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                                </div>
                            </td>
                            
                            <td width="50" class="AdmTabelaDados01Celula">
                                <div align="right" class="AdmTexto02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>
                                </div>
                            </td>
                            
                            <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                            <td width="20" class="AdmTabelaDados01Celula">
                                <div align="center" class="AdmTexto02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensQuantidadeA"); ?>
                                </div>
                            </td>
                            
                            <td width="20" class="AdmTabelaDados01Celula">
                                <div align="right" class="AdmTexto02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensValorSubtotal"); ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <td width="30" class="AdmTabelaDados01Celula">
                                <div align="center" class="AdmTexto02">
                                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                                </div>
                            </td>
                        </tr>
                        
                        <?php
                        //Loop pelos resultados.
                        foreach($resultadoOrcamentosRelacaoRegistros as $linhaOrcamentosRelacaoRegistros)
                        {
							$tbProdutosProduto = "";
							$tbProdutosProduto = DbFuncoes::GetCampoGenerico01($linhaOrcamentosRelacaoRegistros["id_registro"], "tb_produtos", "produto");
							
							$tbProdutosImagem = "";
							$tbProdutosImagem = DbFuncoes::GetCampoGenerico01($linhaOrcamentosRelacaoRegistros["id_registro"], "tb_produtos", "imagem");

                            $tbProdutosValor = 0;
                            $tbProdutosValor = DbFuncoes::GetCampoGenerico01($linhaOrcamentosRelacaoRegistros["id_registro"], "tb_produtos", "valor");
                            
                            //Valor total.
                            if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1)
                            {
                                $orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + ($linhaOrcamentosRelacaoRegistros["quantidade"] * $tbProdutosValor);
                            }else{
                                $orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + $tbProdutosValor;
                            }
                            
                            //Quantidade de itens.
                            $orcamentosItensRelacaoRegistrosQtdTotal = $orcamentosItensRelacaoRegistrosQtdTotal + $linhaOrcamentosRelacaoRegistros["quantidade"];
                        ?>
                        
                            <div style="position: relative; display: none; margin-bottom: 15px;">
                                <div>
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>: 
                                    </strong>
                                    <?php echo DbFuncoes::GetCampoGenerico01($linhaOrcamentosRelacaoRegistros["id_registro"], "tb_produtos", "produto"); ?>
                                </div>
                                <div>
                                    <strong>
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>: 
                                    </strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                    <?php echo Funcoes::MascaraValorLer($tbProdutosValor, $GLOBALS['configSistemaMoeda']);?>
                                </div>
                                <div>
                                    <?php echo $linhaOrcamentosRelacaoRegistros["informacao_complementar1"]; ?>
                                </div>
                            </div>
                            
                            <tr class="AdmTbFundoClaro">
                            	<?php if($GLOBALS['ativacaoProdutosVisualizacaoImagem'] == 1){ ?>
                                <td class="AdmTabelaDados01Celula">
                                    <div align="left" class="SiteTexto02">
										<?php if(!empty($tbProdutosImagem)){ ?>
                                            <?php //Sem pop-up. ?>
                                            <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                                <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $tbProdutosImagem;?>" alt="<?php echo $tbProdutosProduto; ?>" />
                                            <?php } ?>
                                        
                                            <?php //SlimBox 2 - JQuery. ?>
                                            <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                                <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbProdutosImagem;?>" rel="lightbox" title="">
                                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>t<?php echo $tbProdutosImagem;?>" alt="<?php echo $tbProdutosProduto; ?>" />
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </td>
                                <?php } ?>
                                <td class="AdmTabelaDados01Celula">
                                    <div align="left" class="AdmTexto01">
                                        <?php //echo DbFuncoes::GetCampoGenerico01($linhaOrcamentosRelacaoRegistros["id_registro"], "tb_produtos", "produto"); ?>
                                        <?php echo $tbProdutosProduto; ?>
                                        <div>
                                            <?php echo $linhaOrcamentosRelacaoRegistros["informacao_complementar1"]; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="AdmTabelaDados01Celula">
                                    <div align="right" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                        <?php echo Funcoes::MascaraValorLer($tbProdutosValor, $GLOBALS['configSistemaMoeda']);?>
                                    </div>
                                </td>
                                <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                                <td class="AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto01">
                                        <?php echo $linhaOrcamentosRelacaoRegistros["quantidade"]; ?>
                                    </div>
                                </td>
                                <td class="AdmTabelaDados01Celula">
                                    <div align="right" class="AdmTexto01">
                                        <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                                        <?php echo Funcoes::MascaraValorLer(($linhaOrcamentosRelacaoRegistros["quantidade"] * $tbProdutosValor), $GLOBALS['configSistemaMoeda']); ?>
                                    </div>
                                </td>
                                <?php } ?>
                                <td class="AdmTabelaDados01Celula">
                                    <div align="center" class="AdmTexto01">
                                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentosRelacaoRegistros['id'];?>" class="AdmCampoCheckBox01" />
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
            <?php } ?>
            <?php
            //Limpeza de objetos.
            //----------
            unset($strSqlOrcamentosRelacaoRegistrosSelect);
            unset($statementOrcamentosRelacaoRegistrosSelect);
            unset($resultadoOrcamentosRelacaoRegistros);
            unset($linhaOrcamentosRelacaoRegistros);
            //----------
            ?>
        </div>
    <?php } ?>
<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>