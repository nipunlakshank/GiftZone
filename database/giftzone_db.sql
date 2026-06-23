-- MySQL dump 10.13  Distrib 8.0.27, for macos11 (arm64)
--
-- Host: 127.0.0.1    Database: giftzone_db
-- ------------------------------------------------------
-- Server version	9.6.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ 'fec3022e-949b-11ef-9d37-e20057b790ad:1-6597';

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cart_users1_idx` (`users_id`),
  CONSTRAINT `fk_cart_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `products_id` int NOT NULL,
  `qty` int DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cart_has_products_products1_idx` (`products_id`),
  KEY `fk_cart_has_products_cart1_idx` (`cart_id`),
  CONSTRAINT `fk_cart_has_products_cart1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  CONSTRAINT `fk_cart_has_products_products1` FOREIGN KEY (`products_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Cakes','2023-09-02 17:16:08',NULL),(2,'Chocolates','2023-09-02 17:16:08','2023-09-02 20:57:06'),(3,'Cosmetics','2023-09-02 17:16:08',NULL),(4,'Fashion Accessories','2023-09-02 17:16:08',NULL),(5,'Flowers','2023-09-02 17:16:08',NULL),(6,'Fruit Baskets','2023-09-02 17:16:08',NULL),(7,'Gift Boxes','2023-09-02 17:16:08',NULL),(8,'Gift Hampers','2023-09-02 17:16:08',NULL),(9,'Greeting Cards','2023-09-02 17:16:08',NULL),(10,'Jewellery','2023-09-02 17:16:08',NULL),(11,'Stationery Packages','2023-09-02 17:16:08',NULL),(12,'Teddies','2023-09-02 17:16:08',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `categories_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_products_categories1_idx` (`categories_id`),
  CONSTRAINT `fk_products_categories1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Cake 1','cakes1.jpg',2400,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(2,'Cake 2','cakes2.jpg',2450,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(3,'Cake 3','cakes3.jpg',3000,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(4,'Cake 4','cakes4.jpg',3200,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(5,'Cake 5','cakes5.jpg',4500,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(6,'Cake 6','cakes6.jpg',4200,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(7,'Cake 7','cakes7.jpg',3700,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(8,'Cake 8','cakes8.jpg',6000,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(9,'Cake 9','cakes9.jpg',5400,1,'2023-09-02 20:27:13','2023-09-03 11:58:37'),(10,'Choco 1','chocolate1.jpg',1000,2,'2023-09-03 12:08:30',NULL),(11,'Choco 2','chocolate2.webp',980,2,'2023-09-03 12:08:30',NULL),(12,'Choco 3','chocolate3.jpg',1200,2,'2023-09-03 12:08:30',NULL),(13,'Choco 4','chocolate4.webp',1350,2,'2023-09-03 12:08:30',NULL),(14,'Choco 5','chocolate5.jpg',2000,2,'2023-09-03 12:08:30',NULL),(15,'Choco 6','chocolate6.jpg',2100,2,'2023-09-03 12:08:30',NULL),(16,'Choco 7','chocolate7.jpg',3000,2,'2023-09-03 12:08:30','2023-09-03 12:09:13'),(17,'Cosmetic 1','cosmetics1.jpg',3000,3,'2023-09-03 12:22:50',NULL),(18,'Cosmetic 2','cosmetics2.jpg',3200,3,'2023-09-03 12:22:50',NULL),(19,'Cosmetic 3','cosmetics3.jpg',2500,3,'2023-09-03 12:22:50',NULL),(20,'Cosmetic 4','cosmetics4.jpg',5000,3,'2023-09-03 12:22:50',NULL),(21,'Cosmetic 5','cosmetics5.jpg',6400,3,'2023-09-03 12:22:50',NULL),(22,'Cosmetic 6','cosmetics6.jpg',4200,3,'2023-09-03 12:22:50',NULL),(23,'Cosmetic 7','cosmetics7.jpg',3500,3,'2023-09-03 12:22:50',NULL),(24,'Fashion 1','fashion1.webp',500,4,'2023-09-03 12:46:19',NULL),(25,'Fashion 2','fashion2.webp',1500,4,'2023-09-03 12:46:19',NULL),(26,'Fashion 3','fashion3.png',2100,4,'2023-09-03 12:46:19',NULL),(27,'Fashion 4','fashion4.jpg',1000,4,'2023-09-03 12:46:19',NULL),(28,'Fashion 5','fashion5.jpg',2000,4,'2023-09-03 12:46:19',NULL),(29,'Fashion 6','fashion6.webp',2500,4,'2023-09-03 12:46:19',NULL),(30,'Fashion 7','fashion7.jpg',2300,4,'2023-09-03 12:46:19',NULL),(31,'Fashion 8','fashion8.jpg',800,4,'2023-09-03 12:46:19',NULL),(32,'Fashion 9','fashion9.avif',4000,4,'2023-09-03 12:46:19','2023-09-03 12:53:24'),(33,'Flower 1','flower1.jpg',1000,5,'2023-09-03 12:56:42',NULL),(34,'Flower 2','flower2.jpg',1200,5,'2023-09-03 12:56:42',NULL),(35,'Flower 3','flower3.jpg',500,5,'2023-09-03 12:56:42',NULL),(36,'Flower 4','flower4.jpg',900,5,'2023-09-03 12:56:42',NULL),(37,'Flower 5','flower5.webp',3000,5,'2023-09-03 12:56:42','2023-09-03 13:01:44'),(38,'Flower 6','flower6.jpg',4000,5,'2023-09-03 12:56:42',NULL),(39,'Basket 1','basket1.webp',1000,6,'2023-09-03 13:01:01',NULL),(40,'Basket 2','basket2.png',2000,6,'2023-09-03 13:01:01',NULL),(41,'Basket 3','basket3.webp',1200,6,'2023-09-03 13:01:01',NULL),(42,'Basket 4','basket4.jpg',1500,6,'2023-09-03 13:01:01',NULL),(43,'Basket 5','basket5.jpg',1300,6,'2023-09-03 13:01:01',NULL),(44,'Basket 6','basket6.jpg',1400,6,'2023-09-03 13:01:01',NULL),(45,'Basket 7','basket7.webp',2500,6,'2023-09-03 13:01:01',NULL),(46,'Gift 1','gift1.jpg',3000,7,'2023-09-03 13:10:03',NULL),(47,'Gift 2','gift2.webp',2000,7,'2023-09-03 13:10:03',NULL),(48,'Gift 3','gift3.jpg',4000,7,'2023-09-03 13:10:03',NULL),(49,'Gift 4','gift4.jpeg',1500,7,'2023-09-03 13:10:03',NULL),(50,'Gift 5','gift5.jpg',5000,7,'2023-09-03 13:10:03',NULL),(51,'Gift 6','gift6.jpg',4000,7,'2023-09-03 13:10:03',NULL),(52,'Gift 7','gift7.jpg',2600,7,'2023-09-03 13:10:03',NULL),(53,'Gift 8','gift8.webp',7000,7,'2023-09-03 13:10:03',NULL),(54,'Gift 9','gift9.webp',10000,7,'2023-09-03 13:10:03',NULL),(55,'Hamper 1','hamper1.jpg',3000,8,'2023-09-03 13:13:06',NULL),(56,'Hamper 2','hamper2.jpg',2000,8,'2023-09-03 13:13:06',NULL),(57,'Hamper 3','hamper3.jpg',4000,8,'2023-09-03 13:13:06',NULL),(58,'Hamper 4','hamper4.jpg',5000,8,'2023-09-03 13:13:06',NULL),(59,'Hamper 5','hamper5.jpg',2400,8,'2023-09-03 13:13:06',NULL),(60,'Hamper 6','hamper6.jpg',3000,8,'2023-09-03 13:13:06',NULL),(61,'Greeting 1','greeting1.jpg',2000,9,'2023-09-03 13:17:47',NULL),(62,'Greeting 2','greeting2.jpg',1800,9,'2023-09-03 13:17:47',NULL),(63,'Greeting 3','greeting3.jpg',3000,9,'2023-09-03 13:17:47',NULL),(64,'Greeting 4','greeting4.webp',2600,9,'2023-09-03 13:17:47',NULL),(65,'Greeting 5','greeting5.avif',1000,9,'2023-09-03 13:17:47',NULL),(66,'Greeting 6','greeting6.webp',4000,9,'2023-09-03 13:17:47',NULL),(67,'Greeting 7','greeting7.webp',3000,9,'2023-09-03 13:17:47',NULL),(68,'Greeting 8','greeting8.avif',5000,9,'2023-09-03 13:17:47',NULL),(69,'Greeting 9','greeting9.webp',2000,9,'2023-09-03 13:17:47',NULL),(70,'Greeting 10','greeting10.jpeg',1500,9,'2023-09-03 13:17:47',NULL),(71,'Jewellery 1','jewellery1.jpg',2000,10,'2023-09-03 13:21:17',NULL),(72,'Jewellery 2','jewellery2.jpg',1000,10,'2023-09-03 13:21:17',NULL),(73,'Jewellery 3','jewellery3.jpg',3000,10,'2023-09-03 13:21:17',NULL),(74,'Jewellery 4','jewellery4.jpg',4000,10,'2023-09-03 13:21:17',NULL),(75,'Jewellery 5','jewellery5.jpg',5000,10,'2023-09-03 13:21:17',NULL),(76,'Jewellery 6','jewellery6.jpg',2500,10,'2023-09-03 13:21:17',NULL),(77,'Jewellery 7','jewellery7.jpg',3400,10,'2023-09-03 13:21:17',NULL),(78,'Stationery 1','stationery1.jpg',1000,11,'2023-09-03 13:24:20',NULL),(79,'Stationery 2','stationery2.jpg',2000,11,'2023-09-03 13:24:20',NULL),(80,'Stationery 3','stationery3.webp',1200,11,'2023-09-03 13:24:20',NULL),(81,'Stationery 4','stationery4.webp',1500,11,'2023-09-03 13:24:20',NULL),(82,'Stationery 5','stationery5.jpg',1300,11,'2023-09-03 13:24:20',NULL),(83,'Teddy 1','teddy1.webp',5000,12,'2023-09-03 13:28:36',NULL),(84,'Teddy 2','teddy2.jpg',6000,12,'2023-09-03 13:28:36',NULL),(85,'Teddy 3','teddy3.jpg',7000,12,'2023-09-03 13:28:36',NULL),(86,'Teddy 4','teddy4.webp',10000,12,'2023-09-03 13:28:36',NULL),(87,'Teddy 5','teddy5.webp',8000,12,'2023-09-03 13:28:36',NULL),(88,'Teddy 6','teddy6.jpg',9000,12,'2023-09-03 13:28:36',NULL),(89,'Teddy 7','teddy7.webp',11000,12,'2023-09-03 13:28:36',NULL),(90,'Teddy 8','teddy8.webp',6000,12,'2023-09-03 13:28:36',NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `mobile` varchar(14) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `role` varchar(10) DEFAULT 'customer',
  `token` varchar(255) DEFAULT NULL,
  `otp` varchar(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping routines for database 'giftzone_db'
--
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-23 22:07:28
