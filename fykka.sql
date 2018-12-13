-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.21 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para fykka
CREATE DATABASE IF NOT EXISTS `fykka` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `fykka`;

-- Volcando estructura para tabla fykka.login
CREATE TABLE IF NOT EXISTS `login` (
  `log_ide` int(11) NOT NULL AUTO_INCREMENT,
  `log_usu_ide` int(11) NOT NULL,
  `log_user` varchar(50) NOT NULL,
  `log_pass` varchar(50) NOT NULL,
  `log_type` enum('SUPER USUARIO','USUARIO NORMAL'),
  PRIMARY KEY (`log_ide`),
  UNIQUE KEY `log_user` (`log_user`),
  KEY `FK_login_usuarios` (`log_usu_ide`),
  CONSTRAINT `FK_login_usuarios` FOREIGN KEY (`log_usu_ide`) REFERENCES `usuarios` (`usu_ide`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.login: ~2 rows (aproximadamente)
DELETE FROM `login`;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` (`log_ide`, `log_usu_ide`, `log_user`, `log_pass`, `log_type`) VALUES
	(1, 1, 'aceituno', 'aceituno', 'SUPER USUARIO'),
	(2, 2, 'kevin', 'kevin', 'USUARIO NORMAL'),
	(21, 22, 'kely', 'kely', NULL);
/*!40000 ALTER TABLE `login` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.proyecto
CREATE TABLE IF NOT EXISTS `proyecto` (
  `pro_ide` int(11) NOT NULL AUTO_INCREMENT,
  `pro_nombre` varchar(100) NOT NULL,
  `pro_encargado` int(11) NOT NULL,
  `pro_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pro_porcentaje` int(11) NOT NULL DEFAULT '0',
  `pro_estado` enum('INICIADO','TERMINADO','SUSPENDIDO') NOT NULL DEFAULT 'INICIADO',
  PRIMARY KEY (`pro_ide`),
  KEY `FK_proyecto_usuarios` (`pro_encargado`),
  CONSTRAINT `FK_proyecto_usuarios` FOREIGN KEY (`pro_encargado`) REFERENCES `usuarios` (`usu_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.proyecto: ~0 rows (aproximadamente)
DELETE FROM `proyecto`;
/*!40000 ALTER TABLE `proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyecto` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.requerimientoresponsable
CREATE TABLE IF NOT EXISTS `requerimientoresponsable` (
  `rer_usu_ide` int(11) NOT NULL,
  `rer_req_ide` int(11) NOT NULL,
  PRIMARY KEY (`rer_usu_ide`,`rer_req_ide`),
  KEY `FK_requerimientoresponsable_requerimientos` (`rer_req_ide`),
  CONSTRAINT `FK_requerimientoresponsable_requerimientos` FOREIGN KEY (`rer_req_ide`) REFERENCES `requerimientos` (`req_ide`),
  CONSTRAINT `FK_requerimientoresponsable_usuarios` FOREIGN KEY (`rer_usu_ide`) REFERENCES `usuarios` (`usu_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.requerimientoresponsable: ~0 rows (aproximadamente)
DELETE FROM `requerimientoresponsable`;
/*!40000 ALTER TABLE `requerimientoresponsable` DISABLE KEYS */;
/*!40000 ALTER TABLE `requerimientoresponsable` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.requerimientos
CREATE TABLE IF NOT EXISTS `requerimientos` (
  `req_ide` int(11) NOT NULL AUTO_INCREMENT,
  `req_nombre` varchar(100) DEFAULT NULL,
  `req_numeracioin` int(11) NOT NULL DEFAULT '0',
  `req_detalle` int(11) DEFAULT NULL,
  `req_fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `req_estado` enum('ACEPTADO','RECHAZADO','NO EVALUADO') DEFAULT NULL,
  PRIMARY KEY (`req_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.requerimientos: ~0 rows (aproximadamente)
DELETE FROM `requerimientos`;
/*!40000 ALTER TABLE `requerimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `requerimientos` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `rol_ide` int(11) NOT NULL AUTO_INCREMENT,
  `rol_nombre` varchar(100) DEFAULT NULL,
  `rol_link` varchar(100) DEFAULT NULL,
  `rol_tipo` enum('PRINCIPAL','PROYECTOS','TAREAS','OTROS') NOT NULL,
  `rol_usuario` enum('SA','UN','AN','PO','SM') DEFAULT NULL,
  `rol_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rol_ide`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla fykka.roles: ~6 rows (aproximadamente)
DELETE FROM `roles`;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`rol_ide`, `rol_nombre`, `rol_link`, `rol_tipo`, `rol_usuario`, `rol_icon`) VALUES
	(1, 'Crear Proyecto', 'project/new_project', 'PROYECTOS', NULL, 'fa-plus'),
	(2, 'Ver Proyectos', 'project/list_project', 'PROYECTOS', NULL, 'fa-list'),
	(3, 'Mi Perfil', 'user/perfil', 'OTROS', NULL, 'fa-user'),
	(4, 'Principal', 'project/home', 'PRINCIPAL', NULL, 'fa-home'),
	(16, 'Tareas', 'project/tareas', 'PROYECTOS', NULL, 'fa-list'),
	(17, 'Requerimientos', 'project/porequerimientos', 'PROYECTOS', NULL, 'fa-user-tie');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.rolesproyecto
CREATE TABLE IF NOT EXISTS `rolesproyecto` (
  `rdp_ide` int(11) NOT NULL AUTO_INCREMENT,
  `rdp_nombre` varchar(50) DEFAULT NULL,
  `rdp_descripcion` varchar(200) DEFAULT NULL,
  `rdp_necesidad` enum('ALTA','BAJA','MEDIA') DEFAULT NULL,
  PRIMARY KEY (`rdp_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.rolesproyecto: ~0 rows (aproximadamente)
DELETE FROM `rolesproyecto`;
/*!40000 ALTER TABLE `rolesproyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `rolesproyecto` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.rol_proyecto
CREATE TABLE IF NOT EXISTS `rol_proyecto` (
  `rp_ide` int(11) NOT NULL AUTO_INCREMENT,
  `rp_usu_ide` int(11) DEFAULT NULL,
  `rp_pro_ide` int(11) DEFAULT NULL,
  `rp_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`rp_ide`),
  KEY `FK_rol_proyecto_usuarios` (`rp_usu_ide`),
  KEY `FK_rol_proyecto_proyecto` (`rp_pro_ide`),
  KEY `FK_rol_proyecto_rolesproyecto` (`rp_rol`),
  CONSTRAINT `FK_rol_proyecto_proyecto` FOREIGN KEY (`rp_pro_ide`) REFERENCES `proyecto` (`pro_ide`),
  CONSTRAINT `FK_rol_proyecto_rolesproyecto` FOREIGN KEY (`rp_rol`) REFERENCES `rolesproyecto` (`rdp_ide`),
  CONSTRAINT `FK_rol_proyecto_usuarios` FOREIGN KEY (`rp_usu_ide`) REFERENCES `usuarios` (`usu_ide`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.rol_proyecto: ~0 rows (aproximadamente)
DELETE FROM `rol_proyecto`;
/*!40000 ALTER TABLE `rol_proyecto` DISABLE KEYS */;
/*!40000 ALTER TABLE `rol_proyecto` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.tareas
CREATE TABLE IF NOT EXISTS `tareas` (
  `tar_ide` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tar_usu_ide` int(11),
  `tar_rol_ide` int(11),
  PRIMARY KEY (`tar_ide`),
  UNIQUE KEY `tar_usu_ide` (`tar_usu_ide`,`tar_rol_ide`),
  KEY `FK_tarea_roles` (`tar_rol_ide`),
  CONSTRAINT `FK_tarea_roles` FOREIGN KEY (`tar_rol_ide`) REFERENCES `roles` (`rol_ide`),
  CONSTRAINT `FK_tarea_usuarios` FOREIGN KEY (`tar_usu_ide`) REFERENCES `usuarios` (`usu_ide`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.tareas: ~5 rows (aproximadamente)
DELETE FROM `tareas`;
/*!40000 ALTER TABLE `tareas` DISABLE KEYS */;
INSERT INTO `tareas` (`tar_ide`, `tar_usu_ide`, `tar_rol_ide`) VALUES
	(2, 1, 1),
	(3, 1, 2),
	(4, 1, 3),
	(7, 22, 3),
	(5, 22, 4);
/*!40000 ALTER TABLE `tareas` ENABLE KEYS */;

-- Volcando estructura para tabla fykka.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `usu_ide` int(11) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(50) DEFAULT NULL,
  `usu_apellidos` varchar(50) DEFAULT NULL,
  `usu_nivel` enum('SENIOR','MASTER','JUNIOR') DEFAULT NULL,
  `usu_tipo` enum('SUPER USUARIO','USUARIO SIMPLE') DEFAULT NULL,
  `usu_profesion` enum('SUPER USUARIO','USUARIO SIMPLE') DEFAULT NULL,
  `usu_correo` varchar(50) DEFAULT NULL,
  `usu_telefono` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`usu_ide`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla fykka.usuarios: ~2 rows (aproximadamente)
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`usu_ide`, `usu_nombre`, `usu_apellidos`, `usu_nivel`, `usu_tipo`, `usu_profesion`, `usu_correo`, `usu_telefono`) VALUES
	(1, 'MIGUEL', 'ACEITUNO ROJAS', 'SENIOR', 'SUPER USUARIO', NULL, 'aceituno@gmail.com', '917234129'),
	(2, NULL, NULL, NULL, 'USUARIO SIMPLE', NULL, 'kevin@kevin.com', NULL),
	(22, 'Kely Karina', 'Achata Paricahua', 'JUNIOR', 'USUARIO SIMPLE', 'USUARIO SIMPLE', 'kely@kely.com', '9123123131');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para disparador fykka.roles
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `roles` AFTER INSERT ON `usuarios` FOR EACH ROW BEGIN
	insert into tareas (tar_usu_ide,tar_rol_ide) values(New.usu_ide,4);
	insert into tareas (tar_usu_ide,tar_rol_ide) values(New.usu_ide,3);
		
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
