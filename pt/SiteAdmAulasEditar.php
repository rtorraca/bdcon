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

$paginaRetorno = "SiteAdmAulasIndice.php";
$paginaRetornoExclusao = "SiteAdmAulasEditar.php";
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


$statementAulasDetalhesSelect = $dbSistemaConPDO->prepare($strSqlAulasDetalhesSelect);

if ($statementAulasDetalhesSelect !== false)
{
	$statementAulasDetalhesSelect->execute(array(
		"id" => $idTbAulas
	));
}

//$resultadoAulasDetalhes = $dbSistemaConPDO->query($strSqlAulasDetalhesSelect);

$resultadoAulasDetalhes = $statementAulasDetalhesSelect->fetchAll();

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
		
		$tbAulasDataCriacao = Funcoes::DataLeitura01($linhaAulasDetalhes['data_criacao'], $GLOBALS['configSiteFormatoData'], "1");
		//$tbAulasDataAbertura = Funcoes::DataLeitura01($linhaAulasDetalhes['data_abertura'], $GLOBALS['configSiteFormatoData'], "1");
		if($linhaAulasDetalhes['data_aula'] == NULL)
		{
			$tbAulasDataAula = "";
		}else{
			$tbAulasDataAula = Funcoes::DataLeitura01($linhaAulasDetalhes['data_aula'], $GLOBALS['configSiteFormatoData'], "1");
		}
		
		if($linhaAulasDetalhes['data1'] == NULL)
		{
			$tbAulasData1 = "";
		}else{
			$tbAulasData1 = Funcoes::DataLeitura01($linhaAulasDetalhes['data1'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data2'] == NULL)
		{
			$tbAulasData2 = "";
		}else{
			$tbAulasData2 = Funcoes::DataLeitura01($linhaAulasDetalhes['data2'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data3'] == NULL)
		{
			$tbAulasData3 = "";
		}else{
			$tbAulasData3 = Funcoes::DataLeitura01($linhaAulasDetalhes['data3'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data4'] == NULL)
		{
			$tbAulasData4 = "";
		}else{
			$tbAulasData4 = Funcoes::DataLeitura01($linhaAulasDetalhes['data4'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data5'] == NULL)
		{
			$tbAulasData5 = "";
		}else{
			$tbAulasData5 = Funcoes::DataLeitura01($linhaAulasDetalhes['data5'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data6'] == NULL)
		{
			$tbAulasData6 = "";
		}else{
			$tbAulasData6 = Funcoes::DataLeitura01($linhaAulasDetalhes['data6'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data7'] == NULL)
		{
			$tbAulasData7 = "";
		}else{
			$tbAulasData7 = Funcoes::DataLeitura01($linhaAulasDetalhes['data7'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data8'] == NULL)
		{
			$tbAulasData8 = "";
		}else{
			$tbAulasData8 = Funcoes::DataLeitura01($linhaAulasDetalhes['data8'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data9'] == NULL)
		{
			$tbAulasData9 = "";
		}else{
			$tbAulasData9 = Funcoes::DataLeitura01($linhaAulasDetalhes['data9'], $GLOBALS['configSiteFormatoData'], "1");
		}
		if($linhaAulasDetalhes['data10'] == NULL)
		{
			$tbAulasData10 = "";
		}else{
			$tbAulasData10 = Funcoes::DataLeitura01($linhaAulasDetalhes['data10'], $GLOBALS['configSiteFormatoData'], "1");
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
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAdmPainelAulasIndice");
}
if($palavraChave <> ""){
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBuscaResultados");
}
$metaTitulo = $tituloLinkAtual . " - " . htmlentities($GLOBALS['configTituloSite']);
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
			$('#formAulasEditar').validate({ //Inicialização do plug-in.
			
			
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
					carga_horaria: {
						required: true,
						//regex: /-?\d+(\.\d{1,3})?/
						number: true
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
					carga_horaria: {
					  //required: "Campo obrigatório.",
					  required: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica2"); ?>",
					  //regex: "Campo numérico."
					  //number: "Campo numérico."
					  number: "<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatusCritica1"); ?>"
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
    <form name="formAulasEditar" id="formAulasEditar" action="SiteAdmAulasEditarExe.php" method="post" enctype="multipart/form-data" class="FormularioDados01">
        <table class="AdmTabelaCampos01">
            <tr>
                <td class="AdmTbFundoEscuro" colspan="4">
                    <div align="center" class="AdmTexto02">
                        <strong>
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasTbAulasEditar"); ?>
                        </strong>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarAulasVinculo1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo1Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo1 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo1'], $GLOBALS['configIdTbTipoAulasVinculo1'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo1'], $GLOBALS['configAulasVinculo1Metodo']);
                        ?>
                        <select name="id_tb_cadastro1" id="id_tb_cadastro1" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasIdTbCadastro1 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo1); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo1[$countArray][0];?>"<?php if($arrAulasVinculo1[$countArray][0] == $tbAulasIdTbCadastro1){ ?> selected="selected"<?php } ?>><?php echo $arrAulasVinculo1[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo2Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo2 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo2'], $GLOBALS['configIdTbTipoAulasVinculo2'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo2'], $GLOBALS['configAulasVinculo2Metodo']);
                        ?>
                        <select name="id_tb_cadastro2" id="id_tb_cadastro2" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasIdTbCadastro2 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo2); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo2[$countArray][0];?>"<?php if($arrAulasVinculo2[$countArray][0] == $tbAulasIdTbCadastro2){ ?> selected="selected"<?php } ?>><?php echo $arrAulasVinculo2[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo3Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo3 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo3'], $GLOBALS['configIdTbTipoAulasVinculo3'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo3'], $GLOBALS['configAulasVinculo3Metodo']);
                        ?>
                        <select name="id_tb_cadastro3" id="id_tb_cadastro3" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasIdTbCadastro3 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo3); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo3[$countArray][0];?>"<?php if($arrAulasVinculo3[$countArray][0] == $tbAulasIdTbCadastro3){ ?> selected="selected"<?php } ?>><?php echo $arrAulasVinculo3[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo4Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo4 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo4'], $GLOBALS['configIdTbTipoAulasVinculo4'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo4'], $GLOBALS['configAulasVinculo4Metodo']);
                        ?>
                        <select name="id_tb_cadastro4" id="id_tb_cadastro4" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasIdTbCadastro4 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo4); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo4[$countArray][0];?>"<?php if($arrAulasVinculo4[$countArray][0] == $tbAulasIdTbCadastro4){ ?> selected="selected"<?php } ?>><?php echo $arrAulasVinculo4[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasVinculo5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasVinculo5Nome']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasVinculo5 = DbFuncoes::VinculoGenericoSelect02($GLOBALS['configIdTbAulasVinculo5'], $GLOBALS['configIdTbTipoAulasVinculo5'], "tb_cadastro", "id_tb_categorias", "", $GLOBALS['configClassificacaoAulasVinculo5'], $GLOBALS['configAulasVinculo5Metodo']);
                        ?>
                        <select name="id_tb_cadastro5" id="id_tb_cadastro5" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasIdTbCadastro5 == 0){ ?>selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNenhumDropDown"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasVinculo5); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasVinculo5[$countArray][0];?>"<?php if($arrAulasVinculo5[$countArray][0] == $tbAulasIdTbCadastro5){ ?> selected="selected"<?php } ?>><?php echo $arrAulasVinculo5[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasDataAula"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
                    	<?php //JQuery DatePicker. ?>
                    	<?php //---------------------- ?>
						<?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                        	<?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaPtCampos = "#data_distribuicao";
                                    strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data_aula;";
                                </script>
                            <?php } ?>
                            <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
								<script type="text/javascript">
                                    //Variável para conter todos os campos que funcionam com o DatePicker.
                                    //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                    //var strDatapickerAgendaEnCampos = "#data_distribuicao";
                                    strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data_aula;";
                                </script>
                            <?php } ?>
                            <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                        
                            <input type="text" name="data_aula" id="data_aula" class="AdmCampoData01" maxlength="10" value="<?php echo $tbAulasDataAula; ?>" />
                            <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                        <?php } ?>
                    	<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
                        
            <?php if($GLOBALS['habilitarAulasData1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasData1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left">
						<?php //JQuery DatePicker. ?>
						<?php //---------------------- ?>
                    	<?php if($GLOBALS['configTipoCampoAulasData1'] == 1){ ?>
                            <?php if($GLOBALS['configDataTipoCampo'] == 1){ ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 1){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaPtCampos = "#data1";
                                        strDatapickerAgendaPtCampos = strDatapickerAgendaPtCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <?php if($GLOBALS['configSiteFormatoData'] == 2){ ?>
                                    <script type="text/javascript">
                                        //Variável para conter todos os campos que funcionam com o DatePicker.
                                        //OBS: A definição da variável deve ficar antes do includeDatepickerFuncoes.js.
                                        //var strDatapickerAgendaEnCampos = "#data1";
                                        strDatapickerAgendaEnCampos = strDatapickerAgendaEnCampos + "#data1;";
                                    </script>
                                <?php } ?>
                                <script type="text/javascript" src="../jquery/datepicker/includeDatepickerFuncoes.js"></script>
                            
                                <input type="text" name="data1" id="data1" class="AdmCampoData01" maxlength="10" value="<?php echo $tbAulasData1; ?>" />
                                <?php //echo Funcoes::DataGravacaoSql("15/02/1980", 1); ?>
                            <?php } ?>
                        <?php } ?>
						<?php //---------------------- ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasTema"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula"<?php if($GLOBALS['habilitarAulasNClassificacao'] <> "1"){ ?> colspan="3"<?php } ?>>
                    <div align="left">
                        <input type="text" name="tema" id="tema" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasTema; ?>" />
                    </div>
                </td>
				<?php if($GLOBALS['habilitarAulasNClassificacao'] == 1){ ?>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaColuna01 TabelaCampos01Celula">
                    <div>
                        <input type="text" name="n_classificacao" id="n_classificacao" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbAulasNClassificacao; ?>" />
                    </div>
                </td>
                <?php } ?>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasDescricao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <?php //Sem formatação.?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                            <textarea name="descricao" id="descricao" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasDescricao; ?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação básica (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                            
                            <script type="text/javascript">
                                //Caixa básica.
                                $(document).ready(function () {
                                    $("#descricao").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorBasicoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorBasicoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao" id="descricao"><?php echo $tbAulasDescricao; ?></textarea>
                        <?php } ?>
                        
                        <?php //Formatação avançada (CLEditor).?>
                        <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#descricao").cleditor(
                                        {
                                            //Controles disponíveis na barra de ferramentas.
                                            controls:
                                            CLEditorAvancadoControles
                                            , 
                                    
                                            //Fontes disponíveis.
                                            fonts:        
                                            CLEditorAvancadoFontes
                                        }
                                    );
                                });
                            </script>
                            <textarea name="descricao" id="descricao"><?php echo $tbAulasDescricao; ?></textarea>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasLocal"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div>
                        <input type="text" name="local" id="local" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasLocal; ?>" />
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarAulasStatus'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasStatus"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
						<?php 
                            $arrAulasStatus = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 1);
                        ?>
                        <select name="id_tb_aulas_status" id="id_tb_aulas_status" class="AdmCampoDropDownMenu01">
                            <option value="0" <?php if($tbAulasIdTbAulasStatus == 0){ ?> selected="selected"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasStatus); $countArray++)
                            {
                            ?>
                                <option value="<?php echo $arrAulasStatus[$countArray][0];?>"<?php if($arrAulasStatus[$countArray][0] == $tbAulasIdTbAulasStatus){ ?> selected="selected"<?php } ?>><?php echo $arrAulasStatus[$countArray][1];?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasPalavrasChave'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave01"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <textarea name="palavras_chave" id="palavras_chave" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasPalavrasChave; ?></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemPalavrasChave02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasValor'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
						<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasValor"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                    	<?php echo htmlentities($GLOBALS['configSistemaMoeda']); ?>
                    	<input type="text" name="valor" id="valor" class="AdmCampoNumerico02" maxlength="255" value="<?php echo $tbAulasValor; ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemValorDescicao01"); ?>
                    </div>
                </td>
            </tr>
			<?php } ?>
            
            <?php if($GLOBALS['habilitarAulasCargaHoraria'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasCargaHoraria"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <input type="text" name="carga_horaria" id="carga_horaria" class="AdmCampoNumerico01" maxlength="10" value="<?php echo $tbAulasCargaHoraria; ?>" />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasCargaHorariaInstrucoesM"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico01'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico01Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							//echo "FiltrosGenericosSelect03=" . FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "12", "", ",", "", "1") . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "12", "", ",", "", "1") . "<br />";
							//FiltrosGenericosSelect03($idRegistro, $srtTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
							//FiltrosGenericosSelect03($idRegistro, $strTabela, $strCampo, $strCampoComplemento, $strTipoComplemento, $strMarcador, $strSeparador, $tabelaComplemento, $tipoRetorno)
							
							$arrAulasFiltroGenerico01Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "12", "", ",", "", "1"));
							//echo "arrAulasFiltroGenerico01Selecao=" . $arrAulasFiltroGenerico01Selecao[0] . "<br />";
							//echo "in_array=" . in_array("03", $arrAulasFiltroGenerico01Selecao) . "<br />";
						
                            //echo "arrAulasFiltroGenerico01Selecao=" . $arrAulasFiltroGenerico01Selecao . "<br />";
                            //echo "arrAulasFiltroGenerico01Selecao[0]=" . $arrAulasFiltroGenerico01Selecao[0] . "<br />";
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico01 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 12);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico01CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico01); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico01[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico01[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico01[$countArray][0], $arrAulasFiltroGenerico01Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico01[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico01CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico01[]" name="idsAulasFiltroGenerico01[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico01[$countArray][0], $arrAulasFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico01CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico01[]" name="idsAulasFiltroGenerico01[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico01); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico01[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico01[$countArray][0], $arrAulasFiltroGenerico01Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico01[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico01)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico02'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico02Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico02Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "13", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico02 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 13);
                            //echo "arrAulasFiltroGenerico02Selecao=" . $arrAulasFiltroGenerico02Selecao . "<br />";
                            //echo "arrAulasFiltroGenerico02Selecao[0]=" . $arrAulasFiltroGenerico02Selecao[0] . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbAulasId=" . $tbAulasId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico02CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico02); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico02[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico02[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico02[$countArray][0], $arrAulasFiltroGenerico02Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico02[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico02CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico02[]" name="idsAulasFiltroGenerico02[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico02[$countArray][0], $arrAulasFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico02CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico02[]" name="idsAulasFiltroGenerico02[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico02); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico02[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico02[$countArray][0], $arrAulasFiltroGenerico02Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico02[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico02)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico03'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico03Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico03Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "14", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico03 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 14);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico03CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico03); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico03[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico03[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico03[$countArray][0], $arrAulasFiltroGenerico03Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico03[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico03CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico03[]" name="idsAulasFiltroGenerico03[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico03[$countArray][0], $arrAulasFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico03CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico03[]" name="idsAulasFiltroGenerico03[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico03); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico03[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico03[$countArray][0], $arrAulasFiltroGenerico03Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico03[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico03)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarAulasFiltroGenerico04'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico04Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico04Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "15", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico04 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 15);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico04CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico04); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico04[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico04[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico04[$countArray][0], $arrAulasFiltroGenerico04Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico04[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico04CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico04[]" name="idsAulasFiltroGenerico04[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico04[$countArray][0], $arrAulasFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico04CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico04[]" name="idsAulasFiltroGenerico04[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico04); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico04[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico04[$countArray][0], $arrAulasFiltroGenerico04Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico04[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico04)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico05'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico05Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico05Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "16", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico05 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 16);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico05CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico05); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico05[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico05[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico05[$countArray][0], $arrAulasFiltroGenerico05Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico05[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico05CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico05[]" name="idsAulasFiltroGenerico05[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico05[$countArray][0], $arrAulasFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico05[$countArray][1];?></option>

                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico05CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico05[]" name="idsAulasFiltroGenerico05[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico05); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico05[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico05[$countArray][0], $arrAulasFiltroGenerico05Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico05[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico05)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico06'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico06Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico06Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "17", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico06 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 17);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico06CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico06); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico06[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico06[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico06[$countArray][0], $arrAulasFiltroGenerico06Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico06[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico06CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico06[]" name="idsAulasFiltroGenerico06[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico06[$countArray][0], $arrAulasFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico06CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico06[]" name="idsAulasFiltroGenerico06[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico06); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico06[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico06[$countArray][0], $arrAulasFiltroGenerico06Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico06[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico06)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico07'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico07Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico07Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "18", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico07 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 18);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico07CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico07); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico07[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico07[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico07[$countArray][0], $arrAulasFiltroGenerico07Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico07[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico07CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico07[]" name="idsAulasFiltroGenerico07[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico07[$countArray][0], $arrAulasFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico07CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico07[]" name="idsAulasFiltroGenerico07[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico07); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico07[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico07[$countArray][0], $arrAulasFiltroGenerico07Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico07[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico07)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico08'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico08Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico08Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "19", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico08 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 19);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico08CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico08); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico08[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico08[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico08[$countArray][0], $arrAulasFiltroGenerico08Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico08[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico08CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico08[]" name="idsAulasFiltroGenerico08[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico08[$countArray][0], $arrAulasFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico08CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico08[]" name="idsAulasFiltroGenerico08[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico08); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico08[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico08[$countArray][0], $arrAulasFiltroGenerico08Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico08[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico08)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico09'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico09Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico09Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "20", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico09 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 20);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico09CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico09); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico09[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico09[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico09[$countArray][0], $arrAulasFiltroGenerico09Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico09[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico09CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico09[]" name="idsAulasFiltroGenerico09[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico09[$countArray][0], $arrAulasFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico09CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico09[]" name="idsAulasFiltroGenerico09[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico09); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico09[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico09[$countArray][0], $arrAulasFiltroGenerico09Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico09[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico09)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico10Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico10Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "21", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico10 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 21);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico10); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico10[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico10[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico10[$countArray][0], $arrAulasFiltroGenerico10Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico10[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico10[]" name="idsAulasFiltroGenerico10[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico10[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico10[$countArray][0], $arrAulasFiltroGenerico10Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico10[]" name="idsAulasFiltroGenerico10[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico10); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico10[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico10[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico10)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico11Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico11Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "22", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico11 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 22);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico11CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico11); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico11[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico11[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico11[$countArray][0], $arrAulasFiltroGenerico11Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico11[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico11CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico11[]" name="idsAulasFiltroGenerico11[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico11[$countArray][0], $arrAulasFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico11CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico11[]" name="idsAulasFiltroGenerico11[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico11); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico11[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico11[$countArray][0], $arrAulasFiltroGenerico11Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico11[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico11)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico12Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico12Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "23", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico12 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 23);
                            //echo "arrAulasFiltroGenerico12Selecao=" . $arrAulasFiltroGenerico12Selecao . "<br />";
                            //echo "arrAulasFiltroGenerico12Selecao[0]=" . $arrAulasFiltroGenerico12Selecao[0] . "<br />";
							//echo "FiltrosGenericosSelect03=" . DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "13", "", ",", "", "1")  . "<br />";
                            //echo "tbAulasId=" . $tbAulasId . "<br />";
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico12CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico12); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico12[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico12[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico12[$countArray][0], $arrAulasFiltroGenerico12Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico12[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico12CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico12[]" name="idsAulasFiltroGenerico12[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico12[$countArray][0], $arrAulasFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico12CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico12[]" name="idsAulasFiltroGenerico12[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico12); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico12[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico12[$countArray][0], $arrAulasFiltroGenerico12Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico12[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico12)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico13Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico13Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "24", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico13 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 24);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico13CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico13); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico13[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico13[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico13[$countArray][0], $arrAulasFiltroGenerico13Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico13[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico13CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico13[]" name="idsAulasFiltroGenerico13[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico13[$countArray][0], $arrAulasFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico13CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico13[]" name="idsAulasFiltroGenerico13[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico13); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico13[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico13[$countArray][0], $arrAulasFiltroGenerico13Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico13[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico13)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>

            <?php if($GLOBALS['habilitarAulasFiltroGenerico14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico14Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico14Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "25", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico14 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 25);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico14CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico14); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico14[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico14[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico14[$countArray][0], $arrAulasFiltroGenerico14Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico14[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico14CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico14[]" name="idsAulasFiltroGenerico14[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico14[$countArray][0], $arrAulasFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico14CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico14[]" name="idsAulasFiltroGenerico14[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico14); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico14[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico14[$countArray][0], $arrAulasFiltroGenerico14Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico14[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico14)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico15Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">

                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico15Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "26", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico15 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 26);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico15CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico15); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico15[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico15[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico15[$countArray][0], $arrAulasFiltroGenerico15Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico15[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico15CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico15[]" name="idsAulasFiltroGenerico15[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico15[$countArray][0], $arrAulasFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico15CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico15[]" name="idsAulasFiltroGenerico15[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico15); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico15[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico15[$countArray][0], $arrAulasFiltroGenerico15Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico15[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico15)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico16Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico16Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "27", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico16 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 27);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico16CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico16); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico16[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico16[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico16[$countArray][0], $arrAulasFiltroGenerico16Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico16[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico16CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico16[]" name="idsAulasFiltroGenerico16[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico16[$countArray][0], $arrAulasFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico16CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico16[]" name="idsAulasFiltroGenerico16[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico16); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico16[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico16[$countArray][0], $arrAulasFiltroGenerico16Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico16[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico16)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico17Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico17Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "28", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico17 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 28);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico17CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico17); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico17[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico17[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico17[$countArray][0], $arrAulasFiltroGenerico17Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico17[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico17CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico17[]" name="idsAulasFiltroGenerico17[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico17[$countArray][0], $arrAulasFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico17CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico17[]" name="idsAulasFiltroGenerico17[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico17); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico17[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico17[$countArray][0], $arrAulasFiltroGenerico17Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico17[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico17)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico18Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico18Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "29", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico18 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 29);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico18CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico18); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico18[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico18[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico18[$countArray][0], $arrAulasFiltroGenerico18Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico18[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico18CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico18[]" name="idsAulasFiltroGenerico18[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico18[$countArray][0], $arrAulasFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico18CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico18[]" name="idsAulasFiltroGenerico18[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico18); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico18[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico18[$countArray][0], $arrAulasFiltroGenerico18Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico18[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico18)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico19Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico19Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "30", "", ",", "", "1"));
						?>

						<?php 
                            $arrAulasFiltroGenerico19 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 30);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico19CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico19); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico19[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico19[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico19[$countArray][0], $arrAulasFiltroGenerico19Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico19[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico19CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico19[]" name="idsAulasFiltroGenerico19[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico19[$countArray][0], $arrAulasFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico19CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico19[]" name="idsAulasFiltroGenerico19[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico19); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico19[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico19[$countArray][0], $arrAulasFiltroGenerico19Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico19[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico19)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasFiltroGenerico20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasFiltroGenerico20Nome']); ?>: 
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div class="AdmTexto01">
                        <?php
							//Seleção de ids selecionados para o registro.
							$arrAulasFiltroGenerico20Selecao = explode(",", DbFuncoes::FiltrosGenericosSelect03($tbAulasId, "tb_aulas_relacao_complemento", "id_tb_aulas", "id_tb_aulas_complemento", "31", "", ",", "", "1"));
						?>
                    
						<?php 
                            $arrAulasFiltroGenerico20 = DbFuncoes::FiltrosGenericosFill01("tb_aulas_complemento", 31);
                        ?>
                        
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 1){ ?>
                            <?php 
                            for($countArray = 0; $countArray < count($arrAulasFiltroGenerico20); $countArray++)
                            {
                            ?>
                                <div>
                                    <input name="idsAulasFiltroGenerico20[]" type="checkbox" value="<?php echo $arrAulasFiltroGenerico20[$countArray][0];?>" class="AdmCampoCheckBox01"<?php if(in_array($arrAulasFiltroGenerico20[$countArray][0], $arrAulasFiltroGenerico20Selecao)){ ?> checked="checked"<?php } ?> /> <?php echo $arrAulasFiltroGenerico20[$countArray][1];?>
                                </div>
                            <?php 
                            }
                            ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 2){ ?>
                            <select id="idsAulasFiltroGenerico10[]" name="idsAulasFiltroGenerico20[]" size="5" multiple="multiple" class="AdmCampoFiltroGenericoListBox01">
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico20[$countArray][0];?>"<?php if(in_array($arrAulasFiltroGenerico20[$countArray][0], $arrAulasFiltroGenerico20Selecao)){ ?> selected="selected"<?php } ?>><?php echo $arrAulasFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select> 
                            <br />
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico01"); ?>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasFiltroGenerico10CaixaSelecao'] == 3){ ?>
                            <select id="idsAulasFiltroGenerico10[]" name="idsAulasFiltroGenerico20[]" class="AdmCampoDropDownMenu01">
                                <option value="0"><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico03"); ?></option>
                                <?php 
                                for($countArray = 0; $countArray < count($arrAulasFiltroGenerico20); $countArray++)
                                {
                                ?>
                                    <option value="<?php echo $arrAulasFiltroGenerico20[$countArray][0];?>"><?php echo $arrAulasFiltroGenerico20[$countArray][1];?></option>
                                <?php 
                                }
                                ?>
                            </select>
                        <?php } ?>
                        
                        <?php if(empty($arrAulasFiltroGenerico20)){ ?>
                        	<a href="AulasManutencao.php" class="AdmLinks01">
								<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemFiltroGenerico04"); ?>
                            </a>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasURL1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configAulasURL1Titulo']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                    	<textarea name="url1" id="url1" class="AdmCampoTextoMultilinhaURL"><?php echo $tbAulasURL1; ?></textarea>
                        <br />
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemURL02"); ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao3"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="ativacao" id="ativacao" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasAtivacao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4"); ?></option>
                            <option value="1"<?php if($tbAulasAtivacao == "1"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            
            <?php if($GLOBALS['habilitarAulasReposicao'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01">
                    <div align="left" class="AdmTexto01">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteAulasReposicao"); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro" colspan="3">
                    <div align="left" class="AdmTexto01">
                        <select name="reposicao" id="reposicao" class="AdmCampoDropDownMenu01">
                            <option value="0"<?php if($tbAulasReposicao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNao"); ?></option>
                            <option value="1"<?php if($tbAulasReposicao == "0"){?> selected="true"<?php } ?>><?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemSim"); ?></option>
                        </select>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc1'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc1']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc1'] == 1){ ?>
                            <input type="text" name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC1;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc1'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar1" id="informacao_complementar1" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC1;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbAulasIC1;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar1").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar1" id="informacao_complementar1"><?php echo $tbAulasIC1;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc2'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc2']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc2'] == 1){ ?>
                            <input type="text" name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC2;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc2'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar2" id="informacao_complementar2" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC2;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbAulasIC2;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar2").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar2" id="informacao_complementar2"><?php echo $tbAulasIC2;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc3'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc3']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc3'] == 1){ ?>
                            <input type="text" name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC3;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc3'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar3" id="informacao_complementar3" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC3;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbAulasIC3;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar3").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar3" id="informacao_complementar3"><?php echo $tbAulasIC3;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc4'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc4']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc4'] == 1){ ?>
                            <input type="text" name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC4;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc4'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar4" id="informacao_complementar4" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC4;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbAulasIC4;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar4").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar4" id="informacao_complementar4"><?php echo $tbAulasIC4;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc5'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc5']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc5'] == 1){ ?>
                            <input type="text" name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC5;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc5'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar5" id="informacao_complementar5" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC5;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbAulasIC5;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar5").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar5" id="informacao_complementar5"><?php echo $tbAulasIC5;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc6'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc6']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc6'] == 1){ ?>
                            <input type="text" name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC6;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc6'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar6" id="informacao_complementar6" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC6;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbAulasIC6;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar6").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar6" id="informacao_complementar6"><?php echo $tbAulasIC6;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc7'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc7']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc7'] == 1){ ?>
                            <input type="text" name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC7;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc2'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar7" id="informacao_complementar7" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC7;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbAulasIC7;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar7").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:

                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );

                                    });
                                </script>
                                <textarea name="informacao_complementar7" id="informacao_complementar7"><?php echo $tbAulasIC7;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc8'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc8']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc8'] == 1){ ?>
                            <input type="text" name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC8;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc8'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar8" id="informacao_complementar8" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC8;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbAulasIC8;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar8").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar8" id="informacao_complementar8"><?php echo $tbAulasIC8;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc9'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc9']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc9'] == 1){ ?>
                            <input type="text" name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC9;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc9'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar9" id="informacao_complementar9" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC9;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbAulasIC9;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar9").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar9" id="informacao_complementar9"><?php echo $tbAulasIC9;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc10'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc10']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc10'] == 1){ ?>
                            <input type="text" name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC10;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc10'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar10" id="informacao_complementar10" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC10;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbAulasIC10;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar10").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar10" id="informacao_complementar10"><?php echo $tbAulasIC10;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc11'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc11']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc11'] == 1){ ?>
                            <input type="text" name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTexto02" maxlength="255"  value="<?php echo $tbAulasIC11;?>"/>
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc11'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar11" id="informacao_complementar11" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC11;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbAulasIC11;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar11").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar11" id="informacao_complementar11"><?php echo $tbAulasIC11;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc12'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc12']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc12'] == 1){ ?>
                            <input type="text" name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC12;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc12'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar12" id="informacao_complementar12" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC12;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbAulasIC12;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar12").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar12" id="informacao_complementar12"><?php echo $tbAulasIC12;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc13'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc13']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc13'] == 1){ ?>
                            <input type="text" name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC13;?>">
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc13'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar13" id="informacao_complementar13" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC13;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbAulasIC13;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar13").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar13" id="informacao_complementar13"><?php echo $tbAulasIC13;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc14'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc14']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc14'] == 1){ ?>
                            <input type="text" name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC14;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc14'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar14" id="informacao_complementar14" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC14;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbAulasIC14;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar14").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar14" id="informacao_complementar14"><?php echo $tbAulasIC14;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc15'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc15']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc15'] == 1){ ?>
                            <input type="text" name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC15;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc15'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar15" id="informacao_complementar15" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC15;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbAulasIC15;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar15").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar15" id="informacao_complementar15"><?php echo $tbAulasIC15;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc16'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc16']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc16'] == 1){ ?>
                            <input type="text" name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC16;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc16'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar16" id="informacao_complementar16" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC16;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar16").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbAulasIC16;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar16").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar16" id="informacao_complementar16"><?php echo $tbAulasIC16;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc17'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc17']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc17'] == 1){ ?>
                            <input type="text" name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC17;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc12'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar17" id="informacao_complementar17" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC17;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar17").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbAulasIC17;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar17").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar17" id="informacao_complementar17"><?php echo $tbAulasIC17;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc18'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc18']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc18'] == 1){ ?>
                            <input type="text" name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC18;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc18'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar18" id="informacao_complementar18" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC18;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar18").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbAulasIC18;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar18").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }

                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar18" id="informacao_complementar18"><?php echo $tbAulasIC18;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc19'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc19']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc19'] == 1){ ?>
                            <input type="text" name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC19;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc19'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar19" id="informacao_complementar19" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC19;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar19").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbAulasIC19;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar19").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar19" id="informacao_complementar19"><?php echo $tbAulasIC19;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc20'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc20']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc20'] == 1){ ?>
                            <input type="text" name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC20;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc20'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar20" id="informacao_complementar20" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC20;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar20").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbAulasIC20;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar20").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar20" id="informacao_complementar20"><?php echo $tbAulasIC20;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc21'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc21']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc21'] == 1){ ?>
                            <input type="text" name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC21;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc21'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar21" id="informacao_complementar21" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC21;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar21").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbAulasIC21;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar21").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar21" id="informacao_complementar21"><?php echo $tbAulasIC21;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc22'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc22']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc22'] == 1){ ?>
                            <input type="text" name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC22;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc22'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar22" id="informacao_complementar22" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC22;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar22").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbAulasIC22;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar22").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar22" id="informacao_complementar22"><?php echo $tbAulasIC22;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc23'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc23']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc23'] == 1){ ?>
                            <input type="text" name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC23;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc23'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar23" id="informacao_complementar23" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC23;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar23").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbAulasIC23;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar23").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar23" id="informacao_complementar23"><?php echo $tbAulasIC23;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc24'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc24']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc24'] == 1){ ?>
                            <input type="text" name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC24;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc24'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar24" id="informacao_complementar24" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC24;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar24").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbAulasIC24;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar24").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar24" id="informacao_complementar24"><?php echo $tbAulasIC24;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc25'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc25']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc25'] == 1){ ?>
                            <input type="text" name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC25;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc25'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar25" id="informacao_complementar25" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC25;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar25").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar25" id="informacao_complementar25"><?php echo $tbAulasIC25;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar25").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar25" id="informacao_complementar25"><?php echo $tbAulasIC25;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc26'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc26']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc26'] == 1){ ?>
                            <input type="text" name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC26;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc26'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar26" id="informacao_complementar26" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC26;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar26").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar26" id="informacao_complementar26"><?php echo $tbAulasIC26;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar26").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar26" id="informacao_complementar26"><?php echo $tbAulasIC26;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc27'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc27']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc27'] == 1){ ?>
                            <input type="text" name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC27;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc22'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar27" id="informacao_complementar27" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC27;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar27").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar27" id="informacao_complementar27"><?php echo $tbAulasIC27;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar27").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar27" id="informacao_complementar27"><?php echo $tbAulasIC27;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc28'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc28']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc28'] == 1){ ?>
                            <input type="text" name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC28;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc28'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar28" id="informacao_complementar28" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC28;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar28").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar28" id="informacao_complementar28"><?php echo $tbAulasIC28;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar28").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar28" id="informacao_complementar28"><?php echo $tbAulasIC28;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc29'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc29']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc29'] == 1){ ?>
                            <input type="text" name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC29;?>" />

                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc29'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar29" id="informacao_complementar29" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC29;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar29").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar29" id="informacao_complementar29"><?php echo $tbAulasIC29;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar29").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar29" id="informacao_complementar29"><?php echo $tbAulasIC29;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc30'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc30']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc30'] == 1){ ?>
                            <input type="text" name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC30;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc30'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar30" id="informacao_complementar30" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC30;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar30").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar30" id="informacao_complementar30"><?php echo $tbAulasIC30;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar30").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar30" id="informacao_complementar30"><?php echo $tbAulasIC30;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc31'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc31']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc31'] == 1){ ?>
                            <input type="text" name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC31;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc31'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar31" id="informacao_complementar31" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC31;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar31").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbAulasIC31;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar31").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar31" id="informacao_complementar31"><?php echo $tbAulasIC31;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc32'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc32']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc32'] == 1){ ?>
                            <input type="text" name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC32;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc32'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar32" id="informacao_complementar32" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC32;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar32").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbAulasIC32;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar32").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar32" id="informacao_complementar32"><?php echo $tbAulasIC32;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc33'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc33']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc33'] == 1){ ?>
                            <input type="text" name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC33;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc33'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar33" id="informacao_complementar33" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC33;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar33").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbAulasIC33;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar33").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar33" id="informacao_complementar33"><?php echo $tbAulasIC33;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc34'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc34']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc34'] == 1){ ?>
                            <input type="text" name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC34;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc34'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar34" id="informacao_complementar34" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC34;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar34").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbAulasIC34;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar34").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar34" id="informacao_complementar34"><?php echo $tbAulasIC34;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc35'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc35']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc35'] == 1){ ?>
                            <input type="text" name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC35;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc35'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar35" id="informacao_complementar35" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC35;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar35").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }

                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbAulasIC35;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar35").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar35" id="informacao_complementar35"><?php echo $tbAulasIC35;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc36'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc36']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc36'] == 1){ ?>
                            <input type="text" name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC36;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc36'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar36" id="informacao_complementar36" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC36;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar36").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbAulasIC36;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar36").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar36" id="informacao_complementar36"><?php echo $tbAulasIC36;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc37'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc37']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc37'] == 1){ ?>
                            <input type="text" name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC37;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc37'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar37" id="informacao_complementar37" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC37;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar37").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbAulasIC37;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar37").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar37" id="informacao_complementar37"><?php echo $tbAulasIC37;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc38'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc38']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc38'] == 1){ ?>
                            <input type="text" name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC38;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc38'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar38" id="informacao_complementar38" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC38;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar38").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbAulasIC38;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar38").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar38" id="informacao_complementar38"><?php echo $tbAulasIC38;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc39'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc39']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc39'] == 1){ ?>
                            <input type="text" name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC39;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc39'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar39" id="informacao_complementar39" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC39;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar39").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbAulasIC39;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar39").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar39" id="informacao_complementar39"><?php echo $tbAulasIC39;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc40'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc40']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc40'] == 1){ ?>
                            <input type="text" name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC40;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc40'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar40" id="informacao_complementar40" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC40;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbAulasIC40;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar40").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar40" id="informacao_complementar40"><?php echo $tbAulasIC40;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc41'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc41']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc41'] == 1){ ?>
                            <input type="text" name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC41;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc41'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar41" id="informacao_complementar41" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC41;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar41").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar41" id="informacao_complementar41"><?php echo $tbAulasIC41;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar41").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar41" id="informacao_complementar41"><?php echo $tbAulasIC41;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc42'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc42']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc42'] == 1){ ?>
                            <input type="text" name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC42;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc42'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar42" id="informacao_complementar42" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC42;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar42").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar42" id="informacao_complementar42"><?php echo $tbAulasIC42;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar42").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar42" id="informacao_complementar42"><?php echo $tbAulasIC42;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc43'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc43']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc43'] == 1){ ?>
                            <input type="text" name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC43;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc43'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar43" id="informacao_complementar43" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC43;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar43").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar43" id="informacao_complementar43"><?php echo $tbAulasIC43;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar43").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar43" id="informacao_complementar43"><?php echo $tbAulasIC43;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc44'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc44']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc44'] == 1){ ?>
                            <input type="text" name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC44;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc44'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar44" id="informacao_complementar44" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC44;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar44").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar44" id="informacao_complementar44"><?php echo $tbAulasIC44;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar44").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar44" id="informacao_complementar44"><?php echo $tbAulasIC44;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc45'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc45']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc45'] == 1){ ?>
                            <input type="text" name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC45;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc45'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar45" id="informacao_complementar45" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC45;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar45").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles

                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar45" id="informacao_complementar45"><?php echo $tbAulasIC45;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar45").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar45" id="informacao_complementar45"><?php echo $tbAulasIC45;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc46'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc46']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc46'] == 1){ ?>
                            <input type="text" name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC46;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc46'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar46" id="informacao_complementar46" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC46;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar46").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar46" id="informacao_complementar46"><?php echo $tbAulasIC46;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar46").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar46" id="informacao_complementar46"><?php echo $tbAulasIC46;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc47'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc47']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc47'] == 1){ ?>
                            <input type="text" name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC47;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc42'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar47" id="informacao_complementar47" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC47;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar47").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar47" id="informacao_complementar47"><?php echo $tbAulasIC47;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar47").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar47" id="informacao_complementar47"><?php echo $tbAulasIC47;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc48'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc48']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc48'] == 1){ ?>
                            <input type="text" name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC48;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc48'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar48" id="informacao_complementar48" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC48;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar48").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar48" id="informacao_complementar48"><?php echo $tbAulasIC48;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar48").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar48" id="informacao_complementar48"><?php echo $tbAulasIC48;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc49'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc49']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc49'] == 1){ ?>
                            <input type="text" name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC49;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc49'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar49" id="informacao_complementar49" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC49;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar49").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar49" id="informacao_complementar49"><?php echo $tbAulasIC49;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar49").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar49" id="informacao_complementar49"><?php echo $tbAulasIC49;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc50'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc50']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc50'] == 1){ ?>
                            <input type="text" name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC50;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc50'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar50" id="informacao_complementar50" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC50;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar50").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar50" id="informacao_complementar50"><?php echo $tbAulasIC50;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar50").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar50" id="informacao_complementar50"><?php echo $tbAulasIC50;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc51'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc51']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc51'] == 1){ ?>
                            <input type="text" name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC51;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc51'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar51" id="informacao_complementar51" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC51;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar51").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar51" id="informacao_complementar51"><?php echo $tbAulasIC51;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar51").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar51" id="informacao_complementar51"><?php echo $tbAulasIC51;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc52'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc52']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc52'] == 1){ ?>
                            <input type="text" name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC52;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc52'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar52" id="informacao_complementar52" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC52;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar52").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar52" id="informacao_complementar52"><?php echo $tbAulasIC52;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar52").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar52" id="informacao_complementar52"><?php echo $tbAulasIC52;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc53'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc53']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc53'] == 1){ ?>
                            <input type="text" name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC53;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc53'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar53" id="informacao_complementar53" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC53;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar53").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar53" id="informacao_complementar53"><?php echo $tbAulasIC53;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar53").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar53" id="informacao_complementar53"><?php echo $tbAulasIC53;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc54'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc54']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc54'] == 1){ ?>
                            <input type="text" name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC54;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc54'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar54" id="informacao_complementar54" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC54;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar54").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar54" id="informacao_complementar54"><?php echo $tbAulasIC54;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar54").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar54" id="informacao_complementar54"><?php echo $tbAulasIC54;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc55'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc55']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc55'] == 1){ ?>
                            <input type="text" name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC55;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc55'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar55" id="informacao_complementar55" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC55;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar55").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar55" id="informacao_complementar55"><?php echo $tbAulasIC55;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar55").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar55" id="informacao_complementar55"><?php echo $tbAulasIC55;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc56'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc56']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc56'] == 1){ ?>
                            <input type="text" name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC56;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc56'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar56" id="informacao_complementar56" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC56;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar56").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar56" id="informacao_complementar56"><?php echo $tbAulasIC56;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar56").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar56" id="informacao_complementar56"><?php echo $tbAulasIC56;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAulasIc57'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc57']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc57'] == 1){ ?>
                            <input type="text" name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC57;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc52'] == 7){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar57" id="informacao_complementar57" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC57;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar57").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar57" id="informacao_complementar57"><?php echo $tbAulasIC57;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar57").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar57" id="informacao_complementar57"><?php echo $tbAulasIC57;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc58'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc58']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc58'] == 1){ ?>
                            <input type="text" name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC58;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc58'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar58" id="informacao_complementar58" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC58;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar58").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar58" id="informacao_complementar58"><?php echo $tbAulasIC58;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar58").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar58" id="informacao_complementar58"><?php echo $tbAulasIC58;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc59'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc59']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc59'] == 1){ ?>
                            <input type="text" name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC59;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc59'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar59" id="informacao_complementar59" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC59;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar59").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar59" id="informacao_complementar59"><?php echo $tbAulasIC59;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar59").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar59" id="informacao_complementar59"><?php echo $tbAulasIC59;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
        
            <?php if($GLOBALS['habilitarAulasIc60'] == 1){ ?>
            <tr>
                <td class="AdmTbFundoMedio TabelaColuna01 TabelaCampos01Celula">
                    <div align="left" class="AdmTexto01">
                        <?php echo htmlentities($GLOBALS['configTituloAulasIc60']); ?>:
                    </div>
                </td>
                <td class="AdmTbFundoClaro TabelaCampos01Celula" colspan="3">
                    <div>
                        <?php if($GLOBALS['configAulasBoxIc60'] == 1){ ?>
                            <input type="text" name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTexto02" maxlength="255" value="<?php echo $tbAulasIC60;?>" />
                        <?php } ?>
                        <?php if($GLOBALS['configAulasBoxIc60'] == 2){ ?>
                            <?php //Sem formatação.?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 1){ ?>
                                <textarea name="informacao_complementar60" id="informacao_complementar60" class="AdmCampoTextoMultilinha01"><?php echo $tbAulasIC60;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação básica (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 11){ ?>
                                
                                <script type="text/javascript">
                                    //Caixa básica.
                                    $(document).ready(function () {
                                        $("#informacao_complementar60").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorBasicoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorBasicoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar60" id="informacao_complementar60"><?php echo $tbAulasIC60;?></textarea>
                            <?php } ?>
                            
                            <?php //Formatação avançada (CLEditor).?>
                            <?php if($GLOBALS['configConteudoCaixaTexto'] == 12){ ?>
                                <script type="text/javascript">
                                    $(document).ready(function () {
                                        $("#informacao_complementar60").cleditor(
                                            {
                                                //Controles disponíveis na barra de ferramentas.
                                                controls:
                                                CLEditorAvancadoControles
                                                , 
                                        
                                                //Fontes disponíveis.
                                                fonts:        
                                                CLEditorAvancadoFontes
                                            }
                                        );
                                    });
                                </script>
                                <textarea name="informacao_complementar60" id="informacao_complementar60"><?php echo $tbAulasIC60;?></textarea>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
        </table>
        <div>
            <div style="float:left;">
                <input type="image" name="submit" value="Submit" src="img/btoAtualizar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoAtualizar"); ?>" />
                
                <input name="idTbAulas" type="hidden" id="idTbAulas" value="<?php echo $idTbAulas; ?>" />
                <input name="id_parent" type="hidden" id="id_parent" value="<?php echo $tbAulasIdParent; ?>" />
                <input name="id_tb_cadastro_usuario" type="hidden" id="id_tb_cadastro_usuario" value="<?php echo $tbAulasIdTbCadastroUsuario; ?>" />
                <input name="n_visitas" type="hidden" id="n_visitas" value="<?php echo $tbAulasNVisitas; ?>" />
                <input name="paginaRetorno" type="hidden" id="paginaRetorno" value="<?php echo $paginaRetorno; ?>" />
                <input name="masterPageSiteSelect" type="hidden" id="masterPageSiteSelect" value="<?php echo $masterPageSiteSelect; ?>" />
            </div>
            <div style="float:right;">
                <a href="<?php echo $paginaRetorno; ?>?idParentAulas=<?php echo $idParentAulas; ?>">
                    <img src="img/btoVoltar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>"  />
                </a>
            </div>
        </div>
        
    </form>
    <br />
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