-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: restaurant_db
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Current Database: `restaurant_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `restaurant_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `restaurant_db`;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'C001','Arun Kumar','9876543210','arun@gmail.com','Chennai','Male','2026-10-26 09:58:02'),(2,'C002','Priya','9876501234','priya@gmail.com','Coimbatore','Female','2026-10-26 09:58:02'),(3,'C003','Rahul','9123456789','rahul@gmail.com','Madurai','Male','2026-10-26 09:58:02'),(4,'C004','Divya','9988776655','divya@gmail.com','Salem','Female','2026-10-26 09:58:02'),(5,'C005','Karthik','9012345678','karthik@gmail.com','Erode','Male','2026-10-26 09:58:02'),(6,'C006','Anitha','9345678901','anitha@gmail.com','Trichy','Female','2026-10-26 09:58:02'),(7,'C007','Vijay','9789012345','vijay@gmail.com','Tirunelveli','Male','2026-10-26 09:58:02'),(8,'C008','Meena','9871234560','meena@gmail.com','Vellore','Female','2026-10-26 09:58:02'),(9,'C009','Suresh','9367890123','suresh@gmail.com','Thanjavur','Male','2026-10-26 09:58:02'),(10,'C010','Kavya','9845678901','kavya@gmail.com','Namakkal','Female','2026-10-26 09:58:02'),(11,'C011','Ramesh','9874561230','ramesh@gmail.com','Karur','Male','2026-10-26 09:58:02'),(12,'C012','Nisha','9956789012','nisha@gmail.com','Dindigul','Female','2026-10-26 09:58:02'),(13,'C013','Prakash','9445678901','prakash@gmail.com','Thoothukudi','Male','2026-10-26 09:58:02'),(14,'C014','Deepa','9001234567','deepa@gmail.com','Cuddalore','Female','2026-10-26 09:58:02'),(15,'C015','Hari','9798765432','hari@gmail.com','Sivakasi','Male','2026-10-26 09:58:02'),(16,'C016','Keerthana','9887654321','keerthana@gmail.com','Virudhunagar','Female','2026-10-26 09:58:02'),(17,'C017','Manoj','9340011223','manoj@gmail.com','Nagercoil','Male','2026-10-26 09:58:02'),(18,'C018','Swathi','9877001122','swathi@gmail.com','Kanchipuram','Female','2026-10-26 09:58:02'),(19,'C019','Ajith','9011223344','ajith@gmail.com','Tiruppur','Male','2026-10-26 09:58:02'),(20,'C020','Lavanya','9900112233','lavanya@gmail.com','Pollachi','Female','2026-10-26 09:58:02'),(21,'C021','Santhosh','9788112233','santhosh@gmail.com','Hosur','Male','2026-10-26 09:58:02'),(22,'C022','Revathi','9866223344','revathi@gmail.com','Dharmapuri','Female','2026-10-26 09:58:02'),(23,'C023','Lokesh','9122334455','lokesh@gmail.com','Mayiladuthurai','Male','2026-10-26 09:58:02'),(24,'C024','Gayathri','9877334455','gayathri@gmail.com','Nagapattinam','Female','2026-10-26 09:58:02'),(25,'C025','Bharath','9011445566','bharath@gmail.com','Pudukkottai','Male','2026-10-26 09:58:02'),(26,'C026','Shalini','9888556677','shalini@gmail.com','Ramanathapuram','Female','2026-10-26 09:58:02'),(27,'C027','Vinoth','9344556677','vinoth@gmail.com','Krishnagiri','Male','2026-10-26 09:58:02'),(28,'C028','Monika','9777665544','monika@gmail.com','Tenkasi','Female','2026-10-26 09:58:02'),(29,'C029','Sathish','9009988776','sathish@gmail.com','Villupuram','Male','2026-10-26 09:58:02'),(30,'C030','Preethi','9899887766','preethi@gmail.com','Kumbakonam','Female','2026-10-26 09:58:02');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'Chicken Biryani','Biryani',180.00,'Available'),(2,'Mutton Biryani','Biryani',250.00,'Available'),(3,'Veg Biryani','Biryani',140.00,'Available'),(4,'Chicken Fried Rice','Rice',160.00,'Available'),(5,'Veg Fried Rice','Rice',120.00,'Available'),(6,'Chicken Noodles','Noodles',150.00,'Available'),(7,'Veg Noodles','Noodles',110.00,'Available'),(8,'Masala Dosa','South Indian',80.00,'Available'),(9,'Plain Dosa','South Indian',60.00,'Available'),(10,'Idli','South Indian',50.00,'Available'),(11,'Vada','South Indian',45.00,'Available'),(12,'Paneer Butter Masala','Main Course',160.00,'Available'),(13,'Chicken 65','Starters',140.00,'Available'),(14,'Paneer Tikka','Starters',130.00,'Available'),(15,'Chicken Tikka','Starters',180.00,'Available'),(16,'French Fries','Fast Food',90.00,'Available'),(17,'Veg Burger','Fast Food',100.00,'Available'),(18,'Chicken Burger','Fast Food',140.00,'Available'),(19,'Gulab Jamun','Dessert',60.00,'Available'),(20,'Ice Cream','Dessert',70.00,'Available');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `delivery_address` text DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'Pending',
  `total` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,101,'Johnathan Doe','Chicken Biryani',2,'2026-10-22','123 MG Road, Chennai','Pending',440.00,'2026-10-22 12:57:57'),(2,102,'Nagu','Parotta',2,'2026-10-22','12-B yavarum nalam street Chennai','Pending',100.00,'2026-10-22 13:09:45');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,'Arun Kumar',5,'The Chicken Biryani and Jigarthanda were absolutely authentic and delicious! Excellent service.','2026-10-22 14:00:00'),(2,'Priya S.',5,'Best South Indian dosas in town. Crispy, fresh, and hot sambar!','2026-10-22 14:45:00'),(5,'Meena Ramesh',5,'Loved the Masala Dosa and filter coffee! Courteous staff and quick service.','2026-10-23 02:30:12'),(6,'Nagu',4,'biryani super','2026-10-23 03:00:29');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'System Administrator','admin','admin@restaurant.com','9876543210','$2y$10$z13pbstW/vzS9tGspMiU1OKnjGo6j/MqIuN1Hkfwf4qdNHN5T2D6C','admin','2026-10-22 12:56:51'),(4,'Nagu','NK','nageshwaran@gmail.com','','$2y$10$9dnhn5arI7vFisJoZJ/7feDRZqlvwLsfg4CcrwpSomjr5Wo7qg7V6','customer','2026-10-22 13:08:28');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-26 15:31:11
