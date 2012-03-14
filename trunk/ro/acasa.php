<?
    session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ro">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Acasa</title>
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta name="description" content="Ortoprotetica - Acasa" />
	<meta name="copyright" content="&copy; 2012 Ortoprotetica" />
    <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
    <script type="text/javascript" src="../js/easyslider/easySlider1.7.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function(){    
            jQuery("#slider").easySlider({
                auto: true, 
                continuous: true,
                numeric: false
            });
        });    
    </script>
	<script type="text/javascript">
		jQuery("#main_frame",window.parent.document).load(function(){
			var db1 = jQuery(document).height();
			var docHeight = db1;
			jQuery("#main_frame",window.parent.document).height(docHeight +50);
			jQuery("#body",window.parent.document).height(docHeight +60);
		})
	</script>
	<LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css" />
    <link href="../css/easyslider.css" rel="stylesheet" type="text/css" />
</head>
<body>

<?
    //citeste fisierele pentru slide
	$cale = "../images/slider/";
	$imagini = array();
	if ($handle = opendir($cale)) 
	{
		$imagini = array();
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") $imagini[] = $entry;
		}
		closedir($handle);
	}
	$slide_images = "";
	foreach ($imagini as $imagine)
	{
		$slide_images .= "<li><a href=''><img src='".$cale.$imagine."' alt='Css Template Preview' /></a></li>
			";
	}
	$tabel = "
    <!-- slider -->
    <div id='container'>
        <div id='content_slider'>
            <div id='slider'>
                <ul>                
                    ".$slide_images."            
                </ul>
            </div>
        </div>
    </div>
    <!-- slider -->
    
    <div id='produse'>
	";	
    
	include("../inc/global.php");
	
	$sql_no_prods = "SELECT content from files where denumire = 'prima_pagina'";
	$query__no_prods = mysql_query($sql_no_prods);
	$rs_no_prods = mysql_fetch_array($query__no_prods);
	$tabel .= "<div id='no_prod_promo'>".$rs_no_prods[0]."</div><br />";
	
    $sql_produse = "SELECT a.id, a.nume, a.descriere, a.pret, a.reducere, b.denumire, a.cod, a.prod_la_comanda as tip, a.grila_masuri as masuri FROM produse a LEFT JOIN categorii b ON b.id = a.id_categorie WHERE prima_pagina like 'da'";
    $q_produse = mysql_query($sql_produse) or die("Eroare preluare produse!");
	
	if(mysql_num_rows($q_produse) > 0)
	{
		$tabel .= "<h3 style='color: #3c3d3f; font-size: 12px; text-indent: 20px; margin-top: 20px;'>Promo Ortoprotetica</h3>";
		while ($rs_produse = mysql_fetch_array($q_produse))
		{
			$image = "&nbsp;";
			$image = "<img src='../images/produse/no_foto.jpg' class='img_caseta_prod' alt='' />";
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
			if ($rs_produse["tip"])
			{
				$class_tip_prod = "hide";
				$class_tip_prod1 = "show";
			}
			else
			{
				$class_tip_prod = "show";
				$class_tip_prod1 = "hide";
			}
			$masuri = "Masura:";
			if ($rs_produse["masuri"] == 'unica')
				$masuri .= "<input type='hidden' name='masura_prod' value='unica' />unica";
			else
			{
				$masuri_arr = explode(",",$rs_produse["masuri"]);
				$masuri .= "<select name='masura_".$rs_produse[0]."' id='masura_".$rs_produse[0]."'>";
				foreach ($masuri_arr as $masura)
				{
					$masuri .= "<option value='".$masura."'>".$masura."</option>";
				}
				$masuri .= "</select>";
			}

			$tabel .= "
				<div class='caseta_prod'>
					<div class='categorie_prod_top'>$rs_produse[5]</div>
					<div style='text-align:center;' title='".$rs_produse[1]."' onmouseover=\"this.style.cursor='pointer';\" onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\">".$image."</div>
					<div class='nume_prod'>".$rs_produse[1]."</div>
					<div class='pret_div'>pret <span class='pret'>".$pret."</span> Lei <input type='button' onmouseover=\"this.style.cursor='pointer';\" title='Detalii despre produs' class='detalii_prod' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\" /></div>
					<div class='descript_prod'>".substr(trim($rs_produse[2]),0,70)."...</div>
					<div class='prod_in_cos ".$class_tip_prod."'>Cant.: <input type='text' class='input' name='cant_".$rs_produse[0]."' id='cant_".$rs_produse[0]."' value='0' style=\"width:20px;\" /> ".$masuri." <input type='button' title='Adauga in cos' class='add_to_cart' onmouseover=\"this.style.cursor='pointer';\" onclick=\"if (document.getElementById('cant_".$rs_produse[0]."').value>0) {top.document.getElementById('cos_frame').src='cos.php?adauga_prod=1&cant_prod='+document.getElementById('cant_".$rs_produse[0]."').value+'&pret_prod=".$pret_ron."&id_prod=".$rs_produse[0]."&masura_prod='+document.getElementById('masura_".$rs_produse[0]."').options[document.getElementById('masura_".$rs_produse[0]."').selectedIndex].value;} else {alert('Nu ati completat cantitatea dorita ! ')};\" /></div>
					<div class='comanda_acum ".$class_tip_prod1."' onmouseover=\"this.style.cursor='pointer';\" title='Acest produs se aduce doar la comanda!' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$rs_produse[0]."';\"></div>
				</div>
				";  
		}
	}
    $tabel .= "
        </div>
    ";
    echo $tabel;
	$sql_last_prods = "SELECT id, nume, pret, reducere FROM produse ORDER BY id desc LIMIT 0,5";
	$q_last_prods = mysql_query($sql_last_prods) or die("Eroare la preluarea ultimelor produse adaugate");
	$prods = "";
	while ($row = mysql_fetch_array($q_last_prods))
	{
		$imagine = "<img src='../images/produse/no_foto.jpg' height=60 alt='' />";
		if( file_exists("../images/produse/".$row["id"].".jpg") )
			$imagine = "<img src='../images/produse/".$row["id"].".jpg' height=60 alt='' />";
		if( file_exists("../images/produse/".$row["id"].".gif") )
			$imagine = "<img src='../images/produse/".$row["id"].".gif' height=60 alt='' />";
		if ( $row["reducere"] > 0 )
		{
			$pret = $row["pret"]*((100-$row["reducere"])/100);
		}
		else
		{
			$pret = $row["pret"];
		}
		$prods .= '
			<div class="last_prod" onmouseover="this.style.cursor=\'pointer\';" onclick="top.document.getElementById(\'main_frame\').src=\'ro/produse.php?mod=1&id_produs='.$row["id"].'\'" >
				'.$imagine.'
				<div class="info">	
					<span class="blue">'.substr($row["nume"],0,18).'</span><br />
					pret: <span class="red"> '.$pret.' Lei</span>
				</div>
			</div>';
	}
	echo '
			<div id="last_prods_container">
				'.$prods.'
			</div>
		';
?>
</body>
</html>