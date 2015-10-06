/*
SQLyog Ultimate v8.5 
MySQL - 5.5.25 : Database - bibihelper_stage
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Data for the table `brand` */

insert  into `brand`(`id`,`country`,`name`,`icon_src`,`icon_name`) values (9,'Англия','Bentley','/images/brand-icons/','Bentley.png'),(10,'Англия','Jaguar','/images/brand-icons/','Jaguar.png'),(11,'Англия','Land Rover','/images/brand-icons/','Land Rover.png'),(12,'Англия','MG','/images/brand-icons/','MG.png'),(13,'Англия','Rover','/images/brand-icons/','Rover.png'),(14,'Германия','Audi','/images/brand-icons/','Audi.png'),(15,'Германия','BMW','/images/brand-icons/','BMW.png'),(16,'Германия','Mersedes','/images/brand-icons/','Mersedes.png'),(17,'Германия','Mini','/images/brand-icons/','Mini.png'),(18,'Германия','Opel','/images/brand-icons/','Opel.png'),(19,'Германия','Porsche','/images/brand-icons/','Porsche.png'),(20,'Германия','Smart','/images/brand-icons/','Smart.png'),(21,'Германия','Volkswagen','/images/brand-icons/','Volkswagen.png'),(22,'Иран','Iran Khodro','/images/brand-icons/','Iran Khodro.png'),(23,'Испания','Seat','/images/brand-icons/','Seat.png'),(24,'Италия','Alfa Romeo','/images/brand-icons/','Alfa Romeo.png'),(25,'Италия','Ferrari','/images/brand-icons/','Ferrari.png'),(26,'Италия','Fiat','/images/brand-icons/','Fiat.png'),(27,'Италия','Lancia','/images/brand-icons/','Lancia.png'),(28,'Китай','Baw','/images/brand-icons/','Baw.png'),(29,'Китай','Brilliance','/images/brand-icons/','Brilliance.png'),(30,'Китай','BYD','/images/brand-icons/','BYD.png'),(31,'Китай','Chery','/images/brand-icons/','Chery.png'),(32,'Китай','Derways','/images/brand-icons/','Derways.png'),(33,'Китай','Faw','/images/brand-icons/','Faw.png'),(34,'Китай','Foton','/images/brand-icons/','Foton.png'),(35,'Китай','Geely','/images/brand-icons/','Geely.png'),(36,'Китай','Great Wall','/images/brand-icons/','Great Wall.png'),(37,'Китай','Hafei','/images/brand-icons/','Hafei.png'),(38,'Китай','Lifan','/images/brand-icons/','Lifan.png'),(39,'Китай','Xinkai','/images/brand-icons/','Xinkai.png'),(40,'Корея','Daewoo','/images/brand-icons/','Daewoo.png'),(41,'Корея','Hyundai','/images/brand-icons/','Hyundai.png'),(42,'Корея','Kia','/images/brand-icons/','Kia.png'),(43,'Корея','SsangYong','/images/brand-icons/','SsangYong.png'),(44,'Россия','ГАЗ','/images/brand-icons/','ГАЗ.png'),(45,'Россия','ПАЗ','/images/brand-icons/','ПАЗ.png'),(46,'Россия','ТАГАЗ','/images/brand-icons/','ТАГАЗ.png'),(47,'Россия','УАЗ','/images/brand-icons/','УАЗ.png'),(48,'Россия','ВАЗ','/images/brand-icons/','ВАЗ.png'),(49,'Россия','ЗИЛ','/images/brand-icons/','ЗИЛ.png'),(50,'США','Acura','/images/brand-icons/','Acura.png'),(51,'США','Buick','/images/brand-icons/','Buick.png'),(52,'США','Cadillac','/images/brand-icons/','Cadillac.png'),(53,'США','Chevrolet','/images/brand-icons/','Chevrolet.png'),(54,'США','Chrysler','/images/brand-icons/','Chrysler.png'),(55,'США','Dodge','/images/brand-icons/','Dodge.png'),(56,'США','Eagle','/images/brand-icons/','Eagle.png'),(57,'США','Ford','/images/brand-icons/','Ford.png'),(58,'США','GMC','/images/brand-icons/','GMC.png'),(59,'США','Hummer','/images/brand-icons/','Hummer.png'),(60,'США','Jeep','/images/brand-icons/','Jeep.png'),(61,'США','Lincoln','/images/brand-icons/','Lincoln.png'),(62,'США','Mercury','/images/brand-icons/','Mercury.png'),(63,'США','Oldsmobile','/images/brand-icons/','Oldsmobile.png'),(64,'США','Plymouth','/images/brand-icons/','Plymouth.png'),(65,'США','Pontiac','/images/brand-icons/','Pontiac.png'),(66,'США','Saturn','/images/brand-icons/','Saturn.png'),(67,'Франция','Citroen','/images/brand-icons/','Citroen.png'),(68,'Франция','Peugeot','/images/brand-icons/','Peugeot.png'),(69,'Франция','Renault','/images/brand-icons/','Renault.png'),(70,'Чехия','Skoda','/images/brand-icons/','Skoda.png'),(71,'Швеция','Saab','/images/brand-icons/','Saab.png'),(72,'Швеция','Volvo','/images/brand-icons/','Volvo.png'),(73,'Япония','Daihatsu','/images/brand-icons/','Daihatsu.png'),(74,'Япония','Honda','/images/brand-icons/','Honda.png'),(75,'Япония','Infiniti','/images/brand-icons/','Infiniti.png'),(76,'Япония','Isuzu','/images/brand-icons/','Isuzu.png'),(77,'Япония','Lexus','/images/brand-icons/','Lexus.png'),(78,'Япония','Mazda','/images/brand-icons/','Mazda.png'),(79,'Япония','Mitsubishi','/images/brand-icons/','Mitsubishi.png'),(80,'Япония','Nissan','/images/brand-icons/','Nissan.png'),(81,'Япония','Subaru','/images/brand-icons/','Subaru.png'),(82,'Япония','Suzuki','/images/brand-icons/','Suzuki.png'),(83,'Япония','Toyota','/images/brand-icons/','Toyota.png');

/*Data for the table `category` */

insert  into `category`(`id`,`name`) values (1,'Техническое обслуживание'),(2,'Кузовной ремонт и покраска'),(3,'Ремонт ходовой и трансмиссии'),(4,'Ремонт систем двигателя'),(5,'Ремонт электрооборудования'),(6,'Ремонт других систем и агрегатов'),(7,'Установка доп. Оборудования'),(8,'Прочие услуги');

/*Data for the table `city` */

insert  into `city`(`id`,`name`,`latitude`,`longitude`) values (1,'Новосибирск',NULL,NULL),(2,'Красноярск',NULL,NULL);

/*Data for the table `service` */

insert  into `service`(`id`,`name`,`category_id`) values (1,'Замена колодок',1),(2,'Плановые ТО',1),(3,'Послегарантийное обслуживание',1),(4,'Экспресс замена жидкостей',1),(5,'Экспресс замена масла, фильтров',1),(6,'Ремонт зеркал',2),(7,'Кузовной ремонт',2),(8,'Восстановление геометрии',2),(9,'Покраска',2),(10,'Покраска в камере',2),(11,'Матовая покраска',2),(12,'Подбор красок',2),(13,'Полировка кузова',2),(14,'Ремонт бамперов',2),(15,'Устранение сколов',2),(16,'Локальная покраска',2),(17,'Удаление вмятин без покраски',2),(18,'Аэрография',2),(19,'Ламинирование пленками',2),(20,'Установка и ремонт автостекол',2),(21,'Антикоррозийная обработка',2),(22,'Аргонная сварка',2),(23,'Замена и вклейка автостекол',2),(24,'Ремонт крыши кабриолета',2),(25,'Ремонт раздаток',3),(26,'Ремонт редукторов',3),(27,'Ремонт суппортов',3),(28,'Диагностика ходовой',3),(29,'Диагностика трансмиссии',3),(30,'Диагностика КПП',3),(31,'Ремонт ходовой',3),(32,'Ремонт АКПП',3),(33,'Продажа восстановленных АКПП',3),(34,'Ремонт РКПП (робот)',3),(35,'Ремонт МКПП',3),(36,'Ремонт трансмиссии',3),(37,'Сход-развал',3),(38,'Замена тормозных дисков',3),(39,'Компьютерная диагностика двигателя',4),(40,'Ремонт двигателя',4),(41,'Ремонт дизельных двигателей',4),(42,'Ремонт ТНВД',4),(43,'Капитальный ремонт двигателя',4),(44,'Переборка двигателя',4),(45,'Ремонт турбин',4),(46,'Замена ремней ГРМ (цепей ГРМ)',4),(47,'Ремонт топливной системы',4),(48,'Ремонт карбюратора',4),(49,'Ремонт инжектора',4),(50,'Промывка инжектора',4),(51,'Промывка форсунок ультразвуком',4),(52,'Ремонт радиаторов',4),(53,'Ремонт системы охлаждения двигателя',4),(54,'Компьютерная диагностика электрооборудования',5),(55,'Ремонт электрооборудования',5),(56,'Ремонт генераторов',5),(57,'Ремонт стартеров',5),(58,'Ремонт автоэлектроники',5),(59,'Ремонт рулевой рейки',6),(60,'Ремонт рулевого механизма',6),(61,'Ремонт гидроусилителя',6),(62,'Ремонт отопительной системы',6),(63,'Ремонт кондиционеров',6),(64,'Ремонт глушителей',6),(65,'Ремонт катализаторов',6),(66,'Ремонт сцепления',6),(67,'Заправка кондиционеров',6),(68,'Ремонт тормозной системы',6),(69,'Бронирование фар',7),(70,'Перетяжка салона',7),(71,'Тонирование автомобилей',7),(72,'Тюнинг автомобиля',7),(73,'Тюнинг тормозной системы',7),(74,'Установка DVD',7),(75,'Установка автозвука',7),(76,'Установка автосигнализаций',7),(77,'Установка ксенона',7),(78,'Установка иммобилайзеров',7),(79,'Установка ксенона',7),(80,'Установка омывателя фар',7),(81,'Установка парктроников',7),(82,'Установка сигнализаций спутниковых',7),(83,'Установка, ремонт газоаппаратуры',7),(84,'Установка навигации',7),(85,'Шумоизоляция',7),(86,'Установка подогрева сидений',7),(87,'Установка глушителей и насадок',7),(88,'Чип-тюнинг',7),(89,'WiFi',8),(90,'Кафе ',8),(91,'Автострахование',8),(92,'Аккредитованный оператор ТО',8),(93,'Выезд к клиенту',8),(94,'Техпомощь на дороге',8),(95,'Химчистка',8),(96,'Эвакуация автотранспорта',8),(97,'Заказ запчастей',8),(98,'Нано-полировка стекол и кузова',8),(99,'Оценка автомобиля',8),(100,'Предпродажная подготовка',8),(101,'Покупка битых автомобилей',8),(102,'Продажа подержанных автомобилей',8),(103,'Trade-in',8);

/*Data for the table `specializations` */

insert  into `specializations`(`id`,`name`) values (1,'Автосервис'),(2,'Автомойка'),(3,'Шиномонтаж');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;