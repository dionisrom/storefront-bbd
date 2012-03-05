<?php
session_start();

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = strtolower($_POST['action']);
	$prefix = "";
	if ( strpos($action,"introducere") !== false )
	{
		$prefix = "introd_";
		$arr_temp = explode("_", $action);
		$action = $arr_temp[1];
	}
	if ( strpos($action,"modificare") !== false )
	{
		$prefix = "mod_";
		$arr_temp = explode("_", $action);
		$action = $arr_temp[1];
	}
    switch($action) {
		// meniu users
        
		//meniu admin
		case 'producator'			: adm_content($prefix."producatori");break;
		case 'categorie'			: adm_content($prefix."categorii");break;
		case 'subcategorie'			: adm_content($prefix."subcategorii");break;
		case 'produs'				: adm_content($prefix."produs");break;
		case 'administrare_cosuri'	: adm_content("adm_cosuri");break;
		case 'administrare_useri'	: adm_content("adm_users");break;
		case 'administrare_reclame'	: adm_content("adm_reclame");break;
		case 'pagini_web'			: adm_content("adm_pagini");break;
		case 'rapoarte'				: adm_content("rapoarte");break;
		case 'statistici'			: getStatistici();break;
		default						: getPage($action); break;
    }
    
}

function adm_content($file)
{
	$return = array();
	$return["continut"] = "./ro/".$file.".php";
    echo json_encode($return);
}

function getPage($page)
{
    $return = array();
	if ($page == "acasa")
		$ext = "php";
	else
		$ext = "html";
	$return["continut"] = "ro/".$page.".".$ext;
    echo json_encode($return);
}

function getStatistici()
{
	$return = array();
	$return["error_msg"] = "";
	include_once("../inc/global.php");
	$sql_vizitate = "SELECT count(a.id) as vizite, b.nume as produs, b.id as id FROM vizionari a, produse b WHERE b.id = a.id_prod GROUP BY a.id_prod ORDER BY vizite desc LIMIT 0,5";
	//$return["error_msg"] = ;
	
	$q_vizitate = mysql_query($sql_vizitate) or die("Eroare preluare cele mai vizitate produse!". mysql_error());
	$output_vizitate = "<ol>";
	while ($row_vizitate = mysql_fetch_array($q_vizitate))
	{
		$output_vizitate .= "<li onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$row_vizitate["id"]."';\">".substr(ucfirst($row_vizitate[1]),0,25)."</li>";
	}
	$output_vizitate .= "</ol>";
	$return["continut_vizitate"] = $output_vizitate;
	
	
	$sql_vandute = "SELECT * FROM cos WHERE validat = 1";
	$q_vandute = mysql_query($sql_vandute) or die("Eroare preluare cele mai vandute produse!". mysql_error());
	$produse = array();
	$cant = array();
	while ($row_vandute= mysql_fetch_array($q_vandute))
	{
		$produse_row = explode(",",$row_vandute["produse"]) ;
		$cant_row = explode(",", $row_vandute["cantitati"]);
		foreach ($produse_row as $key => $value)
		{
			if (in_array($value,$produse))
			{
				$cant[$value] += $cant_row[$key];
			}
			else
			{
				$produse[] = $value;
				$cant[$value] = $cant_row[$key];
			}
		}
	}
	arsort($cant);
	$output_vandute = "<ol>";
	foreach ($cant as $key => $value)
	{
		$sql_prod = "SELECT nume FROM produse WHERE id = ".$key;
		$rez = mysql_query($sql_prod);
		if(mysql_numrows($rez)>0)
		{
			$produs = mysql_fetch_array($rez); 
			$output_vandute .= "<li onclick=\"top.document.getElementById('main_frame').src='ro/produse.php?mod=1&id_produs=".$value."';\">".substr(ucfirst($produs[0]),0,25)."</li>";
		}
	}
	$output_vandute .= "</ol>";
	$return["continut_vandute"] = $output_vandute;
    echo json_encode($return);
	
}
?>
