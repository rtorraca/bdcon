<?php
//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Verificação de login Master.
LoginAutenticacao::UsuarioLoginVerificacao();


//Resgate de variáveis.
$idTbNewsletterEmailsAvulso = $_GET["idTbNewsletterEmailsAvulso"];
$idTbNewsletterEmailsAvulsoGrupos = DbFuncoes::GetCampoGenerico01($idTbNewsletterEmailsAvulso, "tb_newsletter_emails_avulso", "id_tb_newsletter_emails_avulso_grupos");

$paginaRetorno = "NewsletterEmailsAvulsoIndice.php";
$paginaRetornoExclusao = "NewsletterEmailsAvulsoEditar.php";
$variavelRetorno = "idTbNewsletterEmailsAvulso";
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
$strSqlNewsletterEmailsAvulsoDetalhesSelect = "";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "SELECT ";
//$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "* ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "id, ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "id_tb_newsletter_emails_avulso_grupos, ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "email, ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "ativacao_mala_direta ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "FROM tb_newsletter_emails_avulso ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "WHERE id <> 0 ";
$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "AND id = :id ";
//$strSqlNewsletterEmailsAvulsoDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementNewsletterEmailsAvulsoDetalhesSelect = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoDetalhesSelect);

if ($statementNewsletterEmailsAvulsoDetalhesSelect !== false)
{
	$statementNewsletterEmailsAvulsoDetalhesSelect->execute(array(
		"id" => $idTbNewsletterEmailsAvulso
	));
}

//$resultadoNewsletterEmailsAvulsoDetalhes = $dbSistemaConPDO->query($strSqlNewsletterEmailsAvulsoDetalhesSelect);
$resultadoNewsletterEmailsAvulsoDetalhes = $statementNewsletterEmailsAvulsoDetalhesSelect->fetchAll();

if (empty($resultadoNewsletterEmailsAvulsoDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoNewsletterEmailsAvulsoDetalhes as $linhaNewsletterEmailsAvulsoDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbNewsletterEmailsAvulsoId = $linhaNewsletterEmailsAvulsoDetalhes['id'];
		$tbNewsletterEmailsAvulsoIdTbNewsletterEmailsAvulsoGrupos = $linhaNewsletterEmailsAvulsoDetalhes['id_tb_newsletter_emails_avulso_grupos'];
		$tbNewsletterEmailsAvulsoEmail = Funcoes::ConteudoMascaraLeitura($linhaNewsletterEmailsAvulsoDetalhes['email']);
		$tbNewsletterEmailsAvulsoAtivacaoMalaDireta = $linhaNewsletterEmailsAvulsoDetalhes['ativacao_mala_direta'];
		
		
		//Verificação de erro.
		//echo "tbNewsletterEmailsAvulsoId=" . $tbNewsletterEmailsAvulsoId . "<br>";
		//echo "tbNewsletterEmailsAvulsoTitulo=" . $tbNewsletterEmailsAvulsoTitulo . "<br>";
		//echo "tbNewsletterEmailsAvulsoAtivacao=" . $tbNewsletterEmailsAvulsoAtivacao . "<br>";
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
    <form name="formEmailsAvulso" id="formEmailsAvulso" action="NewsletterEmailsAvulsoEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="TabelaCampos01">
            <tr>
                <td class="TbFundoEscuro" colspan="2">
                    <div align="center" class="Texto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoTbEmailsEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>

            <tr>
                <td class="TbFundoMedio TabelaColuna01">
                    <div align="left" class="Texto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterGruposEmailAvulsoIncluirEmails"); ?>:
                    </div>
                </td>
                <td class="TbFundoClaro">
                    <div align="left">
                        <input type="text" name="email" id="email" class="CampoTexto01" maxlength="255" value="<?php echo $tbNewsletterEmailsAvulsoEmail; ?>" />
                    </div>
                    <div align="left" class="Texto01">
                        <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaNewsletterEmailsAvulsoEmailsInstrucoes01"); ?>
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
                        <select name="ativacao_mala_direta" id="ativacao_mala_direta" class="CampoDropDownMenu01">
                            <option value="0"<?php if($tbNewsletterEmailsAvulsoAtivacaoMalaDireta == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbNewsletterEmailsAvulsoAtivacaoMalaDireta == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
        </table>

        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaBotaoAtualizar"); ?>" />
                
                <input type="hidden" id="idTbNewsletterEmailsAvulso" name="idTbNewsletterEmailsAvulso" value="<?php echo $tbNewsletterEmailsAvulsoId; ?>" />
                <input type="hidden" id="id_tb_newsletter_emails_avulso_grupos" name="id_tb_newsletter_emails_avulso_grupos" value="<?php echo $tbNewsletterEmailsAvulsoIdTbNewsletterEmailsAvulsoGrupos; ?>" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSelect" name="masterPageSelect" value="<?php echo $masterPageSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idTbNewsletterEmailsAvulsoGrupos=<?php echo $idTbNewsletterEmailsAvulsoGrupos; ?><?php echo $queryPadrao;?>">
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
unset($strSqlNewsletterEmailsAvulsoDetalhesSelect);
unset($statementNewsletterEmailsAvulsoDetalhesSelect);
unset($resultadoNewsletterEmailsAvulsoDetalhes);
unset($linhaNewsletterEmailsAvulsoDetalhes);
//----------


//Inclusão do template do layout.
include_once $page->LayoutSistema;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>