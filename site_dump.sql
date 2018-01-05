-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: site
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_content` text,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT '/img/home/no-image.jpg',
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `category_id_index` (`category_id`),
  CONSTRAINT `category_id_f_k` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (10,6,'rwerwer','werwer','werwerwer','/img/blog/c.jpg',1),(11,6,'nm,nm,','nm,nm,nm,','nm,nm,nm,','/img/blog/robot2.jpg',0),(13,6,'Article Title 1000','asdasdasd','asdasdasd','/img/blog/girl1.jpg',1),(14,6,'Article Title 1001','hjghjgj','ghjghjghj','/img/blog/14robot2.jpg',1),(15,6,'New Article 112',',nm,nm,','bnmbnmnmbnm','/img/blog/15c.jpg',1),(20,6,'asdasd','adasd','asdasd','/img/blog/20girl1.jpg',1),(21,6,'fgdfgdf','gdfgdf','gdfgdfg','/img/blog/59b4345a7a2c4girl4.jpg',1),(22,6,'dfgfg','dfgdf','gdfgdfg','/img/blog/59b4345223abdgirl2.jpg',1),(23,6,'dfsdfsd','fsdfsdf','sdfsdfsdf','/img/blog/59b430647f1fagirl3.jpg',1),(27,21,'sfsdfs','dfsdfs','dfsdfsdf','/img/blog/59b56480b4891c.jpg',1),(28,6,'New Article 1000','New description','New content','/img/blog/59e8fdf093b99robot2.jpg',1),(29,6,'yrtyr','tyrtyrtyr','tyrtyrtyrtyrtyrtyrty\r\nrtyrt\r\nyrty\r\nrtyrtyrtyrtyr\r\ntyrtyrtyrtyry','/img/blog/59ea2f39d1454girl1.jpg',1),(30,6,'yrtyr','tyrtyrtyr','tyrtyrtyrtyrtyrtyrty\r\nrtyrt\r\nyrty\r\nrtyrtyrtyrtyr\r\ntyrtyrtyrtyry','/img/blog/59ea305599339c.jpg',1),(31,6,'Article1','tyrtyrtyr\r\nsdfsdfsdfs\r\nfsdfsdfsdf','tyrtyrtyrtyrtyrtyrty','/img/blog/59ea3a5986106girl4.jpg',1),(47,6,'NEW TITLE','SHORT CONTENT','CONTENT','/img/home/no-image.jpg',0),(48,6,'NEW TITLE','SHORT CONTENT','CONTENT','/img/home/no-image.jpg',0),(49,6,'NEW TITLE','SHORT CONTENT','CONTENT','/img/home/no-image.jpg',0),(50,6,'NEW TITLE','SHORT CONTENT','CONTENT','/img/home/no-image.jpg',0),(51,6,'NEW TITLE','SHORT CONTENT','FOOOO','/img/home/no-image.jpg',0),(52,6,'NEW TITLE','SHORT CONTENT','CONTENT','/img/home/no-image.jpg',0),(53,6,'FOOOO111','SHORT FOOOO1','FOOOO1','/img/home/no-image.jpg',0),(54,6,'FOOOO111','SHORT FOOOO1','FOOOO1','/img/home/no-image.jpg',0),(55,6,'FOOOO111','SHORT FOOOO1','FOOOO1','/img/home/no-image.jpg',0);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `is_public` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_u_k` (`name`),
  KEY `parent_id_key` (`parent_id`),
  CONSTRAINT `parent_id_f_k` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (6,NULL,'Category 1',1),(19,NULL,'Category 2',1),(20,19,'Category 3',1),(21,20,'Category 4',1),(22,NULL,'Category 5',1),(34,NULL,'Category 6',1);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `registration_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_name_u_k` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,'2d2d1dc9d0672452977405bd20462fd2eeb6e4e0f1c25b8931e5c39063033700MjgzNzE0MjA2OTE0MDI3Mw8k7VTni/jy8e3nFQwubug=','$2y$10$h7ES9YhEnm7xc3SXR.B3z.YLhgKFlPrmduZSyk0c3kWb7J6tHZvNe','smith@test.com','87c223a64c63195a4c9bee054802bf7390055cb233f9613eddce75f33075412eMzY0NTIwNDkxNTMwOTgzOTSCKqkBC3DD7N92CS5AtWWfG6P8S2GMNSFtSfE1aU0h','2017-10-31 18:42:47'),(16,'722e7060fdd211b0af9c4800c549d694edc9518d333ac995b1933ffc45284feeMjgzNzE0MjA2OTE0MDI3M6JKW9QTXywKWkwVFEmTnIU=','$2y$10$IYbVjQlo7jDrUm5g.0bgKeVDRwu8XdTtbN.COtdPIXY5S03qeMn8e','johnson@test.com','10f6a93a0ca9caa5ca407067abfd38bd6d84461fc42732dfcc15647a9f24ec07MzY0NTIwNDkxNTMwOTgzOeHYI1ihtwycbWO+o9ZKmxBeND7avqgNfdWAqMj6ocv5','2017-10-31 18:52:43'),(17,'95e04a9cd38c1a65dea4d6badeecfe1027bc58ea9c0cc4eec2651ad606229001MjgzNzE0MjA2OTE0MDI3M+6tItCtF3ZR2aNeaWEd+lU=','$2y$10$0eByeCYFGG2RDqGB9qfdmOCDFIIgAZrewabP96YFtC8pvlwSH316q','pupkin@gmail.com','7680bc3726b5f34c76134fa7080b105dd97c68b121344acdc67d3b6c3970b882MDUwNTA2OTQ4MjMxMjMwNt2SZHNfhImCH9uuQoYmq4hDXFQGTRt2O/xfAT2kW6cp','2017-10-31 19:00:04'),(18,'cd61be4afe4f42dc0ed62aa8bdee8ad8b986ea0694046bcef54ad7f06ad486f4MjgzNzE0MjA2OTE0MDI3M4myralu4EfOO/LaYCC+6r4=','$2y$10$6v.fTYAhiY7nfy40/e/GeO34wTo4EONXFiVqXaIk0MWiYcFS9OMim','malone@gmail.com','526d798a50b79a91bc789d6e30fe8ae017eafb1455a16852ae4615d4cbd49bf7MzY0NTIwNDkxNTMwOTgzOWUBeUDNsb8ilO2iZxB44JP0mryGQiFs/LbSCjeerGUO','2017-11-08 19:35:27');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-04 18:05:12
