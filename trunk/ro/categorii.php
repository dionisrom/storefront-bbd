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
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<title>Afisare categorii de produse</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - afisare categorii de produse">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
	</head>
	<body>
	<div class="titlu_pag">Afisare categorii de produse</div>
		<?=$tabel;?>
	</body>
</html>