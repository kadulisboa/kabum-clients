-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 12-Abr-2021 às 19:44
-- Versão do servidor: 8.0.23-0ubuntu0.20.04.1
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `kabum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `authorization_tokens`
--

CREATE TABLE `authorization_tokens` (
  `id` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `id` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `birthday` date NOT NULL,
  `cpf` varchar(14) COLLATE utf8mb4_bin NOT NULL,
  `rg` varchar(12) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(16) COLLATE utf8mb4_bin NOT NULL,
  `address` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`id`, `name`, `birthday`, `cpf`, `rg`, `phone`, `address`) VALUES
('0252c13f-9bc7-11eb-85f0-080027df74b8', 'Cliente 1', '2001-01-26', '304.942.478-00', '20.169.402-X', '(11) 92284-7212', '{\"address1\": {\"uf\": \"SP\", \"city\": \"Itu\", \"number\": \"345\", \"street\": \"Rua Olga Hollanda\"}, \"address2\": {\"uf\": \"SP\", \"city\": \"Sorocaba\", \"number\": \"22\", \"street\": \"Rua Olivio Milani\"}}');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` text COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
('1e047fdb-9bc6-11eb-85f0-080027df74b8', 'Kadu Lisboa', 'contato@kadulisboa.com.br', '$2y$10$xv2ElQemzji2JKXXRBAdiOJ0yIWbkFPH32NBLzcwnyOJKhDk94Yb2');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `authorization_tokens`
--
ALTER TABLE `authorization_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
