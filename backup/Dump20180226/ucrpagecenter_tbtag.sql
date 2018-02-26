-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: ucrpagecenter
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `tbtag`
--

DROP TABLE IF EXISTS `tbtag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbtag` (
  `tagactivityid` int(11) NOT NULL,
  `tagword` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tagactivityid`,`tagword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbtag`
--

LOCK TABLES `tbtag` WRITE;
/*!40000 ALTER TABLE `tbtag` DISABLE KEYS */;
INSERT INTO `tbtag` VALUES (2,';'),(2,'acontecimiento'),(2,'acordar'),(2,'acordes'),(2,'acuerdo'),(2,'aire'),(2,'aireacion'),(2,'aireo'),(2,'ajuste'),(2,'algo'),(2,'alguien'),(2,'alterando'),(2,'ambiente'),(2,'apariencia'),(2,'articulo'),(2,'aspecto'),(2,'ataque'),(2,'atiene'),(2,'atmosfera'),(2,'atrevido'),(2,'audicion'),(2,'autonomo'),(2,'brisa'),(2,'buen'),(2,'cambio'),(2,'cancion'),(2,'cantan'),(2,'cara'),(2,'carece'),(2,'cargas'),(2,'cheques'),(2,'cielo'),(2,'cine'),(2,'circunstancias'),(2,'combinar'),(2,'composicion'),(2,'composiciones'),(2,'comprometida'),(2,'concierto'),(2,'concordar'),(2,'concordia'),(2,'condicion'),(2,'conjuntamente'),(2,'conjunto'),(2,'construye'),(2,'convenio'),(2,'corriente'),(2,'cosa'),(2,'cosas'),(2,'culpa'),(2,'decidir'),(2,'decretos'),(2,'descanso'),(2,'descocado'),(2,'desenvuelto'),(2,'desocupado'),(2,'disfrutar'),(2,'dispensado'),(2,'disponible'),(2,'disposicion'),(2,'diversos'),(2,'donaire'),(2,'ejecuta'),(2,'elegancia'),(2,'ellos'),(2,'emancipado'),(2,'emitir'),(2,'empleados'),(2,'encerrado'),(2,'engreimiento'),(2,'entablar'),(2,'entre'),(2,'escapado'),(2,'escrito'),(2,'espacio'),(2,'esta'),(2,'establecidos'),(2,'eter'),(2,'evadido'),(2,'excarcelado'),(2,'exento'),(2,'eximir'),(2,'expedir'),(2,'expedito'),(2,'expresion'),(2,'facultad'),(2,'figura'),(2,'forma'),(2,'formar'),(2,'franco'),(2,'fuera'),(2,'fugado'),(2,'funcion'),(2,'gala'),(2,'gallardia'),(2,'garbo'),(2,'gaseosa'),(2,'gracia'),(2,'grado'),(2,'grupo'),(2,'hacer'),(2,'huido'),(2,'impedimentos'),(2,'independiente'),(2,'inocente'),(2,'instrumentos'),(2,'interpretacion'),(2,'intr'),(2,'jactarse'),(2,'lentitud'),(2,'letras'),(2,'liberado'),(2,'libertado'),(2,'libertino'),(2,'librado'),(2,'libre'),(2,'llevan'),(2,'melodia'),(2,'mezcla'),(2,'modo'),(2,'molestia'),(2,'musica'),(2,'musical'),(2,'musicales'),(2,'nadie'),(2,'ninguna'),(2,'obligacion'),(2,'obligaciones'),(2,'obra'),(2,'obrar'),(2,'obstaculos'),(2,'ocio'),(2,'ocupado'),(2,'orden'),(2,'ordenes'),(2,'oreo'),(2,'orgullo'),(2,'original'),(2,'osado'),(2,'otra'),(2,'oxigeno'),(2,'pactar'),(2,'pacto'),(2,'pago'),(2,'para'),(2,'paralisis'),(2,'parecido'),(2,'parte'),(2,'peligro'),(2,'personal'),(2,'personas'),(2,'petulancia'),(2,'pinta'),(2,'plante'),(2,'poner'),(2,'porte'),(2,'prep'),(2,'preservar'),(2,'preso'),(2,'presumir'),(2,'principal'),(2,'prnl'),(2,'publica'),(2,'rapidez'),(2,'recital'),(2,'redimido'),(2,'regla'),(2,'rescatado'),(2,'rigurosamente'),(2,'rodean'),(2,'sacar'),(2,'sentencias'),(2,'sentido'),(2,'sesion'),(2,'soberano'),(2,'soberbia'),(2,'sobre'),(2,'soltera'),(2,'sometido'),(2,'soplo'),(2,'sostener'),(2,'suelto'),(2,'sujeto'),(2,'tambien'),(2,'terrestre'),(2,'texto'),(2,'tiene'),(2,'tierra'),(2,'tocan'),(2,'todo'),(2,'tonada'),(2,'trato'),(2,'usos'),(2,'vacante'),(2,'vacio'),(2,'vanidad'),(2,'varios'),(2,'ventilacion'),(2,'verbo'),(2,'verbos'),(2,'viene'),(2,'viento'),(2,'voces');
/*!40000 ALTER TABLE `tbtag` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-26  7:55:32
