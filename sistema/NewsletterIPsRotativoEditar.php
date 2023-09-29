<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbNewsletterIPsRotativo = $_GET["idTbNewsletterIPsRotativo"];
$idParent = DbFuncoes::GetCampoGenerico01($idTbNewsletterIPsRotativo, "tb_newsletter_ips", "id_parent");

$paginaRetorno = "NewsletterIPsRotativoIndice.php";
$paginaRetornoExclusao = "NewsletterIPsRotativoEditar.php";
$variavelRetorno = "idParent";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Montagem de query padrão de retorno.
$queryPadrao = "&paginaRetorno=" . $paginaRetorno . 
"&masterPageSelect=" . $masterPageSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlNewsletterIPsRotativoDetalhesSelect = "";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "SELECT ";
//$strSqlNewsletterIPsRotativoDetalhesSelect .= "* ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "id, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "id_parent, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "data_inclusao, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "titulo, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "ip_rotativo, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "servidor_smtp, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "usuario, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "senha, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "porta_smtp, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "encryption, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "habilitar_autenticacao, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "ativacao, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "ativacao_selecao, ";

$strSqlNewsletterIPsRotativoDetalhesSelect .= "informacao_configuracao1, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "informacao_configuracao2, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "informacao_configuracao3, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "informacao_configuracao4, ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "informacao_configuracao5, ";

$strSqlNewsletterIPsRotativoDetalhesSelect .= "obs ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "FROM tb_newsletter_ips ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "WHERE id <> 0 ";
$strSqlNewsletterIPsRotativoDetalhesSelect .= "AND id = :id ";
//$strSqlNewsletterIPsRotativoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementNewsletterIPsRotativoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlNewsletterIPsRotativoDetalhesSelect);

if ($statementNewsletterIPsRotativoDetalhesSelect !== false)
{
	$statementNewsletterIPsRotativoDetalhesSelect->execute(array(
		"id" => $idTbNewsletterIPsRotativo
	));
}

//$resultadoNewsletterIPsRotativoDetalhes = $dbSistemaConPDO->query($strSqlNewsletterIPsRotativoDetalhesSelect);
$resultadoNewsletterIPsRotativoDetalhes = $statementNewsletterIPsRotativoDetalhesSelect->fetchAll();

if (empty($resultadoNewsletterIPsRotativoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoNewsletterIPsRotativoDetalhes as $linhaNewsletterIPsRotativoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbNewsletterIPsRotativoId = $linhaNewsletterIPsRotativoDetalhes['id'];
		$tbNewsletterIPsRotativoIdParent = $linhaNewsletterIPsRotativoDetalhes['id_parent'];
		$tbNewsletterIPsRotativoIPRotativo = $linhaNewsletterIPsRotativoDetalhes['ip_rotativo'];
		$tbNewsletterIPsRotativoAtivacao = $linhaNewsletterIPsRotativoDetalhes['ativacao'];
		$tbNewsletterIPsRotativoAtivacaoSelecao = $linhaNewsletterIPsRotativoDetalhes['ativacao_selecao'];
		
		
		//Verificação de erro.
		//echo "tbNewsletterIPsRotativoId=" . $tbNewsletterIPsRotativoId . "<br>";
		//echo "tbNewsletterIPsRotativoTitulo=" . $tbNewsletterIPsRotativoTitulo . "<br>";
		//echo "tbNewsletterIPsRotativoAtivacao=" . $tbNewsletterIPsRotativoAtivacao . "<br>";
	}
}
//----------
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistema"); ?> - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configNomeCliente'], "IncludeConfig"); ?>
<?php 
$page->cphTitle = ob_get_clean(); 
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
	
<?php 
$page->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Cabeçalho.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoCabecalho*/ ?>
    <div align="left" class="TextoTitulo01">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoTituloEditar"); ?>
    </div>
<?php 
$page->cphConteudoCabecalho = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div align="center" class="TextoErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="TextoSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

    <div style="position: relative; display: block; overflow: hidden; clear: both;">
    <form name="formNewsletterIPsRotativo" id="formNewsletterIPsRotativo" action="NewsletterIPsRotativoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoTbIPsEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterIPsRotativoIP"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="ip_rotativo" id="ip_rotativo" class="CampoTexto01" maxlength="255" value="<?php echo $tbNewsletterIPsRotativoIPRotativo; ?>" />
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro" colspan="3">
                    <div align="left" class="Texto01">
                        <select name="ativacao" id="ativacao" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbNewsletterIPsRotativoAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbNewsletterIPsRotativoAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>

        </table>

        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input type="hidden" id="idTbNewsletterIPsRotativo" name="idTbNewsletterIPsRotativo" value="<?php echo $tbNewsletterIPsRotativoId; ?>" />
                <input type="hidden" id="id_Parent" name="id_Parent" value="<?php echo $tbNewsletterIPsRotativoIdParent; ?>" />
                <input type="hidden" id="ativacao_selecao" name="ativacao_selecao" value="<?php echo $tbNewsletterIPsRotativoIdParent; ?>" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParent=<?php echo $idParent; ?><?php echo $queryPadrao;?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
    </form>
    <br />
    </div>
<?php 
$page->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlNewsletterIPsRotativoDetalhesSelect);
unset($statementNewsletterIPsRotativoDetalhesSelect);
unset($resultadoNewsletterIPsRotativoDetalhes);
unset($linhaNewsletterIPsRotativoDetalhes);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>