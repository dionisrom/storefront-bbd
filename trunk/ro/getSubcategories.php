<?php
session_start();
include("../inc/global.php");
$return = array();
if( !empty($_POST["categorie"]) )
{
	$str_cat = "SELECT id, denumire FROM subcategorii WHERE id_categ = ".$_REQUEST["categorie"]." ORDER BY denumire";
	$q_cat = mysql_query($str_cat);
	if (!$q_cat)
	{
		$return["error"] = true;
		$return["msg"] = "Eroare aparuta la preluarea categoriilor! ";
		$return["opts"] = array();
		//die("Eroare aparuta la preluarea categoriilor!");
		
	}
	else
	{
		$return["error"] = false;
		$return["msg"] = "";
		$return["opts"] = array();
		while ( $rs_cat = mysql_fetch_array($q_cat) )
		{
			$return["opts"][$rs_cat[0]]=$rs_cat[1];
		}
	}
	
}
else 
{
	$return["error"] = false;
	$return["msg"] = "";
	$return["opts"] = array();
}
echo json_encode($return);
?>
