<?
session_start();
include("../inc/global.php");
if ( isset($_REQUEST["salvez"]) && $_REQUEST["salvez"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
	$sql_cat = "INSERT INTO subcategorii (denumire,id_categ) VALUES ('".trim($_REQUEST['denumire'])."',".$_REQUEST["categorie"].")";
	mysql_query($sql_cat) or die("Eroare aparuta la introducerea unei subcategorii noi! Va rugam contactati administratorul site-ului.");	

	echo'
		<html>
		<head>
			<title>Adaugare afectiune noua</title>
		    <meta http-equiv="Pragma" content="no-cache">
		    <meta http-equiv="Cache-Control" content="no-cache">
		    <meta name="author" content="Bajanica Bogdan Dionisie">
		    <meta name="description" content="Medical Active - Adaugare afectiune noua">
		    <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
		    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">	
		</head>
		<body>
			<div class="titlu_mic">
				A fost adugata cu succes noua subcategorie : <b><i><u>'.$_REQUEST["denumire"].'</u></i></b> in baza de date.<br>
			</div>
		</body>
		</html>
		';
}
else
{
?>
<html>
	<head>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
		<title>Inserare subcategorie noua</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Medical Active - inserare subcategorie noua">
        <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
	</head>
	<body>
	<div class="titlu_pag">Inserare subcategorie noua</div>
		<form target="_self" method="post" id="form_af" name="form_af">
			<table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
				<tr>
					<td>Denumire subcategorie *:</td>
            		<td><input type="text" name="denumire" id="denumire" onkeyup="this.style.textTransform = 'capitalize';" value="" size="30" class="input" /><font id='err_denumire' class="eroare_text"></font></td>
				</tr>
				<tr>
					<td>Categorie *:</td>
            		<td>
            			<select name="categorie" id="categorie" value="" class="input" />
            				<option>- ALEGE -</option>
            				<?
            				$str_cat = "SELECT id, denumire FROM categorii ORDER BY denumire";
            				$q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea categoriilor de produse!");
            				while ( $rs_cat = mysql_fetch_array($q_cat) )
            				{
								echo "<option value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
            				}
            				?>
            			</select>
            			<font id='err_categorie' class="eroare_text"></font>
            		</td>
				</tr>
				<tr>
			        <td colspan="2" align="center">
			            <input type="hidden" id="salvez" name="salvez" value="da">
			            <input type="submit" onclick="if (document.getElementById('denumire').value==null || document.getElementById('denumire').value=='') {document.getElementById('err_denumire').innerHTML='Va rog introduceti denumirea afectiunii!';return false;} else {document.getElementById('form_af').submit();}" name="creaza_cont" id="creaza_cont" value="Adauga afectiune" class="submit" />
			        </td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?
}
?>