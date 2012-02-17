<?
session_start();
include("../inc/global.php");
if ( isset($_REQUEST["salvez"]) && $_REQUEST["salvez"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
	$sql_prod = 'INSERT INTO producatori (denumire,link) VALUES ("'.str_replace("\'","'",$_REQUEST["denumire"]).'","'.$_REQUEST["link"].'")';
	
	mysql_query($sql_prod) or die("Eroare aparuta la introducerea unui producator nou! Va rugam contactati administratorul site-ului.<br>".$sql_prod);	
	$lastid = mysql_insert_id();
	$mesaj = "";
	if ( (($_FILES["sigla"]["type"] == "image/gif") || ($_FILES["sigla"]["type"] == "image/jpeg") ) && ($_FILES["sigla"]["size"] < 30000) && ($_FILES["sigla"]["error"] == 0) )
	{
		$target_path = "../images/producatori/";
		$ext=substr(basename( $_FILES['sigla']['name']),(strlen(basename( $_FILES['sigla']['name']))-4));
		$target_path .= $lastid.$ext;
		
		if (file_exists($target_path) )
	    {
	    	$mesaj = "Fisierul cu denumirea <b></i>".$lastid.$ext."</i></b> exista deja. ";
	    }
	    else
	    {
			if(move_uploaded_file($_FILES['sigla']['tmp_name'], $target_path)) {
			    $mesaj = "Sigla producatorului a fost uploadata cu succes.";
			} else{
			    $mesaj = "A aparut o eroare la uploadarea fisierului ce contine sigla producatorului!";
			}
		}
	}
	else
	{
		$mesaj = "Fisierul nu indeplineste conditiile pentru upload!<br>";
	}
	echo'
		<html>
		<head>
			<title>Adaugare producator nou</title>
		    <meta http-equiv="Pragma" content="no-cache">
		    <meta http-equiv="Cache-Control" content="no-cache">
		    <meta name="author" content="Bajanica Bogdan Dionisie">
		    <meta name="description" content="Medical Active - Adaugare producator nou">
		    <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
		    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">	
		</head>
		<body>
			<div class="titlu_mic">
				A fost adugat cu succes noul producator : <b><i><u>'.$_REQUEST["denumire"].'</u></i></b> in baza de date.<br>
				'.$mesaj.'
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
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<title>Inserare producator nou</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="author" content="Bajanica Bogdan Dionisie">
        <meta name="description" content="Medical Active - inserare producator nou">
        <meta name="copyright" content="&copy; 2009 Medical Active SRL" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
	</head>
	<body>
	<div class="titlu_pag">Inserare producator nou</div>
		<form target="_self" method="post" enctype="multipart/form-data" id="form_prod" name="form_prod">
			<table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
				<tr>
					<td>Denumire *:</td>
            		<td><input type="text" name="denumire" id="denumire" onkeyup="this.style.textTransform = 'capitalize';" value="" size="30" class="input" /></td>
            		<td id='err_nume' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Link:</td>
            		<td><input type="text" name="link" id="link" value="" size="30" class="input" /></td>
            		<td id='err_link' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Sigla producator :</td>
            		<td>
            			<input type="file" name="sigla" id="sigla" value="" class="input"/>
            		</td>
            		<td></td>
				</tr>
				
				<tr>
			        <td colspan="3" align="center">
			            <input type="hidden" id="salvez" name="salvez" value="da">
			            <input type="submit" onclick="if (document.getElementById('denumire').value==null || document.getElementById('denumire').value=='' ) {document.getElementById('err_denumire').innerHTML='Va rog introduceti denumirea producatorului!';return false;} else {document.getElementById('form_prod').submit();}" id="add_producator" value="Adauga producator" class="submit" />
			        </td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?
}
?>
