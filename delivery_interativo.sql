-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Out-2022 às 05:06
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

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
  `logo_rel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`id`, `nome_sistema`, `email_sistema`, `telefone_sistema`, `telefone_fixo`, `endereco_sistema`, `instagram_sistema`, `tipo_rel`, `tipo_miniatura`, `status_whatsapp`, `previsao_entrega`, `horario_abertura`, `horario_fechamento`, `texto_fechamento_horario`, `status_estabelecimento`, `texto_fechamento_imprevisto`, `logo_sistema`, `favicon_sistema`, `logo_rel`) VALUES
(1, 'Delivery Interativo', 'danielantunespaiva@gmail.com', '(15) 99180-5895', '(15) 3031-4024', 'Alameda do Capiroto,  número 666, Bairro de Satã, Cidade do Caos', 'instagram.com/rapidin', 'PDF', 'Foto', 'Sim', 66, '18:30:00', '00:30:00', 'Texto para fechamento normal', 'Aberto', 'Texto para fechamento imprevisto', '17-10-2022-18-37-05-logo.png', 'favicon.png', 'logo_rel.jpg');

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
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `senha`, `senha_crip`, `nivel`, `ativo`, `data`, `foto`, `telefone`) VALUES
(1, 'Administrador', 'danielantunespaiva@gmail.com', '000.000.000-00', '123', '202cb962ac59075b964b07152d234b70', 'Administrador', 'Sim', '2022-10-17', '17-10-2022-18-37-21-logo_rel.jpg', '(15) 99180-5895'),
(2, 'usuario', 'usuario@hotmail.com', '000.000.000-01', '123', '202cb962ac59075b964b07152d234b70', 'Cliente', 'Sim', '2022-10-17', '', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
