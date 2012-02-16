<?php

if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = strtolower($_POST['action']);
	$prefix = "";
	if ( strpos($action,"introducere") !== false )
	{
		$prefix = "introd_";
		$arr_temp = explode(" ", $action);
		$action = $arr_temp[1];
	}
	if ( strpos($action,"modificare") !== false )
	{
		$prefix = "mod_";
		$arr_temp = explode(" ", $action);
		$action = $arr_temp[1];
	}
    switch($action) {
		// meniu users
        
		//meniu admin
		case 'producator'			: adm_content($prefix."producatori");break;
		case 'categorie'			: adm_content($prefix."categorii");break;
		case 'subcategorie'			: adm_content($prefix."subcategorii");break;
		case 'produs'				: adm_content($prefix."produs");break;
		case 'administrare cosuri'	: adm_content("adm_cosuri");break;
		case 'administrare useri'	: adm_content("adm_users");break;
		case 'pagini web'			: adm_content("adm_pagini");break;
		default						: getPage($action); break;
    }
    
}

function adm_content($file)
{
	$return = array();
	$return["continut"] = "ro/".$file.".php";
    echo json_encode($return);
}

function getPage($page)
{
    $return = array();
	$return["continut"] = "ro/".$page.".html";
    echo json_encode($return);
}

?>
