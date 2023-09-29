<?php
//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Resgate de variáveis.
$idCePedidos = $_GET["idCePedidos"];
$idTbCadastroCliente = DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente");

$mensagemErro = $_GET["mensagemErro"];
$mensagemSucesso = $_GET["mensagemSucesso"];


//Query de pesquisa.
//----------
$strSqlPedidosDetalhesSelect = "";
$strSqlPedidosDetalhesSelect .= "SELECT ";
//$strSqlPedidosDetalhesSelect .= "* ";
$strSqlPedidosDetalhesSelect .= "id, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cliente, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_enderecos, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_cartoes, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro_usuario, ";
$strSqlPedidosDetalhesSelect .= "tipo_pagamento, ";
$strSqlPedidosDetalhesSelect .= "data_pedido, ";
$strSqlPedidosDetalhesSelect .= "data_pagamento, ";
$strSqlPedidosDetalhesSelect .= "data_entrega, ";
$strSqlPedidosDetalhesSelect .= "data_validade, ";
$strSqlPedidosDetalhesSelect .= "valor_pedido, ";
$strSqlPedidosDetalhesSelect .= "valor_frete, ";
$strSqlPedidosDetalhesSelect .= "periodo_contratacao, ";
$strSqlPedidosDetalhesSelect .= "tipo_entrega, ";
$strSqlPedidosDetalhesSelect .= "valor_desconto, ";
$strSqlPedidosDetalhesSelect .= "valor_acrescimo, ";
$strSqlPedidosDetalhesSelect .= "valor_total, ";
$strSqlPedidosDetalhesSelect .= "peso_total, ";
$strSqlPedidosDetalhesSelect .= "endereco_entrega, ";
$strSqlPedidosDetalhesSelect .= "endereco_numero_entrega, ";
$strSqlPedidosDetalhesSelect .= "endereco_complemento_entrega, ";
$strSqlPedidosDetalhesSelect .= "bairro_entrega, ";
$strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
$strSqlPedidosDetalhesSelect .= "cidade_entrega, ";
$strSqlPedidosDetalhesSelect .= "pais_entrega, ";
$strSqlPedidosDetalhesSelect .= "cep_entrega, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro1, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro2, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro3, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro4, ";
$strSqlPedidosDetalhesSelect .= "id_tb_cadastro5, ";
$strSqlPedidosDetalhesSelect .= "obs, ";
$strSqlPedidosDetalhesSelect .= "ativacao, ";
$strSqlPedidosDetalhesSelect .= "informacao_complementar1, ";
$strSqlPedidosDetalhesSelect .= "informacao_complementar2, ";
$strSqlPedidosDetalhesSelect .= "informacao_complementar3, ";
$strSqlPedidosDetalhesSelect .= "informacao_complementar4, ";
$strSqlPedidosDetalhesSelect .= "informacao_complementar5, ";
$strSqlPedidosDetalhesSelect .= "id_ce_complemento_status, ";
$strSqlPedidosDetalhesSelect .= "transacao_externa_status, ";
$strSqlPedidosDetalhesSelect .= "transacao_externa_autenticacao, ";
$strSqlPedidosDetalhesSelect .= "transacao_externa_log, ";
$strSqlPedidosDetalhesSelect .= "transacao_externa_data_pagamento_liberado ";
$strSqlPedidosDetalhesSelect .= "FROM ce_pedidos ";
$strSqlPedidosDetalhesSelect .= "WHERE id <> 0 ";
//$strSqlPedidosDetalhesSelect .= "AND id_tb_categorias = :id_tb_categorias ";
$strSqlPedidosDetalhesSelect .= "AND id = :id ";
//$strSqlPedidosDetalhesSelect .= "ORDER BY " . $GLOBALS['configClassificacaoCadastro'] . " ";
//echo "strSqlPedidosDetalhesSelect=" . $strSqlPedidosDetalhesSelect . "<br>";
//----------


//Parâmetros.
//----------
$statementPedidosDetalhesSelect = $dbSistemaConPDO->prepare($strSqlPedidosDetalhesSelect);

if ($statementPedidosDetalhesSelect !== false)
{
	$statementPedidosDetalhesSelect->execute(array(
		"id" => $idCePedidos
	));
}
//----------


//$resultadoPedidosDetalhes = $dbSistemaConPDO->query($strSqlPedidosDetalhesSelect);
$resultadoPedidosDetalhes = $statementPedidosDetalhesSelect->fetchAll();

if (empty($resultadoPedidosDetalhes))
{
	//echo "Nenhum registro encontrado";
}else{
	foreach($resultadoPedidosDetalhes as $linhaPedidosDetalhes)
	{
		//Definição das variáveis de detalhes.
		$tbPedidosId = $linhaPedidosDetalhes['id'];
		$tbPedidosIdTbCadastroCliente = $linhaPedidosDetalhes['id_tb_cadastro_cliente'];
		$tbPedidosIdTbCadastroEnderecos = $linhaPedidosDetalhes['id_tb_cadastro_enderecos'];
		$tbPedidosIdTbCadastroCartoes = $linhaPedidosDetalhes['id_tb_cadastro_cartoes'];
		$tbPedidosIdTbCadastroUsuario = $linhaPedidosDetalhes['id_tb_cadastro_usuario'];
		$tbPedidosTipoPagamento = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_pagamento']);
		
		//$tbPedidosDataPedido = $linhaPedidosDetalhes['data_pedido'];
		if($linhaPedidosDetalhes['data_pedido'] == NULL)
		{
			$tbPedidosDataPedido = "";
		}else{
			$tbPedidosDataPedido = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pedido'], $GLOBALS['configSiteFormatoData'], "1");
		}
		
		//$tbPedidosDataPagamento = $linhaPedidosDetalhes['data_pagamento'];
		if($linhaPedidosDetalhes['data_pagamento'] == NULL)
		{
			$tbPedidosDataPagamento = "";
		}else{
			$tbPedidosDataPagamento = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_pagamento'], $GLOBALS['configSiteFormatoData'], "1");
		}

		//$tbPedidosDataEntrega = $linhaPedidosDetalhes['data_entrega'];
		if($linhaPedidosDetalhes['data_entrega'] == NULL)
		{
			$tbPedidosDataEntrega = "";
		}else{
			$tbPedidosDataEntrega = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_entrega'], $GLOBALS['configSiteFormatoData'], "1");
		}

		//$tbPedidosDataValidade = $linhaPedidosDetalhes['data_validade'];
		if($linhaPedidosDetalhes['data_validade'] == NULL)
		{
			$tbPedidosDataValidade = "";
		}else{
			$tbPedidosDataValidade = Funcoes::DataLeitura01($linhaPedidosDetalhes['data_validade'], $GLOBALS['configSiteFormatoData'], "1");
		}

		//$tbPedidosValorPedido = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_pedido'], $GLOBALS['configSistemaMoeda']);
		$tbPedidosValorPedido = $linhaPedidosDetalhes['valor_pedido'];

		//$tbPedidosValorFrete = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_frete'], $GLOBALS['configSistemaMoeda']);
		$tbPedidosValorFrete = $linhaPedidosDetalhes['valor_frete'];

		$tbPedidosPeriodoContratacao = $linhaPedidosDetalhes['periodo_contratacao'];
		$tbPedidosTipoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['tipo_entrega']);

		$tbPedidosValorDesconto = $linhaPedidosDetalhes['valor_desconto'];
		$tbPedidosValorAcrescimo = $linhaPedidosDetalhes['valor_acrescimo'];

		$tbPedidosValorTotal = Funcoes::MascaraValorLer($linhaPedidosDetalhes['valor_total'], $GLOBALS['configSistemaMoeda']);
		//$tbPedidosValorTotal = $linhaPedidosDetalhes['valor_total'];

		$tbPedidosPesoTotal = $linhaPedidosDetalhes['peso_total'];
		$tbPedidosEnderecoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_entrega']);
		$tbPedidosEnderecoNumeroEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_numero_entrega']);
		$tbPedidosEnderecoComplementoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['endereco_complemento_entrega']);
		$tbPedidosBairroEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['bairro_entrega']);
		$tbPedidosCidadeEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['cidade_entrega']);
		$tbPedidosEstadoEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['estado_entrega']);
		$tbPedidosPaisEntrega = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['pais_entrega']);
		$tbPedidosCepEntrega = Funcoes::FormatarCEPLer($linhaPedidosDetalhes['cep_entrega']);
		
		$tbPedidosIdTbCadastro1 = $linhaPedidosDetalhes['id_tb_cadastro1'];
		$tbPedidosIdTbCadastro1NomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro1, "tb_cadastro", "nome"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro1, "tb_cadastro", "razao_social"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro1, "tb_cadastro", "nome_fantasia"), 
																											1));
		$tbPedidosIdTbCadastro2 = $linhaPedidosDetalhes['id_tb_cadastro2'];
		$tbPedidosIdTbCadastro2NomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro2, "tb_cadastro", "nome"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro2, "tb_cadastro", "razao_social"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro2, "tb_cadastro", "nome_fantasia"), 
																											1));
		$tbPedidosIdTbCadastro3 = $linhaPedidosDetalhes['id_tb_cadastro3'];
		$tbPedidosIdTbCadastro3NomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro3, "tb_cadastro", "nome"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro3, "tb_cadastro", "razao_social"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro3, "tb_cadastro", "nome_fantasia"), 
																											1));
		$tbPedidosIdTbCadastro4 = $linhaPedidosDetalhes['id_tb_cadastro4'];
		$tbPedidosIdTbCadastro4NomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro4, "tb_cadastro", "nome"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro4, "tb_cadastro", "razao_social"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro4, "tb_cadastro", "nome_fantasia"), 
																											1));
		$tbPedidosIdTbCadastro5 = $linhaPedidosDetalhes['id_tb_cadastro5'];
		$tbPedidosIdTbCadastro5NomePreferencial = Funcoes::ConteudoMascaraLeitura(Funcoes::GetCadastroTitulo(DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro5, "tb_cadastro", "nome"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro5, "tb_cadastro", "razao_social"), 
																											DbFuncoes::GetCampoGenerico01($tbPedidosIdTbCadastro5, "tb_cadastro", "nome_fantasia"), 
																											1));

		$tbPedidosOBS = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['obs']);
		$tbPedidosAtivacao = $linhaPedidosDetalhes['ativacao'];
		$tbPedidosIC1 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar1']);
		$tbPedidosIC2 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar2']);
		$tbPedidosIC3 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar3']);
		$tbPedidosIC4 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar4']);
		$tbPedidosIC5 = Funcoes::ConteudoMascaraLeitura($linhaPedidosDetalhes['informacao_complementar5']);
		$tbPedidosIdCeComplementoStatus = $linhaPedidosDetalhes['id_ce_complemento_status'];
		$tbPedidosTransacaoExternaStatus = $linhaPedidosDetalhes['transacao_externa_status'];
		$tbPedidosTransacaoExternaAutenticacao = $linhaPedidosDetalhes['transacao_externa_autenticacao'];
		$tbPedidosTransacaoExternaLog = $linhaPedidosDetalhes['transacao_externa_log'];
		$tbPedidosTransacaoExternaDataPagamentoLiberado = $linhaPedidosDetalhes['transacao_externa_data_pagamento_liberado'];
		
		
		//Detalhes do cadastro.
		//----------
		$resultadoCadastroDetalhes = DbFuncoes::TabelaGenericaFill01_FetchAll("tb_cadastro", 
									array("id;".$tbPedidosIdTbCadastroCliente.";i"), 
									"", 
									"");
									
		if (empty($resultadoCadastroDetalhes))
		{
			//echo "Nenhum registro encontrado";
		}else{
			foreach($resultadoCadastroDetalhes as $linhaCadastroDetalhes)
			{
				//Definição das variáveis de detalhes.
				$tbCadastroId = $linhaCadastroDetalhes['id'];
				$tbCadastroIdTbCategorias = $linhaCadastroDetalhes['id_tb_categorias'];
				$tbCadastroDataCadastro = $linhaCadastroDetalhes['data_cadastro'];
				//$tbCadastroNClassificacao = $linhaCadastroDetalhes['n_classificacao'];
				$tbCadastroPfPj = $linhaCadastroDetalhes['pf_pj'];
				$tbCadastroNome = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome']);
				$tbCadastroSexo = $linhaCadastroDetalhes['sexo'];
				$tbCadastroAltura = $linhaCadastroDetalhes['altura'];
				$tbCadastroPeso = $linhaCadastroDetalhes['peso'];
				$tbCadastroRazaoSocial = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['razao_social']);
				$tbCadastroNomeFantasia = Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['nome_fantasia']);
				
				//$tbCadastroDataNascimento = $linhaCadastroDetalhes['data_nascimento'];
				//if($GLOBALS['configSiteFormatoData'] == "1"){
					//$tbCadastroDataNascimento = date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
				//}
				//if($GLOBALS['configSiteFormatoData'] == "2"){
					//$tbCadastroDataNascimento = date("m",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("d",strtotime($linhaCadastroDetalhes['data_nascimento'])) . "/" . date("y",strtotime($linhaCadastroDetalhes['data_nascimento']));
				//}
				if($linhaCadastroDetalhes['data_nascimento'] == NULL)
				{
					$tbCadastroDataNascimento = "";
				}else{
					$tbCadastroDataNascimento = Funcoes::DataLeitura01($linhaCadastroDetalhes['data_nascimento'], $GLOBALS['configSistemaFormatoData'], "1");
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
				$tbCadastroCepPrincipal = Funcoes::SomenteNum($linhaCadastroDetalhes['cep_principal']);
				$tbCadastroCepPrincipal_print = Funcoes::FormatarCEPLer($linhaCadastroDetalhes['cep_principal']);
		
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
				//$tbCadastroIdTbCadastro1 = $linhaCadastroDetalhes['id_tb_cadastro1'];
				//$tbCadastroIdTbCadastro2 = $linhaCadastroDetalhes['id_tb_cadastro2'];
				//$tbCadastroIdTbCadastro3 = $linhaCadastroDetalhes['id_tb_cadastro3'];
				$tbCadastroAtivacao = $linhaCadastroDetalhes['ativacao'];
				$tbCadastroAtivacaoDestaque = $linhaCadastroDetalhes['ativacao_destaque'];
				$tbCadastroAtivacaoMalaDireta = $linhaCadastroDetalhes['ativacao_mala_direta'];
				$tbCadastroUsuario = $linhaCadastroDetalhes['usuario'];
				
				//$tbCadastroSenha = $linhaCadastroDetalhes['senha'];
				if($GLOBALS['configCadastroMetodoSenha'] == 2){
					if($GLOBALS['configCadastroSenha'] == 1){
						$tbCadastroSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($linhaCadastroDetalhes['senha'], 2), 2);
					}
				}
				
				$tbCadastroImagem = $linhaCadastroDetalhes['imagem'];
				$tbCadastroArquivo1 = $linhaCadastroDetalhes['arquivo1'];
				$tbCadastroArquivo2 = $linhaCadastroDetalhes['arquivo2'];
				$tbCadastroArquivo3 = $linhaCadastroDetalhes['arquivo3'];
				$tbCadastroArquivo4 = $linhaCadastroDetalhes['arquivo4'];
				$tbCadastroArquivo5 = $linhaCadastroDetalhes['arquivo5'];
				
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
		unset($resultadoCadastroDetalhes);
		unset($linhaCadastroDetalhes);
		//----------
		
		
		//Verificação de erro.
		//echo "tbPedidosId=" . $tbPedidosId . "<br>";
		//echo "tbPedidosValorPedido=" . $tbPedidosValorPedido . "<br>";
		//echo "tbPedidosAtivacao=" . $tbPedidosAtivacao . "<br>";
	}
}


//Query de pesquisa.
//----------
$strSqlPedidosItensSelect = "";
$strSqlPedidosItensSelect .= "SELECT ";
//$strSqlPedidosItensSelect .= "* ";
$strSqlPedidosItensSelect .= "id, ";
$strSqlPedidosItensSelect .= "id_ce_pedidos, ";
$strSqlPedidosItensSelect .= "id_tb_cadastro_cliente, ";
$strSqlPedidosItensSelect .= "id_tb_cadastro_usuario, ";
$strSqlPedidosItensSelect .= "id_item, ";
$strSqlPedidosItensSelect .= "cod_item, ";
$strSqlPedidosItensSelect .= "descricao, ";
$strSqlPedidosItensSelect .= "tabela, ";
$strSqlPedidosItensSelect .= "quantidade, ";
$strSqlPedidosItensSelect .= "valor_unitario, ";
$strSqlPedidosItensSelect .= "id_tb_itens_valores, ";
$strSqlPedidosItensSelect .= "id_tb_itens_valores_titulo, ";
$strSqlPedidosItensSelect .= "id_tb_itens_data, ";
$strSqlPedidosItensSelect .= "valor_total, ";
$strSqlPedidosItensSelect .= "ids_opcionais, ";
$strSqlPedidosItensSelect .= "ids_opcionais_descricao, ";
$strSqlPedidosItensSelect .= "obs, ";

$strSqlPedidosItensSelect .= "informacao_complementar1, ";
$strSqlPedidosItensSelect .= "informacao_complementar2, ";
$strSqlPedidosItensSelect .= "informacao_complementar3, ";
$strSqlPedidosItensSelect .= "informacao_complementar4, ";
$strSqlPedidosItensSelect .= "informacao_complementar5, ";

$strSqlPedidosItensSelect .= "ativacao, ";
$strSqlPedidosItensSelect .= "data_pedido, ";
$strSqlPedidosItensSelect .= "data_pagamento, ";
$strSqlPedidosItensSelect .= "data_entrega, ";
$strSqlPedidosItensSelect .= "data_validade, ";
$strSqlPedidosItensSelect .= "id_tb_produtos_complemento_status ";

$strSqlPedidosItensSelect .= "FROM ce_itens ";
$strSqlPedidosItensSelect .= "WHERE id <> 0 ";
if($idCePedidos <> "")
{
	$strSqlPedidosItensSelect .= "AND id_ce_pedidos = :id_ce_pedidos ";
}

//$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoPedidosItens'] . " ";
//if($GLOBALS['habilitarPedidosItensClassificacaoPersonalizada'] == 1 and DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) <> "")
//{
	//$strSqlPedidosItensSelect .= "ORDER BY " . DbFuncoes::GetCampoGenerico04("classificacao", "criterio_classificacao", "id_registro", $idParentPedidosItens) . " ";
	
//}else{
	$strSqlPedidosItensSelect .= "ORDER BY " . $GLOBALS['configClassificacaoItens'] . " ";
//}
//----------


//Parâmetros
//----------
$statementPedidosItensSelect = $dbSistemaConPDO->prepare($strSqlPedidosItensSelect);

if ($statementPedidosItensSelect !== false)
{
	if($idCePedidos <> "")
	{
		$statementPedidosItensSelect->bindParam(':id_ce_pedidos', $idCePedidos, PDO::PARAM_STR);
	}
	$statementPedidosItensSelect->execute();
	
	/*
	$statementPedidosItensSelect->execute(array(
		"id_parent" => $idParentPedidosItens
	));
	*/
}

//$resultadoPedidosItens = $dbSistemaConPDO->query($strSqlPedidosItensSelect);
$resultadoPedidosItens = $statementPedidosItensSelect->fetchAll();
//----------


//Montagem das meta tags.
//----------
$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaTitulo");
$metaTitulo = Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig") . " - " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaTitulo");

//Tratamento de títulos.
if($GLOBALS['configFormaCobranca'] == "pedido")
{
	$tituloLinkAtual = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaPedidoTitulo");
	$metaTitulo = Funcoes::ConteudoMascaraLeitura($GLOBALS['configTituloSite'], "IncludeConfig") . " - " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaPedidoTitulo");
}
//----------


//Verificação de erro - debug.
//echo "idCePedidos=" . $idCePedidos . "<br>";
//echo "idTbCadastroCliente=" . $idTbCadastroCliente . "<br>";
//echo "cookie=" . $_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']] . "<br>";
//echo "cookie(decrypt)=" . $tbUsuariosSenha = Crypto::DecryptValue(Funcoes::ConteudoMascaraLeitura($_COOKIE[$GLOBALS['configNomeCookie'] . "_" . $GLOBALS['configSessionNomeUsuarioMaster']], 2), 2) . "<br>";
/*
echo "PedidosEnviar=" . Email::PedidosEnviar($idCePedidos, 
											"contato@jorgemauricio.com", 
											"Joge Mauricio", 
											1) . "<br>";
*/											
//echo "CadastroConteudo=" . Email::CadastroConteudo(DbFuncoes::GetCampoGenerico01($idCePedidos, "ce_pedidos", "id_tb_cadastro_cliente"), 1, 0, 1) . "<br>";
//echo "PedidosConteudo=" . Email::PedidosConteudo($idCePedidos, 1, 0) . "<br>";
//echo "PedidosItensConteudo=" . Email::PedidosItensConteudo($idCePedidos, 1, 0) . "<br>";
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
    <meta name="description" content="" /><?php //Abaixo de 160 caracteres.?>
    <meta name="keywords" content="" /><?php //Abaixo de 100 caracteres.?>
    <meta name="title" content="<?php echo $metaTitulo;?>" /><?php //Abaixo de 60 caracteres.?>
<?php 
$pageSite->cphHead = ob_get_clean(); 
//ob_end_flush();
?>
<?php //**************************************************************************************?>


<?php //Título atual.?>
<?php //**************************************************************************************?>
<?php ob_start(); /* cphConteudoCabecalho*/ ?>
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
    
    
	<?php //Pedidos - detalhes. ?>
	<?php //**************************************************************************************?>
    <div style="position: relative; display: block;">
        <table width="100%" border="0" cellspacing="1" cellpadding="4">
            <tr>
                <td colspan="2" class="AdmTbFundoEscuro">
                    <div align="center" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosInformacoes"); ?>
                    </div>
                </td>
            </tr>
            <tr>
	            <td class="AdmTbFundoEscuro" style="width: 150px;">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosData"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
                    	<?php echo $tbPedidosDataPedido; ?>
		            </div>
	            </td>
            </tr>
            <tr>
	            <td class="AdmTbFundoEscuro">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosNumero"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
		                <?php echo $tbPedidosId; ?>
		            </div>
	            </td>
            </tr>
            
            <?php if($GLOBALS['habilitarPedidosValorDesconto'] == 1){ ?>
            <tr>
	            <td class="AdmTbFundoEscuro">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorTotal"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                        <?php echo Funcoes::MascaraValorLer($tbPedidosValorDesconto); ?>
		            </div>
	            </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarPedidosValorAcrescimo'] == 1){ ?>
            <tr>
	            <td class="AdmTbFundoEscuro">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorAcrescimo"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
                    	<?php echo $GLOBALS['configSistemaMoeda']; ?> 
                        <?php echo Funcoes::MascaraValorLer($tbPedidosValorAcrescimo); ?>
		            </div>
	            </td>
            </tr>
            <?php } ?>
            
            <?php if($GLOBALS['habilitarAdministrarPedidosFrete'] == 1){ ?>
            <tr>
	            <td class="AdmTbFundoEscuro">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorPedido"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                        <?php echo Funcoes::MascaraValorLer($tbPedidosValorPedido); ?>
		            </div>
	            </td>
            </tr>
            
            <tr>
	            <td class="AdmTbFundoEscuro">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorFrete"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                        <?php echo Funcoes::MascaraValorLer($tbPedidosValorFrete); ?>
		            </div>
	            </td>
            </tr>
            <?php } ?>

            <tr>
	            <td class="AdmTbFundoEscuro">
                    <div align="left"class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosValorTotal"); ?>:
                    </div>
                </td>
	            <td class="AdmTbFundoClaro">
		            <div align="left" class="CarrinhoConteudo01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?> 
                        <?php echo $tbPedidosValorTotal; ?>
		            </div>
	            </td>
            </tr>
        </table>
    </div>
	<?php //**************************************************************************************?>
    
    
	<?php //Pedidos - listagem de itens. ?>
	<?php //**************************************************************************************?>
    <div style="position: relative; display: block;">
        <?php
        if (empty($resultadoPedidosItens))
        {
            //echo "Nenhum registro encontrado";
        ?>
            <div align="center" class="TextoErro">
                <?php //echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteStatus1"); ?>
            </div>
        <?php
        }else{
        ?>
        	<br />
            <table border="0" width="100%" cellspacing="1" cellpadding="4" class="AdmTbFundoEscuro">
                <tr>
                    <td>
                        <div align="center" class="CarrinhoTextoHeader">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosListagemItens"); ?>
                        </div>
                    </td>
                </tr>
            </table>
            
            <table width="100%" class="AdmTabelaDados01">
              <tr class="AdmTbFundoEscuro">
                <?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td width="1" class="AdmTbFundoEscuro">
                    <div align="center" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteItemImagem"); ?>
                    </div>
                </td>
                <?php } ?>
                
                <td width="100" class="AdmTbFundoEscuro">
                    <div align="center" class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensCodigo"); ?>
                    </div>
                </td>
                
                <td class="AdmTbFundoEscuro">
                    <div class="CarrinhoTextoHeader">
                        <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensDescricao"); ?>
                    </div>
                </td>
                
                <td width="40" class="AdmTbFundoEscuro">
                    <div align="center" class="CarrinhoTextoHeader">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensQuantidade"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="AdmTbFundoEscuro">
                    <div align="center" class="CarrinhoTextoHeader">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorUnitario"); ?>
                        </strong>
                    </div>
                </td>
                
                <td width="100" class="AdmTbFundoEscuro">
                    <div align="center" class="CarrinhoTextoHeader">
                    	<strong>
							<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "sitePedidosItensValorTotal"); ?>
                        </strong>
                    </div>
                </td>
                
              </tr>
              <?php
                //Loop pelos resultados.
                foreach($resultadoPedidosItens as $linhaPedidosItens)
                {
              ?>
              <tr class="AdmTbFundoClaro">
              	<?php if($GLOBALS['ativacaoProdutosImagens'] == 1){ ?>
                <td>
                    <div align="center" class="CarrinhoConteudo01">
                    	<?php //Imagem - Produtos. ?>
                    	<?php //---------- ?>
							<?php
							$ceItensImagem = "";
							$ceItensImagem = DbFuncoes::GetCampoGenerico01($linhaPedidosItens['id_item'], "tb_produtos", "imagem");
                            ?>
                            <?php //if(!empty($ceItensImagem)){ ?>
                            <?php if($ceItensImagem <> ""){ ?>
                                <?php //Sem pop-up. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 0){ ?>
                                    <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                <?php } ?>
                            
                                <?php //SlimBox 2 - JQuery. ?>
                                <?php if($GLOBALS['configImagemPopUp'] == 1){ ?>
                                    <a href="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/g<?php echo $ceItensImagem;?>" rel="lightbox" title="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>">
                                        <img src="<?php echo $GLOBALS['configCaminhoSiteImagens'];?>/t<?php echo $ceItensImagem;?>" alt="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']); ?>" />
                                    </a>
                                <?php } ?>
                            <?php } ?>
                    	<?php //---------- ?>
                    </div>
                </td>
                <?php } ?>

                <td>
                    <div align="center" class="CarrinhoConteudo01">
                        <?php echo $linhaPedidosItens['cod_item'];?>
                    </div>
                </td>
                
                <td>
                    <div class="CarrinhoConteudo01">
                    	<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>
                    </div>
                </td>
                
                <td>
                    <div align="center" class="CarrinhoConteudo01">
                        <?php echo $linhaPedidosItens['quantidade'];?>
                    </div>
                </td>
                
                <td>
                    <div align="center" class="CarrinhoConteudo01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], $GLOBALS['configSistemaMoeda']);?>
                    </div>
                </td>
                
                <td>
                    <div align="center" class="CarrinhoConteudo01">
						<?php echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configSistemaMoeda'], "IncludeConfig"); ?>
                        <?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_total'], $GLOBALS['configSistemaMoeda']);?>
						
						<?php 
                        //Contabilizado.
                        //----------------------
						$itensValorTotal = $itensValorTotal + $linhaPedidosItens['valor_total'];
                        //----------------------
						?>
                    </div>
                </td>
              </tr>
              <?php } ?>
            </table>
		<?php } ?>
    </div>
	<?php //**************************************************************************************?>
    
    
	<?php //Transação eletrônica. ?>
    <?php if($tbPedidosValorPedido <> "0"){ ?>
		<?php //PagSeguro. ?>
        <?php //**************************************************************************************?>
        <?php if(strpos($GLOBALS['configFormaCobranca'], "pagseguro") !== false){ ?>
            <form method="post" action="https://pagseguro.uol.com.br/v2/checkout/payment.html" target="_blank" class="FormularioDados01">
                <div align="center" class="CarrinhoConteudo01">
                	<?php //Campos obrigatórios. ?>
                    <input type="hidden" name="receiverEmail" value="<?php echo $GLOBALS['configCobrancaEmail']; ?>" />
                	<input type="hidden" name="encoding" value="UTF-8" />
                	<input type="hidden" name="currency" value="BRL" />
                    
                    <?php if($tbPedidosValorFrete <> "0"){ ?>
                    	<input type="hidden" name="itemShippingCost1" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorFrete, "pagseguro"); ?>" />
                    <?php } ?>
                    
                    <?php //Itens do pagamento (ao menos um item é obrigatório). ?>
					<?php
                    if(empty($resultadoPedidosItens))
                    {
                        //echo "Nenhum registro encontrado";
                    }else{
						$countItens = 1;
						
						//Loop pelos resultados.
						foreach($resultadoPedidosItens as $linhaPedidosItens)
						{
						?>
                            <input type="hidden" name="itemId<?php echo $countItens; ?>" value="<?php echo $linhaPedidosItens['cod_item'];?>" />
                            <input type="hidden" name="itemDescription<?php echo $countItens; ?>" value="<?php echo Funcoes::LimitadorCatecteres(Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']), 99);?>" />
                            <input type="hidden" name="itemAmount<?php echo $countItens; ?>" value="<?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], "pagseguro");?>" />
                            <input type="hidden" name="itemQuantity<?php echo $countItens; ?>" value="<?php echo $linhaPedidosItens['quantidade'];?>" />
					<?php 
							$countItens = $countItens + 1;
						} 
					} 
					?>
                    
                    <?php //Código de referência do pagamento no seu sistema (opcional). ?>
					<input type="hidden" name="reference" value="<?php echo $tbPedidosId; ?>" />
                    
                    <?php //Informações de frete (opcionais). ?>
					<input type="hidden" name="shippingType" value="<?php echo Carrinho::GetCodigoEntrega($tbPedidosTipoPagamento, 2); ?>" />
                    <input type="hidden" name="shippingAddressPostalCode" value="<?php echo $tbCadastroCepPrincipal; ?>" />
                    <input type="hidden" name="shippingAddressStreet" value="<?php echo $tbCadastroEnderecoPrincipal; ?>" />
                    <input type="hidden" name="shippingAddressNumber" value="<?php echo $tbCadastroEnderecoNumeroPrincipal; ?>" />
                    <input type="hidden" name="shippingAddressComplement" value="<?php echo $tbCadastroEnderecoComplementoPrincipal; ?>" />
                    <input type="hidden" name="shippingAddressDistrict" value="<?php echo $tbCadastroBairroPrincipal; ?>" />
                    <input type="hidden" name="shippingAddressCity" value="<?php echo $tbCadastroCidadePrincipal; ?>" />
                    <input type="hidden" name="shippingAddressState" value="<?php echo $tbCadastroEstadoPrincipal; ?>" />
                    <input type="hidden" name="shippingAddressCountry" value="BRA" />

                    <?php //Dados do comprador (opcionais). ?>
                    <input type="hidden" name="senderName" value="<?php echo $tbCadastroNome; ?>" />
                    
                    <?php if($tbCadastroTelPrincipal <> ""){ ?>
                    	<input type="hidden" name="senderAreaCode" value="<?php echo $tbCadastroTelDDDPrincipal; ?>" />
                    	<input type="hidden" name="senderPhone" value="<?php echo $tbCadastroTelPrincipal; ?>" />
                    <?php }else{ ?>
                    	<input type="hidden" name="senderAreaCode" value="<?php echo $tbCadastroCelDDDPrincipal; ?>" />
                    	<input type="hidden" name="senderPhone" value="<?php echo $tbCadastroCelPrincipal; ?>" />
                    <?php } ?>
                    
                    <input type="hidden" name="senderEmail" value="<?php echo $tbCadastroEmailPrincipal; ?>" />


                	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaPagSeguroInstrucao01"); ?>
                    <br />
                    <?php //Submit do form (obrigatório). ?>
                    <input type="image" name="submit" src="../imagens_globais/pagSeguro_120x53.gif" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoPagamentoPagSeguro"); ?>" />
                    <br />
                    <br />

                    <?php if($GLOBALS['configFormaRecebimentoPagSeguro'] == "1"){ ?>
                        <img src="../imagens_globais/pagSeguro_bannerBoletoTransferencia_550x70.gif" title="Este site aceita pagamentos com Bradesco, Itaú, Banco do Brasil, Unibanco, Banrisul, saldo em conta PagSeguro e boleto." alt="Banner PagSeguro" />
                    <?php } ?>

                    <?php if($GLOBALS['configFormaRecebimentoPagSeguro'] == "2"){ ?>
                        <img src="../imagens_globais/pagSeguro_bannerTodosPagamentos_418x74.gif" title="Este site aceita pagamentos com Visa, MasterCard, Diners, American Express, Hipercard, Aura, Bradesco, Ita&uacute;, Unibanco, Banco do Brasil, Banco Real, saldo em conta PagSeguro e boleto." alt="Banner PagSeguro" />
                    <?php } ?>
                </div>
            </form>
		<?php } ?>
		<?php //**************************************************************************************?>
        
        
		<?php //PayPal. ?>
        <?php //**************************************************************************************?>
        <?php //ref: https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/formbasics/#specifying-button-type--cmd?>
        <?php //ref: https://developer.paypal.com/docs/classic/paypal-payments-standard/integration-guide/cart_upload/#implement-the-cart-upload-command?>
        <?php if(strpos($GLOBALS['configFormaCobranca'], "paypal") !== false){ ?>
            <form method="post" action="https://www.paypal.com/cgi-bin/webscr" target="_blank" class="FormularioDados01">
                <div align="center" class="CarrinhoConteudo01">
                	<?php //Campos obrigatórios. ?>
                    <input type="hidden" name="cmd" value="_cart">
                    <input type="hidden" name="upload" value="1">
                    <input type="hidden" name="charset" value="utf-8">
                    <input type="hidden" name="business" value="<?php echo $GLOBALS['configCobrancaEmail']; ?>" />
                    
                    <?php //Retorno de pagamento. ?>
                    <!--input type="hidden" name="return" value="URLspecificToThisTransaction"-->
                    
                	<?php //Moeda. ?>
                    <?php if($GLOBALS['configSistemaMoeda'] == "R$"){ ?>
                    	<input type="hidden" name="currency_code" value="BRL" />
                    <?php } ?>
                    <?php if($GLOBALS['configSistemaMoeda'] == "$"){ ?>
                    	<input type="hidden" name="currency_code" value="USD" />
                    <?php } ?>
                    <?php if($GLOBALS['configSistemaMoeda'] == "€"){ ?>
                    	<input type="hidden" name="currency_code" value="EUR" />
                    <?php } ?>
                    
                    <?php //Itens do pagamento (ao menos um item é obrigatório). ?>
					<?php
                    if(empty($resultadoPedidosItens))
                    {
                        //echo "Nenhum registro encontrado";
                    }else{
						$countItens = 1;
						
						//Loop pelos resultados.
						foreach($resultadoPedidosItens as $linhaPedidosItens)
						{
						?>
                        	<input type="hidden" name="item_number_<?php echo $countItens; ?>" value="<?php echo $linhaPedidosItens['cod_item'];?>" />
                        	<input type="hidden" name="item_name_<?php echo $countItens; ?>" value="<?php echo Funcoes::ConteudoMascaraLeitura($linhaPedidosItens['descricao']);?>" />
                            <input type="hidden" name="amount_<?php echo $countItens; ?>" value="<?php echo Funcoes::MascaraValorLer($linhaPedidosItens['valor_unitario'], "paypal");?>" />
                            
							<?php if($tbPedidosValorFrete <> "0"){ ?>
                            	<?php if($countItens == 1){ ?>
                                    <input type="hidden" name="shipping_<?php echo $countItens; ?>" value="<?php echo Funcoes::MascaraValorLer($tbPedidosValorFrete, "paypal"); ?>" />
								<?php }else{ ?>
                                    <input type="hidden" name="shipping_<?php echo $countItens; ?>" value="0.00" />
								<?php } ?>
                            <?php } ?>
					<?php 
							$countItens = $countItens + 1;
						} 
					} 
					?>
                    
                    <input type="hidden" name="first_name" value="<?php echo $tbCadastroNome; ?>" />
                    <!--input type="hidden" name="last_name" value="Doe"-->
                    <input type="hidden" name="address1" value="<?php echo $tbCadastroEnderecoPrincipal; ?>, <?php echo $tbCadastroEnderecoNumeroPrincipal; ?>" />
                    <input type="hidden" name="address2" value="<?php echo $tbCadastroEnderecoComplementoPrincipal; ?>" />
                    <input type="hidden" name="city" value="<?php echo $tbCadastroCidadePrincipal; ?>" />
                    <input type="hidden" name="state" value="<?php echo $tbCadastroEstadoPrincipal; ?>" />
                    <input type="hidden" name="country" value="BR" /><?php //ref: https://www.paypal.com/us/smarthelp/article/how-do-i-pre-populate-my-customer's-paypal-sign-up-form-ts1372 | https://developer.paypal.com/webapps/developer/docs/classic/api/country_codes/# ?>
                    <input type="hidden" name="zip" value="<?php echo $tbCadastroCepPrincipal; ?>">
                    <!--input type="hidden" name="night_phone_a" value="610"-->
                    <!--input type="hidden" name="night_phone_b" value="555"-->
                    <!--input type="hidden" name="night_phone_c" value="1234"-->
                    <input type="hidden" name="email" value="<?php echo $tbCadastroEmailPrincipal; ?>" />
                    
                    
					<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaPayPalInstrucao01"); ?>
                    <br />
                    <?php //Submit do form (obrigatório). ?>
                    <input type="image" name="submit" src="../imagens_globais/payPal_144x47.gif" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoPagamentoPayPal"); ?>" />
                    <br />
                    <br />
                </div>
            </form>
		<?php } ?>
		<?php //**************************************************************************************?>
        
        
		<?php //Cobrança off-line - depósito. ?>
        <?php //**************************************************************************************?>
		<?php if($GLOBALS['habilitarCarrinhoCobrancaDeposito'] == 1){ ?>
        <div class="CarrinhoConteudo01" align="center" style="position: relative; display: block; margin: 20px 0px 0px 0px;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4">
                <tr>
                    <td colspan="2" class="AdmTbFundoEscuro">
                        <div align="center" class="CarrinhoTextoHeader">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaDepositoTitulo"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
	                <td colspan="2" class="AdmTbFundoClaro">
		                <div align="left" class="CarrinhoConteudo01">
							<?php //Conteúdo.?>
                            <?php //----------------------?>
                            <?php 
                            //Definição de variáveis do include.
                            $includeConteudo_idParentConteudo = $GLOBALS['configCarrinhoCobrancaDepositoId'];
                            $includeConteudo_idTbConteudo = "";
                            $includeConteudo_tipoConteudo = "";
                            
                            $includeConteudo_configTipoDiagramacao = "1";
                            $includeConteudo_configConteudoNRegistros = "";
                            $includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
                            ?>
                            
                            <?php include "IncludeConteudo.php";?>
                            <?php //----------------------?>
		                </div>

		                <div align="center" class="CarrinhoConteudo01">
                            <a href="SiteCarrinhoPedidosCobrancaConcluido.php?idCePedidos=<?php echo $idCePedidos;?>&tipoPagamento=deposito">
                                <img src="img/btoCarrinhoSelecionar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSelecionar"); ?>" />
                            </a>
		                </div>
	                </td>
                </tr>
            </table>
        </div>
		<?php } ?>
		<?php //**************************************************************************************?>
        
        
		<?php //Cobrança off-line - boleto manual. ?>
        <?php //**************************************************************************************?>
		<?php if($GLOBALS['habilitarCarrinhoCobrancaBoletoManual'] == 1){ ?>
        <div class="CarrinhoConteudo01" align="center" style="position: relative; display: block; margin: 20px 0px 0px 0px;">
            <table width="100%" border="0" cellspacing="1" cellpadding="4">
                <tr>
                    <td colspan="2" class="AdmTbFundoEscuro">
                        <div align="center" class="CarrinhoTextoHeader">
                            <?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaBoletoManualTitulo"); ?>
                        </div>
                    </td>
                </tr>
                <tr>
	                <td colspan="2" class="AdmTbFundoClaro">
		                <div align="left" class="CarrinhoConteudo01">
							<?php //Conteúdo.?>
                            <?php //----------------------?>
                            <?php 
                            //Definição de variáveis do include.
                            $includeConteudo_idParentConteudo = $GLOBALS['configCarrinhoCobrancaDepositoId'];
                            $includeConteudo_idTbConteudo = "";
                            $includeConteudo_tipoConteudo = "";
                            
                            $includeConteudo_configTipoDiagramacao = "1";
                            $includeConteudo_configConteudoNRegistros = "";
                            $includeConteudo_configClassificacaoConteudo = $GLOBALS['configClassificacaoConteudo'];
                            ?>
                            
                            <?php include "IncludeConteudo.php";?>
                            <?php //----------------------?>
		                </div>

		                <div align="center" class="CarrinhoConteudo01">
                            <a href="SiteCarrinhoPedidosCobrancaConcluido.php?idCePedidos=<?php echo $idCePedidos;?>&tipoPagamento=boletoManual">
                                <img src="img/btoCarrinhoSelecionar.png" alt="<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteBotaoSelecionar"); ?>" />
                            </a>
		                </div>
	                </td>
                </tr>
            </table>
        </div>
		<?php } ?>
		<?php //**************************************************************************************?>
    <?php } ?>


	<?php //Pedidos - instruções. ?>
	<?php //**************************************************************************************?>
    <?php if($GLOBALS['configFormaCobranca'] == "pedido"){ ?>
    <div class="CarrinhoConteudo01" align="center" style="position: relative; display: block; margin: 20px 0px 20px 0px;">
    	<?php echo XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSite'], "siteCobrancaPedidoInstrucao01"); ?>
    </div>
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
unset($strSqlPedidosItensSelect);
unset($statementPedidosItensSelect);
unset($resultadoPedidosItens);
unset($linhaPedidosItens);
//----------


//Limpeza de objetos.
//----------
unset($strSqlPedidosDetalhesSelect);
unset($statementPedidosDetalhesSelect);
unset($resultadoPedidosDetalhes);
unset($linhaPedidosDetalhes);
//----------


//Inclusão do template do layout.
include_once $pageSite->LayoutSite;


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
$dbSistemaConPDO = null;
?>