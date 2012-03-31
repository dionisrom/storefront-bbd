-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2012 at 03:54 PM
-- Server version: 5.0.95
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ortoprot_storefront`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorii`
--

CREATE TABLE IF NOT EXISTS `categorii` (
  `id` int(10) NOT NULL auto_increment,
  `denumire` varchar(255) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=96 ;

--
-- Dumping data for table `categorii`
--

INSERT INTO `categorii` (`id`, `denumire`) VALUES
(1, 'Orteze'),
(2, 'Proteze'),
(3, 'Incaltaminte ortopedica'),
(4, 'Dispozitive de mers'),
(9, 'Aparatura medicala'),
(10, 'Consumabile'),
(91, 'Ingrijire la domiciliu');

-- --------------------------------------------------------

--
-- Table structure for table `comentarii`
--

CREATE TABLE IF NOT EXISTS `comentarii` (
  `id` int(10) NOT NULL auto_increment,
  `id_produs` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `data` varchar(10) character set utf8 NOT NULL,
  `comentariu` longtext character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE IF NOT EXISTS `cos` (
  `id` int(10) NOT NULL auto_increment,
  `data` varchar(10) character set utf8 NOT NULL,
  `ora` varchar(8) character set utf8 NOT NULL,
  `produse` varchar(255) character set utf8 NOT NULL,
  `data_validare` varchar(10) character set utf8 default NULL,
  `ora_validare` varchar(8) character set utf8 default NULL,
  `cantitati` varchar(255) character set utf8 NOT NULL,
  `preturi` varchar(255) collate utf8_bin NOT NULL,
  `validat` tinyint(1) NOT NULL default '0',
  `id_user` int(10) NOT NULL,
  `curier` int(1) NOT NULL default '0' COMMENT '0 - posta romana - 12 lei; 1 - cargus - 25 lei',
  `masuri` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=28 ;

--
-- Dumping data for table `cos`
--

INSERT INTO `cos` (`id`, `data`, `ora`, `produse`, `data_validare`, `ora_validare`, `cantitati`, `preturi`, `validat`, `id_user`, `curier`, `masuri`) VALUES
(18, '17.08.2010', '16:33:00', '23', NULL, NULL, '1', '', 0, 6, 0, ''),
(19, '01.10.2010', '07:59:00', '23', NULL, NULL, '1', '', 0, 7, 0, ''),
(20, '02.12.2010', '14:55:43', '17', NULL, NULL, '1', '', 0, 25, 1, ''),
(21, '28.02.2012', '23:02:36', '23,22,72', '29.02.2012', '00:27:37', '1,2,1', '', 1, 28, 0, ''),
(22, '29.02.2012', '00:26:32', '134', '29.02.2012', '00:27:28', '1', '', 1, 28, 0, ''),
(23, '29.02.2012', '00:54:05', '134', '29.02.2012', '00:54:50', '1', '', 1, 28, 0, ''),
(24, '29.02.2012', '13:57:02', '134', '29.02.2012', '14:00:57', '1', '', 1, 29, 0, ''),
(25, '14.03.2012', '22:56:33', '144_S', '14.03.2012', '23:00:52', '1', '70.00', 1, 28, 0, 'S'),
(26, '14.03.2012', '22:57:43', '144_S', NULL, NULL, '1', '70.00', 0, 28, 0, 'S'),
(27, '14.03.2012', '22:58:37', '143_', NULL, NULL, '3', '69.00', 0, 28, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id_file` int(11) NOT NULL auto_increment,
  `denumire` varchar(255) character set latin1 NOT NULL,
  `content` longtext character set latin1 NOT NULL,
  `last_change` int(13) NOT NULL,
  PRIMARY KEY  (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=19 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id_file`, `denumire`, `content`, `last_change`) VALUES
(4, 'despre_noi', '&lt;p&gt;&lt;span style=&quot;font-size: x-small; font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color: #ff6600; font-size: small;&quot;&gt;Despre&amp;nbsp;noi&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;color: #ff6600;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&lt;/span&gt;&lt;span style=&quot;color: #ff6600;&quot;&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #ff6600; font-size: x-small;&quot;&gt;&lt;strong style=&quot;font-size: small;&quot;&gt;Principii&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Creativitatea, indrazneala, dinamismul, grija pentru detalii ne definesc in tot ceea ce intreprindem.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Apropierea de pacient, receptivitatea fata de nevoile acestuia fac posibila colaborarea eficienta.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Promptitudinea este atuul forte al firmei deoarece am constientizat importanta imediata a dispozitivelor furnizate.&lt;/span&gt;&lt;br /&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Calitatea si eficienta sunt aspecte obligatorii si definitorii pentru produsele noastre.&lt;/span&gt;&lt;br /&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Faptele vorbesc de aceea nu ezitati sa ne contactati pentru a va convinge de veridicitatea celor sustinute anterior! &lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #ff6600; font-size: x-small;&quot;&gt;&lt;strong style=&quot;font-size: small;&quot;&gt;Echipa&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Unul dintre principalele atuuri ale firmei il reprezinta echipa. Specialistilor ortoprotezisti ce beneficieaza de formare profesioanala continua prin cursuri, li se adauga licentiati in kinetoterapie cu specializare protezare &amp;ndash; ortezare. Astfel gandita, echipa este menita sa inteleaga necesitatile si cerintele persoanelor cu diferite dizabilitati fizice, dar si sa stabileasca un limbaj comun cu personalul medical implicat in recuperarea pacientilor &amp;ndash; medic, kinetoterapeut, psiholog si nu in ultimul rand asistent medical.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Cautand o perfectionare continua, echipa este deschisa sugestiilor specialistilor implicati in procesul de reabilitare, acestia fiind cei care urmaresc constant starea si evolutia pacientilor. Numai in acest mod se pot obtine solutii optime de executie a dispozitivului medical recomandat.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #ff6600; font-size: x-small;&quot;&gt;&lt;strong style=&quot;font-size: small;&quot;&gt;Asigurarea calitatii&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Preocuparea pentru calitatea produselor si serviciilor ne-a motivat sa implementam si sa certificam sistemul de management al calitatii SR EN ISO 9001:2008.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #ff6600; font-size: x-small;&quot;&gt;&lt;strong style=&quot;font-size: small;&quot;&gt;Realizarile noastre&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Interesul acordat necesitatilor clientilor nostri in vederea recuperarii lor a actionat ca o forta, impulsionand activitatea noastra si permitandu-ne sa realizam produse unice pe piata din Rom&amp;acirc;nia.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;Pentru a veni in sprijinul pacientilor, oferindu-le alternative la produsele existente, am imbunatatit tehnica de realizare a sustinatorilor plantari utilizand analiza plantara computerizata si amprentarea tridimensionala, ne-am perfectionat tehnica de realizare a corsetului Cheneau sub atenta monitorizare a medicilor ortopezi si de recuperare, specializati in tehnici de corectie ortotica a scoliozelor, obtinand rezultate foarte bune; am realizat orteze pentru corectia plagiocefaliei si nu in ultimul rand am investit in tehnologie.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: x-small;&quot;&gt;\n&lt;script type=&quot;text/javascript&quot; src=&quot;../js/jquery-1.7.1.min.js&quot;&gt;&lt;/script&gt;\n&lt;script type=&quot;text/javascript&quot;&gt;// &lt;![CDATA[\njQuery(window).load(function(){\n				var db1 = jQuery(&quot;html&quot;).height();\n				var docHeight = db1;\n				jQuery(&quot;#main_frame&quot;,window.parent.document).height(docHeight +50);\n				jQuery(&quot;#body&quot;,window.parent.document).height(docHeight +60);\n			})\n// ]]&gt;&lt;/script&gt;\n&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 0),
(6, 'asistenta', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Asistenta&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: small;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu pharetra tortor. Nulla porttitor quam sit amet mi condimentum quis lacinia felis hendrerit. Sed quis elementum arcu. Mauris quis justo velit, a ullamcorper ante. Phasellus ut nisl nisl, congue dictum ligula. Nulla condimentum luctus luctus. Nulla facilisi. Fusce consectetur dignissim mattis. Vivamus placerat gravida ipsum sit amet tincidunt. Donec ut ligula in purus consequat ultricies nec sed ligula. Aenean ac nulla nulla, eget rutrum justo. Nulla facilisi. Aliquam interdum aliquet justo, non consequat quam hendrerit fringilla. Quisque congue urna vel dolor semper ut faucibus velit cursus. Nullam ut lacus odio. &lt;/span&gt;&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: small;&quot;&gt;&amp;nbsp;Proin ipsum libero, condimentum in pretium hendrerit, consequat ut justo. In quis venenatis orci. Donec turpis sem, feugiat vel blandit id, adipiscing at leo. Integer eget ligula quis ipsum porta porttitor et at lectus. Maecenas urna mauris, accumsan tristique aliquet quis, scelerisque pulvinar risus. Curabitur eros nibh, tempor id sagittis non, convallis vel ante. Quisque non porttitor massa. Quisque ut sapien purus, at cursus sapien. Donec volutpat varius est sed auctor. &lt;/span&gt;&lt;br /&gt;&lt;br /&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: small;&quot;&gt;&amp;nbsp;Etiam at lectus quam, et facilisis lectus. Vivamus odio velit, dignissim ut dignissim id, varius a arcu. Nam tristique gravida turpis quis sollicitudin. Phasellus pellentesque tortor nec ipsum bibendum laoreet. Nulla auctor, ligula vitae bibendum dictum, lectus mauris scelerisque lectus, vel euismod turpis eros sed magna. Sed vitae vehicula neque. Praesent tincidunt dolor eu velit sagittis interdum. Aenean accumsan mollis lobortis. Nam eu lorem at enim cursus pulvinar quis quis nulla. Curabitur aliquam pharetra dapibus. Vivamus ut justo velit, sed eleifend felis. Aliquam vel eleifend leo. Sed varius, justo vel tempor lacinia, purus tellus posuere tellus, sit amet adipiscing quam ligula et dui. Nunc ultricies, sem sed fringilla fermentum, arcu nulla aliquam lacus, nec ultricies velit libero nec nisi. Nunc sed viverra dolor. Aenean sem massa, pulvinar vel volutpat eu, porta eget risus.&lt;/span&gt;&lt;/p&gt;', 0),
(7, 'parteneri', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu pharetra tortor. Nulla porttitor quam sit amet mi condimentum quis lacinia felis hendrerit. Sed quis elementum arcu. Mauris quis justo velit, a ullamcorper ante. Phasellus ut nisl nisl, congue dictum ligula. Nulla condimentum luctus luctus. Nulla facilisi. Fusce consectetur dignissim mattis. Vivamus placerat gravida ipsum sit amet tincidunt. Donec ut ligula in purus consequat ultricies nec sed ligula. Aenean ac nulla nulla, eget rutrum justo. Nulla facilisi. Aliquam interdum aliquet justo, non consequat quam hendrerit fringilla. Quisque congue urna vel dolor semper ut faucibus velit cursus. Nullam ut lacus odio. &lt;br /&gt;&lt;br /&gt;&amp;nbsp;Proin ipsum libero, condimentum in pretium hendrerit, consequat ut justo. In quis venenatis orci. Donec turpis sem, feugiat vel blandit id, adipiscing at leo. Integer eget ligula quis ipsum porta porttitor et at lectus. Maecenas urna mauris, accumsan tristique aliquet quis, scelerisque pulvinar risus. Curabitur eros nibh, tempor id sagittis non, convallis vel ante. Quisque non porttitor massa. Quisque ut sapien purus, at cursus sapien. Donec volutpat varius est sed auctor. &lt;br /&gt;&lt;br /&gt;&amp;nbsp;Etiam at lectus quam, et facilisis lectus. Vivamus odio velit, dignissim ut dignissim id, varius a arcu. Nam tristique gravida turpis quis sollicitudin. Phasellus pellentesque tortor nec ipsum bibendum laoreet. Nulla auctor, ligula vitae bibendum dictum, lectus mauris scelerisque lectus, vel euismod turpis eros sed magna. Sed vitae vehicula neque. Praesent tincidunt dolor eu velit sagittis interdum. Aenean accumsan mollis lobortis. Nam eu lorem at enim cursus pulvinar quis quis nulla. Curabitur aliquam pharetra dapibus. Vivamus ut justo velit, sed eleifend felis. Aliquam vel eleifend leo. Sed varius, justo vel tempor lacinia, purus tellus posuere tellus, sit amet adipiscing quam ligula et dui. Nunc ultricies, sem sed fringilla fermentum, arcu nulla aliquam lacus, nec ultricies velit libero nec nisi. Nunc sed viverra dolor. Aenean sem massa, pulvinar vel volutpat eu, porta eget risus.&lt;/p&gt;', 0),
(8, 'livrare', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Livrare&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: small;&quot;&gt;&lt;br style=&quot;font-family: arial,helvetica,sans-serif; font-size: small;&quot; /&gt;&lt;/span&gt;&lt;/p&gt;', 0),
(9, 'testimoniale', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Testimoniale&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu pharetra tortor. Nulla porttitor quam sit amet mi condimentum quis lacinia felis hendrerit. Sed quis elementum arcu. Mauris quis justo velit, a ullamcorper ante. Phasellus ut nisl nisl, congue dictum ligula. Nulla condimentum luctus luctus. Nulla facilisi. Fusce consectetur dignissim mattis. Vivamus placerat gravida ipsum sit amet tincidunt. Donec ut ligula in purus consequat ultricies nec sed ligula. Aenean ac nulla nulla, eget rutrum justo. Nulla facilisi. Aliquam interdum aliquet justo, non consequat quam hendrerit fringilla. Quisque congue urna vel dolor semper ut faucibus velit cursus. Nullam ut lacus odio. &lt;br /&gt;&lt;br /&gt;&amp;nbsp;Proin ipsum libero, condimentum in pretium hendrerit, consequat ut justo. In quis venenatis orci. Donec turpis sem, feugiat vel blandit id, adipiscing at leo. Integer eget ligula quis ipsum porta porttitor et at lectus. Maecenas urna mauris, accumsan tristique aliquet quis, scelerisque pulvinar risus. Curabitur eros nibh, tempor id sagittis non, convallis vel ante. Quisque non porttitor massa. Quisque ut sapien purus, at cursus sapien. Donec volutpat varius est sed auctor. &lt;br /&gt;&lt;br /&gt;&amp;nbsp;Etiam at lectus quam, et facilisis lectus. Vivamus odio velit, dignissim ut dignissim id, varius a arcu. Nam tristique gravida turpis quis sollicitudin. Phasellus pellentesque tortor nec ipsum bibendum laoreet. Nulla auctor, ligula vitae bibendum dictum, lectus mauris scelerisque lectus, vel euismod turpis eros sed magna. Sed vitae vehicula neque. Praesent tincidunt dolor eu velit sagittis interdum. Aenean accumsan mollis lobortis. Nam eu lorem at enim cursus pulvinar quis quis nulla. Curabitur aliquam pharetra dapibus. Vivamus ut justo velit, sed eleifend felis. Aliquam vel eleifend leo. Sed varius, justo vel tempor lacinia, purus tellus posuere tellus, sit amet adipiscing quam ligula et dui. Nunc ultricies, sem sed fringilla fermentum, arcu nulla aliquam lacus, nec ultricies velit libero nec nisi. Nunc sed viverra dolor. Aenean sem massa, pulvinar vel volutpat eu, porta eget risus.&lt;/p&gt;', 0),
(10, 'link-uri_utile', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Linkuri utile&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;a href=&quot;http://www.google.ro&quot;&gt;Link 1&lt;/a&gt;&lt;/p&gt;\n&lt;p&gt;&lt;a title=&quot;Google.ro&quot; href=&quot;http://www.google.ro&quot;&gt;Link 2&lt;/a&gt;&lt;/p&gt;\n&lt;p&gt;&lt;a title=&quot;Google.ro&quot; href=&quot;http://www.google.ro&quot;&gt;Link 3&lt;/a&gt;&lt;/p&gt;', 0),
(11, 'noutati', '<p><strong><span style="font-size: small; font-family: arial,helvetica,sans-serif;">http://www.ortoprotetica.ro/dev/index.php</span></strong></p>\n<p>&nbsp;</p>\n<p><span style="font-size: small; font-family: arial,helvetica,sans-serif;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vivamus velit. Morbi odio. Ut in sapien. Proin nec erat vitae orci tincidunt iaculis. Morbi laoreet metus sed diam suscipit ultricies. Sed non libero ut nunc tristique dapibus. Sed mollis tellus aliquam est. Etiam at turpis. Donec a urna. Pellentesque sed ante at nisl luctus consequat.</span><br /><br /><span style="font-size: small; font-family: arial,helvetica,sans-serif;">Etiam sit amet magna. Sed turpis nisl, ullamcorper in, congue posuere, facilisis ut, lectus. Pellentesque viverra eros et dolor. Maecenas id metus ac nisi feugiat condimentum. Nulla quis purus. Proin sollicitudin enim et mauris. Proin tristique mauris. Maecenas adipiscing purus sed libero. Fusce quis metus. Mauris malesuada nulla eu nunc. Mauris nonummy magna eu ligula.</span></p>\n<p>&nbsp;</p>\n<p><span style="font-size: small; font-family: arial,helvetica,sans-serif;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Vivamus velit. Morbi odio. Ut in sapien. Proin nec erat vitae orci tincidunt iaculis. Morbi laoreet metus sed diam suscipit ultricies. Sed non libero ut nunc tristique dapibus. Sed mollis tellus aliquam est. Etiam at turpis. Donec a urna. Pellentesque sed ante at nisl luctus consequat.</span><br /><br /><span style="font-size: small; font-family: arial,helvetica,sans-serif;">Etiam sit amet magna. Sed turpis nisl, ullamcorper in, congue posuere, facilisis ut, lectus. Pellentesque viverra eros et dolor. Maecenas id metus ac nisi feugiat condimentum. Nulla quis purus. Proin sollicitudin enim et mauris. Proin tristique mauris. Maecenas adipiscing purus sed libero. Fusce quis metus. Mauris malesuada nulla eu nunc. Mauris nonummy magna eu ligula.</span></p>', 0),
(12, 'parteneri', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Parteneri&lt;br /&gt;&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: small;&quot;&gt;Aceasta pagina este in constructie&lt;/span&gt;&lt;/p&gt;', 0),
(13, 'kinetoterapie_colaboratori', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Kinetoterapie&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: small;&quot;&gt;Aceasta pagina este in constructie&lt;/span&gt;&lt;/p&gt;', 0),
(14, 'info', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color: #ff6600;&quot;&gt;PLAGIOCEFALIA&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color: #ff6600;&quot;&gt;Ce este plagiocefalia?&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;color: #333333; font-size: x-small; font-family: arial,helvetica,sans-serif;&quot;&gt;Plagiocefalia este o deformatie a formei capului manifestata printr-o aplatizare cu traiect oblic fata de axa antero-posterioara a capului. De asemenea mai poate fi intalnit si aspectul de brahicefalie (aplatizarea posterioara a capului, diametrul biauricular putand fi mai mare decat cel sagital)&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color: #ff6600;&quot;&gt;Care sunt cauzele Plagiocefaliei?&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Pozitia intrauterina (lipsa spatiului)&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Sarcina multipla&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Pozitia in somn/repaus (Plagiocefalia pozitionala) &amp;ndash; preferinta copilului pentru o anumita pozitie&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Torticolis muscular (Plagiocefalia pozitionala)&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Nasterea prematura&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Craniostoza ce implica inchiderea prematura a unei suturi craniene ceea ce poate duce la necesitatea unui tratament chirurgical&lt;/span&gt;&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;color: #ff6600;&quot;&gt;Care sunt metodele de tratament ale Plagiocefaliei?&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;ul&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Tratament chirurgical- craniostoza&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Tratament kinetic&lt;/span&gt;&lt;/li&gt;\n&lt;li&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Tratament ortopedic- purtarea unei casti realizata special pentru a aplica o usoara presiune in zonele capului unde se doreste limitarea cresterii diametrului respectiv si de asemenea se creeaza spatii de expansiune in zonele aplatizate.&lt;/span&gt;&lt;/li&gt;\n&lt;/ul&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Durata tratamentului este de 2-6 luni fiind necesara uneori confectionarea mai multor casti succesive, timpul necesar pt purtarea castii fiind de 23 ore /zi.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Sunt necesare controale periodice&amp;nbsp; la intervale de 1, maxim 2 saptamani, moment in care casca poate suferi unele ajustari ca urmare a corectiei deja obtinute.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Pentru confectionarea acestei casti este necesara luarea unui mulaj&amp;nbsp; gipsat. Aceasta procedura este nedureroasa si permite obtinerea fidela a formei capului copilului.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;Casca este realizata din polietilena la exterior si este capitonata la interior cu un material moale, biocompatibil. Aceste materiale au o greutate redusa facand comoda purtarea castii.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; font-size: x-small;&quot;&gt;&amp;nbsp;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 0),
(16, 'cariere', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif;&quot;&gt;&lt;strong&gt;&lt;span style=&quot;font-size: medium; color: #ff6600;&quot;&gt;Cariere&lt;/span&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: small;&quot;&gt;Aceasta pagina este in constructie&lt;/span&gt;&lt;/p&gt;', 0),
(1, 'cum_cumpar', '<html>\r\n    <head>\r\n        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">\r\n        <title>Cum cumpar ?</title>\r\n        <meta http-equiv="Pragma" content="no-cache">\r\n        <meta http-equiv="Cache-Control" content="no-cache">\r\n        <meta name="description" content="Ortoprotetica - cum cumpar ?">\r\n        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />\r\n        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">\r\n    </head>\r\n    <body>\r\n    <div class="titlu_pag">Cum cumpar ?</div>\r\n    <ul>\r\n        <div class="titlu_mic">Cumpara online:</div>\r\n        <li>Pentru a efectua o comanda prin intermediul magazinului nostru este necesar sa va Inregistrati  , folosind o adresa de e-mail valida.</li>\r\n        <li>Alegeti produsul dorit, selectati cantitatea dorita si apoi faceti click pe butonul "Adauga in cos".</li>\r\n        <li>Pentru vizualizarea produselor alese faceti click pe "Vezi cos" din sectiunea Cos de cumparaturi aflata in dreapta paginii.</li>\r\n        <li>Aveti posibilitatea sa vizualizati istoricul comenzilor efectuate in sectiunea "Istoric cumparaturi" si sa reluati una din tranzactii.</li>\r\n        <li>Valoarea minima a comenzii este de 10,00 RON.</li>\r\n    </ul>\r\n    </body>\r\n</html>', 0),
(2, 'cum_platesc', '', 0),
(3, 'contact', '<html>\r\n<head>\r\n	<title>Contact</title>\r\n	<meta http-equiv="Pragma" content="no-cache">\r\n	<meta http-equiv="Cache-Control" content="no-cache">\r\n	<meta name="description" content="Ortoprotetica - Contact">\r\n	<meta name="copyright" content="&copy; 2012 Ortoprotetica" />\r\n	<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">\r\n	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>\r\n	<script type="text/javascript">\r\n\r\n	function initialize() {\r\n		var latlng = new google.maps.LatLng(44.456513,26.042233);\r\n		var myOptions = {\r\n				zoom: 15,\r\n				center: latlng,\r\n				mapTypeId: google.maps.MapTypeId.ROADMAP\r\n		};\r\n		var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);\r\n		var myHtml = ''<table><tr><td align=center style="border-bottom:1px solid #DDDDDD; color:#ee1c25;"><b>Ortoprotetica</b></td></tr><tr><td align=center valign=middle style="color:#000000;">Bd. Constructorilor, nr.20A<br/>IPROMET, parter, sector 6</td></tr></table>'';\r\n		var infowindow = new google.maps.InfoWindow({\r\n				content: myHtml\r\n		});\r\n		var marker = new google.maps.Marker({\r\n				position: latlng,\r\n				map: map,\r\n				title: ''Ortoprotetica''\r\n		});\r\n		google.maps.event.addListener(marker, ''click'', function() {\r\n		infowindow.open(map,marker);\r\n		});\r\n	}\r\n\r\n	</script>\r\n</head>\r\n<body onload="initialize()">\r\n	<div class="titlu_pag">\r\n		Contact\r\n	</div>\r\n    <div style="width:100%">\r\n		<span class="label">Adresa:</span><span class="info">Bd. Constructorilor, nr.20A, IPROMET, parter, Bucuresti, sector 6</span><br />\r\n		<span class="label">Telefon: </span><span class="info">0213169605</span><br />\r\n		<span class="label">Mobil: </span><span class="info"> 0744311737, 0744777270, 0745182075</span><br />\r\n		<span class="label">Fax: </span><span class="info">0213169605</span><br />\r\n		<br />\r\n		<span class="label">Localizare pe harta: </span>\r\n		<div id="map_canvas" style="width: 500px; height: 350px; padding: 20px; border: 2px solid #FFFFFF;"></div>\r\n    </div>\r\n</body>\r\n</html>', 0),
(17, 'cautare', '', 0),
(18, 'prima_pagina', '&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #ff6600; font-size: medium;&quot;&gt;&lt;strong&gt;Mesajul nostru&lt;/strong&gt;&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: small;&quot;&gt;Sustinerea programului de reabilitare a pacientilor cu diferite afectiuni fizice prin furnizarea de dispozitive medicale performante reprezinta o mare responsabilitate. Este ceea ce ne motiveaza. Ne bazam pe experienta echipei si pe cea a partenerilor nostri pentru a asigura clientilor dispozitive care sa-i satisfaca. Aceasta este dealtfel filozofia care ne-a definit de la momentul inceperii activitatii.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: small;&quot;&gt;Prin demersurile noastre constante in sensul cresterii nivelului de performanta, diversificarea produselor, extinderea punctelor de lucru dintara, continuam consolidarea pozitiei pe piata furnizorilor de dispozitive medicale dinRomania.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #333333; font-size: small;&quot;&gt;Vom continua sa ne folosim experienta, spiritul inovator si tehnologia de care dispunem in scopul imbunatatirii calitatii vietii persoanelor cu dizabilitati si deficiente fizice, furnizandu-le solutii viabile.&lt;/span&gt;&lt;/p&gt;\n&lt;p&gt;&lt;span style=&quot;font-family: arial,helvetica,sans-serif; color: #808080; font-size: small;&quot;&gt;&lt;br /&gt;&lt;/span&gt;&lt;/p&gt;', 0);

-- --------------------------------------------------------

--
-- Table structure for table `judete`
--

CREATE TABLE IF NOT EXISTS `judete` (
  `id` int(3) NOT NULL auto_increment,
  `denumire` varchar(100) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=48 ;

--
-- Dumping data for table `judete`
--

INSERT INTO `judete` (`id`, `denumire`) VALUES
(1, 'ALBA'),
(2, 'ARAD'),
(3, 'ARGES'),
(4, 'BACAU'),
(5, 'BIHOR'),
(6, 'BISTRITA'),
(7, 'BOTOSANI'),
(8, 'BRAILA'),
(9, 'BRASOV'),
(10, 'BUC.SECTOR 1'),
(11, 'BUC.SECTOR 2'),
(12, 'BUC.SECTOR 3'),
(13, 'BUC.SECTOR 4'),
(14, 'BUC.SECTOR 5'),
(15, 'BUC.SECTOR 6'),
(16, 'BUZAU'),
(17, 'CALARASI'),
(18, 'CARAS SEVERIN'),
(19, 'CLUJ'),
(20, 'CONSTANTA'),
(21, 'COVASNA'),
(22, 'DIMBOVITA'),
(23, 'DOLJ'),
(24, 'GALATI'),
(25, 'GIURGIU'),
(26, 'GORJ'),
(27, 'HARGHITA'),
(28, 'HUNEDOARA'),
(29, 'IALOMITA'),
(30, 'IASI'),
(31, 'MARAMURES'),
(32, 'MEHEDINTI'),
(33, 'MURES'),
(34, 'NEAMT'),
(35, 'OLT'),
(36, 'PRAHOVA'),
(37, 'SALAJ'),
(38, 'SATU MARE'),
(39, 'SECTOR AGR ILF.'),
(40, 'SIBIU'),
(41, 'SUCEAVA'),
(42, 'TELEORMAN'),
(43, 'TIMIS'),
(44, 'TULCEA'),
(45, 'VASLUI'),
(46, 'VILCEA'),
(47, 'VRANCEA');

-- --------------------------------------------------------

--
-- Table structure for table `mesaje`
--

CREATE TABLE IF NOT EXISTS `mesaje` (
  `id` int(10) NOT NULL auto_increment,
  `nume` varchar(255) character set latin1 NOT NULL,
  `email` varchar(255) character set latin1 NOT NULL,
  `telefon` varchar(10) character set latin1 NOT NULL,
  `subiect` varchar(100) character set latin1 NOT NULL,
  `mesaj` longtext character set latin1 NOT NULL,
  `ip` varchar(15) character set latin1 NOT NULL,
  `data` varchar(19) character set latin1 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mesaje`
--

INSERT INTO `mesaje` (`id`, `nume`, `email`, `telefon`, `subiect`, `mesaj`, `ip`, `data`) VALUES
(1, 'Bogdan', 'dionisrom@gmail.com', '0730290445', 'subiect', 'mesaj', '89.122.193.29', '27.07.2009 05:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `producatori`
--

CREATE TABLE IF NOT EXISTS `producatori` (
  `id` int(10) NOT NULL auto_increment,
  `denumire` varchar(255) character set utf8 NOT NULL,
  `link` varchar(100) character set utf8 default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `producatori`
--

INSERT INTO `producatori` (`id`, `denumire`, `link`) VALUES
(3, 'Orthoservice ', 'http://www.orthoservice.com'),
(5, 'ABC Saglic & Spor', 'http://www.proteor.com'),
(6, 'Comfort', 'www.googl.ro'),
(8, 'Prim', ''),
(9, 'Ortoprotetica', 'www.kappa.ro');

-- --------------------------------------------------------

--
-- Table structure for table `produse`
--

CREATE TABLE IF NOT EXISTS `produse` (
  `id` int(10) NOT NULL auto_increment,
  `nume` varchar(255) character set utf8 NOT NULL,
  `cod` varchar(50) character set utf8 NOT NULL,
  `descriere` longtext character set utf8,
  `pret` decimal(10,2) NOT NULL default '0.00',
  `id_categorie` int(10) NOT NULL,
  `id_subcategorie` int(10) NOT NULL,
  `id_producator` int(10) NOT NULL,
  `reducere` int(3) NOT NULL default '0',
  `prima_pagina` enum('da','nu') character set utf8 NOT NULL default 'nu',
  `super_oferta` enum('da','nu') character set utf8 NOT NULL default 'nu',
  `indicatii` varchar(255) character set utf8 default NULL,
  `grila_masuri` varchar(50) character set utf8 NOT NULL,
  `prod_la_comanda` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `id_subcategorie` (`id_subcategorie`),
  KEY `cod` (`cod`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=155 ;

--
-- Dumping data for table `produse`
--

INSERT INTO `produse` (`id`, `nume`, `cod`, `descriere`, `pret`, `id_categorie`, `id_subcategorie`, `id_producator`, `reducere`, `prima_pagina`, `super_oferta`, `indicatii`, `grila_masuri`, `prod_la_comanda`) VALUES
(86, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 69.19, 82, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(91, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 77.38, 6, 4, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(142, 'Orteza pentru plagiocefalie', 'OPCV 01', '• Realizată din polietilenă termoformabilă.\r\n• Individualizată în urma mulajului.\r\n• Capitonată la interior cu material moale, biocompatibil.\r\n• Materialele au o greutate redusă, făcând comodă purtarea căştii.\r\n• Poate avea orificii pentru aerisire.\r\n• Sistem de închidere cu bandă velcro.', 0.00, 1, 26, 9, 0, 'nu', 'nu', '• Plagiocefalie.', '', 1),
(143, 'orteza cervicala - colar', 'CC20', '• Structură din burete de densitate medie.\r\n• Înveliş exterior din bumbac.\r\n• Închidere posterioară cu bandă velcro.\r\n• Lavabilă.\r\n• Confecţionată din material radio transparent.', 69.00, 1, 27, 3, 0, 'nu', 'nu', '• Distorsiuni uşoare ale coloanei vertebrale.\r\n• Torticolis.\r\n• Crize vertiginoase de origine cervicală.\r\n• Artroze cervicale.', 'S,M,L,XL,XXL', 0),
(144, 'Orteza cervicala - Schanz', 'E41', '• Structură din plastazot atoxic.\r\n• Realizat din 2 segmente.\r\n• Închidere cu bandă velcro.\r\n• Întăritură rigidă, centrală, anterior şi posterior.\r\n• Găuri pentru aerisire.\r\n• Profil adaptat pentru o perfectă aderenţă la nivelul mentonului, cefei şi umărului.\r\n• Confecţionată din material radio transparent.', 70.00, 1, 27, 3, 0, 'nu', 'nu', '• Distorsiuni grave ale coloanei cervicale.\r\n• Discopatie multiplă a coloanei cervicale.\r\n• Traumatisme cervicale.\r\n• Cedări patologice secundare metastazelor cervicale.\r\n• Post-operator în chirurgia cervicală.', 'S,M,L,XL,XXL', 0),
(148, 'Orteza de posturare - corset Siege', 'OPOP 02', '• Realizat din polipropilenă, individualizat în urma mulajului gipsat sau măsurătorilor.\r\n• Capitonat la interior cu material moale.\r\n• Menţine coapsele în abducţie.\r\n• Montat pe placă melaminată, asigurând stabilitatea dispozitivului.\r\n• Poate avea tetieră reglabilă pe înălţime.\r\n• Sistem de închidere cu bandă velcro.\r\n• Prezintă pelotă toracală.', 0.00, 1, 30, 9, 0, 'nu', 'nu', '• Infirmitate motorie cerebrală.\r\n• Parapareză spastică.', '', 1),
(149, 'Orteza de glezna picior pentru talus- valgus de mers', 'OPMI 101A', '• Realizată din polietilenă / polipropilenă.\r\n• Capitonată la nivelul maleolelor cu material moale.\r\n• Menţine articulaţia gleznei la 90°.\r\n• Sistem de închidere cu bandă velcro.\r\n• Prezintă pe banda velcro de la nivelul gleznei o pelotă din material moale, buretos pentru a\r\nasigura confortul.', 0.00, 1, 29, 9, 0, 'nu', 'nu', '• Talus valgus.\r\n• Picior plat valg.', '', 1),
(150, 'Orteza de incheietura mainii mana fixa', 'OPMS 101', '• Realizată din polietilenă în urma mulajului gipsat sau a măsurătorilor.\r\n• Sistem de închidere cu bandă velcro.\r\n• Capitonată cu material moale, biocompatibil.\r\n• Ortezei îi poate fi aplicat un sistem progresiv de modificare a gradelor la nivelul articulaţiei\r\npumnului.', 0.00, 1, 28, 9, 0, 'nu', 'nu', '• Leziuni neurologice de tip periferic sau central (paralizie flască sau spastică).\r\n• Imobilizare în diferite afecţiuni.\r\n• În redorile posttraumatice.\r\n• Poliartrita reumatoidă.', '', 1),
(154, 'Orteza cervicala - Minerva', 'OPCV 01', '• Structură din polietilenă decupată pentru ventilaţie.\r\n• Căptuşită cu material moale, biocompatibil.\r\n• Închidere cu bandă velcro.\r\n• Confecţionată din material radio transparent.\r\n• Sistem suplimentar de fixare la nivel frontal.', 0.00, 1, 0, 9, 0, 'nu', 'nu', '• Distorsiuni grave ale coloanei cervicale.\r\n• Discopatie multiplă a coloanei cervicale.\r\n• Traumatisme cervicale.\r\n• Cedări patologice secundare metastazelor cervicale.\r\n• Post-operator în chirurgia cervicală.', '', 1),
(72, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 175.46, 6, 4, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(84, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 68.19, 81, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(85, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 97.53, 81, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(100, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 88.56, 86, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(133, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 62.44, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(41, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 775.00, 8, 1, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(42, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 110.70, 8, 1, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(43, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 110.70, 8, 1, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(71, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 38.08, 6, 4, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(73, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 60.00, 75, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(74, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 116.13, 75, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(75, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 56.79, 76, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(76, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 90.55, 76, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(77, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 64.98, 76, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(78, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 266.46, 76, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(79, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 86.90, 77, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(80, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 162.62, 77, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(81, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 100.74, 79, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(82, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 71.62, 79, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(83, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 35.65, 79, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(87, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 267.35, 82, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(88, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 254.61, 82, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(90, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 98.30, 81, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(92, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 60.00, 83, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(93, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 48.71, 83, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(94, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 80.48, 84, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(95, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 73.32, 84, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(96, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 64.98, 84, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(97, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 129.85, 84, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(98, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 142.03, 85, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(99, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 260.38, 85, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(101, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 37.42, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(102, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 139.26, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0);
INSERT INTO `produse` (`id`, `nume`, `cod`, `descriere`, `pret`, `id_categorie`, `id_subcategorie`, `id_producator`, `reducere`, `prima_pagina`, `super_oferta`, `indicatii`, `grila_masuri`, `prod_la_comanda`) VALUES
(103, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 119.12, 86, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(105, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 81.26, 18, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(106, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 56.46, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(107, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 56.79, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(108, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 34.88, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(109, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 62.44, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(110, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 106.05, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(111, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 71.63, 85, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(112, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 60.00, 22, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(113, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 86.90, 81, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(114, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 38.75, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(115, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 81.26, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(116, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 56.79, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(117, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 105.61, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(118, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 54.13, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(119, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 84.47, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(121, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 54.13, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(122, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 81.26, 81, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(123, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 80.26, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(124, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 81.26, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(125, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 79.48, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(126, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 121.99, 80, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(127, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 86.12, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(128, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 99.19, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(129, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 68.19, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(130, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 56.79, 54, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(131, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 56.79, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(132, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 85.24, 87, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(135, 'Orteză cervicală - COLAR', 'CC20', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce dignissim, sem sed aliquet aliquam, eros diam rutrum massa, vitae tristique elit lorem vitae turpis. Proin quis ipsum a purus dignissim fermentum. Nunc imperdiet consequat pulvinar. Proin pellentesque volutpat lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sollicitudin commodo tincidunt. Donec ultrices posuere elit, at vulputate felis dapibus a. Sed nec vulputate lacus. Aenean ac lacus sapien. Quisque ac erat est. Phasellus iaculis placerat nisl et pellentesque.\n\nPellentesque convallis purus sit amet metus rhoncus sagittis. In sed nibh erat. In malesuada, nunc egestas semper tempor, nunc lorem adipiscing lectus, in iaculis urna odio in ipsum. Etiam vel ipsum quis nisi tempus suscipit. Mauris et nunc lorem. Proin scelerisque egestas nisl, eu hendrerit est elementum eu. Integer ut risus lacus, at malesuada libero.', 33.98, 79, 0, 2, 0, 'nu', 'nu', 'Phasellus tincidunt nisl id augue aliquet vitae venenatis purus posuere. Maecenas massa turpis, elementum nec posuere sagittis, pretium ut nunc. Suspendisse hendrerit dictum diam id porta. Phasellus arcu enim, dignissim vitae pharetra dignissim, tempus ul', '', 0),
(145, 'Orteza de incheietura mainii mana deget', '13B', '• Structură complexă realizată din componente metalice modelabile căptuşite cu material\r\nmoale, buretos, biocompatibil.\r\n• Segmente pentru degete realizate din înlocuitor de piele.\r\n• Benzi elastice de cauciuc.', 0.00, 1, 28, 3, 0, 'nu', 'nu', '• Leziuni nervoase la nivelul mâinii.', 'S,M,L', 0),
(146, 'Orteza de glezna picior fixa pentru talus valgus', 'OPMI 101B', '• Realizată din polietilenă/ polipropilenă.\r\n• Individualizată în urma mulajului gipsat.\r\n• Capitonată la interior cu material moale.\r\n• Sistem de închidere cu bandă velcro.\r\n• Poate fi de posturare sau de mers în funcţie de vârsta copilului.', 0.00, 1, 29, 9, 0, 'nu', 'nu', '• Talus valgus.\r\n• Picior plat valg.', '', 1),
(147, 'Orteza de glezna picior fixa', 'OPMI 101C', '• Realizată din polietilenă / polipropilenă / piele.\r\n• Capitonată la interior cu material moale / meşină naturală.\r\n• Sistem de închidere cu bandă velcro.\r\n• Prezintă la nivelul tălpii ortezei un sistem articulat de reglaj al abducţiei antepiciorului faţă de retropicior.', 0.00, 1, 29, 9, 0, 'nu', 'nu', '• Picior varus equin.\r\n• Metatarsus varus.\r\n• Metatarsus adductus.', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stoc`
--

CREATE TABLE IF NOT EXISTS `stoc` (
  `id` int(10) NOT NULL auto_increment,
  `data_intrare` varchar(10) character set utf8 NOT NULL,
  `cantitate` int(10) NOT NULL,
  `id_produs` int(10) NOT NULL,
  `termen_garantie` varchar(10) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subcategorii`
--

CREATE TABLE IF NOT EXISTS `subcategorii` (
  `id` int(10) NOT NULL auto_increment,
  `id_categ` int(10) NOT NULL,
  `denumire` varchar(50) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_categ` (`id_categ`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=46 ;

--
-- Dumping data for table `subcategorii`
--

INSERT INTO `subcategorii` (`id`, `id_categ`, `denumire`) VALUES
(27, 1, 'Coloana vertebrala'),
(31, 1, 'Compresive'),
(45, 91, 'Recuperare medicale'),
(32, 2, 'Membrul inferior'),
(26, 1, 'Craniene'),
(28, 1, 'Membrul superior'),
(44, 91, 'Produse antiescara'),
(34, 2, 'San'),
(30, 1, 'Posturare'),
(33, 2, 'Membrul superior'),
(29, 1, 'Membrul inferior'),
(37, 9, 'Electroterapie'),
(38, 9, 'Ecografe'),
(39, 9, 'EKG'),
(40, 10, 'Hartie EKG'),
(41, 9, 'Hartie videoprinter'),
(42, 10, 'Gel ecografie'),
(43, 10, 'Electrozi');

-- --------------------------------------------------------

--
-- Table structure for table `tip_user`
--

CREATE TABLE IF NOT EXISTS `tip_user` (
  `id` int(1) NOT NULL auto_increment,
  `denumire` varchar(100) character set utf8 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tip_user`
--

INSERT INTO `tip_user` (`id`, `denumire`) VALUES
(1, 'Super administrator'),
(2, 'Administrator'),
(3, 'Cumparator');

-- --------------------------------------------------------

--
-- Table structure for table `useri`
--

CREATE TABLE IF NOT EXISTS `useri` (
  `id` int(10) NOT NULL auto_increment,
  `nume` varchar(100) character set utf8 NOT NULL,
  `prenume` varchar(100) character set utf8 NOT NULL,
  `id_judet` int(4) NOT NULL,
  `adresa` varchar(255) character set utf8 NOT NULL,
  `telefon` varchar(10) character set utf8 NOT NULL,
  `email` varchar(255) character set utf8 NOT NULL,
  `id_tip` int(1) NOT NULL default '3',
  `data_inscriere` varchar(10) character set utf8 NOT NULL,
  `usr` varchar(25) character set utf8 NOT NULL,
  `par` varchar(32) character set utf8 NOT NULL,
  `cod_postal` varchar(10) character set utf8 default NULL,
  `telefon_mobil` varchar(10) character set utf8 default NULL,
  `fax` varchar(10) character set utf8 default NULL,
  `stare` tinyint(1) NOT NULL default '0',
  `cod_validare` varchar(10) character set utf8 NOT NULL,
  `localitate` varchar(255) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `usr` (`usr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=30 ;

--
-- Dumping data for table `useri`
--

INSERT INTO `useri` (`id`, `nume`, `prenume`, `id_judet`, `adresa`, `telefon`, `email`, `id_tip`, `data_inscriere`, `usr`, `par`, `cod_postal`, `telefon_mobil`, `fax`, `stare`, `cod_validare`, `localitate`) VALUES
(1, 'Administrator', '', 0, '', '', 'webmaster@pretuimsanatatea.ro', 1, '28.07.2009', 'admin', 'fe01ce2a7fbac8fafaed7c982a04e229', '', '', '', 1, '', NULL),
(2, 'Bajanica', 'Bogdan', 8, 'acasa', '0339805605', 'dionisrom@yahoo.com', 3, '06.11.2009', 'dionisrom', 'fe01ce2a7fbac8fafaed7c982a04e229', '810297', '0730290445', '', 1, '', 'Braila'),
(26, 'Magdalinoiu ', 'Ovidiu', 13, 'Dumitrescu, 11', '0723398223', 'ovidiu@magdalinoiu.ro', 3, '28.02.2012', 'ovimag', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 0, '3wmzad3u2u', 'Bucuresti'),
(27, 'Ovi', 'Mag', 13, 'Dumitrecu, 11', '0723398223', 'ovidiu@magdalinoiu.ro', 3, '28.02.2012', 'ovimag2', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 0, 'fcphxi0tny', 'Bucuresti'),
(28, 'Ovi 3', 'Mag 4', 13, 'Dumitrescu, 11', '0723398223', 'ovidiu@magdalinoiu.ro', 3, '28.02.2012', 'ovimag3', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', 1, '', 'Bucuresti'),
(29, 'velea', 'simona', 15, 'iuliu maniu 158', '0213169605', 'simona@ortoprotetica.ro', 3, '29.02.2012', 'simonavelea', 'a52e5daeb1a7bf016c8859c07edcf359', '', '', '', 1, '', 'bucuresti');

-- --------------------------------------------------------

--
-- Table structure for table `vizionari`
--

CREATE TABLE IF NOT EXISTS `vizionari` (
  `id` int(10) NOT NULL auto_increment,
  `id_prod` int(10) NOT NULL,
  `data_vizionarii` timestamp NULL default CURRENT_TIMESTAMP,
  `id_user` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_prod` (`id_prod`),
  KEY `id_user` (`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=214 ;

--
-- Dumping data for table `vizionari`
--

INSERT INTO `vizionari` (`id`, `id_prod`, `data_vizionarii`, `id_user`) VALUES
(1, 134, '2012-02-19 13:37:24', 0),
(2, 23, '2012-02-19 13:37:36', 0),
(3, 134, '2012-02-19 13:39:34', 0),
(4, 23, '2012-02-19 13:40:54', 0),
(5, 134, '2012-02-19 13:41:50', 0),
(6, 23, '2012-02-19 13:41:55', 0),
(7, 134, '2012-02-19 13:43:16', 0),
(8, 134, '2012-02-19 13:43:29', 0),
(9, 23, '2012-02-19 13:43:38', 0),
(10, 134, '2012-02-19 13:44:07', 0),
(11, 134, '2012-02-19 13:45:06', 0),
(12, 23, '2012-02-19 13:48:09', 0),
(13, 134, '2012-02-19 13:48:12', 0),
(14, 61, '2012-02-19 13:48:19', 0),
(15, 23, '2012-02-19 13:48:58', 0),
(16, 134, '2012-02-19 13:50:23', 0),
(17, 61, '2012-02-19 13:51:36', 0),
(18, 134, '2012-02-19 13:52:16', 0),
(19, 61, '2012-02-19 13:52:34', 0),
(20, 23, '2012-02-19 13:53:15', 0),
(21, 61, '2012-02-19 13:54:37', 0),
(22, 23, '2012-02-19 13:55:07', 0),
(23, 61, '2012-02-19 13:55:13', 0),
(24, 23, '2012-02-19 13:57:16', 0),
(25, 23, '2012-02-19 13:57:23', 0),
(26, 23, '2012-02-19 13:57:46', 0),
(27, 22, '2012-02-19 13:59:52', 0),
(28, 61, '2012-02-19 14:00:56', 0),
(29, 22, '2012-02-19 14:00:58', 0),
(30, 134, '2012-02-19 14:04:47', 0),
(31, 23, '2012-02-19 14:05:24', 0),
(32, 23, '2012-02-20 08:04:03', 0),
(33, 61, '2012-02-20 08:31:11', 0),
(34, 72, '2012-02-20 08:31:17', 0),
(35, 72, '2012-02-20 08:31:21', 0),
(36, 134, '2012-02-20 21:42:31', 0),
(37, 62, '2012-02-20 21:43:00', 0),
(38, 69, '2012-02-20 21:43:03', 0),
(39, 134, '2012-02-21 17:09:01', 0),
(40, 23, '2012-02-28 09:40:06', 0),
(41, 61, '2012-02-28 09:40:14', 0),
(42, 22, '2012-02-28 09:40:16', 0),
(43, 72, '2012-02-28 09:40:17', 0),
(44, 23, '2012-02-28 09:40:19', 0),
(45, 22, '2012-02-28 09:42:08', 0),
(46, 22, '2012-02-28 09:42:10', 0),
(47, 61, '2012-02-28 09:42:10', 0),
(48, 134, '2012-02-28 09:42:11', 0),
(49, 23, '2012-02-28 09:42:11', 0),
(50, 22, '2012-02-28 09:54:18', 0),
(51, 134, '2012-02-28 10:00:36', 0),
(52, 22, '2012-02-28 10:00:51', 0),
(53, 23, '2012-02-28 11:01:27', 0),
(54, 22, '2012-02-28 12:44:57', 0),
(55, 23, '2012-02-28 12:45:01', 0),
(56, 23, '2012-02-28 20:28:04', 0),
(57, 134, '2012-02-28 20:28:05', 0),
(58, 23, '2012-02-28 20:28:07', 0),
(59, 23, '2012-02-28 20:31:49', 0),
(60, 61, '2012-02-28 20:53:44', 0),
(61, 23, '2012-02-28 21:00:36', 28),
(62, 22, '2012-02-28 21:01:44', 28),
(63, 72, '2012-02-28 21:01:53', 28),
(64, 134, '2012-02-28 22:53:52', 28),
(65, 23, '2012-02-28 23:00:57', 0),
(66, 134, '2012-02-28 23:22:13', 0),
(67, 137, '2012-02-28 23:26:45', 0),
(68, 137, '2012-02-28 23:34:21', 0),
(69, 137, '2012-02-28 23:34:29', 0),
(70, 137, '2012-02-28 23:35:01', 0),
(71, 134, '2012-02-28 23:35:12', 0),
(72, 72, '2012-02-28 23:35:12', 0),
(73, 23, '2012-02-28 23:35:14', 0),
(74, 23, '2012-02-28 23:35:15', 0),
(75, 137, '2012-02-28 23:35:23', 0),
(76, 137, '2012-02-28 23:35:25', 0),
(77, 137, '2012-02-28 23:35:27', 0),
(78, 137, '2012-02-28 23:35:29', 0),
(79, 137, '2012-02-28 23:35:31', 0),
(80, 137, '2012-02-28 23:35:32', 0),
(81, 137, '2012-02-28 23:36:12', 0),
(82, 23, '2012-02-28 23:36:19', 0),
(83, 134, '2012-02-28 23:36:23', 0),
(84, 136, '2012-02-28 23:36:39', 0),
(85, 136, '2012-02-28 23:36:45', 0),
(86, 137, '2012-02-29 11:47:18', 0),
(87, 137, '2012-02-29 12:02:01', 0),
(88, 137, '2012-02-29 12:05:49', 0),
(89, 137, '2012-02-29 12:06:05', 0),
(90, 137, '2012-02-29 12:18:33', 0),
(91, 137, '2012-02-29 12:22:37', 0),
(92, 137, '2012-02-29 12:24:15', 0),
(93, 137, '2012-02-29 12:25:32', 29),
(94, 137, '2012-02-29 12:25:38', 0),
(95, 70, '2012-02-29 19:24:36', 0),
(96, 134, '2012-02-29 19:24:50', 0),
(97, 136, '2012-02-29 19:24:53', 0),
(98, 136, '2012-03-06 11:04:39', 0),
(99, 137, '2012-03-06 16:37:34', 0),
(100, 61, '2012-03-06 17:28:59', 0),
(101, 137, '2012-03-08 18:50:52', 0),
(102, 23, '2012-03-08 18:51:09', 0),
(103, 91, '2012-03-08 18:52:00', 0),
(104, 137, '2012-03-08 18:54:58', 0),
(105, 136, '2012-03-08 18:55:07', 0),
(106, 136, '2012-03-08 18:55:33', 0),
(107, 136, '2012-03-08 18:56:16', 0),
(108, 134, '2012-03-08 21:19:15', 0),
(109, 137, '2012-03-08 21:20:21', 0),
(110, 137, '2012-03-08 21:21:03', 0),
(111, 64, '2012-03-08 21:31:39', 0),
(112, 23, '2012-03-08 21:32:04', 0),
(113, 136, '2012-03-08 21:32:16', 0),
(114, 134, '2012-03-08 21:32:22', 0),
(115, 137, '2012-03-08 21:33:54', 0),
(116, 23, '2012-03-08 21:34:15', 0),
(117, 134, '2012-03-08 21:39:45', 0),
(118, 136, '2012-03-08 21:39:50', 0),
(119, 134, '2012-03-08 21:44:04', 0),
(120, 136, '2012-03-08 21:44:11', 0),
(121, 134, '2012-03-08 21:48:06', 0),
(122, 137, '2012-03-08 23:49:37', 0),
(123, 57, '2012-03-08 23:49:53', 0),
(124, 134, '2012-03-08 23:49:56', 0),
(125, 138, '2012-03-12 15:16:21', 0),
(126, 138, '2012-03-12 15:31:15', 0),
(127, 72, '2012-03-12 22:06:10', 0),
(128, 138, '2012-03-12 22:06:12', 0),
(129, 91, '2012-03-12 22:06:15', 0),
(130, 138, '2012-03-12 22:09:17', 0),
(131, 138, '2012-03-12 22:09:43', 0),
(132, 139, '2012-03-12 22:09:48', 0),
(133, 91, '2012-03-12 22:10:41', 0),
(134, 140, '2012-03-12 22:16:02', 0),
(135, 142, '2012-03-13 08:15:17', 0),
(136, 143, '2012-03-13 08:26:10', 0),
(137, 142, '2012-03-13 08:26:52', 0),
(138, 143, '2012-03-13 08:27:19', 0),
(139, 144, '2012-03-13 09:47:37', 0),
(140, 142, '2012-03-13 10:14:45', 0),
(141, 142, '2012-03-13 10:15:01', 0),
(142, 135, '2012-03-13 10:16:34', 0),
(143, 143, '2012-03-13 10:17:00', 0),
(144, 144, '2012-03-13 10:17:05', 0),
(145, 143, '2012-03-13 10:17:11', 0),
(146, 135, '2012-03-13 10:17:19', 0),
(147, 135, '2012-03-13 10:17:38', 0),
(148, 142, '2012-03-13 10:17:38', 0),
(149, 133, '2012-03-13 10:17:41', 0),
(150, 142, '2012-03-13 14:33:47', 0),
(151, 143, '2012-03-13 17:41:12', 0),
(152, 142, '2012-03-13 17:41:33', 0),
(153, 143, '2012-03-13 17:41:58', 0),
(154, 91, '2012-03-13 17:41:59', 0),
(155, 135, '2012-03-13 17:42:00', 0),
(156, 72, '2012-03-13 17:42:00', 0),
(157, 142, '2012-03-13 17:42:01', 0),
(158, 144, '2012-03-13 17:42:16', 0),
(159, 144, '2012-03-13 17:59:29', 0),
(160, 145, '2012-03-14 12:23:14', 0),
(161, 145, '2012-03-14 12:25:15', 0),
(162, 146, '2012-03-14 12:30:57', 0),
(163, 147, '2012-03-14 12:35:13', 0),
(164, 147, '2012-03-14 12:35:41', 0),
(165, 148, '2012-03-14 12:40:10', 0),
(166, 149, '2012-03-14 12:44:49', 0),
(167, 150, '2012-03-14 12:55:52', 0),
(168, 150, '2012-03-14 13:04:16', 0),
(169, 151, '2012-03-14 13:04:21', 0),
(170, 145, '2012-03-14 13:08:49', 0),
(171, 147, '2012-03-14 13:09:00', 0),
(172, 143, '2012-03-14 19:27:38', 0),
(173, 152, '2012-03-14 19:29:32', 0),
(174, 150, '2012-03-14 19:33:27', 0),
(175, 150, '2012-03-14 19:37:05', 0),
(176, 152, '2012-03-14 19:37:17', 0),
(177, 145, '2012-03-14 19:39:03', 0),
(178, 145, '2012-03-14 19:39:15', 0),
(179, 145, '2012-03-14 19:39:45', 0),
(180, 145, '2012-03-14 19:40:17', 0),
(181, 143, '2012-03-14 19:48:19', 0),
(182, 143, '2012-03-14 20:11:13', 0),
(183, 143, '2012-03-14 20:16:08', 0),
(184, 143, '2012-03-14 20:32:17', 0),
(185, 144, '2012-03-14 20:32:21', 0),
(186, 152, '2012-03-14 20:38:21', 0),
(187, 151, '2012-03-14 20:38:31', 0),
(188, 144, '2012-03-14 20:39:11', 0),
(189, 147, '2012-03-14 20:55:53', 0),
(190, 147, '2012-03-14 20:56:53', 28),
(191, 145, '2012-03-14 20:57:12', 28),
(192, 143, '2012-03-14 20:58:26', 28),
(193, 142, '2012-03-19 06:00:52', 0),
(194, 142, '2012-03-19 12:15:29', 0),
(195, 142, '2012-03-19 12:15:34', 0),
(196, 142, '2012-03-19 12:20:33', 0),
(197, 142, '2012-03-19 12:32:25', 0),
(198, 145, '2012-03-19 12:32:56', 0),
(199, 147, '2012-03-19 12:35:14', 0),
(200, 144, '2012-03-19 14:14:48', 0),
(201, 148, '2012-03-23 13:25:20', 0),
(202, 150, '2012-03-23 15:09:10', 0),
(203, 150, '2012-03-23 15:21:08', 0),
(204, 154, '2012-03-25 23:26:14', 0),
(205, 142, '2012-03-26 11:39:18', 0),
(206, 142, '2012-03-28 12:07:04', 0),
(207, 154, '2012-03-28 13:34:20', 0),
(208, 144, '2012-03-28 13:34:42', 0),
(209, 142, '2012-03-30 10:42:44', 0),
(210, 143, '2012-03-30 10:42:45', 0),
(211, 145, '2012-03-30 10:42:47', 0),
(212, 144, '2012-03-30 10:42:48', 0),
(213, 72, '2012-03-30 10:42:50', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
