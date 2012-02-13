<?php
  session_start();
?>
<html>
<head>
    <title>Cautare</title>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="author" content="Bajanica Bogdan Dionisie">
    <meta name="description" content="Medical Active - Cautare">
    <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">    
</head>
<body>
    <div class="titlu_pag">Rezultate cautare</div>
    <?
    include("../inc/global.php");
    if ( isset($_REQUEST["caut"]) && $_REQUEST["caut"] != "" )
    {
        $sql_af = "";
        $sql_cat = "";
        $sql_cataf = "";
        $sql_pr = "";
        if ( $_REQUEST["ch_af"] == 1 )
        {
            $sql_af = "SELECT * FROM afectiuni WHERE denumire like '%".$_REQUEST["caut"]."%'";
            $sql_cataf = "SELECT * FROM categorii_afectiuni WHERE denumire like '%".$_REQUEST["caut"]."%'";
            $q_af = mysql_query($sql_af) or die("Eroare preluare afectiuni!");
            $q_cataf = mysql_query($sql_cataf) or die("Eroare preluare categorii de afectiuni!");
            if ( mysql_num_rows($q_af) )
            {
                echo "<div class='titlu_cap'>Rezultate - afectiuni</div>";
                while ( $rs_af = mysql_fetch_array($q_af) )
                {
                    echo "<a href='javascript:;' title='' alt='' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_af=".$rs_af[0]."'\">".$rs_af[1]."</a><br>";
                }
            }
            if ( mysql_num_rows($q_cataf) )
            {
                echo "<div class='titlu_cap'>Rezultate - categorii de afectiuni</div>";
                while ( $rs_cataf = mysql_fetch_array($q_cataf) )
                {
                    echo "<a href='javascript:;' title='' alt='' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_af=".$rs_cataf[0]."'\">".$rs_cataf[1]."</a><br>";
                }
            }
        }
        if ( $_REQUEST["ch_pr"] == 1 )
        {
            $sql_pr = "SELECT * FROM produse WHERE nume like '%".$_REQUEST["caut"]."%' or descriere like '%".$_REQUEST["caut"]."%' or indicatii like '%".$_REQUEST["caut"]."%'";
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
        if ( $_REQUEST["ch_cat"] == 1 )
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
        if ( $_REQUEST["ch_prod"] == 1 )
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
</body>
</html>

