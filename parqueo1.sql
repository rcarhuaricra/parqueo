/*
SQLyog Ultimate v8.82 
MySQL - 5.5.5-10.1.9-MariaDB : Database - parqueo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`parqueo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `parqueo`;

/*Table structure for table `mp_cuadras` */

DROP TABLE IF EXISTS `mp_cuadras`;

CREATE TABLE `mp_cuadras` (
  `id_cuadras` int(11) NOT NULL AUTO_INCREMENT,
  `id_via` int(11) DEFAULT NULL,
  `cuadra` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_cuadras`),
  KEY `FK_mp_cuadras` (`id_via`),
  CONSTRAINT `FK_mp_cuadras` FOREIGN KEY (`id_via`) REFERENCES `mpcalle` (`codvia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `mp_cuadras` */

insert  into `mp_cuadras`(`id_cuadras`,`id_via`,`cuadra`) values (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7),(8,1,8),(9,1,9),(10,1,10),(11,2,3),(12,2,4);

/*Table structure for table `mp_tareaje` */

DROP TABLE IF EXISTS `mp_tareaje`;

CREATE TABLE `mp_tareaje` (
  `id_tareaje` varchar(25) NOT NULL,
  `iduser_parqueador` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `fecha_tarea` date DEFAULT NULL,
  `fecreg` datetime DEFAULT CURRENT_TIMESTAMP,
  `userreg` varchar(50) DEFAULT NULL,
  `fecmod` datetime DEFAULT NULL,
  `usermod` varchar(50) DEFAULT NULL,
  `id_cuadras` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tareaje`),
  KEY `FK_MP_tareaje` (`iduser_parqueador`),
  KEY `FK_MP_tareaje_turno` (`id_turno`),
  CONSTRAINT `FK_MP_tareaje` FOREIGN KEY (`iduser_parqueador`) REFERENCES `mpuser` (`iduser`),
  CONSTRAINT `FK_MP_tareaje_turno` FOREIGN KEY (`id_turno`) REFERENCES `mp_turno` (`id_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mp_tareaje` */

/*Table structure for table `mp_turno` */

DROP TABLE IF EXISTS `mp_turno`;

CREATE TABLE `mp_turno` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `txt_turno` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `mp_turno` */

insert  into `mp_turno`(`id_turno`,`txt_turno`) values (1,'MAÑANA'),(2,'TARDE');

/*Table structure for table `mpcalle` */

DROP TABLE IF EXISTS `mpcalle`;

CREATE TABLE `mpcalle` (
  `codvia` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `mpuser` */

insert  into `mpuser`(`iduser`,`user_name`,`user_ape_pat`,`user_ape_mat`,`email`,`numcelular`,`password`,`fecreg`,`idrol`) values (1,'RONALD','CARHUARICRA','VIVAS','RONALD.CARHUARICRA@MUNISANISIDRO.GOB.PE',964727438,'123456','2017-08-03 15:38:59',1),(2,'PEPITO','PERES','BOZ','PEPITO.PERES@MUNISANISIDRO.GOB.PE',321654987,'123456','2017-08-03 15:39:55',2),(3,'Maile','Kemp','Bernard','adipiscing.fringilla@ullamcorpereueuismod.co.uk',0,'123456','2017-06-07 00:34:06',2),(4,'Shad','Doyle','Juarez','euismod.est.arcu@Aeneanegestashendrerit.edu',0,'123456','2016-10-02 06:32:23',2),(5,'Logan','Pratt','Harding','at.arcu@inceptoshymenaeosMauris.edu',0,'123456','2017-11-25 09:57:52',2),(6,'Cade','Petersen','Cherry','in.lobortis@Vivamus.com',0,'123456','2018-02-28 03:41:58',2),(7,'Tashya','Petersen','Roberts','Donec.fringilla@convalliserat.ca',0,'123456','2018-05-19 14:52:00',2),(8,'Ivy','Davis','Brown','rhoncus@duiaugue.co.uk',0,'123456','2017-06-20 14:58:30',2),(9,'Karen','Church','Medina','odio.sagittis@eget.ca',0,'123456','2016-09-25 13:49:23',2),(10,'Ethan','Morse','Conner','sociis@vel.net',0,'123456','2016-12-22 07:09:07',2),(11,'Regan','Houston','Cantrell','sed.dictum.eleifend@natoquepenatibuset.co.uk',0,'123456','2016-09-01 18:12:48',2),(12,'Nicole','Greene','Marshall','nec.enim@velitduisemper.org',0,'123456','2017-10-02 17:57:44',2),(13,'Tobias','Gray','Beard','Sed@id.ca',0,'123456','2016-09-30 04:54:13',2),(14,'Lilah','Turner','Ellison','pede.Praesent@non.co.uk',0,'123456','2016-10-26 17:16:39',2);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `mpvehiculo` */

insert  into `mpvehiculo`(`idvehiculo`,`placa`,`codvia`,`iduserreg`,`horainicio`,`horafinal`,`idestado`,`observacion`,`hora_salida_parqueo`) values (1,'ABC-123',1,1,'2017-04-21 16:45:20','2017-04-21 18:45:20',4,NULL,NULL),(2,'321',2,1,'2017-04-28 12:45:14','2017-04-28 15:45:14',4,NULL,NULL),(3,'FGHH',1,1,'2017-05-18 12:25:46','2017-05-18 14:25:46',2,NULL,NULL),(4,'FGH-567',1,1,'2017-08-01 14:42:55','2017-08-01 16:42:55',4,NULL,NULL),(5,'321654',1,1,'2017-08-02 10:04:50','2017-08-02 12:04:50',1,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
