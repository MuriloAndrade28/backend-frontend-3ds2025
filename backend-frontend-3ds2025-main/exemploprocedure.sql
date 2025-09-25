-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 29-Jul-2025 às 13:21
-- Versão do servidor: 5.7.36
-- versão do PHP: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `exemploprocedure`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `crud_estado` (IN `var_id` INT, `var_uf` CHAR(2), `var_nome` VARCHAR(50), `opcao` INT)   BEGIN
	IF(EXISTS(SELECT est_id FROM tb_estado WHERE est_id = var_id)) THEN
    	IF(opcao = 1) THEN
        	UPDATE tb_estado SET est_nome = var_nome, est_uf = var_uf WHERE est_id = var_id;
        ELSE
        	DELETE FROM tb_estado WHERE est_id = var_id;
        END IF;
    ELSE
    	INSERT INTO tb_estado VALUES (var_id, var_uf, var_nome);
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_estado` (IN `var_id` INT)   BEGIN
	IF(var_id IS NULL) THEN
    	SELECT * FROM tb_estado ORDER by est_nome;
    ELSE
    	SELECT * FROM tb_estado WHERE est_id = var_id;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estado`
--

CREATE TABLE `tb_estado` (
  `est_id` int(11) NOT NULL,
  `est_uf` char(2) DEFAULT NULL,
  `est_nome` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_estado`
--

INSERT INTO `tb_estado` (`est_id`, `est_uf`, `est_nome`) VALUES
(1, 'SP', 'São Paulo'),
(2, 'SP', 'SÃƒO PAULO'),
(3, 'RJ', 'RIO DE JANEIRO'),
(4, 'MG', 'MINAS GERAIS'),
(5, 'TS', 'TESTE'),
(6, 'TS', 'TESTE');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  ADD PRIMARY KEY (`est_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_estado`
--
ALTER TABLE `tb_estado`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
