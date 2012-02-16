<?php 
//session_start();
define("DB_SERVER", "localhost");
define("DB_NAME", "orto");
define ("DB_USER", "root");
define ("DB_PASSWORD", "arnia");
$db=mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die ("Nu pot sa ma conectez !!! ".mysql_error()); 
mysql_select_db(DB_NAME, $db) or die ("Nu gasesc baza de date !!! ".mysql_error());
date_default_timezone_set('Europe/Bucharest');
?>