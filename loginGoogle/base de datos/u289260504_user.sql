-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: u289260504_user
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (0,'Inactivo'),(1,'Activo'),(2,'Activoxgoogle');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_notificaciones`
--

DROP TABLE IF EXISTS `estado_notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_notificaciones` (
  `id_estado_notificacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_estado_notificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_notificaciones`
--

LOCK TABLES `estado_notificaciones` WRITE;
/*!40000 ALTER TABLE `estado_notificaciones` DISABLE KEYS */;
INSERT INTO `estado_notificaciones` VALUES (0,'No suscripto'),(1,'Suscripto');
/*!40000 ALTER TABLE `estado_notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos+buscados`
--

DROP TABLE IF EXISTS `productos+buscados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productos+buscados` (
  `idproductos` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `productos+buscadoscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idproductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos+buscados`
--

LOCK TABLES `productos+buscados` WRITE;
/*!40000 ALTER TABLE `productos+buscados` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos+buscados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_social`
--

DROP TABLE IF EXISTS `users_social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_social` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `social_id` varchar(255) NOT NULL,
  `service` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_id_idx` (`users_id`),
  CONSTRAINT `users_id` FOREIGN KEY (`users_id`) REFERENCES `usuarios` (`idusuarios`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_social`
--

LOCK TABLES `users_social` WRITE;
/*!40000 ALTER TABLE `users_social` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado_idEstado` int(11) NOT NULL,
  `cod_activacion` varchar(50) DEFAULT NULL,
  `token_gmail` varchar(255) DEFAULT NULL,
  `estado_notificaciones_id_estado_notificacion` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`idusuarios`),
  UNIQUE KEY `mail_UNIQUE` (`mail`),
  KEY `fk_usuarios_estado1_idx` (`estado_idEstado`),
  KEY `fk_usuarios_estado_notificaciones1_idx` (`estado_notificaciones_id_estado_notificacion`),
  CONSTRAINT `fk_usuarios_estado1` FOREIGN KEY (`estado_idEstado`) REFERENCES `estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarios_estado_notificaciones1` FOREIGN KEY (`estado_notificaciones_id_estado_notificacion`) REFERENCES `estado_notificaciones` (`id_estado_notificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'lopezcarlosjavier25@gmail.com','$2y$10$xVlsgsZmsQbDl8H08se83elPmGpCfkfKjLCOAVt2zbXPz0VvSYibW',1,'g_aanqex8k0u1t1vzmsf0bp9xux59e',NULL,0,''),(2,'mariaadriazola25@gmail.com','$2y$10$R5h0Tp.YnZuEoZDYEVG2suEqcHcy8YF6dBmFOpzSSUiaTkjwHWXly',1,'dfador2602l5uebb1vhl5awbg5nj9e',NULL,0,''),(3,'lopezgimenezwilfrido45@gmail.com','$2y$10$83/Xsw1VNaqDgdg2RiefCOxsXZkGBKW.2E29UZ.c1TdKs4Da8DRjG',1,'brfesilqjm93h4yfrogrnehx_1ggws',NULL,0,'');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'u289260504_user'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-30  1:23:17
