<?
session_start();
include("../inc/global.php");
$str_categorii = "SELECT * FROM categorii_afectiuni ORDER BY denumire";
$q_categorii = mysql_query($str_categorii) or die("A aparut o eroare la preluarea categoriilor de afectiuni !");
$tabel = "<table cellpadding=2 cellspacing=0 border=0 style='white-space:nowrap;padding-left:20px;'>";
while ( $rs_cat = mysql_fetch_array($q_categorii) )
{
	$tabel .= "
	<tr>
		<td align='center' valign='middle' border=0 style='white-space:nowrap;'>
			 <img id='plus_".$rs_cat[0]."' src='../ico/plus.png' border='0' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('detalii_".$rs_cat[0]."').style.display='table-row';this.style.display='none';document.getElementById('minus_".$rs_cat[0]."').style.display='block';\">
			 <img style=\"display:none\" id='minus_".$rs_cat[0]."' src='../ico/minus.png' border='0' onmouseover=\"this.style.cursor='pointer';\" onclick=\"document.getElementById('detalii_".$rs_cat[0]."').style.display='none';this.style.display='none';document.getElementById('plus_".$rs_cat[0]."').style.display='block';\">
		</td>
		<td align='left' style='padding-left:15px; white-space:nowrap;' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_cat=".$rs_cat[0]."';\" onmouseover=\"this.style.cursor='pointer';\">
			 ".strtoupper($rs_cat[1])."
		</td>
	</tr>
	<tr>
		<td colspan=2 width=100%>
			<table style='display:none' cellpadding=0 cellspacing=0 border=0 width='100%'id='detalii_".$rs_cat[0]."'>
				<tr>";
			$str_afectiuni = "SELECT * FROM afectiuni WHERE id_cat_afectiune = ".$rs_cat[0]." ORDER BY denumire";
			$q_afectiuni = mysql_query($str_afectiuni) or die("A aparut o eroare la preluarea afectiunilor din cadrul categoriei selectate !");
			$nr=1;
			while ( $rs_afectiuni = mysql_fetch_array($q_afectiuni) )
			{
				$tabel .="
					<td style='padding-left:5px;'><a href='javascript:;' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_af=".$rs_afectiuni[0]."'\">".$rs_afectiuni[1]."</a></td>
				";
				if ( $nr%2 == 0 )
			    {
			       $tabel .= "
			       </tr>
			       <tr>";
			       $nr = 0;
			    }
			    $nr++;
			}
			$tabel .= "
			</table>
		</td>
	</tr>
	";
}
$tabel .= "</tabel>";
?>

<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<title>Afisare subcategorii</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - afisare subcategorii">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(window).load(function(){
				$("#main_frame",window.parent.document).height($("html").height()+20); $("#body",window.parent.document).height($("html").height()+30);
			});    
		</script>
	</head>
	<body>
	<div class="titlu_pag">Afisare Subcategorii</div>
		<?=$tabel;?>
	</body>
</html>