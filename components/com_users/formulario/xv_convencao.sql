CREATE DATABASE IF NOT EXISTS `lionsdla6` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lionsdla6`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jom1__user_reset_senha`
--
DROP TABLE IF EXISTS jom1__user_reset_senha;
CREATE TABLE IF NOT EXISTS `jom1__user_reset_senha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` varchar(32) NOT NULL,
  `usado`CHAR(1) NOT NULL DEFAULT '0',
  `data_usado` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `__usuario`
--
DROP TABLE IF EXISTS __usuario;
CREATE TABLE IF NOT EXISTS `__usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `matricula` varchar(11) DEFAULT NULL,
  `nascimento` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `estado` varchar(10) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `clube` varchar(100) NOT NULL,
  `delegado` varchar(10) DEFAULT NULL,
  `cargo_clube` varchar(20) DEFAULT NULL,
  `qual_cc` varchar(30) DEFAULT NULL,
  `cargo_distrito` varchar(20) DEFAULT NULL,
  `qual_cd` varchar(30) DEFAULT NULL,
  `cl_mj` varchar(10) NOT NULL,
  `prefixo` varchar(10) NOT NULL,
  `camisa` varchar(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `__comprovante`
--
DROP TABLE IF EXISTS __comprovante;
CREATE TABLE IF NOT EXISTS `__comprovante` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `md5` varchar(32) NOT NULL,
  `local` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `__inscricao_convencao`
--
DROP TABLE IF EXISTS __inscricao_convencao;
CREATE TABLE IF NOT EXISTS `__inscricao_convencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `convencao_id` int(11) NOT NULL,
  `pago` CHAR(1) NOT NULL DEFAULT '0',
  `comprovante` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`,`convencao_id`),
  KEY `convencao_id` (`convencao_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `__convencao`
--
DROP TABLE IF EXISTS __convencao;
CREATE TABLE IF NOT EXISTS `__convencao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `aberta` CHAR(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT  INTO `__convencao`(`id`,`titulo`,`aberta`) VALUES (1,'XVI Convenção','1');


--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `__inscricao_convencao`
--
ALTER TABLE `__inscricao_convencao`
  ADD CONSTRAINT `convercao_id_fk` FOREIGN KEY (`convencao_id`) REFERENCES `__convencao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_id_fk` FOREIGN KEY (`usuario_id`) REFERENCES `__usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
