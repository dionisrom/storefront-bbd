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
		case 'subcategorie'		: adm_content($prefix."subcategorii");break;
		case 'produs'			: adm_content($prefix."produs");break;
		case 'administrare_cosuri'	: adm_content("adm_cosuri");break;
		case 'administrare_useri'	: adm_content("adm_users");break;
		case 'administrare_reclame'	: adm_content("adm_reclame");break;
		case 'pagini_web'		: adm_content("adm_pagini");break;
		case 'rapoarte'			: adm_content("rapoarte");break;
		case ''				: break;
		default				: getPage($action); break;
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
?>
