-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/04/2025 às 20:56
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `igreja_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `conteudo` text DEFAULT NULL,
  `imagem_url` varchar(255) DEFAULT NULL,
  `data_postagem` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `blog`
--

INSERT INTO `blog` (`id`, `titulo`, `conteudo`, `imagem_url`, `data_postagem`) VALUES
(2, 'Aniversário da igreja', 'The standard Lorem Ipsum passage, used since the 1500s\r\n\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"\r\n\r\nSection 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC\r\n\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', 'uploads/68055633499e0_Gemini_Generated_Image_6dj2me6dj2me6dj2.jpeg', '2025-04-20 17:16:51'),
(8, NULL, NULL, '', '2025-04-21 19:33:02'),
(9, NULL, NULL, '', '2025-04-21 20:28:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sobrenome` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `casa` varchar(20) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `idade` int(11) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `members`
--

INSERT INTO `members` (`id`, `user_id`, `nome`, `sobrenome`, `bairro`, `rua`, `numero`, `casa`, `cep`, `idade`, `sexo`) VALUES
(1, 1, 'joão', 'perereiras antunes', 'vila caro', 'ipes amarelos', '564', 'sim', '1487754', 42, 'Masculino'),
(2, 4, 'Marcos', 'Oliveira Silvless', 'v. Hortencia', 'vara cruz', '123', 'apartamento', '145789', 65, 'Masculino');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `data_pagamento` datetime DEFAULT current_timestamp(),
  `comprovante_url` varchar(255) DEFAULT NULL,
  `status` enum('feito','nao_feito') DEFAULT 'feito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamentos`
--

INSERT INTO `pagamentos` (`id`, `user_id`, `data_pagamento`, `comprovante_url`, `status`) VALUES
(1, 1, '2025-04-20 18:10:13', 'uploads/680562b534887_dgfghg.png', 'feito'),
(2, 1, '2025-04-21 19:32:05', 'uploads/6806c7652a237_agssjja.png', 'feito');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pix_eventos`
--

CREATE TABLE `pix_eventos` (
  `id` int(11) NOT NULL,
  `nome_evento` varchar(255) NOT NULL,
  `imagem_pix` varchar(255) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pix_eventos`
--

INSERT INTO `pix_eventos` (`id`, `nome_evento`, `imagem_pix`, `data_criacao`) VALUES
(4, 'festa do pastel', 'uploads/pix_1745272618_codqr.jpg', '2025-04-21 21:56:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','usuario') DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `email`, `senha`, `tipo`) VALUES
(1, 'ashd@hfjf.com', '$2y$10$nlyh4KMfnF3QerbZNfpC.epkxMpn0Dwhm/Eg5NEfhnf3/80ou79Su', 'usuario'),
(3, 'admin@igreja.com', '$2y$10$vDPF4MOrCojbrERuUQbmm.zOmBjBZAoeyWR8NVZvLr948WLkm2yLm', 'admin'),
(4, 'hdgsfkkk@kyyy.com', '$2y$10$2nNEDpVJr7/8i4BbcSn67.bxBwaX4shC.7UwYdT.doNCjnZl46JQW', 'usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `pix_eventos`
--
ALTER TABLE `pix_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pix_eventos`
--
ALTER TABLE `pix_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
