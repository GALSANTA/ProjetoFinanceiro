-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jan-2019 às 05:52
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projeto_financeiro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_background`
--

CREATE TABLE IF NOT EXISTS `tb_background` (
  `img_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `img_nome` varchar(50) NOT NULL,
  `img_local` varchar(50) NOT NULL,
  PRIMARY KEY (`img_id`),
  UNIQUE KEY `img_id` (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `tb_background`
--

INSERT INTO `tb_background` (`img_id`, `user_id`, `img_nome`, `img_local`) VALUES
(21, 2, 'IMG_20180125_124919583_HDR.jpg', 'imagem_background/'),
(25, 1, 'IMG_20171224_140739540_HDR.jpg', 'imagem_background/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contas`
--

CREATE TABLE IF NOT EXISTS `tb_contas` (
  `con_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `con_nome` varchar(50) NOT NULL,
  `con_agencia` varchar(50) DEFAULT NULL,
  `con_corrente` varchar(50) DEFAULT NULL,
  `con_titular` varchar(50) NOT NULL,
  `con_saldo` float NOT NULL,
  PRIMARY KEY (`con_id`),
  UNIQUE KEY `con_id` (`con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `tb_contas`
--

INSERT INTO `tb_contas` (`con_id`, `user_id`, `con_nome`, `con_agencia`, `con_corrente`, `con_titular`, `con_saldo`) VALUES
(12, 1, 'Bradesco', '1234-5', '10.123-5', 'Fernando', 500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imagem`
--

CREATE TABLE IF NOT EXISTS `tb_imagem` (
  `img_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `img_nome` varchar(50) NOT NULL,
  `img_local` varchar(50) NOT NULL,
  PRIMARY KEY (`img_id`),
  UNIQUE KEY `img_id` (`img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `tb_imagem`
--

INSERT INTO `tb_imagem` (`img_id`, `user_id`, `img_nome`, `img_local`) VALUES
(21, 2, 'IMG_20180126_100650617_HDR.jpg', 'imagem_usuarios/'),
(26, 1, 'WhatsApp Image 2018-05-12 at 16.26.26.jpeg', 'imagem_usuarios/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_transacoes`
--

CREATE TABLE IF NOT EXISTS `tb_transacoes` (
  `tran_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `con_id` int(11) NOT NULL,
  `tran_tipo` tinyint(4) NOT NULL,
  `tran_valor` varchar(50) NOT NULL,
  `tran_data` date NOT NULL,
  `tran_desc` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`tran_id`),
  UNIQUE KEY `tran_id` (`tran_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `tb_transacoes`
--

INSERT INTO `tb_transacoes` (`tran_id`, `con_id`, `tran_tipo`, `tran_valor`, `tran_data`, `tran_desc`, `user_id`) VALUES
(22, 12, 1, '300', '2019-01-13', 'eu', 1),
(23, 12, 1, '300', '2019-01-13', 'carteira', 1),
(24, 12, 0, '200', '2019-01-13', 'banco x', 1),
(26, 12, 0, '200', '2019-01-13', 'banco y', 1),
(27, 12, 1, '300', '2019-01-13', 'eu', 1),
(28, 12, 1, '300', '2019-01-14', 'banco f', 1),
(29, 12, 0, '300', '2019-01-14', 'banco x', 1),
(31, 12, 0, '300', '2019-01-15', 'banco X', 1),
(32, 12, 0, '200', '2019-01-17', 'faxineira', 1),
(33, 12, 1, '500', '2019-01-18', 'mesada', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_nome` varchar(50) NOT NULL,
  `user_sobrenome` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_senha` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`user_id`, `user_nome`, `user_sobrenome`, `user_email`, `user_senha`) VALUES
(1, 'Fernando', 'Marques', 'teste@teste', 'teste'),
(2, 'Pablo', 'Lisboa', 'bito@bito', 'bito'),
(8, 'Ruan', 'Lisboa', 'ruan@ruan', 'ruan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
