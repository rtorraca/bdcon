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
$idTbProdutos = $_GET["idTbProdutos"];
$idParentProdutos = DbFuncoes::GetCampoGenerico01($idTbProdutos, "tb_produtos", "id_tb_categorias");
$idTipoProduto = DbFuncoes::FiltrosGenericosSelect03($idTbProdutos, "tb_produtos_relacao_complemento", "id_tb_produtos", "id_tb_produtos_complemento", "2", "", ",", "", "1");

$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroUsuario = $idTbCadastroLogado;

$paginaRetorno = "SiteAdmProdutosIndice.php";
$paginaRetornoExclusao = "SiteAdmProdutosEditar.php";
$variavelRetorno = "idTbProdutos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];

//Manutenção - acesso.
$configManutencaoLink = 3;//0 - não exibir | 1 - página com todos as opções | 2 - página com opções específicas | 3 - ajax
$configManutencaoLinkFlag = true;

//Montagem de query padrão de retorno.
$queryPadrao = "&idParentProdutos=" . $idParentProdutos . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlProdutosDetalhesSelect = "";
$strSqlProdutosDetalhesSelect .= "SELECT ";
//$strSqlProdutosDetalhesSelect .= "* ";
$strSqlProdutosDetalhesSelect .= "id, ";
$strSqlProdutosDetalhesSelect .= "id_tb_categorias, ";
$strSqlProdutosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlProdutosDetalhesSelect .= "data_produto, ";
$strSqlProdutosDetalhesSelect .= "cod_produto, ";
$strSqlProdutosDetalhesSelect .= "n_classificacao, ";
$strSqlProdutosDetalhesSelect .= "produto, ";
$strSqlProdutosDetalhesSelect .= "descricao01, ";
$strSqlProdutosDetalhesSelect .= "descricao02, ";
$strSqlProdutosDetalhesSelect .= "descricao03, ";
$strSqlProdutosDetalhesSelect .= "descricao04, ";
$strSqlProdutosDetalhesSelect .= "descricao05, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar1, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar2, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar3, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar4, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar5, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar6, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar7, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar8, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar9, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar10, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar11, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar12, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar13, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar14, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar15, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar16, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar17, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar18, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar19, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar20, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar21, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar22, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar23, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar24, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar25, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar26, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar27, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar28, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar29, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar30, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar31, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar32, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar33, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar34, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar35, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar36, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar37, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar38, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar39, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar40, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar41, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar42, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar43, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar44, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar45, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar46, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar47, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar48, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar49, ";
$strSqlProdutosDetalhesSelect .= "informacao_complementar50, ";
$strSqlProdutosDetalhesSelect .= "palavras_chave, ";
$strSqlProdutosDetalhesSelect .= "valor, ";
$strSqlProdutosDetalhesSelect .= "valor1, ";
$strSqlProdutosDetalhesSelect .= "valor2, ";
$strSqlProdutosDetalhesSelect .= "peso, ";
$strSqlProdutosDetalhesSelect .= "coeficiente, ";
$strSqlProdutosDetalhesSelect .= "estoque, ";
$strSqlProdutosDetalhesSelect .= "ativacao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_promocao, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home, ";
$strSqlProdutosDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlProdutosDetalhesSelect .= "acesso_restrito, ";
$strSqlProdutosDetalhesSelect .= "n_questoes_aprovacao, ";
$strSqlProdutosDetalhesSelect .= "id_tb_produtos_status, ";
$strSqlProdutosDetalhesSelect .= "imagem, ";
$strSqlProdutosDetalhesSelect .= "anotacoes_internas, ";
$strSqlProdutosDetalhesSelect .= "n_visitas ";
$strSqlProdutosDetalhesSelect .= "FROM tb_produtos ";
$strSqlProdutosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlProdutosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlProdutosDetalhesSelect .= "AND id = :id ";
//$strSqlProdutosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Parâmetros.
//----------
$statementProdutosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlProdutosDetalhesSelect);

if ($statementProdutosDetalhesSelect !== false)
{
	$statementProdutosDetalhesSelect->execute(array(
		"id" => $idTbProdutos
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoProdutosDetalhes = $dbSistemaConPDO->query($strSqlProdutosDetalhesSelect);
$resultadoProdutosDetalhes = $statementProdutosDetalhesSelect->fetchAll();

if (empty($resultadoProdutosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoProdutosDetalhes as $linhaProdutosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbProdutosId = $linhaProdutosDetalhes['id'];
		$tbProdutosIdTbCategorias = $linhaProdutosDetalhes['id_tb_categorias'];
		$tbProdutosIdTbCadastroUsuario = $linhaProdutosDetalhes['id_tb_cadastro_usuario'];
		//$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaProdutosDetalhes['data_produto'] == NULL)
		{
			$tbProdutosDataProduto = "";
		}else{
			$tbProdutosDataProduto = Funcoes::DataLeitura01($linhaProdutosDetalhes['data_produto'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		$tbProdutosCodProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['cod_produto']);
		$tbProdutosNClassificacao = $linhaProdutosDetalhes['n_classificacao'];

		$tbProdutosProduto = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['produto']);
		$tbProdutosDescricao01 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao01']);
		$tbProdutosDescricao02 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao02']);
		$tbProdutosDescricao03 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao03']);
		$tbProdutosDescricao04 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao04']);
		$tbProdutosDescricao05 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['descricao05']);

		$tbProdutosIC1 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar1']);
		$tbProdutosIC2 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar2']);
		$tbProdutosIC3 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar3']);
		$tbProdutosIC4 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar4']);
		$tbProdutosIC5 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar5']);
		$tbProdutosIC6 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar6']);
		$tbProdutosIC7 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar7']);
		$tbProdutosIC8 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar8']);
		$tbProdutosIC9 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar9']);
		$tbProdutosIC10 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar10']);
		$tbProdutosIC11 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar11']);
		$tbProdutosIC12 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar12']);
		$tbProdutosIC13 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar13']);
		$tbProdutosIC14 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar14']);
		$tbProdutosIC15 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar15']);
		$tbProdutosIC16 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar16']);
		$tbProdutosIC17 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar17']);
		$tbProdutosIC18 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar18']);
		$tbProdutosIC19 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar19']);
		$tbProdutosIC20 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar20']);
		$tbProdutosIC21 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar21']);
		$tbProdutosIC22 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar22']);
		$tbProdutosIC23 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar23']);
		$tbProdutosIC24 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar24']);
		$tbProdutosIC25 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar25']);
		$tbProdutosIC26 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar26']);
		$tbProdutosIC27 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar27']);
		$tbProdutosIC28 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar28']);
		$tbProdutosIC29 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar29']);
		$tbProdutosIC30 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar30']);
		$tbProdutosIC31 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar31']);
		$tbProdutosIC32 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar32']);
		$tbProdutosIC33 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar33']);
		$tbProdutosIC34 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar34']);
		$tbProdutosIC35 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar35']);
		$tbProdutosIC36 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar36']);
		$tbProdutosIC37 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar37']);
		$tbProdutosIC38 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar38']);
		$tbProdutosIC39 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar39']);
		$tbProdutosIC40 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar40']);
		$tbProdutosIC41 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar41']);
		$tbProdutosIC42 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar42']);
		$tbProdutosIC43 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar43']);
		$tbProdutosIC44 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar44']);
		$tbProdutosIC45 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar45']);
		$tbProdutosIC46 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar46']);
		$tbProdutosIC47 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar47']);
		$tbProdutosIC48 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar48']);
		$tbProdutosIC49 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar49']);
		$tbProdutosIC50 = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['informacao_complementar50']);

		$tbProdutosPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['palavras_chave']);
		$tbProdutosValor = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor1 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosValor2 = Funcoes::MascaraValorLer($linhaProdutosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
		//$tbProdutosPeso = Funcoes::MascaraValorLer($linhaProdutosDetalhes['peso'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosPeso = $linhaProdutosDetalhes['peso'];
		
		//$tbProdutosCoeficiente = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['coeficiente']);
		//$tbProdutosCoeficiente = Funcoes::MascaraValorLer($linhaProdutosDetalhes['coeficiente'], $GLOBALS['configSistemaMoeda']);
		$tbProdutosCoeficiente = $linhaProdutosDetalhes['coeficiente'];
		$tbProdutosEstoque = $linhaProdutosDetalhes['estoque'];
		$tbProdutosAtivacao = $linhaProdutosDetalhes['ativacao'];
		$tbProdutosAtivacaoPromocao = $linhaProdutosDetalhes['ativacao_promocao'];
		$tbProdutosAtivacaoHome = $linhaProdutosDetalhes['ativacao_home'];
		$tbProdutosAtivacaoHomeCategoria = $linhaProdutosDetalhes['ativacao_home_categoria'];
		$tbProdutosAcessoRestrito = $linhaProdutosDetalhes['acesso_restrito'];
		
		$tbProdutosNQuestoesAprovacao = $linhaProdutosDetalhes['n_questoes_aprovacao'];
		$tbProdutosIdTbProdutosStatus = $linhaProdutosDetalhes['id_tb_produtos_status'];
		$tbProdutosImagem = $linhaProdutosDetalhes['imagem'];
		$tbProdutosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaProdutosDetalhes['anotacoes_internas']);
		$tbProdutosNVisitas = $linhaProdutosDetalhes['n_visitas'];
		//Verificação de erro.
		//echo "tbProdutosId=" . $tbProdutosId . "<br>";
		//echo "tbProdutosProcesso=" . $tbProdutosProcesso . "<br>";
		
	}
}
//----------


//Verificação de erro - debug.
//echo "strSqlVeiculosDetalhesSelect=" . $strSqlVeiculosDetalhesSelect . "<br />";
echo "idTipoProduto=" . $idTipoProduto . "<br>";
?>
<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTituloEditar"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosTituloEditar"); ?>
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
    <div align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>

	<!--Box identificação.-->
	<div style="position: absolute; display: block; width: 1014px; height: 668px; margin-top: -334px; margin-left: -507px; top: 50%; left: 50%; border: 1px solid #efe4b0; background-color: #ffffff; /**/">
        
        <!--Box principal.-->
        <div style="position: absolute; display: block; width: 990px; height: 430px; top: 15px; left: 12px; border: 1px solid #000000; background-color: #efe4b0;">
        	<!--Títulos.-->
            <div style="position: absolute; display: block; /*height: 20px; */top: -8px; left: 13px; border: 1px solid #000000; background-color: #ffffff;">
            	<span class="SiteTitulos01" style="position: relative; display: block; padding: 3px 5px 3px 5px;">
                    Identifica&ccedil;&atilde;o
                </span>
            </div>
            
	<script type="text/javascript">
		$(document).ready(function () {
			
			/*
			$.validator.addMethod(
					"alphabetsOnly",
					function(value, element, regexp) {
						var re = new RegExp(regexp);
						return this.optional(element) || re.test(value);
					},
					"Please check your input values again!!!."
			);
			*/
			//Parâmetro personalizado.
			//**************************************************************************************
			jQuery.validator.addMethod("accept", function(value, element, param) {
				//return value.match(new RegExp("^" + param + "$"));
				return value.match(new RegExp(param));
			});	
			//**************************************************************************************

				
			//Validação de formulário (JQuery).
			//**************************************************************************************
			$('#formProdutosEditar').validate({ //Inicialização do plug-in.
			
			
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
					},
					valor: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor1: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					},
					valor2: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						//regex: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?/
						//pattern: /^(\d+|\d+,\d{1,2})$/
						//pattern: /[0-9]+([\.|,][0-9]+)?/
						accept: "-?[0-9]+(?:\.?[0-9]*)?,?[0-9]+(?:\.?[0-9]*)?"
						//number: true
					}//,
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
					},
					valor: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor1: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					},
					valor2: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //pattern: "echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3");"
					  accept: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica3"); ?>"
					  //number: "Campo numérico."
					}//,
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
	<script type="text/javascript">
        //Variável para conter todos os campos que funcionam com o DatePicker.
        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
        var strDatapickerAgendaPtCampos = "";
        var strDatapickerAgendaEnCampos = "";
    </script>
    <form name="formProdutosEditar" id="formProdutosEditar" action="SiteAdmProdutosEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
            
            <!--Identificação - Livros.-->
			<?php if($idTipoProduto == "3486"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3486.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Livros.-->
            
            
            <!--Identificação - Diplomas.-->
			<?php if($idTipoProduto == "3483"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3483.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Diplomas.-->
            
            
            <!--Identificação - Documentos.-->
			<?php if($idTipoProduto == "3484"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3484.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Documentos.-->
            
            
            <!--Identificação - Fotografia.-->
			<?php if($idTipoProduto == "3485"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3485.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Fotografia.-->
            
            
            <!--Identificação - Mapas.-->
			<?php if($idTipoProduto == "3487"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3487.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Mapas.-->
            
            
            <!--Identificação - Obras de Arte.-->
			<?php if($idTipoProduto == "3488"){ ?>
            <div class="AdmTexto01" style="position: absolute; display: block; width: 605px; height: 405px; top: 15px; left: 13px; border: 1px solid #000000;">
				<?php include "SiteAdmProdutosEditarIncludeIdentificacao3488.php"; ?>
            </div>
			<?php } ?>
            <!--Identificação - Obras de Arte.-->
            
            <!--Salvar.-->
            <div style="position: absolute; display: block; bottom: 8px; left: 625px;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input type="hidden" id="idTbProdutos" name="idTbProdutos" value="<?php echo $idTbProdutos; ?>" />
                
                <input type="hidden" id="id_tb_categorias" name="id_tb_categorias" value="<?php echo $tbProdutosIdTbCategorias; ?>" />
                <input type="hidden" id="ativacao_promocao" name="ativacao_promocao" value="<?php echo $tbProdutosAtivacaoPromocao; ?>" />
                <input type="hidden" id="ativacao_home" name="ativacao_home" value="<?php echo $tbProdutosAtivacaoHome; ?>" />
                <input type="hidden" id="ativacao_home_categoria" name="ativacao_home_categoria" value="<?php echo $tbProdutosAtivacaoHomeCategoria; ?>" />
                <input type="hidden" id="acesso_restrito" name="acesso_restrito" value="<?php echo $tbProdutosAcessoRestrito; ?>" />
                
                <input type="hidden" id="paginaRetorno" name="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input type="hidden" id="masterPageSiteSelect" name="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            
    </form>
    <br />
            
            
            <!--Imagens.-->
            <div style="position: absolute; display: block; width: 350px; height: 365px; top: 15px; left: 625px; border: 1px solid #000000;">
            
            </div>
            <!--Imagens.-->
        </div>
        <!--Box principal.-->
        
        
        <!--Box histórico.-->
        <div style="position: absolute; display: block; width: 990px; height: 170px; top: 460px; left: 12px; border: 1px solid #000000; background-color: #efe4b0;">
        	<!--Títulos.-->
            <div style="position: absolute; display: block; /*height: 20px; */top: -8px; left: 13px; border: 1px solid #000000; background-color: #ffffff;">
            	<span class="SiteTitulos01" style="position: relative; display: block; padding: 3px 5px 3px 5px;">
                    Ficha T&eacute;cnica de Tratamento
                </span>
            </div>
            
            <!--Conteúdo.-->
            <div style="position: absolute; display: block; width: 738px; height: 120px; top: 15px; left: 13px; border: 1px solid #000000; background-color: #ffffff;">
            
            </div>
        </div>
        <!--Box histórico.-->
        
        
        <!--Paginação.-->
        <div style="position: absolute; display: block; top: 640px; left: 12px;">
			Controles
        </div>
    </div>
	<!--Box identificação.-->
    
    
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
unset($strSqlProdutosDetalhesSelect);
unset($statementProdutosDetalhesSelect);
unset($resultadoProdutosDetalhes);
unset($linhaProdutosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>