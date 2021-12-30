-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.34-log - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para appsalon
CREATE DATABASE IF NOT EXISTS `appsalon` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `appsalon`;

-- Volcando estructura para tabla appsalon.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `usuarioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioId_idx` (`usuarioId`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon.citas: ~13 rows (aproximadamente)
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` (`id`, `fecha`, `hora`, `usuarioId`) VALUES
	(11, '2021-11-03', '16:20:00', 3),
	(12, '2021-11-03', '16:20:00', 3),
	(13, '2021-11-11', '16:23:00', 3),
	(14, '2021-11-25', '16:31:00', 3),
	(15, '2021-11-19', '16:33:00', 3),
	(16, '2021-11-12', '16:47:00', 3),
	(17, '2021-11-11', '16:54:00', 3),
	(18, '2021-11-05', '16:55:00', 3),
	(20, '2021-11-04', '16:00:00', 3),
	(21, '2021-11-10', '16:00:00', 3),
	(22, '2021-11-30', '17:01:00', 3),
	(23, '2021-11-04', '17:05:00', 3),
	(24, '2021-11-04', '17:05:00', 3);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;

-- Volcando estructura para tabla appsalon.citasservicios
CREATE TABLE IF NOT EXISTS `citasservicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citaId` int(11) DEFAULT NULL,
  `servicioId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `citaId_idx` (`citaId`),
  KEY `servicioId_idx` (`servicioId`),
  CONSTRAINT `citasservicios_ibfk_1` FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  CONSTRAINT `citasservicios_ibfk_2` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon.citasservicios: ~21 rows (aproximadamente)
/*!40000 ALTER TABLE `citasservicios` DISABLE KEYS */;
INSERT INTO `citasservicios` (`id`, `citaId`, `servicioId`) VALUES
	(11, 11, 2),
	(12, 11, 3),
	(13, 11, 6),
	(14, 11, 7),
	(15, 12, 1),
	(16, 12, 4),
	(17, 13, 1),
	(18, 14, 1),
	(19, 15, 1),
	(20, 16, 1),
	(21, 17, 1),
	(22, 18, 1),
	(23, 18, 2),
	(24, 18, 3),
	(25, 20, 1),
	(26, 21, 1),
	(27, 21, 8),
	(28, 22, 9),
	(29, 22, 10),
	(30, 22, 11),
	(31, 23, 1),
	(32, 23, 4),
	(33, 24, 1);
/*!40000 ALTER TABLE `citasservicios` ENABLE KEYS */;

-- Volcando estructura para tabla appsalon.servicios
CREATE TABLE IF NOT EXISTS `servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon.servicios: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` (`id`, `nombre`, `precio`) VALUES
	(1, 'Corte de Cabello Mujer', 90.00),
	(2, 'Corte de Cabello Hombre', 80.00),
	(3, 'Corte de Cabello Niño', 60.00),
	(4, 'Peinado Mujer', 80.00),
	(5, 'Peinado Hombre', 60.00),
	(6, 'Peinado Niño', 60.00),
	(7, 'Corte de Barba', 60.00),
	(8, 'Tinte Mujer', 300.00),
	(9, 'Uñas', 400.00),
	(10, 'Lavado de Cabello', 50.00),
	(11, 'Tratamiento Capilar', 150.00),
	(12, ' Tinte para cabello', 120.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;

-- Volcando estructura para tabla appsalon.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla appsalon.usuarios: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`, `telefono`, `admin`, `confirmado`, `token`) VALUES
	(2, 'Admin', 'SuperPoderoso', 'admin@solucioncb.com', '$2y$10$EawBZEv24gdDj4eDpn.BGeNU.3Oeo6.4kmM3tKDu.lrRdezCLeCSC', '123456789', 1, 1, ''),
	(3, 'Julio', 'Cervantes', 'usuario@usuario.com', '$2y$10$50APHKi8Bt31vO6vWglO9OFsX3/xWMNvFrsugAp0wFZ7TtxeiO7WC', '0123456789', 0, 1, '');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
