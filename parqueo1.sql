/*
SQLyog Ultimate v8.82 
MySQL - 5.1.73 : Database - parqueo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`parqueo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `parqueo`;

/*Table structure for table `mpcalle` */

DROP TABLE IF EXISTS `mpcalle`;

CREATE TABLE `mpcalle` (
  `codvia` int(5) NOT NULL AUTO_INCREMENT,
  `tipoVia` varchar(10) DEFAULT NULL,
  `nombrevia` varchar(30) DEFAULT NULL,
  `tiempoparqueo` int(1) DEFAULT NULL,
  `flgestado` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`codvia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mpcalle` */

insert  into `mpcalle`(`codvia`,`tipoVia`,`nombrevia`,`tiempoparqueo`,`flgestado`) values (1,'AV.','CONQUISTADORES',120,'1'),(2,'CALLE','DASSO',180,'1');

/*Table structure for table `mpestadovehiculo` */

DROP TABLE IF EXISTS `mpestadovehiculo`;

CREATE TABLE `mpestadovehiculo` (
  `idestado` int(5) NOT NULL AUTO_INCREMENT,
  `txtestado` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`idestado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `mpestadovehiculo` */

insert  into `mpestadovehiculo`(`idestado`,`txtestado`) values (1,'ESTACIONADO'),(2,'CULMINADO'),(3,'REMOLCADO'),(4,'ANULADO');

/*Table structure for table `mproles` */

DROP TABLE IF EXISTS `mproles`;

CREATE TABLE `mproles` (
  `idrol` int(5) NOT NULL AUTO_INCREMENT,
  `txtrol` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mproles` */

insert  into `mproles`(`idrol`,`txtrol`) values (1,'ADMINISTRADOR'),(2,'PARQUEADOR');

/*Table structure for table `mpuser` */

DROP TABLE IF EXISTS `mpuser`;

CREATE TABLE `mpuser` (
  `iduser` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(40) DEFAULT NULL,
  `user_ape_pat` varchar(40) DEFAULT NULL,
  `user_ape_mat` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `numcelular` int(9) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fecreg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idrol` int(5) DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  KEY `idrol` (`idrol`),
  CONSTRAINT `mpuser_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `mproles` (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `mpuser` */

insert  into `mpuser`(`iduser`,`user_name`,`user_ape_pat`,`user_ape_mat`,`email`,`numcelular`,`password`,`fecreg`,`idrol`) values (1,'RONALD','CARHUARICRA','VIVAS','RONALD.CARHUARICRA@MUNISANISIDRO.GOB.PE',964727438,'123456','2017-04-18 20:10:08',1);

/*Table structure for table `mpvehiculo` */

DROP TABLE IF EXISTS `mpvehiculo`;

CREATE TABLE `mpvehiculo` (
  `idvehiculo` int(5) NOT NULL AUTO_INCREMENT,
  `placa` varchar(15) DEFAULT NULL,
  `codvia` int(5) DEFAULT NULL,
  `iduserreg` int(5) DEFAULT NULL,
  `horainicio` datetime DEFAULT NULL,
  `horafinal` datetime DEFAULT NULL,
  `idestado` int(5) DEFAULT '1',
  `observacion` varchar(200) DEFAULT NULL,
  `hora_salida_parqueo` datetime DEFAULT NULL,
  PRIMARY KEY (`idvehiculo`),
  KEY `iduser` (`iduserreg`),
  KEY `FK_mpvehiculo` (`codvia`),
  KEY `FK_mpvehiculoestado` (`idestado`),
  CONSTRAINT `FK_mpvehiculo` FOREIGN KEY (`codvia`) REFERENCES `mpcalle` (`codvia`),
  CONSTRAINT `FK_mpvehiculoestado` FOREIGN KEY (`idestado`) REFERENCES `mpestadovehiculo` (`idestado`),
  CONSTRAINT `mpvehiculo_ibfk_1` FOREIGN KEY (`iduserreg`) REFERENCES `mpuser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `mpvehiculo` */

insert  into `mpvehiculo`(`idvehiculo`,`placa`,`codvia`,`iduserreg`,`horainicio`,`horafinal`,`idestado`,`observacion`,`hora_salida_parqueo`) values (1,'ABC-123',1,1,'2017-04-21 16:45:20','2017-04-21 18:45:20',4,NULL,NULL),(2,'ASD345',1,1,'2017-04-21 16:55:20','2017-04-21 18:55:20',4,NULL,NULL),(3,'987',2,1,'2017-04-21 09:57:54','2017-04-21 12:57:54',4,NULL,NULL),(4,'ASD-345',1,1,'2017-04-21 10:26:06','2017-04-21 12:26:06',4,NULL,NULL),(5,'ABC-963',1,1,'2017-04-21 10:31:30','2017-04-21 12:31:30',4,NULL,NULL),(6,'QWE-345',1,1,'2017-04-21 10:37:02','2017-04-21 12:37:02',4,NULL,NULL),(7,'QWE234',1,1,'2017-04-21 10:38:48','2017-04-21 12:38:48',2,NULL,NULL),(8,'MAURO123',1,1,'2017-04-21 10:42:42','2017-04-21 12:42:42',4,NULL,NULL),(9,'ASD-345',1,1,'2017-04-21 10:46:00','2017-04-21 12:46:00',4,NULL,NULL),(10,'ETT-456',1,1,'2017-04-21 10:47:35','2017-04-21 12:47:35',3,NULL,NULL),(11,'MAURO123',2,1,'2017-04-21 11:01:05','2017-04-21 14:01:05',2,NULL,NULL),(12,'RONA123',1,1,'2017-04-21 11:18:37','2017-04-21 13:18:37',3,NULL,NULL),(13,'HHHH',1,1,'2017-04-21 12:01:57','2017-04-21 14:01:57',4,NULL,NULL),(14,'ABC-456',1,1,'2017-04-23 15:28:53','2017-04-23 17:28:53',4,NULL,NULL),(15,'RTY234',1,1,'2017-04-26 16:30:56','2017-04-26 18:30:56',4,NULL,NULL),(16,'123ABC',1,1,'2017-04-26 16:36:27','2017-04-26 18:36:27',4,NULL,NULL),(17,'ABC567',1,1,'2017-04-26 18:06:58','2017-04-26 20:06:58',4,NULL,NULL),(18,'123ABC',2,1,'2017-04-26 18:28:38','2017-04-26 21:28:38',4,NULL,NULL),(19,'ABC123',2,1,'2017-04-27 09:59:55','2017-04-27 12:59:55',4,NULL,NULL),(20,'MAU113',1,1,'2017-04-27 10:06:11','2017-04-27 12:06:11',4,NULL,NULL),(21,'BUL123',2,1,'2017-04-27 10:42:11','2017-04-27 13:42:11',4,NULL,NULL),(22,'TYU123',1,1,'2017-04-27 14:35:30','2017-04-27 16:35:30',4,NULL,NULL),(23,'ASD-258',2,1,'2017-04-28 12:37:24','2017-04-28 15:37:24',1,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
