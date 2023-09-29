<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "IncludeConfig.php"; //Deve vir antes do db.
require_once "IncludeConexao.php";
require_once "IncludeFuncoes.php";
//require_once "IncludeUsuarioVerificacao.php";
require_once "IncludeLayout.php";


//Resgate de variáveis.
if($GLOBALS['configUsuariosMetodoSenha'] == 1)
{
	$idTbUsuarios = 3; //Usuário padrão (md5)
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
	$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), $GLOBALS['configUsuariosMetodoSenha']);
	//$senha = Crypto::EncryptValue($_POST["senha"], 2);
}

if($GLOBALS['configUsuariosMetodoSenha'] == 2)
{
	//Usuário padrão PHP (MCrypt PHP library).
	if($GLOBALS['configCryptDados'] == 21)
	{
		$idTbUsuarios = 2; 
	}
	
	//Usuário padrão PHP (Defuse PHP library).
	if($GLOBALS['configCryptDados'] == 22)
	{
		$idTbUsuarios = 4; 
	}

	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraLeitura($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 2);
	//$senha = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), $GLOBALS['configUsuariosMetodoSenha']);
	$senha = Funcoes::ConteudoMascaraGravacao01($_POST["senha"]);
	//$senhaMD5 = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($_POST["senha"]), 1);
	//$senha = Crypto::EncryptValue($_POST["senha"], 2);
}

$loginVerificacao = false;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Verificação de erro - debug
//echo "idTbUsuarios=" . $idTbUsuarios . "<br />";
//echo "senha=" . $senha . "<br />";
//echo "senha(decrypt)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($senha, 2), 2) . "<br />";
//echo "senhaMD5=" . $senhaMD5 . "<br />";


//Query de pesquisa.
//----------
$strSqlUsuariosDetalhesSelect = "";
$strSqlUsuariosDetalhesSelect .= "SELECT ";
$strSqlUsuariosDetalhesSelect .= "id, ";
$strSqlUsuariosDetalhesSelect .= "nome, ";
$strSqlUsuariosDetalhesSelect .= "usuario, ";
$strSqlUsuariosDetalhesSelect .= "senha, ";
$strSqlUsuariosDetalhesSelect .= "email, ";
$strSqlUsuariosDetalhesSelect .= "obs, ";
$strSqlUsuariosDetalhesSelect .= "usuario_data, ";
$strSqlUsuariosDetalhesSelect .= "usuario_tipo, ";
$strSqlUsuariosDetalhesSelect .= "ativacao ";
$strSqlUsuariosDetalhesSelect .= "FROM tb_usuarios ";
$strSqlUsuariosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlUsuariosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlUsuariosDetalhesSelect .= "AND id = :id ";
$strSqlUsuariosDetalhesSelect .= "AND ativacao = 1 ";
//$strSqlUsuariosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementUsuariosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlUsuariosDetalhesSelect);

if ($statementUsuariosDetalhesSelect !== false)
{
	$statementUsuariosDetalhesSelect->execute(array(
		"id" => $idTbUsuarios
	));
}

//$resultadoUsuariosDetalhes = $dbSistemaConPDO->query($strSqlUsuariosDetalhesSelect);
$resultadoUsuariosDetalhes = $statementUsuariosDetalhesSelect->fetchAll();


if (empty($resultadoUsuariosDetalhes))
{
	//echo "Nenhum registro encontrado";
	$loginVerificacao = false;
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusErro2");
}else{
	foreach($resultadoUsuariosDetalhes as $linhaUsuariosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbUsuariosId = $linhaUsuariosDetalhes['id'];
		$tbUsuariosIdCrypt = Crypto::EncryptValue(Funcoes::ConteudoMascaraGravacao01($tbUsuariosId), 2);
		
		$tbUsuariosNome = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['nome']);
		$tbUsuariosUsuario = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['usuario']);
		
		//$tbUsuariosSenha = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['usuario']);
		if($GLOBALS['configCadastroMetodoSenha'] == 1){
			$tbUsuariosSenha = $linhaUsuariosDetalhes['senha'];
        }
		
		if($GLOBALS['configCadastroMetodoSenha'] == 2){
			$tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['senha'], 2), 2);
        }
		
		$tbUsuariosEmail = $linhaUsuariosDetalhes['email'];
		//$tbUsuariosOBS = Funcoes::ConteudoMascaraLeitura($linhaUsuariosDetalhes['obs']);
		//$tbUsuariosUsuarioData = $linhaUsuariosDetalhes['usuario_data'];
		$tbUsuariosUsuarioTipo = $linhaUsuariosDetalhes['usuario_tipo'];
		$tbUsuariosAtivacao = $linhaUsuariosDetalhes['ativacao'];
		
		//Verificação de erro.
		//echo "tbCadastroId=" . $tbUsuariosId . "<br>";
		//echo "tbCadastroSenha=" . $tbUsuariosSenha . "<br>";
	}
	
	
	//Verificação de senha.
	//----------
	if($tbUsuariosSenha == $senha)
	{
		$loginVerificacao = true;
		$mensagemSucesso = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusSucesso10");
	}else{
		$loginVerificacao = false;
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatusErro2");
	}
	//----------
}


//Limpeza de objetos.
//----------
unset($strSqlUsuariosDetalhesSelect);
unset($statementUsuariosDetalhesSelect);
unset($resultadoUsuariosDetalhes);
unset($linhaUsuariosDetalhes);
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;

//Tratamenot do resultado do login.
if($loginVerificacao == true)
{
	$paginaRetorno = "UsuariosIndice.php";
	
	//Método de criação de cookie.
	if($GLOBALS['configUsuariosMasterMetodoAutenticacao'] == "1")
	{
		//Criação do cookie.
		//time() + (86400 * 30)
		//setcookie($GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster'],$tbUsuariosId,time() + (86400 * 30), "/");
		//setcookie($GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster'], $tbUsuariosIdCrypt, time() + (86400 * 30), "/");
		CookiesFuncoes::CookieCriar($GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster'], $tbUsuariosIdCrypt);
	}
	
}else{
	$paginaRetorno = "UsuariosLogin.php";
}


//Verificação de erro.
//echo "loginVerificacao=" . $loginVerificacao . "<br>";
//echo "paginaRetorno=" . $paginaRetorno . "<br>";
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";


//Montagem do URL de retorno.
$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
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
exit;
?>