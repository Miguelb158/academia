-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Fev-2025 às 12:55
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `aluno_cod` int(50) NOT NULL,
  `aluno_nome` varchar(100) NOT NULL,
  `aluno_cpf` int(50) NOT NULL,
  `aluno_endereco` varchar(150) NOT NULL,
  `aluno_telefone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`aluno_cod`, `aluno_nome`, `aluno_cpf`, `aluno_endereco`, `aluno_telefone`) VALUES
(1, 'joge', 1, 'sei la', '1111'),
(2, 'beatriz leite pedroso', 45134615, 'rua dos abacates', '12345564'),
(3, 'João da Silva', 2147483647, 'Rua A, 123', '1234-5678'),
(4, 'Maria Oliveira', 2147483647, 'Rua B, 456', '2345-6789'),
(5, 'Pedro Santos', 2147483647, 'Rua C, 789', '3456-7890'),
(6, 'Ana Costa', 2147483647, 'Rua D, 101', '4567-8901'),
(7, 'Carlos Lima', 2147483647, 'Rua E, 202', '5678-9012'),
(8, 'Fernanda Rocha', 2147483647, 'Rua F, 303', '6789-0123'),
(9, 'Rafael Souza', 2147483647, 'Rua G, 404', '7890-1234'),
(10, 'Juliana Martins', 2147483647, '\' OR \'1\'=\'1\' -- ', '8901-2345');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aula`
--

CREATE TABLE `aula` (
  `aula_cod` int(11) NOT NULL,
  `aula_tipo` varchar(50) NOT NULL,
  `aula_data` date NOT NULL,
  `fk_instrutor_cod` int(11) NOT NULL,
  `fk_aluno_cod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aula`
--

INSERT INTO `aula` (`aula_cod`, `aula_tipo`, `aula_data`, `fk_instrutor_cod`, `fk_aluno_cod`) VALUES
(2, 'musculação', '2025-01-24', 2, 2),
(3, 'Crossfit', '2025-01-31', 3, 1),
(4, 'aeróbico', '2025-01-27', 4, 1),
(5, 'judo', '2025-02-20', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `instrutor`
--

CREATE TABLE `instrutor` (
  `instrutor_cod` int(11) NOT NULL,
  `instrutor_nome` varchar(100) NOT NULL,
  `instrutor_especialidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `instrutor`
--

INSERT INTO `instrutor` (`instrutor_cod`, `instrutor_nome`, `instrutor_especialidade`) VALUES
(1, 'ana', 'pilates'),
(2, 'jorge', 'judo'),
(3, 'julia', 'pilates'),
(4, 'lin', 'corrida'),
(5, 'Luís', 'Musculção'),
(6, 'Wesley', 'Aeróbico'),
(7, 'Joana', 'Crossfit'),
(8, 'Kellen', 'Musculção'),
(9, 'Lucia', 'yoga'),
(10, 'Gabriel', 'Crossfit'),
(11, 'Fernanda', 'Aeróbico'),
(12, 'Jamile', 'yoga');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`aluno_cod`);

--
-- Índices para tabela `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`aula_cod`),
  ADD KEY `fk_instrutor_cod` (`fk_instrutor_cod`),
  ADD KEY `fk_aluno_cod` (`fk_aluno_cod`);

--
-- Índices para tabela `instrutor`
--
ALTER TABLE `instrutor`
  ADD PRIMARY KEY (`instrutor_cod`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `aluno_cod` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `aula`
--
ALTER TABLE `aula`
  MODIFY `aula_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `instrutor`
--
ALTER TABLE `instrutor`
  MODIFY `instrutor_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`fk_instrutor_cod`) REFERENCES `instrutor` (`instrutor_cod`),
  ADD CONSTRAINT `aula_ibfk_2` FOREIGN KEY (`fk_aluno_cod`) REFERENCES `aluno` (`aluno_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
