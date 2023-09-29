<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
//$id = ContadorUniversal::ContadorUniversalUpdate(1);
$id = $_POST["idTbNewsletterEmailsAvulso"];
$idTbNewsletterEmailsAvulsoGrupos = $_POST["id_tb_newsletter_emails_avulso_grupos"];
//$emails = Funcoes::ConteudoMascaraGravacao01($_POST["emails"]);
$email = Funcoes::ConteudoMascaraGravacao01($_POST["email"]);
$ativacaoMalaDireta = $_POST["ativacao_mala_direta"];

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";

//Montagem de query padrão de retorno.
$queryPadrao = "&masterPageSelect=" . $masterPageSelect;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Update de registro no BD.
//----------
$strSqlNewsletterEmailsAvulsoUpdate = "";
$strSqlNewsletterEmailsAvulsoUpdate .= "UPDATE tb_newsletter_emails_avulso ";
$strSqlNewsletterEmailsAvulsoUpdate .= "SET ";
//$strSqlNewsletterEmailsAvulsoUpdate .= "id = :id, ";
$strSqlNewsletterEmailsAvulsoUpdate .= "id = :id, ";
$strSqlNewsletterEmailsAvulsoUpdate .= "id_tb_newsletter_emails_avulso_grupos = :id_tb_newsletter_emails_avulso_grupos, ";
$strSqlNewsletterEmailsAvulsoUpdate .= "email = :email, ";
$strSqlNewsletterEmailsAvulsoUpdate .= "ativacao_mala_direta = :ativacao_mala_direta ";
$strSqlNewsletterEmailsAvulsoUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlNewsletterEmailsAvulsoUpdate . "<br />";
//----------


//Parâmetros.
//----------
$statementNewsletterEmailsAvulsoUpdate = $dbSistemaConPDO->prepare($strSqlNewsletterEmailsAvulsoUpdate);

/*
"data_publicacao" => $dataPublicacao,
"n_impressoes" => $nImpressoes,
"n_impressoes_contratacao" => $nImpressoesContratacao,
"n_cliques" => $nCliques,
"n_cliques_contratacao" => $nCliquesContratacao
"arquivo" => $arquivo
*/
if ($statementNewsletterEmailsAvulsoUpdate !== false)
{
	$statementNewsletterEmailsAvulsoUpdate->execute(array(
		"id" => $id,
		"id_tb_newsletter_emails_avulso_grupos" => $idTbNewsletterEmailsAvulsoGrupos,
		"email" => $email,
		"ativacao_mala_direta" => $ativacaoMalaDireta
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlNewsletterEmailsAvulsoUpdate);
unset($statementNewsletterEmailsAvulsoUpdate);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
"idTbNewsletterEmailsAvulsoGrupos=" . $idTbNewsletterEmailsAvulsoGrupos .
$queryPadrao . 
"&mensagemSucesso=" . $mensagemSucesso .
"&mensagemErro=" . $mensagemErro;

//Limpeza do buffer de saída.
///*
while (ob_get_status()) 
{
    ob_end_clean();
}
//*/

//Redirecionamento de página.
//exit();
header("Location: " . $URLRetorno);
die();
?>