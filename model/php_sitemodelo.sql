-- phpMyAdmin SQL Dump
-- version 4.0.4.2
-- http://www.phpmyadmin.net
--
-- Máquina: localhost
-- Data de Criação: 27-Nov-2019 às 17:28
-- Versão do servidor: 5.6.13
-- versão do PHP: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` decimal(12,2) NOT NULL,
  `quant` int(11) NOT NULL,
  `foto1` varchar(100) NOT NULL,
  `foto2` varchar(100) NOT NULL,
  `foto3` varchar(100) NOT NULL,
  `foto4` varchar(100) NOT NULL,
  `foto5` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `valor`, `quant`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`) VALUES
(1, 'Downward', 'Jogo medieval', '0.00', 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id-tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome-tipo` varchar(100) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id-tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`id-tipo`, `nome-tipo`, `nivel`) VALUES
(1, 'comum', 0),
(2, 'admin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(50) DEFAULT NULL,
  `id-tipo` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  KEY `id-tipo` (`id-tipo`),
  KEY `id-tipo_2` (`id-tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`uid`, `nome`, `nickname`, `email`, `senha`, `id-tipo`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', '111111', 2),
(2, 'Ana Maria', 'anaM', 'ana@ana.com.br', '111111', 1),
(3, 'Pedro', 'pp2', 'pedro@email.com', '111111', 1),
(4, 'Mario', 'marinho', 'mario@email.com', '111111', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE IF NOT EXISTS `venda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uid_usuario` int(11) NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `aberto` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid_usuario` (`uid_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda_produto`
--

CREATE TABLE IF NOT EXISTS `venda_produto` (
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quant` int(11) NOT NULL,
  `valor_produto` decimal(12,2) NOT NULL,
  `valor_total` decimal(12,2) NOT NULL,
  KEY `id_venda` (`id_venda`,`id_produto`),
  KEY `id_produto` (`id_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id-tipo`) REFERENCES `tipo` (`id-tipo`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`uid_usuario`) REFERENCES `usuario` (`uid`);

--
-- Limitadores para a tabela `venda_produto`
--
ALTER TABLE `venda_produto`
  ADD CONSTRAINT `venda_produto_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
  ADD CONSTRAINT `venda_produto_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`);


