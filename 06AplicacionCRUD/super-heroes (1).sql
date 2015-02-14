-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-02-2015 a las 10:55:25
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `super-heroes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `editorial` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id_editorial`, `editorial`) VALUES
(1, 'DC Comics'),
(2, 'Marvel Comic'),
(3, 'Shonen Jump'),
(4, 'Vértigo'),
(5, 'Mirage Studio'),
(6, 'Icon Comics');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `heroes`
--

CREATE TABLE IF NOT EXISTS `heroes` (
  `id_heroe` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `editorial` int(11) NOT NULL,
  PRIMARY KEY (`id_heroe`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `heroes`
--

INSERT INTO `heroes` (`id_heroe`, `nombre`, `imagen`, `descripcion`, `editorial`) VALUES
(1, 'KickAss', 'kick-ass.png', 'Dave Lizewski es un chico adolescente obsesionado con los cómics que decide convertirse en un superhéroe. Comienza a patrullar las calles y tiene una brutal pelea con unos delincuentes. Milagrosamente sobrevive, vence al grupo y encima toda la pelea es grabada en vídeo y subida a YouTube, teniendo un éxito total. Dave se convierte en Kick Ass, un fenómeno de masas, pero todo se complica cuando se mete la mafia de por medio.', 6),
(2, 'Rafael', 'rafael.png', 'Rafael es la más valiente de las Tortugas Ninja, y un auténtico rebelde que no duda en irse en solitario a luchar contra el crimen.', 5);
