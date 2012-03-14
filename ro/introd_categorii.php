<?
session_start();
include("../inc/global.php");
if ( isset($_REQUEST["salvez"]) && $_REQUEST["salvez"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
	$sql_cat = "INSERT INTO categorii (denumire) VALUES ('".trim($_REQUEST['denumire'])."')";
	mysql_query($sql_cat) or die("Eroare aparuta la introducerea unei categorii noi! Va rugam contactati administratorul site-ului.");	

	echo'
		<html>
		<head>
			<title>Adaugare categorie noua</title>
		    <meta http-equiv="Pragma" content="no-cache">
		    <meta http-equiv="Cache-Control" content="no-cache">
		    <meta name="author" content="Bajanica Bogdan Dionisie">
		    <meta name="description" content="Ortoprotetica - Adaugare categorie noua">
		    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
		    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
			<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		</head>
		<body>
			<div class="titlu_mic">
				A fost adugata cu succes noua categorie : <b><i><u>'.$_REQUEST["denumire"].'</u></i></b> in baza de date.<br>
			</div>
			<script type="text/javascript">
		jQuery("#main_frame",window.parent.document).load(function(){
			var db1 = jQuery(document).height();
			var docHeight = db1;
			jQuery("#main_frame",window.parent.document).height(docHeight +50);
			jQuery("#body",window.parent.document).height(docHeight +60);
		})
	</script>
		</body>
		</html>
		';
}
else
{
?>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<title>Inserare categorie noua</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Ortoprotetica - inserare categorie noua">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
	</head>
	<body>
	<div class="titlu_pag">Inserare categorie noua</div>
		<form target="_self" method="post" id="form_cat" name="form_cat">
			<table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
				<tr>
					<td>Denumire categorie *:</td>
            		<td><input type="text" name="denumire" id="denumire" onkeyup="this.style.textTransform = 'capitalize';" value="" size="30" class="input" /><font id='err_denumire' class="eroare_text"></font></td>
				</tr>
				<tr>
			        <td colspan="2" align="center">
			            <input type="hidden" id="salvez" name="salvez" value="da">
			            <input type="submit" onclick="if (document.getElementById('denumire').value==null || document.getElementById('denumire').value=='') {document.getElementById('err_denumire').innerHTML='Va rog introduceti denumirea categoriei!';return false;} else {document.getElementById('form_cat').submit();}" name="creaza_cont" id="creaza_cont" value="Adauga categorie" class="submit" />
			        </td>
				</tr>
			</table>
		</form>
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
<?
}
?>