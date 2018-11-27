-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 27/11/2018 às 12:25
-- Versão do servidor: 5.7.21-0ubuntu0.16.04.1
-- Versão do PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `leitura`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacaolivro`
--

CREATE TABLE `avaliacaolivro` (
  `al_idavaliacaolivro` int(11) NOT NULL,
  `al_idlivro` int(11) DEFAULT NULL,
  `al_idusuario` int(11) DEFAULT NULL,
  `al_datahora` datetime DEFAULT NULL,
  `al_nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `avaliacaolivro`
--

INSERT INTO `avaliacaolivro` (`al_idavaliacaolivro`, `al_idlivro`, `al_idusuario`, `al_datahora`, `al_nota`) VALUES
(1, 59, 1, '2018-11-27 11:42:31', 3),
(2, 59, 1, '2018-11-27 11:51:09', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `biblioteca`
--

CREATE TABLE `biblioteca` (
  `bi_id` int(11) NOT NULL,
  `bi_idlivro` int(11) DEFAULT NULL,
  `bi_idprateleira` int(11) DEFAULT NULL,
  `bi_datainclusao` datetime DEFAULT NULL,
  `bi_observacao` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentario`
--

CREATE TABLE `comentario` (
  `cm_id` int(11) NOT NULL,
  `cm_texto` varchar(200) NOT NULL,
  `cm_data` date NOT NULL,
  `cm_curtidas` int(11) DEFAULT NULL,
  `cm_idusuario` int(11) NOT NULL,
  `cm_idlivro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `comentario`
--

INSERT INTO `comentario` (`cm_id`, `cm_texto`, `cm_data`, `cm_curtidas`, `cm_idusuario`, `cm_idlivro`) VALUES
(1, 'muito bom, curti', '2018-10-02', 2, 1, 0),
(4, 'ggggsd', '2018-10-03', 2, 1, 13),
(5, 'ggggsd', '2018-10-03', 2, 1, 56),
(6, 'kkklklk', '2018-10-03', 2, 1, 54),
(7, 'kkklklk', '2018-10-03', 2, 1, 54),
(8, 'aaaa', '2018-10-15', 0, 1, 56),
(9, 'sdasda', '2018-10-15', 0, 1, 54),
(10, 'a', '2018-10-20', 0, 1, 53),
(11, 'b', '2018-10-20', 0, 1, 53),
(12, 'c', '2018-10-20', 0, 1, 53);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fatores`
--

CREATE TABLE `fatores` (
  `fa_id` int(11) NOT NULL,
  `fa_descricao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='	';

--
-- Fazendo dump de dados para tabela `fatores`
--

INSERT INTO `fatores` (`fa_id`, `fa_descricao`) VALUES
(1, 'Tamanho do Livro'),
(2, 'Gêneros do Livro'),
(3, 'Avaliação dos usuarios'),
(4, 'Ano de Publicação'),
(5, 'Censura do Livro'),
(6, 'Livros em alta');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fatorlivro`
--

CREATE TABLE `fatorlivro` (
  `fl_id` int(11) NOT NULL,
  `fl_idfator` int(11) DEFAULT NULL,
  `fl_idlivro` int(11) DEFAULT NULL,
  `fl_idusuario` int(11) DEFAULT NULL,
  `fl_valor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `fatorlivro`
--

INSERT INTO `fatorlivro` (`fl_id`, `fl_idfator`, `fl_idlivro`, `fl_idusuario`, `fl_valor`) VALUES
(29, 1, 61, 1, 156),
(30, 1, 62, 1, 256),
(31, 1, 63, 1, 240),
(32, 1, 64, 1, 192),
(33, 1, 65, 1, 480),
(34, 1, 66, 1, 1104),
(35, 1, 67, 1, 288),
(36, 1, 68, 1, 224),
(37, 1, 69, 1, 226),
(38, 1, 70, 1, 400),
(39, 1, 71, 1, 320),
(40, 1, 72, 1, 210),
(41, 1, 73, 1, 398),
(42, 1, 74, 1, 464),
(43, 1, 75, 1, 328),
(44, 1, 76, 1, 272),
(45, 1, 77, 1, 304);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fatorusuario`
--

CREATE TABLE `fatorusuario` (
  `fu_id` int(11) NOT NULL,
  `fu_idfator` int(11) DEFAULT NULL,
  `fu_idusuario` int(11) DEFAULT NULL,
  `fu_nota` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `fatorusuario`
--

INSERT INTO `fatorusuario` (`fu_id`, `fu_idfator`, `fu_idusuario`, `fu_nota`) VALUES
(13, 1, 1, '100'),
(14, 2, 1, '2'),
(15, 3, 1, 'on'),
(16, 4, 1, '2012'),
(17, 5, 1, '18'),
(18, 6, 1, 'on');

-- --------------------------------------------------------

--
-- Estrutura para tabela `genero`
--

CREATE TABLE `genero` (
  `ge_id` int(11) NOT NULL,
  `ge_descricao` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `genero`
--

INSERT INTO `genero` (`ge_id`, `ge_descricao`) VALUES
(1, 'Ambito Religioso'),
(2, 'Ação'),
(3, 'Autobiografia'),
(5, 'Biografia'),
(6, 'Comédia'),
(7, 'Conto'),
(8, 'Crônica'),
(9, 'Drama'),
(10, 'Épico'),
(11, 'Fábula'),
(12, 'Fantasia'),
(13, 'Farsa'),
(14, 'Ficção'),
(15, 'Haicai'),
(16, 'Melodrama'),
(17, 'Novela'),
(18, 'Paródia'),
(19, 'Poesia'),
(20, 'Romance'),
(21, 'Sátira'),
(22, 'Soneto'),
(23, 'Suspense'),
(24, 'Terror'),
(25, 'Tragédia'),
(26, 'Tragicomédia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `generolivro`
--

CREATE TABLE `generolivro` (
  `gl_id` int(11) NOT NULL,
  `gl_idlivro` int(11) DEFAULT NULL,
  `gl_idgenero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `generolivro`
--

INSERT INTO `generolivro` (`gl_id`, `gl_idlivro`, `gl_idgenero`) VALUES
(48, 60, 3),
(49, 61, 12),
(50, 62, 20),
(51, 63, 20),
(52, 64, 7),
(53, 64, 8),
(54, 65, 20),
(55, 66, 14),
(56, 66, 23),
(57, 66, 24),
(58, 67, 1),
(59, 68, 12),
(60, 68, 14),
(61, 69, 23),
(62, 70, 14),
(63, 71, 20),
(64, 72, 14),
(65, 73, 14),
(66, 74, 9),
(67, 74, 14),
(68, 74, 20),
(69, 75, 14),
(70, 75, 20),
(71, 76, 10),
(72, 76, 14),
(73, 76, 20),
(74, 77, 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `img_id` int(11) NOT NULL,
  `arquivo` int(40) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livro`
--

CREATE TABLE `livro` (
  `li_idlivro` int(11) NOT NULL,
  `li_titulo` varchar(200) DEFAULT NULL,
  `li_ano` int(11) DEFAULT NULL,
  `li_autor` varchar(100) DEFAULT NULL,
  `li_paginas` int(11) DEFAULT NULL,
  `li_editora` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `li_censura` int(11) DEFAULT NULL,
  `li_idusuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `livro`
--

INSERT INTO `livro` (`li_idlivro`, `li_titulo`, `li_ano`, `li_autor`, `li_paginas`, `li_editora`, `li_censura`, `li_idusuario`) VALUES
(59, 'outro livro com 90 pags', 2010, 'novo autor feito agora', 90, 'aaaa', 10, 1),
(60, 'novo livo', 2010, 'autor', 100, 'editora', 0, 1),
(61, 'As reinaÃ§Ãµes de Narizinho', 2008, 'Monteiro Lobato', 156, 'Globo', 0, 1),
(62, 'MemÃ³rias PÃ³stumas de BrÃ¡s Cubas', 1881, 'Machado de Assis', 256, 'L&M Editores', 14, 1),
(63, 'O PrÃ­ncipe e o Mendigo', 2007, ' Mark Twain', 240, 'L&M Editores', 10, 1),
(64, 'Auto da Compadecida', 2014, 'Ariano Suassuna', 192, 'Nova Fronteira', 14, 1),
(65, 'A Menina que roubava livros', 2007, ' Markus Zusak', 480, 'IntrÃ­nseca', 14, 1),
(66, 'IT: A coisa', 2014, 'Stephen King', 1104, 'Suma de Letras', 16, 1),
(67, 'Cristianismo Puro e Simples', 2005, 'C.S. Lewis', 288, 'Thomas Nelson', 0, 1),
(68, 'Harry Potter e a Pedra Filosofal', 2000, 'J.K. Rowling', 224, 'Rocco ', 10, 1),
(69, 'Assassinato no expresso do Oriente', 1934, 'Agatha Christie', 226, 'Harpercollins ', 12, 1),
(70, 'Percy Jackson e o LadrÃ£o de Raios', 2008, 'Rick Riordan', 400, 'InstrÃ­nseca', 0, 1),
(71, 'Para todos os garotos que jÃ¡ amei', 2015, 'Janny Han', 320, 'IntrÃ­nseca', 14, 1),
(72, 'Viagem ao centro da Terra', 1886, ' JÃºlio Verne', 210, 'Zahar', 10, 1),
(73, 'Guerra Civil - Uma HistÃ³ria do Universo Marvel', 2014, 'Stuart Moore', 398, ' Novo SÃ©culo Marvel', 0, 1),
(74, 'Lost Boys: O verdadeiro amor nunca morre', 2013, 'Lilian Carmine', 464, 'Casa da Palavra', 14, 1),
(75, 'A Sereia', 2016, 'Kiera Cass', 328, ' Seguinte', 12, 1),
(76, 'Os MiserÃ¡veis', 1862, 'Vitor Hugo', 272, 'Seguinte', 16, 1),
(77, 'Jogo de espelhos', 2017, 'Cara Delevigne ', 304, 'IntrÃ­nseca', 16, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `prateleira`
--

CREATE TABLE `prateleira` (
  `pr_id` int(11) NOT NULL,
  `pr_descricao` varchar(150) DEFAULT NULL,
  `pr_idusuario` int(11) DEFAULT NULL,
  `pr_datacriacao` datetime DEFAULT NULL,
  `pr_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `prateleira`
--

INSERT INTO `prateleira` (`pr_id`, `pr_descricao`, `pr_idusuario`, `pr_datacriacao`, `pr_status`) VALUES
(6, 'nova nova', 1, '2018-10-15 03:07:54', NULL),
(7, 'nova nova', 1, '2018-10-15 03:08:24', NULL),
(8, 'nova nova', 1, '2018-10-15 03:08:33', NULL),
(9, 'aaaaaaaaaa', 1, '2018-10-15 03:08:42', NULL),
(10, 'bbb', 1, '2018-10-15 03:09:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `resenha`
--

CREATE TABLE `resenha` (
  `re_id` int(11) NOT NULL,
  `re_idlivro` int(11) DEFAULT NULL,
  `re_idusuario` int(11) DEFAULT NULL,
  `re_data` datetime DEFAULT NULL,
  `re_textoresenha` varchar(4000) DEFAULT NULL,
  `re_status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `Usuario`
--

CREATE TABLE `Usuario` (
  `us_id` int(11) NOT NULL,
  `us_nome` varchar(100) DEFAULT NULL,
  `us_email` varchar(200) DEFAULT NULL,
  `us_senha` varchar(200) DEFAULT NULL,
  `us_datanascimento` date DEFAULT NULL,
  `us_sexo` char(1) DEFAULT NULL,
  `tip_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `Usuario`
--

INSERT INTO `Usuario` (`us_id`, `us_nome`, `us_email`, `us_senha`, `us_datanascimento`, `us_sexo`, `tip_usuario`) VALUES
(1, 'hugo', 'hugo@hugo.com', '123', '2018-07-04', 'm', 2),
(17, 'taina2', 'taina@taina.com', '123', '2000-11-04', 'F', 1),
(18, 'Novo Usuario', 'novo@novo.com', '123', '2000-01-01', 'M', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuariogenero`
--

CREATE TABLE `usuariogenero` (
  `ug_id` int(11) NOT NULL,
  `ug_idgenero` int(11) DEFAULT NULL,
  `ug_idusuario` int(11) DEFAULT NULL,
  `ug_nota` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `avaliacaolivro`
--
ALTER TABLE `avaliacaolivro`
  ADD PRIMARY KEY (`al_idavaliacaolivro`),
  ADD KEY `al_livro_idx` (`al_idlivro`),
  ADD KEY `al_usuario_idx` (`al_idusuario`);

--
-- Índices de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD PRIMARY KEY (`bi_id`),
  ADD KEY `bi_livro_idx` (`bi_idlivro`),
  ADD KEY `bi_prateleira_idx` (`bi_idprateleira`);

--
-- Índices de tabela `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`cm_id`);

--
-- Índices de tabela `fatores`
--
ALTER TABLE `fatores`
  ADD PRIMARY KEY (`fa_id`);

--
-- Índices de tabela `fatorlivro`
--
ALTER TABLE `fatorlivro`
  ADD PRIMARY KEY (`fl_id`),
  ADD KEY `fl_fator_idx` (`fl_idfator`),
  ADD KEY `fl_livro_idx` (`fl_idlivro`),
  ADD KEY `fl_usuario_idx` (`fl_idusuario`);

--
-- Índices de tabela `fatorusuario`
--
ALTER TABLE `fatorusuario`
  ADD PRIMARY KEY (`fu_id`),
  ADD KEY `fu_fator_idx` (`fu_idfator`),
  ADD KEY `fu_usuario_idx` (`fu_idusuario`);

--
-- Índices de tabela `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`ge_id`);

--
-- Índices de tabela `generolivro`
--
ALTER TABLE `generolivro`
  ADD PRIMARY KEY (`gl_id`),
  ADD KEY `gl_livro_idx` (`gl_idlivro`),
  ADD KEY `gl_genero_idx` (`gl_idgenero`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`img_id`);

--
-- Índices de tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`li_idlivro`);

--
-- Índices de tabela `prateleira`
--
ALTER TABLE `prateleira`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `pr_usuario_idx` (`pr_idusuario`);

--
-- Índices de tabela `resenha`
--
ALTER TABLE `resenha`
  ADD PRIMARY KEY (`re_id`),
  ADD KEY `re_livro_idx` (`re_idlivro`),
  ADD KEY `re_usuario_idx` (`re_idusuario`);

--
-- Índices de tabela `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`us_id`);

--
-- Índices de tabela `usuariogenero`
--
ALTER TABLE `usuariogenero`
  ADD PRIMARY KEY (`ug_id`),
  ADD KEY `ug_genero_idx` (`ug_idgenero`),
  ADD KEY `ug_usuario_idx` (`ug_idusuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `avaliacaolivro`
--
ALTER TABLE `avaliacaolivro`
  MODIFY `al_idavaliacaolivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `biblioteca`
--
ALTER TABLE `biblioteca`
  MODIFY `bi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `comentario`
--
ALTER TABLE `comentario`
  MODIFY `cm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `fatores`
--
ALTER TABLE `fatores`
  MODIFY `fa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `fatorlivro`
--
ALTER TABLE `fatorlivro`
  MODIFY `fl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de tabela `fatorusuario`
--
ALTER TABLE `fatorusuario`
  MODIFY `fu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `genero`
--
ALTER TABLE `genero`
  MODIFY `ge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de tabela `generolivro`
--
ALTER TABLE `generolivro`
  MODIFY `gl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `li_idlivro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de tabela `prateleira`
--
ALTER TABLE `prateleira`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de tabela `resenha`
--
ALTER TABLE `resenha`
  MODIFY `re_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de tabela `usuariogenero`
--
ALTER TABLE `usuariogenero`
  MODIFY `ug_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `avaliacaolivro`
--
ALTER TABLE `avaliacaolivro`
  ADD CONSTRAINT `al_livro` FOREIGN KEY (`al_idlivro`) REFERENCES `livro` (`li_idlivro`),
  ADD CONSTRAINT `al_usuario` FOREIGN KEY (`al_idusuario`) REFERENCES `Usuario` (`us_id`);

--
-- Restrições para tabelas `biblioteca`
--
ALTER TABLE `biblioteca`
  ADD CONSTRAINT `bi_livro` FOREIGN KEY (`bi_idlivro`) REFERENCES `livro` (`li_idlivro`),
  ADD CONSTRAINT `bi_prateleira` FOREIGN KEY (`bi_idprateleira`) REFERENCES `prateleira` (`pr_id`);

--
-- Restrições para tabelas `fatorlivro`
--
ALTER TABLE `fatorlivro`
  ADD CONSTRAINT `fl_fator` FOREIGN KEY (`fl_idfator`) REFERENCES `fatores` (`fa_id`),
  ADD CONSTRAINT `fl_livro` FOREIGN KEY (`fl_idlivro`) REFERENCES `livro` (`li_idlivro`),
  ADD CONSTRAINT `fl_usuario` FOREIGN KEY (`fl_idusuario`) REFERENCES `Usuario` (`us_id`);

--
-- Restrições para tabelas `fatorusuario`
--
ALTER TABLE `fatorusuario`
  ADD CONSTRAINT `fu_fator` FOREIGN KEY (`fu_idfator`) REFERENCES `fatores` (`fa_id`),
  ADD CONSTRAINT `fu_usuario` FOREIGN KEY (`fu_idusuario`) REFERENCES `Usuario` (`us_id`);

--
-- Restrições para tabelas `generolivro`
--
ALTER TABLE `generolivro`
  ADD CONSTRAINT `gl_genero` FOREIGN KEY (`gl_idgenero`) REFERENCES `genero` (`ge_id`),
  ADD CONSTRAINT `gl_livro` FOREIGN KEY (`gl_idlivro`) REFERENCES `livro` (`li_idlivro`);

--
-- Restrições para tabelas `prateleira`
--
ALTER TABLE `prateleira`
  ADD CONSTRAINT `pr_usuario` FOREIGN KEY (`pr_idusuario`) REFERENCES `Usuario` (`us_id`);

--
-- Restrições para tabelas `resenha`
--
ALTER TABLE `resenha`
  ADD CONSTRAINT `re_livro` FOREIGN KEY (`re_idlivro`) REFERENCES `livro` (`li_idlivro`),
  ADD CONSTRAINT `re_usuario` FOREIGN KEY (`re_idusuario`) REFERENCES `Usuario` (`us_id`);

--
-- Restrições para tabelas `usuariogenero`
--
ALTER TABLE `usuariogenero`
  ADD CONSTRAINT `ug_genero` FOREIGN KEY (`ug_idgenero`) REFERENCES `genero` (`ge_id`),
  ADD CONSTRAINT `ug_usuario` FOREIGN KEY (`ug_idusuario`) REFERENCES `Usuario` (`us_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
