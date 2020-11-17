-- MySQL dump 10.13  Distrib 5.7.16, for Win64 (x86_64)
--
-- Host: localhost    Database: demo
-- ------------------------------------------------------
-- Server version	5.7.16

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
-- Table structure for table `dx_auth`
--

DROP TABLE IF EXISTS `dx_auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dx_auth` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '权限名称',
  `urls` varchar(100) NOT NULL COMMENT '权限地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dx_auth`
--

LOCK TABLES `dx_auth` WRITE;
/*!40000 ALTER TABLE `dx_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `dx_auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dx_dolog`
--

DROP TABLE IF EXISTS `dx_dolog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dx_dolog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL COMMENT '操作描述',
  `url` varchar(250) NOT NULL COMMENT '地址',
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='操作日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dx_dolog`
--

LOCK TABLES `dx_dolog` WRITE;
/*!40000 ALTER TABLE `dx_dolog` DISABLE KEYS */;
/*!40000 ALTER TABLE `dx_dolog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dx_role`
--

DROP TABLE IF EXISTS `dx_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dx_role` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `auth_list` varchar(500) NOT NULL COMMENT '权限列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dx_role`
--

LOCK TABLES `dx_role` WRITE;
/*!40000 ALTER TABLE `dx_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `dx_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dx_test`
--

DROP TABLE IF EXISTS `dx_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dx_test` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `age` varchar(50) NOT NULL DEFAULT '0',
  `egg` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `e` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dx_test`
--

LOCK TABLES `dx_test` WRITE;
/*!40000 ALTER TABLE `dx_test` DISABLE KEYS */;
INSERT INTO `dx_test` VALUES (1,'11','0','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'22','0','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'11','0','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `dx_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dx_user`
--

DROP TABLE IF EXISTS `dx_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dx_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `pword` char(32) NOT NULL,
  `rule_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`uname`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dx_user`
--

LOCK TABLES `dx_user` WRITE;
/*!40000 ALTER TABLE `dx_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `dx_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-21 15:12:42
