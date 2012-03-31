-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 09, 2012 at 04:28 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orto`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
CREATE TABLE IF NOT EXISTS `files` (
  `id_file` int(11) NOT NULL AUTO_INCREMENT,
  `denumire` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `last_change` int(13) NOT NULL,
  PRIMARY KEY (`id_file`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id_file`, `denumire`, `content`, `last_change`) VALUES
(1, 'cum_cumpar', '<html>\r\n    <head>\r\n        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">\r\n        <title>Cum cumpar ?</title>\r\n        <meta http-equiv="Pragma" content="no-cache">\r\n        <meta http-equiv="Cache-Control" content="no-cache">\r\n        <meta name="description" content="Medical Active - cum cumpar ?">\r\n        <meta name="copyright" content="&copy; 2009 Medical Active SRL" />\r\n        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">\r\n    </head>\r\n    <body>\r\n    <div class="titlu_pag">Cum cumpar ?</div>\r\n    <ul>\r\n        <div class="titlu_mic">Cumpara online:</div>\r\n        <li>Pentru a efectua o comanda prin intermediul magazinului nostru este necesar sa va Inregistrati  , folosind o adresa de e-mail valida.</li>\r\n        <li>Alegeti produsul dorit, selectati cantitatea dorita si apoi faceti click pe butonul "Adauga in cos".</li>\r\n        <li>Pentru vizualizarea produselor alese faceti click pe "Vezi cos" din sectiunea Cos de cumparaturi aflata in dreapta paginii.</li>\r\n        <li>Aveti posibilitatea sa vizualizati istoricul comenzilor efectuate in sectiunea "Istoric cumparaturi" si sa reluati una din tranzactii.</li>\r\n        <li>Valoarea minima a comenzii este de 10,00 RON.</li>\r\n    </ul>\r\n    </body>\r\n</html>', 0),
(2, 'cum_platesc', '', 0),
(3, 'contact', '&lt;p&gt;;kl;kl;k&lt;/p&gt;', 0),
(4, 'despre', '<html>\r\n<head>\r\n	<title>Despre noi</title>\r\n	<meta http-equiv="Pragma" content="no-cache">\r\n	<meta http-equiv="Cache-Control" content="no-cache">\r\n	<meta name="description" content="Medical Active - Despre noi">\r\n	<meta name="copyright" content="&copy; 2009 Medical Active SRL" />\r\n	<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">\r\n    <script type="text/javascript" src="../js/corner.js"></script>	\r\n</head>\r\n<body>\r\n	<div class="titlu_pag">\r\n		Despre noi\r\n	</div>\r\n    <div class="footer">\r\n        <div style="text-indent:15px;">MEDICAL ACTIVE SRL isi doreste, ca pe langa a va oferi o serie de produse naturiste, sa devina un real partener pentru sanatatea dumneavoastra. De aceea, din multitudinea de produse existente pe piata si dupa o evaluare prealabila a cerintelor (in functie de: varsta, afectiuni), incercam sa raspundem doleantelor dumneavoastra.</div>\r\n        <div style="text-indent:15px;">COMPARTIMENTUL MEDICAL al MEDICAL ACTIVE SRL - asigura consultatii si recomandari medicale gratuite, pentru partenerii/utilizatorii produselor achizitionate din magazinul propriu (contact: 0724 220 270 sau e-mail).</div>\r\n        <div style="text-indent:15px;">Nu ne-am propus sa incarcam pagini intregi cu produse greu accesibile ci chiar sa va cerem parerile, sugestiile pentru ca ne intereseaza mai mult raportul pret/calitate/accesibilitate/adresabilitate.</div>\r\n        <div style="text-indent:15px;">Pagina  de produse naturiste este construita dupa un studiu atent al afectiunilor mai frecvente si pe grupe de varsta. Compartimentul medical va sta la dispozitie si va raspunde la intrebari privind: starea de sanatate, administrarea produselor etc.</div>       \r\n        <div style="text-indent:15px;">Suntem in primul rand interesati de evolutia afectiunilor cu care ne confruntam. De aceea, dorim in primul rand sa comunicam cu dumneavoastra, apoi daca alegeti un produs de pe pagina noastra, inseamna ca efectul comunicarii a fost cel asteptat de ambii parteneri.</div>\r\n        <div style="text-indent:15px;">Continutul acestui site are un caracter informativ si nu se substituie diagnosticarilor si/sau recomandarilor medicale de specialitate.</div>\r\n        <div style="text-indent:25px;">-Produsele descrise pe acest site se elibereaza fara reteta</div>\r\n        <div style="text-indent:25px;">-Cititi cu atentie prospectele care insotesc produsele comadate</div>\r\n        <div style="text-indent:25px;">-MedFarma nu este responsabil pentru administrarea  neadecvata sau incorecta a produselor oferite.</div>\r\n    </div>\r\n</body>\r\n</html>', 0),
(6, 'asistenta', '', 0),
(7, 'parteneri', '', 0),
(8, 'livrare', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
