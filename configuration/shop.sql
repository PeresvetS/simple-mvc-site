-- MySQL dump 10.13  Distrib 5.7.17, for Linux (x86_64)
--
-- Host: localhost    Database: mvc-site
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.17.04.1

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
-- Table structure for table `basket`
--

DROP TABLE IF EXISTS `basket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basket` (
  `id_basket` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_good` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id_basket`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `basket`
--

LOCK TABLES `basket` WRITE;
/*!40000 ALTER TABLE `basket` DISABLE KEYS */;
INSERT INTO `basket` VALUES (2,1,1,1000),(73,5,4,38),(74,5,4,38),(75,5,2,52),(76,5,3,22),(77,5,3,22),(78,5,2,52),(79,5,2,52);
/*!40000 ALTER TABLE `basket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `id_good` int(11) NOT NULL AUTO_INCREMENT,
  `good_name` varchar(300) NOT NULL,
  `good_description` varchar(9999) NOT NULL,
  `good_price` int(11) NOT NULL,
  `good_type` varchar(99) NOT NULL,
  `is_active` int(11) NOT NULL,
  `good_img` varchar(999) NOT NULL,
  PRIMARY KEY (`id_good`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'MANGO','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',12,'Men',1,'img/1-t-shirt.jpg'),(2,'PEOPLE T-SHIRT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',52,'Women',1,'img/2-t-shirt.jpg'),(3,'T-SHIRT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',22,'Men',1,'img/3-t-shirt.jpg'),(4,'MANGO PEOPLE DRESS','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',38,'Women',1,'img/4-t-shirt.jpg'),(5,'HAT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',10,'Men',1,'img/5-t-shirt.jpg'),(6,'BOOTS','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',90,'Men',1,'img/1-t-shirt.jpg'),(7,'TOPMAN','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',99,'Kids',1,'img/7-t-shirt.jpg'),(8,'ZARA','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',15,'Kids',1,'img/8-t-shirt.jpg'),(9,'TOPMAN T-SHIRT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',1000,'Men',0,'img/8-t-shirt.jpg'),(10,'TOPWOMEN','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',123,'Women',1,'img/7-t-shirt.jpg'),(17,'MANGO PEOPLE T-SHIRT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',44,'Women',1,'img/2-t-shirt.jpg'),(18,'TOPMAN T-SHIRT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',17,'Women',1,'img/4-t-shirt.jpg'),(19,'HAT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',66,'Women',1,'img/lady4.png'),(20,'MANGO PEOPLE T-SHIRT','Compellingly actualize fully researched processes before proactive outsourcing. Progressively syndicate collaborative architectures before cutting-edge services. Completely visualize parallel core competencies rather than exceptional portals.',76,'Kids',0,'img/lady4.png');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `news_title` varchar(999) NOT NULL,
  `news_content` varchar(9999) NOT NULL,
  `datetime_create` varchar(139) DEFAULT NULL,
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'Test','Test','0000-00-00 00:00:00'),(2,'123','123','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `datetime_create` date DEFAULT NULL,
  `id_order_status` int(11) NOT NULL,
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (2,1,1000,'2017-08-01',1),(3,1,1000,'2017-08-01',1),(4,8,62,'2016-08-20',1),(5,8,62,'2016-08-20',1);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_status` (
  `id_order_status` int(11) NOT NULL AUTO_INCREMENT,
  `order_status_name` varchar(29) NOT NULL,
  PRIMARY KEY (`id_order_status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_status`
--

LOCK TABLES `order_status` WRITE;
/*!40000 ALTER TABLE `order_status` DISABLE KEYS */;
INSERT INTO `order_status` VALUES (1,'new'),(2,'accepted'),(3,'executed'),(4,'cancelled');
/*!40000 ALTER TABLE `order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(300) NOT NULL,
  `user_login` varchar(300) NOT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_last_action` varchar(80) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','$2a$08$ZDYxOGU5ODA0YTk3M2Y1YugWWmWSZ0TTigwlFqe7TePdk6KanN5WS','0000-00-00',''),(5,'asdasd','asdasd','$2a$08$NGZjMGQzZDBiYTkyOWFiNusO8hPEafYHiMSVVmgXjsh9fAI6CQxD2','14.08.2017 16:50:35','asd@aa.asd'),(6,'asdasd1','1asdasd','$2a$08$NGQ5YzEwYjUyMTdjZTUwNOYKMl8Emnbt9FFln4cbz/z4yMcSyBvK','14.08.2017 17:04:53','asd@aa.asd'),(7,'asd','asd','$2a$08$YzVlZmQ3MTdlMTQxNGNkN.sH5RhINffZCVGd/WlJ3Kf7nf/S4PZDm','14.08.2017 17:54:25','asd@aa.asd'),(8,'master','master','$2a$08$Mjg4ODU2YmM3ZTkxZjIyO.zXLv3dSBxcZ53vXajgJ4ljUMzeSTF3K','15.08.2017 19:32:50','master@asd.ru');
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

-- Dump completed on 2017-08-16 23:30:02
