<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbFormularios = $_POST["idTbFormularios"];
$emailCorpoMensagemTexto = "";
$emailCorpoMensagemHTML = "texo html";

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Query de pesquisa.
//----------
$strSqlFormulariosDetalhesSelect = "";
$strSqlFormulariosDetalhesSelect .= "SELECT ";
//$strSqlFormulariosDetalhesSelect .= "* ";
$strSqlFormulariosDetalhesSelect .= "id, ";
$strSqlFormulariosDetalhesSelect .= "id_tb_categorias, ";
$strSqlFormulariosDetalhesSelect .= "nome_formulario, ";
$strSqlFormulariosDetalhesSelect .= "assunto_formulario, ";
$strSqlFormulariosDetalhesSelect .= "nome_email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_destinatario, ";
$strSqlFormulariosDetalhesSelect .= "email_copia, ";
$strSqlFormulariosDetalhesSelect .= "config_mensagem_sucesso ";
$strSqlFormulariosDetalhesSelect .= "FROM tb_formularios ";
$strSqlFormulariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlFormulariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlFormulariosDetalhesSelect .= "AND id = :id ";
//$strSqlFormulariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementFormulariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlFormulariosDetalhesSelect);

if ($statementFormulariosDetalhesSelect !== false)
{
	$statementFormulariosDetalhesSelect->execute(array(
		"id" => $idTbFormularios
	));
}

//$resultadoFormulariosDetalhes = $dbSistemaConPDO->query($strSqlFormulariosDetalhesSelect);
$resultadoFormulariosDetalhes = $statementFormulariosDetalhesSelect->fetchAll();

if (empty($resultadoFormulariosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoFormulariosDetalhes as $linhaFormulariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbFormulariosId = $linhaFormulariosDetalhes['id'];
		$tbFormulariosIdTbCategorias = $linhaFormulariosDetalhes['id_tb_categorias'];
		$tbFormulariosNomeFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_formulario']);
		$tbFormulariosAssuntoFormulario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['assunto_formulario']);
		$tbFormulariosNomeEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['nome_email_destinatario']);
		$tbFormulariosEmailDestinatario = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_destinatario']);
		$tbFormulariosEmailCopia = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['email_copia']);
		$tbFormulariosConfigMensagemSucesso = Funcoes::ConteudoMascaraLeitura($linhaFormulariosDetalhes['config_mensagem_sucesso']);
		
		//Verificação de erro.
		//echo "tbFormulariosId=" . $tbFormulariosId . "<br>";
		//echo "tbFormulariosTitulo=" . $tbFormulariosTitulo . "<br>";
		//echo "tbFormulariosAtivacao=" . $tbFormulariosAtivacao . "<br>";
	}
}


if($GLOBALS['habilitarFormulariosConfigMensageSucesso'] == 1)
{
	$mensagemSucesso = $tbFormulariosConfigMensagemSucesso;
}else{
	$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteMensagemFormulariosEnvio");
}


?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $GLOBALS['configNomeCliente']; ?>
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

<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>

<?php 

//Montagem da mensagem.
//**************************************************************************************

//Query de pesquisa.
//----------
$strSqlFormulariosCamposSelect = "";
$strSqlFormulariosCamposSelect .= "SELECT ";
//$strSqlFormulariosCamposSelect .= "* ";
$strSqlFormulariosCamposSelect .= "id, ";
$strSqlFormulariosCamposSelect .= "id_tb_formularios, ";
$strSqlFormulariosCamposSelect .= "n_classificacao, ";
$strSqlFormulariosCamposSelect .= "nome_campo, ";
$strSqlFormulariosCamposSelect .= "nome_campo_formatado, ";
$strSqlFormulariosCamposSelect .= "tipo_campo, ";
$strSqlFormulariosCamposSelect .= "tamanho_campo, ";
$strSqlFormulariosCamposSelect .= "altura_campo, ";
$strSqlFormulariosCamposSelect .= "ativacao, ";
$strSqlFormulariosCamposSelect .= "obrigatorio ";
$strSqlFormulariosCamposSelect .= "FROM tb_formularios_campos ";
$strSqlFormulariosCamposSelect .= "WHERE id <> 0 ";
$strSqlFormulariosCamposSelect .= "AND id_tb_formularios = :id_tb_formularios ";
$strSqlFormulariosCamposSelect .= "ORDER BY " . $GLOBALS['configClassificacaoFormulariosCampos'] . " ";

$statementFormulariosCamposSelect = $dbSistemaConPDO->prepare($strSqlFormulariosCamposSelect);

if ($statementFormulariosCamposSelect !== false)
{
	$statementFormulariosCamposSelect->execute(array(
		"id_tb_formularios" => $idTbFormularios
	));
}

//$resultadoFormulariosCampos = $dbSistemaConPDO->query($strSqlFormulariosCamposSelect);
$resultadoFormulariosCampos = $statementFormulariosCamposSelect->fetchAll();


if (empty($resultadoFormulariosCampos))
{
	//echo "Nenhum registro encontrado";
}else{
	//Loop pelos resultados.
	foreach($resultadoFormulariosCampos as $linhaFormulariosCampos)
	{
		//Formato texto.
		//----------------------
		
		//Campo de texto.
		if($linhaFormulariosCampos['tipo_campo'] == 1)
		{
			if(!empty($_POST[$linhaFormulariosCampos['nome_campo_formatado']])){
				//$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . ": " . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
				//$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
				$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
				//$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo'], "utf8_encode") . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
				//$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraGravacao01($linhaFormulariosCampos['nome_campo']) . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
				//$emailCorpoMensagemTexto .= utf8_encode($linhaFormulariosCampos['nome_campo']) . ": " . utf8_encode($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
				//
			}
		}
		
		//Área de texto.
		if($linhaFormulariosCampos['tipo_campo'] == 2)
		{
			if(!empty($_POST[$linhaFormulariosCampos['nome_campo_formatado']])){
				$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
			}
		}
		
		//DropDownMenu.
		if($linhaFormulariosCampos['tipo_campo'] == 5)
		{
			if(!empty($_POST[$linhaFormulariosCampos['nome_campo_formatado']])){
				$emailCorpoMensagemTexto .= Funcoes::ConteudoMascaraLeitura($linhaFormulariosCampos['nome_campo']) . Funcoes::ConteudoMascaraLeitura($_POST[$linhaFormulariosCampos['nome_campo_formatado']]) . "\n"; //PHP_EOL
			}
		}
		
		//DropDownMenu.
		/*if($linhaFormulariosCampos['tipo_campo'] == 7)
		{
			$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . "/n";
		}
		
		//Subtítulo explicativo.
		if($linhaFormulariosCampos['tipo_campo'] == 8)
		{
			$emailCorpoMensagemTexto .= $linhaFormulariosCampos['nome_campo'] . "/n";
		}*/
		
		
		//$emailCorpoMensagemTexto .= "";
		//----------------------
	}
}

//Limpeza de objetos.
//----------
unset($strSqlFormulariosCamposSelect);
unset($statementFormulariosCamposSelect);
unset($resultadoFormulariosCampos);
unset($linhaFormulariosCampos);
//----------
//**************************************************************************************


//Verificação de erro - debug.
echo "emailCorpoMensagemTexto=" . $emailCorpoMensagemTexto . "<br>";



//echo "emailCorpoMensagemTexto=" . $emailCorpoMensagemTexto . "<br>";




//PHPMailer.
//**************************************************************************************
if($GLOBALS['componenteEmail'] == 1)
{
	$phpMailerSender = new PHPMailer();
	$phpMailerSender->IsSMTP(); //send via SMTP
	$phpMailerSender->Host = $GLOBALS['configPHPMailerHost']; //SMTP server
	$phpMailerSender->SMTPAuth = true; //turn on SMTP authentication
	$phpMailerSender->Username = $GLOBALS['configPHPMailerUsername']; //SMTP username
	$phpMailerSender->Password = $GLOBALS['configPHPMailerPassword']; //SMTP password
	$phpMailerSender->From = $GLOBALS['configEmailRemetente'];
	$phpMailerSender->FromName = $GLOBALS['configEmailRemetenteNome'];
	$phpMailerSender->AddAddress("web@sistemadinamico.cu.cc","Sistema Dinâmico (Dev)"); //destinatário
	$phpMailerSender->AddReplyTo($GLOBALS['configEmailReply'],$GLOBALS['configEmailRemetenteNome']);
	//$phpMailerSender->WordWrap = 50; // set word wrap
	//$phpMailerSender->AddAttachment("Path to Attachment "); //attachment
	//$phpMailerSender->CharSet='iso-8859-1';
	$phpMailerSender->CharSet='UTF-8';
	$phpMailerSender->IsHTML($GLOBALS['configPHPMailerIsHTML']); //send as HTML
	$phpMailerSender->Subject  =  $tbFormulariosAssuntoFormulario;
	$phpMailerSender->Body     =  $emailCorpoMensagemHTML;
	$phpMailerSender->AltBody  =  $emailCorpoMensagemTexto;
	
	//Tentativa de envio de e-mail.
	//----------
	if(!$phpMailerSender->Send())
	{
		$mensagemErro .= "(" . $phpMailerSender->ErrorInfo . ")";
		//echo "Erro no envio de mensagem.";
		//echo "Erro do Mailer: " . $mail->ErrorInfo;
		//exit;
	}else{
		
	}
	//----------
}
//**************************************************************************************
?>

    <div align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlFormulariosDetalhesSelect);
unset($statementFormulariosDetalhesSelect);
unset($resultadoFormulariosDetalhes);
unset($linhaFormulariosDetalhes);
//----------

//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>

<?php include_once $pageSite->LayoutSite ?>