<?php
//Recurso para permitir o redirecionamento (evitar duplicidade de header).
ob_start();


//Importação dos arquivos de configuração.
require_once "../sistema/IncludeConfig.php"; //Deve vir antes do db.
require_once "../sistema/IncludeConexao.php";
require_once "../sistema/IncludeFuncoes.php";
//require_once "IncludeLayout.php";
require_once "IncludeLayoutSite.php";


//Verificação de login de cadastro.
LoginAutenticacao::CadastroLoginVerificacao();


//Resgate de variáveis.
$id = $_POST["idTbVeiculos"];
$idTbCategorias = $_POST["id_tb_categorias"];

$idTbCadastroUsuario = $_POST["id_tb_cadastro_usuario"];
if($idTbCadastroUsuario == "")
{
	$idTbCadastroUsuario = 0;
}

$arrIdsVeiculosTipo = $_POST["idsVeiculosTipo"];
$arrIdsVeiculosFiltroGenerico01 = $_POST["idsVeiculosFiltroGenerico01"];
$arrIdsVeiculosFiltroGenerico02 = $_POST["idsVeiculosFiltroGenerico02"];
$arrIdsVeiculosFiltroGenerico03 = $_POST["idsVeiculosFiltroGenerico03"];
$arrIdsVeiculosFiltroGenerico04 = $_POST["idsVeiculosFiltroGenerico04"];
$arrIdsVeiculosFiltroGenerico05 = $_POST["idsVeiculosFiltroGenerico05"];
$arrIdsVeiculosFiltroGenerico06 = $_POST["idsVeiculosFiltroGenerico06"];
$arrIdsVeiculosFiltroGenerico07 = $_POST["idsVeiculosFiltroGenerico07"];
$arrIdsVeiculosFiltroGenerico08 = $_POST["idsVeiculosFiltroGenerico08"];
$arrIdsVeiculosFiltroGenerico09 = $_POST["idsVeiculosFiltroGenerico09"];
$arrIdsVeiculosFiltroGenerico10 = $_POST["idsVeiculosFiltroGenerico10"];
$arrIdsVeiculosFiltroGenerico11 = $_POST["idsVeiculosFiltroGenerico11"];
$arrIdsVeiculosFiltroGenerico12 = $_POST["idsVeiculosFiltroGenerico12"];
$arrIdsVeiculosFiltroGenerico13 = $_POST["idsVeiculosFiltroGenerico13"];
$arrIdsVeiculosFiltroGenerico14 = $_POST["idsVeiculosFiltroGenerico14"];
$arrIdsVeiculosFiltroGenerico15 = $_POST["idsVeiculosFiltroGenerico15"];
$arrIdsVeiculosFiltroGenerico16 = $_POST["idsVeiculosFiltroGenerico16"];
$arrIdsVeiculosFiltroGenerico17 = $_POST["idsVeiculosFiltroGenerico17"];
$arrIdsVeiculosFiltroGenerico18 = $_POST["idsVeiculosFiltroGenerico18"];
$arrIdsVeiculosFiltroGenerico19 = $_POST["idsVeiculosFiltroGenerico19"];
$arrIdsVeiculosFiltroGenerico20 = $_POST["idsVeiculosFiltroGenerico20"];

$modalidade = $_POST["modalidade"];
if($modalidade == "")
{
	$modalidade = 0;
}

//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
$dataPublicacao = Funcoes::DataGravacaoSql($_POST["data_publicacao"], $GLOBALS['configSistemaFormatoData']);
if($dataPublicacao == "")
{
	//$data_publicacao = NULL;	
	//$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d");
	$dataPublicacao = date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
	 
}

$data1 = Funcoes::DataGravacaoSql($_POST["data1"], $GLOBALS['configSistemaFormatoData']);
if($data1 == "")
{
	$data1 = NULL;	
}
$data2 = Funcoes::DataGravacaoSql($_POST["data2"], $GLOBALS['configSistemaFormatoData']);
if($data2 == "")
{
	$data2 = NULL;	
}
$data3 = Funcoes::DataGravacaoSql($_POST["data3"], $GLOBALS['configSistemaFormatoData']);
if($data3 == "")
{
	$data3 = NULL;	
}
$data4 = Funcoes::DataGravacaoSql($_POST["data4"], $GLOBALS['configSistemaFormatoData']);
if($data4 == "")
{
	$data4 = NULL;	
}
$data5 = Funcoes::DataGravacaoSql($_POST["data5"], $GLOBALS['configSistemaFormatoData']);
if($data5 == "")
{
	$data5 = NULL;	
}
$data6 = Funcoes::DataGravacaoSql($_POST["data6"], $GLOBALS['configSistemaFormatoData']);
if($data6 == "")
{
	$data6 = NULL;	
}
$data7 = Funcoes::DataGravacaoSql($_POST["data7"], $GLOBALS['configSistemaFormatoData']);
if($data7 == "")
{
	$data7 = NULL;	
}
$data8 = Funcoes::DataGravacaoSql($_POST["data8"], $GLOBALS['configSistemaFormatoData']);
if($data8 == "")
{
	$data8 = NULL;	
}
$data9 = Funcoes::DataGravacaoSql($_POST["data9"], $GLOBALS['configSistemaFormatoData']);
if($data9 == "")
{
	$data9 = NULL;	
}
$data10 = Funcoes::DataGravacaoSql($_POST["data10"], $GLOBALS['configSistemaFormatoData']);
if($data10 == "")
{
	$data10 = NULL;	
}

$codigo = Funcoes::ConteudoMascaraGravacao01($_POST["codigo"]);

$nClassificacao = $_POST["n_classificacao"];
if($nClassificacao == "")
{
	$nClassificacao = 0;
}

$veiculo = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo"]);
$descricao = Funcoes::ConteudoMascaraGravacao01($_POST["descricao"]);

$portas = $_POST["portas"];
$kilometragem = Funcoes::MascaraValorGravar($_POST["kilometragem"]);
$placa = Funcoes::RemoverCaracteresEspeciais(Funcoes::ConteudoMascaraGravacao01($_POST["placa"]));
$anoFabricacao = $_POST["ano_fabricacao"];
$anoModelo = $_POST["ano_modelo"];

$idTbCadastro1 = $_POST["id_tb_cadastro1"];
if($idTbCadastro1 == "")
{
	$idTbCadastro1 = 0;
}
$idTbCadastro2 = $_POST["id_tb_cadastro2"];
if($idTbCadastro2 == "")
{
	$idTbCadastro2 = 0;
}
$idTbCadastro3 = $_POST["id_tb_cadastro3"];
if($idTbCadastro3 == "")
{
	$idTbCadastro3 = 0;
}
$idTbCadastro4 = $_POST["id_tb_cadastro4"];
if($idTbCadastro4 == "")
{
	$idTbCadastro4 = 0;
}
$idTbCadastro5 = $_POST["id_tb_cadastro5"];
if($idTbCadastro5 == "")
{
	$idTbCadastro5 = 0;
}

$informacaoComplementar1 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar1"]);
$informacaoComplementar2 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar2"]);
$informacaoComplementar3 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar3"]);
$informacaoComplementar4 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar4"]);
$informacaoComplementar5 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar5"]);
$informacaoComplementar6 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar6"]);
$informacaoComplementar7 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar7"]);
$informacaoComplementar8 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar8"]);
$informacaoComplementar9 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar9"]);
$informacaoComplementar10 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar10"]);
$informacaoComplementar11 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar11"]);
$informacaoComplementar12 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar12"]);
$informacaoComplementar13 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar13"]);
$informacaoComplementar14 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar14"]);
$informacaoComplementar15 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar15"]);
$informacaoComplementar16 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar16"]);
$informacaoComplementar17 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar17"]);
$informacaoComplementar18 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar18"]);
$informacaoComplementar19 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar19"]);
$informacaoComplementar20 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar20"]);
$informacaoComplementar21 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar21"]);
$informacaoComplementar22 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar22"]);
$informacaoComplementar23 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar23"]);
$informacaoComplementar24 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar24"]);
$informacaoComplementar25 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar25"]);
$informacaoComplementar26 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar26"]);
$informacaoComplementar27 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar27"]);
$informacaoComplementar28 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar28"]);
$informacaoComplementar29 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar29"]);
$informacaoComplementar30 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar30"]);
$informacaoComplementar31 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar31"]);
$informacaoComplementar32 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar32"]);
$informacaoComplementar33 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar33"]);
$informacaoComplementar34 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar34"]);
$informacaoComplementar35 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar35"]);
$informacaoComplementar36 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar36"]);
$informacaoComplementar37 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar37"]);
$informacaoComplementar38 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar38"]);
$informacaoComplementar39 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar39"]);
$informacaoComplementar40 = Funcoes::ConteudoMascaraGravacao01($_POST["informacao_complementar40"]);

$idDBCepTblBairros = $_POST["id_db_cep_tblBairros"];
$idDBCepTblCidades = $_POST["id_db_cep_tblCidades"];
$idDBCepTblLogradouros = $_POST["id_db_cep_tblLogradouros"];
$idDBCepTblUF = $_POST["id_db_cep_tblUF"];

$veiculoEndereco = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_endereco"]);
$veiculoEnderecoNumero = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_endereco_numero"]);
$veiculoEnderecoComplemento = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_endereco_complemento"]);
$veiculoBairro = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_bairro"]);
$veiculoCidade = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_cidade"]);
$veiculoEstado = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_estado"]);
$veiculoPais = Funcoes::ConteudoMascaraGravacao01($_POST["veiculo_pais"]);
$veiculoCep = Funcoes::SomenteNum($_POST["veiculo_cep"]);

$contato = Funcoes::ConteudoMascaraGravacao01($_POST["contato"]);
$email = $_POST["email"];
$linkExterno = Funcoes::ConteudoMascaraGravacao01($_POST["link_externo"]);

$url1 = Funcoes::ConteudoMascaraGravacao01($_POST["url1"]);
$url2 = Funcoes::ConteudoMascaraGravacao01($_POST["url2"]);
$url3 = Funcoes::ConteudoMascaraGravacao01($_POST["url3"]);
$url4 = Funcoes::ConteudoMascaraGravacao01($_POST["url4"]);
$url5 = Funcoes::ConteudoMascaraGravacao01($_POST["url5"]);

$palavrasChave = Funcoes::ConteudoMascaraGravacao01($_POST["palavras_chave"]);

$valor = Funcoes::MascaraValorGravar($_POST["valor"]);
if($valor == "")
{
	$valor = 0;
}

$valor1 = Funcoes::MascaraValorGravar($_POST["valor1"]);
if($valor1 == "")
{
	$valor1 = 0;
}

$valor2 = Funcoes::MascaraValorGravar($_POST["valor2"]);
if($valor2 == "")
{
	$valor2 = 0;
}

$ativacao = $_POST["ativacao"];
$ativacao1 = $_POST["ativacao1"];
$ativacao2 = $_POST["ativacao2"];
$ativacao3 = $_POST["ativacao3"];
$ativacao4 = $_POST["ativacao4"];
$ativacaoPromocao = $_POST["ativacao_promocao"];
$ativacaoHome = $_POST["ativacao_home"];
$ativacaoHomeCategoria = $_POST["ativacao_home_categoria"];
$ativacaoInfoCadastro = $_POST["ativacao_info_cadastro"];
$acessoRestrito = $_POST["acesso_restrito"];
if($acessoRestrito == "")
{
	$acessoRestrito = 0;
}

$idTbVeiculosStatus = $_POST["id_tb_veiculos_status"];

$anotacoesInternas = Funcoes::ConteudoMascaraGravacao01($_POST["anotacoes_internas"]);
$nVisitas = 0;

$paginaRetorno = $_POST["paginaRetorno"];
$mensagemErro = "";
$mensagemSucesso = "";


//Update de registro no BD.
//----------
$strSqlVeiculosUpdate = "";
$strSqlVeiculosUpdate .= "UPDATE tb_veiculos ";
$strSqlVeiculosUpdate .= "SET ";
//$strSqlVeiculosUpdate .= "id = :id, ";
//$strSqlVeiculosUpdate .= "id = :id, ";
$strSqlVeiculosUpdate .= "id_tb_categorias = :id_tb_categorias, ";
$strSqlVeiculosUpdate .= "id_tb_cadastro_usuario = :id_tb_cadastro_usuario, ";
$strSqlVeiculosUpdate .= "modalidade = :modalidade, ";
$strSqlVeiculosUpdate .= "data_publicacao = :data_publicacao, ";

$strSqlVeiculosUpdate .= "data1 = :data1, ";
$strSqlVeiculosUpdate .= "data2 = :data2, ";
$strSqlVeiculosUpdate .= "data3 = :data3, ";
$strSqlVeiculosUpdate .= "data4 = :data4, ";
$strSqlVeiculosUpdate .= "data5 = :data5, ";
$strSqlVeiculosUpdate .= "data6 = :data6, ";
$strSqlVeiculosUpdate .= "data7 = :data7, ";
$strSqlVeiculosUpdate .= "data8 = :data8, ";
$strSqlVeiculosUpdate .= "data9 = :data9, ";
$strSqlVeiculosUpdate .= "data10 = :data10, ";

$strSqlVeiculosUpdate .= "codigo = :codigo, ";
$strSqlVeiculosUpdate .= "n_classificacao = :n_classificacao, ";
$strSqlVeiculosUpdate .= "veiculo = :veiculo, ";
$strSqlVeiculosUpdate .= "descricao = :descricao, ";

$strSqlVeiculosUpdate .= "portas = :portas, ";
$strSqlVeiculosUpdate .= "kilometragem = :kilometragem, ";
$strSqlVeiculosUpdate .= "placa = :placa, ";
$strSqlVeiculosUpdate .= "ano_fabricacao = :ano_fabricacao, ";
$strSqlVeiculosUpdate .= "ano_modelo = :ano_modelo, ";

$strSqlVeiculosUpdate .= "id_tb_cadastro1 = :id_tb_cadastro1, ";
$strSqlVeiculosUpdate .= "id_tb_cadastro2 = :id_tb_cadastro2, ";
$strSqlVeiculosUpdate .= "id_tb_cadastro3 = :id_tb_cadastro3, ";
$strSqlVeiculosUpdate .= "id_tb_cadastro4 = :id_tb_cadastro4, ";
$strSqlVeiculosUpdate .= "id_tb_cadastro5 = :id_tb_cadastro5, ";

$strSqlVeiculosUpdate .= "informacao_complementar1 = :informacao_complementar1, ";
$strSqlVeiculosUpdate .= "informacao_complementar2 = :informacao_complementar2, ";
$strSqlVeiculosUpdate .= "informacao_complementar3 = :informacao_complementar3, ";
$strSqlVeiculosUpdate .= "informacao_complementar4 = :informacao_complementar4, ";
$strSqlVeiculosUpdate .= "informacao_complementar5 = :informacao_complementar5, ";
$strSqlVeiculosUpdate .= "informacao_complementar6 = :informacao_complementar6, ";
$strSqlVeiculosUpdate .= "informacao_complementar7 = :informacao_complementar7, ";
$strSqlVeiculosUpdate .= "informacao_complementar8 = :informacao_complementar8, ";
$strSqlVeiculosUpdate .= "informacao_complementar9 = :informacao_complementar9, ";
$strSqlVeiculosUpdate .= "informacao_complementar10 = :informacao_complementar10, ";
$strSqlVeiculosUpdate .= "informacao_complementar11 = :informacao_complementar11, ";
$strSqlVeiculosUpdate .= "informacao_complementar12 = :informacao_complementar12, ";
$strSqlVeiculosUpdate .= "informacao_complementar13 = :informacao_complementar13, ";
$strSqlVeiculosUpdate .= "informacao_complementar14 = :informacao_complementar14, ";
$strSqlVeiculosUpdate .= "informacao_complementar15 = :informacao_complementar15, ";
$strSqlVeiculosUpdate .= "informacao_complementar16 = :informacao_complementar16, ";
$strSqlVeiculosUpdate .= "informacao_complementar17 = :informacao_complementar17, ";
$strSqlVeiculosUpdate .= "informacao_complementar18 = :informacao_complementar18, ";
$strSqlVeiculosUpdate .= "informacao_complementar19 = :informacao_complementar19, ";
$strSqlVeiculosUpdate .= "informacao_complementar20 = :informacao_complementar20, ";
$strSqlVeiculosUpdate .= "informacao_complementar21 = :informacao_complementar21, ";
$strSqlVeiculosUpdate .= "informacao_complementar22 = :informacao_complementar22, ";
$strSqlVeiculosUpdate .= "informacao_complementar23 = :informacao_complementar23, ";
$strSqlVeiculosUpdate .= "informacao_complementar24 = :informacao_complementar24, ";
$strSqlVeiculosUpdate .= "informacao_complementar25 = :informacao_complementar25, ";
$strSqlVeiculosUpdate .= "informacao_complementar26 = :informacao_complementar26, ";
$strSqlVeiculosUpdate .= "informacao_complementar27 = :informacao_complementar27, ";
$strSqlVeiculosUpdate .= "informacao_complementar28 = :informacao_complementar28, ";
$strSqlVeiculosUpdate .= "informacao_complementar29 = :informacao_complementar29, ";
$strSqlVeiculosUpdate .= "informacao_complementar30 = :informacao_complementar30, ";
$strSqlVeiculosUpdate .= "informacao_complementar31 = :informacao_complementar31, ";
$strSqlVeiculosUpdate .= "informacao_complementar32 = :informacao_complementar32, ";
$strSqlVeiculosUpdate .= "informacao_complementar33 = :informacao_complementar33, ";
$strSqlVeiculosUpdate .= "informacao_complementar34 = :informacao_complementar34, ";
$strSqlVeiculosUpdate .= "informacao_complementar35 = :informacao_complementar35, ";
$strSqlVeiculosUpdate .= "informacao_complementar36 = :informacao_complementar36, ";
$strSqlVeiculosUpdate .= "informacao_complementar37 = :informacao_complementar37, ";
$strSqlVeiculosUpdate .= "informacao_complementar38 = :informacao_complementar38, ";
$strSqlVeiculosUpdate .= "informacao_complementar39 = :informacao_complementar39, ";
$strSqlVeiculosUpdate .= "informacao_complementar40 = :informacao_complementar30, ";

$strSqlVeiculosUpdate .= "id_db_cep_tblBairros = :id_db_cep_tblBairros, ";
$strSqlVeiculosUpdate .= "id_db_cep_tblCidades = :id_db_cep_tblCidades, ";
$strSqlVeiculosUpdate .= "id_db_cep_tblLogradouros = :id_db_cep_tblLogradouros, ";
$strSqlVeiculosUpdate .= "id_db_cep_tblUF = :id_db_cep_tblUF, ";

$strSqlVeiculosUpdate .= "veiculo_endereco = :veiculo_endereco, ";
$strSqlVeiculosUpdate .= "veiculo_endereco_numero = :veiculo_endereco_numero, ";
$strSqlVeiculosUpdate .= "veiculo_endereco_complemento = :veiculo_endereco_complemento, ";
$strSqlVeiculosUpdate .= "veiculo_bairro = :veiculo_bairro, ";
$strSqlVeiculosUpdate .= "veiculo_cidade = :veiculo_cidade, ";
$strSqlVeiculosUpdate .= "veiculo_estado = :veiculo_estado, ";
$strSqlVeiculosUpdate .= "veiculo_pais = :veiculo_pais, ";
$strSqlVeiculosUpdate .= "veiculo_cep = :veiculo_cep, ";

$strSqlVeiculosUpdate .= "contato = :contato, ";
$strSqlVeiculosUpdate .= "email = :email, ";

$strSqlVeiculosUpdate .= "link_externo = :link_externo, ";
$strSqlVeiculosUpdate .= "url1 = :url1, ";
$strSqlVeiculosUpdate .= "url2 = :url2, ";
$strSqlVeiculosUpdate .= "url3 = :url3, ";
$strSqlVeiculosUpdate .= "url4 = :url4, ";
$strSqlVeiculosUpdate .= "url5 = :url5, ";

//$strSqlVeiculosUpdate .= "url_amigavel = :url_amigavel, ";
$strSqlVeiculosUpdate .= "palavras_chave = :palavras_chave, ";

$strSqlVeiculosUpdate .= "valor = :valor, ";
$strSqlVeiculosUpdate .= "valor1 = :valor1, ";
$strSqlVeiculosUpdate .= "valor2 = :valor2, ";

$strSqlVeiculosUpdate .= "ativacao = :ativacao, ";
$strSqlVeiculosUpdate .= "ativacao1 = :ativacao1, ";
$strSqlVeiculosUpdate .= "ativacao2 = :ativacao2, ";
$strSqlVeiculosUpdate .= "ativacao3 = :ativacao3, ";
$strSqlVeiculosUpdate .= "ativacao4 = :ativacao4, ";
$strSqlVeiculosUpdate .= "ativacao_promocao = :ativacao_promocao, ";
$strSqlVeiculosUpdate .= "ativacao_home = :ativacao_home, ";
$strSqlVeiculosUpdate .= "ativacao_home_categoria = :ativacao_home_categoria, ";
$strSqlVeiculosUpdate .= "ativacao_info_cadastro = :ativacao_info_cadastro, ";
$strSqlVeiculosUpdate .= "acesso_restrito = :acesso_restrito, ";
$strSqlVeiculosUpdate .= "id_tb_veiculos_status = :id_tb_veiculos_status, ";
//$strSqlVeiculosUpdate .= "imagem = :imagem, ";
$strSqlVeiculosUpdate .= "anotacoes_internas = :anotacoes_internas, ";
$strSqlVeiculosUpdate .= "n_visitas = :n_visitas ";

$strSqlVeiculosUpdate .= "WHERE id = :id ";
//echo "strSqlCategoriasUpdate = " . $strSqlVeiculosUpdate . "<br />";
//----------


//Parametros e execução.
//----------
$statementVeiculosUpdate = $dbSistemaConPDO->prepare($strSqlVeiculosUpdate);

/*
"n_visitas" => $n_visitas
*/
if ($statementVeiculosUpdate !== false)
{
	$statementVeiculosUpdate->execute(array(
		"id" => $id,
		"id_tb_categorias" => $idTbCategorias,
		"id_tb_cadastro_usuario" => $idTbCadastroUsuario,
		"modalidade" => $modalidade,
		"data_publicacao" => $dataPublicacao,
		"data1" => $data1,
		"data2" => $data2,
		"data3" => $data3,
		"data4" => $data4,
		"data5" => $data5,
		"data6" => $data6,
		"data7" => $data7,
		"data8" => $data8,
		"data9" => $data9,
		"data10" => $data10,
		"codigo" => $codigo,
		"n_classificacao" => $nClassificacao,
		"veiculo" => $veiculo,
		"descricao" => $descricao,
		"portas" => $portas,
		"kilometragem" => $kilometragem,
		"placa" => $placa,
		"ano_fabricacao" => $anoFabricacao,
		"ano_modelo" => $anoModelo,
		"id_tb_cadastro1" => $idTbCadastro1,
		"id_tb_cadastro2" => $idTbCadastro2,
		"id_tb_cadastro3" => $idTbCadastro3,
		"id_tb_cadastro4" => $idTbCadastro4,
		"id_tb_cadastro5" => $idTbCadastro5,
		"informacao_complementar1" => $informacaoComplementar1,
		"informacao_complementar2" => $informacaoComplementar2,
		"informacao_complementar3" => $informacaoComplementar3,
		"informacao_complementar4" => $informacaoComplementar4,
		"informacao_complementar5" => $informacaoComplementar5,
		"informacao_complementar6" => $informacaoComplementar6,
		"informacao_complementar7" => $informacaoComplementar7,
		"informacao_complementar8" => $informacaoComplementar8,
		"informacao_complementar9" => $informacaoComplementar9,
		"informacao_complementar10" => $informacaoComplementar10,
		"informacao_complementar11" => $informacaoComplementar11,
		"informacao_complementar12" => $informacaoComplementar12,
		"informacao_complementar13" => $informacaoComplementar13,
		"informacao_complementar14" => $informacaoComplementar14,
		"informacao_complementar15" => $informacaoComplementar15,
		"informacao_complementar16" => $informacaoComplementar16,
		"informacao_complementar17" => $informacaoComplementar17,
		"informacao_complementar18" => $informacaoComplementar18,
		"informacao_complementar19" => $informacaoComplementar19,
		"informacao_complementar20" => $informacaoComplementar20,
		"informacao_complementar21" => $informacaoComplementar21,
		"informacao_complementar22" => $informacaoComplementar22,
		"informacao_complementar23" => $informacaoComplementar23,
		"informacao_complementar24" => $informacaoComplementar24,
		"informacao_complementar25" => $informacaoComplementar25,
		"informacao_complementar26" => $informacaoComplementar26,
		"informacao_complementar27" => $informacaoComplementar27,
		"informacao_complementar28" => $informacaoComplementar28,
		"informacao_complementar29" => $informacaoComplementar29,
		"informacao_complementar30" => $informacaoComplementar30,
		"informacao_complementar31" => $informacaoComplementar31,
		"informacao_complementar32" => $informacaoComplementar32,
		"informacao_complementar33" => $informacaoComplementar33,
		"informacao_complementar34" => $informacaoComplementar34,
		"informacao_complementar35" => $informacaoComplementar35,
		"informacao_complementar36" => $informacaoComplementar36,
		"informacao_complementar37" => $informacaoComplementar37,
		"informacao_complementar38" => $informacaoComplementar38,
		"informacao_complementar39" => $informacaoComplementar39,
		"informacao_complementar40" => $informacaoComplementar30,
		"id_db_cep_tblBairros" => $idDBCepTblBairros,
		"id_db_cep_tblCidades" => $idDBCepTblCidades,
		"id_db_cep_tblLogradouros" => $idDBCepTblLogradouros,
		"id_db_cep_tblUF" => $idDBCepTblUF,
		"veiculo_endereco" => $veiculoEndereco,
		"veiculo_endereco_numero" => $veiculoEnderecoNumero,
		"veiculo_endereco_complemento" => $veiculoEnderecoComplemento,
		"veiculo_bairro" => $veiculoBairro,
		"veiculo_cidade" => $veiculoCidade,
		"veiculo_estado" => $veiculoEstado,
		"veiculo_pais" => $veiculoPais,
		"veiculo_cep" => $veiculoCep,
		"contato" => $contato,
		"email" => $email,
		"link_externo" => $linkExterno,
		"url1" => $url1,
		"url2" => $url2,
		"url3" => $url3,
		"url4" => $url4,
		"url5" => $url5,
		"palavras_chave" => $palavrasChave,
		"valor" => $valor,
		"valor1" => $valor1,
		"valor2" => $valor2,
		"ativacao" => $ativacao,
		"ativacao1" => $ativacao1,
		"ativacao2" => $ativacao2,
		"ativacao3" => $ativacao3,
		"ativacao4" => $ativacao4,
		"ativacao_promocao" => $ativacaoPromocao,
		"ativacao_home" => $ativacaoHome,
		"ativacao_home_categoria" => $ativacaoHomeCategoria,
		"ativacao_info_cadastro" => $ativacaoInfoCadastro,
		"acesso_restrito" => $acessoRestrito,
		"id_tb_veiculos_status" => $idTbVeiculosStatus,
		//"imagem" => $imagem,
		"anotacoes_internas" => $anotacoesInternas,
		"n_visitas" => $nVisitas
	));
	
	$mensagemSucesso = "1 " . XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus7");
}else{
	//echo "erro";
	$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus8");
}
//----------


//Limpeza de objetos.
//----------
unset($strSqlVeiculosUpdate);
unset($statementVeiculosUpdate);
//----------


//Gravação de complementos.
//----------
//Tipo.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"2");
if(!empty($arrIdsVeiculosTipo))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosTipo); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosTipo[$countArray], "2", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 01.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"12");
if(!empty($arrIdsVeiculosFiltroGenerico01))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico01); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico01[$countArray], "12", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 02.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"13");
if(!empty($arrIdsVeiculosFiltroGenerico02))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico02); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico02[$countArray], "13", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 03.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"14");
if(!empty($arrIdsVeiculosFiltroGenerico03))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico03); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico03[$countArray], "14", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 04.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"15");
if(!empty($arrIdsVeiculosFiltroGenerico04))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico04); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico04[$countArray], "15", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 05.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"16");
if(!empty($arrIdsVeiculosFiltroGenerico05))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico05); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico05[$countArray], "16", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 06.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"17");
if(!empty($arrIdsVeiculosFiltroGenerico06))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico06); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico06[$countArray], "17", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 07.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"18");
if(!empty($arrIdsVeiculosFiltroGenerico07))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico07); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico07[$countArray], "18", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 08.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"19");
if(!empty($arrIdsVeiculosFiltroGenerico08))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico08); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico08[$countArray], "19", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 09.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"20");
if(!empty($arrIdsVeiculosFiltroGenerico09))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico09); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico09[$countArray], "20", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 10.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"21");
if(!empty($arrIdsVeiculosFiltroGenerico10))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico10); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico10[$countArray], "21", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 11.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"22");
if(!empty($arrIdsVeiculosFiltroGenerico11))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico11); $countArray++)
	{

		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico11[$countArray], "22", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 12.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"23");
if(!empty($arrIdsVeiculosFiltroGenerico12))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico12); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico12[$countArray], "23", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 13.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"24");
if(!empty($arrIdsVeiculosFiltroGenerico13))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico13); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico13[$countArray], "24", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 14.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"25");
if(!empty($arrIdsVeiculosFiltroGenerico14))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico14); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico14[$countArray], "25", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 15.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"26");
if(!empty($arrIdsVeiculosFiltroGenerico15))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico15); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico15[$countArray], "26", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 16.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"27");
if(!empty($arrIdsVeiculosFiltroGenerico16))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico16); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico16[$countArray], "27", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 17.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"28");
if(!empty($arrIdsVeiculosFiltroGenerico17))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico17); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico17[$countArray], "28", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 18.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"29");
if(!empty($arrIdsVeiculosFiltroGenerico18))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico18); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico18[$countArray], "29", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 19.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"30");
if(!empty($arrIdsVeiculosFiltroGenerico19))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico19); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico19[$countArray], "30", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}


//Filtro genérico 20.
//Limpeza dos registros anteriores.
DbExcluir::ExcluirRegistrosGenerico02($id, 
									"tb_veiculos_relacao_complemento", 
									"id_tb_veiculos",
									"tipo_complemento", 
									"31");
if(!empty($arrIdsVeiculosFiltroGenerico20))
{
	for($countArray = 0; $countArray < count($arrIdsVeiculosFiltroGenerico20); $countArray++)
	{
		DbFuncoes::FiltrosGenericosGravar01($id, $arrIdsVeiculosFiltroGenerico20[$countArray], "31", "tb_veiculos_relacao_complemento", "id_tb_veiculos", "id_tb_veiculos_complemento");
	}
}
//----------


//Upload de arquivos.
//----------
if(!empty($_FILES["ArquivoUpload1"]["name"])) //Verifica se arquivos foram postados.
{

	//Definição do tamanho das imagens.
	$arrImagemTamanhos = $GLOBALS['arrImagemVeiculos'];
	if($GLOBALS['ativacaoImagensPadrao'] == 1)
	{
		$arrImagemTamanhos = $GLOBALS['arrImagemPadrao'];
	}
	
	//Definição do diretório de upload.
	$arquivosDiretorioUpload = $GLOBALS['raizCaminhoFisico'] . "/" . $GLOBALS['configDiretorioSistema'] . "/" . $GLOBALS['configDiretorioArquivos'];
	
	//Definição do nome do arquivo.
	$arrArquivoExtensao = explode(".", $_FILES["ArquivoUpload1"]["name"]);
	$arquivoExtensao = strtolower(end($arrArquivoExtensao));
	$arquivoNome = $id . "." . $arquivoExtensao;
	
	
	//Gravação do arquivo original no servidor.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"o" . $arquivoNome);
	}else{
		$resultadoUpload = Arquivo::ArquivoUpload($id, 
												$_FILES["ArquivoUpload1"], 
												$arquivosDiretorioUpload,
												"" . $arquivoNome);
	}

	if($resultadoUpload == true){
	
	}else{
		$mensagemErro .= $resultadoUpload;
		//$mensagemSucesso = "";
	}
	
	
	//Verificação de formato do arquivo.
	if(strpos($GLOBALS['configImagensFormatos'], $arquivoExtensao) !== false) {
		//Redimensionamento de arquivos.
		Imagem::ImagemRedimensionar01($arrImagemTamanhos, 
									$arquivosDiretorioUpload, 
									$arquivoNome);
	}else{
		$mensagemErro = XMLFuncoes::XMLIdiomas($GLOBALS['xmlIdiomaSistema'], "sistemaStatus19");
		//$mensagemSucesso = "";
	}
	
	
	//Update do registro com o nome do arquivo.
	$resultadoUpdate = DbUpdate::DbRegistroGenericoUpdate01($arquivoNome, $id, "tb_veiculos", "imagem");
	if ($resultadoUpdate == true) 
	{
	
	}else{
		$mensagemErro .= $resultadoUpdate;
		//$mensagemSucesso = "";
	}
}
//----------


//Fechamento da conexão.
//mysqli_close($dbSistemaCon);
//$dbSistemaConMysqli->close();
$dbSistemaConPDO = null;


//Montagem do URL de retorno.
//$URLRetorno = $configUrl . "/" . $configDiretorioSistema . "/" . $paginaRetorno . "?" .
$URLRetorno = $configUrl . "/" . $visualizacaoAtivaSistema . "/" . $paginaRetorno . "?" .
"idParentVeiculos=" . $idTbCategorias .
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