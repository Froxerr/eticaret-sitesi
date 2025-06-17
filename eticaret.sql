-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: eticaret
-- ------------------------------------------------------
-- Server version	8.4.3

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

--
-- Table structure for table `auto_comp`
--

DROP TABLE IF EXISTS `auto_comp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auto_comp` (
  `id` int NOT NULL,
  `country_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `country_code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auto_comp`
--

LOCK TABLES `auto_comp` WRITE;
/*!40000 ALTER TABLE `auto_comp` DISABLE KEYS */;
INSERT INTO `auto_comp` VALUES (0,'India','IN','New Delhi'),(1,'Philippines','PH','San Nicolas'),(2,'China','CN','Lainqu'),(3,'Ireland','IE','Raheny'),(4,'Colombia','CO','Paicol'),(5,'Jamaica','JM','Lluidas Vale'),(6,'Tanzania','TZ','Mtwango'),(7,'France','FR','Arles'),(8,'Indonesia','ID','Sawangan'),(9,'Spain','ES','Murcia'),(10,'Brazil','BR','Ribeira do Pombal'),(11,'Moldova','MD','Ciorescu'),(12,'France','FR','Le Mans'),(13,'Russia','RU','Novyy Nekouz'),(14,'Indonesia','ID','Sarimukti Kaler'),(15,'Indonesia','ID','Suwalan'),(16,'Cuba','CU','Maisí'),(17,'Indonesia','ID','Pulosari'),(18,'Indonesia','ID','Banjarejo'),(19,'Japan','JP','Obama'),(20,'Indonesia','ID','Tekikbanyuurip'),(21,'Czech Republic','CZ','Veselí nad Lužnicí'),(22,'China','CN','Kanbula'),(23,'Portugal','PT','Paços de Ferreira'),(24,'Japan','JP','Kukichūō'),(25,'Egypt','EG','Qalyūb'),(26,'Netherlands','NL','Almelo'),(27,'Portugal','PT','Venda do Alcaide'),(28,'Iran','IR','Bastak'),(29,'Peru','PE','Aquia'),(30,'Brazil','BR','Ribeirão Preto'),(31,'China','CN','Taihu'),(32,'Armenia','AM','Spitak'),(33,'Nigeria','NG','Gakem'),(34,'Ecuador','EC','Piñas'),(35,'China','CN','Macun'),(36,'Philippines','PH','Parabcan'),(37,'Japan','JP','Naka'),(38,'China','CN','Huarong Chengguanzhen'),(39,'United States','US','Rockford'),(40,'China','CN','Jiaozuo'),(41,'Vietnam','VN','Thị Trấn Phú Mỹ'),(42,'China','CN','Haizhouwobao'),(43,'China','CN','Dongchuan'),(44,'China','CN','Xiayunling'),(45,'South Korea','KR','Heung-hai'),(46,'Sweden','SE','Åmål'),(47,'Albania','AL','Mamurras'),(48,'Ecuador','EC','Loja'),(49,'Czech Republic','CZ','Raškovice'),(50,'Brazil','BR','São Leopoldo'),(51,'Indonesia','ID','Kliwon Cibingbin'),(52,'Uzbekistan','UZ','To’rtko’l Shahri'),(53,'Indonesia','ID','Kotabaru'),(54,'Jordan','JO','Aţ Ţafīlah'),(55,'Thailand','TH','Lom Sak'),(56,'Bolivia','BO','Azurduy'),(57,'North Korea','KP','Hyesan-dong'),(58,'Mongolia','MN','Bayanhoshuu'),(59,'Indonesia','ID','Kalisabuk'),(60,'New Zealand','NZ','Whakatane'),(61,'Netherlands','NL','Eindhoven'),(62,'Sweden','SE','Borås'),(63,'China','CN','Guantouzui'),(64,'Poland','PL','Tarnowskie Góry'),(65,'Brazil','BR','Boituva'),(66,'Dominica','DM','Calibishie'),(67,'Albania','AL','Lis'),(68,'Bulgaria','BG','Boychinovtsi'),(69,'China','CN','Haishan'),(70,'Slovenia','SI','Razvanje'),(71,'Uzbekistan','UZ','Qo‘qon'),(72,'Greece','GR','Álimos'),(73,'Indonesia','ID','Kaca'),(74,'Indonesia','ID','Dodu Dua'),(75,'Portugal','PT','Quintela'),(76,'China','CN','Tianyu'),(77,'Sweden','SE','Kristianstad'),(78,'Philippines','PH','Maayong Tubig'),(79,'China','CN','Shanjie'),(80,'Philippines','PH','Montaneza'),(81,'Yemen','YE','Al Madīd'),(82,'Philippines','PH','Calauag'),(83,'Colombia','CO','Heliconia'),(84,'Indonesia','ID','Pandanwangi'),(85,'China','CN','Shuangpu'),(86,'Russia','RU','Vinsady'),(87,'France','FR','Montpellier'),(88,'Russia','RU','Kashin'),(89,'Russia','RU','Yukhnov'),(90,'China','CN','Jiaobei'),(91,'China','CN','Xiaohe'),(92,'Canada','CA','Taber'),(93,'Argentina','AR','Aristóbulo del Valle'),(94,'China','CN','Hengqu'),(95,'Burkina Faso','BF','Dédougou'),(96,'Mayotte','YT','Dembeni'),(97,'China','CN','Dengfeng'),(98,'Canada','CA','Whitehorse'),(99,'Reunion','RE','Saint-Denis'),(100,'Brazil','BR','Tubarão'),(101,'China','CN','Daping'),(102,'China','CN','Wangcun'),(103,'Russia','RU','Isheyevka'),(104,'China','CN','Mashizhai'),(105,'Philippines','PH','Ramon Magsaysay'),(106,'Nigeria','NG','Katagum'),(107,'China','CN','Maying'),(108,'Philippines','PH','Burgos'),(109,'Philippines','PH','Marsada'),(110,'Indonesia','ID','Blawi'),(111,'China','CN','Songyuan'),(112,'China','CN','Qiaotou'),(113,'United States','US','Pasadena'),(114,'Ecuador','EC','Celica'),(115,'China','CN','Jiangqiao'),(116,'Brazil','BR','Três Lagoas'),(117,'Panama','PA','El Coco'),(118,'Finland','FI','Hankasalmi'),(119,'United States','US','Nashville'),(120,'Russia','RU','Yalkhoy-Mokhk'),(121,'China','CN','Nanjing'),(122,'Sweden','SE','Trosa'),(123,'Germany','DE','Cottbus'),(124,'Brazil','BR','Cândido Mota'),(125,'China','CN','Heping'),(126,'Thailand','TH','Kosamphi Nakhon'),(127,'Russia','RU','Blagoveshchenka'),(128,'Nepal','NP','Nawal'),(129,'Philippines','PH','Caramay'),(130,'Indonesia','ID','Cikole'),(131,'Canada','CA','Nanton'),(132,'Indonesia','ID','Panyuran'),(133,'Indonesia','ID','Ceper'),(134,'Philippines','PH','Doong'),(135,'China','CN','Dalai'),(136,'China','CN','Daduchuan'),(137,'Chad','TD','Bitkine'),(138,'Indonesia','ID','Kampungbajo'),(139,'Philippines','PH','Biga'),(140,'Indonesia','ID','Paloh'),(141,'Indonesia','ID','Harjamukti'),(142,'Serbia','RS','Tršić'),(143,'Russia','RU','Volgodonsk'),(144,'Czech Republic','CZ','Horní Stropnice'),(145,'Poland','PL','Szczawno-Zdrój'),(146,'United States','US','San Diego'),(147,'Portugal','PT','Ribaldeira'),(148,'South Korea','KR','Icheon-si'),(149,'Czech Republic','CZ','Stochov'),(150,'Azerbaijan','AZ','Barda'),(151,'Philippines','PH','Latung'),(152,'United States','US','Lansing'),(153,'Iran','IR','Nūr'),(154,'Russia','RU','Gusev'),(155,'Bosnia and Herzegovina','BA','Ilići'),(156,'China','CN','Longmenfan'),(157,'Bosnia and Herzegovina','BA','Obudovac'),(158,'China','CN','Xinqiao'),(159,'China','CN','Yong’an'),(160,'China','CN','Songjiang'),(161,'Indonesia','ID','Cibangban Girang'),(162,'Brazil','BR','Pedra Branca'),(163,'Philippines','PH','Balingasag'),(164,'Thailand','TH','Nong Yai'),(165,'Philippines','PH','Sultan Kudarat'),(166,'Russia','RU','Vol’nyy Aul'),(167,'China','CN','Yangdenghu'),(168,'Brazil','BR','Boquira'),(169,'China','CN','Wuguishan'),(170,'Maldives','MV','Viligili'),(171,'China','CN','Lianjiangkou'),(172,'Botswana','BW','Mahalapye'),(173,'Brazil','BR','Piquete'),(174,'Portugal','PT','Pedreira'),(175,'Bosnia and Herzegovina','BA','Potoci'),(176,'Spain','ES','Pamplona/Iruña'),(177,'Syria','SY','‘Afrīn'),(178,'Philippines','PH','Balingasag'),(179,'Mexico','MX','La Guadalupe'),(180,'Greece','GR','Examília'),(181,'China','CN','Taihu'),(182,'Brazil','BR','Iporã'),(183,'Norway','NO','Bergen'),(184,'Ukraine','UA','Tsibulev'),(185,'China','CN','Huanghuai'),(186,'China','CN','Pinghu'),(187,'Mexico','MX','Magisterial'),(188,'Brazil','BR','Jatobá'),(189,'Portugal','PT','Figueiras'),(190,'China','CN','Qingduizi'),(191,'Greece','GR','Néa Karyá'),(192,'Russia','RU','Novogornyy'),(193,'Greece','GR','Mégara'),(194,'Brazil','BR','Propriá'),(195,'Israel','IL','Giv\'on HaHadasha'),(196,'Afghanistan','AF','Farah'),(197,'Serbia','RS','Adorjan'),(198,'Netherlands','NL','Amsterdam Nieuw West'),(199,'Croatia','HR','Garešnica'),(200,'Colombia','CO','Túquerres'),(201,'China','CN','Luci'),(202,'China','CN','Taohua'),(203,'Poland','PL','Suwałki'),(204,'Brazil','BR','Limoeiro'),(205,'China','CN','Nu’erbage'),(206,'Greece','GR','Vlycháda'),(207,'Afghanistan','AF','Qarchī Gak'),(208,'Japan','JP','Izumi'),(209,'France','FR','Paris 15'),(210,'Portugal','PT','São Bartolomeu'),(211,'Azerbaijan','AZ','Shamkhor'),(212,'Ukraine','UA','Truskavets'),(213,'France','FR','Alençon'),(214,'Palestinian Territory','PS','Ḩuwwārah'),(215,'Tunisia','TN','Al ‘Āliyah'),(216,'France','FR','Suresnes'),(217,'Honduras','HN','San Luis'),(218,'Ukraine','UA','Lazeshchyna'),(219,'Zimbabwe','ZW','Mazowe'),(220,'Sweden','SE','Jönköping'),(221,'Russia','RU','Vinsady'),(222,'Portugal','PT','Gondifelos'),(223,'China','CN','Zhujiaqiao'),(224,'Nigeria','NG','Abakaliki'),(225,'Japan','JP','Nakatsugawa'),(226,'Brazil','BR','Crato'),(227,'Russia','RU','Dugulubgey'),(228,'China','CN','Yangjiaqiao'),(229,'Colombia','CO','Nariño'),(230,'China','CN','Jiudu'),(231,'Portugal','PT','Souto de Cima'),(232,'China','CN','Taihe'),(233,'United States','US','Pasadena'),(234,'Russia','RU','Kabakovo'),(235,'China','CN','Quchi'),(236,'Sweden','SE','Åkersberga'),(237,'Colombia','CO','Campo de la Cruz'),(238,'Netherlands','NL','Maastricht'),(239,'Greece','GR','Rízoma'),(240,'Peru','PE','Mollebamba'),(241,'Mexico','MX','San Lorenzo'),(242,'Peru','PE','Andahuaylas'),(243,'Canada','CA','Crossfield'),(244,'United States','US','Louisville'),(245,'France','FR','Le Mans'),(246,'France','FR','Saint-Maur-des-Fossés'),(247,'Uzbekistan','UZ','Toshbuloq'),(248,'United States','US','Denver'),(249,'China','CN','Jiekeng'),(250,'Cameroon','CM','Somié'),(251,'Norway','NO','Oslo'),(252,'Indonesia','ID','Suwaduk'),(253,'Philippines','PH','Sitangkai'),(254,'Brazil','BR','Ibaté'),(255,'Poland','PL','Przystajń'),(256,'Japan','JP','Ikedachō'),(257,'Portugal','PT','Várzea da Serra'),(258,'Indonesia','ID','Kombapari'),(259,'Philippines','PH','Santa Paz'),(260,'China','CN','Haicheng'),(261,'Philippines','PH','Sambuluan'),(262,'Indonesia','ID','Kadukandel'),(263,'Sweden','SE','Kalix'),(264,'Uzbekistan','UZ','Bektemir'),(265,'Russia','RU','Tomsk'),(266,'China','CN','Qiaozhuang'),(267,'Russia','RU','Verkhniy Baskunchak'),(268,'China','CN','Guangping'),(269,'Greece','GR','Évlalo'),(270,'Malaysia','MY','Putrajaya'),(271,'Germany','DE','Bielefeld'),(272,'Russia','RU','Nezlobnaya'),(273,'China','CN','Xin Bulag'),(274,'China','CN','Shifan'),(275,'Sweden','SE','Kalmar'),(276,'Portugal','PT','Cabeças Verdes'),(277,'China','CN','Gaohe'),(278,'Russia','RU','Egvekinot'),(279,'Maldives','MV','Fonadhoo'),(280,'Mexico','MX','El Refugio'),(281,'China','CN','Lianhe'),(282,'Philippines','PH','Salvacion'),(283,'Palestinian Territory','PS','Jifnā'),(284,'Ethiopia','ET','Turmi'),(285,'Indonesia','ID','Poli'),(286,'French Polynesia','PF','Otutara'),(287,'Kazakhstan','KZ','Ekibastuz'),(288,'Indonesia','ID','Banjar Dauhmargi'),(289,'China','CN','Zhangpu'),(290,'Portugal','PT','Vila Chã'),(291,'Poland','PL','Bardo'),(292,'China','CN','Dajin'),(293,'Indonesia','ID','Wuluhan'),(294,'Peru','PE','Tantamayo'),(295,'Belarus','BY','Lyozna'),(296,'China','CN','Jiamachi'),(297,'Bolivia','BO','Eucaliptus'),(298,'Japan','JP','Kitaibaraki'),(299,'Mexico','MX','Luis Donaldo Colosio'),(300,'Tunisia','TN','La Mohammedia'),(301,'Brazil','BR','Cordeirópolis'),(302,'Brazil','BR','Sarzedo'),(303,'China','CN','Jianggezhuang'),(304,'Uruguay','UY','Florencio Sánchez'),(305,'Japan','JP','Shimabara'),(306,'Suriname','SR','Albina'),(307,'Japan','JP','Hashimoto'),(308,'China','CN','Weiting'),(309,'China','CN','Jincheng'),(310,'China','CN','Shangyuan'),(311,'Brazil','BR','Águas Formosas'),(312,'Indonesia','ID','Jawa'),(313,'China','CN','Yeshan'),(314,'China','CN','Dengfang'),(315,'United States','US','Sioux Falls'),(316,'Afghanistan','AF','Qarqīn'),(317,'Thailand','TH','Pa Mok'),(318,'France','FR','Chaumont'),(319,'Brazil','BR','Pirassununga'),(320,'Czech Republic','CZ','Stráž nad Nisou'),(321,'Poland','PL','Stanisław Dolny'),(322,'Ireland','IE','Blarney'),(323,'China','CN','Taoyuan'),(324,'China','CN','Daliuhao'),(325,'Indonesia','ID','Jagabaya Dua'),(326,'Brazil','BR','Paraíso'),(327,'France','FR','Niort'),(328,'Portugal','PT','Lameira'),(329,'Peru','PE','Mendoza'),(330,'Japan','JP','Kokubunji'),(331,'China','CN','Xiangba'),(332,'United States','US','Marietta'),(333,'Albania','AL','Bulqizë'),(334,'Philippines','PH','Tranca'),(335,'Czech Republic','CZ','Luhačovice'),(336,'South Korea','KR','Seongnam-si'),(337,'China','CN','Zhongshan'),(338,'Sweden','SE','Alingsås'),(339,'China','CN','Jiazhuang'),(340,'Cambodia','KH','Lumphăt'),(341,'Indonesia','ID','Soko'),(342,'Portugal','PT','Choca do Mar'),(343,'Portugal','PT','Vila Velha de Ródão'),(344,'Russia','RU','Uvarovo'),(345,'Serbia','RS','Debeljača'),(346,'Dominican Republic','DO','Oviedo'),(347,'Thailand','TH','Rasi Salai'),(348,'Colombia','CO','La Unión'),(349,'Indonesia','ID','Glondong'),(350,'Bangladesh','BD','Mehendiganj'),(351,'Slovenia','SI','Vrtojba'),(352,'Iran','IR','Arāk'),(353,'Philippines','PH','Naili'),(354,'China','CN','Machikou'),(355,'Cameroon','CM','Ngou'),(356,'Albania','AL','Vlorë'),(357,'Poland','PL','Pępowo'),(358,'China','CN','Jincheng'),(359,'Portugal','PT','Cruzeiro'),(360,'Russia','RU','Znamenskoye'),(361,'Indonesia','ID','Sitularang Landeuh'),(362,'Thailand','TH','Nong Bua Daeng'),(363,'Canada','CA','Armstrong'),(364,'Japan','JP','Shimonoseki'),(365,'United States','US','Shawnee Mission'),(366,'Russia','RU','Nizhniy Kurkuzhin'),(367,'France','FR','Locminé'),(368,'Iran','IR','Gālīkesh'),(369,'Philippines','PH','Pulong Sampalok'),(370,'Uzbekistan','UZ','Bulung’ur'),(371,'Croatia','HR','Hodošan'),(372,'Indonesia','ID','Matumadua'),(373,'Brazil','BR','Conselheiro Lafaiete'),(374,'Argentina','AR','Caseros'),(375,'Portugal','PT','Mosteiros'),(376,'China','CN','Jianping'),(377,'Indonesia','ID','Krajan Satu'),(378,'China','CN','Dalubian'),(379,'China','CN','Hualong'),(380,'Czech Republic','CZ','Žihle'),(381,'Indonesia','ID','Sinabang'),(382,'Moldova','MD','Chişinău'),(383,'Japan','JP','Toyota'),(384,'China','CN','Checun'),(385,'Brazil','BR','Tatuí'),(386,'Brazil','BR','Barra do Bugres'),(387,'Canada','CA','Lamont'),(388,'Sweden','SE','Umeå'),(389,'Portugal','PT','Pereiro'),(390,'Poland','PL','Piła'),(391,'Palestinian Territory','PS','Far‘ūn'),(392,'Philippines','PH','Mabayo'),(393,'Venezuela','VE','El Dividive'),(394,'United States','US','Greensboro'),(395,'Albania','AL','Lunik'),(396,'China','CN','Bajiazi'),(397,'Japan','JP','Oyabe'),(398,'China','CN','Shanxiahu'),(399,'Poland','PL','Sosnowiec'),(400,'Portugal','PT','Santa Maria do Souto'),(401,'Indonesia','ID','Palumbungan'),(402,'Philippines','PH','President Roxas'),(403,'China','CN','Bor Ondor'),(404,'Greece','GR','Vágia'),(405,'Serbia','RS','Pančevo'),(406,'Indonesia','ID','Tasikona'),(407,'Nigeria','NG','Kwatarkwashi'),(408,'Mexico','MX','Adolfo Ruiz Cortines'),(409,'Russia','RU','Sysert’'),(410,'Canada','CA','St. Thomas'),(411,'Ukraine','UA','Polonne'),(412,'Mexico','MX','San Isidro'),(413,'Finland','FI','Orivesi'),(414,'Japan','JP','Ginowan'),(415,'Yemen','YE','Al Khawkhah'),(416,'Burkina Faso','BF','Réo'),(417,'China','CN','Changting'),(418,'Poland','PL','Stalowa Wola'),(419,'Colombia','CO','Funes'),(420,'Venezuela','VE','Umuquena'),(421,'Poland','PL','Obsza'),(422,'Cambodia','KH','Kampong Chhnang'),(423,'France','FR','Golbey'),(424,'China','CN','Xuancheng'),(425,'Philippines','PH','Concepcion'),(426,'Israel','IL','Kefar Tavor'),(427,'Indonesia','ID','Buket Teukuh'),(428,'China','CN','Huixian Chengguanzhen'),(429,'China','CN','Qingshui'),(430,'Philippines','PH','San Agustin'),(431,'United States','US','Fairbanks'),(432,'Panama','PA','Potrero Grande'),(433,'China','CN','Huixing'),(434,'Greece','GR','Filótion'),(435,'China','CN','Shanhe'),(436,'Thailand','TH','Pho Thong'),(437,'Indonesia','ID','Growong Kidul'),(438,'Philippines','PH','Alcoy'),(439,'China','CN','Jingouhe'),(440,'Indonesia','ID','Mnelalete'),(441,'China','CN','Guankou'),(442,'Thailand','TH','Cho-airong'),(443,'China','CN','Xiangzikou'),(444,'Japan','JP','Kukichūō'),(445,'Argentina','AR','Inriville'),(446,'New Zealand','NZ','Pakuranga'),(447,'Thailand','TH','Bueng Khong Long'),(448,'Portugal','PT','Torreira'),(449,'Indonesia','ID','Cibeureum'),(450,'France','FR','Paris 06'),(451,'Armenia','AM','Spitak'),(452,'Argentina','AR','La Tigra'),(453,'Sweden','SE','Tierp'),(454,'Philippines','PH','Lipa City'),(455,'Thailand','TH','Dong Charoen'),(456,'Indonesia','ID','Lokorae'),(457,'France','FR','Tours'),(458,'Canada','CA','Princeton'),(459,'Dominican Republic','DO','Sabaneta'),(460,'Colombia','CO','San José del Guaviare'),(461,'Tanzania','TZ','Mlalo'),(462,'Brazil','BR','Ouricuri'),(463,'Japan','JP','Bungo-Takada-shi'),(464,'Indonesia','ID','Batanamang'),(465,'Sweden','SE','Pajala'),(466,'Mali','ML','Gao'),(467,'United States','US','Garland'),(468,'Indonesia','ID','Pakemitan Dua'),(469,'Greece','GR','Messíni'),(470,'Canada','CA','Bells Corners'),(471,'Albania','AL','Fushëkuqe'),(472,'Botswana','BW','Mathakola'),(473,'Czech Republic','CZ','Konice'),(474,'China','CN','Nanguzhuang'),(475,'Colombia','CO','Cáchira'),(476,'China','CN','Gaoyu'),(477,'Peru','PE','San Clemente'),(478,'Kazakhstan','KZ','Zyryanovsk'),(479,'Portugal','PT','Galamares'),(480,'Peru','PE','Sibayo'),(481,'China','CN','Guojia'),(482,'Indonesia','ID','Kebonagung'),(483,'France','FR','Paris 15'),(484,'Russia','RU','Krasnotur’insk'),(485,'Haiti','HT','Torbeck'),(486,'United States','US','Minneapolis'),(487,'Thailand','TH','Samut Songkhram'),(488,'Venezuela','VE','Tacarigua'),(489,'Brazil','BR','Itapipoca'),(490,'Syria','SY','Aş Şūrah aş Şaghīrah'),(491,'Portugal','PT','Lourido'),(492,'Russia','RU','Starokucherganovka'),(493,'Indonesia','ID','Jambean'),(494,'Peru','PE','Urpay'),(495,'Philippines','PH','San Martin'),(496,'China','CN','Huazhaizi'),(497,'Greece','GR','Galatás'),(498,'Russia','RU','Belgorod'),(499,'China','CN','Xiguantun Muguzu Manzuxiang'),(500,'China','CN','Jiangna');
/*!40000 ALTER TABLE `auto_comp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iletisim`
--

DROP TABLE IF EXISTS `iletisim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iletisim` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `soyadi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `eposta` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `telefon` int NOT NULL,
  `adres` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `konu` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `mesaj` text COLLATE utf8mb4_general_ci NOT NULL,
  `saat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iletisim`
--

LOCK TABLES `iletisim` WRITE;
/*!40000 ALTER TABLE `iletisim` DISABLE KEYS */;
INSERT INTO `iletisim` VALUES (3,'İbrahim','Aral','ibrahimaral123@gmail.com',2147483647,'ibrahim caddesi aral mahallesi','Bilinmiyor','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2024-06-17 20:14:23'),(4,'Mahmut','Paşa','mahmutpasa001@gmail.com',2147483647,'mahmut pasa caddesi 13. sokak','Paşalar','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2024-06-17 20:14:58'),(5,'Mehmet','Usta','mehmetusta01@gmail.com',2147483647,'mehmet usta caddesi 13. sokak','Mehmet Ustalar','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2024-06-17 20:15:28'),(6,'Mustafa','Ceylan','mustafaceylan01@gmail.com',2147483647,'mustafa ceylan sokak no.1','Mustafa Ceylanlar','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2024-06-17 20:16:02'),(7,'Murat','Mustafa','muratmustafa01@gmail.com',2147483647,'Murat Mustafa Sokak No: 2','Murat Mustafalar','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2024-06-17 20:16:30');
/*!40000 ALTER TABLE `iletisim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eposta` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `uyelik` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Üye',
  `kayit_tarihi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kayit_adresi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (17,'ib@abn','123123','Üye','2024-06-17 20:45:48','::1'),(19,'dyumruk1@gmail.com','123123','Admin','2024-06-17 20:46:39','::1'),(20,'sadas@gmail.com','12341234','Üye','2024-06-17 20:47:08','::1'),(21,'dsfada@gasda','1234','Üye','2024-06-17 20:47:21','::1'),(22,'123@gmail.com','123','Üye','2024-06-17 23:27:14','::1'),(23,'dsfada@xn--gasdajkhn-0pbd','123','Üye','2024-06-17 23:33:27','::1'),(24,'admin@gmail.com','123123123','Üye','2025-06-17 11:12:34','::1'),(25,'admin1@gmail.com','$2y$10$QS9TZuWyd9xkFNRBYnp9cubCvEZbu42avQxtVpowPfgfCj3aNIyve','Admin','2025-06-17 11:20:35','::1');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_cikis`
--

DROP TABLE IF EXISTS `login_cikis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_cikis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cikis_saat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cikis_adres` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cikis_mail` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cikis_sifre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `benzersiz_anahtar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_cikis`
--

LOCK TABLES `login_cikis` WRITE;
/*!40000 ALTER TABLE `login_cikis` DISABLE KEYS */;
INSERT INTO `login_cikis` VALUES (21,'2024-06-18 12:09:09','::1','ib@abn','123123','a1f43248-7061-4e28-9673-1b905183692a'),(22,'2024-06-18 12:09:32','::1','dyumruk1@gmail.com','kralibo','006fe7c0-de51-454a-93cb-e8687195e2cc'),(24,'2024-06-18 12:11:49','::1','dyumruk1@gmail.com','kralibo','7779e9fb-2b4e-4102-bba2-1c86626c86d8'),(25,'2024-06-18 12:16:13','::1','dyumruk1@gmail.com','kralibo','3755e083-f03e-4159-b859-c2662733d529');
/*!40000 ALTER TABLE `login_cikis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_giris`
--

DROP TABLE IF EXISTS `login_giris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_giris` (
  `id` int NOT NULL AUTO_INCREMENT,
  `giris_saat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `giris_adres` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `giris_mail` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `giris_sifre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `benzersiz_anahtar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_giris`
--

LOCK TABLES `login_giris` WRITE;
/*!40000 ALTER TABLE `login_giris` DISABLE KEYS */;
INSERT INTO `login_giris` VALUES (25,'2024-06-18 12:09:05','::1','ib@abn','123123','a1f43248-7061-4e28-9673-1b905183692a'),(26,'2024-06-18 12:09:19','::1','dyumruk1@gmail.com','kralibo','006fe7c0-de51-454a-93cb-e8687195e2cc'),(28,'2024-06-18 12:09:54','::1','dyumruk1@gmail.com','kralibo','7779e9fb-2b4e-4102-bba2-1c86626c86d8'),(29,'2024-06-18 12:12:07','::1','dyumruk1@gmail.com','kralibo','3755e083-f03e-4159-b859-c2662733d529'),(30,'2025-06-17 11:25:30','::1','admin1@gmail.com','$2y$10$QS9TZuWyd9xkFNRBYnp9cubCvEZbu42avQxtVpowPfgfCj3aNIyve','3486844d5c21d742b7904541e4ccf228'),(31,'2025-06-17 12:28:34','::1','admin1@gmail.com','$2y$10$QS9TZuWyd9xkFNRBYnp9cubCvEZbu42avQxtVpowPfgfCj3aNIyve','8cd6fe904b86563ea27b2f4d831d07e3'),(32,'2025-06-17 12:59:03','::1','admin1@gmail.com','$2y$10$QS9TZuWyd9xkFNRBYnp9cubCvEZbu42avQxtVpowPfgfCj3aNIyve','3db7d98c541d80b31338bc4a5fcaa072');
/*!40000 ALTER TABLE `login_giris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sepet_kontrol`
--

DROP TABLE IF EXISTS `sepet_kontrol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sepet_kontrol` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sepet_mail` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sepet_urun` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sepet_tarih` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sepet_adres` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sepet_ucret` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sepet_kontrol`
--

LOCK TABLES `sepet_kontrol` WRITE;
/*!40000 ALTER TABLE `sepet_kontrol` DISABLE KEYS */;
INSERT INTO `sepet_kontrol` VALUES (13,'froxer6','Retinol Night Serum','2024-06-17 22:48:40','::1','140'),(14,'froxer6','Retinol Night Serum','2024-06-17 22:48:48','::1','140'),(15,'froxer6','Vitamin C Face Cleanser','2024-06-17 22:48:50','::1','58'),(16,'froxer6','Makeup Primer Spray','2024-06-17 22:48:51','::1','70'),(17,'dyumruk1','Retinol Night Serum','2024-06-17 23:29:18','::1','140'),(18,'froxer6','NARS','2024-06-17 23:35:35','::1','140'),(19,'admin1','Retinol Night Serum','2025-06-17 11:25:52','::1','140'),(20,'admin1','Witch Hazel Toner','2025-06-17 11:26:14','::1','90'),(21,'admin1','Vitamin C Face Cleanser','2025-06-17 11:26:19','::1','58'),(22,'admin1','Lancome Lipstick','2025-06-17 11:26:43','::1','380'),(23,'admin1','Palet','2025-06-17 11:27:03','::1','340'),(24,'admin1','Retinol Night Serum','2025-06-17 11:32:16','::1','140'),(25,'admin1','Vitamin C Face Cleanser','2025-06-17 11:33:22','::1','58'),(26,'admin1','Palet','2025-06-17 11:33:32','::1','340'),(27,'admin1','Retinol Night Serum','2025-06-17 11:43:49','::1','140'),(28,'admin1','Witch Hazel Toner','2025-06-17 11:45:43','::1','90'),(29,'admin1','Retinol Night Serum','2025-06-17 11:56:36','::1','140'),(30,'admin1','Retinol Night Serum','2025-06-17 12:11:21','::1','140'),(31,'admin1','Retinol Night Serum','2025-06-17 12:17:03','::1','140'),(32,'admin1','Retinol Night Serum','2025-06-17 12:22:14','::1','140'),(33,'admin1','Retinol Night Serum','2025-06-17 12:26:06','::1','140'),(34,'admin1','Retinol Night Serum','2025-06-17 12:27:16','::1','140'),(35,'admin1','Retinol Night Serum','2025-06-17 12:28:40','::1','140'),(36,'admin1','Vitamin C Face Cleanser','2025-06-17 12:29:24','::1','58'),(37,'admin1','Retinol Night Serum','2025-06-17 12:29:29','::1','140'),(38,'admin1','Retinol Night Serum','2025-06-17 12:30:49','::1','140'),(39,'admin1','Retinol Night Serum','2025-06-17 12:30:54','::1','140'),(40,'admin1','Retinol Night Serum','2025-06-17 12:30:59','::1','140'),(41,'admin1','Witch Hazel Toner','2025-06-17 12:35:43','::1','90'),(42,'admin1','Witch Hazel Toner','2025-06-17 12:38:03','::1','90'),(43,'admin1','Witch Hazel Toner','2025-06-17 12:39:03','::1','90'),(44,'admin1','Witch Hazel Toner','2025-06-17 12:40:43','::1','90'),(45,'admin1','Witch Hazel Toner','2025-06-17 12:40:54','::1','90'),(46,'admin1','Witch Hazel Toner','2025-06-17 12:43:28','::1','90'),(47,'admin1','Witch Hazel Toner','2025-06-17 12:43:35','::1','90'),(48,'admin1','Witch Hazel Toner','2025-06-17 12:43:37','::1','90'),(49,'admin1','Witch Hazel Toner','2025-06-17 12:47:32','::1','90'),(50,'admin1','Vitamin C Face Cleanser','2025-06-17 13:01:56','::1','58'),(51,'admin1','Makeup Primer Spray','2025-06-17 13:02:01','::1','70'),(52,'admin1','Retinol Night Serum','2025-06-17 13:06:55','::1','140'),(53,'admin1','Retinol Night Serum','2025-06-17 13:10:25','::1','140'),(54,'admin1','Lipsticks','2025-06-17 13:13:04','::1','300'),(55,'admin1','EyeShadow Brush','2025-06-17 13:16:56','::1','180');
/*!40000 ALTER TABLE `sepet_kontrol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siparis_detaylari`
--

DROP TABLE IF EXISTS `siparis_detaylari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siparis_detaylari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `siparis_id` int DEFAULT NULL,
  `urun_adi` varchar(255) DEFAULT NULL,
  `urun_fiyati` decimal(10,2) DEFAULT NULL,
  `urun_adedi` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `siparis_detaylari_siparisler_id_fk` (`siparis_id`),
  CONSTRAINT `siparis_detaylari_siparisler_id_fk` FOREIGN KEY (`siparis_id`) REFERENCES `siparisler` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siparis_detaylari`
--

LOCK TABLES `siparis_detaylari` WRITE;
/*!40000 ALTER TABLE `siparis_detaylari` DISABLE KEYS */;
INSERT INTO `siparis_detaylari` VALUES (1,2,'Retinol Night Serum',140.00,1),(2,3,'Witch Hazel Toner',90.00,1),(3,4,'Vitamin C Face Cleanser',58.00,1),(4,4,'Makeup Primer Spray',70.00,3),(5,5,'Retinol Night Serum',140.00,1),(6,6,'Lipsticks',300.00,2),(7,7,'EyeShadow Brush',180.00,1);
/*!40000 ALTER TABLE `siparis_detaylari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `siparisler`
--

DROP TABLE IF EXISTS `siparisler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `siparisler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kullanici_adi` varchar(255) DEFAULT NULL,
  `teslimat_adi` varchar(255) DEFAULT NULL,
  `teslimat_adresi` text,
  `teslimat_telefon` varchar(20) DEFAULT NULL,
  `teslimat_email` varchar(255) DEFAULT NULL,
  `siparis_tarihi` datetime DEFAULT NULL,
  `toplam_tutar` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `siparisler`
--

LOCK TABLES `siparisler` WRITE;
/*!40000 ALTER TABLE `siparisler` DISABLE KEYS */;
INSERT INTO `siparisler` VALUES (1,'admin1','İbrahim','asfdghjk','05340652412','admin@gmail.com','2025-06-17 12:10:39',230.00),(2,'admin1','safdg','sadfsgdhj','05340652412','safdgh@gmail.com','2025-06-17 12:17:18',140.00),(3,'admin1','safdgh','safdghjgfds','05340652412','admin@gmail.com','2025-06-17 12:47:52',90.00),(4,'admin1','İbrahim','safdghjkljhgfdsa','05340652412','ibrahimaral20@gmail.com','2025-06-17 13:02:24',268.00),(5,'admin1','safdg','asdgfhj','5340652412','admin@gmail.com','2025-06-17 13:10:48',140.00),(6,'admin1','test','asfdh','05340652412','test2@gmail.com','2025-06-17 16:13:17',600.00),(7,'admin1','afdsfh','asdgfg','05340652412','admin@gmail.com','2025-06-17 13:17:09',180.00);
/*!40000 ALTER TABLE `siparisler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urun_detaylari`
--

DROP TABLE IF EXISTS `urun_detaylari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `urun_detaylari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `urun_ismi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `urun_stokkod` int NOT NULL,
  `urun_ana_img` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `urun_yan_img_1` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'yok',
  `urun_yan_img_2` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'yok',
  `urun_fiyati` int NOT NULL,
  `urun_aciklama` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `urun_ve_iade_politikasi_aciklama` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `gonderim_bilgisi_aciklama` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urun_detaylari`
--

LOCK TABLES `urun_detaylari` WRITE;
/*!40000 ALTER TABLE `urun_detaylari` DISABLE KEYS */;
INSERT INTO `urun_detaylari` VALUES (1,'EyeShadow Brush',1,'card5.png','card2.png','card3.png',180,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(2,'Vitamin C Face Cleanser',2,'card3.png','card1.png','card3.png',58,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(3,'Retinol Night Serum',3,'card1.png','yok','yok',140,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(4,'Lipsticks',4,'card6.png','card1.png','card2.png',300,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(5,'Lipgloss',5,'card7.png','card4.png','card3.png',95,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(6,'Witch Hazel Toner',6,'card2.png','yok','card6.png',90,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(7,'Makeup Primer Spray',7,'card4.png','card6.png','card3.png',70,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(8,'Black and Pink Lipstick',8,'card8.png','card7.png','card3.png',400,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(9,'Lancome Lipstick',9,'card9.png','card7.png','card2.png',380,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(10,'Estee Lauder',10,'card10.png','card3.png','card2.png',350,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(11,'Palet',11,'card11.png','card8.png','card5.png',340,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de'),(12,'NARS',12,'card12.png','card11.png','card5.png',140,'Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de','Cevap: Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with de');
/*!40000 ALTER TABLE `urun_detaylari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urun_kategoriler`
--

DROP TABLE IF EXISTS `urun_kategoriler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `urun_kategoriler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `genel_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `alt_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urun_kategoriler`
--

LOCK TABLES `urun_kategoriler` WRITE;
/*!40000 ALTER TABLE `urun_kategoriler` DISABLE KEYS */;
INSERT INTO `urun_kategoriler` VALUES (1,'Makyaj','Yüz Makyajı'),(2,'Makyaj','Göz Makyajı'),(3,'Makyaj','Dudak Makyajı'),(4,'Makyaj','Makyaj Fırçaları'),(5,'Makyaj','Makyaj Aksesuarları'),(6,'Cilt Bakımı','Güneş'),(7,'Cilt Bakımı','Yüz Bakım'),(8,'Cilt Bakımı','El ve Vücut'),(9,'Saç Bakımı','Saç Boyaları'),(10,'Saç Bakımı','Saç Bakım Ürünleri'),(11,'Saç Bakımı','Saç Aksesuarları'),(12,'Kişisel Bakım','Ayak ve Tırnak Bakımı'),(13,'Kişisel Bakım','Epilasyon Ağda ve Tıraş'),(14,'Kişisel Bakım','Ağız ve Diş Bakım'),(15,'Kişisel Bakım','Duş ve Banyo'),(16,'Parfüm ve Deodorant','Kadın Parfümleri'),(17,'Parfüm ve Deodorant','Erkek Parfümleri'),(18,'Parfüm ve Deodorant','Parfüm Seti'),(19,'Parfüm ve Deodorant','Kadın Roll-On Deodorant'),(20,'Parfüm ve Deodorant','Kadın Roll-On Deodorant');
/*!40000 ALTER TABLE `urun_kategoriler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `urunler`
--

DROP TABLE IF EXISTS `urunler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `urunler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `urun_adi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `urun_fiyati` int NOT NULL,
  `urun_resimi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `urun_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `urun_alt_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `urunler`
--

LOCK TABLES `urunler` WRITE;
/*!40000 ALTER TABLE `urunler` DISABLE KEYS */;
INSERT INTO `urunler` VALUES (1,'Retinol Night Serum',140,'card1.png','Makyaj','Yüz Makyajı'),(2,'Witch Hazel Toner',90,'card2.png','Makyaj','Göz Makyajı'),(3,'Vitamin C Face Cleanser',58,'card3.png','Makyaj','Dudak Makyajı'),(4,'Makeup Primer Spray',70,'card4.png','Cilt Bakımı','Güneş'),(5,'EyeShadow Brush',180,'card5.png','Cilt Bakımı','Yüz Bakım'),(6,'Lipsticks',300,'card6.png','Cilt Bakımı','El ve Vücut'),(7,'Lipgloss',95,'card7.png','Saç Bakımı','Saç Boyaları'),(8,'Black and Pink Lipstick',400,'card8.png','Saç Bakımı','Saç Bakım Ürünleri'),(9,'Lancome Lipstick',380,'card9.png','Kişisel Bakım','Ayak ve Tırnak Bakımı'),(10,'Estee Lauder',350,'card10.png','Kişisel Bakım','Epilasyon Ağda ve Tıraş'),(11,'Palet',340,'card11.png','Parfüm ve Deodorant','Kadın Parfümleri'),(12,'NARS',140,'card12.png','Parfüm ve Deodorant','Erkek Parfümleri');
/*!40000 ALTER TABLE `urunler` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-17 17:44:15
