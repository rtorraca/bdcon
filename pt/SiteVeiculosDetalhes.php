<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idTbVeiculos = $_GET["idTbVeiculos"];
$idParentVeiculos = DbFuncoes::GetCampoGenerico01($idTbVeiculos, "tb_veiculos", "id_tb_categorias");

$idTbCadastroLogado = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);
$idTbCadastroUsuario = $idTbCadastroLogado;

//$resultadoVeiculosComplemento = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_veiculos_complemento");
$resultadoVeiculosComplemento = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_veiculos_complemento", 
								NULL, 
								"complemento", 
								"");
$resultadoVeiculosComplementoRelacao = DbFuncoes::FiltrosGenericosSelect02_FetchAll("tb_veiculos_relacao_complemento", 
																					$idTbVeiculos, 
																					"id_tb_veiculos");
																					
//$resultadoVeiculosFiltroGenerico01Selecao = array_intersect_key($resultadoVeiculosComplementoRelacao, array(array("tipo_complemento" => "12")));																					
//$resultadoVeiculosFiltroGenerico01Selecao = $resultadoVeiculosComplementoRelacao[array_search('12',array_column($resultadoVeiculosComplementoRelacao, 'tipo_complemento'))]['id_tb_veiculos_complemento'];																					
/*
$resultadoVeiculosFiltroGenerico01Selecao = array_filter($resultadoVeiculosComplementoRelacao, function($v, $k){
    return $k == 'tipo_complemento' || $v == '12';
}, ARRAY_FILTER_USE_BOTH);
*/
/*
$delValue = 12;
$resultadoVeiculosFiltroGenerico01Selecao = array_filter($resultadoVeiculosComplementoRelacao, function($v, $k) use ($delValue) {
    return ($k == $delValue);
});*/
//sort($resultadoVeiculosComplementoRelacao);
//$resultadoVeiculosFiltroGenerico01Selecao = array_search(12, array_column($resultadoVeiculosComplementoRelacao, 'tipo_complemento'));
//$resultadoVeiculosFiltroGenerico01Selecao = array_keys(array_combine(array_keys($resultadoVeiculosComplementoRelacao), array_column($resultadoVeiculosComplementoRelacao, 'tipo_complemento')),12);
/*$resultadoVeiculosFiltroGenerico01Selecao = array_reduce($resultadoVeiculosComplementoRelacao, function ($num, array $resultadoVeiculosComplementoRelacao) {
    return $num + (int)($resultadoVeiculosComplementoRelacao['tipo_complemento'] == '12');
}, 0);*/

$tituloLinkAtual = "";
$metaTitulo = "";
$metaDescricao = "";
$metaPalavrasChave = "";

$paginaRetorno = "SiteVeiculosDetalhes.php";
//$paginaRetornoExclusao = "SiteAdmVeiculosEditar.php";
$variavelRetorno = "idTbVeiculos";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Montagem de query padrão de retorno.
//"&paginaRetornoExclusao=" . $paginaRetornoExclusao . 
$queryPadrao = "&idParentVeiculos=" . $idParentVeiculos . 
"&idTbCadastroUsuario=" . $idTbCadastroUsuario . 
"&paginaRetorno=" . $paginaRetorno . 
"&masterPageSiteSelect=" . $masterPageSiteSelect . 
"&variavelRetorno=" . $variavelRetorno;
$queryPadraoRetornoPaginacao = "&paginacaoNumero=" . $paginacaoNumero; //talvez incorporar este item no de cima.
$queryPadraoRetornoCaracter = "&caracterAtual=" . $caracterAtual; //talvez incorporar este item no de cima.


//Query de pesquisa.
//----------
$strSqlVeiculosDetalhesSelect = "";
$strSqlVeiculosDetalhesSelect .= "SELECT ";
//$strSqlVeiculosDetalhesSelect .= "* ";
$strSqlVeiculosDetalhesSelect .= "id, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_categorias, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlVeiculosDetalhesSelect .= "modalidade, ";
$strSqlVeiculosDetalhesSelect .= "data_publicacao, ";

$strSqlVeiculosDetalhesSelect .= "data1, ";
$strSqlVeiculosDetalhesSelect .= "data2, ";
$strSqlVeiculosDetalhesSelect .= "data3, ";
$strSqlVeiculosDetalhesSelect .= "data4, ";
$strSqlVeiculosDetalhesSelect .= "data5, ";
$strSqlVeiculosDetalhesSelect .= "data6, ";
$strSqlVeiculosDetalhesSelect .= "data7, ";
$strSqlVeiculosDetalhesSelect .= "data8, ";
$strSqlVeiculosDetalhesSelect .= "data9, ";
$strSqlVeiculosDetalhesSelect .= "data10, ";

$strSqlVeiculosDetalhesSelect .= "codigo, ";
$strSqlVeiculosDetalhesSelect .= "n_classificacao, ";
$strSqlVeiculosDetalhesSelect .= "veiculo, ";
$strSqlVeiculosDetalhesSelect .= "descricao, ";
$strSqlVeiculosDetalhesSelect .= "portas, ";
$strSqlVeiculosDetalhesSelect .= "kilometragem, ";
$strSqlVeiculosDetalhesSelect .= "placa, ";
$strSqlVeiculosDetalhesSelect .= "ano_fabricacao, ";
$strSqlVeiculosDetalhesSelect .= "ano_modelo, ";

$strSqlVeiculosDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_cadastro4, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_cadastro5, ";

$strSqlVeiculosDetalhesSelect .= "informacao_complementar1, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar2, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar3, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar4, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar5, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar6, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar7, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar8, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar9, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar10, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar11, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar12, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar13, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar14, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar15, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar16, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar17, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar18, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar19, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar20, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar21, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar22, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar23, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar24, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar25, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar26, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar27, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar28, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar29, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar30, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar31, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar32, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar33, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar34, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar35, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar36, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar37, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar38, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar39, ";
$strSqlVeiculosDetalhesSelect .= "informacao_complementar40, ";

$strSqlVeiculosDetalhesSelect .= "id_db_cep_tblBairros, ";
$strSqlVeiculosDetalhesSelect .= "id_db_cep_tblCidades, ";
$strSqlVeiculosDetalhesSelect .= "id_db_cep_tblLogradouros, ";
$strSqlVeiculosDetalhesSelect .= "id_db_cep_tblUF, ";

$strSqlVeiculosDetalhesSelect .= "veiculo_endereco, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_endereco_numero, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_endereco_complemento, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_bairro, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_cidade, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_estado, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_pais, ";
$strSqlVeiculosDetalhesSelect .= "veiculo_cep, ";

$strSqlVeiculosDetalhesSelect .= "contato, ";
$strSqlVeiculosDetalhesSelect .= "email, ";
$strSqlVeiculosDetalhesSelect .= "link_externo, ";

$strSqlVeiculosDetalhesSelect .= "url1, ";
$strSqlVeiculosDetalhesSelect .= "url2, ";
$strSqlVeiculosDetalhesSelect .= "url3, ";
$strSqlVeiculosDetalhesSelect .= "url4, ";
$strSqlVeiculosDetalhesSelect .= "url5, ";

$strSqlVeiculosDetalhesSelect .= "url_amigavel, ";
$strSqlVeiculosDetalhesSelect .= "palavras_chave, ";

$strSqlVeiculosDetalhesSelect .= "valor, ";
$strSqlVeiculosDetalhesSelect .= "valor1, ";
$strSqlVeiculosDetalhesSelect .= "valor2, ";

$strSqlVeiculosDetalhesSelect .= "ativacao, ";
$strSqlVeiculosDetalhesSelect .= "ativacao1, ";
$strSqlVeiculosDetalhesSelect .= "ativacao2, ";
$strSqlVeiculosDetalhesSelect .= "ativacao3, ";
$strSqlVeiculosDetalhesSelect .= "ativacao4, ";
$strSqlVeiculosDetalhesSelect .= "ativacao_promocao, ";
$strSqlVeiculosDetalhesSelect .= "ativacao_home, ";
$strSqlVeiculosDetalhesSelect .= "ativacao_home_categoria, ";
$strSqlVeiculosDetalhesSelect .= "ativacao_info_cadastro, ";
$strSqlVeiculosDetalhesSelect .= "acesso_restrito, ";
$strSqlVeiculosDetalhesSelect .= "id_tb_veiculos_status, ";

$strSqlVeiculosDetalhesSelect .= "imagem, ";
$strSqlVeiculosDetalhesSelect .= "arquivo1, ";
$strSqlVeiculosDetalhesSelect .= "arquivo2, ";
$strSqlVeiculosDetalhesSelect .= "arquivo3, ";
$strSqlVeiculosDetalhesSelect .= "arquivo4, ";
$strSqlVeiculosDetalhesSelect .= "arquivo5, ";

$strSqlVeiculosDetalhesSelect .= "anotacoes_internas, ";
$strSqlVeiculosDetalhesSelect .= "n_visitas ";
$strSqlVeiculosDetalhesSelect .= "FROM tb_veiculos ";
$strSqlVeiculosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlVeiculosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlVeiculosDetalhesSelect .= "AND id = :id ";
//$strSqlVeiculosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


//Parâmetros.
//----------
$statementVeiculosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlVeiculosDetalhesSelect);

if ($statementVeiculosDetalhesSelect !== false)
{
	$statementVeiculosDetalhesSelect->execute(array(
		"id" => $idTbVeiculos
	));
}
//----------


//Definição das variáveis de detalhes.
//----------
//$resultadoVeiculosDetalhes = $dbSistemaConPDO->query($strSqlVeiculosDetalhesSelect);
$resultadoVeiculosDetalhes = $statementVeiculosDetalhesSelect->fetchAll();

if (empty($resultadoVeiculosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoVeiculosDetalhes as $linhaVeiculosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbVeiculosId = $linhaVeiculosDetalhes['id'];
		$tbVeiculosIdTbCategorias = $linhaVeiculosDetalhes['id_tb_categorias'];
		$tbVeiculosIdTbCadastroUsuario = $linhaVeiculosDetalhes['id_tb_cadastro_usuario'];
		$tbVeiculosModalidade = $linhaVeiculosDetalhes['modalidade'];
		$tbVeiculosModalidade_print = "";
		if($tbVeiculosModalidade == 1)
		{
			$tbVeiculosModalidade_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade1");
		}
		if($tbVeiculosModalidade == 2)
		{
			$tbVeiculosModalidade_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade2");
		}

		//$tbVeiculosDataPublicacao = $linhaVeiculosDetalhes['data_publicacao'];
		if($linhaVeiculosDetalhes['data_publicacao'] == NULL)
		{
			$tbVeiculosDataPublicacao = "";
		}else{
			$tbVeiculosDataPublicacao = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data_publicacao'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		if($linhaVeiculosDetalhes['data1'] == NULL)
		{
			$tbVeiculosData1 = "";
		}else{
			$tbVeiculosData1 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data2'] == NULL)
		{
			$tbVeiculosData2 = "";
		}else{
			$tbVeiculosData2 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data3'] == NULL)
		{
			$tbVeiculosData3 = "";
		}else{
			$tbVeiculosData3 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data4'] == NULL)
		{
			$tbVeiculosData4 = "";
		}else{
			$tbVeiculosData4 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data5'] == NULL)
		{
			$tbVeiculosData5 = "";
		}else{
			$tbVeiculosData5 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data6'] == NULL)
		{
			$tbVeiculosData6 = "";
		}else{
			$tbVeiculosData6 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data7'] == NULL)
		{
			$tbVeiculosData7 = "";
		}else{
			$tbVeiculosData7 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data8'] == NULL)
		{
			$tbVeiculosData8 = "";
		}else{
			$tbVeiculosData8 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data9'] == NULL)
		{
			$tbVeiculosData9 = "";
		}else{
			$tbVeiculosData9 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaVeiculosDetalhes['data10'] == NULL)
		{
			$tbVeiculosData10 = "";
		}else{
			$tbVeiculosData10 = Funcoes::DataLeitura01($linhaVeiculosDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		$tbVeiculosCodigo = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['codigo']);
		$tbVeiculosNClassificacao = $linhaVeiculosDetalhes['n_classificacao'];
		$tbVeiculosVeiculo = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo']);
		$tbVeiculosDescricao = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['descricao']);
		$tbVeiculosPortas = $linhaVeiculosDetalhes['portas'];
		$tbVeiculosKilometragem = $linhaVeiculosDetalhes['kilometragem'];
		$tbVeiculosPlaca = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['placa']);
		$tbVeiculosAnoFabricacao = $linhaVeiculosDetalhes['ano_fabricacao'];
		$tbVeiculosAnoModelo = $linhaVeiculosDetalhes['ano_modelo'];
		
		$tbVeiculosIdTbCadastro1 = $linhaVeiculosDetalhes['id_tb_cadastro1'];
		$tbVeiculosIdTbCadastro2 = $linhaVeiculosDetalhes['id_tb_cadastro2'];
		$tbVeiculosIdTbCadastro3 = $linhaVeiculosDetalhes['id_tb_cadastro3'];
		$tbVeiculosIdTbCadastro4 = $linhaVeiculosDetalhes['id_tb_cadastro4'];
		$tbVeiculosIdTbCadastro5 = $linhaVeiculosDetalhes['id_tb_cadastro5'];
		
		$tbVeiculosIC1 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar1']);
		$tbVeiculosIC2 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar2']);
		$tbVeiculosIC3 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar3']);
		$tbVeiculosIC4 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar4']);
		$tbVeiculosIC5 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar5']);
		$tbVeiculosIC6 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar6']);
		$tbVeiculosIC7 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar7']);
		$tbVeiculosIC8 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar8']);
		$tbVeiculosIC9 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar9']);
		$tbVeiculosIC10 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar10']);
		$tbVeiculosIC11 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar11']);
		$tbVeiculosIC12 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar12']);
		$tbVeiculosIC13 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar13']);
		$tbVeiculosIC14 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar14']);
		$tbVeiculosIC15 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar15']);
		$tbVeiculosIC16 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar16']);
		$tbVeiculosIC17 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar17']);
		$tbVeiculosIC18 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar18']);
		$tbVeiculosIC19 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar19']);
		$tbVeiculosIC20 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar20']);
		$tbVeiculosIC31 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar31']);
		$tbVeiculosIC32 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar32']);
		$tbVeiculosIC33 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar33']);
		$tbVeiculosIC34 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar34']);
		$tbVeiculosIC35 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar35']);
		$tbVeiculosIC36 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar36']);
		$tbVeiculosIC37 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar37']);
		$tbVeiculosIC38 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar38']);
		$tbVeiculosIC39 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar39']);
		$tbVeiculosIC40 = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['informacao_complementar40']);
		
		$tbVeiculosIdDBCepTblBairros = $linhaVeiculosDetalhes['id_db_cep_tblBairros'];
		$tbVeiculosIdDBCepTblCidades = $linhaVeiculosDetalhes['id_db_cep_tblCidades'];
		$tbVeiculosIdDBCepTblLogradouros = $linhaVeiculosDetalhes['id_db_cep_tblLogradouros'];
		$tbVeiculosIdDBCepTblUF = $linhaVeiculosDetalhes['id_db_cep_tblLogradouros'];
		
		$tbVeiculosVeiculoEndereco = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_endereco']);
		$tbVeiculosVeiculoEnderecoNumero = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_endereco_numero']);
		$tbVeiculosVeiculoEnderecoComplemento = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_endereco_complemento']);
		$tbVeiculosVeiculoBairro = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_bairro']);
		$tbVeiculosVeiculoCidade = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_cidade']);
		$tbVeiculosVeiculoEstado = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_estado']);
		$tbVeiculosVeiculoPais = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['veiculo_pais']);
		
		//$tbVeiculosVeiculoCEP = $linhaVeiculosDetalhes['veiculo_cep'];
		$tbVeiculosVeiculoCEP = Funcoes::FormatarCEPLer($linhaVeiculosDetalhes['veiculo_cep']);

		$tbVeiculosContato = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['contato']);
		$tbVeiculosEmail = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['email']);
		$tbVeiculosLinkExterno = $linhaVeiculosDetalhes['link_externo'];
		
		$tbVeiculosURL1 = $linhaVeiculosDetalhes['url1'];
		$tbVeiculosURL2 = $linhaVeiculosDetalhes['url2'];
		$tbVeiculosURL3 = $linhaVeiculosDetalhes['url3'];
		$tbVeiculosURL4 = $linhaVeiculosDetalhes['url4'];
		$tbVeiculosURL5 = $linhaVeiculosDetalhes['url5'];
		
		$tbVeiculosURLAmigavel = $linhaVeiculosDetalhes['url_amigavel'];
		$tbVeiculosPalavrasChave = $linhaVeiculosDetalhes['palavras_chave'];
		
		$tbVeiculosValor = Funcoes::MascaraValorLer($linhaVeiculosDetalhes['valor'], $GLOBALS['configSistemaMoeda']);
		$tbVeiculosValor1 = Funcoes::MascaraValorLer($linhaVeiculosDetalhes['valor1'], $GLOBALS['configSistemaMoeda']);
		$tbVeiculosValor2 = Funcoes::MascaraValorLer($linhaVeiculosDetalhes['valor2'], $GLOBALS['configSistemaMoeda']);
		
		$tbVeiculosAtivacao = $linhaVeiculosDetalhes['ativacao'];
		$tbVeiculosAtivacao1 = $linhaVeiculosDetalhes['ativacao1'];
		$tbVeiculosAtivacao2 = $linhaVeiculosDetalhes['ativacao2'];
		$tbVeiculosAtivacao3 = $linhaVeiculosDetalhes['ativacao3'];
		$tbVeiculosAtivacao4 = $linhaVeiculosDetalhes['ativacao4'];
		$tbVeiculosAtivacaoPromocao = $linhaVeiculosDetalhes['ativacao_promocao'];
		$tbVeiculosAtivacaoHome = $linhaVeiculosDetalhes['ativacao_home'];
		$tbVeiculosAtivacaoHomeCategoria = $linhaVeiculosDetalhes['ativacao_home_categoria'];
		$tbVeiculosAtivacaoInfoCadastro = $linhaVeiculosDetalhes['ativacao_info_cadastro'];
		$tbVeiculosAcessoRestrito = $linhaVeiculosDetalhes['acesso_restrito'];
		$tbVeiculosIdTbVeiculosStatus = $linhaVeiculosDetalhes['id_tb_veiculos_status'];
		$tbVeiculosIdTbVeiculosStatus_print = DbFuncoes::GetCampoGenerico01($tbVeiculosIdTbVeiculosStatus, "tb_veiculos_complemento", "complemento");
		
		$tbVeiculosImagem = $linhaVeiculosDetalhes['imagem'];
		$tbVeiculosArquivo1 = $linhaVeiculosDetalhes['arquivo1'];
		$tbVeiculosArquivo2 = $linhaVeiculosDetalhes['arquivo2'];
		$tbVeiculosArquivo3 = $linhaVeiculosDetalhes['arquivo3'];
		$tbVeiculosArquivo4 = $linhaVeiculosDetalhes['arquivo4'];
		$tbVeiculosArquivo5 = $linhaVeiculosDetalhes['arquivo5'];
		
		$tbVeiculosAnotacoesInternas = Funcoes::ConteudoMascaraLeitura($linhaVeiculosDetalhes['anotacoes_internas']);
		$tbVeiculosNVisitas = $linhaVeiculosDetalhes['n_visitas'];
		
		
		//Verificação de erro.
		//echo "tbVeiculosId=" . $tbVeiculosId . "<br>";
		//echo "tbVeiculosProcesso=" . $tbVeiculosProcesso . "<br>";
		
	}
}
//----------


//Definição de variáveis.
$tituloLinkAtual = Funcoes::RemoverHTML01($tbVeiculosVeiculo);


//Montagem das meta tags.
//----------
$metaTitulo = $tituloLinkAtual . " - " . Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig");
$metaTitulo = Funcoes::LimitadorCatecteres(Funcoes::RemoverHTML01($metaTitulo), 60);

$metaDescricao = Funcoes::RemoverHTML01($tbVeiculosDescricao);
$metaPalavrasChave = Funcoes::RemoverHTML01($tbVeiculosPalavrasChave);
//----------


//Verificação de erro - debug.
//echo "idTemporario=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer($GLOBALS['configNomeCookie'] . "_" . "idTbCadastroTemporario")), 2) . "<br>";
//echo "resultadoVeiculosComplemento=";
//var_dump($resultadoVeiculosComplemento);
//echo "<br>";

//echo "resultadoVeiculosComplementoRelacao=<pre>";
//var_dump($resultadoVeiculosComplementoRelacao);
//echo "</pre><br>";

//echo "resultadoVeiculosFiltroGenerico01Selecao=<pre>";
//var_dump($resultadoVeiculosFiltroGenerico01Selecao);
//echo "</pre><br>";

//echo "resultadoVeiculosFiltroGenerico01Selecao[id_tb_veiculos_complemento]=<pre>";
//var_dump($resultadoVeiculosFiltroGenerico01Selecao["id_tb_veiculos_complemento"]);
//echo "</pre><br>";
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
    <meta name="title" content="<?php echo $metaTitulo; ?>" /><?php //Abaixo de 60 caracteres.?>
    <meta name="description" content="<?php echo $metaDescricao; ?>" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="<?php echo $metaPalavrasChave; ?>" /><?php //Abaixo de 100 caracteres.?>
    
    <meta property="og:title" content="<?php echo Funcoes::LimitadorCatecteres($metaTitulo, 35); ?>" /> <?php //35 caracteres.?>
    <meta property="og:url" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/SiteVeiculosDetalhes.php?idTbVeiculos=" . $idTbVeiculos; ?>" />
    <meta property="og:description" content="<?php echo $metaDescricao; ?>"><?php //155 caracteres - Funcoes.LimitadorCatecteres($metaDescricao, 155).?>
    <?php if($tbVeiculosImagem <> ""){ ?>
    <meta property="og:image" content="<?php echo $configUrl . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/r" . $tbVeiculosImagem; ?>"><?php //JPG ou PNG, menos que 300k e dimensão mínima de 300x200 pixels.?>
    <?php } ?>
    <meta property="og:image:alt" content="<?php echo $metaTitulo; ?>" />
    <meta property="og:type" content="product.item" /><?php //referencias de tipos: https://developers.facebook.com/docs/reference/opengraph/.?>

    <meta property="og:locale" content="pt_BR" />
    <!--meta property="og:locale:alternate" content="fr_FR" /--><?php //Idiomas adicionais.?>
    <!--meta property="og:locale:alternate" content="es_ES" /-->

    <!--
    Twitter: https://developer.twitter.com/en/docs/tweets/optimize-with-cards/guides/getting-started
    Áudio/Vídeo: http://ogp.me/
    Favicon: https://stackoverflow.com/questions/2268204/favicon-dimensions/43154399#43154399
    -->
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
	<?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteTarefasTitulo"); ?>
	<?php echo $tituloLinkAtual; ?>
<?php 
$pageSite->cphTituloLinkAtual = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Conteúdo principal.?>
<?php //**************************************************************************************?>
<?php ob_start(); /*cphConteudoPrincipal*/ ?>
    <div id="lblMensagemErro" align="center" class="AdmErro">
        <?php echo $mensagemErro;?>
    </div>
    <div id="lblMensagemSucesso" align="center" class="AdmSucesso">
        <?php echo $mensagemSucesso;?>
    </div>
    <div id="lblMensagemAlerta" align="center" class="AdmAlerta">
        <?php echo $mensagemAlerta;?>
    </div>
    
    
	<?php //Diagramação 1.?>
    <?php //**************************************************************************************?>
    <div align="center" style="position: relative; display: block;">
    	
		<?php //Imagem Principal.?>
        <?php if($tbVeiculosImagem <> ""){ ?>
            <div align="center">
                <?php //SlimBox 2 - JQuery.?>
                <?php if($GLOBALS['configImagemPopUp'] == "1"){ ?>
                    <div class="VeiculosImagemDetalhes"><a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>g<?php echo $tbVeiculosImagem;?>" rel="lightbox" title="<?php echo $tbVeiculosProduto; ?>"><img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?><?php echo $tbVeiculosImagem;?>" alt="<?php echo $tbVeiculosProduto; ?>" /></a></div>
                <?php } ?>
                
                <?php //Pop-up div com comentários.?>
                <?php if($GLOBALS['configImagemPopUp'] == "2"){ ?>

                <?php } ?>
            </div>
        <?php } ?>
        
        <table border="0" cellspacing="4" cellpadding="0">
            <tr valign="top">
                <td>
                    <div class="VeiculosDetalhesConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDataPublicacao");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="VeiculosDetalhesConteudo">
                    	<?php echo $tbVeiculosDataPublicacao;?>
                    </div>
                </td>
            </tr>
    
            <tr valign="top">
                <td>
                    <div class="VeiculosDetalhesConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosCodigo");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="VeiculosDetalhesConteudo">
                    	<?php echo $tbVeiculosCodigo;?>
                    </div>
                </td>
            </tr>
    
            <?php if($GLOBALS['habilitarVeiculosTipo'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="VeiculosDetalhesConteudo">
                            <strong>
							    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosTipo");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="VeiculosDetalhesConteudo">
							<?php
                            //Loop pelos resultados.
                            foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                            {
                            ?>
                                <div>
                                    <?php if($linhaVeiculosComplemento["tipo_complemento"] == "2"){ ?> 
                                        <?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                            - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
    
            <tr valign="top">
                <td>
                    <div class="VeiculosDetalhesConteudo">
                        <strong>
                             <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculo");?>: 
                        </strong>
                    </div>
                </td>
                <td>
                    <div align="left" class="VeiculosDetalhesConteudo"><?php //class="VeiculosDetalhesTitulo" ?>
                        <h2 style="padding: 0px; margin: 0px; font-size: inherit;">
							<?php echo $tbVeiculosVeiculo;?>
                        </h2>
                    </div>
                </td>
            </tr>
    
            <?php if($GLOBALS['habilitarVeiculosValor'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="VeiculosDetalhesConteudo">
                            <strong>
								 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosValor");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="VeiculosDetalhesConteudo">
                        	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig");?> 
                            <?php echo $tbVeiculosValor;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarVeiculosValor1'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="VeiculosDetalhesConteudo">
                            <strong>
								 <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Nome'], "IncludeConfig");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="VeiculosDetalhesConteudo">
                        	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Moeda'], "IncludeConfig"); ?> 
                            <?php echo $tbVeiculosValor1;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
    
            <?php if($GLOBALS['habilitarVeiculosStatus'] == "1"){ ?>
                <tr valign="top">
                    <td>
                        <div class="VeiculosDetalhesConteudo">
                            <strong>
								 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosStatus");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="VeiculosDetalhesConteudo">
                            <?php //echo $tbVeiculosIdTbVeiculosStatus;?>
                            <?php echo $tbVeiculosIdTbVeiculosStatus_print;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
    
			<?php if($tbVeiculosDescricao <> ""){ ?>
                <tr valign="top">
                    <td>
                        <div class="VeiculosDetalhesConteudo">
                            <strong>
                                 <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDescricao");?>: 
                            </strong>
                        </div>
                    </td>
                    <td>
                        <div align="left" class="VeiculosDetalhesConteudo">
                            <?php echo $tbVeiculosDescricao;?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php //**************************************************************************************?>
    
    
	<?php //Informações complementares. ?>
    <?php //************************************************************************************** ?>
	<?php if($tbVeiculosDescricao <> ""){ ?>
        <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDescricao");?>: 
        </div>
        <div align="justify" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
            <?php echo $tbVeiculosDescricao;?>
        </div>
        <div class="VeiculosDetalhesConteudoSeparador">
        </div>
    <?php } ?>
    <?php //************************************************************************************** ?>
    
    
	<?php //Detalhes. ?>
    <?php //************************************************************************************** ?>
		<?php if($tbVeiculosModalidade_print <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosModalidade_print;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    
		<?php if($tbVeiculosDataPublicacao <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosDataPublicacao");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosDataPublicacao;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

		<?php if($tbVeiculosCodigo <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosCodigo");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosCodigo;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosData1'] == 1){ ?>
		<?php if($tbVeiculosData1 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData1'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData1;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData2'] == 1){ ?>
		<?php if($tbVeiculosData2 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData2'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData2;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData3'] == 1){ ?>
		<?php if($tbVeiculosData3 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData3'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData3;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData4'] == 1){ ?>
		<?php if($tbVeiculosData4 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData4'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData4;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData5'] == 1){ ?>
		<?php if($tbVeiculosData5 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData5'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData5;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData6'] == 1){ ?>
		<?php if($tbVeiculosData6 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData6'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData6;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData7'] == 1){ ?>
		<?php if($tbVeiculosData7 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData7'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData7;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData8'] == 1){ ?>
		<?php if($tbVeiculosData8 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData8'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData8;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData9'] == 1){ ?>
		<?php if($tbVeiculosData9 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData9'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData9;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosData10'] == 1){ ?>
		<?php if($tbVeiculosData10 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosData10'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosData10;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

		<?php if($tbVeiculosModalidade_print <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosModalidade");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosModalidade_print;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosTipo'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosTipo");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "2"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico01'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico01Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "12"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico02'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico02Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "13"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico03'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico03Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "14"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico04'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico04Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "15"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico05'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico05Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "16"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico06'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico06Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "17"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico07'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico07Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "18"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico08'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico08Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "19"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico09'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico09Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "20"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico10'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico10Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "21"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico11'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico11Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "22"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico12'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico12Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "23"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico13'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico13Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "24"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico14'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico14Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "25"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico15'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico15Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "26"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico16'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico16Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "27"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico17'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico17Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "28"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico18'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico18Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "29"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico19'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico19Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "30"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosFiltroGenerico20'] == 1){ ?>
		<?php //if($xxx <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosFiltroGenerico20Nome'], "IncludeConfig"); ?>: 
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php
                    //Loop pelos resultados.
                    foreach($resultadoVeiculosComplemento as $linhaVeiculosComplemento)
                    {
                    ?>
                        <div>
                            <?php if($linhaVeiculosComplemento["tipo_complemento"] == "31"){ ?> 
								<?php if(in_array($linhaVeiculosComplemento["id"], array_column($resultadoVeiculosComplementoRelacao, 'id_tb_veiculos_complemento'))){ ?> 
                                    - <?php echo Funcoes::ConteudoMascaraLeitura($linhaVeiculosComplemento["complemento"]);?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php //} ?>
    <?php } ?>
    

		<?php if($tbVeiculosPortas <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPortas");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosPortas;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

		<?php if($tbVeiculosKilometragem <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragem"); ?> 
                    (<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMetricoDistancia'], "IncludeConfig"); ?>):
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosKilometragem;?>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosQuilometragemDescricao01"); ?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosPlaca'] == 1){ ?>
		<?php if($tbVeiculosPlaca <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosPlaca"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosPlaca;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

		<?php if($tbVeiculosAnoFabricacao <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAnoFabricacao");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosAnoFabricacao;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

		<?php if($tbVeiculosAnoModelo <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosAnoModelo");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosAnoModelo;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc1'] == 1){ ?>
		<?php if($tbVeiculosIC1 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc1'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC1;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc2'] == 1){ ?>
		<?php if($tbVeiculosIC2 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc2'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC2;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc3'] == 1){ ?>
		<?php if($tbVeiculosIC3 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc3'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC3;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc4'] == 1){ ?>
		<?php if($tbVeiculosIC4 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc4'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC4;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc5'] == 1){ ?>
		<?php if($tbVeiculosIC5 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc5'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC5;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc6'] == 1){ ?>
		<?php if($tbVeiculosIC6 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc6'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC6;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc7'] == 1){ ?>
		<?php if($tbVeiculosIC7 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc7'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC7;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc8'] == 1){ ?>
		<?php if($tbVeiculosIC8 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc8'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC8;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc9'] == 1){ ?>
		<?php if($tbVeiculosIC9 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc9'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC9;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc10'] == 1){ ?>
		<?php if($tbVeiculosIC10 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc10'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC10;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarVeiculosIc11'] == 1){ ?>
		<?php if($tbVeiculosIC11 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc11'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC11;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc12'] == 1){ ?>
		<?php if($tbVeiculosIC12 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc12'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC12;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc13'] == 1){ ?>
		<?php if($tbVeiculosIC13 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc13'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC13;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc14'] == 1){ ?>
		<?php if($tbVeiculosIC14 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc14'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC14;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc15'] == 1){ ?>
		<?php if($tbVeiculosIC15 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc15'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC15;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc16'] == 1){ ?>
		<?php if($tbVeiculosIC16 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc16'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC16;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc17'] == 1){ ?>
		<?php if($tbVeiculosIC17 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc17'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC17;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc18'] == 1){ ?>
		<?php if($tbVeiculosIC18 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc18'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC18;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc19'] == 1){ ?>
		<?php if($tbVeiculosIC19 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc19'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC19;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosIc20'] == 1){ ?>
		<?php if($tbVeiculosIC20 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloVeiculosIc20'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIC20;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

	<?php if($GLOBALS['configVeiculosIncluirLocalizacao'] == 1){ ?>
		<?php if($tbVeiculosVeiculoCEP <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoCEP");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoCEP;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoEndereco <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEndereco");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoEndereco;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoEnderecoNumero <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEnderecoNumero");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoEnderecoNumero;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoEnderecoComplemento <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEnderecoComplemento");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoEnderecoComplemento;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoBairro <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoBairro");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoBairro;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoCidade <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoCidade");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoCidade;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoEstado <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoEstado");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoEstado;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
		<?php if($tbVeiculosVeiculoPais <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosVeiculoPais");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosVeiculoPais;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosContato'] == 1){ ?>
		<?php if($tbVeiculosContato <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosContato");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosContato;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosEmail'] == 1){ ?>
		<?php if($tbVeiculosEmail <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosEMail");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosEmail;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosURLExterno'] == 1){ ?>
		<?php if($tbVeiculosLinkExterno <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosLinkExterno"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                	<a href="<?php echo $tbVeiculosLinkExterno;?>" class="VeiculosLinks01" target="_blank">
						<?php echo $tbVeiculosLinkExterno;?>
                    </a>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    
    <?php if($GLOBALS['habilitarVeiculosURL1'] == 1){ ?>
		<?php if($tbVeiculosURL1 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL1Titulo'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                	<a href="<?php echo $tbVeiculosURL1;?>" class="VeiculosLinks01" target="_blank">
						<?php echo $tbVeiculosURL1;?>
                    </a>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosURL2'] == 1){ ?>
		<?php if($tbVeiculosURL2 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL2Titulo'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                	<a href="<?php echo $tbVeiculosURL2;?>" class="VeiculosLinks01" target="_blank">
						<?php echo $tbVeiculosURL2;?>
                    </a>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosURL3'] == 1){ ?>
		<?php if($tbVeiculosURL3 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL3Titulo'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                	<a href="<?php echo $tbVeiculosURL3;?>" class="VeiculosLinks01" target="_blank">
						<?php echo $tbVeiculosURL3;?>
                    </a>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosURL4'] == 1){ ?>
		<?php if($tbVeiculosURL4 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL4Titulo'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                	<a href="<?php echo $tbVeiculosURL4;?>" class="VeiculosLinks01" target="_blank">
						<?php echo $tbVeiculosURL4;?>
                    </a>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosURL5'] == 1){ ?>
		<?php if($tbVeiculosURL5 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosURL5Titulo'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                	<a href="<?php echo $tbVeiculosURL5;?>" class="VeiculosLinks01" target="_blank">
						<?php echo $tbVeiculosURL5;?>
                    </a>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosValor'] == 1){ ?>
		<?php if($tbVeiculosValor <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosValor");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                    <?php echo $tbVeiculosValor;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosValor1'] == 1){ ?>
		<?php if($tbVeiculosValor1 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor1Nome'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                    <?php echo $tbVeiculosValor1;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php if($GLOBALS['habilitarVeiculosValor2'] == 1){ ?>
		<?php if($tbVeiculosValor1 <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configVeiculosValor2Nome'], "IncludeConfig"); ?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
					<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig") . " "; ?>
                    <?php echo $tbVeiculosValor2;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if($GLOBALS['habilitarVeiculosStatus'] == 1){ ?>
		<?php if($tbVeiculosIdTbVeiculosStatus_print <> ""){ ?>
            <div class="VeiculosDetalhesConteudoDivFileira01">
                <div class="VeiculosDetalhesSubtitulo VeiculosDetalhesConteudoDiv">
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteVeiculosStatus");?>:
                </div>
                <div align="left" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
                    <?php echo $tbVeiculosIdTbVeiculosStatus_print;?>
                </div>
                <div class="VeiculosDetalhesConteudoSeparador">
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <?php //************************************************************************************** ?>
    
    
	<?php //Mapa on-line. ?>
    <?php //************************************************************************************** ?>
    <div align="center" class="VeiculosDetalhesConteudo VeiculosDetalhesConteudoDiv">
    	<?php //iFrame. ?>
    	<?php //ref: https://developers.google.com/maps/documentation/embed/guide. ?>
        <iframe
          width="100%"
          height="350"
          frameborder="0" style="border:0"
          src="https://www.google.com/maps/embed/v1/place?key=<?php echo $GLOBALS['configAPIGoogleMapsJavascript'];?>
            &q=<?php echo $tbVeiculosVeiculoEndereco;?>+<?php echo $tbVeiculosVeiculoEnderecoNumero;?>+<?php echo $tbVeiculosVeiculoBairro;?>+<?php echo $tbVeiculosVeiculoCidade;?>+<?php echo $tbVeiculosVeiculoEstado;?>
            &zoom=15" allowfullscreen>
        </iframe>
    </div>

    <div class="VeiculosDetalhesConteudoSeparador">
    </div>
    <?php //************************************************************************************** ?>
    
    
	<?php //Imagens complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivosImagens_idTbArquivos = $tbVeiculosId;
	$includeArquivosImagens_tipoVisualizacao = "1";
	
	$includeArquivosImagens_limiteRegistros = "";
	$includeArquivosImagens_nImagensVisivelScroll = "3";
	$includeArquivosImagens_configImagemZoom = "1";
	?>
    
    <?php include "IncludeArquivosImagens.php";?>
    <?php //----------------------?>
    
    
	<?php //Arquivos complementares.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeArquivos_idTbArquivos = $tbVeiculosId;
	$includeArquivos_tipoVisualizacao = "1";
	$includeArquivos_configArquivosNColunas = "1";
	
	$includeArquivos_limiteRegistros = "";
	$includeArquivos_nImagensVisivelScroll = "1";
	?>
    
    <?php include "IncludeArquivos.php";?>
    <?php //----------------------?>
    
    
	<?php //Conteúdo.?>
    <?php //----------------------?>
    <?php 
	//Definição de variáveis do include.
	$includeConteudo_idParentConteudo = $tbVeiculosId;
	$includeConteudo_idTbConteudo = "";
	$includeConteudo_tipoConteudo = "";
	
	$includeConteudo_configTipoDiagramacao = "1";
	$includeConteudo_configConteudoNRegistros = "";
	$includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
	?>
    
    <?php include "IncludeConteudo.php";?>
    <?php //----------------------?>

    
	<?php //Cadastro - Detalhes.?>
    <?php //----------------------?>
    <?php if($tbVeiculosIdTbCadastroUsuario <> 0){?>
        <?php 
        //Definição de variáveis do include.
        //$includePaginas_idParentPaginas = $tbCadastroId;
        $includeCadastroDetalhes_idTbCadastro = $tbVeiculosIdTbCadastroUsuario;
        $includeCadastro_configTipoDiagramacao = "1";
        ?>
        
        <?php include "IncludeCadastroDetalhes.php";?>
    <?php } ?>
    <?php //----------------------?>


    <div align="center">
		<a href="javascript:history.go(-1);">
			<img src="img/btoVoltar.png" border="0" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoVoltar"); ?>" />
		</a>
    </div>
    
    
    <?php //Progress bar.?>
    <div id="updtProgressVeiculosDetalhes" class="ProgressBarGenerico01Container" style="display: none;">
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
unset($strSqlVeiculosDetalhesSelect);
unset($statementVeiculosDetalhesSelect);
unset($resultadoVeiculosDetalhes);
unset($linhaVeiculosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>