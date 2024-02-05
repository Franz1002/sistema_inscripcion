-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: inscripcion_escolar
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aula`
--

DROP TABLE IF EXISTS `aula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aula` (
  `idaula` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombreaula` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` int(2) NOT NULL,
  `seccionid` bigint(20) NOT NULL,
  PRIMARY KEY (`idaula`),
  KEY `seccionid` (`seccionid`),
  CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`seccionid`) REFERENCES `seccion` (`idseccion`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aula`
--

LOCK TABLES `aula` WRITE;
/*!40000 ALTER TABLE `aula` DISABLE KEYS */;
INSERT INTO `aula` VALUES (1,'Honguito Rojo',30,1),(2,'Honguito verde',30,1),(3,'Honguito azul',30,1),(4,'Honguito amarillo',30,2),(5,'Honguito cafe',30,2),(6,'Honguito blanco',30,2);
/*!40000 ALTER TABLE `aula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cargo`
--

DROP TABLE IF EXISTS `cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cargo` (
  `idcargo` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombrecargo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargo`
--

LOCK TABLES `cargo` WRITE;
/*!40000 ALTER TABLE `cargo` DISABLE KEYS */;
INSERT INTO `cargo` VALUES (1,'Administrador','Encargado de administrar el sistema',1),(2,'Director','Autoridad máxima de la Unidad Educativa\r\n',1),(3,'Profesor','Profesor',1);
/*!40000 ALTER TABLE `cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL AUTO_INCREMENT,
  `rude` bigint(20) NOT NULL,
  `fotoestudiante` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `ciestudiante` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `expedido` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `primernombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `segundonombre` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidopaterno` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidomaterno` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  `genero` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `deptonacido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `domicilio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`rude`),
  KEY `indice1` (`idestudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES (8,282702223054785,'img_f2399f4a2a8e2bcfdad98e4b1116b878.jpg','36545383','SC','Ali','Greg','Furley','Odcroft','2020-08-27','MASCULINO','COCHABAMBA','5 Lakewood Drive',1),(9,287153282645878,'img_c82c62488c2acc585b306cbb2f98b098.jpg','74589878','SC','Karla','Babita','Karolczyk','Leonard','2022-05-04','FEMENINO','COCHABAMBA','72 Northport Park',1),(4,345061945412587,'img_80f49b5ff3bafe3139e182ee909425b8.jpg','48799107','CH','Thelma','Leland','Foddy','Burdfield','2019-04-18','FEMENINO','ORURO','27592 Butterfield Road',1),(3,474147752545878,'img_f0daf52e46dd29bed551e323297549c4.jpg','56175581','PD','Colman','Devlin','Sommerfeld','Wackley','2022-07-25','MASCULINO','SANTA CRUZ','27202 Hermina Place',1),(6,507278260345878,'img_e7ebeb6184530db749eaa69a38459a0a.jpg','28653412','CB','Latrena','Georgena','Gauche','Castellanos','2021-06-30','FEMENINO','COCHABAMBA','113 Birchwood Pass',1),(5,588708631956875,'img_0c43a2181e20c7fe58fe674eafdbbf04.jpg','59003032','LP','Adrianne','Prudence','Corse','Parks','2019-11-09','FEMENINO','BENI','04640 Redwing Parkway',1),(10,632560581054785,'img_1a628a812ff199aff7438a738af00919.jpg','60048026','CB','Rufe','Warde','Ryder','Burnyate','2022-05-23','MASCULINO','SUCRE','997 Forest Dale Court',1),(1,642182301714578,'img_0c43a2181e20c7fe58fe674eafdbbf04.jpg','90494831','PD','Brittan','Theresita','Joao','Fawlkes','2021-03-18','FEMENINO','SANTA CRUZ','Plaza',1),(2,655883048514525,'img_ebd2467c0debcec0eeabff492b6bb4fe.jpg','65500286','CB','Chrystel','Daveta','McVrone','Punter','2019-07-18','FEMENINO','COCHABAMBA','3945 Reindahl Way',1),(7,666753046654785,'img_f104ecf55c35d7bcbae8973d670e2ec6.jpg','58789875','SC','Fanchette','Helga','Marusik','Trye','2019-06-05','FEMENINO','LA PAZ','86297 Chive Center',1);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inscripcion`
--

DROP TABLE IF EXISTS `inscripcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscripcion` (
  `idinscripcion` bigint(20) NOT NULL AUTO_INCREMENT,
  `estudianteid` bigint(20) NOT NULL,
  `aulaid` bigint(20) NOT NULL,
  `periodoid` bigint(20) NOT NULL,
  `fechainscripcion` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idinscripcion`),
  KEY `estudianteid` (`estudianteid`),
  KEY `aulaid` (`aulaid`),
  KEY `periodoid` (`periodoid`),
  CONSTRAINT `inscripcion_ibfk_3` FOREIGN KEY (`aulaid`) REFERENCES `aula` (`idaula`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inscripcion_ibfk_7` FOREIGN KEY (`periodoid`) REFERENCES `periodoacademico` (`idperiodo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inscripcion_ibfk_8` FOREIGN KEY (`estudianteid`) REFERENCES `estudiante` (`rude`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inscripcion`
--

LOCK TABLES `inscripcion` WRITE;
/*!40000 ALTER TABLE `inscripcion` DISABLE KEYS */;
INSERT INTO `inscripcion` VALUES (1,282702223054785,1,2,'2022-11-15'),(2,345061945412587,2,2,'2022-11-15'),(3,642182301714578,5,2,'2022-11-15');
/*!40000 ALTER TABLE `inscripcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodoacademico`
--

DROP TABLE IF EXISTS `periodoacademico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodoacademico` (
  `idperiodo` bigint(20) NOT NULL AUTO_INCREMENT,
  `anio` int(4) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafinal` date NOT NULL,
  `estado` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idperiodo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodoacademico`
--

LOCK TABLES `periodoacademico` WRITE;
/*!40000 ALTER TABLE `periodoacademico` DISABLE KEYS */;
INSERT INTO `periodoacademico` VALUES (1,2021,'2021-02-01','2021-12-20',2),(2,2022,'2022-02-01','2022-12-20',1);
/*!40000 ALTER TABLE `periodoacademico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seccion`
--

DROP TABLE IF EXISTS `seccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seccion` (
  `idseccion` bigint(20) NOT NULL AUTO_INCREMENT,
  `numeroseccion` int(2) NOT NULL,
  PRIMARY KEY (`idseccion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seccion`
--

LOCK TABLES `seccion` WRITE;
/*!40000 ALTER TABLE `seccion` DISABLE KEYS */;
INSERT INTO `seccion` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `seccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tutor`
--

DROP TABLE IF EXISTS `tutor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tutor` (
  `idtutor` bigint(20) NOT NULL AUTO_INCREMENT,
  `citutor` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `expedido` varchar(2) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `parentesco` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(20) NOT NULL,
  `estudianteid` bigint(20) NOT NULL,
  PRIMARY KEY (`idtutor`),
  KEY `estudianteid` (`estudianteid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tutor`
--

LOCK TABLES `tutor` WRITE;
/*!40000 ALTER TABLE `tutor` DISABLE KEYS */;
INSERT INTO `tutor` VALUES (1,'58958745','SC','Annie','Odcroft','MADRE',65897858,282702223054785),(2,'45478848','CB','Andy','Karolczyk','MADRE',65478541,287153282645878),(3,'78574587','CB','Kathia','Burdfield','TIA',63589648,345061945412587),(4,'84587896','SC','Abril','Wackley','MADRE',62547854,474147752545878),(5,'87452145','CB','Belen','Castellanos','MADRE',62541587,507278260345878),(6,'56543456','CH','Ana','Parks','TIA',62587896,588708631956875),(7,'84578541','PN','Angela','Burnyate','MADRE',66985478,632560581054785),(8,'58958745','CB','Jhessica','Fawlkes','MADRE',68954125,642182301714578),(9,'521148785','PN','Vanesa','Punter','MADRE',62547854,655883048514525);
/*!40000 ALTER TABLE `tutor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `ci` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `cargoid` bigint(20) NOT NULL,
  `estado` int(10) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`),
  KEY `cargoid` (`cargoid`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cargoid`) REFERENCES `cargo` (`idcargo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'9397838','Franz','Cori','franz17','admin',69518441,'2022-09-16 15:02:59',1,1),(2,'9338254','Adrian','Montero','adrian000','12345',74587854,'2022-09-16 15:03:29',1,2),(3,'68554785','Juan','Ledezma','juan102','12345',4874587,'2022-09-16 15:04:00',2,1),(4,'7878783','Abel','Suarez','abel2','12345',4585698,'2022-09-16 16:02:46',2,1),(5,'5656532','Alexander','Dimitrix','gdfgalex12','12345',4858754,'2022-09-16 16:22:01',2,2),(6,'1234532','Andru','Iriarte','andrui1','13245',4654563,'2022-09-16 16:22:29',3,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-15 21:05:22
