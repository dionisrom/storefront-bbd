<?
session_start();
include("../inc/global.php");
$str_producatori = "SELECT * FROM producatori ORDER BY denumire";
$q_producatori = mysql_query($str_producatori) or die("A aparut o eroare la preluarea producatorilor !");
$tabel = "
        <table cellpadding=5 cellspacing=5 border=0 style='white-space:nowrap;padding-left:20px;'>
            <tr>
            ";
$nr = 1;
while ( $rs = mysql_fetch_array($q_producatori) )
{
    $image = "&nbsp;";
    $image = "<img src='../images/no_foto.jpg' border=0 class='corner iradius10 ishadow25'>";
	if ( file_exists("../images/producatori/".$rs[0].".jpg") )
	{
		$image = "<img src='../images/producatori/".$rs[0].".jpg' border=0 class='corner iradius10 ishadow25'>";
	}
    if ( file_exists("../images/producatori/".$rs[0].".gif") )
    {
        $image = "<img src='../images/producatori/".$rs[0].".gif' border=0 class='corner iradius10 ishadow25'>";
    }
    $tabel .= "
		<td width='100px' onmouseover=\"this.style.cursor='pointer';\" onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=2&id_pr=".$rs[0]."';\" title='".strtoupper($rs[1])."' align='center' valign='middle' style='border: 1px solid #367766; white-space:nowrap;'>
			 ".$image."<br>		
			 ".strtoupper($rs[1])."
		</td>
        ";
    if ( $nr%3 == 0 )
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
		<title>Afisare producatori</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - afisare producatori">
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
	<div class="titlu_pag">Producatori</div>
		<?=$tabel;?>
	</body>
</html>