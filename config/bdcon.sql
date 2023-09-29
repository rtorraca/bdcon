-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2019 at 10:30 AM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rel_db_uspbdc`
--

-- --------------------------------------------------------

--
-- Table structure for table `ce_complemento`
--

CREATE TABLE `ce_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_itens`
--

CREATE TABLE `ce_itens` (
  `id` double DEFAULT '0',
  `id_ce_pedidos` double DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `cod_item` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `tabela` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `valor_unitario` double DEFAULT '0',
  `valor_desconto` double DEFAULT '0',
  `valor_acrescimo` double DEFAULT '0',
  `id_tb_itens_valores` int(11) DEFAULT '0',
  `id_tb_itens_valores_titulo` longtext,
  `id_tb_itens_data` datetime DEFAULT NULL,
  `valor_total` double DEFAULT '0',
  `ids_opcionais` longtext,
  `ids_opcionais_descricao` longtext,
  `obs` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `ativacao` int(11) DEFAULT '0',
  `data_pedido` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `data_validade` datetime DEFAULT NULL,
  `id_tb_produtos_complemento_status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_itens_backup01`
--

CREATE TABLE `ce_itens_backup01` (
  `id` double DEFAULT '0',
  `id_ce_pedidos` double DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `cod_item` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `tabela` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `valor_unitario` double DEFAULT '0',
  `valor_total` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `data_pedido` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `data_validade` datetime DEFAULT NULL,
  `id_tb_produtos_complemento_status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_itens_temporario`
--

CREATE TABLE `ce_itens_temporario` (
  `id` double DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `data_selecao` datetime DEFAULT NULL,
  `tabela` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `valor_unitario` double DEFAULT '0',
  `id_tb_itens_valores` int(11) DEFAULT '0',
  `id_tb_itens_valores_titulo` longtext,
  `id_tb_itens_data` datetime DEFAULT NULL,
  `ids_opcionais` longtext,
  `ids_opcionais_descricao` longtext,
  `obs` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_itens_temporario_backup01`
--

CREATE TABLE `ce_itens_temporario_backup01` (
  `id` double DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `data_selecao` datetime DEFAULT NULL,
  `tabela` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `valor_unitario` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_orcamentos`
--

CREATE TABLE `ce_orcamentos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_enderecos` double DEFAULT '0',
  `id_tb_cadastro_vendedor` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_orcamento` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `valor_orcamento` double DEFAULT '0',
  `valor_frete` double DEFAULT '0',
  `periodo_contratacao` varchar(255) DEFAULT NULL,
  `tipo_entrega` varchar(255) DEFAULT NULL,
  `valor_total` double DEFAULT '0',
  `peso_total` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `id_ce_complemento_status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_orcamentos_fichas`
--

CREATE TABLE `ce_orcamentos_fichas` (
  `id` double NOT NULL DEFAULT '0',
  `id_ce_orcamentos` double DEFAULT '0',
  `id_tb_cadastro_vendedor` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_ficha` datetime DEFAULT NULL,
  `titulo` longtext,
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `id_ce_complemento_status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_orcamentos_itens`
--

CREATE TABLE `ce_orcamentos_itens` (
  `id` double NOT NULL DEFAULT '0',
  `id_ce_orcamentos` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `item_titulo` varchar(255) DEFAULT NULL,
  `item_descricao` longtext,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `arquivo6` varchar(255) DEFAULT NULL,
  `arquivo7` varchar(255) DEFAULT NULL,
  `arquivo8` varchar(255) DEFAULT NULL,
  `arquivo9` varchar(255) DEFAULT NULL,
  `arquivo10` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_orcamentos_itens_relacao_registros`
--

CREATE TABLE `ce_orcamentos_itens_relacao_registros` (
  `id` double NOT NULL DEFAULT '0',
  `data_atualizacao` datetime DEFAULT NULL,
  `id_ce_orcamentos` double DEFAULT '0',
  `id_ce_orcamentos_itens` double DEFAULT '0',
  `id_registro` double DEFAULT '0',
  `tipo_categoria` double DEFAULT '0',
  `tipo_relacao` int(11) DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_orcamentos_relacao_itens`
--

CREATE TABLE `ce_orcamentos_relacao_itens` (
  `id` double DEFAULT '0',
  `id_ce_orcamentos` double DEFAULT '0',
  `id_ce_orcamentos_itens` double DEFAULT '0',
  `tipo_item` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_orcamentos_relacao_registros`
--

CREATE TABLE `ce_orcamentos_relacao_registros` (
  `id` double NOT NULL DEFAULT '0',
  `data_atualizacao` datetime DEFAULT NULL,
  `id_ce_orcamentos` double DEFAULT '0',
  `id_registro` double DEFAULT '0',
  `tipo_registro` int(11) DEFAULT '0',
  `tipo_categoria` double DEFAULT '0',
  `tipo_relacao` int(11) DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT '0',
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_pedidos`
--

CREATE TABLE `ce_pedidos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_enderecos` double DEFAULT '0',
  `id_tb_cadastro_cartoes` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `tipo_pagamento` varchar(255) DEFAULT NULL,
  `data_pedido` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `data_validade` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `valor_pedido` double DEFAULT '0',
  `valor_frete` double DEFAULT '0',
  `periodo_contratacao` varchar(255) DEFAULT NULL,
  `tipo_entrega` varchar(255) DEFAULT NULL,
  `valor_desconto` double DEFAULT '0',
  `valor_acrescimo` double DEFAULT '0',
  `valor_total` double DEFAULT '0',
  `peso_total` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `endereco_entrega` longtext,
  `endereco_numero_entrega` varchar(255) DEFAULT NULL,
  `endereco_complemento_entrega` varchar(255) DEFAULT NULL,
  `bairro_entrega` varchar(255) DEFAULT NULL,
  `cidade_entrega` varchar(255) DEFAULT NULL,
  `estado_entrega` varchar(255) DEFAULT NULL,
  `pais_entrega` varchar(255) DEFAULT NULL,
  `cep_entrega` varchar(255) DEFAULT NULL,
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `id_tb_cadastro4` double DEFAULT '0',
  `id_tb_cadastro5` double DEFAULT '0',
  `id_tb_cadastro6` double DEFAULT '0',
  `id_tb_cadastro7` double DEFAULT '0',
  `id_tb_cadastro8` double DEFAULT '0',
  `id_tb_cadastro9` double DEFAULT '0',
  `id_tb_cadastro10` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `id_ce_complemento_status` int(11) DEFAULT '0',
  `transacao_externa_status` varchar(255) DEFAULT NULL,
  `transacao_externa_autenticacao` varchar(255) DEFAULT NULL,
  `transacao_externa_log` varchar(255) DEFAULT NULL,
  `transacao_externa_data_pagamento_liberado` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_pedidos_backup01`
--

CREATE TABLE `ce_pedidos_backup01` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_enderecos` double DEFAULT '0',
  `id_tb_cadastro_cartoes` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `tipo_pagamento` varchar(255) DEFAULT NULL,
  `data_pedido` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  `data_validade` datetime DEFAULT NULL,
  `valor_pedido` double DEFAULT '0',
  `valor_frete` double DEFAULT '0',
  `periodo_contratacao` varchar(255) DEFAULT NULL,
  `tipo_entrega` varchar(255) DEFAULT NULL,
  `valor_total` double DEFAULT '0',
  `peso_total` double DEFAULT '0',
  `endereco_entrega` longtext,
  `endereco_numero_entrega` varchar(255) DEFAULT NULL,
  `endereco_complemento_entrega` varchar(255) DEFAULT NULL,
  `bairro_entrega` varchar(255) DEFAULT NULL,
  `cidade_entrega` varchar(255) DEFAULT NULL,
  `estado_entrega` varchar(255) DEFAULT NULL,
  `pais_entrega` varchar(255) DEFAULT NULL,
  `cep_entrega` varchar(255) DEFAULT NULL,
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `id_ce_complemento_status` int(11) DEFAULT '0',
  `transacao_externa_status` varchar(255) DEFAULT NULL,
  `transacao_externa_autenticacao` varchar(255) DEFAULT NULL,
  `transacao_externa_log` varchar(255) DEFAULT NULL,
  `transacao_externa_data_pagamento_liberado` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_pedidos_log`
--

CREATE TABLE `ce_pedidos_log` (
  `id` double NOT NULL DEFAULT '0',
  `id_ce_pedidos` double DEFAULT '0',
  `id_ce_itens` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_log` datetime DEFAULT NULL,
  `tipo_log` int(11) DEFAULT '0',
  `count_log` int(11) DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_pedidos_parcelas`
--

CREATE TABLE `ce_pedidos_parcelas` (
  `id` double NOT NULL DEFAULT '0',
  `id_ce_pedidos` double DEFAULT '0',
  `n_parcela` int(11) DEFAULT '0',
  `data_vencimento` datetime DEFAULT NULL,
  `data_pagamento` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `valor` double DEFAULT '0',
  `valor_desconto` double DEFAULT '0',
  `valor_acrescimo` double DEFAULT '0',
  `valor_total` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `id_ce_complemento_tipo` double DEFAULT '0',
  `id_ce_complemento_status` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_relacao_complemento`
--

CREATE TABLE `ce_relacao_complemento` (
  `id_ce_registro` double DEFAULT '0',
  `id_ce_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ce_reservas`
--

CREATE TABLE `ce_reservas` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `data_reserva` datetime DEFAULT NULL,
  `data_inicial` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `id_ce_complementos_status` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `classificacao`
--

CREATE TABLE `classificacao` (
  `id_registro` double DEFAULT '0',
  `criterio_classificacao` varchar(255) DEFAULT NULL,
  `tabela` varchar(255) DEFAULT NULL,
  `dia_data_inicial` varchar(255) DEFAULT NULL,
  `mes_data_inicial` varchar(255) DEFAULT NULL,
  `ano_data_inicial` varchar(255) DEFAULT NULL,
  `dia_data_final` varchar(255) DEFAULT NULL,
  `mes_data_final` varchar(255) DEFAULT NULL,
  `ano_data_final` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config_bairro`
--

CREATE TABLE `config_bairro` (
  `id` double NOT NULL DEFAULT '0',
  `id_config_regiao` double DEFAULT '0',
  `id_config_cidade` double DEFAULT '0',
  `bairro` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config_cidade`
--

CREATE TABLE `config_cidade` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_estado` double DEFAULT '0',
  `cidade` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config_estado`
--

CREATE TABLE `config_estado` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_pais` double DEFAULT '0',
  `estado` varchar(255) DEFAULT NULL,
  `estado_abreviacao` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config_pais`
--

CREATE TABLE `config_pais` (
  `id` double NOT NULL DEFAULT '0',
  `pais` varchar(255) DEFAULT NULL,
  `pais_abreviacao` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `config_regiao`
--

CREATE TABLE `config_regiao` (
  `id` double NOT NULL DEFAULT '0',
  `id_config_cidade` double DEFAULT '0',
  `regiao` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contador`
--

CREATE TABLE `contador` (
  `id` int(11) DEFAULT '0',
  `contador` double DEFAULT '0',
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contador`
--

INSERT INTO `contador` (`id`, `contador`, `descricao`) VALUES
(1, 4136, 'Contador Geral'),
(2, 1, 'Contador da parte de configuracoes de pais, cidade, endereço e bairro'),
(3, 1, 'Lotes de Notas Fiscais'),
(4, 1, 'Lotes de Carga de Imóveis ZAP'),
(5, 1, 'Importação');

-- --------------------------------------------------------

--
-- Table structure for table `fl_grupos`
--

CREATE TABLE `fl_grupos` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `nome_grupo` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fl_grupos_arquivos`
--

CREATE TABLE `fl_grupos_arquivos` (
  `id` double NOT NULL DEFAULT '0',
  `id_fl_grupos` double DEFAULT '0',
  `n_classificacao` int(11) DEFAULT '0',
  `nome_slide` varchar(255) DEFAULT NULL,
  `texto1` longtext,
  `texto2` longtext,
  `texto3` longtext,
  `texto4` longtext,
  `texto5` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `imagem_offset_topo` int(11) DEFAULT '0',
  `imagem_offset_esquerda` int(11) DEFAULT '0',
  `endereco_eletronico` longtext,
  `acesso_janela` int(11) DEFAULT '0',
  `animacao_orientacao` int(11) DEFAULT '0',
  `animacao_pause` double DEFAULT '0',
  `n_cliques` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tabela_generica`
--

CREATE TABLE `tabela_generica` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tabela` int(11) DEFAULT '0',
  `n_classificacao` int(11) DEFAULT '0',
  `data_gravacao` datetime DEFAULT NULL,
  `data_registro` datetime DEFAULT NULL,
  `campo0` longtext,
  `campo1` longtext,
  `campo2` longtext,
  `campo3` longtext,
  `campo4` longtext,
  `campo5` longtext,
  `campo6` longtext,
  `campo7` longtext,
  `campo8` longtext,
  `campo9` longtext,
  `campo10` longtext,
  `campo11` longtext,
  `campo12` longtext,
  `campo13` longtext,
  `campo14` longtext,
  `campo15` longtext,
  `campo16` longtext,
  `campo17` longtext,
  `campo18` longtext,
  `campo19` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_afiliacoes`
--

CREATE TABLE `tb_afiliacoes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `afiliacao` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `tipo_cobranca` int(11) DEFAULT '0',
  `valor` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `configuracao_periodo_contratacao` int(11) DEFAULT '0',
  `configuracao_complementar` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_afiliacoes_relacoes`
--

CREATE TABLE `tb_afiliacoes_relacoes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_afiliacoes` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_animais`
--

CREATE TABLE `tb_animais` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `data_edicao` datetime DEFAULT NULL,
  `data_nascimento` datetime DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `nome` longtext,
  `apelido` varchar(255) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `descricao01` longtext,
  `descricao02` longtext,
  `descricao03` longtext,
  `descricao04` longtext,
  `descricao05` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `peso` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `id_tb_complemento_status` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `anotacoes_internas` longtext,
  `n_visitas` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_animais_complemento`
--

CREATE TABLE `tb_animais_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_animais_relacao_complemento`
--

CREATE TABLE `tb_animais_relacao_complemento` (
  `id_tb_animais` double DEFAULT '0',
  `id_tb_animais_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_arquivos`
--

CREATE TABLE `tb_arquivos` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `data_arquivo` datetime DEFAULT NULL,
  `tipo_arquivo` int(11) DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `arquivo` varchar(255) DEFAULT NULL,
  `arquivo_tumbnail` varchar(255) DEFAULT NULL,
  `tamanho_arquivo` varchar(255) DEFAULT NULL,
  `duracao_arquivo` varchar(255) DEFAULT NULL,
  `dimensao_arquivo` varchar(255) DEFAULT NULL,
  `titulo` longtext,
  `legenda` longtext,
  `descricao` longtext,
  `codigo_html` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `palavras_chave` longtext,
  `config_arquivo` int(11) DEFAULT '0',
  `n_visitas` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_arquivos`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_atendimento`
--

CREATE TABLE `tb_atendimento` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_atendimento` double DEFAULT '0',
  `nome_sala` varchar(255) DEFAULT NULL,
  `tipo_mensagem` int(11) DEFAULT '0',
  `tipo_conteudo` int(11) DEFAULT '0',
  `data_mensagem_remetente` datetime DEFAULT NULL,
  `id_tb_cadastro_remetente` double DEFAULT '0',
  `nome_remetente` varchar(255) DEFAULT NULL,
  `nick_remetente` varchar(255) DEFAULT NULL,
  `email_remetente` varchar(255) DEFAULT NULL,
  `mensagem_remetente` longtext,
  `data_mensagem_destinatario` datetime DEFAULT NULL,
  `id_tb_cadastro_destinatario` double DEFAULT '0',
  `flag_resposta` int(11) DEFAULT '0',
  `arquivo` varchar(255) DEFAULT NULL,
  `config_arquivo` int(11) DEFAULT '0',
  `dimensao_arquivo` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_destaque` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_atendimento_relacao_categorias`
--

CREATE TABLE `tb_atendimento_relacao_categorias` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_aulas`
--

CREATE TABLE `tb_aulas` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `id_tb_cadastro4` double DEFAULT '0',
  `id_tb_cadastro5` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `data_aula` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `data6` datetime DEFAULT NULL,
  `data7` datetime DEFAULT NULL,
  `data8` datetime DEFAULT NULL,
  `data9` datetime DEFAULT NULL,
  `data10` datetime DEFAULT NULL,
  `tema` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `local` varchar(255) DEFAULT NULL,
  `id_tb_aulas_status` double DEFAULT '0',
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `informacao_complementar41` longtext,
  `informacao_complementar42` longtext,
  `informacao_complementar43` longtext,
  `informacao_complementar44` longtext,
  `informacao_complementar45` longtext,
  `informacao_complementar46` longtext,
  `informacao_complementar47` longtext,
  `informacao_complementar48` longtext,
  `informacao_complementar49` longtext,
  `informacao_complementar50` longtext,
  `informacao_complementar51` longtext,
  `informacao_complementar52` longtext,
  `informacao_complementar53` longtext,
  `informacao_complementar54` longtext,
  `informacao_complementar55` longtext,
  `informacao_complementar56` longtext,
  `informacao_complementar57` longtext,
  `informacao_complementar58` longtext,
  `informacao_complementar59` longtext,
  `informacao_complementar60` longtext,
  `carga_horaria` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `reposicao` int(11) DEFAULT '0',
  `anotacoes_internas` longtext,
  `n_visitas` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_aulas_complemento`
--

CREATE TABLE `tb_aulas_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_aulas_relacao_complemento`
--

CREATE TABLE `tb_aulas_relacao_complemento` (
  `id_tb_aulas` double DEFAULT '0',
  `id_tb_aulas_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_banners`
--

CREATE TABLE `tb_banners` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `grupo` varchar(255) DEFAULT NULL,
  `n_banners` int(11) DEFAULT '0',
  `descricao` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_banners_arquivos`
--

CREATE TABLE `tb_banners_arquivos` (
  `id` int(11) NOT NULL DEFAULT '0',
  `id_tb_banners` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `tipo_publicacao` int(11) DEFAULT '0',
  `data_publicacao` datetime DEFAULT NULL,
  `data_inicial` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `endereco_eletronico` longtext,
  `codigo_html` longtext,
  `obs` longtext,
  `dimensao_w` int(11) DEFAULT '0',
  `dimensao_h` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `arquivo` varchar(255) DEFAULT NULL,
  `n_impressoes` double DEFAULT '0',
  `n_impressoes_contratacao` double DEFAULT '0',
  `n_cliques` double DEFAULT '0',
  `n_cliques_contratacao` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_banners_relacao_categorias`
--

CREATE TABLE `tb_banners_relacao_categorias` (
  `id_tb_banners_arquivos` double DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro`
--

CREATE TABLE `tb_cadastro` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_parent_cadastro` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_cadastro` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `data6` datetime DEFAULT NULL,
  `data7` datetime DEFAULT NULL,
  `data8` datetime DEFAULT NULL,
  `data9` datetime DEFAULT NULL,
  `data10` datetime DEFAULT NULL,
  `pf_pj` int(11) DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `sexo` int(11) DEFAULT '0',
  `altura` double DEFAULT '0',
  `peso` double DEFAULT '0',
  `razao_social` varchar(255) DEFAULT NULL,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `data_nascimento` datetime DEFAULT NULL,
  `cpf_` varchar(255) DEFAULT NULL,
  `rg_` varchar(255) DEFAULT NULL,
  `cnpj_` varchar(255) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `i_municipal` varchar(255) DEFAULT NULL,
  `i_estadual` varchar(255) DEFAULT NULL,
  `endereco_principal` varchar(255) DEFAULT NULL,
  `endereco_numero_principal` varchar(255) DEFAULT NULL,
  `endereco_complemento_principal` varchar(255) DEFAULT NULL,
  `bairro_principal` varchar(255) DEFAULT NULL,
  `cidade_principal` varchar(255) DEFAULT NULL,
  `estado_principal` varchar(255) DEFAULT NULL,
  `pais_principal` varchar(255) DEFAULT NULL,
  `id_config_bairro` double DEFAULT '0',
  `id_config_cidade` double DEFAULT '0',
  `id_config_estado` double DEFAULT '0',
  `id_config_regiao` double DEFAULT '0',
  `id_config_pais` double DEFAULT '0',
  `id_db_cep_tblBairros` double DEFAULT '0',
  `id_db_cep_tblCidades` double DEFAULT '0',
  `id_db_cep_tblLogradouros` double DEFAULT '0',
  `id_db_cep_tblUF` varchar(255) DEFAULT NULL,
  `cep_principal` varchar(255) DEFAULT NULL,
  `ponto_referencia` longtext,
  `email_principal` varchar(255) DEFAULT NULL,
  `tel_ddd_principal` varchar(255) DEFAULT NULL,
  `tel_principal` varchar(255) DEFAULT NULL,
  `cel_ddd_principal` varchar(255) DEFAULT NULL,
  `cel_principal` varchar(255) DEFAULT NULL,
  `fax_ddd_principal` varchar(255) DEFAULT NULL,
  `fax_principal` varchar(255) DEFAULT NULL,
  `site_principal` varchar(255) DEFAULT NULL,
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `n_funcionarios` int(11) DEFAULT '0',
  `obs_interno` longtext,
  `id_tb_cadastro_status` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `ativacao_destaque` int(11) DEFAULT '0',
  `ativacao_mala_direta` int(11) DEFAULT '0',
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `mapa` varchar(255) DEFAULT NULL,
  `mapa_online` longtext,
  `palavras_chave` longtext,
  `url_amigavel` longtext,
  `apresentacao` longtext,
  `servicos` longtext,
  `promocoes` longtext,
  `condicoes_comerciais` longtext,
  `formas_pagamento` longtext,
  `horario_atendimento` longtext,
  `situacao_atual` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `n_visitas` int(11) DEFAULT '0',
  `origem_cadastro` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cadastro`
--

INSERT INTO `tb_cadastro` (`id`, `id_tb_categorias`, `id_parent_cadastro`, `n_classificacao`, `data_cadastro`, `data1`, `data2`, `data3`, `data4`, `data5`, `data6`, `data7`, `data8`, `data9`, `data10`, `pf_pj`, `nome`, `sexo`, `altura`, `peso`, `razao_social`, `nome_fantasia`, `data_nascimento`, `cpf_`, `rg_`, `cnpj_`, `documento`, `i_municipal`, `i_estadual`, `endereco_principal`, `endereco_numero_principal`, `endereco_complemento_principal`, `bairro_principal`, `cidade_principal`, `estado_principal`, `pais_principal`, `id_config_bairro`, `id_config_cidade`, `id_config_estado`, `id_config_regiao`, `id_config_pais`, `id_db_cep_tblBairros`, `id_db_cep_tblCidades`, `id_db_cep_tblLogradouros`, `id_db_cep_tblUF`, `cep_principal`, `ponto_referencia`, `email_principal`, `tel_ddd_principal`, `tel_principal`, `cel_ddd_principal`, `cel_principal`, `fax_ddd_principal`, `fax_principal`, `site_principal`, `url1`, `url2`, `url3`, `url4`, `url5`, `n_funcionarios`, `obs_interno`, `id_tb_cadastro_status`, `id_tb_cadastro`, `id_tb_cadastro1`, `id_tb_cadastro2`, `id_tb_cadastro3`, `ativacao`, `ativacao1`, `ativacao2`, `ativacao3`, `ativacao4`, `ativacao_destaque`, `ativacao_mala_direta`, `usuario`, `senha`, `imagem`, `arquivo1`, `arquivo2`, `arquivo3`, `arquivo4`, `arquivo5`, `logo`, `banner`, `mapa`, `mapa_online`, `palavras_chave`, `url_amigavel`, `apresentacao`, `servicos`, `promocoes`, `condicoes_comerciais`, `formas_pagamento`, `horario_atendimento`, `situacao_atual`, `informacao_complementar1`, `informacao_complementar2`, `informacao_complementar3`, `informacao_complementar4`, `informacao_complementar5`, `informacao_complementar6`, `informacao_complementar7`, `informacao_complementar8`, `informacao_complementar9`, `informacao_complementar10`, `informacao_complementar11`, `informacao_complementar12`, `informacao_complementar13`, `informacao_complementar14`, `informacao_complementar15`, `informacao_complementar16`, `informacao_complementar17`, `informacao_complementar18`, `informacao_complementar19`, `informacao_complementar20`, `informacao_complementar21`, `informacao_complementar22`, `informacao_complementar23`, `informacao_complementar24`, `informacao_complementar25`, `informacao_complementar26`, `informacao_complementar27`, `informacao_complementar28`, `informacao_complementar29`, `informacao_complementar30`, `informacao_complementar31`, `informacao_complementar32`, `informacao_complementar33`, `informacao_complementar34`, `informacao_complementar35`, `informacao_complementar36`, `informacao_complementar37`, `informacao_complementar38`, `informacao_complementar39`, `informacao_complementar40`, `n_visitas`, `origem_cadastro`) VALUES
(3482, 3479, 0, 0, '2018-08-10 11:30:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste01 - Master', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste01', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 'iCK+6g1OcxrUI8A5W+TkfEyq37+BVg6/qg80grp+HBkOjki4y2J9cxxg3UepqC35Gvh2ZGxnySne3rKsPS1XH8ZxuDd5vb29XLRzSe7XUNgqOJfYcS89krQsBfrb2Og4|h5B0+Qbaw5wecnomIOd/lqbtYZyGHSg7xUFNWPyTJaY=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3770, 3479, 0, 0, '2018-11-10 19:21:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste02 - Nível 2', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste02', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 'ZOflUlZBPtq93Y75gAuyD0ruMfyIAxVhqPS+gmAGmm87yinqziLoqgZPi29WH5gP8yjR95+TTiSTuDA4WSXo1QSCbamzrPcwUHRQ6jY1jTHetV/Fr6mPsp0UygbOquwF|nlj6rIyKwjfaIsVJxGzT0Ui/vUyY8qp4PmpSxkCh5Oo=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3804, 3479, 0, 0, '2018-11-23 09:27:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste03', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste03', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 'vGu0eEMTQu1kw4SErZmUh6u/XToib1RUA8uUhwd/RriBT0lRXNm1GwTPFiCPff1/uAGjdUFW++Rr7pIWj37kGLFK+sgyAScgai9MtUURbs0zKgjOaYgGHIX969eak4cL|fm0VoLnDaYWOAF+/Udo7yP/SojDxz83xgSVnWQi6/v8=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3811, 3479, 0, 0, '2018-11-26 19:08:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste04', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste04', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, '0M7OCkGwdwLmloe+ytzRflQc3iUc8gjuaWClTknzK+c81/4Z9wYB3rg4fmw3ZpEH4uLZs1gPL6Dx9PORUsIJ+RA5iXF8bnI3GAB3iFwG7sqk2R7ZA6In/Di27VjLYPf5|zxLWaAzGU4vWHJGNzU0JNxL6CWyRnoP1HnLpr7DfmBk=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3820, 3479, 0, 0, '2018-12-17 18:40:47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste05 - Nível 2', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste05', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, '0M7OCkGwdwLmloe+ytzRflQc3iUc8gjuaWClTknzK+c81/4Z9wYB3rg4fmw3ZpEH4uLZs1gPL6Dx9PORUsIJ+RA5iXF8bnI3GAB3iFwG7sqk2R7ZA6In/Di27VjLYPf5|zxLWaAzGU4vWHJGNzU0JNxL6CWyRnoP1HnLpr7DfmBk=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3821, 3479, 0, 0, '2018-12-17 18:41:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste06 - Nível 3', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste06', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 'K8Od84WfWgxgK8uL5RVHI/gyDHpG6kchTqR+4M5QEaQTppM0PJAB4TE3RjYMCg618Q99zkDJmajPOw4ra6FC3mCc3LAY1OSM1od+NQsLDq7s/AO6zRJnhCRe+H0ncHhk|njhU2njx0oMZ0er38YyoFMWCVLFU0MmBNDdTsdGUelk=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3822, 3479, 0, 0, '2018-12-17 18:42:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste07 - Nível 4', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste07', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 'E8HNuuvXNDY1K0DvipCOai3BBW4A8ILTPayeVERum/MyTKyXLvLlWsWLsSYW50lIpLggPxxy6dxd6wz7e7ooncb5ykGeDC+mctIbNQQZag1TY3pmPqeBqqEqvzUdpd09|iz+Uu4lTo8NYh5ihKKBHYISt6qmrpM7LbuNKQvNicfw=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(3823, 3479, 0, 0, '2018-12-17 18:42:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Teste08 - Nível 5', NULL, NULL, NULL, '', '', NULL, '', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, '0', '', NULL, 'teste08', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, NULL, 'ihG5kvud+kDRhnru6NNHnAoDhLHbpxcx3ZkVaHhMUCjuvFoV88C0wZ7A4M2SO0L5f0MukQJoRSkiBbzDKZakqB0HQ0L8VflpjOnYe/q4RYQfqYt2Fgs/8rtolQMr5Km7|YDmMwSJfWZP3e8h0GMlkKedEOrV/qCJcpgBBZhA4SLI=', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_backup01`
--

CREATE TABLE `tb_cadastro_backup01` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_parent_cadastro` double DEFAULT '0',
  `data_cadastro` datetime DEFAULT NULL,
  `pf_pj` int(11) DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `sexo` int(11) DEFAULT '0',
  `altura` double DEFAULT '0',
  `peso` double DEFAULT '0',
  `razao_social` varchar(255) DEFAULT NULL,
  `nome_fantasia` varchar(255) DEFAULT NULL,
  `data_nascimento` datetime DEFAULT NULL,
  `cpf_` varchar(255) DEFAULT NULL,
  `rg_` varchar(255) DEFAULT NULL,
  `cnpj_` varchar(255) DEFAULT NULL,
  `documento` varchar(255) DEFAULT NULL,
  `i_municipal` varchar(255) DEFAULT NULL,
  `i_estadual` varchar(255) DEFAULT NULL,
  `endereco_principal` varchar(255) DEFAULT NULL,
  `endereco_numero_principal` varchar(255) DEFAULT NULL,
  `endereco_complemento_principal` varchar(255) DEFAULT NULL,
  `bairro_principal` varchar(255) DEFAULT NULL,
  `cidade_principal` varchar(255) DEFAULT NULL,
  `estado_principal` varchar(255) DEFAULT NULL,
  `pais_principal` varchar(255) DEFAULT NULL,
  `id_config_bairro` double DEFAULT '0',
  `id_config_cidade` double DEFAULT '0',
  `id_config_estado` double DEFAULT '0',
  `id_config_regiao` double DEFAULT '0',
  `id_config_pais` double DEFAULT '0',
  `id_db_cep_tblBairros` double DEFAULT '0',
  `id_db_cep_tblCidades` double DEFAULT '0',
  `id_db_cep_tblLogradouros` double DEFAULT '0',
  `id_db_cep_tblUF` varchar(255) DEFAULT NULL,
  `cep_principal` varchar(255) DEFAULT NULL,
  `ponto_referencia` longtext,
  `email_principal` varchar(255) DEFAULT NULL,
  `tel_ddd_principal` varchar(255) DEFAULT NULL,
  `tel_principal` varchar(255) DEFAULT NULL,
  `cel_ddd_principal` varchar(255) DEFAULT NULL,
  `cel_principal` varchar(255) DEFAULT NULL,
  `fax_ddd_principal` varchar(255) DEFAULT NULL,
  `fax_principal` varchar(255) DEFAULT NULL,
  `site_principal` varchar(255) DEFAULT NULL,
  `n_funcionarios` int(11) DEFAULT '0',
  `obs_interno` longtext,
  `id_tb_cadastro_status` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao_destaque` int(11) DEFAULT '0',
  `ativacao_mala_direta` int(11) DEFAULT '0',
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `mapa` varchar(255) DEFAULT NULL,
  `mapa_online` longtext,
  `palavras_chave` longtext,
  `apresentacao` longtext,
  `servicos` longtext,
  `promocoes` longtext,
  `condicoes_comerciais` longtext,
  `formas_pagamento` longtext,
  `horario_atendimento` longtext,
  `situacao_atual` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `n_visitas` int(11) DEFAULT '0',
  `origem_cadastro` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_cartoes`
--

CREATE TABLE `tb_cadastro_cartoes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `cartao_data_inclusao` datetime DEFAULT NULL,
  `cartao_bandeira` int(11) DEFAULT '0',
  `cartao_nome` varchar(255) DEFAULT NULL,
  `n_cartao_crypt` longtext,
  `codigo_seguranca_crypt` longtext,
  `cartao_mes_adesao` int(11) DEFAULT '0',
  `cartao_ano_adesao` int(11) DEFAULT '0',
  `cartao_mes_validade` int(11) DEFAULT '0',
  `cartao_ano_validade` int(11) DEFAULT '0',
  `verificacao` double DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `nome_cobranca` varchar(255) DEFAULT NULL,
  `endereco_cobranca` varchar(255) DEFAULT NULL,
  `endereco_numero_cobranca` varchar(255) DEFAULT NULL,
  `endereco_complemento_cobranca` varchar(255) DEFAULT NULL,
  `bairro_cobranca` varchar(255) DEFAULT NULL,
  `cidade_cobranca` varchar(255) DEFAULT NULL,
  `estado_cobranca` varchar(255) DEFAULT NULL,
  `pais_cobranca` varchar(255) DEFAULT NULL,
  `cep_cobranca` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_complemento`
--

CREATE TABLE `tb_cadastro_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` double DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL,
  `anotacoes_banco03` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cadastro_complemento`
--

INSERT INTO `tb_cadastro_complemento` (`id`, `tipo_complemento`, `complemento`, `descricao`, `anotacoes_banco`, `anotacoes_banco02`, `anotacoes_banco03`) VALUES
(3480, 1, 'Usuário - Master', '', NULL, NULL, NULL),
(3481, 1, 'Usuário - Nível 2', 'Não apaga registros.\r\nInclusão de tudo.', NULL, NULL, NULL),
(3771, 1, 'Usuário - Nível 3', 'Inclusão de obra (identificação).\r\nHigienização (edição).\r\n', NULL, NULL, NULL),
(3772, 1, 'Usuário - Nível 4', 'Pesquisa qualquer registro.', NULL, NULL, NULL),
(3773, 1, 'Usuário - Nível 5', 'Visualizar identificação e tipo de tratamento.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_config_transacoes`
--

CREATE TABLE `tb_cadastro_config_transacoes` (
  `id` int(11) NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `config_empresa_trasacao` double DEFAULT '0',
  `config_transacao` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_contas_bancarias`
--

CREATE TABLE `tb_cadastro_contas_bancarias` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `titulo_conta` varchar(255) DEFAULT NULL,
  `nome_titular` varchar(255) DEFAULT NULL,
  `cpf_cnpj` varchar(255) DEFAULT NULL,
  `n_banco` int(11) DEFAULT '0',
  `n_agencia` varchar(50) DEFAULT NULL,
  `digito_agencia` varchar(50) DEFAULT NULL,
  `n_conta` varchar(50) DEFAULT NULL,
  `digito_conta` varchar(50) DEFAULT NULL,
  `tipo_conta` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_contatos`
--

CREATE TABLE `tb_cadastro_contatos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `filial` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `departamento` varchar(50) DEFAULT NULL,
  `tel_ddd` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `cel_ddd` varchar(255) DEFAULT NULL,
  `cel` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contato_senha` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `contato_endereco` varchar(255) DEFAULT NULL,
  `contato_endereco_numero` varchar(255) DEFAULT NULL,
  `contato_endereco_complemento` varchar(255) DEFAULT NULL,
  `contato_bairro` varchar(255) DEFAULT NULL,
  `contato_cidade` varchar(255) DEFAULT NULL,
  `contato_municipio` varchar(255) DEFAULT NULL,
  `contato_estado` varchar(255) DEFAULT NULL,
  `contato_pais` varchar(255) DEFAULT NULL,
  `contato_cep` varchar(255) DEFAULT NULL,
  `contato_ponto_referencia` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_dominios`
--

CREATE TABLE `tb_cadastro_dominios` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `registro_dominio` varchar(255) DEFAULT NULL,
  `site_registro` longtext,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_dominios_urls`
--

CREATE TABLE `tb_cadastro_dominios_urls` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro_dominios` double DEFAULT '0',
  `dominio` longtext,
  `data_criacao` datetime DEFAULT NULL,
  `data_expiracao` datetime DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_enderecos`
--

CREATE TABLE `tb_cadastro_enderecos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `tipo_endereco` int(11) DEFAULT '0',
  `data_endereco` datetime DEFAULT NULL,
  `horario` varchar(255) DEFAULT NULL,
  `endereco_titulo` varchar(255) DEFAULT NULL,
  `endereco_descricao` longtext,
  `endereco_site` longtext,
  `endereco_email` varchar(255) DEFAULT NULL,
  `id_config_bairro` double DEFAULT '0',
  `id_config_cidade` double DEFAULT '0',
  `id_config_estado` double DEFAULT '0',
  `id_config_regiao` double DEFAULT '0',
  `id_config_pais` double DEFAULT '0',
  `id_db_cep_tblBairros` double DEFAULT '0',
  `id_db_cep_tblCidades` double DEFAULT '0',
  `id_db_cep_tblLogradouros` double DEFAULT '0',
  `id_db_cep_tblUF` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `endereco_numero` varchar(255) DEFAULT NULL,
  `endereco_complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `ponto_referencia` longtext,
  `mapa_online` longtext,
  `ativacao` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_hosts`
--

CREATE TABLE `tb_cadastro_hosts` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `conta` varchar(255) DEFAULT NULL,
  `host_www` varchar(255) DEFAULT NULL,
  `host_ftp` varchar(255) DEFAULT NULL,
  `host_temp` varchar(255) DEFAULT NULL,
  `host_ip` varchar(255) DEFAULT NULL,
  `usuario_ftp` varchar(255) DEFAULT NULL,
  `senha_ftp` varchar(255) DEFAULT NULL,
  `host_painel` varchar(255) DEFAULT NULL,
  `usuario_painel` varchar(255) DEFAULT NULL,
  `senha_painel` varchar(255) DEFAULT NULL,
  `host_webmail` varchar(255) DEFAULT NULL,
  `servidor_pop` varchar(255) DEFAULT NULL,
  `servidor_smtp` varchar(255) DEFAULT NULL,
  `id_tb_cadastro_servidor` double DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_hosts_emails`
--

CREATE TABLE `tb_cadastro_hosts_emails` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_hosts` double DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `usuario_email` varchar(255) DEFAULT NULL,
  `senha_email` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_log`
--

CREATE TABLE `tb_cadastro_log` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `tipo_log` double DEFAULT '0',
  `data_log` double DEFAULT '0',
  `acao` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_login_simultaneo`
--

CREATE TABLE `tb_cadastro_login_simultaneo` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent_ativo` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_atendimento` double DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `nick` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_tb_cadastro_ip` varchar(255) DEFAULT NULL,
  `data_hora_login` datetime DEFAULT NULL,
  `flag_login` double DEFAULT '0',
  `data_hora_ultima_verificacao` datetime DEFAULT NULL,
  `preferencias_cor` varchar(255) DEFAULT NULL,
  `preferencias_fonte` varchar(255) DEFAULT NULL,
  `preferencias_fonte_tamanho` varchar(255) DEFAULT NULL,
  `preferencias_imagem` varchar(255) DEFAULT NULL,
  `id_tb_cadastro_banido` int(11) DEFAULT '0',
  `id_tb_cadastro_ip_banido` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_login_verificacao`
--

CREATE TABLE `tb_cadastro_login_verificacao` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `data_registro` datetime DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_relacao_complemento`
--

CREATE TABLE `tb_cadastro_relacao_complemento` (
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cadastro_relacao_complemento`
--

INSERT INTO `tb_cadastro_relacao_complemento` (`id_tb_cadastro`, `id_tb_cadastro_complemento`, `tipo_complemento`) VALUES
(3482, 3480, 1),
(3770, 3481, 1),
(3804, 3480, 1),
(3811, 3480, 1),
(3820, 3481, 1),
(3821, 3771, 1),
(3822, 3772, 1),
(3823, 3773, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_rh`
--

CREATE TABLE `tb_cadastro_rh` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `empregado_atualmente` int(11) DEFAULT '0',
  `objetivo` longtext,
  `informacoes_complementares` longtext,
  `resumo_curriculo` longtext,
  `pretensao_salarial_min` double DEFAULT '0',
  `pretensao_salarial_max` double DEFAULT '0',
  `estado_civil` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_rh_contrato`
--

CREATE TABLE `tb_cadastro_rh_contrato` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_rh` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_produtos` double DEFAULT '0',
  `valor_cadastro` double DEFAULT '0',
  `valor_rh` double DEFAULT '0',
  `valor1a` double DEFAULT '0',
  `valor1a_obs` varchar(255) DEFAULT NULL,
  `valor2a` double DEFAULT '0',
  `valor2a_obs` varchar(255) DEFAULT NULL,
  `valor3a` double DEFAULT '0',
  `valor3a_obs` varchar(255) DEFAULT NULL,
  `valor1s` double DEFAULT '0',
  `valor1s_obs` varchar(255) DEFAULT NULL,
  `valor2s` double DEFAULT '0',
  `valor2s_obs` varchar(255) DEFAULT NULL,
  `valor3s` double DEFAULT '0',
  `valor3s_obs` varchar(255) DEFAULT NULL,
  `data_contrato` datetime DEFAULT NULL,
  `data_contrato_final` datetime DEFAULT NULL,
  `data_prestacao` datetime DEFAULT NULL,
  `escala` varchar(50) DEFAULT NULL,
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_rh_escolaridade`
--

CREATE TABLE `tb_cadastro_rh_escolaridade` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `grau` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_conclusao` datetime DEFAULT NULL,
  `ano_atual` varchar(255) DEFAULT NULL,
  `nome_instituicao` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_rh_experiencia`
--

CREATE TABLE `tb_cadastro_rh_experiencia` (
  `id` int(11) NOT NULL DEFAULT '0',
  `id_tb_cadastro` int(11) DEFAULT '0',
  `data_entrada` datetime DEFAULT NULL,
  `data_saida` datetime DEFAULT NULL,
  `emprego_atual` int(11) DEFAULT '0',
  `nome_empresa` varchar(255) DEFAULT NULL,
  `cargo_empresa` varchar(255) DEFAULT NULL,
  `salario_empresa` varchar(255) DEFAULT NULL,
  `atribuicoes` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_rh_idiomas`
--

CREATE TABLE `tb_cadastro_rh_idiomas` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_complemento` int(11) DEFAULT '0',
  `nivel_idioma` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_saques`
--

CREATE TABLE `tb_cadastro_saques` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_contas_bancarias` double DEFAULT '0',
  `data_saque` datetime DEFAULT NULL,
  `data_deposito` datetime DEFAULT NULL,
  `valor` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_vinculos`
--

CREATE TABLE `tb_cadastro_vinculos` (
  `id` double NOT NULL DEFAULT '0',
  `vinculo` varchar(255) DEFAULT NULL,
  `descricao` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cadastro_vinculos_relacao`
--

CREATE TABLE `tb_cadastro_vinculos_relacao` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_cadastro_vinculo` int(11) DEFAULT '0',
  `id_tb_cadastro_vinculado` double DEFAULT '0',
  `id_tb_cadastro_vinculado_ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `n_nivel` int(11) DEFAULT '0',
  `data_categoria` datetime DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `tipo_categoria` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_categorias`
--

INSERT INTO `tb_categorias` (`id`, `id_parent`, `n_classificacao`, `id_tb_cadastro_usuario`, `n_nivel`, `data_categoria`, `categoria`, `descricao`, `informacao_complementar1`, `informacao_complementar2`, `informacao_complementar3`, `informacao_complementar4`, `informacao_complementar5`, `tipo_categoria`, `imagem`, `ativacao`, `acesso_restrito`) VALUES
(3478, 0, 0, 0, 0, '2018-08-10 11:16:37', 'Obras', '', '', '', '', '', '', 2, NULL, 1, 0),
(3479, 0, 0, 0, 0, '2018-08-10 11:16:44', 'Cadastro', '', '', '', '', '', '', 13, NULL, 1, 0),
(3629, 0, 0, 0, 0, '2018-09-15 14:43:31', 'Instruções', '', '', '', '', '', '', 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_categorias_estrutura`
--

CREATE TABLE `tb_categorias_estrutura` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` int(11) DEFAULT '0',
  `id_top_nivel` int(11) DEFAULT '0',
  `total_niveis` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_categorias_relacao_registros`
--

CREATE TABLE `tb_categorias_relacao_registros` (
  `id_tb_registro` double DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `tipo_categoria` double DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_classificados`
--

CREATE TABLE `tb_classificados` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `data_classificado` datetime DEFAULT NULL,
  `classificado` varchar(255) DEFAULT NULL,
  `estado_civil` int(11) DEFAULT '0',
  `descricao` longtext,
  `porte_empresa` varchar(255) DEFAULT NULL,
  `exigencias` longtext,
  `beneficios` longtext,
  `localidade` varchar(255) DEFAULT NULL,
  `quantidade_classificado` int(11) DEFAULT '0',
  `valor_classificado` double DEFAULT '0',
  `faixa_etaria_min` int(11) DEFAULT '0',
  `faixa_etaria_max` int(11) DEFAULT '0',
  `nome_responsavel` varchar(255) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `link_externo` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_info_cadastro` int(11) DEFAULT '0',
  `obs` longtext,
  `n_visitas` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_classificados_relacao_complemento`
--

CREATE TABLE `tb_classificados_relacao_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_classificados` double DEFAULT '0',
  `id_tb_cadastro_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_conteudo`
--

CREATE TABLE `tb_conteudo` (
  `id` double NOT NULL DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `tipo_conteudo` int(11) DEFAULT '0',
  `alinhamento_texto` int(11) DEFAULT '0',
  `alinhamento_imagem` int(11) DEFAULT '0',
  `conteudo` longtext,
  `conteudo_link` longtext,
  `arquivo` varchar(255) DEFAULT NULL,
  `config_arquivo` int(11) DEFAULT '0',
  `dimensao_arquivo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_conteudo`
--

INSERT INTO `tb_conteudo` (`id`, `n_classificacao`, `id_tb_categorias`, `id_tb_cadastro`, `tipo_conteudo`, `alinhamento_texto`, `alinhamento_imagem`, `conteudo`, `conteudo_link`, `arquivo`, `config_arquivo`, `dimensao_arquivo`) VALUES
(3827, 0, 3629, 0, 1, 3, 0, 'Introdução', '', NULL, 2, ','),
(3828, 0, 3629, 0, 3, 4, 0, 'O projeto consiste em dois acessos principais para interatividade e gerenciamento. \r\n\r\n', '', NULL, 2, ','),
(3829, 0, 3629, 0, 2, 3, 0, 'Frontend:', '', NULL, 2, ','),
(3830, 0, 3629, 0, 4, 3, 0, '- Acesso pelos usuários criados no backend;\r\n- Interatividade com os dados cadastrados no banco de dados – inclusão/edição/exclusão de obras, inclusão/edição/exclusão de tratamentos, inclusão/edição/exclusão de arquivos, inclusão de testes de solubilidade; \r\n- Busca;\r\n- Visualização de relatórios;\r\n\r\n', '', NULL, 2, ','),
(3831, 0, 3629, 0, 2, 3, 0, 'Backend:', '', NULL, 2, ','),
(3832, 0, 3629, 0, 4, 3, 0, '- Útil para criação de usuários e definição de níveis de acesso;\r\n- Correção de qualquer informação com acesso a todas as funcionalidades;\r\n- Inclusão/edição de informações sobre as instruções do sistema.\r\n\r\n', '', NULL, 2, ','),
(3833, 0, 3629, 0, 1, 3, 0, 'Frontend', '', NULL, 2, ','),
(3834, 0, 3629, 0, 2, 3, 0, 'Login - tela de acesso restrito:', '', NULL, 2, ','),
(3836, 0, 3629, 0, 3, 4, 0, 'Acesse o endereço http://143.107.127.22/ e encontrará a tela de login/acesso restrito ao frontend do sistema. \r\n\r\n', '', NULL, 2, ','),
(3837, 0, 3629, 0, 5, 2, 2, '', '', '3837.jpg', 2, ','),
(3838, 0, 3629, 0, 3, 4, 0, '\r\nA inclusão de usuários para acesso ao sistema é realizada pelo backend (instruções em outra parte do manual). Ao acessar a tela de login, informe o e-mail e senha definidos na criação de usuário e clique no botão “login”.\r\n\r\n', '', NULL, 2, ','),
(3839, 0, 3629, 0, 2, 3, 0, 'Painel de Controle:', '', NULL, 2, ','),
(3840, 0, 3629, 0, 3, 4, 0, 'Após a autenticação das informações bem sucedidas, será direcionado a uma tela com as opções principais de interatividade com o sistema. Segue uma pequena descrição sobre cada opção:\r\n\r\n- Painel de Controle:\r\nVolta para as opções iniciais do sistema.\r\n\r\n- Nova Entrada de Obra:\r\nAo passar o mouse, abre um “dropdown menu” com as opções para acessar cada tipo de obra. \r\n\r\n- Busca:\r\nÁrea para realizar busca simplificada pelas obras.\r\n\r\n- Relatórios:\r\nÁrea para definir critérios para geração de relatórios.\r\n\r\n- Instruções:\r\nInformações sobre uso do sistema (backend e frontend).\r\n\r\n- Logoff:\r\nTerminar a sessão, excluir o cookie de identificação de autenticação e sair do sistema.\r\n\r\n', '', NULL, 2, ','),
(3841, 0, 3629, 0, 2, 3, 0, 'Nova Entrada de Obra', '', NULL, 2, ','),
(3842, 0, 3629, 0, 3, 4, 0, 'Ao passar o mouse por esta opção, abrirá um “dropdown menu” para escolher qual tipo de obra gostaria de ter interatividade. Depois de escolher uma das áreas disponíveis, será direcionado para a listagem de obras incluídas nesta determinada área, com informações resumidas – Imagem, Identificação, Trava.\r\n\r\n', '', NULL, 2, ','),
(3843, 0, 3629, 0, 5, 2, 2, '', '', '3843.jpg', 2, ','),
(3844, 0, 3629, 0, 2, 3, 0, '- Remover Obra:', '', NULL, 2, ','),
(3845, 0, 3629, 0, 3, 4, 0, 'Existe uma coluna na listagem das obras incluídas de uma determinada área chamada “X”. Serve para remover uma obra do sistema (excluir do banco de dados). Caso gostaria de remover qualquer obra, selecione a obra pela caixa de seleção desta coluna e acione o botão “Remover”.\r\nATENÇÃO: Os dados daquela determinada obra serão excluídas permanentemente do banco de dados do sistema. Utilize esta função apenas quando tiver 100% de certeza que gostaria de fazer uma exclusão ou que tenha incluído um registro por engano. Mesmo se for um registro por engano, a sugestão seria de editar a obra e clicar no botão “Cancelar/Excluir”. Tem o mesmo efeito. Porém, te dará uma oportunidade de revisar as informações daquela obra para certificar-se de que é a obra correta que gostaria de excluir do sistema.\r\n\r\n', '', NULL, 2, ','),
(3846, 0, 3629, 0, 2, 3, 0, '- Listagem de Obras:', '', NULL, 2, ','),
(3847, 0, 3629, 0, 3, 4, 0, 'Após passar o mouse em “Nova Entrada de Obra” e escolher o tipo de obra que gostaria de adicionar, encontrará uma listagem das obras incluídas nesta determinada área, com as colunas “X”, “E”, Imagem, Identificação e Trava. \r\n\r\n', '', NULL, 2, ','),
(3848, 0, 3629, 0, 2, 3, 0, '- Incluir Nova Obra:', '', NULL, 2, ','),
(3849, 0, 3629, 0, 3, 4, 0, 'Acione este botão para incluir uma nova entrada de obra. Ao clicar nesta opção, será direcionado a tela de edição de informações principais sobre a obra a ser cadastrada. A interface é dividida em e áreas – informações principais da obra, imagem principal da obra e ficha técnica de tratamento.\r\n\r\n', '', NULL, 2, ','),
(3850, 0, 3629, 0, 5, 2, 2, '', '', '3850.jpg', 2, ','),
(3851, 0, 3629, 0, 3, 4, 0, '\r\nCada área possui campos específicos para cadastramento. \r\n\r\n', '', NULL, 2, ','),
(3852, 0, 3629, 0, 5, 2, 2, 'Exemplo de tela de cadastramento/edição de informações de diplomas.', '', '3852.jpg', 2, ','),
(3853, 0, 3629, 0, 5, 2, 2, 'Exemplo de tela de cadastramento/edição de informações de documentos.', '', '3853.jpg', 2, ','),
(3854, 0, 3629, 0, 5, 2, 2, 'Exemplo de tela de cadastramento/edição de informações de fotografia.', '', '3854.jpg', 2, ','),
(3855, 0, 3629, 0, 5, 2, 2, 'Exemplo de tela de cadastramento/edição de informações de livros.', '', '3855.jpg', 2, ','),
(3856, 0, 3629, 0, 5, 2, 2, 'Exemplo de tela de cadastramento/edição de informações de mapas.', '', '3856.jpg', 2, ','),
(3857, 0, 3629, 0, 5, 2, 2, 'Exemplo de tela de cadastramento/edição de informações de obras de arte.', '', '3857.jpg', 2, ','),
(3858, 0, 3629, 0, 3, 4, 0, 'ATENÇÃO: Caso não seja sua intenção de cadastrar uma nova obra, deverá clicar no botão “Excluir/Cancelar”, localizado na parte inferior/centro da tela para eliminar o registro da obra criada, depois que tiver acionado o botão “Incluir Nova Obra”. \r\n\r\n', '', NULL, 2, ','),
(3859, 0, 3629, 0, 5, 2, 2, '', '', '3859.jpg', 2, ','),
(3860, 0, 3629, 0, 3, 4, 0, '\r\nApós o preenchimento dos dados principais da obra, deverá acionar o botão salvar. Caso o acionamento seja realizado com sucesso, terá uma mensagem próximo ao botão salvar indicando que o registro foi atualizado com sucesso.\r\n\r\n', '', NULL, 2, ','),
(3861, 0, 3629, 0, 2, 3, 0, 'Funções complementares:', '', NULL, 2, ','),
(3862, 0, 3629, 0, 2, 3, 0, '- Inclusão de imagem principal da obra: ', '', NULL, 2, ','),
(3863, 0, 3629, 0, 3, 4, 0, 'Existe um campo abaixo da área para exibição da imagem principal da obra, chamado “Imagem”. Este campo serve para definir uma imagem principal. Ao acionar este campo, o navegador abrirá uma caixa de seleção de imagem a ser escolhida armazenada no seu computador.\r\n\r\n', '', NULL, 2, ','),
(3864, 0, 3629, 0, 5, 2, 2, '', '', '3864.jpg', 2, ','),
(3865, 0, 3629, 0, 3, 4, 0, '\r\nO projeto gráfico já prevê um determinado tamanho de imagem, então, ao postar uma imagem, não é necessário se preocupar com o tamanho da imagem que está enviando, pois o sistema possui uma rotina de programação que redimensiona as imagens para 4 tamanhos diferentes a serem utilizados de variadas formas, de acordo com a interface de navegação.\r\n\r\nFormados permitidos: .bmp, .gif, .jpg, .jpeg, .png)\r\n\r\n', '', NULL, 2, ','),
(3866, 0, 3629, 0, 2, 3, 0, '- Inclusão/edição de lista auxiliar:', '', NULL, 2, ','),
(3867, 0, 3629, 0, 3, 4, 0, 'Muitas opções de cadastramento da obra possuem listas predefinidas para escolha/definição de uma determinada característica. Este recurso é necessário para um melhor cadastramento de informações com agilidade e possibilitar a geração de relatórios de acordo com estas características. Podemos identificar estes campos com o elemento gráfico ao lado, que permite acessar a área de manipulação destas opções.\r\n\r\n', '', NULL, 2, ','),
(3868, 0, 3629, 0, 5, 2, 2, '', '', '3868.jpg', 2, ','),
(3869, 0, 3629, 0, 3, 4, 0, '\r\nAo clicar neste botão especial, abrirá um “pop-up” com a área de manipulação das opções disponíveis para aquele determinado campo. Na parte de cima, tem a exibição da lista de opções já incluídas para este campo. Na parte de baixo, um formulário para inclusão de novas opções. Ainda temos dois botões para auxílio na manipulação das opções, na parte superior – “Anexar / Fechar” e “Remover”.\r\n\r\n', '', NULL, 2, ','),
(3870, 0, 3629, 0, 5, 2, 2, '', '', '3870.jpg', 2, ','),
(3871, 0, 3629, 0, 2, 3, 0, '\r\n- Inserir Nova Opção:', '', NULL, 2, ','),
(3872, 0, 3629, 0, 3, 4, 0, 'Basta utilizar o campo disponível para digitar a nova opção a ser incluída e clicar no botão “Incluir”.\r\n\r\n', '', NULL, 2, ','),
(3873, 0, 3629, 0, 2, 3, 0, '- Editar Opção Existente:', '', NULL, 2, ','),
(3874, 0, 3629, 0, 3, 4, 0, 'Na listagem de exibição de opções existentes para aquele determinado campo, existe uma coluna descrita com “E”. Significa “Edição”. Para editar (alterar informações) daquela opção, clique no ícone de editar daquela determinada opção. Ao acionar esta opção, será direcionado à tela de edição, que só tem um campo e dois botões – “Salvar” e “Voltar”. Após alterar as informações da opção, clique no botão “Salvar”. Caso tenha desistido de alterar qualquer informação desta opção, clique no botão “Voltar”.\r\n\r\n', '', NULL, 2, ','),
(3875, 0, 3629, 0, 2, 3, 0, '- Selecionar:', '', NULL, 2, ','),
(3876, 0, 3629, 0, 3, 4, 0, 'Para as opções que possuem recurso de múltiplas seleção, existe uma coluna da tabela chamada “Sel.”. Esta coluna serve para selecionar as opções que gostaria de marcar para aquele determinado campo, daquela obra. Após selecionar as opções desejadas, clique no botão “Anexar / Fechar”.\r\n\r\n', '', NULL, 2, ','),
(3877, 0, 3629, 0, 5, 2, 2, '', '', '3877.jpg', 2, ','),
(3878, 0, 3629, 0, 2, 3, 0, '\r\n- Excluir:', '', NULL, 2, ','),
(3879, 0, 3629, 0, 3, 4, 0, 'Caso deseje excluir alguma opção, utilize o caixa de seleção da coluna chamada “X”. Selecione os registros que deseja excluir e clique no botão “Remover”. \r\nATENÇÃO: Exclua apenas opções que tem 100% de certeza que não tenham sido selecionadas em outras obras, pois terá efeito diretamente na geração dos relatórios. E caso gostaria apenas de fazer uma correção ortográfica, utilize sempre a função “Editar”, pois não perde o vínculo com a identificação interna do sistema. Desta forma, não prejudica a geração de relatórios. \r\n\r\n', '', NULL, 2, ','),
(3880, 0, 3629, 0, 2, 3, 0, '- Fechar:', '', NULL, 2, ','),
(3881, 0, 3629, 0, 3, 4, 0, 'Após terminar todas as manipulações, clique no botão fechar. O sistema irá atualizar a visualização das opções selecionadas ou as opções disponíveis no “dropdown menu” com as alterações realizadas.\r\n\r\n', '', NULL, 2, ','),
(3882, 0, 3629, 0, 2, 3, 0, '- Funções Complementares:', '', NULL, 2, ','),
(3883, 0, 3629, 0, 3, 4, 0, 'No rodapé do sistema, existem ainda mais alguns botões. No canto esquerdo, pode navegar pelas obras daquela determinada área. No canto direito, pode acionar para voltar ao Painel de Controle.\r\n\r\n', '', NULL, 2, ','),
(3884, 0, 3629, 0, 1, 3, 0, 'Ficha Técnica de Tratamento', '', NULL, 2, ','),
(3885, 0, 3629, 0, 3, 4, 0, 'Ao incluir/editar qualquer obra, terá acesso a incluir fichas de tratamento daquela determinada obra.\r\n\r\n', '', NULL, 2, ','),
(3886, 0, 3629, 0, 5, 2, 2, '', '', '3886.jpg', 2, ','),
(3887, 0, 3629, 0, 2, 3, 0, '\r\n- Listagem de tratamentos da obra:', '', NULL, 2, ','),
(3888, 0, 3629, 0, 3, 4, 0, 'Na parte inferior da tela de edição da obra, será exibida uma listagem das fichas técnicas do tratamento daquela obra, com informações básicas – “X”, “E”, Entrada, Saída, Técnicos, Trava e Funções.\r\n\r\n', '', NULL, 2, ','),
(3889, 0, 3629, 0, 2, 3, 0, '- Remover Tratamento:', '', NULL, 2, ','),
(3890, 0, 3629, 0, 3, 4, 0, 'Existe uma coluna na listagem dos tratamentos incluídos de uma determinada obra chamada “X”. Serve para remover um tratamento do sistema (excluir do banco de dados). Caso gostaria de remover qualquer tratamento, selecione o tratamento pela caixa de seleção desta coluna e acione o botão “Remover”.\r\nATENÇÃO: Os dados daquele determinado tratamento serão excluídos permanentemente do banco de dados do sistema. Utilize esta função apenas quando tiver 100% de certeza que gostaria de fazer uma exclusão ou que tenha incluído um registro por engano. \r\n\r\n', '', NULL, 2, ','),
(3891, 0, 3629, 0, 2, 3, 0, '- Incluir Tratamento:', '', NULL, 2, ','),
(3892, 0, 3629, 0, 3, 4, 0, 'Ao acionar este botão, o sistema incluirá um novo registro de ficha técnica de tratamento e direcionará para a tela de edição/manipulação de dados do registro daquela ficha técnica de tratamento. A depender do tipo de obra, encontrará os campos de informações divididos em abas.\r\n\r\n', '', NULL, 2, ','),
(3893, 0, 3629, 0, 3, 4, 0, 'Descrição:\r\n- Informações básicas sobre descrição do tratamento.\r\n\r\nEstado de Conservação:\r\n- Informações sobre o estado de conservação do tratamento.\r\n\r\n- Tratamento:\r\nAlguns tipos de obras possuem duas abas para manipular dados desta área, pois podem existir muitos campos para preenchimento. Parte 1 e parte 2.\r\n\r\nAcondicionamento:\r\n- Informações para manipulação de dados sobre o acondicionamento do tratamento.\r\n\r\nInformações Complementares:\r\n- Útil para inclusão de qualquer outro arquivo complementar sobre o tratamento, como arquivos .doc, .ppt, .pdf, entre outros.\r\n\r\nFotos:\r\n- Útil para inclusão de fotos sobre o qualquer aspecto do tratamento em andamento.\r\n\r\nOBS: A cada vez que o usuário transita entre uma aba e outra, o sistema salva os dados do registro daquele tratamento. E a qualquer momento, pode acionar o botão de \"salvar\", localizado no canto superior direito da tela.\r\n\r\n- Voltar:\r\nClique nesta opção para voltar para a tela de manipulação de dados daquela obra.\r\n\r\n\r\n', '', NULL, 2, ','),
(3894, 0, 3629, 0, 2, 3, 0, '- Inclusão/edição de lista auxiliar:', '', NULL, 2, ','),
(3895, 0, 3629, 0, 3, 4, 0, 'Muitas opções de cadastramento de tratamento possuem listas predefinidas para escolha/definição de uma determinada característica. É necessário para um melhor cadastramento de informações com agilidade e possibilitar a geração de relatórios de acordo com estas características. Podemos identificar estes campos com o elemento gráfico ao lado, que permite acessar a área de manipulação destas opções.\r\n\r\n', '', NULL, 2, ','),
(3896, 0, 3629, 0, 5, 2, 2, '', '', '3896.jpg', 2, ','),
(3897, 0, 3629, 0, 3, 4, 0, '\r\nAo clicar neste botão especial, abrirá um “pop-up” com a área de manipulação das opções disponíveis para aquele determinado campo. Na parte de cima, tem a exibição da lista de opções já incluídas para este campo. Na parte de baixo, um formulário para inclusão de novas opções. Ainda temos dois botões para auxílio na manipulação das opções, na parte superior – “Anexar / Fechar” e “Remover”.\r\n\r\n', '', NULL, 2, ','),
(3898, 0, 3629, 0, 5, 2, 2, '', '', '3898.jpg', 2, ','),
(3899, 0, 3629, 0, 2, 3, 0, '\r\n- Inserir Nova Opção:', '', NULL, 2, ','),
(3900, 0, 3629, 0, 3, 4, 0, 'Basta utilizar o campo disponível para digitar a nova opção a ser incluída e clicar no botão “Incluir”.\r\n\r\n', '', NULL, 2, ','),
(3901, 0, 3629, 0, 2, 3, 0, '- Editar Opção Existente:', '', NULL, 2, ','),
(3902, 0, 3629, 0, 3, 4, 0, 'Na listagem de exibição de opções existentes para aquele determinado campo, existe uma coluna descrita com “E”. Significa “Edição”. Para editar (alterar informações) daquela opção, clique no ícone de editar daquela determinada opção. Ao acionar esta opção, será direcionado à tela de edição, que só tem um campo e dois botões – “Salvar” e “Voltar”. Após alterar as informações da opção, clique no botão “Salvar”. Caso tenha desistido de alterar qualquer informação desta opção, clique no botão “Voltar”.\r\n\r\n', '', NULL, 2, ','),
(3903, 0, 3629, 0, 2, 3, 0, '- Selecionar:', '', NULL, 2, ','),
(3904, 0, 3629, 0, 3, 4, 0, 'Para as opções que possuem recurso de múltiplas seleção, existe uma coluna da tabela chamada “Sel.”. Esta coluna serve para selecionar as opções que gostaria de marcar para aquele determinado campo, daquela obra. Após selecionar as opções desejadas, clique no botão “Anexar / Fechar”.\r\n', '', NULL, 2, ','),
(3905, 0, 3629, 0, 5, 2, 2, '', '', '3905.jpg', 2, ','),
(3906, 0, 3629, 0, 2, 3, 0, '- Excluir:', '', NULL, 2, ','),
(3907, 0, 3629, 0, 3, 4, 0, 'Caso deseje excluir alguma opção, utilize o caixa de seleção da coluna chamada “X”. Selecione os registros que deseja excluir e clique no botão “Remover”. \r\nATENÇÃO: Exclua apenas opções que tem 100% de certeza que não tenham sido selecionadas em outras obras, pois terá efeito diretamente na geração dos relatórios. E caso gostaria apenas de fazer uma correção ortográfica, utilize sempre a função “Editar”, pois não perde o vínculo com a identificação interna do sistema. Desta forma, não prejudica a geração de relatórios. \r\n\r\n\r\n', '', NULL, 2, ','),
(3908, 0, 3629, 0, 2, 3, 0, '- Fechar:', '', NULL, 2, ','),
(3909, 0, 3629, 0, 3, 4, 0, 'Após terminar todas as manipulações, clique no botão fechar. O sistema irá atualizar a visualização das opções selecionadas ou as opções disponíveis no “dropdown menu” com as alterações realizadas.\r\n\r\n', '', NULL, 2, ','),
(3910, 0, 3629, 0, 2, 3, 0, '- Teste de Solubilidade:', '', NULL, 2, ','),
(3911, 0, 3629, 0, 3, 4, 0, 'Em alguns tipos de obras, existe uma área para inclusão de registros sobre teste de solubilidade. Este recurso encontra-se na área de tratamentos.\r\n\r\n', '', NULL, 2, ','),
(3912, 0, 3629, 0, 2, 3, 0, 'Listagem dos Testes:', '', NULL, 2, ','),
(3913, 0, 3629, 0, 3, 4, 0, 'Nesta área, encontrará a listagem dos testes já incluídos, com as colunas \"X\", \"E\", Cor do Pigmento, Produto e Resultado.\r\n\r\n', '', NULL, 2, ','),
(3914, 0, 3629, 0, 2, 3, 0, 'Incluir Teste:', '', NULL, 2, ','),
(3915, 0, 3629, 0, 3, 4, 0, '- Para incluir um novo registro de teste de solubilidade, clique no botão \"Incluir Teste\", localizado na parte inferior da listagem de testes incluídos. Uma janela \"pop-up\" será aberta para inclusão de registros. O formulário para inclusão de registros encontra-se abaixo da listagem de registros já incluídos.\r\n\r\n', '', NULL, 2, ','),
(3916, 0, 3629, 0, 5, 2, 2, '', '', '3916.jpg', 2, ','),
(3917, 0, 3629, 0, 3, 4, 0, 'Após preencher os campos do registro do teste, clique no botão “incluir” para adicionar o registro. Depois de incluído todos os registros desejados, clique no botão “anexar / fechar”, para continuar a manipulação de dados do registro do tratamento.\r\n', '', NULL, 2, ','),
(3918, 0, 3629, 0, 2, 3, 0, 'Editar Teste:', '', NULL, 2, ','),
(3919, 0, 3629, 0, 3, 4, 0, '- Para editar qualquer registro de testes incluídos, clique no ícone de editar da fileira do registro desejado. Abrirá novamente a janela “pop-up”, com as informações armazenadas daquele registro. Quando terminar, clique no botão “atualizar” para salvar as novas informações daquele registro.\r\n\r\n', '', NULL, 2, ','),
(3921, 0, 3629, 0, 2, 3, 0, 'Remover Teste:', '', NULL, 2, ','),
(3922, 0, 3629, 0, 3, 4, 0, '- Existe uma caixa de seleção ao lado de cada registro. Selecione os registros desejados e clique no botão “remover” para excluir o registro do banco de dados.\r\nATENÇÃO: Ao excluir o registro, eliminará a informação permanentemente do sistema/banco de dados.\r\n\r\n\r\n', '', NULL, 2, ','),
(3923, 0, 3629, 0, 2, 3, 0, 'Visualizar Mapa:', '', NULL, 2, ','),
(3924, 0, 3629, 0, 3, 4, 0, '- Clique nesta opção para visualizar todos os registros incluídos, numa janela pop-up.\r\n\r\n', '', NULL, 2, ','),
(3925, 0, 3629, 0, 2, 3, 0, 'Abas Informações Complementares e Fotos', '', NULL, 2, ','),
(3926, 0, 3629, 0, 3, 4, 0, '- Estas duas áreas possuem o funcionamento semelhante. Ao clicar na aba desejada, encontrará a listagem dos arquivos já incluídos do lado esquerdo e do lado direito, a mesma listagem, porém com elementos gráficos de apoio para ajudar a gerenciar os arquivos desta área. No caso da aba de fotos, encontrará um “thumbnail” da imagem incluída.\r\n\r\n', '', NULL, 2, ','),
(3927, 0, 3629, 0, 5, 2, 2, '', '', '3927.jpg', 2, ','),
(3928, 0, 3629, 0, 2, 3, 0, '\r\n- Adicionar Arquivos/Fotos:', '', NULL, 2, ','),
(3929, 0, 3629, 0, 3, 4, 0, 'Abaixo da listagem da esquerda, existe um botão chamado “Adicionar”. Ao clicar neste botão, encontrará um pequeno formulário para fazer upload do arquivo desejado. Inclua as informações (título e descrição) para localizar o material com mais facilidade. Por último, clique no botão “escolher arquivo” (esta identificação pode ser modificada de acordo com o navegador a ser utilizado). Ao acionar este campo, o navegador abrirá uma caixa de seleção de imagem a ser escolhida armazenada no seu computador. Escolha a imagem do seu computador e clique em “Abrir”. Depois, basta clicar no botão “uplaod” e aguardar a transferência do arquivo para o servidor. O tempo de transferência é proporcional ao tamanho do arquivo.\r\n\r\n', '', NULL, 2, ','),
(3930, 0, 3629, 0, 2, 3, 0, '- Remover:', '', NULL, 2, ','),
(3931, 0, 3629, 0, 3, 4, 0, 'Para excluir qualquer arquivo, utilize o formulário da lateral esquerda, marque a caixa de seleção do registro desejado e clique em excluir.\r\nATENÇÃO: Ao excluir qualquer arquivo, o registro é eliminado permanentemente do banco de dados junto com o arquivo físico vinculado ao registro.\r\n\r\n', '', NULL, 2, ','),
(3932, 0, 3629, 0, 1, 3, 0, 'Busca', '', NULL, 2, ','),
(3933, 0, 3629, 0, 3, 4, 0, 'Caso necessite encontrar algum registro em qualquer uma das categorias, acesse a área de busca. Encontrará um campo para informar um termo e acione o botão disponível. O sistema irá procurar este termo nos campos de texto disponíveis na tabela de cadastramento das obras, similar a encontrada na navegação por categorias de obras. Em seguida, será exibida uma listagem com os resultados encontrados com o termo informado. Depois, basta acessar o registro para interagir de acordo com a necessidade.\r\n\r\n', '', NULL, 2, ','),
(3934, 0, 3629, 0, 5, 2, 2, '', '', '3934.jpg', 2, ','),
(3935, 0, 3629, 0, 1, 3, 0, '\r\nRelatórios', '', NULL, 2, ','),
(3936, 0, 3629, 0, 3, 4, 0, 'Acesse esta área para gerar relatórios sobre os tratamentos registrados. Ao acessar esta parte, encontrará algumas abas com os filtros disponíveis para geração de relatórios personalizados. A primeira aba (Gráfico) refere-se a algumas configurações de visualização do relatório pretendido. As outras abas são os filtros e colunas desejadas. \r\n\r\n', '', NULL, 2, ','),
(3937, 0, 3629, 0, 5, 2, 2, '', '', '3937.jpg', 2, ','),
(3938, 0, 3629, 0, 2, 3, 0, '\r\n- Definição de Exibição de Colunas:', '', NULL, 2, ','),
(3939, 0, 3629, 0, 3, 4, 0, 'Muitas opções de filtro possuem um “checkbox” ao lado. Este mecanismo serve para definir quais colunas serão exibidas no relatório a ser gerado. Desta forma, consegue construir um relatório dinâmico, com as colunas personalizadas. Não se preocupe com a quantidade de colunas definidas para exibição, pois a tela de resultados possui um “scroll” horizontal para consegui visualizar as demais colunas, se for o caso.\r\n\r\n', '', NULL, 2, ','),
(3940, 0, 3629, 0, 5, 2, 2, '', '', '3940.jpg', 2, ','),
(3941, 0, 3629, 0, 2, 3, 0, '\r\n- Resultados:', '', NULL, 2, ','),
(3942, 0, 3629, 0, 3, 4, 0, 'Depois de configurar todos os filtros e definir todas as colunas a serem exibidas, basta clicar no botão “Buscar” para que o resultado seja exibido numa janela separada.\r\n\r\n', '', NULL, 2, ','),
(3943, 0, 3629, 0, 5, 2, 2, 'Exemplo de relatório – tabela. O resultado é apresentado em tabela com as colunas definidas.', '', '3943.jpg', 2, ','),
(3944, 0, 3629, 0, 5, 2, 2, 'Exemplo de relatório – pizza. O resultado é apresentado em forma de gráfico com a quantidade de registros encontrados em relação à quantidade de registros existentes no banco de dados.', '', '3944.jpg', 2, ','),
(3945, 0, 3629, 0, 3, 4, 0, '\r\nObservação: A depender dos filtros e colunas aplicadas, pode ocorrer de demorar o carregamento dos resultados, pois esta tela é uma compilação com praticamente todas tabelas utilizadas no banco de dados.\r\n\r\n', '', NULL, 2, ','),
(3946, 0, 3629, 0, 2, 3, 0, '- Salvar em PDF:', '', NULL, 2, ','),
(3947, 0, 3629, 0, 3, 4, 0, 'Ao precisar salvar os resultados em PDF, é bem simples. Na tela dos resultados, basta clicar com o botão direito do mouse em qualquer da tela. Abrirá um pequeno menu, com opções. Escolha a opção “imprimir”. O navegador abrirá uma janela de impressão. A parte chamada “destino”, certifique-se que está selecionado “Salvar Como PDF”. Caso não esteja, clique no botão “Alterar...” e selecione a opção chamada “Salvar como PDF”. Após esta configuração, prossiga com o botão “Salvar”. Depois do botão acionado, o navegador irá abrir uma janela de gerenciamento de arquivos do seu computador para escolher o local de preferência para salvar o arquivo. Uma vez escolhido, clique em “Salvar” nesta outra janela e o trâmite está finalizado. Caso tenha necessidade de alterar outras configurações desta parte como “tamanho de papel”, “margens”, entre outros, clique em “Mais definições” naquela mesma janela de impressão antes de concluir o trâmite de salvar como PDF.\r\nObservação: Utilize o navegador Google Chrome para realizar este recurso com êxito. \r\n\r\n', '', NULL, 2, ','),
(3948, 0, 3629, 0, 1, 3, 0, 'Administração do Sistema (Backend)', '', NULL, 2, ','),
(3949, 0, 3629, 0, 2, 3, 0, 'Visão Geral:', '', NULL, 2, ','),
(3950, 0, 3629, 0, 3, 4, 0, 'Após acessar o endereço do sistema http://143.107.127.22/sistema/, entre com as informações de acesso:\r\nUsuário: (consultar)\r\nSenha: (consultar)\r\nE aperte o botão “Login”. A primeira tela encontrada é a página principal. As opções principais se encontram ao lado esquerdo. \r\n\r\nNavegação pelo sistema: ao navegar pelo sistema, normalmente a parte que fica à esquerda (dentro da área de conteúdo, excluindo a barra lateral) é destinada à organização estrutural do sistema. E a parte da direita é destinada a inclusão de informações dentro daquela área ou módulo.\r\n\r\nSempre que você (administrador) se “perder” na navegação das sub-categorias do sistema, acesse “Estrutura de Links”, e te levara para a estrutura inicial da organização do sistema.\r\n\r\nLinks Laterais:\r\nOs links principais do sistema ficam na barra lateral esquerda. Segue uma pequena descrição para cada link:\r\n\r\n- Estrutura de Links:\r\nOpção para acessar os módulos criados para o sistema.\r\n\r\n- Busca no Sistema:\r\nUsado para fazer uma busca de cadastro rapidamente no sistema.\r\n\r\n- Manutenção Obras:\r\nNecessário para complementar algumas opções padrões que ficam disponíveis em alguns formulários de cadastramento da obra, dentro do sistema.\r\n\r\n- Manutenção Cadastro:\r\nNecessário para complementar algumas opções padrões que ficam disponíveis em alguns formulários de cadastramento dentro do sistema.\r\n\r\n- Manutenção Tratamento:\r\nNecessário para complementar algumas opções padrões que ficam disponíveis em alguns formulários de cadastramento do tratamento, dentro do sistema.\r\n\r\n- Teste de Solubilidade – Índice Geral:\r\nAcesso a todos registros de tratamentos cadastrados no sistema, vinculados a cada obra.\r\n\r\n- Ficha Técnica – Índice Geral:\r\nAcesso a todos registros de tratamentos cadastrados no sistema, vinculados a cada obra.\r\n\r\n- Log-off (sair do sistema):\r\nUtilizado para sair do sistema.\r\n\r\n', '', NULL, 2, ','),
(3951, 0, 3629, 0, 2, 3, 0, 'Cadastramento de Usuários:', '', NULL, 2, ','),
(3952, 0, 3629, 0, 3, 4, 0, 'Acesse: Estrutura de Links -> Gerenciamento de Cadastro (da linha “Cadastro”).', '', NULL, 2, ','),
(3953, 0, 3629, 0, 5, 2, 2, '', '', '3953.jpg', 2, ','),
(3954, 0, 3629, 0, 3, 4, 0, '\r\nATENÇÃO: Não exclua nenhuma categoria desta parte, pois a identificação das categorias estão vinculadas na codificação do sistema. Qualquer exclusão de categorias poderá inviabilizar o funcionamento do sistema, sendo necessário uma manutenção do sistema ou até mesmo restauração de backup para recuperar seu funcionamento parcial. Qualquer necessidade de nova categoria ou mudança de nome, consulte o desenvolvedor primeiramente.\r\n\r\nDepois de acessar o link “Gerenciamento de Cadastro” encontrará, na parte de cima, os cadastros de usuários já realizados, e na parte de baixo, as caixas de entrada de dados para cada cadastro.\r\n\r\nAbaixo da listagem dos cadastrados, encontrará um formulário para preenchimento. A maioria destes espaços é livre para qualquer preenchimento e funciona de uma forma bem simples. Os que funcionam de uma forma diferenciada são:\r\n\r\n- Campo “Tipo de Cadastro”: neste caso, o usuário deve ser definido como um dos níveis disponíveis. O acionamento de tipo serve para definir os privilégios que o usuário terá no frontend. \r\n\r\nATENÇÃO: JAMAIS exclua qualquer opção de “Tipo de Cliente” que já esteja cadastrado previamente no sistema. Alguns podem influenciar o funcionamento do sistema e outros podem influenciar as informações nelas inseridas podendo causar erros e falhas de funcionamento deles. \r\n\r\n- Campo “e-mail”: Utilize este campo para definir o e-mail de acesso do usuário a ser incluído para entrar no painel de controle do frontend.\r\n\r\n- Campo “senha”: Utilize este campo para definir a senha de acesso do usuário a ser incluído para entrar no painel de controle do frontend.\r\n\r\nApós o preenchimento dos campos, acione o botão “incluir”, que se encontra no final do formulário de cadastro. Logo em seguida, um resumo do registro aparecerá na parte de cima do formulário em forma de tabela com as principais informações do cadastro. \r\n\r\nCada registro possui algumas funcionalidades básicas para gerenciamento rápido. Segue a descrição de algumas funcionalidades básicas da listagem de cada registro:\r\n\r\n- Link Administrar: acione este link para acessar as informações detalhadas e complementares do cadastrado.\r\n\r\n- Link de Ativação: na coluna intitulada “Trava.” existe um link para cada registro que estará escrito “Lib” ou “Trav”. “Lib” significa “Liberado”. “Trav” significa “Travado”. Esta liberação serve para permitir ou bloquear o acesso do cadastrado ao sistema pela interface do frontend. \r\n\r\n- Link Editar: serve para entrar no modo de edição do cadastro para realizar alterações de informações no cadastro básico do registro.\r\n\r\n- Link de Exclusão: na coluna intitulada “Excluir” existe uma caixa de seleção para cada registro. Ao acionar os registros, você estará excluindo, de forma instantânea o registro do banco de dados.', '', NULL, 2, ',');

-- --------------------------------------------------------

--
-- Table structure for table `tb_conteudo_colunas`
--

CREATE TABLE `tb_conteudo_colunas` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_conteudo` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_enquetes`
--

CREATE TABLE `tb_enquetes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `tipo_enquete` int(11) DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_enquete` datetime DEFAULT NULL,
  `descricao` longtext,
  `ativacao` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `resposta` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_enquetes_log`
--

CREATE TABLE `tb_enquetes_log` (
  `id` double NOT NULL DEFAULT '0',
  `data_resposta` datetime DEFAULT NULL,
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_enquetes` double DEFAULT '0',
  `id_tb_opcoes` double DEFAULT '0',
  `resposta_correta` int(11) DEFAULT '0',
  `count_resposta` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_enquetes_modulos`
--

CREATE TABLE `tb_enquetes_modulos` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `data_modulo` datetime DEFAULT NULL,
  `n_classificacao` int(11) DEFAULT '0',
  `modulo` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `arquivo` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `n_questoes` int(11) DEFAULT '0',
  `n_questoes_aprovacao` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_enquetes_opcoes`
--

CREATE TABLE `tb_enquetes_opcoes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_enquetes` double DEFAULT '0',
  `n_classificacao` int(11) DEFAULT '0',
  `opcao` longtext,
  `ativacao` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `n_votos` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_extras`
--

CREATE TABLE `tb_extras` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_extra` int(11) DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_extra` datetime DEFAULT NULL,
  `data_final_extra` datetime DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `titulo` longtext,
  `conteudo_simples` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `fonte` varchar(255) DEFAULT NULL,
  `link_fonte` varchar(255) DEFAULT NULL,
  `editoria` varchar(255) DEFAULT NULL,
  `palavras_chave` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `n_visitas` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fluxo`
--

CREATE TABLE `tb_fluxo` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `data_lancamento` datetime DEFAULT NULL,
  `data_contabilizacao` datetime DEFAULT NULL,
  `debito_credito` int(11) DEFAULT '0',
  `id_item` double DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `id_tb_cadastro` int(11) DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `lancamento` longtext,
  `id_tb_fluxo_tipo` int(11) DEFAULT '0',
  `id_tb_fluxo_status` int(11) DEFAULT '0',
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `n_documento` longtext,
  `autenticacao` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_contabilizacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fluxo_complemento`
--

CREATE TABLE `tb_fluxo_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` double DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fluxo_relacao_complemento`
--

CREATE TABLE `tb_fluxo_relacao_complemento` (
  `id_tb_fluxo` double DEFAULT '0',
  `id_tb_fluxo_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_formularios`
--

CREATE TABLE `tb_formularios` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `nome_formulario` varchar(255) DEFAULT NULL,
  `assunto_formulario` varchar(255) DEFAULT NULL,
  `nome_email_destinatario` varchar(255) DEFAULT NULL,
  `email_destinatario` varchar(255) DEFAULT NULL,
  `email_copia` varchar(255) DEFAULT NULL,
  `config_mensagem_sucesso` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_formularios_campos`
--

CREATE TABLE `tb_formularios_campos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_formularios` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `nome_campo` longtext,
  `nome_campo_formatado` varchar(255) DEFAULT NULL,
  `tipo_campo` int(11) DEFAULT '0',
  `tamanho_campo` int(11) DEFAULT '0',
  `altura_campo` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `obrigatorio` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_formularios_campos_opcoes`
--

CREATE TABLE `tb_formularios_campos_opcoes` (
  `id` int(11) NOT NULL DEFAULT '0',
  `id_tb_formularios_campos` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `nome_opcao` longtext,
  `nome_opcao_formatado` varchar(255) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_formularios_emails`
--

CREATE TABLE `tb_formularios_emails` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_formularios` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `departamento` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `email_tipo` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_forum_postagens`
--

CREATE TABLE `tb_forum_postagens` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `n_classificacao` int(11) DEFAULT '0',
  `data_postagem` datetime DEFAULT NULL,
  `postagem` longtext,
  `nota_avaliacao` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_forum_postagens`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_forum_topicos`
--

CREATE TABLE `tb_forum_topicos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_vendedor` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_topico` datetime DEFAULT NULL,
  `topico` longtext,
  `assunto` longtext,
  `ativacao` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_historico`
--

CREATE TABLE `tb_historico` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_historico` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `assunto` longtext,
  `historico` longtext,
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `id_tb_cadastro4` double DEFAULT '0',
  `id_tb_cadastro5` double DEFAULT '0',
  `id_tb_cadastro6` double DEFAULT '0',
  `id_tb_cadastro7` double DEFAULT '0',
  `id_tb_cadastro8` double DEFAULT '0',
  `id_tb_cadastro9` double DEFAULT '0',
  `id_tb_cadastro10` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `informacao_complementar41` longtext,
  `informacao_complementar42` longtext,
  `informacao_complementar43` longtext,
  `informacao_complementar44` longtext,
  `informacao_complementar45` longtext,
  `informacao_complementar46` longtext,
  `informacao_complementar47` longtext,
  `informacao_complementar48` longtext,
  `informacao_complementar49` longtext,
  `informacao_complementar50` longtext,
  `informacao_complementar51` longtext,
  `informacao_complementar52` longtext,
  `informacao_complementar53` longtext,
  `informacao_complementar54` longtext,
  `informacao_complementar55` longtext,
  `informacao_complementar56` longtext,
  `informacao_complementar57` longtext,
  `informacao_complementar58` longtext,
  `informacao_complementar59` longtext,
  `informacao_complementar60` longtext,
  `palavras_chave` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `id_tb_historico_status` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_historico`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_historico_complemento`
--

CREATE TABLE `tb_historico_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_historico_complemento`
--

INSERT INTO `tb_historico_complemento` (`id`, `tipo_complemento`, `complemento`, `descricao`) VALUES
(3532, 12, 'Caixa Solander', ''),
(3533, 12, 'Encapsulamento', ''),
(3534, 12, 'Caixa em T', ''),
(3535, 13, 'Microondulado', ''),
(3536, 13, 'Papelão', ''),
(3537, 13, 'Papel-cartão', ''),
(3538, 14, 'Conservação Preventiva', ''),
(3539, 15, 'Trincha', ''),
(3541, 15, 'Retirada de Clips', ''),
(3542, 16, 'Localizada', ''),
(3543, 17, 'Deionizada', ''),
(3544, 18, 'Imersão', ''),
(3545, 19, 'Aquosa', ''),
(3546, 19, 'Não Aquosa', ''),
(4078, 25, 'Nenhuma', ''),
(3548, 21, 'Imersão', ''),
(3549, 22, 'Hidróxido de Cálcio', ''),
(3550, 23, 'Hipoclorito de Cálcio', ''),
(3551, 24, 'Tópica', ''),
(3552, 25, 'Hipoclorito de Cálcio', ''),
(3553, 26, 'Total Por Imersão', ''),
(3554, 27, 'Velatura', ''),
(3555, 28, 'Tissue', ''),
(3556, 29, 'Reenfibragem', ''),
(3557, 30, 'Mecânico', ''),
(3558, 31, 'Lápis de Cor', ''),
(3559, 32, 'Localizado, Com Pesos', ''),
(3560, 33, 'Limpeza', ''),
(3561, 33, 'Enxerto', ''),
(3562, 34, 'Limpeza', ''),
(3563, 34, 'Lombada Nova', ''),
(3564, 35, 'Guardas Novas', ''),
(3565, 36, 'Tapa Nova', ''),
(3566, 37, 'Nervos Novos', ''),
(3567, 38, 'Industrial', ''),
(3568, 38, 'Manual', ''),
(3569, 39, 'Costura Nova', ''),
(3570, 40, 'Troca', ''),
(3571, 55, 'Abrasão', ''),
(3572, 55, 'Rasgos', ''),
(3573, 55, 'Manchas', ''),
(3574, 55, 'Vincos', ''),
(3575, 56, 'Bom', ''),
(3576, 57, 'Abrasão', ''),
(3577, 57, 'Rasgos', ''),
(3578, 57, 'Manchas', ''),
(3579, 57, 'Encolhimento', ''),
(3580, 58, 'Bom', ''),
(3581, 59, 'Perdido na Parte Superior', ''),
(3582, 59, 'Solto', ''),
(3583, 59, 'Danificado', ''),
(3584, 60, 'Rompidos Parte Superior', ''),
(3585, 60, 'Perdidos', ''),
(3586, 60, 'Parcialmente Perdidos', ''),
(3587, 61, 'Estojo', ''),
(3588, 61, 'Caixa', ''),
(3589, 61, 'Envelope', ''),
(3590, 62, 'Madeira', ''),
(3591, 62, 'Acrílico', ''),
(3592, 62, 'Metal', ''),
(3593, 63, 'Carimbo', ''),
(3594, 63, 'Esmaecimento', ''),
(3595, 63, 'Dobras', ''),
(3596, 63, 'Perfuração', ''),
(3597, 64, 'Bom', ''),
(3598, 65, 'Rompida', ''),
(3599, 65, 'Integra', ''),
(3600, 65, 'Solta', ''),
(3601, 65, 'Fragilizada', ''),
(3602, 66, 'Bom', ''),
(3603, 67, 'Estojo', ''),
(3604, 67, 'Caixa', ''),
(3605, 67, 'Envelope', ''),
(3606, 68, 'Madeira', ''),
(3607, 68, 'Acrílico', ''),
(3608, 68, 'Metal', ''),
(3609, 69, 'Não', ''),
(3610, 69, 'Vidro', ''),
(3611, 69, 'Acrílico', ''),
(3612, 70, 'Não', ''),
(3613, 70, 'Eucatex', ''),
(3614, 70, 'Madeira', ''),
(3615, 72, 'Não', ''),
(3616, 72, 'Papelão Revestido', ''),
(3617, 72, 'Papel-cartão 100% Algodão', ''),
(3618, 73, 'Regular', ''),
(3619, 74, 'Intervenções Anteriores', ''),
(3620, 74, 'Rasgos', ''),
(3621, 74, 'Carimbo', ''),
(3622, 74, 'Colas', ''),
(3623, 74, 'Ferrugem', ''),
(3624, 80, 'Caixa', ''),
(3625, 80, 'Encapsulamento', ''),
(3626, 80, 'Folder', ''),
(3630, 41, 'Original', ''),
(3631, 41, 'Não Original', ''),
(3632, 42, 'Inteira', ''),
(3633, 42, 'Capa Presa', ''),
(3634, 43, 'Couro', ''),
(3635, 43, 'Pergaminho', ''),
(3636, 45, 'Nervos Naturais', ''),
(3637, 45, 'Nervos Duplos', ''),
(3638, 46, 'Papel', ''),
(3639, 46, 'Tecido', ''),
(3640, 47, 'Manual', ''),
(3641, 47, 'Dourado', ''),
(3642, 48, 'Sanfona', ''),
(3643, 48, 'Oco', ''),
(3644, 75, 'Microondulado', ''),
(3645, 75, 'Papelão', ''),
(3646, 75, 'Papel-cartão', ''),
(3647, 71, 'Caixa Solander', ''),
(3648, 71, 'Encapsulamento', ''),
(3649, 71, 'Caixa em T', ''),
(4037, 44, 'Pergaminho1', ''),
(3651, 44, 'Pergaminho', ''),
(3658, 76, 'Caixa', ''),
(3659, 77, 'Não', ''),
(3660, 77, 'Vidro', ''),
(3661, 77, 'Acrílico', ''),
(3662, 78, 'Não', ''),
(3663, 78, 'Madeira', ''),
(3664, 78, 'Poliondas', ''),
(3665, 79, 'Passe-partout', ''),
(3666, 79, 'Só Fundo', ''),
(3667, 79, 'Dois Elementos', ''),
(3668, 81, 'Papel-cartão Neutro', ''),
(3669, 81, 'Papel-cartão 100% Algodão', ''),
(3670, 82, 'A Mesma', ''),
(3671, 82, 'Madeira', ''),
(3672, 82, 'Acrílico', ''),
(3754, 49, 'Industrial', ''),
(3755, 50, 'Madeira', ''),
(3756, 51, 'Papel Trapo', ''),
(3757, 53, 'Retos', ''),
(3760, 52, 'Sim', ''),
(3759, 54, 'Foliado', ''),
(3761, 52, 'Não', ''),
(3762, 41, 'Inexistente', ''),
(3775, 83, 'Teste com inclusão de palavra-chave de tratamentos', ''),
(3776, 83, 'Outro teste de inclusão', ''),
(3795, 83, 'Inclusão pelo frontend', ''),
(3807, 43, 'Pano', ''),
(4058, 14, 'Conservação interventiva', ''),
(4059, 14, 'Higienização', ''),
(4060, 14, 'Restauro', ''),
(4076, 20, 'Deionizada', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_historico_interacao`
--

CREATE TABLE `tb_historico_interacao` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_interacao` datetime DEFAULT NULL,
  `assunto` longtext,
  `interacao` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_historico_relacao_complemento`
--

CREATE TABLE `tb_historico_relacao_complemento` (
  `id_tb_historico` double DEFAULT '0',
  `id_tb_historico_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_historico_relacao_complemento`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_imoveis`
--

CREATE TABLE `tb_imoveis` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_cadastro_vendedor` double DEFAULT '0',
  `id_tb_imoveis_bairro` double DEFAULT '0',
  `id_tb_imoveis_cidade` double DEFAULT '0',
  `id_tb_imoveis_estado` double DEFAULT '0',
  `id_config_bairro` double DEFAULT '0',
  `id_config_cidade` double DEFAULT '0',
  `id_config_estado` double DEFAULT '0',
  `id_config_regiao` double DEFAULT '0',
  `id_config_pais` double DEFAULT '0',
  `id_db_cep_tblBairros` double DEFAULT '0',
  `id_db_cep_tblCidades` double DEFAULT '0',
  `id_db_cep_tblLogradouros` double DEFAULT '0',
  `id_db_cep_tblUF` varchar(255) DEFAULT NULL,
  `imovel_endereco` varchar(255) DEFAULT NULL,
  `imovel_endereco_numero` varchar(255) DEFAULT NULL,
  `imovel_endereco_complemento` varchar(255) DEFAULT NULL,
  `imovel_bairro` varchar(255) DEFAULT NULL,
  `imovel_cidade` varchar(255) DEFAULT NULL,
  `imovel_estado` varchar(255) DEFAULT NULL,
  `imovel_pais` varchar(255) DEFAULT NULL,
  `imovel_cep` varchar(255) DEFAULT NULL,
  `data_imovel` datetime DEFAULT NULL,
  `imovel_venda` int(11) DEFAULT '0',
  `imovel_aluguel` int(11) DEFAULT '0',
  `codigo_imovel` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `detalhes` longtext,
  `ano_construcao` varchar(255) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `n_quartos` int(11) DEFAULT '0',
  `n_suites` int(11) DEFAULT '0',
  `varanda` varchar(255) DEFAULT NULL,
  `lavabo` varchar(255) DEFAULT NULL,
  `d_empregada` varchar(255) DEFAULT NULL,
  `vagas` varchar(255) DEFAULT NULL,
  `piscina` varchar(255) DEFAULT NULL,
  `salao_jogos` varchar(255) DEFAULT NULL,
  `sauna` varchar(255) DEFAULT NULL,
  `area_construida` varchar(255) DEFAULT NULL,
  `area_total` varchar(255) DEFAULT NULL,
  `apt_andar` varchar(255) DEFAULT NULL,
  `n_andares` varchar(50) DEFAULT NULL,
  `n_pavimento` varchar(255) DEFAULT NULL,
  `vista` longtext,
  `estado_imovel` longtext,
  `valor_venda` double DEFAULT '0',
  `valor_aluguel` double DEFAULT '0',
  `valor_condominio` double DEFAULT '0',
  `valor_iptu` double DEFAULT '0',
  `condicoes_comerciais` longtext,
  `proprietario` longtext,
  `palavras_chave` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `n_visitas` int(11) DEFAULT '0',
  `id_tb_imoveis_status` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `mapa` varchar(255) DEFAULT NULL,
  `mapa_online` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_imoveis_complemento`
--

CREATE TABLE `tb_imoveis_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_imoveis_relacao_complemento`
--

CREATE TABLE `tb_imoveis_relacao_complemento` (
  `id_tb_imoveis` double DEFAULT '0',
  `id_tb_imoveis_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_itens_config`
--

CREATE TABLE `tb_itens_config` (
  `id` double NOT NULL DEFAULT '0',
  `id_registro` double DEFAULT '0',
  `id_registro_complemento` varchar(255) DEFAULT NULL,
  `tabela` varchar(255) DEFAULT NULL,
  `config_tipo` int(11) DEFAULT '0',
  `config_status` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_itens_enviados`
--

CREATE TABLE `tb_itens_enviados` (
  `id` double NOT NULL DEFAULT '0',
  `data_envio` datetime DEFAULT NULL,
  `id_tb_cadastro_remetente` double DEFAULT '0',
  `id_tb_cadastro_destinatario` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `tipo_categoria` int(11) DEFAULT '0',
  `tipo_interatividade` int(11) DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `nome_remetente` varchar(255) DEFAULT NULL,
  `email_remetente` varchar(255) DEFAULT NULL,
  `nome_destinatario` varchar(255) DEFAULT NULL,
  `email_destinatario` varchar(255) DEFAULT NULL,
  `assunto` varchar(255) DEFAULT NULL,
  `mensagem` longtext,
  `assinatura` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `count_envio` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_itens_relacao_registros`
--

CREATE TABLE `tb_itens_relacao_registros` (
  `id` double DEFAULT '0',
  `data_atualizacao` datetime DEFAULT NULL,
  `id_item` double DEFAULT '0',
  `id_registro` double DEFAULT '0',
  `tipo_categoria` double DEFAULT '0',
  `tipo_relacao` int(11) DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_itens_relacao_registros_backup01`
--

CREATE TABLE `tb_itens_relacao_registros_backup01` (
  `id` double DEFAULT '0',
  `id_item` double DEFAULT '0',
  `id_registro` double DEFAULT '0',
  `tipo_categoria` double DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_itens_selecao`
--

CREATE TABLE `tb_itens_selecao` (
  `id` double NOT NULL DEFAULT '0',
  `n_classificacao` int(11) DEFAULT '0',
  `data_selecao` datetime DEFAULT NULL,
  `id_tb_cadastro` double DEFAULT '0',
  `id_tb_item` double DEFAULT '0',
  `tipo_categoria` int(11) DEFAULT '0',
  `descricao` longtext,
  `valor_selecao` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_itens_valores`
--

CREATE TABLE `tb_itens_valores` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `valor` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log`
--

CREATE TABLE `tb_log` (
  `id` double NOT NULL DEFAULT '0',
  `id_registro` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `tabela` varchar(255) DEFAULT NULL,
  `log_data` datetime DEFAULT NULL,
  `log_tipo` int(11) DEFAULT '0',
  `log_ip` varchar(255) DEFAULT NULL,
  `log_acao` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_complemento`
--

CREATE TABLE `tb_log_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_relacao_complemento`
--

CREATE TABLE `tb_log_relacao_complemento` (
  `id_tb_log` double DEFAULT '0',
  `id_tb_log_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_modulos`
--

CREATE TABLE `tb_modulos` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `id_tb_cadastro4` double DEFAULT '0',
  `id_tb_cadastro5` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `data6` datetime DEFAULT NULL,
  `data7` datetime DEFAULT NULL,
  `data8` datetime DEFAULT NULL,
  `data9` datetime DEFAULT NULL,
  `data10` datetime DEFAULT NULL,
  `nome_modulo` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `id_tb_modulos_status` double DEFAULT '0',
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `informacao_complementar41` longtext,
  `informacao_complementar42` longtext,
  `informacao_complementar43` longtext,
  `informacao_complementar44` longtext,
  `informacao_complementar45` longtext,
  `informacao_complementar46` longtext,
  `informacao_complementar47` longtext,
  `informacao_complementar48` longtext,
  `informacao_complementar49` longtext,
  `informacao_complementar50` longtext,
  `informacao_complementar51` longtext,
  `informacao_complementar52` longtext,
  `informacao_complementar53` longtext,
  `informacao_complementar54` longtext,
  `informacao_complementar55` longtext,
  `informacao_complementar56` longtext,
  `informacao_complementar57` longtext,
  `informacao_complementar58` longtext,
  `informacao_complementar59` longtext,
  `informacao_complementar60` longtext,
  `carga_horaria` double DEFAULT '0',
  `duracao_aula` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `anotacoes_internas` longtext,
  `n_visitas` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_modulos_complemento`
--

CREATE TABLE `tb_modulos_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_modulos_relacao_complemento`
--

CREATE TABLE `tb_modulos_relacao_complemento` (
  `id_tb_modulos` double DEFAULT '0',
  `id_tb_modulos_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_newsletter`
--

CREATE TABLE `tb_newsletter` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_newsletter` datetime DEFAULT NULL,
  `data_envio` datetime DEFAULT NULL,
  `campanha` longtext,
  `nome_remetente` varchar(255) DEFAULT NULL,
  `email_remetente` varchar(255) DEFAULT NULL,
  `assunto` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `cor_interna` varchar(255) DEFAULT NULL,
  `cor_fundo` varchar(255) DEFAULT NULL,
  `cor_borda` varchar(255) DEFAULT NULL,
  `largura` int(11) DEFAULT '0',
  `n_envios` double DEFAULT '0',
  `n_emails` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_newsletter_emails_avulso`
--

CREATE TABLE `tb_newsletter_emails_avulso` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_newsletter_emails_avulso_grupos` double DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `ativacao_mala_direta` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_newsletter_emails_avulso_grupos`
--

CREATE TABLE `tb_newsletter_emails_avulso_grupos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_newsletter` double DEFAULT '0',
  `data_grupo` datetime DEFAULT NULL,
  `grupo_emails` varchar(255) DEFAULT NULL,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_newsletter_ips`
--

CREATE TABLE `tb_newsletter_ips` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `data_inclusao` datetime DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `ip_rotativo` varchar(255) DEFAULT NULL,
  `servidor_smtp` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` longtext,
  `porta_smtp` varchar(255) DEFAULT NULL,
  `encryption` int(11) DEFAULT '0',
  `habilitar_autenticacao` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao_selecao` int(11) DEFAULT '0',
  `informacao_configuracao1` varchar(255) DEFAULT NULL,
  `informacao_configuracao2` varchar(255) DEFAULT NULL,
  `informacao_configuracao3` varchar(255) DEFAULT NULL,
  `informacao_configuracao4` varchar(255) DEFAULT NULL,
  `informacao_configuracao5` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_newsletter_relacao_cadastro`
--

CREATE TABLE `tb_newsletter_relacao_cadastro` (
  `id_tb_newsletter` double DEFAULT '0',
  `id_tb_categorias_cadastro` double DEFAULT '0',
  `id_tb_cadastro_complemento` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paginas`
--

CREATE TABLE `tb_paginas` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `palavras_chave` longtext,
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `n_visitas` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paginas_complemento`
--

CREATE TABLE `tb_paginas_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paginas_relacao_cadastro`
--

CREATE TABLE `tb_paginas_relacao_cadastro` (
  `id_tb_paginas` double DEFAULT '0',
  `id_tb_cadastro` double DEFAULT '0',
  `tipo_relacao` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_paginas_relacao_complemento`
--

CREATE TABLE `tb_paginas_relacao_complemento` (
  `id_tb_paginas` double DEFAULT '0',
  `id_tb_paginas_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_processos`
--

CREATE TABLE `tb_processos` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `data_abertura` datetime DEFAULT NULL,
  `data_distribuicao` datetime DEFAULT NULL,
  `data_admissao` datetime DEFAULT NULL,
  `data_demissao` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `data6` datetime DEFAULT NULL,
  `data7` datetime DEFAULT NULL,
  `data8` datetime DEFAULT NULL,
  `data9` datetime DEFAULT NULL,
  `data10` datetime DEFAULT NULL,
  `processo` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `id_tb_processos_status` double DEFAULT '0',
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `informacao_complementar41` longtext,
  `informacao_complementar42` longtext,
  `informacao_complementar43` longtext,
  `informacao_complementar44` longtext,
  `informacao_complementar45` longtext,
  `informacao_complementar46` longtext,
  `informacao_complementar47` longtext,
  `informacao_complementar48` longtext,
  `informacao_complementar49` longtext,
  `informacao_complementar50` longtext,
  `informacao_complementar51` longtext,
  `informacao_complementar52` longtext,
  `informacao_complementar53` longtext,
  `informacao_complementar54` longtext,
  `informacao_complementar55` longtext,
  `informacao_complementar56` longtext,
  `informacao_complementar57` longtext,
  `informacao_complementar58` longtext,
  `informacao_complementar59` longtext,
  `informacao_complementar60` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `n_visitas` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_processos_complemento`
--

CREATE TABLE `tb_processos_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_processos_relacao_complemento`
--

CREATE TABLE `tb_processos_relacao_complemento` (
  `id_tb_processos` double DEFAULT '0',
  `id_tb_processos_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `data_produto` datetime DEFAULT NULL,
  `data_edicao` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `cod_produto` varchar(255) DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `produto` longtext,
  `descricao01` longtext,
  `descricao02` longtext,
  `descricao03` longtext,
  `descricao04` longtext,
  `descricao05` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `informacao_complementar41` longtext,
  `informacao_complementar42` longtext,
  `informacao_complementar43` longtext,
  `informacao_complementar44` longtext,
  `informacao_complementar45` longtext,
  `informacao_complementar46` longtext,
  `informacao_complementar47` longtext,
  `informacao_complementar48` longtext,
  `informacao_complementar49` longtext,
  `informacao_complementar50` longtext,
  `url_amigavel` longtext,
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `peso` double DEFAULT '0',
  `coeficiente` int(11) DEFAULT '0',
  `estoque` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `ativacao_promocao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `n_questoes_aprovacao` int(11) DEFAULT '0',
  `id_tb_produtos_status` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `anotacoes_internas` longtext,
  `n_visitas` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_produtos`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_backup01`
--

CREATE TABLE `tb_produtos_backup01` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_produto` datetime DEFAULT NULL,
  `data_edicao` datetime DEFAULT NULL,
  `cod_produto` varchar(255) DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `produto` longtext,
  `descricao01` longtext,
  `descricao02` longtext,
  `descricao03` longtext,
  `descricao04` longtext,
  `descricao05` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `peso` double DEFAULT '0',
  `coeficiente` int(11) DEFAULT '0',
  `estoque` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao_promocao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `n_questoes_aprovacao` int(11) DEFAULT '0',
  `id_tb_produtos_status` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `anotacoes_internas` longtext,
  `n_visitas` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_complemento`
--

CREATE TABLE `tb_produtos_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_produtos_complemento`
--

INSERT INTO `tb_produtos_complemento` (`id`, `tipo_complemento`, `complemento`, `descricao`, `anotacoes_banco01`, `anotacoes_banco02`) VALUES
(3483, 2, 'Diplomas', '', NULL, NULL),
(3484, 2, 'Documentos', '', NULL, NULL),
(3485, 2, 'Fotografia', '', NULL, NULL),
(3486, 2, 'Livros', '', NULL, NULL),
(3487, 2, 'Mapas', '', NULL, NULL),
(3488, 2, 'Obras de Arte', '', NULL, NULL),
(3489, 12, 'Exemplo de Nome de Autor 01', '', NULL, NULL),
(3490, 12, 'Exemplo de Nome de Autor 02', '', NULL, NULL),
(3491, 12, 'Exemplo de Nome de Autor 03', '', NULL, NULL),
(3492, 13, 'Exemplo de Nome de Autor Principal 01', '', NULL, NULL),
(3493, 13, 'Exemplo de Nome de Autor Principal 02', '', NULL, NULL),
(3494, 14, 'Exemplo de Nome de Autor Secundário 01', '', NULL, NULL),
(3495, 14, 'Exemplo de Nome de Autor Secundário 02', '', NULL, NULL),
(3496, 14, 'Exemplo de Nome de Autor Secundário 03', '', NULL, NULL),
(3497, 14, 'Exemplo de Nome de Autor Secundário 04', '', NULL, NULL),
(3498, 15, 'Português', '', NULL, NULL),
(3499, 15, 'Inglês', '', NULL, NULL),
(3500, 15, 'Alemão', '', NULL, NULL),
(3501, 15, 'Espanhol', '', NULL, NULL),
(3502, 16, 'Exemplo de Editora 01', '', NULL, NULL),
(3503, 16, 'Exemplo de Editora 02', '', NULL, NULL),
(3504, 17, 'Biblioteca', '', NULL, NULL),
(3505, 17, 'Fundação', '', NULL, NULL),
(3506, 18, 'Pasta Mecânica', '', NULL, NULL),
(3507, 18, 'Pasta Química', '', NULL, NULL),
(4126, 32, '', '', NULL, NULL),
(3509, 19, 'Offset', '', NULL, NULL),
(3510, 19, 'Datilografia', '', NULL, NULL),
(3511, 23, 'Selos de Papel', '', NULL, NULL),
(3512, 23, 'Selos de Cera', '', NULL, NULL),
(3513, 23, 'Ornamentos de Tecido', '', NULL, NULL),
(3514, 21, 'Exemplo de Órgão Emissor 01', '', NULL, NULL),
(3515, 21, 'Exemplo de Órgão Emissor 01', '', NULL, NULL),
(3516, 22, 'Exemplo de Favorecido 01', '', NULL, NULL),
(3517, 22, 'Exemplo de Favorecido 02', '', NULL, NULL),
(3518, 22, 'Exemplo de Favorecido 03', '', NULL, NULL),
(3519, 24, 'Exemplo de Destinatário 01', '', NULL, NULL),
(3520, 24, 'Exemplo de Destinatário 02', '', NULL, NULL),
(3521, 25, 'Filme Digitalizado', '', NULL, NULL),
(3522, 26, 'Gelatina de Prata', '', NULL, NULL),
(3523, 27, 'Pelo Artista', '', NULL, NULL),
(3524, 28, 'Laminada no Verso', '', NULL, NULL),
(3525, 29, 'Sim', '', NULL, NULL),
(3526, 29, 'Não', '', NULL, NULL),
(3527, 30, 'Desconheço', '', NULL, NULL),
(3528, 31, 'Exemplo de Artista 01', '', NULL, NULL),
(3529, 31, 'Exemplo de Artista 02', '', NULL, NULL),
(3530, 32, 'Laboratório Comercial', '', NULL, NULL),
(3683, 20, 'Datilografia', '', NULL, NULL),
(3968, 35, 'conservação', '', NULL, NULL),
(4022, 18, 'Bambu', '', NULL, NULL),
(3686, 33, 'Gravura Metal', '', NULL, NULL),
(3687, 33, 'Pasta Química', '', NULL, NULL),
(3688, 33, 'Pasta de Trapo', '', NULL, NULL),
(3689, 34, 'Pelo Ateliê do Artista', '', NULL, NULL),
(3768, 12, 'teste', '', NULL, NULL),
(3815, 16, 'ttt', '', NULL, NULL),
(3774, 35, 'Teste com palavra', '', NULL, NULL),
(3958, 21, 'Universidade de São Paulo', '', NULL, NULL),
(3963, 20, 'manuscrito', '', NULL, NULL),
(3960, 22, 'Isis Baldini Elias', '', NULL, NULL),
(3964, 20, 'impressão', '', NULL, NULL),
(3965, 20, 'carimbo', '', NULL, NULL),
(3966, 20, 'offset', '', NULL, NULL),
(3969, 35, 'restauro', '', NULL, NULL),
(3970, 35, 'acondicionamento', '', NULL, NULL),
(3983, 12, 'ATWOOD, Margareth', '', NULL, NULL),
(3984, 16, 'Rocco', '', NULL, NULL),
(3985, 35, 'Literatura canadense', '', NULL, NULL),
(3986, 35, 'Ficção', '', NULL, NULL),
(3996, 31, 'Irma Blank', '', NULL, NULL),
(3997, 31, 'Waltercio Caldas', '', NULL, NULL),
(3998, 31, 'Emiliano Di Cavalcanti', '', NULL, NULL),
(3999, 31, 'Pablo Picasso', '', NULL, NULL),
(4006, 33, 'Pastel seco', '', NULL, NULL),
(4001, 33, 'Rótulos pintados colados sobre madeira', '', NULL, NULL),
(4002, 33, 'aquarela', '', NULL, NULL),
(4003, 33, 'grafite', '', NULL, NULL),
(4007, 32, 'sem registro', '', NULL, NULL),
(4008, 17, 'Biblioteca Brasiliana Guita e José Mindlin', '', NULL, NULL),
(4009, 17, 'Suzana Steinbruch', '', NULL, NULL),
(4010, 17, 'Orandi Momesso', '', NULL, NULL),
(4011, 17, 'Carlos Zeron', '', NULL, NULL),
(4012, 18, 'papel 100% algodão', '', NULL, NULL),
(4023, 18, 'Bambu2', '', NULL, NULL),
(4026, 18, 'Bambu3 - editado3', '', NULL, NULL),
(4032, 16, 'Exemplo de Editora 04', '', NULL, NULL),
(4031, 16, 'Exemplo de Editora 03', '', NULL, NULL),
(4029, 18, 'Bambu4', '', NULL, NULL),
(4033, 16, 'Exemplo de Editora 05', '', NULL, NULL),
(4034, 16, 'Exemplo de Editora 06', '', NULL, NULL),
(4035, 16, 'Exemplo de Editora 07', '', NULL, NULL),
(4036, 16, 'Exemplo de Editora 08', '', NULL, NULL),
(4095, 16, 'Mais um exemplo', '', NULL, NULL),
(4127, 32, 'com', '', NULL, NULL),
(4131, 36, 'Livro de Artista', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_estoque`
--

CREATE TABLE `tb_produtos_estoque` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_produtos` double DEFAULT '0',
  `id_tb_produtos_opcoes` double DEFAULT '0',
  `id_tb_cadastro_cliente` double DEFAULT '0',
  `id_ce_itens` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_movimento` datetime DEFAULT NULL,
  `tipo_movimento` int(11) DEFAULT '0',
  `origem_movimento` varchar(50) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `quantidade` double DEFAULT '0',
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_opcoes`
--

CREATE TABLE `tb_produtos_opcoes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_produtos` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `tipo_opcao` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `ativacao` int(11) DEFAULT '0',
  `tipo_selecao` int(11) DEFAULT '0',
  `tipo_selecao_n_colunas` int(11) DEFAULT '0',
  `obrigatorio` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_opcoes_variacoes`
--

CREATE TABLE `tb_produtos_opcoes_variacoes` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_produtos_opcoes` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `variacao` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `ativacao` int(11) DEFAULT '0',
  `valor` double DEFAULT '0',
  `configuracao` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_relacao_cadastro`
--

CREATE TABLE `tb_produtos_relacao_cadastro` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_produtos` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_atualizacao` datetime DEFAULT NULL,
  `valor` double DEFAULT '0',
  `valor_login` double DEFAULT '0',
  `estoque` double DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_destaque` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_relacao_complemento`
--

CREATE TABLE `tb_produtos_relacao_complemento` (
  `id_tb_produtos` double DEFAULT '0',
  `id_tb_produtos_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_produtos_relacao_complemento`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_produtos_relacao_produtos`
--

CREATE TABLE `tb_produtos_relacao_produtos` (
  `id` double DEFAULT '0',
  `n_classificacao` int(11) DEFAULT '0',
  `data_relacao` datetime DEFAULT NULL,
  `id_tb_produtos` double DEFAULT '0',
  `id_tb_produtos_relacao` double DEFAULT '0',
  `tipo_relacao` int(11) DEFAULT '0',
  `obs` longtext,
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_publicacoes`
--

CREATE TABLE `tb_publicacoes` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_publicacao` int(11) DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `data_publicacao` datetime DEFAULT NULL,
  `data_final_publicacao` datetime DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `titulo` longtext,
  `conteudo_simples` longtext,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `fonte` varchar(255) DEFAULT NULL,
  `link_fonte` varchar(255) DEFAULT NULL,
  `editoria` varchar(255) DEFAULT NULL,
  `palavras_chave` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_publicacoes_complemento`
--

CREATE TABLE `tb_publicacoes_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_publicacoes_relacao_complemento`
--

CREATE TABLE `tb_publicacoes_relacao_complemento` (
  `id_tb_publicacoes` double DEFAULT '0',
  `id_tb_publicacoes_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tarefas`
--

CREATE TABLE `tb_tarefas` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `data_registro_tarefa` datetime DEFAULT NULL,
  `data_tarefa` datetime DEFAULT NULL,
  `data_tarefa_final` datetime DEFAULT NULL,
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `tarefa` longtext,
  `descricao` longtext,
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `id_tb_tarefa_status` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_turmas`
--

CREATE TABLE `tb_turmas` (
  `id` double NOT NULL DEFAULT '0',
  `id_parent` double DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `id_tb_cadastro4` double DEFAULT '0',
  `id_tb_cadastro5` double DEFAULT '0',
  `id_tb_cadastro6` double DEFAULT '0',
  `id_tb_cadastro7` double DEFAULT '0',
  `id_tb_cadastro8` double DEFAULT '0',
  `id_tb_cadastro9` double DEFAULT '0',
  `id_tb_cadastro10` double DEFAULT '0',
  `n_classificacao` double DEFAULT '0',
  `data_criacao` datetime DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_final` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `data6` datetime DEFAULT NULL,
  `data7` datetime DEFAULT NULL,
  `data8` datetime DEFAULT NULL,
  `data9` datetime DEFAULT NULL,
  `data10` datetime DEFAULT NULL,
  `nome_turma` varchar(255) DEFAULT NULL,
  `cod_turma` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `id_tb_turmas_status` double DEFAULT '0',
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `valor3` double DEFAULT '0',
  `valor4` double DEFAULT '0',
  `valor5` double DEFAULT '0',
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `informacao_complementar41` longtext,
  `informacao_complementar42` longtext,
  `informacao_complementar43` longtext,
  `informacao_complementar44` longtext,
  `informacao_complementar45` longtext,
  `informacao_complementar46` longtext,
  `informacao_complementar47` longtext,
  `informacao_complementar48` longtext,
  `informacao_complementar49` longtext,
  `informacao_complementar50` longtext,
  `informacao_complementar51` longtext,
  `informacao_complementar52` longtext,
  `informacao_complementar53` longtext,
  `informacao_complementar54` longtext,
  `informacao_complementar55` longtext,
  `informacao_complementar56` longtext,
  `informacao_complementar57` longtext,
  `informacao_complementar58` longtext,
  `informacao_complementar59` longtext,
  `informacao_complementar60` longtext,
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `anotacoes_internas` longtext,
  `n_visitas` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_turmas_complemento`
--

CREATE TABLE `tb_turmas_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_turmas_relacao_complemento`
--

CREATE TABLE `tb_turmas_relacao_complemento` (
  `id_tb_turmas` double DEFAULT '0',
  `id_tb_turmas_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id` double NOT NULL DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `obs` longtext,
  `usuario_data` datetime DEFAULT NULL,
  `usuario_tipo` int(11) DEFAULT '0',
  `ativacao` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id`, `nome`, `usuario`, `senha`, `email`, `obs`, `usuario_data`, `usuario_tipo`, `ativacao`) VALUES
(0, NULL, NULL, 'sistema', NULL, 'Usuário padrão ASP', NULL, 0, 1),
(1, NULL, NULL, 'UbcvakWrFIH07Vt7OzaaiA==', NULL, 'Usuário padrão ASP.NET', NULL, 0, 1),
(2, NULL, NULL, 'zBipOt+psQLNleAuTb9miucg2qf5urv2iDlI1nUaRhQeGJFNrbAl//bMVDt5X8oOxW8b2Bdg4d21bXAZbByvgDrXeINtkqE3xwGECEZU9frGElB7GugSd7JQAa3h8A9c|Em7XrqN9Zyei47uSwgu7D77WBP6avZzBywccWZ+zpcY=', NULL, 'Usuário padrão PHP (MCrypt PHP library)', NULL, 0, 1),
(3, NULL, NULL, '4f60ea1ef9e951b3fdc8f22b94fc6056', NULL, 'Usuário padrão (md5)', NULL, 0, 1),
(4, NULL, NULL, 'def50200b308a5fb5c5764eba4b4ca9a90054ef14296b5a6f22e639bd4153944385af10c255da199b6798cceb61207ef04fdc4ccbd9f08109fe6bc5602df3597c9af72ff43e71743a3e32dcef94b6a0c519bf7d433192716371a3e', NULL, 'Usuário padrão PHP (Defuse php-encryption)', NULL, 0, 1),
(3477, 'Administrador', 'admin', '7og/tX7NvjIC/iq3ZRB9GsPpi9xEqrZr5I4h3FKSepxvVqVR4OjGNXrllK8vp4Q9J1/HP7flDwj7RPvV4VKZ8Cotuc6/5s9tNcypdz2BNfd4mMgKtFErHVkTd2MllOVz|efK9VeKtPICeJFUhhhEGuGwFqfDp2wXgHbSvQP7Alp0=', '', '', '2018-08-10 11:16:20', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_usuarios_log`
--

CREATE TABLE `tb_usuarios_log` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_usuarios` double DEFAULT '0',
  `tipo_log` double DEFAULT '0',
  `data_log` double DEFAULT '0',
  `acao` varchar(255) DEFAULT NULL,
  `obs` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_veiculos`
--

CREATE TABLE `tb_veiculos` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `modalidade` int(11) DEFAULT '0',
  `data_publicacao` datetime DEFAULT NULL,
  `data1` datetime DEFAULT NULL,
  `data2` datetime DEFAULT NULL,
  `data3` datetime DEFAULT NULL,
  `data4` datetime DEFAULT NULL,
  `data5` datetime DEFAULT NULL,
  `data6` datetime DEFAULT NULL,
  `data7` datetime DEFAULT NULL,
  `data8` datetime DEFAULT NULL,
  `data9` datetime DEFAULT NULL,
  `data10` datetime DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `veiculo` longtext,
  `descricao` longtext,
  `portas` int(11) DEFAULT '0',
  `kilometragem` double DEFAULT '0',
  `placa` varchar(255) DEFAULT NULL,
  `ano_fabricacao` int(11) DEFAULT '0',
  `ano_modelo` int(11) DEFAULT '0',
  `id_tb_cadastro1` double DEFAULT '0',
  `id_tb_cadastro2` double DEFAULT '0',
  `id_tb_cadastro3` double DEFAULT '0',
  `id_tb_cadastro4` double DEFAULT '0',
  `id_tb_cadastro5` double DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `informacao_complementar16` longtext,
  `informacao_complementar17` longtext,
  `informacao_complementar18` longtext,
  `informacao_complementar19` longtext,
  `informacao_complementar20` longtext,
  `informacao_complementar21` longtext,
  `informacao_complementar22` longtext,
  `informacao_complementar23` longtext,
  `informacao_complementar24` longtext,
  `informacao_complementar25` longtext,
  `informacao_complementar26` longtext,
  `informacao_complementar27` longtext,
  `informacao_complementar28` longtext,
  `informacao_complementar29` longtext,
  `informacao_complementar30` longtext,
  `informacao_complementar31` longtext,
  `informacao_complementar32` longtext,
  `informacao_complementar33` longtext,
  `informacao_complementar34` longtext,
  `informacao_complementar35` longtext,
  `informacao_complementar36` longtext,
  `informacao_complementar37` longtext,
  `informacao_complementar38` longtext,
  `informacao_complementar39` longtext,
  `informacao_complementar40` longtext,
  `id_db_cep_tblBairros` double DEFAULT '0',
  `id_db_cep_tblCidades` double DEFAULT '0',
  `id_db_cep_tblLogradouros` double DEFAULT '0',
  `id_db_cep_tblUF` varchar(255) DEFAULT NULL,
  `veiculo_endereco` varchar(255) DEFAULT NULL,
  `veiculo_endereco_numero` varchar(255) DEFAULT NULL,
  `veiculo_endereco_complemento` varchar(255) DEFAULT NULL,
  `veiculo_bairro` varchar(255) DEFAULT NULL,
  `veiculo_cidade` varchar(255) DEFAULT NULL,
  `veiculo_estado` varchar(255) DEFAULT NULL,
  `veiculo_pais` varchar(255) DEFAULT NULL,
  `veiculo_cep` varchar(255) DEFAULT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `link_externo` longtext,
  `url1` longtext,
  `url2` longtext,
  `url3` longtext,
  `url4` longtext,
  `url5` longtext,
  `url_amigavel` longtext,
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `valor1` double DEFAULT '0',
  `valor2` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao1` int(11) DEFAULT '0',
  `ativacao2` int(11) DEFAULT '0',
  `ativacao3` int(11) DEFAULT '0',
  `ativacao4` int(11) DEFAULT '0',
  `ativacao_promocao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `ativacao_info_cadastro` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `id_tb_veiculos_status` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `arquivo1` varchar(255) DEFAULT NULL,
  `arquivo2` varchar(255) DEFAULT NULL,
  `arquivo3` varchar(255) DEFAULT NULL,
  `arquivo4` varchar(255) DEFAULT NULL,
  `arquivo5` varchar(255) DEFAULT NULL,
  `anotacoes_internas` longtext,
  `n_visitas` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_veiculos_backup01`
--

CREATE TABLE `tb_veiculos_backup01` (
  `id` double NOT NULL DEFAULT '0',
  `id_tb_categorias` double DEFAULT '0',
  `id_tb_cadastro_usuario` double DEFAULT '0',
  `modalidade` int(11) DEFAULT '0',
  `data_publicacao` datetime DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `n_classificacao` double DEFAULT '0',
  `veiculo` longtext,
  `descricao` longtext,
  `portas` int(11) DEFAULT '0',
  `kilometragem` double DEFAULT '0',
  `placa` varchar(255) DEFAULT NULL,
  `ano_fabricacao` int(11) DEFAULT '0',
  `ano_modelo` int(11) DEFAULT '0',
  `informacao_complementar1` longtext,
  `informacao_complementar2` longtext,
  `informacao_complementar3` longtext,
  `informacao_complementar4` longtext,
  `informacao_complementar5` longtext,
  `informacao_complementar6` longtext,
  `informacao_complementar7` longtext,
  `informacao_complementar8` longtext,
  `informacao_complementar9` longtext,
  `informacao_complementar10` longtext,
  `informacao_complementar11` longtext,
  `informacao_complementar12` longtext,
  `informacao_complementar13` longtext,
  `informacao_complementar14` longtext,
  `informacao_complementar15` longtext,
  `id_db_cep_tblBairros` double DEFAULT '0',
  `id_db_cep_tblCidades` double DEFAULT '0',
  `id_db_cep_tblLogradouros` double DEFAULT '0',
  `id_db_cep_tblUF` varchar(255) DEFAULT NULL,
  `veiculo_endereco` varchar(255) DEFAULT NULL,
  `veiculo_endereco_numero` varchar(255) DEFAULT NULL,
  `veiculo_endereco_complemento` varchar(255) DEFAULT NULL,
  `veiculo_bairro` varchar(255) DEFAULT NULL,
  `veiculo_cidade` varchar(255) DEFAULT NULL,
  `veiculo_estado` varchar(255) DEFAULT NULL,
  `veiculo_pais` varchar(255) DEFAULT NULL,
  `veiculo_cep` varchar(255) DEFAULT NULL,
  `contato` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `link_externo` longtext,
  `palavras_chave` longtext,
  `valor` double DEFAULT '0',
  `ativacao` int(11) DEFAULT '0',
  `ativacao_promocao` int(11) DEFAULT '0',
  `ativacao_home` int(11) DEFAULT '0',
  `ativacao_home_categoria` int(11) DEFAULT '0',
  `ativacao_info_cadastro` int(11) DEFAULT '0',
  `acesso_restrito` int(11) DEFAULT '0',
  `id_tb_veiculos_status` double DEFAULT '0',
  `imagem` varchar(255) DEFAULT NULL,
  `anotacoes_internas` longtext,
  `n_visitas` double DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_veiculos_complemento`
--

CREATE TABLE `tb_veiculos_complemento` (
  `id` double NOT NULL DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0',
  `complemento` varchar(255) DEFAULT NULL,
  `descricao` longtext,
  `anotacoes_banco01` varchar(50) DEFAULT NULL,
  `anotacoes_banco02` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_veiculos_relacao_complemento`
--

CREATE TABLE `tb_veiculos_relacao_complemento` (
  `id_tb_veiculos` double DEFAULT '0',
  `id_tb_veiculos_complemento` double DEFAULT '0',
  `tipo_complemento` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ce_complemento`
--
ALTER TABLE `ce_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ce_itens`
--
ALTER TABLE `ce_itens`
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_itens_valores` (`id_tb_itens_valores`),
  ADD KEY `id_tb_itens_valores_titulo` (`id_tb_itens_valores_titulo`(100)),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_tb_produtos_complemento_status` (`id_tb_produtos_complemento_status`),
  ADD KEY `id_ce_pedidos` (`id_ce_pedidos`),
  ADD KEY `ids_opcionais` (`ids_opcionais`(100)),
  ADD KEY `ids_opcionais_descricao` (`ids_opcionais_descricao`(100));

--
-- Indexes for table `ce_itens_backup01`
--
ALTER TABLE `ce_itens_backup01`
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_tb_produtos_complemento_status` (`id_tb_produtos_complemento_status`),
  ADD KEY `id_ce_pedidos` (`id_ce_pedidos`);

--
-- Indexes for table `ce_itens_temporario`
--
ALTER TABLE `ce_itens_temporario`
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `ids_opcionais` (`ids_opcionais`(100)),
  ADD KEY `id_tb_itens_valores` (`id_tb_itens_valores`),
  ADD KEY `id_tb_itens_valores_titulo` (`id_tb_itens_valores_titulo`(100)),
  ADD KEY `ids_opcionais_descricao` (`ids_opcionais_descricao`(100));

--
-- Indexes for table `ce_itens_temporario_backup01`
--
ALTER TABLE `ce_itens_temporario_backup01`
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `ce_orcamentos`
--
ALTER TABLE `ce_orcamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_ce_complemento_status` (`id_ce_complemento_status`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_enderecos` (`id_tb_cadastro_enderecos`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro_vendedor` (`id_tb_cadastro_vendedor`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `ce_orcamentos_fichas`
--
ALTER TABLE `ce_orcamentos_fichas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_ce_complemento_status` (`id_ce_complemento_status`),
  ADD KEY `id_ce_orcamentos` (`id_ce_orcamentos`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro_vendedor` (`id_tb_cadastro_vendedor`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `ce_orcamentos_itens`
--
ALTER TABLE `ce_orcamentos_itens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `ce_orcamentos_itens_relacao_registros`
--
ALTER TABLE `ce_orcamentos_itens_relacao_registros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_ce_orcamentos` (`id_ce_orcamentos`),
  ADD KEY `id_ce_orcamentos_itens` (`id_ce_orcamentos_itens`);

--
-- Indexes for table `ce_orcamentos_relacao_itens`
--
ALTER TABLE `ce_orcamentos_relacao_itens`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_ce_orcamentos` (`id_ce_orcamentos`),
  ADD KEY `id_ce_orcamentos_itens` (`id_ce_orcamentos_itens`);

--
-- Indexes for table `ce_orcamentos_relacao_registros`
--
ALTER TABLE `ce_orcamentos_relacao_registros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_ce_orcamentos` (`id_ce_orcamentos`);

--
-- Indexes for table `ce_pedidos`
--
ALTER TABLE `ce_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_cartoes` (`id_tb_cadastro_cartoes`),
  ADD KEY `id_tb_cadastro_enderecos` (`id_tb_cadastro_enderecos`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro4` (`id_tb_cadastro4`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro5` (`id_tb_cadastro5`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro6` (`id_tb_cadastro6`),
  ADD KEY `id_tb_cadastro7` (`id_tb_cadastro7`),
  ADD KEY `id_tb_cadastro8` (`id_tb_cadastro8`),
  ADD KEY `id_tb_cadastro9` (`id_tb_cadastro9`),
  ADD KEY `id_tb_cadastro10` (`id_tb_cadastro10`),
  ADD KEY `id_ce_complemento_status` (`id_ce_complemento_status`);

--
-- Indexes for table `ce_pedidos_backup01`
--
ALTER TABLE `ce_pedidos_backup01`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_cartoes` (`id_tb_cadastro_cartoes`),
  ADD KEY `id_tb_cadastro_enderecos` (`id_tb_cadastro_enderecos`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_ce_complemento_status` (`id_ce_complemento_status`);

--
-- Indexes for table `ce_pedidos_log`
--
ALTER TABLE `ce_pedidos_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_ce_itens` (`id_ce_itens`),
  ADD KEY `id_ce_pedidos` (`id_ce_pedidos`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `ce_pedidos_parcelas`
--
ALTER TABLE `ce_pedidos_parcelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_ce_complemento_tipo` (`id_ce_complemento_tipo`),
  ADD KEY `id_ce_complemento_status` (`id_ce_complemento_status`),
  ADD KEY `id_ce_pedidos` (`id_ce_pedidos`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `ce_relacao_complemento`
--
ALTER TABLE `ce_relacao_complemento`
  ADD KEY `id_ce_registro` (`id_ce_registro`),
  ADD KEY `id_ce_complemento` (`id_ce_complemento`);

--
-- Indexes for table `ce_reservas`
--
ALTER TABLE `ce_reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_ce_complementos_status` (`id_ce_complementos_status`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`);

--
-- Indexes for table `classificacao`
--
ALTER TABLE `classificacao`
  ADD KEY `id_registro` (`id_registro`);

--
-- Indexes for table `config_bairro`
--
ALTER TABLE `config_bairro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_config_cidade` (`id_config_cidade`),
  ADD KEY `id_config_regiao` (`id_config_regiao`);

--
-- Indexes for table `config_cidade`
--
ALTER TABLE `config_cidade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_estado` (`id_tb_estado`);

--
-- Indexes for table `config_estado`
--
ALTER TABLE `config_estado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_pais` (`id_tb_pais`);

--
-- Indexes for table `config_pais`
--
ALTER TABLE `config_pais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `config_regiao`
--
ALTER TABLE `config_regiao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_config_cidade` (`id_config_cidade`);

--
-- Indexes for table `contador`
--
ALTER TABLE `contador`
  ADD KEY `id` (`id`);

--
-- Indexes for table `fl_grupos`
--
ALTER TABLE `fl_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `fl_grupos_arquivos`
--
ALTER TABLE `fl_grupos_arquivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_fl_grupos` (`id_fl_grupos`);

--
-- Indexes for table `tabela_generica`
--
ALTER TABLE `tabela_generica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tabela` (`id_tabela`);

--
-- Indexes for table `tb_afiliacoes`
--
ALTER TABLE `tb_afiliacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_afiliacoes_relacoes`
--
ALTER TABLE `tb_afiliacoes_relacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_afiliacoes` (`id_tb_afiliacoes`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_animais`
--
ALTER TABLE `tb_animais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tb_animais_complemento`
--
ALTER TABLE `tb_animais_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_animais_relacao_complemento`
--
ALTER TABLE `tb_animais_relacao_complemento`
  ADD KEY `id_tb_animais` (`id_tb_animais`),
  ADD KEY `id_tb_animais_complemento` (`id_tb_animais_complemento`);

--
-- Indexes for table `tb_arquivos`
--
ALTER TABLE `tb_arquivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tb_atendimento`
--
ALTER TABLE `tb_atendimento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_atendimento` (`id_tb_atendimento`),
  ADD KEY `id_tb_cadastro_remetente` (`id_tb_cadastro_remetente`),
  ADD KEY `id_tb_cadastro_destinatario` (`id_tb_cadastro_destinatario`);

--
-- Indexes for table `tb_atendimento_relacao_categorias`
--
ALTER TABLE `tb_atendimento_relacao_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_aulas`
--
ALTER TABLE `tb_aulas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro4` (`id_tb_cadastro4`),
  ADD KEY `id_tb_cadastro5` (`id_tb_cadastro5`);

--
-- Indexes for table `tb_aulas_complemento`
--
ALTER TABLE `tb_aulas_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_aulas_relacao_complemento`
--
ALTER TABLE `tb_aulas_relacao_complemento`
  ADD KEY `id_tb_aulas` (`id_tb_aulas`),
  ADD KEY `id_tb_aulas_complemento` (`id_tb_aulas_complemento`);

--
-- Indexes for table `tb_banners`
--
ALTER TABLE `tb_banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_banners_arquivos`
--
ALTER TABLE `tb_banners_arquivos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_banners` (`id_tb_banners`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_banners_relacao_categorias`
--
ALTER TABLE `tb_banners_relacao_categorias`
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_banners_arquivos` (`id_tb_banners_arquivos`);

--
-- Indexes for table `tb_cadastro`
--
ALTER TABLE `tb_cadastro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_config_bairro` (`id_config_bairro`),
  ADD KEY `id_config_cidade` (`id_config_cidade`),
  ADD KEY `id_config_estado` (`id_config_estado`),
  ADD KEY `id_config_regiao` (`id_config_regiao`),
  ADD KEY `id_config_pais` (`id_config_pais`),
  ADD KEY `id_db_cep_tblLogradouros` (`id_db_cep_tblLogradouros`),
  ADD KEY `id_db_cep_tblBairros` (`id_db_cep_tblBairros`),
  ADD KEY `id_db_cep_tblCidades` (`id_db_cep_tblCidades`),
  ADD KEY `id_db_cep_tblUF` (`id_db_cep_tblUF`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_status` (`id_tb_cadastro_status`),
  ADD KEY `id_parent_cadastro` (`id_parent_cadastro`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `tb_cadastro_backup01`
--
ALTER TABLE `tb_cadastro_backup01`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_config_bairro` (`id_config_bairro`),
  ADD KEY `id_config_cidade` (`id_config_cidade`),
  ADD KEY `id_config_estado` (`id_config_estado`),
  ADD KEY `id_config_regiao` (`id_config_regiao`),
  ADD KEY `id_config_pais` (`id_config_pais`),
  ADD KEY `id_db_cep_tblLogradouros` (`id_db_cep_tblLogradouros`),
  ADD KEY `id_db_cep_tblBairros` (`id_db_cep_tblBairros`),
  ADD KEY `id_db_cep_tblCidades` (`id_db_cep_tblCidades`),
  ADD KEY `id_db_cep_tblUF` (`id_db_cep_tblUF`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_status` (`id_tb_cadastro_status`),
  ADD KEY `id_parent_cadastro` (`id_parent_cadastro`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `tb_cadastro_cartoes`
--
ALTER TABLE `tb_cadastro_cartoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_complemento`
--
ALTER TABLE `tb_cadastro_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_cadastro_config_transacoes`
--
ALTER TABLE `tb_cadastro_config_transacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_contas_bancarias`
--
ALTER TABLE `tb_cadastro_contas_bancarias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `n_banco` (`n_banco`),
  ADD KEY `n_agencia` (`n_agencia`),
  ADD KEY `digito_agencia` (`digito_agencia`),
  ADD KEY `n_conta` (`n_conta`),
  ADD KEY `digito_conta` (`digito_conta`),
  ADD KEY `tipo_conta` (`tipo_conta`);

--
-- Indexes for table `tb_cadastro_contatos`
--
ALTER TABLE `tb_cadastro_contatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_dominios`
--
ALTER TABLE `tb_cadastro_dominios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_dominios_urls`
--
ALTER TABLE `tb_cadastro_dominios_urls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_dominios` (`id_tb_cadastro_dominios`);

--
-- Indexes for table `tb_cadastro_enderecos`
--
ALTER TABLE `tb_cadastro_enderecos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_config_bairro` (`id_config_bairro`),
  ADD KEY `id_config_cidade` (`id_config_cidade`),
  ADD KEY `id_config_estado` (`id_config_estado`),
  ADD KEY `id_config_pais` (`id_config_pais`),
  ADD KEY `id_config_regiao` (`id_config_regiao`),
  ADD KEY `id_db_cep_tblBairros` (`id_db_cep_tblBairros`),
  ADD KEY `id_db_cep_tblCidades` (`id_db_cep_tblCidades`),
  ADD KEY `id_db_cep_tblLogradouros` (`id_db_cep_tblLogradouros`),
  ADD KEY `id_db_cep_tblUF` (`id_db_cep_tblUF`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_hosts`
--
ALTER TABLE `tb_cadastro_hosts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_servidor` (`id_tb_cadastro_servidor`);

--
-- Indexes for table `tb_cadastro_hosts_emails`
--
ALTER TABLE `tb_cadastro_hosts_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_hosts` (`id_tb_cadastro_hosts`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_log`
--
ALTER TABLE `tb_cadastro_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_login_simultaneo`
--
ALTER TABLE `tb_cadastro_login_simultaneo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent_ativo` (`id_parent_ativo`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_banido` (`id_tb_cadastro_banido`),
  ADD KEY `id_tb_cadastro_ip` (`id_tb_cadastro_ip`),
  ADD KEY `id_tb_cadastro_ip_banido` (`id_tb_cadastro_ip_banido`),
  ADD KEY `preferencias_cor` (`preferencias_cor`),
  ADD KEY `preferencias_fonte` (`preferencias_fonte`),
  ADD KEY `preferencias_imagem` (`preferencias_imagem`),
  ADD KEY `preferencias_fonte_tamanho` (`preferencias_fonte_tamanho`),
  ADD KEY `id_tb_cadastro_atendimento` (`id_tb_cadastro_atendimento`);

--
-- Indexes for table `tb_cadastro_login_verificacao`
--
ALTER TABLE `tb_cadastro_login_verificacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_relacao_complemento`
--
ALTER TABLE `tb_cadastro_relacao_complemento`
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_complemento` (`id_tb_cadastro_complemento`);

--
-- Indexes for table `tb_cadastro_rh`
--
ALTER TABLE `tb_cadastro_rh`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_rh_contrato`
--
ALTER TABLE `tb_cadastro_rh_contrato`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_rh` (`id_tb_cadastro_rh`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_produtos` (`id_tb_produtos`);

--
-- Indexes for table `tb_cadastro_rh_escolaridade`
--
ALTER TABLE `tb_cadastro_rh_escolaridade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_rh_experiencia`
--
ALTER TABLE `tb_cadastro_rh_experiencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_rh_idiomas`
--
ALTER TABLE `tb_cadastro_rh_idiomas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_complemento` (`id_tb_cadastro_complemento`),
  ADD KEY `nivel_idioma` (`nivel_idioma`);

--
-- Indexes for table `tb_cadastro_saques`
--
ALTER TABLE `tb_cadastro_saques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_contas_bancarias` (`id_tb_cadastro_contas_bancarias`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_cadastro_vinculos`
--
ALTER TABLE `tb_cadastro_vinculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_cadastro_vinculos_relacao`
--
ALTER TABLE `tb_cadastro_vinculos_relacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro_vinculado_ativacao` (`id_tb_cadastro_vinculado_ativacao`),
  ADD KEY `id_tb_cadastro_vinculado` (`id_tb_cadastro_vinculado`);

--
-- Indexes for table `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `tb_categorias_estrutura`
--
ALTER TABLE `tb_categorias_estrutura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_top_nivel` (`id_top_nivel`);

--
-- Indexes for table `tb_categorias_relacao_registros`
--
ALTER TABLE `tb_categorias_relacao_registros`
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_registro` (`id_tb_registro`);

--
-- Indexes for table `tb_classificados`
--
ALTER TABLE `tb_classificados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_classificados_relacao_complemento`
--
ALTER TABLE `tb_classificados_relacao_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_complemento` (`id_tb_cadastro_complemento`),
  ADD KEY `id_tb_classificados` (`id_tb_classificados`);

--
-- Indexes for table `tb_conteudo`
--
ALTER TABLE `tb_conteudo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_conteudo_colunas`
--
ALTER TABLE `tb_conteudo_colunas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_conteudo` (`id_tb_conteudo`);

--
-- Indexes for table `tb_enquetes`
--
ALTER TABLE `tb_enquetes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_enquetes_log`
--
ALTER TABLE `tb_enquetes_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_opcoes` (`id_tb_opcoes`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_enquetes` (`id_tb_enquetes`);

--
-- Indexes for table `tb_enquetes_modulos`
--
ALTER TABLE `tb_enquetes_modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tb_enquetes_opcoes`
--
ALTER TABLE `tb_enquetes_opcoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_enquetes` (`id_tb_enquetes`);

--
-- Indexes for table `tb_extras`
--
ALTER TABLE `tb_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `tb_fluxo`
--
ALTER TABLE `tb_fluxo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_fluxo_status` (`id_tb_fluxo_status`),
  ADD KEY `id_tb_fluxo_tipo` (`id_tb_fluxo_tipo`);

--
-- Indexes for table `tb_fluxo_complemento`
--
ALTER TABLE `tb_fluxo_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_fluxo_relacao_complemento`
--
ALTER TABLE `tb_fluxo_relacao_complemento`
  ADD KEY `id_tb_fluxo` (`id_tb_fluxo`),
  ADD KEY `id_tb_fluxo_complemento` (`id_tb_fluxo_complemento`);

--
-- Indexes for table `tb_formularios`
--
ALTER TABLE `tb_formularios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_formularios_campos`
--
ALTER TABLE `tb_formularios_campos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `nome_campo_formatado` (`nome_campo_formatado`),
  ADD KEY `id_tb_formularios` (`id_tb_formularios`);

--
-- Indexes for table `tb_formularios_campos_opcoes`
--
ALTER TABLE `tb_formularios_campos_opcoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_formularios_campos` (`id_tb_formularios_campos`);

--
-- Indexes for table `tb_formularios_emails`
--
ALTER TABLE `tb_formularios_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `obs` (`obs`(100)),
  ADD KEY `imagem` (`imagem`),
  ADD KEY `id` (`id`),
  ADD KEY `departamento` (`departamento`),
  ADD KEY `id_tb_formularios` (`id_tb_formularios`);

--
-- Indexes for table `tb_forum_postagens`
--
ALTER TABLE `tb_forum_postagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `tb_forum_topicos`
--
ALTER TABLE `tb_forum_topicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_cadastro_vendedor` (`id_tb_cadastro_vendedor`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `tb_historico_interacao`
--
ALTER TABLE `tb_historico_interacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `tb_imoveis`
--
ALTER TABLE `tb_imoveis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_config_bairro` (`id_config_bairro`),
  ADD KEY `id_config_cidade` (`id_config_cidade`),
  ADD KEY `id_config_estado` (`id_config_estado`),
  ADD KEY `id_config_pais` (`id_config_pais`),
  ADD KEY `id_config_regiao` (`id_config_regiao`),
  ADD KEY `id_db_cep_tblBairros` (`id_db_cep_tblBairros`),
  ADD KEY `id_db_cep_tblCidades` (`id_db_cep_tblCidades`),
  ADD KEY `id_db_cep_tblLogradouros` (`id_db_cep_tblLogradouros`),
  ADD KEY `id_db_cep_tblUF` (`id_db_cep_tblUF`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro_vendedor` (`id_tb_cadastro_vendedor`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_imoveis_estado` (`id_tb_imoveis_estado`),
  ADD KEY `id_tb_imoveis_bairro` (`id_tb_imoveis_bairro`),
  ADD KEY `id_tb_imoveis_cidade` (`id_tb_imoveis_cidade`);

--
-- Indexes for table `tb_imoveis_complemento`
--
ALTER TABLE `tb_imoveis_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tb_imoveis_relacao_complemento`
--
ALTER TABLE `tb_imoveis_relacao_complemento`
  ADD KEY `id_tb_imoveis` (`id_tb_imoveis`),
  ADD KEY `id_tb_imoveis_complemento` (`id_tb_imoveis_complemento`);

--
-- Indexes for table `tb_itens_config`
--
ALTER TABLE `tb_itens_config`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_registro_complemento` (`id_registro_complemento`);

--
-- Indexes for table `tb_itens_enviados`
--
ALTER TABLE `tb_itens_enviados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id_tb_cadastro_remetente` (`id_tb_cadastro_remetente`),
  ADD KEY `id_tb_cadastro_destinatario` (`id_tb_cadastro_destinatario`);

--
-- Indexes for table `tb_itens_relacao_registros`
--
ALTER TABLE `tb_itens_relacao_registros`
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_itens_relacao_registros_backup01`
--
ALTER TABLE `tb_itens_relacao_registros_backup01`
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_item` (`id_item`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_itens_selecao`
--
ALTER TABLE `tb_itens_selecao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`),
  ADD KEY `id_tb_item` (`id_tb_item`);

--
-- Indexes for table `tb_itens_valores`
--
ALTER TABLE `tb_itens_valores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_registro` (`id_registro`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_log_complemento`
--
ALTER TABLE `tb_log_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_log_relacao_complemento`
--
ALTER TABLE `tb_log_relacao_complemento`
  ADD KEY `id_tb_log` (`id_tb_log`),
  ADD KEY `id_tb_log_complemento` (`id_tb_log_complemento`);

--
-- Indexes for table `tb_modulos`
--
ALTER TABLE `tb_modulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro4` (`id_tb_cadastro4`),
  ADD KEY `id_tb_cadastro5` (`id_tb_cadastro5`);

--
-- Indexes for table `tb_modulos_complemento`
--
ALTER TABLE `tb_modulos_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_modulos_relacao_complemento`
--
ALTER TABLE `tb_modulos_relacao_complemento`
  ADD KEY `id_tb_modulos` (`id_tb_modulos`),
  ADD KEY `id_tb_modulos_complemento` (`id_tb_modulos_complemento`);

--
-- Indexes for table `tb_newsletter`
--
ALTER TABLE `tb_newsletter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_newsletter_emails_avulso`
--
ALTER TABLE `tb_newsletter_emails_avulso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_newsletter_emails_avulso_grupos` (`id_tb_newsletter_emails_avulso_grupos`);

--
-- Indexes for table `tb_newsletter_emails_avulso_grupos`
--
ALTER TABLE `tb_newsletter_emails_avulso_grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_newsletter` (`id_tb_newsletter`);

--
-- Indexes for table `tb_newsletter_ips`
--
ALTER TABLE `tb_newsletter_ips`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`);

--
-- Indexes for table `tb_newsletter_relacao_cadastro`
--
ALTER TABLE `tb_newsletter_relacao_cadastro`
  ADD KEY `id_tb_categorias_cadastro` (`id_tb_categorias_cadastro`),
  ADD KEY `id_tb_cadastro_complemento` (`id_tb_cadastro_complemento`),
  ADD KEY `id_tb_newsletter` (`id_tb_newsletter`);

--
-- Indexes for table `tb_paginas`
--
ALTER TABLE `tb_paginas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `tb_paginas_complemento`
--
ALTER TABLE `tb_paginas_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_paginas_relacao_cadastro`
--
ALTER TABLE `tb_paginas_relacao_cadastro`
  ADD KEY `id_tb_paginas` (`id_tb_paginas`),
  ADD KEY `id_tb_cadastro` (`id_tb_cadastro`);

--
-- Indexes for table `tb_paginas_relacao_complemento`
--
ALTER TABLE `tb_paginas_relacao_complemento`
  ADD KEY `id_tb_paginas` (`id_tb_paginas`),
  ADD KEY `id_tb_paginas_complemento` (`id_tb_paginas_complemento`);

--
-- Indexes for table `tb_processos`
--
ALTER TABLE `tb_processos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`);

--
-- Indexes for table `tb_processos_complemento`
--
ALTER TABLE `tb_processos_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_processos_relacao_complemento`
--
ALTER TABLE `tb_processos_relacao_complemento`
  ADD KEY `id_tb_processos` (`id_tb_processos`),
  ADD KEY `id_tb_processos_complemento` (`id_tb_processos_complemento`);

--
-- Indexes for table `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_produtos_backup01`
--
ALTER TABLE `tb_produtos_backup01`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_produtos_complemento`
--
ALTER TABLE `tb_produtos_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_produtos_estoque`
--
ALTER TABLE `tb_produtos_estoque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_ce_itens` (`id_ce_itens`),
  ADD KEY `id_tb_cadastro_cliente` (`id_tb_cadastro_cliente`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_produtos` (`id_tb_produtos`),
  ADD KEY `id_tb_produtos_opcoes` (`id_tb_produtos_opcoes`);

--
-- Indexes for table `tb_produtos_opcoes`
--
ALTER TABLE `tb_produtos_opcoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_produtos` (`id_tb_produtos`);

--
-- Indexes for table `tb_produtos_opcoes_variacoes`
--
ALTER TABLE `tb_produtos_opcoes_variacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_produtos_opcoes` (`id_tb_produtos_opcoes`);

--
-- Indexes for table `tb_produtos_relacao_cadastro`
--
ALTER TABLE `tb_produtos_relacao_cadastro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_produtos` (`id_tb_produtos`);

--
-- Indexes for table `tb_produtos_relacao_complemento`
--
ALTER TABLE `tb_produtos_relacao_complemento`
  ADD KEY `id_tb_produtos` (`id_tb_produtos`),
  ADD KEY `id_tb_produtos_complemento` (`id_tb_produtos_complemento`);

--
-- Indexes for table `tb_produtos_relacao_produtos`
--
ALTER TABLE `tb_produtos_relacao_produtos`
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_produtos` (`id_tb_produtos`),
  ADD KEY `id_tb_produtos_relacao` (`id_tb_produtos_relacao`);

--
-- Indexes for table `tb_publicacoes`
--
ALTER TABLE `tb_publicacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`);

--
-- Indexes for table `tb_publicacoes_complemento`
--
ALTER TABLE `tb_publicacoes_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_publicacoes_relacao_complemento`
--
ALTER TABLE `tb_publicacoes_relacao_complemento`
  ADD KEY `id_tb_publicacoes` (`id_tb_publicacoes`),
  ADD KEY `id_tb_publicacoes_complemento` (`id_tb_publicacoes_complemento`);

--
-- Indexes for table `tb_tarefas`
--
ALTER TABLE `tb_tarefas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_tarefa_status` (`id_tb_tarefa_status`);

--
-- Indexes for table `tb_turmas`
--
ALTER TABLE `tb_turmas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_parent` (`id_parent`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro10` (`id_tb_cadastro10`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro4` (`id_tb_cadastro4`),
  ADD KEY `id_tb_cadastro5` (`id_tb_cadastro5`),
  ADD KEY `id_tb_cadastro6` (`id_tb_cadastro6`),
  ADD KEY `id_tb_cadastro7` (`id_tb_cadastro7`),
  ADD KEY `id_tb_cadastro8` (`id_tb_cadastro8`),
  ADD KEY `id_tb_cadastro9` (`id_tb_cadastro9`);

--
-- Indexes for table `tb_turmas_complemento`
--
ALTER TABLE `tb_turmas_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_turmas_relacao_complemento`
--
ALTER TABLE `tb_turmas_relacao_complemento`
  ADD KEY `id_tb_turmas` (`id_tb_turmas`),
  ADD KEY `id_tb_turmas_complemento` (`id_tb_turmas_complemento`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_usuarios_log`
--
ALTER TABLE `tb_usuarios_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_tb_usuarios` (`id_tb_usuarios`);

--
-- Indexes for table `tb_veiculos`
--
ALTER TABLE `tb_veiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_db_cep_tblBairros` (`id_db_cep_tblBairros`),
  ADD KEY `id_db_cep_tblCidades` (`id_db_cep_tblCidades`),
  ADD KEY `id_db_cep_tblLogradouros` (`id_db_cep_tblLogradouros`),
  ADD KEY `id_db_cep_tblUF` (`id_db_cep_tblUF`),
  ADD KEY `id_tb_cadastro1` (`id_tb_cadastro1`),
  ADD KEY `id_tb_cadastro2` (`id_tb_cadastro2`),
  ADD KEY `id_tb_cadastro3` (`id_tb_cadastro3`),
  ADD KEY `id_tb_cadastro4` (`id_tb_cadastro4`),
  ADD KEY `id_tb_cadastro5` (`id_tb_cadastro5`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_veiculos_backup01`
--
ALTER TABLE `tb_veiculos_backup01`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_db_cep_tblBairros` (`id_db_cep_tblBairros`),
  ADD KEY `id_db_cep_tblCidades` (`id_db_cep_tblCidades`),
  ADD KEY `id_db_cep_tblLogradouros` (`id_db_cep_tblLogradouros`),
  ADD KEY `id_db_cep_tblUF` (`id_db_cep_tblUF`),
  ADD KEY `id_tb_cadastro_usuario` (`id_tb_cadastro_usuario`),
  ADD KEY `id_tb_categorias` (`id_tb_categorias`);

--
-- Indexes for table `tb_veiculos_complemento`
--
ALTER TABLE `tb_veiculos_complemento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `tb_veiculos_relacao_complemento`
--
ALTER TABLE `tb_veiculos_relacao_complemento`
  ADD KEY `id_tb_veiculos` (`id_tb_veiculos`),
  ADD KEY `id_tb_veiculos_complemento` (`id_tb_veiculos_complemento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
