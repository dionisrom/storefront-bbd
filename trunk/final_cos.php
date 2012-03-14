<?php
session_start();
include ("inc/global.php");
$sql_cos = "INSERT INTO cos (data,ora,produse,cantitati,preturi,masuri,id_user,curier) VALUE ('".strftime('%d.%m.%Y',time())."','".strftime('%H:%M:%S',time())."','".implode(",",$_SESSION["id_produse"])."','".implode(",",$_SESSION["cant_produse"])."','".implode(",",$_SESSION["pret_produse"])."','".implode(",",$_SESSION["masura_produse"])."',".$_SESSION["id_user"].", ".$_REQUEST['curier'].")";
mysql_query($sql_cos) or die("Eroare la finalizarea cosului !");
unset($_SESSION["cos"]);
unset($_SESSION["nr_produse"]);
unset($_SESSION["id_produse"]);
unset($_SESSION["cant_produse"]);
unset($_SESSION["pret_produse"]);
unset($_SESSION["masura_produse"]);
$headers = 'From: webmaster@ortoprotetica.ro' . "\n" .
		'Reply-To: webmaster@ortoprotetica.ro' . "\n" .
		'X-Mailer: PHP/' . phpversion().
		'MIME-Version: 1.0' . "\n".
		'Content-type: text/html; charset=utf-8' . "\n";
mail("comenzi@ortoprotetica.ro","A fost adaugata o noua comanda pe site","A fost adaugata o noua comanda de produse de pe siteul ortoprotetica.ro!",$headers) ;
echo '
<html>
<head>
	<title>Finalizare cos</title>
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta name="author" content="Bajanica Bogdan Dionisie">
	<meta name="description" content="Ortoprotetica - Finalizare cos">
	<meta name="copyright" content="&copy; 2012 Ortoprotetica" />
	<LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">
</head>
<body>
	<script>
		top.document.location.href="index.php";
	</script>
</body>
</html>
';
  
?>
