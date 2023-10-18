-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/10/2023 às 09:25
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `dataNasc` date NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `dataNasc`, `CPF`, `status`) VALUES
(1, 'Augusto Fernandes', '2000-08-10', '210.298.293-09', 'ativo'),
(2, 'Maria Silva Oliveira', '1999-03-21', '210.298.293-09', 'ativo'),
(3, 'Alfonse Smikchuz', '2002-10-02', '210.298.293-09', 'ativo'),
(4, 'Nagela Perreira', '1997-05-16', '210.298.293-09', 'ativo'),
(5, 'Gustavo Hernanes', '2001-07-10', '210.298.293-09', 'ativo'),
(6, 'João Paulo Ferreira', '1995-06-26', '210.298.293-09', 'inativo'),
(7, 'Julio Costa Martins', '1980-11-23', '210.298.293-09', 'ativo'),
(8, 'Helena Marques', '2000-01-11', '210.298.293-09', 'ativo'),
(9, 'Zira Silva', '2003-02-14', '210.298.293-09', 'ativo'),
(10, 'João Bicalho', '1993-03-12', '210.298.293-09', 'inativo'),
(11, 'Paulina Araujo', '2002-08-10', '210.298.293-09', 'ativo'),
(12, 'Carolina Rosa Silva', '2001-12-24', '210.298.293-09', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `procedimentos`
--

CREATE TABLE `procedimentos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(80) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `procedimentos`
--

INSERT INTO `procedimentos` (`id`, `descricao`, `tipo_id`, `status`) VALUES
(1, 'Consulta Pediátrica ', 1, 'ativo'),
(2, 'Consulta Clínico Geral', 1, 'ativo'),
(3, 'Hemograma', 2, 'ativo'),
(4, 'Glicemia', 2, 'ativo'),
(5, 'Colesterol', 2, 'ativo'),
(6, 'Triglicerídeos', 2, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissional`
--

CREATE TABLE `profissional` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `profissional`
--

INSERT INTO `profissional` (`id`, `nome`, `status`) VALUES
(1, 'Orlando Nobrega', 'ativo'),
(2, 'Rafaela Tenorio', 'ativo'),
(3, 'João Paulo Nobrega', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissionalatende`
--

CREATE TABLE `profissionalatende` (
  `id` int(11) NOT NULL,
  `procedimento_id` int(11) NOT NULL,
  `profissional_id` int(11) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `profissionalatende`
--

INSERT INTO `profissionalatende` (`id`, `procedimento_id`, `profissional_id`, `status`) VALUES
(1, 1, 2, 'ativo'),
(2, 2, 2, 'ativo'),
(3, 2, 3, 'ativo'),
(4, 1, 3, 'inativo'),
(5, 3, 1, 'ativo'),
(6, 4, 1, 'ativo'),
(7, 5, 1, 'ativo'),
(8, 6, 1, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `solicitacao`
--

CREATE TABLE `solicitacao` (
  `id` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `id_profissional` int(11) NOT NULL,
  `id_procedimento` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `solicitacao`
--

INSERT INTO `solicitacao` (`id`, `id_paciente`, `id_profissional`, `id_procedimento`, `data`, `hora`) VALUES
(157, 2, 1, 3, '2023-10-18', '02:37:00'),
(158, 2, 1, 4, '2023-10-18', '02:37:00'),
(159, 1, 2, 2, '2023-10-18', '03:25:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tiposolicitacao`
--

CREATE TABLE `tiposolicitacao` (
  `id` int(11) NOT NULL,
  `descricao` varchar(40) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tiposolicitacao`
--

INSERT INTO `tiposolicitacao` (`id`, `descricao`, `status`) VALUES
(1, 'Consulta', 'ativo'),
(2, 'Exames Laboratoriais', 'ativo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Índices de tabela `profissional`
--
ALTER TABLE `profissional`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `profissionalatende`
--
ALTER TABLE `profissionalatende`
  ADD PRIMARY KEY (`id`),
  ADD KEY `procedimento_id` (`procedimento_id`,`profissional_id`),
  ADD KEY `profissional_id` (`profissional_id`);

--
-- Índices de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paciente` (`id_paciente`,`id_profissional`,`id_procedimento`),
  ADD KEY `id_profissional` (`id_profissional`),
  ADD KEY `id_procedimento` (`id_procedimento`);

--
-- Índices de tabela `tiposolicitacao`
--
ALTER TABLE `tiposolicitacao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `procedimentos`
--
ALTER TABLE `procedimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `profissional`
--
ALTER TABLE `profissional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `profissionalatende`
--
ALTER TABLE `profissionalatende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `solicitacao`
--
ALTER TABLE `solicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de tabela `tiposolicitacao`
--
ALTER TABLE `tiposolicitacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `procedimentos`
--
ALTER TABLE `procedimentos`
  ADD CONSTRAINT `procedimentos_ibfk_1` FOREIGN KEY (`tipo_id`) REFERENCES `tiposolicitacao` (`id`),
  ADD CONSTRAINT `procedimentos_ibfk_2` FOREIGN KEY (`id`) REFERENCES `profissionalatende` (`procedimento_id`);

--
-- Restrições para tabelas `profissionalatende`
--
ALTER TABLE `profissionalatende`
  ADD CONSTRAINT `profissionalatende_ibfk_1` FOREIGN KEY (`procedimento_id`) REFERENCES `procedimentos` (`id`),
  ADD CONSTRAINT `profissionalatende_ibfk_2` FOREIGN KEY (`profissional_id`) REFERENCES `profissional` (`id`);

--
-- Restrições para tabelas `solicitacao`
--
ALTER TABLE `solicitacao`
  ADD CONSTRAINT `solicitacao_ibfk_1` FOREIGN KEY (`id_profissional`) REFERENCES `profissional` (`id`),
  ADD CONSTRAINT `solicitacao_ibfk_2` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id`),
  ADD CONSTRAINT `solicitacao_ibfk_3` FOREIGN KEY (`id_procedimento`) REFERENCES `procedimentos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
