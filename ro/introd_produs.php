<?
session_start();
include("../inc/global.php");
if ( isset($_REQUEST["salvez"]) && $_REQUEST["salvez"] == "da" && ( $_SESSION["tipusr"] == 1 || $_SESSION["tipusr"] == 2 ) )
{
    $masuri =array();
	if (isset($_REQUEST['masuri_tip1'])) $masuri = $_REQUEST['masuri_tip1'];
    if (isset($_REQUEST['masuri_tip2'])) $masuri = $_REQUEST['masuri_tip2'];
    if (isset($_REQUEST['masuri_tip3'])) $masuri = $_REQUEST['masuri_tip3'];
	$sql_prod = "INSERT INTO produse (nume,cod,descriere,indicatii,pret,id_categorie,id_producator,id_subcategorie,reducere,prima_pagina,super_oferta,grila_masuri,prod_la_comanda) VALUES (";
	$sql_prod .= " '".trim($_REQUEST['nume'])."', ";
	$sql_prod .= " '".trim($_REQUEST['cod'])."', ";
	$sql_prod .= " '".trim($_REQUEST['descriere'])."', ";
	$sql_prod .= " '".trim($_REQUEST['indicatii'])."', ";
	$sql_prod .= " ".trim($_REQUEST['pret']).", ";
	$sql_prod .= " ".trim($_REQUEST['categorie']).", ";
	$sql_prod .= " ".trim($_REQUEST['producator']).", ";
	$sql_prod .= " ".trim($_REQUEST['subcategorie']).", ";
	$sql_prod .= " ".trim($_REQUEST['reducere']).", ";
	$sql_prod .= " '".trim($_REQUEST['prima_pagina'])."', ";
	$sql_prod .= " '".trim($_REQUEST['super_oferta'])."', ";
	$sql_prod .= " '".implode(",",$masuri)."', ";
	$sql_prod .= " ".trim($_REQUEST["prod_la_comanda"])."', ";
	$sql_prod .= ")";
	
	mysql_query($sql_prod) or die("Eroare aparuta la introducerea unui produs nou! Va rugam contactati administratorul site-ului.<br>".$sql_prod);	
	$lastid = mysql_insert_id();
	$mesaj = "";
	if ( (($_FILES["poza"]["type"] == "image/png" || $_FILES["poza"]["type"] == "image/gif") || ($_FILES["poza"]["type"] == "image/jpeg") ) && ($_FILES["poza"]["size"] < 50000) && ($_FILES["poza"]["error"] == 0) )
	{
		$target_path = "../images/produse/";
		$ext=substr(basename( $_FILES['poza']['name']),(strlen(basename( $_FILES['poza']['name']))-4));
		$target_path .= $lastid.$ext;
		
		if (file_exists($target_path) )
	    {
	    	$mesaj = "Fisierul cu denumirea <b></i>".$lastid.$ext."</i></b> exista deja.";
	    }
	    else
	    {
			if(move_uploaded_file($_FILES['poza']['tmp_name'], $target_path)) {
			    $mesaj = "Poza produsului a fost uploadata cu succes.";
			} else{
			    $mesaj = "A aparut o eroare la uploadarea fisierului ce contine poza produsului!";
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
			<title>Adaugare produs nou</title>
		    <meta http-equiv="Pragma" content="no-cache">
		    <meta http-equiv="Cache-Control" content="no-cache">
		    <meta name="description" content="Ortoprotetica - Adaugare produs nou">
		    <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
		    <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
			<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
			<script type="text/javascript">
				$(window).load(function(){
					$("#main_frame",window.parent.document).height($(document).height());
				});    
			</script>
		</head>
		<body>
			<div class="titlu_mic">
				A fost adugat cu succes noul produs : <b><i><u>'.$_REQUEST["nume"].'</u></i></b> in baza de date.<br>
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
		<title>Inserare produs nou</title>
        <meta http-equiv="Pragma" content="no-cache">
        <meta http-equiv="Cache-Control" content="no-cache">
        <meta name="description" content="Ortoprotetica - inserare produs nou">
        <meta name="copyright" content="&copy; 2012 Ortoprotetica" />
        <LINK HREF="../css/default.css" REL="stylesheet" TYPE="text/css">
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script> 
		<script type="text/javascript">
			$(window).load(function(){
				$("#main_frame",window.parent.document).height($(document).height());
			});    
		</script>
		<script>
			function getSubcateg(categ)
			{
				$.ajax({
					type : 'POST',
					url : 'getSubcategories.php',
					dataType : 'json',
					data: {
						categorie : categ
					},
					success : function(data){
						if (data.error === true)
							alert("Eroare ajax: "+data.msg);
						else
						{
							$("#subcategorie option[text!='- ALEGE -']").remove();
							$.each(data.opts, function(val, text) {
								$('#subcategorie').append( new Option(text,val) );
							});
						}
					}

				});
			};
		</script>
	</head>
	<body>
	<div class="titlu_pag">Inserare produs nou</div>
		<form target="_self" method="post" enctype="multipart/form-data" id="form_prod" name="form_prod">
			<table cellpadding="2" cellspacing="0" border="0" style="white-space:nowrap;">
				<tr>
					<td>Denumire *:</td>
            		<td><input type="text" name="nume" id="nume" onkeyup="this.style.textTransform = 'capitalize';" value="" size="30" class="input" /></td>
            		<td id='err_nume' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Cod *:</td>
            		<td><input type="text" name="cod" id="cod" value="" size="30" class="input" /></td>
            		<td id='err_cod' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Descriere :</td>
            		<td><textarea name="descriere" id="descriere" cols="30" rows="5" class="input" ></textarea></td>
            		<td id='err_descriere' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Indicatii :</td>
            		<td><textarea name="indicatii" id="indicatii" cols="30" rows="5" class="input" ></textarea></td>
            		<td id='err_indicatii' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Poza produs :</td>
            		<td>
            		<input type="file" name="poza" id="poza" value="" class="input" name="MAX_FILE_SIZE" value="50000"/>
            		</td>
            		<td></td>
				</tr>
				<tr>
					<td>Pret *:</td>
            		<td><input type="text" name="pret" id="pret" value="" size="30" class="input" /></td>
            		<td id='err_pret' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Categorie :</td>
            		<td>
            			<select name="categorie" id="categorie" class="input" onchange="getSubcateg($(this).val());">
            				<option value="">- ALEGE -</option>
            				<?
            				$str_cat = "SELECT id, denumire FROM categorii ORDER BY denumire";
            				$q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea categoriilor!");
            				while ( $rs_cat = mysql_fetch_array($q_cat) )
            				{
								echo "<option value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
            				}
            				?>
            			</select>
            		</td>
            		<td id='err_categorie' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Subcategorie :</td>
            		<td>
            			<select name="subcategorie" id="subcategorie" class="input">
            				<option>- ALEGE -</option>
            				
            			</select>
            		</td>
            		<td id='err_subcategorie' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Producator :</td>
            		<td>
            			<select name="producator" id="producator" class="input">
            				<option>- ALEGE -</option>
            				<?
            				$str_cat = "SELECT id, denumire FROM producatori ORDER BY denumire";
            				$q_cat = mysql_query($str_cat) or die("Eroare aparuta la preluarea producatorilor!");
            				while ( $rs_cat = mysql_fetch_array($q_cat) )
            				{
								echo "<option value='".$rs_cat[0]."'>".$rs_cat[1]."</option>\n";
            				}
            				?>
            			</select>
            		</td>
            		<td id='err_producator' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Apare pe prima pagina ?</td>
            		<td>
            			<select name="prima_pagina" id="prima_pagina" class="input">
            				<option value="nu">NU</option>
            				<option value="da">DA</option>
            			</select>
            		</td>
            		<td id='err_prima_pagina' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Este o super oferta ?</td>
            		<td>
            			<select name="super_oferta" id="super_oferta" class="input">
            				<option value="nu">NU</option>
            				<option value="da">DA</option>
            			</select>
            		</td>
            		<td id='err_super_oferta' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Reducere :</td>
            		<td><input type="text" name="reducere" id="reducere" value="0" size="30" class="input" /></td>
            		<td id='err_reducere' class="eroare_text"></td>
				</tr>
				<tr>
					<td>Se aduce doar la comanda :</td>
            		<td>
						<select name="prod_la_comanda" id="prod_la_comanda" class="input">
            				<option value="0">NU</option>
            				<option value="1">DA</option>
            			</select>
					</td>
            		<td id='err_prod_la_comanda' class="eroare_text"></td>
				</tr>
				<tr>
					<td style="vertical-align: top;">Grila masuri :</td>
            		<td>
						<h3 style="margin-left: 15px;">Masuri tip 1</h3>
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" value="S" class="input" /> S</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" value="M" class="input" /> M</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" value="L" class="input" /> L</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" value="XL" class="input" /> XL</label><br />
						<label style="width: 40px;"><input type="checkbox" name="masuri_tip1[]" value="XXL" class="input" /> XXL</label><br />
						<hr>
						<h3 style="clear:both;margin-left: 15px;">Masuri tip 2</h3>
						<label>1 <input type="checkbox" name="masuri_tip2[]" value="1" class="input" /></label><br />
						<label>2 <input type="checkbox" name="masuri_tip2[]" value="2" class="input" /></label><br />
						<label>3 <input type="checkbox" name="masuri_tip2[]" value="3" class="input" /></label><br />
						<label>4 <input type="checkbox" name="masuri_tip2[]" value="4" class="input" /></label><br />
						<label>5 <input type="checkbox" name="masuri_tip2[]" value="5" class="input" /></label><br />
						<label>6 <input type="checkbox" name="masuri_tip2[]" value="6" class="input" /></label><br />
						<label>7 <input type="checkbox" name="masuri_tip2[]" value="7" class="input" /></label><br />
						<hr>
						<h3 style="margin-left: 15px;">Masuri tip 3</h3>
						<label>Masura unica <input type="checkbox" name="masuri_tip3[]" value="unica" class="input" /></label><br />
					</td>
            		<td id='err_grila_masuri' class="eroare_text"></td>
				</tr>
				<tr>
			        <td colspan="3" align="center">
			            <input type="hidden" id="salvez" name="salvez" value="da">
			            <input type="submit" onclick="if (document.getElementById('denumire').value==null || document.getElementById('denumire').value=='' ) {document.getElementById('err_denumire').innerHTML='Va rog introduceti denumirea produsului!';return false;} else {document.getElementById('form_prod').submit();}" name="creaza_cont" id="creaza_cont" value="Adauga produs" class="submit" />
			        </td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?
}
?>