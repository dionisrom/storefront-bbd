<?
session_start();
include("../inc/global.php");
$str_categorie = "SELECT * FROM categorii ORDER BY denumire";
$q_categorie = mysql_query($str_categorie) or die("A aparut o eroare la preluarea categoriilor de produse !");
$tabel = "<table cellpadding=2 cellspacing=0 border=0 style='white-space:nowrap;padding-left:20px;'><tr>";
$nr=1;
while ( $rs_categ = mysql_fetch_array($q_categorie) )
{
	$tabel .= "
		<td align='left' valign='middle' border=0 style='white-space:nowrap;'>
			 <a href='javascript:;' onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_catprod=".$rs_categ[0]."'\">".$rs_categ[1]."</a>
		</td>
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
$tabel .= "</tabel>";
?>

<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<title>Afisare categorii de produse</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - afisare categorii de produse">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
	</head>
	<body>
	<div class="titlu_pag">Afisare categorii de produse</div>
		<?=$tabel;?>
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