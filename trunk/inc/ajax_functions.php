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
        case 'acasa'				: home();break;
        case 'despre noi'			: despre();break;
        case 'cum cumpar'			: cum_cumpar();break;
        case 'cum platesc'			: cum_platesc();break;
        case 'livrare'				: livrare();break;
        case 'asistenta'			: asistenta();break;
        case 'parteneri'			: parteneri();break;
        case 'contact'				: contact();break;
		//meniu admin
		case 'producator'			: adm_content($prefix."producatori");break;
		case 'categorie'			: adm_content($prefix."categorii");break;
		case 'subcategorie'			: adm_content($prefix."subcategorii");break;
		case 'produs'				: adm_content($prefix."produs");break;
		case 'administrare cosuri'	: adm_content("adm_cosuri");break;
		case 'administrare useri'	: adm_content("adm_users");break;
		case 'pagini web'			: adm_content("adm_pagini");break;
    }
    
}

function adm_content($file)
{
	$return = array();
	$return["continut"] = "ro/".$file.".php";
    echo json_encode($return);
}

function home()
{
    $return = array();
	$return["continut"] = "ro/home.html";
    echo json_encode($return);
}

function despre()
{
    $return = array();
	$return["continut"] = "ro/despre.html";
    echo json_encode($return);
}

function cum_platesc()
{
    $return = array();
	$return["continut"] = "ro/cum_platesc.html";
    echo json_encode($return);
}

function cum_cumpar()
{
    $return = array();
	$return["continut"] = "ro/cum_cumpar.html";
    echo json_encode($return);
}

function livrare()
{
    $return = array();
	$return["continut"] = "ro/livrare.html";
    echo json_encode($return);
}

function asistenta()
{
    $return = array();
	$return["continut"] = "ro/asistenta.html";
    echo json_encode($return);
}

function parteneri()
{
    $return = array();
	$return["continut"] = "ro/parteneri.html";
    echo json_encode($return);
}

function contact()
{
    $return = array();
	$return["continut"] = "ro/contact.html";
    echo json_encode($return);
}

?>
