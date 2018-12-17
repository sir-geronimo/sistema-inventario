-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: inventario
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `articulos`
--

DROP TABLE IF EXISTS `articulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) DEFAULT NULL,
  `num_serie` varchar(300) DEFAULT NULL,
  `precio_venta` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `estante` varchar(300) DEFAULT NULL,
  `suplidor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `suplidor_idx` (`suplidor`),
  CONSTRAINT `suplidor` FOREIGN KEY (`suplidor`) REFERENCES `suplidores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos`
--

LOCK TABLES `articulos` WRITE;
/*!40000 ALTER TABLE `articulos` DISABLE KEYS */;
INSERT INTO `articulos` VALUES (1,'Clavos','CA-21',2,86,'5-C',6),(2,'Tornillo','T-83',5,974,'1-A',4),(3,'Tabla de caoba','TBC-59',550,300,'3-F',2),(4,'Sillas plasticas','SP132',500,707,'2-A',2),(5,'Bebedero','BSD-100',2500,10,'2-FA',6),(7,'b','321b',1233,12,'A12',18),(8,'Aguacate','AGC',15,985,'C110',19);
/*!40000 ALTER TABLE `articulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulos_compra`
--

DROP TABLE IF EXISTS `articulos_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos_compra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `suplidor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_articulo_idx` (`id_articulo`),
  KEY `id_suplidor_idx` (`suplidor`),
  CONSTRAINT `id_articulo_compra` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `id_suplidor` FOREIGN KEY (`suplidor`) REFERENCES `suplidores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos_compra`
--

LOCK TABLES `articulos_compra` WRITE;
/*!40000 ALTER TABLE `articulos_compra` DISABLE KEYS */;
INSERT INTO `articulos_compra` VALUES (1,1,'2018-03-30',6),(2,2,'2018-02-16',4),(3,3,'2018-04-02',2),(4,4,'2012-01-01',6),(5,5,'1111-11-11',4),(6,7,'2018-04-08',18),(7,8,'2018-10-16',19);
/*!40000 ALTER TABLE `articulos_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articulos_vendidos`
--

DROP TABLE IF EXISTS `articulos_vendidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `articulos_vendidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_articulo` int(11) DEFAULT NULL,
  `fecha_venta` date DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `pagado` tinyint(4) DEFAULT '0',
  `id_factura` int(250) NOT NULL DEFAULT '0',
  `precio` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_articulo_venta_idx` (`id_articulo`),
  CONSTRAINT `id_articulo_venta` FOREIGN KEY (`id_articulo`) REFERENCES `articulos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articulos_vendidos`
--

LOCK TABLES `articulos_vendidos` WRITE;
/*!40000 ALTER TABLE `articulos_vendidos` DISABLE KEYS */;
INSERT INTO `articulos_vendidos` VALUES (1,1,'2018-10-16',150,1,4264,0),(2,1,'2018-10-16',1,1,5419,0),(3,2,'2018-10-16',10,1,1707,0),(4,8,'2018-10-16',15,1,6843,0),(5,2,'2018-10-19',2,1,6843,0),(6,1,'2018-11-01',2,1,6843,2),(7,1,'2018-11-01',2,1,6843,2),(8,1,'2018-11-01',2,1,6843,2),(9,4,'2018-11-01',5,1,1,500),(10,1,'2018-11-01',5,1,1007,2),(11,2,'2018-11-01',2,1,1007,5);
/*!40000 ALTER TABLE `articulos_vendidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `codigo_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_facturacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,0) NOT NULL,
  PRIMARY KEY (`codigo_cliente`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (5419,1,'2018-11-02 03:10:49',12),(1707,2,'2018-11-02 03:12:01',12),(6843,3,'2018-11-02 03:19:12',12),(1007,4,'2018-11-03 16:29:11',20);
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suplidores`
--

DROP TABLE IF EXISTS `suplidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suplidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `apellido` varchar(300) DEFAULT NULL,
  `direccion` text,
  `active` enum('0','1') DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suplidores`
--

LOCK TABLES `suplidores` WRITE;
/*!40000 ALTER TABLE `suplidores` DISABLE KEYS */;
INSERT INTO `suplidores` VALUES (1,'Juan','Perez','Calle las mariposas #14','0'),(2,'José','Gonzales','Calle 39 #86','0'),(4,'Juan','Manuel Gonzales','Calle las Americas #777','1'),(5,'Pepe','Auyama','El Jardin #21','0'),(6,'Enger','Jiménez','Calle Respaldo la Javilla #14','1'),(17,'Pepe','Agallas','321','0'),(18,'Manuel','Tavarez','Calle Industrial #25','1'),(19,'Jhonly','Baez','Santo Domingo Este','1');
/*!40000 ALTER TABLE `suplidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(300) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'EJ21','$2y$10$vqoAFJAGmc/bs8eRxVRH0eNiDg2uvl0gxO.d2VQBZ5KoQ4gERzz5O','Enger','Jiménez'),(3,'EJ','$2y$10$LJbG7RmknFTWTnwwqPEcBeAP95CeIm4VVGZBkLTlRLKwvTtWqInv.','Pepe','Agallas'),(4,'JC','$2y$10$c4o933VPdJNUXa5x/D6b9.QU8UI0cgUUGZecjmGNF2rr0whSXf8yi','Jose','Contreras'),(5,'admin','$2y$10$MLFmZxWOW6CiXskxNpfoTeKS9O0VUB.dKJayy8dTQULHAojJKJ.HS','jhonly','baez');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-17 12:04:09
