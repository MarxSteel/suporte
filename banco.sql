-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 05, 2016 at 04:25 PM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

--
-- Database: `henrySuporte`
--
-- --------------------------------------------------------
--
-- Table structure for table `atendimento`
--

CREATE TABLE `atendimento` (
  `id` int(11) UNSIGNED NOT NULL,
  `Status` int(2) DEFAULT NULL,
  `TipoAtendimento` int(3) DEFAULT NULL,
  `DescAtend` text,
  `DescSolicita` text,
  `UserCadastro` varchar(50) DEFAULT NULL,
  `UserAtendente` varchar(50) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `DataFinaliza` datetime DEFAULT NULL,
  `Revenda` varchar(200) DEFAULT NULL,
  `RevendaTecnico` varchar(200) DEFAULT NULL,
  `NumSerie` varchar(200) DEFAULT NULL,
  `Equip` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `doctos`
--

CREATE TABLE `doctos` (
  `id` int(11) UNSIGNED NOT NULL,
  `Versao` varchar(25) DEFAULT NULL,
  `Modelo` varchar(200) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `UserCadastro` varchar(100) DEFAULT NULL,
  `Obs` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `firmware`
--

CREATE TABLE `firmware` (
  `id` int(11) UNSIGNED NOT NULL,
  `Versao` varchar(25) DEFAULT NULL,
  `Modelo` varchar(200) DEFAULT NULL,
  `file` varchar(250) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `UserCadastro` varchar(250) DEFAULT NULL,
  `Obs` text,
  `Status` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) UNSIGNED NOT NULL,
  `Cod` int(3) DEFAULT NULL,
  `TipoLog` varchar(250) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `UserCadastro` varchar(250) DEFAULT NULL,
  `Descreve` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `codLogin` mediumint(8) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(120) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `pFw` int(2) DEFAULT '0',
  `pUsr` int(2) DEFAULT '0',
  `pRel` int(2) DEFAULT '0',
  `pReabre` int(2) DEFAULT '0',
  `pSup` int(2) DEFAULT NULL,
  `Tipo` int(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `DataCadastro` datetime DEFAULT NULL,
  `Obs` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Indexes for table `atendimento`
--
ALTER TABLE `atendimento`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `doctos`
--
ALTER TABLE `doctos`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `firmware`
--
ALTER TABLE `firmware`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`codLogin`);
--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for table `atendimento`
--
ALTER TABLE `atendimento`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `doctos`
--
ALTER TABLE `doctos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `firmware`
--
ALTER TABLE `firmware`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `codLogin` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;