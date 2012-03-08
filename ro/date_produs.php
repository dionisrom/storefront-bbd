<?
session_start();
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" )
{
     include("../inc/global.php");
     $sql_date = "SELECT * FROM produse WHERE id=".$_REQUEST["id"];
     $q_date = mysql_query($sql_date);
     $rs_date = mysql_fetch_array($q_date);
	 
	 // preluare subcategorii
	 $str_subcat = "SELECT id, denumire FROM subcategorii WHERE id_categ = ".$rs_date["id_categorie"]." ORDER BY denumire";
	 $q_subcat = mysql_query($str_subcat);
	 $subcat = "var subcategorii_id = new Array();";
	 $subcat .= "var subcategorii_den = new Array();";
	 $i = 0;
     while ( $rs_subcat = mysql_fetch_array($q_subcat) )
	 {
		$subcat .= "subcategorii_id[".$i."] = '".$rs_subcat[0]."';";
		$subcat .= "subcategorii_den[".$i."] = '".$rs_subcat[1]."';";
		$i++;
	 }
	 $str_des = str_replace("\n", "\\n", $rs_date["descriere"]);
     $str_arr1 = split("\r",$rs_date["indicatii"]) ;
     $str_ind = "";
     for ($i=0; $i<count($str_arr1); $i++)
        $str_ind .= $str_arr1[$i]."\\n\\";
     $str_ind = substr($str_ind,0,(strlen($str_ind)-3));
     $masuri = explode(",",$rs_date["grila_masuri"]);
	 $grila_masuri = "\n";
	 if($masuri[0] == "unica")
	 {
		 $grila_masuri .= "parent.document.getElementById('unica').checked='checked';\n";
	 }
	 else
	 {		 
		for($i=0;$i<count($masuri);$i++)
		{
			$grila_masuri .= "parent.document.getElementById('".$masuri[$i]."').checked='checked';\n";
		}
	 }
	 if (file_exists("../images/produse/".$rs_date["id"].".jpg")) $foto = "../images/produse/".$rs_date["id"].".jpg";
	 if (file_exists("../images/produse/".$rs_date["id"].".gif")) $foto = "../images/produse/".$rs_date["id"].".gif";
	 if (file_exists("../images/produse/".$rs_date["id"].".png")) $foto = "../images/produse/".$rs_date["id"].".png";
	 echo "
	<html>
	<head>
		 <script type='text/javascript' src='../js/jquery-1.7.1.min.js'></script>
		 <title>Date produs</title>
	</head>
	<body>
     <script>
		".$subcat."
        parent.document.getElementById('id_produs').value='".$rs_date["id"]."';
        parent.document.getElementById('id').value='".$rs_date["id"]."';
        parent.document.getElementById('nume').value='".$rs_date["nume"]."';
        parent.document.getElementById('cod').value='".$rs_date["cod"]."';
        parent.document.getElementById('descriere').value='".$str_des."';
        parent.document.getElementById('pret').value='".$rs_date["pret"]."';
        parent.document.getElementById('indicatii').value='".$str_ind."';
        parent.document.getElementById('reducere').value='".$rs_date["reducere"]."';
        parent.document.getElementById('poza_existenta').src='".$foto."';
		".$grila_masuri."	
		var cat = parent.document.getElementById('categorie');
        for (i=1;i<cat.options.length;i++)
		{
            if (cat.options[i].value==".$rs_date["id_categorie"].")
			{
                cat.options[i].selected = true;
				break;
			}
		}
		
        jQuery(\"#subcategorie option[value!='0']\", window.parent.document).remove();
		for(i=0;i<subcategorii_id.length;i++)
		{
			if (subcategorii_id[i] == '".$rs_date["id_subcategorie"]."')
				jQuery('#subcategorie',window.parent.document).append( new Option(subcategorii_den[i],subcategorii_id[i]) ).attr('selected','selected');
			else
				jQuery('#subcategorie',window.parent.document).append( new Option(subcategorii_den[i],subcategorii_id[i]) );
				
		}
		var subcat = parent.document.getElementById('subcategorie');
		for (i=1;i<subcat.options.length;i++)
		{
            if (subcat.options[i].value == '".$rs_date["id_subcategorie"]."')
			{
                subcat.options[i].selected = true;
				break;
			}
		}
		
        var prod = parent.document.getElementById('producator');
        for (i=1;i<prod.options.length;i++)
		{
            if (prod.options[i].value==".$rs_date["id_producator"].")
			{
                prod.options[i].selected = true;
				break;
			}
		}
        if ( '".$rs_date["prima_pagina"]."' == 'da' )
            parent.document.getElementById('prima_pagina').options[1].selected=true;
        else
            parent.document.getElementById('prima_pagina').options[0].selected=true;
        if ( '".$rs_date["super_oferta"]."' == 'da' )
            parent.document.getElementById('super_oferta').options[1].selected=true;
        else
            parent.document.getElementById('super_oferta').options[0].selected=true;
		
        if ( '".$rs_date["prod_la_comanda"]."' == '1' )
            parent.document.getElementById('prod_la_comanda').options[1].selected=true;
        else
            parent.document.getElementById('prod_la_comanda').options[0].selected=true;
     </script>
	 </body>
	 </html>
     ";
}
?>