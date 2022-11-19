-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2022 às 15:09
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `delivery_interativo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adicionais`
--

CREATE TABLE `adicionais` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `valor` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `adicionais`
--

INSERT INTO `adicionais` (`id`, `produto`, `nome`, `ativo`, `valor`) VALUES
(2, 2, 'Cheddar', 'Não', '7.00'),
(3, 2, 'Bacon', 'Sim', '5.00'),
(6, 2, 'Ketchup', 'Sim', '3.50'),
(7, 4, 'Mussarela', 'Sim', '6.00'),
(9, 4, 'Anchovas', 'Sim', '9.00'),
(10, 4, 'Barbecue', 'Sim', '4.90');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE `bairros` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`id`, `nome`, `valor`) VALUES
(1, 'VIla Haro', '8.00'),
(2, 'Alto da Boa Vista', '12.00'),
(4, 'Jardim Rodrigo', '19.00'),
(5, 'Éden', '26.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `sessao` varchar(35) NOT NULL,
  `cliente` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total_item` decimal(8,2) NOT NULL,
  `obs` varchar(255) NOT NULL,
  `pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `sessao`, `cliente`, `produto`, `quantidade`, `total_item`, `obs`, `pedido`) VALUES
(20, '2022-11-17-16:54:27-2794', 3, 4, 1, '43.90', '', 0),
(21, '2022-11-17-16:54:27-2794', 3, 4, 1, '38.90', '', 0),
(22, '2022-11-18-17:06:31-318', 7, 4, 1, '30.00', 'dadadaaaetete', 0),
(23, '2022-11-18-17:06:31-318', 7, 4, 1, '25.00', '', 0),
(24, '2022-11-19-10:23:11-2198', 9, 4, 1, '43.90', 'pedido  do dia', 0),
(25, '2022-11-19-10:23:11-2198', 9, 4, 1, '44.90', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `cor` varchar(30) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `foto`, `cor`, `ativo`, `url`) VALUES
(1, 'Pizzas Gostosas', 'Pizzas Muito Saborosas!!!!', '09-07-2022-18-23-30-SANDUICHE.jpg', 'verde-escuro', 'Sim', 'pizzas-gostosas'),
(3, 'Bebidas', 'Bebidas', '09-07-2022-18-23-50-BEBIDAS.jpg', 'roxo', 'Sim', 'bebidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `logradouro` varchar(50) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `telefone`, `logradouro`, `numero`, `complemento`, `bairro`, `data`) VALUES
(2, 'Eduardo Sakamoto', '(55) 55555-5555', 'Rua Japão', '666', 'Apartamento 213', 'Jardim Rodrigo', '2022-10-31'),
(3, 'Arnaldo Besta', '(44) 44444-4444', 'Rua Quatro', '44', 'apartamento 4', 'Passa Quatro', '2022-11-16'),
(4, 'Cabrón', '(31) 31141-4141', '', '', NULL, '', '2022-11-17'),
(5, 'Julio Pilantra', '(98) 81814-4194', '', '', NULL, '', '2022-11-17'),
(6, 'Hector', '(14) 14131-3133', '', '', NULL, '', '2022-11-17'),
(7, 'Jucaaaaa', '(11) 49295-2952', '', '', NULL, '', '2022-11-17'),
(8, 'Geraldo', '(01) 91191-9191', '', '', NULL, '', '2022-11-17'),
(9, 'Melvin Krigger', '(13) 15353-5353', '', '', NULL, '', '2022-11-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `nome_sistema` varchar(50) NOT NULL,
  `email_sistema` varchar(50) NOT NULL,
  `telefone_sistema` varchar(20) NOT NULL,
  `telefone_fixo` varchar(20) DEFAULT NULL,
  `endereco_sistema` varchar(255) NOT NULL,
  `instagram_sistema` varchar(100) NOT NULL,
  `tipo_rel` varchar(10) NOT NULL,
  `tipo_miniatura` varchar(10) NOT NULL,
  `status_whatsapp` varchar(5) NOT NULL,
  `previsao_entrega` int(11) NOT NULL,
  `horario_abertura` time NOT NULL,
  `horario_fechamento` time NOT NULL,
  `texto_fechamento_horario` varchar(255) DEFAULT NULL,
  `status_estabelecimento` varchar(20) NOT NULL,
  `texto_fechamento_imprevisto` varchar(255) DEFAULT NULL,
  `logo_sistema` varchar(100) NOT NULL,
  `favicon_sistema` varchar(100) NOT NULL,
  `logo_rel` varchar(100) NOT NULL,
  `tempo_atualizar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`id`, `nome_sistema`, `email_sistema`, `telefone_sistema`, `telefone_fixo`, `endereco_sistema`, `instagram_sistema`, `tipo_rel`, `tipo_miniatura`, `status_whatsapp`, `previsao_entrega`, `horario_abertura`, `horario_fechamento`, `texto_fechamento_horario`, `status_estabelecimento`, `texto_fechamento_imprevisto`, `logo_sistema`, `favicon_sistema`, `logo_rel`, `tempo_atualizar`) VALUES
(1, 'Delivery Interativo', 'danielantunespaiva@gmail.com', '(15) 99180-5895', '(15) 3031-4024', 'Alameda do Capiroto,  número 666, Bairro de Satã, Cidade do Caos', 'instagram.com/rapidin', 'PDF', 'Foto', 'Sim', 66, '18:30:00', '00:30:00', 'Texto para fechamento normal', 'Aberto', 'Texto para fechamento imprevisto', 'logo.png', 'favicon.png', 'logo_rel.jpg', 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `entradas`
--

INSERT INTO `entradas` (`id`, `produto`, `quantidade`, `motivo`, `usuario`, `data`) VALUES
(1, 3, 11, 'Compra', 1, '2022-10-27'),
(2, 3, 1, 'Achou na rua', 1, '2022-10-27'),
(3, 4, 30, 'Compra', 1, '2022-11-14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `data` date NOT NULL,
  `tipo_chave` varchar(35) DEFAULT NULL,
  `chave_pix` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `email`, `telefone`, `endereco`, `data`, `tipo_chave`, `chave_pix`) VALUES
(2, 'Marco Janela e Porta', 'janelasportas23@hotmail.com', '(04) 10410-4105', 'Rua das Acácias, 23', '2022-10-31', NULL, NULL),
(3, 'João da Banana', 'banana@hotmail.com', '(15) 91919-1919', 'Rua do Mato, 99', '2022-11-01', 'CPF', '131.313.313-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ingredientes`
--

CREATE TABLE `ingredientes` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ingredientes`
--

INSERT INTO `ingredientes` (`id`, `produto`, `nome`, `ativo`) VALUES
(1, 4, 'Tomate', 'Sim'),
(6, 4, 'Azeitona', 'Não'),
(7, 4, 'Cebola', 'Sim'),
(8, 3, 'Limão', 'Sim'),
(9, 3, 'Uva', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `niveis`
--

CREATE TABLE `niveis` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `niveis`
--

INSERT INTO `niveis` (`id`, `nome`) VALUES
(5, 'Administrador'),
(6, 'Cliente'),
(7, 'Funcionário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagar`
--

CREATE TABLE `pagar` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `tipo` varchar(30) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_baixa` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `fornecedor` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pagar`
--

INSERT INTO `pagar` (`id`, `descricao`, `tipo`, `valor`, `data_lanc`, `data_venc`, `data_pgto`, `usuario_lanc`, `usuario_baixa`, `foto`, `fornecedor`, `pago`, `produto`, `quantidade`, `funcionario`, `cliente`) VALUES
(5, 'Conta de Luz', 'Conta', '120.00', '2022-11-03', '2022-11-03', '2022-11-05', 1, 1, '03-11-2022-14-41-58-banner-teste.jpg', 0, 'Sim', 0, 0, 0, 0),
(6, 'dadada', 'Conta', '31.00', '2022-11-03', '2022-11-03', '2022-11-02', 1, 1, 'sem-foto.jpg', 0, 'Sim', 0, 0, 0, 0),
(9, 'Compra - (22) Coca Cola Lata 350ml', 'Compra', '23.00', '2022-11-03', '2022-11-03', '2022-11-03', 1, 1, 'sem-foto.jpg', 2, 'Sim', 3, 22, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(1000) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `valor_compra` decimal(8,2) NOT NULL,
  `valor_venda` decimal(8,2) NOT NULL,
  `estoque` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nivel_estoque` int(11) NOT NULL,
  `tem_estoque` varchar(5) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `descricao`, `categoria`, `valor_compra`, `valor_venda`, `estoque`, `foto`, `nivel_estoque`, `tem_estoque`, `ativo`, `url`) VALUES
(2, 'Produto Novo 01', 'Piriri', 1, '40.00', '80.00', 1, '27-10-2022-02-01-57-curso-de-php.jpg', 10, 'Sim', 'Sim', 'produto-novo-01'),
(3, 'Coca Cola Lata 350ml', '', 3, '1.05', '5.00', 145, '27-10-2022-15-20-02-coca-cola-lata.jpeg', 10, 'Sim', 'Sim', 'coca-cola-lata-350ml'),
(4, 'Pizza de Calabresa', '', 1, '10.00', '20.00', 30, 'calabresa.jpg', 10, 'Sim', 'Sim', 'pizza-de-calabresa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `receber`
--

CREATE TABLE `receber` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `tipo` varchar(30) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_baixa` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `funcionario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `receber`
--

INSERT INTO `receber` (`id`, `descricao`, `tipo`, `valor`, `data_lanc`, `data_venc`, `data_pgto`, `usuario_lanc`, `usuario_baixa`, `foto`, `pago`, `produto`, `quantidade`, `funcionario`, `cliente`) VALUES
(4, 'Conta do Marcos', 'Conta', '110.00', '2022-11-03', '2022-11-03', '2022-11-03', 1, 1, '03-11-2022-16-35-15-curso-de-aplicativo-de-tarefas-com-react.jpeg', 'Sim', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(100) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `saidas`
--

INSERT INTO `saidas` (`id`, `produto`, `quantidade`, `motivo`, `usuario`, `data`) VALUES
(1, 3, 1, 'Roubaram', 1, '2022-10-27'),
(2, 3, 1, 'Perdi', 1, '2022-10-27'),
(3, 3, 2, 'Dei', 1, '2022-10-27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `sessao` varchar(35) NOT NULL,
  `tabela` varchar(25) NOT NULL,
  `id_item` int(11) NOT NULL,
  `id_variacao` int(11) DEFAULT NULL,
  `carrinho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `temp`
--

INSERT INTO `temp` (`id`, `sessao`, `tabela`, `id_item`, `id_variacao`, `carrinho`) VALUES
(67, '2022-11-17-16:54:27-2794', 'adicionais', 10, 14, 0),
(68, '2022-11-17-16:54:27-2794', 'adicionais', 9, 13, 0),
(69, '2022-11-18-17:06:31-318', 'ingredientes', 1, 14, 0),
(70, '2022-11-18-17:06:31-318', 'ingredientes', 7, 13, 0),
(71, '2022-11-19-10:23:11-2198', 'adicionais', 9, 14, 0),
(72, '2022-11-19-10:23:11-2198', 'adicionais', 10, 14, 0),
(73, '2022-11-19-10:23:11-2198', 'ingredientes', 1, 14, 0),
(75, '2022-11-19-10:23:11-2198', 'adicionais', 7, 13, 0),
(76, '2022-11-19-10:23:11-2198', 'ingredientes', 7, 13, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `senha` varchar(35) NOT NULL,
  `senha_crip` varchar(100) NOT NULL,
  `nivel` varchar(30) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `data` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tipo_chave` varchar(35) DEFAULT NULL,
  `chave_pix` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `senha`, `senha_crip`, `nivel`, `ativo`, `data`, `foto`, `telefone`, `tipo_chave`, `chave_pix`) VALUES
(1, 'Administrador 2', 'danielantunespaiva@gmail.com', '000.000.000-00', '123', '202cb962ac59075b964b07152d234b70', 'Administrador', 'Sim', '2022-10-17', '26-10-2022-01-25-29-04.jpg', '(15) 99180-5895', NULL, NULL),
(8, 'João da Silva', 'joao@hotmail.com', '000.000.000-2', '123', '202cb962ac59075b964b07152d234b70', 'Cliente', 'Sim', '2022-10-26', '26-10-2022-09-53-03-gordolio.jpg', '(10) 10101-0101', NULL, NULL),
(11, 'Marcos Teste de Func', 'marcosfunc@hotmail.com', '314.343.435-35', '123', '202cb962ac59075b964b07152d234b70', 'Funcionário', 'Sim', '2022-11-01', '01-11-2022-16-53-25-mendigo-fudido.jpg', '(15) 99180-5891', 'Email', 'marcosfunc@hotmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `variacoes`
--

CREATE TABLE `variacoes` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `sigla` varchar(5) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `variacoes`
--

INSERT INTO `variacoes` (`id`, `produto`, `sigla`, `nome`, `descricao`, `valor`, `ativo`) VALUES
(8, 3, 'M', 'Média', 'Item médio', '32.00', 'Sim'),
(11, 3, 'G', 'Grande', 'Grandão', '51.00', 'Sim'),
(12, 4, 'P', 'Pequena', '4 Fatisaa', '20.00', 'Sim'),
(13, 4, 'M', 'Média', '6 Fatias', '25.00', 'Sim'),
(14, 4, 'G', 'Grande', '8 Fatias', '30.00', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `total_pago` decimal(8,2) NOT NULL,
  `troco` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `status` varchar(25) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `obs` varchar(100) DEFAULT NULL,
  `taxa_entrega` decimal(8,2) NOT NULL,
  `tipo_pgto` varchar(25) NOT NULL,
  `usuario_baixa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id`, `cliente`, `valor`, `total_pago`, `troco`, `data`, `hora`, `status`, `pago`, `obs`, `taxa_entrega`, `tipo_pgto`, `usuario_baixa`) VALUES
(1, 2, '65.00', '70.00', '5.00', '2022-11-03', '12:00:00', 'Cancelado', 'Sim', 'Apertar interfone ao chegar.', '5.00', 'dinheiro', 0),
(2, 2, '35.00', '40.00', '5.00', '2022-11-03', '20:58:35', 'Finalizado', 'Sim', '', '3.00', 'cartão de crédito', 1),
(3, 2, '30.00', '90.00', '0.00', '2022-11-11', '21:14:33', 'Iniciado', 'Não', NULL, '4.00', 'pix', 1),
(4, 2, '45.00', '50.00', '5.00', '2022-11-11', '19:54:21', 'Entrega', 'Não', 'teste', '5.00', 'dinheiro', 1),
(5, 2, '13.00', '14.00', '1.00', '2022-11-11', '00:41:17', 'Iniciado', 'Não', NULL, '0.00', '', 0),
(6, 2, '42.00', '0.00', '0.00', '2022-11-11', '19:54:21', 'Iniciado', 'Não', NULL, '0.00', '', 0),
(7, 2, '13.00', '50.00', '0.00', '2022-11-11', '19:54:21', 'Iniciado', 'Não', NULL, '0.00', '', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adicionais`
--
ALTER TABLE `adicionais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `bairros`
--
ALTER TABLE `bairros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `niveis`
--
ALTER TABLE `niveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receber`
--
ALTER TABLE `receber`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `variacoes`
--
ALTER TABLE `variacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adicionais`
--
ALTER TABLE `adicionais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `bairros`
--
ALTER TABLE `bairros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `ingredientes`
--
ALTER TABLE `ingredientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `niveis`
--
ALTER TABLE `niveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pagar`
--
ALTER TABLE `pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `receber`
--
ALTER TABLE `receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `variacoes`
--
ALTER TABLE `variacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
