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
$idTbAulas = $_GET["idTbAulas"];
$idParentAulas = DbFuncoes::GetCampoGenerico01($idTbAulas, "tb_aulas", "id_parent");

$paginaRetorno = "SiteAdmAulasAdministrar.php";
$paginaRetornoExclusao = "SiteAdmAulasAdministrar.php";
$variavelRetorno = "idTbAulas";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
$queryPadrao = "&idParentAulas=" . $idParentAulas . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlAulasDetalhesSelect = "";
$strSqlAulasDetalhesSelect .= "SELECT ";
//$strSqlAulasDetalhesSelect .= "* ";
$strSqlAulasDetalhesSelect .= "id, ";
$strSqlAulasDetalhesSelect .= "id_parent, ";
$strSqlAulasDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlAulasDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlAulasDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlAulasDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlAulasDetalhesSelect .= "id_tb_cadastro4, ";
$strSqlAulasDetalhesSelect .= "id_tb_cadastro5, ";
$strSqlAulasDetalhesSelect .= "n_classificacao, ";
$strSqlAulasDetalhesSelect .= "data_criacao, ";
$strSqlAulasDetalhesSelect .= "data_aula, ";
$strSqlAulasDetalhesSelect .= "data1, ";
$strSqlAulasDetalhesSelect .= "data2, ";
$strSqlAulasDetalhesSelect .= "data3, ";
$strSqlAulasDetalhesSelect .= "data4, ";
$strSqlAulasDetalhesSelect .= "data5, ";
$strSqlAulasDetalhesSelect .= "data6, ";
$strSqlAulasDetalhesSelect .= "data7, ";
$strSqlAulasDetalhesSelect .= "data8, ";
$strSqlAulasDetalhesSelect .= "data9, ";
$strSqlAulasDetalhesSelect .= "data10, ";
$strSqlAulasDetalhesSelect .= "tema, ";
$strSqlAulasDetalhesSelect .= "descricao, ";
$strSqlAulasDetalhesSelect .= "local, ";
$strSqlAulasDetalhesSelect .= "id_tb_aulas_status, ";
$strSqlAulasDetalhesSelect .= "palavras_chave, ";
$strSqlAulasDetalhesSelect .= "valor, ";
$strSqlAulasDetalhesSelect .= "valor1, ";
$strSqlAulasDetalhesSelect .= "valor2, ";
$strSqlAulasDetalhesSelect .= "valor3, ";
$strSqlAulasDetalhesSelect .= "valor4, ";
$strSqlAulasDetalhesSelect .= "valor5, ";
$strSqlAulasDetalhesSelect .= "url1, ";
$strSqlAulasDetalhesSelect .= "url2, ";
$strSqlAulasDetalhesSelect .= "url3, ";
$strSqlAulasDetalhesSelect .= "url4, ";
$strSqlAulasDetalhesSelect .= "url5, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar1, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar2, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar3, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar4, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar5, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar6, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar7, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar8, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar9, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar10, ";

$strSqlAulasDetalhesSelect .= "informacao_complementar11, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar12, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar13, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar14, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar15, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar16, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar17, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar18, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar19, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar20, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar21, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar22, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar23, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar24, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar25, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar26, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar27, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar28, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar29, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar30, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar31, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar32, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar33, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar34, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar35, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar36, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar37, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar38, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar39, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar40, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar41, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar42, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar43, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar44, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar45, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar46, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar47, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar48, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar49, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar50, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar51, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar52, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar53, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar54, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar55, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar56, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar57, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar58, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar59, ";
$strSqlAulasDetalhesSelect .= "informacao_complementar60, ";
$strSqlAulasDetalhesSelect .= "carga_horaria, ";
$strSqlAulasDetalhesSelect .= "ativacao, ";
$strSqlAulasDetalhesSelect .= "ativacao1, ";
$strSqlAulasDetalhesSelect .= "ativacao2, ";
$strSqlAulasDetalhesSelect .= "ativacao3, ";
$strSqlAulasDetalhesSelect .= "ativacao4, ";
$strSqlAulasDetalhesSelect .= "reposicao, ";
$strSqlAulasDetalhesSelect .= "anotacoes_internas, ";
$strSqlAulasDetalhesSelect .= "n_visitas, ";
$strSqlAulasDetalhesSelect .= "acesso_restrito ";
$strSqlAulasDetalhesSelect .= "FROM tb_aulas ";
$strSqlAulasDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlAulasDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlAulasDetalhesSelect .= "AND id = :id ";
//$strSqlAulasDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//----------


//Criação de componentes.
//----------
$statementAulasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlAulasDetalhesSelect);

if ($statementAulasDetalhesSelect !== false)
{
	$statementAulasDetalhesSelect->execute(array(
		"id" => $idTbAulas
	));
}

//$resultadoAulasDetalhes = $dbSistemaConPDO->query($strSqlAulasDetalhesSelect);

$resultadoAulasDetalhes = $statementAulasDetalhesSelect->fetchAll();
//----------


if (empty($resultadoAulasDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoAulasDetalhes as $linhaAulasDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbAulasId = $linhaAulasDetalhes['id'];
		$tbAulasIdParent = $linhaAulasDetalhes['id_parent'];
		$tbAulasIdTbCadastroUsuario = $linhaAulasDetalhes['id_tb_cadastro_usuario'];
		
		$tbAulasIdTbCadastro1 = $linhaAulasDetalhes['id_tb_cadastro1'];
		$tbAulasIdTbCadastro2 = $linhaAulasDetalhes['id_tb_cadastro2'];
		$tbAulasIdTbCadastro3 = $linhaAulasDetalhes['id_tb_cadastro3'];
		$tbAulasIdTbCadastro4 = $linhaAulasDetalhes['id_tb_cadastro4'];
		$tbAulasIdTbCadastro5 = $linhaAulasDetalhes['id_tb_cadastro5'];
		
		$tbAulasNClassificacao = $linhaAulasDetalhes['n_classificacao'];
		
		$tbAulasDataCriacao = Funcoes::DataLeitura01($linhaAulasDetalhes['data_criacao'], $GLOBALS['configSistemaFormatoData'], "1");
		//$tbAulasDataAbertura = Funcoes::DataLeitura01($linhaAulasDetalhes['data_abertura'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaAulasDetalhes['data_aula'] == NULL)
		{
			$tbAulasDataAula = "";
		}else{
			$tbAulasDataAula = Funcoes::DataLeitura01($linhaAulasDetalhes['data_aula'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		if($linhaAulasDetalhes['data1'] == NULL)
		{
			$tbAulasData1 = "";
		}else{
			$tbAulasData1 = Funcoes::DataLeitura01($linhaAulasDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data2'] == NULL)
		{
			$tbAulasData2 = "";
		}else{
			$tbAulasData2 = Funcoes::DataLeitura01($linhaAulasDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data3'] == NULL)
		{
			$tbAulasData3 = "";
		}else{
			$tbAulasData3 = Funcoes::DataLeitura01($linhaAulasDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data4'] == NULL)
		{
			$tbAulasData4 = "";
		}else{
			$tbAulasData4 = Funcoes::DataLeitura01($linhaAulasDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data5'] == NULL)
		{
			$tbAulasData5 = "";
		}else{
			$tbAulasData5 = Funcoes::DataLeitura01($linhaAulasDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data6'] == NULL)
		{
			$tbAulasData6 = "";
		}else{
			$tbAulasData6 = Funcoes::DataLeitura01($linhaAulasDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data7'] == NULL)
		{
			$tbAulasData7 = "";
		}else{
			$tbAulasData7 = Funcoes::DataLeitura01($linhaAulasDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data8'] == NULL)
		{
			$tbAulasData8 = "";
		}else{
			$tbAulasData8 = Funcoes::DataLeitura01($linhaAulasDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data9'] == NULL)
		{
			$tbAulasData9 = "";
		}else{
			$tbAulasData9 = Funcoes::DataLeitura01($linhaAulasDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data10'] == NULL)
		{
			$tbAulasData10 = "";
		}else{
			$tbAulasData10 = Funcoes::DataLeitura01($linhaAulasDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		$tbAulasTema = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['tema']);
		$tbAulasDescricao = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['descricao']);
		$tbAulasLocal = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['local']);

		$tbAulasIdTbAulasStatus = $linhaAulasDetalhes['id_tb_aulas_status'];
		$tbAulasPalavrasChave = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['palavras_chave']);
		
		$tbAulasValor = Funcoes::MascaraValorLer($linhaAulasDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbAulasValor1 = Funcoes::MascaraValorLer($linhaAulasDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
		$tbAulasValor2 = Funcoes::MascaraValorLer($linhaAulasDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
		$tbAulasValor3 = Funcoes::MascaraValorLer($linhaAulasDetalhes['valor3'], $GLOBALS['configSistemaMoeda']);
		$tbAulasValor4 = Funcoes::MascaraValorLer($linhaAulasDetalhes['valor4'], $GLOBALS['configSistemaMoeda']);
		$tbAulasValor5 = Funcoes::MascaraValorLer($linhaAulasDetalhes['valor5'], $GLOBALS['configSistemaMoeda']);
		$tbAulasURL1 = $linhaAulasDetalhes['url1'];
		$tbAulasURL2 = $linhaAulasDetalhes['url2'];
		$tbAulasURL3 = $linhaAulasDetalhes['url3'];
		$tbAulasURL4 = $linhaAulasDetalhes['url4'];
		$tbAulasURL5 = $linhaAulasDetalhes['url5'];

		$tbAulasIC1 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar1']);
		$tbAulasIC2 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar2']);
		$tbAulasIC3 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar3']);
		$tbAulasIC4 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar4']);
		$tbAulasIC5 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar5']);
		$tbAulasIC6 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar6']);
		$tbAulasIC7 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar7']);
		$tbAulasIC8 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar8']);
		$tbAulasIC9 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar9']);
		$tbAulasIC10 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar10']);
		$tbAulasIC11 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar11']);
		$tbAulasIC12 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar12']);
		$tbAulasIC13 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar13']);
		$tbAulasIC14 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar14']);
		$tbAulasIC15 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar15']);
		$tbAulasIC16 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar16']);
		$tbAulasIC17 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar17']);
		$tbAulasIC18 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar18']);
		$tbAulasIC19 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar19']);
		$tbAulasIC20 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar20']);
		$tbAulasIC21 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar21']);
		$tbAulasIC22 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar22']);
		$tbAulasIC23 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar23']);
		$tbAulasIC24 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar24']);
		$tbAulasIC25 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar25']);
		$tbAulasIC26 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar26']);
		$tbAulasIC27 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar27']);
		$tbAulasIC28 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar28']);
		$tbAulasIC29 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar29']);
		$tbAulasIC30 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar30']);
		$tbAulasIC31 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar31']);
		$tbAulasIC32 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar32']);
		$tbAulasIC33 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar33']);
		$tbAulasIC34 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar34']);
		$tbAulasIC35 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar35']);
		$tbAulasIC36 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar36']);
		$tbAulasIC37 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar37']);
		$tbAulasIC38 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar38']);
		$tbAulasIC39 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar39']);
		$tbAulasIC40 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar40']);
		$tbAulasIC41 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar41']);
		$tbAulasIC42 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar42']);
		$tbAulasIC43 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar43']);
		$tbAulasIC44 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar44']);
		$tbAulasIC45 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar45']);
		$tbAulasIC46 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar46']);
		$tbAulasIC47 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar47']);
		$tbAulasIC48 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar48']);
		$tbAulasIC49 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar49']);
		$tbAulasIC50 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar50']);
		$tbAulasIC51 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar51']);
		$tbAulasIC52 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar52']);
		$tbAulasIC53 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar53']);
		$tbAulasIC54 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar54']);
		$tbAulasIC55 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar55']);
		$tbAulasIC56 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar56']);
		$tbAulasIC57 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar57']);
		$tbAulasIC58 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar58']);
		$tbAulasIC59 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar59']);
		$tbAulasIC60 = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['informacao_complementar60']);
		
		$tbAulasCargaHoraria = $linhaAulasDetalhes['carga_horaria'];

		$tbAulasAtivacao = $linhaAulasDetalhes['ativacao'];
		$tbAulasAtivacao1 = $linhaAulasDetalhes['ativacao1'];
		$tbAulasAtivacao2 = $linhaAulasDetalhes['ativacao2'];
		$tbAulasAtivacao3 = $linhaAulasDetalhes['ativacao3'];
		$tbAulasAtivacao4 = $linhaAulasDetalhes['ativacao4'];
		$tbAulasReposicao = $linhaAulasDetalhes['reposicao'];

		$tbAulasAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaAulasDetalhes['anotacoes_internas']);
		$tbAulasNVisitas = $linhaAulasDetalhes['n_visitas'];
		$tbAulasAcessoRestrito = $linhaAulasDetalhes['acesso_restrito'];
		
		//Verificação de erro.
		//echo "tbAulasId=" . $tbAulasId . "<br>";
		//echo "tbAulasProcesso=" . $tbAulasProcesso . "<br>";
		//echo "tbAulasIC60=" . $tbAulasIC60 . "<br>";
	}
}


//Definição de variáveis.
if($tituloLinkAtual == ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemGerenciarAula");
}
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "habilitarTurmasSistemaPaginacao=" . $habilitarTurmasSistemaPaginacao . "<br />";
//echo "strSqlTurmasSelect=" . $strSqlTurmasSelect . "<br />";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo $metaTitulo; ?>
<?php 
$pageSite->cphTitle = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Head.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphHead*/ ?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelProcessosAdministrar"); ?>
	<?php echo $tituloLinkAtual; ?>
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
    
    <?php //Cadastros vinculados.?>
	<?php //**************************************************************************************?>
    <?php
	//id do módulo - $tbAulasIdParent
	
	//id da turma.
	$idTbTurma = DbFuncoes::GetCampoGenerico01($tbAulasIdParent, "tb_modulos", "id_parent");
	
	//Cadastros vinculados
	$itensRelacaoRegistrosSelect13 = DbFuncoes::GetCampoGenerico06("tb_itens_relacao_registros", 
	"id_registro", 
	"id_item", 
	$idTbTurma, 
	"", 
	"", 
	1, 
	"", 
	"", 
	"tipo_categoria", 
	"13", 
	"", 
	"");
	
	
	//Verificação de erro - debug.
	//echo "itensRelacaoRegistrosSelect13=" . $itensRelacaoRegistrosSelect13 . "<br />";
	//echo "tbAulasIdParent=" . $tbAulasIdParent . "<br />";
	//echo "idTbTurma=" . $idTbTurma . "<br />";
	?>
    
    <?php if($itensRelacaoRegistrosSelect13 == ""){ ?>
        <div align="center" class="TextoErro">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
        </div>
    <?php }else{ ?>
		<?php
        //Definição de variáveis.
        $idParentCadastro = "";
		$idsTbCadastro = $itensRelacaoRegistrosSelect13;
    
        
        //Query de pesquisa.
        //----------
        $strSqlCadastroSelect = "";
        $strSqlCadastroSelect .= "SELECT ";
        //$strSqlCadastroSelect .= "SELECT SQL_CALC_FOUND_ROWS ";
        //$strSqlCadastroSelect .= "* ";
        $strSqlCadastroSelect .= "id, ";
        $strSqlCadastroSelect .= "id_tb_categorias, ";
        //$strSqlCadastroSelect .= "id_parent_cadastro, ";
        $strSqlCadastroSelect .= "data_cadastro, ";
        $strSqlCadastroSelect .= "pf_pj, ";
        $strSqlCadastroSelect .= "nome, ";
        $strSqlCadastroSelect .= "sexo, ";
        $strSqlCadastroSelect .= "altura, ";
        $strSqlCadastroSelect .= "peso, ";
        $strSqlCadastroSelect .= "razao_social, ";
        $strSqlCadastroSelect .= "nome_fantasia, ";
        $strSqlCadastroSelect .= "data_nascimento, ";
        $strSqlCadastroSelect .= "cpf_, ";
        $strSqlCadastroSelect .= "rg_, ";
        $strSqlCadastroSelect .= "cnpj_, ";
        $strSqlCadastroSelect .= "documento, ";
        $strSqlCadastroSelect .= "i_municipal, ";
        $strSqlCadastroSelect .= "i_estadual, ";
        
        $strSqlCadastroSelect .= "endereco_principal, ";
        $strSqlCadastroSelect .= "endereco_numero_principal, ";
        $strSqlCadastroSelect .= "endereco_complemento_principal, ";
        $strSqlCadastroSelect .= "bairro_principal, ";
        $strSqlCadastroSelect .= "cidade_principal, ";
        $strSqlCadastroSelect .= "estado_principal, ";
        $strSqlCadastroSelect .= "pais_principal, ";
        $strSqlCadastroSelect .= "cep_principal, ";
        
        $strSqlCadastroSelect .= "ponto_referencia, ";
        $strSqlCadastroSelect .= "email_principal, ";
        $strSqlCadastroSelect .= "tel_ddd_principal, ";
        $strSqlCadastroSelect .= "tel_principal, ";
        $strSqlCadastroSelect .= "cel_ddd_principal, ";
        $strSqlCadastroSelect .= "cel_principal, ";
        $strSqlCadastroSelect .= "fax_ddd_principal, ";
        $strSqlCadastroSelect .= "fax_principal, ";
        $strSqlCadastroSelect .= "site_principal, ";
        $strSqlCadastroSelect .= "n_funcionarios, ";
        $strSqlCadastroSelect .= "obs_interno, ";
        $strSqlCadastroSelect .= "id_tb_cadastro_status, ";
        //$strSqlCadastroSelect .= "id_tb_cadastro, ";
        $strSqlCadastroSelect .= "id_tb_cadastro1, ";
        $strSqlCadastroSelect .= "id_tb_cadastro2, ";
        $strSqlCadastroSelect .= "id_tb_cadastro3, ";
        $strSqlCadastroSelect .= "ativacao, ";
        $strSqlCadastroSelect .= "ativacao_destaque, ";
        $strSqlCadastroSelect .= "ativacao_mala_direta, ";
        $strSqlCadastroSelect .= "usuario, ";
        $strSqlCadastroSelect .= "senha, ";
        
        $strSqlCadastroSelect .= "imagem, ";
        $strSqlCadastroSelect .= "logo, ";
        $strSqlCadastroSelect .= "banner, ";
        $strSqlCadastroSelect .= "mapa, ";
        
        $strSqlCadastroSelect .= "mapa_online, ";
        $strSqlCadastroSelect .= "palavras_chave, ";
        $strSqlCadastroSelect .= "apresentacao, ";
        $strSqlCadastroSelect .= "servicos, ";
        $strSqlCadastroSelect .= "promocoes, ";
        $strSqlCadastroSelect .= "condicoes_comerciais, ";
        $strSqlCadastroSelect .= "formas_pagamento, ";
        $strSqlCadastroSelect .= "horario_atendimento, ";
        $strSqlCadastroSelect .= "situacao_atual, ";
        
        $strSqlCadastroSelect .= "informacao_complementar1, ";
        $strSqlCadastroSelect .= "informacao_complementar2, ";
        $strSqlCadastroSelect .= "informacao_complementar3, ";
        $strSqlCadastroSelect .= "informacao_complementar4, ";
        $strSqlCadastroSelect .= "informacao_complementar5, ";
        $strSqlCadastroSelect .= "informacao_complementar6, ";
        $strSqlCadastroSelect .= "informacao_complementar7, ";
        $strSqlCadastroSelect .= "informacao_complementar8, ";
        $strSqlCadastroSelect .= "informacao_complementar9, ";
        $strSqlCadastroSelect .= "informacao_complementar10, ";
        $strSqlCadastroSelect .= "informacao_complementar11, ";
        $strSqlCadastroSelect .= "informacao_complementar12, ";
        $strSqlCadastroSelect .= "informacao_complementar13, ";
        $strSqlCadastroSelect .= "informacao_complementar14, ";
        $strSqlCadastroSelect .= "informacao_complementar15, ";
        $strSqlCadastroSelect .= "informacao_complementar16, ";
        $strSqlCadastroSelect .= "informacao_complementar17, ";
        $strSqlCadastroSelect .= "informacao_complementar18, ";
        $strSqlCadastroSelect .= "informacao_complementar19, ";
        $strSqlCadastroSelect .= "informacao_complementar20, ";
        $strSqlCadastroSelect .= "informacao_complementar21, ";
        $strSqlCadastroSelect .= "informacao_complementar22, ";
        $strSqlCadastroSelect .= "informacao_complementar23, ";
        $strSqlCadastroSelect .= "informacao_complementar24, ";
        $strSqlCadastroSelect .= "informacao_complementar25, ";
        $strSqlCadastroSelect .= "informacao_complementar26, ";
        $strSqlCadastroSelect .= "informacao_complementar27, ";
        $strSqlCadastroSelect .= "informacao_complementar28, ";
        $strSqlCadastroSelect .= "informacao_complementar29, ";
        $strSqlCadastroSelect .= "informacao_complementar30, ";
        $strSqlCadastroSelect .= "informacao_complementar31, ";
        $strSqlCadastroSelect .= "informacao_complementar32, ";
        $strSqlCadastroSelect .= "informacao_complementar33, ";
        $strSqlCadastroSelect .= "informacao_complementar34, ";
        $strSqlCadastroSelect .= "informacao_complementar35, ";
        $strSqlCadastroSelect .= "informacao_complementar36, ";
        $strSqlCadastroSelect .= "informacao_complementar37, ";
        $strSqlCadastroSelect .= "informacao_complementar38, ";
        $strSqlCadastroSelect .= "informacao_complementar39, ";
        $strSqlCadastroSelect .= "informacao_complementar40, ";
        $strSqlCadastroSelect .= "n_visitas ";
        $strSqlCadastroSelect .= "FROM tb_cadastro ";
        $strSqlCadastroSelect .= "WHERE id <> 0 ";
		
        if($idParentCadastro <> "")
        {
            $strSqlCadastroSelect .= "AND id_tb_categorias = :id_tb_categorias ";
        }
		
        if($idsTbCadastro <> "")
        {
            $strSqlCadastroSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbCadastro) . ") ";
        }
		
        $strSqlCadastroSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
		//echo "strSqlCadastroSelect=" . $strSqlCadastroSelect . "<br />";
		//echo "idParentCadastro=" . $idParentCadastro . "<br />";
        //----------
        
        
        //Criação de componentes.
        //----------
        $statementCadastroSelect = $dbSistemaConPDO->prepare($strSqlCadastroSelect);
        
        if ($statementCadastroSelect !== false)
        {
            if($idParentCadastro <> "")
            {
                $statementCadastroSelect->bindParam(':id_tb_categorias', $idParentCadastro, PDO::PARAM_STR);
            }
            $statementCadastroSelect->execute();
            /*
            //"idsTdCadastro" => $idsTdCadastro
            $statementCadastroSelect->execute(array(
                "id_tb_categorias" => $idParentCadastro
            ));
            */
        }
        
        $resultadoCadastro = $statementCadastroSelect->fetchAll();
        //----------
        ?>
        
		<?php
        if(empty($resultadoCadastro))
        {
            //echo "Nenhum registro encontrado";
        }else{
        ?>
            <div style="position: relative; display: block; overflow: hidden;">
                <form name="formItensRelacaoRegistrosIndice" id="formItensRelacaoRegistrosIndice" action="SiteAdmRegistrosAcoesExe.php" method="post" class="FormularioTabela01">
                    <input name="idTbAulas" id="idTbAulas" type="hidden" value="<?php echo $idTbAulas; ?>" />
                    <input name="strTabela" id="strTabela" type="hidden" value="<?php echo $strTabela; ?>" />
        
                    <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                    <input name="variavelRetorno" type="hidden" id="variavelRetorno" value="<?php echo $variavelRetorno; ?>" />
                    <input name="idRegistroRetorno" type="hidden" id="idRegistroRetorno" value="<?php echo $idItem; ?>" />
                    
                    <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
                    <input name="paginacaoNumero" type="hidden" id="paginacaoNumero" value="<?php echo $paginacaoNumero; ?>" />
                    <input name="caracterAtual" type="hidden" id="caracterAtual" value="<?php echo $caracterAtual; ?>" />
                
                    <table width="100%" class="AdmTabelaDados01">
                      <tr class="AdmTbFundoEscuro">
                      
                        <td class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastro"); ?>
                            </div>
                        </td>
                        
                        <?php if($GLOBALS['habilitarLogFiltroGenerico01'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico01Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <?php if($GLOBALS['habilitarLogFiltroGenerico02'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico02Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarLogFiltroGenerico03'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico03Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarLogFiltroGenerico04'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico04Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarLogFiltroGenerico05'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico05Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <?php if($GLOBALS['habilitarLogFiltroGenerico06'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico06Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <?php if($GLOBALS['habilitarLogFiltroGenerico07'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico07Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarLogFiltroGenerico08'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico08Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarLogFiltroGenerico09'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico09Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>

                        <?php if($GLOBALS['habilitarLogFiltroGenerico10'] == 1){ ?>
                        <td width="100" class="AdmTabelaDados01Celula">
                            <div class="AdmTexto02">
                                <?php echo htmlentities($GLOBALS['configLogFiltroGenerico10Nome']); ?>
                            </div>
                        </td>
                        <?php } ?>
                        
                        <!--td width="100" class="AdmTabelaDados01Celula">
                            <div align="center" class="AdmTexto02">
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFuncoes"); ?>
                            </div>
                        </td-->
                      </tr>
                      
						<?php
						$countTabelaFundo = 0;
						
						//Filtros genéricos.
						if($GLOBALS['habilitarLogFiltroGenerico01'] == 1){
							$arrLogFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 12);
						}
						
						if($GLOBALS['habilitarLogFiltroGenerico02'] == 1){
							$arrLogFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 13);
						}
						
						if($GLOBALS['habilitarLogFiltroGenerico03'] == 1){
							$arrLogFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 14);
						}

						if($GLOBALS['habilitarLogFiltroGenerico04'] == 1){
							$arrLogFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 15);
						}

						if($GLOBALS['habilitarLogFiltroGenerico05'] == 1){
							$arrLogFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 16);
						}

						if($GLOBALS['habilitarLogFiltroGenerico06'] == 1){
							$arrLogFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 17);
						}

						if($GLOBALS['habilitarLogFiltroGenerico07'] == 1){
							$arrLogFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 18);
						}

						if($GLOBALS['habilitarLogFiltroGenerico08'] == 1){
							$arrLogFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 19);
						}

						if($GLOBALS['habilitarLogFiltroGenerico09'] == 1){
							$arrLogFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 20);
						}

						if($GLOBALS['habilitarLogFiltroGenerico10'] == 1){
							$arrLogFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_log_complemento", 21);
						}
						
						//Seleção dos logs da aula (log_tipo = 21).
						//----------------------
						$idsLog21 = DbFuncoes::GetCampoGenerico06("tb_log", 
																	"id", 
																	"id_registro", 
																	$idTbAulas, 
																	"", 
																	"", 
																	1, 
																	"", 
																	"", 
																	"", 
																	"", 
																	"log_tipo", 
																	"21");
						$idsLog21RelacaoComplemento = "";
																	
						if($idsLog21 <> "")
						{
							$arrIdsLog21 = explode(",", $idsLog21);
							
							for($countArray = 0; $countArray < count($arrIdsLog21); $countArray++)
							{
								if($idsLog21RelacaoComplemento <> "")
								{
									$idsLog21RelacaoComplemento .= "," . DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																								"id_tb_log_complemento", 
																								"id_tb_log", 
																								$arrIdsLog21[$countArray], 
																								"", 
																								"", 
																								1, 
																								"", 
																								"", 
																								"", 
																								"", 
																								"", 
																								"");
								}else{
									$idsLog21RelacaoComplemento .= DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																								"id_tb_log_complemento", 
																								"id_tb_log", 
																								$arrIdsLog21[$countArray], 
																								"", 
																								"", 
																								1, 
																								"", 
																								"", 
																								"", 
																								"", 
																								"", 
																								"");
									
								}
							}
						}
						
						//Tratamento da variável para retirar a última vírgula.
						$idsLog21RelacaoComplemento = Funcoes::IdsFormatar01($idsLog21RelacaoComplemento);
						
						$arrIdsLog21RelacaoComplemento = explode(",", $idsLog21RelacaoComplemento);
						//----------------------
						
						
                        //Loop pelos resultados.
                        foreach($resultadoCadastro as $linhaCadastro)
                        {
                            //echo "id=" . $linhaCategorias['id'] . "<br />";
							
							
							//Seleção de log da aula registrado para o cadastro.
							//----------------------
							//value="id_tb_log_complemento;id_tb_cadastro;log_tipo(tb_log);tipo_categoria(tb_log);tabela"
							$idsLog21CadastroAula = DbFuncoes::GetCampoGenerico06("tb_log", 
																				"id", 
																				"id_registro", 
																				$idTbAulas, 
																				"", 
																				"", 
																				1, 
																				"", 
																				"", 
																				"id_tb_cadastro", 
																				$linhaCadastro['id'], 
																				"", 
																				"");
															
							$arrIdsLog21CadastroAula = explode(",", $idsLog21CadastroAula);
							
							//Verificação de erro - debug.
							//echo "idsLog21CadastroAula=" . $idsLog21CadastroAula . "<br />";
							//echo "arrIdsLog21CadastroAula=" . print_r(array_values($arrIdsLog21CadastroAula)) . "<br />";
							//echo "arrIdsLog21CadastroAula=" . print_r($arrIdsLog21CadastroAula) . "<br />";
							//----------------------
                        ?>
                          <tr class="<?php if($countTabelaFundo == 0){ ?>AdmTbFundoClaro<?php }else{?>AdmTbFundoAlternativo<?php } ?>">
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01" style="/*padding-left: 20px;*/">
                                	<a href="SiteAdmCadastroAdministrar.php?idTbCadastro=<?php echo $linhaCadastro['id'];?>&masterPageSiteSelect=LayoutSiteSemMenu.php" target="_blank" class="AdmLinks01">
										<?php //echo Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']);?>
                                        <?php echo Funcoes::GetCadastroTitulo(Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome']), 
                                                                            Funcoes::ConteudoMascaraLeitura($linhaCadastro['razao_social']), 
                                                                            Funcoes::ConteudoMascaraLeitura($linhaCadastro['nome_fantasia']), 
                                                                            1); 
                                        ?>
                                    </a>
                                </div>
                                <?php //echo "itensRelacaoRegistrosSelect13=" . $itensRelacaoRegistrosSelect13 . "<br />"; ?>
                                <?php //echo "idsLog21=" . $idsLog21 . "<br />"; ?>
                                <?php //echo "arrLogFiltroGenerico01Selecao=" . print_r(array_values($arrLogFiltroGenerico01Selecao)) . "<br />"; ?>
                                <?php //echo "idsLog21RelacaoComplemento=" . $idsLog21RelacaoComplemento . "<br />"; ?>
                            </td>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico01'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico01CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico01); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico01[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico01[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico01[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico01CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico01[]" name="idsLogFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico01); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico01[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico01[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico01CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico01[]" name="idsLogFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico01); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico01Check = false;
												
												//Verificação de relação complemento.
												//if(in_array(strval($arrLogFiltroGenerico01[$countArray][0]), $arrIdsLog21RelacaoComplemento, true) == true)
												/*
												if(in_array($arrLogFiltroGenerico01[$countArray][0], $arrIdsLog21RelacaoComplemento, true) == true)
												{
													echo "arrLogFiltroGenerico01=" . $arrLogFiltroGenerico01[$countArray][0] . "<br />";
													$logFiltroGenerico01Check = true;
												}
												*/
												
												//if(in_array($linhaCadastro['id'], $arrIdsLog21CadastroAula, true) == true)
												//{
													/*
													for($countArray = 0; $countArray < count($arrIdsLog21RelacaoComplemento); $countArray++)
													{
														echo "arrIdsLog21RelacaoComplemento=" . $arrIdsLog21RelacaoComplemento[$countArray] . "<br />";
														echo "arrIdsLog21CadastroAula=" . print_r($arrIdsLog21CadastroAula) . "<br />";
														
														if(in_array($arrIdsLog21RelacaoComplemento[$countArray], $arrIdsLog21CadastroAula, true) == true)
														//if(in_array(strval($arrIdsLog21RelacaoComplemento[$countArray]), $arrIdsLog21CadastroAula, true) == true)
														{
															$logFiltroGenerico01Check = true;
														}
													}
													*/
												//}
												
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													//echo "arrIdsLog21CadastroAula=" . $arrIdsLog21CadastroAula[$countArrayCadastroAula] . "<br />";
													//echo "arrIdsLog21RelacaoComplemento=" . print_r($arrIdsLog21RelacaoComplemento) . "<br />";
													//if(in_array($arrIdsLog21CadastroAula[$countArrayCadastroAula], $arrIdsLog21RelacaoComplemento, true) == true)
													/*
													if(in_array($arrLogFiltroGenerico01[$countArray][0], $arrIdsLog21RelacaoComplemento, true) == true)
													{
														$logFiltroGenerico01Check = true;
													}
													*/
													/*
													if($linhaCadastro['id'] == $arrIdsLog21CadastroAula[$countArrayCadastroAula])
													{
													}
													*/
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"12", 
																						"", 
																						"") == $arrLogFiltroGenerico01[$countArray][0])
													{
														$logFiltroGenerico01Check = true;
													}
													
												}
												
												/*
												if(in_array($arrLogFiltroGenerico01[$countArray][0], $arrIdsLog21RelacaoComplemento, true) == true)
												{
													$logFiltroGenerico01Check = true;
												}
												*/
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico01[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico01Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico01[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico01)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico02'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico02CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico02); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico02[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico02[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico02[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico02CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico02[]" name="idsLogFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico02); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico02[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico02[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico02CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico02[]" name="idsLogFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico02); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico02Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"13", 
																						"", 
																						"") == $arrLogFiltroGenerico02[$countArray][0])
													{
														$logFiltroGenerico02Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico02[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico02Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico02[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico02)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico03'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico03CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico03); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico03[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico03[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico03[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico03CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico03[]" name="idsLogFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico03); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico03[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico03[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico03CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico03[]" name="idsLogFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico03); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico03Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"14", 
																						"", 
																						"") == $arrLogFiltroGenerico03[$countArray][0])
													{
														$logFiltroGenerico03Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico03[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico03Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico03[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico03)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico04'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico04CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico04); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico04[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico04[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico04[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico04CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico04[]" name="idsLogFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico04); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico04[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico04[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico04CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico04[]" name="idsLogFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico04); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico04Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"15", 
																						"", 
																						"") == $arrLogFiltroGenerico04[$countArray][0])
													{
														$logFiltroGenerico04Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico04[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico04Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico04[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico04)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico05'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico05CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico05); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico05[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico05[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico05[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico05CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico05[]" name="idsLogFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico05[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico05CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico05[]" name="idsLogFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico05); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico05Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"16", 
																						"", 
																						"") == $arrLogFiltroGenerico05[$countArray][0])
													{
														$logFiltroGenerico05Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico05[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico05Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico05[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico05)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico06'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico06CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico06); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico06[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico06[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico06[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico06CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico06[]" name="idsLogFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico06[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico06CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico06[]" name="idsLogFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico06); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico06Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"17", 
																						"", 
																						"") == $arrLogFiltroGenerico06[$countArray][0])
													{
														$logFiltroGenerico06Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico06[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico06Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico06[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico06)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico07'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico07CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico07); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico07[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico07[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico07[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico07CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico07[]" name="idsLogFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico07[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico07CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico07[]" name="idsLogFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico07); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico07Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"18", 
																						"", 
																						"") == $arrLogFiltroGenerico07[$countArray][0])
													{
														$logFiltroGenerico07Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico07[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico07Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico07[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico07)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico08'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico08CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico08); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico08[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico08[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico08[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico08CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico08[]" name="idsLogFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico08[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico08CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico08[]" name="idsLogFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico08); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico08Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"19", 
																						"", 
																						"") == $arrLogFiltroGenerico08[$countArray][0])
													{
														$logFiltroGenerico08Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico08[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico08Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico08[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico08)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico09'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico09CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico09); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico09[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico09[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico09[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico09CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico09[]" name="idsLogFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico09[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico09CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico09[]" name="idsLogFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico09); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico09Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"20", 
																						"", 
																						"") == $arrLogFiltroGenerico09[$countArray][0])
													{
														$logFiltroGenerico09Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico09[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico09Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico09[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico09)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <?php if($GLOBALS['habilitarLogFiltroGenerico10'] == 1){ ?>
                            <td class="AdmTabelaDados01Celula">
                                <div class="AdmTexto01">
									<?php if($GLOBALS['configLogFiltroGenerico10CaixaSelecao'] == 1){ ?>
                                        <?php 
                                        for($countArray = 0; $countArray < count($arrLogFiltroGenerico10); $countArray++)
                                        {
                                        ?>
                                            <div>
                                                <input name="idsLogFiltroGenerico10[]" type="checkbox" value="<?php echo $arrLogFiltroGenerico10[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro" class="AdmCampoCheckBox01" /> <?php echo $arrLogFiltroGenerico10[$countArray][1];?>
                                            </div>
                                        <?php 
                                        }
                                        ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico10CaixaSelecao'] == 2){ ?>
                                        <select id="idsLogFiltroGenerico10[]" name="idsLogFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                                <option value="<?php echo $arrLogFiltroGenerico10[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"><?php echo $arrLogFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select> 
                                        <br />
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                                    <?php } ?>
                                    <?php if($GLOBALS['configLogFiltroGenerico10CaixaSelecao'] == 3){ ?>
                                        <select id="idsLogFiltroGenerico10[]" name="idsLogFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                            <!--option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option-->
                                            <option value=""></option>
                                            <?php 
                                            for($countArray = 0; $countArray < count($arrLogFiltroGenerico10); $countArray++)
                                            {
                                            ?>
                                            	<?php 
												$logFiltroGenerico10Check = false;
												
												//Verificação de relação complemento.
												for($countArrayCadastroAula = 0; $countArrayCadastroAula < count($arrIdsLog21CadastroAula); $countArrayCadastroAula++)
												{
													if(DbFuncoes::GetCampoGenerico06("tb_log_relacao_complemento", 
																						"id_tb_log_complemento", 
																						"id_tb_log", 
																						$arrIdsLog21CadastroAula[$countArrayCadastroAula], 
																						"", 
																						"", 
																						2, 
																						"", 
																						"", 
																						"tipo_complemento", 
																						"21", 
																						"", 
																						"") == $arrLogFiltroGenerico10[$countArray][0])
													{
														$logFiltroGenerico10Check = true;
													}
												}
												?>
                                                
                                                <option value="<?php echo $arrLogFiltroGenerico10[$countArray][0];?>;<?php echo $linhaCadastro['id'];?>;21;13;tb_cadastro"<?php if($logFiltroGenerico10Check == true){?> selected="selected"<?php } ?>><?php echo $arrLogFiltroGenerico10[$countArray][1];?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    <?php } ?>
                                    
                                    <?php if(empty($arrLogFiltroGenerico10)){ ?>
                                        <a href="SiteAdmLogManutencao.php" class="AdmLinks01">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php } ?>
                            
                            <!--td class="AdmTabelaDados01Celula">
                                <div align="center" class="AdmTexto01">
                                    <input name="idsRegistrosSelecionar[]" type="checkbox" value="<?php echo $linhaCadastro['id'];?>" class="AdmCampoCheckBox01"<?php if(in_array($linhaCadastro['id'], $arrItensRelacaoRegistrosSelect13, true) == true){?> checked="checked"<?php } ?> />
                                </div>
                            </td-->
                          </tr>
					  <?php 
                          //Linha alternativa de tabela.
                          //----------
                          //$countTabelaFundo = $countTabelaFundo + 1;
                          $countTabelaFundo++;
                        
                           if($countTabelaFundo == 2)
                           {
                               $countTabelaFundo = 0;
                           }
                          //----------
                      } 
                      ?>
                        
                    </table>
                    <div>
                        <div style="float:left;">
                            <input type="image" name="btoLog01" value="Submit" src="img/btoSalvar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSalvar"); ?>" />
                        </div>
                        <div style="float:right;">
                            &nbsp;
                        </div>
                    </div>
                </form>
            </div>
		<?php } ?>
    
        <?php
        //Limpeza de objetos.
        //----------
        unset($strSqlCadastroSelect);
        unset($statementCadastroSelect);
        unset($resultadoCadastro);
        unset($linhaCadastro);
        //----------
        ?>
	<?php } ?>
	<?php //**************************************************************************************?>

<?php 
$pageSite->cphConteudoPrincipal = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php
//Limpeza de objetos.
//----------
unset($strSqlAulasDetalhesSelect);
unset($statementAulasDetalhesSelect);
unset($resultadoAulasDetalhes);
unset($linhaAulasDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>