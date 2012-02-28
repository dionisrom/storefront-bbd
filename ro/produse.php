<?
session_start();
include_once("../inc/global.php");
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
    $str_prod = "SELECT a.*, b.denumire as categorie, c.denumire as producator, d.denumire as subcategorie FROM produse a, categorii b, producatori c, subcategorii d WHERE a.id=".$_REQUEST["id_produs"]." and b.id = a.id_categorie and c.id = a.id_producator and d.id = a.id_subcategorie ORDER BY a.nume";
    $q_prod = mysql_query($str_prod) or die ("Eroare preluare produse. ".mysql_error());
    $num = mysql_num_fields($q_prod);
    $table = "";
    if (mysql_num_rows($q_prod) > 0 )
    {
		// Introducere vizionare pentru articolul curent - START
		if (isset($_SESSION["id_user"]))
			$id_user = $_SESSION["id_user"];
		else
			$id_user = 0;
		$sql_vizionare = "INSERT INTO vizionari (id_prod, id_user) VALUES (".$_REQUEST["id_produs"].",".$id_user.")";
		$q_ins_viz = mysql_query($sql_vizionare) or die ("Eroare introducere vizionare. ".mysql_error($q_ins_viz)."<br />".$sql_vizionare);
		// Introducere vizionare pentru articolul curent - STOP
		
		$rs_prod = mysql_fetch_array($q_prod);
		$imagine = "<img src='../images/produse/no_foto.jpg' border=0 height=160 />";
        if( file_exists("../images/produse/".$rs_prod["id"].".jpg") )
            $imagine = "<img src='../images/produse/".$rs_prod["id"].".jpg' title='Apasati pentru a mari imaginea !' onclick=\"window.open(this.src);\" border=0 height=160 />";
        if( file_exists("../images/produse/".$rs_prod["id"].".gif") )
            $imagine = "<img src='../images/produse/".$rs_prod["id"].".gif' title='Apasati pentru a mari imaginea !' onclick=\"window.open(this.src);\" border=0 height=160 />";
        if ( $rs_prod["reducere"] > 0 )
        {
            $pret = "<font style='text-decoration: line-through;'>".$rs_prod["pret"]."</font>&nbsp;&nbsp;".$rs_prod["pret"]*((100-$rs_prod["reducere"])/100);
        }
        else
        {
            $pret = $rs_prod["pret"];
        }
        $table .= "
            <tr>
                <td onmouseover=\"this.style.cursor='pointer'; return false;\" width=110>
                    ".$imagine."
                </td>
                <td align=left>
                    <table border=0 cellpadding=0 cellspacing=5>
                        <tr>
                            <td class='trans'>Cod:</td><td class='trans'>".$rs_prod["cod"]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Denumire produs:</td><td class='trans'>".$rs_prod["nume"]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Producator:</td><td class='trans'>".$rs_prod[("producator")]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Pret:</td><td class='trans'>".$pret." Lei</td>
                        </tr>
                        <tr>
                            <td class='trans'>Categorie:</td><td class='trans'>".$rs_prod[("categorie")]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Subcategorie:</td><td class='trans'>".$rs_prod[("subcategorie")]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Grila de masuri:</td><td class='trans'>".$rs_prod["grila_masuri"]."</td>
                        </tr>
                        <tr>
                            <td class='trans'>Cantitate:</td>
                            <td class='trans'>
                            	<input type='text' class='input' id='cant_".$rs_prod["id"]."' id='cant_".$rs_prod["id"]."' value='0' size=8>
                            	<input type='button' title='Adauga in cos' class='add_to_cart' onmouseover=\"this.style.cursor='pointer';\" onclick=\"if (document.getElementById('cant_".$rs_prod["id"]."').value>0) {top.document.getElementById('cos_frame').src='cos.php?adauga_prod=1&cant_prod='+document.getElementById('cant_".$rs_prod["id"]."').value+'&pret_prod=".$pret."&id_prod=".$rs_prod["id"]."';} else {alert('Nu ati completat cantitatea dorita ! ')};\">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <table border=0 cellpadding=0 cellspacing=5>
                        <tr>
                            <td class='trans' width=70>Descriere:</td><td class='trans'>".nl2br($rs_prod["descriere"])."</td>
                        </tr>
                    </table>    
                </td>
            </tr>
            ";
            if ( trim($rs_prod["indicatii"]) != null && trim($rs_prod["indicatii"]) != "" )
            {
				$table .= "
				<tr>
	                <td colspan=2>
	                    <table border=0 cellpadding=0 cellspacing=5>
	                        <tr>
	                            <td class='trans' width=70>Indicatii:</td><td class='trans'>".nl2br($rs_prod["indicatii"])."</td>
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
	$filtru = " WHERE categorii.id = produse.id_categorie ";
	$inputs = "";
    if ( isset($_REQUEST["id_pr"]) )
    {
        $filtru .= "AND id_producator=".$_REQUEST["id_pr"]."";
        $inputs .= "
        <input type='hidden' id='id_pr' name='id_pr' value='".$_REQUEST["id_pr"]."'>";
    } 
    if ( isset($_REQUEST["id_subcat"]) )
    {
        $filtru .= "AND produse.id_subcategorie = ".$_REQUEST["id_subcat"]."";
        $inputs .= "
        <input type='hidden' id='id_cat' name='id_subcat' value='".$_REQUEST["id_subcat"]."'>";
    }
    if ( isset($_REQUEST["id_catprod"]) )
    {
        $filtru .= "AND produse.id_categorie=".$_REQUEST["id_catprod"]."";
        $inputs .= "
        <input type='hidden' id='id_catprod' name='id_catprod' value='".$_REQUEST["id_catprod"]."'>";
    } 
	$sql_produse = "SELECT produse.id as id, produse.nume as nume, produse.descriere as descriere, produse.pret as pret, produse.reducere as reducere, produse.cod as cod, categorii.denumire as categorie FROM produse, categorii ".$filtru." ORDER BY produse.nume"; 
    // --------------------- PAGINARE ----------------------
    
    $q_nr_prod = mysql_query("SELECT count(produse.id) FROM produse, categorii ".$filtru);
    $rs_nr_prod = mysql_fetch_array($q_nr_prod);
	$num = $rs_nr_prod[0];
    $nr_pags = ceil($rs_nr_prod[0] / $el_in_pag);
    //echo $nr_pag.", ".$nr_pags.", ".$rs_nr_prod[0];
    $tabel_pag = "<td align='right'>Pagina</td>";
    for ( $e=1; $e<=$nr_pags; $e++ )
    {
        if ( $e == $nr_pag )
            $tabel_pag .= "<td onmouseover=\"this.style.cursor='pointer'; this.style.backgroundColor='#EAEAEA';\" onclick=\"document.getElementById('pagina').value='".$e."';document.getElementById('mod_pags').submit();\">".$e."</td>";
        else
            $tabel_pag .= "<td onmouseover=\"this.style.cursor='pointer'; this.style.backgroundColor='#EAEAEA';\" onmouseout=\"this.style.backgroundColor='transparent';\" onclick=\"document.getElementById('pagina').value='".$e."';document.getElementById('mod_pags').submit();\">".$e."</td>";
    }
    $sel = "
    
    Produse / pagina : 
    <input type='hidden' id='pagina' name='pagina' value=0>
    <input type='hidden' id='mod' name='mod' value=2>".$inputs."
    <select id='el_pag' name='el_pag' class='input' onchange=\"document.getElementById('pagina').value=1;document.getElementById('mod_pags').submit();\">
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
    $tabel_pag .= "<td>".$sel."</td>";
    // --------------------- PAGINARE ----------------------
	//echo $sql_produse."<br>";
    $sql_produse .= $limit;
    $q_produse = mysql_query($sql_produse) or die("Eroare preluare produse!");
    $table = "
    <div id='produse'>
        ";
    //$nr = 1;
    while ($rs_produse = mysql_fetch_array($q_produse))
    {
        $image = "&nbsp;";
        $image = "<img src='../images/produse/no_foto.jpg' class='img_caseta_prod' alt='' />";
        if ( file_exists("../images/produse/".$rs_produse["id"].".jpg") )
        {
            $image = "<img src='../images/produse/".$rs_produse["id"].".jpg' class='img_caseta_prod' alt='' />";
        }
        if ( file_exists("../images/produse/".$rs_produse["id"].".gif") )
        {
            $image = "<img src='../images/produse/".$rs_produse["id"].".gif' class='img_caseta_prod' alt='' />";
        }
        if ( $rs_produse["reducere"] > 0 )
        {
            $pret = "<font style='text-decoration: line-through;'>".$rs_produse["pret"]."</font>&nbsp;&nbsp;".$rs_produse["pret"]*((100-$rs_produse["reducere"])/100);
            $pret_ron = $rs_produse["pret"]*((100-$rs_produse["reducere"])/100);
        }
        else
        {
            $pret = $rs_produse["pret"];
            $pret_ron = $rs_produse["pret"];
        }
        $table .= "
             <div class='caseta_prod'>
				<div class='categorie_prod_top'>".$rs_produse["categorie"]."</div>
                <div style='text-align:center;' title='".$rs_produse["nume"]."' onmouseover=\"this.style.cursor='pointer';\" onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse["id"]."';\">".$image."</div>
                <div class='nume_prod'>".$rs_produse["nume"]."</div>
                <div class='pret_div'>pret <span class='pret'>".$pret."</span> Lei <input type='button' onmouseover=\"this.style.cursor='pointer';\" title='Detalii despre produs' class='detalii_prod' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse["id"]."';\" /></div>
                <div class='descript_prod'>".substr(trim($rs_produse["descriere"]),0,70)."...</div>
                <div class='prod_in_cos'>Cantitate: <input type='text' class='input' id='cant_".$rs_produse["id"]."' id='cant_".$rs_produse["id"]."' value='0' size=4 /> <input type='button' title='Adauga in cos' class='add_to_cart' onmouseover=\"this.style.cursor='pointer';\" onclick=\"if (document.getElementById('cant_".$rs_produse["id"]."').value>0) {top.document.getElementById('cos_frame').src='cos.php?adauga_prod=1&cant_prod='+document.getElementById('cant_".$rs_produse["id"]."').value+'&pret_prod=".$pret_ron."&id_prod=".$rs_produse["id"]."';} else {alert('Nu ati completat cantitatea dorita ! ')};\" /></div>
             </div>
            ";   
    }
    $table .= "
        </div>
    ";
}
$table .= "</table>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ro">
    <head>
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
        <title>Afisare produse</title>
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Cache-Control" content="no-cache" />
        <meta name="description" content="Ortoprotetica - Afisare produse" />
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css" />
        <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(document).ready(function(){
				$("#main_frame",window.parent.document).height($(document).height()+10);
			});    
		</script>
        <style>
        .trans
        {
            height: 20px;
            font-size: 12px;
            font-weight: 200;
            vertical-align: top;
            background: url(../img/gray_bg_tr.png);
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
	        if ( $num > 0 )
	        {
	        ?>
	            <div align=center><form id='mod_pags'><table border=0 cellspacing=2 cellpadding=0 style='white-space: nowrap;'><tr><?=$tabel_pag?></tr></table></form></div>
	        <?php
	        }
	        else
	        {
	            echo "Nu exista produse pentru care sa indeplineasca conditiile solicitate !";
	        }
		}
        ?>
        <table cellpadding="0" cellspacing="0" border="0">
            <?=$table?>
        </table>
    </body>
</html>