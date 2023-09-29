<?php
//Configura��es PHP.
//**************************************************************************************
//Recurso para for�ar exibi��o de erro, caso o servidor n�o esteja exibindo os erros.
//----------------------
//ini_set('display_errors', 1); //Mostra todos os erros.
//error_reporting(0); //Ocultar todos erros.
//error_reporting(E_ALL); //alpshost
//error_reporting(E_STRICT & ~E_STRICT); //Locaweb Linux 5.4 | HostGator Linux 5.5 | e 1 (windows)
//error_reporting(E_ALL | E_STRICT);
//error_reporting(error_reporting() & ~E_NOTICE);
//----------------------

date_default_timezone_set('America/Sao_Paulo');
//**************************************************************************************


//Configura��es gerais.
//**************************************************************************************
//Informa��es b�sicas.
$configNomeCliente = "BBM - Biblioteca Brasiliana Guita e Jos� Mindlin"; //nome do cliente
$configClienteRazaoSocial = "Laborat�rio de Conserva��o Preventiva Guita Mindlin";
$configClienteCPF = "";
$configClienteCNPJ = "";
$configClienteIEstadual = "";
$configClienteIMunicipal = "";
$configClienteIC1Nome = "";
$configClienteIC1 = "";
$configClienteIC2Nome = "";
$configClienteIC2 = "";
$configClienteIC3Nome = "";
$configClienteIC3 = "";
$configClienteIC4Nome = "";
$configClienteIC4 = "";
$configClienteIC5Nome = "";
$configClienteIC5 = "";
$configClienteEndereco = "";
$configClienteNumero = "";
$configClienteComplemento = "";
$configClienteBairro = "";
$configClienteCidade = "";
$configClienteEstado = "";
$configClientePais = "";
$configClienteCEP = "";
$configClienteTel = "";
$configClienteEmail = "";

$configTituloSite = "Banco de Dados da Conserva��o"; //nome do site
$configNomeDesenvolvedor = "Planejamento Visual - Arte e Tecnologia"; //Jorge Mauricio - Programador Visual | Planejamento Visual - Arte e Tecnologia | Jorge Mauricio - Cria��o e Treinamento Web | Web Inventor - Imagine, realize.
$configSiteDesenvolvedor = "http://www.planejamentovisual.com.br"; //http://www.programadorvisual.com.br | http://www.planejamentovisual.com.br | http://www.jorgemauricio.com | http://www.webinventor.com.br
$configAnoCopiright = "2018";
$configNomeSistema = "Sistema de Gerenciamento de Conte�do"; //Sistema de Controle | Sistema Administrativo | CRM
$configUrl = "http://usp.bancodedadosdaconservacao.br.solidcp.temp-address.com"; //URL da raiz ("http://" . $_SERVER['SERVER_NAME']; - Registra automaticamente - para fun��es mais sofisticadas)
$configUrlSSL = "http://usp.bancodedadosdaconservacao.br.solidcp.temp-address.com"; //URL SSL
$configUrlSiteImagens = ".."; //".." = caminho relativo | http://www.nomedodominio.com.br = caminho absoluto
$visualizacaoAtivaSistema = "pt"; //Nome do diret�rio equivalente ao idioma.
$visualizacaoAtivaMobile = "mobile"; //Nome do diret�rio da vers�o mobile principal.


//Configura��o dos recursos de exibi��o de m�dias (arquivos).
$configTamanhoVideoW = 640;
$configTamanhoVideoH = 360;

$configImagemPopUp = 1; //0 - Sem pop-up | 1 - LightBox/SlimBox 2 (JQuery)

//Configura��o de diret�rios.
$raizCaminhoFisico = $_SERVER['DOCUMENT_ROOT']; // otimizado: $_SERVER['DOCUMENT_ROOT'] (s� funciona com o dom�nio oficial) | arvixe: /home/jmrj/public_html
//$raizCaminhoFisico = "/home/jmrj/public_html"; // /home/jmrj/public_html | /usr/local/apache/htdocs
//$raizCaminhoFisico = $_SERVER['DOCUMENT_ROOT'] . "/home/jmrj/public_html";
//echo "raizCaminhoFisico=" . $raizCaminhoFisico . "<br>";
//echo "dirname(__FILE__)=" . dirname(__FILE__) . "<br>"; //Obs: Retirar do D: ou qualquer outro indicador de drive e alterar as barras para contra-barras (\) (/).
$configDiretorioSistema = "sistema";
$configDiretorioArquivosVisualizacao = "arquivos";
$configDiretorioArquivos = "arquivos";
$configDiretorioBanners = "banners";
$configDiretorioFuncoes = "funcoes";
$configDiretorioRecursos = "recursos";
$configDiretorioAPI = "api";
//$configDiretorioMaterialEnviado = "sistema\material_enviado";
$configDiretorioMaterialEnviado = $configDiretorioSistema . "/" . "material_enviado";

$configCaminhoSiteImagens = $configUrlSiteImagens . "/" . $configDiretorioSistema . "/" . $configDiretorioArquivosVisualizacao . "/";
$configURLSistemaAPI = $configURL . "/" . $configDiretorioAPI;

$configDiretorioExportacao = "exportacao";
$configCaminhoExportacao = $raizCaminhoFisico . "/" . $configDiretorioSistema . "/" . $configDiretorioExportacao;
$configCaminhoExportacaoDownload = $configURL . "/" . $configDiretorioSistema . "/" . $configDiretorioExportacao;

$configImagemQualidade = 100; //Percentual da qualidade de grava��o da imagem no redimencionamento
$configImagensFormatos =  ".bmp, .gif, .jpg, .jpeg, .png"; //Formatos de arquivos que ser�o redimensionados


//Configura��es para recursos espec�ficos de DB.
//----------------------
$configTipoDB = 2; //1 - Access | 2 - MySQL | 3 - SQL Server
//----------------------


$configConteudoCaixaTexto = 1; //determina qual caixa de texto ser� utilizada (1-sem formata��o | 11-Formata��o b�sica (CLEditor) | 12-Formata��o avan�ada (CLEditor))


//Configura��es de formato de visualiza��o.
//----------------------
$configSistemaFormatoData = 1; //configura��o de formato de data (1 - portugu�s dd/mm/aaaa | 2 - brit�nico mm/dd/aaaa)
$configSiteFormatoData = 1; //configura��o de formato de data (1 - portugu�s dd/mm/aaaa | 2 - brit�nico mm/dd/aaaa)
$configDataTipoCampo = 1; //1 - JQuery DatePicker | 2 - dropdown

$configSistemaMoeda = "R$"; //op��es: R$ | $ | �
$configSistemaPeso = "g"; //op��es: g | Pounds
$configSistemaPeso2 = "kg"; //op��es: kg | Pounds
$configSistemaMetrico = "m�"; //op��es: m� | ft�
$configSistemaMetricoDistancia = "KM"; //op��es: KM | MI
//----------------------


//Configura��es de cobran�a.
//----------------------
$configFormaCobranca = "pedido"; //op��es: op��es: pagseguro | paypal | f2b | pagamentodigital | moip | pedido (pedidos sem cobran�a)
$configCobrancaEmail = ""; //op��es: e-mail da cobran�a ou "em branco" (para desativar a etapa de cobran�a eletr�nica) | PayPal - e-mail ou c�digo dentro da conta do paypal (ex: 9RAVVKL3XDCCQ) - nas situa��es de doa��es
$configCobrancaToken = "";
$configCobrancaSenhaF2B = "";

$configFormaRecebimentoPagSeguro = "2"; //1 - somente boleto, transferencias e pagseguro (horizontal) | 2 - boleto + cart�es (horizontal) | 3 - somente boleto, transferencias e pagseguro (quadrado)
$configFormaRecebimentoPagamentoDigital = "1"; //1 - banner 468x60 horizontal

$configCEPOrigem = "";
//----------------------


//Configura��o de componentes.
//----------------------
$componenteEmail = 1; //0 - Sem Componente | 1 - PHP Mailer
$configFormatoEmail = 1; //0 - texto | 1 - html

$configQuebraLinha = "";
$configPlataforma = "";
if(PATH_SEPARATOR == ";")
{
	$configQuebraLinha = "\r\n";//windows
	$configPlataforma = "windows";
	//echo "configQuebraLinha=" . "windows" . "<br />";
}else{
	$configQuebraLinha = "\n";//linux
	$configPlataforma = "linux";
	//echo "configQuebraLinha=" . "linux" . "<br />";
}
//echo Funcoes::ConteudoMascaraLeitura($GLOBALS['configLogFiltroGenerico03Nome'], "IncludeConfig");
//Obs: retirar utf8_encode do include config e substituir pela fun��o acima.
//----------------------


//Cookies.
$configCookieTipoGravacao = 1; //0-desativado | 1-ativado (0 - grava sem path - diretorio | 1 - grava com o recurso de path - diretorio)
$configCookieDiretorio = "/"; // (/ - site inteiro)
$configNomeCookie = "bdc"; //vers�o antiga: nome_cookie

//Sessions.
$configSessionNomeUsuarioMaster = "usuario_master";
$configSessionNomeUsuario = "usuario";
$configSessionSistemaTimeout = "1440";


//Criptografia.
//----------------------
//$configCryptTipo = 1; //0 - sem criptografia | 1 - md5 (n�o permite decriptografia) | 2 - MCrypt PHP library (possibilita criptografia e decriptografia) (at� PHP 5.4) | 3 - Defuse php-encryption
$configCryptTipo = 1; //0 - sem criptografia | 1 - hash (n�o permite decriptografia) | 2 - dados (revers�vel)
$configCryptHash = 11; //11 - md5 (n�o permite decriptografia)
$configCryptDados = 21; //21 - MCrypt PHP library (possibilita criptografia e decriptografia) (testes arpovados: linux - php 7.0 | windows - php 5.4) | 22 - Defuse php-encryption (possibilita criptografia e decriptografia)
$configCryptChave = "sistema";
$configCryptChave32byte = "d0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282";//32-byte (64 character) hexadecimal encryption key.
$configCryptChaveDefusePHPEncryptionRandomKey = "def000006516cef316c508a843b1362ab79f4fe36a7294070c4c054c16fcab1537fb7ea3cbd6e32526b86e08e7d2906f2303a538eebc48c2944f8e7442886813e25ffab3"; //Defuse php-encryption (chave gerada pelo arquivo /php-encrypption{versao_em_uso}/GerarChave01.php).
$configCryptSalt = "sistema_dinamico"; //Talvez n�o esteja sendo utilizado na vers�o PHP.
//----------------------
//**************************************************************************************


//Sistema - Configura��es do menu lateral.
//**************************************************************************************
$habilitarMenuSistemaSistemaBusca = 1; //0-desativado | 1-ativado

$habilitarMenuSistemaManutencaoProdutos = 1; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoVeiculos = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoCadastro = 1; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoHistorico = 1; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoPaginas = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoProcessos = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoTurmas = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoModulos = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoAulas = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoPedidos = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoFluxo = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaManutencaoLog = 0; //0-desativado | 1-ativado

$habilitarMenuSistemaHistoricoIndiceGeral = 1; //0-desativado | 1-ativado
$configMenuSistemaHistoricoFiltrosStatus = 0; //'1 - listagem | 2 - dropdown menu

$habilitarMenuSistemaTarefasIndiceGeral = 0; //0-desativado | 1-ativado

$habilitarMenuSistemaPedidosIndiceGeral = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaPedidosParcelasIndiceGeral = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaOrcamentosIndiceGeral = 0; //0-desativado | 1-ativado

$habilitarMenuSistemaPostagensIndiceGeral = 1; //0-desativado | 1-ativado

$habilitarMenuSistemaProcessosIndiceGeral = 0; //0-desativado | 1-ativado

$habilitarMenuSistemaRelatorios = 0; //0-desativado | 1-ativado
$habilitarMenuSistemaImportacao = 0; //0-desativado | 1-ativado
//**************************************************************************************


//Idiomas - Carregamento dos XMLs.
//**************************************************************************************
//$xmlIdiomaSistema = simplexml_load_file('IdiomaSistema.xml');
//$xmlIdiomaSistema = simplexml_load_file($GLOBALS['configURL'] . "/" . $GLOBALS['configDiretorioFuncoes'] . "/" . 'IdiomaSistema.xml');
//$xmlIdiomaSistema = simplexml_load_file('../'.$GLOBALS['configDiretorioRecursos'].'/IdiomaSistema.xml'); //funcionando
$xmlIdiomaSistema = simplexml_load_file($GLOBALS['raizCaminhoFisico'] . '/'. $GLOBALS['configDiretorioRecursos'] . '/' . 'IdiomaSistema.xml');
$xmlIdiomaSite = simplexml_load_file($GLOBALS['raizCaminhoFisico'] . '/'. $GLOBALS['configDiretorioRecursos'] . '/' . 'IdiomaSite.xml');
//**************************************************************************************


//Configura��o dos m�dulos dispon�veis.
//**************************************************************************************
$tipoCategoriaConfig = "";
$tipoCategoriaConfig .= "1;Gerenciamento de Conte�do;ConteudoIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "1;Content Management;ConteudoIndice.php?variavelBlank=0;";
$tipoCategoriaConfig .= "2;Gerenciamento de Obras;ProdutosIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "10;Gerenciamento de Im�veis;ImoveisIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "3;Gerenciamento de Not�cias;PublicacoesIndice.php?tipoPublicacao=1;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "3;News Publications Management;PublicacoesIndice.php?tipoPublicacao=1;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "4;Gerenciamento de Galeria de Fotos;PublicacoesIndice.php?tipoPublicacao=2;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "4;Photo Gallery Management;PublicacoesIndice.php?tipoPublicacao=2;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "5;Gerenciamento de Artigos;PublicacoesIndice.php?tipoPublicacao=3;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "5;Articles Management;PublicacoesIndice.php?tipoPublicacao=3;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "6;Gerenciamento de Mat�rias;PublicacoesIndice.php?tipoPublicacao=4;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "6;Releases Management;PublicacoesIndice.php?tipoPublicacao=4;"; //1 - Not�cias | 2 - Galeria de Fotos | 3 - Artigos | 4 - Mat�rias
//$tipoCategoriaConfig .= "7;Gerenciamento de Enquete;EnquetesIndice.php?tipoEnquete=1;"; //Enquetes 
//$tipoCategoriaConfig .= "17;Gerenciamento de Quiz;EnquetesIndice.php?tipoEnquete=2;"; //Quiz
//$tipoCategoriaConfig .= "8;Idioma;-;";
//$tipoCategoriaConfig .= "8;Language;-;";
//$tipoCategoriaConfig .= "9;Segmento;-;";
//$tipoCategoriaConfig .= "9;Segment;-;";
//$tipoCategoriaConfig .= "11;Gerenciamento de Op��o de Afilia��o;AfiliacoesIndice.php?variavelBlank=0;"; //Esta op��o ser� usada para cadastrar os clientes de portais (pensar em uma forma de indicar a ativa��o para sele��o ou n�o). considerar em trocar o nome deste �tem para web services ou servi�os web
//$tipoCategoriaConfig .= "12;Gerenciamento de Formul�rios;FormulariosIndice.php?variavelBlank=0;"; 
//$tipoCategoriaConfig .= "12;Forms Management;FormulariosIndice.php?variavelBlank=0;"; 
$tipoCategoriaConfig .= "13;Gerenciamento de Usu�rios;CadastroIndice.php?variavelBlank=0;"; 
//$tipoCategoriaConfig .= "13;Register Management;CadastroIndice.php?variavelBlank=0;"; 
//$tipoCategoriaConfig .= "19;Gerenciamento de Cadastro RH;CadastroIndice.php?rh=1;"; 
//$tipoCategoriaConfig .= "15;Gerenciamento de T�picos do F�rum;ForumTopicosIndice.php?variavelBlank=0;";
//$lixo - tipoCategoriaConfig .= "16;Recursos Humanos;rh_indice.asp?variavel_blank=0;" 'lixo
//$tipoCategoriaConfig .= "18;Gerenciamento de Ve�culos;VeiculosIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "20;Gerenciamento de Newsletter;NewsletterIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "21;Gerenciamento de Fuxo de Caixa;FluxoIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "22;Gerenciamento de Publica��o de Banners;BannersIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "23;Classificados;-;";
//$tipoCategoriaConfig .= "24;Gerenciamento de Bate-papo;ChatIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "25;Gerenciamento de Avatars;-;";
//$tipoCategoriaConfig .= "26;Gerenciamento de P�ginas;PaginasIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "26;Pages Management;PaginasIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "27;Gerenciamento de Vincula��o de Cadastros;CadastroRelacaoRegistro.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "28;Gerenciamento de Anima��o de Banners;FlashGruposIndice.php?variavelBlank=0;"; //revisar este tipo de categoria (no sistema asp era 26 - mudar no outro sistema)
//$tipoCategoriaConfig .= "29;Gerenciamento de Processos;ProcessosIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "40;Gerenciamento de Tabela Generica 01;TabelaGenericaIndice.php?idTabela=0;"; //id_tabela separa a quantidade de talebas - Tabela para alguma informa��o espec�fica do cliente. Deve conter somente campos texto configur�veis para aparecer ou n�o. 
//$tipoCategoriaConfig .= "63;Gerenciamento de Arquivos;ArquivosIndice.php?tipoArquivo=3&masterPageSelect=LayoutSistemaSemMenu.php;";
//$tipoCategoriaConfig .= "80;Gerenciamento de Turmas;TurmasIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "81;Gerenciamento de M�dulos;ModulosIndice.php?variavelBlank=0;";
//$tipoCategoriaConfig .= "82;Gerenciamento de Aulas;AulasIndice.php?variavelBlank=0;";

//Cria��o de arrays.
$arrTipoCategoriaConfig = explode(";", $tipoCategoriaConfig);

$countArrays = 0;
$arrTipoCategoriaConfigIndice = array();
$arrTipoCategoriaConfigNome = array();
$arrTipoCategoriaConfigPagina = array();

for ($countTipoCategoriaConfig = 0; $countTipoCategoriaConfig < count($arrTipoCategoriaConfig) - 1; ++$countTipoCategoriaConfig) 
{
	//echo "array = " . $GLOBALS['arrTipoCategoriaConfig'][$countTipoCategoriaConfig] . "<br>";
	
	$arrTipoCategoriaConfigIndice[$countArrays] = $GLOBALS['arrTipoCategoriaConfig'][$countTipoCategoriaConfig];
	$countTipoCategoriaConfig = $countTipoCategoriaConfig + 1;
	//$arrTipoCategoriaConfigNome[$countArrays] = utf8_encode($GLOBALS['arrTipoCategoriaConfig'][$countTipoCategoriaConfig]);
	$arrTipoCategoriaConfigNome[$countArrays] = $GLOBALS['arrTipoCategoriaConfig'][$countTipoCategoriaConfig];
	$countTipoCategoriaConfig = $countTipoCategoriaConfig + 1;
	$arrTipoCategoriaConfigPagina[$countArrays] = $GLOBALS['arrTipoCategoriaConfig'][$countTipoCategoriaConfig];
	
	$countArrays = $countArrays + 1;
}
//echo "arrTipoCategoriaConfigNome[1] = " . $arrTipoCategoriaConfigNome[0] . "<br>";

//**************************************************************************************


//Configura��o de tamanho de imagens.
//**************************************************************************************
$ativacaoImagensPadrao = 1; //'0-desativado | 1-ativado

//prefixo;w;h
$arrImagemPadrao = array("g;1200;900","NULL;800;600","r;340;255","t;100;75");
$arrImagemCategoria = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemConteudo = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemProdutos = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemVeiculos = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemPublicacoes = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemArquivos = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemCadastro = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemCadastroEnderecos = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemAfiliacoes = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemFormulariosCamposOpcoes = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemEnquetes = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemEnquetesOpcoes = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemPaginas = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
$arrImagemOrcamentosItens = array("g;667;500","NULL;370;277","r;205;154","t;120;90");
//**************************************************************************************


//Categorias - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoCategorias = "categoria"; //op��es: id | n_classificacao | data_categoria esc | data_categoria desc | categoria
$habilitarCategoriasClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 

//Campos convencionais.
$ativacaoCategoriasImagem = 0; //0-desativado | 1-ativado
$ativacaoCategoriasDescricao = 0; //0-desativado | 1-ativado
$habilitarCategoriasNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarCategoriasAcessoRestrito = 0; //0-desativado | 1-ativado 
$habilitarCategoriasIdParentEdicao = 0; //0-desativado | 1-ativado 

//Pagina��o.
$habilitarCategoriasSistemaPaginacao = 1; //0-desativado | 1-ativado
$habilitarCategoriasSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configCategoriasSistemaPaginacaoNRegistros = 20;

//Recursos dispon�veis para cada categoria.
$habilitarCategoriasFotos = 0; //0-desativado | 1-ativado 
$habilitarCategoriasVideos = 0; //0-desativado | 1-ativado 
$habilitarCategoriasArquivos = 0; //0-desativado | 1-ativado 
$habilitarCategoriasZip = 0; //0-desativado | 1-ativado 
$habilitarCategoriasSwfs = 0; //0-desativado | 1-ativado 


//Defini��o de quantas e quais informa��es complementares as categorias ter�o.
$habilitarCategoriasIc1 = 0; //0-desativado | 1-ativado 
$configTituloCategoriasIc1 = "Descri��o 01";
$configCategoriasBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarCategoriasIc2 = 0; //0-desativado | 1-ativado 
$configTituloCategoriasIc2 = "Descri��o 02"; 
$configCategoriasBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarCategoriasIc3 = 0; //0-desativado | 1-ativado
$configTituloCategoriasIc3 = "Descri��o 03"; 
$configCategoriasBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarCategoriasIc4 = 0; //0-desativado | 1-ativado 
$configTituloCategoriasIc4 = "Descri��o 04"; 
$configCategoriasBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarCategoriasIc5 = 0; //0-desativado | 1-ativado 
$configTituloCategoriasIc5 = "Descri��o 05"; 
$configCategoriasBoxIc5 = 1; //1 - simples | 2 - multilinha


//Site.
$habilitarCategoriasSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarCategoriasSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configCategoriasSitePaginacaoNRegistros = 20;
//**************************************************************************************


//Conte�do - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoConteudo = "id"; //op��es: id | n_classificacao

$habilitarConteudoNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarConteudoVideos = 0; //0-desativado | 1-ativado 
$habilitarConteudoArquivos = 0; //0-desativado | 1-ativado 
$habilitarConteudoColunas = 0; //0-desativado | 1-ativado
$habilitarConteudoSwf = 0; //0-desativado | 1-ativado
$habilitarConteudoImagemSemRedimensionamento = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Produtos - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoProdutos = "produto"; //'RND(INT(NOW*id)-NOW*id) - Access | newid() - SQL Server (random) | valor | cast(produto as varchar(500)) | cod_produto | n_classificacao | data_produto desc | data_produto asc
$habilitarProdutosClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 

$habilitarProdutosSistemaPaginacao = 1; //0-desativado | 1-ativado 
$habilitarProdutosSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado 
$configProdutosSistemaPaginacaoNRegistros = 30;


//Configura��o de recursos gerais liberados para registro dos produtos.
$habilitarProdutosTipo = 1; //0-desativado | 1-ativado 
$habilitarProdutosNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarProdutosAtivacaoPromocoes = 0; //0-desativado | 1-ativado 
$habilitarProdutosAtivacaoHome = 0; //0-desativado | 1-ativado 
$habilitarProdutosAtivacaoCategoria = 0; //0-desativado | 1-ativado 
$habilitarProdutosAtivacaoAcesso = 0; //0-desativado | 1-ativado 
$habilitarProdutosPalavrasChave = 1; //0-desativado | 1-ativado 
$ativacaoProdutosVisualizacaoData = 0; //0-desativado | 1-ativado 
$ativacaoProdutosImagens = 1; //0-desativado | 1-ativado 
$ativacaoProdutosVisualizacaoImagem = 0; //0-desativado | 1-ativado 
$habilitarProdutosValor = 0; //0-desativado | 1-ativado 
$habilitarProdutosValor1 = 0; //0-desativado | 1-ativado 
$configProdutosValor1Nome = "Nome do Valor 01";
$configProdutosValor1Moeda = "R$"; //R$ | $
$habilitarProdutosValor2 = 0; //0-desativado | 1-ativado 
$configProdutosValor2Nome = "Nome do Valor 02"; 
$configProdutosValor2Moeda = "R$"; //R$ | $
$habilitarProdutosPeso = 0; //0-desativado | 1-ativado 
$habilitarProdutosCoeficiente = 0; //0-desativado | 1-ativado 
$configProdutosCoeficienteNome = "Coeficiente"; //0-desativado | 1-ativado 
$configProdutosCoeficienteTipo = ""; //R$ | % | $
$configProdutosCoeficienteOperacao = "n"; //+ | - | / | * | n (n=n�o utilizar)
$habilitarProdutosStatus = 0; //0-desativado | 1-ativado 


//Descri��es.
$habilitarProdutosDescricao01 = 1; //0-desativado | 1-ativado 
$configProdutosDescricao01Titulo = "Informa��es Adicionais"; 
$habilitarProdutosDescricao02 = 1; //0-desativado | 1-ativado 
$configProdutosDescricao02Titulo = "Descreva o tipo e dimens�es da pel�cula, tipo de c�mera, especifica��o do arquivo (FT), arquivo digital e outras informa��es"; 
$habilitarProdutosDescricao03 = 1; //0-desativado | 1-ativado 
$configProdutosDescricao03Titulo = "Descreva, caso se aplique, qualquer manipula��o ou tratamento de imagem anterior a impress�o"; 
$habilitarProdutosDescricao04 = 0; //0-desativado | 1-ativado 
$configProdutosDescricao04Titulo = "Descri��o 04"; 
$habilitarProdutosDescricao05 = 0; //0-desativado | 1-ativado 
$configProdutosDescricao05Titulo = "Descri��o 05"; 


//Filtros gen�ricos.
$habilitarProdutosFiltroGenerico01 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico01Nome = "Autor";
$configProdutosFiltroGenerico01CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico02 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico02Nome = "Autor Principal";
$configProdutosFiltroGenerico02CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico03 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico03Nome = "Autor Secund�rio";
$configProdutosFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico04 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico04Nome = "Idioma";
$configProdutosFiltroGenerico04CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico05 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico05Nome = "Editora";
$configProdutosFiltroGenerico05CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico06 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico06Nome = "Proced�ncia";
$configProdutosFiltroGenerico06CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico07 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico07Nome = "Suporte";
$configProdutosFiltroGenerico07CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico08 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico08Nome = "T�cnica de Impress�o";
$configProdutosFiltroGenerico08CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico09 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico09Nome = "T�cnica";
$configProdutosFiltroGenerico09CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico10 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico10Nome = "�rg�o Emissor";
$configProdutosFiltroGenerico10CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico11 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico11Nome = "Favorecido";
$configProdutosFiltroGenerico11CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico12 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico12Nome = "Outros Elementos";
$configProdutosFiltroGenerico12CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico13 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico13Nome = "Destinat�rio";
$configProdutosFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico14 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico14Nome = "Gerada atrav�s de";
$configProdutosFiltroGenerico14CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico15 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico15Nome = "Processo de Impress�o";
$configProdutosFiltroGenerico15CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico16 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico16Nome = "Impressa por";
$configProdutosFiltroGenerico16CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico17 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico17Nome = "Ap�s Impress�o a Fotografia Foi";
$configProdutosFiltroGenerico17CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico18 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico18Nome = "Faz Parte de Uma S�rie";
$configProdutosFiltroGenerico18CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico19 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico19Nome = "Existem outras edi��es com outro formato ou dimens�es";
$configProdutosFiltroGenerico19CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico20 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico20Nome = "Artista";
$configProdutosFiltroGenerico20CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico21 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico21Nome = "Obra Impressa por";
$configProdutosFiltroGenerico21CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico22 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico22Nome = "T�cnica";
$configProdutosFiltroGenerico22CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico23 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico23Nome = "Mapa Impresso Por";
$configProdutosFiltroGenerico23CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico24 = 1; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico24Nome = "Palavras-Chave";
$configProdutosFiltroGenerico24CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico25 = 0; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico25Nome = "Filtro 25";
$configProdutosFiltroGenerico25CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico26 = 0; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico26Nome = "Filtro 26";
$configProdutosFiltroGenerico26CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico27 = 0; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico27Nome = "Filtro 27";
$configProdutosFiltroGenerico27CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico28 = 0; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico28Nome = "Filtro 28";
$configProdutosFiltroGenerico28CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico29 = 0; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico29Nome = "Filtro 29";
$configProdutosFiltroGenerico29CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProdutosFiltroGenerico30 = 0; //0-desativado | 1-ativado 
$configProdutosFiltroGenerico30Nome = "Filtro 30";
$configProdutosFiltroGenerico30CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares os produtos ter�o.
$habilitarProdutosIc1 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc1 = "Tombo/Codbar";
$configProdutosBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc2 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc2 = "Local"; 
$configProdutosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc3 = 1; //0-desativado | 1-ativado
$configTituloProdutosIc3 = "Exemplar"; 
$configProdutosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc4 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc4 = "Volume"; 
$configProdutosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc5 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc5 = "Edi��o"; 
$configProdutosBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc6 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc6 = "Ano Edi��o";
$configProdutosBoxIc6 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc7 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc7 = "P�ginas"; 
$configProdutosBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc8 = 1; //0-desativado | 1-ativado
$configTituloProdutosIc8 = "Folhas"; 
$configProdutosBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc9 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc9 = "Dimens�es de Encard."; 
$configProdutosBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc10 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc10 = "Dimens�es do Miolo"; 
$configProdutosBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc11 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc11 = "Dimens�es";
$configProdutosBoxIc11 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc12 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc12 = "Data"; 
$configProdutosBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc13 = 1; //0-desativado | 1-ativado
$configTituloProdutosIc13 = "Data Impress�o"; 
$configProdutosBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc14 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc14 = "Ano"; 
$configProdutosBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc15 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc15 = "Descri��o"; 
$configProdutosBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc16 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc16 = "Dados do contato, caso se aplique";
$configProdutosBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc17 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc17 = "Descri��o"; 
$configProdutosBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc18 = 1; //0-desativado | 1-ativado
$configTituloProdutosIc18 = "Tiragem"; 
$configProdutosBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc19 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc19 = "Se sim"; 
$configProdutosBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc20 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc20 = "Se nunca foi editada, existem outras impress�es desta imagem"; 
$configProdutosBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc21 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc21 = "Faz parte de uma s�rie/portf�lio";
$configProdutosBoxIc21 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc22 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc22 = "Escala"; 
$configProdutosBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc23 = 1; //0-desativado | 1-ativado
$configTituloProdutosIc23 = "Suporte de Sustenta��o"; 
$configProdutosBoxIc23 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc24 = 1; //0-desativado | 1-ativado 
$configTituloProdutosIc24 = "N� de Folhas / Partes"; 
$configProdutosBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc25 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc25 = "Descri��o 25"; 
$configProdutosBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc26 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc26 = "Descri��o 26";
$configProdutosBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc27 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc27 = "Descri��o 27"; 
$configProdutosBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc28 = 0; //0-desativado | 1-ativado
$configTituloProdutosIc28 = "Descri��o 28"; 
$configProdutosBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc29 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc29 = "Descri��o 29"; 
$configProdutosBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc30 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc30 = "Descri��o 30"; 
$configProdutosBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc31 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc31 = "Descri��o 31";
$configProdutosBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc32 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc32 = "Descri��o 32"; 
$configProdutosBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc33 = 0; //0-desativado | 1-ativado
$configTituloProdutosIc33 = "Descri��o 33"; 
$configProdutosBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc34 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc34 = "Descri��o 34"; 
$configProdutosBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc35 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc35 = "Descri��o 35"; 
$configProdutosBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc36 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc36 = "Descri��o 36";
$configProdutosBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc37 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc37 = "Descri��o 37"; 
$configProdutosBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc38 = 0; //0-desativado | 1-ativado
$configTituloProdutosIc38 = "Descri��o 38"; 
$configProdutosBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc39 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc39 = "Descri��o 39"; 
$configProdutosBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc40 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc40 = "Descri��o 40"; 
$configProdutosBoxIc40 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc41 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc41 = "Descri��o 41";
$configProdutosBoxIc41 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc42 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc42 = "Descri��o 42"; 
$configProdutosBoxIc42 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc43 = 0; //0-desativado | 1-ativado
$configTituloProdutosIc43 = "Descri��o 43"; 
$configProdutosBoxIc43 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc44 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc44 = "Descri��o 44"; 
$configProdutosBoxIc44 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc45 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc45 = "Descri��o 45"; 
$configProdutosBoxIc45 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc46 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc46 = "Descri��o 46";
$configProdutosBoxIc46 = 2; //1 - simples | 2 - multilinha

$habilitarProdutosIc47 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc47 = "Descri��o 47"; 
$configProdutosBoxIc47 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc48 = 0; //0-desativado | 1-ativado
$configTituloProdutosIc48 = "Descri��o 48"; 
$configProdutosBoxIc48 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc49 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc49 = "Descri��o 49"; 
$configProdutosBoxIc49 = 1; //1 - simples | 2 - multilinha

$habilitarProdutosIc50 = 0; //0-desativado | 1-ativado 
$configTituloProdutosIc50 = "Descri��o 50"; 
$configProdutosBoxIc50 = 1; //1 - simples | 2 - multilinha


//Configura��es para relacionar produtos com cadastros pelo sistema.
$habilitarProdutosCadastroUsuario = 0; //0-desativado | 1-ativado
$configProdutosCadastroUsuarioMetodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroProdutosUsuario = "3892"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroProdutosUsuario = "0"; //id do tipo de cadastro
$configClassificacaoCadastroProdutosUsuario = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarProdutosCadastroVinculosMultiplos = 0; //0-desativado | 1-ativado


//Recursos dispon�veis para cada produto.
$habilitarProdutosFotos = 0; //0-desativado | 1-ativado 
$habilitarProdutosVideos = 0; //0-desativado | 1-ativado 
$habilitarProdutosArquivos = 0; //0-desativado | 1-ativado 
$habilitarProdutosZip = 0; //0-desativado | 1-ativado 
$habilitarProdutosSwfs = 0; //0-desativado | 1-ativado 
$habilitarProdutosConteudo = 0; //0-desativado | 1-ativado 
$habilitarProdutosConteudoHTML = 1; //0-desativado | 1-ativado 
$habilitarProdutosCategorias = 0; //0-desativado | 1-ativado 

$habilitarProdutosHistorico = 1; //0-desativado | 1-ativado 
$habilitarProdutosModulos = 0; //0-desativado | 1-ativado 
$habilitarProdutosAulas = 0; //0-desativado | 1-ativado 


//Site.
$configProdutosImagemPlaceholder = 0; //0-desativado | 1-ativado 
$configProdutosTituloLimiteCaracteres = 0; //0 desativa a limita��o
$configProdutosDescricao01LimiteCaracteres = 200; //0 desativa a limita��o
$configProdutosPaginaRetornoCompra = 1; //0 - Mesma p�gina | 1 - Carrinho

$habilitarProdutosPaginacaoSimples = 1; //0-desativado | 1-ativado 
$habilitarProdutosPaginacaoQtdPaginas = 1; //0-desativado | 1-ativado 
$configProdutosPaginacaoNRegistros = 10; //0-desativado | 1-ativado 


//e-commerce.
$configProdutosSelecaoQuantidade = 0; //0-sele��o autom�tica | 1-sele��o manual | 2-caixa livre
$configProdutosSelecaoQuantidadeMax = 10;
//**************************************************************************************


//Itens Valores - configura��o dos recursos.
//**************************************************************************************
$habilitarProdutosOpcoes = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Itens Valores - configura��o dos recursos.
//**************************************************************************************
$habilitarItensValoresProdutos = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Carrinho - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoProdutosCarrinhoDb = "data_selecao desc"; //op��es: op��es: data_selecao desc | data_selecao asc | id

$configCarrinhoManipulacaoItens = 1; //1 - agrupado (para itens que n�o t�m varia��o) | 2 - individualizado (para itens que possuem varia��o)

//Modalidades de envio.
$habilitarCarrinhoFreteEscolha = 1; //1 - 0-desativado | 1-ativado
$habilitarCarrinhoFreteRetirar = 0; //1 - 0-desativado | 1-ativado
$habilitarCarrinhoFreteTransportadora = 0; //1 - 0-desativado | 1-ativado
$habilitarCarrinhoFreteInternacional = 0; //1 - 0-desativado | 1-ativado
$habilitarCarrinhoFreteCorreiosEntregasACobrar = 0; //1 - 0-desativado | 1-ativado

$habilitarCarrinhoFreteVisualizar = 1; //1 - 0-desativado | 1-ativado
$habilitarCarrinhoFretePesoVisualizar = 1; //1 - 0-desativado | 1-ativado
$habilitarCarrinhoFretePrazoEntregaVisualizar = 1; //1 - 0-desativado | 1-ativado

//Configura��o dos Correios.
$configCarrinhoFreteCorreiosMetodo = 1; //1 - WebService dos correios | 2 - Componente ASP da Locaweb
$configCarrinhoFreteCorreios_nCdEmpresa = ""; //c�digo de cliente fornecido pelo correio
$configCarrinhoFreteCorreiosMetodo_sDsSenha = ""; //Senha para acesso ao servi�o, associada ao seu c�digo administrativo. A senha inicial corresponde aos 8 primeiros d�gitos do CNPJ informado no contrato. A qualquer momento, � poss�vel alterar a senha no endere�o http://www.corporativo.correios.com.br/encomendas/servicosonline/recuperaSenha.
$configCarrinhoFreteCorreios_StrRetorno = "XML"; //Indica a forma de retorno da consulta. (XML - Resultado em XML | Popup - Resultado em uma janela popup | <URL> - Resultado via post em uma p�gina do requisitante)
$configCarrinhoFreteCorreiosContratoPAC = 41211; //41211 | 41068
$configCarrinhoFreteCorreiosContratoSedex = 40096; //40096 | 40436 | 40444 | 40568 | 40606
$configCarrinhoFreteCorreiosContratoESedex = 81019; //81019 | 81868 - Grupo 01 | 81833 - Grupo 02 | 81850 - Grupo 03

$habilitarCarrinhoEnvioPedido = 1; //1 - 0-desativado | 1-ativado (na grava��o do pedido)
$configCarrinhoEnvioPedidoId = "399";

//Cofigura��es de cobran�a off-line.
$habilitarCarrinhoCobrancaDeposito = 0; //1 - 0-desativado | 1-ativado
$configCarrinhoCobrancaDepositoId = 4105;
$habilitarCarrinhoCobrancaBoletoManual = 0; //1 - 0-desativado | 1-ativado
$configCarrinhoCobrancaBoletoManualId = 4107; //1 - 0-desativado | 1-ativado
//**************************************************************************************


//Publica��es - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoPublicacoes = "data_publicacao desc, id desc"; //op��es: id | n_classificacao | data_publicacao esc, id asc | data_publicacao desc, id desc | cast(titulo as varchar(500)) | RND(INT(NOW*id)-NOW*id) - Access | newid() - SQL Server (random)
$habilitarPublicacoesClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesEdicaoCategorias = 0; //0-desativado | 1-ativado 

//Pagina��o.
$habilitarPublicacoesSistemaPaginacao = 0; //0-desativado | 1-ativado
$habilitarPublicacoesSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configPublicacoesSistemaPaginacaoNRegistros = 5;

//Configura��o de recursos gerais liberados para registro das publica��es.
$ativacaoPublicacoesDataFinal = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesAtivacaoHome = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesAtivacaoHomeCategoria = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesAtivacaoAcesso = 0; //0-desativado | 1-ativado 
$ativacaoPublicacoesFonte = 1; //0-desativado | 1-ativado 
$ativacaoPublicacoesFonteLink = 0; //0-desativado | 1-ativado 
$ativacaoPublicacoesEditoria = 0; //0-desativado | 1-ativado 
$ativacaoPublicacoesImagens = 1; //0-desativado | 1-ativado 
$habilitarPublicacoesVisualizacaoImagens = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesConteudoSimples = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesPalavrasChave = 1; //0-desativado | 1-ativado 

//Defini��o de quantas e quais informa��es complementares as publica��es ter�o.
$habilitarPublicacoesIc1 = 0; //0-desativado | 1-ativado 
$configPublicacoesTituloIc1 = "Descri��o 01";
$configPublicacoesBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarPublicacoesIc2 = 0; //0-desativado | 1-ativado 
$configPublicacoesTituloIc2 = "Descri��o 02"; 
$configPublicacoesBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarPublicacoesIc3 = 0; //0-desativado | 1-ativado
$configPublicacoesTituloIc3 = "Descri��o 03"; 
$configPublicacoesBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarPublicacoesIc4 = 0; //0-desativado | 1-ativado 
$configPublicacoesTituloIc4 = "Descri��o 04"; 
$configPublicacoesBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarPublicacoesIc5 = 0; //0-desativado | 1-ativado 
$configPublicacoesTituloIc5 = "Descri��o 05"; 
$configPublicacoesBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarPublicacoesCadastroUsuario = 0; //0-desativado | 1-ativado
//$configPublicacoesVinculo3Nome = "V�nculo 03";
$configPublicacoesCadastroUsuarioMetodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroPublicacoesUsuario = "3892"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroPublicacoesUsuario = "0"; //id do tipo de cadastro
$configClassificacaoCadastroPublicacoesUsuario = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

//Recursos dispon�veis para cada publica��o.
$habilitarPublicacoesConteudo = 1; //0-desativado | 1-ativado 
$habilitarPublicacoesFotos = 1; //0-desativado | 1-ativado 
$habilitarPublicacoesVideos = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesArquivos = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesZip = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesSwfs = 0; //0-desativado | 1-ativado 


//Site.
$configPublicacoesConteudoLimiteCaracteres = "200";
$configPublicacoesImagemPlaceholder = 0; //0-desativado | 1-ativado 
$configPublicacoesAtivacaoPopUp = 1; //0-corpo do site | 1-janela pop-up

$configPublicacoesImagensNColunas = "3";
$configPublicacoesVideosNColunas = "1";
$configPublicacoesArquivosNColunas = "1";
$configPublicacoesZipNColunas = "1";
$configPublicacoesSwfNColunas = "1";

//Pagina��o.
$habilitarPublicacoesPaginacaoSimples = 0; //0-desativado | 1-ativado 
$habilitarPublicacoesPaginacaoQtdPaginas = 1; //0-desativado | 1-ativado 
$configPublicacoesPaginacaoNRegistros = 10;
//**************************************************************************************


//Arquivos - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoArquivos = "id"; //op��es: id | n_classificacao | legenda | RND(INT(NOW*id)-NOW*id) - Access | newid() - SQL Server (random)
$habilitarArquivosMudancaRegistros = 0; //0-desativado | 1-ativado

$habilitarArquivosNClassificacao = 0; //0-desativado | 1-ativado
$habilitarArquivosDescricao = 1; //0-desativado | 1-ativado

$habilitarArquivosVideosTitulos = 0; //0-desativado | 1-ativado
$habilitarArquivosVideosCodigoHTML = 0; //0-desativado | 1-ativado
//**************************************************************************************


//Cadastro - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoCadastro = "nome"; //op��es: id | data_cadastro desc | data_cadastro asc | nome | razao_social | nome_fantasia | RND(INT(NOW*id)-NOW*id) - SQL Server | rand() - MySQL
$habilitarCadastroClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 

//Pagina��o.
$habilitarCadastroSistemaPaginacao = 0; //0-desativado | 1-ativado
$habilitarCadastroSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configCadastroSistemaPaginacaoNRegistros = 30;

//Recursos de cadastramento.
$habilitarCadastroEdicaoCategorias = 0; //0-desativado | 1-ativado

$habilitarCadastroCategoriasVinculosMultiplos = 0; //0-desativado | 1-ativado //antigo nome: configCadastroCategoriaMultipla / config_cadastro_categoria_multipla
$configCadastroIdCategoriaMultiplaRaiz = 3534; //id da categoria

$habilitarCadastroProdutosVinculosMultiplos = 0; //0-desativado | 1-ativado

$configCadastroIncluirLocalizacao = 0; //0 - sem informa��es de localiza��o | 1 - campo livre | 2 - combo box com o db interno persolalizado | 3 - combo box com o db_cep | 4 - XML (http://www.republicavirtual.com.br/cep/exemplos.php) | 5 - XML (http://www.buscarcep.com.br/?cep=22420041&formato=xml&chave=1iyeEHOY7.SVCKZSalTVl5SnTc34470)
$configCadastroCEPPreenchimento = 0; //0-desativado | 1-ativado

//Recursos dispon�veis para cada cadastro.
$habilitarCadastroFotos = 0; //0-desativado | 1-ativado 
$habilitarCadastroVideos = 0; //0-desativado | 1-ativado 
$habilitarCadastroArquivos = 0; //0-desativado | 1-ativado 
$habilitarCadastroZip = 0; //0-desativado | 1-ativado 
$habilitarCadastroSwfs = 0; //0-desativado | 1-ativado 
$habilitarCadastroPaginas = 0; //0-desativado | 1-ativado 
$habilitarCadastroProcessos = 0; //0-desativado | 1-ativado 

$habilitarCadastroLogo = 0; //0-desativado | 1-ativado 
$habilitarCadastroMapa = 0; //0-desativado | 1-ativado 
$habilitarCadastroBanner = 0; //0-desativado | 1-ativado 

$habilitarCadastroNClassificacao = 0; //0-desativado | 1-ativado (obs: ainda n�o est� ativo)
$habilitarCadastroSexo = 0; //0-desativado | 1-ativado
$habilitarCadastroPfPj = 0; //0-desativado | 1-ativado
$habilitarCadastroAlturaPeso = 0; //0-desativado | 1-ativado
$habilitarCadastroRazaoSocial = 0; //0-desativado | 1-ativado
$habilitarCadastroNomeFantasia = 0; //0-desativado | 1-ativado
$habilitarCadastroDataNascimento = 0; //0-desativado | 1-ativado

$habilitarCadastroCPFRG = 0; //0-desativado | 1-ativado
$configCadastroCPFValidacao = 0; //0-desativado | 1-ativado
$configCadastroCPFVerificacaoDuplicado = 0; //0-desativado | 1-ativado

$habilitarCadastroCNPJ = 0; //0-desativado | 1-ativado
$configCadastroCNPJValidacao = 0; //0-desativado | 1-ativado
$configCadastroCNPJVerificacaoDuplicado = 0; //0-desativado | 1-ativado

$habilitarCadastroDocumento = 0; //0-desativado | 1-ativado
$habilitarCadastroIEstadualIMunicipal = 0; //0-desativado | 1-ativado
$habilitarCadastroPontoReferencia = 0; //0-desativado | 1-ativado
$habilitarCadastroSite = 0; //0-desativado | 1-ativado
$habilitarCadastroNFuncionarios = 0; //0-desativado | 1-ativado

$habilitarCadastroVinculo1 = 0; //0-desativado | 1-ativado
$configCadastroVinculo1Nome = "V�nculo 01";
$configCadastroVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroVinculo1 = "3892"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoCadastroVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarCadastroVinculo2 = 0; //0-desativado | 1-ativado
$configCadastroVinculo2Nome = "V�nculo 02";
$configCadastroVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroVinculo2 = "3892"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoCadastroVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarCadastroVinculo3 = 0; //0-desativado | 1-ativado
$configCadastroVinculo3Nome = "V�nculo 03";
$configCadastroVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroVinculo3 = "3892"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoCadastroVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarCadastroStatus = 0; //0-desativado | 1-ativado

$habilitarCadastroAtivacaoDestaque = 0; //0-desativado | 1-ativado
$habilitarCadastroAtivacaoMalaDireta = 0; //0-desativado | 1-ativado
$habilitarCadastroUsuario = 0; //0-desativado | 1-ativado

$configCadastroEmailValidacao = 0; //0-desativado | 1-ativado
$configCadastroEmailVerificacaoDuplicado = 0; //0-desativado | 1-ativado

$habilitarCadastroSenha = 1; //0-desativado | 1-ativado
$configCadastroSenha = 1; //0 - n�o aparecer no sistema e n�o editar (edi��o somente pelo usu�rio) | 1-aparecer no sistema e edi��o
$configCadastroMetodoSenha = 2; //0 - sem criptografia | 1 - md5 (n�o permite decriptografia) | 2 - MCrypt PHP library (possibilita criptografia e decriptografia)

$habilitarCadastroImagem = 0; //0-desativado | 1-ativado
$ativacaoCadastroVisualizacaoImagem = 0; //0-desativado | 1-ativado

//M�scaras.
$configCadastroCPFMascara = 0; //0-desativado | 1-ativado
$configCadastroCNPJMascara = 0; //0-desativado | 1-ativado
$configCadastroCEPMascara = 0; //0-desativado | 1-ativado

$habilitarCadastroMapaOnline = 0; //0-desativado | 1-ativado
$configCadastroMapaOnline = 0; //1 - link | 2 - html | 3 - Latitude e Longitude (formato: latitude;longitude)

$habilitarCadastroPalavrasChave = 0; //0-desativado | 1-ativado
$habilitarCadastroApresentacao = 0; //0-desativado | 1-ativado
$habilitarCadastroServicos = 0; //0-desativado | 1-ativado
$HabilitarCadastroPromocoes = 0; //0-desativado | 1-ativado
$habilitarCadastroCondicoesComerciais = 0; //0-desativado | 1-ativado
$habilitarCadastroFormasPagamento = 0; //0-desativado | 1-ativado
$habilitarCadastroHorarioAtendimento = 0; //0-desativado | 1-ativado
$habilitarCadastroSituacaoAtual = 0; //0-desativado | 1-ativado

$habilitarCadastroTipo = 1; //0-desativado | 1-ativado
$habilitarCadastroAtividades = 0; //0-desativado | 1-ativado

//Arquivos gen�ricos.
$habilitarCadastroArquivo1 = 0; //0-desativado | 1-ativado 
$configCadastroTituloArquivo1 = "Arquivo 01"; 
$configCadastroArquivo1 = 1; //1 - imagem | 3 - arquivo

$habilitarCadastroArquivo2 = 0; //0-desativado | 1-ativado 
$configCadastroTituloArquivo2 = "Arquivo 02"; 
$configCadastroArquivo2 = 1; //1 - imagem | 3 - arquivo

$habilitarCadastroArquivo3 = 0; //0-desativado | 1-ativado 
$configCadastroTituloArquivo3 = "Arquivo 03"; 
$configCadastroArquivo3 = 1; //1 - imagem | 3 - arquivo

$habilitarCadastroArquivo4 = 0; //0-desativado | 1-ativado 
$configCadastroTituloArquivo4 = "Arquivo 04"; 
$configCadastroArquivo4 = 1; //1 - imagem | 3 - arquivo

$habilitarCadastroArquivo5 = 0; //0-desativado | 1-ativado 
$configCadastroTituloArquivo5 = "Arquivo 05"; 
$configCadastroArquivo5 = 1; //1 - imagem | 3 - arquivo

//Datas gen�ricas.
$habilitarCadastroData1 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData1 = "Descri��o 01"; 
$configTipoCampoCadastroData1 = 1; //1 - JQuery DatePicker
$configCadastroData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData2 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData2 = "Descri��o 02"; 
$configTipoCampoCadastroData2 = 1; //1 - JQuery DatePicker
$configCadastroData2 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData3 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData3 = "Descri��o 03"; 
$configTipoCampoCadastroData3 = 1; //1 - JQuery DatePicker
$configCadastroData3 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData4 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData4 = "Descri��o 04"; 
$configTipoCampoCadastroData4 = 1; //1 - JQuery DatePicker
$configCadastroData4 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData5 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData5 = "Descri��o 05"; 
$configTipoCampoCadastroData5 = 1; //1 - JQuery DatePicker
$configCadastroData5 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData6 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData6 = "Descri��o 06"; 
$configTipoCampoCadastroData6 = 1; //1 - JQuery DatePicker
$configCadastroData6 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData7 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData7 = "Descri��o 07"; 
$configTipoCampoCadastroData7 = 1; //1 - JQuery DatePicker
$configCadastroData7 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData8 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData8 = "Descri��o 08"; 
$configTipoCampoCadastroData8 = 1; //1 - JQuery DatePicker
$configCadastroData8 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData9 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData9 = "Descri��o 09"; 
$configTipoCampoCadastroData9 = 1; //1 - JQuery DatePicker
$configCadastroData9 = 1; //1 - data simples (dia, m�s, ano)

$habilitarCadastroData10 = 0; //0-desativado | 1-ativado 
$configTituloCadastroData10 = "Descri��o 10"; 
$configTipoCampoCadastroData10 = 1; //1 - JQuery DatePicker
$configCadastroData10 = 1; //1 - data simples (dia, m�s, ano)

//Ativa��es gen�ricas.
$habilitarCadastroAtivacao1 = 0; //0-desativado | 1-ativado 
$configTituloCadastroAtivacao1 = "Ativa��o 01"; 

$habilitarCadastroAtivacao2 = 0; //0-desativado | 1-ativado 
$configTituloCadastroAtivacao2 = "Ativa��o 02"; 

$habilitarCadastroAtivacao3 = 0; //0-desativado | 1-ativado 
$configTituloCadastroAtivacao3 = "Ativa��o 03"; 

$habilitarCadastroAtivacao4 = 0; //0-desativado | 1-ativado 
$configTituloCadastroAtivacao4 = "Ativa��o 04"; 

//Filtros gen�ricos.
$habilitarCadastroFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico01Nome = "Filtro 01";
$configCadastroFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico02Nome = "Filtro 02";
$configCadastroFiltroGenerico02CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico03Nome = "Filtro 03";
$configCadastroFiltroGenerico03CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico04Nome = "Filtro 04";
$configCadastroFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico05Nome = "Filtro 05";
$configCadastroFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico06Nome = "Filtro 06";
$configCadastroFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico07Nome = "Filtro 07";
$configCadastroFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico08Nome = "Filtro 08";
$configCadastroFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico09Nome = "Filtro 09";
$configCadastroFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico10Nome = "Filtro 10";
$configCadastroFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico11Nome = "Filtro 11";
$configCadastroFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico12Nome = "Filtro 12";
$configCadastroFiltroGenerico12CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico13Nome = "Filtro 13";
$configCadastroFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico14Nome = "Filtro 14";
$configCadastroFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico15Nome = "Filtro 15";
$configCadastroFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico16Nome = "Filtro 16";
$configCadastroFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico17Nome = "Filtro 17";
$configCadastroFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico18Nome = "Filtro 18";
$configCadastroFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico19Nome = "Filtro 19";
$configCadastroFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico20Nome = "Filtro 20";
$configCadastroFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico21 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico21Nome = "Filtro 21";
$configCadastroFiltroGenerico21CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico22 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico22Nome = "Filtro 22";
$configCadastroFiltroGenerico22CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico23 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico23Nome = "Filtro 23";
$configCadastroFiltroGenerico23CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico24 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico24Nome = "Filtro 24";
$configCadastroFiltroGenerico24CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico25 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico25Nome = "Filtro 25";
$configCadastroFiltroGenerico25CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico26 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico26Nome = "Filtro 26";
$configCadastroFiltroGenerico26CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico27 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico27Nome = "Filtro 27";
$configCadastroFiltroGenerico27CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico28 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico28Nome = "Filtro 28";
$configCadastroFiltroGenerico28CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico29 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico29Nome = "Filtro 29";
$configCadastroFiltroGenerico29CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarCadastroFiltroGenerico30 = 0; //0-desativado | 1-ativado 
$configCadastroFiltroGenerico30Nome = "Filtro 30";
$configCadastroFiltroGenerico30CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares os cadastros ter�o.
$habilitarCadastroIc1 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc1 = "Descri��o 01";
$configCadastroBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc2 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc2 = "Descri��o 02"; 
$configCadastroBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc3 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc3 = "Descri��o 03"; 
$configCadastroBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc4 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc4 = "Descri��o 04"; 
$configCadastroBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc5 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc5 = "Descri��o 05"; 
$configCadastroBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc6 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc6 = "Descri��o 06";
$configCadastroBoxIc6 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc7 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc7 = "Descri��o 07"; 
$configCadastroBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc8 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc8 = "Descri��o 08"; 
$configCadastroBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc9 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc9 = "Descri��o 09"; 
$configCadastroBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc10 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc10 = "Descri��o 10"; 
$configCadastroBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc11 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc11 = "Descri��o 11";
$configCadastroBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroIc12 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc12 = "Descri��o 12"; 
$configCadastroBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc13 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc13 = "Descri��o 13"; 
$configCadastroBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc14 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc14 = "Descri��o 14"; 
$configCadastroBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc15 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc15 = "Descri��o 15"; 
$configCadastroBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc16 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc16 = "Descri��o 16";
$configCadastroBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroIc17 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc17 = "Descri��o 17"; 
$configCadastroBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc18 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc18 = "Descri��o 18"; 
$configCadastroBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc19 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc19 = "Descri��o 19"; 
$configCadastroBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc20 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc20 = "Descri��o 20"; 
$configCadastroBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc21 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc21 = "Descri��o 21";
$configCadastroBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroIc22 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc22 = "Descri��o 22"; 
$configCadastroBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc23 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc23 = "Descri��o 23"; 
$configCadastroBoxIc23 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc24 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc24 = "Descri��o 24"; 
$configCadastroBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc25 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc25 = "Descri��o 25"; 
$configCadastroBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc26 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc26 = "Descri��o 26";
$configCadastroBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroIc27 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc27 = "Descri��o 27"; 
$configCadastroBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc28 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc28 = "Descri��o 28"; 
$configCadastroBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc29 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc29 = "Descri��o 29"; 
$configCadastroBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc30 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc30 = "Descri��o 30"; 
$configCadastroBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc31 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc31 = "Descri��o 31";
$configCadastroBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroIc32 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc32 = "Descri��o 32"; 
$configCadastroBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc33 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc33 = "Descri��o 33"; 
$configCadastroBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc34 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc34 = "Descri��o 34"; 
$configCadastroBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc35 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc35 = "Descri��o 35"; 
$configCadastroBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc36 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc36 = "Descri��o 36";
$configCadastroBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroIc37 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc37 = "Descri��o 37"; 
$configCadastroBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc38 = 0; //0-desativado | 1-ativado
$configTituloCadastroIc38 = "Descri��o 38"; 
$configCadastroBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc39 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc39 = "Descri��o 39"; 
$configCadastroBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroIc40 = 0; //0-desativado | 1-ativado 
$configTituloCadastroIc40 = "Descri��o 40"; 
$configCadastroBoxIc40 = 1; //1 - simples | 2 - multilinha


//Tipos de Usu�rios.
$configIdCadastroCliente = 0; //N�mero id indicado pela tabela de manuten��o - tipo de cadastro (qualquer cliente que compre produto).
$configIdCadastroUsuario = 3480; //N�mero id indicado pela tabela de manuten��o - tipo de cadastro (tem acesso a algumas fun��es do site, seja ele pago ou n�o).
$configIdCadastroUsuario2 = 3481;
$configIdCadastroUsuario3 = 3771;
$configIdCadastroUsuario4 = 3772;
$configIdCadastroUsuario5 = 3773;
$configIdCadastroUsuarioVendedor = 0; //N�mero id indicado pela tabela de manuten��o - tipo de cadastro (pode vender produtos no site, independentemente do valor ir direto para ele ou para o sistema geral).
$configIdCadastroUsuarioRH = 0; //N�mero id indicado pela tabela de manuten��o - tipo de cadastro (acesso a edi��o de fun��es ligadas a RH).
$configIdCadastroAssinante = 0; //N�mero id indicado pela tabela de manuten��o - tipo de cadastro.
$configIdCadastroSimples = 0; //N�mero id indicado pela tabela de manuten��o - tipo de cadastro (acesso simples para usu�rio como newsletters, entre outros).

//Formul�rios de cadastro (frontend).
$configCadastroFormularioCamposCliente = "nome,data_nascimento,cpf_,rg_,endereco_principal,endereco_numero_principal,endereco_complemento_principal,bairro_principal,cidade_principal,estado_principal,cep_principal,email_principal,tel_principal,cel_principal,senha,ativacao_mala_direta";
$configCadastroFormularioCamposUsuario = "";
$configCadastroFormularioCamposUsuarioVendedor = "";
$configCadastroFormularioCamposUsuarioRH = "";
$configCadastroFormularioCamposAssinante = "";
$configCadastroFormularioCamposSimples = "atividades,nome,data_nascimento,cpf_,rg_,razao_social,cnpj_,i_municipal,i_estadual,endereco_principal,endereco_numero_principal,endereco_complemento_principal,bairro_principal,cidade_principal,estado_principal,pais_principal,cep_principal,ids_cadastro_filtro_generico01,ids_cadastro_filtro_generico02,email_principal,tel_principal,cel_principal,email_principal,senha";

$configCadastroFormularioCamposAtividades = "";
//$configCadastroFormularioCamposAtividades .= "3544;nome,data_nascimento,cpf_;";

/*
tipo,atividades
nome,data_nascimento,cpf_,rg_,endereco_principal,endereco_numero_principal,endereco_complemento_principal,bairro_principal,cidade_principal,estado_principal,cep_principal,email_principal,tel_principal,cel_principal,fax_principal,senha
razao_social,nome_fantasia,cnpj_,i_municipal,i_estadual
ids_cadastro_filtro_generico01,ids_cadastro_filtro_generico02,ids_cadastro_filtro_generico03,ids_cadastro_filtro_generico04,ids_cadastro_filtro_generico05,ids_cadastro_filtro_generico06,ids_cadastro_filtro_generico07,ids_cadastro_filtro_generico08,ids_cadastro_filtro_generico09,ids_cadastro_filtro_generico10,
ids_cadastro_filtro_generico11,ids_cadastro_filtro_generico12,ids_cadastro_filtro_generico13,ids_cadastro_filtro_generico14,ids_cadastro_filtro_generico15,ids_cadastro_filtro_generico16,ids_cadastro_filtro_generico17,ids_cadastro_filtro_generico18,ids_cadastro_filtro_generico19,ids_cadastro_filtro_generico20,
ids_cadastro_filtro_generico21,ids_cadastro_filtro_generico22,ids_cadastro_filtro_generico23,ids_cadastro_filtro_generico24,ids_cadastro_filtro_generico25,ids_cadastro_filtro_generico26,ids_cadastro_filtro_generico27,ids_cadastro_filtro_generico28,ids_cadastro_filtro_generico29,ids_cadastro_filtro_generico30,
ids_cadastro_filtro_generico31,ids_cadastro_filtro_generico32,ids_cadastro_filtro_generico33,ids_cadastro_filtro_generico34,ids_cadastro_filtro_generico35,ids_cadastro_filtro_generico36,ids_cadastro_filtro_generico37,ids_cadastro_filtro_generico38,ids_cadastro_filtro_generico39,ids_cadastro_filtro_generico40
informacao_complementar1,informacao_complementar2,informacao_complementar3,informacao_complementar4,informacao_complementar5,informacao_complementar6,informacao_complementar7,informacao_complementar8,informacao_complementar9,informacao_complementar10,informacao_complementar11,informacao_complementar12,informacao_complementar13,informacao_complementar14,informacao_complementar15,informacao_complementar16,informacao_complementar17,informacao_complementar18,informacao_complementar19,informacao_complementar20,informacao_complementar21,informacao_complementar22,informacao_complementar23,informacao_complementar24,informacao_complementar25,informacao_complementar26,informacao_complementar27,informacao_complementar28,informacao_complementar29,informacao_complementar30,informacao_complementar31,informacao_complementar32,informacao_complementar33,informacao_complementar34,informacao_complementar35,informacao_complementar36,informacao_complementar37,informacao_complementar38,informacao_complementar39,informacao_complementar40
data1,data2,data3,data4,data5,data6,data7,data8,data9,data10
arquivo1,arquivo2,arquivo3,arquivo4,arquivo5,
termo
nome,data_nascimento,sexo,pf_pj,cpf_,rg_,informacao_complementar1,razao_social,nome_fantasia,cnpj_,i_municipal,i_estadual,endereco_principal,endereco_numero_principal,endereco_complemento_principal,bairro_principal,cidade_principal,estado_principal,cep_principal,email_principal,tel_principal,cel_principal,fax_principal,site_principal,senha
nome,data_nascimento,bairro_principal,cidade_principal,estado_principal,email_principal,tel_principal,cel_principal
nome,data_nascimento,email_principal,tel_principal,cel_principal,email_principal,senha
nome,sexo,data_nascimento,altura,peso,email_principal,senha
nome,sexo,data_nascimento,email_principal,senha (rede social)
nome,data_nascimento,email_principal,cel_principal,senha,ativacao_mala_direta (conte�do adulto)
pf_pj,razao_social,nome_fantasia,cnpj_,i_municipal,i_estadual,endereco_principal,endereco_numero_principal,endereco_complemento_principal,bairro_principal,cidade_principal,estado_principal,cep_principal,email_principal,tel_principal,cel_principal,fax_principal,site_principal,senha
*/


//Site.
$habilitarCadastroVerificarTermo = 0; //0-desativado | 1-ativado
$configIdTermoPort = "1770"; //id da categoria de conte�do

$configCadastroCamposObrigatorios = "nome,cpf_,endereco_principal,cidade_principal,estado_principal,email_principal,senha";
//$configCadastroCamposObrigatoriosNomes = "Nome,CPF,Endere�o,Cidade,Estado,e-mail,Senha";

//Recursos para envio de confirma��o autom�tica de e-mail.
$configIdConteudoEnviarConfirmacao = "1772"; //id da categoria de conte�do
$habilitarCadastroConfirmacaoAtivacaoEmail = 0; //0-desativado | 1-ativado
$habilitarCadastroEnvioEmailAdministracao = 0; //0-desativado | 1-ativado


//Pagina��o.
$habilitarCadastroSitePaginacaoSimples = 0; //0-desativado | 1-ativado
$habilitarCadastroSitePaginacaoQtdPaginas = 1; //0-desativado | 1-ativado-->
$configCadastroSitePaginacaoNRegistros = 5;
//**************************************************************************************


//Cadastro Administra��o - Configura��es dos recursos gerais.
//**************************************************************************************
//Configura��o de recursos de com�rcio eletr�nio.
$habilitarAdministrarECommerce = 0; //0-desativado | 1-ativado 
$habilitarAdministrarCadastroFluxo = 0; //0-desativado | 1-ativado 

//CRM
$habilitarAdministrarCadastroHistorico = 0; //0-desativado | 1-ativado 
$habilitarAdministrarCadastroContatos = 0; //0-desativado | 1-ativado 
$habilitarAdministrarCadastroTarefas = 0; //0-desativado | 1-ativado 
$habilitarAdministrarCadastroContasBancarias = 0; //0-desativado | 1-ativado 

//Configura��o dos recursos automatizados.
$configIdCategoriasConteudoModelo = "-1"; //id do registro de conte�do deste �tem (-1 - desativa)
//**************************************************************************************


//Cadastro Administra��o - Pedidos.
//**************************************************************************************
$configClassificacaoPedidos = "data_pedido desc"; //id asc | id desc | data_pedido asc | data_pedido desc
$configClassificacaoItens = "data_pedido desc"; //descricao | valor_unitario desc | valor_unitario asc | id_item | cod_item | id

//Pagina��o.
$habilitarPedidosSistemaPaginacao = 0; //0-desativado | 1-ativado
$habilitarPedidosSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configPedidosSistemaPaginacaoNRegistros = 5;

$habilitarPedidosValorDesconto = 0; //0-desativado | 1-ativado 
$habilitarPedidosValorAcrescimo = 0; //0-desativado | 1-ativado 

$habilitarAdministrarPedidosPeso = 0; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosFrete = 0; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosDataPagamento = 0; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosDataEntrega = 0; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosTipoEntrega = 0; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosDataValidade = 0; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosStatus = 0; //0-desativado | 1-ativado 

$habilitarEdicaoPedidosData = 0; //0-desativado | 1-ativado 
$habilitarEdicaoPedidosEnderecoEntrega = 0; //0-desativado | 1-ativado 
$configEdicaoPedidosTipoPagamento = 0; //0-desativado | 1-ativado 

$habilitarPedidosVinculo1 = 0; //0-desativado | 1-ativado
$configPedidosVinculo1Nome = "V�nculo 01";
$configPedidosVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPedidosVinculo1 = "3571"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPedidosVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoPedidosVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarPedidosVinculo2 = 0; //0-desativado | 1-ativado
$configPedidosVinculo2Nome = "V�nculo 02";
$configPedidosVinculo2Metodo = 2; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPedidosVinculo2 = "0"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPedidosVinculo2 = "3483"; //id do tipo de cadastro
$configClassificacaoPedidosVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarPedidosVinculo3 = 0; //0-desativado | 1-ativado
$configPedidosVinculo3Nome = "V�nculo 03";
$configPedidosVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPedidosVinculo3 = "0"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPedidosVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoPedidosVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarPedidosVinculo4 = 0; //0-desativado | 1-ativado
$configPedidosVinculo4Nome = "V�nculo 04";
$configPedidosVinculo4Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPedidosVinculo4 = "3572"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPedidosVinculo4 = "0"; //id do tipo de cadastro
$configClassificacaoPedidosVinculo4 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarPedidosVinculo5 = 0; //0-desativado | 1-ativado
$configPedidosVinculo5Nome = "V�nculo 05";
$configPedidosVinculo5Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPedidosVinculo5 = "3572"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPedidosVinculo5 = "0"; //id do tipo de cadastro
$configClassificacaoPedidosVinculo5 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

//Filtros gen�ricos.
$habilitarPedidosFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico01Nome = "Filtro 01";
$configPedidosFiltroGenerico01CaixaSelecao = 3; //3 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico02Nome = "Filtro 02";
$configPedidosFiltroGenerico02CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico03Nome = "Filtro 03";
$configPedidosFiltroGenerico03CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico04Nome = "Filtro 04";
$configPedidosFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico05Nome = "Filtro 05";
$configPedidosFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico06Nome = "Filtro 06";
$configPedidosFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico07Nome = "Filtro 07";
$configPedidosFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico08Nome = "Filtro 08";
$configPedidosFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico09Nome = "Filtro 09";
$configPedidosFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPedidosFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configPedidosFiltroGenerico10Nome = "Filtro 10";
$configPedidosFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

//Defini��o de quantas e quais informa��es complementares para o pedido.
$habilitarPedidosIc1 = 0; //0-desativado | 1-ativado 
$configPedidosTituloIc1 = "Descri��o 01";
$configPedidosBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarPedidosIc2 = 0; //0-desativado | 1-ativado 
$configPedidosTituloIc2 = "Descri��o 02"; 
$configPedidosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosIc3 = 0; //0-desativado | 1-ativado
$configPedidosTituloIc3 = "Descri��o 03"; 
$configPedidosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosIc4 = 0; //0-desativado | 1-ativado 
$configPedidosTituloIc4 = "Descri��o 04"; 
$configPedidosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosIc5 = 0; //0-desativado | 1-ativado 
$configPedidosTituloIc5 = "Descri��o 05"; 
$configPedidosBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosHistorico = 0; //0-desativado | 1-ativado
$habilitarPedidosTarefas = 0; //0-desativado | 1-ativado

$habilitarPedidosEnvioVoucherManual = 0; //0-desativado | 1-ativado 
$configIdPedidosEnvioVoucher = 0; //id do registro de conte�do deste �tem
$habilitarPedidosVoucherImpressao = 0; //0-desativado | 1-ativado 

//Itens.
$habilitarPedidosItensValorDesconto = 0; //0-desativado | 1-ativado 
$habilitarPedidosItensValorAcrescimo = 0; //0-desativado | 1-ativado 

$habilitarPedidosItensHistorico = 0; //0-desativado | 1-ativado


//Configura��o para o registro parcelas de pagamento do pedido.
//----------
$habilitarPedidosParcelas = 0; //0-desativado | 1-ativado 
$configClassificacaoPedidosParcelas = "data_vencimento asc"; //n_parcela asc | n_parcela desc | data_vencimento asc | data_vencimento desc

$habilitarPedidosParcelasValorDesconto = 0; //0-desativado | 1-ativado 
$habilitarPedidosParcelasValorAcrescimo = 0; //0-desativado | 1-ativado 
$habilitarPedidosParcelasValorTotal = 0; //0-desativado | 1-ativado 
$habilitarPedidosParcelasTipo = 0; //0-desativado | 1-ativado 
$habilitarPedidosParcelasStatus = 0; //0-desativado | 1-ativado 

//Defini��o de quantas e quais informa��es complementares para as parcelas de pedidos.
$habilitarPedidosParcelasIc1 = 0; //0-desativado | 1-ativado 
$configPedidosParcelasTituloIc1 = "Descri��o 01"; 
$configPedidosParcelasBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosParcelasIc2 = 0; //0-desativado | 1-ativado 
$configPedidosParcelasTituloIc2 = "Descri��o 02"; 
$configPedidosParcelasBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosParcelasIc3 = 0; //0-desativado | 1-ativado 
$configPedidosParcelasTituloIc3 = "Descri��o 03"; 
$configPedidosParcelasBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosParcelasIc4 = 0; //0-desativado | 1-ativado 
$configPedidosParcelasTituloIc4 = "Descri��o 04"; 
$configPedidosParcelasBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarPedidosParcelasIc5 = 0; //0-desativado | 1-ativado 
$configPedidosParcelasTituloIc5 = "Descri��o 05"; 
$configPedidosParcelasBoxIc5 = 1; //1 - simples | 2 - multilinha
//----------

$habilitarPedidosParcelasHistorico = 0; //0-desativado | 1-ativado 
$habilitarPedidosParcelasTarefas = 0; //0-desativado | 1-ativado 


//Cobran�a avulsa pelo sistema.
$habilitarAdministrarPedidosCobrancaAvulsa = 0; //0-desativado | 1-ativado 
//$habilitarCadastroFrontendPedidosCobrancaAvulsa = 1; //0-desativado | 1-ativado 
$habilitarAdministrarPedidosCobrancaMultipla = 0; //0-desativado | 1-ativado 

$habilitarPedidosInclusaoItemAvulso = 0; //0-desativado | 1-ativado 
$configClassificacaoPedidosCobrancaAvulsaProdutos = "produto"; //valor | produto | cod_produto
$configClassificacaoPedidosCobrancaAvulsaAfilicacoes = "afiliacao"; //id | afiliacoes | n_classificacao | valor asc | valor desc


//Site.
$habilitarPedidosSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarPedidosSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configPedidosSitePaginacaoNRegistros = 10;
//**************************************************************************************


//Cadastro Administra��o - Or�amentos.
//**************************************************************************************
$habilitarCadastroOrcamento = 0; //0-desativado | 1-ativado 
$configClassificacaoOrcamentos = "data_orcamento desc"; //id asc | id desc | data_orcamento asc | data_orcamento desc


//Pagina��o.
$habilitarOrcamentosSistemaPaginacao = 0; //0-desativado | 1-ativado
$habilitarOrcamentosSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configOrcamentosSistemaPaginacaoNRegistros = 5;


$habilitarOrcamentosPeso = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosFrete = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosDataEntrega = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosTipoEntrega = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosStatus = 0; //0-desativado | 1-ativado 

$habilitarOrcamentosEdicaoData = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosEdicaoValorTotal = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosValorReferencia = 0; //0-desativado | 1-ativado (para que os valores fiquei atualizados de acordo com os itens selecionados - n�o implementado ainda)
$habilitarOrcamentosEnvio = 0; //0-desativado | 1-ativado 


//Defini��o de quantas e quais informa��es complementares para o pedido.
$habilitarOrcamentosIc1 = 0; //0-desativado | 1-ativado 
$configOrcamentosTituloIc1 = "Descri��o 01";
$configOrcamentosBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarOrcamentosIc2 = 0; //0-desativado | 1-ativado 
$configOrcamentosTituloIc2 = "Descri��o 02"; 
$configOrcamentosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosIc3 = 0; //0-desativado | 1-ativado
$configOrcamentosTituloIc3 = "Descri��o 03"; 
$configOrcamentosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosIc4 = 0; //0-desativado | 1-ativado 
$configOrcamentosTituloIc4 = "Descri��o 04"; 
$configOrcamentosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosIc5 = 0; //0-desativado | 1-ativado 
$configOrcamentosTituloIc5 = "Descri��o 05"; 
$configOrcamentosBoxIc5 = 1; //1 - simples | 2 - multilinha

//Vinculo de produtos.
$habilitarOrcamentosProdutosVinculosMultiplos = 0;//0-desativado | 1-ativado 
$habilitarOrcamentosProdutosVinculosQuantidade = 0; //0-desativado | 1-ativado 

//Site.
$habilitarOrcamentosSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarOrcamentosSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configOrcamentosSitePaginacaoNRegistros = 5;


//Itens.
$configOrcamentosItens = 0; //0 - desativado | 1 - itens padr�o (refer�ncia) | 2 - itens individualizados
$configClassificacaoOrcamentosItens = "n_classificacao"; //id asc | id desc | item_titulo | n_classificacao

//Configura��o de recursos gerais liberados para registro dos itens.
$habilitarOrcamentosItensNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarOrcamentosItensDescricao = 1; //0-desativado | 1-ativado 
$habilitarOrcamentosItensValor = 1; //0-desativado | 1-ativado 
$habilitarOrcamentosItensValor1 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensValor1Nome = "Nome do Valor 01";
$configOrcamentosItensValor1Moeda = "R$"; //R$ | $
$habilitarOrcamentosItensValor2 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensValor2Nome = "Nome do Valor 02"; 
$configOrcamentosItensValor2Moeda = "R$"; //R$ | $


//Arquivos gen�ricos.
$habilitarOrcamentosItensArquivo1 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo1 = "Arquivo 01"; 
$configOrcamentosItensArquivo1 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo2 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo2 = "Arquivo 02"; 
$configOrcamentosItensArquivo2 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo3 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo3 = "Arquivo 03"; 
$configOrcamentosItensArquivo3 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo4 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo4 = "Arquivo 04"; 
$configOrcamentosItensArquivo4 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo5 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo5 = "Arquivo 05"; 
$configOrcamentosItensArquivo5 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo6 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo6 = "Arquivo 06"; 
$configOrcamentosItensArquivo6 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo7 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo7 = "Arquivo 07"; 
$configOrcamentosItensArquivo7 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo8 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo8 = "Arquivo 08"; 
$configOrcamentosItensArquivo8 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo9 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo9 = "Arquivo 09"; 
$configOrcamentosItensArquivo9 = 1; //1 - imagem

$habilitarOrcamentosItensArquivo10 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloArquivo10 = "Arquivo 10"; 
$configOrcamentosItensArquivo10 = 1; //1 - imagem


//Ativa��o gen�ricas.
$habilitarOrcamentosItensAtivacao1 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloAtivacao1 = "Ativa��o 01"; 

$habilitarOrcamentosItensAtivacao2 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloAtivacao2 = "Ativa��o 02"; 


//Datas gen�ricas.
$habilitarOrcamentosItensData1 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloData1 = "Descri��o 01"; 
$configOrcamentosItensTipoCampoData1 = 1; //1 - JQuery DatePicker
$configOrcamentosItensData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarOrcamentosItensData2 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloData2 = "Descri��o 02"; 
$configOrcamentosItensTipoCampoData2 = 1; //1 - JQuery DatePicker
$configOrcamentosItensData2 = 1; //1 - data simples (dia, m�s, ano)

$habilitarOrcamentosItensData3 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloData3 = "Descri��o 03"; 
$configOrcamentosItensTipoCampoData3 = 1; //1 - JQuery DatePicker
$configOrcamentosItensData3 = 1; //1 - data simples (dia, m�s, ano)

$habilitarOrcamentosItensData4 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloData4 = "Descri��o 04"; 
$configOrcamentosItensTipoCampoData4 = 1; //1 - JQuery DatePicker
$configOrcamentosItensData4 = 1; //1 - data simples (dia, m�s, ano)

$habilitarOrcamentosItensData5 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloData5 = "Descri��o 05"; 
$configOrcamentosItensTipoCampoData5 = 1; //1 - JQuery DatePicker
$configOrcamentosItensData5 = 1; //1 - data simples (dia, m�s, ano)


$habilitarOrcamentosItensVinculo1 = 0; //0-desativado | 1-ativado
$configOrcamentosItensVinculo1Nome = "V�nculo 01";
$configOrcamentosItensVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbOrcamentosItensVinculo1 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoOrcamentosItensVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoOrcamentosItensVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarOrcamentosItensVinculo2 = 0; //0-desativado | 1-ativado
$configOrcamentosItensVinculo2Nome = "V�nculo 02";
$configOrcamentosItensVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbOrcamentosItensVinculo2 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoOrcamentosItensVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoOrcamentosItensVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarOrcamentosItensVinculo3 = 0; //0-desativado | 1-ativado
$configOrcamentosItensVinculo3Nome = "V�nculo 03";
$configOrcamentosItensVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbOrcamentosItensVinculo3 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoOrcamentosItensVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoOrcamentosItensVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia


//Defini��o de quantas e quais informa��es complementares os itens de or�amento ter�o.
$habilitarOrcamentosItensIc1 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc1 = "Descri��o 01";
$configOrcamentosItensBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc2 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc2 = "Descri��o 02"; 
$configOrcamentosItensBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc3 = 0; //0-desativado | 1-ativado
$configOrcamentosItensTituloIc3 = "Descri��o 03"; 
$configOrcamentosItensBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc4 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc4 = "Descri��o 04"; 
$configOrcamentosItensBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc5 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc5 = "Descri��o 05"; 
$configOrcamentosItensBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc6 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc6 = "Descri��o 06";
$configOrcamentosItensBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc7 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc7 = "Descri��o 07"; 
$configOrcamentosItensBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc8 = 0; //0-desativado | 1-ativado
$configOrcamentosItensTituloIc8 = "Descri��o 08"; 
$configOrcamentosItensBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc9 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc9 = "Descri��o 09"; 
$configOrcamentosItensBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensIc10 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensTituloIc10 = "Descri��o 10"; 
$configOrcamentosItensBoxIc10 = 1; //1 - simples | 2 - multilinha


//Vinculo de produtos.
$habilitarOrcamentosItensProdutosVinculosMultiplos = 1;//0-desativado | 1-ativado 
$habilitarOrcamentosItensICProdutosVinculosMultiplos = 0;//0-desativado | 1-ativado 
$habilitarOrcamentosItensProdutosVinculosQuantidade = 0; //0-desativado | 1-ativado 

//Defini��o de quantas e quais informa��es complementares os v�nculos ter�o.
$habilitarOrcamentosItensProdutosVinculosIc1 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensProdutosVinculosTituloIc1 = "Descri��o 01";
$configOrcamentosItensProdutosVinculosBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensProdutosVinculosIc2 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensProdutosVinculosTituloIc2 = "Descri��o 02"; 
$configOrcamentosItensProdutosVinculosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensProdutosVinculosIc3 = 0; //0-desativado | 1-ativado
$configOrcamentosItensProdutosVinculosTituloIc3 = "Descri��o 03"; 
$configOrcamentosItensProdutosVinculosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensProdutosVinculosIc4 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensProdutosVinculosTituloIc4 = "Descri��o 04"; 
$configOrcamentosItensProdutosVinculosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarOrcamentosItensProdutosVinculosIc5 = 0; //0-desativado | 1-ativado 
$configOrcamentosItensProdutosVinculosTituloIc5 = "Descri��o 05"; 
$configOrcamentosItensProdutosVinculosBoxIc5 = 1; //1 - simples | 2 - multilinha


//Fichas.
$habilitarOrcamentoFichas = 0; //0-desativado | 1-ativado 
$configClassificacaoOrcamentosFichas = "data_ficha desc"; //id asc | data_ficha desc | data_ficha asc | titulo

//Configura��o de recursos gerais liberados para registro dos itens.
$habilitarOrcamentosFichasTitulo = 1; //0-desativado | 1-ativado 

$habilitarOrcamentosFichasHistorico = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Hist�rico - configura��o dos recursos.
//**************************************************************************************
$configClassificacaoCadastroHistorico = "data_historico desc"; //op��es: id asc | id desc | data_historico desc | data_historico asc
$configCadastroHistoricoDataEdicao = 1; //0-desativado | 1-ativado

$habilitarCadastroHistoricoUsuario = 1; //0-desativado | 1-ativado
$habilitarCadastroHistoricoStatus = 0; //0-desativado | 1-ativado
$habilitarCadastroHistoricoVisualizarProtocolo = 0; //0-desativado | 1-ativado


//Intera��o.
$habilitarCadastroHistoricoInteracao = 0; //0-desativado | 1-ativado | fun��o para habilitar a intera��o de cada registro de hist�rico
$configClassificacaoCadastroHistoricoInteracao = "data_interacao desc"; //op��es: id asc | id desc | data_interacao desc | data_interacao asc | assunto
$habilitarCadastroHistoricoInteracaoAssunto = 0; //0-desativado | 1-ativado

$habilitarCadastroHistoricoEnvioAutomatico = 0; //0-desativado | 1-ativado
$habilitarCadastroHistoricoEnvioAutomaticoCopia = 0; //0-desativado | 1-ativado

//Datas gen�ricas.
$habilitarHistoricoData1 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoData1 = "Sa�da"; 
$configTipoCampoHistoricoData1 = 1; //1 - JQuery DatePicker
$configHistoricoData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarHistoricoData2 = 0; //0-desativado | 1-ativado 
$configTituloHistoricoData2 = "Data 02"; 
$configTipoCampoHistoricoData2 = 1; //1 - JQuery DatePicker
$configHistoricoData2 = 1; //1 - data simples (dia, m�s, ano)

$habilitarHistoricoData3 = 0; //0-desativado | 1-ativado 
$configTituloHistoricoData3 = "Data 03"; 
$configTipoCampoHistoricoData3 = 1; //1 - JQuery DatePicker
$configHistoricoData3 = 1; //1 - data simples (dia, m�s, ano)

$habilitarHistoricoData4 = 0; //0-desativado | 1-ativado 
$configTituloHistoricoData4 = "Data 04"; 
$configTipoCampoHistoricoData4 = 1; //1 - JQuery DatePicker
$configHistoricoData4 = 1; //1 - data simples (dia, m�s, ano)

$habilitarHistoricoData5 = 0; //0-desativado | 1-ativado 
$configTituloHistoricoData5 = "Data 05"; 
$configTipoCampoHistoricoData5 = 1; //1 - JQuery DatePicker
$configHistoricoData5 = 1; //1 - data simples (dia, m�s, ano)

$habilitarHistoricoVinculo1 = 1; //0-desativado | 1-ativado
$configHistoricoVinculo1Nome = "T�cnico Respons�vel"; //estado de conserva��o
$configHistoricoVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo1 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoHistoricoVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo2 = 1; //0-desativado | 1-ativado
$configHistoricoVinculo2Nome = "T�cnico Respons�vel"; //tratamento 01
$configHistoricoVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo2 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoHistoricoVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo3 = 1; //0-desativado | 1-ativado
$configHistoricoVinculo3Nome = "T�cnico Respons�vel"; //acondicionamento
$configHistoricoVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo3 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoHistoricoVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo4 = 1; //0-desativado | 1-ativado
$configHistoricoVinculo4Nome = "T�cnico Respons�vel"; //descri��o
$configHistoricoVinculo4Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo4 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo4 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo4 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo5 = 1; //0-desativado | 1-ativado
$configHistoricoVinculo5Nome = "T�cnico Respons�vel - Desmonte do Livro"; //tratamento 02
$configHistoricoVinculo5Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo5 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo5 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo5 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo6 = 1; //0-desativado | 1-ativado
$configHistoricoVinculo6Nome = "T�cnico Respons�vel"; //fotos
$configHistoricoVinculo6Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo6 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo6 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo6 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo7 = 0; //0-desativado | 1-ativado
$configHistoricoVinculo7Nome = "V�nculo 04";
$configHistoricoVinculo7Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo7 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo7 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo7 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo8 = 0; //0-desativado | 1-ativado
$configHistoricoVinculo8Nome = "V�nculo 04";
$configHistoricoVinculo8Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo8 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo8 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo8 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo9 = 0; //0-desativado | 1-ativado
$configHistoricoVinculo9Nome = "V�nculo 04";
$configHistoricoVinculo9Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo9 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo9 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo9 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarHistoricoVinculo10 = 0; //0-desativado | 1-ativado
$configHistoricoVinculo10Nome = "V�nculo 04";
$configHistoricoVinculo10Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbHistoricoVinculo10 = "3479"; //id da categoria (0 = todos cadastro)
$configIdTbTipoHistoricoVinculo10 = "0"; //id do tipo de Veiculos
$configClassificacaoHistoricoVinculo10 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

//Filtros gen�ricos.
$habilitarHistoricoFiltroGenerico01 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico01Nome = "Montagem / Embalagem";
$configHistoricoFiltroGenerico01CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico02 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico02Nome = "Material";
$configHistoricoFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico03 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico03Nome = "Tipo de Tratamento";
$configHistoricoFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico04 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico04Nome = "Higieniza��o";
$configHistoricoFiltroGenerico04CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico05 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico05Nome = "Forma de Aplica��o";
$configHistoricoFiltroGenerico05CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico06 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico06Nome = "�gua";
$configHistoricoFiltroGenerico06CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico07 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico07Nome = "T�cnica";
$configHistoricoFiltroGenerico07CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico08 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico08Nome = "Banhos Desacidifica��o";
$configHistoricoFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico09 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico09Nome = "Tipo";
$configHistoricoFiltroGenerico09CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico10 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico10Nome = "T�cnica";
$configHistoricoFiltroGenerico10CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico11 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico11Nome = "Produto";
$configHistoricoFiltroGenerico11CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico12 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico12Nome = "Clareante";
$configHistoricoFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico13 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico13Nome = "Aplica��o";
$configHistoricoFiltroGenerico13CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico14 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico14Nome = "Neutraliza��o";
$configHistoricoFiltroGenerico14CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico15 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico15Nome = "Aplica��o";
$configHistoricoFiltroGenerico15CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico16 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico16Nome = "T�cnica";
$configHistoricoFiltroGenerico16CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico17 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico17Nome = "Material";
$configHistoricoFiltroGenerico17CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico18 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico18Nome = "T�cnica";
$configHistoricoFiltroGenerico18CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico19 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico19Nome = "Processo";
$configHistoricoFiltroGenerico19CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico20 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico20Nome = "Material";
$configHistoricoFiltroGenerico20CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico21 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico21Nome = "Tipo";
$configHistoricoFiltroGenerico21CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico22 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico22Nome = "Revestimento";
$configHistoricoFiltroGenerico22CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico23 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico23Nome = "Lombada";
$configHistoricoFiltroGenerico23CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico24 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico24Nome = "Guardas";
$configHistoricoFiltroGenerico24CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico25 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico25Nome = "Tapas";
$configHistoricoFiltroGenerico25CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico26 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico26Nome = "Nervos";
$configHistoricoFiltroGenerico26CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico27 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico27Nome = "Cabeceado";
$configHistoricoFiltroGenerico27CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico28 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico28Nome = "Costura";
$configHistoricoFiltroGenerico28CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico29 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico29Nome = "Fechos";
$configHistoricoFiltroGenerico29CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico30 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico30Nome = "Capa";
$configHistoricoFiltroGenerico30CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico31 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico31Nome = "Tipo";
$configHistoricoFiltroGenerico31CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico32 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico32Nome = "Material";
$configHistoricoFiltroGenerico32CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico33 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico33Nome = "Material";
$configHistoricoFiltroGenerico33CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico34 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico34Nome = "Nervos";
$configHistoricoFiltroGenerico34CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico35 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico35Nome = "Etiqueta";
$configHistoricoFiltroGenerico35CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico36 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico36Nome = "Texto";
$configHistoricoFiltroGenerico36CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico37 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico37Nome = "Suporte";
$configHistoricoFiltroGenerico37CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico38 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico38Nome = "Cabeceado";
$configHistoricoFiltroGenerico38CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico39 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico39Nome = "Tapa";
$configHistoricoFiltroGenerico39CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico40 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico40Nome = "Guardas";
$configHistoricoFiltroGenerico40CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico41 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico41Nome = "Costura";
$configHistoricoFiltroGenerico41CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico42 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico42Nome = "Corte";
$configHistoricoFiltroGenerico42CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico43 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico43Nome = "Outros";
$configHistoricoFiltroGenerico43CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico44 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico44Nome = "Revestimento";
$configHistoricoFiltroGenerico44CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico45 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico45Nome = "Grau de Integridade";
$configHistoricoFiltroGenerico45CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico46 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico46Nome = "Lombada";
$configHistoricoFiltroGenerico46CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico47 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico47Nome = "Grau de Integridade";
$configHistoricoFiltroGenerico47CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico48 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico48Nome = "Cabeceado";
$configHistoricoFiltroGenerico48CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico49 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico49Nome = "Fechos";
$configHistoricoFiltroGenerico49CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico50 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico50Nome = "Tipo";
$configHistoricoFiltroGenerico50CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico51 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico51Nome = "Material";
$configHistoricoFiltroGenerico51CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico52 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico52Nome = "Suporte";
$configHistoricoFiltroGenerico52CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico53 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico53Nome = "Grau de Integridade";
$configHistoricoFiltroGenerico53CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico54 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico54Nome = "Costura";
$configHistoricoFiltroGenerico54CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico55 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico55Nome = "Grau de Integridade";
$configHistoricoFiltroGenerico55CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico56 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico56Nome = "Tipo";
$configHistoricoFiltroGenerico56CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico57 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico57Nome = "Material";
$configHistoricoFiltroGenerico57CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico58 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico58Nome = "Prote��o Frontal";
$configHistoricoFiltroGenerico58CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico59 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico59Nome = "Prote��o do Verso";
$configHistoricoFiltroGenerico59CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico60 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico60Nome = "Montagem / Embalagem";
$configHistoricoFiltroGenerico60CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico61 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico61Nome = "Passe-partout";
$configHistoricoFiltroGenerico61CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico62 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico62Nome = "Estado de Conserva��o";
$configHistoricoFiltroGenerico62CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico63 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico63Nome = "Diagn�stico";
$configHistoricoFiltroGenerico63CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico64 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico64Nome = "Material";
$configHistoricoFiltroGenerico64CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico65 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico65Nome = "Tipo de Moldura";
$configHistoricoFiltroGenerico65CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico66 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico66Nome = "Prote��o Frontal";
$configHistoricoFiltroGenerico66CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico67 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico67Nome = "Prote��o do Verso";
$configHistoricoFiltroGenerico67CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico68 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico68Nome = "Tipo de Montagem";
$configHistoricoFiltroGenerico68CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico69 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico69Nome = "Tipo";
$configHistoricoFiltroGenerico69CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico70 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico70Nome = "Material";
$configHistoricoFiltroGenerico70CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico71 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico71Nome = "Material";
$configHistoricoFiltroGenerico71CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico72 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico72Nome = "Palavras-Chave";
$configHistoricoFiltroGenerico72CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico73 = 1; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico73Nome = "Montagem / embalagem em que o livro chegou";
$configHistoricoFiltroGenerico73CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico74 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico74Nome = "Filtro 74";
$configHistoricoFiltroGenerico74CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico75 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico75Nome = "Filtro 75";
$configHistoricoFiltroGenerico75CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico76 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico76Nome = "Filtro 76";
$configHistoricoFiltroGenerico76CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico77 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico77Nome = "Filtro 77";
$configHistoricoFiltroGenerico77CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico78 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico78Nome = "Filtro 78";
$configHistoricoFiltroGenerico78CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico79 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico79Nome = "Filtro 79";
$configHistoricoFiltroGenerico79CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarHistoricoFiltroGenerico80 = 0; //0-desativado | 1-ativado 
$configHistoricoFiltroGenerico80Nome = "Filtro 80";
$configHistoricoFiltroGenerico80CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

//Defini��o de quantas e quais informa��es complementares os hist�ricos ter�o.
$habilitarHistoricoIc1 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc1 = "Dimens�es";
$configHistoricoBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc2 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc2 = "Informa��es Adicionais"; 
$configHistoricoBoxIc2 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc3 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc3 = "Fumiga��o"; 
$configHistoricoBoxIc3 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc4 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc4 = "Descri��o"; 
$configHistoricoBoxIc4 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc5 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc5 = "Remo��o de Adesivos"; 
$configHistoricoBoxIc5 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc6 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc6 = "Observa��es"; //Consolida��o da Imagem / Emuls�o Fotogr�fica - Descri��o
$configHistoricoBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc7 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc7 = "Produto"; 
$configHistoricoBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc8 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc8 = "Sol�vel em"; 
$configHistoricoBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc9 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc9 = "Descri��o"; 
$configHistoricoBoxIc9 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc10 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc10 = "pH Antes do Tratamento"; 
$configHistoricoBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc11 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc11 = "pH Ap�s tratamento";
$configHistoricoBoxIc11 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc12 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc12 = "Espessura Antes do Tratamento"; 
$configHistoricoBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc13 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc13 = "Espessura Ap�s Tratamento"; 
$configHistoricoBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc14 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc14 = "Descri��o"; 
$configHistoricoBoxIc14 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc15 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc15 = "Descri��o"; 
$configHistoricoBoxIc15 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc16 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc16 = "Reencolagem";
$configHistoricoBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc17 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc17 = "Descri��o"; 
$configHistoricoBoxIc17 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc18 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc18 = "Descri��o"; 
$configHistoricoBoxIc18 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc19 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc19 = "Descri��o"; 
$configHistoricoBoxIc19 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc20 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc20 = "Descri��o"; 
$configHistoricoBoxIc20 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc21 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc21 = "Informa��es Adicionais do Tratamento";
$configHistoricoBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc22 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc22 = "Descri��o"; 
$configHistoricoBoxIc22 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc23 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc23 = "Descri��o"; 
$configHistoricoBoxIc23 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc24 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc24 = "Descri��o"; 
$configHistoricoBoxIc24 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc25 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc25 = "Descri��o"; 
$configHistoricoBoxIc25 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc26 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc26 = "Descri��o";
$configHistoricoBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc27 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc27 = "Descri��o"; 
$configHistoricoBoxIc27 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc28 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc28 = "Descri��o"; 
$configHistoricoBoxIc28 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc29 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc29 = "Descri��o"; 
$configHistoricoBoxIc29 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc30 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc30 = "Descri��o"; 
$configHistoricoBoxIc30 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc31 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc31 = "Cor";
$configHistoricoBoxIc31 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc32 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc32 = "Montagem"; 
$configHistoricoBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc33 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc33 = "Adesivo"; 
$configHistoricoBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc34 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc34 = "Cor"; 
$configHistoricoBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc35 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc35 = "Tipo"; 
$configHistoricoBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc36 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc36 = "N�mero";
$configHistoricoBoxIc36 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc37 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc37 = "Material"; 
$configHistoricoBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc38 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc38 = "Cor"; 
$configHistoricoBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc39 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc39 = "Informa��es Adicionais"; 
$configHistoricoBoxIc39 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc40 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc40 = "Linha"; 
$configHistoricoBoxIc40 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc41 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc41 = "N. de Nervos / Material";
$configHistoricoBoxIc41 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc42 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc42 = "Refor�o"; 
$configHistoricoBoxIc42 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc43 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc43 = "Informa��es Adicionais"; 
$configHistoricoBoxIc43 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc44 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc44 = "Informa��es Adicionais"; 
$configHistoricoBoxIc44 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc45 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc45 = "Dimens�es"; 
$configHistoricoBoxIc45 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc46 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc46 = "Descri��o do Estado de Conserva��o do Miolo";
$configHistoricoBoxIc46 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc47 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc47 = "Descri��o - Costura"; 
$configHistoricoBoxIc47 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc48 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc48 = "Descri��o do Acondicionamento em que o livro Chegou"; 
$configHistoricoBoxIc48 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc49 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc49 = "Dimens�es"; 
$configHistoricoBoxIc49 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc50 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc50 = "Descri��o"; 
$configHistoricoBoxIc50 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc51 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc51 = "Descri��o do Estado de Conserva��o";
$configHistoricoBoxIc51 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc52 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc52 = "Descri��o da Montagem"; 
$configHistoricoBoxIc52 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc53 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc53 = "Remo��o de Manchas"; 
$configHistoricoBoxIc53 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc54 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc54 = "Informa��es Adicionais"; 
$configHistoricoBoxIc54 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc55 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc55 = "Dimens�es"; 
$configHistoricoBoxIc55 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc56 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc56 = "Descri��o da Montagem em que o Material Chegou";
$configHistoricoBoxIc56 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc57 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc57 = "Dimens�es"; 
$configHistoricoBoxIc57 = 1; //1 - simples | 2 - multilinha

$habilitarHistoricoIc58 = 1; //0-desativado | 1-ativado
$configTituloHistoricoIc58 = "Descri��o"; 
$configHistoricoBoxIc58 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc59 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc59 = "Produto"; 
$configHistoricoBoxIc59 = 2; //1 - simples | 2 - multilinha

$habilitarHistoricoIc60 = 1; //0-desativado | 1-ativado 
$configTituloHistoricoIc60 = "Aplica��o"; 
$configHistoricoBoxIc60 = 2; //1 - simples | 2 - multilinha

//recursos dispon�veis para cada registro de hist�rico
//-------------
$habilitarHistoricoFotos = 1; //0-desativado | 1-ativado 
$habilitarHistoricoVideos = 0; //0-desativado | 1-ativado 
$habilitarHistoricoArquivos = 1; //0-desativado | 1-ativado 
$habilitarHistoricoZip = 0; //0-desativado | 1-ativado 
$habilitarHistoricoSwfs = 0; //0-desativado | 1-ativado 
$habilitarHistoricoConteudo = 0; //0-desativado | 1-ativado 
$habilitarHistoricoConteudoHtml = 0; //0-desativado | 1-ativado 

$habilitarHistoricoForumPostagens = 1; //0-desativado | 1-ativado 
//-------------

//Site (adm).
$configCadastroHistoricoAdmDataEdicao = 0; //0-desativado | 1-ativado

$habilitarHistoricoAdmEdicao = 1; //0-desativado | 1-ativado 
$habilitarHistoricoAdmExclusao = 1; //0-desativado | 1-ativado 
$habilitarHistoricoAdmInteracao = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Tarefas - configura��o dos recursos.
//**************************************************************************************
$configClassificacaoTarefas = "data_tarefa desc"; //op��es: id asc | id desc | data_tarefa desc | data_tarefa asc

$habilitarTarefasDataHorario = 0; //0-desativado | 1-ativado
$habilitarTarefasDataFinal = 0; //0-desativado | 1-ativado
$configTarefasDataExibirDiaSemana = 0; //0-desativado | 1-ativado //obs: substituir por fomato data

//V�nculos
$habilitarTarefasUsuario = 0; //0-desativado | 1-ativado
$habilitarTarefasStatus = 0; //0-desativado | 1-ativado
$habilitarTarefasVinculoProcessos = 0; //0-desativado | 1-ativado 

$habilitarTarefasVinculo1 = 0; //0-desativado | 1-ativado
$configTarefasVinculo1Nome = "V�nculo 01";
$configTarefasVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTarefasVinculo1 = "3571"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTarefasVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoTarefasVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTarefasVinculo2 = 0; //0-desativado | 1-ativado
$configTarefasVinculo2Nome = "V�nculo 02";
$configTarefasVinculo2Metodo = 2; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTarefasVinculo2 = "0"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTarefasVinculo2 = "3483"; //id do tipo de cadastro
$configClassificacaoTarefasVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTarefasVinculo3 = 0; //0-desativado | 1-ativado
$configTarefasVinculo3Nome = "V�nculo 03";
$configTarefasVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTarefasVinculo3 = "0"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTarefasVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoTarefasVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

//Defini��o de quantas e quais informa��es complementares os hist�ricos ter�o.
$habilitarTarefasIc1 = 0; //0-desativado | 1-ativado 
$configTituloTarefasIc1 = "Descri��o 01";
$configTarefasBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarTarefasIc2 = 0; //0-desativado | 1-ativado 
$configTituloTarefasIc2 = "Descri��o 02"; 
$configTarefasBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarTarefasIc3 = 0; //0-desativado | 1-ativado
$configTituloTarefasIc3 = "Descri��o 03"; 
$configTarefasBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarTarefasIc4 = 0; //0-desativado | 1-ativado 
$configTituloTarefasIc4 = "Descri��o 04"; 
$configTarefasBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarTarefasIc5 = 0; //0-desativado | 1-ativado 
$configTituloTarefasIc5 = "Descri��o 05"; 
$configTarefasBoxIc5 = 1; //1 - simples | 2 - multilinha


//Lembrete por e-mail.
$configTarefasLembreteAutomatico = 0; //0-desativado | 1-ativado

//config_tarefas_lembrete_automatico = 0 '0-desativado | 1-ativado
//config_tarefas_lembrete_automatico_tipo_envio = 1 '1 - somente para o usu�rio relacionado ao registro | 2 - para todos os usu�rios internos (id ou tipo cadastro)
//config_tarefas_lembrete_automatico_qtd_envio = 1 '0 - at� desativar o registro
//config_tarefas_lembrete_automatico_periodo_antecedencia = 24
//config_tarefas_lembrete_automatico_periodo_antecedencia_tipo = "h" 'yyyy - Year | q - Quarter | m - Month | y - Day of year | d - Day | w - Weekday | ww - Week of year | h - Hour | n - Minute | s - Second 


$habilitarTarefasLembreteEnvio = 0; //0-desativado | 1-ativado
$configTarefasEmailLembreteEnvioCopia = ""; //"" - desabilita | email@servidor.com.br - define e-mail de c�pia
//**************************************************************************************


//Cadastro Contatos - configura��o dos recursos.
//**************************************************************************************
$configClassificacaoCadastroContatos = "nome"; //op��es: nome | email | filial | id 

$habilitarCadastroContatosFilial = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosSenha = 0; //0-desativado | 1-ativado 

$habilitarCadastroContatosEndereco = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosNumero = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosComplemento = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosBairro = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosCidade = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosEstado = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosPais = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosCep = 0; //0-desativado | 1-ativado 
$habilitarCadastroContatosPontoReferencia = 0; //0-desativado | 1-ativado 

$habilitarCadastroContatosAtivacao = 0; //0-desativado | 1-ativado 


//Defini��o de quantas e quais informa��es complementares os contatos ter�o.
$habilitarCadastroContatosIc1 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc1 = "Descri��o 01";
$configCadastroContatosBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc2 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc2 = "Descri��o 02"; 
$configCadastroContatosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc3 = 0; //0-desativado | 1-ativado
$configTituloCadastroContatosIc3 = "Descri��o 03"; 
$configCadastroContatosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc4 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc4 = "Descri��o 04"; 
$configCadastroContatosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc5 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc5 = "Descri��o 05"; 
$configCadastroContatosBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc6 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc6 = "Descri��o 06";
$configCadastroContatosBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc7 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc7 = "Descri��o 07"; 
$configCadastroContatosBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc8 = 0; //0-desativado | 1-ativado
$configTituloCadastroContatosIc8 = "Descri��o 08"; 
$configCadastroContatosBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc9 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc9 = "Descri��o 09"; 
$configCadastroContatosBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc10 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc10 = "Descri��o 10"; 
$configCadastroContatosBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc11 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc11 = "Descri��o 11";
$configCadastroContatosBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc12 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc12 = "Descri��o 12"; 
$configCadastroContatosBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc13 = 0; //0-desativado | 1-ativado
$configTituloCadastroContatosIc13 = "Descri��o 13"; 
$configCadastroContatosBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc14 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc14 = "Descri��o 14"; 
$configCadastroContatosBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarCadastroContatosIc15 = 0; //0-desativado | 1-ativado 
$configTituloCadastroContatosIc15 = "Descri��o 15"; 
$configCadastroContatosBoxIc15 = 1; //1 - simples | 2 - multilinha
//**************************************************************************************


//Cadastro Contas Banc�rias - configura��o dos recursos.
//**************************************************************************************
$configClassificacaoCadastroContasBancarias = "titulo_conta"; //titulo_conta | nome_titular
//**************************************************************************************


//Publica��o de Banners - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configBannersTipoSistemaPublicacao = 1; //1 - geral | 2 - por categorias

//Grupos.
$configClassificacaoBanners = "grupo"; //op��es: id | grupo
$configBannersDescricao = 1; //1 - caixa sem formata��o | 2 - caixa de acordo com defini��o do conte�do

//Banners - Arquivos.
$configClassificacaoBannersArquivos = "id"; //op��es: id | banner | data_publicacao asc | data_publicacao desc | n_classificacao | newid() - SQL Server

$habilitarBannersArquivosNClassificacao = 1; //0-desativado | 1-ativado
$habilitarBannersArquivosTipoPublicacao = 1; //0-desativado | 1-ativado
$habilitarBannersArquivosPeriodos = 1; //0-desativado | 1-ativado
$habilitarBannersArquivosContratacao = 1; //0-desativado | 1-ativado
$habilitarBannersArquivosCadastro = 1; //0-desativado | 1-ativado
$habilitarBannersArquivosCodigoHTML = 1; //0-desativado | 1-ativado
$habilitarBannersArquivosDimensoes = 1; //0-desativado | 1-ativado

//Site.

//**************************************************************************************


//F�rum - Configura��es dos recursos gerais.
//**************************************************************************************
$configClassificacaoForumTopicos = "data_topico desc"; //op��es: n_classificacao | data_topico desc | data_topico asc | topico | RND(INT(NOW*id)-NOW*id) - Access | newid() - SQL Server (random)

$habilitarForumTopicosClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 

$habilitarForumTopicosSistemaPaginacao = 0; //0-desativado | 1-ativado 
$habilitarForumTopicosSistemaPaginacaoNumeracao = 0; //0-desativado | 1-ativado 
$configForumTopicosSistemaPaginacaoNRegistros = 10;

$habilitarForumTopicosAssunto = 1; //0-desativado | 1-ativado
$habilitarForumTopicosNClassificacao = 0; //0-desativado | 1-ativado

//Recursos dispon�veis para cada t�pico.
$habilitarForumTopicosFotos = 0; //0-desativado | 1-ativado
$habilitarForumTopicosVideos = 0; //0-desativado | 1-ativado
$habilitarForumTopicosArquivos = 0; //0-desativado | 1-ativado
$habilitarForumTopicosZip = 0; //0-desativado | 1-ativado
$habilitarForumTopicosSwfs = 0; //0-desativado | 1-ativado
$habilitarForumTopicosConteudo = 0; //0-desativado | 1-ativado
$habilitarForumTopicosConteudoHTML = 0; //0-desativado | 1-ativado

//Site.
$configForumTopicosAcesso = 0; //0 - livre | 1 - restrito
$configForumFrontendTopicosInserir = 0; //0-desativado | 1-ativado
$configForumTopicosAtivacao = 0; //0 - desativado (ativa��o com modera��o atrav�s do sistema) | 1 - ativa��o autom�tica, sem modera��o

$habilitarForumTopicosAdmPostagensAdministrar = 1; //0-desativado | 1-ativado
$habilitarForumTopicosAdmAtivacao = 1; //0-desativado | 1-ativado

$habilitarForumTopicosSitePaginacao = 0; //0-desativado | 1-ativado 
$habilitarForumTopicosSitePaginacaoNumeracao = 0; //0-desativado | 1-ativado 
$configForumTopicosSitePaginacaoNRegistros = 10;

//Postagens.
$configClassificacaoForumPostagens = "data_postagem asc"; //op��es: n_classificacao | data_postagem desc | data_postagem asc | postagem

$habilitarForumPostagensClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 

$habilitarForumPostagensSistemaPaginacao = 0; //0-desativado | 1-ativado 
$habilitarForumPostagensSistemaPaginacaoNumeracao = 0; //0-desativado | 1-ativado 
$configForumPostagensSistemaPaginacaoNRegistros = 10;

$habilitarForumPostagensNClassificacao = 0; //0-desativado | 1-ativado
$habilitarForumPostagensNome = 0; //0-desativado | 1-ativado
$habilitarForumPostagensEmail = 0; //0-desativado | 1-ativado

//Defini��o de quantas e quais informa��es complementares as postagens ter�o.
$habilitarForumPostagensIc1 = 1; //0-desativado | 1-ativado 
$configTituloForumPostagensIc1 = "Cor do Pigmento";
$configForumPostagensBoxIc1 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc2 = 1; //0-desativado | 1-ativado 
$configTituloForumPostagensIc2 = "Produto"; 
$configForumPostagensBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc3 = 0; //0-desativado | 1-ativado
$configTituloForumPostagensIc3 = "Descri��o 03"; 
$configForumPostagensBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc4 = 0; //0-desativado | 1-ativado 
$configTituloForumPostagensIc4 = "Descri��o 04"; 
$configForumPostagensBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc5 = 0; //0-desativado | 1-ativado 
$configTituloForumPostagensIc5 = "Descri��o 05"; 
$configForumPostagensBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc6 = 0; //0-desativado | 1-ativado 
$configTituloForumPostagensIc6 = "Descri��o 06";
$configForumPostagensBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc7 = 0; //0-desativado | 1-ativado 
$configTituloForumPostagensIc7 = "Descri��o 07"; 
$configForumPostagensBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc8 = 0; //0-desativado | 1-ativado
$configTituloForumPostagensIc8 = "Descri��o 08"; 
$configForumPostagensBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc9 = 0; //0-desativado | 1-ativado 
$configTituloForumPostagensIc9 = "Descri��o 09"; 
$configForumPostagensBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarForumPostagensIc10 = 0; //0-desativado | 1-ativado 
$configTituloForumPostagensIc10 = "Descri��o 10"; 
$configForumPostagensBoxIc10 = 1; //1 - simples | 2 - multilinha

//Site.
$habilitarForumPostagensSitePaginacao = 0; //0-desativado | 1-ativado 
$habilitarForumPostagensSitePaginacaoNumeracao = 0; //0-desativado | 1-ativado 
$configForumPostagensSitePaginacaoNRegistros = 10;

$ConfigForumPostagensAtivacao = 1; //0 - desativado (ativa��o com modera��o atrav�s do sistema) | 1 - ativa��o autom�tica, sem modera��o
$configForumPostagensAcesso = 0; //0 - livre | 1 - restrito
$configForumPostagensEdicaoIdentificacao = 1; //0-desativado | 1-ativado

$configForumPostagensComentariosNivel1 = 1; //0-desativado | 1-ativado
//**************************************************************************************


//Enquetes/Quest�es - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoEnquetes = "n_classificacao"; //op��es: op��es: id | n_classificacao | data_enquete desc | data_enquete asc | cast(descricao as varchar(500)) - SQL Server | newid() - SQL Server (random)
$configClassificacaoEnquetesOpcoes = "opcao"; //op��es: op��es: id | cast(opcao as varchar(500)) - SQL Server | votacao | n_classificacao

$habilitarEnquetesNClassificacao = 1; //1 - simples | 2 - multilinha

$habilitarEnquetesCadastro = 0; //1 - simples | 2 - multilinha
$configEnquetesCadastroUsuarioMetodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroEnquetes = "0"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroEnquetes = "0"; //id do tipo de cadastro
$configClassificacaoCadastroEnquetes = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$ativacaoEnquetesTipo = 0; //1 - simples | 2 - multilinha
$ativacaoEnquetesImagem = 0; //1 - simples | 2 - multilinha

//Recursos dispon�veis para cada enquete.
$habilitarEnquetesFotos = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesVideos = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesArquivos = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesZip = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesSwfs = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesConteudo = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesConteudoHTML = 0; //1 - simples | 2 - multilinha

//Op��es.
$ativacaoEnquetesOpcoesImagem = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesOpcoesNClassificacao = 0; //1 - simples | 2 - multilinha
$habilitarEnquetesOpcoesResposta = 0; //1 - simples | 2 - multilinha
$ativacaoEnquetesOpcoesVotos = 0; //1 - simples | 2 - multilinha


//Site.
$habilitarEnquetesFrontendPaginacaoSimples = 0; //0-desativado | 1-ativado 
$habilitarEnquetesFrontendPaginacaoQtdPaginas = 0; //0-desativado | 1-ativado 
$configEnquetesFrontendPaginacaoNRegistros = 10; //0-desativado | 1-ativado 
//**************************************************************************************


//P�ginas - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoPaginas = "titulo"; //id | titulo | data_criacao asc | data_criacao desc | n_classificacao | newid() - SQL Server (random)
$habilitarPaginasClassificacaoPersonalizada = 1; //0-desativado | 1-ativado 

//Pagina��o.
$habilitarPaginasSistemaPaginacao = 1; //0-desativado | 1-ativado
$habilitarPaginasSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configPaginasSistemaPaginacaoNRegistros = 5;

$habilitarPaginasNClassificacao = 1; //0-desativado | 1-ativado
$habilitarPaginasImagem = 1; //0-desativado | 1-ativado
$habilitarPaginasPalavrasChave = 1; //0-desativado | 1-ativado

$habilitarPaginasURL1 = 1; //0-desativado | 1-ativado
$configPaginasURL1Titulo = "Endere�o URL (link)";

$habilitarPaginasAcessoRestrito = 1; //0-desativado | 1-ativado

$habilitarPaginasVinculo1 = 1; //0-desativado | 1-ativado
$configPaginasVinculo1Nome = "V�nculo 01";
$configPaginasVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPaginasVinculo1 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPaginasVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoPaginasVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarPaginasVinculo2 = 1; //0-desativado | 1-ativado
$configPaginasVinculo2Nome = "V�nculo 02";
$configPaginasVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPaginasVinculo2 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPaginasVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoPaginasVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarPaginasVinculo3 = 1; //0-desativado | 1-ativado
$configPaginasVinculo3Nome = "V�nculo 03";
$configPaginasVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbPaginasVinculo3 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoPaginasVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoPaginasVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia


$habilitarPaginasFotos = 1; //0-desativado | 1-ativado 
$habilitarPaginasVideos = 1; //0-desativado | 1-ativado 
$habilitarPaginasArquivos = 1; //0-desativado | 1-ativado 
$habilitarPaginasZip = 1; //0-desativado | 1-ativado 
$habilitarPaginasSwfs = 1; //0-desativado | 1-ativado 
$habilitarPaginasConteudo = 1; //0-desativado | 1-ativado 
$habilitarPaginasProcessos = 1; //0-desativado | 1-ativado 


//Filtros gen�ricos.
$habilitarPaginasFiltroGenerico01 = 1; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico01Nome = "Filtro 01";
$configPaginasFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico02 = 1; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico02Nome = "Filtro 02";
$configPaginasFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico03 = 1; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico03Nome = "Filtro 03";
$configPaginasFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico04Nome = "Filtro 04";
$configPaginasFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico05Nome = "Filtro 05";
$configPaginasFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico06Nome = "Filtro 06";
$configPaginasFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico07Nome = "Filtro 07";
$configPaginasFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico08Nome = "Filtro 08";
$configPaginasFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico09Nome = "Filtro 09";
$configPaginasFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarPaginasFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configPaginasFiltroGenerico10Nome = "Filtro 10";
$configPaginasFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares as p�ginas ter�o.
$habilitarPaginasIc1 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc1 = "Descri��o 01";
$configPaginasBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarPaginasIc2 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc2 = "Descri��o 02"; 
$configPaginasBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc3 = 1; //0-desativado | 1-ativado
$configTituloPaginasIc3 = "Descri��o 03"; 
$configPaginasBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc4 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc4 = "Descri��o 04"; 
$configPaginasBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc5 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc5 = "Descri��o 05"; 
$configPaginasBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc6 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc6 = "Descri��o 06";
$configPaginasBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarPaginasIc7 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc7 = "Descri��o 07"; 
$configPaginasBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc8 = 1; //0-desativado | 1-ativado
$configTituloPaginasIc8 = "Descri��o 08"; 
$configPaginasBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc9 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc9 = "Descri��o 09"; 
$configPaginasBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc10 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc10 = "Descri��o 10"; 
$configPaginasBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc11 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc11 = "Descri��o 11";
$configPaginasBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarPaginasIc12 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc12 = "Descri��o 12"; 
$configPaginasBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc13 = 1; //0-desativado | 1-ativado
$configTituloPaginasIc13 = "Descri��o 13"; 
$configPaginasBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc14 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc14 = "Descri��o 14"; 
$configPaginasBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarPaginasIc15 = 1; //0-desativado | 1-ativado 
$configTituloPaginasIc15 = "Descri��o 15"; 
$configPaginasBoxIc15 = 1; //1 - simples | 2 - multilinha


//Site.
$habilitarPaginasSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarPaginasSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configPaginasSitePaginacaoNRegistros = 5;

$configPaginasImagemPlaceholder = 0; //0-desativado | 1-ativado
//**************************************************************************************


//Processos - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoProcessos = "data_criacao desc"; //id | processo | data_criacao asc | data_criacao desc | n_classificacao


//Pagina��o.
$habilitarProcessosSistemaPaginacao = 1; //0-desativado | 1-ativado
$habilitarProcessosSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configProcessosSistemaPaginacaoNRegistros = 5;

$habilitarProcessosVinculo1 = 0; //0-desativado | 1-ativado
$configProcessosVinculo1Nome = "V�nculo 01";
$configProcessosVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbProcessosVinculo1 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoProcessosVinculo1 = "0"; //id do tipo de Processos
$configClassificacaoProcessosVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarProcessosVinculo2 = 0; //0-desativado | 1-ativado
$configProcessosVinculo2Nome = "V�nculo 02";
$configProcessosVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbProcessosVinculo2 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoProcessosVinculo2 = "0"; //id do tipo de Processos
$configClassificacaoProcessosVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarProcessosVinculo3 = 0; //0-desativado | 1-ativado
$configProcessosVinculo3Nome = "V�nculo 03";
$configProcessosVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbProcessosVinculo3 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoProcessosVinculo3 = "0"; //id do tipo de Processos
$configClassificacaoProcessosVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarProcessosNClassificacao = 0; //0-desativado | 1-ativado

$habilitarProcessosDataDistribuicao = 0; //0-desativado | 1-ativado
$habilitarProcessosDataAdmissao = 0; //0-desativado | 1-ativado
$habilitarProcessosDataDemissao = 0; //0-desativado | 1-ativado

//Datas gen�ricas.
$habilitarProcessosData1 = 0; //0-desativado | 1-ativado 
$configTituloProcessosData1 = "Descri��o 01"; 
$configTipoCampoProcessosData1 = 1; //1 - JQuery DatePicker
$configProcessosData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarProcessosStatus = 1; //0-desativado | 1-ativado 
$habilitarProcessosPalavrasChave = 0; //0-desativado | 1-ativado

$habilitarProcessosValor = 1; //0-desativado | 1-ativado 

$habilitarProcessosValor1 = 1; //0-desativado | 1-ativado 
$configProcessosValor1nome = "Descri��o 01";

$habilitarProcessosURL1 = 0; //0-desativado | 1-ativado
$configProcessosURL1Titulo = "Endere�o URL (link)";

$habilitarProcessosAcessoRestrito = 0; //0-desativado | 1-ativado


//Filtros gen�ricos.
$habilitarProcessosFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico01Nome = "Filtro 01";
$configProcessosFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico02Nome = "Filtro 02";
$configProcessosFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico03Nome = "Filtro 03";
$configProcessosFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico04Nome = "Filtro 04";
$configProcessosFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico05Nome = "Filtro 05";
$configProcessosFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico06Nome = "Filtro 06";
$configProcessosFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico07Nome = "Filtro 07";
$configProcessosFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico08Nome = "Filtro 08";
$configProcessosFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico09Nome = "Filtro 09";
$configProcessosFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico10Nome = "Filtro 10";
$configProcessosFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico11Nome = "Filtro 11";
$configProcessosFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico12Nome = "Filtro 12";
$configProcessosFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico13Nome = "Filtro 13";
$configProcessosFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico14Nome = "Filtro 14";
$configProcessosFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico15Nome = "Filtro 15";
$configProcessosFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico16Nome = "Filtro 16";
$configProcessosFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico17Nome = "Filtro 17";
$configProcessosFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico18Nome = "Filtro 18";
$configProcessosFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico19Nome = "Filtro 19";
$configProcessosFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarProcessosFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configProcessosFiltroGenerico20Nome = "Filtro 20";
$configProcessosFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares os processos ter�o.
$habilitarProcessosIc1 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc1 = "Descri��o 01";
$configProcessosBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc2 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc2 = "Descri��o 02"; 
$configProcessosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc3 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc3 = "Descri��o 03"; 
$configProcessosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc4 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc4 = "Descri��o 04"; 
$configProcessosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc5 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc5 = "Descri��o 05"; 
$configProcessosBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc6 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc6 = "Descri��o 06";
$configProcessosBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc7 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc7 = "Descri��o 07"; 
$configProcessosBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc8 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc8 = "Descri��o 08"; 
$configProcessosBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc9 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc9 = "Descri��o 09"; 
$configProcessosBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc10 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc10 = "Descri��o 10"; 
$configProcessosBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc11 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc11 = "Descri��o 11";
$configProcessosBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc12 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc12 = "Descri��o 12"; 
$configProcessosBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc13 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc13 = "Descri��o 13"; 
$configProcessosBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc14 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc14 = "Descri��o 14"; 
$configProcessosBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc15 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc15 = "Descri��o 15"; 
$configProcessosBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc16 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc16 = "Descri��o 16";
$configProcessosBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc17 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc17 = "Descri��o 17"; 
$configProcessosBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc18 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc18 = "Descri��o 18"; 
$configProcessosBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc19 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc19 = "Descri��o 19"; 
$configProcessosBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc20 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc20 = "Descri��o 20"; 
$configProcessosBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc21 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc21 = "Descri��o 21";
$configProcessosBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc22 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc22 = "Descri��o 22"; 
$configProcessosBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc23 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc23 = "Descri��o 23"; 
$configProcessosBoxIc23 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc24 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc24 = "Descri��o 24"; 
$configProcessosBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc25 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc25 = "Descri��o 25"; 
$configProcessosBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc26 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc26 = "Descri��o 26";
$configProcessosBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc27 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc27 = "Descri��o 27"; 
$configProcessosBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc28 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc28 = "Descri��o 28"; 
$configProcessosBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc29 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc29 = "Descri��o 29"; 
$configProcessosBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc30 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc30 = "Descri��o 30"; 
$configProcessosBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc31 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc31 = "Descri��o 31";
$configProcessosBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc32 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc32 = "Descri��o 32"; 
$configProcessosBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc33 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc33 = "Descri��o 33"; 
$configProcessosBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc34 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc34 = "Descri��o 34"; 
$configProcessosBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc35 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc35 = "Descri��o 35"; 
$configProcessosBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc36 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc36 = "Descri��o 36";
$configProcessosBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc37 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc37 = "Descri��o 37"; 
$configProcessosBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc38 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc38 = "Descri��o 38"; 
$configProcessosBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc39 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc39 = "Descri��o 39"; 
$configProcessosBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc40 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc40 = "Descri��o 40"; 
$configProcessosBoxIc40 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc41 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc41 = "Descri��o 41";
$configProcessosBoxIc41 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc42 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc42 = "Descri��o 42"; 
$configProcessosBoxIc42 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc43 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc43 = "Descri��o 43"; 
$configProcessosBoxIc43 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc44 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc44 = "Descri��o 44"; 
$configProcessosBoxIc44 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc45 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc45 = "Descri��o 45"; 
$configProcessosBoxIc45 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc46 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc46 = "Descri��o 46";
$configProcessosBoxIc46 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc47 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc47 = "Descri��o 47"; 
$configProcessosBoxIc47 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc48 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc48 = "Descri��o 48"; 
$configProcessosBoxIc48 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc49 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc49 = "Descri��o 49"; 
$configProcessosBoxIc49 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc50 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc50 = "Descri��o 50"; 
$configProcessosBoxIc50 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc51 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc51 = "Descri��o 51";
$configProcessosBoxIc51 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc52 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc52 = "Descri��o 52"; 
$configProcessosBoxIc52 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc53 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc53 = "Descri��o 53"; 
$configProcessosBoxIc53 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc54 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc54 = "Descri��o 54"; 
$configProcessosBoxIc54 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc55 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc55 = "Descri��o 55"; 
$configProcessosBoxIc55 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc56 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc56 = "Descri��o 56";
$configProcessosBoxIc56 = 2; //1 - simples | 2 - multilinha

$habilitarProcessosIc57 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc57 = "Descri��o 57"; 
$configProcessosBoxIc57 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc58 = 0; //0-desativado | 1-ativado
$configTituloProcessosIc58 = "Descri��o 58"; 
$configProcessosBoxIc58 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc59 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc59 = "Descri��o 59"; 
$configProcessosBoxIc59 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosIc60 = 0; //0-desativado | 1-ativado 
$configTituloProcessosIc60 = "Descri��o 60"; 
$configProcessosBoxIc60 = 1; //1 - simples | 2 - multilinha

$habilitarProcessosFotos = 0; //0-desativado | 1-ativado 
$habilitarProcessosVideos = 0; //0-desativado | 1-ativado 
$habilitarProcessosArquivos = 1; //0-desativado | 1-ativado 
$habilitarProcessosZip = 0; //0-desativado | 1-ativado 
$habilitarProcessosSwfs = 0; //0-desativado | 1-ativado 
$habilitarProcessosHistorico = 0; //0-desativado | 1-ativado 
$habilitarProcessosProcessos = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Ve�culos - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoVeiculos = "data_publicacao desc"; //RND(INT(NOW*id)-NOW*id) | valor | veiculo | codigo | n_classificacao | data_publicacao desc | data_publicacao asc
$habilitarVeiculosClassificacaoPersonalizada = 0; //0-desativado | 1-ativado 

$habilitarVeiculosSistemaPaginacaoSimples = 0; //0-desativado | 1-ativado
$habilitarVeiculosSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado
$configVeiculosSistemaPaginacaoNRegistros = 5; //n�mero de registros por p�gina

$configVeiculosIncluirLocalizacao = 0; //0 - desativado | 1 - campo livre | 2 - combo box com o db interno persolalizado | 3 - combo box com o db_cep | 4 - XML (http://www.republicavirtual.com.br/cep/exemplos.php) | 5 - XML (http://www.buscarcep.com.br/?cep=22420041&formato=xml&chave=1iyeEHOY7.SVCKZSalTVl5SnTc34470)
$configVeiculosCEPPreenchimento = 1; //0-desativado | 1-ativado

//configura��es para relacionar ve�culos com cadastros pelo sistema.
//$habilitarVeiculosCadastroUsuario = 1; //0-desativado | 1-ativado
//$configIdTbCadastroVeiculos = 0; //id da categoria | 0=todas as categorias de cadastro 
//Configura��es para relacionar produtos com cadastros pelo sistema.
$habilitarVeiculosCadastroUsuario = 1; //0-desativado | 1-ativado
$configVeiculosCadastroUsuarioMetodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbCadastroVeiculosUsuario = "3490"; //id da categoria (0 = todos cadastros)
$configIdTbTipoCadastroVeiculosUsuario = "0"; //id do tipo de cadastro
$configClassificacaoCadastroVeiculosUsuario = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

//Datas gen�ricas.
$habilitarVeiculosData1 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData1 = "Data 01"; 
$configTipoCampoVeiculosData1 = 1; //1 - JQuery DatePicker
$configVeiculosData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData2 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData2 = "Data 02"; 
$configTipoCampoVeiculosData2 = 1; //1 - JQuery DatePicker
$configVeiculosData2 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData3 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData3 = "Data 03"; 
$configTipoCampoVeiculosData3 = 1; //1 - JQuery DatePicker
$configVeiculosData3 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData4 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData4 = "Data 04"; 
$configTipoCampoVeiculosData4 = 1; //1 - JQuery DatePicker
$configVeiculosData4 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData5 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData5 = "Data 05"; 
$configTipoCampoVeiculosData5 = 1; //1 - JQuery DatePicker
$configVeiculosData5 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData6 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData6 = "Data 06"; 
$configTipoCampoVeiculosData6 = 1; //1 - JQuery DatePicker
$configVeiculosData6 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData7 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData7 = "Data 07"; 
$configTipoCampoVeiculosData7 = 1; //1 - JQuery DatePicker
$configVeiculosData7 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData8 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData8 = "Data 08"; 
$configTipoCampoVeiculosData8 = 1; //1 - JQuery DatePicker
$configVeiculosData8 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData9 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData9 = "Data 09"; 
$configTipoCampoVeiculosData9 = 1; //1 - JQuery DatePicker
$configVeiculosData9 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosData10 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosData10 = "Data 10"; 
$configTipoCampoVeiculosData10 = 1; //1 - JQuery DatePicker
$configVeiculosData10 = 1; //1 - data simples (dia, m�s, ano)

$habilitarVeiculosNClassificacao = 1; //0-desativado | 1-ativado 
$habilitarVeiculosPlaca = 1; //0-desativado | 1-ativado 
$habilitarVeiculosContato = 1; //0-desativado | 1-ativado 
$habilitarVeiculosEmail = 1; //0-desativado | 1-ativado 
$habilitarVeiculosURLExterno = 1; //0-desativado | 1-ativado 

$habilitarVeiculosURL1 = 0; //0-desativado | 1-ativado
$configVeiculosURL1Titulo = "Endere�o URL 01 (link)";

$habilitarVeiculosURL2 = 0; //0-desativado | 1-ativado
$configVeiculosURL2Titulo = "Endere�o URL 02 (link)";

$habilitarVeiculosURL3 = 0; //0-desativado | 1-ativado
$configVeiculosURL3Titulo = "Endere�o URL 03 (link)";

$habilitarVeiculosURL4 = 0; //0-desativado | 1-ativado
$configVeiculosURL4Titulo = "Endere�o URL 04 (link)";

$habilitarVeiculosURL5 = 0; //0-desativado | 1-ativado
$configVeiculosURL5Titulo = "Endere�o URL 04 (link)";

//Ativa��es gen�ricas.
$habilitarVeiculosAtivacao1 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosAtivacao1 = "Ativa��o 01"; 

$habilitarVeiculosAtivacao2 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosAtivacao2 = "Ativa��o 02"; 

$habilitarVeiculosAtivacao3 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosAtivacao3 = "Ativa��o 03"; 

$habilitarVeiculosAtivacao4 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosAtivacao4 = "Ativa��o 04"; 

$habilitarVeiculosAtivacaoPromocoes = 1; //0-desativado | 1-ativado 
$habilitarVeiculosAtivacaoHome = 1; //0-desativado | 1-ativado
$habilitarVeiculosAtivacaoCategoria = 1; //0-desativado | 1-ativado
$habilitarVeiculosAtivacaoInfoCadastro = 1; //0-desativado | 1-ativado
$habilitarVeiculosAtivacaoAcesso = 1; //0-desativado | 1-ativado
$habilitarVeiculosImagem = 1; //0-desativado | 1-ativado 

$habilitarVeiculosPalavrasChave = 1; //0-desativado | 1-ativado

$habilitarVeiculosValor = 1; //0-desativado | 1-ativado 
$habilitarVeiculosValor1 = 0; //0-desativado | 1-ativado 
$configVeiculosValor1Nome = "Valor 01";
$habilitarVeiculosValor2 = 0; //0-desativado | 1-ativado 
$configVeiculosValor2Nome = "Valor 02";

$habilitarVeiculosTipo = 0; //0-desativado | 1-ativado 
$habilitarVeiculosStatus = 0; //0-desativado | 1-ativado 

$habilitarVeiculosVisualizacaoData = 1; //0-desativado | 1-ativado
$habilitarVeiculosVisualizacaoImagem = 1; //0-desativado | 1-ativado

//Filtros gen�ricos.
$habilitarVeiculosFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico01Nome = "Filtro 01";
$configVeiculosFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico02Nome = "Filtro 02";
$configVeiculosFiltroGenerico02CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico03Nome = "Filtro 03";
$configVeiculosFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico04Nome = "Filtro 04";
$configVeiculosFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico05Nome = "Filtro 05";
$configVeiculosFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico06Nome = "Filtro 06";
$configVeiculosFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico07Nome = "Filtro 07";
$configVeiculosFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico08Nome = "Filtro 08";
$configVeiculosFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico09Nome = "Filtro 09";
$configVeiculosFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico10Nome = "Filtro 10";
$configVeiculosFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico11Nome = "Filtro 11";
$configVeiculosFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico12Nome = "Filtro 12";
$configVeiculosFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico13Nome = "Filtro 13";
$configVeiculosFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico14Nome = "Filtro 14";
$configVeiculosFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico15Nome = "Filtro 15";
$configVeiculosFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico16Nome = "Filtro 16";
$configVeiculosFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico17Nome = "Filtro 17";
$configVeiculosFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico18Nome = "Filtro 18";
$configVeiculosFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico19Nome = "Filtro 19";
$configVeiculosFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configVeiculosFiltroGenerico20Nome = "Filtro 20";
$configVeiculosFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarVeiculosVinculo1 = 0; //0-desativado | 1-ativado
$configVeiculosVinculo1Nome = "V�nculo 01";
$configVeiculosVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbVeiculosVinculo1 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoVeiculosVinculo1 = "0"; //id do tipo de Veiculos
$configClassificacaoVeiculosVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarVeiculosVinculo2 = 0; //0-desativado | 1-ativado
$configVeiculosVinculo2Nome = "V�nculo 02";
$configVeiculosVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbVeiculosVinculo2 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoVeiculosVinculo2 = "0"; //id do tipo de Veiculos
$configClassificacaoVeiculosVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarVeiculosVinculo3 = 0; //0-desativado | 1-ativado
$configVeiculosVinculo3Nome = "V�nculo 03";
$configVeiculosVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbVeiculosVinculo3 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoVeiculosVinculo3 = "0"; //id do tipo de Veiculos
$configClassificacaoVeiculosVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarVeiculosVinculo4 = 0; //0-desativado | 1-ativado
$configVeiculosVinculo4Nome = "V�nculo 04";
$configVeiculosVinculo4Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbVeiculosVinculo4 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoVeiculosVinculo4 = "0"; //id do tipo de Veiculos
$configClassificacaoVeiculosVinculo4 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarVeiculosVinculo5 = 0; //0-desativado | 1-ativado
$configVeiculosVinculo5Nome = "V�nculo 05";
$configVeiculosVinculo5Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbVeiculosVinculo5 = "3892"; //id da categoria (0 = todos cadastro)
$configIdTbTipoVeiculosVinculo5 = "0"; //id do tipo de Veiculos
$configClassificacaoVeiculosVinculo5 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

//Defini��o de quantas e quais informa��es complementares os ve�culos ter�o.
$habilitarVeiculosIc1 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc1 = "Descri��o 01";
$configVeiculosBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc2 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc2 = "Descri��o 02"; 
$configVeiculosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc3 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc3 = "Descri��o 03"; 
$configVeiculosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc4 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc4 = "Descri��o 04"; 
$configVeiculosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc5 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc5 = "Descri��o 05"; 
$configVeiculosBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc6 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc6 = "Descri��o 06";
$configVeiculosBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc7 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc7 = "Descri��o 07"; 
$configVeiculosBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc8 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc8 = "Descri��o 08"; 
$configVeiculosBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc9 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc9 = "Descri��o 09"; 
$configVeiculosBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc10 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc10 = "Descri��o 10"; 
$configVeiculosBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc11 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc11 = "Descri��o 11";
$configVeiculosBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc12 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc12 = "Descri��o 12"; 
$configVeiculosBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc13 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc13 = "Descri��o 13"; 
$configVeiculosBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc14 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc14 = "Descri��o 14"; 
$configVeiculosBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc15 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc15 = "Descri��o 15"; 
$configVeiculosBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc16 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc16 = "Descri��o 16";
$configVeiculosBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc17 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc17 = "Descri��o 17"; 
$configVeiculosBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc18 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc18 = "Descri��o 18"; 
$configVeiculosBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc19 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc19 = "Descri��o 19"; 
$configVeiculosBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc20 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc20 = "Descri��o 20"; 
$configVeiculosBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc21 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc21 = "Descri��o 21";
$configVeiculosBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc22 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc22 = "Descri��o 22"; 
$configVeiculosBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc23 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc23 = "Descri��o 23"; 
$configVeiculosBoxIc23 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc24 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc24 = "Descri��o 24"; 
$configVeiculosBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc25 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc25 = "Descri��o 25"; 
$configVeiculosBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc26 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc26 = "Descri��o 26";
$configVeiculosBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc27 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc27 = "Descri��o 27"; 
$configVeiculosBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc28 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc28 = "Descri��o 28"; 
$configVeiculosBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc29 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc29 = "Descri��o 29"; 
$configVeiculosBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc30 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc30 = "Descri��o 30"; 
$configVeiculosBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc31 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc31 = "Descri��o 31";
$configVeiculosBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc32 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc32 = "Descri��o 32"; 
$configVeiculosBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc33 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc33 = "Descri��o 33"; 
$configVeiculosBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc34 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc34 = "Descri��o 34"; 
$configVeiculosBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc35 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc35 = "Descri��o 35"; 
$configVeiculosBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc36 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc36 = "Descri��o 36";
$configVeiculosBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarVeiculosIc37 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc37 = "Descri��o 37"; 
$configVeiculosBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc38 = 0; //0-desativado | 1-ativado
$configTituloVeiculosIc38 = "Descri��o 38"; 
$configVeiculosBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc39 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc39 = "Descri��o 39"; 
$configVeiculosBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarVeiculosIc40 = 0; //0-desativado | 1-ativado 
$configTituloVeiculosIc40 = "Descri��o 40"; 
$configVeiculosBoxIc40 = 1; //1 - simples | 2 - multilinha

//recursos dispon�veis para cada produto
//-------------
$habilitarVeiculosFotos = 1; //0-desativado | 1-ativado 
$habilitarVeiculosVideos = 0; //0-desativado | 1-ativado 
$habilitarVeiculosArquivos = 0; //0-desativado | 1-ativado 
$habilitarVeiculosZip = 0; //0-desativado | 1-ativado 
$habilitarVeiculosSwfs = 0; //0-desativado | 1-ativado 
$habilitarVeiculosConteudo = 0; //0-desativado | 1-ativado 
$habilitarVeiculosConteudoHtml = 0; //0-desativado | 1-ativado 

//$habilitarVeiculosOrcamentos = 1; //0-desativado | 1-ativado 
$habilitarVeiculosHistorico = 0; //0-desativado | 1-ativado 
$habilitarVeiculosTarefas = 0; //0-desativado | 1-ativado 
//-------------


//campos obrigat�rios
//config_veiculos_campos_obrigatorios = "id_tb_categoria_escolha_nivel_1,veiculo"
//config_veiculos_campos_obrigatorios_nomes = "Categoria,Ve�culo/T�tulo"


//site
$configVeiculosNColunas = 1; //do �ndice de ve�culos
$configVeiculosImagensNColunas = 3;
$configVeiculosVideosNColunas = 1;
$configVeiculosArquivosNColunas = 1;
$configVeiculosZipNColunas = 1;
$configVeiculosSwfNColunas = 1;

//config_veiculos_tamanho_video_w = 100
//config_veiculos_tamanho_video_h = 120

$configVeiculosImagemPlaceholder = 1; //0-desativado | 1-ativado  
$configVeiculosTituloLimiteCaracteres = 35; //0 desativa a limita��o
$configVeiculosDescricaoLimiteCaracteres = 200; //0 desativa a limita��o

$habilitarVeiculosEmailDuvidas = 0; //0-desativado | 1-ativado 

//$habilitarVeiculosPaginacaoSimples = 0; //0-desativado | 1-ativado | 2-ativado (mySQL)  
//$habilitarVeiculosPaginacaoQtdPaginas = 0; //0-desativado | 1-ativado
//$configVeiculosPaginacaoNRegistros = 30; //n�mero de registros por p�gina  
$habilitarVeiculosSitePaginacao = 0; //0-desativado | 1-ativado 
$habilitarVeiculosSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado 
$configVeiculosSitePaginacaoNRegistros = 20;
//**************************************************************************************


//Afilia��es - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoAfiliacoes = "afiliacao"; //op��es: id | afiliacoes | n_classificacao | valor asc | valor desc
$habilitarAfiliacoesClassificacaoPersonalizada = 1; //0-desativado | 1-ativado 

//Pagina��o.
$habilitarAfiliacoesSistemaPaginacao = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado 
$configAfiliacoesSistemaPaginacaoNRegistros = 20;

$ativacaoAfiliacoesImagem = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesNClassificacao = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesDescricao = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesTipoCobranca = 1; //0-desativado | 1-ativado 

$habilitarAfiliacoesPeriodoContratacao = 1; //0-desativado | 1-ativado 
$configAfiliacoesPeriodoContratacao = "m"; //yyyy - Year | m - Month | d - Day

$habilitarAfiliacoesConfiguracaoComplementar = 1; //0-desativado | 1-ativado 
$configAfiliacoesConfiguracaoComplementarNome = "Limite de Fotos"; //op��es: Limite de Fotos

//Recursos dispon�veis para cada produto.
$habilitarAfiliacoesFotos = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesVideos = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesArquivos = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesZip = 1; //0-desativado | 1-ativado 
$habilitarAfiliacoesSwfs = 1; //0-desativado | 1-ativado


//Site.
$habilitarAfiliacoesSitePaginacao = 0; //0-desativado | 1-ativado 
$habilitarAfiliacoesSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado 
$configAfiliacoesSitePaginacaoNRegistros = 20;
//**************************************************************************************


//Turmas - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoTurmas = "nome_turma"; //id | nome_turma | data_criacao asc | data_criacao desc | n_classificacao


//Pagina��o.
$habilitarTurmasSistemaPaginacao = 1; //0-desativado | 1-ativado
$habilitarTurmasSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configTurmasSistemaPaginacaoNRegistros = 5;

$habilitarTurmasVinculo1 = 0; //0-desativado | 1-ativado
$configTurmasVinculo1Nome = "V�nculo 01";
$configTurmasVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo1 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTurmasVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo2 = 0; //0-desativado | 1-ativado
$configTurmasVinculo2Nome = "V�nculo 02";
$configTurmasVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo2 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTurmasVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo3 = 0; //0-desativado | 1-ativado
$configTurmasVinculo3Nome = "V�nculo 03";
$configTurmasVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo3 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTurmasVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo4 = 0; //0-desativado | 1-ativado
$configTurmasVinculo4Nome = "V�nculo 04";
$configTurmasVinculo4Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo4 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTurmasVinculo4 = "0"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo4 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo5 = 0; //0-desativado | 1-ativado
$configTurmasVinculo5Nome = "V�nculo 05";
$configTurmasVinculo5Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo5 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoTurmasVinculo5 = "0"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo5 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo6 = 0; //0-desativado | 1-ativado
$configTurmasVinculo6Nome = "V�nculo 06";
$configTurmasVinculo6Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo6 = "0"; //id da categoria (0 = todos cadastros)
$configIdTbTipoTurmasVinculo6 = "123"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo6 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo7 = 0; //0-desativado | 1-ativado
$configTurmasVinculo7Nome = "V�nculo 07";
$configTurmasVinculo7Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo7 = "0"; //id da categoria (0 = todos cadastros)
$configIdTbTipoTurmasVinculo7 = "123"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo7 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo8 = 0; //0-desativado | 1-ativado
$configTurmasVinculo8Nome = "V�nculo 08";
$configTurmasVinculo8Metodo = 1; //1 - id de categoria | 2 - tipo de Processos
$configIdTbTurmasVinculo8 = "0"; //id da categoria (0 = todos cadastros)
$configIdTbTipoTurmasVinculo8 = "123"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo8 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo9 = 0; //0-desativado | 1-ativado
$configTurmasVinculo9Nome = "V�nculo 09";
$configTurmasVinculo9Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo9 = "0"; //id da categoria (0 = todos cadastros)
$configIdTbTipoTurmasVinculo9 = "123"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo9 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarTurmasVinculo10 = 0; //0-desativado | 1-ativado
$configTurmasVinculo10Nome = "V�nculo 10";
$configTurmasVinculo10Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbTurmasVinculo10 = "0"; //id da categoria (0 = todos cadastros)
$configIdTbTipoTurmasVinculo10 = "123"; //id do tipo de cadastro
$configClassificacaoTurmasVinculo10 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia


$habilitarTurmasNClassificacao = 1; //0-desativado | 1-ativado

$habilitarTurmasDataInicio = 1; //0-desativado | 1-ativado
$habilitarTurmasDataFinal = 1; //0-desativado | 1-ativado

//Datas gen�ricas.
$habilitarTurmasData1 = 1; //0-desativado | 1-ativado 
$configTituloTurmasData1 = "Descri��o 01"; 
$configTipoCampoTurmasData1 = 1; //1 - JQuery DatePicker
$configTurmasData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarTurmasCodigo = 1; //0-desativado | 1-ativado
$habilitarTurmasStatus = 1; //0-desativado | 1-ativado
$habilitarTurmasPalavrasChave = 1; //0-desativado | 1-ativado


$habilitarTurmasValor = 1; //0-desativado | 1-ativado 

$habilitarTurmasValor1 = 1; //0-desativado | 1-ativado 
$configTurmasValor1nome = "Descri��o 01";

$habilitarTurmasURL1 = 1; //0-desativado | 1-ativado
$configTurmasURL1Titulo = "Endere�o URL (link)";

$habilitarTurmasAcessoRestrito = 1; //0-desativado | 1-ativado


//Filtros gen�ricos.
$habilitarTurmasFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico01Nome = "Filtro 01";
$configTurmasFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico02Nome = "Filtro 02";
$configTurmasFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico03Nome = "Filtro 03";
$configTurmasFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico04Nome = "Filtro 04";
$configTurmasFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico05Nome = "Filtro 05";
$configTurmasFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico06Nome = "Filtro 06";
$configTurmasFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico07Nome = "Filtro 07";
$configTurmasFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico08Nome = "Filtro 08";
$configTurmasFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico09Nome = "Filtro 09";
$configTurmasFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico10Nome = "Filtro 10";
$configTurmasFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico11Nome = "Filtro 11";
$configTurmasFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico12Nome = "Filtro 12";
$configTurmasFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico13Nome = "Filtro 13";
$configTurmasFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico14Nome = "Filtro 14";
$configTurmasFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico15Nome = "Filtro 15";
$configTurmasFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico16Nome = "Filtro 16";
$configTurmasFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico17Nome = "Filtro 17";
$configTurmasFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico18Nome = "Filtro 18";
$configTurmasFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico19Nome = "Filtro 19";
$configTurmasFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarTurmasFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configTurmasFiltroGenerico20Nome = "Filtro 20";
$configTurmasFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares os processos ter�o.
$habilitarTurmasIc1 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc1 = "Descri��o 01";
$configTurmasBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc2 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc2 = "Descri��o 02"; 
$configTurmasBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc3 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc3 = "Descri��o 03"; 
$configTurmasBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc4 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc4 = "Descri��o 04"; 
$configTurmasBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc5 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc5 = "Descri��o 05"; 
$configTurmasBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc6 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc6 = "Descri��o 06";
$configTurmasBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc7 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc7 = "Descri��o 07"; 
$configTurmasBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc8 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc8 = "Descri��o 08"; 
$configTurmasBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc9 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc9 = "Descri��o 09"; 
$configTurmasBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc10 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc10 = "Descri��o 10"; 
$configTurmasBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc11 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc11 = "Descri��o 11";
$configTurmasBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc12 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc12 = "Descri��o 12"; 
$configTurmasBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc13 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc13 = "Descri��o 13"; 
$configTurmasBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc14 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc14 = "Descri��o 14"; 
$configTurmasBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc15 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc15 = "Descri��o 15"; 
$configTurmasBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc16 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc16 = "Descri��o 16";
$configTurmasBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc17 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc17 = "Descri��o 17"; 
$configTurmasBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc18 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc18 = "Descri��o 18"; 
$configTurmasBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc19 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc19 = "Descri��o 19"; 
$configTurmasBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc20 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc20 = "Descri��o 20"; 
$configTurmasBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc21 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc21 = "Descri��o 21";
$configTurmasBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc22 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc22 = "Descri��o 22"; 
$configTurmasBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc23 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc23 = "Descri��o 23"; 
$configTurmasBoxIc23 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc24 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc24 = "Descri��o 24"; 
$configTurmasBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc25 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc25 = "Descri��o 25"; 
$configTurmasBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc26 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc26 = "Descri��o 26";
$configTurmasBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc27 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc27 = "Descri��o 27"; 
$configTurmasBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc28 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc28 = "Descri��o 28"; 
$configTurmasBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc29 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc29 = "Descri��o 29"; 
$configTurmasBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc30 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc30 = "Descri��o 30"; 
$configTurmasBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc31 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc31 = "Descri��o 31";
$configTurmasBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc32 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc32 = "Descri��o 32"; 
$configTurmasBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc33 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc33 = "Descri��o 33"; 
$configTurmasBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc34 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc34 = "Descri��o 34"; 
$configTurmasBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc35 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc35 = "Descri��o 35"; 
$configTurmasBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc36 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc36 = "Descri��o 36";
$configTurmasBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc37 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc37 = "Descri��o 37"; 
$configTurmasBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc38 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc38 = "Descri��o 38"; 
$configTurmasBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc39 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc39 = "Descri��o 39"; 
$configTurmasBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc40 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc40 = "Descri��o 40"; 
$configTurmasBoxIc40 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc41 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc41 = "Descri��o 41";
$configTurmasBoxIc41 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc42 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc42 = "Descri��o 42"; 
$configTurmasBoxIc42 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc43 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc43 = "Descri��o 43"; 
$configTurmasBoxIc43 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc44 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc44 = "Descri��o 44"; 
$configTurmasBoxIc44 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc45 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc45 = "Descri��o 45"; 
$configTurmasBoxIc45 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc46 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc46 = "Descri��o 46";
$configTurmasBoxIc46 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc47 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc47 = "Descri��o 47"; 
$configTurmasBoxIc47 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc48 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc48 = "Descri��o 48"; 
$configTurmasBoxIc48 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc49 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc49 = "Descri��o 49"; 
$configTurmasBoxIc49 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc50 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc50 = "Descri��o 50"; 
$configTurmasBoxIc50 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc51 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc51 = "Descri��o 51";
$configTurmasBoxIc51 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc52 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc52 = "Descri��o 52"; 
$configTurmasBoxIc52 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc53 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc53 = "Descri��o 53"; 
$configTurmasBoxIc53 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc54 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc54 = "Descri��o 54"; 
$configTurmasBoxIc54 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc55 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc55 = "Descri��o 55"; 
$configTurmasBoxIc55 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc56 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc56 = "Descri��o 56";
$configTurmasBoxIc56 = 2; //1 - simples | 2 - multilinha

$habilitarTurmasIc57 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc57 = "Descri��o 57"; 
$configTurmasBoxIc57 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc58 = 0; //0-desativado | 1-ativado
$configTituloTurmasIc58 = "Descri��o 58"; 
$configTurmasBoxIc58 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc59 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc59 = "Descri��o 59"; 
$configTurmasBoxIc59 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasIc60 = 0; //0-desativado | 1-ativado 
$configTituloTurmasIc60 = "Descri��o 60"; 
$configTurmasBoxIc60 = 1; //1 - simples | 2 - multilinha

$habilitarTurmasFotos = 1; //0-desativado | 1-ativado 
$habilitarTurmasVideos = 1; //0-desativado | 1-ativado 
$habilitarTurmasArquivos = 1; //0-desativado | 1-ativado 
$habilitarTurmasZip = 1; //0-desativado | 1-ativado 
$habilitarTurmasSwfs = 1; //0-desativado | 1-ativado 

$habilitarTurmasHistorico = 1; //0-desativado | 1-ativado 
$habilitarTurmasModulos = 1; //0-desativado | 1-ativado 
$habilitarTurmasAulas = 1; //0-desativado | 1-ativado 
$habilitarTurmasCadastroVinculosMultiplos = 1; //0-desativado | 1-ativado (vincular v�rios cadastro)

//Aviso de final de turma.
$habilitarTurmasAvisoDataFinal = 0; //0-desativado | 1-ativado 
$configTurmasAvisoDataFinal = "24;h";//quantidade;tipo intervalo (h;24)


//Site.
$habilitarTurmasSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarTurmasSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configTurmasSitePaginacaoNRegistros = 5;
//**************************************************************************************


//M�dulos - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoModulos = "nome_modulo"; //id | nome_modulo | data_criacao asc | data_criacao desc | n_classificacao


//Pagina��o.
$habilitarModulosSistemaPaginacao = 1; //0-desativado | 1-ativado
$habilitarModulosSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configModulosSistemaPaginacaoNRegistros = 5;

$habilitarModulosVinculo1 = 1; //0-desativado | 1-ativado
$configModulosVinculo1Nome = "V�nculo 01";
$configModulosVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbModulosVinculo1 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoModulosVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoModulosVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarModulosVinculo2 = 1; //0-desativado | 1-ativado
$configModulosVinculo2Nome = "V�nculo 02";
$configModulosVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbModulosVinculo2 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoModulosVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoModulosVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarModulosVinculo3 = 1; //0-desativado | 1-ativado
$configModulosVinculo3Nome = "V�nculo 03";
$configModulosVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbModulosVinculo3 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoModulosVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoModulosVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarModulosVinculo4 = 1; //0-desativado | 1-ativado
$configModulosVinculo4Nome = "V�nculo 04";
$configModulosVinculo4Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbModulosVinculo4 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoModulosVinculo4 = "0"; //id do tipo de cadastro
$configClassificacaoModulosVinculo4 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarModulosVinculo5 = 1; //0-desativado | 1-ativado
$configModulosVinculo5Nome = "V�nculo 05";
$configModulosVinculo5Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbModulosVinculo5 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoModulosVinculo5 = "0"; //id do tipo de cadastro
$configClassificacaoModulosVinculo5 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia


$habilitarModulosNClassificacao = 1; //0-desativado | 1-ativado

$habilitarModulosDataInicio = 1; //0-desativado | 1-ativado
$habilitarModulosDataFinal = 1; //0-desativado | 1-ativado

//Datas gen�ricas.
$habilitarModulosData1 = 1; //0-desativado | 1-ativado 
$configTituloModulosData1 = "Descri��o 01"; 
$configTipoCampoModulosData1 = 1; //1 - JQuery DatePicker
$configModulosData1 = 1; //1 - data simples (dia, m�s, ano)

$habilitarModulosStatus = 1; //0-desativado | 1-ativado
$habilitarModulosPalavrasChave = 1; //0-desativado | 1-ativado


$habilitarModulosValor = 1; //0-desativado | 1-ativado 

$habilitarModulosValor1 = 1; //0-desativado | 1-ativado 
$configModulosValor1nome = "Descri��o 01";

$habilitarModulosURL1 = 1; //0-desativado | 1-ativado
$configModulosURL1Titulo = "Endere�o URL (link)";

$habilitarModulosCargaHoraria = 1; //0-desativado | 1-ativado
$habilitarModulosDuracaoAula = 1; //0-desativado | 1-ativado
$habilitarModulosAcessoRestrito = 1; //0-desativado | 1-ativado


//Filtros gen�ricos.
$habilitarModulosFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico01Nome = "Filtro 01";
$configModulosFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico02Nome = "Filtro 02";
$configModulosFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico03Nome = "Filtro 03";
$configModulosFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico04Nome = "Filtro 04";
$configModulosFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico05Nome = "Filtro 05";
$configModulosFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico06Nome = "Filtro 06";
$configModulosFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico07Nome = "Filtro 07";
$configModulosFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico08Nome = "Filtro 08";
$configModulosFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico09Nome = "Filtro 09";
$configModulosFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico10Nome = "Filtro 10";
$configModulosFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico11Nome = "Filtro 11";
$configModulosFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico12Nome = "Filtro 12";
$configModulosFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico13Nome = "Filtro 13";
$configModulosFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico14Nome = "Filtro 14";
$configModulosFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico15Nome = "Filtro 15";
$configModulosFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico16Nome = "Filtro 16";
$configModulosFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico17Nome = "Filtro 17";
$configModulosFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico18Nome = "Filtro 18";
$configModulosFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico19Nome = "Filtro 19";
$configModulosFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarModulosFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configModulosFiltroGenerico20Nome = "Filtro 20";
$configModulosFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares os processos ter�o.
$habilitarModulosIc1 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc1 = "Descri��o 01";
$configModulosBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc2 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc2 = "Descri��o 02"; 
$configModulosBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc3 = 0; //0-desativado | 1-ativado
$configTituloModulosIc3 = "Descri��o 03"; 
$configModulosBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc4 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc4 = "Descri��o 04"; 
$configModulosBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc5 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc5 = "Descri��o 05"; 
$configModulosBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc6 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc6 = "Descri��o 06";
$configModulosBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc7 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc7 = "Descri��o 07"; 
$configModulosBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc8 = 0; //0-desativado | 1-ativado
$configTituloModulosIc8 = "Descri��o 08"; 
$configModulosBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc9 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc9 = "Descri��o 09"; 
$configModulosBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc10 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc10 = "Descri��o 10"; 
$configModulosBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc11 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc11 = "Descri��o 11";
$configModulosBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc12 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc12 = "Descri��o 12"; 
$configModulosBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc13 = 0; //0-desativado | 1-ativado
$configTituloModulosIc13 = "Descri��o 13"; 
$configModulosBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc14 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc14 = "Descri��o 14"; 
$configModulosBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc15 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc15 = "Descri��o 15"; 
$configModulosBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc16 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc16 = "Descri��o 16";
$configModulosBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc17 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc17 = "Descri��o 17"; 
$configModulosBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc18 = 0; //0-desativado | 1-ativado
$configTituloModulosIc18 = "Descri��o 18"; 
$configModulosBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc19 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc19 = "Descri��o 19"; 
$configModulosBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc20 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc20 = "Descri��o 20"; 
$configModulosBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc21 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc21 = "Descri��o 21";
$configModulosBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc22 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc22 = "Descri��o 22"; 
$configModulosBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc23 = 0; //0-desativado | 1-ativado
$configTituloModulosIc23 = "Descri��o 23"; 
$configModulosBoxIc23 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc24 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc24 = "Descri��o 24"; 
$configModulosBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc25 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc25 = "Descri��o 25"; 
$configModulosBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc26 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc26 = "Descri��o 26";
$configModulosBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc27 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc27 = "Descri��o 27"; 
$configModulosBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc28 = 0; //0-desativado | 1-ativado
$configTituloModulosIc28 = "Descri��o 28"; 
$configModulosBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc29 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc29 = "Descri��o 29"; 
$configModulosBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc30 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc30 = "Descri��o 30"; 
$configModulosBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc31 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc31 = "Descri��o 31";
$configModulosBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc32 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc32 = "Descri��o 32"; 
$configModulosBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc33 = 0; //0-desativado | 1-ativado
$configTituloModulosIc33 = "Descri��o 33"; 
$configModulosBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc34 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc34 = "Descri��o 34"; 
$configModulosBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc35 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc35 = "Descri��o 35"; 
$configModulosBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc36 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc36 = "Descri��o 36";
$configModulosBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc37 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc37 = "Descri��o 37"; 
$configModulosBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc38 = 0; //0-desativado | 1-ativado
$configTituloModulosIc38 = "Descri��o 38"; 
$configModulosBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc39 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc39 = "Descri��o 39"; 
$configModulosBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc40 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc40 = "Descri��o 40"; 
$configModulosBoxIc40 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc41 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc41 = "Descri��o 41";
$configModulosBoxIc41 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc42 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc42 = "Descri��o 42"; 
$configModulosBoxIc42 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc43 = 0; //0-desativado | 1-ativado
$configTituloModulosIc43 = "Descri��o 43"; 
$configModulosBoxIc43 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc44 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc44 = "Descri��o 44"; 
$configModulosBoxIc44 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc45 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc45 = "Descri��o 45"; 
$configModulosBoxIc45 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc46 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc46 = "Descri��o 46";
$configModulosBoxIc46 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc47 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc47 = "Descri��o 47"; 
$configModulosBoxIc47 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc48 = 0; //0-desativado | 1-ativado
$configTituloModulosIc48 = "Descri��o 48"; 
$configModulosBoxIc48 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc49 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc49 = "Descri��o 49"; 
$configModulosBoxIc49 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc50 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc50 = "Descri��o 50"; 
$configModulosBoxIc50 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc51 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc51 = "Descri��o 51";
$configModulosBoxIc51 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc52 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc52 = "Descri��o 52"; 
$configModulosBoxIc52 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc53 = 0; //0-desativado | 1-ativado
$configTituloModulosIc53 = "Descri��o 53"; 
$configModulosBoxIc53 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc54 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc54 = "Descri��o 54"; 
$configModulosBoxIc54 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc55 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc55 = "Descri��o 55"; 
$configModulosBoxIc55 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc56 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc56 = "Descri��o 56";
$configModulosBoxIc56 = 2; //1 - simples | 2 - multilinha

$habilitarModulosIc57 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc57 = "Descri��o 57"; 
$configModulosBoxIc57 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc58 = 0; //0-desativado | 1-ativado
$configTituloModulosIc58 = "Descri��o 58"; 
$configModulosBoxIc58 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc59 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc59 = "Descri��o 59"; 
$configModulosBoxIc59 = 1; //1 - simples | 2 - multilinha

$habilitarModulosIc60 = 0; //0-desativado | 1-ativado 
$configTituloModulosIc60 = "Descri��o 60"; 
$configModulosBoxIc60 = 1; //1 - simples | 2 - multilinha

$habilitarModulosFotos = 1; //0-desativado | 1-ativado 
$habilitarModulosVideos = 1; //0-desativado | 1-ativado 
$habilitarModulosArquivos = 1; //0-desativado | 1-ativado 
$habilitarModulosZip = 1; //0-desativado | 1-ativado 
$habilitarModulosSwfs = 1; //0-desativado | 1-ativado 

$habilitarModulosHistorico = 1; //0-desativado | 1-ativado 
$habilitarModulosModulos = 1; //0-desativado | 1-ativado 
$habilitarModulosAulas = 1; //0-desativado | 1-ativado 
$habilitarModulosPaginasVinculosMultiplos = 1; //0-desativado | 1-ativado (vincular v�rios cadastro)


//Site
$habilitarModulosSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarModulosSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configModulosSitePaginacaoNRegistros = 5;
//**************************************************************************************


//Aulas - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoAulas = "tema"; //id | tema | data_criacao asc | data_criacao desc | data_aula asc | data_aula desc | n_classificacao


//Pagina��o.
$habilitarAulasSistemaPaginacao = 1; //0-desativado | 1-ativado
$habilitarAulasSistemaPaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configAulasSistemaPaginacaoNRegistros = 5;

$habilitarAulasVinculo1 = 1; //0-desativado | 1-ativado
$configAulasVinculo1Nome = "V�nculo 01";
$configAulasVinculo1Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbAulasVinculo1 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoAulasVinculo1 = "0"; //id do tipo de cadastro
$configClassificacaoAulasVinculo1 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarAulasVinculo2 = 1; //0-desativado | 1-ativado
$configAulasVinculo2Nome = "V�nculo 02";
$configAulasVinculo2Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbAulasVinculo2 = "3657"; //id da categoria (0 = todos cadastro)
$configIdTbTipoAulasVinculo2 = "0"; //id do tipo de cadastro
$configClassificacaoAulasVinculo2 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarAulasVinculo3 = 1; //0-desativado | 1-ativado
$configAulasVinculo3Nome = "V�nculo 03";
$configAulasVinculo3Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbAulasVinculo3 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoAulasVinculo3 = "0"; //id do tipo de cadastro
$configClassificacaoAulasVinculo3 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarAulasVinculo4 = 1; //0-desativado | 1-ativado
$configAulasVinculo4Nome = "V�nculo 04";
$configAulasVinculo4Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbAulasVinculo4 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoAulasVinculo4 = "0"; //id do tipo de cadastro
$configClassificacaoAulasVinculo4 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia

$habilitarAulasVinculo5 = 1; //0-desativado | 1-ativado
$configAulasVinculo5Nome = "V�nculo 05";
$configAulasVinculo5Metodo = 1; //1 - id de categoria | 2 - tipo de cadastro
$configIdTbAulasVinculo5 = "3653"; //id da categoria (0 = todos cadastro)
$configIdTbTipoAulasVinculo5 = "0"; //id do tipo de cadastro
$configClassificacaoAulasVinculo5 = "nome"; //id | data_cadastro desc | nome | razao_social | nome_fantasia


$habilitarAulasNClassificacao = 1; //0-desativado | 1-ativado

//Datas gen�ricas.
$habilitarAulasData1 = 1; //0-desativado | 1-ativado 
$configTituloAulasData1 = "Descri��o 01"; 
$configTipoCampoAulasData1 = 1; //1 - JQuery DatePicker
$configAulasData1 = 1; //1 - data simples (dia, m�s, ano)

//Ativa��es gen�ricas.
$habilitarAulasAtivacao1 = 0; //0-desativado | 1-ativado 
$configTituloAulasAtivacao1 = "Ativa��o 01"; 

$habilitarAulasAtivacao2 = 0; //0-desativado | 1-ativado 
$configTituloAulasAtivacao2 = "Ativa��o 02"; 

$habilitarAulasStatus = 1; //0-desativado | 1-ativado
$habilitarAulasPalavrasChave = 1; //0-desativado | 1-ativado

$habilitarAulasValor = 1; //0-desativado | 1-ativado 

$habilitarAulasValor1 = 1; //0-desativado | 1-ativado 
$configAulasValor1nome = "Descri��o 01";

$habilitarAulasURL1 = 1; //0-desativado | 1-ativado
$configAulasURL1Titulo = "Endere�o URL (link)";

$habilitarAulasCargaHoraria = 1; //0-desativado | 1-ativado
$habilitarAulasReposicao = 1; //0-desativado | 1-ativado
$habilitarAulasAcessoRestrito = 1; //0-desativado | 1-ativado


//Filtros gen�ricos.
$habilitarAulasFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico01Nome = "Filtro 01";
$configAulasFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico02Nome = "Filtro 02";
$configAulasFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico03Nome = "Filtro 03";
$configAulasFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico04Nome = "Filtro 04";
$configAulasFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico05Nome = "Filtro 05";
$configAulasFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico06Nome = "Filtro 06";
$configAulasFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico07Nome = "Filtro 07";
$configAulasFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico08Nome = "Filtro 08";
$configAulasFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico09Nome = "Filtro 09";
$configAulasFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico10Nome = "Filtro 10";
$configAulasFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico11Nome = "Filtro 11";
$configAulasFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico12Nome = "Filtro 12";
$configAulasFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico13Nome = "Filtro 13";
$configAulasFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico14Nome = "Filtro 14";
$configAulasFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico15Nome = "Filtro 15";
$configAulasFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico16Nome = "Filtro 16";
$configAulasFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico17Nome = "Filtro 17";
$configAulasFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico18Nome = "Filtro 18";
$configAulasFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico19Nome = "Filtro 19";
$configAulasFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarAulasFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configAulasFiltroGenerico20Nome = "Filtro 20";
$configAulasFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu


//Defini��o de quantas e quais informa��es complementares os processos ter�o.
$habilitarAulasIc1 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc1 = "Descri��o 01";
$configAulasBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc2 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc2 = "Descri��o 02"; 
$configAulasBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc3 = 0; //0-desativado | 1-ativado
$configTituloAulasIc3 = "Descri��o 03"; 
$configAulasBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc4 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc4 = "Descri��o 04"; 
$configAulasBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc5 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc5 = "Descri��o 05"; 
$configAulasBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc6 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc6 = "Descri��o 06";
$configAulasBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc7 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc7 = "Descri��o 07"; 
$configAulasBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc8 = 0; //0-desativado | 1-ativado
$configTituloAulasIc8 = "Descri��o 08"; 
$configAulasBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc9 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc9 = "Descri��o 09"; 
$configAulasBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc10 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc10 = "Descri��o 10"; 
$configAulasBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc11 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc11 = "Descri��o 11";
$configAulasBoxIc11 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc12 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc12 = "Descri��o 12"; 
$configAulasBoxIc12 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc13 = 0; //0-desativado | 1-ativado
$configTituloAulasIc13 = "Descri��o 13"; 
$configAulasBoxIc13 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc14 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc14 = "Descri��o 14"; 
$configAulasBoxIc14 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc15 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc15 = "Descri��o 15"; 
$configAulasBoxIc15 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc16 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc16 = "Descri��o 16";
$configAulasBoxIc16 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc17 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc17 = "Descri��o 17"; 
$configAulasBoxIc17 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc18 = 0; //0-desativado | 1-ativado
$configTituloAulasIc18 = "Descri��o 18"; 
$configAulasBoxIc18 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc19 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc19 = "Descri��o 19"; 
$configAulasBoxIc19 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc20 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc20 = "Descri��o 20"; 
$configAulasBoxIc20 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc21 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc21 = "Descri��o 21";
$configAulasBoxIc21 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc22 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc22 = "Descri��o 22"; 
$configAulasBoxIc22 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc23 = 0; //0-desativado | 1-ativado
$configTituloAulasIc23 = "Descri��o 23"; 
$configAulasBoxIc23 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc24 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc24 = "Descri��o 24"; 
$configAulasBoxIc24 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc25 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc25 = "Descri��o 25"; 
$configAulasBoxIc25 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc26 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc26 = "Descri��o 26";
$configAulasBoxIc26 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc27 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc27 = "Descri��o 27"; 
$configAulasBoxIc27 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc28 = 0; //0-desativado | 1-ativado
$configTituloAulasIc28 = "Descri��o 28"; 
$configAulasBoxIc28 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc29 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc29 = "Descri��o 29"; 
$configAulasBoxIc29 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc30 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc30 = "Descri��o 30"; 
$configAulasBoxIc30 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc31 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc31 = "Descri��o 31";
$configAulasBoxIc31 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc32 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc32 = "Descri��o 32"; 
$configAulasBoxIc32 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc33 = 0; //0-desativado | 1-ativado
$configTituloAulasIc33 = "Descri��o 33"; 
$configAulasBoxIc33 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc34 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc34 = "Descri��o 34"; 
$configAulasBoxIc34 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc35 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc35 = "Descri��o 35"; 
$configAulasBoxIc35 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc36 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc36 = "Descri��o 36";
$configAulasBoxIc36 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc37 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc37 = "Descri��o 37"; 
$configAulasBoxIc37 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc38 = 0; //0-desativado | 1-ativado
$configTituloAulasIc38 = "Descri��o 38"; 
$configAulasBoxIc38 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc39 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc39 = "Descri��o 39"; 
$configAulasBoxIc39 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc40 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc40 = "Descri��o 40"; 
$configAulasBoxIc40 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc41 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc41 = "Descri��o 41";
$configAulasBoxIc41 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc42 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc42 = "Descri��o 42"; 
$configAulasBoxIc42 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc43 = 0; //0-desativado | 1-ativado
$configTituloAulasIc43 = "Descri��o 43"; 
$configAulasBoxIc43 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc44 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc44 = "Descri��o 44"; 
$configAulasBoxIc44 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc45 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc45 = "Descri��o 45"; 
$configAulasBoxIc45 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc46 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc46 = "Descri��o 46";
$configAulasBoxIc46 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc47 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc47 = "Descri��o 47"; 
$configAulasBoxIc47 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc48 = 0; //0-desativado | 1-ativado
$configTituloAulasIc48 = "Descri��o 48"; 
$configAulasBoxIc48 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc49 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc49 = "Descri��o 49"; 
$configAulasBoxIc49 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc50 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc50 = "Descri��o 50"; 
$configAulasBoxIc50 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc51 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc51 = "Descri��o 51";
$configAulasBoxIc51 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc52 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc52 = "Descri��o 52"; 
$configAulasBoxIc52 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc53 = 0; //0-desativado | 1-ativado
$configTituloAulasIc53 = "Descri��o 53"; 
$configAulasBoxIc53 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc54 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc54 = "Descri��o 54"; 
$configAulasBoxIc54 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc55 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc55 = "Descri��o 55"; 
$configAulasBoxIc55 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc56 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc56 = "Descri��o 56";
$configAulasBoxIc56 = 2; //1 - simples | 2 - multilinha

$habilitarAulasIc57 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc57 = "Descri��o 57"; 
$configAulasBoxIc57 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc58 = 0; //0-desativado | 1-ativado
$configTituloAulasIc58 = "Descri��o 58"; 
$configAulasBoxIc58 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc59 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc59 = "Descri��o 59"; 
$configAulasBoxIc59 = 1; //1 - simples | 2 - multilinha

$habilitarAulasIc60 = 0; //0-desativado | 1-ativado 
$configTituloAulasIc60 = "Descri��o 60"; 
$configAulasBoxIc60 = 1; //1 - simples | 2 - multilinha


$habilitarAulasFotos = 1; //0-desativado | 1-ativado 
$habilitarAulasVideos = 1; //0-desativado | 1-ativado 
$habilitarAulasArquivos = 1; //0-desativado | 1-ativado 
$habilitarAulasZip = 1; //0-desativado | 1-ativado 
$habilitarAulasSwfs = 1; //0-desativado | 1-ativado 

$habilitarAulasEnviar = 0; //0-desativado | 1-ativado 

$habilitarAulasHistorico = 1; //0-desativado | 1-ativado 
$habilitarAulasGerenciar = 1; //0-desativado | 1-ativado 


//Site.
$habilitarAulasSitePaginacao = 0; //0-desativado | 1-ativado
$habilitarAulasSitePaginacaoNumeracao = 1; //0-desativado | 1-ativado-->
$configAulasSitePaginacaoNRegistros = 5;
//**************************************************************************************


//Formul�rios - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoFormularios = "id"; //id | nome_formulario | assunto_formulario | email_destinatario
$configClassificacaoFormulariosCampos = "id"; //id | nome_campo | n_classificacao
$configClassificacaoFormulariosOpcoes = "id"; //id | nome_opcao | n_classificacao
$configClassificacaoFormulariosEmails = "departamento"; //id | departamento | n_classificacao

//Formul�rios.
$habilitarFormulariosCopia = 0; //0-desativado | 1-ativado 
$habilitarFormulariosConfigMensageSucesso = 1; //0-desativado | 1-ativado 

$habilitarFormulariosEmailsDepartamentos = 0; //0-desativado | 1-ativado 

//Campos.
$habilitarFormulariosCamposNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarFormulariosCamposObrigatorio = 0; //0-desativado | 1-ativado 

//Op��es.
$habilitarFormulariosCamposOpcoesNClassificacao = 0; //0-desativado | 1-ativado 
$habilitarFormulariosCamposOpcoesImagem = 0; //0-desativado | 1-ativado 

//e-mails.
$habilitarFormulariosEmailsNClassificacao = 0; //0-desativado | 1-ativado 
//Site.
$configFormulariosEmailsSiteDepartamentosSelecao = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//Componente de envio de e-mail - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configEmailRemetente = "web@sistemadinamico.cu.cc";
$configEmailRemetenteNome = "Sistema Din�mico (Dev)";
$configEmailReply = "web@sistemadinamico.cu.cc";

$configEmailDestinatario = "contato@jorgemauricio.com";
$configEmailDestinatarioNome = "Jorge Mauricio";
$configEmailCc = "contato@jorgemauricio.com";
$configEmailCcNome = "Jorge Mauricio";
$configEmailBcc = "contato@jorgemauricio.com";
$configEmailBccNome = "Jorge Mauricio";

//Componente PHP Mailer.
//$configPHPMailerIsHTML = false; //false - texto | true - HTML

$configPHPMailerHost = "mail.squid.arvixe.com"; //google: smtp.gmail.com (PHPMailer) ou ssl://smtp.gmail.com (sem componente) (ainda n�o testado) | locaweb: smtp.dominio.com.br | uol: smtp.dominio.com.br | king host: smtp.dominio.com.br
$configPHPMailerPort = "25"; //google: 465 ou 587 (n�o testado) + ssl + configura��es especiais | locaweb: 587 | uol: 587 | king host: 587
//Google - Configura��es Adicionais - https://stackoverflow.com/questions/21937586/phpmailer-smtp-error-password-command-failed-when-send-mail-from-my-server
//https://www.google.com/settings/u/1/security/lesssecureapps
//https://accounts.google.com/b/0/DisplayUnlockCaptcha
//https://security.google.com/settings/security/activity?hl=en&pli=1
$configPHPMailerUseSSL = false;

$configPHPMailerUsername = "web@sistemadinamico.cu.cc";
$configPHPMailerPassword = "teSte#1108";
//**************************************************************************************


//Fluxo de Caixa - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoFluxo = "data_lancamento asc"; //id | data_contabilizacao desc | data_contabilizacao asc | data_lancamento desc | data_lancamento asc 

$habilitarFluxoAvulso = 1; //0-desativado | 1-ativado 
$habilitarFluxoPesquisaPeriodo = 1; //0-desativado | 1-ativado 

$habilitarFluxoTipo = 1; //0-desativado | 1-ativado 
$habilitarFluxoStatus = 1; //0-desativado | 1-ativado 
$habilitarFluxoUsuario = 1; //0-desativado | 1-ativado 
$habilitarFluxoNDocumento = 1; //0-desativado | 1-ativado 
$habilitarFluxoAutenticacao = 1; //0-desativado | 1-ativado

//Defini��o de quantas e quais informa��es complementares os registros de fluxo ter�o.
$habilitarFluxoIc1 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc1 = "Descri��o 01";
$configFluxoBoxIc1 = 2; //1 - simples | 2 - multilinha

$habilitarFluxoIc2 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc2 = "Descri��o 02"; 
$configFluxoBoxIc2 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc3 = 0; //0-desativado | 1-ativado
$configTituloFluxoIc3 = "Descri��o 03"; 
$configFluxoBoxIc3 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc4 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc4 = "Descri��o 04"; 
$configFluxoBoxIc4 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc5 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc5 = "Descri��o 05"; 
$configFluxoBoxIc5 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc6 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc6 = "Descri��o 06";
$configFluxoBoxIc6 = 2; //1 - simples | 2 - multilinha

$habilitarFluxoIc7 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc7 = "Descri��o 07"; 
$configFluxoBoxIc7 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc8 = 0; //0-desativado | 1-ativado
$configTituloFluxoIc8 = "Descri��o 08"; 
$configFluxoBoxIc8 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc9 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc9 = "Descri��o 09"; 
$configFluxoBoxIc9 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoIc10 = 0; //0-desativado | 1-ativado 
$configTituloFluxoIc10 = "Descri��o 10"; 
$configFluxoBoxIc10 = 1; //1 - simples | 2 - multilinha

$habilitarFluxoAutomacaoPagamentoRH = 0; //0-desativado | 1-ativado 
$habilitarFluxoAutomacaoRecebimentoRHClientes = 0; //0-desativado | 1-ativado 

$habilitarFluxoContabilizacaoAtivacaoPedidos = 0; //0-desativado | 1-ativado 
$configIdFluxoContabilizacaoAtivacaoPedidos = "3567";
$configTipoFluxoContabilizacaoAtivacaoPedidos = "0";
$configStatusFluxoContabilizacaoAtivacaoPedidos = "0";

$habilitarFluxoImpressao = 1; //0-desativado | 1-ativado 
//**************************************************************************************


//Mecanismos de busca.
//**************************************************************************************
$habilitarBuscaCategorias = 0; //0-desativado | 1-ativado

$habilitarBuscaCadastro = 1; //0-desativado | 1-ativado
$habilitarBuscaCadastroFiltros = 0; //0-desativado | 1-ativado

$habilitarBuscaCadastroContatos = 0; //0-desativado | 1-ativado
$habilitarBuscaCadastroContasBancarias = 0; //0-desativado | 1-ativado

$habilitarBuscaPublicacoes = 0; //0-desativado | 1-ativado

$habilitarBuscaPaginas = 0; //0-desativado | 1-ativado

$habilitarBuscaTarefas = 0; //0-desativado | 1-ativado
$habilitarBuscaTarefasFiltros = 0; //0-desativado | 1-ativado

$habilitarBuscaProcessos = 0; //0-desativado | 1-ativado
//**************************************************************************************


//Log.
//**************************************************************************************

//Filtros gen�ricos.
$habilitarLogFiltroGenerico01 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico01Nome = "Filtro 01";
$configLogFiltroGenerico01CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico02 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico02Nome = "Filtro 02";
$configLogFiltroGenerico02CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico03 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico03Nome = "Filtro 03";
$configLogFiltroGenerico03CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico04 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico04Nome = "Filtro 04";
$configLogFiltroGenerico04CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico05 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico05Nome = "Filtro 05";
$configLogFiltroGenerico05CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico06 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico06Nome = "Filtro 06";
$configLogFiltroGenerico06CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico07 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico07Nome = "Filtro 07";
$configLogFiltroGenerico07CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico08 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico08Nome = "Filtro 08";
$configLogFiltroGenerico08CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico09 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico09Nome = "Filtro 09";
$configLogFiltroGenerico09CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico10 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico10Nome = "Filtro 10";
$configLogFiltroGenerico10CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico11 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico11Nome = "Filtro 11";
$configLogFiltroGenerico11CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico12 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico12Nome = "Filtro 12";
$configLogFiltroGenerico12CaixaSelecao = 2; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico13 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico13Nome = "Filtro 13";
$configLogFiltroGenerico13CaixaSelecao = 3; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico14 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico14Nome = "Filtro 14";
$configLogFiltroGenerico14CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico15 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico15Nome = "Filtro 15";
$configLogFiltroGenerico15CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico16 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico16Nome = "Filtro 16";
$configLogFiltroGenerico16CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico17 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico17Nome = "Filtro 17";
$configLogFiltroGenerico17CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico18 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico18Nome = "Filtro 18";
$configLogFiltroGenerico18CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico19 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico19Nome = "Filtro 19";
$configLogFiltroGenerico19CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu

$habilitarLogFiltroGenerico20 = 0; //0-desativado | 1-ativado 
$configLogFiltroGenerico20Nome = "Filtro 20";
$configLogFiltroGenerico20CaixaSelecao = 1; //1 - checkbox | 2 - listbox | 3 - dropdown menu
//**************************************************************************************


//Itens - Relacionamento.
//**************************************************************************************
$configClassificacaoItensRelacaoRegistros = "id"; //id | data_atualizacao desc | data_atualizacao asc

$habilitarItensRelacaoRegistrosValor = 0; //0-desativado | 1-ativado 
$configItensRelacaoRegistrosValorTipoCategoria = "0"; //identifica��es do tipo_categoria (ex: 2,13,4) | 0 - todas

//Ativa��es gen�ricas.
$habilitarItensRelacaoRegistrosAtivacao1 = 0; //0-desativado | 1-ativado 
$configTituloItensRelacaoRegistrosAtivacao1 = "Ativa��o 01";
$habilitarItensRelacaoRegistrosAtivacao2 = 0; //0-desativado | 1-ativado 
$configTituloItensRelacaoRegistrosAtivacao2 = "Ativa��o 01";
$habilitarItensRelacaoRegistrosAtivacao3 = 0; //0-desativado | 1-ativado 
$configTituloItensRelacaoRegistrosAtivacao3 = "Ativa��o 01";
$habilitarItensRelacaoRegistrosAtivacao4 = 0; //0-desativado | 1-ativado 
$configTituloItensRelacaoRegistrosAtivacao4 = "Ativa��o 01";

$habilitarItensRelacaoRegistrosIc1 = 0; //0-desativado | 1-ativado 
$configItensRelacaoRegistrosTituloIc1 = "Descri��o 01";
$configItensRelacaoRegistrosBoxIc1 = 0; //1 - simples | 2 - multilinha
$configItensRelacaoRegistrosIc1TipoCategoria = "202"; //identifica��es do tipo_categoria (ex: 2,13,4) | 0 - todas
//**************************************************************************************


//Usu�rios do sistema - configura��o dos recursos do m�dulo.
//**************************************************************************************
$configClassificacaoUsuariosSistema = "nome"; //id | nome | usuario | usuario_data esc | usuario_data desc

//M�todo de autentica��o.
$configUsuariosMasterMetodoAutenticacao = 1; //1 - cookie | 2 session
$configUsuariosMetodoAutenticacao = 1; //1 - cookie | 2 session

$configUsuariosSenha = 1; //0 - n�o aparecer no sistema e n�o editar (edi��o somente pelo usu�rio) | 1-aparecer no sistema e edi��o
$configUsuariosMetodoSenha = 2; //0 - sem criptografia | 1 - md5 (n�o permite decriptografia) | 2 - MCrypt PHP library (possibilita criptografia e decriptografia)

$ativacaoUsuariosSistemaEmail = 0; //0-desativado | 1-ativado 
$ativacaoUsuariosSistemaTipo = 0; //0-desativado | 1-ativado 
//**************************************************************************************


//DB CEP.
//**************************************************************************************
$habilitarDBCEPEdicao = 0; //0-desativado | 1-ativado 

$habilitarDBCEPPais = 0; //0-desativado | 1-ativado 
$configClassificacaoDBCEPPais = "id"; //op��es: id

$configClassificacaoDBCEPEstadosBrasil = "Descricao"; //op��es: Codigo | Descricao

$configClassificacaoDBCEPCidadesBrasil = "Descricao"; //op��es: Codigo | Descricao

$configClassificacaoDBCEPBairrosBrasil = "Descricao"; //op��es: Codigo | Descricao

$configClassificacaoDBCEPLogradourosBrasil = "Descricao"; //op��es: Codigo | Descricao
//**************************************************************************************


//DB IBGE.
//**************************************************************************************
$habilitarDBIBGEEdicao = 0; //0-desativado | 1-ativado 

$habilitarDBIBGEPais = 0; //0-desativado | 1-ativado 
$configClassificacaoDBIBGEPais = "nome"; //op��es: id | nome | cod_ibge

$configClassificacaoDBIBGEEstadosBrasil = "estado"; //op��es: id | nome | cod_ibge
$habilitarDBIBGEEstadosBrasilICMS = 0; //0-desativado | 1-ativado 

$configClassificacaoDBIBGECidadesBrasil = "nome"; //op��es: id | nome | cod_ibge
//**************************************************************************************
?>
