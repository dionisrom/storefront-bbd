<?
    session_start();
    include("inc/global.php");
    mysql_query("UPDATE useri SET stare=1 , cod_validare = '' WHERE usr like '".$_REQUEST["username"]."' and cod_validare like '".trim($_REQUEST["cod"])."' ") or die("Eroare la validare! Va rugam contactati administratorul site-lui!" );
    $q_user = mysql_query("SELECT * FROM useri WHERE usr like '".$_REQUEST["username"]."'");
    $rs = mysql_fetch_array($q_user);
    $_SESSION["err"] = "";
    $_SESSION["user"] = $rs[9];
	$_SESSION["id_user"] = $rs[0];
	$_SESSION["nume"] = $rs[1]." ".$rs[2];
	$_SESSION["mesaj_auth"]= "Bine ai revenit <br>".$rs[1]." ".$rs[2]." !";
	$_SESSION["id"] = $_REQUEST["sessid"];
	$_SESSION["auth"] = "da";
	$_SESSION["tipusr"] = $rs[7];
    echo '
    <html>
    <head>
        <title>Validare cont utilizator</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - Validare cont utilizator">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="css/default.css" REL="stylesheet" TYPE="text/css">    
    </head>
    <body>
        <script>
        	alert("Validarea a fost facuta cu succes.");
        	parent.location.href="http://www.pretuimsanatatea.ro/";
        </script>
    </body>
    </html>
    ';
?>