CREATE DATABASE  IF NOT EXISTS `aquaweb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `aquaweb`;
-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: 51.15.100.196    Database: aquaweb
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

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
-- Table structure for table `fish`
--

DROP TABLE IF EXISTS `fish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fish` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fish`
--

LOCK TABLES `fish` WRITE;
/*!40000 ALTER TABLE `fish` DISABLE KEYS */;
INSERT INTO `fish` VALUES (1,'Goldfish',6.00),(2,'Nemo',21.00),(3,'Piranha',36.00),(4,'Moraine',50.00),(5,'WhiteShark',128.00),(6,'AnglerFish',230.00),(7,'Mosasaurus',999.99);
/*!40000 ALTER TABLE `fish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` smallint NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` decimal(10,0) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$hS/GQioUygzsbVwNU6NafO/NRx.8l8VAtA.rbfdahp8DHp7W97BZ6','2021-12-18 16:21:50',999357),(2,'user','$2y$10$Xlr0MfcCvKVj.TFchJo9fux9hW499XgXmVu7ginUxGcGsUqTR5iPC','2021-12-17 21:36:13',559),(3,'lulo','$2y$10$kU4Ny5NWgNj1xyYNTLeMQOqwnm.PH8OgUjR.UzEvwtPUC4WJPnOMa','2021-12-18 16:37:50',9999987235),(13,'daniel','$2y$10$yk737.tp3IFThFmOqi4m2e95auHkVrJnyT.O8jhdJrHXMF64fiwNG','2021-12-27 15:21:13',62);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_fish`
--

DROP TABLE IF EXISTS `users_fish`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_fish` (
  `users_id` smallint NOT NULL,
  `position` smallint NOT NULL,
  `fish_id` smallint NOT NULL,
  `amount` smallint NOT NULL,
  `day_of_Purchase` datetime NOT NULL,
  `lastFed` datetime NOT NULL,
  PRIMARY KEY (`users_id`,`position`),
  KEY `fk_fish_id_idx` (`fish_id`),
  CONSTRAINT `fk_fish_id` FOREIGN KEY (`fish_id`) REFERENCES `fish` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_users_id` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_fish`
--

LOCK TABLES `users_fish` WRITE;
/*!40000 ALTER TABLE `users_fish` DISABLE KEYS */;
INSERT INTO `users_fish` VALUES (1,0,2,1,'2021-12-27 14:52:05','2021-12-27 17:02:42'),(1,1,1,1,'2021-12-27 16:18:47','2021-12-27 17:02:42'),(1,2,1,1,'2021-12-27 16:18:49','2021-12-27 17:02:42'),(1,3,1,1,'2021-12-27 16:19:46','2021-12-27 17:02:42'),(1,4,1,1,'2021-12-27 16:20:09','2021-12-27 17:02:42'),(1,5,1,1,'2021-12-27 16:20:40','2021-12-27 17:02:42'),(1,6,1,1,'2021-12-27 16:22:43','2021-12-27 17:02:42'),(1,7,1,1,'2021-12-27 16:23:40','2021-12-27 17:02:42'),(1,8,1,1,'2021-12-27 16:24:04','2021-12-27 17:02:42'),(3,0,4,1,'2021-12-27 15:21:29','2021-12-27 16:26:04'),(3,1,7,1,'2021-12-27 15:21:48','2021-12-27 16:26:04'),(3,2,6,1,'2021-12-27 15:21:50','2021-12-27 16:26:04'),(3,3,5,1,'2021-12-27 15:21:51','2021-12-27 16:26:04'),(3,4,4,1,'2021-12-27 15:21:53','2021-12-27 16:26:04'),(3,5,3,1,'2021-12-27 15:21:54','2021-12-27 16:26:04'),(3,6,1,1,'2021-12-27 15:22:54','2021-12-27 16:26:04'),(3,7,2,1,'2021-12-27 15:22:55','2021-12-27 16:26:04'),(3,8,3,1,'2021-12-27 15:22:57','2021-12-27 16:26:04'),(3,9,7,1,'2021-12-27 20:21:42','2021-12-27 20:21:42'),(3,10,6,1,'2021-12-27 20:21:43','2021-12-27 20:21:43'),(3,11,5,1,'2021-12-27 20:21:46','2021-12-27 20:21:46'),(3,12,2,1,'2021-12-27 20:21:47','2021-12-27 20:21:47'),(3,13,1,1,'2021-12-27 20:21:49','2021-12-27 20:21:49'),(13,0,2,1,'2021-12-27 15:21:27','2021-12-27 15:21:27'),(13,1,2,1,'2021-12-27 15:21:32','2021-12-27 15:21:32'),(13,2,1,1,'2021-12-27 15:21:34','2021-12-27 15:21:34');
/*!40000 ALTER TABLE `users_fish` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_visitors`
--

DROP TABLE IF EXISTS `users_visitors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_visitors` (
  `user_id` smallint NOT NULL,
  `ip` int unsigned NOT NULL,
  `last_visit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`ip`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_visitors`
--

LOCK TABLES `users_visitors` WRITE;
/*!40000 ALTER TABLE `users_visitors` DISABLE KEYS */;
INSERT INTO `users_visitors` VALUES (1,2130706433,'2021-12-27 20:22:17'),(2,2130706433,'2021-12-27 20:22:26'),(3,2130706433,'2021-12-27 20:21:10'),(13,2130706433,'2021-12-27 21:19:13');
/*!40000 ALTER TABLE `users_visitors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'aquaweb'
--

--
-- Dumping routines for database 'aquaweb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-27 22:24:54
