<?php
session_start();
include("../inc/global.php");
$return = array();
if( !empty($_POST["pagina"]) && !empty($_POST["operation"]) )
{
	if($_POST["operation"] == "getcontent" )
	{
		$str = "SELECT denumire, content FROM files WHERE id_file = ".$_POST["pagina"];
		$q = mysql_query($str);
		if (!$q)
		{
			$return["error"] = true;
			$return["msg"] = "Eroare aparuta la preluarea continutului paginii solicitate! ";
			$return["denumire"] = "";
			$return["continut"] = "";
		}
		else
		{
			$return["error"] = false;
			$return["msg"] = "Preluare continutului pentru fisierul ".$rs[0]." s-a efectuat cu succes!";
			$rs = mysql_fetch_array($q);
			$return["denumire"]=$rs[0];
			$return["continut"]= html_entity_decode($rs[1]);
		}
	}
	if($_POST["operation"] == "putcontent")
	{
		if(empty($_POST["continut"]))
			$continut = "";
		else
			//$continut = mysql_real_escape_string($_POST["continut"]);
			$continut = $_POST['continut'];
		$str = "UPDATE files SET content = '".htmlentities($continut)."' WHERE id_file = ".$_POST["pagina"];
		$q = mysql_query($str);
		if (!$q)
		{
			$return["error"] = true;
			$return["msg"] = "Eroare aparuta la salvarea paginii! ";
		}
		else
		{
			$return["error"] = false;
			$return["msg"] = "Salvarea s-a efectuat cu succes!";
			
			$str = "SELECT denumire FROM files WHERE id_file = ".$_POST["pagina"];
			$q = mysql_query($str);
			$rs = mysql_fetch_array($q);
			// write file
			$myFile = $rs[0].".html";
			$script = '
				<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
				<script type="text/javascript">// <![CDATA[
				jQuery(window).load(function(){
								var db1 = jQuery("html").height();
								var docHeight = db1;
								jQuery("#main_frame",window.parent.document).height(docHeight +50);
								jQuery("#body",window.parent.document).height(docHeight +60);
							})
				// ]]></script>
				';
			if(file_exists($myFile)) unlink($myFile);
			$fh = fopen($myFile, 'w') or die("Nu pot deschide fisierul");
			fwrite($fh, stripslashes($continut).$script);
			fclose($fh);
			$return["msg"] .= " Continutul a fost scris in fisierul corespunzator!";
		}
	}
}
else 
{
	$return["error"] = false;
	$return["msg"] = "";
	$return["denumire"] = "";
	$return["continut"] = "";
}
echo json_encode($return);
?>
