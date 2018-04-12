CREATE DATABASE  IF NOT EXISTS twitter /*!40100 DEFAULT CHARACTER SET utf8 */;
USE twitter;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: twitter
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table followers
--

DROP TABLE IF EXISTS followers;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE followers (
  follower_id int(11) NOT NULL,
  followed_id int(11) NOT NULL,
  PRIMARY KEY (follower_id,followed_id),
  KEY fk_users_has_users_users2_idx (followed_id),
  KEY fk_users_has_users_users1_idx (follower_id),
  CONSTRAINT fk_users_has_users_users1 FOREIGN KEY (follower_id) REFERENCES users (uid) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_users_has_users_users2 FOREIGN KEY (followed_id) REFERENCES users (uid) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table followers
--

LOCK TABLES followers WRITE;
/*!40000 ALTER TABLE followers DISABLE KEYS */;
INSERT INTO followers VALUES (2,1),(3,1),(4,1),(5,1),(10,1),(14,1),(4,2),(6,2),(7,2),(8,2),(9,2),(10,2),(13,2),(1,3),(7,3),(8,3),(14,3),(20,3),(1,4),(6,4),(11,4),(15,4),(20,4),(1,5),(2,5),(4,5),(10,5),(15,5),(20,5),(4,6),(9,6),(13,6),(18,6),(2,7),(5,7),(11,7),(16,7),(18,7),(5,8),(10,8),(17,8),(19,8),(2,9),(5,9),(8,9),(14,9),(7,10),(12,10),(17,10),(19,10),(5,11),(8,11),(16,11),(6,12),(12,12),(14,12),(19,12),(7,13),(8,13),(16,13),(20,13),(6,14),(11,14),(16,14),(18,14),(6,15),(9,15),(13,15),(3,16),(12,16),(15,16),(1,17),(3,17),(9,17),(17,17),(19,17),(7,18),(12,18),(13,18),(3,19),(11,19),(15,19),(4,20),(9,20),(17,20),(18,20);
/*!40000 ALTER TABLE followers ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table likes
--

DROP TABLE IF EXISTS likes;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE likes (
  tweets_tid int(11) NOT NULL,
  users_uid int(11) NOT NULL,
  PRIMARY KEY (tweets_tid,users_uid),
  KEY fk_tweets_has_users_users1_idx (users_uid),
  KEY fk_tweets_has_users_tweets1_idx (tweets_tid),
  CONSTRAINT fk_tweets_has_users_tweets1 FOREIGN KEY (tweets_tid) REFERENCES tweets (tid) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_tweets_has_users_users1 FOREIGN KEY (users_uid) REFERENCES users (uid) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table likes
--

LOCK TABLES likes WRITE;
/*!40000 ALTER TABLE likes DISABLE KEYS */;
INSERT INTO likes VALUES (2,1),(4,1),(2,2),(2,3),(13,3),(2,4),(11,4),(2,5),(5,5),(20,6),(19,7),(10,8),(6,9),(1,10),(17,11),(3,12),(7,13),(14,14),(18,15),(8,16),(1,17),(15,17),(16,18),(1,19),(9,19),(12,20);
/*!40000 ALTER TABLE likes ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table retweets
--

DROP TABLE IF EXISTS retweets;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE retweets (
  tid int(11) NOT NULL,
  uid int(11) NOT NULL,
  t_date date NOT NULL,
  PRIMARY KEY (tid,uid),
  KEY fk_tweets_has_users_users2_idx (uid),
  KEY fk_tweets_has_users_tweets2_idx (tid),
  CONSTRAINT fk_tweets_has_users_tweets2 FOREIGN KEY (tid) REFERENCES tweets (tid) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT fk_tweets_has_users_users2 FOREIGN KEY (uid) REFERENCES users (uid) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table retweets
--

LOCK TABLES retweets WRITE;
/*!40000 ALTER TABLE retweets DISABLE KEYS */;
INSERT INTO retweets VALUES (1,5,'2018-04-06'),(1,15,'2018-04-06'),(2,6,'2018-04-06'),(2,16,'2018-04-06'),(3,7,'2018-04-06'),(3,17,'2018-04-06'),(4,8,'2018-04-06'),(4,18,'2018-04-06'),(5,9,'2018-04-06'),(5,19,'2018-04-06'),(6,10,'2018-04-06'),(7,11,'2018-04-06'),(8,12,'2018-04-06'),(9,13,'2018-04-06');
/*!40000 ALTER TABLE retweets ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table tweets
--

DROP TABLE IF EXISTS tweets;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE tweets (
  tid int(11) NOT NULL AUTO_INCREMENT,
  uid int(11) NOT NULL,
  t_date date NOT NULL,
  t_text varchar(120) NOT NULL,
  PRIMARY KEY (tid),
  KEY fk_tweets_users1_idx (uid),
  CONSTRAINT fk_tweets_users1 FOREIGN KEY (uid) REFERENCES users (uid) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table tweets
--

LOCK TABLES tweets WRITE;
/*!40000 ALTER TABLE tweets DISABLE KEYS */;
INSERT INTO tweets VALUES (1,1,'2011-01-15','this is the text'),(2,2,'2018-04-06','liard'),(3,3,'2018-04-06','insolently'),(4,4,'2018-04-06','preballoted'),(5,5,'2018-04-06','artifice'),(6,6,'2018-04-06','holomorphism'),(7,7,'2018-04-06','afrikaner'),(8,8,'2018-04-06','ducaton'),(9,9,'2018-04-06','arcaro'),(10,10,'2018-04-06','sublaryngal'),(11,11,'2018-04-06','parhelion'),(12,12,'2018-04-06','energised'),(13,13,'2018-04-06','doubly'),(14,14,'2018-04-06','whinge'),(15,15,'2018-04-06','sloane'),(16,16,'2018-04-06','readorn'),(17,17,'2018-04-06','unsmarting'),(18,18,'2018-04-06','mewar'),(19,19,'2018-04-06','axinomancy'),(20,20,'2018-04-06','kain');
/*!40000 ALTER TABLE tweets ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table users
--

DROP TABLE IF EXISTS users;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE users (
  uid int(11) NOT NULL AUTO_INCREMENT,
  uname varchar(45) NOT NULL,
  upass varchar(45) NOT NULL,
  PRIMARY KEY (uid)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table users
--

LOCK TABLES users WRITE;
/*!40000 ALTER TABLE users DISABLE KEYS */;
INSERT INTO users VALUES (1,'Lacie  ','123456'),(2,'Tova  ','123456789'),(3,'Cristine  ','qwerty'),(4,'Rich  ','12345678'),(5,'Suzan  ','111111'),(6,'Zaida  ','1234567890'),(7,'Gay  ','1234567'),(8,'Elvia  ','password'),(9,'Soo  ','123123'),(10,'Lynwood  ','987654321'),(11,'Kirstie  ','qwertyuiop'),(12,'Julia  ','mynoob'),(13,'Mana  ','123321'),(14,'Margarita  ','666666'),(15,'Gaston  ','18atcskd2w'),(16,'Nikita  ','7777777'),(17,'Bradly  ','1q2w3e4r'),(18,'Martin  ','654321'),(19,'Mitzie  ','555555'),(20,'Brittany  ','3rjs1la7qe');
/*!40000 ALTER TABLE users ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-06 17:49:24
