-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 19-Jul-2025 às 15:30
-- Versão do servidor: 8.0.30
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bunco`
--
CREATE DATABASE IF NOT EXISTS `bunco` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bunco`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `licoes`
--

CREATE TABLE `licoes` (
  `id` int NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `tipo` enum('teoria','exercicio') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `progresso`
--

CREATE TABLE `progresso` (
  `id` int NOT NULL,
  `usuario` int NOT NULL,
  `licao` int NOT NULL,
  `data` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `usuario` int NOT NULL,
  `vidas` int NOT NULL DEFAULT '5',
  `ofensiva` int NOT NULL DEFAULT '0',
  `xp` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`id`, `usuario`, `vidas`, `ofensiva`, `xp`) VALUES
(1, 2, 5, 0, 0),
(2, 3, 5, 0, 0),
(4, 5, 5, 0, 0),
(6, 7, 5, 0, 0),
(7, 8, 5, 0, 0),
(9, 10, 5, 0, 0),
(12, 13, 5, 0, 0),
(13, 14, 5, 0, 0),
(14, 15, 5, 0, 0),
(15, 16, 5, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'buncodefault',
  `cor` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'FFFFFF',
  `link_github` varchar(255) DEFAULT NULL,
  `link_instagram` varchar(255) DEFAULT NULL,
  `link_linkedin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `nome`, `email`, `senha`, `foto`, `cor`, `link_github`, `link_instagram`, `link_linkedin`, `created_at`) VALUES
(2, 'jp_p3dro', 'João Pedro', 'joao@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', '000000', NULL, NULL, NULL, '2025-05-20 18:38:43'),
(3, 'antonio_rogerio', 'Antonio Rogerio', 'antonio@gmail.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-05-21 22:03:44'),
(5, 'administrador', 'Administrador', 'administrador@gmail.com', '7580adf5151c6b79c90597aeab91838f', 'buncofazendeiro', 'bbf2ff', 'https://github.com/BuncoTCC', 'https://www.instagram.com/joaopedrodallessio', 'https://www.linkedin.com/in/joão-pedro-dallessio-de-barros/', '2025-05-24 19:01:58'),
(7, 'cachinhos', 'Cachinhos', 'cachinhos@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncoandroid', 'F8F9FA', NULL, NULL, NULL, '2025-06-13 15:27:56'),
(8, 'web01', 'Teste Web', 'web@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-06-14 17:01:15'),
(10, 'ricardo1234', 'Ricardo', 'ricardo@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-06-16 18:28:27'),
(13, 'oi123', 'Oiii', 'oi@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-06-16 22:52:50'),
(14, 'socorro1', 'Socorro', 'socorro@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-06-16 22:53:50'),
(15, 'bunco2778', 'Bunco', 'bunco@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-06-16 23:14:22'),
(16, 'design01', 'Design', 'design@email.com', '7580adf5151c6b79c90597aeab91838f', 'buncodefault', 'FFFFFF', NULL, NULL, NULL, '2025-06-24 19:07:01');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `licoes`
--
ALTER TABLE `licoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `progresso`
--
ALTER TABLE `progresso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `licao` (`licao`),
  ADD KEY `progresso_ibfk_1` (`usuario`);

--
-- Índices para tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_ibfk_1` (`usuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `licoes`
--
ALTER TABLE `licoes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `progresso`
--
ALTER TABLE `progresso`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `progresso`
--
ALTER TABLE `progresso`
  ADD CONSTRAINT `progresso_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `progresso_ibfk_2` FOREIGN KEY (`licao`) REFERENCES `licoes` (`id`);

--
-- Limitadores para a tabela `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
