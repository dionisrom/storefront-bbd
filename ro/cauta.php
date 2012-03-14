<?php
  session_start();
?>
<html>
<head>
    <title>Cautare</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="author" content="Bajanica Bogdan Dionisie">
    <meta name="description" content="Ortoprotetica - Cautare">
    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
	<style>
		a:link, a:active, a:visited
		{
			text-decoration: none;
			color: #2B6FB6;
			padding: 0;
			margin: 0;
			display: block;
		}
		a:hover
		{
			color: #808080;
		}
	</style>
</head>
<body>
    <div class="titlu_pag">Rezultate cautare</div>
    <?
    include("../inc/global.php");
    if ( isset($_REQUEST["caut"]) && $_REQUEST["caut"] != "" )
    {
        //$sql_af = "";
        //$sql_cat = "";
        //$sql_cataf = "";
        //$sql_pr = "";
        if ( 1 == 1 )
        {
            $sql_pr = "SELECT * FROM produse WHERE cod like '%".$_REQUEST["caut"]."%' or nume like '%".$_REQUEST["caut"]."%' or descriere like '%".$_REQUEST["caut"]."%' or indicatii like '%".$_REQUEST["caut"]."%'";
            $q_pr = mysql_query($sql_pr) or die("Eroare preluare produse!");
            if ( mysql_num_rows($q_pr) )
            {
                echo "<div class='titlu_cap'>Rezultate - produse</div>";
                while ( $rs_pr = mysql_fetch_array($q_pr) )
                {
                    echo "<a href='javascript:;' title='' alt='' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_pr[0]."'\">".$rs_pr[1]."</a><br>";
                }
            }
        }
        if ( 1 == 1 )
        {
            $sql_cat = "SELECT * FROM categorii WHERE denumire like '%".$_REQUEST["caut"]."%'";
            $q_cat = mysql_query($sql_cat) or die("Eroare preluare categorii!");
            if ( mysql_num_rows($q_cat) )
            {
                echo "<div class='titlu_cap'>Rezultate - produse</div>";
                while ( $rs_cat = mysql_fetch_array($q_cat) )
                {
                    echo "<a href='javascript:;' title='' alt='' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_catprod=".$rs_cat[0]."'\">".$rs_cat[1]."</a><br>";
                }
            }
        }
        if ( 1 == 1 )
        {
            $sql_prod = "SELECT * FROM producatori WHERE denumire like '%".$_REQUEST["caut"]."%'";
            $q_prod = mysql_query($sql_prod) or die("Eroare preluare producatori!");
            if ( mysql_num_rows($q_prod) )
            {
                echo "<div class='titlu_cap'>Rezultate - producatori</div>";
                while ( $rs_prod = mysql_fetch_array($q_prod) )
                {
                    echo "<a href='javascript:;' title='' alt='' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_pr=".$rs_prod[0]."'\">".$rs_prod[1]."</a><br>";
                }
            }
        }
        
    }
    ?>
<script type="text/javascript">
	jQuery(window).load(function(){
		var db1 = jQuery("html").height();
		var docHeight = db1;
		jQuery("#main_frame",window.parent.document).height(docHeight +50);
		jQuery("#body",window.parent.document).height(docHeight +60);
	})
</script>
</body>
</html>

