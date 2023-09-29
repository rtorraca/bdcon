<?php
//$masterPageSiteSelect = "LayoutSitePainel.php";
$_GET["masterPageSiteSelect"] = "LayoutSitePainel.php";

//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Verificação de erro - debug.
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
//echo "CookieValorLer=" . CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "URLReferenciaLogin")  . "<br>";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginTitulo"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteLoginTitulo"); ?>
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
    
	<?php //Login.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeLogin_tipoLogin = "1";
	$includeLogin_origemLogin = "1";
	?>
    
    <?php include "IncludeLogin.php";?>
    <?php //----------------------?>
    
    <div class="ConteudoTextoCorrido" style="position: relative; display: block; overflow: hidden; margin-top: 20px; text-align: justify;">

        <strong>Equipe de criação:</strong>
        </br></br>
        Desenvolvimento de conteúdo: Isis Baldini e Andréia Wojcicki Ruberti
        </br></br>
        Desenvolvimento de software: Maurício Nunes e Planejamento Visual – Arte e Tecnologia
        </br></br></br>

        <strong>Apoio:</strong>
        </br></br>
        Banco Nacional de Desenvolvimento Econômico e Social – BNDES
        </br></br>
        Fundação de Apoio à Universidade de São Paulo - FUSP
        </br></br></br>

        <strong>Norma de isenção de responsabilidade em termos de uso:</strong>
        </br></br>
	Não é de responsabilidade da FUSP, da BBM ou de qualquer entidade vinculada à USP qualquer dano, prejuízo ou perda no equipamento dos usuários causados por falhas do Banco de Dados da Conservação, no sistema, no servidor ou na Internet, ou decorrentes de condutas de terceiros. A FUSP, a BBM e qualquer entidade vinculada à USP também são isentas de responsabilidade por vírus, dispositivo malicioso e congêneres que possam atacar o equipamento dos usuários em decorrência do acesso, utilização ou navegação no Banco de Dados da Conservação ou como consequência da transferência de dados, arquivos, imagens, textos ou áudio contidos no mesmo. Os usuários não podem atribuir à FUSP, à BBM ou a qualquer entidade vinculada à USP ou ao Banco de Dados da Conservação nenhuma responsabilidade nem exigir o pagamento por dano ou lucro cessante em virtude de prejuízos resultantes de dificuldades técnicas ou falhas nas programações, nos sistemas ou na Internet. Eventualmente, o sistema e seu código fonte podem não estar disponíveis por motivos técnicos ou falhas da Internet, ou por qualquer outro evento decorrente de caso fortuito ou de força maior, alheios ao controle da FUSP, da BBM ou de qualquer entidade vinculada à USP.
	</br></br></br>
	São Paulo, março de 2019
    </div>
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
