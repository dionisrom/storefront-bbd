<?
session_start();
include("../inc/global.php");
if ( isset($_REQUEST["mod"]) && $_REQUEST["mod"] != null && $_REQUEST["mod"] != "" )
{
    $mod = $_REQUEST["mod"];
}
else
{
    $mod = 0;
}
if ( intval($mod) == 1 )
{
    $str_prod = "SELECT a.*, b.denumire, c.denumire, c.id FROM produse a, categorii b, producatori c WHERE a.id=".$_REQUEST["id_produs"]." and b.id = a.id_categorie and c.id = a.id_producator ORDER BY a.nume";
    $q_prod = mysql_query($str_prod) or die ("Eroare preluare produse. ".mysql_error());
    $num = mysql_num_fields($q_prod);
    $tabel = "";
    while ( $rs_prod = mysql_fetch_array($q_prod) )
    {
        $imagine = "<img src='../images/no_foto.jpg' border=0 width=100 height=160 class='corner iradius15 ishadow25'>";
        if( file_exists("../images/produse/".$rs_prod[0].".jpg") )
            $imagine = "<img src='../images/produse/".$rs_prod[0].".jpg' title='Apasati pentru a mari imaginea !' onclick=\"window.open(this.src);\" border=0 width=100 height=160 class='corner iradius15 ishadow25'>";
        if( file_exists("../images/produse/".$rs_prod[0].".gif") )
            $imagine = "<img src='../images/produse/".$rs_prod[0].".gif' title='Apasati pentru a mari imaginea !' onclick=\"window.open(this.src);\" border=0 width=100 height=160 class='corner iradius15 ishadow25'>";
        if ( $rs_prod[8] > 0 )
        {
            $pret = "<font style='text-decoration: line-through;'>".$rs_prod[4]."</font>&nbsp;&nbsp;".$rs_prod[4]*((100-$rs_prod[8])/100);
        }
        else
        {
            $pret = $rs_prod[4];
        }
        $af = substr($rs_prod[6],0,(strlen($rs_prod[6])-1) );
        $sql_af = "SELECT denumire FROM subcategorii WHERE id IN (".$af.")" ;
        $q_af = mysql_query($sql_af);
        $af_str = "";
        if ( mysql_num_rows($q_af) > 0 )
        {
            while ( $rs_af = mysql_fetch_array($q_af) )
            {
                $af_str .= $rs_af[0]."<br>";
            }
        }
        $sql_cataf = "SELECT distinct a.denumire FROM categorii a, subcategorii b WHERE b.id IN (".$af.") and b.id_categ = a.id" ;
        $q_cataf = mysql_query($sql_cataf) or die("Eroare preluare subcategorii!<br>".$sql_cataf);
        $cataf_str = "";
        if ( mysql_num_rows($q_cataf) > 0 )
        {
            while ( $rs_cataf = mysql_fetch_array($q_cataf) )
            {
                $cataf_str .= $rs_cataf[0]."<br>";
            }
        }
        $tabel .= "
            <tr>
                <td onmouseover=\"this.style.cursor='pointer'; return false;\" width=110>
                    ".$imagine."
                </td>
                <td align=left>
                    <table border=0 cellpadding=0 cellspacing=5>
                        <tr>
                            <td class='trans'>Cod:</td><td class='trans'>".$rs_prod[2]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Denumire produs:</td><td class='trans'>".$rs_prod[1]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Producator:</td><td class='trans'>".$rs_prod[($num-2)]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Pret:</td><td class='trans'>".$pret." RON</td>
                        </tr>
                        <tr>
                            <td class='trans'>Categorie:</td><td class='trans'>".$rs_prod[($num-3)]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Subcategorie:</td><td class='trans'>".$af_str."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Grila de masuri:</td><td class='trans'>".$rs_prod[12]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Cantitate:</td>
                            <td class='trans'>
                            	<input type='text' class='input' id='cant_".$rs_prod[0]."' id='cant_".$rs_prod[0]."' value='0' size=8>
                            	<input type='button' title='Adauga in cos' class='submit' value='Adauga in cos' onclick=\"if (document.getElementById('cant_".$rs_prod[0]."').value>0) {top.document.getElementById('cos_frame').src='cos.php?adauga_prod=1&cant_prod='+document.getElementById('cant_".$rs_prod[0]."').value+'&pret_prod=".$pret."&id_prod=".$rs_prod[0]."';} else {alert('Nu ati completat cantitatea dorita ! ')};\">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <table border=0 cellpadding=0 cellspacing=5>
                        <tr>
                            <td class='trans' width=70>Descriere:</td><td class='trans'>".str_replace("\n","<br>",$rs_prod[3])."</td>
                        </tr>
                    </table>    
                </td>
            </tr>
            ";
            if ( trim($rs_prod[11]) != null && trim($rs_prod[11]) != "" )
            {
				$tabel .= "
				<tr>
	                <td colspan=2>
	                    <table border=0 cellpadding=0 cellspacing=5>
	                        <tr>
	                            <td class='trans' width=70>Indicatii:</td><td class='trans'>".str_replace("\n","<br>",$rs_prod[11])."</td>
	                        </tr>
	                    </table>    
	                </td>
	            </tr>";
            }
        }
}
if ( intval($mod) == 2 )
{
    $filtru = "";
	if ( isset($_REQUEST["pagina"]) )
        $nr_pag = intval($_REQUEST["pagina"]);
    else
        $nr_pag = 1;
    if ( isset($_REQUEST["el_pag"]) )
        $el_in_pag = intval($_REQUEST["el_pag"]);
    else
        $el_in_pag = 10;
    $limit = " LIMIT ".(($nr_pag-1)*$el_in_pag).", ".$el_in_pag;
    //echo $limit;
	$sql_produse = "SELECT id, nume, descriere, pret, reducere FROM produse ORDER BY nume";
	$inputs = "";
    if ( isset($_REQUEST["id_pr"]) )
    {
        $filtru = "WHERE id_producator=".$_REQUEST["id_pr"]."";
        $inputs .= "
        <input type='hidden' id='id_pr' name='id_pr' value='".$_REQUEST["id_pr"]."'>";
        $sql_produse = "SELECT id, nume, descriere, pret, reducere FROM produse ".$filtru." ORDER BY nume"; 
    } 
    if ( isset($_REQUEST["id_cat"]) )
    {
        $sql1 = "SELECT id FROM afectiuni WHERE id_cat_afectiune = ".$_REQUEST["id_cat"];
        $query1 = mysql_query($sql1);
        $filtru .= "WHERE ( ";
        while ( $rs1 = mysql_fetch_array($query1) )
        {
            $filtru .= " FIND_IN_SET('".$rs1[0]."', LEFT(produse.id_afectiune,(LENGTH(produse.id_afectiune)-1))) or";
        }
        $filtru = substr($filtru, 0, (strlen($filtru)-2) );
        $filtru .= ")";
        $inputs .= "
        <input type='hidden' id='id_cat' name='id_cat' value='".$_REQUEST["id_cat"]."'>";
        $sql_produse = "SELECT produse.id, produse.nume, produse.descriere, produse.pret, produse.reducere FROM produse ".$filtru;
    }
    if ( isset($_REQUEST["id_af"]) )
    {
        $filtru = "WHERE ".$_REQUEST["id_af"]." IN (LEFT(id_afectiune,(LENGTH(id_afectiune)-1)))";
        $inputs .= "
        <input type='hidden' id='id_af' name='id_af' value='".$_REQUEST["id_af"]."'>";
        $sql_produse = "SELECT id, nume, descriere, pret, reducere FROM produse ".$filtru." ORDER BY nume"; 
    }
    if ( isset($_REQUEST["id_catprod"]) )
    {
        $filtru = "WHERE produse.id_categorie=".$_REQUEST["id_catprod"]."";
        $inputs .= "
        <input type='hidden' id='id_catprod' name='id_catprod' value='".$_REQUEST["id_catprod"]."'>";
        $sql_produse = "SELECT produse.id, produse.nume, produse.descriere, produse.pret, produse.reducere, categorii.denumire FROM produse LEFT JOIN categorii ON categorii.id = produse.id_categorie ".$filtru." ORDER BY produse.nume"; 
    } 
    // --------------------- PAGINARE ----------------------
    
    $q_nr_prod = mysql_query("SELECT count(id) FROM produse ".$filtru);
    $rs_nr_prod = mysql_fetch_array($q_nr_prod);
    $nr_pags = ceil($rs_nr_prod[0] / $el_in_pag);
    //echo $nr_pag.", ".$nr_pags.", ".$rs_nr_prod[0];
    $tabel_pag = "Pagina";
    for ( $e=1; $e<=$nr_pags; $e++ )
    {
        if ( $e == $nr_pag )
            $tabel_pag .= "<td onmouseover=\"this.style.cursor='pointer'; this.style.backgroundColor='#ff0';\" onclick=\"document.getElementById('pagina').value='".$e."';document.getElementById('mod_pags').submit();\">".$e."</td>";
        else
            $tabel_pag .= "<td onmouseover=\"this.style.cursor='pointer'; this.style.backgroundColor='#ff0';\" onmouseout=\"this.style.backgroundColor='transparent';\" onclick=\"document.getElementById('pagina').value='".$e."';document.getElementById('mod_pags').submit();\">".$e."</td>";
    }
    $sel = "
    
    Produse / pagina : 
    <input type='hidden' id='pagina' name='pagina' value=0>
    <input type='hidden' id='mod' name='mod' value=2>".$inputs."
    <select id='el_pag' name='el_pag' class='input' style=\"-moz-border-radius: 0px;-webkit-border-radius: 0px;\" onchange=\"document.getElementById('pagina').value=1;document.getElementById('mod_pags').submit();\">
        <option value=10> 10 </option>
        <option value=20> 20 </option>
        <option value=30> 30 </option>
        <option value=99999> Toate </option>
    </select>
    <script>
        for (i=0;i<document.getElementById('el_pag').options.length;i++)
        {
            if ( document.getElementById('el_pag').options[i].value == $el_in_pag )
                document.getElementById('el_pag').selectedIndex=i;
                document.getElementById('el_pag').value=$el_in_pag;
        }
    </script>
    ";
    $tabel_pag .= $sel;
    // --------------------- PAGINARE ----------------------
	//echo $sql_produse."<br>";
    $sql_produse .= $limit;
    $q_produse = mysql_query($sql_produse) or die("Eroare preluare produse!");
    $tabel = "
    <div id='produse'>
        ";
    $nr = 1;
    while ($rs_produse = mysql_fetch_array($q_produse))
    {
        $image = "&nbsp;";
        $image = "<img src='../images/no_foto.jpg' class='img_caseta_prod' alt='' />";
        if ( file_exists("../images/produse/".$rs_produse[0].".jpg") )
        {
            $image = "<img src='../images/produse/".$rs_produse[0].".jpg' class='img_caseta_prod' alt='' />";
        }
        if ( file_exists("../images/produse/".$rs_produse[0].".gif") )
        {
            $image = "<img src='../images/produse/".$rs_produse[0].".gif' class='img_caseta_prod' alt='' />";
        }
        if ( $rs_produse[4] > 0 )
        {
            $pret = "<font style='text-decoration: line-through;'>".$rs_produse[3]."</font>&nbsp;&nbsp;".$rs_produse[3]*((100-$rs_produse[4])/100);
            $pret_ron = $rs_produse[3]*((100-$rs_produse[4])/100);
        }
        else
        {
            $pret = $rs_produse[3];
            $pret_ron = $rs_produse[3];
        }
        $tabel .= "
             <div class='caseta_prod'>
				<div class='categorie_prod_top'>$rs_produse[5]</div>
                <div style='text-align:center;' title='".$rs_produse[1]."' onmouseover=\"this.style.cursor='pointer';\" onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\">".$image."</div>
                <div class='nume_prod'>".substr($rs_produse[1],0,20)."</div>
                <div class='pret_div'>pret <span class='pret'>".$pret."</span> Lei <input type='button' onmouseover=\"this.style.cursor='pointer';\" title='Detalii despre produs' class='detalii_prod' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\" /></div>
                <div class='descript_prod'>".substr(trim($rs_produse[2]),0,70)."...</div>
                <div class='prod_in_cos'>Cantitate: <input type='text' class='input' id='cant_".$rs_produse[0]."' id='cant_".$rs_produse[0]."' value='0' size=4 /> <input type='button' title='Adauga in cos' class='add_to_cart' onmouseover=\"this.style.cursor='pointer';\" onclick=\"if (document.getElementById('cant_".$rs_produse[0]."').value>0) {top.document.getElementById('cos_frame').src='cos.php?adauga_prod=1&cant_prod='+document.getElementById('cant_".$rs_produse[0]."').value+'&pret_prod=".$pret_ron."&id_prod=".$rs_produse[0]."';} else {alert('Nu ati completat cantitatea dorita ! ')};\" /></div>
             </div>
            ";   
    }
    $table .= "
        </div>
    ";
}
$table .= "</table>";
?>
<html>
    <head>
        <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
        <title>Afisare produse</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="description" content="Medical Active - Afisare produse">
        <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
        <script type="text/javascript" src="../js/corner.js"></script>
        <style>
        .trans
        {
            height: 20px;
            font-size: 12px;
            font-weight: 200;
            vertical-align: top;
            background: url(../images/bg_galben.png);
            background-repeat: repeat;
            color:#000;
            text-align: justify;
            white-space: normal;
        }
        </style>
    </head>
    <body>
        <div class="titlu_pag">
            <?
            if ( $mod == 1 )
                echo "<img src='../ico/back.png' title='Inapoi' width='21' onmouseover=\"this.style.cursor='pointer';\" onclick=\"history.go(-1);\">  ";
            ?>
            Afisare produse
        </div>
		<?php
		if ( $mod == 2 )
		{
	        if ( $rs_nr_prod[0] > 0 )
	        {
	        ?>
	            <div align=center><form id='mod_pags'><table border=0 cellspacing=3 cellpadding=2 style='white-space: nowrap; height: 15px;'><tr><td></td><?=$tabel_pag?></tr></table></form></div>
	        <?php
	        }
	        else
	        {
	            echo "Nu exista produse pentru care sa indeplineasca conditiile solicitate !";
	        }
		}
        ?>
        <table cellpadding="0" cellspacing="0" border="0">
            <?=$tabel?>
        </table>
    </body>
</html>