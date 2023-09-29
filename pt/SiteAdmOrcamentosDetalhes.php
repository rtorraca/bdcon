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
$idCeOrcamentos = $_GET["idCeOrcamentos"];
$idTbCadastroLogin = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login()), 2);

$orcamentosItensRelacaoRegistrosValorTotal = 0;
$orcamentosItensRelacaoRegistrosQtdTotal = 0;

$paginaRetorno = "OrcamentosDetalhes.php";
$criterioClassificacao = "";
$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Query de pesquisa.
//----------
$strSqlOrcamentosDetalhesSelect = "";
$strSqlOrcamentosDetalhesSelect .= "SELECT ";
//$strSqlOrcamentosDetalhesSelect .= "* ";
$strSqlOrcamentosDetalhesSelect .= "id, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_cliente, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_vendedor, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlOrcamentosDetalhesSelect .= "data_orcamento, ";
$strSqlOrcamentosDetalhesSelect .= "data_entrega, ";
$strSqlOrcamentosDetalhesSelect .= "valor_orcamento, ";
$strSqlOrcamentosDetalhesSelect .= "valor_frete, ";
$strSqlOrcamentosDetalhesSelect .= "periodo_contratacao, ";
$strSqlOrcamentosDetalhesSelect .= "tipo_entrega, ";
$strSqlOrcamentosDetalhesSelect .= "valor_total, ";
$strSqlOrcamentosDetalhesSelect .= "peso_total, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlOrcamentosDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlOrcamentosDetalhesSelect .= "obs, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao1, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao2, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao3, ";
$strSqlOrcamentosDetalhesSelect .= "ativacao4, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar1, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar2, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar3, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar4, ";
$strSqlOrcamentosDetalhesSelect .= "informacao_complementar5, ";
$strSqlOrcamentosDetalhesSelect .= "id_ce_complemento_status ";
$strSqlOrcamentosDetalhesSelect .= "FROM ce_orcamentos ";
$strSqlOrcamentosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlOrcamentosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlOrcamentosDetalhesSelect .= "AND id = :id ";
//$strSqlOrcamentosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//echo "strSqlOrcamentosDetalhesSelect=" . $strSqlOrcamentosDetalhesSelect . "<br>";
//----------


//Parâmetros.
//----------
$statementOrcamentosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosDetalhesSelect);

if ($statementOrcamentosDetalhesSelect !== false)
{
	$statementOrcamentosDetalhesSelect->execute(array(
		"id" => $idCeOrcamentos
	));
}
//----------


//$resultadoOrcamentosDetalhes = $dbSistemaConPDO->query($strSqlOrcamentosDetalhesSelect);
$resultadoOrcamentosDetalhes = $statementOrcamentosDetalhesSelect->fetchAll();


if (empty($resultadoOrcamentosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoOrcamentosDetalhes as $linhaOrcamentosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbOrcamentosId = $linhaOrcamentosDetalhes['id'];
		$tbOrcamentosIdTbCadastroCliente = $linhaOrcamentosDetalhes['id_tb_cadastro_cliente'];
		$tbOrcamentosIdTbCadastroEnderecos = $linhaOrcamentosDetalhes['id_tb_cadastro_enderecos'];
		$tbOrcamentosIdTbCadastroVendedor = $linhaOrcamentosDetalhes['id_tb_cadastro_vendedor'];
		$tbOrcamentosIdTbCadastroUsuario = $linhaOrcamentosDetalhes['id_tb_cadastro_usuario'];
		//$tbOrcamentosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['tipo_pagamento']);
		
		//$tbOrcamentosDataPedido = $linhaOrcamentosDetalhes['data_pedido'];
		if($linhaOrcamentosDetalhes['data_orcamento'] == NULL)
		{
			$tbOrcamentosDataOrcamento = "";
		}else{
			$tbOrcamentosDataOrcamento = Funcoes::DataLeitura01($linhaOrcamentosDetalhes['data_orcamento'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		
		//$tbOrcamentosDataEntrega = $linhaOrcamentosDetalhes['data_entrega'];
		if($linhaOrcamentosDetalhes['data_entrega'] == NULL)
		{
			$tbOrcamentosDataEntrega = "";
		}else{
			$tbOrcamentosDataEntrega = Funcoes::DataLeitura01($linhaOrcamentosDetalhes['data_entrega'], $GLOBALS['configSistemaFormatoData'], "1");
		}


		//$tbOrcamentosValorPedido = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorOrcamento = $linhaOrcamentosDetalhes['valor_orcamento'];

		//$tbOrcamentosValorFrete = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorFrete = $linhaOrcamentosDetalhes['valor_frete'];

		$tbOrcamentosPeriodoContratacao = $linhaOrcamentosDetalhes['periodo_contratacao'];
		$tbOrcamentosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['tipo_entrega']);

		//$tbOrcamentosValorTotal = Funcoes::MascaraValorLer($linhaOrcamentosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
		$tbOrcamentosValorTotal = $linhaOrcamentosDetalhes['valor_total'];

		$tbOrcamentosPesoTotal = $linhaOrcamentosDetalhes['peso_total'];
		$tbOrcamentosIdTbCadastro1 = $linhaOrcamentosDetalhes['id_tb_cadastro1'];
		$tbOrcamentosIdTbCadastro2 = $linhaOrcamentosDetalhes['id_tb_cadastro2'];
		$tbOrcamentosIdTbCadastro3 = $linhaOrcamentosDetalhes['id_tb_cadastro3'];
		$tbOrcamentosOBS = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['obs']);
		$tbOrcamentosAtivacao = $linhaOrcamentosDetalhes['ativacao'];
		$tbOrcamentosAtivacao1 = $linhaOrcamentosDetalhes['ativacao1'];
		$tbOrcamentosAtivacao2 = $linhaOrcamentosDetalhes['ativacao2'];
		$tbOrcamentosAtivacao3 = $linhaOrcamentosDetalhes['ativacao3'];
		$tbOrcamentosAtivacao4 = $linhaOrcamentosDetalhes['ativacao4'];
		$tbOrcamentosIC1 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar1']);
		$tbOrcamentosIC2 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar2']);
		$tbOrcamentosIC3 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar3']);
		$tbOrcamentosIC4 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar4']);
		$tbOrcamentosIC5 = Funcoes::ConteudoMascaraLeitura($linhaOrcamentosDetalhes['informacao_complementar5']);
		$tbOrcamentosIdCeComplementoStatus = $linhaOrcamentosDetalhes['id_ce_complemento_status'];
		
		
		//Verificação de erro.
		//echo "tbOrcamentosId=" . $tbOrcamentosId . "<br>";
		//echo "tbOrcamentosValorPedido=" . $tbOrcamentosValorPedido . "<br>";
		//echo "tbOrcamentosAtivacao=" . $tbOrcamentosAtivacao . "<br>";
	}
}


//Limpeza de objetos.
//----------
unset($strSqlOrcamentosDetalhesSelect);
unset($statementOrcamentosDetalhesSelect);
unset($resultadoOrcamentosDetalhes);
unset($linhaOrcamentosDetalhes);
//----------


//Verificação de erro - debug.
//echo "paginacaoTotalRegistros=" . $paginacaoTotalRegistros . "<br />";
//echo "idParentOrcamentos=" . $idParentOrcamentos . "<br />";



//Detalhes do cliente.
//Query de pesquisa.
//----------
$strSqlCadastroDetalhesSelect = "";
$strSqlCadastroDetalhesSelect .= "SELECT ";
$strSqlCadastroDetalhesSelect .= "id, ";
$strSqlCadastroDetalhesSelect .= "id_tb_categorias, ";
//$strSqlCadastroDetalhesSelect .= "id_parent_cadastro, ";

$strSqlCadastroDetalhesSelect .= "data_cadastro, ";
$strSqlCadastroDetalhesSelect .= "data1, ";
$strSqlCadastroDetalhesSelect .= "data2, ";
$strSqlCadastroDetalhesSelect .= "data3, ";
$strSqlCadastroDetalhesSelect .= "data4, ";
$strSqlCadastroDetalhesSelect .= "data5, ";
$strSqlCadastroDetalhesSelect .= "data6, ";
$strSqlCadastroDetalhesSelect .= "data7, ";
$strSqlCadastroDetalhesSelect .= "data8, ";
$strSqlCadastroDetalhesSelect .= "data9, ";
$strSqlCadastroDetalhesSelect .= "data10, ";

$strSqlCadastroDetalhesSelect .= "pf_pj, ";
$strSqlCadastroDetalhesSelect .= "nome, ";
$strSqlCadastroDetalhesSelect .= "sexo, ";
$strSqlCadastroDetalhesSelect .= "altura, ";
$strSqlCadastroDetalhesSelect .= "peso, ";
$strSqlCadastroDetalhesSelect .= "razao_social, ";
$strSqlCadastroDetalhesSelect .= "nome_fantasia, ";
$strSqlCadastroDetalhesSelect .= "data_nascimento, ";
$strSqlCadastroDetalhesSelect .= "cpf_, ";
$strSqlCadastroDetalhesSelect .= "rg_, ";
$strSqlCadastroDetalhesSelect .= "cnpj_, ";
$strSqlCadastroDetalhesSelect .= "documento, ";
$strSqlCadastroDetalhesSelect .= "i_municipal, ";
$strSqlCadastroDetalhesSelect .= "i_estadual, ";

$strSqlCadastroDetalhesSelect .= "endereco_principal, ";
$strSqlCadastroDetalhesSelect .= "endereco_numero_principal, ";
$strSqlCadastroDetalhesSelect .= "endereco_complemento_principal, ";
$strSqlCadastroDetalhesSelect .= "bairro_principal, ";
$strSqlCadastroDetalhesSelect .= "cidade_principal, ";
$strSqlCadastroDetalhesSelect .= "estado_principal, ";
$strSqlCadastroDetalhesSelect .= "pais_principal, ";
$strSqlCadastroDetalhesSelect .= "cep_principal, ";

$strSqlCadastroDetalhesSelect .= "ponto_referencia, ";
$strSqlCadastroDetalhesSelect .= "email_principal, ";
$strSqlCadastroDetalhesSelect .= "tel_ddd_principal, ";
$strSqlCadastroDetalhesSelect .= "tel_principal, ";
$strSqlCadastroDetalhesSelect .= "cel_ddd_principal, ";
$strSqlCadastroDetalhesSelect .= "cel_principal, ";
$strSqlCadastroDetalhesSelect .= "fax_ddd_principal, ";
$strSqlCadastroDetalhesSelect .= "fax_principal, ";
$strSqlCadastroDetalhesSelect .= "site_principal, ";
$strSqlCadastroDetalhesSelect .= "n_funcionarios, ";
$strSqlCadastroDetalhesSelect .= "obs_interno, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro_status, ";
//$strSqlCadastroDetalhesSelect .= "id_tb_cadastro, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlCadastroDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlCadastroDetalhesSelect .= "ativacao, ";
$strSqlCadastroDetalhesSelect .= "ativacao_destaque, ";
$strSqlCadastroDetalhesSelect .= "ativacao_mala_direta, ";
$strSqlCadastroDetalhesSelect .= "usuario, ";
$strSqlCadastroDetalhesSelect .= "senha, ";

$strSqlCadastroDetalhesSelect .= "imagem, ";
$strSqlCadastroDetalhesSelect .= "logo, ";
$strSqlCadastroDetalhesSelect .= "banner, ";
$strSqlCadastroDetalhesSelect .= "mapa, ";

$strSqlCadastroDetalhesSelect .= "mapa_online, ";
$strSqlCadastroDetalhesSelect .= "palavras_chave, ";
$strSqlCadastroDetalhesSelect .= "apresentacao, ";
$strSqlCadastroDetalhesSelect .= "servicos, ";
$strSqlCadastroDetalhesSelect .= "promocoes, ";
$strSqlCadastroDetalhesSelect .= "condicoes_comerciais, ";
$strSqlCadastroDetalhesSelect .= "formas_pagamento, ";
$strSqlCadastroDetalhesSelect .= "horario_atendimento, ";
$strSqlCadastroDetalhesSelect .= "situacao_atual, ";

$strSqlCadastroDetalhesSelect .= "informacao_complementar1, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar2, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar3, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar4, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar5, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar6, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar7, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar8, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar9, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar10, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar11, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar12, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar13, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar14, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar15, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar16, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar17, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar18, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar19, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar20, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar21, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar22, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar23, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar24, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar25, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar26, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar27, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar28, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar29, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar30, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar31, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar32, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar33, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar34, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar35, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar36, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar37, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar38, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar39, ";
$strSqlCadastroDetalhesSelect .= "informacao_complementar40, ";

$strSqlCadastroDetalhesSelect .= "n_visitas ";
$strSqlCadastroDetalhesSelect .= "FROM tb_cadastro ";
$strSqlCadastroDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlCadastroDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlCadastroDetalhesSelect .= "AND id = :id ";
//$strSqlCadastroDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";


$statementCadastroDetalhesSelect = $dbSistemaConPDO->prepare($strSqlCadastroDetalhesSelect);

if ($statementCadastroDetalhesSelect !== false)
{
	$statementCadastroDetalhesSelect->execute(array(
		"id" => $tbOrcamentosIdTbCadastroCliente
	));
}

//$resultadoCadastroDetalhes = $dbSistemaConPDO->query($strSqlCadastroDetalhesSelect);
$resultadoCadastroDetalhes = $statementCadastroDetalhesSelect->fetchAll();


if (empty($resultadoCadastroDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoCadastroDetalhes as $linhaCadastroDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbCadastroId = $linhaCadastroDetalhes['id'];
		$tbCadastroIdTbCategorias = $linhaCadastroDetalhes['id_tb_categorias'];
		$tbCadastroDataCadastro = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_cadastro'], $GLOBALS['configSistemaFormatoData'], "1");
		//$tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
		
		$tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
		$tbCadastroPfPj_print = "";
		if($tbCadastroPfPj == "1"){
			$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj1");
		}
		if($tbCadastroPfPj == "2"){
			$tbCadastroPfPj_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPfPj2");
		}

		$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
		
		$tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
		$tbCadastroSexo_print = "";
		if($tbCadastroSexo == "1"){
			$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo1");
		}
		if($tbCadastroSexo == "2"){
			$tbCadastroSexo_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroSexo2");
		}
		
		$tbCadastroAltura = $linhaCadastroDetalhes['altura'];
		$tbCadastroPeso = $linhaCadastroDetalhes['peso'];
		$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
		$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
		
		//$tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
		//$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
		if($linhaCadastroDetalhes['data_nascimento'] == NULL)
		{
			$tbCadastroDataNascimento = "";
		}else{
			$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSiteFormatoData'], "1");
		}
		
		if($linhaCadastroDetalhes['data1'] == NULL)
		{
			$tbCadastroData1 = "";
		}else{
			$tbCadastroData1 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data1'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data2'] == NULL)
		{
			$tbCadastroData2 = "";
		}else{
			$tbCadastroData2 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data2'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data3'] == NULL)
		{
			$tbCadastroData3 = "";
		}else{
			$tbCadastroData3 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data3'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data4'] == NULL)
		{
			$tbCadastroData4 = "";
		}else{
			$tbCadastroData4 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data4'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data5'] == NULL)
		{
			$tbCadastroData5 = "";
		}else{
			$tbCadastroData5 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data5'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data6'] == NULL)
		{
			$tbCadastroData6 = "";
		}else{
			$tbCadastroData6 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data6'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data7'] == NULL)
		{
			$tbCadastroData7 = "";
		}else{
			$tbCadastroData7 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data7'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data8'] == NULL)
		{
			$tbCadastroData8 = "";
		}else{
			$tbCadastroData8 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data8'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data9'] == NULL)
		{
			$tbCadastroData9 = "";
		}else{
			$tbCadastroData9 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data9'], $GLOBALS['configSistemaFormatoData'], "1");
		}
		if($linhaCadastroDetalhes['data10'] == NULL)
		{
			$tbCadastroData10 = "";
		}else{
			$tbCadastroData10 = Funcoes::DataLeitura01($linhaCadastroDetalhes['data10'], $GLOBALS['configSistemaFormatoData'], "1");
		}

		//$tbCadastroCPF = $linhaCadastroDetalhes['cpf_'];
		$tbCadastroCPF = Funcoes::FormatarCPFLer($linhaCadastroDetalhes['cpf_']);
		$tbCadastroRG = $linhaCadastroDetalhes['rg_'];
		//$tbCadastroCNPJ = $linhaCadastroDetalhes['cnpj_'];
		$tbCadastroCNPJ = Funcoes::FormatarCNPJLer($linhaCadastroDetalhes['cnpj_']);
		$tbCadastroDocumento = $linhaCadastroDetalhes['documento'];
		$tbCadastroIMunicipal = $linhaCadastroDetalhes['i_municipal'];
		$tbCadastroIEstadual = $linhaCadastroDetalhes['i_estadual'];
		$tbCadastroEnderecoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_principal']);
		$tbCadastroEnderecoNumeroPrincipal = $linhaCadastroDetalhes['endereco_numero_principal'];
		$tbCadastroEnderecoComplementoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['endereco_complemento_principal']);
		$tbCadastroBairroPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['bairro_principal']);
		$tbCadastroCidadePrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['cidade_principal']);
		$tbCadastroEstadoPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['estado_principal']);
		$tbCadastroPaisPrincipal = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['pais_principal']);
		//$tbCadastro = $linhaCadastroDetalhes['id_config_bairro'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_cidade'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_estado'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_regiao'];
		//$tbCadastro = $linhaCadastroDetalhes['id_config_pais'];
		$tbCadastroIdDBCepTblBairros = $linhaCadastroDetalhes['id_db_cep_tblBairros'];
		$tbCadastroIdDBCepTblCidades = $linhaCadastroDetalhes['id_db_cep_tblCidades'];
		$tbCadastroIdDBCepTblLogradouros = $linhaCadastroDetalhes['id_db_cep_tblLogradouros'];
		$tbCadastroIdDBCepTblUF = $linhaCadastroDetalhes['id_db_cep_tblUF'];
		
		//$tbCadastroCepPrincipal = $linhaCadastroDetalhes['cep_principal'];
		$tbCadastroCepPrincipal = Funcoes::FormatarCEPLer($linhaCadastroDetalhes['cep_principal']);
		
		$tbCadastroPontoReferencia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['ponto_referencia']);
		$tbCadastroEmailPrincipal = $linhaCadastroDetalhes['email_principal'];
		$tbCadastroTelDDDPrincipal = $linhaCadastroDetalhes['tel_ddd_principal'];
		$tbCadastroTelPrincipal = $linhaCadastroDetalhes['tel_principal'];
		$tbCadastroCelDDDPrincipal = $linhaCadastroDetalhes['cel_ddd_principal'];
		$tbCadastroCelPrincipal = $linhaCadastroDetalhes['cel_principal'];
		$tbCadastroFaxDDDPrincipal = $linhaCadastroDetalhes['fax_ddd_principal'];
		$tbCadastroFaxPrincipal = $linhaCadastroDetalhes['fax_principal'];
		$tbCadastroSitePrincipal = $linhaCadastroDetalhes['site_principal'];
		$tbCadastroNFuncionarios = $linhaCadastroDetalhes['n_funcionarios'];
		$tbCadastroOBSInterno = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['obs_interno']);
		
		$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
		$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
		$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];

		$tbCadastroIdTbCadastroStatus = $linhaCadastroDetalhes['id_tb_cadastro_status'];
		$tbCadastroIdTbCadastroStatus_print = DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastroStatus, "tb_cadastro_complemento", "complemento");
		$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
		$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
		$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];
		
		$tbCadastroAtivacao = $linhaCadastroDetalhes['ativacao'];
		$tbCadastroAtivacao_print = "";
		if($tbCadastroAtivacao == "0"){
			$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
		}
		if($tbCadastroAtivacao == "1"){
			$tbCadastroAtivacao_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
		}

		$tbCadastroAtivacaoDestaque = $linhaCadastroDetalhes['ativacao_destaque'];
		
		$tbCadastroAtivacaoMalaDireta = $linhaCadastroDetalhes['ativacao_mala_direta'];
		$tbCadastroAtivacaoMalaDireta_print = "";
		if($tbCadastroAtivacaoMalaDireta == "0"){
			$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao4");
		}
		if($tbCadastroAtivacaoMalaDireta == "1"){
			$tbCadastroAtivacaoMalaDireta_print = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao5");
		}
		
		$tbCadastroUsuario = $linhaCadastroDetalhes['usuario'];
		
		//$tbCadastroSenha = $linhaCadastroDetalhes['senha'];
		if($GLOBALS['configCadastroMetodoSenha'] == 2){
        	if($GLOBALS['configCadastroSenha'] == 1){
            	$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['senha'], 2), 2);
            }
        }
		
		$tbCadastroImagem = $linhaCadastroDetalhes['imagem'];
		$tbCadastroLogo = $linhaCadastroDetalhes['logo'];
		$tbCadastroBanner = $linhaCadastroDetalhes['banner'];
		$tbCadastroMapa = $linhaCadastroDetalhes['mapa'];
		$tbCadastroMapaOnline = $linhaCadastroDetalhes['mapa_online'];
		$tbCadastroPalavrasChave = $linhaCadastroDetalhes['palavras_chave'];
		$tbCadastroApresentacao = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['apresentacao']);
		$tbCadastroServicos = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['servicos']);
		$tbCadastroPromocoes = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['promocoes']);
		$tbCadastroCondicoesComerciais = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['condicoes_comerciais']);
		$tbCadastroFormasPagamento = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['formas_pagamento']);

		$tbCadastroHorarioAtendimento = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['horario_atendimento']);
		$tbCadastroSituacaoAtual = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['situacao_atual']);
		$tbCadastroIC1 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar1']);
		$tbCadastroIC2 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar2']);
		$tbCadastroIC3 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar3']);
		$tbCadastroIC4 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar4']);
		$tbCadastroIC5 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar5']);
		$tbCadastroIC6 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar6']);
		$tbCadastroIC7 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar7']);
		$tbCadastroIC8 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar8']);
		$tbCadastroIC9 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar9']);
		$tbCadastroIC10 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar10']);
		$tbCadastroIC11 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar11']);
		$tbCadastroIC12 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar12']);
		$tbCadastroIC13 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar13']);
		$tbCadastroIC14 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar14']);
		$tbCadastroIC15 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar15']);
		$tbCadastroIC16 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar16']);
		$tbCadastroIC17 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar17']);
		$tbCadastroIC18 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar18']);
		$tbCadastroIC19 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar19']);
		$tbCadastroIC20 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar20']);
		$tbCadastroIC21 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar21']);
		$tbCadastroIC22 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar22']);
		$tbCadastroIC23 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar23']);
		$tbCadastroIC24 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar24']);
		$tbCadastroIC25 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar25']);
		$tbCadastroIC26 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar26']);
		$tbCadastroIC27 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar27']);
		$tbCadastroIC28 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar28']);
		$tbCadastroIC29 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar29']);
		$tbCadastroIC30 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar30']);
		$tbCadastroIC31 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar31']);
		$tbCadastroIC32 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar32']);
		$tbCadastroIC33 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar33']);
		$tbCadastroIC34 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar34']);
		$tbCadastroIC35 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar35']);
		$tbCadastroIC36 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar36']);
		$tbCadastroIC37 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar37']);
		$tbCadastroIC38 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar38']);
		$tbCadastroIC39 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar39']);
		$tbCadastroIC40 = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['informacao_complementar40']);
		$tbCadastroNVisitas = $linhaCadastroDetalhes['n_visitas'];
		$tbCadastroOrigemCadastro = $linhaCadastroDetalhes['origem_cadastro'];
		//$tbCategoriasCategoria = Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']);
		
		//Verificação de erro.
		//echo "tbCadastroId=" . $tbCadastroId . "<br>";
		//echo "id_parent=" . $linhaCategorias['id_parent'] . "<br>";
		//echo "categoria=" . Funcoes::ConteudoMascaraLeitura($linhaCategorias['categoria']) . "<br>";
		
		//echo "id=" . $tbCategoriasId . "<br>";
		//echo "id_parent=" . $tbCategoriasIdParent . "<br>";
		//echo "categoria=" . $tbCategoriasCategoria . "<br>";
		//echo "tbCadastroIC40=" . $tbCadastroIC40 . "<br>";
		//echo "linhaCadastroDetalhes['informacao_complementar40']=" . $linhaCadastroDetalhes['informacao_complementar40'] . "<br>";
		//echo "linhaCadastroDetalhes['data_nascimento']=" . $linhaCadastroDetalhes['data_nascimento'] . "<br>";
		//echo "tbCadastroPfPj=" . $tbCadastroPfPj . "<br>";
		//echo "linhaCadastroDetalhes['pf_pj']=" . $linhaCadastroDetalhes['pf_pj'] . "<br>";
		
		
	}
}


//Limpeza de objetos.
//----------
unset($strSqlCadastroDetalhesSelect);
unset($statementCadastroDetalhesSelect);
unset($resultadoCadastroDetalhes);
unset($linhaCadastroDetalhes);
//----------


//Verificação de erro - debug.
//echo "cookie(CookieValorLer_Login)=" . Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura(CookiesFuncoes::CookieValorLer_Login(), 2), 2) . "<br>";
?>


<?php //Title.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphTitle*/ ?>
	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig"); ?> - <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTituloDetalhes"); ?>
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
	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTituloDetalhes"); ?>
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
    

	<?php //Diagramação 2.?>
    <?php //**************************************************************************************?>
	<?php //Cabeçalho.?>
    <div class="AdmTexto01" style="position: relative; display: block; overflow: hidden;">
    	<div style="position: relative; display: inline-block; margin-right: 20px; vertical-align: top;">
        	<img src="../<?php echo $configDiretorioSistema; ?>/img/logo_cliente.jpg" alt="Logomarca" style="max-width: 300px;" />
        </div>
        
        <?php //Informações.?>
        <div style="position: relative; display: inline-block; margin-right: 20px; vertical-align: top;">
        	<div>
            	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteRazaoSocial'], "IncludeConfig"); ?>
            </div>
        	<div>
            	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteEndereco'], "IncludeConfig"); ?>, <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteNumero'], "IncludeConfig"); ?>
                <?php if($GLOBALS['configClienteComplemento'] <> ""){ ?>
                 - <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteComplemento'], "IncludeConfig"); ?>
            	<?php } ?>
            </div>
        	<div>
            	<?php if($GLOBALS['configClienteBairro'] <> ""){ ?>
					<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteBairro'], "IncludeConfig"); ?> - 
				<?php } ?>
				<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteCidade'], "IncludeConfig"); ?>/<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteEstado'], "IncludeConfig"); ?>
            </div>
        	<div>
                TEL.: <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteTel'], "IncludeConfig"); ?> 
            </div>
        	<div>
                CEP: <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configClienteCEP'], "IncludeConfig"); ?> 
            </div>
        </div>
        
        <?php //Complemento.?>
        <div style="position: relative; display: inline-block; vertical-align: top;">
        	<div>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosTituloDetalhes"); ?>
            </div>
        	<div>
            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosNumero"); ?>: <?php echo $tbOrcamentosId; ?>
            </div>
        	<div>
            	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosData"); ?>: <?php echo $tbOrcamentosDataOrcamento; ?>
            </div>
			<?php if($GLOBALS['habilitarCadastroVinculo1'] == 1){ ?>
        	<div>
                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configCadastroVinculo1Nome'], "IncludeConfig"); ?>: <?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "razao_social"), DbFuncoes::GetCampoGenerico01($tbCadastroIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 1)); ?>
            </div>
            <?php } ?>
        </div>
    </div>


	<?php //Cliente - Informações.?>
    <div class="AdmTbFundoEscuro AdmTexto02" style="position: relative; display: block; overflow: hidden; padding: 10px; margin-top: 20px;">
    	<div>
			<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosCadastroCliente"); ?>: <?php echo $tbCadastroId; ?>
        </div>
        
        <?php if($GLOBALS['habilitarCadastroIc1'] == "1"){ ?>
    	<div>
			<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloCadastroIc1'], "IncludeConfig"); ?>: <?php echo $tbCadastroIC1; ?>
        </div>
        <?php } ?>
        
    	<div>
			<?php echo Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo($tbCadastroNome, 
            $tbCadastroRazaoSocial, 
            $tbCadastroNomeFantasia, 
            1)); ?>
        </div>
        
        <?php if($tbCadastroCNPJ <> ""){ ?>
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCNPJ"); ?>: 
            </strong>
            <?php echo $tbCadastroCNPJ; ?>
        </div>
        <?php } ?>
        
        <?php if($tbCadastroCPF <> ""){ ?>
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCPF"); ?>: 
            </strong>
            <?php echo $tbCadastroCPF; ?>
        </div>
        <?php } ?>
    </div>
    
	<?php //Cliente - Complemento de informações.?>
    <div class="AdmTbFundoEscuro AdmTexto02" style="position: relative; display: block; overflow: hidden; padding: 10px; margin-top: 20px;">
		<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosInformacoesCliente"); ?>
    </div>
    <div class="AdmTexto01" style="position: relative; display: block; padding: 10px;">
        <?php if($tbCadastroEnderecoPrincipal <> ""){ ?>
        <div>
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEnderecoPrincipal"); ?>: 
            </strong>
            <?php echo $tbCadastroEnderecoPrincipal; ?>, <?php echo $tbCadastroEnderecoNumeroPrincipal; ?>
            <?php if($tbCadastroEnderecoComplementoPrincipal <> ""){ ?>
             - <?php echo $tbCadastroEnderecoComplementoPrincipal; ?>
             <?php } ?>
        </div>
        <?php } ?>
        
        <div style="position: relative; display: block; overflow: hidden; clear: both;">
        	<?php if($tbCadastroBairroPrincipal <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroBairroPrincipal"); ?>: 
                </strong>
                <?php echo $tbCadastroBairroPrincipal; ?>
            </div>
            <?php } ?>
            
        	<?php if($tbCadastroEstadoPrincipal <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroEstadoPrincipal"); ?>: 
                </strong>
                <?php echo $tbCadastroEstadoPrincipal; ?>
            </div>
            <?php } ?>

        	<?php if($tbCadastroEstadoPrincipal <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>: 
                </strong>
                <?php echo $tbCadastroEstadoPrincipal; ?>
            </div>
            <?php } ?>

        	<?php if($tbCadastroPaisPrincipal <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroPaisPrincipal"); ?>: 
                </strong>
                <?php echo $tbCadastroPaisPrincipal; ?>
            </div>
            <?php } ?>
            
        	<?php if($tbCadastroCepPrincipal <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroCEPPrincipal"); ?>: 
                </strong>
                <?php echo $tbCadastroCepPrincipal; ?>
            </div>
            <?php } ?>
        </div>
        
        <div style="position: relative; display: block; overflow: hidden; clear: both;">
        	<?php if($tbCadastroIMunicipal <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "habilitarCadastroIEstadualIMunicipal"); ?>: 
                </strong>
                <?php echo $tbCadastroIMunicipal; ?>
            </div>
            <?php } ?>
            
        	<?php if($tbCadastroIEstadual <> ""){ ?>
        	<div style="position: relative; display: inline-block; margin-right: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCadastroInscricaoEstadual"); ?>: 
                </strong>
                <?php echo $tbCadastroIEstadual; ?>
            </div>
            <?php } ?>
        </div>
    </div>
    
	
	<?php //Orçamento - itens. ?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['configOrcamentosItens'] <> 0){ ?>
	<?php
    //Itens selecionados.
    $idsTbOrcamentosItensSelecao1 = DbFuncoes::GetCampoGenerico06("ce_orcamentos_itens_relacao_registros", 
                                                                "id_ce_orcamentos_itens", 
                                                                "id_ce_orcamentos", 
                                                                $idCeOrcamentos, 
                                                                "", 
                                                                "", 
                                                                1, 
                                                                "", 
                                                                "", 
                                                                "", 
                                                                "", 
                                                                "tipo_relacao", 
                                                                "1");
    if($idsTbOrcamentosItensSelecao1 == "")
    {
        $idsTbOrcamentosItensSelecao1 = "0";
    }
            
                                                                                            
    //Verificação de erro - debug.
    //echo "idsTbOrcamentosItensSelecao1=" . $idsTbOrcamentosItensSelecao1 . "<br />";
    ?>
    <div class="AdmTexto01" style="position: relative; display: block; margin-top: 10px;">
		<?php 
        //Query de pesquisa.
        //----------
        $strSqlOrcamentosItensSelect = "";
        $strSqlOrcamentosItensSelect .= "SELECT ";
        //$strSqlOrcamentosItensSelect .= "* ";
        $strSqlOrcamentosItensSelect .= "id, ";
        $strSqlOrcamentosItensSelect .= "id_ce_orcamentos, ";
        $strSqlOrcamentosItensSelect .= "n_classificacao, ";
        $strSqlOrcamentosItensSelect .= "item_titulo, ";
        $strSqlOrcamentosItensSelect .= "item_descricao, ";
        $strSqlOrcamentosItensSelect .= "data1, ";
        $strSqlOrcamentosItensSelect .= "data2, ";
        $strSqlOrcamentosItensSelect .= "data3, ";
        $strSqlOrcamentosItensSelect .= "data4, ";
        $strSqlOrcamentosItensSelect .= "data5, ";
        $strSqlOrcamentosItensSelect .= "url1, ";
        $strSqlOrcamentosItensSelect .= "url2, ";
        $strSqlOrcamentosItensSelect .= "url3, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro1, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro2, ";
        $strSqlOrcamentosItensSelect .= "id_tb_cadastro3, ";
        $strSqlOrcamentosItensSelect .= "valor, ";
        $strSqlOrcamentosItensSelect .= "valor1, ";
        $strSqlOrcamentosItensSelect .= "valor2, ";
        $strSqlOrcamentosItensSelect .= "ativacao, ";
        $strSqlOrcamentosItensSelect .= "ativacao1, ";
        $strSqlOrcamentosItensSelect .= "ativacao2, ";
        $strSqlOrcamentosItensSelect .= "ativacao3, ";
        $strSqlOrcamentosItensSelect .= "ativacao4, ";
        $strSqlOrcamentosItensSelect .= "arquivo1, ";
        $strSqlOrcamentosItensSelect .= "arquivo2, ";
        $strSqlOrcamentosItensSelect .= "arquivo3, ";
        $strSqlOrcamentosItensSelect .= "arquivo4, ";
        $strSqlOrcamentosItensSelect .= "arquivo5, ";
        $strSqlOrcamentosItensSelect .= "arquivo6, ";
        $strSqlOrcamentosItensSelect .= "arquivo7, ";
        $strSqlOrcamentosItensSelect .= "arquivo8, ";
        $strSqlOrcamentosItensSelect .= "arquivo9, ";
        $strSqlOrcamentosItensSelect .= "arquivo10, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar1, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar2, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar3, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar4, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar5, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar6, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar7, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar8, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar9, ";
        $strSqlOrcamentosItensSelect .= "informacao_complementar10 ";
        $strSqlOrcamentosItensSelect .= "FROM ce_orcamentos_itens ";
        $strSqlOrcamentosItensSelect .= "WHERE id <> 0 ";
        $strSqlOrcamentosItensSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
		
        $strSqlOrcamentosItensSelect .= "AND id IN (" . Funcoes::ConteudoMascaraGravacao01($idsTbOrcamentosItensSelecao1) . ") ";

        $strSqlOrcamentosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
        
        $statementOrcamentosItensSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosItensSelect);
        
        if ($statementOrcamentosItensSelect !== false)
        {
            /*
            $statementOrcamentosItensSelect->execute(array(
                "id_ce_orcamentos" => $idCeOrcamentos
            ));
            */
			/*
			if($idCeOrcamentos <> "")
			{
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
			}
			*/
            if($GLOBALS['configOrcamentosItens'] == 1)
			{
				$idCeOrcamentosPadrao = "0";
				$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentosPadrao, PDO::PARAM_STR);
            }
            $statementOrcamentosItensSelect->execute();
            
        }
        
        //$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosItensSelect);
        $resultadoOrcamentosItens = $statementOrcamentosItensSelect->fetchAll();
        ?>
        
        
		<?php
        if (empty($resultadoOrcamentosItens))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="AdmErro">
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['habilitarOrcamentosItensNClassificacao'] == 1){ ?>
                <td width="50" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemNClassificacaoA"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosItensArquivo1'] == 1){ ?>
                    <?php if($GLOBALS['configOrcamentosItensArquivo1'] == 1){ ?>
                    <td width="1" class="AdmTabelaDados01Celula">
                        <div align="center" class="AdmTexto02">
                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloArquivo1'], "IncludeConfig"); ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensTitulo"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosMultiplos'] == 1){ ?>
                <td width="300" class="AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosVinculados"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao"); ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td width="30" class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto02">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemExcluir"); ?>
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoOrcamentosItens as $linhaOrcamentosItens)
                {
              ?>
              <tr class="TbFundoClaro">
                <?php if($GLOBALS['habilitarOrcamentosItensNClassificacao'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php echo $linhaOrcamentosItens['n_classificacao'];?>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['habilitarOrcamentosItensArquivo1'] == 1){ ?>
                    <?php if($GLOBALS['configOrcamentosItensArquivo1'] == 1){ ?>
                    <td class="AdmTabelaDados01Celula">
                        <div align="center" class="AdmTexto01">
                            <?php if(!empty($linhaOrcamentosItens['arquivo1'])){ ?>
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaOrcamentosItens['arquivo1'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configDiretorioArquivos'];?>/g<?php echo $linhaOrcamentosItens['arquivo1'];?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>">
                                        <img src="<?php echo $GLOBALS['configDiretorioArquivos'];?>/t<?php echo $linhaOrcamentosItens['arquivo1'];?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']); ?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </td>
                    <?php } ?>
                <?php } ?>
                
                <td class="AdmTabelaDados01Celula">
                    <div class="AdmTexto01">
                        <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>
                    </div>
                    
                    <div class="AdmTexto01" style="display: none;">
                    <?php if($GLOBALS['habilitarOrcamentosItensIc1'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar1'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc1'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar1']);?> 
                                
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                    [
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar1'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc2'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar2'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc2'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar2']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                    [
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar2'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc3'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar3'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc3'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar3']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar3'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc4'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar4'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc4'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar4']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar4'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc5'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar5'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc5'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar5']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar5'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc6'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar6'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc6'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar6']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar6'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc7'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar7'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc7'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar7']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar7'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc8'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar8'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc8'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar8']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar8'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc9'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar9'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc9'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar9']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar9'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <?php if($GLOBALS['habilitarOrcamentosItensIc10'] == 1){ ?>
                    	<?php if(!empty($linhaOrcamentosItens['informacao_complementar10'])){ ?>
                            <div class="AdmTexto01">
                                <strong>
                                    <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configOrcamentosItensTituloIc10'], "IncludeConfig"); ?>:
                                </strong>
                                <?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['informacao_complementar10']);?> 
								<?php if($GLOBALS['habilitarOrcamentosItensICProdutosVinculosMultiplos'] == 1){ ?>
                                	[
                                    <a href="OrcamentosItensRelacaoRegistrosIndice.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?>&idCeOrcamentos=<?php echo $idCeOrcamentos;?>&tipoCategoria=2&informacaoComplementar1=<?php echo $linhaOrcamentosItens['informacao_complementar10'];?>&masterPageSelect=LayoutSistemaSemMenu.php&detalhe01=<?php echo Funcoes::ConteudoMascaraLeitura($linhaOrcamentosItens['item_titulo']);?>&detalhe02=" target="_blank" class="AdmLinks01">
                                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemVincularProdutos"); ?>
                                    </a>
                                    ]
                                <?php } ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    </div>
                </td>
                
                <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosMultiplos'] == 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="left" class="AdmTexto01">
                    	<?php
						//Query de pesquisa.
						//----------
						$strSqlOrcamentosItensRelacaoRegistrosSelect = "";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "SELECT ";
						//$strSqlOrcamentosItensRelacaoRegistrosSelect .= "* ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "data_atualizacao, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_ce_orcamentos, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_ce_orcamentos_itens, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "id_registro, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_registro, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_categoria, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tipo_relacao, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "tabela, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "quantidade, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor1, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "valor2, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao1, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao2, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao3, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ativacao4, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar1, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar2, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar3, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar4, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "informacao_complementar5, ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "obs ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "FROM ce_orcamentos_itens_relacao_registros ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "WHERE id <> 0 ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "AND id_ce_orcamentos_itens = :id_ce_orcamentos_itens ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "AND id_ce_orcamentos = :id_ce_orcamentos ";
						//$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ORDER BY " . $GLOBALS['configClassificacaoOrcamentosItens'] . " ";
						$strSqlOrcamentosItensRelacaoRegistrosSelect .= "ORDER BY id ";
						
						$statementOrcamentosItensRelacaoRegistrosSelect = $dbSistemaConPDO->prepare($strSqlOrcamentosItensRelacaoRegistrosSelect);
						
						if ($statementOrcamentosItensRelacaoRegistrosSelect !== false)
						{
							/*
							$statementOrcamentosItensSelect->execute(array(
								"id_ce_orcamentos" => $idCeOrcamentos
							));
							*/
							/*
							if($idCeOrcamentos <> "")
							{
								$statementOrcamentosItensSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
							}
							*/
							//if($GLOBALS['configOrcamentosItens'] == 1)
							//{
								$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos_itens', $linhaOrcamentosItens['id'], PDO::PARAM_STR);
							//}
							
							$statementOrcamentosItensRelacaoRegistrosSelect->bindParam(':id_ce_orcamentos', $idCeOrcamentos, PDO::PARAM_STR);
							$statementOrcamentosItensRelacaoRegistrosSelect->execute();
							
						}
						
						//$resultadoOrcamentosItens = $dbSistemaConPDO->query($strSqlOrcamentosItensRelacaoRegistrosSelect);
						$resultadoOrcamentosItensRelacaoRegistros = $statementOrcamentosItensRelacaoRegistrosSelect->fetchAll();

						?>
						<?php
                        if(empty($resultadoOrcamentosItensRelacaoRegistros))
                        {
                            //echo "Nenhum registro encontrado";
                        }else{
                        ?>
                            <table class="AdmTabelaDados01" width="100%">
                                <tr class="AdmTbFundoEscuro">

                                    <td width="100" class="AdmTabelaDados01Celula">
                                        <div align="left" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="50" class="AdmTabelaDados01Celula">
                                        <div align="right" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>
                                        </div>
                                    </td>
                                    
                                    <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                                    <td width="20" class="AdmTabelaDados01Celula">
                                        <div align="center" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensQuantidadeA"); ?>
                                        </div>
                                    </td>
                                    
                                    <td width="20" class="AdmTabelaDados01Celula">
                                        <div align="right" class="AdmTexto02">
                                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensValorSubtotal"); ?>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                
                                <?php
                                //Loop pelos resultados.
                                foreach($resultadoOrcamentosItensRelacaoRegistros as $linhaOrcamentosItensRelacaoRegistros)
                                {
                                    $tbProdutosValor = 0;
                                    $tbProdutosValor = DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "valor");
                                    
                                    //Valor total.
                                    if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1)
                                    {
                                        $orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + ($linhaOrcamentosItensRelacaoRegistros["quantidade"] * $tbProdutosValor);
                                    }else{
                                        $orcamentosItensRelacaoRegistrosValorTotal = $orcamentosItensRelacaoRegistrosValorTotal + $tbProdutosValor;
                                    }
                                    
                                    //Quantidade de itens.
                                    $orcamentosItensRelacaoRegistrosQtdTotal = $orcamentosItensRelacaoRegistrosQtdTotal + $linhaOrcamentosItensRelacaoRegistros["quantidade"];
                                ?>
                                
                                    <div style="position: relative; display: none; margin-bottom: 15px;">
                                        <div>
                                            <strong>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProduto"); ?>: 
                                            </strong>
                                            <?php echo DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "produto"); ?>
                                        </div>
                                        <div>
                                            <strong>
                                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteProdutosValor"); ?>: 
                                            </strong>
                                            <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                            <?php echo Funcoes::MascaraValorLer($tbProdutosValor, $GLOBALS['configSistemaMoeda']);?>
                                        </div>
                                        <div>
                                            <?php echo $linhaOrcamentosItensRelacaoRegistros["informacao_complementar1"]; ?>
                                        </div>
                                    </div>
                                    
                                    <tr class="TbFundoClaro">
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="left" class="AdmTexto01">
                                                <?php echo DbFuncoes::GetCampoGenerico01($linhaOrcamentosItensRelacaoRegistros["id_registro"], "tb_produtos", "produto"); ?>
                                                <div>
                                                    <?php echo $linhaOrcamentosItensRelacaoRegistros["informacao_complementar1"]; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="right" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                                                <?php echo Funcoes::MascaraValorLer($tbProdutosValor, $GLOBALS['configSistemaMoeda']);?>
                                            </div>
                                        </td>
                                        <?php if($GLOBALS['habilitarOrcamentosItensProdutosVinculosQuantidade'] == 1){ ?>
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="center" class="AdmTexto01">
                                                <?php echo $linhaOrcamentosItensRelacaoRegistros["quantidade"]; ?>
                                            </div>
                                        </td>
                                        <td class="AdmTabelaDados01Celula">
                                            <div align="right" class="AdmTexto01">
                                                <?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                                                <?php echo Funcoes::MascaraValorLer(($linhaOrcamentosItensRelacaoRegistros["quantidade"] * $tbProdutosValor), $GLOBALS['configSistemaMoeda']); ?>
                                            </div>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>
                        <?php
						//Limpeza de objetos.
						//----------
						unset($strSqlOrcamentosItensRelacaoRegistrosSelect);
						unset($statementOrcamentosItensRelacaoRegistrosSelect);
						unset($resultadoOrcamentosItensRelacaoRegistros);
						unset($linhaOrcamentosItensRelacaoRegistros);
						//----------
						?>
                    </div>
                </td>
                <?php } ?>
                
                <td class="<?php if($linhaOrcamentosItens['ativacao'] == 1){/*echo "TbFundoClaro";*/}else{echo "TbFundoDesativado";}?> AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <?php if($GLOBALS['configOrcamentosItens'] == 2){ ?>
                        <a href="RegistrosAtivacaoExe.php?idRegistro=<?php echo $linhaOrcamentosItens['id'];?>&statusAtivacao=<?php echo $linhaOrcamentosItens['ativacao'];?>&strTabela=ce_orcamentos_itens&strCampo=ativacao<?php echo $queryPadrao;?><?php echo $queryPadraoRetornoPaginacao;?>" class="AdmLinks01">
                            <?php if($linhaOrcamentosItens['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        </a>
                        <?php } ?>
                        
                        <?php if($GLOBALS['configOrcamentosItens'] == 1){ ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 0){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao0"); ?>
                            <?php } ?>
                            <?php if($linhaOrcamentosItens['ativacao'] == 1){?>
                                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemAtivacao1"); ?>
                            <?php } ?>
                        <?php } ?>
                        
                        <?php //echo $linhaOrcamentosItens['ativacao'];?>
                    </div>
                </td>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <a href="OrcamentosItensEditar.php?idCeOrcamentosItens=<?php echo $linhaOrcamentosItens['id'];?><?php echo $queryPadrao;?>" class="AdmLinks01">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemEditar"); ?>
                        </a>
                    </div>
                </td>
                <?php } ?>
                
                <?php if($GLOBALS['configOrcamentosItens'] <> 1){ ?>
                <td class="AdmTabelaDados01Celula">
                    <div align="center" class="AdmTexto01">
                        <input name="idsRegistrosExcluir[]" type="checkbox" value="<?php echo $linhaOrcamentosItens['id'];?>" class="CampoCheckBox01" />
                    </div>
                </td>
                <?php } ?>
              </tr>
              <?php } ?>
            </table>
        <?php } ?>
        
        <?php
        //Limpeza de objetos.
        //----------
        unset($strSqlOrcamentosItensSelect);
        unset($statementOrcamentosItensSelect);
        unset($resultadoOrcamentosItens);
        unset($linhaOrcamentosItens);
        //----------
        ?>
    </div>
    <?php } ?>
	<?php //**************************************************************************************?>

    
    <?php //Total. ?>
    <div align="right" class="AdmTexto01" style="position: relative; display: block; overflow: hidden; padding: 10px; margin-top: 20px;">
        <div align="left" style="position: relative; display: inline-block; margin-left: 20px;">
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosItensQuantidade"); ?>: 
            </strong>
            <?php echo $orcamentosItensRelacaoRegistrosQtdTotal;?>
        </div>
        
        <?php if($GLOBALS['habilitarOrcamentosFrete'] == 1){ ?>
            <div align="left" style="position: relative; display: inline-block; margin-left: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorOrcamento"); ?>: 
                </strong>
                <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                <?php echo Funcoes::MascaraValorLer($tbOrcamentosValorOrcamento);?>
            </div>
    
            <div align="left" style="position: relative; display: inline-block; margin-left: 20px;">
                <strong>
                    <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorFrete"); ?>: 
                </strong>
                <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
                <?php echo Funcoes::MascaraValorLer($tbOrcamentosValorFrete);?>
            </div>
        <?php } ?>

        <div align="left" style="position: relative; display: inline-block; margin-left: 20px;">
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteOrcamentosValorTotal"); ?>: 
            </strong>
            <?php echo $GLOBALS['configSistemaMoeda'] . " ";?>
            <?php //echo Funcoes::MascaraValorLer($tbOrcamentosValorTotal);?>
            <?php echo Funcoes::MascaraValorLer($orcamentosItensRelacaoRegistrosValorTotal, $GLOBALS['configSistemaMoeda']);?>
        </div>
    </div>
    
    <?php //Obs. ?>
    <div align="right" class="AdmTexto01" style="position: relative; display: block; overflow: hidden; padding: 10px; margin-top: 20px;">
		<?php if($tbPedidosOBS <> ""){ ?>
        <div align="left" class="AdmTexto01">
            <strong>
                <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosObs"); ?>: 
            </strong>
            <?php echo $tbPedidosOBS; ?>
        </div>
        <?php } ?>
    </div>
    <?php //**************************************************************************************?>
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