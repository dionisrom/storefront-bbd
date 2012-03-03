<?
session_start();
if ( isset($_SESSION["auth"]) && $_SESSION["auth"] == "da" )
{
     include("../inc/global.php");
     $sql_date = "SELECT * FROM produse WHERE id=".$_REQUEST["id"];
     $q_date = mysql_query($sql_date);
     $rs_date = mysql_fetch_array($q_date);
	 $str_des = str_replace("\n", "\\n", $rs_date["descriere"]);
     $str_arr1 = split("\r",$rs_date["indicatii"]) ;
     $str_ind = "";
     for ($i=0; $i<count($str_arr1); $i++)
        $str_ind .= $str_arr1[$i]."\\n\\";
     $str_ind = substr($str_ind,0,(strlen($str_ind)-3));
     echo "
     <script>
        parent.document.getElementById('id_produs').value='".$rs_date["id"]."';
        parent.document.getElementById('id').value='".$rs_date["id"]."';
        parent.document.getElementById('nume').value='".$rs_date["nume"]."';
        parent.document.getElementById('cod').value='".$rs_date["cod"]."';
        parent.document.getElementById('descriere').value='".$str_des."';
        parent.document.getElementById('pret').value='".$rs_date["pret"]."';
        parent.document.getElementById('indicatii').value='".$str_ind."';
        parent.document.getElementById('reducere').value='".$rs_date["reducere"]."';
        parent.document.getElementById('poza_existenta').src='../images/produse/".$rs_date["id"].".jpg';
		var cat = parent.document.getElementById('categorie');
        for (i=1;i<cat.options.length;i++)
            if (cat.options[i].value==".$rs_date["id_categorie"].")
                cat.options[i].selected = true;
        var prod = parent.document.getElementById('producator');
        for (i=1;i<prod.options.length;i++)
            if (prod.options[i].value==".$rs_date["id_producator"].")
                prod.options[i].selected = true;
        if ( '".$rs_date["prima_pagina"]."' == 'da' )
            parent.document.getElementById('prima_pagina').options[1].selected=true;
        else
            parent.document.getElementById('prima_pagina').options[0].selected=true;
        if ( '".$rs_date["super_oferta"]."' == 'da' )
            parent.document.getElementById('super_oferta').options[1].selected=true;
        else
            parent.document.getElementById('super_oferta').options[0].selected=true;
     </script>
     ";
}
?>