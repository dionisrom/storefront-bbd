<?php
  session_start();
  include ("inc/global.php");
  $sql_cos = "INSERT INTO cos (data,ora,produse,cantitati,id_user,curier) VALUE ('".strftime('%d.%m.%Y',time())."','".strftime('%H:%M:%S',time())."','".implode(",",$_SESSION["id_produse"])."','".implode(",",$_SESSION["cant_produse"])."',".$_SESSION["id_user"].", ".$_REQUEST['curier'].")";
  mysql_query($sql_cos) or die("Eroare la finalizarea cosului !");
  session_unregister("cos");
  session_unregister("nr_produse");
  session_unregister("id_produse");
  session_unregister("cant_produse");
  session_unregister("pret_produse");
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
            alert("Cosul dumneavostra a fost salvat!\nUrmeaza sa primiti confirmarea din partea noastra !\nVa multumim");
  			top.document.getElementById("continut_cos").innerHTML="<p align=center>Cosul este gol!</p>";
  			top.document.getElementById("main_frame").src = "ro/acasa.htm";
  		</script>
    </body>
    </html>
  ';
?>
