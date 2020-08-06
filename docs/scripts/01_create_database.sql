CREATE DATABASE  IF NOT EXISTS `psjb_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `psjb_db`;
-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: psjb_db
-- ------------------------------------------------------
-- Server version	5.7.27-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bitacora` (
  `bitacoracod` int(11) NOT NULL AUTO_INCREMENT,
  `bitacorafch` datetime DEFAULT NULL,
  `bitprograma` varchar(15) DEFAULT NULL,
  `bitdescripcion` varchar(255) DEFAULT NULL,
  `bitTipo` char(3) DEFAULT NULL,
  `bitusuario` bigint(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`bitacoracod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `catCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `catDscES` varchar(80) DEFAULT NULL,
  `catDscEN` varchar(80) DEFAULT NULL,
  `catState` char(3) DEFAULT NULL,
  PRIMARY KEY (`catCod`),
  KEY `CatEstF_idx` (`catState`),
  CONSTRAINT `CatStateF` FOREIGN KEY (`catState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Accesorios','Accesories','ACT'),(2,'Camisas','T-Shirt','ACT'),(3,'Libros','Books','ACT'),(4,'FIDES','FIDES','ACT');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direction`
--

DROP TABLE IF EXISTS `direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direction` (
  `directCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `userCodD` bigint(10) unsigned NOT NULL,
  `hoodCodFK` int(10) unsigned NOT NULL,
  `directStreet` varchar(254) DEFAULT NULL,
  PRIMARY KEY (`directCod`,`userCodD`,`hoodCodFK`),
  KEY `hoodCod_idx` (`hoodCodFK`),
  KEY `userCodDf_idx` (`userCodD`),
  CONSTRAINT `hoodCod` FOREIGN KEY (`hoodCodFK`) REFERENCES `neighborhood` (`hoodCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userCodDf` FOREIGN KEY (`userCodD`) REFERENCES `user` (`userCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direction`
--

LOCK TABLES `direction` WRITE;
/*!40000 ALTER TABLE `direction` DISABLE KEYS */;
INSERT INTO `direction` VALUES (1,2,1,'Col. Kennedy, Segunda Entrada, Bloque 4, Casa 2432. Casa Anaranjada');
/*!40000 ALTER TABLE `direction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `management`
--

DROP TABLE IF EXISTS `management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `management` (
  `codManagement` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hourManagement` varchar(45) DEFAULT NULL,
  `daysManagement` varchar(45) DEFAULT NULL,
  `maxOrderManagement` varchar(45) DEFAULT NULL,
  `stateManagement` char(3) DEFAULT NULL,
  PRIMARY KEY (`codManagement`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `management`
--

LOCK TABLES `management` WRITE;
/*!40000 ALTER TABLE `management` DISABLE KEYS */;
INSERT INTO `management` VALUES (1,'12:00 AM-10:00 PM','Mon,Tue,Wed,Thu,Fri,Sat,Sun','100000','ACT');
/*!40000 ALTER TABLE `management` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module` (
  `mdlCod` varchar(25) NOT NULL,
  `mdlDscES` varchar(80) DEFAULT NULL,
  `mdlDscEN` varchar(80) DEFAULT NULL,
  `mdlState` char(3) DEFAULT NULL,
  `mdlClass` char(3) DEFAULT NULL,
  PRIMARY KEY (`mdlCod`),
  KEY `mdlStateF_idx` (`mdlState`),
  CONSTRAINT `mdlStateF` FOREIGN KEY (`mdlState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES ('Acceso','',NULL,'ACT','PGE'),('Accesos','Control de Accesos','Access Control','ACT','MNU'),('Approved',NULL,NULL,'ACT','PGE'),('Canceled',NULL,NULL,'ACT','PGE'),('cart',NULL,NULL,'ACT','PGE'),('cartL',NULL,NULL,'ACT','PGE'),('Categoria',NULL,NULL,'ACT','PGE'),('Categorias','Tipos de Categorias','Types of Categories','ACT','MNU'),('Change',NULL,NULL,'ACT','PGE'),('Checkout',NULL,NULL,'ACT','PGE'),('Config','Configuración de Usuario','User Configuration','INA','MNU'),('Directions','Mis Direcciones','My Directions','INA','MNU'),('Entrega',NULL,NULL,'ACT','PGE'),('Entregas','Control de Lugares de Entrega','Delivery Places Management','ACT','MNU'),('forgot',NULL,NULL,'ACT','PGE'),('Historial','Mis Ordenes','My Ordes','ACT','MNU'),('Manejo',NULL,NULL,'ACT','PGE'),('Manejos','Control de Horarios','Schedule Management','ACT','MNU'),('Modulo',NULL,NULL,'ACT','PGE'),('Modulos','Control de Modulos','Modules Control','ACT','MNU'),('Orden',NULL,NULL,'ACT','PGE'),('Ordenes','Manejo de Ordenes','Orders Management','ACT','MNU'),('Pago',NULL,NULL,'ACT','PGE'),('Pagos','Tipos de Pagos','','INA','MNU'),('Producto',NULL,NULL,'ACT','PGE'),('Productos','Control de Inventario','Inventory Managment','ACT','MNU'),('pwsd',NULL,NULL,'ACT','PGE'),('Roles',NULL,NULL,'ACT','PGE'),('Start',NULL,NULL,'ACT','PGE'),('Status',NULL,NULL,'ACT','PGE'),('Statuses','Tipos de Estado de Ordenes','Order Status Types','ACT','MNU'),('store',NULL,NULL,'ACT','PGE'),('storeL',NULL,NULL,'ACT','PGE'),('Tipo',NULL,NULL,'ACT','PGE'),('Tipos','Tipo de Usuarios','User Types','ACT','MNU'),('User',NULL,NULL,'ACT','PGE'),('Users','Control de Usuarios','Users Management','ACT','MNU');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `neighborhood`
--

DROP TABLE IF EXISTS `neighborhood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `neighborhood` (
  `hoodCod` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hoodState` char(3) NOT NULL,
  `hoodDsc` varchar(130) DEFAULT NULL,
  `hoodShippingFee` decimal(8,3) DEFAULT NULL,
  PRIMARY KEY (`hoodCod`),
  KEY `hoodState_idx` (`hoodState`),
  CONSTRAINT `hoodState` FOREIGN KEY (`hoodState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `neighborhood`
--

LOCK TABLES `neighborhood` WRITE;
/*!40000 ALTER TABLE `neighborhood` DISABLE KEYS */;
INSERT INTO `neighborhood` VALUES (1,'ACT','Los Robles',0.990);
/*!40000 ALTER TABLE `neighborhood` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_product` (
  `orderPrdCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderCod` bigint(10) unsigned NOT NULL,
  `prdCod` bigint(10) unsigned NOT NULL,
  `prdPrice` decimal(16,2) DEFAULT NULL,
  `cartQuantity` int(11) DEFAULT NULL,
  `prdQuantity` int(11) DEFAULT NULL,
  `prdDiscount` decimal(3,2) DEFAULT NULL,
  `prdIsv` decimal(9,4) DEFAULT NULL,
  PRIMARY KEY (`orderPrdCod`,`orderCod`,`prdCod`),
  KEY `orderCodF_idx` (`orderCod`),
  KEY `prdCodF_idx` (`prdCod`),
  CONSTRAINT `orderCodF` FOREIGN KEY (`orderCod`) REFERENCES `orders` (`orderCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `prdCodF` FOREIGN KEY (`prdCod`) REFERENCES `product` (`prdCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` VALUES (1,1,2,0.50,1,1,0.00,NULL);
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `orderCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `userCod` bigint(10) unsigned NOT NULL,
  `orderStatus` char(3) DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  `orderDeliverTime` datetime DEFAULT NULL,
  `orderPayment` char(3) DEFAULT NULL,
  `orderCell` varchar(40) DEFAULT NULL,
  `orderDirection` varchar(254) DEFAULT NULL,
  `orderShippingFee` decimal(7,2) DEFAULT NULL,
  `orderIsv` decimal(15,2) DEFAULT NULL,
  `orderTotal` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`orderCod`,`userCod`),
  KEY `userCodF_idx` (`userCod`),
  KEY `orderPaymentF_idx` (`orderPayment`),
  KEY `orderStatusF_idx` (`orderStatus`),
  CONSTRAINT `orderPaymentF` FOREIGN KEY (`orderPayment`) REFERENCES `payment` (`paymentCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orderStatusF` FOREIGN KEY (`orderStatus`) REFERENCES `status` (`statusCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userCod` FOREIGN KEY (`userCod`) REFERENCES `user` (`userCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,2,'PND','2020-08-05 01:45:19','2020-08-05 03:00:00','PPL','8990-7077','Barrio/Colonia: Los Robles----> Direccion Especifica: Col. Kennedy, Segunda Entrada, Bloque 4, Casa 2432. Casa Anaranjada',0.99,0.00,1.49);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `paymentCod` char(3) NOT NULL,
  `paymentDscES` varchar(45) DEFAULT NULL,
  `paymentDscEN` varchar(45) DEFAULT NULL,
  `paymentLib` varchar(30) DEFAULT NULL,
  `paymentState` char(3) DEFAULT NULL,
  PRIMARY KEY (`paymentCod`),
  KEY `paymentStateF_idx` (`paymentState`),
  CONSTRAINT `paymentStateF` FOREIGN KEY (`paymentState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES ('PPL','Pago Con Paypal','Paypal Payment','paypal','ACT');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `prdCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `prdImageURL` varchar(255) DEFAULT NULL,
  `prdDscES` varchar(80) DEFAULT NULL,
  `prdDscEN` varchar(80) DEFAULT NULL,
  `prdPrice` decimal(16,2) DEFAULT NULL,
  `prdIsv` decimal(9,4) DEFAULT NULL,
  `prdQuantity` int(10) unsigned DEFAULT NULL,
  `prdCategory` bigint(10) unsigned DEFAULT NULL,
  `prdStock` int(10) unsigned DEFAULT NULL,
  `prdState` char(3) DEFAULT NULL,
  `productcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`prdCod`),
  KEY `prdState_idx` (`prdState`),
  KEY `prdCategoryF_idx` (`prdCategory`),
  CONSTRAINT `prdCategoryF` FOREIGN KEY (`prdCategory`) REFERENCES `category` (`catCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `prdStateF` FOREIGN KEY (`prdState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'public/imgs/EditorialVerboDivino1.png','Biblia Verbo Divino','Divine Verb Bible',2.00,NULL,10,3,60,'ACT',NULL),(2,'public/imgs/RosarioNegro.png','Rosario Negro','Black Rosary',0.50,NULL,1,1,5,'ACT',NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `state` (
  `stateCod` char(3) NOT NULL,
  `stateDsc` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`stateCod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES ('ACT','Activo'),('INA','Inactivo'),('PND','Pendiente');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `statusCod` char(3) NOT NULL,
  `statusDscES` varchar(45) DEFAULT NULL,
  `statusDscEN` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`statusCod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES ('DLV','Entregada','Delivered'),('DNY','Denegada','Cancelled'),('OMW','En camino','On my way'),('PND','Pendiente','Pending'),('PRP','Preparando','Preparing');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type` (
  `typeCod` char(3) NOT NULL,
  `typeDsc` varchar(45) DEFAULT NULL,
  `typeState` char(3) DEFAULT NULL,
  `typeExp` datetime DEFAULT NULL,
  PRIMARY KEY (`typeCod`),
  KEY `typeStateF_idx` (`typeState`),
  CONSTRAINT `typeStateF` FOREIGN KEY (`typeState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES ('ADM','Administrador','ACT',NULL),('CLI','Cliente','ACT',NULL),('EMP','Empleado','ACT','2021-01-01 00:00:00');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_module`
--

DROP TABLE IF EXISTS `type_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `type_module` (
  `typeCod` char(3) NOT NULL,
  `mdlCod` varchar(45) NOT NULL,
  PRIMARY KEY (`typeCod`,`mdlCod`),
  KEY `mdlCodF_idx` (`mdlCod`),
  CONSTRAINT `mdlCodF` FOREIGN KEY (`mdlCod`) REFERENCES `module` (`mdlCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `typeCodF` FOREIGN KEY (`typeCod`) REFERENCES `type` (`typeCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_module`
--

LOCK TABLES `type_module` WRITE;
/*!40000 ALTER TABLE `type_module` DISABLE KEYS */;
INSERT INTO `type_module` VALUES ('ADM','Acceso'),('ADM','Accesos'),('ADM','Approved'),('CLI','Approved'),('ADM','Canceled'),('CLI','Canceled'),('ADM','cart'),('CLI','cart'),('ADM','cartL'),('CLI','cartL'),('ADM','Categoria'),('ADM','CategoriaS'),('ADM','Change'),('ADM','Checkout'),('CLI','Checkout'),('ADM','Config'),('ADM','Directions'),('ADM','Entrega'),('CLI','Entrega'),('ADM','Entregas'),('ADM','forgot'),('CLI','forgot'),('ADM','Historial'),('ADM','Manejo'),('ADM','Manejos'),('ADM','Modulo'),('ADM','Modulos'),('ADM','Orden'),('CLI','Orden'),('ADM','Ordenes'),('ADM','Pago'),('CLI','Pago'),('ADM','Pagos'),('ADM','Producto'),('ADM','Productos'),('ADM','pwsd'),('ADM','Roles'),('ADM','Start'),('CLI','Start'),('ADM','Status'),('ADM','Statuses'),('ADM','store'),('CLI','store'),('ADM','storeL'),('CLI','storeL'),('ADM','Tipo'),('ADM','Tipos'),('ADM','User'),('ADM','Users');
/*!40000 ALTER TABLE `type_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(80) NOT NULL,
  `userName` varchar(80) DEFAULT NULL,
  `userPswd` varchar(128) NOT NULL,
  `userRgstrd` datetime DEFAULT NULL,
  `userPswdState` char(3) DEFAULT NULL,
  `userPswdExp` datetime DEFAULT NULL,
  `userState` char(3) DEFAULT NULL,
  `userVrfd` varchar(128) DEFAULT NULL,
  `userPswdChg` varchar(128) DEFAULT NULL,
  `userCell` varchar(40) DEFAULT NULL,
  `userLL` datetime DEFAULT NULL,
  `userLM` datetime DEFAULT NULL,
  `userMaxOrder` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`userCod`),
  UNIQUE KEY `userMail_UNIQUE` (`userEmail`),
  KEY `userState_idx` (`userState`),
  KEY `userPswdStateF_idx` (`userPswdState`),
  CONSTRAINT `userPswdStateF` FOREIGN KEY (`userPswdState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userStateF` FOREIGN KEY (`userState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin@demo.com','Administrador','45348d66cacfe76ea14c3c0490788567','2020-08-04 22:52:41','ACT','2021-08-04 22:52:41','ACT','0',NULL,'',NULL,NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `typeCodUT` char(3) NOT NULL,
  `userCodUT` bigint(10) unsigned NOT NULL,
  `userTypeState` char(3) DEFAULT NULL,
  `userTypeExp` datetime DEFAULT NULL,
  `userTypeRgstrd` datetime DEFAULT NULL,
  PRIMARY KEY (`typeCodUT`,`userCodUT`),
  KEY `userCod_idx` (`userCodUT`),
  KEY `userTypeState_idx` (`userTypeState`),
  CONSTRAINT `typeCodUTF` FOREIGN KEY (`typeCodUT`) REFERENCES `type` (`typeCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userCodUTF` FOREIGN KEY (`userCodUT`) REFERENCES `user` (`userCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `userTypeStateF` FOREIGN KEY (`userTypeState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES ('ADM',1,'ACT',NULL,'2020-08-04 22:52:41'),('CLI',2,'ACT',NULL,'2020-08-05 01:22:01');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variation`
--

DROP TABLE IF EXISTS `variation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `variation` (
  `variationCod` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `prdCod` bigint(10) unsigned DEFAULT NULL,
  `variationPrice` decimal(16,2) DEFAULT NULL,
  `variationQuantity` int(10) unsigned DEFAULT NULL,
  `variationState` char(3) DEFAULT NULL,
  PRIMARY KEY (`variationCod`),
  KEY `prdCodF_idx` (`prdCod`),
  KEY `variationState_idx` (`variationState`),
  CONSTRAINT `prdCodFF` FOREIGN KEY (`prdCod`) REFERENCES `product` (`prdCod`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `variationState` FOREIGN KEY (`variationState`) REFERENCES `state` (`stateCod`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variation`
--

LOCK TABLES `variation` WRITE;
/*!40000 ALTER TABLE `variation` DISABLE KEYS */;
/*!40000 ALTER TABLE `variation` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-05 18:20:13
