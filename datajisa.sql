-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: jisa
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Dumping data for table `aeropuertos`
--

LOCK TABLES `aeropuertos` WRITE;
/*!40000 ALTER TABLE `aeropuertos` DISABLE KEYS */;
INSERT INTO `aeropuertos` VALUES (1,'Cusco / Cusco','CUZ','Aeropuerto Internacional Alejandro Velasco Astete','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'Iquitos / Loreto','IQT','Aeropuerto Internacional Coronel FAP Francisco Secada Vignetta','2024-08-12 15:38:22','2024-08-12 15:38:22'),(3,'Lima / Callao	Callao','LIM','Aeropuerto Internacional Jorge Chávez','2024-08-12 15:38:22','2024-08-12 15:38:22'),(4,'Arequipa / Arequipa','AQP','Aeropuerto Internacional Rodríguez Ballón','2024-08-12 15:38:22','2024-08-12 15:38:22'),(5,'Piura / Piura','PIU','Aeropuerto Internacional Cap. FAP Guillermo Concha Iberico','2024-08-12 15:38:22','2024-08-12 15:38:22'),(6,'Ayacucho / Ayacucho','AYP','Aeropuerto Coronel FAP Alfredo Mendívil Duarte','2024-08-12 15:38:22','2024-08-12 15:38:22'),(7,'Cajamarca / Cajamarca','CJA','Aeropuerto Mayor General FAP Armando Revoredo Iglesias','2024-08-12 15:38:22','2024-08-12 15:38:22'),(8,'Juliaca / Puno','JUL','Aeropuerto Internacional Inca Manco Cápac','2024-08-12 15:38:22','2024-08-12 15:38:22'),(9,'Puerto Maldonado / Madre de Dios','PEM','Aeropuerto Internacional Padre Aldamiz','2024-08-12 15:38:22','2024-08-12 15:38:22'),(10,'Tacna / Tacna','TCQ','Aeropuerto Internacional Crnl. FAP Carlos Ciriani Santa Rosa','2024-08-12 15:38:22','2024-08-12 15:38:22'),(11,'Tarapoto / San Martín','TPP','Aeropuerto Cad. FAP Guillermo del Castillo Paredes','2024-08-12 15:38:22','2024-08-12 15:38:22'),(12,'Trujillo / La Libertad','TRU','Aeropuerto Internacional Cap. FAP Carlos Martínez de Pinillos','2024-08-12 15:38:22','2024-08-12 15:38:22'),(13,'Tumbes / Tumbes','TBP','AeropuertoCap. FAP Pedro Canga Rodríguez','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `aeropuertos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'SERVICIOS',NULL,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(2,'HOTEL',NULL,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(3,'VUELO',NULL,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(4,'OTROS',NULL,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(5,'TOURS',1,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(6,'RECOJOS',1,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(7,'UNA ESTRELLA',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(8,'DOS ESTRELLAS',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(9,'TRES ESTRELLAS',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(10,'CUATRO ESTRELLAS',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(11,'CINCO ESTRELLAS',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(12,'BOUTIQUE',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','0'),(13,'TRANSPORTE',4,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(14,'ALIMENTACION',4,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(15,'GUIA',4,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(16,'OTROS',4,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(17,'TICKETS',4,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1'),(18,'AGENCIAS',5,'1','2024-08-12 15:38:22','2024-08-12 15:38:22','1');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'A.V.T. JISA ADVENTURE E.I.R.L.','20600769317','CAL. GARCUKASI NRO. 265 INT. 12','48507551','Goptics2024',NULL,NULL,'CUSCO','CUSCO','CUSCO','080101','0','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cuotas`
--

LOCK TABLES `cuotas` WRITE;
/*!40000 ALTER TABLE `cuotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `cuotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cupons`
--

LOCK TABLES `cupons` WRITE;
/*!40000 ALTER TABLE `cupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `cupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_liquidacions`
--

LOCK TABLES `detalle_liquidacions` WRITE;
/*!40000 ALTER TABLE `detalle_liquidacions` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_liquidacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_paquete_incluyes`
--

LOCK TABLES `detalle_paquete_incluyes` WRITE;
/*!40000 ALTER TABLE `detalle_paquete_incluyes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_paquete_incluyes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_paquete_no_incluyes`
--

LOCK TABLES `detalle_paquete_no_incluyes` WRITE;
/*!40000 ALTER TABLE `detalle_paquete_no_incluyes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_paquete_no_incluyes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_paquetes`
--

LOCK TABLES `detalle_paquetes` WRITE;
/*!40000 ALTER TABLE `detalle_paquetes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_paquetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_reserva_incluyes`
--

LOCK TABLES `detalle_reserva_incluyes` WRITE;
/*!40000 ALTER TABLE `detalle_reserva_incluyes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_reserva_incluyes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_reserva_no_incluyes`
--

LOCK TABLES `detalle_reserva_no_incluyes` WRITE;
/*!40000 ALTER TABLE `detalle_reserva_no_incluyes` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_reserva_no_incluyes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_reservas`
--

LOCK TABLES `detalle_reservas` WRITE;
/*!40000 ALTER TABLE `detalle_reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_ventas`
--

LOCK TABLES `detalle_ventas` WRITE;
/*!40000 ALTER TABLE `detalle_ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `documento_sunats`
--

LOCK TABLES `documento_sunats` WRITE;
/*!40000 ALTER TABLE `documento_sunats` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento_sunats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (1,'DNI','48507551','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'DNI','74890811','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'BOLETA DE VENTA ELECTRÓNICA',1,0,'BV','03','B001','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'FACTURA ELECTRÓNICA',1,0,'F','01','F001','2024-08-12 15:38:22','2024-08-12 15:38:22'),(3,'NOTA DE CRÉDITO',1,0,'BV','07','BC01','2024-08-12 15:38:22','2024-08-12 15:38:22'),(4,'NOTA DE CRÉDITO',1,0,'F','07','FC01','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `etiqueta_servicio`
--

LOCK TABLES `etiqueta_servicio` WRITE;
/*!40000 ALTER TABLE `etiqueta_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `etiqueta_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `etiquetas`
--

LOCK TABLES `etiquetas` WRITE;
/*!40000 ALTER TABLE `etiquetas` DISABLE KEYS */;
/*!40000 ALTER TABLE `etiquetas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `guias`
--

LOCK TABLES `guias` WRITE;
/*!40000 ALTER TABLE `guias` DISABLE KEYS */;
INSERT INTO `guias` VALUES (1,'DAVID MIRANDA TARCO','982733597','dmirandatarco@gmail.com','Av Lechugal 213','/storage/usuario/default.png',2,1,'1','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `guias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `horarios`
--

LOCK TABLES `horarios` WRITE;
/*!40000 ALTER TABLE `horarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `incidencias`
--

LOCK TABLES `incidencias` WRITE;
/*!40000 ALTER TABLE `incidencias` DISABLE KEYS */;
/*!40000 ALTER TABLE `incidencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `incluye`
--

LOCK TABLES `incluye` WRITE;
/*!40000 ALTER TABLE `incluye` DISABLE KEYS */;
INSERT INTO `incluye` VALUES (9,12,1),(10,12,2),(11,12,3),(12,12,4),(13,12,5),(14,12,6),(15,12,7),(16,12,8),(17,14,1),(18,14,2),(19,14,3),(20,14,4),(21,14,5),(22,14,6),(23,14,8),(24,14,14),(25,19,2),(26,19,3),(27,19,4),(28,19,5),(29,19,6),(30,19,7),(31,19,16),(32,19,1),(33,19,2),(34,19,3),(35,19,4),(36,19,5),(37,19,6),(38,19,7),(39,19,8),(40,20,2),(41,20,3),(42,20,4),(43,20,5),(44,20,6),(45,20,7),(46,20,16),(47,20,1),(48,20,2),(49,20,3),(50,20,4),(51,20,5),(52,20,6),(53,20,7),(54,20,8),(55,21,1),(56,21,2),(57,21,3),(58,21,4),(59,21,5),(60,21,6),(61,21,7),(62,21,8),(63,23,2),(64,23,3),(65,23,4),(66,23,6),(67,23,22),(68,24,3),(69,24,4),(70,24,6),(71,24,22),(72,28,3),(73,28,25),(74,28,26),(75,28,27),(76,32,3),(77,32,4),(78,32,6),(79,32,16),(80,32,29),(81,32,30),(82,32,31),(83,35,2),(84,35,4),(85,35,6),(86,35,33),(87,37,2),(88,37,4),(89,37,6),(90,37,33),(91,39,2),(92,39,4),(93,39,6),(94,39,33),(95,40,2),(96,40,4),(97,40,6),(98,40,16),(99,40,33),(100,41,2),(101,41,4),(102,41,6),(103,41,16),(104,41,33),(112,49,2),(113,49,4),(114,49,6),(115,49,33),(116,49,42),(117,49,43),(118,49,44),(119,49,47),(120,50,2),(121,50,4),(122,50,6),(123,50,16),(124,50,22),(125,50,33),(126,50,43),(127,58,2),(128,58,4),(129,58,6),(130,58,33),(131,58,51),(132,58,52),(133,58,53),(134,58,54),(135,58,55),(136,58,56),(137,58,57),(138,59,2),(139,59,4),(140,59,6),(141,59,33),(142,59,51),(143,59,52),(144,59,53),(145,59,54),(146,59,55),(147,59,56),(148,59,57),(149,62,2),(150,62,4),(151,62,33),(152,62,51),(153,62,53),(154,62,55),(155,62,59),(156,62,60),(157,70,2),(158,70,4),(159,70,6),(160,70,33),(161,70,51),(162,70,52),(163,70,54),(164,70,55),(165,70,62),(166,70,63),(167,70,4),(168,70,33),(169,70,64),(170,70,65),(171,70,66),(172,70,67),(173,71,2),(174,71,4),(175,71,6),(176,71,33),(177,71,51),(178,71,52),(179,71,54),(180,71,55),(181,71,62),(182,71,63),(183,71,4),(184,71,33),(185,71,64),(186,71,65),(187,71,66),(188,71,67),(189,73,2),(190,73,4),(191,73,5),(192,73,6),(193,73,33),(194,73,51),(195,73,53),(196,73,54),(197,73,55),(198,73,59),(199,73,70),(200,75,2),(201,75,4),(202,75,6),(203,75,33),(204,75,51),(205,75,52),(206,75,54),(207,75,55),(208,75,59),(209,75,72),(210,89,74),(211,89,75),(212,89,76),(213,89,77),(214,89,78),(215,89,79),(216,89,76),(217,89,81),(218,89,82),(219,89,83),(220,89,84),(221,89,85),(222,90,74),(223,90,75),(224,90,76),(225,90,77),(226,90,78),(227,90,79),(228,90,76),(229,90,81),(230,90,82),(231,90,83),(232,90,84),(233,90,85),(234,91,74),(235,91,75),(236,91,76),(237,91,77),(238,91,78),(239,91,79),(240,91,76),(241,91,81),(242,91,82),(243,91,83),(244,91,84),(245,91,85),(246,92,74),(247,92,75),(248,92,76),(249,92,77),(250,92,78),(251,92,79),(266,95,2),(267,95,3),(268,95,4),(269,95,6),(270,95,42),(271,95,43),(272,95,44),(273,95,48);
/*!40000 ALTER TABLE `incluye` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `itinerario_reservas`
--

LOCK TABLES `itinerario_reservas` WRITE;
/*!40000 ALTER TABLE `itinerario_reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `itinerario_reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `itinerarios`
--

LOCK TABLES `itinerarios` WRITE;
/*!40000 ALTER TABLE `itinerarios` DISABLE KEYS */;
INSERT INTO `itinerarios` VALUES (1,1,1,'storage/template/default.png','2024-08-12 15:40:16','2024-08-12 15:40:16'),(2,2,1,'storage/template/default.png','2024-08-12 15:40:27','2024-08-12 15:40:27'),(3,3,1,'storage/template/default.png','2024-08-12 15:40:43','2024-08-12 15:40:43'),(4,4,1,'storage/template/default.png','2024-08-12 15:40:54','2024-08-12 15:40:54'),(5,5,1,'storage/template/default.png','2024-08-12 15:41:05','2024-08-12 15:41:05'),(6,6,1,'storage/template/default.png','2024-08-12 15:41:17','2024-08-12 15:41:17'),(7,7,1,'storage/template/default.png','2024-08-12 15:41:33','2024-08-12 15:41:33'),(8,8,1,'storage/template/default.png','2024-08-12 15:41:45','2024-08-12 15:41:45'),(9,9,1,'storage/template/default.png','2024-08-12 15:41:56','2024-08-12 15:41:56'),(10,10,1,'storage/template/default.png','2024-08-12 15:42:07','2024-08-12 15:42:07'),(12,13,1,'storage/template/full-day-machu-picchu-en-tren-turistico-expedition-o-voyager0.png','2024-08-12 15:47:13','2024-08-12 15:47:13'),(13,14,1,'storage/template/default.png','2024-08-12 15:52:23','2024-08-12 15:52:23'),(14,15,1,'storage/template/full-day-machu-picchu-en-tren-turistico-observatorio-y-expedition0.png','2024-08-12 15:55:06','2024-08-12 15:55:06'),(15,16,1,'storage/template/default.png','2024-08-12 15:56:59','2024-08-12 15:56:59'),(16,17,1,'storage/template/default.png','2024-08-12 15:57:17','2024-08-12 15:57:17'),(17,18,1,'storage/template/default.png','2024-08-12 15:57:30','2024-08-12 15:57:30'),(18,19,1,'storage/template/default.png','2024-08-12 15:57:42','2024-08-12 15:57:42'),(19,20,1,'storage/template/machu-picchu-2d1n-con-valle-sagrado-en-tren-turistico0.png','2024-08-12 16:04:10','2024-08-12 16:04:10'),(20,20,2,'storage/template/machu-picchu-2d1n-con-valle-sagrado-en-tren-turistico1.png','2024-08-12 16:04:11','2024-08-12 16:04:11'),(21,21,1,'storage/template/machu-picchu-2d1n-en-tren-turistico-expedition-o-voyager0.png','2024-08-12 16:07:38','2024-08-12 16:07:38'),(22,22,1,'storage/template/default.png','2024-08-12 16:12:03','2024-08-12 16:12:03'),(23,23,1,'storage/template/city-tour-lima-colonial-y-moderna0.png','2024-08-12 16:21:17','2024-08-12 16:21:17'),(24,24,1,'storage/template/circuito-magico-del-agua0.png','2024-08-12 16:24:34','2024-08-12 16:24:34'),(25,25,1,'storage/template/default.png','2024-08-12 16:25:34','2024-08-12 16:25:34'),(26,26,1,'storage/template/default.png','2024-08-12 16:25:53','2024-08-12 16:25:53'),(27,27,1,'storage/template/default.png','2024-08-12 16:26:06','2024-08-12 16:26:06'),(28,28,1,'storage/template/clasicos-de-la-gastronomia-peruana-en-barranco0.png','2024-08-12 16:28:24','2024-08-12 16:28:24'),(29,29,1,'storage/template/default.png','2024-08-12 16:28:55','2024-08-12 16:28:55'),(30,30,1,'storage/template/default.png','2024-08-12 16:29:06','2024-08-12 16:29:06'),(31,31,1,'storage/template/default.png','2024-08-12 16:29:18','2024-08-12 16:29:18'),(32,32,1,'storage/template/pachacamac-y-caballos-de-paso0.png','2024-08-12 16:32:35','2024-08-12 16:32:35'),(33,33,1,'storage/template/default.png','2024-08-12 16:44:44','2024-08-12 16:44:44'),(34,34,1,'storage/template/default.png','2024-08-12 16:44:59','2024-08-12 16:44:59'),(35,35,1,'storage/template/city-tour-cusco-4-ruinas-templo-del-sol-turno-dia0.png','2024-08-12 16:53:43','2024-08-12 16:53:43'),(36,36,1,'storage/template/default.png','2024-08-12 16:54:10','2024-08-12 16:54:10'),(37,37,1,'storage/template/tour-valle-sur0.png','2024-08-12 16:56:55','2024-08-12 16:56:55'),(38,38,1,'storage/template/default.png','2024-08-12 16:57:27','2024-08-12 16:57:27'),(39,39,1,'storage/template/tour-chinchero-maras-y-moray0.png','2024-08-12 16:59:38','2024-08-12 16:59:38'),(40,40,1,'storage/template/fd-valle-sagrado-tradicional0.png','2024-08-12 17:03:11','2024-08-12 17:03:11'),(41,41,1,'storage/template/fd-valle-sagrado-completo0.png','2024-08-12 17:05:32','2024-08-12 17:05:32'),(42,42,1,'storage/template/default.png','2024-08-12 17:06:01','2024-08-12 17:06:01'),(43,43,1,'storage/template/default.png','2024-08-12 17:06:12','2024-08-12 17:06:12'),(44,44,1,'storage/template/default.png','2024-08-12 17:06:23','2024-08-12 17:06:23'),(45,45,1,'storage/template/default.png','2024-08-12 17:06:33','2024-08-12 17:06:33'),(47,47,1,'storage/template/default.png','2024-08-12 17:10:54','2024-08-12 17:10:54'),(48,48,1,'storage/template/default.png','2024-08-12 17:11:08','2024-08-12 17:11:08'),(49,49,1,'storage/template/montana-de-colores-desayuno-almuerzo0.png','2024-08-12 17:14:00','2024-08-12 17:14:00'),(50,50,1,'storage/template/tour-palccoyo0.png','2024-08-12 17:18:04','2024-08-12 17:18:04'),(51,51,1,'storage/template/default.png','2024-08-12 17:19:35','2024-08-12 17:19:35'),(52,52,1,'storage/template/default.png','2024-08-12 17:19:57','2024-08-12 17:19:57'),(53,53,1,'storage/template/default.png','2024-08-12 17:20:08','2024-08-12 17:20:08'),(54,54,1,'storage/template/default.png','2024-08-12 17:20:19','2024-08-12 17:20:19'),(55,55,1,'storage/template/default.png','2024-08-12 17:20:31','2024-08-12 17:20:31'),(56,56,1,'storage/template/default.png','2024-08-12 17:20:52','2024-08-12 17:20:52'),(57,57,1,'storage/template/default.png','2024-08-12 17:21:05','2024-08-12 17:21:05'),(58,58,1,'storage/template/viaje-a-paracas-y-desierto-de-huacachina0.png','2024-08-12 17:26:43','2024-08-12 17:26:43'),(59,58,2,'storage/template/viaje-a-paracas-y-desierto-de-huacachina1.png','2024-08-12 17:26:44','2024-08-12 17:26:44'),(60,59,1,'storage/template/default.png','2024-08-12 17:28:20','2024-08-12 17:28:20'),(61,60,1,'storage/template/default.png','2024-08-12 17:28:52','2024-08-12 17:28:52'),(62,61,1,'storage/template/desierto-de-huacachina-vinedo0.png','2024-08-12 17:31:52','2024-08-12 17:31:52'),(63,62,1,'storage/template/default.png','2024-08-12 17:33:59','2024-08-12 17:33:59'),(64,63,1,'storage/template/default.png','2024-08-12 17:34:41','2024-08-12 17:34:41'),(65,64,1,'storage/template/default.png','2024-08-12 17:35:15','2024-08-12 17:35:15'),(66,65,1,'storage/template/default.png','2024-08-12 17:35:25','2024-08-12 17:35:25'),(67,66,1,'storage/template/default.png','2024-08-12 17:35:49','2024-08-12 17:35:49'),(68,67,1,'storage/template/default.png','2024-08-12 17:36:01','2024-08-12 17:36:01'),(69,68,1,'storage/template/default.png','2024-08-12 17:36:23','2024-08-12 17:36:23'),(70,69,1,'storage/template/paracas-ica-nazca-2d-1n0.png','2024-08-12 17:46:08','2024-08-12 17:46:08'),(71,69,2,'storage/template/paracas-ica-nazca-2d-1n1.png','2024-08-12 17:46:09','2024-08-12 17:46:09'),(72,70,1,'storage/template/default.png','2024-08-12 17:47:16','2024-08-12 17:47:16'),(73,71,1,'storage/template/paracas-ica-huacachina-vinedo0.png','2024-08-12 17:50:26','2024-08-12 17:50:26'),(74,72,1,'storage/template/default.png','2024-08-12 17:50:56','2024-08-12 17:50:56'),(75,73,1,'storage/template/full-day-paracas-y-desierto-de-huacachina0.png','2024-08-12 17:55:26','2024-08-12 17:55:26'),(76,74,1,'storage/template/default.png','2024-08-12 18:00:34','2024-08-12 18:00:34'),(77,75,1,'storage/template/default.png','2024-08-12 18:00:44','2024-08-12 18:00:44'),(78,76,1,'storage/template/default.png','2024-08-12 18:01:00','2024-08-12 18:01:00'),(79,77,1,'storage/template/default.png','2024-08-12 18:01:20','2024-08-12 18:01:20'),(80,78,1,'storage/template/default.png','2024-08-12 18:01:35','2024-08-12 18:01:35'),(81,79,1,'storage/template/default.png','2024-08-12 18:02:02','2024-08-12 18:02:02'),(82,80,1,'storage/template/default.png','2024-08-12 18:02:16','2024-08-12 18:02:16'),(83,81,1,'storage/template/default.png','2024-08-12 18:02:59','2024-08-12 18:02:59'),(84,82,1,'storage/template/default.png','2024-08-12 18:03:24','2024-08-12 18:03:24'),(85,83,1,'storage/template/default.png','2024-08-12 18:03:35','2024-08-12 18:03:35'),(86,84,1,'storage/template/default.png','2024-08-12 18:03:47','2024-08-12 18:03:47'),(87,85,1,'storage/template/default.png','2024-08-12 18:03:57','2024-08-12 18:03:57'),(88,86,1,'storage/template/default.png','2024-08-12 18:04:08','2024-08-12 18:04:08'),(89,87,1,'storage/template/conexion-a-puno-03-dias-02-noches0.png','2024-08-12 18:12:51','2024-08-12 18:12:51'),(90,87,2,'storage/template/conexion-a-puno-03-dias-02-noches1.png','2024-08-12 18:12:51','2024-08-12 18:12:51'),(91,87,3,'storage/template/conexion-a-puno-03-dias-02-noches2.png','2024-08-12 18:12:52','2024-08-12 18:12:52'),(92,88,1,'storage/template/ruta-del-sol0.png','2024-08-12 18:15:19','2024-08-12 18:15:19'),(95,46,1,'storage/template/full-day-laguna-humantay0.png','2024-08-12 20:53:59','2024-08-12 20:53:59'),(96,89,1,'storage/template/translado-de-aeropuerto-lima-a-hotel0.png','2024-08-13 15:13:51','2024-08-13 15:13:51'),(97,90,1,'storage/template/traslado-del-hotel-apto-lima-traslado-de-apto-cusco-hotel0.png','2024-08-13 15:15:05','2024-08-13 15:15:05'),(98,91,1,'storage/template/traslado-del-hotel-apto-cusco0.png','2024-08-13 15:15:55','2024-08-13 15:15:55');
/*!40000 ALTER TABLE `itinerarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `liquidacions`
--

LOCK TABLES `liquidacions` WRITE;
/*!40000 ALTER TABLE `liquidacions` DISABLE KEYS */;
/*!40000 ALTER TABLE `liquidacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `medios`
--

LOCK TABLES `medios` WRITE;
/*!40000 ALTER TABLE `medios` DISABLE KEYS */;
INSERT INTO `medios` VALUES (1,'EFECTIVO',NULL,NULL,NULL,0,'EFECTIVO',1,'1','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'EFECTIVO',NULL,NULL,NULL,0,'EFECTIVO',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22'),(3,'IZIPAY',NULL,NULL,NULL,0,'IZIPAY',2,'1','2024-08-12 15:38:22','2024-08-12 15:38:22'),(4,'IZIPAY',NULL,NULL,NULL,0,'IZIPAY',1,'1','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `medios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--


--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `monedas`
--

LOCK TABLES `monedas` WRITE;
/*!40000 ALTER TABLE `monedas` DISABLE KEYS */;
INSERT INTO `monedas` VALUES (1,'S/','SOLES','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'$','DOLARES','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `monedas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `noincluye`
--

LOCK TABLES `noincluye` WRITE;
/*!40000 ALTER TABLE `noincluye` DISABLE KEYS */;
INSERT INTO `noincluye` VALUES (1,12,9),(2,12,10),(3,14,9),(4,14,10),(5,19,9),(6,19,17),(7,19,18),(8,19,19),(9,19,9),(10,19,10),(11,20,9),(12,20,17),(13,20,18),(14,20,19),(15,20,9),(16,20,10),(17,21,9),(18,21,10),(19,23,9),(20,23,10),(21,24,9),(22,24,10),(23,28,9),(24,32,9),(25,35,9),(26,35,10),(27,35,18),(28,35,19),(29,35,34),(30,37,9),(31,37,10),(32,37,18),(33,37,19),(34,37,36),(35,39,18),(36,39,19),(37,39,38),(38,40,9),(39,40,18),(40,40,19),(41,41,9),(42,41,18),(43,41,19),(44,41,38),(47,49,9),(48,49,45),(49,50,9),(50,50,45),(51,58,9),(52,58,10),(53,59,9),(54,59,10),(55,62,9),(56,62,10),(57,70,9),(58,70,10),(59,70,9),(60,70,10),(61,70,68),(62,71,9),(63,71,10),(64,71,9),(65,71,10),(66,71,68),(67,73,9),(68,73,10),(69,75,9),(70,75,10),(71,89,10),(72,89,80),(73,89,80),(74,89,86),(75,90,10),(76,90,80),(77,90,80),(78,90,86),(79,91,10),(80,91,80),(81,91,80),(82,91,86),(83,92,80),(88,95,9),(89,95,45);
/*!40000 ALTER TABLE `noincluye` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `notificacions`
--

LOCK TABLES `notificacions` WRITE;
/*!40000 ALTER TABLE `notificacions` DISABLE KEYS */;
/*!40000 ALTER TABLE `notificacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `operar_detalle_reservas`
--

LOCK TABLES `operar_detalle_reservas` WRITE;
/*!40000 ALTER TABLE `operar_detalle_reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `operar_detalle_reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `operar_pasajeros`
--

LOCK TABLES `operar_pasajeros` WRITE;
/*!40000 ALTER TABLE `operar_pasajeros` DISABLE KEYS */;
/*!40000 ALTER TABLE `operar_pasajeros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `operar_servicios`
--

LOCK TABLES `operar_servicios` WRITE;
/*!40000 ALTER TABLE `operar_servicios` DISABLE KEYS */;
/*!40000 ALTER TABLE `operar_servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `operars`
--

LOCK TABLES `operars` WRITE;
/*!40000 ALTER TABLE `operars` DISABLE KEYS */;
/*!40000 ALTER TABLE `operars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES (1,'AF','Afganistán','69','Afghan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'AX','Islas Åland','134','Åland Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(3,'AL','Albania','135','Albanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(4,'DZ','Argelia','48','Algerian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(5,'US','Estados Unidos','207','American','2024-08-12 15:38:22','2024-08-12 15:38:22'),(6,'AD','Andorra','137','Andorran','2024-08-12 15:38:22','2024-08-12 15:38:22'),(7,'AO','Angola','41','Angolan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(8,'AI','Anguila','213','Anguillian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(9,'AQ','Antártida','214','Antarctican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(10,'AG','Antigua y Barbuda','208','Antiguan and Barbudan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(11,'AN','Antillas Holandesas','119','Antillean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(12,'AR','Argentina','212','Argentinian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(13,'AM','Armenia','182','Armenian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(14,'AW','Aruba','217','Aruban','2024-08-12 15:38:22','2024-08-12 15:38:22'),(15,'AU','Australia','90','Australian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(16,'AT','Austria','139','Austrian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(17,'AZ','Azerbaiyán','185','Azerbaijani','2024-08-12 15:38:22','2024-08-12 15:38:22'),(18,'BS','Bahamas','204','Bahamian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(19,'BH','Baréin','183','Bahraini','2024-08-12 15:38:22','2024-08-12 15:38:22'),(20,'BD','Bangladés','70','Bangladeshi','2024-08-12 15:38:22','2024-08-12 15:38:22'),(21,'BB','Barbados','205','Barbadian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(22,'LS','Lesoto','8','Basotho','2024-08-12 15:38:22','2024-08-12 15:38:22'),(23,'BY','Bielorrusia','136','Belarusian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(24,'BE','Bélgica','138','Belgian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(25,'BZ','Belice','113','Belizean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(26,'BJ','Benín','42','Beninese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(27,'BM','Bermudas','202','Bermudian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(28,'BT','Bután','56','Bhutanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(29,'BO','Bolivia','218','Bolivian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(30,'BA','Bosnia y Herzegovina','143','Bosnian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(31,'BW','Botsuana','44','Botswanan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(32,'BV','Isla Bouvet','110','Bouvet Island','2024-08-12 15:38:22','2024-08-12 15:38:22'),(33,'BR','Brasil','215','Brazilian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(34,'GB','Reino Unido','1','British','2024-08-12 15:38:22','2024-08-12 15:38:22'),(35,'IO','Territorio Británico del Océano Índico','62','British Indian Ocean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(36,'BN','Brunéi','61','Bruneian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(37,'BG','Bulgaria','144','Bulgarian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(38,'BF','Burkina Faso','52','Burkinabe','2024-08-12 15:38:22','2024-08-12 15:38:22'),(39,'MM','Birmania','76','Burmese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(40,'BI','Burundi','45','Burundian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(41,'KH','Camboya','72','Cambodian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(42,'CM','Camerún','49','Cameroonian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(43,'CA','Canadá','203','Canadian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(44,'CV','Cabo Verde','51','Cape Verdean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(45,'KY','Islas Caimán','107','Caymanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(46,'CF','República Centroafricana','53','Central African','2024-08-12 15:38:22','2024-08-12 15:38:22'),(47,'TD','Chad','50','Chadian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(48,'JE','Islas del Canal','151','Channel Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(49,'CL','Chile','210','Chilean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(50,'CN','China','77','Chinese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(51,'CX','Isla de Navidad','63','Christmas Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(52,'CC','Islas Cocos','81','Cocos Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(53,'CO','Colombia','216','Colombian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(54,'KM','Comoras','43','Comorian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(55,'CG','Congo','46','Congolese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(56,'CK','Islas Cook','88','Cook Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(57,'CR','Costa Rica','112','Costa Rican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(58,'HR','Croacia','147','Croatian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(59,'CU','Cuba','108','Cuban','2024-08-12 15:38:22','2024-08-12 15:38:22'),(60,'CY','Chipre','146','Cypriot','2024-08-12 15:38:22','2024-08-12 15:38:22'),(61,'CZ','República Checa','148','Czech','2024-08-12 15:38:22','2024-08-12 15:38:22'),(62,'DK','Dinamarca','153','Danish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(63,'DJ','Yibuti','236','Djiboutian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(64,'DM','Dominica','106','Dominican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(65,'TL','Timor Oriental','85','East Timorese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(66,'EC','Ecuador','211','Ecuadorian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(67,'EG','Egipto','54','Egyptian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(68,'AE','Emiratos Árabes Unidos','199','Emiratis','2024-08-12 15:38:22','2024-08-12 15:38:22'),(69,'GQ','Guinea Ecuatorial','219','Equatoguinean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(70,'ER','Eritrea','40','Eritrean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(71,'EE','Estonia','157','Estonian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(72,'ET','Etiopía','39','Ethiopian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(73,'FK','Islas Malvinas','220','Falkland Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(74,'FO','Islas Feroe','141','Faroese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(75,'FJ','Fiyi','89','Fijian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(76,'PH','Filipinas','79','Filipino','2024-08-12 15:38:22','2024-08-12 15:38:22'),(77,'FI','Finlandia','142','Finnish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(78,'FR','Francia','125','French','2024-08-12 15:38:22','2024-08-12 15:38:22'),(79,'PF','Polinesia Francesa','104','French Polynesian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(80,'GA','Gabón','4','Gabonese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(81,'GM','Gambia','37','Gambian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(82,'GE','Georgia','184','Georgian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(83,'DE','Alemania','145','German','2024-08-12 15:38:22','2024-08-12 15:38:22'),(84,'GH','Ghana','7','Ghanaian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(85,'GI','Gibraltar','149','Gibraltarian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(86,'GR','Grecia','150','Greek','2024-08-12 15:38:22','2024-08-12 15:38:22'),(87,'GL','Groenlandia','209','Greenlandic','2024-08-12 15:38:22','2024-08-12 15:38:22'),(88,'GD','Granada','222','Grenadian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(89,'GP','Guadalupe','223','Guadeloupean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(90,'GU','Guam','224','Guamanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(91,'GT','Guatemala','111','Guatemalan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(92,'GY','Guyana','221','Guianese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(93,'GW','Guinea-Bisáu','3','Guinea-Bissau national','2024-08-12 15:38:22','2024-08-12 15:38:22'),(94,'GN','Guinea','38','Guinean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(95,'GY','Guyana','226','Guyanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(96,'HT','Haití','114','Haitian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(97,'HM','Islas Heard y McDonald','115','Heard and McDonald Island','2024-08-12 15:38:22','2024-08-12 15:38:22'),(98,'HN','Honduras','116','Honduran','2024-08-12 15:38:22','2024-08-12 15:38:22'),(99,'HK','Hong Kong','64','Hong Kong Chinese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(100,'HU','Hungría','152','Hungarian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(101,'IS','Islandia','154','Icelandic','2024-08-12 15:38:22','2024-08-12 15:38:22'),(102,'KI','Kiribati','92','I-Kiribati','2024-08-12 15:38:22','2024-08-12 15:38:22'),(103,'IN','India','65','Indian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(104,'ID','Indonesia','66','Indonesian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(105,'IR','Irán','59','Iranian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(106,'IQ','Irak','67','Iraqi','2024-08-12 15:38:22','2024-08-12 15:38:22'),(107,'IE','Irlanda','155','Irish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(108,'IL','Israel','186','Israeli','2024-08-12 15:38:22','2024-08-12 15:38:22'),(109,'IT','Italia','156','Italian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(110,'CI','Costa de Marfil','6','Ivorian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(111,'JM','Jamaica','105','Jamaican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(112,'JP','Japón','55','Japanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(113,'JO','Jordania','188','Jordanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(114,'KZ','Kazajistán','193','Kazakh','2024-08-12 15:38:22','2024-08-12 15:38:22'),(115,'KE','Kenia','5','Kenyan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(116,'KW','Kuwait','189','Kuwaiti','2024-08-12 15:38:22','2024-08-12 15:38:22'),(117,'KG','Kirguistán','190','Kyrgyz','2024-08-12 15:38:22','2024-08-12 15:38:22'),(118,'LA','Laos','73','Lao','2024-08-12 15:38:22','2024-08-12 15:38:22'),(119,'LV','Letonia','158','Latvian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(120,'LB','Líbano','187','Lebanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(121,'LR','Liberia','9','Liberian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(122,'LY','Libia','11','Libyan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(123,'LI','Liechtenstein','159','Liechtensteiner','2024-08-12 15:38:22','2024-08-12 15:38:22'),(124,'LT','Lituania','160','Lithuanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(125,'LU','Luxemburgo','162','Luxembourgish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(126,'MO','Macao','74','Macanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(127,'MK','Macedonia del Norte','166','Macedonian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(128,'YT','Mayotte','118','Mahorais','2024-08-12 15:38:22','2024-08-12 15:38:22'),(129,'MG','Madagascar','14','Malagasy','2024-08-12 15:38:22','2024-08-12 15:38:22'),(130,'MW','Malaui','15','Malawian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(131,'MY','Malasia','82','Malaysian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(132,'MV','Maldivas','58','Maldivian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(133,'ML','Malí','23','Malian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(134,'MT','Malta','167','Maltese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(135,'MH','Islas Marshall','225','Marshallese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(136,'MQ','Martinica','117','Martinican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(137,'MR','Mauritania','16','Mauritanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(138,'MU','Mauricio','17','Mauritian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(139,'MX','México','206','Mexican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(140,'FM','Micronesia','91','Micronesian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(141,'MD','Moldavia','161','Moldovan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(142,'MC','Mónaco','168','Monegasque','2024-08-12 15:38:22','2024-08-12 15:38:22'),(143,'MN','Mongolia','68','Mongolian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(144,'ME','Montenegro','163','Montenegrian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(145,'MS','Montserrat','122','Montserratian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(146,'MA','Marruecos','20','Moroccan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(147,'MZ','Mozambique','21','Mozambican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(148,'NA','Namibia','19','Namibian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(149,'NR','Nauru','94','Nauruan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(150,'NP','Nepal','80','Nepalese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(151,'NL','Países Bajos','164','Netherlander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(152,'NC','Nueva Caledonia','93','New Caledonian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(153,'NZ','Nueva Zelanda','99','New Zealander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(154,'NI','Nicaragua','120','Nicaraguan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(155,'NG','Nigeria','25','Nigerian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(156,'NE','Níger','34','Nigerien','2024-08-12 15:38:22','2024-08-12 15:38:22'),(157,'NU','Niue','95','Niuean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(158,'N1','Ninguno','235','None','2024-08-12 15:38:22','2024-08-12 15:38:22'),(159,'NF','Isla Norfolk','228','Norfolk Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(160,'KP','Corea del Norte','71','North Korean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(161,'MP','Islas Marianas del Norte','57','Northern Mariana Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(162,'NO','Noruega','165','Norwegian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(163,'OM','Omán','192','Omani','2024-08-12 15:38:22','2024-08-12 15:38:22'),(164,'OT','Omán','234','Otros','2024-08-12 15:38:22','2024-08-12 15:38:22'),(165,'PK','Pakistán','60','Pakistani','2024-08-12 15:38:22','2024-08-12 15:38:22'),(166,'PW','Palaos','96','Palauan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(167,'PS','Palestina','196','Palestinian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(168,'PA','Panamá','123','Panamanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(169,'PG','Papúa Nueva Guinea','97','Papua New Guinean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(170,'PY','Paraguay','229','Paraguayan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(171,'PE','Perú','230','Peruvian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(172,'PN','Islas Pitcairn','103','Pitcairn Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(173,'PL','Polonia','140','Polish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(174,'PT','Portugal','169','Portuguese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(175,'PR','Puerto Rico','121','Puerto Rican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(176,'QA','Catar','195','Qatari','2024-08-12 15:38:22','2024-08-12 15:38:22'),(177,'RE','Reunión','124','Reunionese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(178,'RO','Rumania','171','Romanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(179,'RU','Rusia','170','Russian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(180,'RW','Ruanda','24','Rwandan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(181,'EH','Sáhara Occidental','36','Sahrawi','2024-08-12 15:38:22','2024-08-12 15:38:22'),(182,'SH','Santa Elena','126','Saint Helenian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(183,'KN','San Cristóbal y Nieves','131','Saint Kitts and Nevis','2024-08-12 15:38:22','2024-08-12 15:38:22'),(184,'LC','Santa Lucía','130','Saint Lucian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(185,'PM','San Pedro y Miquelón','127','Saint Pierre and Miquelon','2024-08-12 15:38:22','2024-08-12 15:38:22'),(186,'SV','El Salvador','109','Salvadoran','2024-08-12 15:38:22','2024-08-12 15:38:22'),(187,'SM','San Marino','174','Sammarinese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(188,'ST','Santo Tomé y Príncipe','128','São Toméan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(189,'SA','Arabia Saudita','194','Saudi Arabian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(190,'SN','Senegal','30','Senegalese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(191,'RS','Serbia','172','Serbian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(192,'SC','Seychelles','10','Seychellois','2024-08-12 15:38:22','2024-08-12 15:38:22'),(193,'SL','Sierra Leona','12','Sierra Leonean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(194,'SG','Singapur','75','Singaporean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(195,'SK','Eslovaquia','173','Slovak','2024-08-12 15:38:22','2024-08-12 15:38:22'),(196,'SI','Eslovenia','175','Slovene','2024-08-12 15:38:22','2024-08-12 15:38:22'),(197,'SB','Islas Salomón','101','Solomon Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(198,'SO','Somalia','28','Somali','2024-08-12 15:38:22','2024-08-12 15:38:22'),(199,'ZA','Sudáfrica','13','South African','2024-08-12 15:38:22','2024-08-12 15:38:22'),(200,'KR','Corea del Sur','78','South Korean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(201,'ES','España','176','Spanish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(202,'LK','Sri Lanka','83','Sri Lankan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(203,'SD','Sudán','35','Sudanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(204,'SR','Surinam','231','Surinamese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(205,'SJ','Svalbard y Jan Mayen','178','Svalbard and Jan Mayen','2024-08-12 15:38:22','2024-08-12 15:38:22'),(206,'SZ','Esuatini','18','Swazi','2024-08-12 15:38:22','2024-08-12 15:38:22'),(207,'SE','Suecia','177','Swedish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(208,'CH','Suiza','179','Swiss','2024-08-12 15:38:22','2024-08-12 15:38:22'),(209,'SY','Siria','197','Syrian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(210,'TW','Taiwán','86','Taiwanese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(211,'TJ','Tayikistán','198','Tajik','2024-08-12 15:38:22','2024-08-12 15:38:22'),(212,'TZ','Tanzania','26','Tanzanian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(213,'TH','Tailandia','84','Thai','2024-08-12 15:38:22','2024-08-12 15:38:22'),(214,'TG','Togo','22','Togolese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(215,'TK','Tokelau','100','Tokelauan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(216,'TO','Tonga','98','Tongan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(217,'TT','Trinidad y Tobago','132','Trinidadian & Tobagonian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(218,'TN','Túnez','27','Tunisian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(219,'TR','Turquía','180','Turkish','2024-08-12 15:38:22','2024-08-12 15:38:22'),(220,'TM','Turkmenistán','191','Turkmen','2024-08-12 15:38:22','2024-08-12 15:38:22'),(221,'TC','Islas Turcas y Caicos','227','Turks and Caicos Islander','2024-08-12 15:38:22','2024-08-12 15:38:22'),(222,'TV','Tuvalu','102','Tuvaluan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(223,'UG','Uganda','29','Ugandan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(224,'UA','Ucrania','181','Ukrainian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(225,'UY','Uruguay','232','Uruguayan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(226,'UZ','Uzbekistán','200','Uzbek','2024-08-12 15:38:22','2024-08-12 15:38:22'),(227,'VA','Ciudad del Vaticano','133','Vatican','2024-08-12 15:38:22','2024-08-12 15:38:22'),(228,'VE','Venezuela','233','Venezuelan','2024-08-12 15:38:22','2024-08-12 15:38:22'),(229,'VN','Vietnam','87','Vietnamese','2024-08-12 15:38:22','2024-08-12 15:38:22'),(230,'VC','San Vicente y las Granadinas','129','Vincentian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(231,'YE','Yemen','201','Yemeni','2024-08-12 15:38:22','2024-08-12 15:38:22'),(232,'CD','Zaire','31','Zaïrean','2024-08-12 15:38:22','2024-08-12 15:38:22'),(233,'ZM','Zambia','32','Zambian','2024-08-12 15:38:22','2024-08-12 15:38:22'),(234,'ZW','Zimbabue','33','Zimbabwean','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `paquete_pasajero`
--

LOCK TABLES `paquete_pasajero` WRITE;
/*!40000 ALTER TABLE `paquete_pasajero` DISABLE KEYS */;
/*!40000 ALTER TABLE `paquete_pasajero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `paquetes`
--

LOCK TABLES `paquetes` WRITE;
/*!40000 ALTER TABLE `paquetes` DISABLE KEYS */;
/*!40000 ALTER TABLE `paquetes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pasajero_reserva`
--

LOCK TABLES `pasajero_reserva` WRITE;
/*!40000 ALTER TABLE `pasajero_reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `pasajero_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pasajeros`
--

LOCK TABLES `pasajeros` WRITE;
/*!40000 ALTER TABLE `pasajeros` DISABLE KEYS */;
INSERT INTO `pasajeros` VALUES (1,'david miranda tarco','MASCULINO','2024-08-12','982733597','dmirandatarco@gmail.com','ADULTO',171,1,'','fasf','2024-08-12 21:02:29','2024-08-12 21:02:29');
/*!40000 ALTER TABLE `pasajeros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `pdf_datos`
--

LOCK TABLES `pdf_datos` WRITE;
/*!40000 ALTER TABLE `pdf_datos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pdf_datos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'dashboard','Configuracion','Visualizar Dashboard','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(2,'user.index','Usuario','Ver Listado de Usuarios','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(3,'user.edit','Usuario','Editar Usuario','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(4,'user.create','Usuario','Crear Usuario','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(5,'user.destroy','Usuario','Eliminar Usuario','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(6,'user.show','Usuario','Ver información Usuario','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(7,'guia.index','Guia','Ver Listado de Guias','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(8,'guia.edit','Guia','Editar Guia','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(9,'guia.create','Guia','Crear Guia','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(10,'guia.destroy','Guia','Eliminar Guia','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(11,'guia.show','Guia','Ver información Guia','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(12,'etiqueta.index','Etiqueta','Ver Listado de Etiquetas','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(13,'etiqueta.edit','Etiqueta','Editar Etiqueta','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(14,'etiqueta.create','Etiqueta','Crear Etiqueta','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(15,'etiqueta.destroy','Etiqueta','Eliminar Etiqueta','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(16,'categoria.index','Categoria','Ver Listado de Categorias','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(17,'categoria.edit','Categoria','Editar Categoria','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(18,'categoria.create','Categoria','Crear Categoria','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(19,'categoria.destroy','Categoria','Eliminar Categoria','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(20,'precio.index','Precio','Ver Listado de Precios','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(21,'precio.edit','Precio','Editar Precio','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(22,'precio.destroy','Precio','Eliminar Precio','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(23,'precio.create','Precio','Crear Precio','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(24,'hotel.index','Hotel','Ver Listado de Hoteles','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(25,'hotel.edit','Hotel','Editar Hotel','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(26,'hotel.destroy','Hotel','Eliminar Hotel','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(27,'hotel.create','Hotel','Crear Hotel','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(28,'ubicacion.index','Ubicacion','Ver Listado de Ubicaciones','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(29,'ubicacion.edit','Ubicacion','Editar Ubicacion','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(30,'ubicacion.create','Ubicacion','Crear Ubicacion','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(31,'ubicacion.destroy','Ubicacion','Eliminar Ubicacion','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(32,'ubicacion.show','Ubicacion','Ver información Ubicacion','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(33,'servicio.index','Servicio','Ver Listado de Servicios','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(34,'servicio.hotel','Servicio','Ver Listado de Servicios Hotel','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(35,'servicio.vuelo','Servicio','Ver Listado de Servicios Vuelos','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(36,'servicio.otros','Servicio','Ver Listado de Servicios Otros','web','2024-08-12 15:38:20','2024-08-12 15:38:20'),(37,'servicio.edit','Servicio','Editar Servicio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(38,'servicio.create','Servicio','Crear Servicio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(39,'servicio.destroy','Servicio','Eliminar Servicio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(40,'servicio.show','Servicio','Ver información Servicio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(41,'paquete.index','Paquete','Ver Listado de Paquetes','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(42,'paquete.edit','Paquete','Editar Paquete','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(43,'paquete.create','Paquete','Crear Paquete','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(44,'paquete.destroy','Paquete','Eliminar Paquete','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(45,'paquete.show','Paquete','Ver información Paquete','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(46,'paquete.duplicate','Paquete','Duplicar Paquete','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(47,'paquete.pdf','Paquete','PDF Paquete','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(48,'calendario.hotel','Paquete','Calendario Hotel','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(49,'calendario.tours','Paquete','Calendario Tours','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(50,'calendario.vuelos','Paquete','Calendario Vuelos','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(51,'reserva.index','Reserva','Ver Listado de Reservas','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(52,'reserva.edit','Reserva','Editar Reserva','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(53,'reserva.create','Reserva','Crear Reserva','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(54,'reserva.destroy','Reserva','Eliminar Reserva','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(55,'reserva.show','Reserva','Ver información Reserva','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(56,'medio.index','Medio','Ver Listado de Medios','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(57,'medio.edit','Medio','Editar Medio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(58,'medio.create','Medio','Crear Medio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(59,'medio.destroy','Medio','Eliminar Medio','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(60,'cupon.index','Cupon','Ver Listado de Cupones','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(61,'cupon.edit','Cupon','Editar Cupon','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(62,'cupon.create','Cupon','Crear Cupon','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(63,'cupon.destroy','Cupon','Eliminar Cupon','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(64,'proveedor.index','Proveedor','Ver Listado de Proveedores','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(65,'proveedor.edit','Proveedor','Editar Proveedor','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(66,'proveedor.create','Proveedor','Crear Proveedor','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(67,'proveedor.destroy','Proveedor','Eliminar Proveedor','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(68,'operacion.index','Operacion','Ver Listado de Operaciones','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(69,'operacion.edit','Operacion','Editar Operacion','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(70,'operacion.create','Operacion','Crear Operacion','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(71,'operacion.destroy','Operacion','Eliminar Operacion','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(72,'operacion.show','Operacion','Ver información Operacion','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(73,'notificacion.index','Notificación','Ver Listado de Notificaciones','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(74,'notificacion.edit','Notificación','Editar Notificación','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(75,'notificacion.create','Notificación','Crear Notificación','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(76,'notificacion.destroy','Notificación','Eliminar Notificación','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(77,'pdfdatos.index','PDF Datos','Ver Listado de PDF Datos','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(78,'pdfdatos.edit','PDF Datos','Editar PDF Datos','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(79,'pdfdatos.create','PDF Datos','Crear PDF Datos','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(80,'pdfdatos.destroy','PDF Datos','Eliminar PDF Datos','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(81,'role.index','Roles','Ver la lista de Roles','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(82,'role.edit','Roles','Editar Rol','web','2024-08-12 15:38:21','2024-08-12 15:38:21'),(83,'role.destroy','Roles','Cambiar de estado Rol','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(84,'role.create','Roles','Crear Rol','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(85,'liquidacion.ingreso','Liquidacion','Listado de Liquidacion de ingreso','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(86,'liquidacion.salida','Liquidacion','Listado de Liquidacion de egreso','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(87,'liquidacion.ingresocreate','Liquidacion','Crear Liquidacion de ingreso','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(88,'liquidacion.salidacreate','Liquidacion','Crear Liquidacion de egreso','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(89,'liquidacion.ver','Liquidacion','Ver Liquidacion','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(90,'liquidacion.edit','Liquidacion','Editar Liquidacion','web','2024-08-12 15:38:22','2024-08-12 15:38:22'),(91,'liquidacion.destroy','Liquidacion','Liquidacion Anular','web','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `precio_servicio`
--

LOCK TABLES `precio_servicio` WRITE;
/*!40000 ALTER TABLE `precio_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `precio_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `precios`
--

LOCK TABLES `precios` WRITE;
/*!40000 ALTER TABLE `precios` DISABLE KEYS */;
INSERT INTO `precios` VALUES (1,'ADULTO',0,1,'2024-08-12 21:22:43','2024-08-12 21:22:43'),(2,'NIÑO',0,1,'2024-08-12 21:22:51','2024-08-12 21:22:51');
/*!40000 ALTER TABLE `precios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `proveedors`
--

LOCK TABLES `proveedors` WRITE;
/*!40000 ALTER TABLE `proveedors` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(75,1),(76,1),(77,1),(78,1),(79,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','web','2024-08-12 15:38:20','2024-08-12 15:38:20');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `servicio_ubicacion`
--

LOCK TABLES `servicio_ubicacion` WRITE;
/*!40000 ALTER TABLE `servicio_ubicacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicio_ubicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (1,'BOLETO DE INGRESO AL CENTRO ARQUEOLÓGICO DE MACHU PICCHU',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 15:40:16','2024-08-12 15:40:16',1,NULL,NULL,1),(2,'SESIÓN DE INFORMACIÓN PREVIA A LA SALIDA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 15:40:27','2024-08-12 15:40:27',1,NULL,NULL,1),(3,'GUÍA DE TURISMO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,15,1,NULL,NULL,NULL,'1','1','2024-08-12 15:40:43','2024-08-12 15:40:43',1,NULL,NULL,1),(4,'ATENCIÓN AL CLIENTE 24/7',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 15:40:54','2024-08-12 15:40:54',1,NULL,NULL,1),(5,'RECOJO DEL HOTEL',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 15:41:05','2024-08-12 15:41:05',1,NULL,NULL,1),(6,'TRANSPORTE TURÍSTICO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 15:41:17','2024-08-12 15:41:17',1,NULL,NULL,1),(7,'TRENES EN CATEGORIA EXPEDITION O VOYAGER',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 15:41:33','2024-08-12 15:41:33',1,NULL,NULL,1),(8,'TICKET DE BUS DE IDA Y VUELTA DE AGUAS CALIENTES A MACHU PICCHU',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 15:41:45','2024-08-12 15:41:45',1,NULL,NULL,1),(9,'SEGURO DE VIAJE',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 15:41:56','2024-08-12 15:41:56',1,NULL,NULL,1),(10,'ALIMENTACIÓN',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 15:42:07','2024-08-12 15:42:07',1,NULL,NULL,1),(13,'FULL DAY MACHU PICCHU EN TREN  TURÍSTICO EXPEDITION O VOYAGER','<p>De acuerdo al horario de su ticket de ingreso a Machupicchu, nos dirigimos a la estación de tren, para abordar el transporte turístico hasta Ollantaytambo durante aproximadamente una hora y media. Abordaremos nuestro vagón de tren con destino al pueblo de Aguas Calientes, punto de partida de nuestro viaje a la Maravilla del Mundo. Nuestro viaje en tren durará casi 2 horas, atravesando el borde de la selva cusqueña.Luego de disfrutar de las vistas escénicas desde este tren turístico, a su llegada, nuestro guía lo estará esperando para abordar el bus que lo llevará a Machu Picchu. Ascenderá durante casi 25 minutos hasta la entrada de la fortaleza inca.Tendrá una visita guiada en la que conocerá los misterios que encierra este lugar increíblemente especial en el mundo, visitando miradores, templos y puntos clave según la ruta que elija.Después descenderemos hacia Aguas Calientes para disfrutar de tiempo libre.A la hora prevista, tomaremos el tren de regreso a Ollantaytambo y luego viajaremos a Cusco en nuestro transporte turístico.Finalmente, un transporte privado nos estará esperando en la estación para trasladarnos hasta la puerta de su hotel.<br></p>','storage/servicios/full-day-machu-picchu-en-tren-turistico-expedition-o-voyager.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFFF00',NULL,'0','1','2024-08-12 15:47:12','2024-08-12 15:47:12',1,NULL,NULL,0),(14,'TRENES EN CATEGORIA VISTADOME OBSERVATORIO Y EXPEDITION',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 15:52:23','2024-08-12 15:52:23',1,NULL,NULL,1),(15,'FULL DAY MACHU PICCHU EN TREN  TURÍSTICO  OBSERVATORIO  Y  EXPEDITION','<p>De acuerdo al horario de su ticket de ingreso a Machupicchu, nos dirigimos a la estación de tren, para abordar el transporte turístico hasta Ollantaytambo durante aproximadamente una hora y media. Trayecto a Machu Picchu: Abordarás el tren turístico Vistadome Observatory con vistas espectaculares y panorámicas con show abordo (2 horas de viaje aproximadamente).Llegada a Aguas Calientes donde un guía personalizado te espera para dirigirte a la estación de bus CONSETTUR.Conocerás Machu Picchu donde explorarás cada rincón y disfrutarás del sitio arqueológico segun la ruta que elijas.Después descenderemos hacia Aguas Calientes para disfrutar de tiempo libre.A ahora prevista, regreso a Cusco desde la estación de tren de Ollantaytambo, traslado de vuelta a Cusco y&nbsp; el punto de llegada será en su hotel.<br></p>','storage/servicios/full-day-machu-picchu-en-tren-turistico-observatorio-y-expedition.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFFF00',NULL,'0','1','2024-08-12 15:55:06','2024-08-12 15:55:06',1,NULL,NULL,0),(16,'ALMUERZO BUFFET ',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 15:56:59','2024-08-12 15:56:59',1,NULL,NULL,1),(17,'CENA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 15:57:17','2024-08-12 15:57:17',1,NULL,NULL,1),(18,'BOLETO TURÍSTICO PARCIAL',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 15:57:30','2024-08-12 15:57:30',1,NULL,NULL,1),(19,'BOLETO TURÍSTICO COMPLETO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 15:57:41','2024-08-12 15:57:41',1,NULL,NULL,1),(20,'MACHU PICCHU 2D/1N CON VALLE SAGRADO  EN TREN TURÍSTICO ','<p>Día 1: Valle Sagrado&nbsp; con maras y moray</p><p>Comenzamos el tour con el recojo de sus hoteles alrededor de las 6:00 a.m. para dirigirnos hacia..Chinchero: para explorar terrazas agrícolas, templo colonial y producción de textiles con mujeres tejedoras del pueblo de Chinchero.Moray: para conocer terrazas circulares de experimentación agrícola Inca.Salineras de Maras: Para ver pozas de sal y aprender sobre la tradición de extracción de la sal.Urubamba: Lugar donde disfrutaremos de la gastronomía Peruana, tendrá tiempo libre para que pueda disfrutar del almuerzo buffet. (incluido). Ollantaytambo: Este sitio es una importante fortaleza, evidencia de la tecnología arquitectónica Inca.Finalmente nos separaremos del grupo para dirigirnos a la estación de tren y abordar el vagon (2 horas de viaje) hacia el pueblo de aguas calientes.A su llegada un personal del hotel le esperará en la estación de tren para su traslado hacia el hotel.&nbsp; (NO INCLUYE HOTEL - OPCIONAL).</p><div><br></div>','storage/servicios/machu-picchu-2d1n-con-valle-sagrado-en-tren-turistico.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFFF00',NULL,'0','1','2024-08-12 16:04:10','2024-08-12 16:04:10',2,NULL,NULL,0),(21,'MACHU PICCHU 2D/1N EN TREN TURÍSTICO EXPEDITION O VOYAGER','<p>Día 1: traslado hacia la estación de tren&nbsp;<br>Nuestra movidad pasara por su alojamiento para trasladarlo a la estación de Tren Para abordar el transporte turístico hasta Ollantaytambo (2 horas de viaje).Abordaremos el tren con destino al pueblo de Aguas Calientes (2 horas de viaje) atravesando el borde de la selva cusqueña.A su llegada un personal del hotel le esperará en la estación de tren para su traslado hacia el hotel.&nbsp; (NO ITarde libre para que disfrute del pueblo de aguas calientes.<br><br>Día 2: Machu Picchu&nbsp; maravilla del mundo&nbsp;<br>Desayuno en el hotel Luego nos dirigiremos a la estación de bus CONSETTUR, donde subiremos al bus que nos llevará a la entrada de Machu Picchu. Recuerda tener a mano tu boleto de ingreso y tu documento de identificación (DNI o pasaporte).Conocerás Machu Picchu, te maravillarás y disfrutarás del sitio arqueológico segun la ruta que elijas.Después descenderemos hacia Aguas Calientes para almorzar (NO INCLUIDO) y retorno a la estación de tren de Ollantaytambo, donde estarás de regreso a Cusco, hasta tu hotel.<br></p>','storage/servicios/machu-picchu-2d1n-en-tren-turistico-expedition-o-voyager.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFFF00',NULL,'0','1','2024-08-12 16:07:37','2024-08-12 16:07:37',2,NULL,NULL,0),(22,'INGRESOS',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 16:12:03','2024-08-12 16:12:03',1,NULL,NULL,1),(23,'CITY TOUR  LIMA COLONIAL Y MODERNA','<p>A hora acordada&nbsp; daremos al recojo desde su hotel, visitaremos:Lima Pre-Hispánica, Colonial y Moderna. El tour iniciará desde el distrito de Miraflores, visitando el ‘’Parque del Amor’’ en el camino se apreciará desde el bus la impresionante “Huaca Pucllana”, antiguo Centro Ceremonial y arqueológico.Luego nos dirigiremos al Centro Histórico de Lima. Donde se apreciará lo que fue la antigua Lima Colonial, además de diferentes monumentos y edificios coloniales dentro de los que destacan el paseo de la República.La Plaza San Martín, La Plaza Mayor, entre otros, luego se podrá descender alrededor de la Plaza Mayor donde se puede apreciar sus majestuosos edificios más representativos como Palacio de Gobierno, El Palacio Municipal, El Palacio Arzobispal, La Basílica Catedral, luego visita e ingreso a la Convento de San Francisco, Donde su principal atractivo es la visita a sus criptas subterráneas conocidas como Las Catacumbas.&nbsp; Finalizando el tour en su hotel.<br></p>','storage/servicios/city-tour-lima-colonial-y-moderna.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#51D1F6',NULL,'0','1','2024-08-12 16:21:17','2024-08-12 16:21:17',1,NULL,NULL,0),(24,'CIRCUITO MÁGICO DEL AGUA','<p>06:30 pm. Aproximadamente el guía estará pasando por su alojamiento.Nos trasladaremos hacia el Circuito Mágico del Agua, visitará al mayor complejo de Fuentes electrónicas del mundo, certificado por el Guinness World Record, donde podrá disfrutar de un maravilloso espectáculo de agua, luz, música e imágenes, presentadas en el famoso Parque de la Reserva. Finalmente se visitará de forma panorámica a la Zona Contemporánea o Moderna de Lima donde se aprecia sus edificaciones y algunas de las zonas residenciales de Lima, culminando en Miraflores (retorno al Hotel).<br></p>','storage/servicios/circuito-magico-del-agua.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#51D1F6',NULL,'0','1','2024-08-12 16:24:34','2024-08-12 16:24:34',1,NULL,NULL,0),(25,'COMIDAS Y BEBIDAS (15)',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 16:25:34','2024-08-12 16:25:34',1,NULL,NULL,1),(26,'ATRACTIVOS TRUSTICOS POR BARRANCO.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 16:25:53','2024-08-12 16:25:53',1,NULL,NULL,1),(27,'TRASLADOS DEL HOTEL - BARRANCO - HOTEL. (DESDE MIRAFLORES).',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 16:26:06','2024-08-12 16:26:06',1,NULL,NULL,1),(28,'CLASICOS DE LA GASTRONOMIA PERUANA EN BARRANCO','<p>Sabores emblemáticos en el barrio más cool de LatinoaméricaDurante este recorrido gastronómico a pie por Lima, degustará más de 15 comidas y bebidas peruanas en uno de los barrios más bonitos de Lima: el artístico y bohemio Barranco. Incluso tendrá la oportunidad de interactuar con nuestros anfitriones locales para aprender a preparar el famoso ceviche y el pisco sour. Usted aprenderá acerca de todos los detalles históricos y culturales detrás de cada plato que usted tendrá la oportunidad de probar durante este recorrido a pie de 4 horas de comida de Lima.<br></p>','storage/servicios/clasicos-de-la-gastronomia-peruana-en-barranco.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#51D1F6',NULL,'0','1','2024-08-12 16:28:24','2024-08-12 16:28:24',1,NULL,NULL,0),(29,'DANZAS TÍPICAS + PASEO A CABALLO + SHOW DE CABALLOS DE PASO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 16:28:55','2024-08-12 16:28:55',1,NULL,NULL,1),(30,'TICKET DE INGRESO A PACHACAMAC',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 16:29:06','2024-08-12 16:29:06',1,NULL,NULL,1),(31,'ASISTENCIA DURANTE TODO EL TOUR',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 16:29:18','2024-08-12 16:29:18',1,NULL,NULL,1),(32,'PACHACAMAC Y CABALLOS DE PASO','<p>10:20 AM –10:30 AM aproximadamente, recojo de hoteles de Miraflores. Comenzamos el Tour en la enigmática ciudadela de Pachacamac ubicado a 45 minutos de Lima, muestran un conjunto de edificaciones piramidales de templos y recintos de antiguas culturas precolombinas y del imperio Incaico, destacan el oráculo de Pachacamac, los templos Acllahuasi o palacio de las vírgenes del Sol, Templo pintado, Templo del Sol entre otros y su museo de sitio. Continuamos el recorrido con un show espectacular de los caballos Peruanos de Paso en una hermosa Casa Hacienda ubicada en el Valle de Lurín, al llegar caminaremos por las caballerizas de la hacienda para conocer sobre la historia y características propias de los caballos y así entender porque son únicos y especiales en el Mundo. La presentación incluye a elegantes chalanes o jinetes peruanos cabalgando hermosos ejemplares, que bailan al son de la música, si desea podrá realizar un paseo montando el caballo peruano de paso.4:00 PM aproximadamente, retorno a sus hoteles.<br></p>','storage/servicios/pachacamac-y-caballos-de-paso.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#51D1F6',NULL,'0','1','2024-08-12 16:32:35','2024-08-12 16:32:35',1,NULL,NULL,0),(33,'GUÍA DE TURISMO Y AVENTURA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,15,1,NULL,NULL,NULL,'1','1','2024-08-12 16:44:44','2024-08-12 16:44:44',1,NULL,NULL,1),(34,'ENTRADA AL QORIKANCHA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 16:44:59','2024-08-12 16:44:59',1,NULL,NULL,1),(35,'CITY TOUR CUSCO 4 RUINAS + TEMPLO DEL SOL TURNO DIA','<p>02:00 pm. aproximadamente iniciaremos con nuestro city tour con el recojo en el hotel o prevía coordinación en la Plaza de armas.Nuestro primer punto será Qorikancha: Aprendizaje sobre la historia y la importancia cultural del Templo del Sol. Después, abordaremos el transporte para dirigirnos a un centro textil y a los sitios arqueológicos como: Sacsayhuamán: Aprendizaje sobre las técnicas de construcción incas y ceremonial del lugar. Qenqo: Conocimiento sobre los rituales incas y la cosmovisión manifestada en este sitio sagrado. Pukapucara: Exploración de la fortaleza militar y aprendizaje sobre su función defensiva y estratégica durante el Imperio Inca. Tambomachay: Apreciación de las fuentes y canales de piedra que demuestran la ingeniería hidráulica de los incas. Retorno a las 6:00 pm aproximadamente.<br></p>','storage/servicios/city-tour-cusco-4-ruinas-templo-del-sol-turno-dia.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#E6AA77',NULL,'0','1','2024-08-12 16:53:43','2024-08-12 16:53:43',1,NULL,NULL,0),(36,'BOLETO DE INGRESO A LA CAPILLA SIXTINA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 16:54:10','2024-08-12 16:54:10',1,NULL,NULL,1),(37,'TOUR VALLE SUR','<p>Recojo en hotel entre las 08:00 y las 08:30 hrs. aproximadamente.Visita a Pikillacta, ciudad preíncaica a 30 km al suroeste de Cusco.Exploración de estructuras y sumergirse en la historia preinca.Viaje hacia Andahuaylillas, parte de la Ruta del Barroco Andino.Visita a la famosa Capilla Sixtina de América.Llegada a Tipón, joya del Imperio Inca, con acueductos y terrazas agrícolas.Conexión con la naturaleza y gestión eficiente del agua por los incas.Culminación del tour 2:00 pm&nbsp; aproximadamente para&nbsp;<br></p>','storage/servicios/tour-valle-sur.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#835D8C',NULL,'0','1','2024-08-12 16:56:55','2024-08-12 16:56:55',1,NULL,NULL,0),(38,'ENTRADA DE INGRESO A SALINERAS DE MARAS',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 16:57:27','2024-08-12 16:57:27',1,NULL,NULL,1),(39,'TOUR CHINCHERO, MARAS Y MORAY','Recojo en hotel en zona céntrica del Cusco a las 8:00 am.&nbsp; aproximadamente.Visita al pintoresco pueblo inca colonial de Chinchero. Maravíllate con el encanto y esplendor histórico de Chinchero.Continuación del recorrido hacia Moray, lugar de experimentación inca.Fascinación por las terrazas circulares y vistas espectaculares en Moray.Viaje a Maras, conocidas por sus famosas pozas de sal.Descubrimiento de la geografía única y producción de sal de alta calidad. Experiencia combinada de historia, cultura y vistas panorámicas.Conexión con la grandeza de los incas y la belleza natural de la región.Retorno a la ciudad del Cusco alrededor de las 2:00 pm.','storage/servicios/tour-chinchero-maras-y-moray.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#D2D2D2',NULL,'0','1','2024-08-12 16:59:38','2024-08-12 16:59:38',1,NULL,NULL,0),(40,'FD. VALLE SAGRADO TRADICIONAL','<p>Recojo en hotel en zona céntrica del Cusco 7:00 a 7:30 amaproximadamente para conocer el valle sagrado y visitar;Pisac: Terrazas Agrícolas y Vestigios Incas: explora este impresionante sitio arqueológico y disfruta de una visita guiada. Almuerzo en Urubamba: Recarga energías con un delicioso almuerzo buffet de comida típica andina en Urubamba, la capital del Valle Sagrado. Ollantaytambo: Templo del Sol y Terrazas Andinas: Sumérgete en la historia y la arquitectura incaica mientras exploras el imponente Templo del Sol, el Intihuatana, los Baños de la Princesa y las magníficas terrazas andinas. Chinchero: Termina tu día explorando Chinchero, un pueblo lleno de encanto y tradición. Visita la iglesia colonial del siglo XVII y explora las terrazas incas. Regreso a Cusco: Finalizando nuestro recorrido regresando a la ciudad del Cusco alrededor de las 6:00 pm.&nbsp;<br></p>','storage/servicios/fd-valle-sagrado-tradicional.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFC65E',NULL,'0','1','2024-08-12 17:03:11','2024-08-12 17:03:11',1,NULL,NULL,0),(41,'FD. VALLE SAGRADO COMPLETO','<p>Comenzamos el tour con el recojo de sus hoteles a las 6:00 a.m. aproximadamente previa coordinación para dirigirnos hacia el valle sagrado, nuestra primera parada será: Chinchero: para explorar terrazas agrícolas, templo colonial y producción de textiles con mujeres tejedoras del pueblo de Chinchero.Moray: para conocer terrazas circulares de experimentación agrícola Inca.Salineras de Maras: Para ver pozas de sal y aprender sobre la tradición de extracción de la sal.Urubamba: Lugar donde disfrutaremos de la gastronomía Peruana, tendrá tiempo libre para que pueda disfrutar del almuerzo buffet. (incluido). Ollantaytambo: Este sitio es una importante fortaleza, evidencia de la tecnología arquitectónica Inca.Pisac: como último punto de visita, un importante centro urbano y religioso Inca.Regreso a Cusco alrededor de las 7:00 pm.<br></p>','storage/servicios/fd-valle-sagrado-completo.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFA500',NULL,'0','1','2024-08-12 17:05:32','2024-08-12 17:05:32',1,NULL,NULL,0),(42,'DESAYUNO - ALMUERZO BUFFET',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 17:06:01','2024-08-12 17:06:01',1,NULL,NULL,1),(43,'BASTONES DE TREKKING',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:06:12','2024-08-12 17:06:12',1,NULL,NULL,1),(44,'MANTA POLAR ',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:06:23','2024-08-12 17:06:23',1,NULL,NULL,1),(45,'RENTA DE CABALLOS ',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:06:33','2024-08-12 17:06:33',1,NULL,NULL,1),(46,'FULL DAY LAGUNA HUMANTAY','<p>Hora de recojo desde el hotel a las 4:00 am - 4:30 am aproximadamente.Viaje de Cusco a Mollepata: Al subir al transporte tendrá mantas polares para que esté más abrigado y en el trayecto disfrute de pintorescos paisajes, al llegar al pueblo tendremos una parada técnica para disfrutar de un delicioso desayuno tipo buffet para energizarse. Soraypampa: Continuamos hacia este punto para iniciarla caminata. Caminata a Laguna Humantay: El guía les brindará equipos de trekking profesional para iniciar la caminata que dura aproximadamente 1 hora y 40 minutos durante el recorrido conectate con la naturaleza en su máxima expresión. Llegada a la Laguna Humantay: Maravíllate con el color turquesa del agua y las vistas panorámicas, Descenso a Soraypampa: Regreso al punto de partida. Almuerzo en Mollepata: reconfortante almuerzo tipo buffet después de la caminata. Regreso a Cusco: Viaje de vuelta con estimación de llegada a las 6:00 p.m aproximadamente.<br></p>','storage/servicios/full-day-laguna-humantay.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#0CB7F2',0.00,'0','1','2024-08-12 17:09:56','2024-08-12 20:49:17',1,NULL,NULL,0),(47,'ENTRADA DE LA MONTAÑA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 17:10:54','2024-08-12 17:10:54',1,NULL,NULL,1),(48,'ENTRADA A LA LAGUNA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 17:11:08','2024-08-12 17:11:08',1,NULL,NULL,1),(49,'MONTAÑA DE COLORES + DESAYUNO + ALMUERZO','<p>Hora de recojo desde el hotel a las 4:00 am - 4:30 am aproximadamente.Viaje de Cusco al pueblo de Cusipata: Al subir al transporte tendrá mantas polares para que esté más abrigado, al llegar al pueblo tendremos una parada técnica para disfrutar de un delicioso desayuno tipo buffet para energizarse. Inicio del sendero Quesyuno: nuestro guía les brindará equipos de trekking profesional, les dará una pequeña instrucción de la zona y los últimos alcances para empezar la caminata. Caminata hacia Vinicunca: Duración aproximada de 2,5 horas, de dificultad moderada. Llegada a Vinicunca: Llegaremos a nuestro destino llamado Vinicunca o la Montaña del Arco Iris para disfrutar del paisaje natural.Descenso: Retorno por el mismo camino hacia la movilidad.Regreso al Restaurante en Cusipata: Para disfrutar de un almuerzo buffet. Viaje de regreso a Cusco: Disfrutando del paisaje en el trayecto.&nbsp;<br></p>','storage/servicios/montana-de-colores-desayuno-almuerzo.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#00FF00',NULL,'0','1','2024-08-12 17:13:59','2024-08-12 17:13:59',1,NULL,NULL,0),(50,'TOUR PALCCOYO','<p>Hora de recojo desde el hotel a las 4:00 am - 4:30 am aproximadameNos dirigiremos al pintoresco pueblo de Checacupe para un breve descanso y aprovisionamiento.Palccoyo: Luego, continuaremos nuestro viaje por una hora hacia la comunidad de Palccoyo, donde sera nuestro punto de inicio de la caminata.Inicio de caminata: se inicia una caminata de 45 minutos con vistas impresionantes del Bosque de Piedras y la Cordillera de Colores. Se observa una variedad de camélidos sudamericanos y se llega a la cima para disfrutar del imponente Apu Ausangate.Descenso:&nbsp; Después del contacto con la naturaleza, se regresa a Cusipata para almorzar.Viaje de regreso a Cusco: Posteriormente retornaremos a ciudad de Cusco dando por finalizado nuestro recorrido a las 5:00pm aproximadamente.<br></p>','storage/servicios/tour-palccoyo.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#FFC0CB',NULL,'0','1','2024-08-12 17:18:03','2024-08-12 17:18:03',1,NULL,NULL,0),(51,'SEGURO DE PASAJEROS CONTRA ACCIDENTES - SOAT (VEHICULAR)',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:19:35','2024-08-12 17:19:35',1,NULL,NULL,1),(52,'VISITA A UNA VITINICOLA',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:19:57','2024-08-12 17:19:57',1,NULL,NULL,1),(53,'DEGUSTACIÓN DE VINO Y PISCO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:20:08','2024-08-12 17:20:08',1,NULL,NULL,1),(54,'ENTRADAS A HUACANCHINA E ISLAS BALLESTAS',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'0','1','2024-08-12 17:20:19','2024-08-12 17:20:19',1,NULL,NULL,1),(55,'TUBULARES Y SANDSLEDING',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:20:31','2024-08-12 17:20:31',1,NULL,NULL,1),(56,'TRANSPORTE TURISTICO CRUZ DEL SUR DÍA 2, RETORNO A LIMA.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:20:52','2024-08-12 17:20:52',1,NULL,NULL,1),(57,'RECOJO DEL HOTEL Y LLEGADA AL HOTEL (SOLO MIRAFLORES).',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 17:21:05','2024-08-12 17:21:05',1,NULL,NULL,1),(58,'VIAJE A PARACAS Y DESIERTO DE HUACACHINA','<p>El horario de recojo aproximado es de 4:20 am a 5:00 am.Viaje a la costa peruana, con una parada en Chilca para desayunar. Una vez en Paracas, nos embarcamos en deslizadores para disfrutar de las Islas Ballestas, además de apreciar la naturaleza junto con la vida marina de la zona, también apreciará el Candelabro.Visitaremos la Dulcería Viviana, donde se degustará la tradicional chocoteja artesanal, así como alfajores, mermeladas, galletas artesanales, etc.Viaje hacia la ciudad de Ica, visitaremos el Restaurante y vitivinicola artesanal ‘’Cultur Pisco‘’ Podremos degustar los principales productos que se elaboran en la bodega: Vinos, Piscos, Cremas de Pisco, Macerados y Mistelas. Finalmente visitaremos el Oasis de La Huacachina, En esta hermosa laguna y desierto podrán disfrutar de la adrenalina en los famosos carros areneros, donde se vivirá un inolvidable momento de aventura, donde pasará a toda velocidad por las Dunas, también podrán realizar el deslizamiento en tablas conocido como Sandsleding.Nos seraremos del grupo para dirigirnos al hotel y noche libre para que puede disfrutar del Oasis.<br></p>','storage/servicios/viaje-a-paracas-y-desierto-de-huacachina.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#2196F3',NULL,'0','1','2024-08-12 17:26:43','2024-08-12 17:26:43',2,NULL,NULL,0),(59,'VISITA GUIADA A UNA VIÑEDO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:28:20','2024-08-12 17:28:20',1,NULL,NULL,1),(60,'ENTRADAS A HUACANCHINA ',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 17:28:52','2024-08-12 17:28:52',1,NULL,NULL,1),(61,'DESIERTO DE HUACACHINA + VIÑEDO','<p>El horario de recojo aproximado es de 7:00 am.Viaje a la costa peruana y&nbsp; conocer el unico oasis de America.Visitaremos a uno de los VIÑEDOS MÁS ANTIGUOS DE SUDAMÉRICA, YA SEA TACAMA o CARAVEDO: tendrá un guiado por el viñedo y degustaremos los vinos y piscos en copas de cristal.Tendrá tiempo libre para que pueda almorzar y degustar la gastronomía peruana. (no incluido).Ciudad de Ica, para realizar la excursión al Oasis de La Huacachina, En esta hermosa laguna y desierto podrán disfrutar de la adrenalina en los famosos carros areneros, donde se vivirá un inolvidable momento de aventura, donde pasará a toda velocidad por las Dunas, también podrán realizar el deslizamiento en tablas conocido como Sandsleding.Sunset en el desierto, podrá terminar el día y disfrutar de esta experiencia diferente en las dunas de Ica, finalmente nos trasladaremos al transporte para retornar a Lima.Llegada estimada a Lima alrededor de las 10:00 p.m.<br></p>','storage/servicios/desierto-de-huacachina-vinedo.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#42A5F5',NULL,'0','1','2024-08-12 17:31:52','2024-08-12 17:31:52',1,NULL,NULL,0),(62,'TRASLADO DE HUACACHINA - ESTACIÓN DE BUS',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:33:59','2024-08-12 17:33:59',1,NULL,NULL,1),(63,'TRASLADO DE ICA - NAZCA EN CRUZ DEL SUR.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:34:41','2024-08-12 17:34:41',1,NULL,NULL,1),(64,'SOBREVUELO EN LINEAS DE NAZCA 30MIN APROXIMADAMENTE.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:35:15','2024-08-12 17:35:15',1,NULL,NULL,1),(65,'TRASLADO HTL - AERODROMO RT.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:35:25','2024-08-12 17:35:25',1,NULL,NULL,1),(66,'TRANSPORTE DE NAZCA - LIMA EN CRUZ DEL SUR.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:35:49','2024-08-12 17:35:49',1,NULL,NULL,1),(67,'TRASLADO DE ESTACIÓN LIMA - HOTEL MIRAFLORES.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'1','1','2024-08-12 17:36:01','2024-08-12 17:36:01',1,NULL,NULL,1),(68,'IMPUESTOS DEL AERODROMO  TUUA – BOLETO TURÍSTICO ($22.00 – S/77.00) PAGO EN EFECTIVO.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:36:23','2024-08-12 17:36:23',1,NULL,NULL,1),(69,'PARACAS ICA  NAZCA 2D-1N','<p>DIA 1fullday PARACAS Y DESIERTO DE huacachina<br>El horario de recojo aproximado es de 4:20 am a 5:00 am.Viaje a la costa peruana con una parada en Chilca para desayunar. Una vez en Paracas, nos embarcamos en deslizadores para disfrutar de las Islas Ballestas, además de apreciar la naturaleza junto con la vida marina de la zona, también apreciará el Candelabro; (01:40 horas. horas aproximadamente).Visitaremos la Dulcería Viviana ubicado en los alrededores del balneario, donde se degustará la tradicional chocoteja artesanal, así como alfajores, mermeladas, galletas artesanales, etcViaje hacia la ciudad de Ica, visitaremos el Restaurante y vitivinicola artesanal ‘’Cultur Pisco‘’ Podremos degustar los principales productos que se elaboran en la bodega: Vinos, Piscos, Cremas de Pisco, Macerados y Mistelas. Finalmente visitaremos el Oasis de La Huacachina, En esta hermosa laguna y desierto podrán disfrutar de la adrenalina en los famosos carros areneros, donde se vivirá un inolvidable momento de aventura, donde pasará a toda velocidad por las Dunas, también podrán realizar el deslizamiento en tablas conocido como Sandsleding.Viaje de Ica - Nazca (3hrs). Nos separaremos del grupo para tener un tiempo libre en la huacachina y luego trasladarnos a la estación de bus de cruz del sur. Llegada a Nazca y traslado al hotel.Noche de alojamiento en Nazca.<br><br>DIA 2 SOBREVuELO LINEAS DE NAZCA Y RETORNO A LIMA<br>Desayuno en el Hotel.A&nbsp; hora indicada, salida con destino al aeródromo María Reiche. Las Líneas de Nazca poseen un gran misterio, queremos que te diviertas descifrando este enigma sobrevolando durante 35 minutos en una Aeronave Cessna sobre las 13 líneas más importantes de Nazca.Retorno al Hotel.Tiempo libre para comprar souvenirs - Almuerzo por cuenta del pasajero.Salida a la estación de bus. Salida con destino a la ciudad de Lima en bus Cruz del Sur.Llegada a la ciudad de Lima – Estación de buses.<br></p>','storage/servicios/paracas-ica-nazca-2d-1n.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#64B5F6',NULL,'0','1','2024-08-12 17:46:08','2024-08-12 17:46:08',2,NULL,NULL,0),(70,'SUNSET EN HUACACHINA ',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 17:47:16','2024-08-12 17:47:16',1,NULL,NULL,1),(71,'PARACAS - ICA, HUACACHINA - VIÑEDO','<p>El horario de recojo aproximado es a las 5:00 am.Viaje a la costa peruana en servicio privado, visitaremos el Balneario de Paracas con una parada en Chilca para degustar el pan artesanal y desayunar (no incluido).Una vez en Paracas, nos embarcamos en deslizadores para disfrutar de las Islas Ballestas, además de apreciar la naturaleza junto con la vida marina de la zona, también apreciará el Candelabro.Visitaremos a uno de los VIÑEDOS MÁS ANTIGUOS DE SUDAMÉRICA, YA SEA TACAMA o CARAVEDO: tendrá un guiado por el viñedo y degustaremos los vinos y piscos en copas de cristal.Tendrá tiempo libre para que pueda almorzar y degustar la gastronomía peruana. Oasis de La Huacachina, en esta hermosa laguna y desierto podrán disfrutar de la adrenalina en los famosos carros areneros, donde se vivirá un inolvidable momento de aventura, donde pasará a toda velocidad por las Dunas, también podrán realizar el deslizamiento en tablas conocido como Sandsleding.Sunset en el desierto, podrá terminar el día y disfrutar de esta experiencia diferente en las dunas de Ica, finalmente nos trasladaremos al transporte para retornar a Lima.Llegada estimada a Lima alrededor de las 10:30 p.m. aproximadamente.<br></p>','storage/servicios/paracas-ica-huacachina-vinedo.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#90CAF9',NULL,'0','1','2024-08-12 17:50:25','2024-08-12 17:50:25',1,NULL,NULL,0),(72,'RECOJO DEL HOTEL Y LLEGADA AL HOTEL (SOLO MIRAFLORES, SAN ISIDRO Y BARRANCO).',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 17:50:56','2024-08-12 17:50:56',1,NULL,NULL,1),(73,' FULL DAY PARACAS Y DESIERTO DE HUACACHINA','<p>El horario de recojo aproximado es de 4:20 am a 5:00 am.Viaje a la costa peruana, con una parada en Chilca para desayunar. Una vez en Paracas, nos embarcamos en deslizadores para disfrutar de las Islas Ballestas, además de apreciar la naturaleza junto con la vida marina de la zona, también apreciará el Candelabro.Visitaremos la Dulcería Viviana, donde se degustará la tradicional chocoteja artesanal, así como alfajores, mermeladas, galletas artesanales, etc.Viaje hacia la ciudad de Ica, para realizar la excursión al Oasis de LaHuacachina, en esta hermosa laguna y desierto podrán disfrutar de laadrenalina en los famosos carros areneros, donde se vivirá un inolvidablemomento de aventura, donde pasará a toda velocidad por las Dunas, tambiénpodrán realizar el deslizamiento en tablas conocido como Sandsleding.Nuestra última parada será el Restaurante y viñedo ‘’ Cultur Pisco ‘’Podremos degustar los principales productos que se elaboran en la bodega.Después de un día lleno de aventura y máxima diversión, regresaremos aLima.Llegada estimada a Lima alrededor de las 10:00 p.m.<br></p>','storage/servicios/full-day-paracas-y-desierto-de-huacachina.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#BBDEFB',NULL,'0','1','2024-08-12 17:55:25','2024-08-12 17:55:25',1,NULL,NULL,0),(74,'TRANSPORTE DESDE HOTEL - ESTACIÓN DE BUS.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 18:00:34','2024-08-12 18:00:34',1,NULL,NULL,1),(75,'TRANSPORTE TURISTICO CUSCO - PUNO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 18:00:44','2024-08-12 18:00:44',1,NULL,NULL,1),(76,'GUÍA BILINGÜE INGLÉS ESPAÑOL.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,15,1,NULL,NULL,NULL,'1','1','2024-08-12 18:01:00','2024-08-12 18:01:00',1,NULL,NULL,1),(77,'ENTRADAS A LOS SITIOS ARQUEOLÓGICOS.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'0','1','2024-08-12 18:01:20','2024-08-12 18:01:20',1,NULL,NULL,1),(78,'ALMUERZO BUFFET EN EL RESTAURANTE TURÍSTICO «MARANGANI»',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 18:01:35','2024-08-12 18:01:35',1,NULL,NULL,1),(79,'TRANSPORTE DE ESTACIÓN PUNO - HOTEL.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 18:02:02','2024-08-12 18:02:02',1,NULL,NULL,1),(80,'GASTOS PERSONALES Y PROPINAS',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 18:02:16','2024-08-12 18:02:16',1,NULL,NULL,1),(81,'ENTRADAS A LA ISLA (UROS Y TAQUILE)',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,17,1,NULL,NULL,NULL,'1','1','2024-08-12 18:02:59','2024-08-12 18:02:59',1,NULL,NULL,1),(82,'ALMUERZO',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,14,1,NULL,NULL,NULL,'1','1','2024-08-12 18:03:24','2024-08-12 18:03:24',1,NULL,NULL,1),(83,'TRANSFER HOTEL-PUERTO-HOTEL',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 18:03:35','2024-08-12 18:03:35',1,NULL,NULL,1),(84,'SERVICIO LANCHA/ LANCHA MOTOR',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,13,1,NULL,NULL,NULL,'0','1','2024-08-12 18:03:47','2024-08-12 18:03:47',1,NULL,NULL,1),(85,'EMBARCACIÓN.',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 18:03:57','2024-08-12 18:03:57',1,NULL,NULL,1),(86,'PASEO EN BARCO TOTORA S/.15 POR PERSONA (PAGO SE REALIZA EN LA ISLA)',NULL,'storage/servicios/default.png',NULL,NULL,NULL,NULL,16,1,NULL,NULL,NULL,'0','1','2024-08-12 18:04:08','2024-08-12 18:04:08',1,NULL,NULL,1),(87,'CONEXIÓN A PUNO  03 DÍAS -02 NOCHES','<p>DÍA 1: ruta del sol VIAJE DE CUSCO - PUNO<br>Traslado desde su hotel - estación de bus.La maravillosa Ruta del Sol conecta a las ciudades Cusco a Puno o viceversa, llevándote por una experiencia inolvidable con un guía abordo.Este Tour Exclusivo ofrece la oportunidad de explorar centros arqueológicos incas, arte colonial, y un museo arqueológico ubicado en un pintoresco pueblo, todo mientras te sumerges en los maravillosos paisajes naturales que adornan este recorrido.Con nuestro tour Rutal del Sol podrás visitar:La capilla de Andahuaylillas (Tiempo estimado de 35 minutos).Complejo Arqueológico de Raqchi (Tiempo estimado de 50 minutos).Almuerzo Buffet en el Restaurante Turístico «Marangani» (Tiempo estimado de 45 minutos).La Raya (Tiempo estimado de 10 minutos).Museo Pukara (Tiempo estimado de 40 minutos).PUNTO DE LLEGADA PUNO: Terminal terrestre Puno 5:30 p.m. aproximadamente para luego trasladarnos al hotel.<br><br>día 2: FulldaY URUS + TAQUILE + ALMUERZO<br>07:15 a.m.: Se empieza a recoger a los visitantes de sus hoteles en el centro de Puno.07:30 a.m.: La lancha parte en Dirección de las islas flotantes. Visita de las Islas Flotantes de los Uros.Puno.11:00 a.m.: Llegada al muelle de la Isla de Taquile, Empezamos la caminata hacia el lugar donde encontramos a los tejedores. Durante una hora y media disfrutamos de los encuentros con las familias de habitantes, la observación de los diseños textiles de Taquile, la interpretación de la ropa tradicional y la forma de vida de la gente de Taquile en donde también será el almuerzo.12:30 a.m.: Almuerzo.13:30 a.m.: Se inicia el regreso hacia el muelle principal de Taquile.15:30 a.m.: Se llega al muelle principal de la Ciudad de Puno y trasladamos a los pasajeros de regreso a sus hoteles.<br><br><br></p>','storage/servicios/conexion-a-puno-03-dias-02-noches.jpg',NULL,NULL,NULL,NULL,5,1,NULL,'#5B1F00',NULL,'0','1','2024-08-12 18:12:50','2024-08-12 18:12:50',3,NULL,NULL,0),(88,'RUTA  DEL SOL','<p>A hora estimada pasaremos por su alojamiento para trasladarlos a la estación de bus e iniciar con el viaje hacia Puno.La maravillosa Ruta del Sol conecta a las ciudades Cusco a Puno o viceversa, llevándote por una experiencia inolvidable con un guía abordo.Este Tour Exclusivo ofrece la oportunidad de explorar centros arqueológicos incas, arte colonial, y un museo arqueológico ubicado en un pintoresco pueblo, todo mientras te sumerges en los maravillosos paisajes naturales que adornan este recorrido.Con nuestro tour Rutal del Sol podrás visitar:La capilla de Andahuaylillas (Tiempo estimado de 35 minutos).Complejo Arqueológico de Raqchi (Tiempo estimado de 50 minutos).Almuerzo Buffet en el Restaurante Turístico «Marangani» (Tiempo estimado de 45 minutos).La Raya (Tiempo estimado de 10 minutos).Museo Pukara (Tiempo estimado de 40 minutos).PUNTO DE LLEGADA PUNO: Terminal terrestre Puno 5:30 p.m. aproximadamente para luego trasladarnos al hotel.<br></p>','storage/servicios/ruta-del-sol.webp',NULL,NULL,NULL,NULL,5,1,NULL,'#66280A',NULL,'0','1','2024-08-12 18:15:19','2024-08-12 18:15:19',1,NULL,NULL,0),(89,'TRANSLADO DE AEROPUERTO LIMA A HOTEL ',NULL,'storage/servicios/translado-de-aeropuerto-lima-a-hotel.png',NULL,NULL,NULL,NULL,6,1,NULL,'#008DC0',NULL,'0','1','2024-08-13 15:13:50','2024-08-13 15:13:50',1,NULL,NULL,0),(90,'TRASLADO DEL HOTEL  - APTO. LIMA / TRASLADO DE APTO. CUSCO - HOTEL',NULL,'storage/servicios/traslado-del-hotel-apto-lima-traslado-de-apto-cusco-hotel.png',NULL,NULL,NULL,NULL,6,1,NULL,'#009DCF',NULL,'0','1','2024-08-13 15:15:04','2024-08-13 15:15:04',1,NULL,NULL,0),(91,'TRASLADO DEL HOTEL - APTO. CUSCO',NULL,'storage/servicios/traslado-del-hotel-apto-cusco.png',NULL,NULL,NULL,NULL,6,1,NULL,'#804000',NULL,'0','1','2024-08-13 15:15:55','2024-08-13 15:15:55',1,NULL,NULL,0);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipo_cambios`
--

LOCK TABLES `tipo_cambios` WRITE;
/*!40000 ALTER TABLE `tipo_cambios` DISABLE KEYS */;
INSERT INTO `tipo_cambios` VALUES (1,3.725,3.731,'2024-08-12','2024-08-12 15:39:02','2024-08-12 15:39:02');
/*!40000 ALTER TABLE `tipo_cambios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `totals`
--

LOCK TABLES `totals` WRITE;
/*!40000 ALTER TABLE `totals` DISABLE KEYS */;
/*!40000 ALTER TABLE `totals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ubicacions`
--

LOCK TABLES `ubicacions` WRITE;
/*!40000 ALTER TABLE `ubicacions` DISABLE KEYS */;
INSERT INTO `ubicacions` VALUES (1,'CUSCO','/storage/ubicaciones/default.png','1','2024-08-12 15:38:22','2024-08-12 15:38:22'),(2,'LIMA','/storage/ubicaciones/default.png','1','2024-08-12 15:38:22','2024-08-12 15:38:22'),(3,'PUNO','/storage/ubicaciones/default.png','1','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `ubicacions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'DAVID MIRANDA TARCO','982733597','dmirandatarco@gmail.com','2023-02-11','2023-10-16',NULL,NULL,'david','$2y$10$1wcKJp6sM0/ZIi9PRZiJh.t71QhcIPy8P/9B4xi9TJ24u.YDWBHTq','/storage/usuario/default.png',1,'1','2024-08-12 15:38:22','2024-08-12 15:38:22');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-13 10:26:43
